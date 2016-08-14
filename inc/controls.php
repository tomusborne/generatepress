<?php
/***********************
/*
/*	Generate_Customize_Slider_Control
/* 
/***********************/
if ( !class_exists('Generate_Customize_Width_Slider_Control') ) :
	class Generate_Customize_Width_Slider_Control extends WP_Customize_Control
	{
		// Setup control type
		public $type = 'slider';
		
		public function __construct($manager, $id, $args = array(), $options = array())
		{
			parent::__construct( $manager, $id, $args );
		}

		// Override content render function to output slider HTML
		public function render_content()
		{ ?>
			<label><p style="margin-bottom:0;"><span class="customize-control-title" style="margin:0;display:inline-block;"><?php echo esc_html( $this->label ); ?></span> <span class="value"><input name="<?php echo $this->id; ?>" type="text" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" class="slider-input" /><span class="px">px</span></span></p></label>
			<div class="slider"></div>
		<?php
		}
		
		// Function to enqueue the right jquery scripts and styles
		public function enqueue() {
			
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_script( 'generate-slider-js', get_template_directory_uri() . '/inc/js/customcontrol.slider.js', array('jquery'), GENERATE_VERSION );
			wp_enqueue_style('jquery-ui-slider', get_template_directory_uri() . '/inc/css/jquery-ui.structure.css');
			wp_enqueue_style('jquery-ui-slider-theme', get_template_directory_uri() . '/inc/css/jquery-ui.theme.css');
			
		}
	}
endif;