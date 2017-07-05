<?php
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'generate_paging_nav' ) ) :
/**
 * Build the pagination links
 * @since 1.3.35
 * @deprecated 1.3.45
 */
function generate_paging_nav() {
	_deprecated_function( __FUNCTION__, '1.3.45', "the_posts_navigation()" );
	if ( function_exists( 'the_posts_pagination' ) ) {
		the_posts_pagination( array(
			'mid_size' => apply_filters( 'generate_pagination_mid_size', 1 ),
			'prev_text' => __( '&larr; Previous', 'generatepress' ),
			'next_text' => __( 'Next &rarr;', 'generatepress' )
		) );
	}
}
endif;


if ( ! function_exists( 'generate_addons_available' ) ) :
/** 
 * Check to see if there's any addons not already activated
 * @since 1.0.9
 * @deprecated 1.3.47
 */
function generate_addons_available() {
	if ( defined( 'GP_PREMIUM_VERSION' ) ) {
		return false;
	}
}
endif;

if ( ! function_exists( 'generate_no_addons' ) ) :
/** 
 * Check to see if no addons are activated
 * @since 1.0.9
 * @deprecated 1.3.47
 */
function generate_no_addons() {
	if ( defined( 'GP_PREMIUM_VERSION' ) ) {
		return false;
	}
}
endif;

if ( ! function_exists( 'generate_get_min_suffix' ) ) :
/** 
 * Figure out if we should use minified scripts or not
 * @since 1.3.29
 */
function generate_get_min_suffix()  {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}
endif;

if ( ! function_exists( 'generate_categorized_blog' ) ) :
/**
 * Determine whether blog/site has more than one category.
 *
 * @since 1.2.5
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function generate_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'generate_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'generate_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so twentyfifteen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so twentyfifteen_categorized_blog should return false.
		return false;
	}
}
endif;

if ( ! function_exists( 'generate_category_transient_flusher' ) ) :
/**
 * Flush out the transients used in {@see generate_categorized_blog()}.
 *
 * @since 1.2.5
 */
function generate_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'generate_categories' );
}
endif;

/**
 * Hooked & filtered functions that have had a name change or become unnecessary.
 *
 * These likely don't need to be deprecated, but to be careful we'll keep them
 * in here for a couple months to give people who have used remove_action() etc..
 * time to update their code.
 */
 
if ( ! function_exists( 'generate_add_layout_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_add_layout_meta_box() { 
	_deprecated_function( __FUNCTION__, '1.4', "generate_register_layout_meta_box()" );
}  
endif;

if ( ! function_exists( 'generate_show_layout_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_show_layout_meta_box() {  
	_deprecated_function( __FUNCTION__, '1.4', "generate_do_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_save_layout_meta' ) ) :
/**
 * @deprecated 1.4
 */
function generate_save_layout_meta() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_save_layout_meta_data()" );
}  
endif;

if ( ! function_exists( 'generate_add_footer_widget_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_add_footer_widget_meta_box() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_register_layout_meta_box()" );
}  
endif;

if ( ! function_exists( 'generate_show_footer_widget_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_show_footer_widget_meta_box() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_do_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_save_footer_widget_meta' ) ) :
/**
 * @deprecated 1.4
 */
function generate_save_footer_widget_meta() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_save_layout_meta_data()" );
}  
endif;

if ( ! function_exists( 'generate_add_page_builder_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_add_page_builder_meta_box() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_register_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_show_page_builder_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_show_page_builder_meta_box() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_do_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_save_page_builder_meta' ) ) :
/**
 * @deprecated 1.4
 */
function generate_save_page_builder_meta($post_id) {
	_deprecated_function( __FUNCTION__, '1.4', "generate_save_layout_meta_data()" );
}
endif;

if ( !function_exists('generate_add_de_meta_box') ) :
/**
 * @deprecated 1.4
 */
function generate_add_de_meta_box() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_register_layout_meta_box()" );
}  
endif;

if ( !function_exists( 'generate_show_de_meta_box' ) ) :
/**
 * @deprecated 1.4
 */
function generate_show_de_meta_box() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_do_layout_meta_box()" );
}
endif;

if ( !function_exists( 'generate_save_de_meta' ) ) :
/**
 * @deprecated 1.4
 */
function generate_save_de_meta() {
	_deprecated_function( __FUNCTION__, '1.4', "generate_save_layout_meta_data()" );
}  
endif;

if ( ! function_exists( 'generate_additional_spacing' ) ) :
/**
 * Add fallback CSS for our mobile search icon color
 * @deprecated 1.3.47
 */
function generate_additional_spacing() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) :
/**
 * Enqueue our mobile search icon color fallback CSS
 * @deprecated 1.3.47
 */
function generate_mobile_search_spacing_fallback_css() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) :
/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function generate_enhanced_image_navigation() {
	// No longer needed
}
endif;