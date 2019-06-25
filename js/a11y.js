/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();

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
	}
} )();

( function() {
	'use strict';

	if ( 'querySelector' in document && 'addEventListener' in window && document.body.classList.contains( 'dropdown-hover' ) ) {
		var navLinks = document.querySelectorAll( 'nav .main-nav ul a' );

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
					if ( -1 !== self.className.indexOf( 'sfHover' ) ) {
						self.className = self.className.replace( ' sfHover', '' );
					} else {
						self.className += ' sfHover';
					}
				}

				self = self.parentElement;
			}
		}

		for ( var i = 0; i < navLinks.length; i++ ) {
			navLinks[i].addEventListener( 'focus', toggleFocus );
			navLinks[i].addEventListener( 'blur', toggleFocus );
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

						// Close other sub-menus
						var openedSubMenus = this.closest( 'nav' ).querySelectorAll( 'ul.toggled-on' );
						if ( openedSubMenus && ! this.closest( 'ul' ).classList.contains( 'toggled-on' ) && ! this.closest( 'li' ).classList.contains( 'sfHover' ) ) {
							for ( var o = 0; o < openedSubMenus.length; o++ ) {
								openedSubMenus[o].classList.remove( 'toggled-on' );
								openedSubMenus[o].closest( 'li' ).classList.remove( 'sfHover' );
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

})();
