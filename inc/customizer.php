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
function generate_set_customizer_helpers() {
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
		$defaults = generate_get_defaults();

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

		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( 'Generate_Customize_Misc_Control' );
			$wp_customize->register_control_type( 'Generate_Range_Slider_Control' );
		}

		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'GeneratePress_Upsell_Section' );
		}

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector' => '.main-title a',
					'render_callback' => 'generate_customize_partial_blogname',
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector' => '.site-description',
					'render_callback' => 'generate_customize_partial_blogdescription',
				)
			);
		}

		if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new GeneratePress_Upsell_Section(
					$wp_customize,
					'generatepress_upsell_section',
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

		$wp_customize->add_setting(
			'generate_settings[logo_width]',
			array(
				'default' => $defaults['logo_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_empty_absint',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[logo_width]',
				array(
					'label' => __( 'Logo Width', 'generatepress' ),
					'section' => 'title_tagline',
					'settings' => array(
						'desktop' => 'generate_settings[logo_width]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 20,
							'max' => 1200,
							'step' => 10,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'active_callback' => 'generate_has_custom_logo_callback',
				)
			)
		);

		$wp_customize->add_setting(
			'generate_settings[inline_logo_site_branding]',
			array(
				'default' => $defaults['inline_logo_site_branding'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'generate_settings[inline_logo_site_branding]',
			array(
				'type' => 'checkbox',
				'label' => esc_html__( 'Place logo next to title', 'generatepress' ),
				'section' => 'title_tagline',
				'active_callback' => 'generate_show_inline_logo_callback',
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
			'generate_settings[background_color]',
			array(
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
			'generate_settings[text_color]',
			array(
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
			'generate_settings[link_color]',
			array(
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
			'generate_settings[link_color_hover]',
			array(
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

		if ( '' !== generate_get_option( 'link_color_visited' ) ) {
			$wp_customize->add_setting(
				'generate_settings[link_color_visited]',
				array(
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
		}

		$color_defaults = generate_get_color_defaults();

		if ( ! $wp_customize->get_setting( 'generate_settings[blog_post_title_color]' ) ) {
			$wp_customize->add_setting(
				'generate_settings[blog_post_title_color]',
				array(
					'default' => $color_defaults['blog_post_title_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'blog_post_title_color',
					array(
						'label' => __( 'Blog Post Title', 'generatepress' ),
						'section' => $wp_customize->get_section( 'content_color_section' ) ? 'content_color_section' : 'body_section',
						'settings' => 'generate_settings[blog_post_title_color]',
					)
				)
			);

			$wp_customize->add_setting(
				'generate_settings[blog_post_title_hover_color]',
				array(
					'default' => $color_defaults['blog_post_title_hover_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'blog_post_title_hover_color',
					array(
						'label' => __( 'Blog Post Title Hover', 'generatepress' ),
						'section' => $wp_customize->get_section( 'content_color_section' ) ? 'content_color_section' : 'body_section',
						'settings' => 'generate_settings[blog_post_title_hover_color]',
					)
				)
			);
		}

		$wp_customize->add_setting(
			'nav_color_presets',
			array(
				'default' => 'current',
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_preset_layout',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'nav_color_presets',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Color Presets', 'generatepress' ),
				'section' => $wp_customize->get_section( 'navigation_color_section' ) ? 'navigation_color_section' : 'body_section',
				'priority' => $wp_customize->get_section( 'navigation_color_section' ) ? 0 : null,
				'choices' => array(
					'current' => __( 'Current', 'generatepress' ),
					'default' => __( 'Default', 'generatepress' ),
					'classic' => __( 'Classic', 'generatepress' ),
					'grey' => __( 'Grey', 'generatepress' ),
					'red' => __( 'Red', 'generatepress' ),
					'green' => __( 'Green', 'generatepress' ),
					'blue' => __( 'Blue', 'generatepress' ),
				),
				'settings' => 'nav_color_presets',
			)
		);

		if ( ! $wp_customize->get_setting( 'generate_settings[navigation_background_color]' ) ) {
			$wp_customize->add_setting(
				'generate_settings[navigation_background_color]',
				array(
					'default' => $color_defaults['navigation_background_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[navigation_text_color]',
				array(
					'default' => $color_defaults['navigation_text_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[navigation_background_hover_color]',
				array(
					'default'     => $color_defaults['navigation_background_hover_color'],
					'type'        => 'option',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[navigation_text_hover_color]',
				array(
					'default'     => $color_defaults['navigation_text_hover_color'],
					'type'        => 'option',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'generate_sanitize_hex_color',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[navigation_background_current_color]',
				array(
					'default' => $color_defaults['navigation_background_current_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[navigation_text_current_color]',
				array(
					'default' => $color_defaults['navigation_text_current_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[subnavigation_background_color]',
				array(
					'default'     => $color_defaults['subnavigation_background_color'],
					'type'        => 'option',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[subnavigation_text_color]',
				array(
					'default' => $color_defaults['subnavigation_text_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[subnavigation_background_hover_color]',
				array(
					'default'     => $color_defaults['subnavigation_background_hover_color'],
					'type'        => 'option',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[subnavigation_text_hover_color]',
				array(
					'default' => $color_defaults['subnavigation_text_hover_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[subnavigation_background_current_color]',
				array(
					'default'     => $color_defaults['subnavigation_background_current_color'],
					'type'        => 'option',
					'transport'   => 'postMessage',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
				)
			);

			$wp_customize->add_setting(
				'generate_settings[subnavigation_text_current_color]',
				array(
					'default' => $color_defaults['subnavigation_text_current_color'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_hex_color',
					'transport' => 'postMessage',
				)
			);
		}

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
						'url' => generate_get_premium_url( 'https://generatepress.com/premium/#colors', false ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'generate_layout_panel' ) ) {
				$wp_customize->add_panel(
					'generate_layout_panel',
					array(
						'priority' => 25,
						'title' => __( 'Layout', 'generatepress' ),
					)
				);
			}
		}

		$wp_customize->add_section(
			'generate_layout_container',
			array(
				'title' => __( 'Container', 'generatepress' ),
				'priority' => 10,
				'panel' => 'generate_layout_panel',
			)
		);

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

		$wp_customize->add_section(
			'generate_top_bar',
			array(
				'title' => __( 'Top Bar', 'generatepress' ),
				'priority' => 15,
				'panel' => 'generate_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[top_bar_width]',
			array(
				'default' => $defaults['top_bar_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[top_bar_inner_width]',
			array(
				'default' => $defaults['top_bar_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[top_bar_alignment]',
			array(
				'default' => $defaults['top_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_section(
			'generate_layout_header',
			array(
				'title' => __( 'Header', 'generatepress' ),
				'priority' => 20,
				'panel' => 'generate_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'generate_header_helper',
			array(
				'default' => 'current',
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_preset_layout',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'generate_header_helper',
			array(
				'type' => 'select',
				'label' => __( 'Header Presets', 'generatepress' ),
				'section' => 'generate_layout_header',
				'choices' => array(
					'current' => __( 'Current', 'generatepress' ),
					'default' => __( 'Default', 'generatepress' ),
					'classic' => __( 'Classic', 'generatepress' ),
					'nav-before' => __( 'Navigation Before', 'generatepress' ),
					'nav-after' => __( 'Navigation After', 'generatepress' ),
					'nav-before-centered' => __( 'Navigation Before - Centered', 'generatepress' ),
					'nav-after-centered' => __( 'Navigation After - Centered', 'generatepress' ),
					'nav-left' => __( 'Navigation Left', 'generatepress' ),
				),
				'settings' => 'generate_header_helper',
				'priority' => 4,
			)
		);

		if ( ! $wp_customize->get_setting( 'generate_settings[site_title_font_size]' ) ) {
			$typography_defaults = generate_get_default_fonts();

			$wp_customize->add_setting(
				'generate_settings[site_title_font_size]',
				array(
					'default' => $typography_defaults['site_title_font_size'],
					'type' => 'option',
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
				)
			);
		}

		if ( ! $wp_customize->get_setting( 'generate_spacing_settings[header_top]' ) ) {
			$spacing_defaults = generate_spacing_get_defaults();

			$wp_customize->add_setting(
				'generate_spacing_settings[header_top]',
				array(
					'default' => $spacing_defaults['header_top'],
					'type' => 'option',
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
				)
			);
		}

		if ( ! $wp_customize->get_setting( 'generate_spacing_settings[header_bottom]' ) ) {
			$spacing_defaults = generate_spacing_get_defaults();

			$wp_customize->add_setting(
				'generate_spacing_settings[header_bottom]',
				array(
					'default' => $spacing_defaults['header_bottom'],
					'type' => 'option',
					'sanitize_callback' => 'absint',
					'transport' => 'postMessage',
				)
			);
		}

		$wp_customize->add_setting(
			'generate_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'refresh',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[nav_drop_point]',
			array(
				'default' => $defaults['nav_drop_point'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_empty_absint',
			)
		);

		$wp_customize->add_control(
			new Generate_Range_Slider_Control(
				$wp_customize,
				'generate_settings[nav_drop_point]',
				array(
					'label' => __( 'Navigation Drop Point', 'generatepress' ),
					'sub_description' => __( 'The width when the navigation ceases to float and drops below your logo.', 'generatepress' ),
					'section' => 'generate_layout_navigation',
					'settings' => array(
						'desktop' => 'generate_settings[nav_drop_point]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 500,
							'max' => 2000,
							'step' => 10,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'priority' => 22,
				)
			)
		);

		$wp_customize->add_setting(
			'generate_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[nav_dropdown_direction]',
			array(
				'default' => $defaults['nav_dropdown_direction'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'generate_settings[nav_dropdown_direction]',
			array(
				'type' => 'select',
				'label' => __( 'Dropdown Direction', 'generatepress' ),
				'section' => 'generate_layout_navigation',
				'choices' => array(
					'right' => __( 'Right', 'generatepress' ),
					'left' => __( 'Left', 'generatepress' ),
				),
				'settings' => 'generate_settings[nav_dropdown_direction]',
				'priority' => 22,
			)
		);

		$wp_customize->add_setting(
			'generate_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[container_alignment]',
			array(
				'default' => $defaults['container_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'generate_settings[container_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Container Alignment', 'generatepress' ),
				'section' => 'generate_layout_container',
				'choices' => array(
					'boxes' => __( 'Boxes', 'generatepress' ),
					'text' => __( 'Text', 'generatepress' ),
				),
				'settings' => 'generate_settings[container_alignment]',
				'priority' => 30,
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

		$wp_customize->add_setting(
			'generate_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_setting(
			'generate_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'generate_settings[footer_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Bar Alignment', 'generatepress' ),
				'section' => 'generate_layout_footer',
				'choices' => array(
					'left' => __( 'Left', 'generatepress' ),
					'center' => __( 'Center', 'generatepress' ),
					'right' => __( 'Right', 'generatepress' ),
				),
				'settings' => 'generate_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'generate_is_footer_bar_active',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

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

		$wp_customize->add_section(
			'generate_blog_section',
			array(
				'title' => __( 'Blog', 'generatepress' ),
				'priority' => 55,
				'panel' => 'generate_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_blog_excerpt',
			)
		);

		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'generatepress' ),
				'section' => 'generate_blog_section',
				'choices' => array(
					'full' => __( 'Full Content', 'generatepress' ),
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
						'url' => generate_get_premium_url( 'https://generatepress.com/premium/#blog', false ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
					)
				)
			);
		}

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

		$show_flexbox_option = true;

		if ( defined( 'GP_PREMIUM_VERSION' ) && version_compare( GP_PREMIUM_VERSION, '1.11.0-alpha.1', '<' ) ) {
			$show_flexbox_option = false;
		}

		if ( generate_is_using_flexbox() ) {
			$show_flexbox_option = true;
		}

		$show_flexbox_option = apply_filters( 'generate_show_flexbox_customizer_option', $show_flexbox_option );

		if ( $show_flexbox_option ) {
			$wp_customize->add_setting(
				'generate_settings[structure]',
				array(
					'default' => $defaults['structure'],
					'type' => 'option',
					'sanitize_callback' => 'generate_sanitize_choices',
				)
			);

			$wp_customize->add_control(
				'generate_settings[structure]',
				array(
					'type' => 'select',
					'label' => __( 'Structure', 'generatepress' ),
					'section' => 'generate_general_section',
					'choices' => array(
						'flexbox' => __( 'Flexbox', 'generatepress' ),
						'floats' => __( 'Floats', 'generatepress' ),
					),
					'description' => sprintf(
						'<strong>%1$s</strong> %2$s',
						__( 'Caution:', 'generatepress' ),
						sprintf(
							/* translators: Learn more here */
							__( 'Switching your structure can change how your website displays. Review your website thoroughly before publishing this change, or use a staging site to review the potential changes. Learn more %s.', 'generatepress' ),
							'<a href="https://docs.generatepress.com/article/switching-from-floats-to-flexbox/" target="_blank" rel="noopener noreferrer">' . __( 'here', 'generatepress' ) . '</a>'
						)
					),
					'settings' => 'generate_settings[structure]',
				)
			);
		}

		$wp_customize->add_setting(
			'generate_settings[icons]',
			array(
				'default' => $defaults['icons'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'generate_settings[icons]',
			array(
				'type' => 'select',
				'label' => __( 'Icon Type', 'generatepress' ),
				'section' => 'generate_general_section',
				'choices' => array(
					'svg' => __( 'SVG', 'generatepress' ),
					'font' => __( 'Font', 'generatepress' ),
				),
				'settings' => 'generate_settings[icons]',
			)
		);

		$wp_customize->add_setting(
			'generate_settings[combine_css]',
			array(
				'default' => $defaults['combine_css'],
				'type' => 'option',
				'sanitize_callback' => 'generate_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'generate_settings[combine_css]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Combine CSS', 'generatepress' ),
				'description' => __( 'Reduce the number of CSS file requests and use a lite version of our grid system.', 'generatepress' ),
				'section' => 'generate_general_section',
				'active_callback' => 'generate_is_using_floats_callback',
			)
		);

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
