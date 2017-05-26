(function ( $ ) {
	$.fn.generateDropdownClick = function( options ) {
		// Set the default settings
		var settings = $.extend({
			item: 'menu-item'
		}, options );

		$( this ).on( 'click', function( e ) {
			e.preventDefault();
			// Get the clicked element
			var _this = $( this );
			
			// Bail if we're clicking a mega menu sub-menu item
			if ( _this.closest( '.sub-menu' ).closest( '.menu-item-has-children' ).hasClass( 'mega-menu' ) )
				return;
			
			// Get clicked parent
			var _parent = _this.closest( 'nav' );
			
			// If we're clicking on the main navigation, close the secondary navigation dropdown
			if ( 'main-navigation' == _parent.attr( 'class' ) ) {
				if ( $( '.secondary-navigation ul.toggled-on' ).is( ':visible' ) ) {
					$( '.secondary-navigation .main-nav .menu-item-has-children > a' ).parent().removeClass( 'sfHover' );
					$( '.secondary-navigation .main-nav .menu-item-has-children > a' ).siblings( '.children, .sub-menu' ).removeClass( 'toggled-on' );
				}
			}
			
			// If we're clicking on the secondary navigation, close the main navigation dropdown
			if ( 'secondary-navigation' == _parent.attr( 'class' ) ) {
				if ( $( '.main-navigation ul.toggled-on' ).is( ':visible' ) ) {
					$( '.main-navigation .main-nav .menu-item-has-children > a' ).parent().removeClass( 'sfHover' );
					$( '.main-navigation .main-nav .menu-item-has-children > a' ).siblings( '.children, .sub-menu' ).removeClass( 'toggled-on' );
				}
			}
			
			// Close other sub-menus
			_this.closest( 'li' ).siblings().find('.toggled-on').removeClass( 'toggled-on' );
			
			// Remove sfHover class from other menu items
			_this.closest( 'li' ).siblings( '.sfHover' ).removeClass( 'sfHover' );
			
			// Remove sfHover class from other sub menu items
			_this.closest( 'li' ).siblings().find( '.sfHover' ).removeClass( 'sfHover' );

			// Add sfHover class to parent li
			_this.closest( 'li' ).toggleClass( 'sfHover' );

			if ( 'menu-item' == settings.item ) {
				// Add toggled-on class to nearest sub-menus
				_this.siblings( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
				
				// Change accessibility attributes
				_this.children( 'span' ).attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
			}
			
			if ( 'arrow' == settings.item ) {
				// Add toggled-on class to nearest sub-menus
				_this.parent().siblings( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
				
				// Change accessibility attributes
				_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
			}
			
			return false;
		} );
		
		$.fn.generateDropdownClick.close = function() {
			if ( $( 'ul.toggled-on' ).is( ':visible' ) ) {
				$( '.main-nav .menu-item-has-children > a' ).parent().removeClass( 'sfHover' );
				$( '.main-nav .menu-item-has-children > a' ).siblings( '.children, .sub-menu' ).removeClass( 'toggled-on' );
			}
        }
		
	};
}( jQuery ));

jQuery(document).ready(function($) {
	// Initiate dropdown click on the menu item
	if ( $( 'body' ).hasClass( 'dropdown-click-menu-item' ) ) {
		$( '.dropdown-click-menu-item .main-nav .menu-item-has-children > a' ).generateDropdownClick({
			item: 'menu-item'
		});
	}
	
	// Initiate dropdown click on the arrow
	if ( $( 'body' ).hasClass( 'dropdown-click-arrow' ) ) {
		// Set the dropdown click to the arrows
		$( '.dropdown-click-arrow .main-nav .menu-item-has-children > a .dropdown-menu-toggle' ).generateDropdownClick({
			item: 'arrow'
		});
		
		// If our parent item has # as the URL, add a class to it
		$( '.main-nav .menu-item-has-children > a' ).each( function() {
			if ( $( this ).attr( 'href' ) == '#' ) $( this ).addClass( 'menu-item-dropdown-click' );
		});
		
		// If our parent item has the menu-item-dropdown-click class, set the dropdown click to the whole item
		$( '.dropdown-click-arrow .main-nav .menu-item-has-children > a.menu-item-dropdown-click' ).generateDropdownClick({
			item: 'menu-item'
		});
	}
	
	// Close the search area on click outside of area
	$( document ).click( function( event ) { 
		if ( $( event.target ).closest('ul.toggled-on').length ) {
			// do nothing
		} else {
			$( 'ul.toggled-on' ).generateDropdownClick.close();
		}
	});
	
	// Close the dropdown menus when we click the navigation search or slideout button
	$( '.search-item a, .slideout-toggle a' ).on( 'click', function() {
		$( 'ul.toggled-on' ).generateDropdownClick.close();
	});
	
});