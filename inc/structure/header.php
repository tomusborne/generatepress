<?php
/**
 * All of our header elements.
 * These functions are wrapped in function_exists() so you can overwrite them.
 * 
 * @package GeneratePress
 */ 
 
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_construct_header' ) ) :
/**
 * Build the header
 *
 * @since 1.3.42
 */
add_action( 'generate_header','generate_construct_header' );
function generate_construct_header() {
	?>
	<header <?php generate_do_attr( 'header' ); ?>>
		<div <?php generate_do_attr( 'inside-header' ); ?>>
			<?php do_action( 'generate_before_header_content' ); ?>
			<?php generate_header_items(); ?>
			<?php do_action( 'generate_after_header_content' ); ?>
		</div><!-- .inside-header -->
	</header><!-- #masthead -->
	<?php
}
endif;

if ( ! function_exists( 'generate_header_items' ) ) :
/**
 * Build the header contents
 *
 * Wrapping this into a function allows us to customize the order
 *
 * @since 1.2.9.7
 */
function generate_header_items() {
	// Header widget
	generate_construct_header_widget();
	
	// Site title and tagline
	generate_construct_site_title();
	
	// Site logo
	generate_construct_logo();
}
endif;

if ( ! function_exists( 'generate_construct_logo' ) ) :
/**
 * Build the logo
 *
 * @since 1.3.28
 */
function generate_construct_logo() {
	// Get our logo URL if we're using the custom logo
	$logo_url = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;
	
	// Get our logo from the custom logo or our GP setting
	$logo = ( $logo_url ) ? $logo_url[0] : generate_get_option( 'logo' );
	
	// If we don't have a logo, bail
	if ( empty( $logo ) ) {
		return;
	}
	
	do_action( 'generate_before_logo' );
	
	// Print our HTML
	echo apply_filters( 'generate_logo_output', sprintf( 
		'<div class="site-logo">
			<a href="%1$s" title="%2$s" rel="home">
				<img class="header-image" src="%3$s" alt="%2$s" title="%2$s" />
			</a>
		</div>',
		esc_url( apply_filters( 'generate_logo_href' , home_url( '/' ) ) ),
		esc_attr( apply_filters( 'generate_logo_title', get_bloginfo( 'name', 'display' ) ) ),
		esc_url( apply_filters( 'generate_logo', $logo ) )
	), $logo );
	
	do_action( 'generate_after_logo' );
}
endif;

if ( ! function_exists( 'generate_construct_site_title' ) ) :
/**
 * Build the site title and tagline
 *
 * @since 1.3.28
 */
function generate_construct_site_title() {
	// Get the title and tagline
	$title = get_bloginfo( 'title' );
	$tagline = get_bloginfo( 'description' );
	
	// If the disable title checkbox is checked, or the title field is empty, return true
	$disable_title = ( '1' == generate_get_option( 'hide_title' ) || '' == $title ) ? true : false; 
	
	// If the disable tagline checkbox is checked, or the tagline field is empty, return true
	$disable_tagline = ( '1' == generate_get_option( 'hide_tagline' ) || '' == $tagline ) ? true : false;
	
	// Build our site title
	$site_title = apply_filters( 'generate_site_title_output', sprintf(
		'<%1$s class="main-title" itemprop="headline">
			<a href="%2$s" rel="home">
				%3$s
			</a>
		</%1$s>',
		( is_front_page() && is_home() ) ? 'h1' : 'p',
		esc_url( apply_filters( 'generate_site_title_href', home_url( '/' ) ) ),
		get_bloginfo( 'name' )
	));
	
	// Build our tagline
	$site_tagline = apply_filters( 'generate_site_description_output', sprintf(
		'<p class="site-description">
			%1$s
		</p>',
		html_entity_decode( get_bloginfo( 'description', 'display' ) )
	));
	
	// Site title and tagline
	if ( false == $disable_title || false == $disable_tagline ) {
		echo apply_filters( 'generate_site_branding_output', sprintf(
			'<div class="site-branding">
				%1$s
				%2$s
			</div>',
			( ! $disable_title ) ? $site_title : '',
			( ! $disable_tagline ) ? $site_tagline : ''
		) );
	}
}
endif;

if ( ! function_exists( 'generate_construct_header_widget' ) ) :
/**
 * Build the header widget
 *
 * @since 1.3.28
 */
function generate_construct_header_widget() {
	if ( is_active_sidebar('header') ) : ?>
		<div class="header-widget">
			<?php dynamic_sidebar( 'header' ); ?>
		</div>
	<?php endif;
}
endif;

if ( ! function_exists( 'generate_top_bar' ) ) :
/**
 * Build our top bar
 *
 * @since 1.3.45
 */
add_action( 'generate_before_header','generate_top_bar', 5 );
function generate_top_bar() {
	if ( ! is_active_sidebar( 'top-bar' ) ) {
		return;
	}
	
	?>
	<div <?php generate_do_attr( 'top-bar' ); ?>>
		<div class="inside-top-bar<?php if ( 'contained' == generate_get_option( 'top_bar_inner_width' ) ) echo ' grid-container grid-parent'; ?>">
			<?php dynamic_sidebar( 'top-bar' ); ?>
		</div>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'generate_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 * @since 1.3.42
 */
add_action( 'wp_head', 'generate_pingback_header' );
function generate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
endif;

if ( ! function_exists( 'generate_add_viewport' ) ) :
/** 
 * Add viewport to wp_head
 * @since 1.1.0
 */
add_action('wp_head','generate_add_viewport');
function generate_add_viewport() {
	echo apply_filters( 'generate_meta_viewport', '<meta name="viewport" content="width=device-width, initial-scale=1">' );
}
endif;