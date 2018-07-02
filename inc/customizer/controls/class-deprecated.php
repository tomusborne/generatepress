<?php
/**
 * Where old Customizer controls retire.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Generate_Customize_Width_Slider_Control' ) ) {
	/**
	 * Create our container width slider control
	 * @deprecated 1.3.47
	 */
	class Generate_Customize_Width_Slider_Control extends WP_Customize_Control {
		public function render_content() {}
	}
}

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'GenerateLabelControl' ) ) {
	/**
	 * Heading area
	 * @since 0.1
	 * @depreceted 1.3.41
	 **/
	class GenerateLabelControl extends WP_Customize_Control {
		public function render_content() {}
	}
}

if ( ! class_exists( 'Generate_Google_Font_Dropdown_Custom_Control' ) ) {
	/**
	 * A class to create a dropdown for all google fonts
	 */
	class Generate_Google_Font_Dropdown_Custom_Control extends WP_Customize_Control {
		public $type = 'gp-customizer-fonts';

		public function enqueue() {
			wp_enqueue_script( 'generatepress-customizer-fonts', trailingslashit( get_template_directory_uri() ) . 'inc/js/typography-controls.js', array( 'customize-controls' ), GENERATE_VERSION, true );
			wp_localize_script( 'generatepress-customizer-fonts', 'gp_customize', array( 'nonce' => wp_create_nonce( 'gp_customize_nonce' ) ) );
		}

		public function to_json() {
			parent::to_json();

			$number_of_fonts = apply_filters( 'generate_number_of_fonts', 200 );
			$this->json['link'] = $this->get_link();
			$this->json['value'] = $this->value();
			$this->json['default_fonts_title'] = __( 'Default fonts', 'generatepress' );
			$this->json['google_fonts_title'] = __( 'Google fonts', 'generatepress' );
			$this->json['description'] = __( 'Font family','generatepress' );
			$this->json['google_fonts'] = apply_filters( 'generate_typography_customize_list', generate_get_all_google_fonts( $number_of_fonts ) );
			$this->json['default_fonts'] = generate_typography_default_fonts();
		}

		public function content_template() {
			?>
			<label>
				<span class="customize-control-title">{{ data.label }}</span>
				<select {{{ data.link }}}>
					<optgroup label="{{ data.default_fonts_title }}">
						<# for ( var key in data.default_fonts ) { #>
							<# var name = data.default_fonts[ key ].split(',')[0]; #>
							<option value="{{ data.default_fonts[ key ] }}"  <# if ( data.default_fonts[ key ] === data.value ) { #>selected="selected"<# } #>>{{ name }}</option>
						<# } #>
					</optgroup>
					<optgroup label="{{ data.google_fonts_title }}">
						<# for ( var key in data.google_fonts ) { #>
							<option value="{{ data.google_fonts[ key ].name }}"  <# if ( data.google_fonts[ key ].name === data.value ) { #>selected="selected"<# } #>>{{ data.google_fonts[ key ].name }}</option>
						<# } #>
					</optgroup>
				</select>
				<p class="description">{{ data.description }}</p>
			</label>
			<?php
		}
	}
}

if ( ! class_exists( 'Generate_Select_Control' ) ) {
	/**
	 * A class to create a dropdown for font weight
	 */
	class Generate_Select_Control extends WP_Customize_Control {
		public $type = 'gp-typography-select';
		public $choices = array();

		public function to_json() {
			parent::to_json();

			foreach ( $this->choices as $name => $choice ) {
				$this->choices[ $name ] = $choice;
			}

			$this->json['choices'] = $this->choices;
			$this->json['link'] = $this->get_link();
			$this->json['value'] = $this->value();

		}

		public function content_template() {
			?>
			<# if ( ! data.choices )
				return;
			#>
			<label>
				<select {{{ data.link }}}>
					<# jQuery.each( data.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.value ) { #> selected="selected"<# } #>>{{ choice }}</option>
					<# } ) #>
				</select>
				<# if ( data.label ) { #>
					<p class="description">{{ data.label }}</p>
				<# } #>
			</label>
			<?php
		}
	}
}

if ( ! class_exists( 'Generate_Hidden_Input_Control' ) ) {
	/**
	 *	Create our hidden input control
	 */
	class Generate_Hidden_Input_Control extends WP_Customize_Control {
		// Setup control type
		public $type = 'gp-hidden-input';
		public $id = '';

		public function to_json() {
			parent::to_json();
			$this->json['link'] = $this->get_link();
			$this->json['value'] = $this->value();
			$this->json['id'] = $this->id;
		}

		public function content_template() {
			?>
			<input name="{{ data.id }}" type="text" {{{ data.link }}} value="{{{ data.value }}}" class="gp-hidden-input" />
			<?php
		}
	}
}

if ( ! class_exists( 'Generate_Font_Weight_Custom_Control' ) ) {
	/**
	 * A class to create a dropdown for font weight
	 * @deprecated since 1.3.40
	 */
	class Generate_Font_Weight_Custom_Control extends WP_Customize_Control {

		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
	    }

		/**
		 * Render the content of the category dropdown
		 *
		 * @return HTML
		 */
		 public function render_content() {
			 ?>
			 <label>
				 <select <?php $this->link(); ?>>
					 <?php
					 printf('<option value="%s" %s>%s</option>', 'normal', selected($this->value(), 'normal', false), 'normal');
					 printf('<option value="%s" %s>%s</option>', 'bold', selected($this->value(), 'bold', false), 'bold');
					 printf('<option value="%s" %s>%s</option>', '100', selected($this->value(), '100', false), '100');
					 printf('<option value="%s" %s>%s</option>', '200', selected($this->value(), '200', false), '200');
					 printf('<option value="%s" %s>%s</option>', '300', selected($this->value(), '300', false), '300');
					 printf('<option value="%s" %s>%s</option>', '400', selected($this->value(), '400', false), '400');
					 printf('<option value="%s" %s>%s</option>', '500', selected($this->value(), '500', false), '500');
					 printf('<option value="%s" %s>%s</option>', '600', selected($this->value(), '600', false), '600');
					 printf('<option value="%s" %s>%s</option>', '700', selected($this->value(), '700', false), '700');
					 printf('<option value="%s" %s>%s</option>', '800', selected($this->value(), '800', false), '800');
					 printf('<option value="%s" %s>%s</option>', '900', selected($this->value(), '900', false), '900');
					 ?>
				 </select>
				 <p class="description"><?php echo esc_html( $this->label ); ?></p>
			 </label>
			 <?php
		 }
	 }
}

if ( ! class_exists( 'Generate_Text_Transform_Custom_Control' ) ) {
	/**
	 * A class to create a dropdown for text-transform
	 * @deprecated since 1.3.40
	 */
	class Generate_Text_Transform_Custom_Control extends WP_Customize_Control {

		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Render the content of the category dropdown
		 *
		 * @return HTML
		 */
		 public function render_content() {
			 ?>
			 <label>
				 <select <?php $this->link(); ?>>
					 <?php
					 printf('<option value="%s" %s>%s</option>', 'none', selected($this->value(), 'none', false), 'none');
					 printf('<option value="%s" %s>%s</option>', 'capitalize', selected($this->value(), 'capitalize', false), 'capitalize');
					 printf('<option value="%s" %s>%s</option>', 'uppercase', selected($this->value(), 'uppercase', false), 'uppercase');
					 printf('<option value="%s" %s>%s</option>', 'lowercase', selected($this->value(), 'lowercase', false), 'lowercase');
					 ?>
				 </select>
				 <p class="description"><?php echo esc_html( $this->label ); ?></p>
			 </label>
			 <?php
		 }
	 }
}

if ( ! class_exists( 'Generate_Customize_Slider_Control' ) ) {
	/**
	 * Create our container width slider control
	 * @deprecated 1.3.47
	 */
	class Generate_Customize_Slider_Control extends WP_Customize_Control {
		public function render_content() {}
	}
}
