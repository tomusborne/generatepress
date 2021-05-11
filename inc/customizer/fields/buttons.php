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
	'generate_buttons_colors_title',
	[
		'section' => 'generate_colors_section',
		'title' => __( 'Buttons', 'generatepress' ),
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_buttons_background_wrapper',
	[
		'section' => 'generate_colors_section',
		'wrapper_type' => 'color',
		'wrapper_items' => [
			'form_button_background_color',
			'form_button_background_color_hover',
		],
	]
);

$buttons_selector = 'button, html input[type="button"], input[type="reset"], input[type="submit"], a.button, a.button:visited, a.wp-block-button__link:not(.has-background)';
$buttons_hover_selector = 'button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, a.button:hover, button:focus, html input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, a.button:focus, a.wp-block-button__link:not(.has-background):active, a.wp-block-button__link:not(.has-background):focus, a.wp-block-button__link:not(.has-background):hover';

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_background_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['form_button_background_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'form_button_background_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		],
		'output' => [
			[
				'element'  => $buttons_selector,
				'property' => 'background-color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_background_color_hover]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['form_button_background_color_hover'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'form_button_background_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
		],
		'output' => [
			[
				'element'  => $buttons_hover_selector,
				'property' => 'background-color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_buttons_text_wrapper',
	[
		'section' => 'generate_colors_section',
		'wrapper_type' => 'color',
		'wrapper_items' => [
			'form_button_text_color',
			'form_button_text_color_hover',
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_text_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['form_button_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Text Color', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'form_button_text_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		],
		'output' => [
			[
				'element'  => $buttons_selector,
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_text_color_hover]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['form_button_text_color_hover'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'form_button_text_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
		],
		'output' => [
			[
				'element'  => $buttons_hover_selector,
				'property' => 'color',
			],
		],
	]
);
