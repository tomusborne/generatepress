<?php
/**
 * This file handles the customizer fields for the footer widgets.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_footer_widgets_colors_title',
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Footer Widgets', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'footer-widget-colors',
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_widget_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_widget_background_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'footer-widget-colors',
			'wrapper' => 'footer_widget_background_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.footer-widgets',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_widget_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_widget_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-widget-colors',
			'wrapper' => 'footer_widget_text_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.footer-widgets',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_footer_widget_colors_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'footer-widget-colors',
			'items' => array(
				'footer_widget_link_color',
				'footer_widget_link_hover_color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_widget_link_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_widget_link_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-widget-colors',
			'wrapper' => 'footer_widget_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.footer-widgets a',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_widget_link_hover_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_widget_link_hover_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Link Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-widget-colors',
			'wrapper' => 'footer_widget_link_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => '.footer-widgets a:hover',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[footer_widget_title_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['footer_widget_title_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Widget Title', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'footer-widget-colors',
		),
		'output' => array(
			array(
				'element'  => '.footer-widgets .widget-title',
				'property' => 'color',
			),
		),
	)
);
