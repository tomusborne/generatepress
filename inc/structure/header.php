<?php
defined( 'WPINC' ) or die;

if ( ! function_exists( 'generate_construct_header' ) ) {
	add_action( 'generate_header', 'generate_construct_header' );
	/**
	 * Build the header.
	 *
	 * @since 1.3.42
	 */
	function generate_construct_header() {
		?>
		<header itemtype="http://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php generate_header_class(); ?>>
			<div <?php generate_inside_header_class(); ?>>
				<?php do_action( 'generate_before_header_content' ); ?>
				<?php generate_header_items(); ?>
				<?php do_action( 'generate_after_header_content' ); ?>
			</div><!-- .inside-header -->
		</header><!-- #masthead -->
		<?php
	}
}

if ( ! function_exists( 'generate_header_items' ) ) {
	/**
	 * Build the header contents.
	 * Wrapping this into a function allows us to customize the order.
	 *
	 * @since 1.2.9.7
	 */
	function generate_header_items() {
		generate_construct_header_widget();
		generate_construct_site_title();
		generate_construct_logo();
	}
}

if ( ! function_exists( 'generate_construct_logo' ) ) {
	/**
	 * Build the logo
	 *
	 * @since 1.3.28
	 */
	function generate_construct_logo() {
		$logo = function_exists( 'get_custom_logo' ) ? get_custom_logo() : false;

		// If we don't have a logo, bail
		if ( empty( $logo ) ) {
			return;
		}

		do_action( 'generate_before_logo' );
		the_custom_logo();
		do_action( 'generate_after_logo' );
	}
}

add_filter( 'get_custom_logo', 'generate_adjust_custom_logo_output' );
/**
 * Adjust the output of our custom logo.
 * Allows us to add a custom class and some filters to the output.
 *
 * @since 1.5
 *
 * @param string $html
 * @return string
 */
function generate_adjust_custom_logo_output( $html ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		$custom_logo_attr = array(
            'class'    => 'custom-logo header-image',
            'itemprop' => 'logo',
        );

        /*
         * If the logo alt attribute is empty, get the site title and explicitly
         * pass it to the attributes used by wp_get_attachment_image().
         */
        $image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
        if ( empty( $image_alt ) ) {
            $custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
        }

		// Get our logo URL
		$logo_url = get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;
		$logo_url = $logo_url ? $logo_url[0] : generate_get_setting( 'logo' );

		$html = apply_filters( 'generate_logo_output', sprintf(
			'<div class="site-logo">
				<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url" title="%2$s">%3$s</a>
			</div>',
            esc_url( apply_filters( 'generate_logo_href' , home_url( '/' ) ) ),
			esc_attr( apply_filters( 'generate_logo_title', get_bloginfo( 'name', 'display' ) ) ),
            wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr )
        ), $logo_url );
	}

	return $html;
}

add_filter( 'wp_get_attachment_image_attributes', 'generate_do_custom_logo_attributes', 10, 2 );
/**
 * Add custom srcset to our logo to allow a retina logo.
 * Also filters the logo URL.
 *
 * @since 1.5
 *
 * @param array $attr
 * @param object $attachment
 * @return string
 */
function generate_do_custom_logo_attributes( $attr, $attachment ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id == $attachment->ID ) {

		// Get our logo URL
		$logo_url = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( $custom_logo_id, 'full' ) : false;
		$logo_url = ( $logo_url ) ? $logo_url[0] : generate_get_setting( 'logo' );
		$logo_url = esc_url( apply_filters( 'generate_logo', $logo_url ) );

		$attr['src'] = $logo_url;
		$attr['srcset'] = '';

		$retina_logo = esc_url( apply_filters( 'generate_retina_logo', generate_get_setting( 'retina_logo' ) ) );

		if ( '' !== $retina_logo ) {
			$attr['srcset'] = $logo_url . ' 1x, ' . $retina_logo . ' 2x';
		}

	}

	return $attr;
}

if ( ! function_exists( 'generate_construct_site_title' ) ) {
	/**
	 * Build the site title and tagline.
	 *
	 * @since 1.3.28
	 */
	function generate_construct_site_title() {
		$generate_settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		// Get the title and tagline
		$title = get_bloginfo( 'title' );
		$tagline = get_bloginfo( 'description' );

		// If the disable title checkbox is checked, or the title field is empty, return true
		$disable_title = ( '1' == $generate_settings[ 'hide_title' ] || '' == $title ) ? true : false;

		// If the disable tagline checkbox is checked, or the tagline field is empty, return true
		$disable_tagline = ( '1' == $generate_settings[ 'hide_tagline' ] || '' == $tagline ) ? true : false;

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
}

if ( ! function_exists( 'generate_construct_header_widget' ) ) {
	/**
	 * Build the header widget.
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
}

if ( ! function_exists( 'generate_top_bar' ) ) {
	add_action( 'generate_before_header', 'generate_top_bar', 5 );
	/**
	 * Build our top bar.
	 *
	 * @since 1.3.45
	 */
	function generate_top_bar() {

		if ( ! is_active_sidebar( 'top-bar' ) ) {
			return;
		}

		?>
		<div <?php generate_top_bar_class(); ?>>
			<div class="inside-top-bar<?php if ( 'contained' == generate_get_setting( 'top_bar_inner_width' ) ) echo ' grid-container grid-parent'; ?>">
				<?php dynamic_sidebar( 'top-bar' ); ?>
			</div>
		</div>
		<?php

	}
}

if ( ! function_exists( 'generate_pingback_header' ) ) {
	add_action( 'wp_head', 'generate_pingback_header' );
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 * @since 1.3.42
	 */
	function generate_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}

if ( ! function_exists( 'generate_add_viewport' ) ) {
	add_action( 'wp_head', 'generate_add_viewport' );
	/**
	 * Add viewport to wp_head.
	 *
	 * @since 1.1.0
	 */
	function generate_add_viewport() {
		echo apply_filters( 'generate_meta_viewport', '<meta name="viewport" content="width=device-width, initial-scale=1">' );
	}
}