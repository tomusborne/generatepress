<?php
/**
 * General functions.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'generate_scripts' );
	/**
	 * Enqueue scripts and styles
	 */
	function generate_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$dir_uri = get_template_directory_uri();

		if ( generate_is_using_flexbox() ) {
			// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison -- Intentionally loose.
			if ( is_singular() && ( comments_open() || '0' != get_comments_number() ) ) {
				wp_enqueue_style( 'generate-comments', $dir_uri . "/assets/css/components/comments{$suffix}.css", array(), GENERATE_VERSION, 'all' );
			}

			if (
				is_active_sidebar( 'top-bar' ) ||
				is_active_sidebar( 'footer-bar' ) ||
				is_active_sidebar( 'footer-1' ) ||
				is_active_sidebar( 'footer-2' ) ||
				is_active_sidebar( 'footer-3' ) ||
				is_active_sidebar( 'footer-4' ) ||
				is_active_sidebar( 'footer-5' )
			) {
				wp_enqueue_style( 'generate-widget-areas', $dir_uri . "/assets/css/components/widget-areas{$suffix}.css", array(), GENERATE_VERSION, 'all' );
			}

			wp_enqueue_style( 'generate-style', $dir_uri . "/assets/css/main{$suffix}.css", array(), GENERATE_VERSION, 'all' );
		} else {
			if ( generate_get_option( 'combine_css' ) && $suffix ) {
				wp_enqueue_style( 'generate-style', $dir_uri . "/assets/css/all{$suffix}.css", array(), GENERATE_VERSION, 'all' );
			} else {
				wp_enqueue_style( 'generate-style-grid', $dir_uri . "/assets/css/unsemantic-grid{$suffix}.css", false, GENERATE_VERSION, 'all' );
				wp_enqueue_style( 'generate-style', $dir_uri . "/assets/css/style{$suffix}.css", array(), GENERATE_VERSION, 'all' );
				wp_enqueue_style( 'generate-mobile-style', $dir_uri . "/assets/css/mobile{$suffix}.css", array(), GENERATE_VERSION, 'all' );
			}
		}

		if ( 'font' === generate_get_option( 'icons' ) ) {
			wp_enqueue_style( 'generate-font-icons', $dir_uri . "/assets/css/components/font-icons{$suffix}.css", array(), GENERATE_VERSION, 'all' );
		}

		if ( ! apply_filters( 'generate_fontawesome_essentials', false ) ) {
			wp_enqueue_style( 'font-awesome', $dir_uri . "/assets/css/components/font-awesome{$suffix}.css", false, '4.7', 'all' );
		}

		if ( is_rtl() ) {
			if ( generate_is_using_flexbox() ) {
				wp_enqueue_style( 'generate-rtl', $dir_uri . "/assets/css/main-rtl{$suffix}.css", array(), GENERATE_VERSION, 'all' );
			} else {
				wp_enqueue_style( 'generate-rtl', $dir_uri . "/assets/css/style-rtl{$suffix}.css", array(), GENERATE_VERSION, 'all' );
			}
		}

		if ( is_child_theme() && apply_filters( 'generate_load_child_theme_stylesheet', true ) ) {
			wp_enqueue_style( 'generate-child', get_stylesheet_uri(), array( 'generate-style' ), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
		}

		if ( function_exists( 'wp_script_add_data' ) ) {
			wp_enqueue_script( 'generate-classlist', $dir_uri . "/assets/js/classList{$suffix}.js", array(), GENERATE_VERSION, true );
			wp_script_add_data( 'generate-classlist', 'conditional', 'lte IE 11' );
		}

		if ( generate_has_active_menu() ) {
			wp_enqueue_script( 'generate-menu', $dir_uri . "/assets/js/menu{$suffix}.js", array(), GENERATE_VERSION, true );
		}

		wp_localize_script(
			'generate-menu',
			'generatepressMenu',
			apply_filters(
				'generate_localize_js_args',
				array(
					'toggleOpenedSubMenus' => true,
					'openSubMenuLabel' => esc_attr__( 'Open Sub-Menu', 'generatepress' ),
					'closeSubMenuLabel' => esc_attr__( 'Close Sub-Menu', 'generatepress' ),
				)
			)
		);

		if ( 'click' === generate_get_option( 'nav_dropdown_type' ) || 'click-arrow' === generate_get_option( 'nav_dropdown_type' ) ) {
			wp_enqueue_script( 'generate-dropdown-click', $dir_uri . "/assets/js/dropdown-click{$suffix}.js", array(), GENERATE_VERSION, true );
		}

		if ( 'enable' === generate_get_option( 'nav_search' ) ) {
			wp_enqueue_script( 'generate-navigation-search', $dir_uri . "/assets/js/navigation-search{$suffix}.js", array(), GENERATE_VERSION, true );

			wp_localize_script(
				'generate-navigation-search',
				'generatepressNavSearch',
				array(
					'open' => esc_attr__( 'Open Search Bar', 'generatepress' ),
					'close' => esc_attr__( 'Close Search Bar', 'generatepress' ),
				)
			);
		}

		if ( 'enable' === generate_get_option( 'back_to_top' ) ) {
			wp_enqueue_script( 'generate-back-to-top', $dir_uri . "/assets/js/back-to-top{$suffix}.js", array(), GENERATE_VERSION, true );

			wp_localize_script(
				'generate-back-to-top',
				'generatepressBackToTop',
				apply_filters(
					'generate_back_to_top_js_args',
					array(
						'smooth' => true,
					)
				)
			);
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

if ( ! function_exists( 'generate_widgets_init' ) ) {
	add_action( 'widgets_init', 'generate_widgets_init' );
	/**
	 * Register widgetized area and update sidebar with default widgets
	 */
	function generate_widgets_init() {
		$widgets = array(
			'sidebar-1' => __( 'Right Sidebar', 'generatepress' ),
			'sidebar-2' => __( 'Left Sidebar', 'generatepress' ),
			'header' => __( 'Header', 'generatepress' ),
			'footer-1' => __( 'Footer Widget 1', 'generatepress' ),
			'footer-2' => __( 'Footer Widget 2', 'generatepress' ),
			'footer-3' => __( 'Footer Widget 3', 'generatepress' ),
			'footer-4' => __( 'Footer Widget 4', 'generatepress' ),
			'footer-5' => __( 'Footer Widget 5', 'generatepress' ),
			'footer-bar' => __( 'Footer Bar', 'generatepress' ),
			'top-bar' => __( 'Top Bar', 'generatepress' ),
		);

		foreach ( $widgets as $id => $name ) {
			register_sidebar(
				array(
					'name'          => $name,
					'id'            => $id,
					'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => apply_filters( 'generate_start_widget_title', '<h2 class="widget-title">' ),
					'after_title'   => apply_filters( 'generate_end_widget_title', '</h2>' ),
				)
			);
		}
	}
}

if ( ! function_exists( 'generate_smart_content_width' ) ) {
	add_action( 'wp', 'generate_smart_content_width' );
	/**
	 * Set the $content_width depending on layout of current page
	 * Hook into "wp" so we have the correct layout setting from generate_get_layout()
	 * Hooking into "after_setup_theme" doesn't get the correct layout setting
	 */
	function generate_smart_content_width() {
		global $content_width;

		$container_width = generate_get_option( 'container_width' );
		$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
		$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
		$layout = generate_get_layout();

		if ( 'left-sidebar' === $layout ) {
			$content_width = $container_width * ( ( 100 - $left_sidebar_width ) / 100 );
		} elseif ( 'right-sidebar' === $layout ) {
			$content_width = $container_width * ( ( 100 - $right_sidebar_width ) / 100 );
		} elseif ( 'no-sidebar' === $layout ) {
			$content_width = $container_width;
		} else {
			$content_width = $container_width * ( ( 100 - ( $left_sidebar_width + $right_sidebar_width ) ) / 100 );
		}
	}
}

if ( ! function_exists( 'generate_page_menu_args' ) ) {
	add_filter( 'wp_page_menu_args', 'generate_page_menu_args' );
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 *
	 * @since 0.1
	 *
	 * @param array $args The existing menu args.
	 * @return array Menu args.
	 */
	function generate_page_menu_args( $args ) {
		$args['show_home'] = true;

		return $args;
	}
}

if ( ! function_exists( 'generate_disable_title' ) ) {
	add_filter( 'generate_show_title', 'generate_disable_title' );
	/**
	 * Remove our title if set.
	 *
	 * @since 1.3.18
	 *
	 * @param bool $title Whether the title is displayed or not.
	 * @return bool Whether to display the content title.
	 */
	function generate_disable_title( $title ) {
		if ( is_singular() ) {
			$disable_title = get_post_meta( get_the_ID(), '_generate-disable-headline', true );

			if ( $disable_title ) {
				$title = false;
			}
		}

		return $title;
	}
}

if ( ! function_exists( 'generate_resource_hints' ) ) {
	add_filter( 'wp_resource_hints', 'generate_resource_hints', 10, 2 );
	/**
	 * Add resource hints to our Google fonts call.
	 *
	 * @since 1.3.42
	 *
	 * @param array  $urls           URLs to print for resource hints.
	 * @param string $relation_type  The relation type the URLs are printed.
	 * @return array $urls           URLs to print for resource hints.
	 */
	function generate_resource_hints( $urls, $relation_type ) {
		$handle = generate_is_using_dynamic_typography() ? 'generate-google-fonts' : 'generate-fonts';

		if ( wp_style_is( $handle, 'queue' ) && 'preconnect' === $relation_type ) {
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
}

if ( ! function_exists( 'generate_remove_caption_padding' ) ) {
	add_filter( 'img_caption_shortcode_width', 'generate_remove_caption_padding' );
	/**
	 * Remove WordPress's default padding on images with captions
	 *
	 * @param int $width Default WP .wp-caption width (image width + 10px).
	 * @return int Updated width to remove 10px padding.
	 */
	function generate_remove_caption_padding( $width ) {
		return $width - 10;
	}
}

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) {
	add_filter( 'attachment_link', 'generate_enhanced_image_navigation', 10, 2 );
	/**
	 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages.
	 *
	 * @param string $url The input URL.
	 * @param int    $id The ID of the post.
	 */
	function generate_enhanced_image_navigation( $url, $id ) {
		if ( ! is_attachment() && ! wp_attachment_is_image( $id ) ) {
			return $url;
		}

		$image = get_post( $id );
		// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison -- Intentially loose.
		if ( ! empty( $image->post_parent ) && $image->post_parent != $id ) {
			$url .= '#main';
		}

		return $url;
	}
}

if ( ! function_exists( 'generate_categorized_blog' ) ) {
	/**
	 * Determine whether blog/site has more than one category.
	 *
	 * @since 1.2.5
	 *
	 * @return bool True of there is more than one category, false otherwise.
	 */
	function generate_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'generate_categories' ) ) ) { // phpcs:ignore
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,

					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'generate_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so twentyfifteen_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so twentyfifteen_categorized_blog should return false.
			return false;
		}
	}
}

if ( ! function_exists( 'generate_category_transient_flusher' ) ) {
	add_action( 'edit_category', 'generate_category_transient_flusher' );
	add_action( 'save_post', 'generate_category_transient_flusher' );
	/**
	 * Flush out the transients used in {@see generate_categorized_blog()}.
	 *
	 * @since 1.2.5
	 */
	function generate_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'generate_categories' );
	}
}

if ( ! function_exists( 'generate_get_default_color_palettes' ) ) {
	/**
	 * Set up our colors for the color picker palettes and filter them so you can change them.
	 *
	 * @since 1.3.42
	 */
	function generate_get_default_color_palettes() {
		$palettes = array(
			'#000000',
			'#FFFFFF',
			'#F1C40F',
			'#E74C3C',
			'#1ABC9C',
			'#1e72bd',
			'#8E44AD',
			'#00CC77',
		);

		return apply_filters( 'generate_default_color_palettes', $palettes );
	}
}

add_filter( 'generate_fontawesome_essentials', 'generate_set_font_awesome_essentials' );
/**
 * Check to see if we should include the full Font Awesome library or not.
 *
 * @since 2.0
 *
 * @param bool $essentials The existing value.
 * @return bool
 */
function generate_set_font_awesome_essentials( $essentials ) {
	if ( generate_get_option( 'font_awesome_essentials' ) ) {
		return true;
	}

	return $essentials;
}

add_filter( 'generate_dynamic_css_skip_cache', 'generate_skip_dynamic_css_cache' );
/**
 * Skips caching of the dynamic CSS if set to false.
 *
 * @since 2.0
 *
 * @param bool $cache The existing value.
 * @return bool
 */
function generate_skip_dynamic_css_cache( $cache ) {
	if ( ! generate_get_option( 'dynamic_css_cache' ) ) {
		return true;
	}

	return $cache;
}

add_filter( 'wp_headers', 'generate_set_wp_headers' );
/**
 * Set any necessary headers.
 *
 * @param array $headers The existing headers.
 *
 * @since 2.3
 */
function generate_set_wp_headers( $headers ) {
	$headers['X-UA-Compatible'] = 'IE=edge';

	return $headers;
}

add_filter( 'generate_after_element_class_attribute', 'generate_set_microdata_markup', 10, 2 );
/**
 * Adds microdata to elements.
 *
 * @since 3.0.0
 * @param string $output The existing output after the class attribute.
 * @param string $context What element we're targeting.
 */
function generate_set_microdata_markup( $output, $context ) {
	if ( 'left_sidebar' === $context || 'right_sidebar' === $context ) {
		$context = 'sidebar';
	}

	if ( 'footer' === $context ) {
		return $output;
	}

	if ( 'site-info' === $context ) {
		$context = 'footer';
	}

	$microdata = generate_get_microdata( $context );

	if ( $microdata ) {
		return $microdata;
	}

	return $output;
}

add_action( 'wp_footer', 'generate_do_a11y_scripts' );
/**
 * Enqueue scripts in the footer.
 *
 * @since 3.1.0
 */
function generate_do_a11y_scripts() {
	if ( apply_filters( 'generate_print_a11y_script', true ) ) {
		// Add our small a11y script inline.
		printf(
			'<script id="generate-a11y">%s</script>',
			'!function(){"use strict";if("querySelector"in document&&"addEventListener"in window){var e=document.body;e.addEventListener("mousedown",function(){e.classList.add("using-mouse")}),e.addEventListener("keydown",function(){e.classList.remove("using-mouse")})}}();'
		);
	}
}
