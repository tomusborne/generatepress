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