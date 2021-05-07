<?php
/**
 * Adds HTML markup.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_body_classes' ) ) {
	add_filter( 'body_class', 'generate_body_classes' );
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_body_classes( $classes ) {
		$sidebar_layout       = generate_get_layout();
		$navigation_location  = generate_get_navigation_location();
		$navigation_alignment = generate_get_option( 'nav_alignment_setting' );
		$navigation_dropdown  = generate_get_option( 'nav_dropdown_type' );
		$header_alignment     = generate_get_option( 'header_alignment_setting' );
		$content_layout       = generate_get_option( 'content_layout_setting' );

		// These values all have defaults, but we like to be extra careful.
		$classes[] = ( $sidebar_layout ) ? $sidebar_layout : 'right-sidebar';
		$classes[] = ( $navigation_location ) ? $navigation_location : 'nav-below-header';
		$classes[] = ( $content_layout ) ? $content_layout : 'separate-containers';

		if ( ! generate_is_using_flexbox() ) {
			$footer_widgets = generate_get_footer_widgets();
			$header_layout  = generate_get_option( 'header_layout_setting' );

			$classes[] = ( $header_layout ) ? $header_layout : 'fluid-header';
			$classes[] = ( '' !== $footer_widgets ) ? 'active-footer-widgets-' . absint( $footer_widgets ) : 'active-footer-widgets-3';
		}

		if ( 'enable' === generate_get_option( 'nav_search' ) ) {
			$classes[] = 'nav-search-enabled';
		}

		// Only necessary for nav before or after header.
		if ( ! generate_is_using_flexbox() && 'nav-below-header' === $navigation_location || 'nav-above-header' === $navigation_location ) {
			if ( 'center' === $navigation_alignment ) {
				$classes[] = 'nav-aligned-center';
			} elseif ( 'right' === $navigation_alignment ) {
				$classes[] = 'nav-aligned-right';
			} elseif ( 'left' === $navigation_alignment ) {
				$classes[] = 'nav-aligned-left';
			}
		}

		if ( 'center' === $header_alignment ) {
			$classes[] = 'header-aligned-center';
		} elseif ( 'right' === $header_alignment ) {
			$classes[] = 'header-aligned-right';
		} elseif ( 'left' === $header_alignment ) {
			$classes[] = 'header-aligned-left';
		}

		if ( 'click' === $navigation_dropdown ) {
			$classes[] = 'dropdown-click';
			$classes[] = 'dropdown-click-menu-item';
		} elseif ( 'click-arrow' === $navigation_dropdown ) {
			$classes[] = 'dropdown-click-arrow';
			$classes[] = 'dropdown-click';
		} else {
			$classes[] = 'dropdown-hover';
		}

		if ( is_singular() ) {
			// Page builder container metabox option.
			// Used to be a single checkbox, hence the name/true value. Now it's a radio choice between full width and contained.
			$content_container = get_post_meta( get_the_ID(), '_generate-full-width-content', true );

			if ( $content_container ) {
				if ( 'true' === $content_container ) {
					$classes[] = 'full-width-content';
				}

				if ( 'contained' === $content_container ) {
					$classes[] = 'contained-content';
				}
			}

			if ( has_post_thumbnail() ) {
				$classes[] = 'featured-image-active';
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_top_bar_classes' ) ) {
	add_filter( 'generate_top_bar_class', 'generate_top_bar_classes' );
	/**
	 * Adds custom classes to the header.
	 *
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_top_bar_classes( $classes ) {
		$classes[] = 'top-bar';

		if ( 'contained' === generate_get_option( 'top_bar_width' ) ) {
			$classes[] = 'grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$classes[] = 'grid-parent';
			}
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
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_right_sidebar_classes( $classes ) {
		$classes[] = 'widget-area';
		$classes[] = 'sidebar';
		$classes[] = 'is-right-sidebar';

		if ( ! generate_is_using_flexbox() ) {
			$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
			$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );

			$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
			$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );

			$classes[] = 'grid-' . $right_sidebar_width;
			$classes[] = 'tablet-grid-' . $right_sidebar_tablet_width;
			$classes[] = 'grid-parent';

			// Get the layout.
			$layout = generate_get_layout();

			if ( '' !== $layout ) {
				switch ( $layout ) {
					case 'both-left':
						$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;
						$classes[] = 'pull-' . ( 100 - $total_sidebar_width );

						$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;
						$classes[] = 'tablet-pull-' . ( 100 - $total_sidebar_tablet_width );
						break;
				}
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
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_left_sidebar_classes( $classes ) {
		$classes[] = 'widget-area';
		$classes[] = 'sidebar';
		$classes[] = 'is-left-sidebar';

		if ( ! generate_is_using_flexbox() ) {
			$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
			$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
			$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;

			$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
			$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
			$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;

			$classes[] = 'grid-' . $left_sidebar_width;
			$classes[] = 'tablet-grid-' . $left_sidebar_tablet_width;
			$classes[] = 'mobile-grid-100';
			$classes[] = 'grid-parent';

			// Get the layout.
			$layout = generate_get_layout();

			if ( '' !== $layout ) {
				switch ( $layout ) {
					case 'left-sidebar':
						$classes[] = 'pull-' . ( 100 - $left_sidebar_width );
						$classes[] = 'tablet-pull-' . ( 100 - $left_sidebar_tablet_width );
						break;

					case 'both-sidebars':
					case 'both-left':
						$classes[] = 'pull-' . ( 100 - $total_sidebar_width );
						$classes[] = 'tablet-pull-' . ( 100 - $total_sidebar_tablet_width );
						break;
				}
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
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_content_classes( $classes ) {
		$classes[] = 'content-area';

		if ( ! generate_is_using_flexbox() ) {
			$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
			$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
			$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;

			$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
			$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
			$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;

			$classes[] = 'grid-parent';
			$classes[] = 'mobile-grid-100';

			// Get the layout.
			$layout = generate_get_layout();

			if ( '' !== $layout ) {
				switch ( $layout ) {

					case 'right-sidebar':
						$classes[] = 'grid-' . ( 100 - $right_sidebar_width );
						$classes[] = 'tablet-grid-' . ( 100 - $right_sidebar_tablet_width );
						break;

					case 'left-sidebar':
						$classes[] = 'push-' . $left_sidebar_width;
						$classes[] = 'grid-' . ( 100 - $left_sidebar_width );
						$classes[] = 'tablet-push-' . $left_sidebar_tablet_width;
						$classes[] = 'tablet-grid-' . ( 100 - $left_sidebar_tablet_width );
						break;

					case 'no-sidebar':
						$classes[] = 'grid-100';
						$classes[] = 'tablet-grid-100';
						break;

					case 'both-sidebars':
						$classes[] = 'push-' . $left_sidebar_width;
						$classes[] = 'grid-' . ( 100 - $total_sidebar_width );
						$classes[] = 'tablet-push-' . $left_sidebar_tablet_width;
						$classes[] = 'tablet-grid-' . ( 100 - $total_sidebar_tablet_width );
						break;

					case 'both-right':
						$classes[] = 'grid-' . ( 100 - $total_sidebar_width );
						$classes[] = 'tablet-grid-' . ( 100 - $total_sidebar_tablet_width );
						break;

					case 'both-left':
						$classes[] = 'push-' . $total_sidebar_width;
						$classes[] = 'grid-' . ( 100 - $total_sidebar_width );
						$classes[] = 'tablet-push-' . $total_sidebar_tablet_width;
						$classes[] = 'tablet-grid-' . ( 100 - $total_sidebar_tablet_width );
						break;
				}
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
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_header_classes( $classes ) {
		$classes[] = 'site-header';

		if ( 'contained-header' === generate_get_option( 'header_layout_setting' ) ) {
			$classes[] = 'grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$classes[] = 'grid-parent';
			}
		}

		if ( generate_has_inline_mobile_toggle() ) {
			$classes[] = 'has-inline-mobile-toggle';
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_inside_header_classes' ) ) {
	add_filter( 'generate_inside_header_class', 'generate_inside_header_classes' );
	/**
	 * Adds custom classes to inside the header.
	 *
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_inside_header_classes( $classes ) {
		$classes[] = 'inside-header';

		if ( 'full-width' !== generate_get_option( 'header_inner_width' ) ) {
			$classes[] = 'grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$classes[] = 'grid-parent';
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_navigation_classes' ) ) {
	add_filter( 'generate_navigation_class', 'generate_navigation_classes' );
	/**
	 * Adds custom classes to the navigation.
	 *
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_navigation_classes( $classes ) {
		$classes[] = 'main-navigation';

		if ( 'contained-nav' === generate_get_option( 'nav_layout_setting' ) ) {
			if ( generate_is_using_flexbox() ) {
				$navigation_location = generate_get_navigation_location();

				if ( 'nav-float-right' !== $navigation_location && 'nav-float-left' !== $navigation_location ) {
					$classes[] = 'grid-container';
				}
			} else {
				$classes[] = 'grid-container';
				$classes[] = 'grid-parent';
			}
		}

		if ( generate_is_using_flexbox() ) {
			$nav_alignment = generate_get_option( 'nav_alignment_setting' );

			if ( 'center' === $nav_alignment ) {
				$classes[] = 'nav-align-center';
			} elseif ( 'right' === $nav_alignment ) {
				$classes[] = 'nav-align-right';
			} elseif ( is_rtl() && 'left' === $nav_alignment ) {
				$classes[] = 'nav-align-left';
			}

			if ( generate_has_menu_bar_items() ) {
				$classes[] = 'has-menu-bar-items';
			}
		}

		$submenu_direction = 'right';

		if ( 'left' === generate_get_option( 'nav_dropdown_direction' ) ) {
			$submenu_direction = 'left';
		}

		if ( 'nav-left-sidebar' === generate_get_navigation_location() ) {
			$submenu_direction = 'right';

			if ( 'both-right' === generate_get_layout() ) {
				$submenu_direction = 'left';
			}
		}

		if ( 'nav-right-sidebar' === generate_get_navigation_location() ) {
			$submenu_direction = 'left';

			if ( 'both-left' === generate_get_layout() ) {
				$submenu_direction = 'right';
			}
		}

		$classes[] = 'sub-menu-' . $submenu_direction;

		return $classes;
	}
}

if ( ! function_exists( 'generate_inside_navigation_classes' ) ) {
	add_filter( 'generate_inside_navigation_class', 'generate_inside_navigation_classes' );
	/**
	 * Adds custom classes to the inner navigation.
	 *
	 * @param array $classes The existing classes.
	 * @since 1.3.41
	 */
	function generate_inside_navigation_classes( $classes ) {
		$classes[] = 'inside-navigation';

		if ( 'full-width' !== generate_get_option( 'nav_inner_width' ) ) {
			$classes[] = 'grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$classes[] = 'grid-parent';
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_menu_classes' ) ) {
	add_filter( 'generate_menu_class', 'generate_menu_classes' );
	/**
	 * Adds custom classes to the menu.
	 *
	 * @param array $classes The existing classes.
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
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_footer_classes( $classes ) {
		$classes[] = 'site-footer';

		if ( 'contained-footer' === generate_get_option( 'footer_layout_setting' ) ) {
			$classes[] = 'grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$classes[] = 'grid-parent';
			}
		}

		if ( is_active_sidebar( 'footer-bar' ) ) {
			$classes[] = 'footer-bar-active';
			$classes[] = 'footer-bar-align-' . esc_attr( generate_get_option( 'footer_bar_alignment' ) );
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_inside_footer_classes' ) ) {
	add_filter( 'generate_inside_footer_class', 'generate_inside_footer_classes' );
	/**
	 * Adds custom classes to the footer.
	 *
	 * @param array $classes The existing classes.
	 * @since 0.1
	 */
	function generate_inside_footer_classes( $classes ) {
		$classes[] = 'footer-widgets-container';

		if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) {
			$classes[] = 'grid-container';

			if ( ! generate_is_using_flexbox() ) {
				$classes[] = 'grid-parent';
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'generate_main_classes' ) ) {
	add_filter( 'generate_main_class', 'generate_main_classes' );
	/**
	 * Adds custom classes to the <main> element
	 *
	 * @param array $classes The existing classes.
	 * @since 1.1.0
	 */
	function generate_main_classes( $classes ) {
		$classes[] = 'site-main';

		return $classes;
	}
}

add_filter( 'generate_page_class', 'generate_do_page_container_classes' );
/**
 * Adds custom classes to the #page element
 *
 * @param array $classes The existing classes.
 * @since 3.0.0
 */
function generate_do_page_container_classes( $classes ) {
	$classes[] = 'site';
	$classes[] = 'grid-container';
	$classes[] = 'container';

	if ( generate_is_using_hatom() ) {
		$classes[] = 'hfeed';
	}

	if ( ! generate_is_using_flexbox() ) {
		$classes[] = 'grid-parent';
	}

	return $classes;
}

add_filter( 'generate_comment-author_class', 'generate_do_comment_author_classes' );
/**
 * Adds custom classes to the comment author element
 *
 * @param array $classes The existing classes.
 * @since 3.0.0
 */
function generate_do_comment_author_classes( $classes ) {
	$classes[] = 'comment-author';

	if ( generate_is_using_hatom() ) {
		$classes[] = 'vcard';
	}

	return $classes;
}

if ( ! function_exists( 'generate_post_classes' ) ) {
	add_filter( 'post_class', 'generate_post_classes' );
	/**
	 * Adds custom classes to the <article> element.
	 * Remove .hentry class from pages to comply with structural data guidelines.
	 *
	 * @param array $classes The existing classes.
	 * @since 1.3.39
	 */
	function generate_post_classes( $classes ) {
		if ( 'page' === get_post_type() || ! generate_is_using_hatom() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}

		return $classes;
	}
}
