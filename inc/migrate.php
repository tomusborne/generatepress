<?php
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_update_logo_setting' ) ) :
/**
 * Migrate the old logo database entry to the new custom_logo theme mod (WordPress 4.5)
 *
 * @since 1.3.29
 */
add_action( 'admin_init', 'generate_update_logo_setting' );
function generate_update_logo_setting() 
{
	// If we're not running WordPress 4.5, bail.
	if ( ! function_exists( 'the_custom_logo' ) )
		return;
	
	// If we already have a custom logo, bail.
	if ( get_theme_mod( 'custom_logo' ) )
		return;
	
	// Get our settings.
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Get the old logo value.
	$old_value = $generate_settings['logo'];
	
	// If there's no old value, bail.
	if ( empty( $old_value ) )
		return;
	
	// We made it this far, that means we have an old logo, and no new logo.
	
	// Let's get the ID from our old value.
	$logo = attachment_url_to_postid( $old_value );
	
	// Now let's update the new logo setting with our ID.
	if ( is_int( $logo ) ) {
		set_theme_mod( 'custom_logo', $logo );
	}
	
	// Got our custom logo? Time to delete the old value
	if ( get_theme_mod( 'custom_logo' ) ) {
		$new_settings[ 'logo' ] = '';
		$update_settings = wp_parse_args( $new_settings, $generate_settings );
		update_option( 'generate_settings', $update_settings );
	}
}
endif;

if ( ! function_exists( 'generate_typography_convert_values' ) ) :
/**
 * Take the old body font value and strip it of variants
 * This should only run once
 * @since 1.3.0
 */
add_action('admin_init', 'generate_typography_convert_values');
function generate_typography_convert_values()
{
	// Don't run this if Typography add-on is activated
	if ( function_exists( 'generate_fonts_customize_register' ) )
		return;
	
	// If we've done this before, bail
	if ( 'true' == get_option( 'generate_update_core_typography' ) || 'true' == get_option( 'generate_update_premium_typography' ) )
		return;
	
	// Get all settings
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_default_fonts() 
	);
	
	// Get our body font family setting
	$value = $generate_settings[ 'font_body' ];
	
	// Create a new, empty array
	$new_settings = array();
	
	// If our value has : in it, and isn't empty
	if ( strpos( $value, ':' ) !== false && ! empty( $value ) ) :
		
		// Remove the : and anything past it
		$value = current( explode( ':', $value ) );
		
		// Populate our new array with our new, clean value
		$new_settings[ 'font_body' ] = $value;
		
	endif;
	
	// Update our options if our new array isn't empty
	if ( ! empty( $new_settings ) ) :
		$generate_new_typography_settings = wp_parse_args( $new_settings, $generate_settings );
		update_option( 'generate_settings', $generate_new_typography_settings );
	endif;
	
	// All done, set an option so we don't go through this again
	update_option( 'generate_update_core_typography','true' );
}
endif;