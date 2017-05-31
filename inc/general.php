<?php
defined( 'WPINC' ) or die;

add_action( 'wp_enqueue_scripts', 'generate_enqueue_scripts' );
/**
 * Enqueue scripts and styles
 */
function generate_enqueue_scripts() {
	// Get the minified suffix.
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	
	// Enqueue our CSS.
	wp_enqueue_style( 'generate-style-grid', trailingslashit( get_template_directory_uri() ) . "css/unsemantic-grid{$suffix}.css", false, GENERATE_VERSION, 'all' );
	wp_enqueue_style( 'generate-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'generate-style-grid' ), GENERATE_VERSION, 'all' );
	wp_enqueue_style( 'generate-mobile-style', trailingslashit( get_template_directory_uri() ) . "css/mobile{$suffix}.css", array( 'generate-style' ), GENERATE_VERSION, 'all' );
	
	// Add the child theme CSS if child theme is active.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'generate-child', get_stylesheet_uri(), array( 'generate-style' ), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
	}
	
	// Font Awesome
	$icon_essentials = apply_filters( 'generate_fontawesome_essentials', false );
	$icon_essentials = ( $icon_essentials ) ? '-essentials' : false;
	wp_enqueue_style( "fontawesome{$icon_essentials}", trailingslashit( get_template_directory_uri() ) . "css/font-awesome{$icon_essentials}{$suffix}.css", false, '4.7', 'all' );
	
	// IE 8
	wp_enqueue_style( 'generate-ie', trailingslashit( get_template_directory_uri() ) . "css/ie{$suffix}.css", array( 'generate-style-grid' ), GENERATE_VERSION, 'all' );
	wp_style_add_data( 'generate-ie', 'conditional', 'lt IE 9' );
	
	// Add our mobile navigation
	wp_enqueue_script( 'generate-navigation', trailingslashit( get_template_directory_uri() ) . "js/navigation{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	
	// Add our hover or click dropdown menu scripts
	$click = ( 'click' == generate_get_option( 'nav_dropdown_type' ) || 'click-arrow' == generate_get_option( 'nav_dropdown_type' ) ) ? '-click' : '';
	wp_enqueue_script( 'generate-dropdown', trailingslashit( get_template_directory_uri() ) . "js/dropdown{$click}{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	
	// Add our navigation search if it's enabled
	if ( 'enable' == generate_get_option( 'nav_search' ) ) {
		wp_enqueue_script( 'generate-navigation-search', trailingslashit( get_template_directory_uri() ) . "js/navigation-search{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	}
	
	// Add the back to top script if it's enabled
	if ( 'enable' == generate_get_option( 'back_to_top' ) ) {
		wp_enqueue_script( 'generate-back-to-top', trailingslashit( get_template_directory_uri() ) . "js/back-to-top{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	}
	
	// Move the navigation from below the content on mobile to below the header if it's in a sidebar
	if ( 'nav-left-sidebar' == generate_get_navigation_location() || 'nav-right-sidebar' == generate_get_navigation_location() ) {
		wp_enqueue_script( 'generate-move-navigation', trailingslashit( get_template_directory_uri() ) . "js/move-navigation{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	}
	
	// IE 8
	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_enqueue_script( 'generate-html5', trailingslashit( get_template_directory_uri() ) . "js/html5shiv{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
		wp_script_add_data( 'generate-html5', 'conditional', 'lt IE 9' );
	}
	
	// Add the threaded comments script
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
 * @since 1.4
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
 * @since 1.4
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
 * @since 1.4
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

add_filter( 'wp_resource_hints', 'generate_google_font_resource_hints', 10, 2 );
/**
 * Add resource hints to our Google fonts call.
 *
 * @since 1.4
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function generate_google_font_resource_hints( $urls, $relation_type ) {
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