<?php
/**
 * All of our navigation elements.
 * These functions are wrapped in function_exists() so you can overwrite them.
 * 
 * @package GeneratePress
 */ 
 
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_navigation_position' ) ) :
/**
 * Build the navigation
 *
 * @since 0.1
 */
function generate_navigation_position() {
	?>
	<nav <?php generate_do_attr( 'navigation' ); ?>>
		<div <?php generate_do_attr( 'inside-navigation' ); ?>>
			<?php do_action( 'generate_inside_navigation' ); ?>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<?php do_action( 'generate_inside_mobile_menu' ); ?>
				<span class="mobile-menu"><?php echo apply_filters('generate_mobile_menu_label', __( 'Menu', 'generatepress' ) ); ?></span>
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
					'items_wrap' => '<ul ' . generate_get_attr( 'menu', array( 'id' => '%1$s', 'class' => '%2$s ' . generate_get_element_classes( 'generate_menu_class' ) ) ) . '>%3$s</ul>'
				) 
			);
			?>
		</div><!-- .inside-navigation -->
	</nav><!-- #site-navigation -->
	<?php
}
endif;

if ( ! function_exists( 'generate_menu_fallback' ) ) :
/**
 * Menu fallback. 
 *
 * @param  array $args
 * @return string
 *
 * @since 1.1.4
 */
function generate_menu_fallback( $args ) {
	?>
	<div id="primary-menu" class="main-nav">
		<ul <?php generate_do_attr( 'menu', array( 'class' => generate_get_element_classes( 'generate_menu_class' ) ) ); ?>>
			<?php 
			$args = array(
				'sort_column' => 'menu_order',
				'title_li' => '',
				'walker' => new Generate_Page_Walker()
			);
			wp_list_pages( $args );
			if ( 'enable' == generate_get_option( 'nav_search' ) ) {
				echo '<li class="search-item" title="' . esc_attr_x( 'Search', 'submit button', 'generatepress' ) . '"><a href="#"><i class="fa fa-fw fa-search" aria-hidden="true"></i><span class="screen-reader-text">' . _x( 'Search', 'submit button', 'generatepress' ) . '</span></a></li>';
			}
			?>
		</ul>
	</div><!-- .main-nav -->
	<?php 
}
endif;

/**
 * Generate the navigation based on settings
 *
 * It would be better to have all of these inside one action, but these
 * are kept this way to maintain backward compatibility for people
 * un-hooking and moving the navigation/changing the priority.
 *
 * @since 0.1
 */
if ( ! function_exists( 'generate_add_navigation_after_header' ) ) :
add_action( 'generate_after_header', 'generate_add_navigation_after_header', 5 );
function generate_add_navigation_after_header() {
	if ( 'nav-below-header' == generate_get_navigation_location() ) {
		generate_navigation_position();
	}
}
endif;

if ( ! function_exists( 'generate_add_navigation_before_header' ) ) :
add_action( 'generate_before_header', 'generate_add_navigation_before_header', 5 );
function generate_add_navigation_before_header() {	
	if ( 'nav-above-header' == generate_get_navigation_location() ) {
		generate_navigation_position();
	}
}
endif;

if ( ! function_exists( 'generate_add_navigation_float_right' ) ) :
add_action( 'generate_after_header_content', 'generate_add_navigation_float_right', 5 );
function generate_add_navigation_float_right() {
	if ( 'nav-float-right' == generate_get_navigation_location() || 'nav-float-left' == generate_get_navigation_location() ) {
		generate_navigation_position();
	}
}
endif;

if ( ! function_exists( 'generate_add_navigation_before_right_sidebar' ) ) :
add_action( 'generate_before_right_sidebar_content', 'generate_add_navigation_before_right_sidebar', 5 );
function generate_add_navigation_before_right_sidebar() {
	if ( 'nav-right-sidebar' == generate_get_navigation_location() ) {
		echo '<div class="gen-sidebar-nav">';
			generate_navigation_position();
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'generate_add_navigation_before_left_sidebar' ) ) :
add_action( 'generate_before_left_sidebar_content', 'generate_add_navigation_before_left_sidebar', 5 );
function generate_add_navigation_before_left_sidebar() {
	if ( 'nav-left-sidebar' == generate_get_navigation_location() ) {
		echo '<div class="gen-sidebar-nav">';
			generate_navigation_position();
		echo '</div>';
	}
}
endif;

if ( ! class_exists( 'Generate_Page_Walker' ) && class_exists( 'Walker_Page' ) ) :
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
			$button = '<span role="button" class="dropdown-menu-toggle" aria-expanded="false"></span>';
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
		} elseif ( $page->ID == get_option('page_for_posts') ) {
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
endif;

if ( ! function_exists( 'generate_dropdown_icon_to_menu_link' ) ) :
/**
 * Add dropdown icon if menu item has children.
 *
 * @since 1.3.42
 */
add_filter( 'nav_menu_item_title', 'generate_dropdown_icon_to_menu_link', 10, 4 );
function generate_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	// Build an array with our theme location
	$theme_locations = array(
		'primary',
		'secondary',
		'slideout'
	);
	
	// Loop through our menu items and add our dropdown icons
	if ( in_array( $args->theme_location, apply_filters( 'generate_menu_arrow_theme_locations', $theme_locations ) ) ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value  ) {
				$title = $title . '<span role="button" class="dropdown-menu-toggle" aria-expanded="false"></span>';
			}
		}
	}

	// Return our title
	return $title;
}
endif;

if ( ! function_exists( 'generate_navigation_search' ) ) :
/**
 * Add the search bar to the navigation
 * @since 1.1.4
 */
add_action( 'generate_inside_navigation','generate_navigation_search');
function generate_navigation_search() {
	if ( 'enable' !== generate_get_option( 'nav_search' ) ) {
		return;
	}
	
	echo apply_filters( 'generate_navigation_search_output', sprintf( 
		'<form method="get" class="search-form navigation-search" action="%1$s">
			<input type="search" class="search-field" value="%2$s" name="s" title="%3$s" />
		</form>',
		esc_url( home_url( '/' ) ),
		esc_attr( get_search_query() ),
		esc_attr_x( 'Search', 'label', 'generatepress' )
	));
}
endif;

if ( ! function_exists( 'generate_menu_search_icon' ) ) :
/**
 * Add search icon to primary menu if set
 *
 * @since 1.2.9.7
 */
add_filter( 'wp_nav_menu_items','generate_menu_search_icon', 10, 2 );
function generate_menu_search_icon( $nav, $args ) {
	// If the search icon isn't enabled, return the regular nav
	if ( 'enable' !== generate_get_option( 'nav_search' ) ) {
		return $nav;
	}
	
	// If our primary menu is set, add the search icon
	if ( $args->theme_location == 'primary' ) {
		return $nav . '<li class="search-item" title="' . esc_attr_x( 'Search', 'submit button', 'generatepress' ) . '"><a href="#"><i class="fa fa-fw fa-search" aria-hidden="true"></i><span class="screen-reader-text">' . _x( 'Search', 'submit button', 'generatepress' ) . '</span></a></li>';
	}
	
	// Our primary menu isn't set, return the regular nav
	// In this case, the search icon is added to the generate_menu_fallback() function in navigation.php
    return $nav;
}
endif;

if ( ! function_exists( 'generate_mobile_menu_search_icon' ) ) :
/**
 * Add search icon to mobile menu bar
 *
 * @since 1.3.12
 */
add_action( 'generate_inside_navigation','generate_mobile_menu_search_icon' );
function generate_mobile_menu_search_icon() {
	// If the search icon isn't enabled, return the regular nav
	if ( 'enable' !== generate_get_option( 'nav_search' ) ) {
		return;
	}
	
	?>
	<div class="mobile-bar-items">
		<?php do_action( 'generate_inside_mobile_menu_bar' ); ?>
		<span class="search-item" title="<?php esc_attr( _ex( 'Search', 'submit button', 'generatepress' ) ); ?>">
			<a href="#">
				<i class="fa fa-fw fa-search" aria-hidden="true"></i>
				<span class="screen-reader-text"><?php esc_attr( _ex( 'Search', 'submit button', 'generatepress' ) ); ?></span>
			</a>
		</span>
	</div><!-- .mobile-bar-items -->
	<?php
}
endif;