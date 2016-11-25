<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_sanitize_integer' ) ) :
/**
 * Sanitize integers
 * @since 1.0.8
 */
function generate_sanitize_integer( $input ) {
	return absint( $input );
}
endif;

if ( ! function_exists( 'generate_sanitize_decimal_integer' ) ) :
/**
 * Sanitize integers that can use decimals
 * @since 1.3.41
 */
function generate_sanitize_decimal_integer( $input ) {
	return abs( floatval( $input ) );
}
endif;

if ( ! function_exists( 'generate_sanitize_checkbox' ) ) :
/**
 * Sanitize checkbox values
 * @since 1.0.8
 */
function generate_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
endif;

if ( ! function_exists( 'generate_sanitize_typography' ) ) :
/**
 * Sanitize typography dropdown
 * @since 1.1.10
 */
function generate_sanitize_typography( $input ) 
{
	// Grab all of our fonts
	$fonts = generate_get_all_google_fonts();
	
	// Loop through all of them and grab their names
	$font_names = array();
	foreach ( $fonts as $k => $fam ) {
		$font_names[] = $fam['name'];
	}
	
	// Get all non-Google font names
	$not_google = generate_typography_default_fonts();

	// Merge them both into one array
	$valid = array_merge( $font_names, $not_google );
	
	// Sanitize
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'Open Sans';
    }
}
endif;

if ( ! function_exists( 'generate_sanitize_blog_excerpt' ) ) :
/**
 * Sanitize blog excerpt
 * @since 1.0.8
 * Needed because GP Premium calls the control ID which is different from the settings ID
 */
function generate_sanitize_blog_excerpt( $input ) {
    $valid = array(
        'full',
		'excerpt'
    );
 
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'full';
    }
}
endif;

if ( ! function_exists( 'generate_sanitize_hex_color' ) ) :
/**
 * Sanitize colors
 * Allow blank value
 * @since 1.2.9.6
 */
function generate_sanitize_hex_color( $color ) {
    if ( '' === $color )
        return '';
 
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
        return $color;
 
    return '';
}
endif;

if ( ! function_exists( 'generate_sanitize_choices' ) ) :
/**
 * Sanitize choices
 * @since 1.3.24
 */
function generate_sanitize_choices( $input, $setting ) {
	
	// Ensure input is a slug
	$input = sanitize_key( $input );
	
	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

if ( ! function_exists( 'generate_sanitize_font_weight' ) ) :
/**
 * Sanitize font weight
 * @since 1.1.10
 * @deprecated 1.3.40
 */
function generate_sanitize_font_weight( $input ) {

    $valid = array(
        'normal',
		'bold',
		'100',
		'200',
		'300',
		'400',
		'500',
		'600',
		'700',
		'800',
		'900'
    );
 
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'normal';
    }
}
endif;

if ( ! function_exists( 'generate_sanitize_text_transform' ) ) :
/**
 * Sanitize text transform
 * @since 1.1.10
 * @deprecated 1.3.40
 */
function generate_sanitize_text_transform( $input ) {

    $valid = array(
        'none',
		'capitalize',
		'uppercase',
		'lowercase'
    );
 
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'none';
    }
}
endif;