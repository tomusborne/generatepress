<?php
/**
 * Main theme functions.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * A wrapper function to get our options.
 *
 * @since 2.2
 *
 * @param string $option The option name to look up.
 * @return string The option value.
 */
function generate_get_option( $option ) {
	$options = wp_parse_args(
		get_option( 'generate_settings', array() ),
		generate_get_defaults()
	);

	return $options[ $option ];
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
		$layout = generate_get_option( 'layout_setting' );

		if ( is_single() ) {
			$layout = generate_get_option( 'single_layout_setting' );
		}

		if ( is_singular() ) {
			$layout_meta = get_post_meta( get_the_ID(), '_generate-sidebar-layout-meta', true );

			if ( $layout_meta ) {
				$layout = $layout_meta;
			}
		}

		if ( is_home() || is_archive() || is_search() || is_tax() ) {
			$layout = generate_get_option( 'blog_layout_setting' );
		}

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
		$widgets = generate_get_option( 'footer_widget_setting' );

		if ( is_singular() ) {
			$widgets_meta = get_post_meta( get_the_ID(), '_generate-footer-widget-meta', true );

			if ( $widgets_meta || '0' === $widgets_meta ) {
				$widgets = $widgets_meta;
			}
		}

		return apply_filters( 'generate_footer_widgets', $widgets );
	}
}

if ( ! function_exists( 'generate_show_excerpt' ) ) {
	/**
	 * Figure out if we should show the blog excerpts or full posts
	 * @since 1.3.15
	 */
	function generate_show_excerpt() {
		global $post;

		// Check to see if the more tag is being used.
		$more_tag = apply_filters( 'generate_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		$show_excerpt = ( 'excerpt' === generate_get_option( 'post_content' ) ) ? true : false;

		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;

		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		$show_excerpt = ( is_search() ) ? true : $show_excerpt;

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
	 * @param bool $trailing_slash Whether we want to include a trailing slash.
	 * @return string The URL to generatepress.com.
	 */
	function generate_get_premium_url( $url = 'https://generatepress.com/premium', $trailing_slash = true ) {
		if ( $trailing_slash ) {
			$url = trailingslashit( $url );
		}

		$args = apply_filters( 'generate_premium_url_args', array(
			'ref' => null,
			'campaign' => null,
		) );

		if ( isset( $args['ref'] ) ) {
			$url = add_query_arg( 'ref', absint( $args['ref'] ), $url );
		}

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
		return apply_filters( 'generate_navigation_location', generate_get_option( 'nav_position_setting' ) );
	}
}
