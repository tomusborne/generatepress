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
 * @link     https://generatepress.com
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !function_exists('generate_get_color_defaults') ) :
/**
 * Set default options
 */
function generate_get_color_defaults()
{
	$generate_color_defaults = array(
		'header_background_color' => '#ffffff',
		'header_text_color' => '#3a3a3a',
		'header_link_color' => '#3a3a3a',
		'header_link_hover_color' => '',
		'site_title_color' => '#222222',
		'site_tagline_color' => '#999999',
		'navigation_background_color' => '#222222',
		'navigation_text_color' => '#ffffff',
		'navigation_background_hover_color' => '#3f3f3f',
		'navigation_text_hover_color' => '#ffffff',
		'navigation_background_current_color' => '#3f3f3f',
		'navigation_text_current_color' => '#ffffff',
		'subnavigation_background_color' => '#3f3f3f',
		'subnavigation_text_color' => '#ffffff',
		'subnavigation_background_hover_color' => '#4f4f4f',
		'subnavigation_text_hover_color' => '#ffffff',
		'subnavigation_background_current_color' => '#4f4f4f',
		'subnavigation_text_current_color' => '#ffffff',
		'content_background_color' => '#ffffff',
		'content_text_color' => '',
		'content_link_color' => '',
		'content_link_hover_color' => '',
		'content_title_color' => '',
		'blog_post_title_color' => '',
		'blog_post_title_hover_color' => '',
		'entry_meta_text_color' => '#888888',
		'entry_meta_link_color' => '#666666',
		'entry_meta_link_color_hover' => '#1e73be',
		'h1_color' => '',
		'h2_color' => '',
		'h3_color' => '',
		'sidebar_widget_background_color' => '#ffffff',
		'sidebar_widget_text_color' => '',
		'sidebar_widget_link_color' => '',
		'sidebar_widget_link_hover_color' => '',
		'sidebar_widget_title_color' => '#000000',
		'footer_widget_background_color' => '#ffffff',
		'footer_widget_text_color' => '',
		'footer_widget_link_color' => '',
		'footer_widget_link_hover_color' => '',
		'footer_widget_title_color' => '#000000',
		'footer_background_color' => '#222222',
		'footer_text_color' => '#ffffff',
		'footer_link_color' => '#ffffff',
		'footer_link_hover_color' => '#606060',
		'form_background_color' => '#fafafa',
		'form_text_color' => '#666666',
		'form_background_color_focus' => '#ffffff',
		'form_text_color_focus' => '#666666',
		'form_border_color' => '#cccccc',
		'form_border_color_focus' => '#bfbfbf',
		'form_button_background_color' => '#666666',
		'form_button_background_color_hover' => '#3f3f3f',
		'form_button_text_color' => '#ffffff',
		'form_button_text_color_hover' => '#ffffff'
	);
	
	return apply_filters( 'generate_color_option_defaults', $generate_color_defaults );
}
endif;

if ( ! function_exists( 'generate_advanced_css' ) ) :
/**
 * Generate the CSS in the <head> section using the Theme Customizer
 * @since 0.1
 */
function generate_advanced_css()
{
	// Get our settings
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_color_defaults() 
	);
	
	// Initiate our CSS class
	$css = new GeneratePress_CSS;
	
	// Header
	$css->set_selector( '.site-header' );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'header_background_color' ] ) );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'header_text_color' ] ) );
	
	// Header link
	$css->set_selector( '.site-header a,.site-header a:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'header_link_color' ] ) );
	
	// Header link hover
	$css->set_selector( '.site-header a:hover' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'header_link_hover_color' ] ) );
	
	// Site title
	$css->set_selector( '.main-title a,.main-title a:hover,.main-title a:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'site_title_color' ] ) );
	
	// Site description
	$css->set_selector( '.site-description' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'site_tagline_color' ] ) );
	
	// Navigation styling
	if ( '' !== generate_get_navigation_location() || is_customize_preview() ) {
		// Navigation background
		$css->set_selector( '.main-navigation,.main-navigation ul ul' );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'navigation_background_color' ] ) );
		
		// Navigation text
		$css->set_selector( '.main-navigation .main-nav ul li a,.menu-toggle' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_text_color' ] ) );
		
		// Navigation background/text on hover
		$css->set_selector( '.main-navigation .main-nav ul li > a:hover,.main-navigation .main-nav ul li > a:focus, .main-navigation .main-nav ul li.sfHover > a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_text_hover_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'navigation_background_hover_color' ] ) );
		
		// Mobile button text
		$css->set_selector( 'button.menu-toggle:hover,button.menu-toggle:focus,.main-navigation .mobile-bar-items a,.main-navigation .mobile-bar-items a:hover,.main-navigation .mobile-bar-items a:focus' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_text_color' ] ) );
		
		// Navigation background/text current
		$css->set_selector( '.main-navigation .main-nav ul li[class*="current-menu-"] > a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_text_current_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'navigation_background_current_color' ] ) );
		
		// Navigation background text current text hover
		$css->set_selector( '.main-navigation .main-nav ul li[class*="current-menu-"] > a:hover,.main-navigation .main-nav ul li[class*="current-menu-"].sfHover > a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_text_current_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'navigation_background_current_color' ] ) );
		
		// Navigation search styling
		if ( 'enable' == generate_get_setting( 'nav_search' ) ) {
			// Navigation search input
			$css->set_selector( '.navigation-search input[type="search"],.navigation-search input[type="search"]:active' );
			$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_background_hover_color' ] ) );
			$css->add_property( 'background-color', esc_attr( $generate_settings[ 'navigation_background_hover_color' ] ) );

			// Navigation search input on focus
			$css->set_selector( '.navigation-search input[type="search"]:focus' );
			$css->add_property( 'color', esc_attr( $generate_settings[ 'navigation_text_hover_color' ] ) );
			$css->add_property( 'background-color', esc_attr( $generate_settings[ 'navigation_background_hover_color' ] ) );
		}
		
		// Sub-navigation background
		$css->set_selector( '.main-navigation ul ul' );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'subnavigation_background_color' ] ) );
		
		// Sub-navigation text
		$css->set_selector( '.main-navigation .main-nav ul ul li a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'subnavigation_text_color' ] ) );
		
		// Sub-Navigation background/text on hover
		$css->set_selector( '.main-navigation .main-nav ul ul li > a:hover,.main-navigation .main-nav ul ul li > a:focus,.main-navigation .main-nav ul ul li.sfHover > a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'subnavigation_text_hover_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'subnavigation_background_hover_color' ] ) );
		
		// Sub-Navigation background / text current
		$css->set_selector( '.main-navigation .main-nav ul ul li[class*="current-menu-"] > a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'subnavigation_text_current_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'subnavigation_background_current_color' ] ) );
		
		// Sub-Navigation current background / text current
		$css->set_selector( '.main-navigation .main-nav ul ul li[class*="current-menu-"] > a:hover,.main-navigation .main-nav ul ul li[class*="current-menu-"].sfHover > a' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'subnavigation_text_current_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'subnavigation_background_current_color' ] ) );
	}
	
	// Content
	$css->set_selector( '.inside-article, .comments-area, .page-header,.one-container .container,.paging-navigation,.inside-page-header' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'content_text_color' ] ) );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'content_background_color' ] ) );
	
	// Content links
	$css->set_selector( '.inside-article a,.inside-article a:visited,.paging-navigation a,.paging-navigation a:visited,.comments-area a,.comments-area a:visited,.page-header a,.page-header a:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'content_link_color' ] ) );
	
	// Content links on hover
	$css->set_selector( '.inside-article a:hover,.paging-navigation a:hover,.comments-area a:hover,.page-header a:hover' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'content_link_hover_color' ] ) );
	
	// Entry header
	$css->set_selector( '.entry-header h1,.page-header h1' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'content_title_color' ] ) );
	
	// Blog post title
	$css->set_selector( '.entry-title a,.entry-title a:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'blog_post_title_color' ] ) );
	
	// Blog post title on hover
	$css->set_selector( '.entry-title a:hover' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'blog_post_title_hover_color' ] ) );
	
	// Entry meta text
	$css->set_selector( '.entry-meta' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'entry_meta_text_color' ] ) );
	
	// Entry meta links
	$css->set_selector( '.entry-meta a,.entry-meta a:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'entry_meta_link_color' ] ) );
	
	// Entry meta links on hover
	$css->set_selector( '.entry-meta a:hover' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'entry_meta_link_color_hover' ] ) );
	
	// H1 color
	$css->set_selector( 'h1' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'h1_color' ] ) );
	
	// H2 color
	$css->set_selector( 'h2' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'h2_color' ] ) );
	
	// H1 color
	$css->set_selector( 'h3' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'h3_color' ] ) );
	
	// Sidebar widgets
	if ( 'no-sidebar' !== generate_get_layout() ) {
		// Sidebar widget
		$css->set_selector( '.sidebar .widget' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'sidebar_widget_text_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'sidebar_widget_background_color' ] ) );
		
		// Sidebar widget links
		$css->set_selector( '.sidebar .widget a,.sidebar .widget a:visited' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'sidebar_widget_link_color' ] ) );
		
		// Sidebar widget links on hover
		$css->set_selector( '.sidebar .widget a:hover' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'sidebar_widget_link_hover_color' ] ) );
		
		// Sidebar widget title
		$css->set_selector( '.sidebar .widget .widget-title' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'sidebar_widget_title_color' ] ) );
	}
	
	// Footer widgets
	$footer_widgets = generate_get_footer_widgets();
	if ( ! empty( $footer_widgets ) && 0 !== $footer_widgets ) {
		// Footer widget
		$css->set_selector( '.footer-widgets' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_widget_text_color' ] ) );
		$css->add_property( 'background-color', esc_attr( $generate_settings[ 'footer_widget_background_color' ] ) );
		
		// Footer widget links
		$css->set_selector( '.footer-widgets a,.footer-widgets a:visited' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_widget_link_color' ] ) );
		
		// Footer widget links on hover
		$css->set_selector( '.footer-widgets a:hover' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_widget_link_hover_color' ] ) );
		
		// Footer widget title
		$css->set_selector( '.footer-widgets .widget-title' );
		$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_widget_title_color' ] ) );
	}
	
	// Footer
	$css->set_selector( '.site-info' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_text_color' ] ) );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'footer_background_color' ] ) );
	
	// Footer links
	$css->set_selector( '.site-info a,.site-info a:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_link_color' ] ) );
	
	// Footer links on hover
	$css->set_selector( '.site-info a:hover' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_link_hover_color' ] ) );
	
	// Footer bar widget menu
	$css->set_selector( '.footer-bar .widget_nav_menu .current-menu-item a' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'footer_link_hover_color' ] ) );
	
	// Form input
	$css->set_selector( 'input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],textarea' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'form_text_color' ] ) );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'form_background_color' ] ) );
	$css->add_property( 'border-color', esc_attr( $generate_settings[ 'form_border_color' ] ) );
	
	// Form input on focus
	$css->set_selector( 'input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,textarea:focus' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'form_text_color_focus' ] ) );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'form_background_color_focus' ] ) );
	$css->add_property( 'border-color', esc_attr( $generate_settings[ 'form_border_color_focus' ] ) );
	
	// Form button
	$css->set_selector( 'button,html input[type="button"],input[type="reset"],input[type="submit"],.button,.button:visited' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'form_button_text_color' ] ) );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'form_button_background_color' ] ) );
	
	// Form button on hover
	$css->set_selector( 'button:hover,html input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.button:hover,button:focus,html input[type="button"]:focus,input[type="reset"]:focus,input[type="submit"]:focus,.button:focus' );
	$css->add_property( 'color', esc_attr( $generate_settings[ 'form_button_text_color_hover' ] ) );
	$css->add_property( 'background-color', esc_attr( $generate_settings[ 'form_button_background_color_hover' ] ) );
	
	// Allow us to hook CSS into our output
	do_action( 'generate_colors_css', $css );
	
	// Return our dynamic CSS
	return $css->css_output();
}
endif;

if ( ! function_exists( 'generate_color_scripts' ) ) :
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'generate_color_scripts', 50 );
function generate_color_scripts() {
	wp_add_inline_style( 'generate-style', generate_advanced_css() );
}
endif;

if ( ! function_exists( 'generate_get_default_color_palettes' ) ) :
/**
 * Set up our colors for the color picker palettes and filter them so you can change them
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
endif;

if ( ! function_exists( 'generate_enqueue_color_palettes' ) ):
/**
 * Add our custom color palettes to the color pickers in the Customizer
 * @since 1.3.42
 */
add_action( 'customize_controls_enqueue_scripts','generate_enqueue_color_palettes' );
function generate_enqueue_color_palettes() 
{
	// Old versions of WP don't get nice things
	if ( ! function_exists( 'wp_add_inline_script' ) )
		return;
	
	// Grab our palette array and turn it into JS
	$palettes = json_encode( generate_get_default_color_palettes() );
	
	// Add our custom palettes
	wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . sanitize_text_field( $palettes ) . ';' );
}
endif;