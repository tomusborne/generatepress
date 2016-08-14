<?php
/**
 * GeneratePress Customizer
 *
 * @package GeneratePress
 */

if ( ! function_exists( 'generate_customize_register' ) ) :
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
add_action( 'customize_register', 'generate_customize_register' );
function generate_customize_register( $wp_customize ) {

	$defaults = generate_get_defaults();

	// Load custom controls
	require_once get_template_directory() . '/inc/controls.php';
	require_once get_template_directory() . '/inc/sanitize.php';
	
	if ( $wp_customize->get_section( 'title_tagline' ) ) {
		$wp_customize->get_section('title_tagline')->title = __( 'Site Identity', 'generatepress' );
	}
	
	if ( $wp_customize->get_control( 'blogdescription' ) ) {
		$wp_customize->get_control('blogdescription')->priority = 3;
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}
	
	if ( $wp_customize->get_control( 'blogname' ) ) {
		$wp_customize->get_control('blogname')->priority = 1;
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	}
	
	$static_front_page = wp_list_pages( array( 'echo' => false ) );
	if ( ! empty( $static_front_page ) ) {
		$wp_customize->get_section('static_front_page')->title = __( 'Set Front Page', 'generatepress' );
		$wp_customize->get_section('static_front_page')->priority = 10;
	}
	
	if ( $wp_customize->get_section( 'background_image' ) ) {
		$wp_customize->remove_section('background_image');
	}
	
	if ( $wp_customize->get_section( 'colors' ) ) {
		$wp_customize->remove_section('colors');
	}
	
	if ( $wp_customize->get_control( 'header_text' ) ) {
		$wp_customize->remove_control('header_text');
	}
	
	// Remove title
	$wp_customize->add_setting( 
		'generate_settings[hide_title]', 
		array(
			'default' => $defaults['hide_title'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'generate_settings[hide_title]',
		array(
			'type' => 'checkbox',
			'label' => __('Hide site title','generatepress'),
			'section' => 'title_tagline',
			'priority' => 2
		)
	);
	
	$wp_customize->add_setting( 
		'generate_settings[hide_tagline]', 
		array(
			'default' => $defaults['hide_tagline'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'generate_settings[hide_tagline]',
		array(
			'type' => 'checkbox',
			'label' => __('Hide site tagline','generatepress'),
			'section' => 'title_tagline',
			'priority' => 4
		)
	);
	
	// Only show this option if we're not using WordPress 4.5
	if ( ! function_exists( 'the_custom_logo' ) ) {
		$wp_customize->add_setting( 
			'generate_settings[logo]', 
			array(
				'default' => $defaults['logo'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'generate_settings[logo]',
				array(
					'label' => __('Logo','generatepress'),
					'section' => 'title_tagline',
					'settings' => 'generate_settings[logo]'
				)
			)
		);
	}
	
	if ( $wp_customize->get_panel( 'generate_colors_panel' ) ) {		
		$wp_customize->add_section(
			'body_section',
			array(
				'title' => __( 'Body', 'generatepress' ),
				'capability' => 'edit_theme_options',
				'priority' => 30,
				'panel' => 'generate_colors_panel'
			)
		); 
	} else {
		$wp_customize->add_section(
			'body_section',
			array(
				'title' => __( 'Colors', 'generatepress' ),
				'capability' => 'edit_theme_options',
				'priority' => 30,
			)
		); 
	}
	
	// Add color settings
	$body_colors = array();
	$body_colors[] = array(
		'slug'=>'background_color', 
		'default' => $defaults['background_color'],
		'label' => __('Background Color', 'generatepress'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'text_color', 
		'default' => $defaults['text_color'],
		'label' => __('Text Color', 'generatepress'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'link_color', 
		'default' => $defaults['link_color'],
		'label' => __('Link Color', 'generatepress'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'link_color_hover', 
		'default' => $defaults['link_color_hover'],
		'label' => __('Link Color Hover', 'generatepress'),
		'transport' => 'postMessage'
	);
	$body_colors[] = array(
		'slug'=>'link_color_visited', 
		'default' => $defaults['link_color_visited'],
		'label' => __('Link Color Visited', 'generatepress'),
		'transport' => 'refresh'
	);

	foreach( $body_colors as $color ) {
		$wp_customize->add_setting(
			'generate_settings[' . $color['slug'] . ']', array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'generate_sanitize_hex_color',
				'transport' => $color['transport']
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array(
					'label' => $color['label'], 
					'section' => 'body_section',
					'settings' => 'generate_settings[' . $color['slug'] . ']'
				)
			)
		);
	}
	
	if ( !function_exists( 'generate_colors_customize_register' ) && ! defined( 'GP_PREMIUM_VERSION' ) ) {

		$wp_customize->add_control(
			new Generate_Customize_Misc_Control(
				$wp_customize,
				'colors_get_addon_desc',
				array(
					'section'     => 'body_section',
					'type'        => 'addon',
					'label'			=> __( 'More Settings','generatepress' ),
					'url' => 'https://generatepress.com/downloads/generate-colors/',
					'description' => sprintf(
						__( 'Looking to add more color settings?<br /> %s.', 'generatepress' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( 'https://generatepress.com/downloads/generate-colors/' ),
							__( 'Check out Generate Colors', 'generatepress' )
						)
					),
					'priority'    => 30
				)
			)
		);
	}
	
	if ( class_exists( 'WP_Customize_Panel' ) ) :
		if ( ! $wp_customize->get_panel( 'generate_layout_panel' ) ) {
			$wp_customize->add_panel( 'generate_layout_panel', array(
				'priority'       => 25,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => __( 'Layout','generatepress' ),
				'description'    => '',
			) );
		}
	endif;
	
	// Add Layout section
	$wp_customize->add_section(
		'generate_layout_container',
		array(
			'title' => __( 'Container', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'priority' => 10,
			'panel' => 'generate_layout_panel'
		)
	);
	
	// Container width
	$wp_customize->add_setting( 
		'generate_settings[container_width]', 
		array(
			'default' => $defaults['container_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_integer',
			'transport' => 'postMessage'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Customize_Width_Slider_Control( 
			$wp_customize, 
			'generate_settings[container_width]', 
			array(
				'label' => __('Container Width','generatepress'),
				'section' => 'generate_layout_container',
				'settings' => 'generate_settings[container_width]',
				'priority' => 0
			)
		)
	);
	
	// Add Layout section
	$wp_customize->add_section(
		'generate_layout_header',
		array(
			'title' => __( 'Header', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'priority' => 20,
			'panel' => 'generate_layout_panel'
		)
	);
	
	// Add Header Layout setting
	$wp_customize->add_setting(
		'generate_settings[header_layout_setting]',
		array(
			'default' => $defaults['header_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add Header Layout control
	$wp_customize->add_control(
		'generate_settings[header_layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Header Width', 'generatepress' ),
			'section' => 'generate_layout_header',
			'choices' => array(
				'fluid-header' => __( 'Full', 'generatepress' ),
				'contained-header' => __( 'Contained', 'generatepress' )
			),
			'settings' => 'generate_settings[header_layout_setting]',
			'priority' => 5
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[header_alignment_setting]',
		array(
			'default' => $defaults['header_alignment_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[header_alignment_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Header Alignment', 'generatepress' ),
			'section' => 'generate_layout_header',
			'choices' => array(
				'left' => __( 'Left', 'generatepress' ),
				'center' => __( 'Center', 'generatepress' ),
				'right' => __( 'Right', 'generatepress' )
			),
			'settings' => 'generate_settings[header_alignment_setting]',
			'priority' => 10
		)
	);
	
	$wp_customize->add_section(
		'generate_layout_navigation',
		array(
			'title' => __( 'Primary Navigation', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'priority' => 30,
			'panel' => 'generate_layout_panel'
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[nav_layout_setting]',
		array(
			'default' => $defaults['nav_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Navigation Width', 'generatepress' ),
			'section' => 'generate_layout_navigation',
			'choices' => array(
				'fluid-nav' => __( 'Full', 'generatepress' ),
				'contained-nav' => __( 'Contained', 'generatepress' )
			),
			'settings' => 'generate_settings[nav_layout_setting]',
			'priority' => 15
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[nav_position_setting]',
		array(
			'default' => $defaults['nav_position_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_position_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Navigation Position', 'generatepress' ),
			'section' => 'generate_layout_navigation',
			'choices' => array(
				'nav-below-header' => __( 'Below Header', 'generatepress' ),
				'nav-above-header' => __( 'Above Header', 'generatepress' ),
				'nav-float-right' => __( 'Float Right', 'generatepress' ),
				'nav-float-left' => __( 'Float Left', 'generatepress' ),
				'nav-left-sidebar' => __( 'Left Sidebar', 'generatepress' ),
				'nav-right-sidebar' => __( 'Right Sidebar', 'generatepress' ),
				'' => __( 'No Navigation', 'generatepress' )
			),
			'settings' => 'generate_settings[nav_position_setting]',
			'priority' => 20
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[nav_alignment_setting]',
		array(
			'default' => $defaults['nav_alignment_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_alignment_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Navigation Alignment', 'generatepress' ),
			'section' => 'generate_layout_navigation',
			'choices' => array(
				'left' => __( 'Left', 'generatepress' ),
				'center' => __( 'Center', 'generatepress' ),
				'right' => __( 'Right', 'generatepress' )
			),
			'settings' => 'generate_settings[nav_alignment_setting]',
			'priority' => 22
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[nav_dropdown_type]',
		array(
			'default' => $defaults['nav_dropdown_type'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_dropdown_type]',
		array(
			'type' => 'select',
			'label' => __( 'Navigation Dropdown', 'generatepress' ),
			'section' => 'generate_layout_navigation',
			'choices' => array(
				'hover' => __( 'Hover', 'generatepress' ),
				'click' => __( 'Click - Menu Item', 'generatepress' ),
				'click-arrow' => __( 'Click - Arrow', 'generatepress' )
			),
			'settings' => 'generate_settings[nav_dropdown_type]',
			'priority' => 22
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[nav_search]',
		array(
			'default' => $defaults['nav_search'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_search]',
		array(
			'type' => 'select',
			'label' => __( 'Navigation Search', 'generatepress' ),
			'section' => 'generate_layout_navigation',
			'choices' => array(
				'enable' => __( 'Enabled', 'generatepress' ),
				'disable' => __( 'Disabled', 'generatepress' )
			),
			'settings' => 'generate_settings[nav_search]',
			'priority' => 23
		)
	);
	
	// Add content setting
	$wp_customize->add_setting(
		'generate_settings[content_layout_setting]',
		array(
			'default' => $defaults['content_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add content control
	$wp_customize->add_control(
		'generate_settings[content_layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Content Layout', 'generatepress' ),
			'section' => 'generate_layout_container',
			'choices' => array(
				'separate-containers' => __( 'Separate Containers', 'generatepress' ),
				'one-container' => __( 'One Container', 'generatepress' )
			),
			'settings' => 'generate_settings[content_layout_setting]',
			'priority' => 25
		)
	);
	
	$wp_customize->add_section(
		'generate_layout_sidebars',
		array(
			'title' => __( 'Sidebars', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'priority' => 40,
			'panel' => 'generate_layout_panel'
		)
	);
	
	// Add Layout setting
	$wp_customize->add_setting(
		'generate_settings[layout_setting]',
		array(
			'default' => $defaults['layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add Layout control
	$wp_customize->add_control(
		'generate_settings[layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Sidebar Layout', 'generatepress' ),
			'section' => 'generate_layout_sidebars',
			'choices' => array(
				'left-sidebar' => __( 'Sidebar / Content', 'generatepress' ),
				'right-sidebar' => __( 'Content / Sidebar', 'generatepress' ),
				'no-sidebar' => __( 'Content (no sidebars)', 'generatepress' ),
				'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'generatepress' ),
				'both-left' => __( 'Sidebar / Sidebar / Content', 'generatepress' ),
				'both-right' => __( 'Content / Sidebar / Sidebar', 'generatepress' )
			),
			'settings' => 'generate_settings[layout_setting]',
			'priority' => 30
		)
	);
	
	// Add Layout setting
	$wp_customize->add_setting(
		'generate_settings[blog_layout_setting]',
		array(
			'default' => $defaults['blog_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add Layout control
	$wp_customize->add_control(
		'generate_settings[blog_layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Blog Sidebar Layout', 'generatepress' ),
			'section' => 'generate_layout_sidebars',
			'choices' => array(
				'left-sidebar' => __( 'Sidebar / Content', 'generatepress' ),
				'right-sidebar' => __( 'Content / Sidebar', 'generatepress' ),
				'no-sidebar' => __( 'Content (no sidebars)', 'generatepress' ),
				'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'generatepress' ),
				'both-left' => __( 'Sidebar / Sidebar / Content', 'generatepress' ),
				'both-right' => __( 'Content / Sidebar / Sidebar', 'generatepress' )
			),
			'settings' => 'generate_settings[blog_layout_setting]',
			'priority' => 35
		)
	);
	
	// Add Layout setting
	$wp_customize->add_setting(
		'generate_settings[single_layout_setting]',
		array(
			'default' => $defaults['single_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add Layout control
	$wp_customize->add_control(
		'generate_settings[single_layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Single Post Sidebar Layout', 'generatepress' ),
			'section' => 'generate_layout_sidebars',
			'choices' => array(
				'left-sidebar' => __( 'Sidebar / Content', 'generatepress' ),
				'right-sidebar' => __( 'Content / Sidebar', 'generatepress' ),
				'no-sidebar' => __( 'Content (no sidebars)', 'generatepress' ),
				'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'generatepress' ),
				'both-left' => __( 'Sidebar / Sidebar / Content', 'generatepress' ),
				'both-right' => __( 'Content / Sidebar / Sidebar', 'generatepress' )
			),
			'settings' => 'generate_settings[single_layout_setting]',
			'priority' => 36
		)
	);
	
	$wp_customize->add_section(
		'generate_layout_footer',
		array(
			'title' => __( 'Footer', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'priority' => 50,
			'panel' => 'generate_layout_panel'
		)
	);
	
	// Add footer setting
	$wp_customize->add_setting(
		'generate_settings[footer_layout_setting]',
		array(
			'default' => $defaults['footer_layout_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add content control
	$wp_customize->add_control(
		'generate_settings[footer_layout_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Footer Width', 'generatepress' ),
			'section' => 'generate_layout_footer',
			'choices' => array(
				'fluid-footer' => __( 'Full', 'generatepress' ),
				'contained-footer' => __( 'Contained', 'generatepress' )
			),
			'settings' => 'generate_settings[footer_layout_setting]',
			'priority' => 40
		)
	);
	
	// Add footer widget setting
	$wp_customize->add_setting(
		'generate_settings[footer_widget_setting]',
		array(
			'default' => $defaults['footer_widget_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add footer widget control
	$wp_customize->add_control(
		'generate_settings[footer_widget_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Footer Widgets', 'generatepress' ),
			'section' => 'generate_layout_footer',
			'choices' => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5'
			),
			'settings' => 'generate_settings[footer_widget_setting]',
			'priority' => 45
		)
	);
	
	// Add back to top setting
	$wp_customize->add_setting(
		'generate_settings[back_to_top]',
		array(
			'default' => $defaults['back_to_top'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices'
		)
	);
	
	// Add content control
	$wp_customize->add_control(
		'generate_settings[back_to_top]',
		array(
			'type' => 'select',
			'label' => __( 'Back to Top Button', 'generatepress' ),
			'section' => 'generate_layout_footer',
			'choices' => array(
				'enable' => __( 'Enabled', 'generatepress' ),
				'' => __( 'Disabled', 'generatepress' )
			),
			'settings' => 'generate_settings[back_to_top]',
			'priority' => 50
		)
	);
	
	// Add Layout section
	$wp_customize->add_section(
		'blog_section',
		array(
			'title' => __( 'Blog', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'description' => '',
			'priority' => 35,
			'active_callback' => 'generate_is_posts_page'
		)
	);
	
	// Add Layout setting
	$wp_customize->add_setting(
		'generate_settings[post_content]',
		array(
			'default' => $defaults['post_content'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_blog_excerpt'
		)
	);
	
	// Add Layout control
	$wp_customize->add_control(
		'blog_content_control',
		array(
			'type' => 'select',
			'label' => __( 'Blog Post Content', 'generatepress' ),
			'section' => 'blog_section',
			'choices' => array(
				'full' => __( 'Show full post', 'generatepress' ),
				'excerpt' => __( 'Show excerpt', 'generatepress' )
			),
			'settings' => 'generate_settings[post_content]',
			'priority' => 10,
			'active_callback' => 'generate_is_posts_page'
		)
	);
	
	if ( !function_exists( 'generate_blog_customize_register' ) && ! defined( 'GP_PREMIUM_VERSION' ) ) {

		$wp_customize->add_control(
			new Generate_Customize_Misc_Control(
				$wp_customize,
				'blog_get_addon_desc',
				array(
					'section'     => 'blog_section',
					'type'        => 'addon',
					'label'			=> __( 'More Settings','generatepress' ),
					'url' => 'https://generatepress.com/downloads/generate-blog/',
					'description' => sprintf(
						__( 'Looking to add more blog settings?<br /> %s.', 'generatepress' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( 'https://generatepress.com/downloads/generate-blog/' ),
							__( 'Check out Generate Blog', 'generatepress' )
						)
					),
					'priority'    => 30
				)
			)
		);
	}
}
endif;

if ( ! function_exists( 'generate_customizer_live_preview' ) ) :
add_action( 'customize_preview_init', 'generate_customizer_live_preview' );
function generate_customizer_live_preview()
{
	wp_enqueue_script( 
		  'generate-themecustomizer',
		  get_template_directory_uri().'/inc/js/customizer.js',
		  array( 'jquery','customize-preview' ),
		  GENERATE_VERSION,
		  true
	);
}
endif;

/**
 * Heading area
 *
 * Since 0.1
 **/
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'GenerateLabelControl' ) ) {
    # Adds textarea support to the theme customizer
    class GenerateLabelControl extends WP_Customize_Control {
        public $type = 'label';
        public function __construct( $manager, $id, $args = array() ) {
            $this->statuses = array( '' => __( 'Default', 'generatepress' ) );
            parent::__construct( $manager, $id, $args );
        }
 
        public function render_content() {
            echo '<span class="generate_customize_label">' . esc_html( $this->label ) . '</span>';
        }
    }
 
}

/**
 * Class Generate_Customize_Misc_Control
 *
 * Control for adding arbitrary HTML to a Customizer section.
 *
 * @since 1.0.7
 */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Customize_Misc_Control' ) ) {
	class Generate_Customize_Misc_Control extends WP_Customize_Control {
		public $settings = 'blogname';
		public $description = '';
		public $url = '';
		public $group = '';

		public function render_content() {
			switch ( $this->type ) {
				default:
				case 'text' :
					echo '<p class="description">' . $this->description . '</p>';
					break;

				case 'addon':
					echo '<span class="get-addon">' . sprintf(
								'<a href="%1$s" target="_blank">%2$s</a>',
								esc_url( $this->url ),
								__('Add-on available','generatepress')
							) . '</span>';
					echo '<p class="description" style="margin-top:5px;">' . $this->description . '</p>';
					break;
					
				case 'line' :
					echo '<hr />';
					break;
			}
		}
	}
}

if ( ! function_exists( 'generate_customize_preview_css' ) ) :
add_action('customize_controls_print_styles', 'generate_customize_preview_css');
function generate_customize_preview_css() {
	?>
	<style>
		.customize-control-line {
			display: none !important;
		}
		#accordion-section-secondary_bg_images_section li.customize-section-description-container {
			float: none;
			width: 100%;
		}
		#customize-control-blogname,
		#customize-control-blogdescription {
			margin-bottom: 0;
		}
		
		.customize-control-title.addon {
			display:inline;
		}

		.get-addon a {
			background: #D54E21;
			color:#FFF;
			text-transform: uppercase;
			font-size:11px;
			padding: 3px 5px;
			font-weight: bold;
		}
		
		.customize-control-addon {
			margin-top: 10px;
		}
		
		.slider-input {
			width: 40px !important;
			font-size: 12px;
			padding: 2px;
			text-align: center;
		}
		
		span.value {
			display: inline-block;
			float: right;
			width: 30%;
			text-align: right;
		}
		
		span.typography-size-label {
			display: inline-block;
			width: 70%;
		}
		
		div.slider {
			margin-top: 8px;
		}
		
		span.px {
			background: #FAFAFA;
			line-height: 18px;
			display: inline-block;
			padding: 2px 5px;
			font-style: normal;
			font-weight: bold;
			border-right: 1px solid #DDD;
			border-top: 1px solid #DDD;
			border-bottom: 1px solid #DDD;
			font-size: 12px;
		}
		
	</style>
	<?php
}
endif;

if ( ! function_exists( 'generate_customize_preview_js' ) ) :
add_action('customize_controls_print_footer_scripts', 'generate_customize_preview_js');
function generate_customize_preview_js()
{
	if ( generate_addons_available() !== true )
		return;
	?>
	<script>
		jQuery( window ).load( function() {
			jQuery('#accordion-section-themes').append('<span class="get-addon" style="display:block;position:relative;top:-15px;"><a style="display:block;padding-left: 15px;padding-right:0;" href="<?php echo esc_url('https://generatepress.com/add-ons');?>" target="_blank"><?php _e('Add-ons Available! Take a look','generatepress');?> &rarr;</a></span>');
		});
	</script>
	<?php
}
endif;

if ( ! function_exists( 'generate_is_posts_page' ) ) :
function generate_is_posts_page()
{
	$blog = ( is_home() || is_archive() || is_attachment() || is_tax() ) ? true : false;
	
	return $blog;
}
endif;