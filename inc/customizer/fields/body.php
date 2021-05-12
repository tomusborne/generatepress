<?php
/**
 * This file handles the customizer fields for the Body.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_body_colors_title',
	[
		'section' => 'generate_colors_section',
		'title' => __( 'Base', 'generatepress' ),
		'choices' => [
			'toggleId' => 'base-colors',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[background_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $defaults['background_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'toggleId' => 'base-colors',
		],
		'output' => [
			[
				'element'  => 'body',
				'property' => 'background-color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[text_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $defaults['text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'toggleId' => 'base-colors',
		],
		'output' => [
			[
				'element'  => 'body',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_body_link_wrapper',
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'type' => 'color',
			'toggleId' => 'base-colors',
			'items' => [
				'link_color',
				'link_color_hover',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[link_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $defaults['link_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
			'toggleId' => 'base-colors',
		],
		'output' => [
			[
				'element'  => 'a, a:visited',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[link_color_hover]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $defaults['link_color_hover'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'link_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'toggleId' => 'base-colors',
		],
		'output' => [
			[
				'element'  => 'a:hover',
				'property' => 'color',
			],
		],
	]
);

if ( '' !== generate_get_option( 'link_color_visited' ) ) {
	GeneratePress_Customize_Field::add_field(
		'generate_settings[link_color_hover]',
		'GeneratePress_Customize_Color_Control',
		[
			'default' => $defaults['link_color_visited'],
			'sanitize_callback' => 'generate_sanitize_hex_color',
			'transport' => 'refresh',
		],
		[
			'label' => __( 'Link Color Visited', 'generatepress' ),
			'section' => 'generate_colors_section',
			'choices' => [
				'toggleId' => 'base-colors',
			],
		]
	);
}
