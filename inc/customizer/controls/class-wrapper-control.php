<?php
/**
 * The upsell Customizer controll.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Create our in-section upsell controls.
 * Escape your URL in the Customizer using esc_url().
 *
 * @since 0.1
 */
class GeneratePress_Customize_Wrapper_Control extends WP_Customize_Control {
	/**
	 * Type.
	 *
	 * @access public
	 * @since 1.0.0
	 * @var string
	 */
	public $type = 'generate-wrapper-control';

	/**
	 * Set choices
	 *
	 * @var public $choices
	 */
	public $choices = array();

	/**
	 * Send variables to json.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
	}

	/**
	 * Render content.
	 */
	public function content_template() {}
}
