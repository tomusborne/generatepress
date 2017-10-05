<?php
defined( 'WPINC' ) or die;

add_action( 'wp_enqueue_scripts', 'generate_enqueue_scripts' );
/**
 * Enqueue scripts and styles
 */
function generate_enqueue_scripts() {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'generate-style-grid', trailingslashit( get_template_directory_uri() ) . "css/unsemantic-grid{$suffix}.css", false, GENERATE_VERSION, 'all' );
	wp_enqueue_style( 'generate-style', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css", array( 'generate-style-grid' ), GENERATE_VERSION, 'all' );
	wp_enqueue_style( 'generate-mobile-style', trailingslashit( get_template_directory_uri() ) . "css/mobile{$suffix}.css", array( 'generate-style' ), GENERATE_VERSION, 'all' );

	if ( is_child_theme() ) {
		wp_enqueue_style( 'generate-child', get_stylesheet_uri(), array( 'generate-style' ), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
	}

	$icon_essentials = ( apply_filters( 'generate_fontawesome_essentials', false ) ) ? '-essentials' : false;
	wp_enqueue_style( "font-awesome{$icon_essentials}", trailingslashit( get_template_directory_uri() ) . "css/font-awesome{$icon_essentials}{$suffix}.css", false, '4.7', 'all' );

	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_enqueue_script( 'generate-classlist', trailingslashit( get_template_directory_uri() ) . "js/classList{$suffix}.js", array(), GENERATE_VERSION, true );
		wp_script_add_data( 'generate-classlist', 'conditional', 'lte IE 11' );
	}

	wp_enqueue_script( 'generate-menu', trailingslashit( get_template_directory_uri() ) . "js/menu{$suffix}.js", array(), GENERATE_VERSION, true );
	wp_enqueue_script( 'generate-a11y', trailingslashit( get_template_directory_uri() ) . "js/a11y{$suffix}.js", array(), GENERATE_VERSION, true );

	$click = ( 'click' == generate_get_option( 'nav_dropdown_type' ) || 'click-arrow' == generate_get_option( 'nav_dropdown_type' ) ) ? '-click' : '';
	wp_enqueue_script( 'generate-dropdown', trailingslashit( get_template_directory_uri() ) . "js/dropdown{$click}{$suffix}.js", array( 'generate-menu' ), GENERATE_VERSION, true );

	if ( 'enable' == generate_get_option( 'nav_search' ) ) {
		wp_enqueue_script( 'generate-navigation-search', trailingslashit( get_template_directory_uri() ) . "js/navigation-search{$suffix}.js", array( 'generate-menu' ), GENERATE_VERSION, true );
	}

	if ( 'enable' == generate_get_option( 'back_to_top' ) ) {
		wp_enqueue_script( 'generate-back-to-top', trailingslashit( get_template_directory_uri() ) . "js/back-to-top{$suffix}.js", array(), GENERATE_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'widgets_init', 'generate_register_widget_areas' );
/**
 * Register widgetized area and update sidebar with default widgets
 */
function generate_register_widget_areas() {
	$widgets = array(
		'sidebar-1' => __( 'Right Sidebar', 'generatepress' ),
		'sidebar-2' => __( 'Left Sidebar', 'generatepress' ),
		'header' => __( 'Header', 'generatepress' ),
		'footer-1' => __( 'Footer Widget 1', 'generatepress' ),
		'footer-2' => __( 'Footer Widget 2', 'generatepress' ),
		'footer-3' => __( 'Footer Widget 3', 'generatepress' ),
		'footer-4' => __( 'Footer Widget 4', 'generatepress' ),
		'footer-5' => __( 'Footer Widget 5', 'generatepress' ),
		'footer-bar' => __( 'Footer Bar','generatepress' ),
		'top-bar' => __( 'Top Bar','generatepress' ),
	);

	foreach ( $widgets as $id => $name ) {
		register_sidebar( array(
			'name'          => $name,
			'id'            => $id,
			'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => apply_filters( 'generate_start_widget_title', '<h4 class="widget-title">' ),
			'after_title'   => apply_filters( 'generate_end_widget_title', '</h4>' ),
		) );
	}
}

add_action( 'wp', 'generate_set_content_width' );
/**
 * Set the $content_width depending on layout of current page.
 * Hook into "wp" so we have the correct layout setting from generate_get_sidebar_layout().
 * Hooking into "after_setup_theme" doesn't get the correct layout setting.
 *
 * @since 2.0
 */
function generate_set_content_width() {
	global $content_width;

	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	$layout = generate_get_sidebar_layout();

	if ( 'left-sidebar' == $layout ) {
		$content_width = generate_get_option( 'container_width' ) * ( ( 100 - $left_sidebar_width ) / 100 );
	} elseif ( 'right-sidebar' == $layout ) {
		$content_width = generate_get_option( 'container_width' ) * ( ( 100 - $right_sidebar_width ) / 100 );
	} elseif ( 'no-sidebar' == $layout ) {
		$content_width = generate_get_option( 'container_width' );
	} else {
		$content_width = generate_get_option( 'container_width' ) * ( ( 100 - ( $left_sidebar_width + $right_sidebar_width ) ) / 100 );
	}
}

add_filter( 'wp_page_menu_args', 'generate_set_home_link_fallback' );
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since 2.0
 *
 * @param array $args The existing menu args.
 * @return array Menu args.
 */
function generate_set_home_link_fallback( $args ) {
	$args['show_home'] = true;
	return $args;
}

add_filter( 'generate_show_title', 'generate_remove_content_title' );
/**
 * Remove our title if set.
 *
 * @since 2.0
 *
 * @return bool Whether to display the content title.
 */
function generate_remove_content_title() {
	$disable_headline = get_post_meta( get_the_ID(), '_generate-disable-headline', true );

	if ( ! empty( $disable_headline ) && false !== $disable_headline ) {
		return false;
	}

	return true;
}

add_filter( 'wp_resource_hints', 'generate_set_google_font_resource_hints', 10, 2 );
/**
 * Add resource hints to our Google fonts call.
 *
 * @since 2.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function generate_set_google_font_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'generate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}
	return $urls;
}

add_filter( 'img_caption_shortcode_width', 'generate_set_caption_width' );
/**
 * Remove WordPress's default padding on images with captions
 *
 * @since 2.0
 *
 * @param int $width Default WP .wp-caption width (image width + 10px)
 * @return int Updated width to remove 10px padding
 */
function generate_set_caption_width( $width ) {
	return $width - 10;
}

add_filter( 'generate_fontawesome_essentials', 'generate_set_font_awesome_library' );
/**
 * Check to see if we should include the full Font Awesome library or not.
 *
 * @since 1.5
 *
 * @param bool $essentials
 * @return bool
 */
function generate_set_font_awesome_library( $essentials ) {
	if ( 'essentials' == generate_get_option( 'font_awesome' ) ) {
		return true;
	}
	return $essentials;
}