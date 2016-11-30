<?php
/*
 WARNING: This is a core Generate file. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Generate Spacing integration
 *
 * This file is a core Generate file and should not be edited.
 *
 * @package  GeneratePress
 * @author   Thomas Usborne
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.generatepress.com
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists('generate_spacing_get_defaults') ) :
function generate_spacing_get_defaults()
{
	$generate_spacing_defaults = array(
		'header_top' => '40',
		'header_right' => '40',
		'header_bottom' => '40',
		'header_left' => '40',
		'menu_item' => '20',
		'menu_item_height' => '60',
		'sub_menu_item_height' => '10',
		'content_top' => '40',
		'content_right' => '40',
		'content_bottom' => '40',
		'content_left' => '40',
		'separator' => '20',
		'left_sidebar_width' => '25',
		'right_sidebar_width' => '25',
		'widget_top' => '40',
		'widget_right' => '40',
		'widget_bottom' => '40',
		'widget_left' => '40',
		'footer_widget_container_top' => '40',
		'footer_widget_container_right' => '0',
		'footer_widget_container_bottom' => '40',
		'footer_widget_container_left' => '0',
		'footer_top' => '20',
		'footer_right' => '0',
		'footer_bottom' => '20',
		'footer_left' => '0',
	);
	
	return apply_filters( 'generate_spacing_option_defaults', $generate_spacing_defaults );
}
endif;
if ( !function_exists('generate_spacing_css') ) :
	function generate_spacing_css()
	{
		$spacing_settings = wp_parse_args( 
			get_option( 'generate_spacing_settings', array() ), 
			generate_spacing_get_defaults() 
		);
			
		$space = ' ';
		// Start the magic
		$spacing_css = array (
		
			'.inside-header' => array(
				'padding' => generate_padding_css( $spacing_settings[ 'header_top' ], $spacing_settings[ 'header_right' ], $spacing_settings[ 'header_bottom' ], $spacing_settings[ 'header_left' ] )
			),
			
			'.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .separate-containers .paging-navigation, .one-container .site-content' => array(
				'padding' => generate_padding_css( $spacing_settings[ 'content_top' ], $spacing_settings[ 'content_right' ], $spacing_settings[ 'content_bottom' ], $spacing_settings[ 'content_left' ] )
			),
			
			'.one-container.right-sidebar .site-main,
			.one-container.both-right .site-main' => array(
				'margin-right' => ( isset( $spacing_settings['content_right'] ) ) ? $spacing_settings['content_right'] . 'px' : null,
			),
			
			'.one-container.left-sidebar .site-main,
			.one-container.both-left .site-main' => array(
				'margin-left' => ( isset( $spacing_settings['content_left'] ) ) ? $spacing_settings['content_left'] . 'px' : null,
			),
			
			'.one-container.both-sidebars .site-main' => array(
				'margin' => generate_padding_css( '0', $spacing_settings[ 'content_right' ], '0', $spacing_settings[ 'content_left' ] )
			),
			
			'.ignore-x-spacing' => array(
				'margin-right' => ( isset( $spacing_settings['content_right'] ) ) ? '-' . $spacing_settings['content_right'] . 'px' : null,
				'margin-bottom' => ( isset( $spacing_settings['content_bottom'] ) ) ? $spacing_settings['content_bottom'] . 'px' : null,
				'margin-left' => ( isset( $spacing_settings['content_left'] ) ) ? '-' . $spacing_settings['content_left'] . 'px' : null,
			),
			
			'.ignore-xy-spacing' => array(
				'margin' => generate_padding_css( '-' . $spacing_settings[ 'content_top' ], '-' . $spacing_settings[ 'content_right' ], $spacing_settings[ 'content_bottom' ], '-' . $spacing_settings[ 'content_left' ] )
			),
			
			'.main-navigation .main-nav ul li a,
			.menu-toggle,
			.main-navigation .mobile-bar-items a' => array(
				'padding-left' => ( isset( $spacing_settings['menu_item'] ) ) ? $spacing_settings['menu_item'] . 'px' : null,
				'padding-right' => ( isset( $spacing_settings['menu_item'] ) ) ? $spacing_settings['menu_item'] . 'px' : null,
				'line-height' => ( isset( $spacing_settings['menu_item_height'] ) ) ? $spacing_settings['menu_item_height'] . 'px' : null,
			),
			
			'.main-navigation .main-nav ul ul li a' => array(
				'padding' => generate_padding_css( $spacing_settings[ 'sub_menu_item_height' ], $spacing_settings[ 'menu_item' ], $spacing_settings[ 'sub_menu_item_height' ], $spacing_settings[ 'menu_item' ] )
			),
			
			'.main-navigation ul ul' => array(
				'top' => ( isset( $spacing_settings['menu_item_height'] ) ) ? $spacing_settings['menu_item_height'] . 'px' : null
			),
			
			'.navigation-search' => array(
				'height' => ( isset( $spacing_settings['menu_item_height'] ) ) ? $spacing_settings['menu_item_height'] . 'px' : null,
				'line-height' => '0px'
			),
			
			'.navigation-search input' => array(
				'height' => ( isset( $spacing_settings['menu_item_height'] ) ) ? $spacing_settings['menu_item_height'] . 'px' : null,
				'line-height' => '0px'
			),
			
			'.widget-area .widget' => array(
				'padding' => generate_padding_css( $spacing_settings[ 'widget_top' ], $spacing_settings[ 'widget_right' ], $spacing_settings[ 'widget_bottom' ], $spacing_settings[ 'widget_left' ] )
			),
			
			'.footer-widgets' => array(
				'padding' => generate_padding_css( $spacing_settings[ 'footer_widget_container_top' ], $spacing_settings[ 'footer_widget_container_right' ], $spacing_settings[ 'footer_widget_container_bottom' ], $spacing_settings[ 'footer_widget_container_left' ] )
			),
			
			'.site-info' => array(
				'padding' => generate_padding_css( $spacing_settings[ 'footer_top' ], $spacing_settings[ 'footer_right' ], $spacing_settings[ 'footer_bottom' ], $spacing_settings[ 'footer_left' ] )
			),
			
			'.right-sidebar.separate-containers .site-main' => array(
				'margin' => generate_padding_css( $spacing_settings[ 'separator' ], $spacing_settings[ 'separator' ], $spacing_settings[ 'separator' ], '0' ),
			),
			
			'.left-sidebar.separate-containers .site-main' => array(
				'margin' => generate_padding_css( $spacing_settings[ 'separator' ], '0', $spacing_settings[ 'separator' ], $spacing_settings[ 'separator' ] ),
			),
			
			'.both-sidebars.separate-containers .site-main' => array(
				'margin' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
			),
			
			'.both-right.separate-containers .site-main' => array(
				'margin' => generate_padding_css( $spacing_settings[ 'separator' ], $spacing_settings[ 'separator' ], $spacing_settings[ 'separator' ], '0' ),
			),
			
			'.separate-containers .site-main' => array(
				'margin-top' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
				'margin-bottom' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
			),
			
			'.separate-containers .page-header-image, .separate-containers .page-header-content, .separate-containers .page-header-image-single, .separate-containers .page-header-content-single' => array(
				'margin-top' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
			),
			
			'.both-left.separate-containers .site-main' => array(
				'margin' => generate_padding_css( $spacing_settings[ 'separator' ], '0', $spacing_settings[ 'separator' ], $spacing_settings[ 'separator' ] ),
			),
			
			'.separate-containers .inside-right-sidebar, .inside-left-sidebar' => array(
				'margin-top' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
				'margin-bottom' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
			),
			
			'.separate-containers .widget, .separate-containers .site-main > *, .separate-containers .page-header, .widget-area .main-navigation' => array(
				'margin-bottom' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] . 'px' : null,
			),
			
			'.both-left.separate-containers .inside-left-sidebar' => array(
				'margin-right' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] / 2 . 'px' : null,
			),
			
			'.both-left.separate-containers .inside-right-sidebar' => array(
				'margin-left' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] / 2 . 'px' : null,
			),
			
			'.both-right.separate-containers .inside-left-sidebar' => array(
				'margin-right' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] / 2 . 'px' : null,
			),

			'.both-right.separate-containers .inside-right-sidebar' => array(
				'margin-left' => ( isset( $spacing_settings['separator'] ) ) ? $spacing_settings['separator'] / 2 . 'px' : null,
			),
			
			'.menu-item-has-children ul .dropdown-menu-toggle' => array (
				'padding-top' => ( isset( $spacing_settings[ 'sub_menu_item_height' ] ) ) ? $spacing_settings[ 'sub_menu_item_height' ] . 'px' : null,
				'padding-bottom' => ( isset( $spacing_settings[ 'sub_menu_item_height' ] ) ) ? $spacing_settings[ 'sub_menu_item_height' ] . 'px' : null,
				'margin-top' => ( isset( $spacing_settings[ 'sub_menu_item_height' ] ) ) ? '-' . $spacing_settings[ 'sub_menu_item_height' ] . 'px' : null,
			),
			
			'.menu-item-has-children .dropdown-menu-toggle' => array(
				'padding-right' => ( isset( $spacing_settings['menu_item'] ) && ! is_rtl() ) ? $spacing_settings['menu_item'] . 'px' : null,
				'padding-left' => ( isset( $spacing_settings['menu_item'] ) && is_rtl() ) ? $spacing_settings['menu_item'] . 'px' : null,
			),
			
			'.main-navigation .main-nav ul li.menu-item-has-children > a' => array(
				'padding-right' => ( is_rtl() ) ? $spacing_settings['menu_item'] . 'px' : null
			)
			
		);
		
		// Output the above CSS
		$output = '';
		foreach($spacing_css as $k => $properties) {
			if(!count($properties))
				continue;

			$temporary_output = $k . ' {';
			$elements_added = 0;

			foreach($properties as $p => $v) {
				if(empty($v))
					continue;

				$elements_added++;
				$temporary_output .= $p . ': ' . $v . '; ';
			}

			$temporary_output .= "}";

			if($elements_added > 0)
				$output .= $temporary_output;
		}
		
		// Get color settings
		$generate_settings = wp_parse_args( 
			get_option( 'generate_settings', array() ), 
			generate_get_color_defaults() 
		);
		
		// Find out if the content background color and sidebar widget background color is the same
		$colors_match = false;
		$sidebar = strtoupper( $generate_settings['sidebar_widget_background_color'] );
		$content = strtoupper( $generate_settings['content_background_color'] );
		if ( ( $sidebar == $content ) || '' == $sidebar ) :
			$colors_match = true;
		endif;
		
		// Put all of our widget padding into an array
		$widget_padding = array(
			$spacing_settings[ 'widget_top' ], 
			$spacing_settings[ 'widget_right' ], 
			$spacing_settings[ 'widget_bottom' ], 
			$spacing_settings[ 'widget_left' ]
		);
		
		// If they're all 40 (default), remove the padding when one container is set
		// This way, the user can still adjust the padding and it will work (unless they want 40px padding)
		// We'll also remove the padding if there's no color difference between the widgets and content background color
		if ( count( array_unique( $widget_padding ) ) === 1 && end( $widget_padding ) === '40' && $colors_match ) {
			$output .= '.one-container .sidebar .widget{padding:0px;}';
		}

		$output = str_replace(array("\r", "\n", "\t"), '', $output);
		return $output; 
	}
	
	/**
	 * Enqueue scripts and styles
	 */
	add_action( 'wp_enqueue_scripts', 'generate_spacing_scripts', 50 );
	function generate_spacing_scripts() {

		wp_add_inline_style( 'generate-style', generate_spacing_css() );
	
	}
endif;

if ( ! function_exists( 'generate_additional_spacing' ) ) :
/**
 * Add fallback CSS for our mobile search icon color
 */
function generate_additional_spacing()
{
	if ( function_exists( 'generate_spacing_get_defaults' ) ) :
		$spacing_settings = wp_parse_args( 
			get_option( 'generate_spacing_settings', array() ), 
			generate_spacing_get_defaults() 
		);
	endif;
		
	$space = ' ';
	// Start the magic
	$spacing_css = array (
		
		// Since 1.3.41
		// Compatibility for GP Premium 1.2.92
		'.menu-item-has-children .dropdown-menu-toggle' => array(
			'padding-right' => ( isset( $spacing_settings['menu_item'] ) && ! is_rtl() ) ? $spacing_settings['menu_item'] . 'px' : null,
			'padding-left' => ( isset( $spacing_settings['menu_item'] ) && is_rtl() ) ? $spacing_settings['menu_item'] . 'px' : null,
		)
		
	);
	
	// Output the above CSS
	$output = '';
	foreach($spacing_css as $k => $properties) {
		if(!count($properties))
			continue;

		$temporary_output = $k . ' {';
		$elements_added = 0;

		foreach($properties as $p => $v) {
			if(empty($v))
				continue;

			$elements_added++;
			$temporary_output .= $p . ': ' . $v . '; ';
		}

		$temporary_output .= "}";

		if($elements_added > 0)
			$output .= $temporary_output;
	}
	
	$output = str_replace(array("\r", "\n", "\t"), '', $output);
	return $output;
}
endif;

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) :
/**
 * Enqueue our mobile search icon color fallback CSS
 */
add_action( 'wp_enqueue_scripts', 'generate_mobile_search_spacing_fallback_css', 50 );
function generate_mobile_search_spacing_fallback_css() 
{
	wp_add_inline_style( 'generate-style', generate_additional_spacing() );
}
endif;

if ( ! function_exists( 'generate_padding_css' ) ) :
function generate_padding_css( $top, $right, $bottom, $left )
{
	$padding_top = ( isset( $top ) && '' !== $top ) ? $top . 'px ' : '0px ';
	$padding_right = ( isset( $right ) && '' !== $right ) ? $right . 'px ' : '0px ';
	$padding_bottom = ( isset( $bottom ) && '' !== $bottom ) ? $bottom . 'px ' : '0px ';
	$padding_left = ( isset( $left ) && '' !== $left ) ? $left . 'px' : '0px';
	
	return $padding_top . $padding_right . $padding_bottom . $padding_left;
}
endif;