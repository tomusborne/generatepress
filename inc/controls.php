<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists('Generate_Customize_Width_Slider_Control') ) :
/**
 *	Create our container width slider control
 */
class Generate_Customize_Width_Slider_Control extends WP_Customize_Control
{
	// Setup control type
	public $type = 'gp-width-slider';
	public $id = '';
	public $default_value = '';
	public $unit = '';
	
	public function to_json() {
		parent::to_json();
		$this->json[ 'link' ] = $this->get_link();
		$this->json[ 'value' ] = $this->value();
		$this->json[ 'id' ] = $this->id;
		$this->json[ 'default_value' ] = $this->default_value;
		$this->json[ 'reset_title' ] = esc_attr__( 'Reset','generatepress' );
		$this->json[ 'unit' ] = $this->unit;
	}
	
	public function content_template() {
		?>
		<label>
			<p style="margin-bottom: 0;">
				<span class="customize-control-title" style="margin:0;display:inline-block;">
					{{ data.label }}
				</span>
				<span class="value">
					<input name="{{ data.id }}" type="number" {{{ data.link }}} value="{{{ data.value }}}" class="slider-input" /><span class="px">px</span>
				</span>
			</p>
		</label>
		<div class="slider gp-flat-slider <# if ( '' !== data.default_value ) { #>show-reset<# } #>"></div>
		<# if ( '' !== data.default_value ) { #><span style="cursor:pointer;" title="{{ data.reset_title }}" class="gp-slider-default-value" data-default-value="{{ data.default_value }}"><span class="gp-customizer-icon-undo" aria-hidden="true"></span><span class="screen-reader-text">{{ data.reset_title }}</span></span><# } #>
		<?php
	}
	
	// Function to enqueue the right jquery scripts and styles
	public function enqueue() {
		
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'generate-slider-js', get_template_directory_uri() . '/inc/js/customcontrol.slider.js', array('jquery-ui-slider','customize-controls'), GENERATE_VERSION );
		wp_enqueue_style( 'generate-ui-slider', get_template_directory_uri() . '/inc/css/jquery-ui.structure.css', array(), GENERATE_VERSION );
		wp_enqueue_style( 'generate-flat-slider', get_template_directory_uri() . '/inc/css/range-slider.css', array(), GENERATE_VERSION );
		
	}
}
endif;

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'GeneratePress_Upsell_Section' ) ) :
/**
 * Create our upsell section
 * Escape your URL in the Customizer using esc_url()!
 */
class GeneratePress_Upsell_Section extends WP_Customize_Section {

	public $type = 'gp-upsell-section';
	public $pro_url = '';
	public $pro_text = '';
	public $id = '';
	
	public function json() {
		$json = parent::json();
		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );
		$json['id'] = $this->id;
		return $json;
	}
	
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="generate-upsell-accordion-section control-section-{{ data.type }} cannot-expand accordion-section">
			<h3><a href="{{{ data.pro_url }}}" target="_blank">{{ data.pro_text }}</a></h3>
		</li>
		<?php
	}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Customize_Misc_Control' ) ) :
/**
 * Create our in-section upsell controls
 * Escape your URL in the Customizer using esc_url()!
 */
class Generate_Customize_Misc_Control extends WP_Customize_Control {
	public $description = '';
	public $url = '';
	public $type = 'addon';

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

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'GenerateLabelControl' ) ) :
/**
 * Heading area
 * @since 0.1
 * @depreceted 1.3.41
 **/
class GenerateLabelControl extends WP_Customize_Control {
	public $type = 'label';
	public function __construct( $manager, $id, $args = array() ) {
		$this->statuses = array( '' => __( 'Default', 'generatepress' ) );
		parent::__construct( $manager, $id, $args );
	}

	public function render_content() {
		echo '<span class="generate_customize_label">' . esc_html( $this->label ) . '</span>';
	}
}
endif;