( function() {
	'use strict';

	if ( 'querySelector' in document && 'addEventListener' in window ) {
		var body = document.body;

		body.addEventListener( 'mousedown', function() {
			body.classList.add( 'using-mouse' );
		} );

		body.addEventListener( 'keydown', function() {
			body.classList.remove( 'using-mouse' );
		} );

		if ( body.classList.contains( 'dropdown-hover' ) ) {
			var navLinks = document.querySelectorAll( 'nav .main-nav ul a' ),
				menuBarItems = document.querySelectorAll( '.menu-bar-items .menu-bar-item > a' );

			/**
			 * Make menu items tab accessible when using the hover dropdown type
			 */
			var toggleFocus = function() {
				if ( this.closest( 'nav' ).classList.contains( 'toggled' ) || this.closest( 'nav' ).classList.contains( 'slideout-navigation' ) ) {
					return;
				}

				var self = this;

				while ( -1 === self.className.indexOf( 'main-nav' ) ) {
					if ( 'li' === self.tagName.toLowerCase() ) {
						self.classList.toggle( 'sfHover' );
					}

					self = self.parentElement;
				}
			}

			/**
			 * Make our menu bar items tab accessible.
			 */
			var toggleMenuBarItemFocus = function() {
				if ( this.closest( 'nav' ).classList.contains( 'toggled' ) || this.closest( 'nav' ).classList.contains( 'slideout-navigation' ) ) {
					return;
				}

				var self = this;

				while ( -1 === self.className.indexOf( 'menu-bar-items' ) ) {
					if ( self.classList.contains( 'menu-bar-item' ) ) {
						self.classList.toggle( 'sfHover' );
					}

					self = self.parentElement;
				}
			}

			for ( var i = 0; i < navLinks.length; i++ ) {
				navLinks[i].addEventListener( 'focus', toggleFocus );
				navLinks[i].addEventListener( 'blur', toggleFocus );
			}

			for ( var i = 0; i < menuBarItems.length; i++ ) {
				menuBarItems[i].addEventListener( 'focus', toggleMenuBarItemFocus );
				menuBarItems[i].addEventListener( 'blur', toggleMenuBarItemFocus );
			}
		}
	}

	/**
	 * Make hover dropdown touch-friendly.
	 */
	if ( 'ontouchend' in document.documentElement && document.body.classList.contains( 'dropdown-hover' ) ) {
		var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' );

		for ( var i = 0; i < parentElements.length; i++ ) {
			parentElements[i].addEventListener( 'touchend', function( e ) {

				// Bail on mobile
				if ( this.closest( 'nav' ).classList.contains( 'toggled' ) ) {
					return;
				}

				if ( e.touches.length === 1 || e.touches.length === 0 ) {
					// Prevent touch events within dropdown bubbling down to document
					e.stopPropagation();

					// Toggle hover
					if ( ! this.classList.contains( 'sfHover' ) ) {
						// Prevent link on first touch
						if ( e.target === this || e.target.parentNode === this || e.target.parentNode.parentNode ) {
							e.preventDefault();
						}

						var getSiblings = function( elem ) {
							return Array.prototype.filter.call( elem.parentNode.children, function( sibling ) {
								return sibling !== elem;
							} );
						};

						// Close other sub-menus.
						var closestLi = this.closest( 'li' ),
							siblings = getSiblings( closestLi );

						for ( var i = 0; i < siblings.length; i++ ) {
							if ( siblings[i].classList.contains( 'sfHover' ) ) {
								siblings[i].classList.remove( 'sfHover' );
							}
						}

						this.classList.add( 'sfHover' );

						// Hide dropdown on touch outside
						var closeDropdown,
							thisItem = this;

						document.addEventListener( 'touchend', closeDropdown = function(e) {
							e.stopPropagation();

							thisItem.classList.remove( 'sfHover' );
							document.removeEventListener( 'touchend', closeDropdown );
						} );
					}
				}
			} );
		}
	}
} )();
