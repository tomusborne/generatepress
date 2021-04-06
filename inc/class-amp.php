<?php
/**
 * Add compatibility for AMP.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * This class adds support for the official AMP plugin.
 */
class GeneratePress_AMP_Support {
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
		add_action( 'wp', array( $this, 'setup' ) );
	}

	/**
	 * Do setup.
	 */
	public function setup() {
		if ( ! generate_is_amp() ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 100 );
		add_filter( 'option_generate_settings', array( $this, 'filter_theme_settings' ) );
		add_action( 'generate_after_footer', array( $this, 'do_toggled_nav' ) );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'do_mobile_menu_dropdown_toggles' ), 10, 4 );
		add_filter( 'generate_attr_menu-toggle', array( $this, 'add_menu_toggle_attributes' ) );
		add_filter( 'generate_attr_navigation', array( $this, 'add_navigation_attributes' ) );
		add_filter( 'generate_attr_mobile-menu-control-wrapper', array( $this, 'add_navigation_attributes' ) );
	}

	/**
	 * Enqueue and dequeue scripts.
	 */
	public function enqueue_scripts() {
		if ( generate_is_amp() ) {
			wp_dequeue_script( 'generate-menu' );
			wp_dequeue_script( 'generate-classlist' );

			wp_enqueue_style( 'generate-amp', get_template_directory_uri() . '/assets/css/amp.css', array(), GENERATE_VERSION );
			wp_add_inline_style( 'generate-style', $this->do_dynamic_css() );
		}
	}

	/**
	 * Do dynamic CSS for AMP.
	 */
	public function do_dynamic_css() {
		$css = new GeneratePress_CSS();

		$settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_color_defaults()
		);

		$css->set_selector( '.main-navigation .main-nav ul .menu-item-has-children > button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['navigation_text_color'] );

		$css->set_selector( '.main-navigation .main-nav ul .menu-item-has-children:hover > button.dropdown-menu-toggle, .main-navigation .main-nav ul .menu-item-has-children.sfHover > button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['navigation_text_hover_color'] );
		$css->add_property( 'background-color', $settings['navigation_background_hover_color'] );

		$css->set_selector( '.main-navigation .main-nav ul li[class*="current-menu-"] > button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['navigation_text_current_color'] );
		$css->add_property( 'background-color', $settings['navigation_background_current_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['subnavigation_text_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li:hover > button.dropdown-menu-toggle,.main-navigation .main-nav ul ul li.sfHover > button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['subnavigation_text_hover_color'] );
		$css->add_property( 'background-color', $settings['subnavigation_background_hover_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li[class*="current-menu-"] > button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['subnavigation_text_current_color'] );
		$css->add_property( 'background-color', $settings['subnavigation_background_current_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li[class*="current-menu-"]:hover > button.dropdown-menu-toggle,.main-navigation .main-nav ul ul li[class*="current-menu-"].sfHover > button.dropdown-menu-toggle' );
		$css->add_property( 'color', $settings['subnavigation_text_current_color'] );
		$css->add_property( 'background-color', $settings['subnavigation_background_current_color'] );

		return $css->css_output();
	}

	/**
	 * Some settings will have to change if AMP is active.
	 *
	 * @param array $settings The existing settings.
	 */
	public function filter_theme_settings( $settings ) {
		$settings['nav_dropdown_type'] = 'hover';
		$settings['back_to_top'] = '';
		$settings['nav_search'] = 'disable';

		return $settings;
	}

	/**
	 * Without the .toggled element on the page, AMP won't include the necessary CSS.
	 */
	public function do_toggled_nav() {
		echo '<div class="main-navigation toggled amp-tree-shaking-help" style="display: none;"></div>';
	}

	/**
	 * Add HTML attributes to the mobile menu toggle.
	 *
	 * @param array $attributes Existing HTML attributes.
	 */
	public function add_menu_toggle_attributes( $attributes ) {
		$toggle_inline_wrapper = '';

		if ( generate_has_inline_mobile_toggle() ) {
			$toggle_inline_wrapper = "mobile-menu-control-wrapper.toggleClass( 'class' = 'toggled' ),";
		}

		$attributes['class'] .= ' amp-menu-toggle';
		$attributes['on'] = "tap:site-navigation.toggleClass( 'class' = 'toggled' )," . $toggle_inline_wrapper . 'AMP.setState( { navMenuExpanded: ! navMenuExpanded } )';
		$attributes['[aria-expanded]'] = "navMenuExpanded ? 'true' : 'false'";

		return $attributes;
	}

	/**
	 * Add HTML attributes to our navigation container.
	 *
	 * @param array $attributes Existing HTML attributes.
	 */
	public function add_navigation_attributes( $attributes ) {
		$attributes['[aria-expanded]'] = "navMenuExpanded ? 'true' : 'false'";

		return $attributes;
	}

	/**
	 * Add dropdown arrow buttons in our mobile menu.
	 *
	 * @param string   $item_output Nav menu item HTML.
	 * @param object   $item Nav menu item.
	 * @param int      $depth Depth of menu item. Used for padding.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 */
	public function do_mobile_menu_dropdown_toggles( $item_output, $item, $depth, $args ) {
		// Only add the buttons in AMP responses.
		if ( ! generate_is_amp() ) {
			return $item_output;
		}

		if ( 'main-nav' !== $args->container_class ) {
			return $item_output;
		}

		// Skip when the item has no sub-menu.
		if ( ! in_array( 'menu-item-has-children', $item->classes, true ) ) {
			return $item_output;
		}

		// Obtain the initial expanded state.
		$expanded = in_array( 'current-menu-ancestor', $item->classes, true );

		// Generate a unique state ID.
		static $nav_menu_item_number = 0;
		$nav_menu_item_number++;
		$expanded_state_id = 'navMenuItemExpanded' . $nav_menu_item_number;

		// Create new state for managing storing the whether the sub-menu is expanded.
		$item_output .= sprintf(
			'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
			esc_attr( $expanded_state_id ),
			wp_json_encode( $expanded )
		);

		/*
		* Create the toggle button which mutates the state and which has class and
		* aria-expanded attributes which react to the state changes.
		*/
		$dropdown_button  = '<button';
		$dropdown_class   = 'dropdown-menu-toggle';

		if ( function_exists( 'generate_get_option' ) && 'svg' === generate_get_option( 'icons' ) ) {
			$dropdown_class .= ' has-svg-icon';
		}

		$toggled_class    = 'toggled-on';
		$dropdown_button .= sprintf(
			' class="%s" [class]="%s"',
			esc_attr( $dropdown_class ),
			esc_attr( sprintf( "%s + ( $expanded_state_id ? %s : '' )", wp_json_encode( $dropdown_class ), wp_json_encode( " $toggled_class" ) ) )
		);

		$dropdown_button .= sprintf(
			' aria-expanded="%s" [aria-expanded]="%s"',
			esc_attr( wp_json_encode( $expanded ) ),
			esc_attr( "$expanded_state_id ? 'true' : 'false'" )
		);

		$dropdown_button .= sprintf(
			' on="%s"',
			esc_attr( "tap:AMP.setState( { $expanded_state_id: ! $expanded_state_id } )" )
		);

		$dropdown_button .= '>';

		if ( function_exists( 'generate_get_svg_icon' ) ) {
			$dropdown_button .= generate_get_svg_icon( 'arrow' );
		}

		// Let the screen reader text in the button also update based on the expanded state.
		$dropdown_button .= sprintf(
			'<span class="screen-reader-text" [text]="%s">%s</span>',
			esc_attr( sprintf( "$expanded_state_id ? %s : %s", wp_json_encode( __( 'collapse child menu', 'gp-amp' ) ), wp_json_encode( __( 'expand child menu', 'gp-amp' ) ) ) ),
			esc_html( $expanded ? __( 'collapse child menu', 'example' ) : __( 'expand child menu', 'gp-amp' ) )
		);

		$dropdown_button .= '</button>';

		$item_output .= $dropdown_button;
		return $item_output;
	}
}

GeneratePress_AMP_Support::get_instance();
