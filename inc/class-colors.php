<?php
/**
 * This file handles colors CSS in the theme.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles all CSS variables generated by our color options.
 */
class GeneratePress_Colors extends GeneratePress_Singleton {
	/**
	 * Build our global color CSS variable data.
	 */
	public static function build_global_color_variables() {
		$global_colors = generate_get_global_colors();
		$variables = [];

		if ( ! empty( $global_colors ) ) {
			foreach ( (array) $global_colors as $key => $data ) {
				if ( ! empty( $data['slug'] ) && ! empty( $data['color'] ) ) {
					$variables['main'][ $data['slug'] ] = $data['color'];
				}
			}
		}

		return $variables;
	}

	/**
	 * Build our color options CSS variable data.
	 */
	public static function build_color_variables() {
		$colors = array_merge(
			[
				'background_color' => 'var(--base-2)',
				'text_color' => 'var(--contrast)',
				'link_color' => 'var(--accent)',
				'link_color_hover' => 'var(--contrast)',
				'link_color_visited' => '',
			],
			generate_get_color_defaults(),
		);

		$settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			$colors
		);

		$variables = [];

		foreach ( $colors as $key => $value ) {
			if ( ! isset( $settings[ $key ] ) ) {
				continue;
			}

			$property = str_replace( '_', '-', $key );
			$variables['main'][ 'gp-' . $property ] = $settings[ $key ];
		}

		return $variables;
	}
}
