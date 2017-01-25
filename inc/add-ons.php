<?php
/*
 WARNING: This is a core Generate file. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Manages addon functionality if they aren't installed
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

require get_template_directory() . '/inc/add-ons/typography.php';
require get_template_directory() . '/inc/add-ons/colors.php';
require get_template_directory() . '/inc/add-ons/spacing.php';
require get_template_directory() . '/inc/add-ons/disable-elements.php';

if ( ! function_exists( 'generate_get_premium_url' ) ) :
/**
 * Generate a URL to our premium add-ons
 * Allows the use of a referral ID and campaign
 * @since 1.3.42
 */
function generate_get_premium_url( $url = 'https://generatepress.com/premium' ) 
{
	// Get our URL
	$url = trailingslashit( $url );
	
	// Set up args
	$args = apply_filters( 'generate_premium_url_args', array(
		'ref' => null,
		'campaign' => null
	) );
	
	// Set up our URL if we have an ID
	if ( isset( $args[ 'ref' ] ) ) {
		$url = esc_url( add_query_arg( 'ref', absint( $args[ 'ref' ] ), $url ) );
	}
	
	// Set up our URL if we have a campaign
	if ( isset( $args[ 'campaign' ] ) ) {
		$url = esc_url( add_query_arg( 'campaign', sanitize_text_field( $args[ 'campaign' ] ), $url ) );
	}
	
	// Return our URL with the optional referral ID
	return esc_url( $url );
}
endif;

if ( ! function_exists( 'generate_addons_available' ) ) :
/** 
 * Check to see if there's any addons not already activated
 * @since 1.0.9
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

if ( ! function_exists( 'generate_include_default_styles' ) ) :
/** 
 * Check whether we should include our defaults.css file
 * @since 1.3.42
 */
function generate_include_default_styles() 
{
	// If Spacing is activated
	if ( defined( 'GENERATE_SPACING_VERSION' ) ) {
		// If we don't have this function, we can't include defaults.css
		if ( ! function_exists( 'generate_include_spacing_defaults' ) ) {
			return false;
		}
	}
	
	// If Typography is activated
	if ( defined( 'GENERATE_FONT_VERSION' ) ) {
		// If we don't have this function, we can't include defaults.css
		if ( ! function_exists( 'generate_include_typography_defaults' ) ) {
			return false;
		}
	}
	
	// We made it this far, return true through a filter
	return apply_filters( 'generate_include_default_styles', true );
}
endif;