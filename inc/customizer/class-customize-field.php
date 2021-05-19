<?php
/**
 * This file handles adding Customizer controls.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Helper functions to add Customizer fields.
 */
class GeneratePress_Customize_Field {
	/**
	 * Instance.
	 *
	 * @access private
	 * @var object Instance
	 */
	private static $instance;

	/**
	 * Initiator.
	 *
	 * @since 1.2.0
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Add a wrapper for defined controls.
	 *
	 * @param string $id The settings ID for this field.
	 * @param array  $control_args The args for add_control().
	 */
	public static function add_wrapper( $id, $control_args = [] ) {
		global $wp_customize;

		if ( ! $id ) {
			return;
		}

		$control_args['settings'] = isset( $wp_customize->selective_refresh ) ? array() : 'blogname';
		$control_args['choices']['id'] = str_replace( '_', '-', $id );

		$wp_customize->add_control(
			new GeneratePress_Customize_Wrapper_Control(
				$wp_customize,
				$id,
				$control_args
			)
		);
	}

	/**
	 * Add a title.
	 *
	 * @param string $id The settings ID for this field.
	 * @param array  $control_args The args for add_control().
	 */
	public static function add_title( $id, $control_args = [] ) {
		global $wp_customize;

		if ( ! $id ) {
			return;
		}

		$control_args['settings'] = isset( $wp_customize->selective_refresh ) ? array() : 'blogname';

		$wp_customize->add_control(
			new GeneratePress_Customize_Title_Control(
				$wp_customize,
				$id,
				$control_args
			)
		);
	}

	/**
	 * Add a Customizer field.
	 *
	 * @param string $id The settings ID for this field.
	 * @param object $control_class A custom control classes if we want one.
	 * @param array  $setting_args The args for add_setting().
	 * @param array  $control_args The args for add_control().
	 */
	public static function add_field( $id, $control_class, $setting_args = [], $control_args = [] ) {
		global $wp_customize;

		if ( ! $id ) {
			return;
		}

		if ( ! isset( $setting_args['type'] ) ) {
			$setting_args['type'] = 'option';
		}

		$wp_customize->add_setting(
			$id,
			$setting_args
		);

		$control_args['settings'] = $id;

		if ( ! isset( $control_args['type'] ) ) {
			unset( $control_args['type'] );
		}

		if ( ! isset( $control_args['defaultValue'] ) && isset( $setting_args['default'] ) ) {
			$control_args['defaultValue'] = $setting_args['default'];
		}

		if ( isset( $control_args['output'] ) ) {
			global $generate_customize_fields;

			$generate_customize_fields[] = array(
				'js_vars' => $control_args['output'],
				'settings' => $id,
			);
		}

		if ( $control_class ) {
			$wp_customize->add_control(
				new $control_class(
					$wp_customize,
					$id,
					$control_args
				)
			);

			return;
		}

		$wp_customize->add_control(
			$id,
			$control_args
		);
	}
}
