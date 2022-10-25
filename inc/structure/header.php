<?php
/**
 * Header elements.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_construct_header' ) ) {
	add_action( 'generate_header', 'generate_construct_header' );
	/**
	 * Build the header.
	 *
	 * @since 1.3.42
	 */
	function generate_construct_header() {
		?>
		<header <?php generate_do_attr( 'header' ); ?>>
			<div <?php generate_do_attr( 'inside-header' ); ?>>
				<?php
				/**
				 * generate_before_header_content hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_before_header_content' );

				if ( ! generate_is_using_flexbox() ) {
					// Add our main header items.
					generate_header_items();
				}

				/**
				 * generate_after_header_content hook.
				 *
				 * @since 0.1
				 *
				 * @hooked generate_add_navigation_float_right - 5
				 */
				do_action( 'generate_after_header_content' );
				?>
			</div>
		</header>
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
		$order = apply_filters(
			'generate_header_items_order',
			array(
				'header-widget',
				'site-branding',
				'logo',
			)
		);

		foreach ( $order as $item ) {
			if ( 'header-widget' === $item ) {
				generate_construct_header_widget();
			}

			if ( 'site-branding' === $item ) {
				generate_construct_site_title();
			}

			if ( 'logo' === $item ) {
				generate_construct_logo();
			}
		}
	}
}

if ( ! function_exists( 'generate_construct_logo' ) ) {
	/**
	 * Build the logo
	 *
	 * @since 1.3.28
	 */
	function generate_construct_logo() {
		$logo_url = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;
		$logo_url = ( $logo_url ) ? $logo_url[0] : generate_get_option( 'logo' );

		$logo_url = esc_url( apply_filters( 'generate_logo', $logo_url ) );
		$retina_logo_url = esc_url( apply_filters( 'generate_retina_logo', generate_get_option( 'retina_logo' ) ) );

		// If we don't have a logo, bail.
		if ( empty( $logo_url ) ) {
			return;
		}

		/**
		 * generate_before_logo hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_before_logo' );

		$attr = apply_filters(
			'generate_logo_attributes',
			array(
				'class' => 'header-image is-logo-image',
				'alt'   => esc_attr( apply_filters( 'generate_logo_title', get_bloginfo( 'name', 'display' ) ) ),
				'src'   => $logo_url,
			)
		);

		if ( '' !== $retina_logo_url ) {
			$attr['srcset'] = $logo_url . ' 1x, ' . $retina_logo_url . ' 2x';

			// Add dimensions to image if retina is set. This fixes a container width bug in Firefox.
			if ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) {
				$data = wp_get_attachment_metadata( get_theme_mod( 'custom_logo' ) );

				if ( ! empty( $data ) ) {
					$attr['width'] = $data['width'];
					$attr['height'] = $data['height'];
				}
			}
		} elseif ( generate_is_using_flexbox() ) {
			// Add this to flexbox version only until we can verify it won't conflict with existing installs.
			if ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) {
				$data = wp_get_attachment_metadata( get_theme_mod( 'custom_logo' ) );

				if ( ! empty( $data ) ) {
					if ( isset( $data['width'] ) ) {
						$attr['width'] = $data['width'];
					}

					if ( isset( $data['height'] ) ) {
						$attr['height'] = $data['height'];
					}
				}
			}
		}

		$attr = array_map( 'esc_attr', $attr );

		$html_attr = '';
		foreach ( $attr as $name => $value ) {
			$html_attr .= " $name=" . '"' . $value . '"';
		}

		// Print our HTML.
		echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'generate_logo_output',
			sprintf(
				'<div class="site-logo">
					<a href="%1$s" rel="home">
						<img %2$s />
					</a>
				</div>',
				esc_url( apply_filters( 'generate_logo_href', home_url( '/' ) ) ),
				$html_attr
			),
			$logo_url,
			$html_attr
		);

		/**
		 * generate_after_logo hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_logo' );
	}
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

		// Get the title and tagline.
		$title = get_bloginfo( 'title' );
		$tagline = get_bloginfo( 'description' );

		// If the disable title checkbox is checked, or the title field is empty, return true.
		$disable_title = ( '1' == $generate_settings['hide_title'] || '' == $title ) ? true : false; // phpcs:ignore

		// If the disable tagline checkbox is checked, or the tagline field is empty, return true.
		$disable_tagline = ( '1' == $generate_settings['hide_tagline'] || '' == $tagline ) ? true : false;  // phpcs:ignore

		$schema_type = generate_get_schema_type();

		// Build our site title.
		$site_title = apply_filters(
			'generate_site_title_output',
			sprintf(
				'<%1$s class="main-title"%4$s>
					<a href="%2$s" rel="home">
						%3$s
					</a>
				</%1$s>',
				( is_front_page() && is_home() ) ? 'h1' : 'p',
				esc_url( apply_filters( 'generate_site_title_href', home_url( '/' ) ) ),
				get_bloginfo( 'name' ),
				'microdata' === generate_get_schema_type() ? ' itemprop="headline"' : ''
			)
		);

		// Build our tagline.
		$site_tagline = apply_filters(
			'generate_site_description_output',
			sprintf(
				'<p class="site-description"%2$s>
					%1$s
				</p>',
				html_entity_decode( get_bloginfo( 'description', 'display' ) ), // phpcs:ignore
				'microdata' === generate_get_schema_type() ? ' itemprop="description"' : ''
			)
		);

		// Site title and tagline.
		if ( false === $disable_title || false === $disable_tagline ) {
			if ( generate_needs_site_branding_container() ) {
				echo '<div class="site-branding-container">';
				generate_construct_logo();
			}

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- outputting site title and tagline. False positive.
			echo apply_filters(
				'generate_site_branding_output',
				sprintf(
					'<div class="site-branding">
						%1$s
						%2$s
					</div>',
					( ! $disable_title ) ? $site_title : '',
					( ! $disable_tagline ) ? $site_tagline : ''
				)
			);

			if ( generate_needs_site_branding_container() ) {
				echo '</div>';
			}
		}
	}
}

add_filter( 'generate_header_items_order', 'generate_reorder_inline_site_branding' );
/**
 * Remove the logo from it's usual position.
 *
 * @since 2.3
 * @param array $order Order of the header items.
 */
function generate_reorder_inline_site_branding( $order ) {
	if ( ! generate_get_option( 'inline_logo_site_branding' ) || ! generate_has_logo_site_branding() ) {
		return $order;
	}

	return array(
		'header-widget',
		'site-branding',
	);
}

if ( ! function_exists( 'generate_construct_header_widget' ) ) {
	/**
	 * Build the header widget.
	 *
	 * @since 1.3.28
	 */
	function generate_construct_header_widget() {
		if ( is_active_sidebar( 'header' ) ) :
			?>
			<div class="header-widget">
				<?php dynamic_sidebar( 'header' ); ?>
			</div>
			<?php
		endif;
	}
}

add_action( 'generate_before_header_content', 'generate_do_site_logo', 5 );
/**
 * Add the site logo to our header.
 * Only added if we aren't using floats to preserve backwards compatibility.
 *
 * @since 3.0.0
 */
function generate_do_site_logo() {
	if ( ! generate_is_using_flexbox() || generate_needs_site_branding_container() ) {
		return;
	}

	generate_construct_logo();
}

add_action( 'generate_before_header_content', 'generate_do_site_branding' );
/**
 * Add the site branding to our header.
 * Only added if we aren't using floats to preserve backwards compatibility.
 *
 * @since 3.0.0
 */
function generate_do_site_branding() {
	if ( ! generate_is_using_flexbox() ) {
		return;
	}

	generate_construct_site_title();
}

add_action( 'generate_after_header_content', 'generate_do_header_widget' );
/**
 * Add the header widget to our header.
 * Only used when grid isn't using floats to preserve backwards compatibility.
 *
 * @since 3.0.0
 */
function generate_do_header_widget() {
	if ( ! generate_is_using_flexbox() ) {
		return;
	}

	generate_construct_header_widget();
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
		<div <?php generate_do_attr( 'top-bar' ); ?>>
			<div <?php generate_do_attr( 'inside-top-bar' ); ?>>
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
	add_action( 'wp_head', 'generate_add_viewport', 1 );
	/**
	 * Add viewport to wp_head.
	 *
	 * @since 1.1.0
	 */
	function generate_add_viewport() {
		echo apply_filters( 'generate_meta_viewport', '<meta name="viewport" content="width=device-width, initial-scale=1">' );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

add_action( 'generate_before_header', 'generate_do_skip_to_content_link', 2 );
/**
 * Add skip to content link before the header.
 *
 * @since 2.0
 */
function generate_do_skip_to_content_link() {
	printf(
		'<a class="screen-reader-text skip-link" href="#content" title="%1$s">%2$s</a>',
		esc_attr__( 'Skip to content', 'generatepress' ),
		esc_html__( 'Skip to content', 'generatepress' )
	);
}
