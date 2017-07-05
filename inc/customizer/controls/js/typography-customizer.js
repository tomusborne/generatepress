( function( api ) {

	api.controlConstructor['gp-customizer-typography'] = api.Control.extend( {
		ready: function() {
			var control = this;

			control.container.on( 'change', '.generatepress-font-family select',
				function() {
					var _this = jQuery( this ),
						_value = _this.val(),
						_categoryID = _this.attr( 'data-category' ),
						_variantsID = _this.attr( 'data-variants' );
						
					// Set our font family
					control.settings['family'].set( _this.val() );
						
					// Bail if our controls don't exist
					if ( 'undefined' == typeof control.settings['category'] || 'undefined' == typeof control.settings['variant'] ) {
						return;
					}
					
					// Send our request to the generate_get_all_google_fonts_ajax function
					var response = jQuery.getJSON({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'generate_get_all_google_fonts_ajax',
							gp_customize_nonce: gp_customize.nonce
						},
						async: false,
						dataType: 'json',
					});
					
					// Get our response
					var fonts = response.responseJSON;
					
					// Create an ID from our selected font
					var id = _value.split(' ').join('_').toLowerCase();
					
					// Set our values if we have them
					if ( id in fonts ) {
						control.settings[ 'category' ].set( fonts[ id ].category )
						control.settings[ 'variant' ].set( fonts[ id ].variants.join( ',' ) )
						jQuery( 'input[name="' + _categoryID + '"' ).val( fonts[ id ].category );
						jQuery( 'input[name="' + _variantsID + '"' ).val( fonts[ id ].variants.join( ',' ) );
					} else {
						control.settings[ 'category' ].set( '' )
						control.settings[ 'variant' ].set( '' )
						jQuery( 'input[name="' + _categoryID + '"' ).val( '' );
						jQuery( 'input[name="' + _variantsID + '"' ).val( '' );
					}
				}
			);
			
			control.container.on( 'change', '.generatepress-font-variant input',
				function() {
					control.settings['variant'].set( jQuery( this ).val() );
				}
			);
			
			control.container.on( 'change', '.generatepress-font-category input',
				function() {
					control.settings['category'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.generatepress-font-weight select',
				function() {
					control.settings['weight'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.generatepress-font-transform select',
				function() {
					control.settings['transform'].set( jQuery( this ).val() );
				}
			);

		}
	} );

} )( wp.customize );