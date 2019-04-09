/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
function generatepress_colors_live_update( id, selector, property, default_value, get_value ) {
	default_value = typeof default_value !== 'undefined' ? default_value : 'initial';
	get_value = typeof get_value !== 'undefined' ? get_value : '';

	wp.customize( 'generate_settings[' + id + ']', function( value ) {
		value.bind( function( newval ) {
			default_value = ( '' !== get_value ) ? wp.customize.value('generate_settings[' + get_value + ']')() : default_value;
			newval = ( '' !== newval ) ? newval : default_value;

			if ( jQuery( 'style#' + id ).length ) {
				jQuery( 'style#' + id ).html( selector + '{' + property + ':' + newval + ';}' );
			} else {
				jQuery( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + newval + '}</style>' );
				setTimeout(function() {
					jQuery( 'style#' + id ).not( ':last' ).remove();
				}, 1000);
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
			});
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
				if ( '' == wp.customize(settings + '[' + id + ']').get() ) {
					var desktopID = id.replace( 'tablet_', '' );
					newval = wp.customize(settings + '[' + desktopID + ']').get();
				}
			}

			if ( isMobile ) {
				if ( '' == wp.customize(settings + '[' + id + ']').get() ) {
					var desktopID = id.replace( 'mobile_', '' );
					newval = wp.customize(settings + '[' + desktopID + ']').get();
				}
			}

			if ( 'buttons_font_size' == id && '' == wp.customize('generate_settings[buttons_font_size]').get() ) {
				newval = wp.customize('generate_settings[body_font_size]').get();
			}

			// We're using a desktop value
			if ( ! isTablet && ! isMobile ) {

				var tabletValue = ( typeof wp.customize(settings + '[tablet_' + id + ']') !== 'undefined' ) ? wp.customize(settings + '[tablet_' + id + ']').get() : '',
					mobileValue = ( typeof wp.customize(settings + '[mobile_' + id + ']') !== 'undefined' ) ? wp.customize(settings + '[mobile_' + id + ']').get() : '';

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
			setTimeout(function() {
				jQuery( 'style#' + id ).not( ':last' ).remove();
			}, 1000);

			setTimeout("jQuery('body').trigger('generate_spacing_updated');", 1000);
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
	 * Body background color
	 * Empty:  white
	 */
	generatepress_colors_live_update( 'background_color', 'body', 'background-color', '#FFFFFF' );

	/**
	 * Text color
	 * Empty:  black
	 */
	generatepress_colors_live_update( 'text_color', 'body', 'color', '#000000' );

	/**
	 * Link color
	 * Empty:  initial
	 */
	generatepress_colors_live_update( 'link_color', 'a, a:visited', 'color', 'initial' );

	/**
	 * Link color hover
	 * Empty:  initial
	 */
	generatepress_colors_live_update( 'link_color_hover', 'a:hover', 'color', 'initial' );

	/**
	 * Live update for content & navigation colors thanks to our preset option.
	 * We only want to run this if GP Premium isn't already doing it.
	 */
	if ( 'undefined' == typeof generate_colors_live_update ) {
		/**
		 * Blog post title color
		 * Empty: Body link color
		 */
		generatepress_colors_live_update( 'blog_post_title_color', '.entry-title a, .entry-title a:visited', 'color', '', 'link_color' );

		/**
		 * Blog post title color on hover
		 * Empty: Body link color on hover
		 */
		generatepress_colors_live_update( 'blog_post_title_hover_color', '.entry-title a:hover', 'color', '', 'link_color_hover' );

		/**
		 * Navigation background color
		 * Empty: Transparent
		 */
		generatepress_colors_live_update( 'navigation_background_color', '.main-navigation', 'background-color', 'transparent' );

		/**
		 * Primary navigation text color
		 * Empty:  link_color
		 */
		generatepress_colors_live_update( 'navigation_text_color',
			'.main-navigation .main-nav ul li a,\
			.menu-toggle,button.menu-toggle:hover,\
			button.menu-toggle:focus,\
			.main-navigation .mobile-bar-items a,\
			.main-navigation .mobile-bar-items a:hover,\
			.main-navigation .mobile-bar-items a:focus',
			'color',
			'',
			'link_color'
		);

		/**
		 * Primary navigation text color hover
		 * Empty: link_color_hover
		 */
		generatepress_colors_live_update( 'navigation_text_hover_color',
			'.navigation-search input[type="search"],\
			.navigation-search input[type="search"]:active,\
			.navigation-search input[type="search"]:focus,\
			.main-navigation .main-nav ul li:hover > a,\
			.main-navigation .main-nav ul li:focus > a,\
			.main-navigation .main-nav ul li.sfHover > a',
			'color',
			'',
			'link_color_hover'
		);

		/**
		 * Primary navigation menu item hover
		 * Empty: transparent
		 */
		generatepress_colors_live_update( 'navigation_background_hover_color',
			'.navigation-search input[type="search"],\
			.navigation-search input[type="search"]:focus,\
			.main-navigation .main-nav ul li:hover > a,\
			.main-navigation .main-nav ul li:focus > a,\
			.main-navigation .main-nav ul li.sfHover > a',
			'background-color',
			'transparent'
		);

		/**
		 * Primary sub-navigation color
		 * Empty:  transparent
		 */
		generatepress_colors_live_update( 'subnavigation_background_color', '.main-navigation ul ul', 'background-color', 'transparent' );

		/**
		 * Primary sub-navigation text color
		 * Empty:  link_color
		 */
		generatepress_colors_live_update( 'subnavigation_text_color', '.main-navigation .main-nav ul ul li a', 'color', 'link_color' );

		/**
		 * Primary sub-navigation hover
		 */
		var subnavigation_hover = '.main-navigation .main-nav ul ul li:hover > a, \
			.main-navigation .main-nav ul ul li:focus > a, \
			.main-navigation .main-nav ul ul li.sfHover > a';

		/**
		 * Primary sub-navigation text hover
		 * Empty: link_color_hover
		 */
		generatepress_colors_live_update( 'subnavigation_text_hover_color', subnavigation_hover, 'color', '', 'link_color_hover' );

		/**
		 * Primary sub-navigation background hover
		 * Empty: transparent
		 */
		generatepress_colors_live_update( 'subnavigation_background_hover_color', subnavigation_hover, 'background-color', 'transparent' );

		/**
		 * Navigation current selectors
		 */
		var navigation_current = '.main-navigation .main-nav ul li[class*="current-menu-"] > a, \
		.main-navigation .main-nav ul li[class*="current-menu-"]:hover > a, \
		.main-navigation .main-nav ul li[class*="current-menu-"].sfHover > a';

		/**
		 * Primary navigation current text
		 * Empty: link_color
		 */
		generatepress_colors_live_update( 'navigation_text_current_color', navigation_current, 'color', '', 'link_color' );

		/**
		 * Primary navigation current background
		 * Empty: transparent
		 */
		generatepress_colors_live_update( 'navigation_background_current_color', navigation_current, 'background-color', 'transparent' );

		/**
		 * Primary sub-navigation current selectors
		 */
		var subnavigation_current = '.main-navigation .main-nav ul ul li[class*="current-menu-"] > a,\
			.main-navigation .main-nav ul ul li[class*="current-menu-"]:hover > a, \
			.main-navigation .main-nav ul ul li[class*="current-menu-"].sfHover > a';

		/**
		 * Primary sub-navigation current text
		 * Empty: link_color
		 */
		generatepress_colors_live_update( 'subnavigation_text_current_color', subnavigation_current, 'color', '', 'link_color' );

		/**
		 * Primary navigation current item background
		 * Empty: transparent
		 */
		generatepress_colors_live_update( 'subnavigation_background_current_color', subnavigation_current, 'background-color', 'transparent' );
	}

	/**
	 * Container width
	 */
	wp.customize( 'generate_settings[container_width]', function( value ) {
		value.bind( function( newval ) {
			if ( jQuery( 'style#container_width' ).length ) {
				jQuery( 'style#container_width' ).html( 'body .grid-container{max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width">body .grid-container{max-width:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#container_width' ).not( ':last' ).remove();
				}, 100);
			}
			jQuery('body').trigger('generate_spacing_updated');
		} );
	} );

	/**
	 * Live update for typography options.
	 * We only want to run this if GP Premium isn't already doing it.
	 */
	if ( 'undefined' == typeof gp_premium_typography_live_update ) {
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
	 * Content layout
	 */
	generatepress_classes_live_update( 'content_layout_setting', [ 'one-container', 'separate-containers' ], 'body' );

	/**
	 * Top bar width
	 */
	wp.customize( 'generate_settings[top_bar_width]', function( value ) {
		value.bind( function( newval ) {
			if ( 'full' == newval ) {
				$( '.top-bar' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
				if ( 'contained' == wp.customize.value('generate_settings[top_bar_inner_width]')() ) {
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
				if ( 'contained' == wp.customize.value('generate_settings[header_inner_width]')() ) {
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
			if ( $( 'body' ).hasClass( 'sticky-enabled' ) ) {
				wp.customize.preview.send( 'refresh' );
			} else {
				if ( 'fluid-nav' == newval ) {
					$( '.main-navigation' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
					if ( 'full-width' !== wp.customize.value('generate_settings[nav_inner_width]')() ) {
						$( '.main-navigation .inside-navigation' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
					}
				}
				if ( 'contained-nav' == newval ) {
					$( '.main-navigation' ).addClass( 'grid-container' ).addClass( 'grid-parent' );
					$( '.main-navigation .inside-navigation' ).removeClass( 'grid-container' ).removeClass( 'grid-parent' );
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
	 * Navigation position
	 */
	wp.customize( 'generate_settings[nav_position_setting]', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).trigger( 'generate_navigation_location_updated' );

			// Update navigation alignment settings.
			$( 'body' ).removeClass( 'nav-aligned-center' );
			$( 'body' ).removeClass( 'nav-aligned-left' );
			$( 'body' ).removeClass( 'nav-aligned-right' );
			$( 'body' ).addClass( 'nav-aligned-' + wp.customize.value('generate_settings[nav_alignment_setting]')() );

			if ( $( '.gen-sidebar-nav' ).length ) {
				wp.customize.preview.send( 'refresh' );
				return false;
			}
			if ( 'nav-left-sidebar' == newval ) {
				wp.customize.preview.send( 'refresh' );
				return false;
			}
			if ( 'nav-right-sidebar' == newval ) {
				wp.customize.preview.send( 'refresh' );
				return false;
			}

			if ( '' !== wp.customize.value('generate_settings[nav_drop_point]')() ) {
				wp.customize.preview.send( 'refresh' );
				return false;
			}

			var classes = [ 'nav-below-header', 'nav-above-header', 'nav-float-right', 'nav-float-left', 'nav-left-sidebar', 'nav-right-sidebar' ];
			if ( 'nav-left-sidebar' !== newval && 'nav-right-sidebar' !== newval ) {
				$.each( classes, function( i, v ) {
					$( 'body' ).removeClass( v );
				});
			}
			$( 'body' ).addClass( newval );
			if ( 'nav-below-header' == newval ) {
				$( '#site-navigation:first' ).insertAfter( '.site-header' ).show();
			}
			if ( 'nav-above-header' == newval ) {
				if ( $( '.top-bar:not(.secondary-navigation .top-bar)' ).length ) {
					$( '#site-navigation:first' ).insertAfter( '.top-bar' ).show();
				} else {
					$( '#site-navigation:first' ).prependTo( 'body' ).show();
				}
			}
			if ( 'nav-float-right' == newval ) {
				if ( ! $( 'body' ).hasClass( 'using-floats' ) && $( '.header-widget' ).length ) {
					$( '#site-navigation:first' ).insertBefore( '.header-widget' ).show();
				} else {
					$( '#site-navigation:first' ).appendTo( '.inside-header' ).show();
				}
			}
			if ( 'nav-float-left' == newval ) {
				$( '#site-navigation:first' ).appendTo( '.inside-header' ).show();
			}
			if ( '' == newval ) {
				if ( $( '.gen-sidebar-nav' ).length ) {
					wp.customize.preview.send( 'refresh' );
				} else {
					$( '#site-navigation:first' ).hide();
				}
			}
		} );
	} );

	/**
	 * Navigation alignment
	 */
	generatepress_classes_live_update( 'nav_alignment_setting', [ 'left', 'center', 'right' ], 'body', 'nav-aligned-' );

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
			contentLeft = generatepress_live_preview.contentLeft,
			contentRight = generatepress_live_preview.contentRight;

		if ( 'text' === containerAlignment ) {
			if ( typeof wp.customize( 'generate_spacing_settings[content_left]' ) !== 'undefined' ) {
				contentLeft = wp.customize( 'generate_spacing_settings[content_left]' ).get();
			}

			if ( typeof wp.customize( 'generate_spacing_settings[content_right]' ) !== 'undefined' ) {
				contentRight = wp.customize( 'generate_spacing_settings[content_right]' ).get();
			}

			var newContainerWidth = Number( containerWidth ) + Number( contentLeft ) + Number( contentRight );

			if ( jQuery( 'style#wide_container_width' ).length ) {
				jQuery( 'style#wide_container_width' ).html( '#page{max-width:' + newContainerWidth + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="wide_container_width">#page{max-width:' + newContainerWidth + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#wide_container_width' ).not( ':last' ).remove();
				}, 100);
			}
		}
	} );
} )( jQuery );
