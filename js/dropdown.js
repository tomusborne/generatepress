( function() {
	'use strict';

	if ( 'querySelector' in document && 'addEventListener' in window ) {
		var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' ),
			body = document.body,
			navLinks = document.querySelectorAll( 'nav ul a' ),
			htmlEl = document.documentElement;

		/**
		 * Make hover dropdown touch-friendly.
		 */
		if ( 'touchend' in document.documentElement ) {
			for ( var i = 0; i < parentElements.length; i++ ) {
				parentElements[i].addEventListener( 'touchend', function( e ) {
					// Bail on mobile
					if ( parentElements[i].closest( 'nav' ).classList.contains( 'toggled' ) ) {
						return;
					}

					if ( e.touches.length === 1 ) {
						// Prevent touch events within dropdown bubbling down to document
						e.stopPropagation();

						// Toggle hover
						if ( ! this.classList.contains( 'sfHover' ) ) {
							// Prevent link on first touch
							if ( e.target === this || e.target.parentNode === this ) {
								e.preventDefault();
							}

							// Close other sub-menus
							var openedSubMenus = parentElements[i].closest( 'nav' ).querySelectorAll( 'ul.toggled-on' );
							if ( openedSubMenus && ! this.closest( 'ul' ).classList.contains( 'toggled-on' ) && ! this.closest( 'li' ).classList.contains( 'sfHover' ) ) {
								for ( var o = 0; o < openedSubMenus.length; o++ ) {
									openedSubMenus[o].classList.remove( 'toggled-on' );
									openedSubMenus[o].closest( 'li' ).classList.remove( 'sfHover' );
								}
							}

							this.classList.add( 'sfHover' );

							// Hide dropdown on touch outside
							document.addEventListener( 'touchend', closeDropdown = function(e) {
								e.stopPropagation();

								this.classList.remove( 'sfHover' );
								document.removeEventListener( 'touchend', closeDropdown );
							} );
						}
					}
				}, true );
			}
		}

		/**
		 * Provides compatibility for the Secondary Navigation until GPP is updated.
		 */
		var addFocusClass = function( e ) {
			if ( this.closest( 'nav' ).classList.contains( 'toggled' ) ) {
				return;
			}

			this.classList.toggle( 'sfHover' );
		}

		var secondaryNavItems = document.querySelectorAll( '.secondary-navigation .menu-item-has-children' );
		for ( var i = 0; i < secondaryNavItems.length; i++ ) {
				secondaryNavItems[i].addEventListener( 'mouseenter', addFocusClass );
				secondaryNavItems[i].addEventListener( 'mouseleave', addFocusClass );
		}

		/**
		 * Do some essential things when menu items are clicked.
		 */
		for ( var i = 0; i < navLinks.length; i++ ) {
			navLinks[i].addEventListener( 'click', function( e ) {
				var closest_nav = this.closest( 'nav' );
				if ( closest_nav.classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) {
					var url = this.getAttribute( 'href' );

					// Open the sub-menu if the link has no destination
					if ( '#' == url || '' == url ) {
						e.preventDefault();
						var closestLi = this.closest( 'li' );
						closestLi.classList.toggle( 'sfHover' );
						var subMenu = closestLi.querySelector( '.sub-menu' );

						if ( subMenu ) {
							subMenu.classList.toggle( 'toggled-on' );
						}
					}

					// Close the mobile menu if our link does something - good for one page sites.
					if ( '#' !== url && '' !== url && ! navigator.userAgent.match( /iemobile/i ) ) {
						setTimeout( function() {
							closest_nav.classList.remove( 'toggled' );
							htmlEl.classList.remove( 'mobile-menu-open' );
						}, 200 );
					}
				}
			}, false );
		}
	}

})();
