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

		var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' ),
			nav,
			allNavToggles = document.querySelectorAll( '.menu-toggle' ),
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

			if ( _this.getAttribute( 'data-nav' ) ) {
				var parentContainer = document.getElementById( _this.getAttribute( 'data-nav' ) );
			} else {
				var parentContainer = document.getElementById( _this.closest( 'nav' ).getAttribute( 'id' ) );
			}

			nav = parentContainer.getElementsByTagName( 'ul' )[0];

			if ( parentContainer.classList.contains( 'toggled' ) ) {
				parentContainer.classList.remove( 'toggled' );
				htmlEl.classList.remove( 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'true' );

				if ( body.classList.contains( 'dropdown-hover' ) ) {
					var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );
					for ( var i = 0; i < dropdownItems.length; i++ ) {
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'tabindex', '' );
					}
				}
			} else {
				parentContainer.classList.add( 'toggled' );
				htmlEl.classList.add( 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'false' );

				if ( body.classList.contains( 'dropdown-hover' ) ) {
					var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );
					for ( var i = 0; i < dropdownItems.length; i++ ) {
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'tabindex', '0' );
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

				var subMenu = closestLi.querySelector( '.sub-menu' );

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
					var closestNav = closestParent.getElementsByTagName( 'ul' )[0];
					var closestNavItems = closestNav.getElementsByTagName( 'li' );
					var closestSubMenus = closestNav.getElementsByTagName( 'ul' );
					if ( closestParent ) {
						closestParent.classList.remove( 'toggled' );
						htmlEl.classList.remove( 'mobile-menu-open' );

						for ( var li = 0; li < closestNavItems.length; li++ ) {
							closestNavItems[li].classList.remove( 'sfHover' );
						}

						for ( var sm = 0; sm < closestSubMenus.length; sm++ ) {
							closestSubMenus[sm].classList.remove( 'toggled-on' );
						}

						if ( closestNav ) {
							closestNav.setAttribute( 'aria-hidden', 'true' );
						}
					}
				}
			}
		}
		window.addEventListener( 'resize', checkMobile, false );
		window.addEventListener( 'orientationchange', checkMobile, false );

		if ( body.classList.contains( 'dropdown-hover' ) ) {
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
					if ( ( this.closest( 'nav' ).classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) ) {
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
								this.closest( 'nav' ).classList.remove( 'toggled' );
								htmlEl.classList.remove( 'mobile-menu-open' );
							}, 200 );
						}
					}
				}, false );
			}
		}

		/**
		 * Dropdown click
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		var dropdownClick = function( e, _this ) {
			e.preventDefault();
			e.stopPropagation();

			if ( ! _this ) {
				var _this = this;
			}

			var closestLi = _this.closest( 'li' );

			// Close other sub-menus
			var openedSubMenus = _this.closest( 'nav' ).querySelectorAll( 'ul.toggled-on' );
			if ( openedSubMenus && ! _this.closest( 'ul' ).classList.contains( 'toggled-on' ) && ! _this.closest( 'li' ).classList.contains( 'sfHover' ) ) {
				for ( var o = 0; o < openedSubMenus.length; o++ ) {
					openedSubMenus[o].classList.remove( 'toggled-on' );
					openedSubMenus[o].closest( 'li' ).classList.remove( 'sfHover' );
				}
			}

			// Add sfHover class to parent li
			closestLi.classList.toggle( 'sfHover' );

			// Open the sub-menu
			if ( body.classList.contains( 'dropdown-click-menu-item' ) ) {
				_this.parentNode.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
			} else if ( body.classList.contains( 'dropdown-click-arrow' ) ) {
				closestLi.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
			}
		}

		// Do stuff if click dropdown if enabled
		if ( body.classList.contains( 'dropdown-click' ) ) {
			var parentElementLinks = document.querySelectorAll( '.main-nav .menu-item-has-children > a' );

			// Open the sub-menu by clicking on the entire link element
			if ( body.classList.contains( 'dropdown-click-menu-item' ) ) {
				for ( var i = 0; i < parentElementLinks.length; i++ ) {
					parentElementLinks[i].addEventListener( 'click', dropdownClick, true );
				}
			}

			// Open the sub-menu by clicking on a dropdown arrow
			if ( body.classList.contains( 'dropdown-click-arrow' ) ) {
				// Add a class to sub-menu items that are set to #
				for ( var i = 0; i < document.querySelectorAll( '.main-nav .menu-item-has-children > a' ).length; i++ ) {
					if ( '#' == document.querySelectorAll( '.main-nav .menu-item-has-children > a' )[i].getAttribute( 'href' ) ) {
						document.querySelectorAll( '.main-nav .menu-item-has-children > a' )[i].classList.add( 'menu-item-dropdown-click' );
					}
				}

				var dropdownToggleLinks = document.querySelectorAll( '.main-nav .menu-item-has-children > a .dropdown-menu-toggle' );
				for ( var i = 0; i < dropdownToggleLinks.length; i++ ) {
					dropdownToggleLinks[i].addEventListener( 'click', dropdownClick, false );

					dropdownToggleLinks[i].addEventListener( 'keydown', function( e ) {
						var _this = this;
						var key = e.which || e.keyCode;
						if ( key === 13 ) { // 13 is enter
							dropdownClick( e, _this );
						}
					}, false );
				}

				for ( var i = 0; i < document.querySelectorAll( '.main-nav .menu-item-has-children > a.menu-item-dropdown-click' ).length; i++ ) {
					document.querySelectorAll( '.main-nav .menu-item-has-children > a.menu-item-dropdown-click' )[i].addEventListener( 'click', dropdownClick, false );
				}
			}

			var closeSubMenus = function() {
				if ( document.querySelector( 'nav ul .toggled-on' ) ) {
					var activeSubMenus = document.querySelectorAll( 'nav ul .toggled-on' );
					for ( var i = 0; i < activeSubMenus.length; i++ ) {
						activeSubMenus[i].classList.remove( 'toggled-on' );
						activeSubMenus[i].closest( '.sfHover' ).classList.remove( 'sfHover' );
					}
				}
			}

			// Close sub-menus when clicking elsewhere
			document.addEventListener( 'click', function ( event ) {
				if ( ! event.target.closest( '.sfHover' ) ) {
					closeSubMenus();
				}
			}, false);

			// Close sub-menus on escape key
			document.addEventListener( 'keydown', function( e ) {
				var key = e.which || e.keyCode;
				if ( key === 27 ) { // 27 is esc
					closeSubMenus();
				}
			}, false );

		}
	}
})();