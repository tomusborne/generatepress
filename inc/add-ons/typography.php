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
		'font_top_bar' => 'inherit',
		'font_top_bar_category' => '',
		'font_top_bar_variants' => '',
		'top_bar_font_weight' => 'normal',
		'top_bar_font_transform' => 'none',
		'top_bar_font_size' => '13',
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
	$top_bar_family = generate_get_font_family_css( 'font_top_bar', 'generate_settings', generate_get_default_fonts() );
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
	
	// Top bar
	if ( is_active_sidebar( 'top-bar' ) ) {
		$css->set_selector( '.top-bar' );
		$css->add_property( 'font-family', $og_defaults[ 'font_top_bar' ] !== $generate_settings[ 'font_top_bar' ] ? $top_bar_family : null );
		$css->add_property( 'font-weight', esc_attr( $generate_settings[ 'top_bar_font_weight' ] ), $og_defaults[ 'top_bar_font_weight' ] );
		$css->add_property( 'text-transform', esc_attr( $generate_settings[ 'top_bar_font_transform' ] ), $og_defaults[ 'top_bar_font_transform' ] );
		$css->add_property( 'font-size', absint( $generate_settings[ 'top_bar_font_size' ] ), absint( $og_defaults[ 'top_bar_font_size' ] ), 'px' );
	}
	
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
	
	// Mobile
	$css->start_media_query( apply_filters( 'generate_mobile_media_query', '(max-width:768px)' ) );
		// Site title
		$mobile_site_title = ( isset( $generate_settings[ 'mobile_site_title_font_size' ] ) ) ? $generate_settings[ 'mobile_site_title_font_size' ] : '30';
		$css->set_selector( '.main-title' );
		$css->add_property( 'font-size', absint( $mobile_site_title ), false, 'px' );
		
		// H1
		$mobile_h1 = ( isset( $generate_settings[ 'mobile_heading_1_font_size' ] ) ) ? $generate_settings[ 'mobile_heading_1_font_size' ] : '30';
		$css->set_selector( 'h1' );
		$css->add_property( 'font-size', absint( $mobile_h1 ), false, 'px' );
		
		// H2
		$mobile_h2 = ( isset( $generate_settings[ 'mobile_heading_2_font_size' ] ) ) ? $generate_settings[ 'mobile_heading_2_font_size' ] : '25';
		$css->set_selector( 'h2' );
		$css->add_property( 'font-size', absint( $mobile_h2 ), false, 'px' );
	$css->stop_media_query();
	
	// Allow us to hook CSS into our output
	do_action( 'generate_typography_css', $css );
	
	return apply_filters( 'generate_typography_css_output', $css->css_output() );
}
endif;

if ( ! function_exists( 'generate_typography_scripts' ) ) :
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'generate_typography_scripts', 50 );
function generate_typography_scripts() {
	wp_add_inline_style( 'generate-style', generate_font_css() );
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
		'font_top_bar',
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
			
			// If the key isn't set, move on
			if ( ! isset( $generate_settings[$key] ) ) {
				continue;
			}
		
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

if ( ! function_exists( 'generate_fonts_customize_register' ) && ! function_exists( 'generate_default_fonts_customize_register' ) ) :
/** 
 * Build our Typography options
 * Don't run if generate_fonts_customize_register (GP Premium) exists
 * @since 0.1
 */
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
/**
 * Hide the hidden input control
 * @since 1.3.40
 */
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
	$content = json_decode( file_get_contents( get_template_directory_uri() . '/fonts/google-fonts.json' ) );
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
/**
 * Set the default system fonts
 * @since 1.3.40
 */
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
		'font_top_bar',
		'font_site_title',
		'font_site_tagline',
		'font_navigation',
		'font_widget_title',
		'font_heading_1',
		'font_heading_2',
		'font_heading_3',
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
