<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_is_footer_bar_active' ) ) :
/**
 * Check to see if we're using our footer bar widget
 *
 * @since 1.3.42
 */
function generate_is_footer_bar_active()  {
	return ( is_active_sidebar( 'footer-bar' ) ) ? true : false;
}
endif;

if ( ! function_exists( 'generate_is_top_bar_active' ) ) :
/**
 * Check to see if the top bar is active
 *
 * @since 1.3.45
 */
function generate_is_top_bar_active() {
	$top_bar = is_active_sidebar( 'top-bar' ) ? true : false;
	return apply_filters( 'generate_is_top_bar_active', $top_bar );
}
endif;

if ( function_exists( 'is_customize_preview' ) ) :
/**
 * Adds a hidden navigation if no navigation is set
 * This allows us to use postMessage to position the navigation when it doesn't exist
 *
 * @since 1.4
 */
add_action( 'wp_footer','generate_do_hidden_navigation' );
function generate_do_hidden_navigation() {
	if ( is_customize_preview() && function_exists( 'generate_navigation_position' ) ) {
		?>
		<div style="display:none;">
			<?php generate_navigation_position(); ?>
		</div>
		<?php
	}
}
endif;

if ( ! function_exists( 'generate_customize_partial_blogname' ) ) :
/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.3.41
 */
function generate_customize_partial_blogname() {
	bloginfo( 'name' );
}
endif;

if ( ! function_exists( 'generate_customize_partial_blogdescription' ) ) :
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.3.41
 */
function generate_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
endif;

if ( ! function_exists( 'generate_get_default_color_palettes' ) ) :
/**
 * Set up our colors for the color picker palettes and filter them so you can change them
 * @since 1.3.42
 * function_exists() as function is defined in GP Premium
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
 * function_exists() as function is defined in GP Premium
 */
add_action( 'customize_controls_enqueue_scripts','generate_enqueue_color_palettes' );
function generate_enqueue_color_palettes() {
	// Old versions of WP don't get nice things
	if ( ! function_exists( 'wp_add_inline_script' ) )
		return;
	
	// Grab our palette array and turn it into JS
	$palettes = json_encode( generate_get_default_color_palettes() );
	
	// Add our custom palettes
	// json_encode takes care of escaping
	wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $palettes . ';' );
}
endif;

if ( ! function_exists( 'generate_sanitize_integer' ) ) :
/**
 * Sanitize integers
 * @since 1.0.8
 * function_exists() as function used to exist in GP Premium
 */
function generate_sanitize_integer( $input ) {
	return absint( $input );
}
endif;

if ( ! function_exists( 'generate_sanitize_decimal_integer' ) ) :
/**
 * Sanitize integers that can use decimals
 * @since 1.3.41
 * function_exists() as function used to exist in GP Premium
 */
function generate_sanitize_decimal_integer( $input ) {
	return abs( floatval( $input ) );
}
endif;

if ( ! function_exists( 'generate_sanitize_checkbox' ) ) :
/**
 * Sanitize checkbox values
 * @since 1.0.8
 * function_exists() as function used to exist in GP Premium
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

if ( ! function_exists( 'generate_sanitize_blog_excerpt' ) ) :
/**
 * Sanitize blog excerpt
 * @since 1.0.8
 * Needed because GP Premium calls the control ID which is different from the settings ID
 * function_exists() as function used to exist in GP Premium
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
 * function_exists() as function used to exist in GP Premium
 */
function generate_sanitize_hex_color( $color ) {
    if ( '' === $color ) {
        return '';
	}
 
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
	}
 
    return '';
}
endif;

if ( ! function_exists( 'generate_sanitize_choices' ) ) :
/**
 * Sanitize choices
 * @since 1.3.24
 * function_exists() as function used to exist in GP Premium
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