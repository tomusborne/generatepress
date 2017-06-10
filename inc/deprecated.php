<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_paging_nav' ) ) :
/**
 * Build the pagination links
 * @since 1.3.35
 * @deprecated 1.3.45
 */
function generate_paging_nav() {
	_deprecated_function( __FUNCTION__, '1.3.45', "the_posts_navigation()" );
	if ( function_exists( 'the_posts_pagination' ) ) {
		the_posts_pagination( array(
			'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
			'prev_text' => __( '&larr; Previous', 'generatepress' ),
			'next_text' => __( 'Next &rarr;', 'generatepress' )
		) );
	}
}
endif;

if ( ! function_exists( 'generate_additional_spacing' ) ) :
/**
 * Add fallback CSS for our mobile search icon color
 * @deprecated 1.3.47
 */
function generate_additional_spacing() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) :
/**
 * Enqueue our mobile search icon color fallback CSS
 * @deprecated 1.3.47
 */
function generate_mobile_search_spacing_fallback_css() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_addons_available' ) ) :
/** 
 * Check to see if there's any addons not already activated
 * @since 1.0.9
 * @deprecated 1.3.47
 */
function generate_addons_available()
{
	if ( defined( 'GP_PREMIUM_VERSION' ) )
		return false;
		
	if ( !function_exists('generate_fonts_setup') ||
		!function_exists('generate_colors_setup') ||
		!function_exists('generate_backgrounds_setup') ||
		!function_exists('generate_page_header') ||
		!function_exists('generate_menu_plus_setup') ||
		!function_exists('generate_insert_import_export') ||
		!function_exists('generate_copyright_option') ||
		!function_exists('generate_disable_elements') ||
		!function_exists('generate_blog_get_defaults') ||
		!function_exists('generate_hooks_setup') ||
		!function_exists('generate_secondary_nav_setup') ||
		!function_exists('generate_sections_styles') ||
		!function_exists('generate_spacing_setup')) :
			return true;
		else :
			return false;
		endif;
}
endif;

if ( ! function_exists( 'generate_no_addons' ) ) :
/** 
 * Check to see if no addons are activated
 * @since 1.0.9
 * @deprecated 1.3.47
 */
function generate_no_addons()
{
	if ( defined( 'GP_PREMIUM_VERSION' ) )
		return false;
		
	if ( !function_exists('generate_fonts_setup') &&
		!function_exists('generate_colors_setup') &&
		!function_exists('generate_backgrounds_setup') &&
		!function_exists('generate_page_header') &&
		!function_exists('generate_menu_plus_setup') &&
		!function_exists('generate_insert_import_export') &&
		!function_exists('generate_copyright_option') &&
		!function_exists('generate_disable_elements') &&
		!function_exists('generate_blog_get_defaults') &&
		!function_exists('generate_hooks_setup') &&
		!function_exists('generate_secondary_nav_setup') &&
		!function_exists('generate_sections_styles') &&
		!function_exists('generate_spacing_setup')) :
			return true;
		else :
			return false;
		endif;
}
endif;