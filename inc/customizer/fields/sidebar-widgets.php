<?php
/**
 * This file handles the customizer fields for the sidebar widgets.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_sidebar_widgets_colors_title',
	array(
		'section' => 'generate_colors_section',
		'title' => __( 'Sidebar Widgets', 'generatepress' ),
		'choices' => array(
			'toggleId' => 'sidebar-widget-colors',
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[sidebar_widget_background_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['sidebar_widget_background_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'alpha' => true,
			'toggleId' => 'sidebar-widget-colors',
			'wrapper' => 'sidebar_widget_background_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.sidebar .widget',
				'property' => 'background-color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[sidebar_widget_text_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['sidebar_widget_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'sidebar-widget-colors',
			'wrapper' => 'sidebar_widget_text_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.sidebar .widget',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_sidebar_widget_colors_wrapper',
	array(
		'section' => 'generate_colors_section',
		'choices' => array(
			'type' => 'color',
			'toggleId' => 'sidebar-widget-colors',
			'items' => array(
				'sidebar_widget_link_color',
				'sidebar_widget_link_hover_color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[sidebar_widget_link_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['sidebar_widget_link_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'sidebar-widget-colors',
			'wrapper' => 'sidebar_widget_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
		),
		'output' => array(
			array(
				'element'  => '.sidebar .widget a',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[sidebar_widget_link_hover_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['sidebar_widget_link_hover_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Link Hover', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'sidebar-widget-colors',
			'wrapper' => 'sidebar_widget_link_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'hideLabel' => true,
		),
		'output' => array(
			array(
				'element'  => '.sidebar .widget a:hover',
				'property' => 'color',
			),
		),
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[sidebar_widget_title_color]',
	'GeneratePress_Customize_Color_Control',
	array(
		'default' => $color_defaults['sidebar_widget_title_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	),
	array(
		'label' => __( 'Widget Title', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => array(
			'toggleId' => 'sidebar-widget-colors',
		),
		'output' => array(
			array(
				'element'  => '.sidebar .widget .widget-title',
				'property' => 'color',
			),
		),
	)
);
