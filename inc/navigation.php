<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_add_navigation_after_header' ) ) :
/**
 * Generate the navigation based on settings
 * @since 0.1
 */
add_action( 'generate_after_header', 'generate_add_navigation_after_header', 5 );
function generate_add_navigation_after_header()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	if ( 'nav-below-header' == $generate_settings['nav_position_setting'] ) :
		generate_navigation_position();
	endif;
	
}
endif;

if ( ! function_exists( 'generate_add_navigation_before_header' ) ) :
add_action( 'generate_before_header', 'generate_add_navigation_before_header', 5 );
function generate_add_navigation_before_header()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	if ( 'nav-above-header' == $generate_settings['nav_position_setting'] ) :
		generate_navigation_position();
	endif;
	
}
endif;

if ( ! function_exists( 'generate_add_navigation_float_right' ) ) :
add_action( 'generate_after_header_content', 'generate_add_navigation_float_right', 5 );
function generate_add_navigation_float_right()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	if ( 'nav-float-right' == $generate_settings['nav_position_setting'] || 'nav-float-left' == $generate_settings[ 'nav_position_setting' ] ) :
		generate_navigation_position();
	endif;
	
}
endif;

if ( ! function_exists( 'generate_add_navigation_before_right_sidebar' ) ) :
add_action( 'generate_before_right_sidebar_content', 'generate_add_navigation_before_right_sidebar', 5 );
function generate_add_navigation_before_right_sidebar()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	if ( 'nav-right-sidebar' == $generate_settings['nav_position_setting'] ) :
		echo '<div class="gen-sidebar-nav">';
			generate_navigation_position();
		echo '</div>';
	endif;
	
}
endif;

if ( ! function_exists( 'generate_add_navigation_before_left_sidebar' ) ) :
add_action( 'generate_before_left_sidebar_content', 'generate_add_navigation_before_left_sidebar', 5 );
function generate_add_navigation_before_left_sidebar()
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	if ( 'nav-left-sidebar' == $generate_settings['nav_position_setting'] ) :
		echo '<div class="gen-sidebar-nav">';
			generate_navigation_position();
		echo '</div>';
	endif;
	
}
endif;

if ( ! function_exists( 'generate_navigation_position' ) ) :
/**
 *
 * Build the navigation
 * @since 0.1
 *
 */
function generate_navigation_position()
{
	?>
	<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" <?php generate_navigation_class(); ?>>
		<div class="inside-navigation grid-container grid-parent">
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
					'items_wrap' => '<ul id="%1$s" class="%2$s ' . join( ' ', generate_get_menu_class() ) . '">%3$s</ul>'
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
 * @since 1.1.4
 */
function generate_menu_fallback( $args )
{ 
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	?>
	<div id="primary-menu" class="main-nav">
		<ul <?php generate_menu_class(); ?>>
			<?php 
			$args = array(
				'sort_column' => 'menu_order',
				'title_li' => '',
				'walker' => new Generate_Page_Walker()
			);
			wp_list_pages( $args );
			if ( 'enable' == $generate_settings['nav_search'] ) :
				echo '<li class="search-item" title="' . _x( 'Search', 'submit button', 'generatepress' ) . '"><a href="#"><i class="fa fa-fw fa-search" aria-hidden="true"></i><span class="screen-reader-text">' . _x( 'Search', 'submit button', 'generatepress' ) . '</span></a></li>';
			endif;
			?>
		</ul>
	</div><!-- .main-nav -->
	<?php 
}
endif;

if ( ! class_exists( 'Generate_Page_Walker' ) && class_exists( 'Walker_Page' ) ) :
/**
 * Add current-menu-item to the current item if no theme location is set
 * This means we don't have to duplicate CSS properties for current_page_item and current-menu-item
 *
 * @since 1.3.21
 */
class Generate_Page_Walker extends Walker_Page 
{
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) 
	{
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

if ( ! function_exists( 'generate_nav_dropdown' ) ) :
/**
 *
 * Build the dropdown arrow
 * @since 1.3.24
 *
 */
add_filter( 'walker_nav_menu_start_el', 'generate_nav_dropdown', 10, 4 );
function generate_nav_dropdown( $item_output, $item, $depth, $args ) 
{
	// If we're working with the primary or secondary theme locations
	if ( 'primary' == $args->theme_location || 'secondary' == $args->theme_location || 'slideout' == $args->theme_location ) {
		// If a dropdown menu is detected
		$dropdown = ( in_array( 'menu-item-has-children', $item->classes ) ) ? true : false;
		if ( $dropdown ) :
			// Add our arrow icon
			$item_output = str_replace( $args->link_after . '</a>', $args->link_after . '<span role="button" class="dropdown-menu-toggle" aria-expanded="false"></span></a>', $item_output );
		endif;
	}
	
	// Return the output
	return $item_output;
}
endif;