<?php
/**
 * Adds HTML markup.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Display HTML classes for an element.
 *
 * @since 2.2
 *
 * @param string $context The element we're targeting.
 * @param string|array $class One or more classes to add to the class list.
 */
function generate_do_element_classes( $context, $class = '' ) {
	echo 'class="' . join( ' ', generate_get_element_classes( $context, $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
}

/**
 * Retrieve HTML classes for an element.
 *
 * @since 2.2
 *
 * @param string $context The element we're targeting.
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function generate_get_element_classes( $context, $class = '' ) {
	$classes = array();

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}

		$classes = array_merge( $classes, $class );
	}

	$classes = array_map( 'esc_attr', $classes );

	return apply_filters( "generate_{$context}_class", $classes, $class );
}

if ( ! function_exists( 'generate_body_classes' ) ) {
	add_filter( 'body_class', 'generate_body_classes' );
	/**
	 * Adds custom classes to the array of body classes.
	 * @since 0.1
	 */
	function generate_body_classes( $classes ) {
		// Get Customizer settings
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// Get the layout
		$layout = generate_get_layout();

		// Get the navigation location
		$navigation_location = generate_get_navigation_location();

		// Get the footer widgets
		$widgets = generate_get_footer_widgets();

		// Full width content
		// Used for page builders, sets the content to full width and removes the padding
		$full_width = get_post_meta( get_the_ID(), '_generate-full-width-content', true );
		$classes[] = ( '' !== $full_width && false !== $full_width && is_singular() && 'true' == $full_width ) ? 'full-width-content' : '';

		// Contained content
		// Used for page builders, basically just removes the content padding
		$classes[] = ( '' !== $full_width && false !== $full_width && is_singular() && 'contained' == $full_width ) ? 'contained-content' : '';

		// Let us know if a featured image is being used
		if ( has_post_thumbnail() ) {
			$classes[] = 'featured-image-active';
		}

		// Layout classes
		$classes[] = ( $layout ) ? $layout : 'right-sidebar';
		$classes[] = ( $navigation_location ) ? $navigation_location : 'nav-below-header';
		$classes[] = ( $generate_settings['header_layout_setting'] ) ? $generate_settings['header_layout_setting'] : 'fluid-header';
		$classes[] = ( $generate_settings['content_layout_setting'] ) ? $generate_settings['content_layout_setting'] : 'separate-containers';
		$classes[] = ( '' !== $widgets ) ? 'active-footer-widgets-' . $widgets : 'active-footer-widgets-3';
		$classes[] = ( 'enable' == $generate_settings['nav_search'] ) ? 'nav-search-enabled' : '';

		// Only necessary for nav before or after header.
		if ( 'nav-below-header' === $navigation_location || 'nav-above-header' === $navigation_location ) {
			if ( 'center' === generate_get_option( 'nav_alignment_setting' ) ) {
				$classes[] = 'nav-aligned-center';
			} elseif ( 'right' === generate_get_option( 'nav_alignment_setting' ) ) {
				$classes[] = 'nav-aligned-right';
			} elseif ( 'left' === generate_get_option( 'nav_alignment_setting' ) ) {
				$classes[] = 'nav-aligned-left';
			}
		}

		if ( 'center' === generate_get_option( 'header_alignment_setting' ) ) {
			$classes[] = 'header-aligned-center';
		} elseif ( 'right' === generate_get_option( 'header_alignment_setting' ) ) {
			$classes[] = 'header-aligned-right';
		} elseif ( 'left' === generate_get_option( 'header_alignment_setting' ) ) {
			$classes[] = 'header-aligned-left';
		}

		// Navigation dropdown type
		if ( 'click' == $generate_settings['nav_dropdown_type'] ) {
			$classes[] = 'dropdown-click';
			$classes[] = 'dropdown-click-menu-item';
		} elseif ( 'click-arrow' == $generate_settings['nav_dropdown_type'] ) {
			$classes[] = 'dropdown-click-arrow';
			$classes[] = 'dropdown-click';
		} else {
			$classes[] = 'dropdown-hover';
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_top_bar_classes' ) ) {
	add_filter( 'generate_top_bar_class', 'generate_top_bar_classes' );
	/**
	 * Adds custom classes to the header.
	 *
	 * @since 0.1
	 */
	function generate_top_bar_classes( $classes ) {
		$classes[] = 'top-bar';

		if ( 'contained' === generate_get_option( 'top_bar_width' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		$classes[] = 'top-bar-align-' . esc_attr( generate_get_option( 'top_bar_alignment' ) );

		return $classes;
	}
}

if ( ! function_exists( 'generate_right_sidebar_classes' ) ) {
	add_filter( 'generate_right_sidebar_class', 'generate_right_sidebar_classes' );
	/**
	 * Adds custom classes to the right sidebar.
	 *
	 * @since 0.1
	 */
	function generate_right_sidebar_classes( $classes ) {
		$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
		$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );

		$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
		$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );

		$classes[] = 'widget-area';
		$classes[] = 'grid-' . $right_sidebar_width;
		$classes[] = 'tablet-grid-' . $right_sidebar_tablet_width;
		$classes[] = 'grid-parent';
		$classes[] = 'sidebar';

		// Get the layout
		$layout = generate_get_layout();

		if ( '' !== $layout ) {
			switch ( $layout ) {
				case 'both-left' :
					$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;
					$classes[] = 'pull-' . ( 100 - $total_sidebar_width );

					$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;
					$classes[] = 'tablet-pull-' . ( 100 - $total_sidebar_tablet_width );
				break;
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_left_sidebar_classes' ) ) {
	add_filter( 'generate_left_sidebar_class', 'generate_left_sidebar_classes' );
	/**
	 * Adds custom classes to the left sidebar.
	 *
	 * @since 0.1
	 */
	function generate_left_sidebar_classes( $classes ) {
		$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
		$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
		$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;

		$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
		$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
		$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;

		$classes[] = 'widget-area';
		$classes[] = 'grid-' . $left_sidebar_width;
		$classes[] = 'tablet-grid-' . $left_sidebar_tablet_width;
		$classes[] = 'mobile-grid-100';
		$classes[] = 'grid-parent';
		$classes[] = 'sidebar';

		// Get the layout
		$layout = generate_get_layout();

		if ( '' !== $layout ) {
			switch ( $layout ) {
				case 'left-sidebar' :
					$classes[] = 'pull-' . ( 100 - $left_sidebar_width );
					$classes[] = 'tablet-pull-' . ( 100 - $left_sidebar_tablet_width );
				break;

				case 'both-sidebars' :
				case 'both-left' :
					$classes[] = 'pull-' . ( 100 - $total_sidebar_width );
					$classes[] = 'tablet-pull-' . ( 100 - $total_sidebar_tablet_width );
				break;
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_content_classes' ) ) {
	add_filter( 'generate_content_class', 'generate_content_classes' );
	/**
	 * Adds custom classes to the content container.
	 *
	 * @since 0.1
	 */
	function generate_content_classes( $classes ) {
		$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
		$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
		$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;

		$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
		$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
		$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;

		$classes[] = 'content-area';
		$classes[] = 'grid-parent';
		$classes[] = 'mobile-grid-100';

		// Get the layout
		$layout = generate_get_layout();

		if ( '' !== $layout ) {
			switch ( $layout ) {

				case 'right-sidebar' :
					$classes[] = 'grid-' . ( 100 - $right_sidebar_width );
					$classes[] = 'tablet-grid-' . ( 100 - $right_sidebar_tablet_width );
				break;

				case 'left-sidebar' :
					$classes[] = 'push-' . $left_sidebar_width;
					$classes[] = 'grid-' . ( 100 - $left_sidebar_width );
					$classes[] = 'tablet-push-' . $left_sidebar_tablet_width;
					$classes[] = 'tablet-grid-' . ( 100 - $left_sidebar_tablet_width );
				break;

				case 'no-sidebar' :
					$classes[] = 'grid-100';
					$classes[] = 'tablet-grid-100';
				break;

				case 'both-sidebars' :
					$classes[] = 'push-' . $left_sidebar_width;
					$classes[] = 'grid-' . ( 100 - $total_sidebar_width );
					$classes[] = 'tablet-push-' . $left_sidebar_tablet_width;
					$classes[] = 'tablet-grid-' . ( 100 - $total_sidebar_tablet_width );
				break;

				case 'both-right' :
					$classes[] = 'grid-' . ( 100 - $total_sidebar_width );
					$classes[] = 'tablet-grid-' . ( 100 - $total_sidebar_tablet_width );
				break;

				case 'both-left' :
					$classes[] = 'push-' . $total_sidebar_width;
					$classes[] = 'grid-' . ( 100 - $total_sidebar_width );
					$classes[] = 'tablet-push-' . $total_sidebar_tablet_width;
					$classes[] = 'tablet-grid-' . ( 100 - $total_sidebar_tablet_width );
				break;
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_header_classes' ) ) {
	add_filter( 'generate_header_class', 'generate_header_classes' );
	/**
	 * Adds custom classes to the header.
	 *
	 * @since 0.1
	 */
	function generate_header_classes( $classes ) {
		$classes[] = 'site-header';

		if ( 'contained-header' === generate_get_option( 'header_layout_setting' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_inside_header_classes' ) ) {
	add_filter( 'generate_inside_header_class', 'generate_inside_header_classes' );
	/**
	 * Adds custom classes to inside the header.
	 *
	 * @since 0.1
	 */
	function generate_inside_header_classes( $classes ) {
		$classes[] = 'inside-header';

		if ( 'full-width' !== generate_get_option( 'header_inner_width' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_navigation_classes' ) ) {
	add_filter( 'generate_navigation_class', 'generate_navigation_classes' );
	/**
	 * Adds custom classes to the navigation.
	 *
	 * @since 0.1
	 */
	function generate_navigation_classes( $classes ) {
		$classes[] = 'main-navigation';

		if ( 'contained-nav' === generate_get_option( 'nav_layout_setting' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		if ( 'left' === generate_get_option( 'nav_dropdown_direction' ) ) {
			$nav_layout = generate_get_option( 'nav_position_setting' );

			switch ( $nav_layout ) {
				case 'nav-below-header':
				case 'nav-above-header':
				case 'nav-float-right':
				case 'nav-float-left':
					$classes[] = 'sub-menu-left';
				break;
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_inside_navigation_classes' ) ) {
	add_filter( 'generate_inside_navigation_class', 'generate_inside_navigation_classes' );
	/**
	 * Adds custom classes to the inner navigation.
	 *
	 * @since 1.3.41
	 */
	function generate_inside_navigation_classes( $classes ) {
		$classes[] = 'inside-navigation';

		if ( 'full-width' !== generate_get_option( 'nav_inner_width' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_menu_classes' ) ) {
	add_filter( 'generate_menu_class', 'generate_menu_classes' );
	/**
	 * Adds custom classes to the menu.
	 *
	 * @since 0.1
	 */
	function generate_menu_classes( $classes ) {
		$classes[] = 'menu';
		$classes[] = 'sf-menu';

		return $classes;
	}
}

if ( ! function_exists( 'generate_footer_classes' ) ) {
	add_filter( 'generate_footer_class', 'generate_footer_classes' );
	/**
	 * Adds custom classes to the footer.
	 *
	 * @since 0.1
	 */
	function generate_footer_classes( $classes ) {
		$classes[] = 'site-footer';

		if ( 'contained-footer' === generate_get_option( 'footer_layout_setting' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		$classes[] = ( is_active_sidebar( 'footer-bar' ) ) ? 'footer-bar-active' : '';
		$classes[] = ( is_active_sidebar( 'footer-bar' ) ) ? 'footer-bar-align-' . esc_attr( generate_get_option( 'footer_bar_alignment' ) ) : '';

		return $classes;
	}
}

if ( ! function_exists( 'generate_inside_footer_classes' ) ) {
	add_filter( 'generate_inside_footer_class', 'generate_inside_footer_classes' );
	/**
	 * Adds custom classes to the footer.
	 *
	 * @since 0.1
	 */
	function generate_inside_footer_classes( $classes ) {
		$classes[] = 'footer-widgets-container';

		if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) {
			$classes[] = 'grid-container';
			$classes[] = 'grid-parent';
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_main_classes' ) ) {
	add_filter( 'generate_main_class', 'generate_main_classes' );
	/**
	 * Adds custom classes to the <main> element
	 * @since 1.1.0
	 */
	function generate_main_classes( $classes ) {
		$classes[] = 'site-main';

		return $classes;
	}
}

if ( ! function_exists( 'generate_post_classes' ) ) {
	add_filter( 'post_class', 'generate_post_classes' );
	/**
	 * Adds custom classes to the <article> element.
	 * Remove .hentry class from pages to comply with structural data guidelines.
	 *
	 * @since 1.3.39
	 */
	function generate_post_classes( $classes ) {
		if ( 'page' == get_post_type() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}

		return $classes;
	}
}
