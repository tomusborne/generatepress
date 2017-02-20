var amountScrolled = jQuery( '.generate-back-to-top' ).data( 'start-scroll' );
var scrollSpeed = jQuery( '.generate-back-to-top' ).data( 'scroll-speed' );
var button = jQuery( 'a.generate-back-to-top' );

jQuery(window).scroll(function() {
	if ( jQuery(window).scrollTop() > amountScrolled ) {
		jQuery( button ).css({
			'opacity': '1',
			'visibility': 'visible'
		});
	} else {
		jQuery( button ).css({
			'opacity': '0',
			'visibility' : 'hidden'
		});
	}
});

jQuery( button ).on( 'click', function( e ) {
	e.preventDefault();
	jQuery('html, body').animate({
		scrollTop: 0
	}, scrollSpeed);
});