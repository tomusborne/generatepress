<?php
/*
 WARNING: This is a core Generate file. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * If Generate Colors isn't activated, set the defaults
 *
 * This file is a core Generate file and should not be edited.
 *
 * @package  GeneratePress
 * @author   Thomas Usborne
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.generatepress.com
 */

if ( !function_exists('generate_get_color_defaults') && !function_exists('generate_advanced_css') ) :
	/**
	 * Set default options
	 */
	function generate_get_color_defaults()
	{
		$generate_color_defaults = array(
			'header_background_color' => '#FFFFFF',
			'header_text_color' => '#3a3a3a',
			'header_link_color' => '#3a3a3a',
			'header_link_hover_color' => '',
			'site_title_color' => '#222222',
			'site_tagline_color' => '#999999',
			'navigation_background_color' => '#222222',
			'navigation_text_color' => '#FFFFFF',
			'navigation_background_hover_color' => '#3f3f3f',
			'navigation_text_hover_color' => '#FFFFFF',
			'navigation_background_current_color' => '#3f3f3f',
			'navigation_text_current_color' => '#FFFFFF',
			'subnavigation_background_color' => '#3f3f3f',
			'subnavigation_text_color' => '#FFFFFF',
			'subnavigation_background_hover_color' => '#4f4f4f',
			'subnavigation_text_hover_color' => '#FFFFFF',
			'subnavigation_background_current_color' => '#4f4f4f',
			'subnavigation_text_current_color' => '#FFFFFF',
			'content_background_color' => '#FFFFFF',
			'content_text_color' => '',
			'content_link_color' => '',
			'content_link_hover_color' => '',
			'content_title_color' => '',
			'blog_post_title_color' => '',
			'blog_post_title_hover_color' => '',
			'entry_meta_text_color' => '#888888',
			'entry_meta_link_color' => '#666666',
			'entry_meta_link_color_hover' => '#1E73BE',
			'h1_color' => '',
			'h2_color' => '',
			'h3_color' => '',
			'sidebar_widget_background_color' => '#FFFFFF',
			'sidebar_widget_text_color' => '',
			'sidebar_widget_link_color' => '',
			'sidebar_widget_link_hover_color' => '',
			'sidebar_widget_title_color' => '#000000',
			'footer_widget_background_color' => '#FFFFFF',
			'footer_widget_text_color' => '',
			'footer_widget_link_color' => '#1e73be',
			'footer_widget_link_hover_color' => '#000000',
			'footer_widget_title_color' => '#000000',
			'footer_background_color' => '#222222',
			'footer_text_color' => '#ffffff',
			'footer_link_color' => '#ffffff',
			'footer_link_hover_color' => '#606060',
			'form_background_color' => '#FAFAFA',
			'form_text_color' => '#666666',
			'form_background_color_focus' => '#FFFFFF',
			'form_text_color_focus' => '#666666',
			'form_border_color' => '#CCCCCC',
			'form_border_color_focus' => '#BFBFBF',
			'form_button_background_color' => '#666666',
			'form_button_background_color_hover' => '#3F3F3F',
			'form_button_text_color' => '#FFFFFF',
			'form_button_text_color_hover' => '#FFFFFF'
		);
		
		return apply_filters( 'generate_color_option_defaults', $generate_color_defaults );
	}
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer
	 * @since 0.1
	 */
	function generate_advanced_css()
	{

		$generate_settings = wp_parse_args( 
			get_option( 'generate_settings', array() ), 
			generate_get_color_defaults() 
		);
		$space = ' ';

		// Start the magic
		$visual_css = array (
		
			// Header
			'.site-header' => array(
				'background-color' => $generate_settings['header_background_color'],
				'color' => $generate_settings['header_text_color']
			),
			
			// Header link
			'.site-header a,
			.site-header a:visited' => array(
				'color' => $generate_settings['header_link_color']
			),
			
			// Header link hover
			'.site-header a:hover' => array(
				'color' => $generate_settings['header_link_hover_color']
			),
			
			// Site title color
			'.main-title a,
			.main-title a:hover,
			.main-title a:visited' => array(
				'color' => $generate_settings['site_title_color']
			),
			
			// Site description
			'.site-description' => array(
				'color' => $generate_settings['site_tagline_color']
			),
			
			// Navigation background
			'.main-navigation,  
			.main-navigation ul ul' => array(
				'background-color' => $generate_settings['navigation_background_color']
			),
			
			// Navigation search input
			'.navigation-search input[type="search"],
			.navigation-search input[type="search"]:active' => array(
				'color' => $generate_settings['navigation_background_hover_color'],
				'background-color' => $generate_settings['navigation_background_hover_color']
			),
			
			// Navigation search input on focus
			'.navigation-search input[type="search"]:focus' => array(
				'color' => $generate_settings['navigation_text_hover_color'],
				'background-color' => $generate_settings['navigation_background_hover_color']
			),
			
			// Sub-Navigation background
			'.main-navigation ul ul' => array(
				'background-color' => $generate_settings['subnavigation_background_color']
			),
			
			// Navigation text
			'.main-navigation .main-nav ul li a,
			.menu-toggle' => array(
				'color' => $generate_settings['navigation_text_color']
			),
			
			'button.menu-toggle:hover,
			button.menu-toggle:focus,
			.main-navigation .mobile-bar-items a,
			.main-navigation .mobile-bar-items a:hover,
			.main-navigation .mobile-bar-items a:focus' => array(
				'color' => $generate_settings['navigation_text_color']
			),
			
			// Sub-Navigation text
			'.main-navigation .main-nav ul ul li a' => array(
				'color' => $generate_settings['subnavigation_text_color']
			),
			
			// Navigation background/text on hover
			'.main-navigation .main-nav ul li > a:hover,
			.main-navigation .main-nav ul li > a:focus, 
			.main-navigation .main-nav ul li.sfHover > a' => array(
				'color' => $generate_settings['navigation_text_hover_color'],
				'background-color' => $generate_settings['navigation_background_hover_color']
			),
			
			// Sub-Navigation background/text on hover
			'.main-navigation .main-nav ul ul li > a:hover,
			.main-navigation .main-nav ul ul li > a:focus,			
			.main-navigation .main-nav ul ul li.sfHover > a' => array(
				'color' => $generate_settings['subnavigation_text_hover_color'],
				'background-color' => $generate_settings['subnavigation_background_hover_color']
			),
			
			// Navigation background / text current
			'.main-navigation .main-nav ul .current-menu-item > a, 
			.main-navigation .main-nav ul .current-menu-parent > a, 
			.main-navigation .main-nav ul .current-menu-ancestor > a' => array(
				'color' => $generate_settings['navigation_text_current_color'],
				'background-color' => $generate_settings['navigation_background_current_color']
			),
			
			// Navigation background text current text hover
			'.main-navigation .main-nav ul .current-menu-item > a:hover, 
			.main-navigation .main-nav ul .current-menu-parent > a:hover, 
			.main-navigation .main-nav ul .current-menu-ancestor > a:hover, 
			.main-navigation .main-nav ul .current-menu-item.sfHover > a, 
			.main-navigation .main-nav ul .current-menu-parent.sfHover > a, 
			.main-navigation .main-nav ul .current-menu-ancestor.sfHover > a' => array(
				'color' => $generate_settings['navigation_text_current_color'],
				'background-color' => $generate_settings['navigation_background_current_color']
			),
			
			// Sub-Navigation background / text current
			'.main-navigation .main-nav ul ul .current-menu-item > a, 
			.main-navigation .main-nav ul ul .current-menu-parent > a, 
			.main-navigation .main-nav ul ul .current-menu-ancestor > a' => array(
				'color' => $generate_settings['subnavigation_text_current_color'],
				'background-color' => $generate_settings['subnavigation_background_current_color']
			),
			
			// Sub-Navigation current background / text current
			'.main-navigation .main-nav ul ul .current-menu-item > a:hover, 
			.main-navigation .main-nav ul ul .current-menu-parent > a:hover, 
			.main-navigation .main-nav ul ul .current-menu-ancestor > a:hover,
			.main-navigation .main-nav ul ul .current-menu-item.sfHover > a, 
			.main-navigation .main-nav ul ul .current-menu-parent.sfHover > a, 
			.main-navigation .main-nav ul ul .current-menu-ancestor.sfHover > a' => array(
				'color' => $generate_settings['subnavigation_text_current_color'],
				'background-color' => $generate_settings['subnavigation_background_current_color']
			),
			
			// Content
			'.inside-article, 
			.comments-area, 
			.page-header,
			.one-container .container,
			.paging-navigation,
			.inside-page-header' => array(
				'background-color' => $generate_settings['content_background_color'],
				'color' => $generate_settings['content_text_color']
			),
			
			// Content links
			'.inside-article a, 
			.inside-article a:visited,
			.paging-navigation a,
			.paging-navigation a:visited,
			.comments-area a,
			.comments-area a:visited,
			.page-header a,
			.page-header a:visited' => array(
				'color' => $generate_settings['content_link_color']
			),
			
			// Content link hover
			'.inside-article a:hover,
			.paging-navigation a:hover,
			.comments-area a:hover,
			.page-header a:hover' => array(
				'color' => $generate_settings['content_link_hover_color']
			),
			
			// Entry header
			'.entry-header h1,
			.page-header h1' => array(
				'color' => $generate_settings['content_title_color']
			),
			
			// Blog post title
			'.entry-title a,
			.entry-title a:visited' => array(
				'color' => $generate_settings['blog_post_title_color']
			),
			
			// Blog post title hover
			'.entry-title a:hover' => array(
				'color' => $generate_settings['blog_post_title_hover_color']
			),
			
			// Entry meta text
			'.entry-meta' => array(
				'color' => $generate_settings['entry_meta_text_color']
			),
			
			// Entry meta links
			'.entry-meta a, 
			.entry-meta a:visited' => array(
				'color' => $generate_settings['entry_meta_link_color']
			),
			
			// Entry meta links hover
			'.entry-meta a:hover' => array(
				'color' => $generate_settings['entry_meta_link_color_hover']
			),
			
			// Heading 1 (H1) color
			'h1' => array(
				'color' => $generate_settings['h1_color']
			),
			
			// Heading 2 (H2) color
			'h2' => array(
				'color' => $generate_settings['h2_color']
			),
			
			// Heading 3 (H3) color
			'h3' => array(
				'color' => $generate_settings['h3_color']
			),
			
			// Sidebar widget
			'.sidebar .widget' => array(
				'background-color' => $generate_settings['sidebar_widget_background_color'],
				'color' => $generate_settings['sidebar_widget_text_color']
			),
			
			// Sidebar widget links
			'.sidebar .widget a, 
			.sidebar .widget a:visited' => array(
				'color' => $generate_settings['sidebar_widget_link_color']
			),
			
			// Sidebar widget link hover
			'.sidebar .widget a:hover' => array(
				'color' => $generate_settings['sidebar_widget_link_hover_color']
			),
			
			// Sidebar widget title
			'.sidebar .widget .widget-title' => array(
				'color' => $generate_settings['sidebar_widget_title_color']
			),
			
			// Footer widget
			'.footer-widgets' => array(
				'background-color' => $generate_settings['footer_widget_background_color'],
				'color' => $generate_settings['footer_widget_text_color']
			),
			
			// Footer widget links
			'.footer-widgets a, 
			.footer-widgets a:visited' => array(
				'color' => $generate_settings['footer_widget_link_color']
			),
			
			// Footer widget link hover
			'.footer-widgets a:hover' => array(
				'color' => $generate_settings['footer_widget_link_hover_color']
			),
			
			// Sidebar widget title
			'.footer-widgets .widget-title' => array(
				'color' => $generate_settings['footer_widget_title_color']
			),
			
			// Footer
			'.site-info' => array(
				'background-color' => $generate_settings['footer_background_color'],
				'color' => $generate_settings['footer_text_color']
			),
			
			// Footer links
			'.site-info a, 
			.site-info a:visited' => array(
				'color' => $generate_settings['footer_link_color']
			),
			
			// Footer link hover
			'.site-info a:hover' => array(
				'color' => $generate_settings['footer_link_hover_color']
			),
			
			// Form input
			'input[type="text"], 
			input[type="email"], 
			input[type="url"], 
			input[type="password"], 
			input[type="search"], 
			textarea' => array(
				'background-color' => $generate_settings['form_background_color'],
				'border-color' => $generate_settings['form_border_color'],
				'color' => $generate_settings['form_text_color']
			),
			
			// Form input focus
			'input[type="text"]:focus, 
			input[type="email"]:focus, 
			input[type="url"]:focus, 
			input[type="password"]:focus, 
			input[type="search"]:focus, 
			textarea:focus' => array(
				'background-color' => $generate_settings['form_background_color_focus'],
				'color' => $generate_settings['form_text_color_focus'],
				'border-color' => $generate_settings['form_border_color_focus']
			),
			
			// Form button
			'button, 
			html input[type="button"], 
			input[type="reset"], 
			input[type="submit"],
			.button,
			.button:visited' => array(
				'background-color' => $generate_settings['form_button_background_color'],
				'color' => $generate_settings['form_button_text_color']
			),
			
			// Form button hover
			'button:hover, 
			html input[type="button"]:hover, 
			input[type="reset"]:hover, 
			input[type="submit"]:hover,
			.button:hover,
			button:focus, 
			html input[type="button"]:focus, 
			input[type="reset"]:focus, 
			input[type="submit"]:focus,
			.button:focus' => array(
				'background-color' => $generate_settings['form_button_background_color_hover'],
				'color' => $generate_settings['form_button_text_color_hover']
			)
			
		);
		
		// Output the above CSS
		$output = '';
		foreach($visual_css as $k => $properties) {
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
	
	/**
	 * Enqueue scripts and styles
	 */
	add_action( 'wp_enqueue_scripts', 'generate_color_scripts', 50 );
	function generate_color_scripts() {

		wp_add_inline_style( 'generate-style', generate_advanced_css() );
	
	}
endif;

if ( ! function_exists( 'generate_mobile_search_color_fallback' ) ) :
/**
 * Add fallback CSS for our mobile search icon color
 */
function generate_mobile_search_color_fallback()
{
	if ( function_exists( 'generate_get_color_defaults' ) ) :
		$generate_settings = wp_parse_args( 
			get_option( 'generate_settings', array() ), 
			generate_get_color_defaults() 
		);
	endif;
	
	$space = ' ';

	// Start the magic
	$visual_css = array (
		
		'.main-navigation .mobile-bar-items a,
		.main-navigation .mobile-bar-items a:hover,
		.main-navigation .mobile-bar-items a:focus' => array(
			'color' => $generate_settings['navigation_text_color']
		)
		
	);
	
	// Output the above CSS
	$output = '';
	foreach($visual_css as $k => $properties) {
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

if ( ! function_exists( 'generate_mobile_search_color_fallback_css' ) ) :
/**
 * Enqueue our mobile search icon color fallback CSS
 */
add_action( 'wp_enqueue_scripts', 'generate_mobile_search_color_fallback_css', 50 );
function generate_mobile_search_color_fallback_css() {

	wp_add_inline_style( 'generate-style', generate_mobile_search_color_fallback() );

}
endif;