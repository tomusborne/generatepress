<?php
/**
 * Output all of our dynamic CSS.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'generate_base_css' ) ) {
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer.
	 *
	 * @since 0.1
	 */
	function generate_base_css() {
		$settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_defaults()
		);

		$css = new GeneratePress_CSS();

		$css->set_selector( 'body' );
		$css->add_property( 'background-color', $settings['background_color'] );
		$css->add_property( 'color', $settings['text_color'] );

		$css->set_selector( 'a' );
		$css->add_property( 'color', $settings['link_color'] );

		$css->set_selector( 'a:visited' )->add_property( 'color', $settings['link_color_visited'] );

		$underline_links = generate_get_option( 'underline_links' );

		if ( 'never' !== $underline_links ) {
			if ( 'always' === $underline_links ) {
				$css->set_selector( 'a' );
				$css->add_property( 'text-decoration', 'underline' );
			}

			if ( 'hover' === $underline_links ) {
				$css->set_selector( 'a:hover, a:focus' );
				$css->add_property( 'text-decoration', 'underline' );
			}

			if ( 'not-hover' === $underline_links ) {
				$css->set_selector( 'a' );
				$css->add_property( 'text-decoration', 'underline' );

				$css->set_selector( 'a:hover, a:focus' );
				$css->add_property( 'text-decoration', 'none' );
			}

			$css->set_selector( '.entry-title a, .site-branding a, a.button, .wp-block-button__link, .main-navigation a' );
			$css->add_property( 'text-decoration', 'none' );
		}

		$css->set_selector( 'a:hover, a:focus, a:active' );
		$css->add_property( 'color', $settings['link_color_hover'] );

		if ( generate_is_using_flexbox() ) {
			if ( 1200 !== (int) $settings['container_width'] ) {
				$css->set_selector( '.grid-container' )->add_property( 'max-width', absint( $settings['container_width'] ), false, 'px' );
			}
		} else {
			$css->set_selector( 'body .grid-container' )->add_property( 'max-width', absint( $settings['container_width'] ), false, 'px' );
		}

		if ( apply_filters( 'generate_do_group_inner_container_style', true ) ) {
			$css->set_selector( '.wp-block-group__inner-container' );
			$css->add_property( 'max-width', absint( $settings['container_width'] ), false, 'px' );
			$css->add_property( 'margin-left', 'auto' );
			$css->add_property( 'margin-right', 'auto' );
		}

		$nav_drop_point = generate_get_option( 'nav_drop_point' );
		$nav_location = generate_get_navigation_location();

		if ( ( 'nav-float-right' === $nav_location || 'nav-float-left' === $nav_location ) && $nav_drop_point ) {
			$media_query = sprintf(
				'(max-width: %1$s) and %2$s',
				absint( $nav_drop_point ) . 'px',
				apply_filters( 'generate_not_mobile_menu_media_query', '(min-width: 769px)' )
			);

			$css->start_media_query( $media_query );
				$css->set_selector( '.inside-header' );
				$css->add_property( 'display', 'flex' );
				$css->add_property( 'flex-direction', 'column' );
				$css->add_property( 'align-items', 'center' );

				$css->set_selector( '.site-logo, .site-branding' );
				$css->add_property( 'margin-bottom', '1.5em' );

				$css->set_selector( '#site-navigation' );
				$css->add_property( 'margin', '0 auto' );

				$css->set_selector( '.header-widget' );
				$css->add_property( 'margin-top', '1.5em' );

				// phpcs:ignore Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Indented inside media query.
				if ( 'nav-float-left' === generate_get_option( 'nav_position_setting' ) ) {
					$css->set_selector( '.nav-float-left .site-logo,.nav-float-left .site-branding,.nav-float-left .header-widget' );
					$css->add_property( 'order', 'initial' );
				} // phpcs:ignore Generic.WhiteSpace.ScopeIndent.IncorrectExact -- Indented inside media query.
			$css->stop_media_query();
		}

		if ( generate_get_option( 'logo_width' ) ) {
			$css->set_selector( '.site-header .header-image' );
			$css->add_property( 'width', absint( generate_get_option( 'logo_width' ) ), false, 'px' );
		}

		if ( generate_get_option( 'back_to_top' ) ) {
			$css->set_selector( '.generate-back-to-top' );
			$css->add_property( 'font-size', '20px' );
			$css->add_property( 'border-radius', '3px' );
			$css->add_property( 'position', 'fixed' );
			$css->add_property( 'bottom', '30px' );
			$css->add_property( 'right', '30px' );
			$css->add_property( 'line-height', '40px' );
			$css->add_property( 'width', '40px' );
			$css->add_property( 'text-align', 'center' );
			$css->add_property( 'z-index', '10' );
			$css->add_property( 'transition', 'opacity 300ms ease-in-out' );
			$css->add_property( 'opacity', '0.1' ); // Can't be 0 or we face double-tap issues on iOS.
			$css->add_property( 'transform', 'translateY(1000px)' ); // Can't use visibility or we face the same issue as above.

			$css->set_selector( '.generate-back-to-top__show' );
			$css->add_property( 'opacity', '1' );
			$css->add_property( 'transform', 'translateY(0)' );
		}

		if ( 'enable' === generate_get_option( 'nav_search' ) ) {
			$css->set_selector( '.navigation-search' );
			$css->add_property( 'position', 'absolute' );
			$css->add_property( 'left', '-99999px' );
			$css->add_property( 'pointer-events', 'none' );
			$css->add_property( 'visibility', 'hidden' );
			$css->add_property( 'z-index', '20' );
			$css->add_property( 'width', '100%' );
			$css->add_property( 'top', '0' );
			$css->add_property( 'transition', 'opacity 100ms ease-in-out' );
			$css->add_property( 'opacity', '0' );

			$css->set_selector( '.navigation-search.nav-search-active' );
			$css->add_property( 'left', '0' );
			$css->add_property( 'right', '0' );
			$css->add_property( 'pointer-events', 'auto' );
			$css->add_property( 'visibility', 'visible' );
			$css->add_property( 'opacity', '1' );

			$css->set_selector( '.navigation-search input[type="search"]' );
			$css->add_property( 'outline', '0' );
			$css->add_property( 'border', '0' );
			$css->add_property( 'vertical-align', 'bottom' );
			$css->add_property( 'line-height', '1' );
			$css->add_property( 'opacity', '0.9' );
			$css->add_property( 'width', '100%' );
			$css->add_property( 'z-index', '20' );
			$css->add_property( 'border-radius', '0' );
			$css->add_property( '-webkit-appearance', 'none' );
			$css->add_property( 'height', '60px' );

			$css->set_selector( '.navigation-search input::-ms-clear' );
			$css->add_property( 'display', 'none' );
			$css->add_property( 'width', '0' );
			$css->add_property( 'height', '0' );

			$css->set_selector( '.navigation-search input::-ms-reveal' );
			$css->add_property( 'display', 'none' );
			$css->add_property( 'width', '0' );
			$css->add_property( 'height', '0' );

			$css->set_selector( '.navigation-search input::-webkit-search-decoration, .navigation-search input::-webkit-search-cancel-button, .navigation-search input::-webkit-search-results-button, .navigation-search input::-webkit-search-results-decoration' );
			$css->add_property( 'display', 'none' );

			if ( ! generate_is_using_flexbox() ) {
				$css->set_selector( '.main-navigation li.search-item' );
				$css->add_property( 'z-index', '21' );

				$css->set_selector( 'li.search-item.active' );
				$css->add_property( 'transition', 'opacity 100ms ease-in-out' );

				$css->set_selector( '.nav-left-sidebar .main-navigation li.search-item.active,.nav-right-sidebar .main-navigation li.search-item.active' );
				$css->add_property( 'width', 'auto' );
				$css->add_property( 'display', 'inline-block' );
				$css->add_property( 'float', 'right' );
			}

			$css->set_selector( '.gen-sidebar-nav .navigation-search' );
			$css->add_property( 'top', 'auto' );
			$css->add_property( 'bottom', '0' );
		}

		if ( 'click' === generate_get_option( 'nav_dropdown_type' ) || 'click-arrow' === generate_get_option( 'nav_dropdown_type' ) ) {
			$css->set_selector( '.dropdown-click .main-navigation ul ul' );
			$css->add_property( 'display', 'none' );
			$css->add_property( 'visibility', 'hidden' );

			$css->set_selector( '.dropdown-click .main-navigation ul ul ul.toggled-on' );
			$css->add_property( 'left', '0' );
			$css->add_property( 'top', 'auto' );
			$css->add_property( 'position', 'relative' );
			$css->add_property( 'box-shadow', 'none' );
			$css->add_property( 'border-bottom', '1px solid rgba(0,0,0,0.05)' );

			$css->set_selector( '.dropdown-click .main-navigation ul ul li:last-child > ul.toggled-on' );
			$css->add_property( 'border-bottom', '0' );

			$css->set_selector( '.dropdown-click .main-navigation ul.toggled-on, .dropdown-click .main-navigation ul li.sfHover > ul.toggled-on' );
			$css->add_property( 'display', 'block' );
			$css->add_property( 'left', 'auto' );
			$css->add_property( 'right', 'auto' );
			$css->add_property( 'opacity', '1' );
			$css->add_property( 'visibility', 'visible' );
			$css->add_property( 'pointer-events', 'auto' );
			$css->add_property( 'height', 'auto' );
			$css->add_property( 'overflow', 'visible' );
			$css->add_property( 'float', 'none' );

			$css->set_selector( '.dropdown-click .main-navigation.sub-menu-left .sub-menu.toggled-on, .dropdown-click .main-navigation.sub-menu-left ul li.sfHover > ul.toggled-on' );
			$css->add_property( 'right', '0' );

			$css->set_selector( '.dropdown-click nav ul ul ul' );
			$css->add_property( 'background-color', 'transparent' );

			$css->set_selector( '.dropdown-click .widget-area .main-navigation ul ul' );
			$css->add_property( 'top', 'auto' );
			$css->add_property( 'position', 'absolute' );
			$css->add_property( 'float', 'none' );
			$css->add_property( 'width', '100%' );
			$css->add_property( 'left', '-99999px' );

			$css->set_selector( '.dropdown-click .widget-area .main-navigation ul ul.toggled-on' );
			$css->add_property( 'position', 'relative' );
			$css->add_property( 'left', '0' );
			$css->add_property( 'right', '0' );

			$css->set_selector( '.dropdown-click .widget-area.sidebar .main-navigation ul li.sfHover ul, .dropdown-click .widget-area.sidebar .main-navigation ul li:hover ul' );
			$css->add_property( 'right', '0' );
			$css->add_property( 'left', '0' );

			$css->set_selector( '.dropdown-click .sfHover > a > .dropdown-menu-toggle > .gp-icon svg' );
			$css->add_property( 'transform', 'rotate(180deg)' );
		}

		$css->set_selector( ':root' );

		$global_colors = generate_get_global_colors();

		if ( ! empty( $global_colors ) ) {
			foreach ( (array) $global_colors as $key => $data ) {
				if ( ! empty( $data['slug'] ) && ! empty( $data['color'] ) ) {
					$css->add_property( '--' . $data['slug'], $data['color'] );
				}
			}

			foreach ( (array) $global_colors as $key => $data ) {
				if ( ! empty( $data['slug'] ) && ! empty( $data['color'] ) ) {
					$css->set_selector( '.has-' . $data['slug'] . '-color' );
					$css->add_property( 'color', 'var(--' . $data['slug'] . ')' );

					$css->set_selector( '.has-' . $data['slug'] . '-background-color' );
					$css->add_property( 'background-color', 'var(--' . $data['slug'] . ')' );
				}
			}
		}

		do_action( 'generate_base_css', $css );

		return apply_filters( 'generate_base_css_output', $css->css_output() );
	}
}

if ( ! function_exists( 'generate_advanced_css' ) ) {
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer.
	 *
	 * @since 0.1
	 */
	function generate_advanced_css() {
		$settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_color_defaults()
		);

		$css = new GeneratePress_CSS();

		$css->set_selector( '.top-bar' );
		$css->add_property( 'background-color', $settings['top_bar_background_color'] );
		$css->add_property( 'color', $settings['top_bar_text_color'] );

		$css->set_selector( '.top-bar a' );
		$css->add_property( 'color', $settings['top_bar_link_color'] );

		$css->set_selector( '.top-bar a:hover' );
		$css->add_property( 'color', $settings['top_bar_link_color_hover'] );

		$css->set_selector( '.site-header' );
		$css->add_property( 'background-color', $settings['header_background_color'] );
		$css->add_property( 'color', $settings['header_text_color'] );

		$css->set_selector( '.site-header a' );
		$css->add_property( 'color', $settings['header_link_color'] );

		$css->set_selector( '.site-header a:hover' );
		$css->add_property( 'color', $settings['header_link_hover_color'] );

		$css->set_selector( '.main-title a,.main-title a:hover' );
		$css->add_property( 'color', $settings['site_title_color'] );

		$css->set_selector( '.site-description' );
		$css->add_property( 'color', $settings['site_tagline_color'] );

		if ( $settings['navigation_background_color'] === $settings['header_background_color'] ) {
			$css->set_selector( '.mobile-menu-control-wrapper .menu-toggle,.mobile-menu-control-wrapper .menu-toggle:hover,.mobile-menu-control-wrapper .menu-toggle:focus,.has-inline-mobile-toggle #site-navigation.toggled' );
			$css->add_property( 'background-color', 'rgba(0, 0, 0, 0.02)' );
		}

		$css->set_selector( '.main-navigation,.main-navigation ul ul' );
		$css->add_property( 'background-color', $settings['navigation_background_color'] );

		$css->set_selector( '.main-navigation .main-nav ul li a, .main-navigation .menu-toggle, .main-navigation .menu-bar-items' );
		$css->add_property( 'color', $settings['navigation_text_color'] );

		$css->set_selector( '.main-navigation .main-nav ul li:not([class*="current-menu-"]):hover > a, .main-navigation .main-nav ul li:not([class*="current-menu-"]):focus > a, .main-navigation .main-nav ul li.sfHover:not([class*="current-menu-"]) > a, .main-navigation .menu-bar-item:hover > a, .main-navigation .menu-bar-item.sfHover > a' );
		$css->add_property( 'color', $settings['navigation_text_hover_color'] );
		$css->add_property( 'background-color', $settings['navigation_background_hover_color'] );

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( 'button.menu-toggle:hover,button.menu-toggle:focus' );
		} else {
			$css->set_selector( 'button.menu-toggle:hover,button.menu-toggle:focus,.main-navigation .mobile-bar-items a,.main-navigation .mobile-bar-items a:hover,.main-navigation .mobile-bar-items a:focus' );
		}

		$css->add_property( 'color', $settings['navigation_text_color'] );

		$css->set_selector( '.main-navigation .main-nav ul li[class*="current-menu-"] > a' );
		$css->add_property( 'color', $settings['navigation_text_current_color'] );
		$css->add_property( 'background-color', $settings['navigation_background_current_color'] );

		$navigation_search_background = $settings['navigation_background_hover_color'];
		$navigation_search_text = $settings['navigation_text_hover_color'];

		if ( '' !== $settings['navigation_search_background_color'] ) {
			$navigation_search_background = $settings['navigation_search_background_color'];
		}

		if ( '' !== $settings['navigation_search_text_color'] ) {
			$navigation_search_text = $settings['navigation_search_text_color'];
		}

		$css->set_selector( '.navigation-search input[type="search"],.navigation-search input[type="search"]:active, .navigation-search input[type="search"]:focus, .main-navigation .main-nav ul li.search-item.active > a, .main-navigation .menu-bar-items .search-item.active > a' );
		$css->add_property( 'color', $navigation_search_text );
		$css->add_property( 'background-color', $navigation_search_background );

		if ( '' !== $settings['navigation_search_background_color'] ) {
			$css->add_property( 'opacity', '1' );
		}

		$css->set_selector( '.main-navigation ul ul' );
		$css->add_property( 'background-color', $settings['subnavigation_background_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li a' );
		$css->add_property( 'color', $settings['subnavigation_text_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li:not([class*="current-menu-"]):hover > a,.main-navigation .main-nav ul ul li:not([class*="current-menu-"]):focus > a, .main-navigation .main-nav ul ul li.sfHover:not([class*="current-menu-"]) > a' );
		$css->add_property( 'color', $settings['subnavigation_text_hover_color'] );
		$css->add_property( 'background-color', $settings['subnavigation_background_hover_color'] );

		$css->set_selector( '.main-navigation .main-nav ul ul li[class*="current-menu-"] > a' );
		$css->add_property( 'color', $settings['subnavigation_text_current_color'] );
		$css->add_property( 'background-color', $settings['subnavigation_background_current_color'] );

		$css->set_selector( '.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .one-container .container, .separate-containers .paging-navigation, .inside-page-header' );
		$css->add_property( 'color', $settings['content_text_color'] );
		$css->add_property( 'background-color', $settings['content_background_color'] );

		$css->set_selector( '.inside-article a,.paging-navigation a,.comments-area a,.page-header a' );
		$css->add_property( 'color', $settings['content_link_color'] );

		$css->set_selector( '.inside-article a:hover,.paging-navigation a:hover,.comments-area a:hover,.page-header a:hover' );
		$css->add_property( 'color', $settings['content_link_hover_color'] );

		$css->set_selector( '.entry-header h1,.page-header h1' );
		$css->add_property( 'color', $settings['content_title_color'] );

		$css->set_selector( '.entry-title a' );
		$css->add_property( 'color', $settings['blog_post_title_color'] );

		$css->set_selector( '.entry-title a:hover' );
		$css->add_property( 'color', $settings['blog_post_title_hover_color'] );

		$css->set_selector( '.entry-meta' );
		$css->add_property( 'color', $settings['entry_meta_text_color'] );

		$css->set_selector( '.entry-meta a' );
		$css->add_property( 'color', $settings['entry_meta_link_color'] );

		$css->set_selector( '.entry-meta a:hover' );
		$css->add_property( 'color', $settings['entry_meta_link_color_hover'] );

		$css->set_selector( 'h1' );
		$css->add_property( 'color', $settings['h1_color'] );

		$css->set_selector( 'h2' );
		$css->add_property( 'color', $settings['h2_color'] );

		$css->set_selector( 'h3' );
		$css->add_property( 'color', $settings['h3_color'] );

		$css->set_selector( 'h4' );
		$css->add_property( 'color', $settings['h4_color'] );

		$css->set_selector( 'h5' );
		$css->add_property( 'color', $settings['h5_color'] );

		$css->set_selector( 'h6' );
		$css->add_property( 'color', $settings['h6_color'] );

		$css->set_selector( '.sidebar .widget' );
		$css->add_property( 'color', $settings['sidebar_widget_text_color'] );
		$css->add_property( 'background-color', $settings['sidebar_widget_background_color'] );

		$css->set_selector( '.sidebar .widget a' );
		$css->add_property( 'color', $settings['sidebar_widget_link_color'] );

		$css->set_selector( '.sidebar .widget a:hover' );
		$css->add_property( 'color', $settings['sidebar_widget_link_hover_color'] );

		$css->set_selector( '.sidebar .widget .widget-title' );
		$css->add_property( 'color', $settings['sidebar_widget_title_color'] );

		$css->set_selector( '.footer-widgets' );
		$css->add_property( 'color', $settings['footer_widget_text_color'] );
		$css->add_property( 'background-color', $settings['footer_widget_background_color'] );

		$css->set_selector( '.footer-widgets a' );
		$css->add_property( 'color', $settings['footer_widget_link_color'] );

		$css->set_selector( '.footer-widgets a:hover' );
		$css->add_property( 'color', $settings['footer_widget_link_hover_color'] );

		$css->set_selector( '.footer-widgets .widget-title' );
		$css->add_property( 'color', $settings['footer_widget_title_color'] );

		$css->set_selector( '.site-info' );
		$css->add_property( 'color', $settings['footer_text_color'] );
		$css->add_property( 'background-color', $settings['footer_background_color'] );

		$css->set_selector( '.site-info a' );
		$css->add_property( 'color', $settings['footer_link_color'] );

		$css->set_selector( '.site-info a:hover' );
		$css->add_property( 'color', $settings['footer_link_hover_color'] );

		$css->set_selector( '.footer-bar .widget_nav_menu .current-menu-item a' );
		$css->add_property( 'color', $settings['footer_link_hover_color'] );

		$css->set_selector( 'input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="tel"],input[type="number"],textarea,select' );
		$css->add_property( 'color', $settings['form_text_color'] );
		$css->add_property( 'background-color', $settings['form_background_color'] );
		$css->add_property( 'border-color', $settings['form_border_color'] );

		$css->set_selector( 'input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="number"]:focus,textarea:focus,select:focus' );
		$css->add_property( 'color', $settings['form_text_color_focus'] );
		$css->add_property( 'background-color', $settings['form_background_color_focus'] );
		$css->add_property( 'border-color', $settings['form_border_color_focus'] );

		$css->set_selector( 'button,html input[type="button"],input[type="reset"],input[type="submit"],a.button,a.wp-block-button__link:not(.has-background)' );
		$css->add_property( 'color', $settings['form_button_text_color'] );
		$css->add_property( 'background-color', $settings['form_button_background_color'] );

		$css->set_selector( 'button:hover,html input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,a.button:hover,button:focus,html input[type="button"]:focus,input[type="reset"]:focus,input[type="submit"]:focus,a.button:focus,a.wp-block-button__link:not(.has-background):active,a.wp-block-button__link:not(.has-background):focus,a.wp-block-button__link:not(.has-background):hover' );
		$css->add_property( 'color', $settings['form_button_text_color_hover'] );
		$css->add_property( 'background-color', $settings['form_button_background_color_hover'] );

		$css->set_selector( 'a.generate-back-to-top' );
		$css->add_property( 'background-color', $settings['back_to_top_background_color'] );
		$css->add_property( 'color', $settings['back_to_top_text_color'] );

		$css->set_selector( 'a.generate-back-to-top:hover,a.generate-back-to-top:focus' );
		$css->add_property( 'background-color', $settings['back_to_top_background_color_hover'] );
		$css->add_property( 'color', $settings['back_to_top_text_color_hover'] );

		$css->start_media_query( generate_get_media_query( 'mobile-menu' ) );
		$css->set_selector( '.main-navigation .menu-bar-item:hover > a, .main-navigation .menu-bar-item.sfHover > a' );
		$css->add_property( 'background', 'none' );
		$css->add_property( 'color', $settings['navigation_text_color'] );
		$css->stop_media_query();

		do_action( 'generate_colors_css', $css );

		return apply_filters( 'generate_colors_css_output', $css->css_output() );
	}
}

if ( ! function_exists( 'generate_font_css' ) ) {
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer.
	 *
	 * @since 0.1
	 */
	function generate_font_css() {

		$settings = wp_parse_args(
			get_option( 'generate_settings', array() ),
			generate_get_default_fonts()
		);

		$defaults = generate_get_default_fonts( false );

		$css = new GeneratePress_CSS();

		$body_family = generate_get_font_family_css( 'font_body', 'generate_settings', generate_get_default_fonts() );
		$top_bar_family = generate_get_font_family_css( 'font_top_bar', 'generate_settings', generate_get_default_fonts() );
		$site_title_family = generate_get_font_family_css( 'font_site_title', 'generate_settings', generate_get_default_fonts() );
		$site_tagline_family = generate_get_font_family_css( 'font_site_tagline', 'generate_settings', generate_get_default_fonts() );
		$navigation_family = generate_get_font_family_css( 'font_navigation', 'generate_settings', generate_get_default_fonts() );
		$widget_family = generate_get_font_family_css( 'font_widget_title', 'generate_settings', generate_get_default_fonts() );
		$h1_family = generate_get_font_family_css( 'font_heading_1', 'generate_settings', generate_get_default_fonts() );
		$h2_family = generate_get_font_family_css( 'font_heading_2', 'generate_settings', generate_get_default_fonts() );
		$h3_family = generate_get_font_family_css( 'font_heading_3', 'generate_settings', generate_get_default_fonts() );
		$h4_family = generate_get_font_family_css( 'font_heading_4', 'generate_settings', generate_get_default_fonts() );
		$h5_family = generate_get_font_family_css( 'font_heading_5', 'generate_settings', generate_get_default_fonts() );
		$h6_family = generate_get_font_family_css( 'font_heading_6', 'generate_settings', generate_get_default_fonts() );
		$footer_family = generate_get_font_family_css( 'font_footer', 'generate_settings', generate_get_default_fonts() );
		$buttons_family = generate_get_font_family_css( 'font_buttons', 'generate_settings', generate_get_default_fonts() );

		$css->set_selector( 'body, button, input, select, textarea' );
		$css->add_property( 'font-family', $body_family );
		$css->add_property( 'font-weight', $settings['body_font_weight'], $defaults['body_font_weight'] );
		$css->add_property( 'text-transform', $settings['body_font_transform'], $defaults['body_font_transform'] );
		$css->add_property( 'font-size', $settings['body_font_size'], $defaults['body_font_size'], 'px' );

		$css->set_selector( 'body' );
		$css->add_property( 'line-height', floatval( $settings['body_line_height'] ), $defaults['body_line_height'] );

		$css->set_selector( 'p' );
		$css->add_property( 'margin-bottom', floatval( $settings['paragraph_margin'] ), $defaults['paragraph_margin'], 'em' );

		if ( apply_filters( 'generate_do_wp_block_margin_bottom', true ) ) {
			$css->set_selector( '.entry-content > [class*="wp-block-"]:not(:last-child)' );
			$css->add_property( 'margin-bottom', floatval( $settings['paragraph_margin'] ), false, 'em' );
		}

		$css->set_selector( '.top-bar' );
		$css->add_property( 'font-family', $defaults['font_top_bar'] !== $settings['font_top_bar'] ? $top_bar_family : null );
		$css->add_property( 'font-weight', $settings['top_bar_font_weight'], $defaults['top_bar_font_weight'] );
		$css->add_property( 'text-transform', $settings['top_bar_font_transform'], $defaults['top_bar_font_transform'] );
		$css->add_property( 'font-size', absint( $settings['top_bar_font_size'] ), absint( $defaults['top_bar_font_size'] ), 'px' );

		$css->set_selector( '.main-title' );
		$css->add_property( 'font-family', $defaults['font_site_title'] !== $settings['font_site_title'] ? $site_title_family : null );
		$css->add_property( 'font-weight', $settings['site_title_font_weight'], $defaults['site_title_font_weight'] );
		$css->add_property( 'text-transform', $settings['site_title_font_transform'], $defaults['site_title_font_transform'] );
		$css->add_property( 'font-size', absint( $settings['site_title_font_size'] ), $defaults['site_title_font_size'], 'px' );

		$css->set_selector( '.site-description' );
		$css->add_property( 'font-family', $defaults['font_site_tagline'] !== $settings['font_site_tagline'] ? $site_tagline_family : null );
		$css->add_property( 'font-weight', $settings['site_tagline_font_weight'], $defaults['site_tagline_font_weight'] );
		$css->add_property( 'text-transform', $settings['site_tagline_font_transform'], $defaults['site_tagline_font_transform'] );

		if ( ! empty( $settings['site_tagline_font_size'] ) ) {
			$css->add_property( 'font-size', absint( $settings['site_tagline_font_size'] ), $defaults['site_tagline_font_size'], 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		$css->set_selector( '.main-navigation a, .menu-toggle' );
		$css->add_property( 'font-family', $defaults['font_navigation'] !== $settings['font_navigation'] ? $navigation_family : null );
		$css->add_property( 'font-weight', $settings['navigation_font_weight'], $defaults['navigation_font_weight'] );
		$css->add_property( 'text-transform', $settings['navigation_font_transform'], $defaults['navigation_font_transform'] );

		if ( ! empty( $settings['navigation_font_size'] ) ) {
			$css->add_property( 'font-size', absint( $settings['navigation_font_size'] ), $defaults['navigation_font_size'], 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.main-navigation .menu-bar-items' );

			if ( ! empty( $settings['navigation_font_size'] ) ) {
				$css->add_property( 'font-size', absint( $settings['navigation_font_size'] ), $defaults['navigation_font_size'], 'px' );
			} else {
				$css->add_property( 'font-size', 'inherit' );
			}
		}

		$css->set_selector( '.main-navigation .main-nav ul ul li a' );

		if ( ! empty( $settings['navigation_font_size'] ) ) {
			$subnav_font_size = $settings['navigation_font_size'] >= 17 ? $settings['navigation_font_size'] - 3 : $settings['navigation_font_size'] - 1;
			$css->add_property( 'font-size', absint( $subnav_font_size ), false, 'px' );
		}

		$css->set_selector( '.widget-title' );
		$css->add_property( 'font-family', $defaults['font_widget_title'] !== $settings['font_widget_title'] ? $widget_family : null );
		$css->add_property( 'font-weight', $settings['widget_title_font_weight'], $defaults['widget_title_font_weight'] );
		$css->add_property( 'text-transform', $settings['widget_title_font_transform'], $defaults['widget_title_font_transform'] );

		if ( ! empty( $settings['widget_title_font_size'] ) ) {
			$css->add_property( 'font-size', $settings['widget_title_font_size'], $defaults['widget_title_font_size'], 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		$css->add_property( 'margin-bottom', absint( $settings['widget_title_separator'] ), absint( $defaults['widget_title_separator'] ), 'px' );

		$css->set_selector( '.sidebar .widget, .footer-widgets .widget' );

		if ( ! empty( $settings['widget_content_font_size'] ) ) {
			$css->add_property( 'font-size', absint( $settings['widget_content_font_size'] ), false, 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		$css->set_selector( 'button:not(.menu-toggle),html input[type="button"],input[type="reset"],input[type="submit"],.button,.wp-block-button .wp-block-button__link' );
		$css->add_property( 'font-family', $defaults['font_buttons'] !== $settings['font_buttons'] ? $buttons_family : null );
		$css->add_property( 'font-weight', $settings['buttons_font_weight'], $defaults['buttons_font_weight'] );
		$css->add_property( 'text-transform', $settings['buttons_font_transform'], $defaults['buttons_font_transform'] );
		$css->add_property( 'font-size', absint( $settings['buttons_font_size'] ), $defaults['buttons_font_size'], 'px' );

		$css->set_selector( 'h1' );
		$css->add_property( 'font-family', $defaults['font_heading_1'] !== $settings['font_heading_1'] ? $h1_family : null );
		$css->add_property( 'font-weight', $settings['heading_1_weight'], $defaults['heading_1_weight'] );
		$css->add_property( 'text-transform', $settings['heading_1_transform'], $defaults['heading_1_transform'] );
		$css->add_property( 'font-size', absint( $settings['heading_1_font_size'] ), $defaults['heading_1_font_size'], 'px' );
		$css->add_property( 'line-height', floatval( $settings['heading_1_line_height'] ), $defaults['heading_1_line_height'], 'em' );
		$css->add_property( 'margin-bottom', floatval( $settings['heading_1_margin_bottom'] ), $defaults['heading_1_margin_bottom'], 'px' );

		$css->set_selector( 'h2' );
		$css->add_property( 'font-family', $defaults['font_heading_2'] !== $settings['font_heading_2'] ? $h2_family : null );
		$css->add_property( 'font-weight', $settings['heading_2_weight'], $defaults['heading_2_weight'] );
		$css->add_property( 'text-transform', $settings['heading_2_transform'], $defaults['heading_2_transform'] );
		$css->add_property( 'font-size', absint( $settings['heading_2_font_size'] ), $defaults['heading_2_font_size'], 'px' );
		$css->add_property( 'line-height', floatval( $settings['heading_2_line_height'] ), $defaults['heading_2_line_height'], 'em' );
		$css->add_property( 'margin-bottom', floatval( $settings['heading_2_margin_bottom'] ), $defaults['heading_2_margin_bottom'], 'px' );

		$css->set_selector( 'h3' );
		$css->add_property( 'font-family', $defaults['font_heading_3'] !== $settings['font_heading_3'] ? $h3_family : null );
		$css->add_property( 'font-weight', $settings['heading_3_weight'], $defaults['heading_3_weight'] );
		$css->add_property( 'text-transform', $settings['heading_3_transform'], $defaults['heading_3_transform'] );
		$css->add_property( 'font-size', absint( $settings['heading_3_font_size'] ), $defaults['heading_3_font_size'], 'px' );
		$css->add_property( 'line-height', floatval( $settings['heading_3_line_height'] ), $defaults['heading_3_line_height'], 'em' );
		$css->add_property( 'margin-bottom', floatval( $settings['heading_3_margin_bottom'] ), $defaults['heading_3_margin_bottom'], 'px' );

		$css->set_selector( 'h4' );
		$css->add_property( 'font-family', $defaults['font_heading_4'] !== $settings['font_heading_4'] ? $h4_family : null );
		$css->add_property( 'font-weight', $settings['heading_4_weight'], $defaults['heading_4_weight'] );
		$css->add_property( 'text-transform', $settings['heading_4_transform'], $defaults['heading_4_transform'] );

		if ( ! empty( $settings['heading_4_font_size'] ) ) {
			$css->add_property( 'font-size', absint( $settings['heading_4_font_size'] ), $defaults['heading_4_font_size'], 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		if ( '' !== $settings['heading_4_line_height'] ) {
			$css->add_property( 'line-height', floatval( $settings['heading_4_line_height'] ), $defaults['heading_4_line_height'], 'em' );
		}

		$css->set_selector( 'h5' );
		$css->add_property( 'font-family', $defaults['font_heading_5'] !== $settings['font_heading_5'] ? $h5_family : null );
		$css->add_property( 'font-weight', $settings['heading_5_weight'], $defaults['heading_5_weight'] );
		$css->add_property( 'text-transform', $settings['heading_5_transform'], $defaults['heading_5_transform'] );

		if ( ! empty( $settings['heading_5_font_size'] ) ) {
			$css->add_property( 'font-size', absint( $settings['heading_5_font_size'] ), $defaults['heading_5_font_size'], 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		if ( '' !== $settings['heading_5_line_height'] ) {
			$css->add_property( 'line-height', floatval( $settings['heading_5_line_height'] ), $defaults['heading_5_line_height'], 'em' );
		}

		$css->set_selector( 'h6' );
		$css->add_property( 'font-family', $defaults['font_heading_6'] !== $settings['font_heading_6'] ? $h6_family : null );
		$css->add_property( 'font-weight', $settings['heading_6_weight'], $defaults['heading_6_weight'] );
		$css->add_property( 'text-transform', $settings['heading_6_transform'], $defaults['heading_6_transform'] );
		$css->add_property( 'font-size', absint( $settings['heading_6_font_size'] ), $defaults['heading_6_font_size'], 'px' );

		if ( '' !== $settings['heading_6_line_height'] ) {
			$css->add_property( 'line-height', floatval( $settings['heading_6_line_height'] ), $defaults['heading_6_line_height'], 'em' );
		}

		$css->set_selector( '.site-info' );
		$css->add_property( 'font-family', $defaults['font_footer'] !== $settings['font_footer'] ? $footer_family : null );
		$css->add_property( 'font-weight', $settings['footer_weight'], $defaults['footer_weight'] );
		$css->add_property( 'text-transform', $settings['footer_transform'], $defaults['footer_transform'] );

		if ( ! empty( $settings['footer_font_size'] ) ) {
			$css->add_property( 'font-size', absint( $settings['footer_font_size'] ), $defaults['footer_font_size'], 'px' );
		} else {
			$css->add_property( 'font-size', 'inherit' );
		}

		$css->start_media_query( generate_get_media_query( 'mobile' ) );
		$css->set_selector( '.main-title' );
		$css->add_property( 'font-size', absint( $settings['mobile_site_title_font_size'] ), false, 'px' );

		$css->set_selector( 'h1' );
		$css->add_property( 'font-size', absint( $settings['mobile_heading_1_font_size'] ), false, 'px' );

		$css->set_selector( 'h2' );
		$css->add_property( 'font-size', absint( $settings['mobile_heading_2_font_size'] ), false, 'px' );

		$css->set_selector( 'h3' );
		$css->add_property( 'font-size', absint( $settings['mobile_heading_3_font_size'] ), false, 'px' );

		$css->set_selector( 'h4' );
		$css->add_property( 'font-size', absint( $settings['mobile_heading_4_font_size'] ), false, 'px' );

		$css->set_selector( 'h5' );
		$css->add_property( 'font-size', absint( $settings['mobile_heading_5_font_size'] ), false, 'px' );
		$css->stop_media_query();

		do_action( 'generate_typography_css', $css );

		return apply_filters( 'generate_typography_css_output', $css->css_output() );
	}
}

if ( ! function_exists( 'generate_spacing_css' ) ) {
	/**
	 * Write our dynamic CSS.
	 *
	 * @since 0.1
	 */
	function generate_spacing_css() {
		$settings = wp_parse_args(
			get_option( 'generate_spacing_settings', array() ),
			generate_spacing_get_defaults()
		);

		$defaults = generate_spacing_get_defaults( false );
		$sidebar_layout = generate_get_layout();

		$css = new GeneratePress_CSS();

		$css->set_selector( '.inside-top-bar' );
		$css->add_property( 'padding', generate_padding_css( $settings['top_bar_top'], $settings['top_bar_right'], $settings['top_bar_bottom'], $settings['top_bar_left'] ), generate_padding_css( $defaults['top_bar_top'], $defaults['top_bar_right'], $defaults['top_bar_bottom'], $defaults['top_bar_left'] ) );

		if ( generate_is_using_flexbox() && 'boxes' === generate_get_option( 'container_alignment' ) ) {
			$top_bar_padding = absint( $settings['top_bar_right'] ) + absint( $settings['top_bar_left'] );

			$css->set_selector( '.inside-top-bar.grid-container' );
			$css->add_property( 'max-width', generate_get_option( 'container_width' ) + $top_bar_padding, false, 'px' );
		}

		$css->set_selector( '.inside-header' );
		$css->add_property( 'padding', generate_padding_css( $settings['header_top'], $settings['header_right'], $settings['header_bottom'], $settings['header_left'] ), generate_padding_css( $defaults['header_top'], $defaults['header_right'], $defaults['header_bottom'], $defaults['header_left'] ) );

		if ( generate_is_using_flexbox() ) {
			if ( 'boxes' === generate_get_option( 'container_alignment' ) ) {
				$header_padding = absint( $settings['header_right'] ) + absint( $settings['header_left'] );

				$css->set_selector( '.inside-header.grid-container' );
				$css->add_property( 'max-width', generate_get_option( 'container_width' ) + $header_padding, false, 'px' );
			}

			if ( 'text' === generate_get_option( 'container_alignment' ) ) {
				$navigation_left_padding = absint( $settings['header_left'] ) - absint( $settings['menu_item'] );
				$navigation_right_padding = absint( $settings['header_right'] ) - absint( $settings['menu_item'] );

				$css->set_selector( '.nav-below-header .main-navigation .inside-navigation.grid-container, .nav-above-header .main-navigation .inside-navigation.grid-container' );
				$css->add_property( 'padding', generate_padding_css( 0, $navigation_right_padding, 0, $navigation_left_padding ) );
			}
		}

		$css->set_selector( '.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .separate-containers .paging-navigation, .one-container .site-content, .inside-page-header' );
		$css->add_property( 'padding', generate_padding_css( $settings['content_top'], $settings['content_right'], $settings['content_bottom'], $settings['content_left'] ), generate_padding_css( $defaults['content_top'], $defaults['content_right'], $defaults['content_bottom'], $defaults['content_left'] ) );

		if ( apply_filters( 'generate_do_group_inner_container_style', true ) ) {
			$css->set_selector( '.site-main .wp-block-group__inner-container' );
			$css->add_property( 'padding', generate_padding_css( $settings['content_top'], $settings['content_right'], $settings['content_bottom'], $settings['content_left'] ) );
		}

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.separate-containers .paging-navigation' );
			$css->add_property( 'padding-top', '20px' );
			$css->add_property( 'padding-bottom', '20px' );
		}

		$content_padding = absint( $settings['content_right'] ) + absint( $settings['content_left'] );
		$css->set_selector( '.entry-content .alignwide, body:not(.no-sidebar) .entry-content .alignfull' );
		$css->add_property( 'margin-left', '-' . absint( $settings['content_left'] ) . 'px' );
		$css->add_property( 'width', 'calc(100% + ' . absint( $content_padding ) . 'px)' );
		$css->add_property( 'max-width', 'calc(100% + ' . absint( $content_padding ) . 'px)' );

		if ( ! generate_is_using_flexbox() && 'text' === generate_get_option( 'container_alignment' ) ) {
			$css->set_selector( '.container.grid-container' );
			$css->add_property( 'max-width', generate_get_option( 'container_width' ) + $content_padding, false, 'px' );
		}

		$css->set_selector( '.one-container.right-sidebar .site-main,.one-container.both-right .site-main' );
		$css->add_property( 'margin-right', absint( $settings['content_right'] ), absint( $defaults['content_right'] ), 'px' );

		$css->set_selector( '.one-container.left-sidebar .site-main,.one-container.both-left .site-main' );
		$css->add_property( 'margin-left', absint( $settings['content_left'] ), absint( $defaults['content_left'] ), 'px' );

		$css->set_selector( '.one-container.both-sidebars .site-main' );
		$css->add_property( 'margin', generate_padding_css( '0', $settings['content_right'], '0', $settings['content_left'] ), generate_padding_css( '0', $defaults['content_right'], '0', $defaults['content_left'] ) );

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.sidebar .widget, .page-header, .widget-area .main-navigation, .site-main > *' );
		} else {
			$css->set_selector( '.separate-containers .widget, .separate-containers .site-main > *, .separate-containers .page-header, .widget-area .main-navigation' );
		}

		$css->add_property( 'margin-bottom', absint( $settings['separator'] ), absint( $defaults['separator'] ), 'px' );

		$css->set_selector( '.separate-containers .site-main' );
		$css->add_property( 'margin', absint( $settings['separator'] ), $defaults['separator'], 'px' );

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.both-right .inside-left-sidebar,.both-left .inside-left-sidebar' );
			$css->add_property( 'margin-right', absint( $settings['separator'] / 2 ), absint( $defaults['separator'] / 2 ), 'px' );

			$css->set_selector( '.both-right .inside-right-sidebar,.both-left .inside-right-sidebar' );
			$css->add_property( 'margin-left', absint( $settings['separator'] / 2 ), absint( $defaults['separator'] / 2 ), 'px' );

			$css->set_selector( '.one-container.archive .post:not(:last-child):not(.is-loop-template-item), .one-container.blog .post:not(:last-child):not(.is-loop-template-item)' );
			$css->add_property( 'padding-bottom', absint( $settings['content_bottom'] ), absint( $defaults['content_bottom'] ), 'px' );
		} else {
			$css->set_selector( '.both-right.separate-containers .inside-left-sidebar' );
			$css->add_property( 'margin-right', absint( $settings['separator'] / 2 ), absint( $defaults['separator'] / 2 ), 'px' );

			$css->set_selector( '.both-right.separate-containers .inside-right-sidebar' );
			$css->add_property( 'margin-left', absint( $settings['separator'] / 2 ), absint( $defaults['separator'] / 2 ), 'px' );

			$css->set_selector( '.both-left.separate-containers .inside-left-sidebar' );
			$css->add_property( 'margin-right', absint( $settings['separator'] / 2 ), absint( $defaults['separator'] / 2 ), 'px' );

			$css->set_selector( '.both-left.separate-containers .inside-right-sidebar' );
			$css->add_property( 'margin-left', absint( $settings['separator'] / 2 ), absint( $defaults['separator'] / 2 ), 'px' );
		}

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.separate-containers .featured-image' );
		} else {
			$css->set_selector( '.separate-containers .page-header-image, .separate-containers .page-header-contained, .separate-containers .page-header-image-single, .separate-containers .page-header-content-single' );
		}

		$css->add_property( 'margin-top', absint( $settings['separator'] ), absint( $defaults['separator'] ), 'px' );

		$css->set_selector( '.separate-containers .inside-right-sidebar, .separate-containers .inside-left-sidebar' );
		$css->add_property( 'margin-top', absint( $settings['separator'] ), absint( $defaults['separator'] ), 'px' );
		$css->add_property( 'margin-bottom', absint( $settings['separator'] ), absint( $defaults['separator'] ), 'px' );

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.main-navigation .main-nav ul li a,.menu-toggle,.main-navigation .menu-bar-item > a' );
		} else {
			$css->set_selector( '.main-navigation .main-nav ul li a,.menu-toggle,.main-navigation .mobile-bar-items a' );
		}

		$css->add_property( 'padding-left', absint( $settings['menu_item'] ), absint( $defaults['menu_item'] ), 'px' );
		$css->add_property( 'padding-right', absint( $settings['menu_item'] ), absint( $defaults['menu_item'] ), 'px' );
		$css->add_property( 'line-height', absint( $settings['menu_item_height'] ), absint( $defaults['menu_item_height'] ), 'px' );

		$css->set_selector( '.main-navigation .main-nav ul ul li a' );
		$css->add_property( 'padding', generate_padding_css( $settings['sub_menu_item_height'], $settings['menu_item'], $settings['sub_menu_item_height'], $settings['menu_item'] ), generate_padding_css( $defaults['sub_menu_item_height'], $defaults['menu_item'], $defaults['sub_menu_item_height'], $defaults['menu_item'] ) );

		$css->set_selector( '.main-navigation ul ul' );
		$css->add_property( 'width', absint( $settings['sub_menu_width'] ), absint( $defaults['sub_menu_width'] ), 'px' );

		$css->set_selector( '.navigation-search input[type="search"]' );
		$css->add_property( 'height', absint( $settings['menu_item_height'] ), absint( $defaults['menu_item_height'] ), 'px' );

		$css->set_selector( '.rtl .menu-item-has-children .dropdown-menu-toggle' );
		$css->add_property( 'padding-left', absint( $settings['menu_item'] ), false, 'px' );

		$css->set_selector( '.menu-item-has-children .dropdown-menu-toggle' );
		$css->add_property( 'padding-right', absint( $settings['menu_item'] ), absint( $defaults['menu_item'] ), 'px' );

		$css->set_selector( '.menu-item-has-children ul .dropdown-menu-toggle' );
		$css->add_property( 'padding-top', absint( $settings['sub_menu_item_height'] ), absint( $defaults['sub_menu_item_height'] ), 'px' );
		$css->add_property( 'padding-bottom', absint( $settings['sub_menu_item_height'] ), absint( $defaults['sub_menu_item_height'] ), 'px' );
		$css->add_property( 'margin-top', '-' . absint( $settings['sub_menu_item_height'] ), '-' . absint( $defaults['sub_menu_item_height'] ), 'px' );

		$css->set_selector( '.rtl .main-navigation .main-nav ul li.menu-item-has-children > a' );
		$css->add_property( 'padding-right', absint( $settings['menu_item'] ), false, 'px' );

		$css->set_selector( '.widget-area .widget' );
		$css->add_property( 'padding', generate_padding_css( $settings['widget_top'], $settings['widget_right'], $settings['widget_bottom'], $settings['widget_left'] ), generate_padding_css( $defaults['widget_top'], $defaults['widget_right'], $defaults['widget_bottom'], $defaults['widget_left'] ) );

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.footer-widgets-container' );
			$css->add_property( 'padding', generate_padding_css( $settings['footer_widget_container_top'], $settings['footer_widget_container_right'], $settings['footer_widget_container_bottom'], $settings['footer_widget_container_left'] ), generate_padding_css( $defaults['footer_widget_container_top'], $defaults['footer_widget_container_right'], $defaults['footer_widget_container_bottom'], $defaults['footer_widget_container_left'] ) );

			if ( 'boxes' === generate_get_option( 'container_alignment' ) ) {
				$footer_widgets_padding = absint( $settings['footer_widget_container_right'] ) + absint( $settings['footer_widget_container_left'] );

				$css->set_selector( '.footer-widgets-container.grid-container' );
				$css->add_property( 'max-width', generate_get_option( 'container_width' ) + $footer_widgets_padding, false, 'px' );
			}
		} else {
			$css->set_selector( '.footer-widgets' );
			$css->add_property( 'padding', generate_padding_css( $settings['footer_widget_container_top'], $settings['footer_widget_container_right'], $settings['footer_widget_container_bottom'], $settings['footer_widget_container_left'] ), generate_padding_css( $defaults['footer_widget_container_top'], $defaults['footer_widget_container_right'], $defaults['footer_widget_container_bottom'], $defaults['footer_widget_container_left'] ) );
		}

		$css->set_selector( '.site-footer .footer-widgets-container .inner-padding' );
		$css->add_property( 'padding', generate_padding_css( '0', '0', '0', $settings['footer_widget_separator'] ), generate_padding_css( '0', '0', '0', $defaults['footer_widget_separator'] ) );

		$css->set_selector( '.site-footer .footer-widgets-container .inside-footer-widgets' );
		$css->add_property( 'margin-left', '-' . absint( $settings['footer_widget_separator'] ), '-' . absint( $defaults['footer_widget_separator'] ), 'px' );

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.inside-site-info' );
			$css->add_property( 'padding', generate_padding_css( $settings['footer_top'], $settings['footer_right'], $settings['footer_bottom'], $settings['footer_left'] ), generate_padding_css( $defaults['footer_top'], $defaults['footer_right'], $defaults['footer_bottom'], $defaults['footer_left'] ) );

			if ( 'boxes' === generate_get_option( 'container_alignment' ) ) {
				$site_info_padding = absint( $settings['footer_right'] ) + absint( $settings['footer_left'] );

				$css->set_selector( '.inside-site-info.grid-container' );
				$css->add_property( 'max-width', generate_get_option( 'container_width' ) + $site_info_padding, false, 'px' );
			}
		} else {
			$css->set_selector( '.site-info' );
			$css->add_property( 'padding', generate_padding_css( $settings['footer_top'], $settings['footer_right'], $settings['footer_bottom'], $settings['footer_left'] ), generate_padding_css( $defaults['footer_top'], $defaults['footer_right'], $defaults['footer_bottom'], $defaults['footer_left'] ) );
		}

		$css->start_media_query( generate_get_media_query( 'mobile' ) );
		$css->set_selector( '.separate-containers .inside-article, .separate-containers .comments-area, .separate-containers .page-header, .separate-containers .paging-navigation, .one-container .site-content, .inside-page-header' );
		$css->add_property( 'padding', generate_padding_css( $settings['mobile_content_top'], $settings['mobile_content_right'], $settings['mobile_content_bottom'], $settings['mobile_content_left'] ) );

		if ( apply_filters( 'generate_do_group_inner_container_style', true ) ) {
			$css->set_selector( '.site-main .wp-block-group__inner-container' );
			$css->add_property( 'padding', generate_padding_css( $settings['mobile_content_top'], $settings['mobile_content_right'], $settings['mobile_content_bottom'], $settings['mobile_content_left'] ) );
		}

		$css->set_selector( '.inside-top-bar' );

		if ( '' !== $settings['mobile_top_bar_top'] ) {
			$css->add_property( 'padding-top', absint( $settings['mobile_top_bar_top'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_top_bar_right'] ) {
			$css->add_property( 'padding-right', absint( $settings['mobile_top_bar_right'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_top_bar_bottom'] ) {
			$css->add_property( 'padding-bottom', absint( $settings['mobile_top_bar_bottom'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_top_bar_left'] ) {
			$css->add_property( 'padding-left', absint( $settings['mobile_top_bar_left'] ), false, 'px' );
		}

		$css->set_selector( '.inside-header' );

		if ( '' !== $settings['mobile_header_top'] ) {
			$css->add_property( 'padding-top', absint( $settings['mobile_header_top'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_header_right'] ) {
			$css->add_property( 'padding-right', absint( $settings['mobile_header_right'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_header_bottom'] ) {
			$css->add_property( 'padding-bottom', absint( $settings['mobile_header_bottom'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_header_left'] ) {
			$css->add_property( 'padding-left', absint( $settings['mobile_header_left'] ), false, 'px' );
		}

		$css->set_selector( '.widget-area .widget' );
		if ( '' !== $settings['mobile_widget_top'] ) {
			$css->add_property( 'padding-top', absint( $settings['mobile_widget_top'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_widget_right'] ) {
			$css->add_property( 'padding-right', absint( $settings['mobile_widget_right'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_widget_bottom'] ) {
			$css->add_property( 'padding-bottom', absint( $settings['mobile_widget_bottom'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_widget_left'] ) {
			$css->add_property( 'padding-left', absint( $settings['mobile_widget_left'] ), false, 'px' );
		}

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.footer-widgets-container' );
		} else {
			$css->set_selector( '.footer-widgets' );
		}

		if ( '' !== $settings['mobile_footer_widget_container_top'] ) {
			$css->add_property( 'padding-top', absint( $settings['mobile_footer_widget_container_top'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_footer_widget_container_right'] ) {
			$css->add_property( 'padding-right', absint( $settings['mobile_footer_widget_container_right'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_footer_widget_container_bottom'] ) {
			$css->add_property( 'padding-bottom', absint( $settings['mobile_footer_widget_container_bottom'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_footer_widget_container_left'] ) {
			$css->add_property( 'padding-left', absint( $settings['mobile_footer_widget_container_left'] ), false, 'px' );
		}

		if ( generate_is_using_flexbox() ) {
			$css->set_selector( '.inside-site-info' );
		} else {
			$css->set_selector( '.site-info' );
		}

		if ( '' !== $settings['mobile_footer_top'] ) {
			$css->add_property( 'padding-top', absint( $settings['mobile_footer_top'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_footer_right'] ) {
			$css->add_property( 'padding-right', absint( $settings['mobile_footer_right'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_footer_bottom'] ) {
			$css->add_property( 'padding-bottom', absint( $settings['mobile_footer_bottom'] ), false, 'px' );
		}

		if ( '' !== $settings['mobile_footer_left'] ) {
			$css->add_property( 'padding-left', absint( $settings['mobile_footer_left'] ), false, 'px' );
		}

		$mobile_content_padding = absint( $settings['mobile_content_right'] ) + absint( $settings['mobile_content_left'] );
		$css->set_selector( '.entry-content .alignwide, body:not(.no-sidebar) .entry-content .alignfull' );
		$css->add_property( 'margin-left', '-' . absint( $settings['mobile_content_left'] ) . 'px' );
		$css->add_property( 'width', 'calc(100% + ' . absint( $mobile_content_padding ) . 'px)' );
		$css->add_property( 'max-width', 'calc(100% + ' . absint( $mobile_content_padding ) . 'px)' );

		if ( '' !== $settings['mobile_separator'] ) {
			if ( generate_is_using_flexbox() ) {
				$css->set_selector( '.sidebar .widget, .page-header, .widget-area .main-navigation, .site-main > *' );
			} else {
				$css->set_selector( '.separate-containers .widget, .separate-containers .site-main > *, .separate-containers .page-header' );
			}

			$css->add_property( 'margin-bottom', absint( $settings['mobile_separator'] ), false, 'px' );

			$css->set_selector( '.separate-containers .site-main' );
			$css->add_property( 'margin', absint( $settings['mobile_separator'] ), false, 'px' );

			if ( generate_is_using_flexbox() ) {
				$css->set_selector( '.separate-containers .featured-image' );
			} else {
				$css->set_selector( '.separate-containers .page-header-image, .separate-containers .page-header-image-single' );
			}

			$css->add_property( 'margin-top', absint( $settings['mobile_separator'] ), false, 'px' );

			$css->set_selector( '.separate-containers .inside-right-sidebar, .separate-containers .inside-left-sidebar' );
			$css->add_property( 'margin-top', absint( $settings['mobile_separator'] ), false, 'px' );
			$css->add_property( 'margin-bottom', absint( $settings['mobile_separator'] ), false, 'px' );

			if ( generate_is_using_flexbox() ) {
				$css->set_selector( '.one-container .site-main .paging-navigation' );
				$css->add_property( 'margin-bottom', absint( $settings['mobile_separator'] ), false, 'px' );
			}
		} else {
			if ( generate_is_using_flexbox() ) {
				$css->set_selector( '.one-container .site-main .paging-navigation' );
				$css->add_property( 'margin-bottom', absint( $settings['separator'] ), false, 'px' );
			}
		}
		$css->stop_media_query();

		// Add spacing back where dropdown arrow should be.
		// Old versions of WP don't get nice things.
		if ( version_compare( $GLOBALS['wp_version'], '4.4', '<' ) ) {
			$css->set_selector( '.main-navigation .main-nav ul li.menu-item-has-children>a, .secondary-navigation .main-nav ul li.menu-item-has-children>a' );
			$css->add_property( 'padding-right', absint( $settings['menu_item'] ), absint( $defaults['menu_item'] ), 'px' );
		}

		$output = '';

		if ( ! generate_is_using_flexbox() ) {
			$generate_settings = wp_parse_args(
				get_option( 'generate_settings', array() ),
				generate_get_color_defaults()
			);

			// Find out if the content background color and sidebar widget background color is the same.
			$sidebar = strtoupper( $generate_settings['sidebar_widget_background_color'] );
			$content = strtoupper( $generate_settings['content_background_color'] );

			// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
			$colors_match = ( ( $sidebar == $content ) || '' == $sidebar ) ? true : false;

			// If they're all 40 (default), remove the padding when one container is set.
			// This way, the user can still adjust the padding and it will work (unless they want 40px padding).
			// We'll also remove the padding if there's no color difference between the widgets and content background color.
			// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
			if ( ( '40' == $settings['widget_top'] && '40' == $settings['widget_right'] && '40' == $settings['widget_bottom'] && '40' == $settings['widget_left'] ) && $colors_match ) {
				$output .= '.one-container .sidebar .widget{padding:0px;}';
			}
		}

		do_action( 'generate_spacing_css', $css );

		return apply_filters( 'generate_spacing_css_output', $css->css_output() . $output );
	}
}

/**
 * Generates any CSS that can't be cached (can change from page to page).
 *
 * @since 2.0
 */
function generate_no_cache_dynamic_css() {
	$css = new GeneratePress_CSS();

	if ( generate_is_using_flexbox() ) {
		$right_sidebar_width = apply_filters( 'generate_right_sidebar_width', '30' );
		$left_sidebar_width = apply_filters( 'generate_left_sidebar_width', '30' );

		$css->set_selector( '.is-right-sidebar' );
		$css->add_property( 'width', absint( $right_sidebar_width ) . '%' );

		$css->set_selector( '.is-left-sidebar' );
		$css->add_property( 'width', absint( $left_sidebar_width ) . '%' );

		$content_width = 100;
		$sidebar_layout = generate_get_layout();

		switch ( $sidebar_layout ) {
			case 'right-sidebar':
				$content_width = $content_width - absint( $right_sidebar_width );
				break;

			case 'left-sidebar':
				$content_width = $content_width - absint( $left_sidebar_width );
				break;

			case 'both-sidebars':
			case 'both-right':
			case 'both-left':
				$content_width = $content_width - absint( $right_sidebar_width ) - absint( $left_sidebar_width );
				break;
		}

		$css->set_selector( '.site-content .content-area' );
		$css->add_property( 'width', absint( $content_width ) . '%' );
	}

	$css->start_media_query( generate_get_media_query( 'mobile-menu' ) );

	if ( generate_is_using_flexbox() ) {
		$css->set_selector( '.main-navigation .menu-toggle,.sidebar-nav-mobile:not(#sticky-placeholder)' );
		$css->add_property( 'display', 'block' );

		$css->set_selector( '.main-navigation ul,.gen-sidebar-nav,.main-navigation:not(.slideout-navigation):not(.toggled) .main-nav > ul,.has-inline-mobile-toggle #site-navigation .inside-navigation > *:not(.navigation-search):not(.main-nav)' );
		$css->add_property( 'display', 'none' );

		$css->set_selector( '.nav-align-right .inside-navigation,.nav-align-center .inside-navigation' );
		$css->add_property( 'justify-content', 'space-between' );

		if ( is_rtl() ) {
			$css->set_selector( '.rtl .nav-align-right .inside-navigation,.rtl .nav-align-center .inside-navigation, .rtl .nav-align-left .inside-navigation' );
			$css->add_property( 'justify-content', 'space-between' );
		}

		if ( generate_has_inline_mobile_toggle() ) {
			$css->set_selector( '.has-inline-mobile-toggle .mobile-menu-control-wrapper' );
			$css->add_property( 'display', 'flex' );
			$css->add_property( 'flex-wrap', 'wrap' );

			$css->set_selector( '.has-inline-mobile-toggle .inside-header' );
			$css->add_property( 'flex-direction', 'row' );
			$css->add_property( 'text-align', 'left' );
			$css->add_property( 'flex-wrap', 'wrap' );

			$css->set_selector( '.has-inline-mobile-toggle .header-widget,.has-inline-mobile-toggle #site-navigation' );
			$css->add_property( 'flex-basis', '100%' );

			$css->set_selector( '.nav-float-left .has-inline-mobile-toggle #site-navigation' );
			$css->add_property( 'order', '10' );
		}
	} else {
		$css->set_selector( '.main-navigation .menu-toggle,.main-navigation .mobile-bar-items,.sidebar-nav-mobile:not(#sticky-placeholder)' );
		$css->add_property( 'display', 'block' );

		$css->set_selector( '.main-navigation ul,.gen-sidebar-nav' );
		$css->add_property( 'display', 'none' );

		$css->set_selector( '[class*="nav-float-"] .site-header .inside-header > *' );
		$css->add_property( 'float', 'none' );
		$css->add_property( 'clear', 'both' );
	}

	$css->stop_media_query();

	return $css->css_output();
}

/**
 * Get all of our dynamic CSS to be cached/added to a file.
 *
 * @since 3.0.0
 */
function generate_get_dynamic_css() {
	if ( generate_is_using_dynamic_typography() ) {
		$typography_css = GeneratePress_Typography::get_css();
	} else {
		$typography_css = generate_font_css();
	}

	$css = generate_base_css() . $typography_css . generate_advanced_css() . generate_spacing_css();

	return apply_filters( 'generate_dynamic_css', $css );
}

add_action( 'wp_enqueue_scripts', 'generate_enqueue_dynamic_css', 50 );
/**
 * Enqueue our dynamic CSS.
 *
 * @since 2.0
 */
function generate_enqueue_dynamic_css() {
	if ( apply_filters( 'generate_using_dynamic_css_external_file', false ) ) {
		$css = '';
	} elseif ( ! get_option( 'generate_dynamic_css_output', false ) || is_customize_preview() || apply_filters( 'generate_dynamic_css_skip_cache', false ) ) {
		$css = generate_get_dynamic_css();
	} else {
		$css = get_option( 'generate_dynamic_css_output' ) . '/* End cached CSS */';
	}

	$css = $css . generate_no_cache_dynamic_css();

	wp_add_inline_style( 'generate-style', wp_strip_all_tags( $css ) );
}

add_action( 'init', 'generate_set_dynamic_css_cache' );
/**
 * Sets our dynamic CSS cache if it doesn't exist.
 *
 * If the theme version changed, bust the cache.
 *
 * @since 2.0
 */
function generate_set_dynamic_css_cache() {
	if ( apply_filters( 'generate_dynamic_css_skip_cache', false ) ) {
		return;
	}

	$cached_css = get_option( 'generate_dynamic_css_output', false );
	$cached_version = get_option( 'generate_dynamic_css_cached_version', '' );

	if ( ! $cached_css || GENERATE_VERSION !== $cached_version ) {
		$css = generate_get_dynamic_css();

		update_option( 'generate_dynamic_css_output', wp_strip_all_tags( $css ) );
		update_option( 'generate_dynamic_css_cached_version', esc_html( GENERATE_VERSION ) );
	}
}

add_action( 'customize_save_after', 'generate_update_dynamic_css_cache' );
/**
 * Update our CSS cache when done saving Customizer options.
 *
 * @since 2.0
 */
function generate_update_dynamic_css_cache() {
	if ( apply_filters( 'generate_dynamic_css_skip_cache', false ) ) {
		return;
	}

	$css = generate_get_dynamic_css();
	update_option( 'generate_dynamic_css_output', wp_strip_all_tags( $css ) );
}
