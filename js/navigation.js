/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens
 */
(function ( $ ) {
	$.fn.GenerateMobileMenu = function( options ) {
		// Set the default settings
		var settings = $.extend({
			menu: '.main-navigation'
		}, options );
		
		// Bail if our menu doesn't exist
		if ( ! $( settings.menu ).length ) {
			return;
		}
		
		// Open the mobile menu
		$( this ).on( 'click', function( e ) {
			e.preventDefault();
			$( this ).closest( settings.menu ).toggleClass( 'toggled' );
			$( this ).closest( settings.menu ).attr( 'aria-expanded', $( this ).closest( settings.menu ).attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
			$( this ).toggleClass( 'toggled' );
			$( this ).children( 'i' ).toggleClass( 'fa-bars' ).toggleClass( 'fa-close' );
			$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		});
	};
}( jQuery ));

jQuery( document ).ready( function( $ ) {
	// Initiate our mobile menu
	$( '#site-navigation .menu-toggle' ).GenerateMobileMenu();
	
	// Set up clicked variable
	// This is important as the second click function was firing even if we were clicking the .dropdown-menu-toggle
	var clicked = false;
	
	// Build the mobile button that displays the dropdown menu
	$( 'nav' ).on( 'click', '.dropdown-menu-toggle', function( e ) {
		e.preventDefault();
		var _this = $( this );
		var mobile = $( '.menu-toggle' );
		var slideout = $( '.slideout-navigation' );
		if ( mobile.is( ':visible' ) || 'visible' == slideout.css( 'visibility' ) ) {
			_this.closest( 'li' ).toggleClass( 'sfHover' );
			_this.parent().next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
			_this.attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			clicked = true;
		}
	});
	
	// Display the dropdown on click if the item URL doesn't go anywhere
	$( 'nav' ).on( 'click', '.main-nav .menu-item-has-children > a', function( e ) {
		var _this = $( this );
		var mobile = $( '.menu-toggle' );
		var slideout = $( '.slideout-navigation' );
		var url = _this.attr( 'href' );
		if ( ( '#' == url || '' == url ) && ! clicked ) {
			if ( mobile.is( ':visible' ) || 'visible' == slideout.css( 'visibility' ) ) {
				e.preventDefault();
				_this.closest( 'li' ).toggleClass( 'sfHover' );
				_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
				_this.attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			}
		}
		clicked = false;
	});
});