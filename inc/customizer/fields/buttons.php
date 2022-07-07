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
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Buttons', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'button-colors',
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_buttons_background_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'button-colors',
			'items' => array(
				'form_button_background_color',
				'form_button_background_color_hover',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['form_button_background_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'button-colors',
			'wrapper' => 'form_button_background_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-button-background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_background_color_hover]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['form_button_background_color_hover'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'button-colors',
			'wrapper' => 'form_button_background_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-button-background-color-hover',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_buttons_text_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'button-colors',
			'items' => array(
				'form_button_text_color',
				'form_button_text_color_hover',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['form_button_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'button-colors',
			'wrapper' => 'form_button_text_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-button-text-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[form_button_text_color_hover]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['form_button_text_color_hover'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'button-colors',
			'wrapper' => 'form_button_text_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-button-text-color-hover',
			),
		),
	)
);
