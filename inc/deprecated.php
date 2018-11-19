<?php
/**
 * Where old functions retire.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Deprecated constants
define( 'GENERATE_URI', get_template_directory_uri() );
define( 'GENERATE_DIR', get_template_directory() );

if ( ! function_exists( 'generate_paging_nav' ) ) {
	/**
	 * Build the pagination links
	 * @since 1.3.35
	 * @deprecated 1.3.45
	 */
	function generate_paging_nav() {
		_deprecated_function( __FUNCTION__, '1.3.45', 'the_posts_navigation()' );
		if ( function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
				'prev_text' => __( '&larr; Previous', 'generatepress' ),
				'next_text' => __( 'Next &rarr;', 'generatepress' )
			) );
		}
	}
}

if ( ! function_exists( 'generate_additional_spacing' ) ) {
	/**
	 * Add fallback CSS for our mobile search icon color
	 * @deprecated 1.3.47
	 */
	function generate_additional_spacing() {
		// No longer needed
	}
}

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) {
	/**
	 * Enqueue our mobile search icon color fallback CSS
	 * @deprecated 1.3.47
	 */
	function generate_mobile_search_spacing_fallback_css() {
		// No longer needed
	}
}

if ( ! function_exists( 'generate_addons_available' ) ) {
	/**
	 * Check to see if there's any addons not already activated
	 * @since 1.0.9
	 * @deprecated 1.3.47
	 */
	function generate_addons_available() {
		if ( defined( 'GP_PREMIUM_VERSION' ) ) {
			return false;
		}
	}
}

if ( ! function_exists( 'generate_no_addons' ) ) {
	/**
	 * Check to see if no addons are activated
	 * @since 1.0.9
	 * @deprecated 1.3.47
	 */
	function generate_no_addons() {
		if ( defined( 'GP_PREMIUM_VERSION' ) ) {
			return false;
		}
	}
}

if ( ! function_exists( 'generate_get_min_suffix' ) ) {
	/**
	 * Figure out if we should use minified scripts or not
	 * @since 1.3.29
	 * @deprecated 2.0
	 */
	function generate_get_min_suffix() {
		return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}
}

if ( ! function_exists( 'generate_add_layout_meta_box' ) ) {
	function generate_add_layout_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_register_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_show_layout_meta_box' ) ) {
	function generate_show_layout_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_do_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_save_layout_meta' ) ) {
	function generate_save_layout_meta() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_save_layout_meta_data()' );
	}
}

if ( ! function_exists( 'generate_add_footer_widget_meta_box' ) ) {
	function generate_add_footer_widget_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_register_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_show_footer_widget_meta_box' ) ) {
	function generate_show_footer_widget_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_do_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_save_footer_widget_meta' ) ) {
	function generate_save_footer_widget_meta() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_save_layout_meta_data()' );
	}
}

if ( ! function_exists( 'generate_add_page_builder_meta_box' ) ) {
	function generate_add_page_builder_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_register_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_show_page_builder_meta_box' ) ) {
	function generate_show_page_builder_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_do_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_save_page_builder_meta' ) ) {
	function generate_save_page_builder_meta() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_save_layout_meta_data()' );
	}
}

if ( ! function_exists( 'generate_add_de_meta_box' ) ) {
	function generate_add_de_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_register_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_show_de_meta_box' ) ) {
	function generate_show_de_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_do_layout_meta_box()' );
	}
}

if ( ! function_exists( 'generate_save_de_meta' ) ) {
	function generate_save_de_meta() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_save_layout_meta_data()' );
	}
}

if ( ! function_exists( 'generate_add_base_inline_css' ) ) {
	function generate_add_base_inline_css() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_enqueue_dynamic_css()' );
	}
}

if ( ! function_exists( 'generate_color_scripts' ) ) {
	function generate_color_scripts() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_enqueue_dynamic_css()' );
	}
}

if ( ! function_exists( 'generate_typography_scripts' ) ) {
	function generate_typography_scripts() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_enqueue_dynamic_css()' );
	}
}

if ( ! function_exists( 'generate_spacing_scripts' ) ) {
	function generate_spacing_scripts() {
		_deprecated_function( __FUNCTION__, '2.0', 'generate_enqueue_dynamic_css()' );
	}
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
		return generate_get_option( $setting );
	}
}
if ( ! function_exists( 'generate_right_sidebar_class' ) ) {
	/**
	 * Display the classes for the sidebar.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_right_sidebar_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_right_sidebar_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_right_sidebar_class' ) ) {
	/**
	 * Retrieve the classes for the sidebar.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_right_sidebar_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_right_sidebar_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_left_sidebar_class' ) ) {
	/**
	 * Display the classes for the sidebar.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_left_sidebar_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_left_sidebar_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_left_sidebar_class' ) ) {
	/**
	 * Retrieve the classes for the sidebar.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_left_sidebar_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_left_sidebar_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_content_class' ) ) {
	/**
	 * Display the classes for the content.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_content_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_content_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_content_class' ) ) {
	/**
	 * Retrieve the classes for the content.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_content_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_content_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_header_class' ) ) {
	/**
	 * Display the classes for the header.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_header_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_header_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_header_class' ) ) {
	/**
	 * Retrieve the classes for the content.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_header_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_header_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_inside_header_class' ) ) {
	/**
	 * Display the classes for inside the header.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_inside_header_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_inside_header_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_inside_header_class' ) ) {
	/**
	 * Retrieve the classes for inside the header.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_inside_header_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_inside_header_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_container_class' ) ) {
	/**
	 * Display the classes for the container.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_container_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_container_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_container_class' ) ) {
	/**
	 * Retrieve the classes for the content.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_container_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_container_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_navigation_class' ) ) {
	/**
	 * Display the classes for the navigation.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_navigation_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_navigation_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_navigation_class' ) ) {
	/**
	 * Retrieve the classes for the navigation.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_navigation_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_navigation_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_inside_navigation_class' ) ) {
	/**
	 * Display the classes for the inner navigation.
	 *
	 * @since 1.3.41
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_inside_navigation_class( $class = '' ) {
		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		$return = apply_filters( 'generate_inside_navigation_class', $classes, $class );

		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', $return ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_menu_class' ) ) {
	/**
	 * Display the classes for the navigation.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_menu_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_menu_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_menu_class' ) ) {
	/**
	 * Retrieve the classes for the navigation.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_menu_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_menu_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_main_class' ) ) {
	/**
	 * Display the classes for the <main> container.
	 *
	 * @since 1.1.0
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_main_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_main_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_main_class' ) ) {
	/**
	 * Retrieve the classes for the footer.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_main_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_main_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_footer_class' ) ) {
	/**
	 * Display the classes for the footer.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_footer_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', generate_get_footer_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_get_footer_class' ) ) {
	/**
	 * Retrieve the classes for the footer.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function generate_get_footer_class( $class = '' ) {

		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'generate_footer_class', $classes, $class );
	}
}

if ( ! function_exists( 'generate_inside_footer_class' ) ) {
	/**
	 * Display the classes for the footer.
	 *
	 * @since 0.1
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_inside_footer_class( $class = '' ) {
		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		$return = apply_filters( 'generate_inside_footer_class', $classes, $class );

		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', $return ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_top_bar_class' ) ) {
	/**
	 * Display the classes for the top bar.
	 *
	 * @since 1.3.45
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function generate_top_bar_class( $class = '' ) {
		$classes = array();

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		}

		$classes = array_map( 'esc_attr', $classes );

		$return = apply_filters( 'generate_top_bar_class', $classes, $class );

		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', $return ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_body_schema' ) ) {
	/**
	 * Figure out which schema tags to apply to the <body> element.
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
		$result = esc_html( apply_filters( 'generate_body_itemtype', $itemtype ) );

		// Return our HTML
		echo "itemtype='https://schema.org/$result' itemscope='itemscope'"; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'generate_article_schema' ) ) {
	/**
	 * Figure out which schema tags to apply to the <article> element
	 * The function determines the itemtype: generate_article_schema( 'BlogPosting' )
	 * @since 1.3.15
	 */
	function generate_article_schema( $type = 'CreativeWork' ) {
		// Get the itemtype
		$itemtype = esc_html( apply_filters( 'generate_article_itemtype', $type ) );

		// Print the results
		echo "itemtype='https://schema.org/$itemtype' itemscope='itemscope'"; // WPCS: XSS ok, sanitization ok.
	}
}
