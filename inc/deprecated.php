<?php
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_paging_nav' ) ) {
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
}

if ( ! function_exists( 'generate_addons_available' ) ) {
	/** 
	 * @deprecated 1.3.47
	 */
	function generate_addons_available() {
		if ( defined( 'GP_PREMIUM_VERSION' ) ) {
			return false;
		}
	}
}

if ( ! function_exists( 'generate_no_addons' ) ) {
	/** 
	 * @deprecated 1.3.47
	 */
	function generate_no_addons() {
		if ( defined( 'GP_PREMIUM_VERSION' ) ) {
			return false;
		}
	}
}

/** 
 * The following functions have been deprecated as of 2.0.
 * Each function is wrapped with function_exists() as these calls
 * existed before, and have been kept to prevent any fatal errors.
 *
 * @deprecated 2.0
 */

if ( ! function_exists( 'generate_get_min_suffix' ) ) {
	function generate_get_min_suffix() {
		return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}
}

if ( ! function_exists( 'generate_get_layout' ) ) {
	function generate_get_layout() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_get_sidebar_layout()" );
		return generate_get_sidebar_layout();
	}
}

if ( ! function_exists( 'generate_get_footer_widgets' ) ) {
	function generate_get_footer_widgets() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_get_footer_widget_count()" );
		return generate_get_footer_widget_count();
	}
}

if ( ! function_exists( 'generate_get_setting' ) ) {
	function generate_get_setting( $setting ) {
		_deprecated_function( __FUNCTION__, '2.0', "generate_get_option()" );
		return generate_get_option( $setting );
	}
}

if ( ! function_exists( 'generate_padding_css' ) ) {
	function generate_padding_css( $top, $right, $bottom, $left ) {
		_deprecated_function( __FUNCTION__, '2.0', "generate_shorthand_spacing_css()" );
		return generate_get_shorthand_spacing( $top, $right, $bottom, $left );
	}
}

if ( ! function_exists( 'generate_right_sidebar_class' ) ) {
	function generate_right_sidebar_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'right-sidebar' )" );
		echo 'class="' . join( ' ', generate_get_right_sidebar_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_right_sidebar_class' ) ) {
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
}

if ( ! function_exists( 'generate_left_sidebar_class' ) ) {
	function generate_left_sidebar_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'left-sidebar' )" );
		echo 'class="' . join( ' ', generate_get_left_sidebar_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_left_sidebar_class' ) ) {
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
}

if ( ! function_exists( 'generate_content_class' ) ) {
	function generate_content_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'primary' )" );
		echo 'class="' . join( ' ', generate_get_content_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_content_class' ) ) {
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
}

if ( ! function_exists( 'generate_header_class' ) ) {
	function generate_header_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'header' )" );
		echo 'class="' . join( ' ', generate_get_header_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_header_class' ) ) {
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
}

if ( ! function_exists( 'generate_inside_header_class' ) ) {
	function generate_inside_header_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'inside-header' )" );
		echo 'class="' . join( ' ', generate_get_inside_header_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_inside_header_class' ) ) {
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
}

if ( ! function_exists( 'generate_container_class' ) ) {
	function generate_container_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'page' )" );
		echo 'class="' . join( ' ', generate_get_container_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_container_class' ) ) {
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
}

if ( ! function_exists( 'generate_navigation_class' ) ) {
	function generate_navigation_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'navigation' )" );
		echo 'class="' . join( ' ', generate_get_navigation_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_navigation_class' ) ) {
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
}

if ( ! function_exists( 'generate_inside_navigation_class' ) ) {
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
		echo 'class="' . join( ' ', $return ) . '"';
	}
}

if ( ! function_exists( 'generate_menu_class' ) ) {
	function generate_menu_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'menu' )" );
		echo 'class="' . join( ' ', generate_get_menu_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_menu_class' ) ) {
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
}

if ( ! function_exists( 'generate_main_class' ) ) {
	function generate_main_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'main' )" );
		echo 'class="' . join( ' ', generate_get_main_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_main_class' ) ) {
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
}

if ( ! function_exists( 'generate_footer_class' ) ) {
	function generate_footer_class( $class = '' ) {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'footer' )" );
		echo 'class="' . join( ' ', generate_get_footer_class( $class ) ) . '"';
	}
}

if ( ! function_exists( 'generate_get_footer_class' ) ) {
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
}

if ( ! function_exists( 'generate_inside_footer_class' ) ) {
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
		echo 'class="' . join( ' ', $return ) . '"';
	}
}

if ( ! function_exists( 'generate_top_bar_class' ) ) {
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
		echo 'class="' . join( ' ', $return ) . '"';
	}
}

if ( ! function_exists( 'generate_body_schema' ) ) {
	function generate_body_schema() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'body' )" );
		$blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;
		$itemtype = 'WebPage';
		$itemtype = ( $blog ) ? 'Blog' : $itemtype;
		$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
		$result = apply_filters( 'generate_body_itemtype', $itemtype );
		echo "itemtype='http://schema.org/$result' itemscope='itemscope'";
	}
}

if ( ! function_exists( 'generate_article_schema' ) ) {
	function generate_article_schema( $type = 'CreativeWork' ) {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_attr( 'post ' )" );
		$itemtype = apply_filters( 'generate_article_itemtype', $type );
		echo "itemtype='http://schema.org/$itemtype' itemscope='itemscope'";
	}
}

if ( ! function_exists( 'generate_show_title' ) ) {
	function generate_show_title() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_show_content_title()" );
		return apply_filters( 'generate_show_title', true );
	}
}

if ( ! function_exists( 'generate_show_excerpt' ) ) {
	function generate_show_excerpt() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_show_post_excerpt()" );
		return generate_show_post_excerpt();
	}
}

if ( ! function_exists( 'generate_get_link_url' ) ) {
	function generate_get_link_url() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_get_url_in_content()" );
		return generate_get_url_in_content();
	}
}

if ( ! function_exists( 'generate_categorized_blog' ) ) {
	function generate_categorized_blog() {
		// No longer needed
		return false;
	}
}

if ( ! function_exists( 'generate_category_transient_flusher' ) ) {
	function generate_category_transient_flusher() {
		// No longer needed
	}
}

if ( ! function_exists( 'generate_remove_caption_padding' ) ) {
	function generate_remove_caption_padding( $width ) {
		return $width - 10;
	}
}

if ( ! function_exists( 'generate_get_navigation_location' ) ) {
	function generate_get_navigation_location() {
		//_deprecated_function( __FUNCTION__, '2.0', "generate_get_primary_menu_location()" );
		return generate_get_primary_menu_location();
	}
}

if ( ! function_exists( 'generate_get_premium_url' ) ) {
	function generate_get_premium_url( $url = 'https://generatepress.com/premium' ) {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_upsell_url()" );
		return generate_do_upsell_url( $url, false );
	}
}

/**
 * Hooked & filtered functions that have had a name change or become unnecessary.
 *
 * These functions were either poorly named or no longer needed.
 *
 * These likely don't need to be deprecated, but to be careful we'll keep them
 * in here for a couple months to give people who have used remove_action() etc..
 * time to update their code.
 *
 * @deprecated 2.0
 */
 
if ( ! function_exists( 'generate_setup' ) ) {
	function generate_setup() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_setup_theme()" );
	}
}

if ( ! function_exists( 'generate_scripts' ) ) {
	function generate_scripts() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_enqueue_scripts()" );
	}
}

if ( ! function_exists( 'generate_create_menu' ) ) {
	function generate_create_menu() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_dashboard_menu()" );
	}
}

if ( ! function_exists( 'generate_options_styles' ) ) {
	function generate_options_styles() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_enqueue_dashboard_scripts()" );
	}
}

if ( ! function_exists( 'generate_settings_page' ) ) {
	function generate_settings_page() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_dashboard_page()" );
	}
}

if ( ! function_exists( 'generate_reset_customizer_settings' ) ) {
	function generate_reset_customizer_settings() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_customizer_reset()" );
	}
}

if ( ! function_exists( 'generate_admin_errors' ) ) {
	function generate_admin_errors() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_admin_errors()" );
	}
}

if ( ! function_exists( 'generate_body_classes' ) ) {
	function generate_body_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_body_attributes()" );
	}
}

if ( ! function_exists( 'generate_top_bar_classes' ) ) {
	function generate_top_bar_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_top_bar_attributes()" );
	}
}

if ( ! function_exists( 'generate_right_sidebar_classes' ) ) {
	function generate_right_sidebar_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_right_sidebar_attributes()" );
	}
}

if ( ! function_exists( 'generate_left_sidebar_classes' ) ) {
	function generate_left_sidebar_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_left_sidebar_attributes()" );
	}
}

if ( ! function_exists( 'generate_content_classes' ) ) {
	function generate_content_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_primary_attributes()" );
	}
}

if ( ! function_exists( 'generate_header_classes' ) ) {
	function generate_header_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_header_attributes()" );
	}
}

if ( ! function_exists( 'generate_inside_header_classes' ) ) {
	function generate_inside_header_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_inside_header_attributes()" );
	}
}

if ( ! function_exists( 'generate_navigation_classes' ) ) {
	function generate_navigation_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_navigation_attributes()" );
	}
}

if ( ! function_exists( 'generate_inside_navigation_classes' ) ) {
	function generate_inside_navigation_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_inside_navigation_attributes()" );
	}
}

if ( ! function_exists( 'generate_menu_classes' ) ) {
	function generate_menu_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_menu_attributes()" );
	}
}

if ( ! function_exists( 'generate_footer_classes' ) ) {
	function generate_footer_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_footer_attributes()" );
	}
}

if ( ! function_exists( 'generate_inside_footer_classes' ) ) {
	function generate_inside_footer_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_inside_footer_attributes()" );
	}
}

if ( ! function_exists( 'generate_main_classes' ) ) {
	function generate_main_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_main_attributes()" );
	}
}

if ( ! function_exists( 'generate_post_classes' ) ) {
	function generate_post_classes() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_post_attributes()" );
	}
}

if ( ! function_exists( 'generate_widgets_init' ) ) {
	function generate_widgets_init() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_register_widget_areas()" );
	}
}

if ( ! function_exists( 'generate_add_layout_meta_box' ) ) {
	function generate_add_layout_meta_box() { 
		_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_show_layout_meta_box' ) ) {
	function generate_show_layout_meta_box() {  
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_save_layout_meta' ) ) {
	function generate_save_layout_meta() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
	}
}

if ( ! function_exists( 'generate_add_footer_widget_meta_box' ) ) {
	function generate_add_footer_widget_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_show_footer_widget_meta_box' ) ) {
	function generate_show_footer_widget_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_save_footer_widget_meta' ) ) {
	function generate_save_footer_widget_meta() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
	}
}

if ( ! function_exists( 'generate_add_page_builder_meta_box' ) ) {
	function generate_add_page_builder_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_show_page_builder_meta_box' ) ) {
	function generate_show_page_builder_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_save_page_builder_meta' ) ) {
	function generate_save_page_builder_meta() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
	}
}

if ( ! function_exists( 'generate_add_de_meta_box' ) ) {
	function generate_add_de_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_register_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_show_de_meta_box' ) ) {
	function generate_show_de_meta_box() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_do_layout_meta_box()" );
	}
}

if ( ! function_exists( 'generate_save_de_meta' ) ) {
	function generate_save_de_meta() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_save_layout_meta_data()" );
	}
}

if ( ! function_exists( 'generate_additional_spacing' ) ) {
	function generate_additional_spacing() {
		// No longer needed
	}
}

if ( ! function_exists( 'generate_mobile_search_spacing_fallback_css' ) ) {
	function generate_mobile_search_spacing_fallback_css() {
		// No longer needed
	}
}

if ( ! function_exists( 'generate_smart_content_width' ) ) {
	function generate_smart_content_width() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_content_width()" );
	}
}

if ( ! function_exists( 'generate_enhanced_image_navigation' ) ) {
	function generate_enhanced_image_navigation() {
		// No longer needed
	}
}

if ( ! function_exists( 'generate_page_menu_args' ) ) {
	function generate_page_menu_args() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_home_link_fallback()" );
	}
}

if ( ! function_exists( 'generate_disable_title' ) ) {
	function generate_disable_title() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_remove_content_title()" );
	}
}

if ( ! function_exists( 'generate_resource_hints' ) ) {
	function generate_resource_hints() {
		_deprecated_function( __FUNCTION__, '2.0', "generate_set_google_font_resource_hints()" );
	}
}