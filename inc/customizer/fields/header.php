<?php
/**
 * This file handles the customizer fields for the header.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_header_colors_title',
	[
		'section' => 'generate_colors_section',
		'title' => __( 'Header', 'generatepress' ),
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_background_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['header_background_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label' => __( 'Background', 'gp-premium' ),
		'section' => 'generate_styling_panel_header',
		'alpha' => true,
		'output' => [
			[
				'element'  => '.site-header',
				'property' => 'background-color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_text_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['header_text_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label' => __( 'Text', 'gp-premium' ),
		'section' => 'generate_styling_panel_header',
		'output' => [
			[
				'element'  => '.site-header',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_header_link_wrapper',
	[
		'section' => 'generate_colors_section',
		'wrapper_type' => 'color',
		'wrapper_items' => [
			'header_link_color',
			'header_link_hover_color',
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_header_link_wrapper',
	[
		'section' => 'generate_colors_section',
		'wrapper_type' => 'color',
		'wrapper_items' => [
			'header_link_color',
			'header_link_hover_color',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_link_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['header_link_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label' => __( 'Link', 'gp-premium' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'header_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		],
		'output' => [
			[
				'element'  => '.site-header a:not([rel="home"])',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_link_hover_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['header_link_hover_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'header_link_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
		],
		'output' => [
			[
				'element'  => '.site-header a:not([rel="home"]):hover',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[site_title_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['site_title_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label' => __( 'Site Title', 'gp-premium' ),
		'section' => 'generate_colors_section',
		'output' => [
			[
				'element'  => '.main-title a, .main-title a:hover',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[site_tagline_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['site_tagline_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label' => __( 'Tagline', 'gp-premium' ),
		'section' => 'generate_colors_section',
		'output' => [
			[
				'element'  => '.site-description',
				'property' => 'color',
			],
		],
	]
);
