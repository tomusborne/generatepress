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
				calc = '';
			} else {
				calc = 'max-width: calc(' + container_width + 'px - ' + both_sidebars_width + '%);';
			}

			if ( 'no-sidebar' === this.value && generate_block_editor.content_width ) {
				calc = 'max-width: ' + generate_block_editor.content_width + 'px';
			}

			$( 'style#sidebar_width' ).remove();
			$( 'head' ).append( '<style id="sidebar_width">' + container_width_elements + '{' + calc + '}</style>' );
		}
	} );
} );