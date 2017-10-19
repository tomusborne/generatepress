<?php
/**
 * Migrates old options on update.
 *
 * @package GeneratePress
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'generate_update_logo_setting' ) ) {
	add_action( 'admin_init', 'generate_update_logo_setting' );
	/**
	 * Migrate the old logo database entry to the new custom_logo theme mod (WordPress 4.5)
	 *
	 * @since 1.3.29
	 */
	function generate_update_logo_setting() {
		// If we're not running WordPress 4.5, bail.
		if ( ! function_exists( 'the_custom_logo' ) ) {
			return;
		}

		// If we already have a custom logo, bail.
		if ( get_theme_mod( 'custom_logo' ) ) {
			return;
		}

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
}

if ( ! function_exists( 'generate_typography_convert_values' ) ) {
	add_action('admin_init', 'generate_typography_convert_values' );
	/**
	 * Take the old body font value and strip it of variants
	 * This should only run once
	 * @since 1.3.0
	 */
	function generate_typography_convert_values() {
		// Don't run this if Typography add-on is activated
		if ( function_exists( 'generate_fonts_customize_register' ) ) {
			return;
		}

		// If we've done this before, bail
		if ( 'true' == get_option( 'generate_update_core_typography' ) || 'true' == get_option( 'generate_update_premium_typography' ) ) {
			return;
		}

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
		if ( strpos( $value, ':' ) !== false && ! empty( $value ) ) {

			// Remove the : and anything past it
			$value = current( explode( ':', $value ) );

			// Populate our new array with our new, clean value
			$new_settings[ 'font_body' ] = $value;

		}

		// Update our options if our new array isn't empty
		if ( ! empty( $new_settings ) ) {
			$generate_new_typography_settings = wp_parse_args( $new_settings, $generate_settings );
			update_option( 'generate_settings', $generate_new_typography_settings );
		}

		// All done, set an option so we don't go through this again
		update_option( 'generate_update_core_typography','true' );
	}
}

if ( ! function_exists( 'generate_typography_set_font_data' ) ) {
	add_action( 'admin_init', 'generate_typography_set_font_data' );
	/**
	 * This function will check to see if your category and variants are saved
	 * If not, it will set them for you
	 * Generally, set_theme_mod isn't best practice, but this is here for migration purposes for a set amount of time only
	 * Any time a user saves a font in the Customizer from now on, the category and variants are saved as theme_mods, so this function won't be necessary.
	 *
	 * @since 1.3.40
	 */
	function generate_typography_set_font_data() {
		// Get our defaults
		$defaults = generate_get_default_fonts();

		// Get our settings
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			$defaults
		);

		// We don't need to do this if we're using the default font, as these values have defaults already
		if ( $defaults[ 'font_body' ] == $generate_settings[ 'font_body' ] ) {
			return;
		}

		// Don't need to continue if we're using a system font or our default font
		if ( in_array( $generate_settings[ 'font_body' ], generate_typography_default_fonts() ) ) {
			return;
		}

		// Don't continue if our category and variants are already set
		if ( get_theme_mod( 'font_body_category' ) && get_theme_mod( 'font_body_variants' ) ) {
			return;
		}

		// Get all of our fonts
		$fonts = generate_get_all_google_fonts();

		// Get the ID from our font
		$id = strtolower( str_replace( ' ', '_', $generate_settings[ 'font_body' ] ) );

		// If the ID doesn't exist within our fonts, we can bail
		if ( ! array_key_exists( $id, $fonts ) ) {
			return;
		}

		// Let's grab our category to go with our font
		$category = ! empty( $fonts[$id]['category'] ) ? $fonts[$id]['category'] : '';

		// Grab all of the variants associated with our font
		$variants = $fonts[$id]['variants'];

		// Loop through our variants and put them into an array, then turn them into a comma separated list
		$output = array();
		if ( $variants ) {
			foreach ( $variants as $variant ) {
				$output[] = $variant;
			}
			$variants = implode(',', $output);
		}

		// Set our theme mods with our new settings
		if ( '' !== $category ) {
			set_theme_mod( 'font_body_category', $category );
		}

		if ( '' !== $variants ) {
			set_theme_mod( 'font_body_variants', $variants );
		}
	}
}

add_action( 'admin_init', 'generate_migrate_font_awesome_library' );
/**
 * Turn on the full Font Awesome library if content exists on the site.
 *
 * We want essentials to be the default, but need existing sites to continue
 * loading the full library.
 *
 * @since 1.5
 */
function generate_migrate_font_awesome_library() {
	$settings = get_option( 'generate_migration_settings', array() );

	if ( isset( $settings['font_awesome_essentials_updated'] ) && 'true' == $settings['font_awesome_essentials_updated'] ) {
		return;
	}

	$existing_settings = get_option( 'generate_settings' );

	// If we have existing settings, we should use the full FA library.
	if ( ! empty( $existing_settings ) ) {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		$new_settings = array();
		$new_settings[ 'font_awesome' ] = 'full-library';

		$update_settings = wp_parse_args( $new_settings, $generate_settings );
		update_option( 'generate_settings', $update_settings );
	}

	$updated = array();
	$updated['font_awesome_essentials_updated'] = 'true';
	$migration_settings = wp_parse_args( $updated, $settings );
	update_option( 'generate_migration_settings', $migration_settings );
}
