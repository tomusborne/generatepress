<?php
/**
 * This file handles the customizer fields for the footer bar.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_footer_bar_colors_title',
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Footer Bar', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'footer-bar-colors',
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_background_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'footer-bar-colors',
			'wrapper' => 'footer_background_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.site-info',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-bar-colors',
			'wrapper' => 'footer_text_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.site-info',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_footer_bar_colors_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'footer-bar-colors',
			'items' => array(
				'footer_link_color',
				'footer_link_hover_color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_link_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_link_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-bar-colors',
			'wrapper' => 'footer_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.site-info a',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_link_hover_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_link_hover_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Link Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-bar-colors',
			'wrapper' => 'footer_link_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => '.site-info a:hover',
				'property' => 'color',
			),
		),
	)
);
