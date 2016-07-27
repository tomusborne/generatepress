jQuery(document).ready(function($){
	"use strict";

	// remove the image when the remove link is clicked
	$('body').on('click', '.generate-upload .remove', function(event) {
		event.preventDefault();
		var _container = $(this).parents('.generate-upload');
		var _input = $(this).parents('.generate-upload').find('input');
				
		_container.find('.remove').hide();
		_input.val('').trigger('change');

		return false;
	});


	// open the upload media lightbox when the upload button is clicked
	$('body').on('click', '.generate-upload .upload', function(event) {
		event.preventDefault();
		
		 if ( frame ) {
			frame.open();
			return;
		}

		var _input = $(this).parents('.generate-upload').find('input');
		var _remove = $(this).siblings('.generate-upload .remove');

		// uploader frame properties
		var frame = wp.media({
			title: jQuery( this ).data( 'title' ),
			multiple: false,
			library: { type: 'image' },
			button : { text : jQuery( this ).data( 'button' ), }
		});

		// get the url when done
		frame.on('select', function() {

			var attachment = frame.state().get('selection').first().toJSON();
			_input.val(attachment.url);
			_input.trigger('change');
			_remove.show();
					
		});

		// open the uploader
		frame.open();

		return false;
	});
});