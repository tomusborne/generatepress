<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'body_class', 'generate_set_body_classes' );
/**
 * Adds custom classes to the array of body classes.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array All of the body classes.
 */
function generate_set_body_classes( $classes ) {
	$layout = generate_get_sidebar_layout();
	$navigation_location = generate_get_navigation_location();
	$widgets = generate_get_footer_widget_count();
	
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
	$classes[] = ( generate_get_option( 'header_layout_setting' ) ) ? generate_get_option( 'header_layout_setting' ) : 'fluid-header';
	$classes[] = ( generate_get_option( 'content_layout_setting' ) ) ? generate_get_option( 'content_layout_setting' ) : 'separate-containers';
	$classes[] = ( '' !== $widgets ) ? 'active-footer-widgets-' . $widgets : 'active-footer-widgets-3';
	$classes[] = ( 'enable' == generate_get_option( 'nav_search' ) ) ? 'nav-search-enabled' : '';
	
	// Navigation alignment class
	if ( generate_get_option( 'nav_alignment_setting' ) == 'left' ) {
		$classes[] = 'nav-aligned-left';
	} elseif ( generate_get_option( 'nav_alignment_setting' ) == 'center' ) {
		$classes[] = 'nav-aligned-center';
	} elseif ( generate_get_option( 'nav_alignment_setting' ) == 'right' ) {
		$classes[] = 'nav-aligned-right';
	} else {
		$classes[] = 'nav-aligned-left';
	}
	
	// Header alignment class
	if ( generate_get_option( 'header_alignment_setting' ) == 'left' ) {
		$classes[] = 'header-aligned-left';
	} elseif ( generate_get_option( 'header_alignment_setting' ) == 'center' ) {
		$classes[] = 'header-aligned-center';
	} elseif ( generate_get_option( 'header_alignment_setting' ) == 'right' ) {
		$classes[] = 'header-aligned-right';
	} else {
		$classes[] = 'header-aligned-left';
	}
	
	// Navigation dropdown type
	if ( 'click' == generate_get_option( 'nav_dropdown_type' ) ) {
		$classes[] = 'dropdown-click';
		$classes[] = 'dropdown-click-menu-item';
	} elseif ( 'click-arrow' == generate_get_option( 'nav_dropdown_type' ) ) {
		$classes[] = 'dropdown-click-arrow';
		$classes[] = 'dropdown-click';
	} else {
		$classes[] = 'dropdown-hover';
	}

	return $classes;
}

add_filter( 'generate_top_bar_class', 'generate_set_top_bar_classes' );
/**
 * Adds custom classes to the header.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Top bar classes.
 */
function generate_set_top_bar_classes( $classes ) {
	$classes[] = 'top-bar';

	if ( 'contained' == generate_get_option( 'top_bar_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}
	
	$classes[] = 'top-bar-align-' . generate_get_option( 'top_bar_alignment' );

	return $classes;
}

add_filter( 'generate_right_sidebar_class', 'generate_set_right_sidebar_classes' );
/**
 * Adds custom classes to the right sidebar.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Right sidebar classes.
 */
function generate_set_right_sidebar_classes( $classes ) {
	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	
	$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
	$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );

	$classes[] = 'widget-area';
	$classes[] = 'grid-' . absint( $right_sidebar_width );
	$classes[] = 'tablet-grid-' . absint( $right_sidebar_tablet_width );
	$classes[] = 'grid-parent';
	$classes[] = 'sidebar';

	$layout = generate_get_sidebar_layout();
	
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

add_filter( 'generate_left_sidebar_class', 'generate_set_left_sidebar_classes' );
/**
 * Adds custom classes to the left sidebar.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Left sidebar classes.
 */
function generate_set_left_sidebar_classes( $classes ) {
	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;
	
	$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
	$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
	$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;
	
	$classes[] = 'widget-area';
	$classes[] = 'grid-' . absint( $left_sidebar_width );
	$classes[] = 'tablet-grid-' . absint( $left_sidebar_tablet_width );
	$classes[] = 'mobile-grid-100';
	$classes[] = 'grid-parent';
	$classes[] = 'sidebar';

	$layout = generate_get_sidebar_layout();
	
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

add_filter( 'generate_content_class', 'generate_set_content_classes' );
/**
 * Adds custom classes to the content container.
 *
 * @since 0.1
 *
 * @param  array $classes Existing classes.
 * @return array Primary content classes.
 */
function generate_set_content_classes( $classes ) {
	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;
	
	$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
	$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
	$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;
	
	$classes[] = 'content-area';
	$classes[] = 'grid-parent';
	$classes[] = 'mobile-grid-100';

	$layout = generate_get_sidebar_layout();
	
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

add_filter( 'generate_header_class', 'generate_set_header_classes' );
/**
 * Adds custom classes to the header.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Header classes.
 */
function generate_set_header_classes( $classes ) {
	$classes[] = 'site-header';
	
	if ( 'contained-header' == generate_get_option( 'header_layout_setting' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	return $classes;
}

add_filter( 'generate_inside_header_class', 'generate_set_inside_header_classes' );
/**
 * Adds custom classes to inside the header.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Inside header classes.
 */
function generate_set_inside_header_classes( $classes ) {
	$classes[] = 'inside-header';
	
	if ( 'full-width' !== generate_get_option( 'header_inner_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	return $classes;
}

add_filter( 'generate_navigation_class', 'generate_set_navigation_classes' );
/**
 * Adds custom classes to the navigation.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Primary navigation classes.
 */
function generate_set_navigation_classes( $classes ) {
	$classes[] = 'main-navigation';

	if ( 'contained-nav' == generate_get_option( 'nav_layout_setting' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	return $classes;
}

add_filter( 'generate_inside_navigation_class', 'generate_set_inside_navigation_classes' );
/**
 * Adds custom classes to the inner navigation.
 *
 * @since 1.3.41
 *
 * @param  array $classes Existing classes.
 * @return array Inside navigation classes.
 */
function generate_set_inside_navigation_classes( $classes ) {
	$classes[] = 'inside-navigation';

	if ( 'full-width' !== generate_get_option( 'nav_inner_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	return $classes;
}

add_filter( 'generate_menu_class', 'generate_set_menu_classes' );
/**
 * Adds custom classes to the menu.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Menu ul classes.
 */
function generate_set_menu_classes( $classes ) {
	$classes[] = 'menu';
	$classes[] = 'sf-menu';
	
	return $classes;
}

add_filter( 'generate_footer_class', 'generate_set_footer_classes' );
/**
 * Adds custom classes to the footer
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Footer classes.
 */
function generate_set_footer_classes( $classes )
{
	$classes[] = 'site-footer';

	if ( 'contained-footer' == generate_get_option( 'footer_layout_setting' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	$classes[] = ( is_active_sidebar( 'footer-bar' ) ) ? 'footer-bar-active' : '';
	$classes[] = ( is_active_sidebar( 'footer-bar' ) ) ? 'footer-bar-align-' . generate_get_option( 'footer_bar_alignment' ) : '';

	return $classes;
}

add_filter( 'generate_inside_footer_class', 'generate_set_inside_footer_classes' );
/**
 * Adds custom classes to the footer.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Inside footer classes.
 */
function generate_set_inside_footer_classes( $classes ) {
	$classes[] = 'footer-widgets-container';

	if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	return $classes;
}

add_filter( 'generate_main_class', 'generate_set_main_classes' );
/**
 * Adds custom classes to the main element.
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Main content element classes.
 */
function generate_set_main_classes( $classes ) {
	$classes[] = 'site-main';
	
	return $classes;
}

add_filter( 'post_class', 'generate_set_post_classes' );
/**
 * Adds custom classes to the article element
 * Remove .hentry class from pages to comply with structural data guidelines
 *
 * @since 2.0
 *
 * @param  array $classes Existing classes.
 * @return array Post classes.
 */
function generate_set_post_classes( $classes ) {
	if ( 'page' == get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}
	
	return $classes;
}