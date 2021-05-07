<?php
/**
 * Customize API: ColorAlpha class
 *
 * @package GeneratePress
 */

/**
 * Customize Color Control class.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class GeneratePress_Customize_Font_Family_Control extends WP_Customize_Control {
	/**
	 * Type.
	 *
	 * @access public
	 * @since 1.0.0
	 * @var string
	 */
	public $type = 'generate-font-family-control';

	/**
	 * Default value.
	 *
	 * @access public
	 * @since 1.0.0
	 * @var mixed
	 */
	public $defaultValue = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 3.4.0
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
		$this->json['defaultValue'] = $this->defaultValue;
	}

	/**
	 * Empty JS template.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function content_template() {}
}
