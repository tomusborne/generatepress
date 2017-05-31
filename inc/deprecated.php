<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_paging_nav' ) ) :
/**
 * Build the pagination links
 * @since 1.3.35
 * @deprecated 1.3.45
 */
function generate_paging_nav() {
	_deprecated_function( __FUNCTION__, '1.3.45', "the_posts_navigation()" );
	if ( function_exists( 'the_posts_pagination' ) ) {
		the_posts_pagination( array(
			'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
			'prev_text' => __( '&larr; Previous', 'generatepress' ),
			'next_text' => __( 'Next &rarr;', 'generatepress' )
		) );
	}
}
endif;

if ( ! function_exists( 'generate_addons_available' ) ) :
/** 
 * Check to see if there's any addons not already activated
 * @since 1.0.9
 * @deprecated 1.4
 */
function generate_addons_available()
{
	if ( defined( 'GP_PREMIUM_VERSION' ) ) {
		return false;
	}
}
endif;

if ( ! function_exists( 'generate_no_addons' ) ) :
/** 
 * Check to see if no addons are activated
 * @since 1.0.9
 * @deprecated 1.4
 */
function generate_no_addons()
{
	if ( defined( 'GP_PREMIUM_VERSION' ) ) {
		return false;
	}
}
endif;

if ( ! function_exists( 'generate_remove_caption_padding' ) ) :
/**
 * Remove WordPress's default padding on images with captions
 *
 * @param int $width Default WP .wp-caption width (image width + 10px)
 * @return int Updated width to remove 10px padding
 * @deprecated 1.4
 */
function generate_remove_caption_padding( $width ) {
	return $width - 10;
}
endif;

if ( ! function_exists( 'generate_get_min_suffix' ) ) :
/** 
 * Figure out if we should use minified scripts or not
 * @since 1.3.29
 * @deprecated 1.4
 */
function generate_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}
endif;

if ( ! function_exists( 'generate_get_layout' ) ) :
/**
 * Get the layout for the current page
 * @deprecated 1.4
 */
function generate_get_layout()
{
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_sidebar_layout()" );
	return generate_get_sidebar_layout();
}
endif;

if ( ! function_exists( 'generate_get_footer_widgets' ) ) :
/**
 * Get the footer widgets for the current page
 * @deprecated 1.4
 */
function generate_get_footer_widgets()
{
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_footer_widget_count()" );
	return generate_get_footer_widget_count();
}
endif;

if ( ! function_exists( 'generate_get_setting' ) ) :
/**
 * A wrapper function to get our settings
 * @since 1.3.40
 * @deprecated 1.4
 */
function generate_get_setting( $setting ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_option()" );
	return generate_get_option( $setting );
}
endif;

if ( ! function_exists( 'generate_padding_css' ) ) :
/**
 * Shorten our padding/margin values into shorthand form
 *
 * Used inside our dynamic spacing CSS
 *
 * function_exists() as this function exists in GP Premium
 * @deprecated 1.4
 */
function generate_padding_css( $top, $right, $bottom, $left ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_shorthand_spacing_css()" );
	return generate_get_shorthand_spacing( $top, $right, $bottom, $left );
}
endif;

if ( ! function_exists( 'generate_right_sidebar_class' ) ) :
/**
 * Display the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_right_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'right-sidebar' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_right_sidebar_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_right_sidebar_class' ) ) :
/**
 * Retrieve the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_right_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'right-sidebar' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_right_sidebar_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_left_sidebar_class' ) ) :
/**
 * Display the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_left_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'left-sidebar' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_left_sidebar_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_left_sidebar_class' ) ) :
/**
 * Retrieve the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_left_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'left-sidebar' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_left_sidebar_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_content_class' ) ) :
/**
 * Display the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_content_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'primary' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_content_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_content_class' ) ) :
/**
 * Retrieve the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_content_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'primary' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_content_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_header_class' ) ) :
/**
 * Display the classes for the header.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'header' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_header_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_header_class' ) ) :
/**
 * Retrieve the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'header' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_header_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_inside_header_class' ) ) :
/**
 * Display the classes for inside the header.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_inside_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'inside-header' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_inside_header_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_inside_header_class' ) ) :
/**
 * Retrieve the classes for inside the header.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_inside_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'inside-header' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_inside_header_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_container_class' ) ) :
/**
 * Display the classes for the container.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_container_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'page' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_container_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_container_class' ) ) :
/**
 * Retrieve the classes for the content.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_container_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'page' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_container_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_navigation_class' ) ) :
/**
 * Display the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_navigation_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'navigation' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_navigation_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_navigation_class' ) ) :
/**
 * Retrieve the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_navigation_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'navigation' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_navigation_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_inside_navigation_class' ) ) :
/**
 * Display the classes for the inner navigation.
 *
 * @since 1.3.41
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_inside_navigation_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'inside-navigation' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	$return = apply_filters('generate_inside_navigation_class', $classes, $class);
	
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', $return ) . '"';
}
endif;

if ( ! function_exists( 'generate_menu_class' ) ) :
/**
 * Display the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_menu_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'menu' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_menu_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_menu_class' ) ) :
/**
 * Retrieve the classes for the navigation.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_menu_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'menu' )" );

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_menu_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_main_class' ) ) :
/**
 * Display the classes for the <main> container.
 *
 * @since 1.1.0
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_main_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'main' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_main_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_main_class' ) ) :
/**
 * Retrieve the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_main_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'main' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_main_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_footer_class' ) ) :
/**
 * Display the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_footer_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'footer' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_footer_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_footer_class' ) ) :
/**
 * Retrieve the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 * @deprecated 1.4
 */
function generate_get_footer_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_get_attr( 'footer' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_footer_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_inside_footer_class' ) ) :
/**
 * Display the classes for the footer.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_inside_footer_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'inside-footer' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);
	
	$return = apply_filters( 'generate_inside_footer_class', $classes, $class );
	
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', $return ) . '"';
}
endif;

if ( ! function_exists( 'generate_top_bar_class' ) ) :
/**
 * Display the classes for the top bar.
 *
 * @since 1.3.45
 * @param string|array $class One or more classes to add to the class list.
 * @deprecated 1.4
 */
function generate_top_bar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'top-bar' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);
	
	$return = apply_filters( 'generate_top_bar_class', $classes, $class );
	
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', $return ) . '"';
}
endif;

if ( ! function_exists( 'generate_body_schema' ) ) :
/** 
 * Figure out which schema tags to apply to the <body> element
 * @since 1.3.15
 * @deprecated 1.4
 */
function generate_body_schema() {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'body' )" );
	// Set up blog variable
	$blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;
	
	// Set up default itemtype
	$itemtype = 'WebPage';

	// Get itemtype for the blog
	$itemtype = ( $blog ) ? 'Blog' : $itemtype;
	
	// Get itemtype for search results
	$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
	
	// Get the result
	$result = apply_filters( 'generate_body_itemtype', $itemtype );
	
	// Return our HTML
	echo "itemtype='http://schema.org/$result' itemscope='itemscope'";
}
endif;

if ( ! function_exists( 'generate_article_schema' ) ) :
/** 
 * Figure out which schema tags to apply to the <article> element
 * The function determines the itemtype: generate_article_schema( 'BlogPosting' )
 * @since 1.3.15
 * @deprecated 1.4
 */
function generate_article_schema( $type = 'CreativeWork' ) {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_do_attr( 'post ' )" );
	// Get the itemtype
	$itemtype = apply_filters( 'generate_article_itemtype', $type );
	
	// Print the results
	echo "itemtype='http://schema.org/$itemtype' itemscope='itemscope'";
}
endif;

if ( ! function_exists( 'generate_show_title' ) ) :
/** 
 * Check to see if we should show our page/post title or not
 * @since 1.3.18
 * @deprecated 1.4
 */
function generate_show_title() {
	//_deprecated_function( __FUNCTION__, '1.4', "generate_show_content_title()" );
	return apply_filters( 'generate_show_title', true );
}
endif;

if ( ! function_exists( 'generate_show_excerpt' ) ) :
/** 
 * Figure out if we should show the blog excerpts or full posts
 * @since 1.3.15
 * @deprecated 1.4
 */
function generate_show_excerpt() {
	return generate_show_post_excerpt();
}
endif;

if ( ! function_exists( 'generate_get_link_url' ) ) :
/**
 * Return the post URL.
 * Falls back to the post permalink if no URL is found in the post.
 * @since 1.2.5
 * @deprecated 1.4
 */
function generate_get_link_url() {
	return generate_get_first_content_url();
}
endif;

/**
 * Hooked & filtered functions that have had a name change or become unnecessary.
 *
 * These likely don't need to be deprecated, but to be careful we'll keep them
 * in here for a couple months to give people who have used remove_action() etc..
 * time to update their code.
 *
 */
 
if ( ! function_exists( 'generate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @deprecated 1.4
 */
function generate_setup() {
	// Replaced by generate_setup_theme()
}
endif;

if ( ! function_exists( 'generate_scripts' ) ) :
/**
 * Enqueue scripts and styles
 * @deprecated 1.4
 */
function generate_scripts() {
	// Replaced by generate_enqueue_scripts()
}
endif;

if ( ! function_exists( 'generate_create_menu' ) ) :
function generate_create_menu() {
	// Replaced by generate_do_dashboard_menu()
}
endif;

if ( ! function_exists( 'generate_options_styles' ) ) :
function generate_options_styles() {
	// Replaced by generate_enqueue_dashboard_scripts()
}
endif;

if ( ! function_exists( 'generate_settings_page' ) ) :
function generate_settings_page() {
	// Replace by generate_do_dashboard_page()
}
endif;

if ( ! function_exists( 'generate_reset_customizer_settings' ) ) :
/**
 * Reset customizer settings
 */
function generate_reset_customizer_settings() {
	// Replaced by generate_do_customizer_reset()
}
endif;

if ( ! function_exists( 'generate_admin_errors' ) ) :
/**
 * Add our admin notices
 */
function generate_admin_errors() {
	// Replaced by generate_do_admin_errors()
}
endif;

if ( ! function_exists( 'generate_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 * @since 0.1
 * @deprecated 1.4
 */
function generate_body_classes() {
	// Replaced by generate_set_body_classes()
}
endif;

if ( ! function_exists( 'generate_top_bar_classes' ) ) :
/**
 * Adds custom classes to the header
 * @since 0.1
 * @deprecated 1.4
 */
function generate_top_bar_classes() {
	// Replaced by generate_set_top_bar_classes()
}
endif;

if ( ! function_exists( 'generate_right_sidebar_classes' ) ) :
/**
 * Adds custom classes to the right sidebar
 * @since 0.1
 * @deprecated 1.4
 */
function generate_right_sidebar_classes() {
	// Replaced by generate_set_right_sidebar_classes()
}
endif;

if ( ! function_exists( 'generate_left_sidebar_classes' ) ) :
/**
 * Adds custom classes to the left sidebar
 * @since 0.1
 * @deprecated 1.4
 */
function generate_left_sidebar_classes() {
	// Replaced by generate_set_left_sidebar_classes()
}
endif;

if ( ! function_exists( 'generate_content_classes' ) ) :
/**
 * Adds custom classes to the content container
 * @since 0.1
 * @deprecated 1.4
 */
function generate_content_classes() {
	// Replaced by generate_set_content_classes()
}
endif;

if ( ! function_exists( 'generate_header_classes' ) ) :
/**
 * Adds custom classes to the header
 * @since 0.1
 * @deprecated 1.4
 */
function generate_header_classes() {
	// Replaced by generate_set_header_classes()
}
endif;

if ( ! function_exists( 'generate_inside_header_classes' ) ) :
/**
 * Adds custom classes to inside the header
 * @since 0.1
 * @deprecated 1.4
 */
function generate_inside_header_classes() {
	// Replaced by generate_set_inside_header_classes()
}
endif;

if ( ! function_exists( 'generate_navigation_classes' ) ) :
/**
 * Adds custom classes to the navigation
 * @since 0.1
 * @deprecated 1.4
 */
function generate_navigation_classes() {
	// Replaced by generate_set_navigation_classes()
}
endif;

if ( ! function_exists( 'generate_inside_navigation_classes' ) ) :
/**
 * Adds custom classes to the inner navigation
 * @since 1.3.41
 * @deprecated 1.4
 */
function generate_inside_navigation_classes() {
	// Replaced by generate_set_inside_navigation_classes()
}
endif;

if ( ! function_exists( 'generate_menu_classes' ) ) :
/**
 * Adds custom classes to the menu
 * @since 0.1
 * @deprecated 1.4
 */
function generate_menu_classes() {
	// Replaced by generate_set_menu_classes()
}
endif;

if ( ! function_exists( 'generate_footer_classes' ) ) :
/**
 * Adds custom classes to the footer
 * @since 0.1
 * @deprecated 1.4
 */
function generate_footer_classes() {
	// Replaced by generate_set_footer_classes()
}
endif;

if ( ! function_exists( 'generate_inside_footer_classes' ) ) :
/**
 * Adds custom classes to the footer
 * @since 0.1
 * @deprecated 1.4
 */
function generate_inside_footer_classes() {
	// Replaced by generate_set_inside_footer_classes()
}
endif;

if ( ! function_exists( 'generate_main_classes' ) ) :
/**
 * Adds custom classes to the <main> element
 * @since 1.1.0
 * @deprecated 1.4
 */
function generate_main_classes() {
	// Replaced by generate_set_main_classes()
}
endif;

if ( ! function_exists( 'generate_post_classes' ) ) :
/**
 * Adds custom classes to the <article> element
 * Remove .hentry class from pages to comply with structural data guidelines
 * @since 1.3.39
 * @deprecated 1.4
 */
function generate_post_classes() {
	// Replaced by generate_set_post_classes()
}
endif;

if ( ! function_exists( 'generate_widgets_init' ) ) :
/**
 * Register widgetized area and update sidebar with default widgets
 */
function generate_widgets_init() {
	// Replaced by generate_register_widgets()
}
endif;

if ( ! function_exists( 'generate_add_layout_meta_box' ) ) :
/**
 * Generate the layout metabox
 * @since 0.1
 * @deprecated 1.4
 */
function generate_add_layout_meta_box() { 
	// Replaced by generate_register_layout_meta_box()
}  
endif;

if ( ! function_exists( 'generate_show_layout_meta_box' ) ) :
/**
 * Outputs the content of the metabox
 * @deprecated 1.4
 */
function generate_show_layout_meta_box() {  
	// Replaced by generate_do_layout_meta_box()
}
endif;

if ( ! function_exists( 'generate_save_layout_meta' ) ) :
/**
 * Saves the sidebar layout meta data
 * @deprecated 1.4
 */
function generate_save_layout_meta() {  
	// Replaced by generate_save_layout_meta_data()
}  
endif;

if ( ! function_exists( 'generate_add_footer_widget_meta_box' ) ) :
/**
 * Generate the footer widget metabox
 * @since 0.1
 * @deprecated 1.4
 */
function generate_add_footer_widget_meta_box() {  
	// Replaced by generate_register_layout_meta_box()
}  
endif;

if ( ! function_exists( 'generate_show_footer_widget_meta_box' ) ) :
/**
 * Outputs the content of the metabox
 * @deprecated 1.4
 */
function generate_show_footer_widget_meta_box() {  
    // Replaced by generate_do_layout_meta_box()
}
endif;

if ( ! function_exists( 'generate_save_footer_widget_meta' ) ) :
/**
 * Saves the footer widget meta data
 * @deprecated 1.4
 */
function generate_save_footer_widget_meta() {  
	// Replaced by generate_save_layout_meta_data()
}  
endif;

if ( ! function_exists( 'generate_add_page_builder_meta_box' ) ) :
/**
 * Generate the page builder integration metabox
 * @since 1.3.32
 * @deprecated 1.4
 */
function generate_add_page_builder_meta_box() {  
	// Replaced by generate_register_layout_meta_box()
}
endif;

if ( ! function_exists( 'generate_show_page_builder_meta_box' ) ) :
/**
 * Outputs the content of the metabox
 * @deprecated 1.4
 */
function generate_show_page_builder_meta_box() {  
	// Replaced by generate_do_layout_meta_box()
}
endif;

if ( ! function_exists( 'generate_save_page_builder_meta' ) ) :
/**
 * Saves the footer widget meta data
 * @deprecated 1.4
 */
function generate_save_page_builder_meta($post_id) {  
	// Replaced by generate_save_layout_meta_data()
}
endif;

if ( !function_exists('generate_add_de_meta_box') ) :
/**
 * Create the metabox
 * @since 1.3.18
 * @deprecated 1.4
 */
function generate_add_de_meta_box() {
	// Replaced by generate_register_layout_meta_box()
}  
endif;

if ( !function_exists( 'generate_show_de_meta_box' ) ) :
/**
 * Build our metabox
 * @since 1.3.18
 * @deprecated 1.4
 */
function generate_show_de_meta_box() {
	// Replaced by generate_do_layout_meta_box()
}
endif;

if ( !function_exists( 'generate_save_de_meta' ) ) :
/**
 * Save our metabox data
 * @since 1.3.18
 * @deprecated 1.4
 */
function generate_save_de_meta() {  
	// Replaced by generate_save_layout_meta_data()
}  
endif;

if ( ! function_exists( 'generate_additional_spacing' ) ) :
/**
 * Add fallback CSS for our mobile search icon color
 * @deprecated 1.4
 */
function generate_additional_spacing() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) :
/**
 * Enqueue our mobile search icon color fallback CSS
 * @deprecated 1.4
 */
function generate_mobile_search_spacing_fallback_css() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_smart_content_width' ) ) :
/**
 * Set the $content_width depending on layout of current page
 * Hook into "wp" so we have the correct layout setting from generate_get_sidebar_layout()
 * Hooking into "after_setup_theme" doesn't get the correct layout setting
 * @deprecated 1.4
 */
add_action( 'wp', 'generate_smart_content_width' );
function generate_smart_content_width() {
	// Replaced by generate_set_content_width()
}
endif;

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) :
/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 * @deprecated 1.4
 */
function generate_enhanced_image_navigation() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_page_menu_args' ) ) :
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 * @deprecated 1.4
 */
function generate_page_menu_args() {
	// Replaced by generate_set_home_link_fallback()
}
endif;

if ( ! function_exists( 'generate_disable_title' ) ) :
/**
 * Remove our title if set
 * @since 1.3.18
 * @deprecated 1.4
 */
function generate_disable_title() {
	// Replaced by generate_remove_content_title()
}
endif;

if ( ! function_exists( 'generate_resource_hints' ) ) :
/**
 * Add resource hints to our Google fonts call
 * @since 1.3.42
 * @deprecated 1.4
 */
function generate_resource_hints() {
	// Replaced by generate_google_font_resource_hints()
}
endif;