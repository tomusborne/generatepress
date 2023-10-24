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
	 * The properties we've output variables for.
	 *
	 * @access private
	 * @var $properties_added An array of properties that have been added.
	 */
	private static $properties_added = [];

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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_google_fonts' ) );
		add_filter( 'generate_editor_styles', array( $this, 'add_editor_styles' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_scripts' ) );

		// Load fonts the old way in versions before 5.8 as block_editor_settings_all didn't exist.
		if ( version_compare( $GLOBALS['wp_version'], '5.8', '<' ) ) {
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_google_fonts' ) );
		}
	}

	/**
	 * Generate our Google Fonts URI.
	 */
	public static function get_google_fonts_uri() {
		$fonts = generate_get_option( 'font_manager' );

		if ( empty( $fonts ) ) {
			return;
		}

		$google_fonts_uri = '';
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
			$name = str_replace( '"', '', $name );

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
					'display' => generate_get_option( 'google_font_display' ),
				)
			);

			$google_fonts_uri = add_query_arg( $font_args, 'https://fonts.googleapis.com/css' );
		}

		return $google_fonts_uri;
	}

	/**
	 * Enqueue Google Fonts if they're set.
	 */
	public function enqueue_google_fonts() {
		if ( ! generate_is_using_dynamic_typography() ) {
			return;
		}

		$google_fonts_uri = self::get_google_fonts_uri();

		if ( $google_fonts_uri ) {
			wp_enqueue_style( 'generate-google-fonts', $google_fonts_uri, array(), GENERATE_VERSION );
		}
	}

	/**
	 * Build an array of CSS variables.
	 */
	public static function build_css_variables() {
		$typography = generate_get_option( 'typography' );

		if ( empty( $typography ) ) {
			return [];
		}

		$variables = array();
		$variable_names = [
			'fontFamily'     => 'font-family',
			'fontWeight'     => 'font-weight',
			'textTransform'  => 'text-transform',
			'fontStyle'      => 'font-style',
			'textDecoration' => 'text-decoration',
			'fontSize'       => 'font-size',
			'letterSpacing'  => 'letter-spacing',
			'lineHeight'     => 'line-height',
			'marginBottom'   => 'margin-bottom',
		];

		foreach ( $typography as $key => $data ) {
			$options = wp_parse_args(
				$data,
				self::get_defaults()
			);
			$devices = [ '', 'Tablet', 'Mobile' ];

			foreach ( $variable_names as $name => $property ) {
				foreach ( $devices as $device ) {
					$option_name = $name . $device;

					if ( ! isset( $options[ $option_name ] ) ) {
						continue;
					}

					$value = $options[ $option_name ];

					if ( isset( $options[ $name . 'Unit' ] ) && is_numeric( $value ) ) {
						$value .= $options[ $name . 'Unit' ];
					}

					if ( 'fontFamily' === $name ) {
						$value = self::get_font_family( $options[ $option_name ] );
					}

					if ( empty( $value ) && ! is_numeric( $value ) ) {
						continue;
					}

					$array_key = '' === $device
						? 'main'
						: strtolower( $device );

					$variables[ $array_key ][ 'gp-' . esc_attr( $options['selector'] ) . '--' . $property ] = $value;
				}
			}
		}

		return $variables;
	}

	/**
	 * Get our CSS variable value.
	 *
	 * @param string $property The CSS property.
	 * @param string $selector The selector we're targeting.
	 * @param string $device The device we're targeting.
	 */
	public static function get_css_variable( $property, $selector, $device ) {
		$variables = GeneratePress_CSS_Variables::get_variable_data();

		if ( ! isset( $variables[ $device ][ "gp-{$selector}--{$property}" ] ) ) {
			return;
		}

		if ( in_array( "{$selector}-{$property}", self::$properties_added ) ) {
			return;
		}

		self::$properties_added[] = "{$selector}-{$property}";

		return "var(--gp-{$selector}--{$property})";
	}

	/**
	 * Build our CSS data.
	 *
	 * @param Object $css The existing CSS object.
	 * @param string $selector The selector the for the CSS output.
	 * @param string $raw_selector The selector as it's saved in the database.
	 * @param string $device The device we're targeting.
	 */
	private static function do_css_output( $css, $selector, $raw_selector, $device = 'main' ) {
		$body_selector = 'body';
		$paragraph_selector = 'p';

		$css->set_selector( $selector );
		$css->add_property( 'font-family', self::get_css_variable( 'font-family', $raw_selector, $device ) );
		$css->add_property( 'font-weight', self::get_css_variable( 'font-weight', $raw_selector, $device ) );
		$css->add_property( 'text-transform', self::get_css_variable( 'text-transform', $raw_selector, $device ) );
		$css->add_property( 'font-style', self::get_css_variable( 'font-style', $raw_selector, $device ) );
		$css->add_property( 'text-decoration', self::get_css_variable( 'font-style', $raw_selector, $device ) );
		$css->add_property( 'font-size', self::get_css_variable( 'font-size', $raw_selector, $device ) );
		$css->add_property( 'letter-spacing', self::get_css_variable( 'letter-spacing', $raw_selector, $device ) );

		if ( 'body' !== $raw_selector ) {
			$css->add_property( 'line-height', self::get_css_variable( 'line-height', $raw_selector, $device ) );
			$css->add_property( 'margin-bottom', self::get_css_variable( 'margin-bottom', $raw_selector, $device ) );
		} else {
			$css->set_selector( $body_selector );
			$css->add_property( 'line-height', self::get_css_variable( 'line-height', $raw_selector, $device ) );

			$css->set_selector( $paragraph_selector );
			$css->add_property( 'margin-bottom', self::get_css_variable( 'margin-bottom', $raw_selector, $device ) );
		}
	}

	/**
	 * Build our typography CSS.
	 *
	 * @param string $module            The name of the module we're generating CSS for.
	 * @param string $specific_selector Target a specific selector to get the CSS for.
	 */
	public static function get_css( $module = 'core', $specific_selector = '' ) {
		$typography = generate_get_option( 'typography' );

		// Get data for a specific module so CSS can be compiled separately.
		$typography = array_filter(
			(array) $typography,
			function( $data ) use ( $module ) {
				return ( isset( $data['module'] ) && $data['module'] === $module );
			}
		);

		if ( empty( $typography ) ) {
			return '';
		}

		$css = new GeneratePress_CSS();

		foreach ( $typography as $key => $data ) {
			$options = wp_parse_args(
				$data,
				self::get_defaults()
			);

			$raw_selector = $options['selector'];
			$selector = self::get_css_selector( $raw_selector );

			if ( 'custom' === $selector ) {
				$selector = $options['customSelector'];
			}

			if (
				$specific_selector &&
				$raw_selector !== $specific_selector &&
				$options['customSelector'] !== $specific_selector
			) {
				continue;
			}

			self::do_css_output( $css, $selector, $raw_selector );

			$css->start_media_query( generate_get_media_query( 'tablet' ) );
			self::do_css_output( $css, $selector, $raw_selector, 'tablet' );
			$css->stop_media_query();

			$css->start_media_query( generate_get_media_query( 'mobile' ) );
			self::do_css_output( $css, $selector, $raw_selector, 'mobile' );
			$css->stop_media_query();
		}

		return $css->css_output();
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
	 * Get our full font family value.
	 *
	 * @param string $font_family The font family name.
	 */
	public static function get_font_family( $font_family ) {
		if ( ! $font_family ) {
			return $font_family;
		}

		$font_manager = generate_get_option( 'font_manager' );

		$font_families = array();
		foreach ( (array) $font_manager as $key => $data ) {
			$font_families[ $data['fontFamily'] ] = $data;
		}

		$font_family_args = array();
		if ( ! empty( $font_families[ $font_family ] ) ) {
			$font_family_args = $font_families[ $font_family ];
		}

		if ( ! empty( $font_family_args['googleFont'] ) && ! empty( $font_family_args['googleFontCategory'] ) ) {
			// Add quotations around font names with standalone numbers.
			if ( preg_match( '/(?<!\S)\d+(?!\S)/', $font_family ) ) {
				$font_family = '"' . $font_family . '"';
			}

			$font_family = $font_family . ', ' . $font_family_args['googleFontCategory'];
		} elseif ( 'System Default' === $font_family ) {
			$font_family = generate_get_system_default_font();
		}

		return $font_family;
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
			'textDecoration' => '',
			'fontStyle' => '',
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

	/**
	 * Add editor styles to the block editor.
	 *
	 * @param array $editor_styles Existing styles.
	 */
	public function add_editor_styles( $editor_styles ) {
		if ( generate_is_using_dynamic_typography() ) {
			$editor_styles[] = 'assets/css/admin/editor-typography.css';
		}

		return $editor_styles;
	}

	/**
	 * Add scripts to the block editor.
	 */
	public function enqueue_editor_scripts() {
		$html_typography = self::get_css( 'core', 'html' );

		if ( $html_typography ) {
			// The editor uses the `body` selector for things like `font-size` and
			// replaces the `body` selector with `editor-styles-wrapper`. This should make
			// it so our `html` selector appears as `body` in the editor and overwrites the
			// common.css file.
			$desktop_css = str_replace( 'html', 'body:not(.editor-styles-wrapper)', $html_typography );

			wp_add_inline_style(
				// wp-edit-blocks is enqueued in the editor, including the iframes.
				// This may break one day, but it's the only way to add CSS into the iframes
				// without WordPress replacing selectors like `html` and `body`.
				'wp-edit-blocks',
				// We add `$desktop_css` to apply to the `<body>` element on desktop and
				// then we add `$html_typography` to apply to the `<html>` element in the device previews.
				$desktop_css . $html_typography
			);
		}
	}
}

GeneratePress_Typography::get_instance();
