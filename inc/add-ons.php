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
		$url = add_query_arg( 'ref', absint( $args[ 'ref' ] ), $url );
	}
	
	// Set up our URL if we have a campaign
	if ( isset( $args[ 'campaign' ] ) ) {
		$url = add_query_arg( 'campaign', sanitize_text_field( $args[ 'campaign' ] ), $url );
	}
	
	// Return our URL with the optional referral ID
	return esc_url( $url );
}
endif;