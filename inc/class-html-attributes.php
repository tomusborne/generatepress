<?php
/**
 * Add HTML attributes to our theme elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * This class adds HTML attributes to various theme elements.
 */
class GeneratePress_HTML_Attributes {
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
		add_filter( 'generate_attr_header', array( $this, 'site_header' ) );
		add_filter( 'generate_attr_menu-toggle', array( $this, 'menu_toggle' ) );
		add_filter( 'generate_attr_navigation', array( $this, 'primary_navigation' ) );
		add_filter( 'generate_attr_inside-navigation', array( $this, 'primary_inner_navigation' ) );
		add_filter( 'generate_attr_mobile-menu-control-wrapper', array( $this, 'mobile_menu_control_wrapper' ) );
		add_filter( 'generate_attr_site-info', array( $this, 'site_info' ) );
		add_filter( 'generate_attr_entry-header', array( $this, 'entry_header' ) );
		add_filter( 'generate_attr_post-navigation', array( $this, 'post_navigation' ) );
	}

	/**
	 * Add attributes to our site header.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function site_header( $attributes ) {
		$attributes['id'] = 'masthead';
		$attributes['aria-label'] = esc_attr__( 'Site', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our menu toggle.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function menu_toggle( $attributes ) {
		$attributes['class'] = 'menu-toggle';
		$attributes['aria-controls'] = 'primary-menu';
		$attributes['aria-expanded'] = 'false';

		return $attributes;
	}

	/**
	 * Add attributes to our main navigation.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function primary_navigation( $attributes ) {
		$attributes['id'] = 'site-navigation';
		$attributes['aria-label'] = esc_attr__( 'Primary', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our main navigation.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function primary_inner_navigation( $attributes ) {
		$classes = generate_get_element_classes( 'inside_navigation' );

		if ( $classes ) {
			$attributes['class'] = join( ' ', $classes );
		}

		return $attributes;
	}

	/**
	 * Add attributes to our main navigation.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function mobile_menu_control_wrapper( $attributes ) {
		$attributes['id'] = 'mobile-menu-control-wrapper';
		$attributes['class'] = 'main-navigation mobile-menu-control-wrapper';
		$attributes['aria-label'] = esc_attr__( 'Mobile Toggle', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our footer element.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function site_info( $attributes ) {
		$attributes['class'] = 'site-info';
		$attributes['aria-label'] = esc_attr__( 'Site', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our entry headers.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function entry_header( $attributes ) {
		$attributes['class'] = 'entry-header';
		$attributes['aria-label'] = esc_attr__( 'Content', 'generatepress' );

		return $attributes;
	}

	/**
	 * Add attributes to our entry headers.
	 *
	 * @since 3.1.0
	 * @param array $attributes The existing attributes.
	 */
	public function post_navigation( $attributes ) {
		if ( is_single() ) {
			$attributes['class'] = 'post-navigation';
			$attributes['aria-label'] = esc_attr__( 'Single Post', 'generatepress' );
		} else {
			$attributes['class'] = 'paging-navigation';
			$attributes['aria-label'] = esc_attr__( 'Archive Page', 'generatepress' );
		}

		return $attributes;
	}
}

GeneratePress_HTML_Attributes::get_instance();
