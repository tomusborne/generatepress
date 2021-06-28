<?php
/**
 * The Customizer Redirect Control.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Create a section redirect control.
 *
 * @since 3.1.0
 */
class Generate_Customize_Redirect_Control extends WP_Customize_Control {

	/**
	 * Set type.
	 *
	 * @var public $type
	 */
	public $type = 'redirect';

	/**
	 * Set label.
	 *
	 * @var public $label
	 */
	public $label = '';

	/**
	 * Set the target section.
	 *
	 * @var string
	 */
	public $target_section = '';

	/**
	 * Set the classes.
	 *
	 * @var string
	 */
	public $classes = 'components-button is-tertiary';

	/**
	 * @inheritdoc
	 */
	public function to_json() {
		parent::to_json();
		$this->json['target_section'] = $this->target_section;
		$this->json['classes'] = $this->classes;
	}

	/**
	 * @inheritdoc
	 */
	public function content_template() {
		printf('
			<a class="{{ data.classes }}" onClick="wp.customize.section( \'{{ data.target_section }}\' ).focus();">
 				{{ data.label }} &#8594;
 			</a>'
		);
	}
}
