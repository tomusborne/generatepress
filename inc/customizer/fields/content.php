<?php
/**
 * This file handles the customizer fields for the content.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access, please.
}

GeneratePress_Customize_Field::add_title(
	'generate_content_colors_title',
	[
		'section' => 'generate_colors_section',
		'title' => __( 'Content', 'generatepress' ),
		'choices' => [
			'toggleId' => 'content-colors',
		],
	]
);

$content_colors = '.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .one-container .container, .separate-containers .paging-navigation, .inside-page-header';

GeneratePress_Customize_Field::add_field(
	'generate_settings[content_background_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['content_background_color'],
		'sanitize_callback' => 'generate_sanitize_rgba_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Background', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => $content_colors,
				'property' => 'background-color',
			],
		],
		'alpha' => true,
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[content_text_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['content_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => $content_colors,
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_content_link_wrapper',
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'type' => 'color',
			'toggleId' => 'content-colors',
			'items' => [
				'content_link_color',
				'content_link_hover_color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[content_link_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['content_link_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Link', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'content_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.inside-article a:not(.button):not(.wp-block-button__link), .inside-article a:not(.button):not(.wp-block-button__link):visited, .paging-navigation a, .paging-navigation a:visited, .comments-area a, .comments-area a:visited, .page-header a, .page-header a:visited',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[content_link_hover_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['content_link_hover_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'content_link_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.inside-article a:not(.button):not(.wp-block-button__link):hover, .paging-navigation a:hover, .comments-area a:hover, .page-header a:hover',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[content_title_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['content_title_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Content Title', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.entry-header h1,.page-header h1',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_archive_content_title_link_wrapper',
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'type' => 'color',
			'toggleId' => 'content-colors',
			'items' => [
				'blog_post_title_color',
				'blog_post_title_hover_color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[blog_post_title_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['blog_post_title_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Archive Content Title', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'blog_post_title_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.entry-title a,.entry-title a:visited',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[blog_post_title_hover_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['blog_post_title_hover_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'blog_post_title_hover_color',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.entry-title a:hover',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[entry_meta_text_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['entry_meta_text_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Entry Meta Text', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.entry-meta',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_wrapper(
	'generate_entry_meta_link_wrapper',
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'type' => 'color',
			'toggleId' => 'content-colors',
			'items' => [
				'entry_meta_link_color',
				'entry_meta_link_color_hover',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[entry_meta_link_color]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['entry_meta_link_color'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'label' => __( 'Entry Meta Links', 'generatepress' ),
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'entry_meta_link_color',
			'tooltip' => __( 'Choose Initial Color', 'generatepress' ),
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.entry-meta a',
				'property' => 'color',
			],
		],
	]
);

GeneratePress_Customize_Field::add_field(
	'generate_settings[entry_meta_link_color_hover]',
	'GeneratePress_Customize_Color_Control',
	[
		'default' => $color_defaults['entry_meta_link_color_hover'],
		'sanitize_callback' => 'generate_sanitize_hex_color',
		'transport' => 'postMessage',
	],
	[
		'section' => 'generate_colors_section',
		'choices' => [
			'wrapper' => 'entry_meta_link_color_hover',
			'tooltip' => __( 'Choose Hover Color', 'generatepress' ),
			'toggleId' => 'content-colors',
		],
		'output' => [
			[
				'element'  => '.entry-meta a:hover',
				'property' => 'color',
			],
		],
	]
);

$headings = [
	[
		'slug' => 'h1_color',
		'label' => __( 'Heading 1 (H1) Color', 'generatepress' ),
		'selector' => 'h1',
	],
	[
		'slug' => 'h2_color',
		'label' => __( 'Heading 2 (H2) Color', 'generatepress' ),
		'selector' => 'h2',
	],
	[
		'slug' => 'h3_color',
		'label' => __( 'Heading 3 (H3) Color', 'generatepress' ),
		'selector' => 'h3',
	],
	[
		'slug' => 'h4_color',
		'label' => __( 'Heading 4 (H4) Color', 'generatepress' ),
		'selector' => 'h4',
	],
	[
		'slug' => 'h5_color',
		'label' => __( 'Heading 5 (H5) Color', 'generatepress' ),
		'selector' => 'h5',
	],
	[
		'slug' => 'h6_color',
		'label' => __( 'Heading 6 (H6) Color', 'generatepress' ),
		'selector' => 'h6',
	],
];

foreach ( $headings as $heading ) {
	GeneratePress_Customize_Field::add_field(
		'generate_settings[' . $heading['slug'] . ']',
		'GeneratePress_Customize_Color_Control',
		[
			'default' => $color_defaults[ $heading['slug'] ],
			'sanitize_callback' => 'generate_sanitize_hex_color',
			'transport' => 'postMessage',
		],
		[
			'label' => $heading['label'],
			'section' => 'generate_colors_section',
			'choices' => [
				'toggleId' => 'content-colors',
			],
			'output' => [
				[
					'element'  => $heading['selector'],
					'property' => 'color',
				],
			],
		]
	);
}
