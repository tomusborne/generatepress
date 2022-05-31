<?php
/**
 * Add compatibility for some popular third party plugins.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'after_setup_theme', 'generate_setup_woocommerce' );
/**
 * Set up WooCommerce
 *
 * @since 1.3.47
 */
function generate_setup_woocommerce() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// Add support for WC features.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Remove default WooCommerce wrappers.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	add_action( 'woocommerce_sidebar', 'generate_construct_sidebars' );
}

/**
 * Get the tag name for our WooCommerce wrappers.
 *
 * @since 3.2.0
 */
function generate_get_woocommerce_wrapper_tagname() {
	echo is_singular()
		? 'article'
		: 'div';
}

if ( ! function_exists( 'generate_woocommerce_start' ) ) {
	add_action( 'woocommerce_before_main_content', 'generate_woocommerce_start', 10 );
	/**
	 * Add WooCommerce starting wrappers
	 *
	 * @since 1.3.22
	 */
	function generate_woocommerce_start() {
		?>
		<div <?php generate_do_attr( 'content' ); ?>>
			<main <?php generate_do_attr( 'main' ); ?>>
				<?php
				/**
				 * generate_before_main_content hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_before_main_content' );
				?>
				<<?php generate_get_woocommerce_wrapper_tagname(); ?> <?php generate_do_attr( 'woocommerce-content' ); ?>>
					<div class="inside-article">
						<?php
						/**
						 * generate_before_content hook.
						 *
						 * @since 0.1
						 *
						 * @hooked generate_featured_page_header_inside_single - 10
						 */
						do_action( 'generate_before_content' );

						$itemprop = '';

						if ( 'microdata' === generate_get_schema_type() ) {
							$itemprop = ' itemprop="text"';
						}
						?>
						<div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
		<?php
	}
}

if ( ! function_exists( 'generate_woocommerce_end' ) ) {
	add_action( 'woocommerce_after_main_content', 'generate_woocommerce_end', 10 );
	/**
	 * Add WooCommerce ending wrappers
	 *
	 * @since 1.3.22
	 */
	function generate_woocommerce_end() {
		?>
						</div>
						<?php
						/**
						 * generate_after_content hook.
						 *
						 * @since 0.1
						 */
						do_action( 'generate_after_content' );
						?>
					</div>
				</<?php generate_get_woocommerce_wrapper_tagname(); ?>>
				<?php
				/**
				 * generate_after_main_content hook.
				 *
				 * @since 0.1
				 */
				do_action( 'generate_after_main_content' );
				?>
			</main>
		</div>
		<?php
	}
}

if ( ! function_exists( 'generate_woocommerce_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'generate_woocommerce_css', 100 );
	/**
	 * Add WooCommerce CSS
	 *
	 * @since 1.3.45
	 */
	function generate_woocommerce_css() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$mobile = generate_get_media_query( 'mobile' );

		$css = '.woocommerce .page-header-image-single {
			display: none;
		}

		.woocommerce .entry-content,
		.woocommerce .product .entry-summary {
			margin-top: 0;
		}

		.related.products {
			clear: both;
		}

		.checkout-subscribe-prompt.clear {
			visibility: visible;
			height: initial;
			width: initial;
		}

		@media ' . esc_attr( $mobile ) . ' {
			.woocommerce .woocommerce-ordering,
			.woocommerce-page .woocommerce-ordering {
				float: none;
			}

			.woocommerce .woocommerce-ordering select {
				max-width: 100%;
			}

			.woocommerce ul.products li.product,
			.woocommerce-page ul.products li.product,
			.woocommerce-page[class*=columns-] ul.products li.product,
			.woocommerce[class*=columns-] ul.products li.product {
				width: 100%;
				float: none;
			}
		}';

		$css = str_replace( array( "\r", "\n", "\t" ), '', $css );
		wp_add_inline_style( 'woocommerce-general', $css );
	}
}

if ( ! function_exists( 'generate_bbpress_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'generate_bbpress_css', 100 );
	/**
	 * Add bbPress CSS
	 *
	 * @since 1.3.45
	 */
	function generate_bbpress_css() {
		if ( ! class_exists( 'bbPress' ) ) {
			return;
		}

		$css = '#bbpress-forums ul.bbp-lead-topic,
		#bbpress-forums ul.bbp-topics,
		#bbpress-forums ul.bbp-forums,
		#bbpress-forums ul.bbp-replies,
		#bbpress-forums ul.bbp-search-results,
		#bbpress-forums,
		div.bbp-breadcrumb,
		div.bbp-topic-tags {
			font-size: inherit;
		}

		.single-forum #subscription-toggle {
			display: block;
			margin: 1em 0;
			clear: left;
		}

		#bbpress-forums .bbp-search-form {
			margin-bottom: 10px;
		}

		.bbp-login-form fieldset {
			border: 0;
			padding: 0;
		}';

		$css = str_replace( array( "\r", "\n", "\t" ), '', $css );
		wp_add_inline_style( 'bbp-default', $css );
	}
}

if ( ! function_exists( 'generate_buddypress_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'generate_buddypress_css', 100 );
	/**
	 * Add BuddyPress CSS
	 *
	 * @since 1.3.45
	 */
	function generate_buddypress_css() {
		if ( ! class_exists( 'BuddyPress' ) ) {
			return;
		}

		$css = '#buddypress form#whats-new-form #whats-new-options[style] {
			min-height: 6rem;
			overflow: visible;
		}';

		$css = str_replace( array( "\r", "\n", "\t" ), '', $css );
		wp_add_inline_style( 'bp-legacy-css', $css );
	}
}

if ( ! function_exists( 'generate_beaver_builder_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'generate_beaver_builder_css', 100 );
	/**
	 * Add Beaver Builder CSS
	 *
	 * Beaver Builder pages set to no sidebar used to automatically be full width, however
	 * now that we have the Page Builder Container meta box, we want to give the user
	 * the option to set the page to full width or contained.
	 *
	 * We can't remove this CSS as people who are depending on it will lose their full
	 * width layout when they update.
	 *
	 * So instead, we only apply this CSS to posts older than the date of this update.
	 *
	 * @since 1.3.45
	 */
	function generate_beaver_builder_css() {
		if ( generate_is_using_flexbox() ) {
			return;
		}

		$body_classes = get_body_class();

		// Check is Beaver Builder is active
		// If we have the full-width-content class, we don't need to do anything else.
		if ( in_array( 'fl-builder', $body_classes ) && ! in_array( 'full-width-content', $body_classes ) && ! in_array( 'contained-content', $body_classes ) ) {
			global $post;

			if ( ! isset( $post ) ) {
				return;
			}

			$compare_date = strtotime( '2017-03-14' );
			$post_date    = strtotime( $post->post_date );
			if ( $post_date < $compare_date ) {
				$css = '.fl-builder.no-sidebar .container.grid-container {
					max-width: 100%;
				}

				.fl-builder.one-container.no-sidebar .site-content {
					padding:0;
				}';
				$css = str_replace( array( "\r", "\n", "\t" ), '', $css );
				wp_add_inline_style( 'generate-style', $css );
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'generate_do_third_party_plugin_css', 50 );
/**
 * Add CSS for third-party plugins.
 *
 * @since 3.0.1
 */
function generate_do_third_party_plugin_css() {
	$css = new GeneratePress_CSS();

	if ( generate_is_using_flexbox() && class_exists( 'Elementor\Plugin' ) ) {
		$css->set_selector( '.elementor-template-full-width .site-content' );
		$css->add_property( 'display', 'block' );
	}

	if ( $css->css_output() ) {
		wp_add_inline_style( 'generate-style', $css->css_output() );
	}
}

add_action( 'wp_enqueue_scripts', 'generate_do_pro_compatibility', 50 );
/**
 * Add CSS to ensure compatibility with GP Premium.
 *
 * @since 3.0.0
 */
function generate_do_pro_compatibility() {
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		return;
	}

	$css = new GeneratePress_CSS();

	if ( version_compare( GP_PREMIUM_VERSION, '1.11.0-alpha.1', '<' ) ) {
		if ( generate_is_using_flexbox() && defined( 'GENERATE_SECONDARY_NAV_VERSION' ) ) {
			$css->set_selector( '.secondary-navigation .inside-navigation:before, .secondary-navigation .inside-navigation:after' );
			$css->add_property( 'content', '"."' );
			$css->add_property( 'display', 'block' );
			$css->add_property( 'overflow', 'hidden' );
			$css->add_property( 'visibility', 'hidden' );
			$css->add_property( 'font-size', '0px' );
			$css->add_property( 'line-height', '0px' );
			$css->add_property( 'width', '0px' );
			$css->add_property( 'height', '0px' );

			$css->set_selector( '.secondary-navigation .inside-navigation:after' );
			$css->add_property( 'clear', 'both' );
		}
	}

	if ( version_compare( GP_PREMIUM_VERSION, '1.12.0-alpha.1', '<' ) ) {
		if ( defined( 'GENERATE_MENU_PLUS_VERSION' ) && function_exists( 'generate_menu_plus_get_defaults' ) ) {
			$menu_plus_settings = wp_parse_args(
				get_option( 'generate_menu_plus_settings', array() ),
				generate_menu_plus_get_defaults()
			);

			if ( generate_is_using_flexbox() && ( 'true' === $menu_plus_settings['sticky_menu'] || 'desktop' === $menu_plus_settings['sticky_menu'] || 'mobile' === $menu_plus_settings['sticky_menu'] || 'enable' === $menu_plus_settings['mobile_header_sticky'] ) ) {
				if ( generate_has_inline_mobile_toggle() ) {
					$css->start_media_query( generate_get_media_query( 'mobile-menu' ) );

					$css->set_selector( '#sticky-placeholder' );
					$css->add_property( 'height', '0' );
					$css->add_property( 'overflow', 'hidden' );

					$css->set_selector( '.has-inline-mobile-toggle #site-navigation.toggled' );
					$css->add_property( 'margin-top', '0' );

					$css->set_selector( '.has-inline-mobile-menu #site-navigation.toggled .main-nav > ul' );
					$css->add_property( 'top', '1.5em' );

					$css->stop_media_query();
				}

				if ( 'desktop' === $menu_plus_settings['sticky_menu'] ) {
					$css->set_selector( '.sticky-enabled .gen-sidebar-nav.is_stuck .main-navigation' );
					$css->add_property( 'margin-bottom', '0' );

					$css->set_selector( '.sticky-enabled .gen-sidebar-nav.is_stuck' );
					$css->add_property( 'z-index', '500' );

					$css->set_selector( '.sticky-enabled .main-navigation.is_stuck' );
					$css->add_property( 'box-shadow', '0 2px 2px -2px rgba(0, 0, 0, .2)' );

					$css->set_selector( '.navigation-stick:not(.gen-sidebar-nav)' );
					$css->add_property( 'left', '0' );
					$css->add_property( 'right', '0' );
					$css->add_property( 'width', '100% !important' );

					$css->set_selector( '.both-sticky-menu .main-navigation:not(#mobile-header).toggled .main-nav > ul,.mobile-sticky-menu .main-navigation:not(#mobile-header).toggled .main-nav > ul,.mobile-header-sticky #mobile-header.toggled .main-nav > ul' );
					$css->add_property( 'position', 'absolute' );
					$css->add_property( 'left', '0' );
					$css->add_property( 'right', '0' );
					$css->add_property( 'z-index', '999' );
				}

				$css->set_selector( '.nav-float-right .navigation-stick' );
				$css->add_property( 'width', '100% !important' );
				$css->add_property( 'left', '0' );

				$css->set_selector( '.nav-float-right .navigation-stick .navigation-branding' );
				$css->add_property( 'margin-right', 'auto' );

				if ( ! $menu_plus_settings['navigation_as_header'] ) {
					$header_left = 40;
					$header_right = 40;
					$mobile_header_left = 30;
					$mobile_header_right = 30;

					if ( function_exists( 'generate_spacing_get_defaults' ) ) {
						$spacing_settings = wp_parse_args(
							get_option( 'generate_spacing_settings', array() ),
							generate_spacing_get_defaults()
						);

						$header_left = $spacing_settings['header_left'];
						$header_right = $spacing_settings['header_right'];
						$mobile_header_left = $spacing_settings['mobile_header_left'];
						$mobile_header_right = $spacing_settings['mobile_header_right'];
					}

					if ( function_exists( 'generate_is_using_flexbox' ) && generate_is_using_flexbox() ) {
						if ( function_exists( 'generate_get_option' ) && 'text' === generate_get_option( 'container_alignment' ) ) {
							$css->set_selector( '.main-navigation.navigation-stick .inside-navigation.grid-container' );
							$css->add_property( 'padding-left', $header_left, false, 'px' );
							$css->add_property( 'padding-right', $header_right, false, 'px' );

							$css->start_media_query( generate_get_media_query( 'mobile-menu' ) );
							$css->set_selector( '.main-navigation.navigation-stick .inside-navigation.grid-container' );
							$css->add_property( 'padding-left', $mobile_header_left, false, 'px' );
							$css->add_property( 'padding-right', $mobile_header_right, false, 'px' );
							$css->stop_media_query();
						}
					}
				}

				$css->set_selector( '.nav-float-right .main-navigation.has-branding:not([class*="nav-align-"]):not(.mobile-header-navigation) .menu-bar-items,.nav-float-right .main-navigation.has-sticky-branding.navigation-stick:not([class*="nav-align-"]):not(.mobile-header-navigation) .menu-bar-items' );
				$css->add_property( 'margin-left', '0' );
			}

			if ( generate_has_inline_mobile_toggle() && 'false' !== $menu_plus_settings['slideout_menu'] ) {
				$css->set_selector( '.slideout-mobile .has-inline-mobile-toggle #site-navigation.toggled,.slideout-both .has-inline-mobile-toggle #site-navigation.toggled' );
				$css->add_property( 'margin-top', '0' );
			}

			if ( 'font' === generate_get_option( 'icons' ) ) {
				$css->set_selector( '.main-navigation .slideout-toggle a:before,.slide-opened .slideout-overlay .slideout-exit:before' );
				$css->add_property( 'font-family', 'GeneratePress' );

				$css->set_selector( '.slideout-navigation .dropdown-menu-toggle:before' );
				$css->add_property( 'content', '"\f107" !important' );

				$css->set_selector( '.slideout-navigation .sfHover > a .dropdown-menu-toggle:before' );
				$css->add_property( 'content', '"\f106" !important' );
			}

			if ( generate_is_using_flexbox() && $menu_plus_settings['navigation_as_header'] ) {
				$content_left = 40;
				$content_right = 40;

				if ( function_exists( 'generate_spacing_get_defaults' ) ) {
					$spacing_settings = wp_parse_args(
						get_option( 'generate_spacing_settings', array() ),
						generate_spacing_get_defaults()
					);

					$content_left = $spacing_settings['content_left'];
					$content_right = $spacing_settings['content_right'];
				}

				if ( 'text' === generate_get_option( 'container_alignment' ) ) {
					$css->set_selector( '.main-navigation.has-branding .inside-navigation.grid-container, .main-navigation.has-branding .inside-navigation.grid-container' );
					$css->add_property( 'padding', generate_padding_css( 0, $content_right, 0, $content_left ) );
				}

				$css->set_selector( '.navigation-branding' );
				$css->add_property( 'margin-left', '10px' );

				$css->set_selector( '.navigation-branding .main-title, .mobile-header-navigation .site-logo' );
				$css->add_property( 'margin-left', '10px' );

				if ( is_rtl() ) {
					$css->set_selector( '.navigation-branding' );
					$css->add_property( 'margin-left', 'auto' );
					$css->add_property( 'margin-right', '10px' );

					$css->set_selector( '.navigation-branding .main-title, .mobile-header-navigation .site-logo' );
					$css->add_property( 'margin-right', '10px' );
					$css->add_property( 'margin-left', '0' );
				}

				$css->set_selector( '.navigation-branding > div + .main-title' );
				$css->add_property( 'margin-left', '10px' );

				if ( is_rtl() ) {
					$css->set_selector( '.navigation-branding > div + .main-title' );
					$css->add_property( 'margin-right', '10px' );
				}

				$css->set_selector( '.has-branding .navigation-branding img' );
				$css->add_property( 'margin', '0' );

				$css->start_media_query( generate_get_media_query( 'mobile-menu' ) );
				if ( 'text' === generate_get_option( 'container_alignment' ) ) {
					$css->set_selector( '.main-navigation.has-branding .inside-navigation.grid-container' );
					$css->add_property( 'padding', '0' );
				}
				$css->stop_media_query();
			}
		}

		if ( defined( 'GENERATE_SPACING_VERSION' ) ) {
			if ( generate_is_using_flexbox() ) {
				$css->set_selector( '#footer-widgets, .site-info' );
				$css->add_property( 'padding', '0' );
			}
		}

		if ( defined( 'GENERATE_SECONDARY_NAV_VERSION' ) ) {
			if ( generate_is_using_flexbox() && has_nav_menu( 'secondary' ) ) {
				if ( 'text' === generate_get_option( 'container_alignment' ) && function_exists( 'generate_secondary_nav_get_defaults' ) ) {
					$secondary_nav_settings = wp_parse_args(
						get_option( 'generate_secondary_nav_settings', array() ),
						generate_secondary_nav_get_defaults()
					);

					$spacing_settings = wp_parse_args(
						get_option( 'generate_spacing_settings', array() ),
						generate_spacing_get_defaults()
					);

					$navigation_left_padding = absint( $spacing_settings['header_left'] ) - absint( $secondary_nav_settings['secondary_menu_item'] );
					$navigation_right_padding = absint( $spacing_settings['header_right'] ) - absint( $secondary_nav_settings['secondary_menu_item'] );

					$css->set_selector( '.secondary-nav-below-header .secondary-navigation .inside-navigation.grid-container, .secondary-nav-above-header .secondary-navigation .inside-navigation.grid-container' );
					$css->add_property( 'padding', generate_padding_css( 0, $navigation_right_padding, 0, $navigation_left_padding ) );
				}
			}
		}

		if ( generate_is_using_flexbox() && defined( 'GENERATE_FONT_VERSION' ) && function_exists( 'generate_get_default_fonts' ) ) {
			$font_settings = wp_parse_args(
				get_option( 'generate_settings', array() ),
				generate_get_default_fonts()
			);

			if ( isset( $font_settings['tablet_navigation_font_size'] ) && '' !== $font_settings['tablet_navigation_font_size'] ) {
				$css->start_media_query( generate_get_media_query( 'tablet' ) );
				$css->set_selector( '.main-navigation .menu-toggle' );
				$css->add_property( 'font-size', absint( $font_settings['tablet_navigation_font_size'] ), false, 'px' );
				$css->stop_media_query();
			}

			if ( isset( $font_settings['mobile_navigation_font_size'] ) && '' !== $font_settings['mobile_navigation_font_size'] ) {
				$css->start_media_query( generate_get_media_query( 'mobile-menu' ) );
				$css->set_selector( '.main-navigation .menu-toggle' );
				$css->add_property( 'font-size', absint( $font_settings['mobile_navigation_font_size'] ), false, 'px' );
				$css->stop_media_query();
			}
		}

		if ( ! generate_show_title() ) {
			$css->set_selector( '.page .entry-content' )->add_property( 'margin-top', '0px' );

			if ( is_single() ) {
				if ( ! apply_filters( 'generate_post_author', true ) && ! apply_filters( 'generate_post_date', true ) ) {
					$css->set_selector( '.single .entry-content' )->add_property( 'margin-top', '0' );
				}
			}
		}
	}

	if ( $css->css_output() ) {
		wp_add_inline_style( 'generate-style', $css->css_output() );
	}
}

add_filter( 'generate_menu_item_dropdown_arrow_direction', 'generate_set_pro_menu_item_arrow_directions', 10, 3 );
/**
 * Set the menu item arrow directions for Secondary and Slideout navs.
 *
 * @since 3.0.0
 * @param string $arrow_direction The current direction.
 * @param object $args The args for the current menu.
 * @param int    $depth The current depth of the menu item.
 */
function generate_set_pro_menu_item_arrow_directions( $arrow_direction, $args, $depth ) {
	if ( function_exists( 'generate_secondary_nav_get_defaults' ) && 'secondary' === $args->theme_location ) {
		$settings = wp_parse_args(
			get_option( 'generate_secondary_nav_settings', array() ),
			generate_secondary_nav_get_defaults()
		);

		if ( 0 !== $depth ) {
			$arrow_direction = 'right';

			if ( 'left' === $settings['secondary_nav_dropdown_direction'] ) {
				$arrow_direction = 'left';
			}
		}

		if ( 'secondary-nav-left-sidebar' === $settings['secondary_nav_position_setting'] ) {
			$arrow_direction = 'right';

			if ( 'both-right' === generate_get_layout() ) {
				$arrow_direction = 'left';
			}
		}

		if ( 'secondary-nav-right-sidebar' === $settings['secondary_nav_position_setting'] ) {
			$arrow_direction = 'left';

			if ( 'both-left' === generate_get_layout() ) {
				$arrow_direction = 'right';
			}
		}

		if ( 'hover' !== generate_get_option( 'nav_dropdown_type' ) ) {
			$arrow_direction = 'down';
		}
	}

	return $arrow_direction;
}

add_filter( 'generate_menu_plus_option_defaults', 'generate_set_menu_plus_compat_defaults' );
/**
 * Set defaults in our pro Menu Plus module.
 *
 * @since 3.0.0
 * @param array $defaults The existing defaults.
 */
function generate_set_menu_plus_compat_defaults( $defaults ) {
	if ( generate_has_inline_mobile_toggle() ) {
		$defaults['mobile_menu_label'] = '';
	}

	return $defaults;
}

add_filter( 'generate_spacing_option_defaults', 'generate_set_spacing_compat_defaults', 20 );
/**
 * Set defaults in our pro Spacing module.
 *
 * @since 3.0.0
 * @param array $defaults The existing defaults.
 */
function generate_set_spacing_compat_defaults( $defaults ) {
	$defaults['mobile_header_top'] = '';
	$defaults['mobile_header_bottom'] = '';
	$defaults['mobile_header_right'] = '30';
	$defaults['mobile_header_left'] = '30';

	$defaults['mobile_widget_top'] = '30';
	$defaults['mobile_widget_right'] = '30';
	$defaults['mobile_widget_bottom'] = '30';
	$defaults['mobile_widget_left'] = '30';

	$defaults['mobile_footer_widget_container_top'] = '30';
	$defaults['mobile_footer_widget_container_right'] = '30';
	$defaults['mobile_footer_widget_container_bottom'] = '30';
	$defaults['mobile_footer_widget_container_left'] = '30';

	return $defaults;
}

add_filter( 'generate_page_hero_css_output', 'generate_do_pro_page_hero_css', 10, 2 );
/**
 * Add CSS to our premium Page Heroes.
 *
 * @since 3.0.0
 * @param string $css_output Existing CSS.
 * @param array  $options The Header Element options.
 */
function generate_do_pro_page_hero_css( $css_output, $options ) {
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		return $css_output;
	}

	$new_css = '';

	if ( version_compare( GP_PREMIUM_VERSION, '1.12.0-alpha.1', '<' ) ) {
		$css = new GeneratePress_CSS();

		$padding_inside = false;

		if ( generate_is_using_flexbox() && 'text' === generate_get_option( 'container_alignment' ) ) {
			$padding_inside = true;
		}

		if ( $padding_inside ) {
			$container_width = generate_get_option( 'container_width' );
			$padding_right = '0px';
			$padding_left = '0px';

			if ( $options['padding_right'] ) {
				$padding_right = absint( $options['padding_right'] ) . $options['padding_right_unit'];
			}

			if ( $options['padding_left'] ) {
				$padding_left = absint( $options['padding_left'] ) . $options['padding_left_unit'];
			}

			$css->set_selector( '.page-hero .inside-page-hero.grid-container' );

			$css->add_property(
				'max-width',
				sprintf(
					'calc(%1$s - %2$s - %3$s)',
					$container_width . 'px',
					$padding_right,
					$padding_left
				)
			);
		}

		if ( generate_is_using_flexbox() && '' !== $options['site_header_merge'] ) {
			if ( 'merge-desktop' === $options['site_header_merge'] ) {
				$css->start_media_query( apply_filters( 'generate_not_mobile_media_query', '(min-width: 769px)' ) );
			}

			if ( $options['navigation_colors'] ) {
				$navigation_background = $options['navigation_background_color'] ? $options['navigation_background_color'] : 'transparent';
				$navigation_background_hover = $options['navigation_background_color_hover'] ? $options['navigation_background_color_hover'] : 'transparent';

				$css->set_selector( '.header-wrap #site-navigation:not(.toggled), .header-wrap #mobile-header:not(.toggled):not(.navigation-stick), .has-inline-mobile-toggle .mobile-menu-control-wrapper' );
				$css->add_property( 'background', $navigation_background );

				$css->set_selector( '.main-navigation:not(.toggled):not(.navigation-stick) .menu-bar-item:not(.close-search) > a' );
				$css->add_property( 'color', esc_attr( $options['navigation_text_color'] ) );

				$css->set_selector( '.header-wrap #site-navigation:not(.toggled) .menu-bar-item:not(.close-search):hover > a, .header-wrap #mobile-header:not(.toggled) .menu-bar-item:not(.close-search):hover > a, .header-wrap #site-navigation:not(.toggled) .menu-bar-item:not(.close-search).sfHover > a, .header-wrap #mobile-header:not(.toggled) .menu-bar-item:not(.close-search).sfHover > a' );
				$css->add_property( 'background', $navigation_background_hover );

				if ( '' !== $options['navigation_text_color_hover'] ) {
					$css->add_property( 'color', esc_attr( $options['navigation_text_color_hover'] ) );
				} else {
					$css->add_property( 'color', esc_attr( $options['navigation_text_color'] ) );
				}
			}

			if ( 'merge-desktop' === $options['site_header_merge'] ) {
				$css->stop_media_query();
			}
		}

		if ( $css->css_output() ) {
			$new_css = $css->css_output();
		}
	}

	return $css_output . $new_css;
}

add_action( 'customize_register', 'generate_pro_compat_customize_register', 100 );
/**
 * Alter some Customizer options in the pro version.
 *
 * @since 3.0.0
 * @param object $wp_customize The Customizer object.
 */
function generate_pro_compat_customize_register( $wp_customize ) {
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		return;
	}

	if ( version_compare( GP_PREMIUM_VERSION, '1.12.0-alpha.1', '<' ) ) {
		if ( $wp_customize->get_setting( 'generate_spacing_settings[separator]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[separator]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[right_sidebar_width]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[right_sidebar_width]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[left_sidebar_width]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[left_sidebar_width]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_top]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_top]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_right]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_right]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_bottom]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_bottom]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_left]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_widget_container_left]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_top]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_top]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_right]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_right]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_bottom]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_bottom]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_left]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[mobile_footer_widget_container_left]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_top]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_top]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_right]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_right]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_bottom]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_bottom]' )->transport = 'refresh';
		}

		if ( $wp_customize->get_setting( 'generate_spacing_settings[footer_left]' ) ) {
			$wp_customize->get_setting( 'generate_spacing_settings[footer_left]' )->transport = 'refresh';
		}
	}

	if ( $wp_customize->get_panel( 'generate_typography_panel' ) ) {
		$wp_customize->get_panel( 'generate_typography_panel' )->active_callback = function() {
			if ( generate_is_using_dynamic_typography() ) {
				return false;
			}

			return true;
		};
	}
}

add_action( 'wp', 'generate_do_pro_compatibility_setup' );
/**
 * Do basic compatibility with GP Premium versions.
 *
 * @since 3.0.0
 */
function generate_do_pro_compatibility_setup() {
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		return;
	}

	if ( version_compare( GP_PREMIUM_VERSION, '1.12.0-alpha.1', '<' ) ) {
		// Fix Elements removing archive post titles.
		if ( function_exists( 'generate_premium_do_elements' ) && ! is_singular() ) {
			add_filter( 'generate_show_title', '__return_true', 20 );
		}
	}

	if ( generate_is_using_dynamic_typography() ) {
		remove_action( 'wp_enqueue_scripts', 'generate_enqueue_google_fonts', 0 );
		remove_action( 'wp_enqueue_scripts', 'generate_typography_premium_css', 100 );
		remove_filter( 'generate_external_dynamic_css_output', 'generate_typography_add_to_external_stylesheet' );
	}
}

add_filter( 'generate_has_active_menu', 'generate_do_pro_active_menus' );
/**
 * Tell GP about our active pro menus.
 *
 * @since 3.1.0
 * @param boolean $has_active_menu Whether we have an active menu.
 */
function generate_do_pro_active_menus( $has_active_menu ) {
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		return $has_active_menu;
	}

	if ( version_compare( GP_PREMIUM_VERSION, '2.1.0-alpha.1', '<' ) ) {
		if ( function_exists( 'generate_menu_plus_get_defaults' ) ) {
			$menu_plus_settings = wp_parse_args(
				get_option( 'generate_menu_plus_settings', array() ),
				generate_menu_plus_get_defaults()
			);

			if ( 'disable' !== $menu_plus_settings['mobile_header'] || 'false' !== $menu_plus_settings['slideout_menu'] ) {
				$has_active_menu = true;
			}
		}

		if ( function_exists( 'generate_secondary_nav_get_defaults' ) && has_nav_menu( 'secondary' ) ) {
			$has_active_menu = true;
		}
	}

	return $has_active_menu;
}

add_action( 'init', 'generate_do_customizer_compatibility_setup' );
/**
 * Make changes to the Customizer in the Pro version.
 */
function generate_do_customizer_compatibility_setup() {
	if ( ! defined( 'GP_PREMIUM_VERSION' ) ) {
		return;
	}

	if ( version_compare( GP_PREMIUM_VERSION, '2.1.0-alpha.1', '<' ) ) {
		if ( generate_is_using_dynamic_typography() ) {
			remove_action( 'customize_register', 'generate_fonts_customize_register' );
			remove_action( 'customize_preview_init', 'generate_typography_customizer_live_preview' );
		}

		remove_action( 'customize_register', 'generate_colors_customize_register' );
		remove_action( 'customize_preview_init', 'generate_colors_customizer_live_preview' );
		remove_action( 'customize_controls_enqueue_scripts', 'generate_enqueue_color_palettes', 1001 );
		remove_action( 'customize_register', 'generate_colors_secondary_nav_customizer', 1000 );
		remove_action( 'customize_register', 'generate_slideout_navigation_color_controls', 150 );
		remove_action( 'customize_register', 'generate_colors_wc_customizer', 100 );
	}
}
