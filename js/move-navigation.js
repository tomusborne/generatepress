jQuery(window).load(function($) {
	var mobile, widthTimer;
	mobile = jQuery( '.menu-toggle' );
			
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
			
	jQuery(window).resize(function() {
		clearTimeout(widthTimer);
		widthTimer = setTimeout(generateCheckWidth, 100);
	});
});