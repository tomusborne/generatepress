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
	public static function add_wrapper( $id, $control_args = array() ) {
		global $wp_customize;

		if ( ! $id ) {
			return;
		}

		$control_args['settings'] = isset( $wp_customize->selective_refresh ) ? array() : 'blogname';
		$control_args['choices']['id'] = str_replace( '_', '-', $id );
		$control_args['type'] = 'generate-wrapper-control';

		$wp_customize->add_control(
			new GeneratePress_Customize_React_Control(
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
	public static function add_title( $id, $control_args = array() ) {
		global $wp_customize;

		if ( ! $id ) {
			return;
		}

		$control_args['settings'] = isset( $wp_customize->selective_refresh ) ? array() : 'blogname';
		$control_args['type'] = 'generate-title-control';
		$control_args['choices']['title'] = $control_args['title'];
		unset( $control_args['title'] );

		$wp_customize->add_control(
			new GeneratePress_Customize_React_Control(
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
	public static function add_field( $id, $control_class, $setting_args = array(), $control_args = array() ) {
		global $wp_customize;

		if ( ! $id ) {
			return;
		}

		$settings = wp_parse_args(
			$setting_args,
			array(
				'type' => 'option',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'validate_callback' => '',
				'sanitize_callback' => '',
			)
		);

		$wp_customize->add_setting(
			$id,
			array(
				'type' => $settings['type'],
				'capability' => $settings['capability'],
				'default' => $settings['default'],
				'transport' => $settings['transport'],
				'validate_callback' => $settings['validate_callback'],
				'sanitize_callback' => $settings['sanitize_callback'],
			)
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

	/**
	 * Add color field group.
	 *
	 * @param string $id The ID for the group wrapper.
	 * @param string $section_id The section ID.
	 * @param string $toggle_id The Toggle ID.
	 * @param array  $fields The color fields.
	 */
	public static function add_color_field_group( $id, $section_id, $toggle_id, $fields ) {
		self::add_wrapper(
			"generate_{$id}_wrapper",
			array(
				'section' => $section_id,
				'choices' => array(
					'type' => 'color',
					'toggleId' => $toggle_id,
					'items' => array_keys( $fields ),
				),
			)
		);

		foreach ( $fields as $key => $field ) {
			self::add_field(
				$key,
				'GeneratePress_Customize_Color_Control',
				array(
					'default' => $field['default_value'],
					'transport' => 'postMessage',
					'sanitize_callback' => 'generate_sanitize_rgba_color',
				),
				array(
					'label' => $field['label'],
					'section' => $section_id,
					'choices' => array(
						'alpha' => isset( $field['alpha'] ) ? $field['alpha'] : true,
						'toggleId' => $toggle_id,
						'wrapper' => $key,
						'tooltip' => $field['tooltip'],
						'hideLabel' => isset( $field['hide_label'] ) ? $field['hide_label'] : false,
					),
					'output' => array(
						array(
							'element'  => $field['element'],
							'property' => $field['property'],
						),
					),
				)
			);
		}
	}
}
