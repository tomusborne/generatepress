<?php
/**
 * This file handles the customizer fields for the header.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

$wp_customize->add_section(
	'generate_styling_panel_header',
	array(
		'title' => __( 'Header', 'gp-premium' ),
		'priority' => 30,
		'panel' => 'generate_styling_panel',
	)
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

$wp_customize->add_control(
	new GeneratePress_Customize_Wrapper_Control(
		$wp_customize,
		'generate_header_link_wrapper',
		array(
			'section'  => 'generate_styling_panel_header',
			'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			'wrapper_id' => 'generate-header-link-wrapper',
			'wrapper_class' => 'generate-customize-color-control-wrapper',
			'wrappers' => array(
				'header_link_color',
				'header_link_hover_color',
			),
		)
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_header_link_wrapper',
	[
		'section' => 'generate_styling_panel_header',
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
		'section' => 'generate_styling_panel_header',
		'choices' => [
			'wrapper' => 'header_link_color',
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
		'section' => 'generate_styling_panel_header',
		'choices' => [
			'wrapper' => 'header_link_hover_color',
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
		'section' => 'generate_styling_panel_header',
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
		'section' => 'generate_styling_panel_header',
		'output' => [
			[
				'element'  => '.site-description',
				'property' => 'color',
			],
		],
	]
);
