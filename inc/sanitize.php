<?php
/**
 * Sanitize integers
 * @since 1.0.8
 */
function generate_sanitize_integer( $input ) {
	return absint( $input );
}

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

/**
 * Sanitize typography dropdown
 * @since 1.1.10
 */
function generate_sanitize_typography( $input ) 
{

	// Grab all of our fonts
	$fonts = ( get_transient('generate_all_google_fonts') ? get_transient('generate_all_google_fonts') : array() );
	
	// Loop through all of them and grab their names
	$font_names = array();
	foreach ( $fonts as $k => $fam ) {
		$font_names[] = $fam['name'];
	}
	
	// Get all non-Google font names
	$not_google = array(
		'inherit',
		'Arial, Helvetica, sans-serif',
		'Century Gothic',
		'Comic Sans MS',
		'Courier New',
		'Georgia, Times New Roman, Times, serif',
		'Helvetica',
		'Impact',
		'Lucida Console',
		'Lucida Sans Unicode',
		'Palatino Linotype',
		'Tahoma, Geneva, sans-serif',
		'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif'
	);

	// Merge them both into one array
	$valid = array_merge( $font_names, $not_google );
	
	// Sanitize
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return 'Open Sans';
    }
}

/**
 * Sanitize font weight
 * @since 1.1.10
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

/**
 * Sanitize text transform
 * @since 1.1.10
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

/**
 * Sanitize blog excerpt
 * @since 1.0.8
 */
function generate_sanitize_blog_excerpt( $input ) {
    $valid = array(
        'full' => __( 'Show full post', 'generatepress' ),
		'excerpt' => __( 'Show excerpt', 'generatepress' )
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'full';
    }
}

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