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
