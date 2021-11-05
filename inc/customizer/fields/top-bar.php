<?php
/**
 * This file handles the customizer fields for the top bar.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_top_bar_colors_title',
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Top Bar', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'top-bar-colors',
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['top_bar_background_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'settings' => 'generate_settings[top_bar_background_color]',
		'active_callback' => 'generate_is_top_bar_active',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'top-bar-colors',
		),
		'output' => array(
			array(
				'element'  => '.top-bar',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['top_bar_text_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'active_callback' => 'generate_is_top_bar_active',
		'choices' => array(
			'toggleId' => 'top-bar-colors',
		),
		'output' => array(
			array(
				'element'  => '.top-bar',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_top_bar_link_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'top-bar-colors',
			'items' => array(
				'top_bar_link_color',
				'top_bar_link_color_hover',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_link_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['top_bar_link_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'active_callback' => 'generate_is_top_bar_active',
		'choices' => array(
			'wrapper' => 'top_bar_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
			'toggleId' => 'top-bar-colors',
		),
		'output' => array(
			array(
				'element'  => '.top-bar a',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_link_color_hover]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['top_bar_link_color_hover'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Link Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'active_callback' => 'generate_is_top_bar_active',
		'choices' => array(
			'wrapper' => 'top_bar_link_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'toggleId' => 'top-bar-colors',
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => '.top-bar a:hover',
				'property' => 'color',
			),
		),
	)
);
