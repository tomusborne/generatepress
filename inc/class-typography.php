<?php
/**
 * This file handles typography on the front-end.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles all of our typography option output.
 */
class GeneratePress_Typography {
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
	 *  Constructor
	 */
	public function __construct() {
		if ( ! generate_is_using_dynamic_typography() ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_google_fonts' ) );
	}

	/**
	 * Enqueue Google Fonts if they're set.
	 */
	public function enqueue_google_fonts() {
		$fonts = generate_get_option( 'font_manager' );

		if ( empty( $fonts ) ) {
			return;
		}

		$data = array();

		foreach ( $fonts as $font ) {
			if ( empty( $font['googleFont'] ) ) {
				continue;
			}

			$variants = array();

			if ( ! empty( $font['googleFontVariants'] ) ) {
				// Remove spaces from string.
				$variants = str_replace( ' ', '', $font['googleFontVariants'] );

				// Turn string into array.
				$variants = explode( ',', $variants );
			}

			$variants = apply_filters( 'generate_google_font_variants', $variants, $font['fontFamily'] );

			$name = str_replace( ' ', '+', $font['fontFamily'] );

			if ( $variants ) {
				$data[] = $name . ':' . implode( ',', $variants );
			} else {
				$data[] = $name;
			}
		}

		if ( ! empty( $data ) ) {
			$font_args = apply_filters(
				'generate_google_font_args',
				array(
					'family' => implode( '|', $data ),
					'subset' => null,
					'display' => 'swap',
				)
			);

			$google_fonts_uri = add_query_arg( $font_args, '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'generate-google-fonts', $google_fonts_uri, array(), GENERATE_VERSION );
		}
	}

	/**
	 * Build our typography CSS.
	 */
	public static function get_css() {
		$font_manager = generate_get_option( 'font_manager' );
		$typography = generate_get_option( 'typography' );

		if ( ! empty( $typography ) ) {
			$font_families = array();

			foreach ( $font_manager as $key => $data ) {
				$font_families[ $data['fontFamily'] ] = $data;
			}

			$css = new GeneratePress_CSS();

			foreach ( $typography as $key => $data ) {
				$options = wp_parse_args(
					$data,
					self::get_defaults()
				);

				$selector = self::get_css_selector( $options['selector'] );
				$font_family_args = array();
				$font_family = $options['fontFamily'];

				if ( ! empty( $font_families[ $font_family ] ) ) {
					$font_family_args = $font_families[ $font_family ];
				}

				if ( ! empty( $font_family_args['googleFont'] ) && ! empty( $font_family_args['googleFontCategory'] ) ) {
					$font_family = $font_family . ', ' . $font_family_args['googleFontCategory'];
				} elseif ( 'System Default' === $font_family ) {
					$font_family = generate_get_system_default_font();
				}

				$css->set_selector( $selector );
				$css->add_property( 'font-family', $font_family );
				$css->add_property( 'font-weight', $options['fontWeight'] );
				$css->add_property( 'text-transform', $options['textTransform'] );
				$css->add_property( 'font-size', $options['fontSize'], false, $options['fontSizeUnit'] );
				$css->add_property( 'letter-spacing', $options['letterSpacing'], false, $options['letterSpacingUnit'] );

				if ( 'body' !== $options['selector'] ) {
					$css->add_property( 'line-height', $options['lineHeight'], false, $options['lineHeightUnit'] );
					$css->add_property( 'margin-bottom', $options['marginBottom'], false, $options['marginBottomUnit'] );
				} else {
					$css->set_selector( 'body' );
					$css->add_property( 'line-height', $options['lineHeight'], false, $options['lineHeightUnit'] );

					$css->set_selector( 'p' );
					$css->add_property( 'margin-bottom', $options['marginBottom'], false, $options['marginBottomUnit'] );
				}

				$css->start_media_query( generate_get_media_query( 'tablet' ) );
				$css->set_selector( $selector );
				$css->add_property( 'font-size', $options['fontSizeTablet'], false, $options['fontSizeUnit'] );
				$css->add_property( 'letter-spacing', $options['letterSpacingTablet'], false, $options['letterSpacingUnit'] );

				if ( 'body' !== $options['selector'] ) {
					$css->add_property( 'line-height', $options['lineHeightTablet'], false, $options['lineHeightUnit'] );
					$css->add_property( 'margin-bottom', $options['marginBottomTablet'], false, $options['marginBottomUnit'] );
				} else {
					$css->set_selector( 'body' );
					$css->add_property( 'line-height', $options['lineHeightTablet'], false, $options['lineHeightUnit'] );

					$css->set_selector( 'p' );
					$css->add_property( 'margin-bottom', $options['marginBottomTablet'], false, $options['marginBottomUnit'] );
				}
				$css->stop_media_query();

				$css->start_media_query( generate_get_media_query( 'mobile' ) );
				$css->set_selector( $selector );
				$css->add_property( 'font-size', $options['fontSizeMobile'], false, $options['fontSizeUnit'] );
				$css->add_property( 'letter-spacing', $options['letterSpacingMobile'], false, $options['letterSpacingUnit'] );

				if ( 'body' !== $options['selector'] ) {
					$css->add_property( 'line-height', $options['lineHeightMobile'], false, $options['lineHeightUnit'] );
					$css->add_property( 'margin-bottom', $options['marginBottomMobile'], false, $options['marginBottomUnit'] );
				} else {
					$css->set_selector( 'body' );
					$css->add_property( 'line-height', $options['lineHeightMobile'], false, $options['lineHeightUnit'] );

					$css->set_selector( 'p' );
					$css->add_property( 'margin-bottom', $options['marginBottomMobile'], false, $options['marginBottomUnit'] );
				}
				$css->stop_media_query();
			}

			return $css->css_output();
		}
	}

	/**
	 * Get the CSS selector.
	 *
	 * @param string $selector The saved selector to look up.
	 */
	public static function get_css_selector( $selector ) {
		switch ( $selector ) {
			case 'body':
				$selector = 'body, button, input, select, textarea';
				break;

			case 'main-title':
				$selector = '.main-title';
				break;

			case 'site-description':
				$selector = '.site-description';
				break;

			case 'primary-menu-items':
				$selector = '.main-navigation a, .main-navigation .menu-toggle, .main-navigation .menu-bar-items';
				break;

			case 'primary-sub-menu-items':
				$selector = '.main-navigation .main-nav ul ul li a';
				break;

			case 'primary-menu-toggle':
				$selector = '.main-navigation .menu-toggle';
				break;

			case 'buttons':
				$selector = 'button:not(.menu-toggle),html input[type="button"],input[type="reset"],input[type="submit"],.button,.wp-block-button .wp-block-button__link';
				break;

			case 'all-headings':
				$selector = 'h1, h2, h3, h4, h5, h6';
				break;

			case 'single-content-title':
				$selector = 'h1.entry-title';
				break;

			case 'archive-content-title':
				$selector = 'h2.entry-title';
				break;

			case 'top-bar':
				$selector = '.top-bar';
				break;

			case 'widget-titles':
				$selector = '.widget-title';
				break;

			case 'footer':
				$selector = '.site-info';
				break;
		}

		return apply_filters( 'generate_typography_css_selector', $selector );
	}

	/**
	 * Get the defaults for our CSS options.
	 */
	public static function get_defaults() {
		return array(
			'selector' => '',
			'fontFamily' => '',
			'fontWeight' => '',
			'textTransform' => '',
			'fontSize' => '',
			'fontSizeTablet' => '',
			'fontSizeMobile' => '',
			'fontSizeUnit' => 'px',
			'lineHeight' => '',
			'lineHeightTablet' => '',
			'lineHeightMobile' => '',
			'lineHeightUnit' => '',
			'letterSpacing' => '',
			'letterSpacingTablet' => '',
			'letterSpacingMobile' => '',
			'letterSpacingUnit' => 'px',
			'marginBottom' => '',
			'marginBottomTablet' => '',
			'marginBottomMobile' => '',
			'marginBottomUnit' => 'px',
		);
	}
}

GeneratePress_Typography::get_instance();
