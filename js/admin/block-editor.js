jQuery( document ).ready( function( $ ) {
	var container_width_elements = 'html body.gutenberg-editor-page .editor-post-title__block,\
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
			var calc = '',
				container_width = generate_block_editor.container_width,
				right_sidebar_width = generate_block_editor.right_sidebar_width,
				left_sidebar_width = generate_block_editor.left_sidebar_width,
				both_sidebars_width = Number( right_sidebar_width ) + Number( left_sidebar_width );

			if ( 'right-sidebar' === this.value ) {
				calc = 'max-width: calc(' + container_width + 'px - ' + right_sidebar_width + '%);';
			} else if ( 'left-sidebar' === this.value ) {
				calc = 'max-width: calc(' + container_width + 'px - ' + left_sidebar_width + '%);';
			} else if ( 'no-sidebar' === this.value ) {
				calc = 'max-width: ' + container_width + 'px;';
			} else if ( '' === this.value ) {
				calc = 'max-width: ' + generate_block_editor.saved_content_width + 'px;';
			} else {
				calc = 'max-width: calc(' + container_width + 'px - ' + both_sidebars_width + '%);';
			}

			$( 'style#sidebar_width' ).remove();
			$( 'head' ).append( '<style id="sidebar_width">' + container_width_elements + '{' + calc + '}</style>' );
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

	var background_color = tinycolor( generate_block_editor.background_color ).toHex8(),
		isDarkMode = tinycolor( background_color ).isDark();

	if ( isDarkMode ) {
		$( 'body' ).addClass( 'is-dark-theme' );
	}
} );

jQuery( window ).load( function() {
	var post_title_block = jQuery( '.editor-post-title__block' );

	if ( post_title_block ) {
		post_title_block.append( '<button class="content-title-visibility disable-content-title" title="' + generate_block_editor.disable_content_title + '" aria-hidden="true"></button>' );
		post_title_block.append( '<button class="content-title-visibility show-content-title" title="' + generate_block_editor.show_content_title + '" aria-hidden="true"></button>' );
	}
} );
