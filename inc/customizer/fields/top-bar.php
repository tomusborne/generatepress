<?php
/**
 * This file handles the customizer fields for the top bar.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

$wp_customize->add_section(
	'generate_styling_panel_top_bar',
	array(
		'title' => __( 'Top Bar', 'gp-premium' ),
		'priority' => 20,
		'panel' => 'generate_styling_panel',
	)
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_background_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default'     => $color_defaults['top_bar_background_color'],
		'transport'   => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label'           => __( 'Background', 'gp-premium' ),
		'section'         => 'generate_styling_panel_top_bar',
		'settings'        => 'generate_settings[top_bar_background_color]',
		'active_callback' => 'generate_is_top_bar_active',
		'alpha'           => true,
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_text_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default'     => $color_defaults['top_bar_text_color'],
		'transport'   => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label'           => __( 'Text', 'gp-premium' ),
		'section'         => 'generate_styling_panel_top_bar',
		'active_callback' => 'generate_is_top_bar_active',
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_link_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default'     => $color_defaults['top_bar_link_color'],
		'transport'   => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label'           => __( 'Link', 'gp-premium' ),
		'section'         => 'generate_styling_panel_top_bar',
		'active_callback' => 'generate_is_top_bar_active',
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[top_bar_link_color_hover]',
	'GeneratePress_Customize_Color_Control',
	[
		'default'     => $color_defaults['top_bar_link_color_hover'],
		'transport'   => 'postMessage',
		'sanitize_callback' => 'generate_premium_sanitize_rgba',
	],
	[
		'label'           => __( 'Link', 'gp-premium' ),
		'section'         => 'generate_styling_panel_top_bar',
		'active_callback' => 'generate_is_top_bar_active',
	]
);
