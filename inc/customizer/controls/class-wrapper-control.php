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
	 * Set wrapper ID.
	 *
	 * @var public $wrapper_id
	 */
	public $wrapper_id = '';

	/**
	 * Set wrapper class.
	 *
	 * @var public $wrapper_class
	 */
	public $wrapper_class = '';

	/**
	 * Set wrapper type.
	 *
	 * @var public $wrapper_class
	 */
	public $wrapper_type = '';

	/**
	 * Set wrappers.
	 *
	 * @var public $wrappers
	 */
	public $wrapper_items = array();

	/**
	 * Send variables to json.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['wrapper_id'] = esc_attr( $this->wrapper_id );
		$this->json['wrapper_class'] = $this->wrapper_class;
		$this->json['wrapper_items'] = $this->wrapper_items;
		$this->json['wrapper_type'] = $this->wrapper_type;
	}

	/**
	 * Render content.
	 */
	public function content_template() {
		?>
		<div class="generate-customize-control-wrapper {{{ data.wrapper_class }}}" id="{{{ data.wrapper_id }}}" data-wrapper-type="{{{ data.wrapper_type }}}">
			<# for ( var key in data.wrapper_items ) { #>
				<div id="{{{ data.wrapper_items[ key ] }}}--wrapper"></div>
			<# } #>
		</div>
		<?php
	}
}
