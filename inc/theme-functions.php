<?php
/**
 * Main theme functions.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_get_setting' ) ) {
	/**
	 * A wrapper function to get our settings.
	 *
	 * @since 1.3.40
	 *
	 * @param string $option The option name to look up.
	 * @return string The option value.
	 * @todo Ability to specify different option name and defaults.
	 */
	function generate_get_setting( $setting ) {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		return $generate_settings[ $setting ];
	}
}

if ( ! function_exists( 'generate_get_layout' ) ) {
	/**
	 * Get the layout for the current page.
	 *
	 * @since 0.1
	 *
	 * @return string The sidebar layout location.
	 */
	function generate_get_layout() {
		// Get current post
		global $post;

		// Get Customizer options
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// Set up the layout variable for pages
		$layout = $generate_settings['layout_setting'];

		// Get the individual page/post sidebar metabox value
		$layout_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-sidebar-layout-meta', true ) : '';

		// Set up BuddyPress variable
		$buddypress = false;
		if ( function_exists( 'is_buddypress' ) ) {
			$buddypress = ( is_buddypress() ) ? true : false;
		}

		// If we're on the single post page
		// And if we're not on a BuddyPress page - fixes a bug where BP thinks is_single() is true
		if ( is_single() && ! $buddypress ) {
			$layout = null;
			$layout = $generate_settings['single_layout_setting'];
		}

		// If the metabox is set, use it instead of the global settings
		if ( '' !== $layout_meta && false !== $layout_meta ) {
			$layout = $layout_meta;
		}

		// If we're on the blog, archive, attachment etc..
		if ( is_home() || is_archive() || is_search() || is_tax() ) {
			$layout = null;
			$layout = $generate_settings['blog_layout_setting'];
		}

		// Finally, return the layout
		return apply_filters( 'generate_sidebar_layout', $layout );
	}
}

if ( ! function_exists( 'generate_get_footer_widgets' ) ) {
	/**
	 * Get the footer widgets for the current page
	 *
	 * @since 0.1
	 *
	 * @return int The number of footer widgets.
	 */
	function generate_get_footer_widgets() {
		// Get current post
		global $post;

		// Get Customizer options
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// Set up the footer widget variable
		$widgets = $generate_settings['footer_widget_setting'];

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
}

if ( ! function_exists( 'generate_show_excerpt' ) ) {
	/**
	 * Figure out if we should show the blog excerpts or full posts
	 * @since 1.3.15
	 */
	function generate_show_excerpt() {
		// Get current post
		global $post;

		// Get Customizer settings
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// Check to see if the more tag is being used
		$more_tag = apply_filters( 'generate_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		// Check the post format
		$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		// Get the excerpt setting from the Customizer
		$show_excerpt = ( 'excerpt' == $generate_settings['post_content'] ) ? true : false;

		// If our post format isn't standard, show the full content
		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;

		// If the more tag is found, show the full content
		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		// If we're on a search results page, show the excerpt
		$show_excerpt = ( is_search() ) ? true : $show_excerpt;

		// Return our value
		return apply_filters( 'generate_show_excerpt', $show_excerpt );
	}
}

if ( ! function_exists( 'generate_show_title' ) ) {
	/**
	 * Check to see if we should show our page/post title or not.
	 *
	 * @since 1.3.18
	 *
	 * @return bool Whether to show the content title.
	 */
	function generate_show_title() {
		return apply_filters( 'generate_show_title', true );
	}
}

if ( ! function_exists( 'generate_get_premium_url' ) ) {
	/**
	 * Generate a URL to our premium add-ons.
	 * Allows the use of a referral ID and campaign.
	 *
	 * @since 1.3.42
	 *
	 * @param string $url URL to premium page.
	 * @return string The URL to generatepress.com.
	 */
	function generate_get_premium_url( $url = 'https://generatepress.com/premium' ) {
		$url = trailingslashit( $url );

		$args = apply_filters( 'generate_premium_url_args', array(
			'ref' => null,
			'campaign' => null,
		) );

		// Set up our URL if we have an ID
		if ( isset( $args['ref'] ) ) {
			$url = add_query_arg( 'ref', absint( $args['ref'] ), $url );
		}

		// Set up our URL if we have a campaign
		if ( isset( $args['campaign'] ) ) {
			$url = add_query_arg( 'campaign', sanitize_text_field( $args['campaign'] ), $url );
		}

		return esc_url( $url );
	}
}

if ( ! function_exists( 'generate_padding_css' ) ) {
	/**
	 * Shorten our padding/margin values into shorthand form.
	 *
	 * @since 0.1
	 *
	 * @param int $top Top spacing.
	 * @param int $right Right spacing.
	 * @param int $bottom Bottom spacing.
	 * @param int $left Left spacing.
	 * @return string Element spacing values.
	 */
	function generate_padding_css( $top, $right, $bottom, $left ) {
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
}

if ( ! function_exists( 'generate_get_link_url' ) ) {
	/**
	 * Return the post URL.
	 *
	 * Falls back to the post permalink if no URL is found in the post.
	 *
	 * @since 1.2.5
	 *
	 * @see get_url_in_content()
	 * @return string The Link format URL.
	 */
	function generate_get_link_url() {
		$has_url = get_url_in_content( get_the_content() );

		return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}
}

if ( ! function_exists( 'generate_get_navigation_location' ) ) {
	/**
	 * Get the location of the navigation and filter it.
	 *
	 * @since 1.3.41
	 *
	 * @return string The primary menu location.
	 */
	function generate_get_navigation_location() {
		return apply_filters( 'generate_navigation_location', generate_get_setting( 'nav_position_setting' ) );
	}
}
