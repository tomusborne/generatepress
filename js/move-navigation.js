jQuery(window).load(function($) {
	var mobile, widthTimer, width;
	mobile = jQuery( '.menu-toggle' );
	width = jQuery( window ).width();

	function generateCheckWidth() {
		if ( ! jQuery( '.gen-sidebar-nav' ) )
			return;
		
		if ( mobile.is( ':visible' ) ) {
			jQuery('#site-navigation:first').insertAfter('.site-header');
		} else {
			jQuery('#site-navigation:first').appendTo('.gen-sidebar-nav');
		}
	}

	if ( mobile.is( ':visible' ) ) {
		generateCheckWidth();
	}

	jQuery( window ).resize(function() {
		if ( jQuery(window).width() != width ) {
			clearTimeout(widthTimer);
			widthTimer = setTimeout(generateCheckWidth, 100);
			width = jQuery(window).width();
		}
	});
	
	jQuery( window ).on( "orientationchange", function( event ) {
		if ( jQuery(window).width() != width ) {
			clearTimeout(widthTimer);
			widthTimer = setTimeout(generateCheckWidth, 100);
			width = jQuery(window).width();
		}
	});
});