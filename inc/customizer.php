<?php
/**
 * Builds our Customizer controls.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'generate_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 * @since 2.0
 */
function generate_set_customizer_helpers( $wp_customize ) {
	// Load helpers
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'generate_customize_register' ) ) {
	add_action( 'customize_register', 'generate_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function generate_customize_register( $wp_customize ) {
		// Get our default values
		$defaults = generate_get_defaults();

		// Load helpers
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		if ( $wp_customize->get_control( 'blogdescription' ) ) {
			$wp_customize->get_control( 'blogdescription' )->priority = 3;
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'blogname' ) ) {
			$wp_customize->get_control( 'blogname' )->priority = 1;
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
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
						'pro_text' => __( 'Premium Modules Available', 'generatepress' ),
						'pro_url' => generate_get_premium_url( 'https://generatepress.com/premium' ),
						'capability' => 'edit_theme_options',
						'priority' => 0,
						'type' => 'gp-upsell-section',
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
				'sanitize_callback' => 'generate_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'generate_settings[hide_title]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site title', 'generatepress' ),
				'section' => 'title_tagline',
				'priority' => 2,
			)
		);

		// Remove tagline
		$wp_customize->add_setting(
			'generate_settings[hide_tagline]',
			array(
				'default' => $defaults['hide_tagline'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'generate_settings[hide_tagline]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site tagline', 'generatepress' ),
				'section' => 'title_tagline',
				'priority' => 4,
			)
		);

		// Only show this option if we're not using WordPress 4.5
		if ( ! function_exists( 'the_custom_logo' ) ) {
			$wp_customize->add_setting(
				'generate_settings[logo]',
				array(
					'default' => $defaults['logo'],
					'type' => 'option',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'generate_settings[logo]',
					array(
						'label' => __( 'Logo', 'generatepress' ),
						'section' => 'title_tagline',
						'settings' => 'generate_settings[logo]',
					)
				)
			);
		}

		$wp_customize->add_setting(
			'generate_settings[retina_logo]',
			array(
				'default' => $defaults['retina_logo'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'generate_settings[retina_logo]',
				array(
					'label' => __( 'Retina Logo', 'generatepress' ),
					'section' => 'title_tagline',
					'settings' => 'generate_settings[retina_logo]',
					'active_callback' => 'generate_has_custom_logo_callback',
				)
			)
		);

		$wp_customize->add_section(
			'body_section',
			array(
				'title' => $wp_customize->get_panel( 'generate_colors_panel' ) ? __( 'Body', 'generatepress' ) : __( 'Colors', 'generatepress' ),
				'capability' => 'edit_theme_options',
				'priority' => 30,
				'panel' => $wp_customize->get_panel( 'generate_colors_panel' ) ? 'generate_colors_panel' : false,
			)
		);

		$wp_customize->add_setting(
			'generate_settings[background_color]', array(
				'default' => $defaults['background_color'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'generate_settings[background_color]',
				array(
					'label' => __( 'Background Color', 'generatepress' ),
					'section' => 'body_section',
					'settings' => 'generate_settings[background_color]',
				)
			)
		);

		$wp_customize->add_setting(
			'generate_settings[text_color]', array(
				'default' => $defaults['text_color'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'generate_settings[text_color]',
				array(
					'label' => __( 'Text Color', 'generatepress' ),
					'section' => 'body_section',
					'settings' => 'generate_settings[text_color]',
				)
			)
		);

		$wp_customize->add_setting(
			'generate_settings[link_color]', array(
				'default' => $defaults['link_color'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'generate_settings[link_color]',
				array(
					'label' => __( 'Link Color', 'generatepress' ),
					'section' => 'body_section',
					'settings' => 'generate_settings[link_color]',
				)
			)
		);

		$wp_customize->add_setting(
			'generate_settings[link_color_hover]', array(
				'default' => $defaults['link_color_hover'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'generate_settings[link_color_hover]',
				array(
					'label' => __( 'Link Color Hover', 'generatepress' ),
					'section' => 'body_section',
					'settings' => 'generate_settings[link_color_hover]',
				)
			)
		);

		$wp_customize->add_setting(
			'generate_settings[link_color_visited]', array(
				'default' => $defaults['link_color_visited'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_hex_color',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'generate_settings[link_color_visited]',
				array(
					'label' => __( 'Link Color Visited', 'generatepress' ),
					'section' => 'body_section',
					'settings' => 'generate_settings[link_color_visited]',
				)
			)
		);

		if ( ! function_exists( 'generate_colors_customize_register' ) && ! defined( 'GP_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Generate_Customize_Misc_Control(
					$wp_customize,
					'colors_get_addon_desc',
					array(
						'section' => 'body_section',
						'type' => 'addon',
						'label' => __( 'Learn More', 'generatepress' ),
						'description' => __( 'More options are available for this section in our premium version.', 'generatepress' ),
						'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-colors/' ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'generate_layout_panel' ) ) {
				$wp_customize->add_panel( 'generate_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'generatepress' ),
				) );
			}
		}

		// Add Layout section
		$wp_customize->add_section(
			'generate_layout_container',
			array(
				'title' => __( 'Container', 'generatepress' ),
				'priority' => 10,
				'panel' => 'generate_layout_panel',
			)
		);

		// Container width
		$wp_customize->add_setting(
			'generate_settings[container_width]',
			array(
				'default' => $defaults['container_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_integer',
				'transport' => 'postMessage',
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
				'transport' => 'postMessage',
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
					'contained' => __( 'Contained', 'generatepress' ),
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
				'transport' => 'postMessage',
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
					'contained' => __( 'Contained', 'generatepress' ),
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
				'transport' => 'postMessage',
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
					'right' => __( 'Right', 'generatepress' ),
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
				'priority' => 20,
				'panel' => 'generate_layout_panel',
			)
		);

		// Add Header Layout setting
		$wp_customize->add_setting(
			'generate_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'contained-header' => __( 'Contained', 'generatepress' ),
				),
				'settings' => 'generate_settings[header_layout_setting]',
				'priority' => 5,
			)
		);

		// Add Inside Header Layout setting
		$wp_customize->add_setting(
			'generate_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'full-width' => __( 'Full', 'generatepress' ),
				),
				'settings' => 'generate_settings[header_inner_width]',
				'priority' => 6,
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'right' => __( 'Right', 'generatepress' ),
				),
				'settings' => 'generate_settings[header_alignment_setting]',
				'priority' => 10,
			)
		);

		$wp_customize->add_section(
			'generate_layout_navigation',
			array(
				'title' => __( 'Primary Navigation', 'generatepress' ),
				'priority' => 30,
				'panel' => 'generate_layout_panel',
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'contained-nav' => __( 'Contained', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_layout_setting]',
				'priority' => 15,
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'full-width' => __( 'Full', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_inner_width]',
				'priority' => 16,
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'right' => __( 'Right', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_alignment_setting]',
				'priority' => 20,
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => ( '' !== generate_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh',
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
					'' => __( 'No Navigation', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_position_setting]',
				'priority' => 22,
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'click-arrow' => __( 'Click - Arrow', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_dropdown_type]',
				'priority' => 22,
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'generate_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'disable' => __( 'Disable', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_search]',
				'priority' => 23,
			)
		);

		// Add content setting
		$wp_customize->add_setting(
			'generate_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'one-container' => __( 'One Container', 'generatepress' ),
				),
				'settings' => 'generate_settings[content_layout_setting]',
				'priority' => 25,
			)
		);

		$wp_customize->add_section(
			'generate_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'generatepress' ),
				'priority' => 40,
				'panel' => 'generate_layout_panel',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'generate_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'both-right' => __( 'Content / Sidebar / Sidebar', 'generatepress' ),
				),
				'settings' => 'generate_settings[layout_setting]',
				'priority' => 30,
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'generate_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'both-right' => __( 'Content / Sidebar / Sidebar', 'generatepress' ),
				),
				'settings' => 'generate_settings[blog_layout_setting]',
				'priority' => 35,
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'generate_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'both-right' => __( 'Content / Sidebar / Sidebar', 'generatepress' ),
				),
				'settings' => 'generate_settings[single_layout_setting]',
				'priority' => 36,
			)
		);

		$wp_customize->add_section(
			'generate_layout_footer',
			array(
				'title' => __( 'Footer', 'generatepress' ),
				'priority' => 50,
				'panel' => 'generate_layout_panel',
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'generate_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'contained-footer' => __( 'Contained', 'generatepress' ),
				),
				'settings' => 'generate_settings[footer_layout_setting]',
				'priority' => 40,
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'generate_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'full-width' => __( 'Full', 'generatepress' ),
				),
				'settings' => 'generate_settings[footer_inner_width]',
				'priority' => 41,
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'generate_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'5' => '5',
				),
				'settings' => 'generate_settings[footer_widget_setting]',
				'priority' => 45,
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'generate_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
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
					'right' => __( 'Right','generatepress' ),
				),
				'settings' => 'generate_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'generate_is_footer_bar_active',
			)
		);

		// Add back to top setting
		$wp_customize->add_setting(
			'generate_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
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
					'' => __( 'Disable', 'generatepress' ),
				),
				'settings' => 'generate_settings[back_to_top]',
				'priority' => 50,
			)
		);

		// Add Layout section
		$wp_customize->add_section(
			'generate_blog_section',
			array(
				'title' => __( 'Blog', 'generatepress' ),
				'priority' => 55,
				'panel' => 'generate_layout_panel',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'generate_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_blog_excerpt',
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'generatepress' ),
				'section' => 'generate_blog_section',
				'choices' => array(
					'full' => __( 'Full', 'generatepress' ),
					'excerpt' => __( 'Excerpt', 'generatepress' ),
				),
				'settings' => 'generate_settings[post_content]',
				'priority' => 10,
			)
		);

		if ( ! function_exists( 'generate_blog_customize_register' ) && ! defined( 'GP_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Generate_Customize_Misc_Control(
					$wp_customize,
					'blog_get_addon_desc',
					array(
						'section' => 'generate_blog_section',
						'type' => 'addon',
						'label' => __( 'Learn more', 'generatepress' ),
						'description' => __( 'More options are available for this section in our premium version.', 'generatepress' ),
						'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-blog/' ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
					)
				)
			);
		}

		// Add Performance section
		$wp_customize->add_section(
			'generate_general_section',
			array(
				'title' => __( 'General', 'generatepress' ),
				'priority' => 99,
			)
		);

		if ( ! apply_filters( 'generate_fontawesome_essentials', false ) ) {
			$wp_customize->add_setting(
				'generate_settings[font_awesome_essentials]',
				array(
					'default' => $defaults['font_awesome_essentials'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'generate_settings[font_awesome_essentials]',
				array(
					'type' => 'checkbox',
					'label' => __( 'Load essential icons only', 'generatepress' ),
					'description' => __( 'Load essential Font Awesome icons instead of the full library.', 'generatepress' ),
					'section' => 'generate_general_section',
					'settings' => 'generate_settings[font_awesome_essentials]',
				)
			);
		}

		$wp_customize->add_setting(
			'generate_settings[dynamic_css_cache]',
			array(
				'default' => $defaults['dynamic_css_cache'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'generate_settings[dynamic_css_cache]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Cache dynamic CSS', 'generatepress' ),
				'description' => __( 'Cache CSS generated by your options to boost performance.', 'generatepress' ),
				'section' => 'generate_general_section',
			)
		);
	}
}

if ( ! function_exists( 'generate_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'generate_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 * @since 0.1
	 */
	function generate_customizer_live_preview() {
		wp_enqueue_script( 'generate-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/js/customizer-live-preview.js', array( 'customize-preview' ), GENERATE_VERSION, true );
	}
}
