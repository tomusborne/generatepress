<?php
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_right_sidebar_class' ) ) :
/**
 * Display the classes for the sidebar.
 *
 * @since 0.1
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_right_sidebar_class( $class = '' ) {
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
 */
function generate_get_right_sidebar_class( $class = '' ) {

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
 */
function generate_left_sidebar_class( $class = '' ) {
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
 */
function generate_get_left_sidebar_class( $class = '' ) {

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
 */
function generate_content_class( $class = '' ) {
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
 */
function generate_get_content_class( $class = '' ) {

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
 */
function generate_header_class( $class = '' ) {
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
 */
function generate_get_header_class( $class = '' ) {

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
 */
function generate_inside_header_class( $class = '' ) {
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
 */
function generate_get_inside_header_class( $class = '' ) {

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
 */
function generate_container_class( $class = '' ) {
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
 */
function generate_get_container_class( $class = '' ) {

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
 */
function generate_navigation_class( $class = '' ) {
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
 */
function generate_get_navigation_class( $class = '' ) {

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
 */
function generate_inside_navigation_class( $class = '' ) {
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
 */
function generate_menu_class( $class = '' ) {
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
 */
function generate_get_menu_class( $class = '' ) {

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
 */
function generate_main_class( $class = '' ) {
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
 */
function generate_get_main_class( $class = '' ) {

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
 */
function generate_footer_class( $class = '' ) {
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
 */
function generate_get_footer_class( $class = '' ) {

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
 */
function generate_inside_footer_class( $class = '' ) {
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
 */
function generate_top_bar_class( $class = '' ) {
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
 *
 * @since 1.3.15
 */
function generate_body_schema() {
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
 *
 * @since 1.3.15
 */
function generate_article_schema( $type = 'CreativeWork' ) {
	// Get the itemtype
	$itemtype = apply_filters( 'generate_article_itemtype', $type );

	// Print the results
	echo "itemtype='http://schema.org/$itemtype' itemscope='itemscope'";
}
endif;