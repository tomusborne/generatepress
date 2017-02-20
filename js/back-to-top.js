jQuery( document ).ready( function($) {
	var _amountScrolled = $( '.generate-back-to-top' ).data( 'start-scroll' ),
		_scrollSpeed = $( '.generate-back-to-top' ).data( 'scroll-speed' ),
		_button = $( 'a.generate-back-to-top' ),
		_window = $( window );

	_window.scroll(function() {
		if ( _window.scrollTop() > _amountScrolled ) {
			$( _button ).css({
				'opacity': '1',
				'visibility': 'visible'
			});
		} else {
			$( _button ).css({
				'opacity': '0',
				'visibility' : 'hidden'
			});
		}
	});

	$( _button ).on( 'click', function( e ) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, _scrollSpeed);
	});
});