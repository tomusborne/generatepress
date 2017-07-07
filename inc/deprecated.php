<?php
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_paging_nav' ) ) :
/**
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
 * @deprecated 2.0
 */
function generate_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}
endif;

if ( ! function_exists( 'generate_get_layout' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_layout() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_get_sidebar_layout()" );
	return generate_get_sidebar_layout();
}
endif;

if ( ! function_exists( 'generate_get_footer_widgets' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_footer_widgets() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_get_footer_widget_count()" );
	return generate_get_footer_widget_count();
}
endif;

if ( ! function_exists( 'generate_get_setting' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_setting( $setting ) {
	_deprecated_function( __FUNCTION__, '2.0', "generate_get_option()" );
	return generate_get_option( $setting );
}
endif;

if ( ! function_exists( 'generate_padding_css' ) ) :
/**
 * @deprecated 2.0
 */
function generate_padding_css( $top, $right, $bottom, $left ) {
	_deprecated_function( __FUNCTION__, '2.0', "generate_shorthand_spacing_css()" );
	return generate_get_shorthand_spacing( $top, $right, $bottom, $left );
}
endif;

if ( ! function_exists( 'generate_right_sidebar_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_right_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'right-sidebar' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_right_sidebar_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_right_sidebar_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_right_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'right-sidebar' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_right_sidebar_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_left_sidebar_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_left_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'left-sidebar' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_left_sidebar_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_left_sidebar_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_left_sidebar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'left-sidebar' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_left_sidebar_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_content_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_content_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'primary' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_content_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_content_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_content_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'primary' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_content_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_header_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'header' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_header_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_header_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'header' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_header_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_inside_header_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_inside_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'inside-header' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_inside_header_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_inside_header_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_inside_header_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'inside-header' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_inside_header_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_container_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_container_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'page' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_container_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_container_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_container_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'page' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_container_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_navigation_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_navigation_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'navigation' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_navigation_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_navigation_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_navigation_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'navigation' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_navigation_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_inside_navigation_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_inside_navigation_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'inside-navigation' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	$return = apply_filters('generate_inside_navigation_class', $classes, $class);
	
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', $return ) . '"';
}
endif;

if ( ! function_exists( 'generate_menu_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_menu_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'menu' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_menu_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_menu_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_menu_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'menu' )" );

	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_menu_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_main_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_main_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'main' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_main_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_main_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_main_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'main' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_main_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_footer_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_footer_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'footer' )" );
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', generate_get_footer_class( $class ) ) . '"';
}
endif;

if ( ! function_exists( 'generate_get_footer_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_footer_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_get_attr( 'footer' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);

	return apply_filters('generate_footer_class', $classes, $class);
}
endif;

if ( ! function_exists( 'generate_inside_footer_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_inside_footer_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'inside-footer' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);
	
	$return = apply_filters( 'generate_inside_footer_class', $classes, $class );
	
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', $return ) . '"';
}
endif;

if ( ! function_exists( 'generate_top_bar_class' ) ) :
/**
 * @deprecated 2.0
 */
function generate_top_bar_class( $class = '' ) {
	//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'top-bar' )" );
	$classes = array();

	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}

	$classes = array_map('esc_attr', $classes);
	
	$return = apply_filters( 'generate_top_bar_class', $classes, $class );
	
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', $return ) . '"';
}
endif;

if ( ! function_exists( 'generate_body_schema' ) ) :
/**
 * @deprecated 2.0
 */
function generate_body_schema() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'body' )" );
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
 * @deprecated 2.0
 */
function generate_article_schema( $type = 'CreativeWork' ) {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'post ' )" );
	// Get the itemtype
	$itemtype = apply_filters( 'generate_article_itemtype', $type );
	
	// Print the results
	echo "itemtype='http://schema.org/$itemtype' itemscope='itemscope'";
}
endif;

if ( ! function_exists( 'generate_show_title' ) ) :
/** 
 * @deprecated 2.0
 */
function generate_show_title() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_show_content_title()" );
	return apply_filters( 'generate_show_title', true );
}
endif;

if ( ! function_exists( 'generate_show_excerpt' ) ) :
/** 
 * @deprecated 2.0
 */
function generate_show_excerpt() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_show_post_excerpt()" );
	return generate_show_post_excerpt();
}
endif;

if ( ! function_exists( 'generate_get_link_url' ) ) :
/**
 * @deprecated 2.0
 */
function generate_get_link_url() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_get_url_in_content()" );
	return generate_get_url_in_content();
}
endif;

if ( ! function_exists( 'generate_categorized_blog' ) ) :
/**
 * @deprecated 2.0
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
 * @deprecated 2.0
 */
function generate_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'generate_categories' );
}
endif;

if ( ! function_exists( 'generate_remove_caption_padding' ) ) :
/**
 * @deprecated 2.0
 */
function generate_remove_caption_padding( $width ) {
	return $width - 10;
}
endif;

/**
 * Hooked & filtered functions that have had a name change or become unnecessary.
 *
 * These functions were either poorly named or no longer needed.
 *
 * These likely don't need to be deprecated, but to be careful we'll keep them
 * in here for a couple months to give people who have used remove_action() etc..
 * time to update their code.
 */
 
if ( ! function_exists( 'generate_setup' ) ) :
/**
 * @deprecated 2.0
 */
function generate_setup() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_setup_theme()" );
}
endif;

if ( ! function_exists( 'generate_scripts' ) ) :
/**
 * @deprecated 2.0
 */
function generate_scripts() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_enqueue_scripts()" );
}
endif;

if ( ! function_exists( 'generate_create_menu' ) ) :
function generate_create_menu() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_dashboard_menu()" );
}
endif;

if ( ! function_exists( 'generate_options_styles' ) ) :
function generate_options_styles() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_enqueue_dashboard_scripts()" );
}
endif;

if ( ! function_exists( 'generate_settings_page' ) ) :
function generate_settings_page() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_dashboard_page()" );
}
endif;

if ( ! function_exists( 'generate_reset_customizer_settings' ) ) :
function generate_reset_customizer_settings() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_customizer_reset()" );
}
endif;

if ( ! function_exists( 'generate_admin_errors' ) ) :
function generate_admin_errors() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_admin_errors()" );
}
endif;

if ( ! function_exists( 'generate_body_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_body_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_body_attributes()" );
}
endif;

if ( ! function_exists( 'generate_top_bar_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_top_bar_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_top_bar_attributes()" );
}
endif;

if ( ! function_exists( 'generate_right_sidebar_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_right_sidebar_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_right_sidebar_attributes()" );
}
endif;

if ( ! function_exists( 'generate_left_sidebar_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_left_sidebar_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_left_sidebar_attributes()" );
}
endif;

if ( ! function_exists( 'generate_content_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_content_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_primary_attributes()" );
}
endif;

if ( ! function_exists( 'generate_header_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_header_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_header_attributes()" );
}
endif;

if ( ! function_exists( 'generate_inside_header_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_inside_header_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_inside_header_attributes()" );
}
endif;

if ( ! function_exists( 'generate_navigation_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_navigation_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_navigation_attributes()" );
}
endif;

if ( ! function_exists( 'generate_inside_navigation_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_inside_navigation_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_inside_navigation_attributes()" );
}
endif;

if ( ! function_exists( 'generate_menu_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_menu_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_menu_attributes()" );
}
endif;

if ( ! function_exists( 'generate_footer_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_footer_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_footer_attributes()" );
}
endif;

if ( ! function_exists( 'generate_inside_footer_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_inside_footer_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_inside_footer_attributes()" );
}
endif;

if ( ! function_exists( 'generate_main_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_main_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_main_attributes()" );
}
endif;

if ( ! function_exists( 'generate_post_classes' ) ) :
/**
 * @deprecated 2.0
 */
function generate_post_classes() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_post_attributes()" );
}
endif;

if ( ! function_exists( 'generate_widgets_init' ) ) :
function generate_widgets_init() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_register_widgets()" );
}
endif;

if ( ! function_exists( 'generate_add_layout_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_add_layout_meta_box() { 
	_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
}  
endif;

if ( ! function_exists( 'generate_show_layout_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_show_layout_meta_box() {  
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_save_layout_meta' ) ) :
/**
 * @deprecated 2.0
 */
function generate_save_layout_meta() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
}  
endif;

if ( ! function_exists( 'generate_add_footer_widget_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_add_footer_widget_meta_box() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
}  
endif;

if ( ! function_exists( 'generate_show_footer_widget_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_show_footer_widget_meta_box() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_save_footer_widget_meta' ) ) :
/**
 * @deprecated 2.0
 */
function generate_save_footer_widget_meta() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
}  
endif;

if ( ! function_exists( 'generate_add_page_builder_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_add_page_builder_meta_box() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_show_page_builder_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_show_page_builder_meta_box() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
}
endif;

if ( ! function_exists( 'generate_save_page_builder_meta' ) ) :
/**
 * @deprecated 2.0
 */
function generate_save_page_builder_meta() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
}
endif;

if ( !function_exists('generate_add_de_meta_box') ) :
/**
 * @deprecated 2.0
 */
function generate_add_de_meta_box() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
}  
endif;

if ( !function_exists( 'generate_show_de_meta_box' ) ) :
/**
 * @deprecated 2.0
 */
function generate_show_de_meta_box() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
}
endif;

if ( !function_exists( 'generate_save_de_meta' ) ) :
/**
 * @deprecated 2.0
 */
function generate_save_de_meta() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
}  
endif;

if ( ! function_exists( 'generate_additional_spacing' ) ) :
/**
 * @deprecated 2.0
 */
function generate_additional_spacing() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) :
/**
 * @deprecated 2.0
 */
function generate_mobile_search_spacing_fallback_css() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_smart_content_width' ) ) :
/**
 * @deprecated 2.0
 */
function generate_smart_content_width() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_content_width()" );
}
endif;

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) :
/**
 * @deprecated 2.0
 */
function generate_enhanced_image_navigation() {
	// No longer needed
}
endif;

if ( ! function_exists( 'generate_page_menu_args' ) ) :
/**
 * @deprecated 2.0
 */
function generate_page_menu_args() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_home_link_fallback()" );
}
endif;

if ( ! function_exists( 'generate_disable_title' ) ) :
/**
 * @deprecated 2.0
 */
function generate_disable_title() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_remove_content_title()" );
}
endif;

if ( ! function_exists( 'generate_resource_hints' ) ) :
/**
 * @deprecated 2.0
 */
function generate_resource_hints() {
	_deprecated_function( __FUNCTION__, '2.0', "generate_set_google_font_resource_hints()" );
}
endif;