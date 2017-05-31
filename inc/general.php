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
function generate_register_widget_areas() 
{
	// Set up our array of widgets	
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
	
	// Loop through them to create our widget areas
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

if ( ! function_exists( 'generate_smart_content_width' ) ) :
/**
 * Set the $content_width depending on layout of current page
 * Hook into "wp" so we have the correct layout setting from generate_get_sidebar_layout()
 * Hooking into "after_setup_theme" doesn't get the correct layout setting
 */
add_action( 'wp', 'generate_smart_content_width' );
function generate_smart_content_width()
{

	global $content_width;
	
	// Get sidebar widths
	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	
	// Get the layout
	$layout = generate_get_sidebar_layout();
	
	// Find the real content width
	if ( 'left-sidebar' == $layout ) {
		// If left sidebar is present
		$content_width = generate_get_option( 'container_width' ) * ( ( 100 - $left_sidebar_width ) / 100 );
	} elseif ( 'right-sidebar' == $layout ) {
		// If right sidebar is present
		$content_width = generate_get_option( 'container_width' ) * ( ( 100 - $right_sidebar_width ) / 100 );
	} elseif ( 'no-sidebar' == $layout ) {
		// If no sidebars are present
		$content_width = generate_get_option( 'container_width' );
	} else {
		// If both sidebars are present
		$content_width = generate_get_option( 'container_width' ) * ( ( 100 - ( $left_sidebar_width + $right_sidebar_width ) ) / 100 );	
	}
}
endif;

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) :
/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
add_filter( 'attachment_link', 'generate_enhanced_image_navigation', 10, 2 );
function generate_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
endif;

if ( ! function_exists( 'generate_page_menu_args' ) ) :
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
add_filter( 'wp_page_menu_args', 'generate_page_menu_args' );
function generate_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
endif;

if ( ! function_exists( 'generate_disable_title' ) ) :
/**
 * Remove our title if set
 * @since 1.3.18
 */
add_filter( 'generate_show_title', 'generate_disable_title' );
function generate_disable_title() {
	// Get our option
	$disable_headline = get_post_meta( get_the_ID(), '_generate-disable-headline', true );
	
	// If our option is set, disable the title
	if ( ! empty( $disable_headline ) && false !== $disable_headline ) {
		return false;
	}
	
	// If we've reached this point, our option is not set, so we should continue to show our title
	return true;
}
endif;