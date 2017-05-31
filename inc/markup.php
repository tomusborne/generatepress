<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Merge array of attributes with defaults, and apply contextual filter on array.
 *
 * The contextual filter is of the form `generate_attr_{context}`.
 *
 * @since 1.4
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @return array Merged and filtered attributes.
 */
function generate_parse_attr( $context, $attributes = array() ) {
    $defaults = array(
        'class' => esc_attr( $context ),
    );

    $attributes = wp_parse_args( $attributes, $defaults );

    // Contextual filter.
    return apply_filters( "generate_attr_{$context}", $attributes, $context );
}

/**
 * Build list of attributes into a string and apply contextual filter on string.
 *
 * The contextual filter is of the form `generate_attr_{context}_output`.
 *
 * @since 1.4
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @return string String of HTML attributes and values.
 */
function generate_get_attr( $context, $attributes = array() ) {
	$attributes = generate_parse_attr( $context, $attributes );

	$output = '';

	// Cycle through attributes, build tag attribute string.
    foreach ( $attributes as $key => $value ) {

		if ( ! $value ) {
			continue;
		}

		if ( true === $value ) {
			$output .= esc_html( $key ) . ' ';
		} else {
			$output .= sprintf( '%s="%s" ', esc_html( $key ), esc_attr( $value ) );
		}

    }

    $output = apply_filters( "generate_attr_{$context}_output", $output, $attributes, $context );

    return trim( $output );
}

/**
 * Print our generate_get_attr() function
 *
 * @since 1.4
 */
function generate_do_attr( $context, $attributes = array() ) {
	echo generate_get_attr( $context, $attributes );
}

add_filter( 'generate_attr_body', 'generate_set_body_attributes' );
/**
 * Build our <body> attributes
 *
 * @since 1.4
 */
function generate_set_body_attributes( $attributes ) {
	$attributes['class'] = join( ' ', get_body_class() );
	$itemtype = 'WebPage';
	
	// Change our itemtype if we're on the blog
	$itemtype = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? 'Blog' : $itemtype;
	
	// Change our itemtype if we're in search results
	$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
	
	$attributes['itemtype']  = 'http://schema.org/' . apply_filters( 'generate_body_itemtype', $itemtype );
	$attributes['itemscope'] = true;
	
	return $attributes;
}

add_filter( 'generate_attr_page', 'generate_set_page_attributes' );
/**
 * Build our page attributes
 *
 * @since 1.4
 */
function generate_set_page_attributes() {
	$attributes['id'] = 'page';
	$attributes['class'] = 'hfeed site grid-container container grid-parent';
	
	return $attributes;
}

add_filter( 'generate_attr_primary', 'generate_set_primary_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_primary_attributes() {
	$attributes['id'] = 'primary';
	$attributes['class'] = generate_get_element_classes( 'generate_content_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_right-sidebar', 'generate_set_right_sidebar_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_right_sidebar_attributes() {
	$attributes['id'] = 'right-sidebar';
	$attributes['class'] = generate_get_element_classes( 'generate_right_sidebar_class' );
	$attributes['itemtype'] = 'http://schema.org/WPSideBar';
	$attributes['itemscope'] = true;
	$attributes['role'] = 'complementary';
	
	return $attributes;
}

add_filter( 'generate_attr_left-sidebar', 'generate_set_left_sidebar_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_left_sidebar_attributes() {
	$attributes['id'] = 'left-sidebar';
	$attributes['class'] = generate_get_element_classes( 'generate_left_sidebar_class' );
	$attributes['itemtype'] = 'http://schema.org/WPSideBar';
	$attributes['itemscope'] = true;
	$attributes['role'] = 'complementary';
	
	return $attributes;
}

add_filter( 'generate_attr_header', 'generate_set_header_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_header_attributes() {
	$attributes['id'] = 'masthead';
	$attributes['class'] = generate_get_element_classes( 'generate_header_class' );
	$attributes['itemtype'] = 'http://schema.org/WPHeader';
	$attributes['itemscope'] = true;
	
	return $attributes;
}

add_filter( 'generate_attr_inside-header', 'generate_set_inside_header_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_inside_header_attributes() {
	$attributes['class'] = generate_get_element_classes( 'generate_inside_header_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_navigation', 'generate_set_navigation_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_navigation_attributes() {
	$attributes['id'] = 'site-navigation';
	$attributes['class'] = generate_get_element_classes( 'generate_navigation_class' );
	$attributes['itemtype'] = 'http://schema.org/SiteNavigationElement';
	$attributes['itemscope'] = true;
	
	return $attributes;
}

add_filter( 'generate_attr_inside-navigation', 'generate_set_inside_navigation_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_inside_navigation_attributes() {
	$attributes['class'] = generate_get_element_classes( 'generate_inside_navigation_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_main', 'generate_set_main_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_main_attributes() {
	$attributes['id'] = 'main';
	$attributes['class'] = generate_get_element_classes( 'generate_main_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_footer', 'generate_set_footer_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_footer_attributes() {
	$attributes['class'] = generate_get_element_classes( 'generate_footer_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_inside-footer', 'generate_set_inside_footer_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_inside_footer_attributes() {
	$attributes['class'] = generate_get_element_classes( 'generate_inside_footer_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_footer-bar', 'generate_set_footer_bar_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_footer_bar_attributes() {
	$attributes['class'] = 'site-info';
	$attributes['itemtype'] = 'http://schema.org/WPFooter';
	$attributes['itemscope'] = true;
	
	return $attributes;
}

add_filter( 'generate_attr_top-bar', 'generate_set_top_bar_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_top_bar_attributes() {
	$attributes['class'] = generate_get_element_classes( 'generate_top_bar_class' );
	
	return $attributes;
}

add_filter( 'generate_attr_post', 'generate_set_post_attributes' );
/**
 * Build our primary content area attributes
 *
 * @since 1.4
 */
function generate_set_post_attributes() {
	$attributes['id'] = 'post-' . get_the_ID();
	$attributes['class'] = join( ' ', get_post_class() );
	$attributes['itemtype'] = 'http://schema.org/CreativeWork';
	$attributes['itemscope'] = true;
	
	return $attributes;
}