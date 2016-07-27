(function ( $ ) {
	// Create our navigation search function
	$.fn.GenerateMenuSearch = function() {
		$( this ).on( 'click', function( e ) {
			e.preventDefault();
			var form = $(this).closest('div').prevAll('form');
			if ( form.is( ':visible' ) ) {
				$(this).parent().removeClass('current-menu-item');
				$(this).parent().removeClass('sfHover');
				$(this).css('opacity','1');
				form.show().fadeOut(200);
				$(this).children('i').replaceWith('<i class="fa fa-fw fa-search"></i>');
			} else {
				$(this).parent().addClass('current-menu-item');
				$(this).parent().removeClass('sfHover');
				$(this).css('opacity','0.9');
				form.hide().fadeIn(200);
				form.children('input').focus();
				$(this).children('i').replaceWith('<i class="fa fa-fw fa-times"></i>');
			}
			return false;
		});
		
		// Close the search area on click outside of area
		$(document).click(function(event) { 
			if($(event.target).closest('.navigation-search').length || $(event.target).closest('.search-item a').length) {
				// do nothing
			} else {
				if($('.navigation-search').is(":visible")) {
					$('.search-item a').parent().removeClass('current-menu-item');
					$('.navigation-search').show().fadeOut(200);
					$('.search-item a').css('opacity','1');
					$('.search-item i').replaceWith('<i class="fa fa-fw fa-search"></i>');
				}
			}
		});
		return this;
    };
}( jQuery ));
jQuery(document).ready(function($) {
	
	// Apply our function to the search item
	$( ".search-item a" ).GenerateMenuSearch();
	
});