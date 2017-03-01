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
		
		// Get the clicked item
		var _this = $( this );
		
		// Bail if our menu doesn't exist
		if ( ! $( settings.menu ).length ) {
			return;
		}
		
		// Toggle the mobile menu
		_this.on( 'click', function( e ) {
			e.preventDefault();
			_this = $( this );
			_this.closest( settings.menu ).toggleClass( 'toggled' );
			_this.closest( settings.menu ).attr( 'aria-expanded', _this.closest( settings.menu ).attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
			_this.toggleClass( 'toggled' );
			_this.children( 'i' ).toggleClass( 'fa-bars' ).toggleClass( 'fa-close' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		});
		
		// Set up our clicked variable
		// We use this to check if we've clicked on the dropdown arrow or not
		var clicked = false;
		
		// Check to see if we're clicking on the dropdown arrow
		$( 'nav' ).on( 'click', '.dropdown-menu-toggle', function( e ) {
			e.preventDefault();
			// If we've clicked on the dropdown arrow, set our clicked variable to true
			clicked = true;
		});
		
		// Close the menu on click
		// This is essential if you're using anchors for a one page site
		$( 'nav' ).on( 'click', '.main-nav a', function( e ) {
			// Only do something if the menu toggle is visible
			if ( $( '.menu-toggle' ).is( ':visible' ) ) {
				var _this = $( this ), url = _this.attr( 'href' );
				
				// Make sure this doesn't fire if we're clicking the dropdown arrow
				// This will only fire if we're not clicking a dropdown arrow, and the URL isn't # or empty
				if ( ! clicked && ( '#' !== url && '' !== url ) ) {
					_this.closest( settings.menu ).removeClass( 'toggled' );
					_this.closest( settings.menu ).attr( 'aria-expanded', 'false' );
					_this.removeClass( 'toggled' );
					_this.children( 'i' ).addClass( 'fa-bars' ).removeClass( 'fa-close' );
					_this.attr( 'aria-expanded', 'false' );
				}
			}
			
			// Reset our clicked variable
			clicked = false;
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