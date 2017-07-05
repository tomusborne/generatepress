<?php
defined( 'WPINC' ) or die;

// Set some definitions
define( 'GENERATE_VERSION', '2.0-alpha' );
define( 'GENERATE_URI', get_template_directory_uri() );
define( 'GENERATE_DIR', get_template_directory() );

add_action( 'after_setup_theme', 'generate_setup_theme' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function generate_setup_theme() {
	// Make theme available for translation
	load_theme_textdomain( 'generatepress' );

	// Add theme support for various features
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status' ) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'custom-logo', array( 'height' => 70, 'width' => 350, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Register primary menu
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'generatepress' ),
	) );
	
	// Set the content width to something large
	// We set a more accurate width in generate_smart_content_width()
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}
		
	// This theme styles the visual editor to resemble the theme style
	add_editor_style( 'css/admin/editor-style.css' );
}

/**
 * Get all necessary theme files
 */
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/defaults.php';
require get_template_directory() . '/inc/class-css.php';
require get_template_directory() . '/inc/css-output.php';
require get_template_directory() . '/inc/general.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/markup.php';
require get_template_directory() . '/inc/element-classes.php';
require get_template_directory() . '/inc/meta-box.php';
require get_template_directory() . '/inc/typography.php';
require get_template_directory() . '/inc/dashboard.php';
require get_template_directory() . '/inc/plugin-compat.php';
require get_template_directory() . '/inc/migrate.php';
require get_template_directory() . '/inc/deprecated.php';

/**
 * Load our theme structure
 *
 * The functions in these files are all pluggable, but you
 * should use filters where possible.
 */
require get_template_directory() . '/inc/structure/archives.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/featured-images.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/navigation.php';
require get_template_directory() . '/inc/structure/post-meta.php';
require get_template_directory() . '/inc/structure/sidebars.php';