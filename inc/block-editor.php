<?php
/**
 * Integrate GeneratePress with the WordPress block editor.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Sidebar layout metabox options are only returned on single posts.
 *
 * @since 2.2
 */
function generate_get_block_editor_sidebar_layout() {
	$screen = get_current_screen();

	if ( ! is_object( $screen ) ) {
		return 'right-sidebar';
	}

	$layout = generate_get_option( 'layout_setting' );

	if ( 'post' === $screen->post_type ) {
		$layout = generate_get_option( 'single_layout_setting' );
	}

	$layout_meta = get_post_meta( get_the_ID(), '_generate-sidebar-layout-meta', true );

	if ( $layout_meta ) {
		$layout = $layout_meta;
	}

	return apply_filters( 'generate_block_editor_sidebar_layout', $layout );
}

function generate_get_block_editor_content_width() {
	$container_width = generate_get_option( 'container_width' );

	$content_width = $container_width;

	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );

	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );

	$layout = generate_get_block_editor_sidebar_layout();

	if ( 'left-sidebar' == $layout ) {
		$content_width = $container_width * ( ( 100 - $left_sidebar_width ) / 100 );
	} elseif ( 'right-sidebar' == $layout ) {
		$content_width = $container_width * ( ( 100 - $right_sidebar_width ) / 100 );
	} elseif ( 'no-sidebar' == $layout ) {
		$content_width = $container_width;
	} else {
		$content_width = $container_width * ( ( 100 - ( $left_sidebar_width + $right_sidebar_width ) ) / 100 );
	}

	if ( 'no-sidebar' === generate_get_block_editor_sidebar_layout() && generate_get_option( 'content_width' ) ) {
		$content_width = generate_get_option( 'content_width' );
	}

	return $content_width;
}

add_action( 'enqueue_block_editor_assets', 'generate_enqueue_google_fonts' );
add_action( 'enqueue_block_editor_assets', 'generate_enqueue_backend_block_editor_assets' );
/**
 * Add CSS to the admin side of the block editor.
 *
 * @since 2.2
 */
function generate_enqueue_backend_block_editor_assets() {
	wp_enqueue_style( 'generate-block-editor-styles', get_template_directory_uri() . "/css/admin/block-editor.css", false, GENERATE_VERSION, 'all' );
	wp_add_inline_style( 'generate-block-editor-styles', generate_do_inline_block_editor_css() );

	wp_enqueue_script( 'generate-block-editor-scripts', get_template_directory_uri() . "/js/admin/block-editor.js", array( 'jquery' ), GENERATE_VERSION, true );

	wp_localize_script( 'generate-block-editor-scripts', 'generate_block_editor', array(
		'content_width' => generate_get_option( 'content_width' ),
		'saved_content_width' => generate_get_block_editor_content_width(),
		'container_width' => generate_get_option( 'container_width' ),
		'right_sidebar_width' => apply_filters( 'generate_right_sidebar_width', '25' ),
		'left_sidebar_width' => apply_filters( 'generate_left_sidebar_width', '25' ),
		'content_title' => generate_show_title() ? 'true' : 'false',
	) );
}

function generate_do_inline_block_editor_css() {
	$color_settings = wp_parse_args(
		get_option( 'generate_settings', array() ),
		generate_get_color_defaults()
	);

	$font_settings = wp_parse_args(
		get_option( 'generate_settings', array() ),
		generate_get_default_fonts()
	);

	$css = new GeneratePress_CSS;

	$content_width = generate_get_block_editor_content_width();

	$css->set_selector( 'html body.gutenberg-editor-page .editor-post-title__block, html body.gutenberg-editor-page .editor-default-block-appender, html body.gutenberg-editor-page .editor-block-list__block' );

	if ( 'true' === get_post_meta( get_the_ID(), '_generate-full-width-content', true ) ) {
		$css->add_property( 'max-width', '100%' );
	} else {
		$css->add_property( 'max-width', absint( $content_width ), false, 'px' );
	}

	$css->set_selector( '.edit-post-visual-editor .editor-block-list__block[data-align=wide]' );
	$css->add_property( 'max-width', absint( $content_width + 40 ), false, 'px' );

	$css->set_selector( '.wp-block-button__link:not(.has-background)' );
	$css->add_property( 'color', esc_attr( $color_settings['form_button_text_color'] ) );
	$css->add_property( 'background-color', esc_attr( $color_settings['form_button_background_color'] ) );

	$css->set_selector( '.wp-block-button__link:not(.has-background):active, .wp-block-button__link:not(.has-background):focus, .wp-block-button__link:not(.has-background):hover' );
	$css->add_property( 'color', esc_attr( $color_settings['form_button_text_color_hover'] ) );
	$css->add_property( 'background-color', esc_attr( $color_settings['form_button_background_color_hover'] ) );

	$body_family = generate_get_font_family_css( 'font_body', 'generate_settings', generate_get_default_fonts() );
	$h1_family = generate_get_font_family_css( 'font_heading_1', 'generate_settings', generate_get_default_fonts() );
	$h2_family = generate_get_font_family_css( 'font_heading_2', 'generate_settings', generate_get_default_fonts() );
	$h3_family = generate_get_font_family_css( 'font_heading_3', 'generate_settings', generate_get_default_fonts() );
	$h4_family = generate_get_font_family_css( 'font_heading_4', 'generate_settings', generate_get_default_fonts() );
	$h5_family = generate_get_font_family_css( 'font_heading_5', 'generate_settings', generate_get_default_fonts() );
	$h6_family = generate_get_font_family_css( 'font_heading_6', 'generate_settings', generate_get_default_fonts() );

	$css->set_selector( 'body.gutenberg-editor-page .editor-block-list__block' );
	$css->add_property( 'font-family', $body_family );

	$css->set_selector( '.wp-block-heading h1, .wp-block-heading h1.editor-rich-text__tinymce, .editor-post-title__block .editor-post-title__input' );
	$css->add_property( 'font-family', 'inherit' === $h1_family ? $body_family : $h1_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_1_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_1_transform'] ) );
	$css->add_property( 'font-size', absint( $font_settings['heading_1_font_size'] ), false, 'px' );

	$css->set_selector( '.wp-block-heading h2, .wp-block-heading h2.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h2_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_2_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_2_transform'] ) );
	$css->add_property( 'font-size', absint( $font_settings['heading_2_font_size'] ), false, 'px' );

	$css->set_selector( '.wp-block-heading h3, .wp-block-heading h3.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h3_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_3_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_3_transform'] ) );
	$css->add_property( 'font-size', absint( $font_settings['heading_3_font_size'] ), false, 'px' );

	$css->set_selector( '.wp-block-heading h4, .wp-block-heading h4.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h4_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_4_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_4_transform'] ) );

	if ( '' !== $font_settings['heading_4_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['heading_4_font_size'] ), false, 'px' );
	}

	$css->set_selector( '.wp-block-heading h5, .wp-block-heading h5.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h5_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_5_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_5_transform'] ) );

	if ( '' !== $font_settings['heading_5_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['heading_5_font_size'] ), $og_defaults['heading_5_font_size'], 'px' );
	}

	$css->set_selector( '.wp-block-heading h6, .wp-block-heading h6.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h6_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_6_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_6_transform'] ) );

	if ( '' !== $font_settings['heading_6_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['heading_6_font_size'] ), false, 'px' );
	}

	return $css->css_output();
}
