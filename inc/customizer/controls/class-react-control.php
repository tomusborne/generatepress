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
class GeneratePress_Customize_React_Control extends WP_Customize_Control {
	/**
	 * Type.
	 *
	 * @access public
	 * @since 1.0.0
	 * @var string
	 */
	public $type = 'generate-react-control';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 3.4.0
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
	}

	/**
	 * Empty JS template.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function content_template() {}

	/**
	 * Empty PHP template.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function render_content() {}
}
