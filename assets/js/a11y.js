( function() {
	'use strict';

	// Check if the browser supports querySelector and addEventListener
	if ( 'querySelector' in document && 'addEventListener' in window ) {
		// Get the body element
		var body = document.body;

		// Add event listener for pointer interactions with passive option
		body.addEventListener( 'pointerdown', function() {
			body.classList.add( 'using-mouse' );
		}, { passive: true } );

		// Add event listener for keyboard interactions
		body.addEventListener( 'keydown', function() {
			body.classList.remove( 'using-mouse' );
		}, { passive: true } );
	}
}() );
