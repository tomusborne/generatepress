<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

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
	// Get our default values
	$defaults = generate_get_defaults();

	// Load custom controls
	require_once get_template_directory() . '/inc/controls.php';
	require_once get_template_directory() . '/inc/sanitize.php';
	
	if ( $wp_customize->get_control( 'blogdescription' ) ) {
		$wp_customize->get_control('blogdescription')->priority = 3;
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}
	
	if ( $wp_customize->get_control( 'blogname' ) ) {
		$wp_customize->get_control('blogname')->priority = 1;
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	}
	
	// Add control types so controls can be built using JS
	if ( method_exists( $wp_customize, 'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Customize_Misc_Control' );
		$wp_customize->register_control_type( 'Generate_Range_Slider_Control' );
	}
	
	// Add upsell section type
	if ( method_exists( $wp_customize, 'register_section_type' ) ) {
		$wp_customize->register_section_type( 'GeneratePress_Upsell_Section' );
	}
	
	// Add selective refresh to site title and description
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.main-title a',
			'render_callback' => 'generate_customize_partial_blogname',
		) );
		
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'render_callback' => 'generate_customize_partial_blogdescription',
		) );
	}
	
	// Add our upsell section
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		$wp_customize->add_section( 
			new GeneratePress_Upsell_Section( $wp_customize, 'generatepress_upsell_section',
				array(
					'pro_text' => __( 'Add-ons Available! Take a look', 'generatepress' ),
					'pro_url' => generate_get_premium_url( 'https://generatepress.com/premium' ),
					'capability' => 'edit_theme_options',
					'priority' => 0,
					'type' => 'gp-upsell-section'
				)
			)
		); 
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
	
	// Remove tagline
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
					'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-colors/' ),
					'description' => sprintf(
						__( 'Looking to add more color settings?<br /> %s.', 'generatepress' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							generate_get_premium_url( 'https://generatepress.com/downloads/generate-colors/' ),
							__( 'Check out Generate Colors', 'generatepress' )
						)
					),
					'priority'    => 30,
					'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
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
		new Generate_Range_Slider_Control(
			$wp_customize,
			'generate_settings[container_width]', 
			array(
				'type' => 'generatepress-range-slider',
				'label' => __( 'Container Width', 'generatepress' ), 
				'section' => 'generate_layout_container',
				'settings' => array( 
					'desktop' => 'generate_settings[container_width]',
				),
				'choices' => array(
					'desktop' => array(
						'min' => 700,
						'max' => 2000,
						'step' => 5,
						'edit' => true,
						'unit' => 'px',
					),
				),
				'priority' => 0,
			)
		)
	);
	
	// Add Top Bar section
	$wp_customize->add_section(
		'generate_top_bar',
		array(
			'title' => __( 'Top Bar', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'priority' => 15,
			'panel' => 'generate_layout_panel',
		)
	);
	
	// Add Top Bar width
	$wp_customize->add_setting(
		'generate_settings[top_bar_width]',
		array(
			'default' => $defaults['top_bar_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add Top Bar width control
	$wp_customize->add_control(
		'generate_settings[top_bar_width]',
		array(
			'type' => 'select',
			'label' => __( 'Top Bar Width', 'generatepress' ),
			'section' => 'generate_top_bar',
			'choices' => array(
				'full' => __( 'Full', 'generatepress' ),
				'contained' => __( 'Contained', 'generatepress' )
			),
			'settings' => 'generate_settings[top_bar_width]',
			'priority' => 5,
			'active_callback' => 'generate_is_top_bar_active',
		)
	);
	
	// Add Top Bar inner width
	$wp_customize->add_setting(
		'generate_settings[top_bar_inner_width]',
		array(
			'default' => $defaults['top_bar_inner_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add Top Bar width control
	$wp_customize->add_control(
		'generate_settings[top_bar_inner_width]',
		array(
			'type' => 'select',
			'label' => __( 'Top Bar Inner Width', 'generatepress' ),
			'section' => 'generate_top_bar',
			'choices' => array(
				'full' => __( 'Full', 'generatepress' ),
				'contained' => __( 'Contained', 'generatepress' )
			),
			'settings' => 'generate_settings[top_bar_inner_width]',
			'priority' => 10,
			'active_callback' => 'generate_is_top_bar_active',
		)
	);
	
	// Add top bar alignment
	$wp_customize->add_setting(
		'generate_settings[top_bar_alignment]',
		array(
			'default' => $defaults['top_bar_alignment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[top_bar_alignment]',
		array(
			'type' => 'select',
			'label' => __( 'Top Bar Alignment', 'generatepress' ),
			'section' => 'generate_top_bar',
			'choices' => array(
				'left' => __( 'Left', 'generatepress' ),
				'center' => __( 'Center', 'generatepress' ),
				'right' => __( 'Right', 'generatepress' )
			),
			'settings' => 'generate_settings[top_bar_alignment]',
			'priority' => 15,
			'active_callback' => 'generate_is_top_bar_active',
		)
	);
	
	// Add Header section
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
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
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
	
	// Add Inside Header Layout setting
	$wp_customize->add_setting(
		'generate_settings[header_inner_width]',
		array(
			'default' => $defaults['header_inner_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add Header Layout control
	$wp_customize->add_control(
		'generate_settings[header_inner_width]',
		array(
			'type' => 'select',
			'label' => __( 'Inner Header Width', 'generatepress' ),
			'section' => 'generate_layout_header',
			'choices' => array(
				'contained' => __( 'Contained', 'generatepress' ),
				'full-width' => __( 'Full', 'generatepress' )
			),
			'settings' => 'generate_settings[header_inner_width]',
			'priority' => 6
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[header_alignment_setting]',
		array(
			'default' => $defaults['header_alignment_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
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
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
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
		'generate_settings[nav_inner_width]',
		array(
			'default' => $defaults['nav_inner_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_inner_width]',
		array(
			'type' => 'select',
			'label' => __( 'Inner Navigation Width', 'generatepress' ),
			'section' => 'generate_layout_navigation',
			'choices' => array(
				'contained' => __( 'Contained', 'generatepress' ),
				'full-width' => __( 'Full', 'generatepress' )
			),
			'settings' => 'generate_settings[nav_inner_width]',
			'priority' => 16
		)
	);
	
	// Add navigation setting
	$wp_customize->add_setting(
		'generate_settings[nav_position_setting]',
		array(
			'default' => $defaults['nav_position_setting'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => ( '' !== generate_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh'
		)
	);
	
	// Add navigation control
	$wp_customize->add_control(
		'generate_settings[nav_position_setting]',
		array(
			'type' => 'select',
			'label' => __( 'Navigation Location', 'generatepress' ),
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
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
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
				'enable' => __( 'Enable', 'generatepress' ),
				'disable' => __( 'Disable', 'generatepress' )
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
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
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
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
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
	
	// Add footer setting
	$wp_customize->add_setting(
		'generate_settings[footer_inner_width]',
		array(
			'default' => $defaults['footer_inner_width'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add content control
	$wp_customize->add_control(
		'generate_settings[footer_inner_width]',
		array(
			'type' => 'select',
			'label' => __( 'Inner Footer Width', 'generatepress' ),
			'section' => 'generate_layout_footer',
			'choices' => array(
				'contained' => __( 'Contained', 'generatepress' ),
				'full-width' => __( 'Full', 'generatepress' )
			),
			'settings' => 'generate_settings[footer_inner_width]',
			'priority' => 41
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
	
	// Add footer widget setting
	$wp_customize->add_setting(
		'generate_settings[footer_bar_alignment]',
		array(
			'default' => $defaults['footer_bar_alignment'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
	
	// Add footer widget control
	$wp_customize->add_control(
		'generate_settings[footer_bar_alignment]',
		array(
			'type' => 'select',
			'label' => __( 'Footer Bar Alignment', 'generatepress' ),
			'section' => 'generate_layout_footer',
			'choices' => array(
				'left' => __( 'Left','generatepress' ),
				'center' => __( 'Center','generatepress' ),
				'right' => __( 'Right','generatepress' )
			),
			'settings' => 'generate_settings[footer_bar_alignment]',
			'priority' => 47,
			'active_callback' => 'generate_is_footer_bar_active'
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
				'enable' => __( 'Enable', 'generatepress' ),
				'' => __( 'Disable', 'generatepress' )
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
			'priority' => 35
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
			'priority' => 10
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
					'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-blog/' ),
					'description' => sprintf(
						__( 'Looking to add more blog settings?<br /> %s.', 'generatepress' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							generate_get_premium_url( 'https://generatepress.com/downloads/generate-blog/' ),
							__( 'Check out Generate Blog', 'generatepress' )
						)
					),
					'priority'    => 30,
					'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
				)
			)
		);
	}
}
endif;

if ( ! function_exists( 'generate_customizer_live_preview' ) ) :
/**
 * Add our live preview scripts
 *
 * @since 0.1
 */
add_action( 'customize_preview_init', 'generate_customizer_live_preview', 100 );
function generate_customizer_live_preview()
{
	wp_enqueue_script( 'generate-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/js/customizer.js', array( 'customize-preview' ), GENERATE_VERSION, true );
}
endif;

if ( ! function_exists( 'generate_customizer_controls_css' ) ) :
/**
 * Add CSS for our controls
 *
 * @since 1.3.41
 */
add_action( 'customize_controls_enqueue_scripts', 'generate_customizer_controls_css' );
function generate_customizer_controls_css()
{
	wp_enqueue_style( 'generate-customizer-controls-css', get_template_directory_uri().'/inc/css/customizer.css', array(), GENERATE_VERSION );
	wp_enqueue_script( 'generatepress-upsell', trailingslashit( get_template_directory_uri() ) . 'inc/js/upsell-control.js', array( 'customize-controls' ), false, true );
}
endif;

if ( ! function_exists( 'generate_is_posts_page' ) ) :
/**
 * Check to see if we're on a posts page
 *
 * @since 1.3.39
 */
function generate_is_posts_page()
{
	return ( is_home() || is_archive() || is_tax() ) ? true : false;
}
endif;

if ( ! function_exists( 'generate_is_footer_bar_active' ) ) :
/**
 * Check to see if we're using our footer bar widget
 *
 * @since 1.3.42
 */
function generate_is_footer_bar_active() 
{
	return ( is_active_sidebar( 'footer-bar' ) ) ? true : false;
}
endif;

if ( ! function_exists( 'generate_is_top_bar_active' ) ) :
/**
 * Check to see if the top bar is active
 *
 * @since 1.3.45
 */
function generate_is_top_bar_active()
{
	$top_bar = is_active_sidebar( 'top-bar' ) ? true : false;
	return apply_filters( 'generate_is_top_bar_active', $top_bar );
}
endif;

if ( ! function_exists( 'generate_hidden_navigation' ) && function_exists( 'is_customize_preview' ) ) :
/**
 * Adds a hidden navigation if no navigation is set
 * This allows us to use postMessage to position the navigation when it doesn't exist
 *
 * @since 1.3.40
 */
add_action( 'wp_footer','generate_hidden_navigation' );
function generate_hidden_navigation()
{
	if ( is_customize_preview() && function_exists( 'generate_navigation_position' ) ) {
		?>
		<div style="display:none;">
			<?php generate_navigation_position(); ?>
		</div>
		<?php
	}
}
endif;

if ( ! function_exists( 'generate_customize_partial_blogname' ) ) :
/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.3.41
 */
function generate_customize_partial_blogname() {
	bloginfo( 'name' );
}
endif;

if ( ! function_exists( 'generate_customize_partial_blogdescription' ) ) :
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.3.41
 */
function generate_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
endif;