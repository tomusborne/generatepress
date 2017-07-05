( function( $, api ) {
	api.controlConstructor['gp-customizer-fonts'] = api.Control.extend( {
		ready: function() {
			var control = this;
			$( 'select', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );
	
	api.controlConstructor['gp-typography-select'] = api.Control.extend( {
		ready: function() {
			var control = this;
			$( 'select', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );
	
	api.controlConstructor['gp-typography-slider'] = api.Control.extend( {
		ready: function() {
			var control = this;
			$( '.slider-input', control.container ).on( 'change keyup input',
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );
	
	api.controlConstructor['gp-hidden-input'] = api.Control.extend( {
		ready: function() {
			var control = this;
			$( '.gp-hidden-input', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );
} )( jQuery, wp.customize );

jQuery( document ).ready( function($) {
	jQuery( '#customize-control-google_font_body_control select' ).on( 'change', function() {
		
		// Bail if our controls don't exist
		if ( 'undefined' == typeof wp.customize.control( 'font_body_category' ) || 'undefined' == typeof wp.customize.control( 'font_body_variants' ) )
			return;
		
		// Get the value of our select
		var _this = $( this ).val();
		
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
		var id = _this.split(' ').join('_').toLowerCase();
		
		// Set our values if we have them
		if ( id in fonts ) {
			wp.customize.control( 'font_body_category' ).setting.set( fonts[ id ].category )
			wp.customize.control( 'font_body_variants' ).setting.set( fonts[ id ].variants.join( ',' ) )
			$( 'input[name="font_body_category"' ).val( fonts[ id ].category );
			$( 'input[name="font_body_variants"' ).val( fonts[ id ].variants.join( ',' ) );
		} else {
			wp.customize.control( 'font_body_category' ).setting.set( '' )
			wp.customize.control( 'font_body_variants' ).setting.set( '' )
			$( 'input[name="font_body_category"' ).val( '' );
			$( 'input[name="font_body_variants"' ).val( '' );
		}
	});
});