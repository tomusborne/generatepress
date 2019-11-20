<?php
/**
 * Navigation elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_navigation_position' ) ) {
	/**
	 * Build the navigation.
	 *
	 * @since 0.1
	 */
	function generate_navigation_position() {
		?>
		<nav id="site-navigation" <?php generate_do_element_classes( 'navigation' ); ?> <?php generate_do_microdata( 'navigation' ); ?>>
			<div <?php generate_do_element_classes( 'inside_navigation' ); ?>>
				<?php
				/**
				 * generate_inside_navigation hook.
				 *
				 * @since 0.1
				 *
				 * @hooked generate_navigation_search - 10
				 * @hooked generate_mobile_menu_search_icon - 10
				 */
				do_action( 'generate_inside_navigation' );
				?>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<?php
					/**
					 * generate_inside_mobile_menu hook.
					 *
					 * @since 0.1
					 */
					do_action( 'generate_inside_mobile_menu' );

					generate_do_svg_icon( 'menu-bars', true );

					$mobile_menu_label = apply_filters( 'generate_mobile_menu_label', __( 'Menu', 'generatepress' ) );

					if ( $mobile_menu_label ) {
						printf(
							'<span class="mobile-menu">%s</span>',
							$mobile_menu_label
						);
					} else {
						printf(
							'<span class="screen-reader-text">%s</span>',
							__( 'Menu', 'generatepress' )
						);
					}
					?>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container' => 'div',
						'container_class' => 'main-nav',
						'container_id' => 'primary-menu',
						'menu_class' => '',
						'fallback_cb' => 'generate_menu_fallback',
						'items_wrap' => '<ul id="%1$s" class="%2$s ' . join( ' ', generate_get_element_classes( 'menu' ) ) . '">%3$s</ul>',
					)
				);

				/**
				 * generate_after_primary_menu hook.
				 *
				 * @since 2.3
				 */
				do_action( 'generate_after_primary_menu' );
				?>
			</div><!-- .inside-navigation -->
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'generate_menu_fallback' ) ) {
	/**
	 * Menu fallback.
	 *
	 * @since 1.1.4
	 *
	 * @param  array $args
	 * @return string
	 */
	function generate_menu_fallback( $args ) {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);
		?>
		<div id="primary-menu" class="main-nav">
			<ul <?php generate_do_element_classes( 'menu' ); ?>>
				<?php
				$args = array(
					'sort_column' => 'menu_order',
					'title_li' => '',
					'walker' => new Generate_Page_Walker(),
				);

				wp_list_pages( $args );

				if ( 'enable' === $generate_settings['nav_search'] ) {
					printf(
						'<li class="search-item"><a aria-label="%1$s" href="#">%2$s</a></li>',
						esc_attr__( 'Open Search Bar', 'generatepress' ),
						generate_get_svg_icon( 'search', true )
					);
				}
				?>
			</ul>
		</div><!-- .main-nav -->
		<?php
	}
}

/**
 * Generate the navigation based on settings
 *
 * It would be better to have all of these inside one action, but these
 * are kept this way to maintain backward compatibility for people
 * un-hooking and moving the navigation/changing the priority.
 *
 * @since 0.1
 */

if ( ! function_exists( 'generate_add_navigation_after_header' ) ) {
	add_action( 'generate_after_header', 'generate_add_navigation_after_header', 5 );
	function generate_add_navigation_after_header() {
		if ( 'nav-below-header' == generate_get_navigation_location() ) {
			generate_navigation_position();
		}
	}
}

if ( ! function_exists( 'generate_add_navigation_before_header' ) ) {
	add_action( 'generate_before_header', 'generate_add_navigation_before_header', 5 );
	function generate_add_navigation_before_header() {
		if ( 'nav-above-header' == generate_get_navigation_location() ) {
			generate_navigation_position();
		}
	}
}

if ( ! function_exists( 'generate_add_navigation_float_right' ) ) {
	add_action( 'generate_after_header_content', 'generate_add_navigation_float_right', 5 );
	function generate_add_navigation_float_right() {
		if ( 'nav-float-right' == generate_get_navigation_location() || 'nav-float-left' == generate_get_navigation_location() ) {
			generate_navigation_position();
		}
	}
}

if ( ! function_exists( 'generate_add_navigation_before_right_sidebar' ) ) {
	add_action( 'generate_before_right_sidebar_content', 'generate_add_navigation_before_right_sidebar', 5 );
	function generate_add_navigation_before_right_sidebar() {
		if ( 'nav-right-sidebar' == generate_get_navigation_location() ) {
			echo '<div class="gen-sidebar-nav">';
				generate_navigation_position();
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'generate_add_navigation_before_left_sidebar' ) ) {
	add_action( 'generate_before_left_sidebar_content', 'generate_add_navigation_before_left_sidebar', 5 );
	function generate_add_navigation_before_left_sidebar() {
		if ( 'nav-left-sidebar' == generate_get_navigation_location() ) {
			echo '<div class="gen-sidebar-nav">';
				generate_navigation_position();
			echo '</div>';
		}
	}
}

if ( ! class_exists( 'Generate_Page_Walker' ) && class_exists( 'Walker_Page' ) ) {
	/**
	 * Add current-menu-item to the current item if no theme location is set
	 * This means we don't have to duplicate CSS properties for current_page_item and current-menu-item
	 *
	 * @since 1.3.21
	 */
	class Generate_Page_Walker extends Walker_Page {
		function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
			$css_class = array( 'page_item', 'page-item-' . $page->ID );
			$button = '';

			if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
				$css_class[] = 'menu-item-has-children';
				$icon = generate_get_svg_icon( 'arrow' );
				$button = '<span role="presentation" class="dropdown-menu-toggle">' . $icon . '</span>';
			}

			if ( ! empty( $current_page ) ) {
				$_current_page = get_post( $current_page );
				if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
					$css_class[] = 'current-menu-ancestor';
				}
				if ( $page->ID == $current_page ) {
					$css_class[] = 'current-menu-item';
				} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
					$css_class[] = 'current-menu-parent';
				}
			} elseif ( $page->ID == get_option( 'page_for_posts' ) ) {
				$css_class[] = 'current-menu-parent';
			}

			$css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

			$args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
			$args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];

			$output .= sprintf(
				'<li class="%s"><a href="%s">%s%s%s%s</a>',
				$css_classes,
				get_permalink( $page->ID ),
				$args['link_before'],
				apply_filters( 'the_title', $page->post_title, $page->ID ),
				$args['link_after'],
				$button
			);
		}
	}
}

if ( ! function_exists( 'generate_dropdown_icon_to_menu_link' ) ) {
	add_filter( 'nav_menu_item_title', 'generate_dropdown_icon_to_menu_link', 10, 4 );
	/**
	 * Add dropdown icon if menu item has children.
	 *
	 * @since 1.3.42
	 *
	 * @param string $title The menu item title.
	 * @param WP_Post $item All of our menu item data.
	 * @param stdClass $args All of our menu item args.
	 * @param int $dept Depth of menu item.
	 * @return string The menu item.
	 */
	function generate_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
		$role = 'presentation';
		$tabindex = '';

		if ( 'click-arrow' === generate_get_option( 'nav_dropdown_type' ) ) {
			$role = 'button';
			$tabindex = ' tabindex="0"';
		}

		if ( isset( $args->container_class ) && 'main-nav' === $args->container_class ) {
			foreach ( $item->classes as $value ) {
				if ( 'menu-item-has-children' === $value ) {
					$icon = generate_get_svg_icon( 'arrow' );
					$title = $title . '<span role="' . $role . '" class="dropdown-menu-toggle"' . $tabindex . '>' . $icon . '</span>';
				}
			}
		}

		return $title;
	}
}

if ( ! function_exists( 'generate_navigation_search' ) ) {
	add_action( 'generate_inside_navigation', 'generate_navigation_search' );
	/**
	 * Add the search bar to the navigation.
	 *
	 * @since 1.1.4
	 */
	function generate_navigation_search() {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		if ( 'enable' !== $generate_settings['nav_search'] ) {
			return;
		}

		echo apply_filters( 'generate_navigation_search_output', sprintf( // WPCS: XSS ok, sanitization ok.
			'<form method="get" class="search-form navigation-search" action="%1$s">
				<input type="search" class="search-field" value="%2$s" name="s" title="%3$s" />
			</form>',
			esc_url( home_url( '/' ) ),
			esc_attr( get_search_query() ),
			esc_attr_x( 'Search', 'label', 'generatepress' )
		));
	}
}

if ( ! function_exists( 'generate_menu_search_icon' ) ) {
	add_filter( 'wp_nav_menu_items', 'generate_menu_search_icon', 10, 2 );
	/**
	 * Add search icon to primary menu if set
	 *
	 * @since 1.2.9.7
	 *
	 * @param string $nav The HTML list content for the menu items.
	 * @param stdClass $args An object containing wp_nav_menu() arguments.
	 * @return string The search icon menu item.
	 */
	function generate_menu_search_icon( $nav, $args ) {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// If the search icon isn't enabled, return the regular nav.
		if ( 'enable' !== $generate_settings['nav_search'] ) {
			return $nav;
		}

		// If our primary menu is set, add the search icon.
		if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
			return sprintf(
				'%1$s<li class="search-item"><a aria-label="%2$s" href="#">%3$s</a></li>',
				$nav,
				esc_attr__( 'Open Search Bar', 'generatepress' ),
				generate_get_svg_icon( 'search', true )
			);
		}

		// Our primary menu isn't set, return the regular nav.
		// In this case, the search icon is added to the generate_menu_fallback() function in navigation.php.
		return $nav;
	}
}

if ( ! function_exists( 'generate_mobile_menu_search_icon' ) ) {
	add_action( 'generate_inside_navigation', 'generate_mobile_menu_search_icon' );
	/**
	 * Add search icon to mobile menu bar
	 *
	 * @since 1.3.12
	 */
	function generate_mobile_menu_search_icon() {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// If the search icon isn't enabled, return the regular nav.
		if ( 'enable' !== $generate_settings['nav_search'] ) {
			return;
		}

		?>
		<div class="mobile-bar-items">
			<?php do_action( 'generate_inside_mobile_menu_bar' ); ?>
			<span class="search-item">
				<a aria-label="<?php _e( 'Open Search Bar', 'generatepress' ); ?>" href="#">
					<?php generate_do_svg_icon( 'search', true ); ?>
				</a>
			</span>
		</div><!-- .mobile-bar-items -->
		<?php
	}
}

add_action( 'wp_footer', 'generate_clone_sidebar_navigation' );
/**
 * Clone our sidebar navigation and place it below the header.
 * This places our mobile menu in a more user-friendly location.
 *
 * We're not using wp_add_inline_script() as this needs to happens
 * before menu.js is enqueued.
 *
 * @since 2.0
 */
function generate_clone_sidebar_navigation() {
	if ( 'nav-left-sidebar' !== generate_get_navigation_location() && 'nav-right-sidebar' !== generate_get_navigation_location() ) {
		return;
	}
	?>
	<script>
		var target, nav, clone;
		nav = document.getElementById( 'site-navigation' );
		if ( nav ) {
			clone = nav.cloneNode( true );
			clone.className += ' sidebar-nav-mobile';
			clone.setAttribute( 'aria-label', '<?php esc_attr_e( 'Mobile Menu', 'generatepress' ); ?>' );
			target = document.getElementById( 'masthead' );
			if ( target ) {
				target.insertAdjacentHTML( 'afterend', clone.outerHTML );
			} else {
				document.body.insertAdjacentHTML( 'afterbegin', clone.outerHTML )
			}
		}
	</script>
	<?php
}
