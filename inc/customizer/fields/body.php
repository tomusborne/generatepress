<?php
/**
 * This file handles the customizer fields for the Body.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

$wp_customize->add_section(
	'generate_styling_panel_body',
	array(
		'title' => esc_attr__( 'Body', 'generatepress' ),
		'priority' => 10,
		'panel' => 'generate_styling_panel',
	)
);

GeneratePress_Customize_Field::add_title(
	'generate_body_typography_title',
	[
		'section' => 'generate_styling_panel_body',
		'title' => __( 'Typography', 'generatepress' ),
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_family]',
	'GeneratePress_Customize_Font_Family_Control',
	[
		'default' => $typography_defaults['body_font_family'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Font Family', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_body_google_font_wrapper',
	[
		'section' => 'generate_styling_panel_body',
		'wrapper_type' => 'google-font',
		'wrapper_items' => [
			'body_font_google',
			'body_font_category',
			'body_font_variants',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_google]',
	'GeneratePress_Customize_Toggle_Control',
	[
		'default' => $typography_defaults['body_font_google'],
		'sanitize_callback' => 'rest_sanitize_boolean',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Google Font', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'body_font_google',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_category]',
	'GeneratePress_Customize_Text_Control',
	[
		'default' => $typography_defaults['body_font_category'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Category', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'body_font_category',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_variants]',
	'GeneratePress_Customize_Text_Control',
	[
		'default' => $typography_defaults['body_font_variants'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Variants', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'body_font_variants',
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_body_font_weight_wrapper',
	[
		'section' => 'generate_styling_panel_body',
		'wrapper_type' => 'two-col',
		'wrapper_items' => [
			'body_font_weight',
			'body_font_transform',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_weight]',
	'GeneratePress_Customize_Select_Control',
	[
		'default' => $typography_defaults['body_font_weight'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Weight', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'body_font_weight',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_transform]',
	'GeneratePress_Customize_Select_Control',
	[
		'default' => $typography_defaults['body_font_transform'],
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Transform', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'body_font_transform',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_font_size]',
	'GeneratePress_Customize_Range_Control',
	[
		'default' => $typography_defaults['body_font_size'],
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Font Size', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'rangeMin' => 6,
			'rangeMax' => 25,
			'step' => 1,
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[body_line_height]',
	'GeneratePress_Customize_Range_Control',
	[
		'default' => $typography_defaults['body_line_height'],
		'sanitize_callback' => 'generate_premium_sanitize_decimal_integer',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Line Height', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'rangeMin' => 1,
			'rangeMax' => 5,
			'step' => .1,
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[paragraph_margin]',
	'GeneratePress_Customize_Range_Control',
	[
		'default' => $typography_defaults['paragraph_margin'],
		'sanitize_callback' => 'generate_premium_sanitize_decimal_integer',
		'transport' => 'refresh',
	],
	[
		'label' => __( 'Paragraph Margin', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'rangeMin' => 0,
			'rangeMax' => 5,
			'step' => .1,
		],
	]
);

GeneratePress_Customize_Field::add_title(
	'generate_body_colors_title',
	[
		'section' => 'generate_styling_panel_body',
		'title' => __( 'Colors', 'generatepress' ),
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
		'label' => __( 'Background Color', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
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
		'label' => __( 'Text Color', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
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
		'section' => 'generate_styling_panel_body',
		'wrapper_type' => 'color',
		'wrapper_items' => [
			'link_color',
			'link_color_hover',
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
		'label' => __( 'Link Color', 'generatepress' ),
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'link_color',
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
		'section' => 'generate_styling_panel_body',
		'choices' => [
			'wrapper' => 'link_color_hover',
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
			'section' => 'generate_styling_panel_body',
		]
	);
}
