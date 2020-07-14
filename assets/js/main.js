( function() {
	'use strict';

	if ( 'querySelector' in document && 'addEventListener' in window ) {
		/**
		 * matches() pollyfil
		 * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Browser_compatibility
		 */
		if ( ! Element.prototype.matches ) {
			Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
		}

		/**
		 * closest() pollyfil
		 * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Browser_compatibility
		 */
		if ( ! Element.prototype.closest ) {
			Element.prototype.closest = function( s ) {
				var el = this;
				var ancestor = this;
				if ( ! document.documentElement.contains( el ) ) {
					return null;
				}
				do {
					if ( ancestor.matches( s ) ) {
						return ancestor;
					}
					ancestor = ancestor.parentElement;
				} while ( ancestor !== null );
				return null;
			};
		}

		var getSiblings = function( elem ) {
			return Array.prototype.filter.call( elem.parentNode.children, function( sibling ) {
				return sibling !== elem;
			} );
		};

		var allNavToggles = document.querySelectorAll( '.menu-toggle' ),
			dropdownToggle = document.querySelectorAll( 'nav .dropdown-menu-toggle' ),
			navLinks = document.querySelectorAll( 'nav ul a' ),
			body = document.body,
			htmlEl = document.documentElement;

		/**
		 * Start mobile menu toggle.
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		var toggleNav = function( e, _this ) {
			if ( ! _this ) {
				var _this = this;
			}

			var mobileMenuControls = document.querySelector( '.mobile-menu-control-wrapper' ),
				parentContainer = '';

			if ( _this.getAttribute( 'data-nav' ) ) {
				parentContainer = document.getElementById( _this.getAttribute( 'data-nav' ) );
			} else {
				parentContainer = document.getElementById( _this.closest( 'nav' ).getAttribute( 'id' ) );
			}

			if ( ! parentContainer ) {
				return;
			}

			var isExternalToggle = false;

			if ( _this.closest( '.mobile-menu-control-wrapper' ) ) {
				isExternalToggle = true;
			}

			var nav = parentContainer.getElementsByTagName( 'ul' )[0];

			if ( parentContainer.classList.contains( 'toggled' ) ) {
				parentContainer.classList.remove( 'toggled' );
				htmlEl.classList.remove( 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'true' );
				_this.setAttribute( 'aria-expanded', 'false' );

				if ( isExternalToggle ) {
					mobileMenuControls.classList.remove( 'toggled' );
					parentContainer.classList.remove( 'nav-is-active' );
				} else if ( mobileMenuControls && parentContainer.classList.contains( 'main-navigation' ) ) {
					mobileMenuControls.classList.remove( 'toggled' );
				}

				if ( body.classList.contains( 'dropdown-hover' ) ) {
					var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );
					for ( var i = 0; i < dropdownItems.length; i++ ) {
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'tabindex' );
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'role', 'presentation' );
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'aria-expanded' );
					}
				}
			} else {
				parentContainer.classList.add( 'toggled' );
				htmlEl.classList.add( 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'false' );
				_this.setAttribute( 'aria-expanded', 'true' );

				if ( isExternalToggle ) {
					mobileMenuControls.classList.add( 'toggled' );

					if ( mobileMenuControls.querySelector( '.search-item' ) ) {
						if ( mobileMenuControls.querySelector( '.search-item' ).classList.contains( 'active' ) ) {
							mobileMenuControls.querySelector( '.search-item' ).click();
						}
					}

					parentContainer.classList.add( 'nav-is-active' );
				} else if ( mobileMenuControls && parentContainer.classList.contains( 'main-navigation' ) ) {
					mobileMenuControls.classList.add( 'toggled' );
				}

				if ( body.classList.contains( 'dropdown-hover' ) ) {
					var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );
					for ( var i = 0; i < dropdownItems.length; i++ ) {
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'tabindex', '0' );
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'role', 'button' );
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'aria-expanded', 'false' );
					}
				}
			}
		}

		for ( var i = 0; i < allNavToggles.length; i++ ) {
			allNavToggles[i].addEventListener( 'click', toggleNav, false );
		}

		/**
		 * Open sub-menus
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		var toggleSubNav = function( e, _this ) {

			if ( ! _this ) {
				var _this = this;
			}

			if ( ( _this.closest( 'nav' ).classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) && ! body.classList.contains( 'dropdown-click' ) ) {
				e.preventDefault();
				var closestLi = _this.closest( 'li' );

				var dropdownToggle = closestLi.querySelector( '.dropdown-menu-toggle' );

				if ( 'false' === dropdownToggle.getAttribute( 'aria-expanded' ) || ! dropdownToggle.getAttribute( 'aria-expanded' ) ) {
					dropdownToggle.setAttribute( 'aria-expanded', 'true' );
				} else {
					dropdownToggle.setAttribute( 'aria-expanded', 'false' );
				}

				if ( closestLi.querySelector( '.sub-menu' ) ) {
					var subMenu = closestLi.querySelector( '.sub-menu' );
				} else {
					var subMenu = closestLi.querySelector( '.children' );
				}

				if ( generatepressMenu.toggleOpenedSubMenus ) {
					var siblings = getSiblings( closestLi );

					for ( var i = 0; i < siblings.length; i++ ) {
						if ( siblings[i].classList.contains( 'sfHover' ) ) {
							siblings[i].classList.remove( 'sfHover' );
							siblings[i].querySelector( '.toggled-on' ).classList.remove( 'toggled-on' );
						}
					}
				}

				closestLi.classList.toggle( 'sfHover' );
				subMenu.classList.toggle( 'toggled-on' );
			}

			e.stopPropagation();
		}

		for ( var i = 0; i < dropdownToggle.length; i++ ) {
			dropdownToggle[i].addEventListener( 'click', toggleSubNav, false );
			dropdownToggle[i].addEventListener( 'keypress', function( e ) {
				var key = e.which || e.keyCode;
				if (key === 13) { // 13 is enter
					toggleSubNav( e, this );
				}
			}, false );
		}

		/**
		 * Disable the mobile menu if our toggle isn't visible.
		 * Makes it possible to style mobile item with .toggled class.
		 */
		var checkMobile = function() {
			for ( var i = 0; i < allNavToggles.length; i++ ) {
				if ( allNavToggles[i].offsetParent === null ) {
					var closestParent = allNavToggles[i].closest( 'nav' );

					if ( closestParent && closestParent.classList.contains( 'toggled' ) ) {
						var closestNav = closestParent.getElementsByTagName( 'ul' )[0];
						var closestNavItems = closestNav.getElementsByTagName( 'li' );
						var closestSubMenus = closestNav.getElementsByTagName( 'ul' );

						document.activeElement.blur();
						closestParent.classList.remove( 'toggled' );
						htmlEl.classList.remove( 'mobile-menu-open' );
						allNavToggles[i].setAttribute( 'aria-expanded', 'false' );

						for ( var li = 0; li < closestNavItems.length; li++ ) {
							closestNavItems[li].classList.remove( 'sfHover' );
						}

						for ( var sm = 0; sm < closestSubMenus.length; sm++ ) {
							closestSubMenus[sm].classList.remove( 'toggled-on' );
						}

						if ( closestNav ) {
							closestNav.removeAttribute( 'aria-hidden' );
						}

						if ( body.classList.contains( 'dropdown-hover' ) ) {
							var dropdownItems = closestParent.querySelectorAll( 'li.menu-item-has-children' );
							for ( var d = 0; d < dropdownItems.length; d++ ) {
								dropdownItems[d].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'tabindex' );
								dropdownItems[d].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'role', 'presentation' );
								dropdownItems[d].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'aria-expanded' );
							}
						}
					}
				}
			}
		}
		window.addEventListener( 'resize', checkMobile, false );
		window.addEventListener( 'orientationchange', checkMobile, false );

		if ( body.classList.contains( 'dropdown-hover' ) ) {
			/**
			 * Do some essential things when menu items are clicked.
			 */
			for ( var i = 0; i < navLinks.length; i++ ) {
				navLinks[i].addEventListener( 'click', function( e ) {
					// Remove sfHover class if we're going to another site.
					if ( this.hostname !== window.location.hostname ) {
						document.activeElement.blur();
					}

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
					}
				}, false );
			}
		}

	}

})();

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

})();
