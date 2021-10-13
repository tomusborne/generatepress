<?php
/**
 * This file handles typography migration.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles all of our typography migration.
 */
class GeneratePress_Typography_Migration {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @var $instance Class instance.
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Map our new typography keys to the old prefixes.
	 */
	public static function get_option_prefixes() {
		$data = array(
			array(
				'selector' => 'body',
				'legacy_prefix' => 'body',
				'group' => 'base',
				'module' => 'core',
			),
			array(
				'selector' => 'top-bar',
				'legacy_prefix' => 'top_bar',
				'group' => 'widgets',
				'module' => 'core',
			),
			array(
				'selector' => 'main-title',
				'legacy_prefix' => 'site_title',
				'group' => 'header',
				'module' => 'core',
			),
			array(
				'selector' => 'site-description',
				'legacy_prefix' => 'site_tagline',
				'group' => 'header',
				'module' => 'core',
			),
			array(
				'selector' => 'primary-menu-items',
				'legacy_prefix' => 'navigation',
				'group' => 'primaryNavigation',
				'module' => 'core',
			),
			array(
				'selector' => 'widget-titles',
				'legacy_prefix' => 'widget_title',
				'group' => 'widgets',
				'module' => 'core',
			),
			array(
				'selector' => 'buttons',
				'legacy_prefix' => 'buttons',
				'group' => 'content',
				'module' => 'core',
			),
			array(
				'selector' => 'single-content-title',
				'legacy_prefix' => 'single_post_title',
				'group' => 'content',
				'module' => 'core',
			),
			array(
				'selector' => 'archive-content-title',
				'legacy_prefix' => 'archive_post_title',
				'group' => 'content',
				'module' => 'core',
			),
			array(
				'selector' => 'footer',
				'legacy_prefix' => 'footer',
				'group' => 'footer',
				'module' => 'core',
			),
		);

		$headings = array(
			'h1' => 'heading_1',
			'h2' => 'heading_2',
			'h3' => 'heading_3',
			'h4' => 'heading_4',
			'h5' => 'heading_5',
			'h6' => 'heading_6',
		);

		foreach ( $headings as $selector => $legacy_prefix ) {
			$data[] = array(
				'selector' => $selector,
				'legacy_prefix' => $legacy_prefix,
				'group' => 'content',
				'module' => 'core',
			);
		}

		if ( function_exists( 'generate_secondary_nav_typography_selectors' ) ) {
			$data[] = array(
				'selector' => 'secondary-nav-menu-items',
				'legacy_prefix' => 'secondary_navigation',
				'group' => 'secondaryNavigation',
				'module' => 'secondary-nav',
			);
		}

		if ( function_exists( 'generate_menu_plus_typography_selectors' ) ) {
			$data[] = array(
				'selector' => 'off-canvas-panel-menu-items',
				'legacy_prefix' => 'slideout',
				'group' => 'offCanvasPanel',
				'module' => 'off-canvas-panel',
			);
		}

		if ( function_exists( 'generate_woocommerce_typography_selectors' ) ) {
			$data[] = array(
				'selector' => 'woocommerce-catalog-product-titles',
				'legacy_prefix' => 'wc_product_title',
				'group' => 'wooCommerce',
				'module' => 'woocommerce',
			);

			$data[] = array(
				'selector' => 'woocommerce-related-product-titles',
				'legacy_prefix' => 'wc_related_product_title',
				'group' => 'wooCommerce',
				'module' => 'woocommerce',
			);
		}

		return $data;
	}

	/**
	 * Check if we have a saved value.
	 *
	 * @param string $id The option ID.
	 * @param array  $settings The saved settings.
	 * @param array  $defaults The defaults.
	 */
	public static function has_saved_value( $id, $settings, $defaults ) {
		return isset( $settings[ $id ] )
			&& isset( $defaults[ $id ] )
			&& $defaults[ $id ] !== $settings[ $id ] // Need this because the Customizer treats defaults as saved values.
			&& (
				! empty( $settings[ $id ] )
				|| 0 === $settings[ $id ]
			);
	}

	/**
	 * Get all of our mapped typography data.
	 */
	public static function get_mapped_typography_data() {
		$settings = get_option( 'generate_settings', array() );
		$defaults = generate_get_default_fonts();
		$typography_mapping = array();

		// These options don't have "font" in their IDs.
		$no_font_in_ids = array(
			'single_post_title',
			'archive_post_title',
		);

		for ( $headings = 1; $headings < 7; $headings++ ) {
			$no_font_in_ids[] = 'heading_' . $headings;
		}

		foreach ( self::get_option_prefixes() as $key => $data ) {
			$legacy_setting_ids = array(
				'fontFamily' => 'font_' . $data['legacy_prefix'],
				'fontWeight' => $data['legacy_prefix'] . '_font_weight',
				'textTransform' => $data['legacy_prefix'] . '_font_transform',
				'fontSize' => $data['legacy_prefix'] . '_font_size',
				'fontSizeMobile' => 'mobile_' . $data['legacy_prefix'] . 'font_size',
				'lineHeight' => $data['legacy_prefix'] . '_line_height',
			);

			if ( 'slideout' === $data['legacy_prefix'] ) {
				$legacy_setting_ids['fontSizeMobile'] = $data['legacy_prefix'] . '_mobile_font_size';
			}

			if ( in_array( $data['legacy_prefix'], $no_font_in_ids ) ) {
				$legacy_setting_ids['fontWeight'] = $data['legacy_prefix'] . '_weight';
				$legacy_setting_ids['textTransform'] = $data['legacy_prefix'] . '_transform';
			}

			foreach ( $legacy_setting_ids as $name => $id ) {
				if ( self::has_saved_value( $id, $settings, $defaults ) ) {
					$typography_mapping[ $key ][ $name ] = $settings[ $id ];
				}

				if ( 'secondary_navigation' === $data['legacy_prefix'] && function_exists( 'generate_secondary_nav_get_defaults' ) ) {
					$secondary_nav_settings = get_option( 'generate_secondary_nav_settings', array() );
					$secondary_nav_defaults = generate_secondary_nav_get_defaults();

					if ( self::has_saved_value( $id, $secondary_nav_settings, $secondary_nav_defaults ) ) {
						$typography_mapping[ $key ][ $name ] = $secondary_nav_settings[ $id ];
					}
				}
			}

			if ( 'body' === $key ) {
				if ( self::has_saved_value( 'body_line_height', $settings, $defaults ) ) {
					$typography_mapping[ $key ]['lineHeightUnit'] = '';
				}

				if ( self::has_saved_value( 'paragraph_margin', $settings, $defaults ) ) {
					$typography_mapping[ $key ]['marginBottom'] = $settings['paragraph_margin'];
					$typography_mapping[ $key ]['marginBottomUnit'] = 'em';
				}
			}

			if ( 'widget-titles' === $key && self::has_saved_value( 'widget_title_separator', $settings, $defaults ) ) {
				$typography_mapping[ $key ]['marginBottom'] = $settings['widget_title_separator'];
				$typography_mapping[ $key ]['marginBottomUnit'] = 'px';
			}

			if ( 'h1' === $key || 'h2' === $key || 'h3' === $key ) {
				if ( self::has_saved_value( $data['legacy_prefix'] . '_margin_bottom', $settings, $defaults ) ) {
					$typography_mapping[ $key ]['marginBottom'] = $settings[ $data['legacy_prefix'] . '_margin_bottom' ];
					$typography_mapping[ $key ]['marginBottomUnit'] = 'px';
				}
			}

			if ( isset( $typography_mapping[ $key ]['fontSize'] ) ) {
				$typography_mapping[ $key ]['fontSizeUnit'] = 'px';
			}

			if ( isset( $typography_mapping[ $key ] ) ) {
				$typography_mapping[ $key ]['selector'] = $data['selector'];
				$typography_mapping[ $key ]['module'] = $data['module'];
				$typography_mapping[ $key ]['group'] = $data['group'];
			}
		}

		// Reset array keys starting at 0.
		$typography_mapping = array_values( $typography_mapping );

		return $typography_mapping;
	}

	/**
	 * Get all of our mapped font data.
	 */
	public static function get_mapped_font_data() {
		$font_mapping = array();

		foreach ( self::get_option_prefixes() as $key => $data ) {
			$settings = get_option( 'generate_settings', array() );
			$defaults = generate_get_default_fonts();

			if ( 'secondary_navigation' === $data['legacy_prefix'] && function_exists( 'generate_secondary_nav_get_defaults' ) ) {
				$settings = get_option( 'generate_secondary_nav_settings', array() );
				$defaults = generate_secondary_nav_get_defaults();
			}

			if ( self::has_saved_value( 'font_' . $data['legacy_prefix'], $settings, $defaults ) ) {
				$has_font = array_search( $settings[ 'font_' . $data['legacy_prefix'] ], array_column( $font_mapping, 'fontFamily' ) );

				if ( false !== $has_font ) {
					continue;
				}

				$font_mapping[ $key ]['fontFamily'] = $settings[ 'font_' . $data['legacy_prefix'] ];

				$local_fonts = generate_typography_default_fonts();

				if ( ! in_array( $settings[ 'font_' . $data['legacy_prefix'] ], $local_fonts ) ) {
					$font_mapping[ $key ]['googleFont'] = true;
					$font_mapping[ $key ]['googleFontCategory'] = get_theme_mod( 'font_' . $data['legacy_prefix'] . '_category' );
					$font_mapping[ $key ]['googleFontVariants'] = get_theme_mod( 'font_' . $data['legacy_prefix'] . '_variants' );
				}
			}
		}

		// Reset array keys starting at 0.
		$font_mapping = array_values( $font_mapping );

		return $font_mapping;
	}
}

GeneratePress_Typography_Migration::get_instance();
