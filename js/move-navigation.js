jQuery(window).load(function($) {
	var mobile, widthTimer;
	mobile = jQuery( '.menu-toggle' );
			
	function generateCheckWidth() {
		if ( mobile.is( ':visible' ) ) {
			jQuery('.main-navigation').insertAfter('.site-header');
		} else {
			jQuery('.main-navigation').appendTo('.gen-sidebar-nav');
		}
	}
			
	if ( mobile.is( ':visible' ) ) {
		generateCheckWidth();
	}
			
	jQuery(window).resize(function() {
		clearTimeout(widthTimer);
		widthTimer = setTimeout(generateCheckWidth, 100);
	});
});