<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all google fonts
 */
if ( ! class_exists( 'Generate_Google_Font_Dropdown_Custom_Control' ) ) :
class Generate_Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
{
    private $fonts = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
		unset($fonts);
		$fonts = ( get_transient('generate_all_google_fonts') ? get_transient('generate_all_google_fonts') : '' );
        if(!empty($fonts))
        {
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?> class="fonts" data-value="<?php echo $this->value();?>">
						<optgroup label="<?php _e( 'Default fonts', 'generatepress' ) ?>" class="default_label">
							<?php 
							printf('<option value="%s" %s>%s</option>', 'inherit', selected($this->value(), 'inherit', false), 'inherit');
							printf('<option value="%s" %s>%s</option>', 'Arial, Helvetica, sans-serif', selected($this->value(), 'Arial, Helvetica, sans-serif', false), 'Arial');
							printf('<option value="%s" %s>%s</option>', 'Century Gothic', selected($this->value(), 'Century Gothic', false), 'Century Gothic');
							printf('<option value="%s" %s>%s</option>', 'Comic Sans MS', selected($this->value(), 'Comic Sans MS', false), 'Comic Sans MS');
							printf('<option value="%s" %s>%s</option>', 'Courier New', selected($this->value(), 'Courier New', false), 'Courier New');
							printf('<option value="%s" %s>%s</option>', 'Georgia, Times New Roman, Times, serif', selected($this->value(), 'Georgia, Times New Roman, Times, serif', false), 'Georgia');
							printf('<option value="%s" %s>%s</option>', 'Helvetica', selected($this->value(), 'Helvetica', false), 'Helvetica');
							printf('<option value="%s" %s>%s</option>', 'Impact', selected($this->value(), 'Impact', false), 'Impact');
							printf('<option value="%s" %s>%s</option>', 'Lucida Console', selected($this->value(), 'Lucida Console', false), 'Lucida Console');
							printf('<option value="%s" %s>%s</option>', 'Lucida Sans Unicode', selected($this->value(), 'Lucida Sans Unicode', false), 'Lucida Sans Unicode');
							printf('<option value="%s" %s>%s</option>', 'Palatino Linotype', selected($this->value(), 'Palatino Linotype', false), 'Palatino Linotype');
							printf('<option value="%s" %s>%s</option>', 'Tahoma, Geneva, sans-serif', selected($this->value(), 'Tahoma, Geneva, sans-serif', false), 'Tahoma');
							printf('<option value="%s" %s>%s</option>', 'Trebuchet MS, Helvetica, sans-serif', selected($this->value(), 'Trebuchet MS, Helvetica, sans-serif', false), 'Trebuchet MS');
							printf('<option value="%s" %s>%s</option>', 'Verdana, Geneva, sans-serif', selected($this->value(), 'Verdana, Geneva, sans-serif', false), 'Verdana');	
							?>
						</optgroup>
						
						<optgroup label="<?php _e( 'Google fonts', 'generatepress' ) ?>" class="google_label">
							<?php
							foreach ( $fonts as $k => $fam )
							{
								printf('<option value="%s" %s>%s</option>', $fam['name'], selected($this->value(), $fam['name'], false), $fam['name']);
							}
							?>
						</optgroup>
                    </select>
					<p class="description"><?php _e('Font family','generatepress'); ?></p>
                </label>
            <?php
        }
    }
    
}
endif;

if ( ! class_exists( 'Generate_Font_Weight_Custom_Control' ) ) :
/**
 * A class to create a dropdown for font weight
 */
class Generate_Font_Weight_Custom_Control extends WP_Customize_Control
{

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
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
endif;

if ( ! class_exists( 'Generate_Text_Transform_Custom_Control' ) ) :
/**
 * A class to create a dropdown for text-transform
 */
class Generate_Text_Transform_Custom_Control extends WP_Customize_Control
{

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
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
endif;

/***********************
/*
/*	Generate_Customize_Slider_Control
/* 
/***********************/
if ( !class_exists('Generate_Customize_Slider_Control') ) :
	class Generate_Customize_Slider_Control extends WP_Customize_Control
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
			<label><p class="description"><span class="typography-size-label"><?php echo esc_html( $this->label ); ?></span> <span class="value"><input name="<?php echo $this->id; ?>" type="text" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" class="slider-input" /><span class="px">px</span></span></p></label>
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