<?php
/*
 WARNING: This is a core Generate file. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * If Generate Typography isn't activated, set the defaults
 *
 * This file is a core Generate file and should not be edited.
 *
 * @package  GeneratePress
 * @author   Thomas Usborne
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.generatepress.com
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;
 
if ( !function_exists('generate_get_default_fonts') ) :
/**
 * Set default options
 */
function generate_get_default_fonts( $filter = true )
{
	$generate_font_defaults = array(
		'font_body' => 'Open Sans',
		'font_body_category' => 'sans-serif',
		'font_body_variants' => '300,300italic,regular,italic,600,600italic,700,700italic,800,800italic',
		'body_font_weight' => 'normal',
		'body_font_transform' => 'none',
		'body_font_size' => '17',
		'body_line_height' => '1.5', // no unit
		'paragraph_margin' => '1.5', // em
		'font_site_title' => 'inherit',
		'font_site_title_category' => '',
		'font_site_title_variants' => '',
		'site_title_font_weight' => 'bold',
		'site_title_font_transform' => 'none',
		'site_title_font_size' => '45',
		'mobile_site_title_font_size' => '30',
		'font_site_tagline' => 'inherit',
		'font_site_tagline_category' => '',
		'font_site_tagline_variants' => '',
		'site_tagline_font_weight' => 'normal',
		'site_tagline_font_transform' => 'none',
		'site_tagline_font_size' => '15',
		'font_navigation' => 'inherit',
		'font_navigation_category' => '',
		'font_navigation_variants' => '',
		'navigation_font_weight' => 'normal',
		'navigation_font_transform' => 'none',
		'navigation_font_size' => '15',
		'font_widget_title' => 'inherit',
		'font_widget_title_category' => '',
		'font_widget_title_variants' => '',
		'widget_title_font_weight' => 'normal',
		'widget_title_font_transform' => 'none',
		'widget_title_font_size' => '20',
		'widget_content_font_size' => '17',
		'font_heading_1' => 'inherit',
		'font_heading_1_category' => '',
		'font_heading_1_variants' => '',
		'heading_1_weight' => '300',
		'heading_1_transform' => 'none',
		'heading_1_font_size' => '40',
		'mobile_heading_1_font_size' => '30',
		'font_heading_2' => 'inherit',
		'font_heading_2_category' => '',
		'font_heading_2_variants' => '',
		'heading_2_weight' => '300',
		'heading_2_transform' => 'none',
		'heading_2_font_size' => '30',
		'mobile_heading_2_font_size' => '25',
		'font_heading_3' => 'inherit',
		'font_heading_3_category' => '',
		'font_heading_3_variants' => '',
		'heading_3_weight' => 'normal',
		'heading_3_transform' => 'none',
		'heading_3_font_size' => '20',
		'footer_font_size' => '15'
	);
	
	if ( $filter )
		return apply_filters( 'generate_font_option_defaults', $generate_font_defaults );
	
	return $generate_font_defaults;
}
endif;

if ( ! function_exists( 'generate_font_css' ) ) :
/**
 * Generate the CSS in the <head> section using the Theme Customizer
 * @since 0.1
 */
function generate_font_css()
{

	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_default_fonts() 
	);
	
	$og_defaults = generate_get_default_fonts( false );

	$css = new GeneratePress_CSS;
	
	// Get our sub-navigation font size
	$subnav_font_size = $generate_settings['navigation_font_size'] >= 17 ? $generate_settings['navigation_font_size'] - 3 : $generate_settings['navigation_font_size'] - 1;
	
	// Create all of our font family entries
	$body_family = generate_get_font_family_css( 'font_body', 'generate_settings', generate_get_default_fonts() );
	$site_title_family = generate_get_font_family_css( 'font_site_title', 'generate_settings', generate_get_default_fonts() );
	$site_tagline_family = generate_get_font_family_css( 'font_site_tagline', 'generate_settings', generate_get_default_fonts() );
	$navigation_family = generate_get_font_family_css( 'font_navigation', 'generate_settings', generate_get_default_fonts() );
	$widget_family = generate_get_font_family_css( 'font_widget_title', 'generate_settings', generate_get_default_fonts() );
	$h1_family = generate_get_font_family_css( 'font_heading_1', 'generate_settings', generate_get_default_fonts() );
	$h2_family = generate_get_font_family_css( 'font_heading_2', 'generate_settings', generate_get_default_fonts() );
	$h3_family = generate_get_font_family_css( 'font_heading_3', 'generate_settings', generate_get_default_fonts() );
	
	// Body
	$css->set_selector( 'body, button, input, select, textarea' );
	$css->add_property( 'font-family', $body_family );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'body_font_weight' ] ), $og_defaults[ 'body_font_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'body_font_transform' ] ), $og_defaults[ 'body_font_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'body_font_size' ] ), $og_defaults[ 'body_font_size' ], 'px' );
	
	// Line hieght
	$css->set_selector( 'body' );
	$css->add_property( 'line-height', $generate_settings['body_line_height'], $og_defaults['body_line_height'] );
	
	// Paragraph margin
	$css->set_selector( 'p' );
	$css->add_property( 'margin-bottom', $generate_settings['paragraph_margin'], $og_defaults['paragraph_margin'], 'em' );
	
	// Site title
	$css->set_selector( '.main-title' );
	$css->add_property( 'font-family', $og_defaults[ 'font_site_title' ] !== $generate_settings[ 'font_site_title' ] ? $site_title_family : null );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'site_title_font_weight' ] ), $og_defaults[ 'site_title_font_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'site_title_font_transform' ] ), $og_defaults[ 'site_title_font_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'site_title_font_size' ] ), $og_defaults[ 'site_title_font_size' ], 'px' );
	
	// Site description
	$css->set_selector( '.site-description' );
	$css->add_property( 'font-family', $og_defaults[ 'font_site_tagline' ] !== $generate_settings[ 'font_site_tagline' ] ? $site_tagline_family : null );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'site_tagline_font_weight' ] ), $og_defaults[ 'site_tagline_font_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'site_tagline_font_transform' ] ), $og_defaults[ 'site_tagline_font_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'site_tagline_font_size' ] ), $og_defaults[ 'site_tagline_font_size' ], 'px' );
	
	// Navigation
	if ( '' !== generate_get_navigation_location() || is_customize_preview() ) {
		$css->set_selector( '.main-navigation a, .menu-toggle' );
		$css->add_property( 'font-family', $og_defaults[ 'font_navigation' ] !== $generate_settings[ 'font_navigation' ] ? $navigation_family : null );
		$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'navigation_font_weight' ] ), $og_defaults[ 'navigation_font_weight' ] );
		$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'navigation_font_transform' ] ), $og_defaults[ 'navigation_font_transform' ] );
		$css->add_property( 'font-size', absint( $generate_settings[ 'navigation_font_size' ] ), $og_defaults[ 'navigation_font_size' ], 'px' );
		
		// Sub-navigation font size
		$css->set_selector( '.main-navigation .main-nav ul ul li a' );
		$css->add_property( 'font-size', absint( $subnav_font_size ), false, 'px' );
	}
	
	// Widget title
	$css->set_selector( '.widget-title' );
	$css->add_property( 'font-family', $og_defaults[ 'font_widget_title' ] !== $generate_settings[ 'font_widget_title' ] ? $widget_family : null );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'widget_title_font_weight' ] ), $og_defaults[ 'widget_title_font_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'widget_title_font_transform' ] ), $og_defaults[ 'widget_title_font_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'widget_title_font_size' ] ), $og_defaults[ 'widget_title_font_size' ], 'px' );
	
	// Widget font size
	$css->set_selector( '.sidebar .widget, .footer-widgets .widget' );
	$css->add_property( 'font-size', absint( $generate_settings['widget_content_font_size'] ), $og_defaults['widget_content_font_size'], 'px' );
	
	// H1
	$css->set_selector( 'h1' );
	$css->add_property( 'font-family', $og_defaults[ 'font_heading_1' ] !== $generate_settings[ 'font_heading_1' ] ? $h1_family : null );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'heading_1_weight' ] ), $og_defaults[ 'heading_1_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'heading_1_transform' ] ), $og_defaults[ 'heading_1_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'heading_1_font_size' ] ), $og_defaults[ 'heading_1_font_size' ], 'px' );
	
	// H2
	$css->set_selector( 'h2' );
	$css->add_property( 'font-family', $og_defaults[ 'font_heading_2' ] !== $generate_settings[ 'font_heading_2' ] ? $h2_family : null );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'heading_2_weight' ] ), $og_defaults[ 'heading_2_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'heading_2_transform' ] ), $og_defaults[ 'heading_2_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'heading_2_font_size' ] ), $og_defaults[ 'heading_2_font_size' ], 'px' );
	
	// H3
	$css->set_selector( 'h3' );
	$css->add_property( 'font-family', $og_defaults[ 'font_heading_3' ] !== $generate_settings[ 'font_heading_3' ] ? $h3_family : null );
	$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'heading_3_weight' ] ), $og_defaults[ 'heading_3_weight' ] );
	$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'heading_3_transform' ] ), $og_defaults[ 'heading_3_transform' ] );
	$css->add_property( 'font-size', absint( $generate_settings[ 'heading_3_font_size' ] ), $og_defaults[ 'heading_3_font_size' ], 'px' );
	
	// Footer
	$css->set_selector( '.site-info' );
	$css->add_property( 'font-size', absint( $generate_settings['footer_font_size'] ), $og_defaults['footer_font_size'], 'px' );
	
	// Mobile CSS
	$output = '';
	$mobile = apply_filters( 'generate_mobile_breakpoint', '768px' );
	$mobile_site_title = ( isset( $generate_settings[ 'mobile_site_title_font_size' ] ) ) ? $generate_settings[ 'mobile_site_title_font_size' ] : '30';
	$mobile_h1 = ( isset( $generate_settings[ 'mobile_heading_1_font_size' ] ) ) ? $generate_settings[ 'mobile_heading_1_font_size' ] : '30';
	$mobile_h2 = ( isset( $generate_settings[ 'mobile_heading_2_font_size' ] ) ) ? $generate_settings[ 'mobile_heading_2_font_size' ] : '25';
	$output .= '@media (max-width:' . esc_attr( $mobile ) . ') {.main-title{font-size:' . absint( $mobile_site_title ) . 'px;}h1{font-size:' . absint( $mobile_h1 ) . 'px;}h2{font-size:' . absint( $mobile_h2 ) . 'px;}}';
	
	// Allow us to hook CSS into our output
	do_action( 'generate_typography_css', $css );
	
	return $css->css_output() . $output;
}
endif;

if ( ! function_exists( 'generate_typography_scripts' ) ) :
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'generate_typography_scripts', 50 );
function generate_typography_scripts() {
	$name = ( wp_style_is( 'generate-defaults', 'enqueued' ) ) ? 'generate-defaults' : 'generate-style';
	wp_add_inline_style( $name, generate_font_css() );
}
endif;

if ( ! function_exists( 'generate_enqueue_google_fonts' ) ) :
/** 
 * Add Google Fonts to wp_head if needed
 * @since 0.1
 */
add_action( 'wp_enqueue_scripts','generate_enqueue_google_fonts', 0 );
function generate_enqueue_google_fonts() {
	
	if ( is_admin() )
		return;
	
	// Grab our options
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_default_fonts() 
	);
	
	// List our non-Google fonts
	$not_google = str_replace( ' ', '+', generate_typography_default_fonts() );
	
	// Grab our font family settings
	$font_settings = array(
		'font_body',
		'font_site_title',
		'font_site_tagline',
		'font_navigation',
		'font_widget_title',
		'font_heading_1',
		'font_heading_2',
		'font_heading_3'
	);
	
	// Create our Google Fonts array
	$google_fonts = array();
	if ( ! empty( $font_settings ) ) :
	
		foreach ( $font_settings as $key ) {
		
			// If our value is still using the old format, fix it
			if ( strpos( $generate_settings[$key], ':' ) !== false )
				$generate_settings[$key] = current( explode( ':', $generate_settings[$key] ) );
		
			// Replace the spaces in the names with a plus
			$value = str_replace( ' ', '+', $generate_settings[$key] );
			
			// Grab the variants using the plain name
			$variants = generate_get_google_font_variants( $generate_settings[$key], $key );
			
			// If we have variants, add them to our value
			$value = ! empty( $variants ) ? $value . ':' . $variants : $value;
			
			// Make sure we don't add the same font twice
			if( ! in_array( $value, $google_fonts ) ) {
				$google_fonts[] = $value;
			}
			
		}
		
	endif;

	// Ignore any non-Google fonts
	$google_fonts = array_diff($google_fonts, $not_google);
	
	// Separate each different font with a bar
	$google_fonts = implode('|', $google_fonts);
	
	// Apply a filter to the output
	$google_fonts = apply_filters( 'generate_typography_google_fonts', $google_fonts );
	
	// Get the subset
	$subset = apply_filters( 'generate_fonts_subset','' );
	
	// Set up our arguments
	$font_args = array();
	$font_args[ 'family' ] = $google_fonts;
	if ( '' !== $subset )
		$font_args[ 'subset' ] = urlencode( $subset );
	
	// Create our URL using the arguments
	$fonts_url = add_query_arg( $font_args, '//fonts.googleapis.com/css' );
	
	// Enqueue our fonts
	if ( $google_fonts ) { 
		wp_enqueue_style('generate-fonts', $fonts_url, array(), null, 'all' );
	}
}
endif;

if ( ! function_exists( 'generate_fonts_customize_register' ) ) :
add_action( 'customize_register', 'generate_default_fonts_customize_register' );
function generate_default_fonts_customize_register( $wp_customize ) {

	require_once get_template_directory() . '/inc/add-ons/controls.php';

	$defaults = generate_get_default_fonts();
	
	if ( method_exists( $wp_customize,'register_control_type' ) ) {
		$wp_customize->register_control_type( 'Generate_Google_Font_Dropdown_Custom_Control' );
		$wp_customize->register_control_type( 'Generate_Select_Control' );
		$wp_customize->register_control_type( 'Generate_Customize_Slider_Control' );
		$wp_customize->register_control_type( 'Generate_Hidden_Input_Control' );
	}

	$wp_customize->add_section(
		// ID
		'font_section',
		// Arguments array
		array(
			'title' => __( 'Typography', 'generatepress' ),
			'capability' => 'edit_theme_options',
			'description' => '',
			'priority' => 30
		)
	);
	
	// Add body fonts
	$wp_customize->add_setting( 
		'generate_settings[font_body]', 
		array(
			'default' => $defaults['font_body'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_typography'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Google_Font_Dropdown_Custom_Control( 
			$wp_customize, 
			'google_font_body_control', 
			array(
				'label' => __('Body','generatepress'),
				'section' => 'font_section',
				'settings' => 'generate_settings[font_body]',
				'priority' => 1,
				'type' => 'gp-customizer-fonts'
			)
		)
	);
	
	$wp_customize->add_setting( 
		'font_body_category', 
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Hidden_Input_Control( 
			$wp_customize, 
			'font_body_category', 
			array(
				'section' => 'font_section',
				'settings' => 'font_body_category',
				'type' => 'gp-hidden-input'
			)
		)
	);
	
	$wp_customize->add_setting( 
		'font_body_variants', 
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Hidden_Input_Control( 
			$wp_customize, 
			'font_body_variants', 
			array(
				'section' => 'font_section',
				'settings' => 'font_body_variants',
				'type' => 'gp-hidden-input'
			)
		)
	);
	
	$wp_customize->add_setting( 
		'generate_settings[body_font_weight]', 
		array(
			'default' => $defaults['body_font_weight'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_choices',
			'transport' => 'postMessage'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Select_Control( 
			$wp_customize, 
			'generate_settings[body_font_weight]', 
			array(
				'label' => __('Font weight','generatepress'),
				'section' => 'font_section',
				'settings' => 'generate_settings[body_font_weight]',
				'priority' => 20,
				'type' => 'gp-typography-select',
				'choices' => array(
					'normal' => 'normal',
					'bold' => 'bold',
					'100' => '100',
					'200' => '200',
					'300' => '300',
					'400' => '400',
					'500' => '500',
					'600' => '600',
					'700' => '700',
					'800' => '800',
					'900' => '900'
				)
			)
		)
	);
	
	$wp_customize->add_setting( 
		'generate_settings[body_font_transform]', 
		array(
			'default' => $defaults['body_font_transform'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_text_transform',
			'transport' => 'postMessage'
			
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Select_Control( 
			$wp_customize, 
			'generate_settings[body_font_transform]', 
			array(
				'label' => __('Text transform','generatepress'),
				'section' => 'font_section',
				'settings' => 'generate_settings[body_font_transform]',
				'priority' => 30,
				'type' => 'gp-typography-select',
				'choices' => array(
					'none',
					'capitalize',
					'uppercase',
					'lowercase'
				)
			)
		)
	);
	
	$wp_customize->add_setting( 
		'generate_settings[body_font_size]', 
		array(
			'default' => $defaults['body_font_size'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_integer',
			'transport' => 'postMessage'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Customize_Slider_Control( 
			$wp_customize, 
			'generate_settings[body_font_size]', 
			array(
				'label' => __('Font size','generatepress'),
				'section' => 'font_section',
				'settings' => 'generate_settings[body_font_size]',
				'priority' => 40,
				'type' => 'gp-typography-slider',
				'default_value' => $defaults['body_font_size'],
				'unit' => 'px'
			)
		)
	);
	
	$wp_customize->add_setting( 
		'generate_settings[body_line_height]', 
		array(
			'default' => $defaults['body_line_height'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_decimal_integer',
			'transport' => 'postMessage'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Customize_Slider_Control( 
			$wp_customize, 
			'generate_settings[body_line_height]', 
			array(
				'label' => __('Line height','generatepress'),
				'section' => 'font_section',
				'settings' => 'generate_settings[body_line_height]',
				'priority' => 45,
				'type' => 'gp-typography-slider',
				'default_value' => $defaults['body_line_height'],
				'unit' => ''
			)
		)
	);
	
	$wp_customize->add_setting( 
		'generate_settings[paragraph_margin]', 
		array(
			'default' => $defaults['paragraph_margin'],
			'type' => 'option',
			'sanitize_callback' => 'generate_sanitize_decimal_integer',
			'transport' => 'postMessage'
		)
	);
		
	$wp_customize->add_control( 
		new Generate_Customize_Slider_Control( 
			$wp_customize, 
			'generate_settings[paragraph_margin]', 
			array(
				'label' => __('Paragraph margin','generatepress'),
				'section' => 'font_section',
				'settings' => 'generate_settings[paragraph_margin]',
				'priority' => 47,
				'type' => 'gp-typography-slider',
				'default_value' => $defaults['paragraph_margin'],
				'unit' => ''
			)
		)
	);
	
	if ( !function_exists( 'generate_fonts_customize_register' ) && ! defined( 'GP_PREMIUM_VERSION' ) ) {

		$wp_customize->add_control(
			new Generate_Customize_Misc_Control(
				$wp_customize,
				'typography_get_addon_desc',
				array(
					'section'     => 'font_section',
					'type'        => 'addon',
					'label'			=> __( 'More Settings','generatepress' ),
					'url' => generate_get_premium_url( 'https://generatepress.com/downloads/generate-typography/' ),
					'description' => sprintf(
						__( 'Looking to add more typography settings?<br /> %s.', 'generatepress' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							generate_get_premium_url( 'https://generatepress.com/downloads/generate-typography/' ),
							__( 'Check out Generate Typography', 'generatepress' )
						)
					),
					'priority'    => 50,
					'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
				)
			)
		);
	}
}
endif;

if ( ! function_exists( 'generate_typography_customize_preview_css' ) ) :
add_action('customize_controls_print_styles', 'generate_typography_customize_preview_css');
function generate_typography_customize_preview_css() {
	?>
	<style>
		.customize-control-gp-hidden-input {display:none !important;}
	</style>
	<?php
}
endif;

if ( ! function_exists( 'generate_get_all_google_fonts' ) ) :
/**
 * Return an array of all of our Google Fonts
 * @since 1.3.0
 */
function generate_get_all_google_fonts( $amount = 'all' )
{
	// Our big list Google Fonts
	// We use json_decode to reduce PHP memory usage
	// Adding them as a PHP array seems to use quite a bit more memory
	$content = json_decode( '[{"family":"Open Sans","category":"sans-serif","variants":["300","300italic","regular","italic","600","600italic","700","700italic","800","800italic"]},{"family":"Roboto","category":"sans-serif","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","900","900italic"]},{"family":"Slabo 27px","category":"serif","variants":["regular"]},{"family":"Lato","category":"sans-serif","variants":["100","100italic","300","300italic","regular","italic","700","700italic","900","900italic"]},{"family":"Oswald","category":"sans-serif","variants":["300","regular","700"]},{"family":"Roboto Condensed","category":"sans-serif","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Source Sans Pro","category":"sans-serif","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900","900italic"]},{"family":"Montserrat","category":"sans-serif","variants":["regular","700"]},{"family":"Raleway","category":"sans-serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"PT Sans","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Roboto Slab","category":"serif","variants":["100","300","regular","700"]},{"family":"Droid Sans","category":"sans-serif","variants":["regular","700"]},{"family":"Open Sans Condensed","category":"sans-serif","variants":["300","300italic","700"]},{"family":"Lora","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Ubuntu","category":"sans-serif","variants":["300","300italic","regular","italic","500","500italic","700","700italic"]},{"family":"Droid Serif","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Merriweather","category":"serif","variants":["300","300italic","regular","italic","700","700italic","900","900italic"]},{"family":"Arimo","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Noto Sans","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"PT Sans Narrow","category":"sans-serif","variants":["regular","700"]},{"family":"Titillium Web","category":"sans-serif","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900"]},{"family":"Playfair Display","category":"serif","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"PT Serif","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Muli","category":"sans-serif","variants":["300","300italic","regular","italic"]},{"family":"Fjalla One","category":"sans-serif","variants":["regular"]},{"family":"Indie Flower","category":"handwriting","variants":["regular"]},{"family":"Inconsolata","category":"monospace","variants":["regular","700"]},{"family":"Dosis","category":"sans-serif","variants":["200","300","regular","500","600","700","800"]},{"family":"Bitter","category":"serif","variants":["regular","italic","700"]},{"family":"Oxygen","category":"sans-serif","variants":["300","regular","700"]},{"family":"Cabin","category":"sans-serif","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Lobster","category":"display","variants":["regular"]},{"family":"Noto Serif","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Arvo","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Hind","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Yanone Kaffeesatz","category":"sans-serif","variants":["200","300","regular","700"]},{"family":"Alegreya Sans","category":"sans-serif","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","800","800italic","900","900italic"]},{"family":"Poiret One","category":"display","variants":["regular"]},{"family":"Catamaran","category":"sans-serif","variants":["100","200","300","regular","500","600","700","800","900"]},{"family":"Bree Serif","category":"serif","variants":["regular"]},{"family":"Nunito","category":"sans-serif","variants":["300","regular","700"]},{"family":"Poppins","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Merriweather Sans","category":"sans-serif","variants":["300","300italic","regular","italic","700","700italic","800","800italic"]},{"family":"Libre Baskerville","category":"serif","variants":["regular","italic","700"]},{"family":"Anton","category":"sans-serif","variants":["regular"]},{"family":"Abel","category":"sans-serif","variants":["regular"]},{"family":"Josefin Sans","category":"sans-serif","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},{"family":"Asap","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Ubuntu Condensed","category":"sans-serif","variants":["regular"]},{"family":"Exo 2","category":"sans-serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Crimson Text","category":"serif","variants":["regular","italic","600","600italic","700","700italic"]},{"family":"Quicksand","category":"sans-serif","variants":["300","regular","700"]},{"family":"Archivo Narrow","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Passion One","category":"display","variants":["regular","700","900"]},{"family":"Pacifico","category":"handwriting","variants":["regular"]},{"family":"Varela Round","category":"sans-serif","variants":["regular"]},{"family":"Sigmar One","category":"display","variants":["regular"]},{"family":"Dancing Script","category":"handwriting","variants":["regular","700"]},{"family":"Karla","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Francois One","category":"sans-serif","variants":["regular"]},{"family":"Cuprum","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Signika","category":"sans-serif","variants":["300","regular","600","700"]},{"family":"Shadows Into Light","category":"handwriting","variants":["regular"]},{"family":"Candal","category":"sans-serif","variants":["regular"]},{"family":"Exo","category":"sans-serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Questrial","category":"sans-serif","variants":["regular"]},{"family":"Vollkorn","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Play","category":"sans-serif","variants":["regular","700"]},{"family":"PT Sans Caption","category":"sans-serif","variants":["regular","700"]},{"family":"Fira Sans","category":"sans-serif","variants":["300","300italic","regular","italic","500","500italic","700","700italic"]},{"family":"Maven Pro","category":"sans-serif","variants":["regular","500","700","900"]},{"family":"Orbitron","category":"sans-serif","variants":["regular","500","700","900"]},{"family":"Roboto Mono","category":"monospace","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic"]},{"family":"Abril Fatface","category":"display","variants":["regular"]},{"family":"Alegreya","category":"serif","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Rokkitt","category":"serif","variants":["regular","700"]},{"family":"Amatic SC","category":"handwriting","variants":["regular","700"]},{"family":"Pathway Gothic One","category":"sans-serif","variants":["regular"]},{"family":"Yellowtail","category":"handwriting","variants":["regular"]},{"family":"Patua One","category":"display","variants":["regular"]},{"family":"Crete Round","category":"serif","variants":["regular","italic"]},{"family":"Rubik","category":"sans-serif","variants":["300","300italic","regular","italic","500","500italic","700","700italic","900","900italic"]},{"family":"Monda","category":"sans-serif","variants":["regular","700"]},{"family":"Work Sans","category":"sans-serif","variants":["100","200","300","regular","500","600","700","800","900"]},{"family":"Gloria Hallelujah","category":"handwriting","variants":["regular"]},{"family":"EB Garamond","category":"serif","variants":["regular"]},{"family":"Architects Daughter","category":"handwriting","variants":["regular"]},{"family":"Righteous","category":"display","variants":["regular"]},{"family":"Comfortaa","category":"display","variants":["300","regular","700"]},{"family":"ABeeZee","category":"sans-serif","variants":["regular","italic"]},{"family":"Josefin Slab","category":"serif","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},{"family":"Sanchez","category":"serif","variants":["regular","italic"]},{"family":"Pontano Sans","category":"sans-serif","variants":["regular"]},{"family":"Kaushan Script","category":"handwriting","variants":["regular"]},{"family":"Ropa Sans","category":"sans-serif","variants":["regular","italic"]},{"family":"Russo One","category":"sans-serif","variants":["regular"]},{"family":"Noticia Text","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Quattrocento Sans","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Lobster Two","category":"display","variants":["regular","italic","700","700italic"]},{"family":"Chewy","category":"display","variants":["regular"]},{"family":"Acme","category":"sans-serif","variants":["regular"]},{"family":"News Cycle","category":"sans-serif","variants":["regular","700"]},{"family":"Hammersmith One","category":"sans-serif","variants":["regular"]},{"family":"Source Code Pro","category":"monospace","variants":["200","300","regular","500","600","700","900"]},{"family":"Istok Web","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Domine","category":"serif","variants":["regular","700"]},{"family":"Old Standard TT","category":"serif","variants":["regular","italic","700"]},{"family":"Cinzel","category":"serif","variants":["regular","700","900"]},{"family":"Economica","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Gudea","category":"sans-serif","variants":["regular","italic","700"]},{"family":"Kreon","category":"serif","variants":["300","regular","700"]},{"family":"Courgette","category":"handwriting","variants":["regular"]},{"family":"BenchNine","category":"sans-serif","variants":["300","regular","700"]},{"family":"Satisfy","category":"handwriting","variants":["regular"]},{"family":"Ruda","category":"sans-serif","variants":["regular","700","900"]},{"family":"Armata","category":"sans-serif","variants":["regular"]},{"family":"Alfa Slab One","category":"display","variants":["regular"]},{"family":"Archivo Black","category":"sans-serif","variants":["regular"]},{"family":"Coming Soon","category":"handwriting","variants":["regular"]},{"family":"Tinos","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Voltaire","category":"sans-serif","variants":["regular"]},{"family":"Quattrocento","category":"serif","variants":["regular","700"]},{"family":"Vidaloka","category":"serif","variants":["regular"]},{"family":"Permanent Marker","category":"handwriting","variants":["regular"]},{"family":"Arapey","category":"serif","variants":["regular","italic"]},{"family":"Handlee","category":"handwriting","variants":["regular"]},{"family":"Varela","category":"sans-serif","variants":["regular"]},{"family":"Covered By Your Grace","category":"handwriting","variants":["regular"]},{"family":"Cabin Condensed","category":"sans-serif","variants":["regular","500","600","700"]},{"family":"Playfair Display SC","category":"serif","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Didact Gothic","category":"sans-serif","variants":["regular"]},{"family":"Source Serif Pro","category":"serif","variants":["regular","600","700"]},{"family":"Bangers","category":"display","variants":["regular"]},{"family":"Oleo Script","category":"display","variants":["regular","700"]},{"family":"Cookie","category":"handwriting","variants":["regular"]},{"family":"Philosopher","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Cantarell","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Fredoka One","category":"display","variants":["regular"]},{"family":"Cardo","category":"serif","variants":["regular","italic","700"]},{"family":"Bevan","category":"display","variants":["regular"]},{"family":"Playball","category":"display","variants":["regular"]},{"family":"Antic Slab","category":"serif","variants":["regular"]},{"family":"Great Vibes","category":"handwriting","variants":["regular"]},{"family":"Rock Salt","category":"handwriting","variants":["regular"]},{"family":"Boogaloo","category":"display","variants":["regular"]},{"family":"Kanit","category":"sans-serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Days One","category":"sans-serif","variants":["regular"]},{"family":"Droid Sans Mono","category":"monospace","variants":["regular"]},{"family":"Sintony","category":"sans-serif","variants":["regular","700"]},{"family":"Luckiest Guy","category":"display","variants":["regular"]},{"family":"Amiri","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Andada","category":"serif","variants":["regular"]},{"family":"Audiowide","category":"display","variants":["regular"]},{"family":"Tangerine","category":"handwriting","variants":["regular","700"]},{"family":"Shadows Into Light Two","category":"handwriting","variants":["regular"]},{"family":"Ek Mukta","category":"sans-serif","variants":["200","300","regular","500","600","700","800"]},{"family":"Actor","category":"sans-serif","variants":["regular"]},{"family":"Bad Script","category":"handwriting","variants":["regular"]},{"family":"Glegoo","category":"serif","variants":["regular","700"]},{"family":"Nobile","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Special Elite","category":"display","variants":["regular"]},{"family":"Antic","category":"sans-serif","variants":["regular"]},{"family":"Volkhov","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Niconne","category":"handwriting","variants":["regular"]},{"family":"Teko","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Signika Negative","category":"sans-serif","variants":["300","regular","600","700"]},{"family":"Changa One","category":"display","variants":["regular","italic"]},{"family":"Rambla","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Paytone One","category":"sans-serif","variants":["regular"]},{"family":"Rancho","category":"handwriting","variants":["regular"]},{"family":"Cambay","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Gentium Book Basic","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Sorts Mill Goudy","category":"serif","variants":["regular","italic"]},{"family":"Scada","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Molengo","category":"sans-serif","variants":["regular"]},{"family":"Montez","category":"handwriting","variants":["regular"]},{"family":"Neuton","category":"serif","variants":["200","300","regular","italic","700","800"]},{"family":"Rajdhani","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Khand","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Damion","category":"handwriting","variants":["regular"]},{"family":"Amaranth","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Patrick Hand","category":"handwriting","variants":["regular"]},{"family":"Khula","category":"sans-serif","variants":["300","regular","600","700","800"]},{"family":"Homenaje","category":"sans-serif","variants":["regular"]},{"family":"Alice","category":"serif","variants":["regular"]},{"family":"Homemade Apple","category":"handwriting","variants":["regular"]},{"family":"Fugaz One","category":"display","variants":["regular"]},{"family":"Prompt","category":"sans-serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Fauna One","category":"serif","variants":["regular"]},{"family":"Sacramento","category":"handwriting","variants":["regular"]},{"family":"Hind Siliguri","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Marck Script","category":"handwriting","variants":["regular"]},{"family":"Nothing You Could Do","category":"handwriting","variants":["regular"]},{"family":"Alex Brush","category":"handwriting","variants":["regular"]},{"family":"Kalam","category":"handwriting","variants":["300","regular","700"]},{"family":"Alegreya Sans SC","category":"sans-serif","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","800","800italic","900","900italic"]},{"family":"Cantata One","category":"serif","variants":["regular"]},{"family":"Jura","category":"sans-serif","variants":["300","regular","500","600"]},{"family":"Calligraffitti","category":"handwriting","variants":["regular"]},{"family":"Copse","category":"serif","variants":["regular"]},{"family":"Pinyon Script","category":"handwriting","variants":["regular"]},{"family":"Gentium Basic","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Enriqueta","category":"serif","variants":["regular","700"]},{"family":"Syncopate","category":"sans-serif","variants":["regular","700"]},{"family":"Share","category":"display","variants":["regular","italic","700","700italic"]},{"family":"Hind Vadodara","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Convergence","category":"sans-serif","variants":["regular"]},{"family":"Hanuman","category":"serif","variants":["regular","700"]},{"family":"Basic","category":"sans-serif","variants":["regular"]},{"family":"Mate","category":"serif","variants":["regular","italic"]},{"family":"Aldrich","category":"sans-serif","variants":["regular"]},{"family":"Ubuntu Mono","category":"monospace","variants":["regular","italic","700","700italic"]},{"family":"Cherry Cream Soda","category":"display","variants":["regular"]},{"family":"Coda","category":"display","variants":["regular","800"]},{"family":"Ultra","category":"serif","variants":["regular"]},{"family":"PT Mono","category":"monospace","variants":["regular"]},{"family":"Viga","category":"sans-serif","variants":["regular"]},{"family":"Montserrat Alternates","category":"sans-serif","variants":["regular","700"]},{"family":"Marmelad","category":"sans-serif","variants":["regular"]},{"family":"Allura","category":"handwriting","variants":["regular"]},{"family":"Neucha","category":"handwriting","variants":["regular"]},{"family":"Squada One","category":"display","variants":["regular"]},{"family":"Electrolize","category":"sans-serif","variants":["regular"]},{"family":"Quantico","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Julius Sans One","category":"sans-serif","variants":["regular"]},{"family":"Kameron","category":"serif","variants":["regular","700"]},{"family":"Adamina","category":"serif","variants":["regular"]},{"family":"Allerta Stencil","category":"sans-serif","variants":["regular"]},{"family":"Cabin Sketch","category":"display","variants":["regular","700"]},{"family":"Ceviche One","category":"display","variants":["regular"]},{"family":"Prata","category":"serif","variants":["regular"]},{"family":"Carme","category":"sans-serif","variants":["regular"]},{"family":"PT Serif Caption","category":"serif","variants":["regular","italic"]},{"family":"Sarala","category":"sans-serif","variants":["regular","700"]},{"family":"Jaldi","category":"sans-serif","variants":["regular","700"]},{"family":"Schoolbell","category":"handwriting","variants":["regular"]},{"family":"Advent Pro","category":"sans-serif","variants":["100","200","300","regular","500","600","700"]},{"family":"Chivo","category":"sans-serif","variants":["regular","italic","900","900italic"]},{"family":"Freckle Face","category":"display","variants":["regular"]},{"family":"Yantramanav","category":"sans-serif","variants":["100","300","regular","500","700","900"]},{"family":"Doppio One","category":"sans-serif","variants":["regular"]},{"family":"Gochi Hand","category":"handwriting","variants":["regular"]},{"family":"Average","category":"serif","variants":["regular"]},{"family":"Unica One","category":"display","variants":["regular"]},{"family":"Lusitana","category":"serif","variants":["regular","700"]},{"family":"Nixie One","category":"display","variants":["regular"]},{"family":"Michroma","category":"sans-serif","variants":["regular"]},{"family":"Puritan","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Reenie Beanie","category":"handwriting","variants":["regular"]},{"family":"Contrail One","category":"display","variants":["regular"]},{"family":"Allerta","category":"sans-serif","variants":["regular"]},{"family":"Just Another Hand","category":"handwriting","variants":["regular"]},{"family":"Marvel","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Pragati Narrow","category":"sans-serif","variants":["regular","700"]},{"family":"Parisienne","category":"handwriting","variants":["regular"]},{"family":"Bubblegum Sans","category":"display","variants":["regular"]},{"family":"Telex","category":"sans-serif","variants":["regular"]},{"family":"Aclonica","category":"sans-serif","variants":["regular"]},{"family":"Average Sans","category":"sans-serif","variants":["regular"]},{"family":"Jockey One","category":"sans-serif","variants":["regular"]},{"family":"Rochester","category":"handwriting","variants":["regular"]},{"family":"Spinnaker","category":"sans-serif","variants":["regular"]},{"family":"Lustria","category":"serif","variants":["regular"]},{"family":"Waiting for the Sunrise","category":"handwriting","variants":["regular"]},{"family":"Limelight","category":"display","variants":["regular"]},{"family":"Merienda","category":"handwriting","variants":["regular","700"]},{"family":"Cutive","category":"serif","variants":["regular"]},{"family":"Sree Krushnadevaraya","category":"serif","variants":["regular"]},{"family":"Alef","category":"sans-serif","variants":["regular","700"]},{"family":"Port Lligat Slab","category":"serif","variants":["regular"]},{"family":"Annie Use Your Telescope","category":"handwriting","variants":["regular"]},{"family":"Overlock","category":"display","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Denk One","category":"sans-serif","variants":["regular"]},{"family":"Walter Turncoat","category":"handwriting","variants":["regular"]},{"family":"Monoton","category":"display","variants":["regular"]},{"family":"Crafty Girls","category":"handwriting","variants":["regular"]},{"family":"Carrois Gothic","category":"sans-serif","variants":["regular"]},{"family":"Marcellus","category":"serif","variants":["regular"]},{"family":"Marcellus SC","category":"serif","variants":["regular"]},{"family":"Goudy Bookletter 1911","category":"serif","variants":["regular"]},{"family":"Sansita One","category":"display","variants":["regular"]},{"family":"Yesteryear","category":"handwriting","variants":["regular"]},{"family":"Magra","category":"sans-serif","variants":["regular","700"]},{"family":"Berkshire Swash","category":"handwriting","variants":["regular"]},{"family":"Chelsea Market","category":"display","variants":["regular"]},{"family":"Black Ops One","category":"display","variants":["regular"]},{"family":"Leckerli One","category":"handwriting","variants":["regular"]},{"family":"Oxygen Mono","category":"monospace","variants":["regular"]},{"family":"Oranienbaum","category":"serif","variants":["regular"]},{"family":"Martel","category":"serif","variants":["200","300","regular","600","700","800","900"]},{"family":"Six Caps","category":"sans-serif","variants":["regular"]},{"family":"Arbutus Slab","category":"serif","variants":["regular"]},{"family":"Press Start 2P","category":"display","variants":["regular"]},{"family":"Coustard","category":"serif","variants":["regular","900"]},{"family":"Halant","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Rosario","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Fontdiner Swanky","category":"display","variants":["regular"]},{"family":"Belleza","category":"sans-serif","variants":["regular"]},{"family":"Caudex","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Fredericka the Great","category":"display","variants":["regular"]},{"family":"Alegreya SC","category":"serif","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Grand Hotel","category":"handwriting","variants":["regular"]},{"family":"Fanwood Text","category":"serif","variants":["regular","italic"]},{"family":"Radley","category":"serif","variants":["regular","italic"]},{"family":"Anonymous Pro","category":"monospace","variants":["regular","italic","700","700italic"]},{"family":"Tauri","category":"sans-serif","variants":["regular"]},{"family":"Carter One","category":"display","variants":["regular"]},{"family":"Merienda One","category":"handwriting","variants":["regular"]},{"family":"Trocchi","category":"serif","variants":["regular"]},{"family":"Forum","category":"display","variants":["regular"]},{"family":"Sue Ellen Francisco","category":"handwriting","variants":["regular"]},{"family":"Duru Sans","category":"sans-serif","variants":["regular"]},{"family":"Racing Sans One","category":"display","variants":["regular"]},{"family":"Lateef","category":"handwriting","variants":["regular"]},{"family":"Metrophobic","category":"sans-serif","variants":["regular"]},{"family":"Short Stack","category":"handwriting","variants":["regular"]},{"family":"Graduate","category":"display","variants":["regular"]},{"family":"Cinzel Decorative","category":"display","variants":["regular","700","900"]},{"family":"Corben","category":"display","variants":["regular","700"]},{"family":"Fenix","category":"serif","variants":["regular"]},{"family":"Mako","category":"sans-serif","variants":["regular"]},{"family":"Anaheim","category":"sans-serif","variants":["regular"]},{"family":"Gilda Display","category":"serif","variants":["regular"]},{"family":"Capriola","category":"sans-serif","variants":["regular"]},{"family":"Allan","category":"display","variants":["regular","700"]},{"family":"Lilita One","category":"display","variants":["regular"]},{"family":"Petit Formal Script","category":"handwriting","variants":["regular"]},{"family":"Italianno","category":"handwriting","variants":["regular"]},{"family":"Inder","category":"sans-serif","variants":["regular"]},{"family":"Gruppo","category":"display","variants":["regular"]},{"family":"Oleo Script Swash Caps","category":"display","variants":["regular","700"]},{"family":"Strait","category":"sans-serif","variants":["regular"]},{"family":"Slackey","category":"display","variants":["regular"]},{"family":"Cousine","category":"monospace","variants":["regular","italic","700","700italic"]},{"family":"Tenor Sans","category":"sans-serif","variants":["regular"]},{"family":"Caveat","category":"handwriting","variants":["regular","700"]},{"family":"Clicker Script","category":"handwriting","variants":["regular"]},{"family":"Unkempt","category":"display","variants":["regular","700"]},{"family":"Timmana","category":"sans-serif","variants":["regular"]},{"family":"VT323","category":"monospace","variants":["regular"]},{"family":"Baumans","category":"display","variants":["regular"]},{"family":"Cutive Mono","category":"monospace","variants":["regular"]},{"family":"Rufina","category":"serif","variants":["regular","700"]},{"family":"Frijole","category":"display","variants":["regular"]},{"family":"Quando","category":"serif","variants":["regular"]},{"family":"Kelly Slab","category":"display","variants":["regular"]},{"family":"Andika","category":"sans-serif","variants":["regular"]},{"family":"Alike","category":"serif","variants":["regular"]},{"family":"Libre Franklin","category":"sans-serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Eczar","category":"serif","variants":["regular","500","600","700","800"]},{"family":"Lemon","category":"display","variants":["regular"]},{"family":"Crushed","category":"display","variants":["regular"]},{"family":"Delius","category":"handwriting","variants":["regular"]},{"family":"Cherry Swash","category":"display","variants":["regular","700"]},{"family":"Slabo 13px","category":"serif","variants":["regular"]},{"family":"Pompiere","category":"display","variants":["regular"]},{"family":"Lekton","category":"sans-serif","variants":["regular","italic","700"]},{"family":"Brawler","category":"serif","variants":["regular"]},{"family":"Ovo","category":"serif","variants":["regular"]},{"family":"Bowlby One SC","category":"display","variants":["regular"]},{"family":"Aladin","category":"handwriting","variants":["regular"]},{"family":"Oregano","category":"display","variants":["regular","italic"]},{"family":"Judson","category":"serif","variants":["regular","italic","700"]},{"family":"Finger Paint","category":"display","variants":["regular"]},{"family":"Wire One","category":"sans-serif","variants":["regular"]},{"family":"The Girl Next Door","category":"handwriting","variants":["regular"]},{"family":"Concert One","category":"display","variants":["regular"]},{"family":"Happy Monkey","category":"display","variants":["regular"]},{"family":"Prosto One","category":"display","variants":["regular"]},{"family":"Love Ya Like A Sister","category":"display","variants":["regular"]},{"family":"NTR","category":"sans-serif","variants":["regular"]},{"family":"Give You Glory","category":"handwriting","variants":["regular"]},{"family":"Bentham","category":"serif","variants":["regular"]},{"family":"Quintessential","category":"handwriting","variants":["regular"]},{"family":"Orienta","category":"sans-serif","variants":["regular"]},{"family":"Nova Square","category":"display","variants":["regular"]},{"family":"Sniglet","category":"display","variants":["regular","800"]},{"family":"Poly","category":"serif","variants":["regular","italic"]},{"family":"Simonetta","category":"display","variants":["regular","italic","900","900italic"]},{"family":"Gravitas One","category":"display","variants":["regular"]},{"family":"Cairo","category":"sans-serif","variants":["200","300","regular","600","700","900"]},{"family":"IM Fell DW Pica","category":"serif","variants":["regular","italic"]},{"family":"Headland One","category":"serif","variants":["regular"]},{"family":"Karma","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Zeyada","category":"handwriting","variants":["regular"]},{"family":"Herr Von Muellerhoff","category":"handwriting","variants":["regular"]},{"family":"Expletus Sans","category":"display","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Shojumaru","category":"display","variants":["regular"]},{"family":"Knewave","category":"display","variants":["regular"]},{"family":"Just Me Again Down Here","category":"handwriting","variants":["regular"]},{"family":"Mr Dafoe","category":"handwriting","variants":["regular"]},{"family":"Skranji","category":"display","variants":["regular","700"]},{"family":"Fira Mono","category":"monospace","variants":["regular","700"]},{"family":"Londrina Solid","category":"display","variants":["regular"]},{"family":"GFS Didot","category":"serif","variants":["regular"]},{"family":"Yeseva One","category":"display","variants":["regular"]},{"family":"La Belle Aurore","category":"handwriting","variants":["regular"]},{"family":"Stardos Stencil","category":"display","variants":["regular","700"]},{"family":"Kranky","category":"display","variants":["regular"]},{"family":"IM Fell English","category":"serif","variants":["regular","italic"]},{"family":"Kotta One","category":"serif","variants":["regular"]},{"family":"Qwigley","category":"handwriting","variants":["regular"]},{"family":"Bilbo Swash Caps","category":"handwriting","variants":["regular"]},{"family":"Lily Script One","category":"display","variants":["regular"]},{"family":"Imprima","category":"sans-serif","variants":["regular"]},{"family":"Biryani","category":"sans-serif","variants":["200","300","regular","600","700","800","900"]},{"family":"Arizonia","category":"handwriting","variants":["regular"]},{"family":"Dorsa","category":"sans-serif","variants":["regular"]},{"family":"Megrim","category":"display","variants":["regular"]},{"family":"Gafata","category":"sans-serif","variants":["regular"]},{"family":"Salsa","category":"display","variants":["regular"]},{"family":"UnifrakturMaguntia","category":"display","variants":["regular"]},{"family":"Holtwood One SC","category":"serif","variants":["regular"]},{"family":"Belgrano","category":"serif","variants":["regular"]},{"family":"Gabriela","category":"serif","variants":["regular"]},{"family":"Engagement","category":"handwriting","variants":["regular"]},{"family":"Carrois Gothic SC","category":"sans-serif","variants":["regular"]},{"family":"Khmer","category":"display","variants":["regular"]},{"family":"Norican","category":"handwriting","variants":["regular"]},{"family":"Loved by the King","category":"handwriting","variants":["regular"]},{"family":"Shanti","category":"sans-serif","variants":["regular"]},{"family":"Kurale","category":"serif","variants":["regular"]},{"family":"Fjord One","category":"serif","variants":["regular"]},{"family":"Rationale","category":"sans-serif","variants":["regular"]},{"family":"Voces","category":"display","variants":["regular"]},{"family":"Angkor","category":"display","variants":["regular"]},{"family":"Kristi","category":"handwriting","variants":["regular"]},{"family":"Ramabhadra","category":"sans-serif","variants":["regular"]},{"family":"Caesar Dressing","category":"display","variants":["regular"]},{"family":"Suwannaphum","category":"display","variants":["regular"]},{"family":"Itim","category":"handwriting","variants":["regular"]},{"family":"Federo","category":"sans-serif","variants":["regular"]},{"family":"Tienne","category":"serif","variants":["regular","700","900"]},{"family":"Share Tech","category":"sans-serif","variants":["regular"]},{"family":"IM Fell English SC","category":"serif","variants":["regular"]},{"family":"Patrick Hand SC","category":"handwriting","variants":["regular"]},{"family":"Martel Sans","category":"sans-serif","variants":["200","300","regular","600","700","800","900"]},{"family":"Chonburi","category":"display","variants":["regular"]},{"family":"Seaweed Script","category":"display","variants":["regular"]},{"family":"Delius Swash Caps","category":"handwriting","variants":["regular"]},{"family":"Mountains of Christmas","category":"display","variants":["regular","700"]},{"family":"Palanquin","category":"sans-serif","variants":["100","200","300","regular","500","600","700"]},{"family":"Aguafina Script","category":"handwriting","variants":["regular"]},{"family":"Londrina Outline","category":"display","variants":["regular"]},{"family":"Mouse Memoirs","category":"sans-serif","variants":["regular"]},{"family":"Italiana","category":"serif","variants":["regular"]},{"family":"Titan One","category":"display","variants":["regular"]},{"family":"Over the Rainbow","category":"handwriting","variants":["regular"]},{"family":"Bowlby One","category":"display","variants":["regular"]},{"family":"Dawning of a New Day","category":"handwriting","variants":["regular"]},{"family":"Life Savers","category":"display","variants":["regular","700"]},{"family":"Fondamento","category":"handwriting","variants":["regular","italic"]},{"family":"Podkova","category":"serif","variants":["regular","700"]},{"family":"Chau Philomene One","category":"sans-serif","variants":["regular","italic"]},{"family":"Sail","category":"display","variants":["regular"]},{"family":"Raleway Dots","category":"display","variants":["regular"]},{"family":"Cantora One","category":"sans-serif","variants":["regular"]},{"family":"Meddon","category":"handwriting","variants":["regular"]},{"family":"Mr De Haviland","category":"handwriting","variants":["regular"]},{"family":"Stalemate","category":"handwriting","variants":["regular"]},{"family":"Averia Serif Libre","category":"display","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Geo","category":"sans-serif","variants":["regular","italic"]},{"family":"Share Tech Mono","category":"monospace","variants":["regular"]},{"family":"Vast Shadow","category":"display","variants":["regular"]},{"family":"Euphoria Script","category":"handwriting","variants":["regular"]},{"family":"Cambo","category":"serif","variants":["regular"]},{"family":"Mate SC","category":"serif","variants":["regular"]},{"family":"Amethysta","category":"serif","variants":["regular"]},{"family":"Balthazar","category":"serif","variants":["regular"]},{"family":"Bokor","category":"display","variants":["regular"]},{"family":"McLaren","category":"display","variants":["regular"]},{"family":"Rouge Script","category":"handwriting","variants":["regular"]},{"family":"Nova Mono","category":"monospace","variants":["regular"]},{"family":"Ledger","category":"serif","variants":["regular"]},{"family":"Unna","category":"serif","variants":["regular"]},{"family":"Cedarville Cursive","category":"handwriting","variants":["regular"]},{"family":"Sofia","category":"handwriting","variants":["regular"]},{"family":"Rammetto One","category":"display","variants":["regular"]},{"family":"IM Fell Double Pica","category":"serif","variants":["regular","italic"]},{"family":"Junge","category":"serif","variants":["regular"]},{"family":"Codystar","category":"display","variants":["300","regular"]},{"family":"Trirong","category":"serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Englebert","category":"sans-serif","variants":["regular"]},{"family":"Amarante","category":"display","variants":["regular"]},{"family":"Averia Sans Libre","category":"display","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Poller One","category":"display","variants":["regular"]},{"family":"Ruthie","category":"handwriting","variants":["regular"]},{"family":"Maiden Orange","category":"display","variants":["regular"]},{"family":"Buenard","category":"serif","variants":["regular","700"]},{"family":"Kite One","category":"sans-serif","variants":["regular"]},{"family":"Battambang","category":"display","variants":["regular","700"]},{"family":"Metamorphous","category":"display","variants":["regular"]},{"family":"Milonga","category":"display","variants":["regular"]},{"family":"Chicle","category":"display","variants":["regular"]},{"family":"Flamenco","category":"display","variants":["300","regular"]},{"family":"IM Fell French Canon","category":"serif","variants":["regular","italic"]},{"family":"Moul","category":"display","variants":["regular"]},{"family":"Stint Ultra Expanded","category":"display","variants":["regular"]},{"family":"Rye","category":"display","variants":["regular"]},{"family":"Mallanna","category":"sans-serif","variants":["regular"]},{"family":"Medula One","category":"display","variants":["regular"]},{"family":"Esteban","category":"serif","variants":["regular"]},{"family":"Inika","category":"serif","variants":["regular","700"]},{"family":"Gurajada","category":"serif","variants":["regular"]},{"family":"Stoke","category":"serif","variants":["300","regular"]},{"family":"Stint Ultra Condensed","category":"display","variants":["regular"]},{"family":"Ramaraja","category":"serif","variants":["regular"]},{"family":"Revalia","category":"display","variants":["regular"]},{"family":"Oldenburg","category":"display","variants":["regular"]},{"family":"Condiment","category":"handwriting","variants":["regular"]},{"family":"Donegal One","category":"serif","variants":["regular"]},{"family":"Rosarivo","category":"serif","variants":["regular","italic"]},{"family":"Dynalight","category":"display","variants":["regular"]},{"family":"IM Fell DW Pica SC","category":"serif","variants":["regular"]},{"family":"Heebo","category":"sans-serif","variants":["100","300","regular","500","700","800","900"]},{"family":"Suez One","category":"serif","variants":["regular"]},{"family":"Numans","category":"sans-serif","variants":["regular"]},{"family":"Prociono","category":"serif","variants":["regular"]},{"family":"Ruslan Display","category":"display","variants":["regular"]},{"family":"Artifika","category":"serif","variants":["regular"]},{"family":"Scheherazade","category":"serif","variants":["regular","700"]},{"family":"Assistant","category":"sans-serif","variants":["200","300","regular","600","700","800"]},{"family":"Chango","category":"display","variants":["regular"]},{"family":"Krona One","category":"sans-serif","variants":["regular"]},{"family":"Henny Penny","category":"display","variants":["regular"]},{"family":"Delius Unicase","category":"handwriting","variants":["regular","700"]},{"family":"Coda Caption","category":"sans-serif","variants":["800"]},{"family":"Monofett","category":"display","variants":["regular"]},{"family":"Offside","category":"display","variants":["regular"]},{"family":"Text Me One","category":"sans-serif","variants":["regular"]},{"family":"IM Fell Double Pica SC","category":"serif","variants":["regular"]},{"family":"Sunshiney","category":"handwriting","variants":["regular"]},{"family":"Swanky and Moo Moo","category":"handwriting","variants":["regular"]},{"family":"Creepster","category":"display","variants":["regular"]},{"family":"Tulpen One","category":"display","variants":["regular"]},{"family":"Sancreek","category":"display","variants":["regular"]},{"family":"Wallpoet","category":"display","variants":["regular"]},{"family":"Kavoon","category":"display","variants":["regular"]},{"family":"Linden Hill","category":"serif","variants":["regular","italic"]},{"family":"Habibi","category":"serif","variants":["regular"]},{"family":"MedievalSharp","category":"display","variants":["regular"]},{"family":"League Script","category":"handwriting","variants":["regular"]},{"family":"Suranna","category":"serif","variants":["regular"]},{"family":"Miniver","category":"display","variants":["regular"]},{"family":"Trade Winds","category":"display","variants":["regular"]},{"family":"Nokora","category":"serif","variants":["regular","700"]},{"family":"IM Fell Great Primer","category":"serif","variants":["regular","italic"]},{"family":"Piedra","category":"display","variants":["regular"]},{"family":"Ruluko","category":"sans-serif","variants":["regular"]},{"family":"Overlock SC","category":"display","variants":["regular"]},{"family":"Almendra","category":"serif","variants":["regular","italic","700","700italic"]},{"family":"Iceland","category":"display","variants":["regular"]},{"family":"Vibur","category":"handwriting","variants":["regular"]},{"family":"IM Fell French Canon SC","category":"serif","variants":["regular"]},{"family":"IM Fell Great Primer SC","category":"serif","variants":["regular"]},{"family":"Buda","category":"display","variants":["300"]},{"family":"Sumana","category":"serif","variants":["regular","700"]},{"family":"Averia Libre","category":"display","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Paprika","category":"display","variants":["regular"]},{"family":"Glass Antiqua","category":"display","variants":["regular"]},{"family":"Montserrat Subrayada","category":"sans-serif","variants":["regular","700"]},{"family":"Caveat Brush","category":"handwriting","variants":["regular"]},{"family":"Wendy One","category":"sans-serif","variants":["regular"]},{"family":"Rubik One","category":"sans-serif","variants":["regular"]},{"family":"Sonsie One","category":"display","variants":["regular"]},{"family":"Port Lligat Sans","category":"sans-serif","variants":["regular"]},{"family":"Nova Round","category":"display","variants":["regular"]},{"family":"Cagliostro","category":"sans-serif","variants":["regular"]},{"family":"Faster One","category":"display","variants":["regular"]},{"family":"Alike Angular","category":"serif","variants":["regular"]},{"family":"Redressed","category":"handwriting","variants":["regular"]},{"family":"Odor Mean Chey","category":"display","variants":["regular"]},{"family":"Elsie","category":"display","variants":["regular","900"]},{"family":"Bilbo","category":"handwriting","variants":["regular"]},{"family":"Irish Grover","category":"display","variants":["regular"]},{"family":"Ribeye","category":"display","variants":["regular"]},{"family":"Snippet","category":"sans-serif","variants":["regular"]},{"family":"Mystery Quest","category":"display","variants":["regular"]},{"family":"Mrs Saint Delafield","category":"handwriting","variants":["regular"]},{"family":"Akronim","category":"display","variants":["regular"]},{"family":"Dr Sugiyama","category":"handwriting","variants":["regular"]},{"family":"New Rocker","category":"display","variants":["regular"]},{"family":"Bigshot One","category":"display","variants":["regular"]},{"family":"Julee","category":"handwriting","variants":["regular"]},{"family":"Mandali","category":"sans-serif","variants":["regular"]},{"family":"Sarpanch","category":"sans-serif","variants":["regular","500","600","700","800","900"]},{"family":"Galindo","category":"display","variants":["regular"]},{"family":"Nosifer","category":"display","variants":["regular"]},{"family":"Della Respira","category":"serif","variants":["regular"]},{"family":"Meie Script","category":"handwriting","variants":["regular"]},{"family":"Antic Didone","category":"serif","variants":["regular"]},{"family":"Nova Slim","category":"display","variants":["regular"]},{"family":"Wellfleet","category":"display","variants":["regular"]},{"family":"Cormorant Garamond","category":"serif","variants":["300","300italic","regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Asul","category":"sans-serif","variants":["regular","700"]},{"family":"Miltonian Tattoo","category":"display","variants":["regular"]},{"family":"Margarine","category":"display","variants":["regular"]},{"family":"Croissant One","category":"display","variants":["regular"]},{"family":"Bubbler One","category":"sans-serif","variants":["regular"]},{"family":"UnifrakturCook","category":"display","variants":["700"]},{"family":"Peralta","category":"display","variants":["regular"]},{"family":"Iceberg","category":"display","variants":["regular"]},{"family":"Sarina","category":"display","variants":["regular"]},{"family":"Jacques Francois","category":"serif","variants":["regular"]},{"family":"El Messiri","category":"sans-serif","variants":["regular","500","600","700"]},{"family":"Content","category":"display","variants":["regular","700"]},{"family":"Nova Flat","category":"display","variants":["regular"]},{"family":"Pirata One","category":"display","variants":["regular"]},{"family":"Trykker","category":"serif","variants":["regular"]},{"family":"Emilys Candy","category":"display","variants":["regular"]},{"family":"Autour One","category":"display","variants":["regular"]},{"family":"Germania One","category":"display","variants":["regular"]},{"family":"Rozha One","category":"serif","variants":["regular"]},{"family":"Palanquin Dark","category":"sans-serif","variants":["regular","500","600","700"]},{"family":"Miriam Libre","category":"sans-serif","variants":["regular","700"]},{"family":"Pattaya","category":"sans-serif","variants":["regular"]},{"family":"Frank Ruhl Libre","category":"sans-serif","variants":["300","regular","500","700","900"]},{"family":"Athiti","category":"sans-serif","variants":["200","300","regular","500","600","700"]},{"family":"GFS Neohellenic","category":"sans-serif","variants":["regular","italic","700","700italic"]},{"family":"Petrona","category":"serif","variants":["regular"]},{"family":"Montaga","category":"serif","variants":["regular"]},{"family":"Monsieur La Doulaise","category":"handwriting","variants":["regular"]},{"family":"Lovers Quarrel","category":"handwriting","variants":["regular"]},{"family":"Snowburst One","category":"display","variants":["regular"]},{"family":"Warnes","category":"display","variants":["regular"]},{"family":"Dekko","category":"handwriting","variants":["regular"]},{"family":"Smythe","category":"display","variants":["regular"]},{"family":"Joti One","category":"display","variants":["regular"]},{"family":"Passero One","category":"display","variants":["regular"]},{"family":"Laila","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Astloch","category":"display","variants":["regular","700"]},{"family":"Kenia","category":"display","variants":["regular"]},{"family":"Keania One","category":"display","variants":["regular"]},{"family":"Original Surfer","category":"display","variants":["regular"]},{"family":"Vesper Libre","category":"serif","variants":["regular","500","700","900"]},{"family":"Asset","category":"display","variants":["regular"]},{"family":"Nova Oval","category":"display","variants":["regular"]},{"family":"Spicy Rice","category":"display","variants":["regular"]},{"family":"Fascinate","category":"display","variants":["regular"]},{"family":"Modern Antiqua","category":"display","variants":["regular"]},{"family":"Kadwa","category":"serif","variants":["regular","700"]},{"family":"Galada","category":"display","variants":["regular"]},{"family":"Eagle Lake","category":"handwriting","variants":["regular"]},{"family":"Fresca","category":"sans-serif","variants":["regular"]},{"family":"Diplomata","category":"display","variants":["regular"]},{"family":"Purple Purse","category":"display","variants":["regular"]},{"family":"Atomic Age","category":"display","variants":["regular"]},{"family":"Vampiro One","category":"display","variants":["regular"]},{"family":"Sura","category":"serif","variants":["regular","700"]},{"family":"Fascinate Inline","category":"display","variants":["regular"]},{"family":"Trochut","category":"display","variants":["regular","italic","700"]},{"family":"Ribeye Marrow","category":"display","variants":["regular"]},{"family":"Gorditas","category":"display","variants":["regular","700"]},{"family":"Jomhuria","category":"display","variants":["regular"]},{"family":"Ranchers","category":"display","variants":["regular"]},{"family":"Griffy","category":"display","variants":["regular"]},{"family":"Lancelot","category":"display","variants":["regular"]},{"family":"Freehand","category":"display","variants":["regular"]},{"family":"Bungee","category":"display","variants":["regular"]},{"family":"Koulen","category":"display","variants":["regular"]},{"family":"Amatica SC","category":"display","variants":["regular","700"]},{"family":"Secular One","category":"sans-serif","variants":["regular"]},{"family":"Galdeano","category":"sans-serif","variants":["regular"]},{"family":"Goblin One","category":"display","variants":["regular"]},{"family":"Pridi","category":"serif","variants":["200","300","regular","500","600","700"]},{"family":"Jacques Francois Shadow","category":"display","variants":["regular"]},{"family":"Jolly Lodger","category":"display","variants":["regular"]},{"family":"Cormorant Infant","category":"serif","variants":["300","300italic","regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Elsie Swash Caps","category":"display","variants":["regular","900"]},{"family":"Rum Raisin","category":"sans-serif","variants":["regular"]},{"family":"Sofadi One","category":"display","variants":["regular"]},{"family":"Averia Gruesa Libre","category":"display","variants":["regular"]},{"family":"Macondo Swash Caps","category":"display","variants":["regular"]},{"family":"Devonshire","category":"handwriting","variants":["regular"]},{"family":"Londrina Shadow","category":"display","variants":["regular"]},{"family":"Mitr","category":"sans-serif","variants":["200","300","regular","500","600","700"]},{"family":"Taviraj","category":"serif","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Felipa","category":"handwriting","variants":["regular"]},{"family":"Amiko","category":"sans-serif","variants":["regular","600","700"]},{"family":"Siemreap","category":"display","variants":["regular"]},{"family":"Miltonian","category":"display","variants":["regular"]},{"family":"Nova Script","category":"display","variants":["regular"]},{"family":"Preahvihear","category":"display","variants":["regular"]},{"family":"Romanesco","category":"handwriting","variants":["regular"]},{"family":"Nova Cut","category":"display","variants":["regular"]},{"family":"Arya","category":"sans-serif","variants":["regular","700"]},{"family":"Baloo Tamma","category":"display","variants":["regular"]},{"family":"Dangrek","category":"display","variants":["regular"]},{"family":"Smokum","category":"display","variants":["regular"]},{"family":"David Libre","category":"serif","variants":["regular","500","700"]},{"family":"Baloo Paaji","category":"display","variants":["regular"]},{"family":"Geostar Fill","category":"display","variants":["regular"]},{"family":"Arima Madurai","category":"display","variants":["100","200","300","regular","500","700","800","900"]},{"family":"Metal Mania","category":"display","variants":["regular"]},{"family":"Chenla","category":"display","variants":["regular"]},{"family":"Seymour One","category":"sans-serif","variants":["regular"]},{"family":"Kantumruy","category":"sans-serif","variants":["300","regular","700"]},{"family":"Princess Sofia","category":"handwriting","variants":["regular"]},{"family":"Londrina Sketch","category":"display","variants":["regular"]},{"family":"Mrs Sheppards","category":"handwriting","variants":["regular"]},{"family":"Underdog","category":"display","variants":["regular"]},{"family":"Sirin Stencil","category":"display","variants":["regular"]},{"family":"Rhodium Libre","category":"serif","variants":["regular"]},{"family":"Butterfly Kids","category":"handwriting","variants":["regular"]},{"family":"Molle","category":"handwriting","variants":["italic"]},{"family":"Bonbon","category":"handwriting","variants":["regular"]},{"family":"Ewert","category":"display","variants":["regular"]},{"family":"Bayon","category":"display","variants":["regular"]},{"family":"Bigelow Rules","category":"display","variants":["regular"]},{"family":"Tillana","category":"handwriting","variants":["regular","500","600","700","800"]},{"family":"Taprom","category":"display","variants":["regular"]},{"family":"Rubik Mono One","category":"sans-serif","variants":["regular"]},{"family":"Aubrey","category":"display","variants":["regular"]},{"family":"Harmattan","category":"sans-serif","variants":["regular"]},{"family":"Plaster","category":"display","variants":["regular"]},{"family":"Amita","category":"handwriting","variants":["regular","700"]},{"family":"Spirax","category":"display","variants":["regular"]},{"family":"Geostar","category":"display","variants":["regular"]},{"family":"Federant","category":"display","variants":["regular"]},{"family":"Almendra SC","category":"serif","variants":["regular"]},{"family":"Miss Fajardose","category":"handwriting","variants":["regular"]},{"family":"Metal","category":"display","variants":["regular"]},{"family":"Maitree","category":"serif","variants":["200","300","regular","500","600","700"]},{"family":"Almendra Display","category":"display","variants":["regular"]},{"family":"Marko One","category":"serif","variants":["regular"]},{"family":"Sriracha","category":"handwriting","variants":["regular"]},{"family":"Supermercado One","category":"display","variants":["regular"]},{"family":"Arbutus","category":"display","variants":["regular"]},{"family":"Sevillana","category":"display","variants":["regular"]},{"family":"Combo","category":"display","variants":["regular"]},{"family":"Kdam Thmor","category":"display","variants":["regular"]},{"family":"Hind Guntur","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Baloo Chettan","category":"display","variants":["regular"]},{"family":"Risque","category":"display","variants":["regular"]},{"family":"Hind Madurai","category":"sans-serif","variants":["300","regular","500","600","700"]},{"family":"Uncial Antiqua","category":"display","variants":["regular"]},{"family":"Ravi Prakash","category":"display","variants":["regular"]},{"family":"Ranga","category":"display","variants":["regular","700"]},{"family":"Diplomata SC","category":"display","variants":["regular"]},{"family":"Macondo","category":"display","variants":["regular"]},{"family":"Eater","category":"display","variants":["regular"]},{"family":"Erica One","category":"display","variants":["regular"]},{"family":"Changa","category":"sans-serif","variants":["200","300","regular","500","600","700","800"]},{"family":"Mr Bedfort","category":"handwriting","variants":["regular"]},{"family":"Stalinist One","category":"display","variants":["regular"]},{"family":"Chela One","category":"display","variants":["regular"]},{"family":"Butcherman","category":"display","variants":["regular"]},{"family":"Bungee Shade","category":"display","variants":["regular"]},{"family":"Ruge Boogie","category":"handwriting","variants":["regular"]},{"family":"Cormorant SC","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Lakki Reddy","category":"handwriting","variants":["regular"]},{"family":"Cormorant","category":"serif","variants":["300","300italic","regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Reem Kufi","category":"sans-serif","variants":["regular"]},{"family":"Lalezar","category":"display","variants":["regular"]},{"family":"Flavors","category":"display","variants":["regular"]},{"family":"Sahitya","category":"serif","variants":["regular","700"]},{"family":"Katibeh","category":"display","variants":["regular"]},{"family":"Jim Nightshade","category":"handwriting","variants":["regular"]},{"family":"Baloo Thambi","category":"display","variants":["regular"]},{"family":"Space Mono","category":"monospace","variants":["regular","italic","700","700italic"]},{"family":"Yrsa","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Unlock","category":"display","variants":["regular"]},{"family":"Emblema One","category":"display","variants":["regular"]},{"family":"Cormorant Upright","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Moulpali","category":"display","variants":["regular"]},{"family":"Baloo","category":"display","variants":["regular"]},{"family":"Mada","category":"sans-serif","variants":["300","regular","500","900"]},{"family":"Bungee Inline","category":"display","variants":["regular"]},{"family":"Tenali Ramakrishna","category":"sans-serif","variants":["regular"]},{"family":"Fasthand","category":"serif","variants":["regular"]},{"family":"Coiny","category":"display","variants":["regular"]},{"family":"Mukta Vaani","category":"sans-serif","variants":["200","300","regular","500","600","700","800"]},{"family":"Baloo Bhaina","category":"display","variants":["regular"]},{"family":"Dhurjati","category":"sans-serif","variants":["regular"]},{"family":"Inknut Antiqua","category":"serif","variants":["300","regular","500","600","700","800","900"]},{"family":"Scope One","category":"serif","variants":["regular"]},{"family":"Atma","category":"display","variants":["300","regular","500","600","700"]},{"family":"Lemonada","category":"display","variants":["300","regular","600","700"]},{"family":"Baloo Da","category":"display","variants":["regular"]},{"family":"Shrikhand","category":"display","variants":["regular"]},{"family":"Fruktur","category":"display","variants":["regular"]},{"family":"Mirza","category":"display","variants":["regular","500","600","700"]},{"family":"BioRhyme","category":"serif","variants":["200","300","regular","700","800"]},{"family":"Gidugu","category":"sans-serif","variants":["regular"]},{"family":"Farsan","category":"display","variants":["regular"]},{"family":"Asar","category":"serif","variants":["regular"]},{"family":"Rakkas","category":"display","variants":["regular"]},{"family":"Proza Libre","category":"sans-serif","variants":["regular","italic","500","500italic","600","600italic","700","700italic","800","800italic"]},{"family":"Baloo Bhai","category":"display","variants":["regular"]},{"family":"Suravaram","category":"serif","variants":["regular"]},{"family":"Yatra One","category":"display","variants":["regular"]},{"family":"Hanalei","category":"display","variants":["regular"]},{"family":"Mogra","category":"display","variants":["regular"]},{"family":"Rasa","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Aref Ruqaa","category":"serif","variants":["regular","700"]},{"family":"Pavanam","category":"sans-serif","variants":["regular"]},{"family":"Hanalei Fill","category":"display","variants":["regular"]},{"family":"BioRhyme Expanded","category":"serif","variants":["200","300","regular","700","800"]},{"family":"Chathura","category":"sans-serif","variants":["100","300","regular","700","800"]},{"family":"Peddana","category":"serif","variants":["regular"]},{"family":"Cormorant Unicase","category":"serif","variants":["300","regular","500","600","700"]},{"family":"Bungee Hairline","category":"display","variants":["regular"]},{"family":"Kumar One Outline","category":"display","variants":["regular"]},{"family":"Modak","category":"display","variants":["regular"]},{"family":"Kavivanar","category":"handwriting","variants":["regular"]},{"family":"Bungee Outline","category":"display","variants":["regular"]},{"family":"Kumar One","category":"display","variants":["regular"]},{"family":"Meera Inimai","category":"sans-serif","variants":["regular"]}]' );
	
	// Loop through them and put what we need into our fonts array
	$fonts = array();
	foreach ( $content as $item ) {
		
		// Grab what we need from our big list
		$atts = array( 
			'name'     => $item->family,
			'category' => $item->category,
			'variants' => $item->variants
		);
		
		// Create an ID using our font family name
		$id = strtolower( str_replace( ' ', '_', $item->family ) );
		
		// Add our attributes to our new array
		$fonts[ $id ] = $atts;
	}
	
	if ( 'all' !== $amount )
		$fonts = array_slice( $fonts, 0, $amount );
	
	// Alphabetize our fonts
	$alphabetize = apply_filters( 'generate_alphabetize_google_fonts', true );
	if ( $alphabetize ) asort( $fonts );
	
	// Filter to allow us to modify the fonts array
	return apply_filters( 'generate_google_fonts_array', $fonts );
}
endif;

if ( ! function_exists( 'generate_get_all_google_fonts_ajax' ) ) :
/**
 * Return an array of all of our Google Fonts
 * @since 1.3.0
 */
add_action( 'wp_ajax_generate_get_all_google_fonts_ajax', 'generate_get_all_google_fonts_ajax' );
function generate_get_all_google_fonts_ajax()
{
	// Bail if the nonce doesn't check out
	if ( ! isset( $_POST[ 'gp_customize_nonce' ] ) || ! wp_verify_nonce( sanitize_key( $_POST[ 'gp_customize_nonce' ] ), 'gp_customize_nonce' ) )
		wp_die();
	
	// Do another nonce check
	check_ajax_referer( 'gp_customize_nonce', 'gp_customize_nonce' );
	
	// Bail if user can't edit theme options
	if ( ! current_user_can( 'edit_theme_options' ) )
		wp_die();
	
	// Get all of our fonts
	$fonts = generate_get_all_google_fonts();
	
	// Send all of our fonts in JSON format
	echo wp_json_encode( $fonts );
	
	// Exit
	die();
}
endif;

if ( ! function_exists( 'generate_get_google_font_variants' ) ) :
/**
 * Wrapper function to find variants for chosen Google Fonts
 * Example: generate_get_google_font_variation( 'Open Sans' )
 * @since 1.3.0
 */
function generate_get_google_font_variants( $font, $key = '' )
{
	// Don't need variants if we're using a system font
	if ( in_array( $font, generate_typography_default_fonts() ) )
		return;
	
	// Return if we have our variants saved
	if ( '' !== $key && get_theme_mod( $key . '_variants' ) ) return get_theme_mod( $key . '_variants' );
	
	// Get our defaults
	$defaults = generate_get_default_fonts();
	
	// If our default font is selected and the category isn't saved, we already know the category
	if ( $defaults[ $key ] == $font ) return $defaults[ $key . '_variants' ];

	// Grab all of our fonts
	// It's a big list, so hopefully we're not even still reading
	$fonts = generate_get_all_google_fonts();
	
	// Get the ID from our font
	$id = strtolower( str_replace( ' ', '_', $font ) );
	
	// If the ID doesn't exist within our fonts, we can bail
	if ( ! array_key_exists( $id, $fonts ) )
		return;
	
	// Grab all of the variants associated with our font
	$variants = $fonts[$id]['variants'];
	
	// Loop through them and put them into an array, then turn them into a comma separated list
	$output = array();
	if ( $variants ) :
		foreach ( $variants as $variant ) {
			$output[] = $variant;
		}
		return implode(',', apply_filters( 'generate_typography_variants', $output ) );
	endif;
	
}
endif;

if ( ! function_exists( 'generate_get_google_font_category' ) ) :
/**
 * Wrapper function to find the category for chosen Google Font
 * Example: generate_get_google_font_category( 'Open Sans' )
 * @since 1.3.0
 */
function generate_get_google_font_category( $font, $key = '' )
{
	// Don't need a category if we're using a system font
	if ( in_array( $font, generate_typography_default_fonts() ) )
		return;
	
	// Return if we have our variants saved
	if ( '' !== $key && get_theme_mod( $key . '_category' ) ) return ', ' . get_theme_mod( $key . '_category' );
	
	// Get our defaults
	$defaults = generate_get_default_fonts();
	
	// If our default font is selected and the category isn't saved, we already know the category
	if ( $defaults[ $key ] == $font ) return ', ' . $defaults[ $key . '_category' ];
	
	// Grab all of our fonts
	// It's a big list, so hopefully we're not even still reading
	$fonts = generate_get_all_google_fonts();
	
	// Get the ID from our font
	$id = strtolower( str_replace( ' ', '_', $font ) );
	
	// If the ID doesn't exist within our fonts, we can bail
	if ( ! array_key_exists( $id, $fonts ) )
		return;
	
	// Let's grab our category to go with our font
	$category = ! empty( $fonts[$id]['category'] ) ? ', ' . $fonts[$id]['category'] : '';
	
	// Return it to be used by our function
	return $category;
	
}
endif;

if ( ! function_exists( 'generate_typography_convert_values' ) ) :
/**
 * Take the old body font value and strip it of variants
 * This should only run once
 * @since 1.3.0
 */
add_action('admin_init', 'generate_typography_convert_values');
function generate_typography_convert_values()
{
	// Don't run this if Typography add-on is activated
	if ( function_exists( 'generate_fonts_customize_register' ) )
		return;
	
	// If we've done this before, bail
	if ( 'true' == get_option( 'generate_update_core_typography' ) || 'true' == get_option( 'generate_update_premium_typography' ) )
		return;
	
	// Get all settings
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_default_fonts() 
	);
	
	// Get our body font family setting
	$value = $generate_settings[ 'font_body' ];
	
	// Create a new, empty array
	$new_settings = array();
	
	// If our value has : in it, and isn't empty
	if ( strpos( $value, ':' ) !== false && ! empty( $value ) ) :
		
		// Remove the : and anything past it
		$value = current( explode( ':', $value ) );
		
		// Populate our new array with our new, clean value
		$new_settings[ 'font_body' ] = $value;
		
	endif;
	
	// Update our options if our new array isn't empty
	if ( ! empty( $new_settings ) ) :
		$generate_new_typography_settings = wp_parse_args( $new_settings, $generate_settings );
		update_option( 'generate_settings', $generate_new_typography_settings );
	endif;
	
	// All done, set an option so we don't go through this again
	update_option( 'generate_update_core_typography','true' );
}
endif;

if ( ! function_exists( 'generate_get_font_family_css' ) ) :
/**
 * Wrapper function to create font-family value for CSS
 * @since 1.3.0
 */
function generate_get_font_family_css( $font, $settings, $default )
{
	$generate_settings = wp_parse_args( 
		get_option( $settings, array() ), 
		$default 
	);
	
	// We don't want to wrap quotes around these values
	$no_quotes = array(
		'inherit',
		'Arial, Helvetica, sans-serif',
		'Georgia, Times New Roman, Times, serif',
		'Helvetica',
		'Impact',
		'Segoe UI, Helvetica Neue, Helvetica, sans-serif',
		'Tahoma, Geneva, sans-serif',
		'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif'
	);
	
	// Get our font
	$font_family = $generate_settings[ $font ];
	
	// If our value is still using the old format, fix it
	if ( strpos( $font_family, ':' ) !== false )
		$font_family = current( explode( ':', $font_family ) );

	// Set up our wrapper
	if ( in_array( $font_family, $no_quotes ) ) :
		$wrapper_start = null;
		$wrapper_end = null;
	else :
		$wrapper_start = '"';
		$wrapper_end = '"' . generate_get_google_font_category( $font_family, $font );
	endif;
	
	// Output the CSS
	$output = ( 'inherit' == $font_family ) ? '' : $wrapper_start . $font_family . $wrapper_end;
	return $output;
}
endif;

if ( ! function_exists( 'generate_typography_default_fonts' ) ) :
function generate_typography_default_fonts() {
	$fonts = array(
		'inherit',
		'Arial, Helvetica, sans-serif',
		'Century Gothic',
		'Comic Sans MS',
		'Courier New',
		'Georgia, Times New Roman, Times, serif',
		'Helvetica',
		'Impact',
		'Lucida Console',
		'Lucida Sans Unicode',
		'Palatino Linotype',
		'Segoe UI, Helvetica Neue, Helvetica, sans-serif',
		'Tahoma, Geneva, sans-serif',
		'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif'
	);
	
	return apply_filters( 'generate_typography_default_fonts', $fonts );
}
endif;

if ( ! function_exists( 'generate_add_to_font_customizer_list' ) ) :
/**
 * This function makes sure your selected typography option exists in the Customizer list
 * Why wouldn't it? Originally, all 800+ fonts were in each list. This has been reduced to 200.
 * This functions makes sure that if you were using a font that is now not included in the 200, you won't lose it.
 * @since 1.3.40
 */
add_filter( 'generate_typography_customize_list','generate_add_to_font_customizer_list' );
function generate_add_to_font_customizer_list( $fonts )
{
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_default_fonts()
	);
	
	$font_settings = array(
		'font_body',
		'font_site_title',
		'font_site_tagline',
		'font_navigation',
		'font_widget_title',
		'font_heading_1',
		'font_heading_2',
		'font_heading_3'
	);
	
	foreach ( $font_settings as $setting ) {
		if ( ! in_array( $generate_settings[ $setting ], generate_typography_default_fonts() ) ) {
			$fonts[ strtolower( str_replace( ' ', '_', $generate_settings[ $setting ] ) ) ] = array( 'name' => $generate_settings[ $setting ] );
		}
	}
	
	if ( function_exists( 'generate_secondary_nav_get_defaults' ) ) :
		$generate_secondary_nav_settings = wp_parse_args( 
			get_option( 'generate_secondary_nav_settings', array() ), 
			generate_secondary_nav_get_defaults() 
		);
		if ( ! in_array( $generate_secondary_nav_settings[ 'font_secondary_navigation' ], generate_typography_default_fonts() ) ) {
			$fonts[ strtolower( str_replace( ' ', '_', $generate_secondary_nav_settings[ 'font_secondary_navigation' ] ) ) ] = array( 'name' => $generate_secondary_nav_settings[ 'font_secondary_navigation' ] );
		}
	endif;
	
	return $fonts;
}
endif;

if ( ! function_exists( 'generate_resource_hints' ) ) :
/**
 * Add resource hints to our Google fonts call
 * @since 1.3.42
 */
add_filter( 'wp_resource_hints', 'generate_resource_hints', 10, 2 );
function generate_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'generate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}
	return $urls;
}
endif;

if ( ! function_exists( 'generate_typography_set_font_data' ) ) :
/**
 * This function will check to see if your category and variants are saved
 * If not, it will set them for you
 * Generally, set_theme_mod isn't best practice, but this is here for migration purposes for a set amount of time only
 * Any time a user saves a font in the Customizer from now on, the category and variants are saved as theme_mods, so this function won't be necessary
 * @since 1.3.40
 */
add_action( 'admin_init','generate_typography_set_font_data' );
function generate_typography_set_font_data() 
{	
	// Get our defaults
	$defaults = generate_get_default_fonts();
	
	// Get our settings
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		$defaults
	);
	
	// We don't need to do this if we're using the default font, as these values have defaults already
	if ( $defaults[ 'font_body' ] == $generate_settings[ 'font_body' ] )
		return;
	
	// Don't need to continue if we're using a system font or our default font
	if ( in_array( $generate_settings[ 'font_body' ], generate_typography_default_fonts() ) )
		return;
	
	// Don't continue if our category and variants are already set
	if ( get_theme_mod( 'font_body_category' ) && get_theme_mod( 'font_body_variants' ) )
		return;
	
	// Get all of our fonts
	$fonts = generate_get_all_google_fonts();

	// Get the ID from our font
	$id = strtolower( str_replace( ' ', '_', $generate_settings[ 'font_body' ] ) );
	
	// If the ID doesn't exist within our fonts, we can bail
	if ( ! array_key_exists( $id, $fonts ) )
		return;
	
	// Let's grab our category to go with our font
	$category = ! empty( $fonts[$id]['category'] ) ? $fonts[$id]['category'] : '';
	
	// Grab all of the variants associated with our font
	$variants = $fonts[$id]['variants'];
	
	// Loop through our variants and put them into an array, then turn them into a comma separated list
	$output = array();
	if ( $variants ) :
		foreach ( $variants as $variant ) {
			$output[] = $variant;
		}
		$variants = implode(',', $output);
	endif;
	
	// Set our theme mods with our new settings
	if ( '' !== $category ) set_theme_mod( 'font_body_category', $category );
	if ( '' !== $variants ) set_theme_mod( 'font_body_variants', $variants );
}
endif;