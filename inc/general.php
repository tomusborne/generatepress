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
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$dir_uri = get_template_directory_uri();

		wp_enqueue_style( 'generate-style-grid', $dir_uri . "/css/unsemantic-grid{$suffix}.css", false, GENERATE_VERSION, 'all' );
		wp_enqueue_style( 'generate-style', $dir_uri . "/style{$suffix}.css", array( 'generate-style-grid' ), GENERATE_VERSION, 'all' );
		wp_enqueue_style( 'generate-mobile-style', $dir_uri . "/css/mobile{$suffix}.css", array( 'generate-style' ), GENERATE_VERSION, 'all' );

		if ( is_child_theme() ) {
			wp_enqueue_style( 'generate-child', get_stylesheet_uri(), array( 'generate-style' ), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
		}

		if ( ! apply_filters( 'generate_fontawesome_essentials', false ) ) {
			wp_enqueue_style( 'font-awesome', $dir_uri . "/css/font-awesome{$suffix}.css", false, '4.7', 'all' );
		}

		if ( function_exists( 'wp_script_add_data' ) ) {
			wp_enqueue_script( 'generate-classlist', $dir_uri . "/js/classList{$suffix}.js", array(), GENERATE_VERSION, true );
			wp_script_add_data( 'generate-classlist', 'conditional', 'lte IE 11' );
		}

		wp_enqueue_script( 'generate-menu', $dir_uri . "/js/menu{$suffix}.js", array(), GENERATE_VERSION, true );
		wp_enqueue_script( 'generate-a11y', $dir_uri . "/js/a11y{$suffix}.js", array(), GENERATE_VERSION, true );

		if ( 'click' == $generate_settings['nav_dropdown_type'] || 'click-arrow' == $generate_settings['nav_dropdown_type'] ) {
			wp_enqueue_script( 'generate-dropdown-click', $dir_uri . "/js/dropdown-click{$suffix}.js", array( 'generate-menu' ), GENERATE_VERSION, true );
		}

		if ( 'enable' == $generate_settings['nav_search'] ) {
			wp_enqueue_script( 'generate-navigation-search', $dir_uri . "/js/navigation-search{$suffix}.js", array( 'generate-menu' ), GENERATE_VERSION, true );
		}

		if ( 'enable' == $generate_settings['back_to_top'] ) {
			wp_enqueue_script( 'generate-back-to-top', $dir_uri . "/js/back-to-top{$suffix}.js", array(), GENERATE_VERSION, true );
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
			'footer-bar' => __( 'Footer Bar','generatepress' ),
			'top-bar' => __( 'Top Bar','generatepress' ),
		);

		foreach ( $widgets as $id => $name ) {
			register_sidebar( array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => apply_filters( 'generate_start_widget_title', '<h2 class="widget-title">' ),
				'after_title'   => apply_filters( 'generate_end_widget_title', '</h2>' ),
			) );
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

		$container_width = generate_get_setting( 'container_width' );
		$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
		$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
		$layout = generate_get_layout();

		if ( 'left-sidebar' == $layout ) {
			$content_width = $container_width * ( ( 100 - $left_sidebar_width ) / 100 );
		} elseif ( 'right-sidebar' == $layout ) {
			$content_width = $container_width * ( ( 100 - $right_sidebar_width ) / 100 );
		} elseif ( 'no-sidebar' == $layout ) {
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
	 * @return bool Whether to display the content title.
	 */
	function generate_disable_title() {
		global $post;

		$disable_headline = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-disable-headline', true ) : '';

		if ( ! empty( $disable_headline ) && false !== $disable_headline ) {
			return false;
		}

		return true;
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
		if ( wp_style_is( 'generate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
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
	 * @param int $width Default WP .wp-caption width (image width + 10px)
	 * @return int Updated width to remove 10px padding
	 */
	function generate_remove_caption_padding( $width ) {
		return $width - 10;
	}
}

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) {
	add_filter( 'attachment_link', 'generate_enhanced_image_navigation', 10, 2 );
	/**
	 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
	 */
	function generate_enhanced_image_navigation( $url, $id ) {
		if ( ! is_attachment() && ! wp_attachment_is_image( $id ) ) {
			return $url;
		}

		$image = get_post( $id );
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
		if ( false === ( $all_the_cool_cats = get_transient( 'generate_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

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
	add_action( 'save_post',     'generate_category_transient_flusher' );
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
 * @param bool $essentials
 * @return bool
 */
function generate_set_font_awesome_essentials( $essentials ) {
	if ( generate_get_setting( 'font_awesome_essentials' ) ) {
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
 * @param bool $cache
 * @return bool
 */
function generate_skip_dynamic_css_cache( $cache ) {
	if ( ! generate_get_setting( 'dynamic_css_cache' ) ) {
		return true;
	}

	return $cache;
}
