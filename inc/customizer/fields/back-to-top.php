<?php
/**
 * This file handles the customizer fields for the back to top button.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_back_to_top_colors_title',
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Back to Top', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'back-to-top-colors',
		),
		'active_callback' => function() {
			if ( generate_get_option( 'back_to_top' ) ) {
				return true;
			}

			return false;
		},
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_back_to_top_background_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'back-to-top-colors',
			'items' => array(
				'back_to_top_background_color',
				'back_to_top_background_color_hover',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[back_to_top_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['back_to_top_background_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'back-to-top-colors',
			'wrapper' => 'back_to_top_background_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => 'a.generate-back-to-top',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[back_to_top_background_color_hover]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['back_to_top_background_color_hover'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'back-to-top-colors',
			'wrapper' => 'back_to_top_background_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => 'a.generate-back-to-top:hover, a.generate-back-to-top:focus',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_back_to_top_text_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'back-to-top-colors',
			'items' => array(
				'back_to_top_text_color',
				'back_to_top_text_color_hover',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[back_to_top_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['back_to_top_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'button-colors',
			'wrapper' => 'back_to_top_text_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => 'a.generate-back-to-top',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[back_to_top_text_color_hover]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['back_to_top_text_color_hover'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'back-to-top-colors',
			'wrapper' => 'back_to_top_text_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => 'a.generate-back-to-top:hover, a.generate-back-to-top:focus',
				'property' => 'color',
			),
		),
	)
);
