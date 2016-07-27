<?php
if ( function_exists( 'generate_menu_plus_get_defaults' ) ) :
/**
 * Enqueue inline CSS
 */
function generate_menu_plus_fallback_inline_css()
{
	
	$generate_menu_plus_settings = wp_parse_args( 
		get_option( 'generate_menu_plus_settings', array() ), 
		generate_menu_plus_get_defaults() 
	);
	
	$return = '';
	
	if ( '' !== $generate_menu_plus_settings['sticky_menu_logo'] ) :
		if ( 'sticky-menu' == $generate_menu_plus_settings['sticky_menu_logo_position'] ) :
			$return .= '.navigation-clone .mobile-bar-items {position: relative;float: right;}';
		else :
			$return .= '@media (max-width: 768px) {.main-navigation .mobile-bar-items {position: relative;float: right;}}';
		endif;
	endif;
	
	return $return;
}

add_action( 'wp_enqueue_scripts','generate_menu_plus_fallback_enqueue', 50 );
function generate_menu_plus_fallback_enqueue()
{
	
	// Add inline CSS
	wp_add_inline_style( 'generate-style', generate_menu_plus_fallback_inline_css() );
	
}
endif;