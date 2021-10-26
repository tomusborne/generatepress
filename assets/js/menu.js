( function() {
	'use strict';

	if ( 'querySelector' in document && 'addEventListener' in window ) {
		/**
		 * matches() pollyfil
		 *
		 * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Browser_compatibility
		 */
		if ( ! Element.prototype.matches ) {
			Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
		}

		/**
		 * closest() pollyfil
		 *
		 * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Browser_compatibility
		 * @param {Object} s The element to check.
		 * @return {Object} The closest object.
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
			dropdownToggles = document.querySelectorAll( 'nav .dropdown-menu-toggle' ),
			navLinks = document.querySelectorAll( 'nav .main-nav ul a' ),
			mobileMenuControls = document.querySelector( '.mobile-menu-control-wrapper' ),
			body = document.body,
			htmlEl = document.documentElement,
			i;

		var enableDropdownArrows = function( nav ) {
			if ( body.classList.contains( 'dropdown-hover' ) ) {
				var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );

				for ( i = 0; i < dropdownItems.length; i++ ) {
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'tabindex', '0' );
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'role', 'button' );
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'aria-expanded', 'false' );
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'aria-label', generatepressMenu.openSubMenuLabel );
				}
			}
		};

		var disableDropdownArrows = function( nav ) {
			if ( body.classList.contains( 'dropdown-hover' ) ) {
				var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );

				for ( i = 0; i < dropdownItems.length; i++ ) {
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'tabindex' );
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'role', 'presentation' );
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'aria-expanded' );
					dropdownItems[ i ].querySelector( '.dropdown-menu-toggle' ).removeAttribute( 'aria-label' );
				}
			}
		};

		var setDropdownArrowAttributes = function( arrow ) {
			if ( 'false' === arrow.getAttribute( 'aria-expanded' ) || ! arrow.getAttribute( 'aria-expanded' ) ) {
				arrow.setAttribute( 'aria-expanded', 'true' );
				arrow.setAttribute( 'aria-label', generatepressMenu.closeSubMenuLabel );
			} else {
				arrow.setAttribute( 'aria-expanded', 'false' );
				arrow.setAttribute( 'aria-label', generatepressMenu.openSubMenuLabel );
			}
		};

		/**
		 * Start mobile menu toggle.
		 *
		 * @param {Object} e The event.
		 * @param {Object} _this The clicked item.
		 */
		var toggleNav = function( e, _this ) {
			if ( ! _this ) {
				_this = this;
			}

			var parentContainer = '';

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

			var nav = parentContainer.getElementsByTagName( 'ul' )[ 0 ];

			if ( parentContainer.classList.contains( 'toggled' ) ) {
				parentContainer.classList.remove( 'toggled' );
				htmlEl.classList.remove( 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'true' );
				_this.setAttribute( 'aria-expanded', 'false' );

				if ( isExternalToggle ) {
					mobileMenuControls.classList.remove( 'toggled' );
				} else if ( mobileMenuControls && parentContainer.classList.contains( 'main-navigation' ) ) {
					mobileMenuControls.classList.remove( 'toggled' );
				}

				disableDropdownArrows( nav );
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
				} else if ( mobileMenuControls && parentContainer.classList.contains( 'main-navigation' ) ) {
					mobileMenuControls.classList.add( 'toggled' );
				}

				enableDropdownArrows( nav );
			}
		};

		for ( i = 0; i < allNavToggles.length; i++ ) {
			allNavToggles[ i ].addEventListener( 'click', toggleNav, false );
		}

		/**
		 * Open sub-menus
		 *
		 * @param {Object} e The event.
		 * @param {Object} _this The clicked item.
		 */
		var toggleSubNav = function( e, _this ) {
			if ( ! _this ) {
				_this = this;
			}

			if ( ( _this.closest( 'nav' ).classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) && ! body.classList.contains( 'dropdown-click' ) ) {
				e.preventDefault();
				var closestLi = _this.closest( 'li' );

				setDropdownArrowAttributes( closestLi.querySelector( '.dropdown-menu-toggle' ) );

				if ( closestLi.querySelector( '.sub-menu' ) ) {
					var subMenu = closestLi.querySelector( '.sub-menu' );
				} else {
					subMenu = closestLi.querySelector( '.children' );
				}

				if ( generatepressMenu.toggleOpenedSubMenus ) {
					var siblings = getSiblings( closestLi );

					for ( i = 0; i < siblings.length; i++ ) {
						if ( siblings[ i ].classList.contains( 'sfHover' ) ) {
							siblings[ i ].classList.remove( 'sfHover' );
							siblings[ i ].querySelector( '.toggled-on' ).classList.remove( 'toggled-on' );
							setDropdownArrowAttributes( siblings[ i ].querySelector( '.dropdown-menu-toggle' ) );
						}
					}
				}

				closestLi.classList.toggle( 'sfHover' );
				subMenu.classList.toggle( 'toggled-on' );
			}

			e.stopPropagation();
		};

		for ( i = 0; i < dropdownToggles.length; i++ ) {
			dropdownToggles[ i ].addEventListener( 'click', toggleSubNav, false );
			dropdownToggles[ i ].addEventListener( 'keypress', function( e ) {
				if ( 'Enter' === e.key ) { // 13 is enter
					toggleSubNav( e, this );
				}
			}, false );
		}

		/**
		 * Disable the mobile menu if our toggle isn't visible.
		 * Makes it possible to style mobile item with .toggled class.
		 */
		var checkMobile = function() {
			var openedMobileMenus = document.querySelectorAll( '.toggled, .has-active-search' );

			for ( i = 0; i < openedMobileMenus.length; i++ ) {
				var menuToggle = openedMobileMenus[ i ].querySelector( '.menu-toggle' );

				if ( mobileMenuControls && ! menuToggle.closest( 'nav' ).classList.contains( 'mobile-menu-control-wrapper' ) ) {
					menuToggle = mobileMenuControls.querySelector( '.menu-toggle' );
				}

				if ( menuToggle && menuToggle.offsetParent === null ) {
					if ( openedMobileMenus[ i ].classList.contains( 'toggled' ) ) {
						var remoteNav = false;

						if ( openedMobileMenus[ i ].classList.contains( 'mobile-menu-control-wrapper' ) ) {
							remoteNav = true;
						}

						if ( ! remoteNav ) {
							// Navigation is toggled, but .menu-toggle isn't visible on the page (display: none).
							var closestNav = openedMobileMenus[ i ].getElementsByTagName( 'ul' )[ 0 ],
								closestNavItems = closestNav.getElementsByTagName( 'li' ),
								closestSubMenus = closestNav.getElementsByTagName( 'ul' );
						}

						document.activeElement.blur();
						openedMobileMenus[ i ].classList.remove( 'toggled' );

						htmlEl.classList.remove( 'mobile-menu-open' );
						menuToggle.setAttribute( 'aria-expanded', 'false' );

						if ( ! remoteNav ) {
							for ( var li = 0; li < closestNavItems.length; li++ ) {
								closestNavItems[ li ].classList.remove( 'sfHover' );
							}

							for ( var sm = 0; sm < closestSubMenus.length; sm++ ) {
								closestSubMenus[ sm ].classList.remove( 'toggled-on' );
							}

							if ( closestNav ) {
								closestNav.removeAttribute( 'aria-hidden' );
							}
						}

						disableDropdownArrows( openedMobileMenus[ i ] );
					}

					if ( mobileMenuControls.querySelector( '.search-item' ) ) {
						if ( mobileMenuControls.querySelector( '.search-item' ).classList.contains( 'active' ) ) {
							mobileMenuControls.querySelector( '.search-item' ).click();
						}
					}
				}
			}
		};
		window.addEventListener( 'resize', checkMobile, false );
		window.addEventListener( 'orientationchange', checkMobile, false );

		if ( body.classList.contains( 'dropdown-hover' ) ) {
			/**
			 * Do some essential things when menu items are clicked.
			 */
			for ( i = 0; i < navLinks.length; i++ ) {
				navLinks[ i ].addEventListener( 'click', function( e ) {
					// Remove sfHover class if we're going to another site.
					if ( this.hostname !== window.location.hostname ) {
						document.activeElement.blur();
					}

					var closestNav = this.closest( 'nav' );
					if ( closestNav.classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) {
						var url = this.getAttribute( 'href' );

						// Open the sub-menu if the link has no destination
						if ( '#' === url || '' === url ) {
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

		if ( body.classList.contains( 'dropdown-hover' ) ) {
			var menuBarItems = document.querySelectorAll( '.menu-bar-items .menu-bar-item > a' );

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
			};

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
			};

			for ( i = 0; i < navLinks.length; i++ ) {
				navLinks[ i ].addEventListener( 'focus', toggleFocus );
				navLinks[ i ].addEventListener( 'blur', toggleFocus );
			}

			for ( i = 0; i < menuBarItems.length; i++ ) {
				menuBarItems[ i ].addEventListener( 'focus', toggleMenuBarItemFocus );
				menuBarItems[ i ].addEventListener( 'blur', toggleMenuBarItemFocus );
			}
		}

		/**
		 * Make hover dropdown touch-friendly.
		 */
		if ( 'ontouchend' in document.documentElement && document.body.classList.contains( 'dropdown-hover' ) ) {
			var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' );

			for ( i = 0; i < parentElements.length; i++ ) {
				parentElements[ i ].addEventListener( 'touchend', function( e ) {
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

							// Close other sub-menus.
							var closestLi = this.closest( 'li' ),
								siblings = getSiblings( closestLi );

							for ( i = 0; i < siblings.length; i++ ) {
								if ( siblings[ i ].classList.contains( 'sfHover' ) ) {
									siblings[ i ].classList.remove( 'sfHover' );
								}
							}

							this.classList.add( 'sfHover' );

							// Hide dropdown on touch outside
							var closeDropdown,
								thisItem = this;

							document.addEventListener( 'touchend', closeDropdown = function( event ) {
								event.stopPropagation();

								thisItem.classList.remove( 'sfHover' );
								document.removeEventListener( 'touchend', closeDropdown );
							} );
						}
					}
				} );
			}
		}
	}
}() );
