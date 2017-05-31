<?php
defined( 'WPINC' ) or die;

/**
 * A wrapper function to get our options
 * @since 1.4
 * @todo Ability to specify different option name and defaults
 */
function generate_get_option( $option ) {
	$options = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	return $options[ $option ];
}

/**
 * Get the layout for the current page
 * @since 1.4
 */
function generate_get_sidebar_layout() {
	// Get current post
	global $post;
	
	// Set up the layout variable for pages
	$layout = generate_get_option( 'layout_setting' );
	
	// Get the individual page/post sidebar metabox value
	$layout_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-sidebar-layout-meta', true ) : '';
	
	// Set up BuddyPress variable
	$buddypress = ( function_exists( 'is_buddypress' ) && is_buddypress() ) ? true : false;

	// If we're on the single post page
	// And if we're not on a BuddyPress page - fixes a bug where BP thinks is_single() is true
	if ( is_single() && ! $buddypress ) {
		$layout = generate_get_option( 'single_layout_setting' );
	}

	// If the metabox is set, use it instead of the global settings
	if ( '' !== $layout_meta && false !== $layout_meta ) {
		$layout = $layout_meta;
	}
	
	// If we're on the blog, archive, attachment etc..
	if ( is_home() || is_archive() || is_search() || is_tax() ) {
		$layout = generate_get_option( 'blog_layout_setting' );
	}
	
	// Finally, return the layout
	return apply_filters( 'generate_sidebar_layout', $layout );
}

/**
 * Get the number of footer widgets for the current page
 * @since 1.4
 */
function generate_get_footer_widget_count() {
	// Get current post
	global $post;
	
	// Set up the footer widget variable
	$widgets = generate_get_option( 'footer_widget_setting' );
	
	// Get the individual footer widget metabox value
	$widgets_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-footer-widget-meta', true ) : '';
	
	// If we're not on a single page or post, the metabox hasn't been set
	if ( ! is_singular() ) {
		$widgets_meta = '';
	}
	
	// If we have a metabox option set, use it
	if ( '' !== $widgets_meta && false !== $widgets_meta ) {
		$widgets = $widgets_meta;
	}
	
	// Finally, return the layout
	return apply_filters( 'generate_footer_widgets', $widgets );
}

/** 
 * Figure out if we should show the post excerpts or full posts
 * @since 1.4
 */
function generate_show_post_excerpt()
{
	// Get current post
	global $post;
	
	// Check to see if the more tag is being used
	$more_tag = apply_filters( 'generate_more_tag', strpos( $post->post_content, '<!--more-->' ) );

	// Check the post format
	$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';
	
	// Get the excerpt setting from the Customizer
	$show_excerpt = ( 'excerpt' == generate_get_option( 'post_content' ) ) ? true : false;
	
	// If our post format isn't standard, show the full content
	$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;
	
	// If the more tag is found, show the full content
	$show_excerpt = ( $more_tag ) ? false : $show_excerpt;
	
	// If we're on a search results page, show the excerpt
	$show_excerpt = ( is_search() ) ? true : $show_excerpt;
	
	// Return our value
	return apply_filters( 'generate_show_excerpt', $show_excerpt );
}

/** 
 * Check to see if we should show our page/post title or not
 * @since 1.4
 */
function generate_show_content_title() {
	return apply_filters( 'generate_show_title', true );
}

/**
 * Generate a URL to our premium add-ons
 * Allows the use of a referral ID and campaign
 * @since 1.3.42
 */
function generate_get_premium_url( $url = 'https://generatepress.com/premium' ) {
	// Get our URL
	$url = trailingslashit( $url );
	
	// Set up args
	$args = apply_filters( 'generate_premium_url_args', array(
		'ref' => null,
		'campaign' => null
	) );
	
	// Set up our URL if we have an ID
	if ( isset( $args[ 'ref' ] ) ) {
		$url = add_query_arg( 'ref', absint( $args[ 'ref' ] ), $url );
	}
	
	// Set up our URL if we have a campaign
	if ( isset( $args[ 'campaign' ] ) ) {
		$url = add_query_arg( 'campaign', sanitize_text_field( $args[ 'campaign' ] ), $url );
	}
	
	// Return our URL with the optional referral ID
	return esc_url( $url );
}

/**
 * Shorten our padding/margin values into shorthand form
 * Used inside our dynamic spacing CSS
 *
 * @since 1.4
 */
function generate_get_shorthand_spacing( $top, $right, $bottom, $left ) {
	$padding_top = ( isset( $top ) && '' !== $top ) ? absint( $top ) . 'px ' : '0px ';
	$padding_right = ( isset( $right ) && '' !== $right ) ? absint( $right ) . 'px ' : '0px ';
	$padding_bottom = ( isset( $bottom ) && '' !== $bottom ) ? absint( $bottom ) . 'px ' : '0px ';
	$padding_left = ( isset( $left ) && '' !== $left ) ? absint( $left ) . 'px' : '0px';
	
	// If all of our values are the same, we can return one value only
	if ( ( absint( $padding_top ) === absint( $padding_right ) ) && ( absint( $padding_right ) === absint( $padding_bottom ) ) && ( absint( $padding_bottom ) === absint( $padding_left ) ) ) {
		return $padding_left;
	}
	
	return $padding_top . $padding_right . $padding_bottom . $padding_left;
}

/**
 * Get our element classes added via filter
 * Display them separated by spaces
 *
 * Before generate_do_attr(), classes were added via individual
 * filters per element, which is what makes this function necessary.
 *
 * From now on, classes can be filtered into the generate_attr_{context} filter.
 *
 * @since 1.4
 */
function generate_get_element_classes( $filter ) {
	$classes = array();
	
	return implode( ' ', apply_filters( $filter, $classes ) );
}

/**
 * Return the post URL.
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since 1.4
 * @see get_url_in_content()
 * @return string The Link format URL.
 */
function generate_get_first_content_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Get the location of the navigation and filter it
 * @since 1.3.41
 */
function generate_get_navigation_location() {
	$location = generate_get_option( 'nav_position_setting' );
	return apply_filters( 'generate_navigation_location', $location );
}