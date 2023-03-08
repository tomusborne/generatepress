<?php
/**
 * This file handles the customizer fields for the Search Modal.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_search_modal_colors_title',
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Search Modal', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'search-modal-colors',
		),
		'active_callback' => function() {
			if ( generate_get_option( 'nav_search_modal' ) ) {
				return true;
			}

			return false;
		},
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[search_modal_bg_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['search_modal_bg_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Field Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'search-modal-colors',
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-search-modal-bg-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[search_modal_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['search_modal_text_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Field Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'search-modal-colors',
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-search-modal-text-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[search_modal_overlay_bg_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['search_modal_overlay_bg_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Overlay Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'search-modal-colors',
		),
		'output' => array(
			array(
				'element'  => ':root',
				'property' => '--gp-search-modal-overlay-bg-color',
			),
		),
	)
);
