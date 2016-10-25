var amountScrolled = jQuery( '.generate-back-to-top' ).data( 'start-scroll' );
var scrollSpeed = jQuery( '.generate-back-to-top' ).data( 'scroll-speed' );

jQuery(window).scroll(function() {
	if ( jQuery(window).scrollTop() > amountScrolled ) {
		jQuery('a.generate-back-to-top').css({
			'opacity': '1',
			'visibility': 'visible'
		});
	} else {
		jQuery('a.generate-back-to-top').css({
			'opacity': '0',
			'visibility' : 'hidden'
		});
	}
});

jQuery('a.generate-back-to-top').on( 'click', function() {
	jQuery('html, body').animate({
		scrollTop: 0
	}, scrollSpeed);
	return false;
});