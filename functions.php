<?php
/**
 * GeneratePress functions and definitions
 *
 * @package GeneratePress
 */

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'GENERATE_VERSION', '1.3.46' );
define( 'GENERATE_URI', get_template_directory_uri() );
define( 'GENERATE_DIR', get_template_directory() );

if ( ! function_exists( 'generate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
add_action( 'after_setup_theme', 'generate_setup' );
function generate_setup() 
{
	// Make theme available for translation
	load_theme_textdomain( 'generatepress' );

	//Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	//Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );

	//Register primary menu
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'generatepress' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status' ) );
	
	// Enable support for WooCommerce
	add_theme_support( 'woocommerce' );
	
	// Enable support for <title> tag
	add_theme_support( 'title-tag' );
	
	// Add HTML5 theme support
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	
	// Add Logo support
	add_theme_support( 'custom-logo', array(
		'height' => 70,
		'width' => 350,
		'flex-height' => true,
		'flex-width' => true,
	) );
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/**
	 * Set the content width to something large
	 * We set a more accurate width in generate_smart_content_width()
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1200; /* pixels */
	}
		
	// This theme styles the visual editor to resemble the theme style
	add_editor_style( 'assets/css/admin/editor-style.css' );
	
	// Remove image caption padding
	add_filter( 'img_caption_shortcode_width', '__return_zero' );
}
endif; // generate_setup

if ( ! function_exists( 'generate_get_setting' ) ) :
/**
 * A wrapper function to get our settings
 * @since 1.3.40
 */
function generate_get_setting( $setting ) {
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	return $generate_settings[ $setting ];
}
endif;

if ( ! function_exists( 'generate_widgets_init' ) ) :
/**
 * Register widgetized area and update sidebar with default widgets
 */
add_action( 'widgets_init', 'generate_widgets_init' );
function generate_widgets_init() 
{
	// Set up our array of widgets	
	$widgets = array(
		'sidebar-1' => __( 'Right Sidebar', 'generatepress' ),
		'sidebar-2' => __( 'Left Sidebar', 'generatepress' ),
		'header' => __( 'Header', 'generatepress' ),
		'footer-1' => __( 'Footer Widget 1', 'generatepress' ),
		'footer-2' => __( 'Footer Widget 2', 'generatepress' ),
		'footer-3' => __( 'Footer Widget 3', 'generatepress' ),
		'footer-4' => __( 'Footer Widget 4', 'generatepress' ),
		'footer-5' => __( 'Footer Widget 5', 'generatepress' ),
		'footer-bar' => __( 'Footer Bar','generatepress' ),
		'top-bar' => __( 'Top Bar','generatepress' ),
	);
	
	// Loop through them to create our widget areas
	foreach ( $widgets as $id => $name ) {
		register_sidebar( array(
			'name'          => $name,
			'id'            => $id,
			'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => apply_filters( 'generate_start_widget_title', '<h4 class="widget-title">' ),
			'after_title'   => apply_filters( 'generate_end_widget_title', '</h4>' ),
		) );
	}
}
endif;

// Setting defaults
require get_template_directory() . '/inc/defaults.php';

// CSS builder
require get_template_directory() . '/inc/class-css.php';

// Dynamic CSS output
require get_template_directory() . '/inc/css-output.php';

// Template elements
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Navigation functions
require get_template_directory() . '/inc/navigation.php';

// Customizer controls and settings
require get_template_directory() . '/inc/customizer.php';

// Element classes
require get_template_directory() . '/inc/element-classes.php';

// Meta boxes
require get_template_directory() . '/inc/metaboxes.php';

// Typography functions
require get_template_directory() . '/inc/typography.php';

// Admin page
require get_template_directory() . '/inc/options.php';

// Plugin compatibility
require get_template_directory() . '/inc/plugin-compat.php';

// Migrate old settings
require get_template_directory() . '/inc/migrate.php';

// Deprecated functions
require get_template_directory() . '/inc/deprecated.php';

if ( ! function_exists( 'generate_get_min_suffix' ) ) :
/** 
 * Figure out if we should use minified scripts or not
 * @since 1.3.29
 */
function generate_get_min_suffix() 
{
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}
endif;

if ( ! function_exists( 'generate_scripts' ) ) :
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'generate_scripts' );
function generate_scripts() 
{
	// Get our options.
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Get the minified suffix.
	$suffix = generate_get_min_suffix();
	
	// Enqueue our CSS.
	wp_enqueue_style( 'generate-style-grid', trailingslashit( get_template_directory_uri() ) . "assets/css/unsemantic-grid{$suffix}.css", false, GENERATE_VERSION, 'all' );
	wp_enqueue_style( 'generate-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'generate-style-grid' ), GENERATE_VERSION, 'all' );
	wp_enqueue_style( 'generate-mobile-style', trailingslashit( get_template_directory_uri() ) . "assets/css/mobile{$suffix}.css", array( 'generate-style' ), GENERATE_VERSION, 'all' );
	
	// Add the child theme CSS if child theme is active.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'generate-child', get_stylesheet_uri(), array( 'generate-style' ), filemtime( get_stylesheet_directory() . '/style.css' ), 'all' );
	}
	
	// Font Awesome
	$icon_essentials = apply_filters( 'generate_fontawesome_essentials', false );
	$icon_essentials = ( $icon_essentials ) ? '-essentials' : false;
	wp_enqueue_style( "fontawesome{$icon_essentials}", trailingslashit( get_template_directory_uri() ) . "assets/css/font-awesome{$icon_essentials}{$suffix}.css", false, '4.7', 'all' );
	
	// IE 8
	wp_enqueue_style( 'generate-ie', trailingslashit( get_template_directory_uri() ) . "assets/css/ie{$suffix}.css", array( 'generate-style-grid' ), GENERATE_VERSION, 'all' );
	wp_style_add_data( 'generate-ie', 'conditional', 'lt IE 9' );
	
	// Add jQuery
	wp_enqueue_script( 'jquery' );
	
	// Add our mobile navigation
	wp_enqueue_script( 'generate-navigation', trailingslashit( get_template_directory_uri() ) . "assets/js/navigation{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	
	// Add our hover or click dropdown menu scripts
	$click = ( 'click' == $generate_settings[ 'nav_dropdown_type' ] || 'click-arrow' == $generate_settings[ 'nav_dropdown_type' ] ) ? '-click' : '';
	wp_enqueue_script( 'generate-dropdown', trailingslashit( get_template_directory_uri() ) . "assets/js/dropdown{$click}{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	
	// Add our navigation search if it's enabled
	if ( 'enable' == $generate_settings['nav_search'] ) {
		wp_enqueue_script( 'generate-navigation-search', trailingslashit( get_template_directory_uri() ) . "assets/js/navigation-search{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	}
	
	// Add the back to top script if it's enabled
	if ( 'enable' == $generate_settings['back_to_top'] ) {
		wp_enqueue_script( 'generate-back-to-top', trailingslashit( get_template_directory_uri() ) . "assets/js/back-to-top{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	}
	
	// Move the navigation from below the content on mobile to below the header if it's in a sidebar
	if ( 'nav-left-sidebar' == generate_get_navigation_location() || 'nav-right-sidebar' == generate_get_navigation_location() ) {
		wp_enqueue_script( 'generate-move-navigation', trailingslashit( get_template_directory_uri() ) . "assets/js/move-navigation{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
	}
	
	// IE 8
	if ( function_exists( 'wp_script_add_data' ) ) {
		wp_enqueue_script( 'generate-html5', trailingslashit( get_template_directory_uri() ) . "assets/js/html5shiv{$suffix}.js", array( 'jquery' ), GENERATE_VERSION, true );
		wp_script_add_data( 'generate-html5', 'conditional', 'lt IE 9' );
	}
	
	// Add the threaded comments script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;

if ( ! function_exists( 'generate_get_layout' ) ) :
/**
 * Get the layout for the current page
 */
function generate_get_layout()
{
	// Get current post
	global $post;
	
	// Get Customizer options
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Set up the layout variable for pages
	$layout = $generate_settings['layout_setting'];
	
	// Get the individual page/post sidebar metabox value
	$layout_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-sidebar-layout-meta', true ) : '';
	
	// Set up BuddyPress variable
	$buddypress = false;
	if ( function_exists( 'is_buddypress' ) ) {
		$buddypress = ( is_buddypress() ) ? true : false;
	}

	// If we're on the single post page
	// And if we're not on a BuddyPress page - fixes a bug where BP thinks is_single() is true
	if ( is_single() && ! $buddypress ) {
		$layout = null;
		$layout = $generate_settings['single_layout_setting'];
	}

	// If the metabox is set, use it instead of the global settings
	if ( '' !== $layout_meta && false !== $layout_meta ) {
		$layout = $layout_meta;
	}
	
	// If we're on the blog, archive, attachment etc..
	if ( is_home() || is_archive() || is_search() || is_tax() ) {
		$layout = null;
		$layout = $generate_settings['blog_layout_setting'];
	}
	
	// Finally, return the layout
	return apply_filters( 'generate_sidebar_layout', $layout );
}
endif;

if ( ! function_exists( 'generate_get_footer_widgets' ) ) :
/**
 * Get the footer widgets for the current page
 */
function generate_get_footer_widgets()
{
	// Get current post
	global $post;
	
	// Get Customizer options
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Set up the footer widget variable
	$widgets = $generate_settings['footer_widget_setting'];
	
	// Get the individual footer widget metabox value
	$widgets_meta = ( isset( $post ) ) ? get_post_meta( $post->ID, '_generate-footer-widget-meta', true ) : '';
	
	// If we're not on a single page or post, the metabox hasn't been set
	if ( ! is_singular() ) {
		$widgets_meta = '';
	}
	
	// If we have a metabox option set, use it
	if ( '' !== $widgets_meta && false !== $widgets_meta ) {
		$widgets = $widgets_meta;
	}
	
	// Finally, return the layout
	return apply_filters( 'generate_footer_widgets', $widgets );
}
endif;

if ( ! function_exists( 'generate_construct_sidebars' ) ) :
/**
 * Construct the sidebars
 * @since 0.1
 */
add_action('generate_sidebars','generate_construct_sidebars');
function generate_construct_sidebars()
{
	// Get the layout
	$layout = generate_get_layout();
	
	// When to show the right sidebar
	$rs = array('right-sidebar','both-sidebars','both-right','both-left');

	// When to show the left sidebar
	$ls = array('left-sidebar','both-sidebars','both-right','both-left');
	
	// If left sidebar, show it
	if ( in_array( $layout, $ls ) ) {
		get_sidebar('left'); 
	}
	
	// If right sidebar, show it
	if ( in_array( $layout, $rs ) ) {
		get_sidebar(); 
	}
}
endif;

if ( ! function_exists( 'generate_smart_content_width' ) ) :
/**
 * Set the $content_width depending on layout of current page
 * Hook into "wp" so we have the correct layout setting from generate_get_layout()
 * Hooking into "after_setup_theme" doesn't get the correct layout setting
 */
add_action( 'wp', 'generate_smart_content_width' );
function generate_smart_content_width()
{

	global $content_width, $post;
	
	// Get Customizer options
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Get sidebar widths
	$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '25' );
	$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '25' );
	
	// Get the layout
	$layout = generate_get_layout();
	
	// Find the real content width
	if ( 'left-sidebar' == $layout ) {
		// If left sidebar is present
		$content_width = $generate_settings['container_width'] * ( ( 100 - $left_sidebar_width ) / 100 );
	} elseif ( 'right-sidebar' == $layout ) {
		// If right sidebar is present
		$content_width = $generate_settings['container_width'] * ( ( 100 - $right_sidebar_width ) / 100 );
	} elseif ( 'no-sidebar' == $layout ) {
		// If no sidebars are present
		$content_width = $generate_settings['container_width'];
	} else {
		// If both sidebars are present
		$content_width = $generate_settings['container_width'] * ( ( 100 - ( $left_sidebar_width + $right_sidebar_width ) ) / 100 );	
	}
}
endif;

if ( ! function_exists( 'generate_body_schema' ) ) :
/** 
 * Figure out which schema tags to apply to the <body> element
 * @since 1.3.15
 */
function generate_body_schema()
{
	// Set up blog variable
	$blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;
	
	// Set up default itemtype
	$itemtype = 'WebPage';

	// Get itemtype for the blog
	$itemtype = ( $blog ) ? 'Blog' : $itemtype;
	
	// Get itemtype for search results
	$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
	
	// Get the result
	$result = apply_filters( 'generate_body_itemtype', $itemtype );
	
	// Return our HTML
	echo "itemtype='http://schema.org/$result' itemscope='itemscope'";
}
endif;

if ( ! function_exists( 'generate_article_schema' ) ) :
/** 
 * Figure out which schema tags to apply to the <article> element
 * The function determines the itemtype: generate_article_schema( 'BlogPosting' )
 * @since 1.3.15
 */
function generate_article_schema( $type = 'CreativeWork' )
{
	// Get the itemtype
	$itemtype = apply_filters( 'generate_article_itemtype', $type );
	
	// Print the results
	echo "itemtype='http://schema.org/$itemtype' itemscope='itemscope'";
}
endif;

if ( ! function_exists( 'generate_show_excerpt' ) ) :
/** 
 * Figure out if we should show the blog excerpts or full posts
 * @since 1.3.15
 */
function generate_show_excerpt()
{
	// Get current post
	global $post;
	
	// Get Customizer settings
	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);
	
	// Check to see if the more tag is being used
	$more_tag = apply_filters( 'generate_more_tag', strpos( $post->post_content, '<!--more-->' ) );

	// Check the post format
	$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';
	
	// Get the excerpt setting from the Customizer
	$show_excerpt = ( 'excerpt' == $generate_settings['post_content'] ) ? true : false;
	
	// If our post format isn't standard, show the full content
	$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;
	
	// If the more tag is found, show the full content
	$show_excerpt = ( $more_tag ) ? false : $show_excerpt;
	
	// If we're on a search results page, show the excerpt
	$show_excerpt = ( is_search() ) ? true : $show_excerpt;
	
	// Return our value
	return apply_filters( 'generate_show_excerpt', $show_excerpt );
}
endif;

if ( ! function_exists( 'generate_show_title' ) ) :
/** 
 * Check to see if we should show our page/post title or not
 * @since 1.3.18
 */
function generate_show_title()
{
	return apply_filters( 'generate_show_title', true );
}
endif;

if ( ! function_exists( 'generate_padding_css' ) ) :
/**
 * Shorten our padding/margin values into shorthand form
 *
 * Used inside our dynamic spacing CSS
 */
function generate_padding_css( $top, $right, $bottom, $left ) {
	$padding_top = ( isset( $top ) && '' !== $top ) ? absint( $top ) . 'px ' : '0px ';
	$padding_right = ( isset( $right ) && '' !== $right ) ? absint( $right ) . 'px ' : '0px ';
	$padding_bottom = ( isset( $bottom ) && '' !== $bottom ) ? absint( $bottom ) . 'px ' : '0px ';
	$padding_left = ( isset( $left ) && '' !== $left ) ? absint( $left ) . 'px' : '0px';
	
	// If all of our values are the same, we can return one value only
	if ( ( absint( $padding_top ) === absint( $padding_right ) ) && ( absint( $padding_right ) === absint( $padding_bottom ) ) && ( absint( $padding_bottom ) === absint( $padding_left ) ) ) {
		return $padding_left;
	}
	
	return $padding_top . $padding_right . $padding_bottom . $padding_left;
}
endif;

if ( ! function_exists( 'generate_get_premium_url' ) ) :
/**
 * Generate a URL to our premium add-ons
 * Allows the use of a referral ID and campaign
 * @since 1.3.42
 */
function generate_get_premium_url( $url = 'https://generatepress.com/premium' ) 
{
	// Get our URL
	$url = trailingslashit( $url );
	
	// Set up args
	$args = apply_filters( 'generate_premium_url_args', array(
		'ref' => null,
		'campaign' => null
	) );
	
	// Set up our URL if we have an ID
	if ( isset( $args[ 'ref' ] ) ) {
		$url = add_query_arg( 'ref', absint( $args[ 'ref' ] ), $url );
	}
	
	// Set up our URL if we have a campaign
	if ( isset( $args[ 'campaign' ] ) ) {
		$url = add_query_arg( 'campaign', sanitize_text_field( $args[ 'campaign' ] ), $url );
	}
	
	// Return our URL with the optional referral ID
	return esc_url( $url );
}
endif;