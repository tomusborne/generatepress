jQuery( document ).ready( function( $ ) {
	var container_width_elements = 'body .wp-block,\
									html body.gutenberg-editor-page .editor-post-title__block,\
	 								html body.gutenberg-editor-page .editor-default-block-appender,\
									html body.gutenberg-editor-page .editor-block-list__block,\
									.edit-post-visual-editor .editor-block-list__block[data-align=wide]';

	$( 'input[name="_generate-full-width-content"]' ).on( 'change', function() {
		if ( 'true' === this.value ) {
			$( 'style#container_width' ).remove();
			$( 'head' ).append( '<style id="container_width">' + container_width_elements + '{max-width: 100%;}</style>' );
		} else {
			$( 'style#container_width' ).remove();
		}
	} );

	$( 'input[name="_generate-sidebar-layout-meta"]' ).on( 'change', function() {
		if ( 'true' !== $( 'input[name="_generate-full-width-content"]:checked' ).val() ) {
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

	var disable_content_title_input = $( '#meta-generate-disable-headline' );
	var disable_content_title_button = $( 'button.content-title-visibility' );
	var body = $( 'body' );

	if ( 'false' === generate_block_editor.content_title ) {
		body.addClass( 'content-title-hidden' );
	}

	disable_content_title_input.on( 'change', function() {
		if ( this.checked ) {
			body.addClass( 'content-title-hidden' );
		} else {
			body.removeClass( 'content-title-hidden' );
		}
	} );

	$( document ).on( 'click', 'button.content-title-visibility', function() {
		var _this = $( this );

		if ( disable_content_title_input.prop( 'checked' ) ) {
			disable_content_title_input.prop( 'checked', false );
			body.removeClass( 'content-title-hidden' );
		} else {
			disable_content_title_input.prop( 'checked', true );
			body.addClass( 'content-title-hidden' );
		}
	} );

	if ( generate_block_editor.show_editor_styles ) {
		var text_color = tinycolor( generate_block_editor.text_color ).toHex8(),
			isTextDark = tinycolor( text_color ).isDark();

		if ( ! isTextDark ) {
			$( 'body' ).addClass( 'is-dark-theme' );
		}
	}
} );

jQuery( window ).load( function() {
	var post_title_block = jQuery( '.editor-post-title__block' );

	if ( post_title_block ) {
		post_title_block.append( '<button class="content-title-visibility disable-content-title" title="' + generate_block_editor.disable_content_title + '" aria-hidden="true"></button>' );
		post_title_block.append( '<button class="content-title-visibility show-content-title" title="' + generate_block_editor.show_content_title + '" aria-hidden="true"></button>' );
	}
} );
