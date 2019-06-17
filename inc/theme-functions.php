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
	$defaults = generate_get_defaults();

	if ( ! isset( $defaults[ $option ] ) ) {
		return;
	}

	$options = wp_parse_args(
		get_option( 'generate_settings', array() ),
		$defaults
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

/**
 * Check if the logo and site branding are active.
 *
 * @since 2.3
 */
function generate_has_logo_site_branding() {
	if ( get_theme_mod( 'custom_logo' ) && ( ! generate_get_option( 'hide_title' ) || ! generate_get_option( 'hide_tagline' ) ) ) {
		return true;
	}

	return false;
}

/**
 * Create SVG icons.
 *
 * @since 2.3
 */
function generate_get_svg_icon( $icon, $replace = false ) {
	if ( 'svg' !== generate_get_option( 'icons' ) ) {
		return;
	}

	$output = '';

	if ( 'menu-bars' === $icon ) {
		$output = '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M0 96c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24z" />
					</svg>';
	}

	if ( 'close' === $icon ) {
		$output = '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z" />
					</svg>';
	}

	if ( 'search' === $icon ) {
		$output = '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M208 48c-88.366 0-160 71.634-160 160s71.634 160 160 160 160-71.634 160-160S296.366 48 208 48zM0 208C0 93.125 93.125 0 208 0s208 93.125 208 208c0 48.741-16.765 93.566-44.843 129.024l133.826 134.018c9.366 9.379 9.355 24.575-.025 33.941-9.379 9.366-24.575 9.355-33.941-.025L337.238 370.987C301.747 399.167 256.839 416 208 416 93.125 416 0 322.875 0 208z"/>
					</svg>';
	}

	if ( 'categories' === $icon ) {
		$output = '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M0 112c0-26.51 21.49-48 48-48h110.014a48 48 0 0 1 43.592 27.907l12.349 26.791A16 16 0 0 0 228.486 128H464c26.51 0 48 21.49 48 48v224c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V112z" fill-rule="nonzero"/>
					</svg>';
	}

	if ( 'tags' === $icon ) {
		$output = '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M20 39.5c-8.836 0-16 7.163-16 16v176c0 4.243 1.686 8.313 4.687 11.314l224 224c6.248 6.248 16.378 6.248 22.626 0l176-176c6.244-6.244 6.25-16.364.013-22.615l-223.5-224A15.999 15.999 0 0 0 196.5 39.5H20zm56 96c0-13.255 10.745-24 24-24s24 10.745 24 24-10.745 24-24 24-24-10.745-24-24z"/>
						<path d="M259.515 43.015c4.686-4.687 12.284-4.687 16.97 0l228 228c4.686 4.686 4.686 12.284 0 16.97l-180 180c-4.686 4.687-12.284 4.687-16.97 0-4.686-4.686-4.686-12.284 0-16.97L479.029 279.5 259.515 59.985c-4.686-4.686-4.686-12.284 0-16.97z" fill-rule="nonzero"/>
					</svg>';
	}

	if ( 'comments' === $icon ) {
		$output = '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M132.838 329.973a435.298 435.298 0 0 0 16.769-9.004c13.363-7.574 26.587-16.142 37.419-25.507 7.544.597 15.27.925 23.098.925 54.905 0 105.634-15.311 143.285-41.28 23.728-16.365 43.115-37.692 54.155-62.645 54.739 22.205 91.498 63.272 91.498 110.286 0 42.186-29.558 79.498-75.09 102.828 23.46 49.216 75.09 101.709 75.09 101.709s-115.837-38.35-154.424-78.46c-9.956 1.12-20.297 1.758-30.793 1.758-88.727 0-162.927-43.071-181.007-100.61z" fill-rule="nonzero"/>
						<path d="M383.371 132.502c0 70.603-82.961 127.787-185.216 127.787-10.496 0-20.837-.639-30.793-1.757-38.587 40.093-154.424 78.429-154.424 78.429s51.63-52.472 75.09-101.67c-45.532-23.321-75.09-60.619-75.09-102.79C12.938 61.9 95.9 4.716 198.155 4.716 300.41 4.715 383.37 61.9 383.37 132.502z" fill-rule="nonzero" />
					</svg>';
	}

	if ( 'arrow' === $icon ) {
		$output = '<svg viewBox="0 0 330 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M305.913 197.085c0 2.266-1.133 4.815-2.833 6.514L171.087 335.593c-1.7 1.7-4.249 2.832-6.515 2.832s-4.815-1.133-6.515-2.832L26.064 203.599c-1.7-1.7-2.832-4.248-2.832-6.514s1.132-4.816 2.832-6.515l14.162-14.163c1.7-1.699 3.966-2.832 6.515-2.832 2.266 0 4.815 1.133 6.515 2.832l111.316 111.317 111.316-111.317c1.7-1.699 4.249-2.832 6.515-2.832s4.815 1.133 6.515 2.832l14.162 14.163c1.7 1.7 2.833 4.249 2.833 6.515z" fill-rule="nonzero"/>
					</svg>';
	}

	if ( $replace ) {
		$output .= '<svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em" height="1em">
						<path d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z" />
					</svg>';
	}

	$classes = array(
		'gp-icon',
		'icon-' . $icon,
	);

	$output = sprintf(
		'<span class="%1$s">%2$s</span>',
		implode( ' ', $classes ),
		$output
	);

	return apply_filters( 'generate_svg_icon', $output, $icon );
}

/**
 * Out our icon HTML.
 *
 * @since 2.3
 *
 * @param string $icon
 * @param bool $replace Whether to include the close icon to be shown using JS.
 * @return string
 */
function generate_do_svg_icon( $icon, $replace = false ) {
	echo generate_get_svg_icon( $icon, $replace );
}
