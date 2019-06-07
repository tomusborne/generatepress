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
 * Check what sidebar layout we're using.
 * We need this function as the post meta in generate_get_layout() only runs
 * on is_singular()
 *
 * @since 2.2
 *
 * @param bool $meta Check for post meta.
 * @return string The saved sidebar layout.
 */
function generate_get_block_editor_sidebar_layout( $meta = true ) {
	$layout = generate_get_option( 'layout_setting' );

	if ( function_exists( 'get_current_screen' ) ) {
		$screen = get_current_screen();

		if ( is_object( $screen ) && 'post' === $screen->post_type ) {
			$layout = generate_get_option( 'single_layout_setting' );
		}
	}

	// Add in our default filter in case people have adjusted it.
	$layout = apply_filters( 'generate_sidebar_layout', $layout );

	if ( $meta ) {
		$layout_meta = get_post_meta( get_the_ID(), '_generate-sidebar-layout-meta', true );

		if ( $layout_meta ) {
			$layout = $layout_meta;
		}
	}

	return apply_filters( 'generate_block_editor_sidebar_layout', $layout );
}

/**
 * Check whether we're disabling the content title or not.
 * We need this function as the post meta in generate_show_title() only runs
 * on is_singular()
 *
 * @since 2.2
 */
function generate_get_block_editor_show_content_title() {
	$title = generate_show_title();

	$disable_title = get_post_meta( get_the_ID(), '_generate-disable-headline', true );

	if ( $disable_title ) {
		$title = false;
	}

	return apply_filters( 'generate_block_editor_show_content_title', $title );
}

/**
 * Get the content width for this post.
 *
 * @since 2.2
 */
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

	return apply_filters( 'generate_block_editor_content_width', $content_width );
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
	wp_enqueue_script( 'generate-block-editor-tinycolor', get_template_directory_uri() . "/js/admin/tinycolor.js", false, GENERATE_VERSION, true );
	wp_enqueue_script( 'generate-block-editor-scripts', get_template_directory_uri() . "/js/admin/block-editor.js", array( 'jquery', 'generate-block-editor-tinycolor' ), GENERATE_VERSION, true );

	$show_editor_styles = apply_filters( 'generate_show_block_editor_styles', true );

	if ( $show_editor_styles ) {
		wp_add_inline_style( 'generate-block-editor-styles', generate_do_inline_block_editor_css() );
	}

	$color_settings = wp_parse_args(
		get_option( 'generate_settings', array() ),
		generate_get_color_defaults()
	);

	$spacing_settings = wp_parse_args(
		get_option( 'generate_spacing_settings', array() ),
		generate_spacing_get_defaults()
	);

	$text_color = generate_get_option( 'text_color' );

	if ( $color_settings['content_text_color'] ) {
		$text_color = $color_settings['content_text_color'];
	}

	wp_localize_script( 'generate-block-editor-scripts', 'generate_block_editor', array(
		'global_sidebar_layout' => generate_get_block_editor_sidebar_layout( false ),
		'container_width' => generate_get_option( 'container_width' ),
		'right_sidebar_width' => apply_filters( 'generate_right_sidebar_width', '25' ),
		'left_sidebar_width' => apply_filters( 'generate_left_sidebar_width', '25' ),
		'content_padding_right' => absint( $spacing_settings['content_right'] ) . 'px',
		'content_padding_left' => absint( $spacing_settings['content_left'] ) . 'px',
		'content_title' => generate_get_block_editor_show_content_title() ? 'true' : 'false',
		'disable_content_title' => esc_html( 'Disable Content Title', 'generatepress' ),
		'show_content_title' => esc_html( 'Show Content Title', 'generatepress' ),
		'text_color' => $text_color,
		'show_editor_styles' => $show_editor_styles,
	) );
}

/**
 * Write our CSS for the block editor.
 *
 * @since 2.2
 */
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

	$spacing_settings = wp_parse_args(
		get_option( 'generate_spacing_settings', array() ),
		generate_spacing_get_defaults()
	);

	$content_width_calc = sprintf(
		'calc(%1$s - %2$s - %3$s)',
		absint( $content_width ) . 'px',
		absint( $spacing_settings['content_left'] ) . 'px',
		absint( $spacing_settings['content_right'] ) . 'px'
	);

	$css->set_selector( 'body .wp-block, html body.gutenberg-editor-page .editor-post-title__block, html body.gutenberg-editor-page .editor-default-block-appender, html body.gutenberg-editor-page .editor-block-list__block' );

	if ( 'true' === get_post_meta( get_the_ID(), '_generate-full-width-content', true ) ) {
		$css->add_property( 'max-width', '100%' );
	} else {
		$css->add_property( 'max-width', $content_width_calc );
	}

	$css->set_selector( 'html body.gutenberg-editor-page .editor-block-list__block[data-align="full"]' );
	$css->add_property( 'max-width', 'none' );

	$css->set_selector( '.edit-post-visual-editor .editor-block-list__block[data-align=wide]' );
	$css->add_property( 'max-width', absint( $content_width ), false, 'px' );

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
	$buttons_family = generate_get_font_family_css( 'font_buttons', 'generate_settings', generate_get_default_fonts() );

	$css->set_selector( 'body.gutenberg-editor-page .editor-block-list__block, body .editor-styles-wrapper' );
	$css->add_property( 'font-family', $body_family );
	$css->add_property( 'font-size', absint( $font_settings['body_font_size'] ), false, 'px' );

	if ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( '.content-title-visibility' );

	if ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( 'body .editor-styles-wrapper, body .editor-styles-wrapper p, body .editor-styles-wrapper .mce-content-body' );
	$css->add_property( 'line-height', floatval( $font_settings['body_line_height'] ) );

	$css->set_selector( '.editor-styles-wrapper h1, .wp-block-heading h1.editor-rich-text__tinymce, .editor-post-title__block .editor-post-title__input' );
	$css->add_property( 'font-family', 'inherit' === $h1_family || '' === $h1_family ? $body_family : $h1_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_1_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_1_transform'] ) );
	$css->add_property( 'font-size', absint( $font_settings['heading_1_font_size'] ), false, 'px' );

	if ( $color_settings['h1_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['h1_color'] ) );
	} elseif ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	if ( $color_settings['content_title_color'] ) {
		$css->set_selector( '.editor-post-title__block .editor-post-title__input' );
		$css->add_property( 'color', esc_attr( $color_settings['content_title_color'] ) );
	}

	$css->set_selector( '.editor-styles-wrapper h2, .wp-block-heading h2.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h2_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_2_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_2_transform'] ) );
	$css->add_property( 'font-size', absint( $font_settings['heading_2_font_size'] ), false, 'px' );

	if ( $color_settings['h2_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['h2_color'] ) );
	} elseif ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( '.editor-styles-wrapper h3, .wp-block-heading h3.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h3_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_3_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_3_transform'] ) );
	$css->add_property( 'font-size', absint( $font_settings['heading_3_font_size'] ), false, 'px' );

	if ( $color_settings['h3_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['h3_color'] ) );
	} elseif ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( '.editor-styles-wrapper h4, .wp-block-heading h4.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h4_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_4_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_4_transform'] ) );

	if ( '' !== $font_settings['heading_4_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['heading_4_font_size'] ), false, 'px' );
	} else {
		$css->add_property( 'font-size', 'inherit' );
	}

	if ( $color_settings['h4_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['h4_color'] ) );
	} elseif ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( '.editor-styles-wrapper h5, .wp-block-heading h5.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h5_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_5_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_5_transform'] ) );

	if ( '' !== $font_settings['heading_5_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['heading_5_font_size'] ), false, 'px' );
	} else {
		$css->add_property( 'font-size', 'inherit' );
	}

	if ( $color_settings['h5_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['h5_color'] ) );
	} elseif ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( '.editor-styles-wrapper h6, .wp-block-heading h6.editor-rich-text__tinymce' );
	$css->add_property( 'font-family', $h6_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['heading_6_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['heading_6_transform'] ) );

	if ( '' !== $font_settings['heading_6_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['heading_6_font_size'] ), false, 'px' );
	} else {
		$css->add_property( 'font-size', 'inherit' );
	}

	if ( $color_settings['h6_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['h6_color'] ) );
	} elseif ( $color_settings['content_text_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_text_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'text_color' ) ) );
	}

	$css->set_selector( '.editor-block-list__layout .wp-block-button .wp-block-button__link' );
	$css->add_property( 'font-family', $buttons_family );
	$css->add_property( 'font-weight', esc_attr( $font_settings['buttons_font_weight'] ) );
	$css->add_property( 'text-transform', esc_attr( $font_settings['buttons_font_transform'] ) );

	if ( '' !== $font_settings['buttons_font_size'] ) {
		$css->add_property( 'font-size', absint( $font_settings['buttons_font_size'] ), false, 'px' );
	}

	$css->set_selector( 'body .editor-styles-wrapper' );
	$css->add_property( 'background-color', esc_attr( generate_get_option( 'background_color' ) ) );

	if ( $color_settings['content_background_color'] ) {
		$body_background = esc_attr( generate_get_option( 'background_color' ) );
		$content_background = esc_attr( $color_settings['content_background_color'] );
		$css->add_property( 'background', 'linear-gradient(' . $content_background . ',' . $content_background . '), linear-gradient(' . $body_background . ',' . $body_background . ')' );
	}

	$css->set_selector( '.editor-block-list__block a, .editor-block-list__block a:visited' );

	if ( $color_settings['content_link_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_link_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'link_color' ) ) );
	}

	$css->set_selector( '.editor-block-list__block a:hover, .editor-block-list__block a:focus, .editor-block-list__block a:active' );

	if ( $color_settings['content_link_hover_color'] ) {
		$css->add_property( 'color', esc_attr( $color_settings['content_link_hover_color'] ) );
	} else {
		$css->add_property( 'color', esc_attr( generate_get_option( 'link_color_hover' ) ) );
	}

	return $css->css_output();
}
