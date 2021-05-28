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
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Header', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'header-colors',
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['header_background_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'header-colors',
		),
		'output' => array(
			array(
				'element'  => '.site-header',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['header_text_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'header-colors',
		),
		'output' => array(
			array(
				'element'  => '.site-header',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_header_link_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'header-colors',
			'items' => array(
				'header_link_color',
				'header_link_hover_color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_link_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['header_link_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'header-colors',
			'wrapper' => 'header_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.site-header a:not([rel="home"])',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[header_link_hover_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['header_link_hover_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Link Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'header-colors',
			'wrapper' => 'header_link_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => '.site-header a:not([rel="home"]):hover',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[site_title_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['site_title_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Site Title', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'header-colors',
		),
		'output' => array(
			array(
				'element'  => '.main-title a, .main-title a:hover',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[site_tagline_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['site_tagline_color'],
		'transport' => 'postMessage',
		'sanitize_callback' => 'generate_sanitize_rgba_color',
	),
	array(
		'label' => __( 'Tagline', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'header-colors',
		),
		'output' => array(
			array(
				'element'  => '.site-description',
				'property' => 'color',
			),
		),
	)
);
