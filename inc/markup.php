<?php
defined( 'WPINC' ) or die;

/**
 * Merge array of attributes with defaults, and apply contextual filter on array.
 *
 * The contextual filter is of the form `generate_attr_{context}`.
 *
 * @since 2.0
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @return array Merged and filtered attributes.
 */
function generate_parse_attr( $context, $attributes = array() ) {
	$defaults = array(
		'class' => esc_attr( $context ),
	);

	$attributes = wp_parse_args( $attributes, $defaults );

	// Contextual filter.
	return apply_filters( "generate_attr_{$context}", $attributes, $context );
}

/**
 * Build list of attributes into a string and apply contextual filter on string.
 *
 * The contextual filter is of the form `generate_attr_{context}_output`.
 *
 * @since 2.0
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @return string String of HTML attributes and values.
 */
function generate_get_attr( $context, $attributes = array() ) {
	$attributes = generate_parse_attr( $context, $attributes );

	$output = '';

	// Cycle through attributes, build tag attribute string.
	foreach ( $attributes as $key => $value ) {

		if ( ! $value ) {
			continue;
		}

		if ( true === $value ) {
			$output .= esc_html( $key ) . ' ';
		} else {
			$output .= sprintf( '%s="%s" ', esc_html( $key ), esc_attr( $value ) );
		}

	}

	$output = apply_filters( "generate_attr_{$context}_output", $output, $attributes, $context );

	return trim( $output );
}

/**
 * Print our generate_get_attr() function.
 *
 * @since 2.0
 *
 * @param string $context    The element name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 */
function generate_do_attr( $context, $attributes = array() ) {
	echo generate_get_attr( $context, $attributes );
}

add_filter( 'generate_attr_body', 'generate_set_body_attributes' );
/**
 * Build our body attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the body element.
 */
function generate_set_body_attributes( $attributes ) {
	$classes = get_body_class();
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

	$attributes['class'] = join( ' ', $classes );
	$itemtype = 'WebPage';

	// Change our itemtype if we're on the blog
	$itemtype = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? 'Blog' : $itemtype;

	// Change our itemtype if we're in search results
	$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;

	$attributes['itemtype']  = 'http://schema.org/' . apply_filters( 'generate_body_itemtype', $itemtype );
	$attributes['itemscope'] = true;

	return $attributes;
}

add_filter( 'generate_attr_page', 'generate_set_page_attributes' );
/**
 * Build our page attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the page element.
 */
function generate_set_page_attributes( $attributes ) {
	$attributes['id'] = 'page';
	$attributes['class'] = 'hfeed site grid-container container grid-parent';

	return $attributes;
}

add_filter( 'generate_attr_primary', 'generate_set_primary_attributes' );
/**
 * Build our primary content area attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the primary element.
 */
function generate_set_primary_attributes( $attributes ) {
	$attributes['id'] = 'primary';

	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;

	$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
	$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
	$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;

	$classes = array();
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

	$attributes['class'] = generate_get_element_classes( 'generate_content_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_right-sidebar', 'generate_set_right_sidebar_attributes' );
/**
 * Build our right sidebar attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the right sidebar element.
 */
function generate_set_right_sidebar_attributes( $attributes ) {
	$attributes['id'] = 'right-sidebar';

	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );

	$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
	$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );

	$classes = array();
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

	$attributes['class'] = generate_get_element_classes( 'generate_right_sidebar_class', $classes );
	$attributes['itemtype'] = 'http://schema.org/WPSideBar';
	$attributes['itemscope'] = true;
	$attributes['role'] = 'complementary';

	return $attributes;
}

add_filter( 'generate_attr_left-sidebar', 'generate_set_left_sidebar_attributes' );
/**
 * Build our left sidebar attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the left sidebar element.
 */
function generate_set_left_sidebar_attributes( $attributes ) {
	$attributes['id'] = 'left-sidebar';

	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	$total_sidebar_width = $left_sidebar_width + $right_sidebar_width;

	$right_sidebar_tablet_width = apply_filters( 'generate_right_sidebar_tablet_width', $right_sidebar_width );
	$left_sidebar_tablet_width = apply_filters( 'generate_left_sidebar_tablet_width', $left_sidebar_width );
	$total_sidebar_tablet_width = $left_sidebar_tablet_width + $right_sidebar_tablet_width;

	$classes = array();
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

	$attributes['class'] = generate_get_element_classes( 'generate_left_sidebar_class', $classes );
	$attributes['itemtype'] = 'http://schema.org/WPSideBar';
	$attributes['itemscope'] = true;
	$attributes['role'] = 'complementary';

	return $attributes;
}

add_filter( 'generate_attr_header', 'generate_set_header_attributes' );
/**
 * Build our header attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the header element.
 */
function generate_set_header_attributes( $attributes ) {
	$attributes['id'] = 'masthead';

	$classes = array();
	$classes[] = 'site-header';
	if ( 'contained-header' == generate_get_option( 'header_layout_setting' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	$attributes['class'] = generate_get_element_classes( 'generate_header_class', $classes );
	$attributes['itemtype'] = 'http://schema.org/WPHeader';
	$attributes['itemscope'] = true;

	return $attributes;
}

add_filter( 'generate_attr_inside-header', 'generate_set_inside_header_attributes' );
/**
 * Build our inner header attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the inner header element.
 */
function generate_set_inside_header_attributes( $attributes ) {
	$classes = array();
	$classes[] = 'inside-header';

	if ( 'full-width' !== generate_get_option( 'header_inner_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}
	$attributes['class'] = generate_get_element_classes( 'generate_inside_header_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_navigation', 'generate_set_navigation_attributes' );
/**
 * Build our primary navigation attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the primary navigation element.
 */
function generate_set_navigation_attributes( $attributes ) {
	$attributes['id'] = 'site-navigation';

	$classes = array();
	$classes[] = 'main-navigation';

	if ( 'contained-nav' == generate_get_option( 'nav_layout_setting' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}
	$attributes['class'] = generate_get_element_classes( 'generate_navigation_class', $classes );
	$attributes['itemtype'] = 'http://schema.org/SiteNavigationElement';
	$attributes['itemscope'] = true;

	return $attributes;
}

add_filter( 'generate_attr_inside-navigation', 'generate_set_inside_navigation_attributes' );
/**
 * Build our inner primary navigation attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the inner primary navigation element.
 */
function generate_set_inside_navigation_attributes( $attributes ) {
	$classes = array();
	$classes[] = 'inside-navigation';

	if ( 'full-width' !== generate_get_option( 'nav_inner_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	$attributes['class'] = generate_get_element_classes( 'generate_inside_navigation_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_menu', 'generate_set_menu_attributes' );
/**
 * Build our menu ul attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the menu ul element.
 */
function generate_set_menu_attributes( $attributes ) {
	$classes[] = 'menu';
	$classes[] = 'sf-menu';

	$attributes['class'] = generate_get_element_classes( 'generate_menu_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_main', 'generate_set_main_attributes' );
/**
 * Build our main content area attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the main content element.
 */
function generate_set_main_attributes( $attributes ) {
	$attributes['id'] = 'main';

	$classes = array();
	$classes[] = 'site-main';
	$attributes['class'] = generate_get_element_classes( 'generate_main_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_footer', 'generate_set_footer_attributes' );
/**
 * Build our footer attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the footer element.
 */
function generate_set_footer_attributes( $attributes ) {
	$classes = array();
	$classes[] = 'site-footer';

	if ( 'contained-footer' == generate_get_option( 'footer_layout_setting' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	$classes[] = ( is_active_sidebar( 'footer-bar' ) ) ? 'footer-bar-active' : '';
	$classes[] = ( is_active_sidebar( 'footer-bar' ) ) ? 'footer-bar-align-' . generate_get_option( 'footer_bar_alignment' ) : '';

	$attributes['class'] = generate_get_element_classes( 'generate_footer_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_inside-footer', 'generate_set_inside_footer_attributes' );
/**
 * Build our inner footer attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the inner footer element.
 */
function generate_set_inside_footer_attributes( $attributes ) {
	$classes = array();
	$classes[] = 'footer-widgets-container';

	if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	$attributes['class'] = generate_get_element_classes( 'generate_inside_footer_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_footer-bar', 'generate_set_footer_bar_attributes' );
/**
 * Build our footer bar/copyright area attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the footer bar (copyright) element.
 */
function generate_set_footer_bar_attributes( $attributes ) {
	$attributes['class'] = 'site-info';
	$attributes['itemtype'] = 'http://schema.org/WPFooter';
	$attributes['itemscope'] = true;

	return $attributes;
}

add_filter( 'generate_attr_top-bar', 'generate_set_top_bar_attributes' );
/**
 * Build our top bar attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the top bar element.
 */
function generate_set_top_bar_attributes( $attributes ) {
	$classes = array();
	$classes[] = 'top-bar';

	if ( 'contained' == generate_get_option( 'top_bar_width' ) ) {
		$classes[] = 'grid-container';
		$classes[] = 'grid-parent';
	}

	$classes[] = 'top-bar-align-' . generate_get_option( 'top_bar_alignment' );

	$attributes['class'] = generate_get_element_classes( 'generate_top_bar_class', $classes );

	return $attributes;
}

add_filter( 'generate_attr_post', 'generate_set_post_attributes' );
/**
 * Build our post/article attributes.
 *
 * @since 2.0
 *
 * @param array $attributes Any existing attributes.
 * @return array New attributes for the post element.
 */
function generate_set_post_attributes( $attributes ) {
	$attributes['id'] = 'post-' . get_the_ID();

	$classes = get_post_class();
	if ( 'page' == get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}

	$attributes['class'] = join( ' ', $classes );
	$attributes['itemtype'] = 'http://schema.org/CreativeWork';
	$attributes['itemscope'] = true;

	return $attributes;
}