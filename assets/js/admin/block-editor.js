jQuery( document ).ready( function( $ ) {
	var container_width_elements = 'body .wp-block,\
									html body.gutenberg-editor-page .editor-post-title__block,\
	 								html body.gutenberg-editor-page .editor-default-block-appender,\
									html body.gutenberg-editor-page .editor-block-list__block,\
									.edit-post-visual-editor .editor-block-list__block[data-align=wide]';

	$( 'select[name="_generate-full-width-content"]' ).on( 'change', function() {
		if ( 'true' === this.value ) {
			$( 'style#container_width' ).remove();
			$( 'head' ).append( '<style id="container_width">' + container_width_elements + '{max-width: 100%;}</style>' );
		} else {
			$( 'style#container_width' ).remove();
		}
	} );

	$( 'select[name="_generate-sidebar-layout-meta"]' ).on( 'change', function() {
		if ( 'true' !== $( this ).val() ) {
			var this_value = this.value,
				content_width = '',
				calc = '',
				container_width = generate_block_editor.container_width,
				right_sidebar_width = generate_block_editor.right_sidebar_width,
				left_sidebar_width = generate_block_editor.left_sidebar_width,
				right_content_padding = generate_block_editor.content_padding_right,
				left_content_padding = generate_block_editor.content_padding_left;

			if ( '' === this_value ) {
				this_value = generate_block_editor.global_sidebar_layout;
			}

			if ( 'left-sidebar' == this_value ) {
				content_width = container_width * ( ( 100 - left_sidebar_width ) / 100 );
			} else if ( 'right-sidebar' == this_value ) {
				content_width = container_width * ( ( 100 - right_sidebar_width ) / 100 );
			} else if ( 'no-sidebar' == this_value ) {
				content_width = container_width;
			} else {
				content_width = container_width * ( ( 100 - ( Number( left_sidebar_width ) + Number( right_sidebar_width ) ) ) / 100 );
			}

			calc = 'max-width: calc(' + content_width + 'px - ' + right_content_padding + ' - ' + left_content_padding + ')';

			$( 'style#content-width' ).remove();
			$( 'head' ).append( '<style id="content-width">' + container_width_elements + '{' + calc + '}</style>' );

			$( 'style#wide-width' ).remove();
			$( 'head' ).append( '<style id="wide-width">.edit-post-visual-editor .editor-block-list__block[data-align=wide]{max-width:' + content_width + 'px}' );
		}
	} );
} );

jQuery( window ).on( 'load', function() {
	// This is a fallback in case the core editor check for the dark theme fails.
	// If the background is using a gradient or rgba, the WP method can be wrong.
	// So instead, we check for text color, as it's a better indicator of the true background color.
	if ( generate_block_editor.show_editor_styles ) {
		var text_color = tinycolor( generate_block_editor.text_color ).toHex8(),
			isTextDark = tinycolor( text_color ).isDark();

		if ( ! isTextDark ) {
			document.body.classList.add( 'is-dark-theme' );
		} else {
			document.body.classList.remove( 'is-dark-theme' );
		}
	}
} );
