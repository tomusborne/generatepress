/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
function generatepress_colors_live_update( id, selector, property, default_value ) {
	default_value = typeof default_value !== 'undefined' ? default_value : 'initial';
	wp.customize( 'generate_settings[' + id + ']', function( value ) {
		value.bind( function( newval ) {
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
	 * Body font size
	 */
	wp.customize( 'generate_settings[body_font_size]', function( value ) {
		value.bind( function( newval ) {
			if ( jQuery( 'style#body_font_size' ).length ) {
				jQuery( 'style#body_font_size' ).html( 'body, button, input, select, textarea{font-size:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="body_font_size">body, button, input, select, textarea{font-size:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#body_font_size' ).not( ':last' ).remove();
				}, 100);
			}
			setTimeout("jQuery('body').trigger('generate_spacing_updated');", 1000);
		} );
	} );

	/**
	 * Body line height
	 */
	wp.customize( 'generate_settings[body_line_height]', function( value ) {
		value.bind( function( newval ) {
			if ( jQuery( 'style#body_line_height' ).length ) {
				jQuery( 'style#body_line_height' ).html( 'body{line-height:' + newval + ';}' );
			} else {
				jQuery( 'head' ).append( '<style id="body_line_height">body{line-height:' + newval + ';}</style>' );
				setTimeout(function() {
					jQuery( 'style#body_line_height' ).not( ':last' ).remove();
				}, 100);
			}
			setTimeout("jQuery('body').trigger('generate_spacing_updated');", 1000);
		} );
	} );

	/**
	 * Paragraph margin
	 */
	wp.customize( 'generate_settings[paragraph_margin]', function( value ) {
		value.bind( function( newval ) {
			if ( jQuery( 'style#paragraph_margin' ).length ) {
				jQuery( 'style#paragraph_margin' ).html( 'p{margin-bottom:' + newval + 'em;}' );
			} else {
				jQuery( 'head' ).append( '<style id="paragraph_margin">p{margin-bottom:' + newval + 'em;}</style>' );
				setTimeout(function() {
					jQuery( 'style#paragraph_margin' ).not( ':last' ).remove();
				}, 100);
			}
			setTimeout("jQuery('body').trigger('generate_spacing_updated');", 1000);
		} );
	} );

	/**
	 * Body font weight
	 */
	wp.customize( 'generate_settings[body_font_weight]', function( value ) {
		value.bind( function( newval ) {
			jQuery( 'head' ).append( '<style id="body_font_weight">body, button, input, select, textarea{font-weight:' + newval + ';}</style>' );
			setTimeout(function() {
				jQuery( 'style#body_font_weight' ).not( ':last' ).remove();
			}, 100);
		} );
	} );

	/**
	 * Body text transform
	 */
	wp.customize( 'generate_settings[body_font_transform]', function( value ) {
		value.bind( function( newval ) {
			jQuery( 'head' ).append( '<style id="body_font_transform">body, button, input, select, textarea{text-transform:' + newval + ';}</style>' );
			setTimeout(function() {
				jQuery( 'style#body_font_transform' ).not( ':last' ).remove();
			}, 100);
		} );
	} );

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
			jQuery('body').trigger('generate_navigation_location_updated');
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
				$( '#site-navigation:first' ).appendTo( '.inside-header' ).show();
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

} )( jQuery );