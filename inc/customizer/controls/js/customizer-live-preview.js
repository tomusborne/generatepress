/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @param id
 * @param selector
 * @param property
 * @param default_value
 * @param get_value
 */
function generatepress_colors_live_update( id, selector, property, default_value, get_value ) {
	default_value = typeof default_value !== 'undefined' ? default_value : 'initial';
	get_value = typeof get_value !== 'undefined' ? get_value : '';

	wp.customize( 'generate_settings[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			default_value = ( '' !== get_value ) ? wp.customize.value( 'generate_settings[' + get_value + ']' )() : default_value;
			newval = ( '' !== newval ) ? newval : default_value;

			if ( jQuery( 'style#' + id ).length ) {
				jQuery( 'style#' + id ).html( selector + '{' + property + ':' + newval + ';}' );
			} else {
				jQuery( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + newval + '}</style>' );
				setTimeout( function() {
					jQuery( 'style#' + id ).not( ':last' ).remove();
				}, 1000 );
			}
		} );
	} );
}

function generatepress_classes_live_update( id, classes, selector, prefix ) {
	classes = typeof classes !== 'undefined' ? classes : '';
	prefix = typeof prefix !== 'undefined' ? prefix : '';
	wp.customize( 'generate_settings[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			jQuery.each( classes, function( i, v ) {
				jQuery( selector ).removeClass( prefix + v );
			} );
			jQuery( selector ).addClass( prefix + newval );
		} );
	} );
}

function generatepress_typography_live_update( id, selector, property, unit, media, settings ) {
	settings = typeof settings !== 'undefined' ? settings : 'generate_settings';
	wp.customize( settings + '[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			// Get our unit if applicable
			unit = typeof unit !== 'undefined' ? unit : '';

			var isTablet = ( 'tablet' == id.substring( 0, 6 ) ) ? true : false,
				isMobile = ( 'mobile' == id.substring( 0, 6 ) ) ? true : false;

			if ( isTablet ) {
				if ( '' == wp.customize( settings + '[' + id + ']' ).get() ) {
					var desktopID = id.replace( 'tablet_', '' );
					newval = wp.customize( settings + '[' + desktopID + ']' ).get();
				}
			}

			if ( isMobile ) {
				if ( '' == wp.customize( settings + '[' + id + ']' ).get() ) {
					var desktopID = id.replace( 'mobile_', '' );
					newval = wp.customize( settings + '[' + desktopID + ']' ).get();
				}
			}

			if ( 'buttons_font_size' == id && '' == wp.customize( 'generate_settings[buttons_font_size]' ).get() ) {
				newval = wp.customize( 'generate_settings[body_font_size]' ).get();
			}

			// We're using a desktop value
			if ( ! isTablet && ! isMobile ) {
				var tabletValue = ( typeof wp.customize( settings + '[tablet_' + id + ']' ) !== 'undefined' ) ? wp.customize( settings + '[tablet_' + id + ']' ).get() : '',
					mobileValue = ( typeof wp.customize( settings + '[mobile_' + id + ']' ) !== 'undefined' ) ? wp.customize( settings + '[mobile_' + id + ']' ).get() : '';

				// The tablet setting exists, mobile doesn't
				if ( '' !== tabletValue && '' == mobileValue ) {
					media = generatepress_live_preview.desktop + ', ' + generatepress_live_preview.mobile;
				}

				// The tablet setting doesn't exist, mobile does
				if ( '' == tabletValue && '' !== mobileValue ) {
					media = generatepress_live_preview.desktop + ', ' + generatepress_live_preview.tablet;
				}

				// The tablet setting doesn't exist, neither does mobile
				if ( '' == tabletValue && '' == mobileValue ) {
					media = generatepress_live_preview.desktop + ', ' + generatepress_live_preview.tablet + ', ' + generatepress_live_preview.mobile;
				}
			}

			// Check if media query
			media_query = typeof media !== 'undefined' ? 'media="' + media + '"' : '';

			jQuery( 'head' ).append( '<style id="' + id + '" ' + media_query + '>' + selector + '{' + property + ':' + newval + unit + ';}</style>' );
			setTimeout( function() {
				jQuery( 'style#' + id ).not( ':last' ).remove();
			}, 1000 );

			setTimeout( "jQuery('body').trigger('generate_spacing_updated');", 1000 );
		} );
	} );
}

( function( $ ) {
	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.main-title a' ).html( newval );
		} );
	} );

	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	wp.customize( 'generate_settings[logo_width]', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .header-image' ).css( 'width', newval + 'px' );

			if ( '' == newval ) {
				$( '.site-header .header-image' ).css( 'width', '' );
			}
		} );
	} );

	/**
	 * Container width
	 */
	wp.customize( 'generate_settings[container_width]', function( value ) {
		value.bind( function( newval ) {
			if ( jQuery( 'style#container_width' ).length ) {
				jQuery( 'style#container_width' ).html( 'body .grid-container, .wp-block-group__inner-container{max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width">body .grid-container, .wp-block-group__inner-container{max-width:' + newval + 'px;}</style>' );
				setTimeout( function() {
					jQuery( 'style#container_width' ).not( ':last' ).remove();
				}, 100 );
			}
			jQuery( 'body' ).trigger( 'generate_spacing_updated' );
		} );
	} );

	/**
	 * Live update for typography options.
	 * We only want to run this if GP Premium isn't already doing it.
	 */
	if ( 'undefined' === typeof gp_premium_typography_live_update ) {
		/**
		 * Body font size, weight and transform
		 */
		generatepress_typography_live_update( 'body_font_size', 'body, button, input, select, textarea', 'font-size', 'px' );
		generatepress_typography_live_update( 'body_line_height', 'body', 'line-height', '' );
		generatepress_typography_live_update( 'paragraph_margin', 'p, .entry-content > [class*="wp-block-"]:not(:last-child)', 'margin-bottom', 'em' );
		generatepress_typography_live_update( 'body_font_weight', 'body, button, input, select, textarea', 'font-weight' );
		generatepress_typography_live_update( 'body_font_transform', 'body, button, input, select, textarea', 'text-transform' );

		/**
		 * H1 font size, weight and transform
		 */
		generatepress_typography_live_update( 'heading_1_font_size', 'h1', 'font-size', 'px', generatepress_live_preview.desktop );
		generatepress_typography_live_update( 'mobile_heading_1_font_size', 'h1', 'font-size', 'px', generatepress_live_preview.mobile );
		generatepress_typography_live_update( 'heading_1_weight', 'h1', 'font-weight' );
		generatepress_typography_live_update( 'heading_1_transform', 'h1', 'text-transform' );
		generatepress_typography_live_update( 'heading_1_line_height', 'h1', 'line-height', 'em' );

		/**
		 * H2 font size, weight and transform
		 */
		generatepress_typography_live_update( 'heading_2_font_size', 'h2', 'font-size', 'px', generatepress_live_preview.desktop );
		generatepress_typography_live_update( 'mobile_heading_2_font_size', 'h2', 'font-size', 'px', generatepress_live_preview.mobile );
		generatepress_typography_live_update( 'heading_2_weight', 'h2', 'font-weight' );
		generatepress_typography_live_update( 'heading_2_transform', 'h2', 'text-transform' );
		generatepress_typography_live_update( 'heading_2_line_height', 'h2', 'line-height', 'em' );

		/**
		 * H3 font size, weight and transform
		 */
		generatepress_typography_live_update( 'heading_3_font_size', 'h3', 'font-size', 'px' );
		generatepress_typography_live_update( 'heading_3_weight', 'h3', 'font-weight' );
		generatepress_typography_live_update( 'heading_3_transform', 'h3', 'text-transform' );
		generatepress_typography_live_update( 'heading_3_line_height', 'h3', 'line-height', 'em' );
	}

	/**
	 * Top bar width
	 */
	wp.customize( 'generate_settings[top_bar_width]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full' == newval ) {
				$( '.top-bar' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
				if ( 'contained' == wp.customize.value( 'generate_settings[top_bar_inner_width]' )() ) {
					$( '.inside-top-bar' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
				}
			}
			if ( 'contained' == newval ) {
				$( '.top-bar' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
				$( '.inside-top-bar' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Inner top bar width
	 */
	wp.customize( 'generate_settings[top_bar_inner_width]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full' == newval ) {
				$( '.inside-top-bar' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
			if ( 'contained' == newval ) {
				$( '.inside-top-bar' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Top bar alignment
	 */
	generatepress_classes_live_update( 'top_bar_alignment', [ 'left', 'center', 'right' ], '.top-bar', 'top-bar-align-' );

	/**
	 * Header layout
	 */
	wp.customize( 'generate_settings[header_layout_setting]', function( value ) {
		value.bind( function( newval ) {
			if ( 'fluid-header' == newval ) {
				$( '.site-header' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
				if ( 'contained' == wp.customize.value( 'generate_settings[header_inner_width]' )() ) {
					$( '.inside-header' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
				}
			}
			if ( 'contained-header' == newval ) {
				$( '.site-header' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
				$( '.inside-header' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Inner Header layout
	 */
	wp.customize( 'generate_settings[header_inner_width]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full-width' == newval ) {
				$( '.inside-header' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
			if ( 'contained' == newval ) {
				$( '.inside-header' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Header alignment
	 */
	generatepress_classes_live_update( 'header_alignment_setting', [ 'left', 'center', 'right' ], 'body', 'header-aligned-' );

	/**
	 * Navigation width
	 */
	wp.customize( 'generate_settings[nav_layout_setting]', function( value ) {
		value.bind( function( newval ) {
			var navLocation = wp.customize.value( 'generate_settings[nav_position_setting]' )();

			if ( $( 'body' ).hasClass( 'sticky-enabled' ) ) {
				wp.customize.preview.send( 'refresh' );
			} else {
				var mainNavigation = $( '.main-navigation' );

				if ( 'fluid-nav' == newval ) {
					mainNavigation.removeClass( 'grid-container' ).removeClass( 'grid-parent' );
					if ( 'full-width' !== wp.customize.value( 'generate_settings[nav_inner_width]' )() ) {
						$( '.main-navigation .inside-navigation' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
					}
				}
				if ( 'contained-nav' == newval ) {
					if ( ! mainNavigation.hasClass( 'has-branding' ) && generatepress_live_preview.isFlex && ( 'nav-float-right' === navLocation || 'nav-float-left' === navLocation ) ) {
						return;
					}

					mainNavigation.addClass( 'grid-container' ).addClass( 'grid-parent' );
				}
			}
		} );
	} );

	/**
	 * Inner navigation width
	 */
	wp.customize( 'generate_settings[nav_inner_width]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full-width' == newval ) {
				$( '.main-navigation .inside-navigation' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
			if ( 'contained' == newval ) {
				$( '.main-navigation .inside-navigation' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Navigation alignment
	 */
	wp.customize( 'generate_settings[nav_alignment_setting]', function( value ) {
		value.bind( function( newval ) {
			var classes = [ 'left', 'center', 'right' ];
			var selector = 'body';
			var prefix = 'nav-aligned-';

			if ( generatepress_live_preview.isFlex ) {
				selector = '.main-navigation:not(.slideout-navigation)';
				prefix = 'nav-align-';
			}

			jQuery.each( classes, function( i, v ) {
				jQuery( selector ).removeClass( prefix + v );
			} );

			if ( generatepress_live_preview.isFlex && generatepress_live_preview.isRTL ) {
				jQuery( selector ).addClass( prefix + newval );
			} else if ( 'nav-align-left' !== prefix + newval ) {
				jQuery( selector ).addClass( prefix + newval );
			}
		} );
	} );

	/**
	 * Footer width
	 */
	wp.customize( 'generate_settings[footer_layout_setting]', function( value ) {
		value.bind( function( newval ) {
			if ( 'fluid-footer' == newval ) {
				$( '.site-footer' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
			if ( 'contained-footer' == newval ) {
				$( '.site-footer' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Inner footer width
	 */
	wp.customize( 'generate_settings[footer_inner_width]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full-width' == newval ) {
				if ( $( '.footer-widgets-container' ).length ) {
					$( '.footer-widgets-container' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
				} else {
					$( '.inside-footer-widgets' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
				}
				$( '.inside-site-info' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
			}
			if ( 'contained' == newval ) {
				if ( $( '.footer-widgets-container' ).length ) {
					$( '.footer-widgets-container' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
				} else {
					$( '.inside-footer-widgets' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
				}
				$( '.inside-site-info' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
			}
		} );
	} );

	/**
	 * Footer bar alignment
	 */
	generatepress_classes_live_update( 'footer_bar_alignment', [ 'left', 'center', 'right' ], '.site-footer', 'footer-bar-align-' );

	jQuery( 'body' ).on( 'generate_spacing_updated', function() {
		var containerAlignment = wp.customize( 'generate_settings[container_alignment]' ).get(),
			containerWidth = wp.customize( 'generate_settings[container_width]' ).get(),
			containerLayout = wp.customize( 'generate_settings[content_layout_setting]' ).get(),
			contentLeft = generatepress_live_preview.contentLeft,
			contentRight = generatepress_live_preview.contentRight;

		if ( ! generatepress_live_preview.isFlex && 'text' === containerAlignment ) {
			if ( typeof wp.customize( 'generate_spacing_settings[content_left]' ) !== 'undefined' ) {
				contentLeft = wp.customize( 'generate_spacing_settings[content_left]' ).get();
			}

			if ( typeof wp.customize( 'generate_spacing_settings[content_right]' ) !== 'undefined' ) {
				contentRight = wp.customize( 'generate_spacing_settings[content_right]' ).get();
			}

			var newContainerWidth = Number( containerWidth ) + Number( contentLeft ) + Number( contentRight );

			if ( jQuery( 'style#wide_container_width' ).length ) {
				jQuery( 'style#wide_container_width' ).html( 'body:not(.full-width-content) #page{max-width:' + newContainerWidth + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="wide_container_width">body:not(.full-width-content) #page{max-width:' + newContainerWidth + 'px;}</style>' );
				setTimeout( function() {
					jQuery( 'style#wide_container_width' ).not( ':last' ).remove();
				}, 100 );
			}
		}

		if ( generatepress_live_preview.isFlex && 'boxes' === containerAlignment ) {
			var topBarPaddingLeft = jQuery( '.inside-top-bar' ).css( 'padding-left' ),
				topBarPaddingRight = jQuery( '.inside-top-bar' ).css( 'padding-right' ),
				headerPaddingLeft = jQuery( '.inside-header' ).css( 'padding-left' ),
				headerPaddingRight = jQuery( '.inside-header' ).css( 'padding-right' ),
				footerWidgetPaddingLeft = jQuery( '.footer-widgets-container' ).css( 'padding-left' ),
				footerWidgetPaddingRight = jQuery( '.footer-widgets-container' ).css( 'padding-right' ),
				footerBarPaddingLeft = jQuery( '.inside-footer-bar' ).css( 'padding-left' ),
				footerBarPaddingRight = jQuery( '.inside-footer-bar' ).css( 'padding-right' );

			if ( typeof wp.customize( 'generate_spacing_settings[top_bar_left]' ) !== 'undefined' ) {
				topBarPaddingLeft = wp.customize( 'generate_spacing_settings[top_bar_left]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[top_bar_right]' ) !== 'undefined' ) {
				topBarPaddingRight = wp.customize( 'generate_spacing_settings[top_bar_right]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[header_left]' ) !== 'undefined' ) {
				headerPaddingLeft = wp.customize( 'generate_spacing_settings[header_left]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[header_right]' ) !== 'undefined' ) {
				headerPaddingRight = wp.customize( 'generate_spacing_settings[header_right]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[footer_widget_container_left]' ) !== 'undefined' ) {
				footerWidgetPaddingLeft = wp.customize( 'generate_spacing_settings[footer_widget_container_left]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[footer_widget_container_right]' ) !== 'undefined' ) {
				footerWidgetPaddingRight = wp.customize( 'generate_spacing_settings[footer_widget_container_right]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[footer_left]' ) !== 'undefined' ) {
				footerBarPaddingLeft = wp.customize( 'generate_spacing_settings[footer_left]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[footer_right]' ) !== 'undefined' ) {
				footerBarPaddingRight = wp.customize( 'generate_spacing_settings[footer_right]' ).get() + 'px';
			}

			var newTopBarWidth = parseFloat( containerWidth ) + parseFloat( topBarPaddingLeft ) + parseFloat( topBarPaddingRight ),
				newHeaderWidth = parseFloat( containerWidth ) + parseFloat( headerPaddingLeft ) + parseFloat( headerPaddingRight ),
				newFooterWidgetWidth = parseFloat( containerWidth ) + parseFloat( footerWidgetPaddingLeft ) + parseFloat( footerWidgetPaddingRight ),
				newFooterBarWidth = parseFloat( containerWidth ) + parseFloat( footerBarPaddingLeft ) + parseFloat( footerBarPaddingRight );

			if ( jQuery( 'style#box_sizing_widths' ).length ) {
				jQuery( 'style#box_sizing_widths' ).html( '.inside-top-bar.grid-container{max-width:' + newTopBarWidth + 'px;}.inside-header.grid-container{max-width:' + newHeaderWidth + 'px;}.footer-widgets-container.grid-container{max-width:' + newFooterWidgetWidth + 'px;}.inside-site-info.grid-container{max-width:' + newFooterBarWidth + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="box_sizing_widths">.inside-top-bar.grid-container{max-width:' + newTopBarWidth + 'px;}.inside-header.grid-container{max-width:' + newHeaderWidth + 'px;}.footer-widgets-container.grid-container{max-width:' + newFooterWidgetWidth + 'px;}.inside-site-info.grid-container{max-width:' + newFooterBarWidth + 'px;}</style>' );
				setTimeout( function() {
					jQuery( 'style#box_sizing_widths' ).not( ':last' ).remove();
				}, 100 );
			}
		}

		if ( generatepress_live_preview.isFlex && 'text' === containerAlignment ) {
			var headerPaddingLeft = jQuery( '.inside-header' ).css( 'padding-left' ),
				headerPaddingRight = jQuery( '.inside-header' ).css( 'padding-right' ),
				menuItemPadding = jQuery( '.main-navigation .main-nav ul li a' ).css( 'padding-left' ),
				secondaryMenuItemPadding = jQuery( '.secondary-navigation .main-nav ul li a' ).css( 'padding-left' );

			if ( typeof wp.customize( 'generate_spacing_settings[header_left]' ) !== 'undefined' ) {
				headerPaddingLeft = wp.customize( 'generate_spacing_settings[header_left]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[header_right]' ) !== 'undefined' ) {
				headerPaddingRight = wp.customize( 'generate_spacing_settings[header_right]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[menu_item]' ) !== 'undefined' ) {
				menuItemPadding = wp.customize( 'generate_spacing_settings[menu_item]' ).get() + 'px';
			}

			if ( typeof wp.customize( 'generate_spacing_settings[secondary_menu_item]' ) !== 'undefined' ) {
				secondaryMenuItemPadding = wp.customize( 'generate_spacing_settings[secondary_menu_item]' ).get() + 'px';
			}

			var newNavPaddingLeft = parseFloat( headerPaddingLeft ) - parseFloat( menuItemPadding ),
				newNavPaddingRight = parseFloat( headerPaddingRight ) - parseFloat( menuItemPadding ),
				newSecondaryNavPaddingLeft = parseFloat( headerPaddingLeft ) - parseFloat( secondaryMenuItemPadding ),
				newSecondaryNavPaddingRight = parseFloat( headerPaddingRight ) - parseFloat( secondaryMenuItemPadding );

			if ( jQuery( 'style#navigation_padding' ).length ) {
				jQuery( 'style#navigation_padding' ).html( '.nav-below-header .main-navigation .inside-navigation.grid-container, .nav-above-header .main-navigation .inside-navigation.grid-container{padding: 0 ' + newNavPaddingRight + 'px 0 ' + newNavPaddingLeft + 'px;}' );
				jQuery( 'style#secondary_navigation_padding' ).html( '.secondary-nav-below-header .secondary-navigation .inside-navigation.grid-container, .secondary-nav-above-header .secondary-navigation .inside-navigation.grid-container{padding: 0 ' + newSecondaryNavPaddingRight + 'px 0 ' + newSecondaryNavPaddingLeft + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="navigation_padding">.nav-below-header .main-navigation .inside-navigation.grid-container, .nav-above-header .main-navigation .inside-navigation.grid-container{padding: 0 ' + newNavPaddingRight + 'px 0 ' + newNavPaddingLeft + 'px;}</style>' );
				jQuery( 'head' ).append( '<style id="secondary_navigation_padding">.secondary-nav-below-header .secondary-navigation .inside-navigation.grid-container, .secondary-nav-above-header .secondary-navigation .inside-navigation.grid-container{padding: 0 ' + newSecondaryNavPaddingRight + 'px 0 ' + newSecondaryNavPaddingLeft + 'px;}</style>' );
				setTimeout( function() {
					jQuery( 'style#navigation_padding' ).not( ':last' ).remove();
					jQuery( 'style#secondary_navigation_padding' ).not( ':last' ).remove();
				}, 100 );
			}
		}
	} );
}( jQuery ) );
