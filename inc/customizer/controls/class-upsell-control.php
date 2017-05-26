<?php
defined( 'WPINC' ) or die;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Customize_Misc_Control' ) ) :
/**
 * Create our in-section upsell controls
 * Escape your URL in the Customizer using esc_url()!
 */
class Generate_Customize_Misc_Control extends WP_Customize_Control {
	public $description = '';
	public $url = '';
	public $type = 'addon';
	
	public function enqueue() {
		wp_enqueue_style( 'generate-customizer-controls-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/css/upsell-customizer.css', array(), GENERATE_VERSION );
	}

	public function to_json() {
		parent::to_json();
		$this->json[ 'url' ] = esc_url( $this->url );
		$this->json[ 'message' ] = __( 'Add-on available','generatepress' );
	}
	
	public function content_template() {
		?>
		<span class="get-addon">
			<a href="{{{ data.url }}}" target="_blank">{{ data.message }}</a>
		</span>
		<p class="description" style="margin-top: 5px;">{{{ data.description }}}</p>
		<?php
	}
}
endif;