( function() {
    if ( 'querySelector' in document && 'addEventListener' in window ) {
		/**
		 * closest() pollyfil
		 * @see https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Browser_compatibility
		 */
		if ( ! Element.prototype.closest ) {
			Element.prototype.closest = function (s) {
				var matches = (this.document || this.ownerDocument).querySelectorAll(s),
					i,
					el = this;
				do {
					i = matches.length;
					while (--i >= 0 && matches.item(i) !== el) {};
				} while ((i < 0) && (el = el.parentElement));
				return el;
			};
		}

		/**
		 * Check if an element is visible
		 *
		 * @param  {element} element
		 */
		isVisible = function (el) {
			if ( el.offsetParent === null ) {
				return false;
			}

			return true;
		}

		if ( ! Element.prototype.siblings ) {
			Element.prototype.siblings = function () {
				var siblings = [];
				var sibling = this.parentNode.firstChild;
				for (; sibling; sibling = sibling.nextSibling) {
					if (sibling.nodeType !== 1 || sibling === this) continue;
					siblings.push(sibling);
				}
				return siblings;
			}
		}

		var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' ),
			nav,
			allNavToggles = document.querySelectorAll( '.menu-toggle' ),
			dropdownToggle = document.querySelectorAll( 'nav .dropdown-menu-toggle' ),
			navLinks = document.querySelectorAll( 'nav ul a' ),
			touchEvent = 'ontouchend' in document.documentElement ? 'touchend' : 'click',
			htmlEl = document.documentElement,
			secondaryNavItems = document.querySelectorAll( '.secondary-navigation .menu-item-has-children' );

		/**
		 * Start mobile menu toggle.
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		toggleNav = function( e, _this ) {
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

				if ( document.body.classList.contains( 'dropdown-hover' ) ) {
					var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );
					for ( var i = 0; i < dropdownItems.length; i++ ) {
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'tabindex', '' );
					}
				}
			} else {
				parentContainer.classList.add( 'toggled' );
				htmlEl.classList.add( 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'false' );

				if ( document.body.classList.contains( 'dropdown-hover' ) ) {
					var dropdownItems = nav.querySelectorAll( 'li.menu-item-has-children' );
					for ( var i = 0; i < dropdownItems.length; i++ ) {
						dropdownItems[i].querySelector( '.dropdown-menu-toggle' ).setAttribute( 'tabindex', '0' );
					}
				}
			}
		}

		for ( var i = 0; i < allNavToggles.length; i++ ) {
			allNavToggles[i].addEventListener( touchEvent, toggleNav, false );
		}

		/**
		 * Open sub-menus
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		toggleSubNav = function( e, _this ) {

			if ( ! _this ) {
				var _this = this;
			}

			if ( ( _this.closest( 'nav' ).classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) && ! document.body.classList.contains( 'dropdown-click' ) ) {
				e.preventDefault();
				var closestLi = _this.closest( 'li' );

				var subMenu = closestLi.querySelector( '.sub-menu' );

				closestLi.classList.toggle( 'sfHover' );
				subMenu.classList.toggle( 'toggled-on' );
			}

			e.stopPropagation();
		}

		for ( var i = 0; i < dropdownToggle.length; i++ ) {
			dropdownToggle[i].addEventListener( touchEvent, toggleSubNav, false );
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
		checkMobile = function() {
			for ( var i = 0; i < allNavToggles.length; i++ ) {
				if ( ! isVisible( allNavToggles[i] ) ) {
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

		/**
		 * Do some essential things when menu items are clicked.
		 */
		for ( var i = 0; i < navLinks.length; i++ ) {
			navLinks[i].addEventListener( touchEvent, function( e ) {
				if ( ( this.closest( 'nav' ).classList.contains( 'toggled' ) || htmlEl.classList.contains( 'slide-opened' ) ) && ! document.body.classList.contains( 'dropdown-click' ) ) {
					var parent = this.closest( 'nav' );
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
							parent.classList.remove( 'toggled' );
							htmlEl.classList.remove( 'mobile-menu-open' );
							nav.setAttribute( 'aria-hidden', 'true' );
						}, 200 );
					}
				}
			}, false );
		}

		if ( document.body.classList.contains( 'dropdown-hover' ) ) {
			/**
			 * Make menu items tab accessible when using the hover dropdown type
			 */
			var toggleFocus = function() {
				if ( this.closest( 'nav' ).classList.contains( 'toggled' ) ) {
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
			if ( 'ontouchstart' in document.documentElement ) {
				for ( var i = 0; i < parentElements.length; i++ ) {
					var $this = parentElements[i];
					var closestParent = $this.parentNode.closest( '.menu-item-has-children' );

					if ( ! $this.closest( 'nav' ).classList.contains( 'toggled' ) ) {
						$this.addEventListener( 'touchstart', function( e ) {
							if ( e.touches.length === 1 ) {
								// Prevent touch events within dropdown bubbling down to document
								e.stopPropagation();

								// Toggle hover
								if ( ! this.classList.contains( 'sfHover' ) ) {
									// Prevent link on first touch
									if ( e.target === this || e.target.parentNode === this ) {
										e.preventDefault();
									}

									var closestLi = this.closest( 'li' );
									var siblings = closestLi.siblings();
									for ( var o = 0; o < siblings.length; o++ ) {

										if ( siblings[o].querySelector( '.toggled-on' ) ) {
											siblings[o].querySelector( '.toggled-on' ).classList.remove( 'toggled-on' );
										}

										siblings[o].classList.remove( 'sfHover' );

									}

									this.classList.add( 'sfHover' );

									// Hide dropdown on touch outside
									document.addEventListener( 'touchstart', closeDropdown = function(e) {
										e.stopPropagation();

										this.classList.remove( 'sfHover' );
										document.removeEventListener( 'touchstart', closeDropdown );
									} );
								}
							}
						}, true );
					}
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

			for ( var i = 0; i < secondaryNavItems.length; i++ ) {
					secondaryNavItems[i].addEventListener( 'mouseenter', addFocusClass );
					secondaryNavItems[i].addEventListener( 'mouseleave', addFocusClass );
			}
		}

		/**
		 * Dropdown click
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		dropdownClick = function( e, _this ) {
			e.preventDefault();
			e.stopPropagation();

			if ( ! _this ) {
				var _this = this;
			}

			var closestLi = _this.closest( 'li' );
			var siblings = closestLi.siblings();
			var parent = _this.closest( 'nav' );

			// Close the secondary menu if we're clicking inside the main menu
			if ( parent.classList.contains( '.main-navigation' ) ) {
				if ( isVisible( document.querySelector( '.secondary-navigation ul.toggled-on' ) ) ) {
					var navLink = document.querySelector( '.secondary-navigation .main-nav .menu-item-has-children > a' );
					navLink.parentNode.classList.remove( 'sfHover' );
				}
			}

			// Close other sub-menus
			for ( var o = 0; o < siblings.length; o++ ) {
				if ( siblings[o].querySelector( '.toggled-on' ) ) {
					siblings[o].querySelector( '.toggled-on' ).classList.remove( 'toggled-on' );
				}

				siblings[o].classList.remove( 'sfHover' );
			}

			// Add sfHover class to parent li
			closestLi.classList.toggle( 'sfHover' );

			// Open the sub-menu
			if ( document.body.classList.contains( 'dropdown-click-menu-item' ) ) {
				_this.parentNode.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
			} else if ( document.body.classList.contains( 'dropdown-click-arrow' ) ) {
				closestLi.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
			}
		}

		// Do stuff if click dropdown if enabled
		if ( document.body.classList.contains( 'dropdown-click' ) ) {

			var parentElementLinks = document.querySelectorAll( '.main-nav .menu-item-has-children > a' );

			// Open the sub-menu by clicking on the entire link element
			if ( document.body.classList.contains( 'dropdown-click-menu-item' ) ) {
				for ( var i = 0; i < parentElementLinks.length; i++ ) {
					parentElementLinks[i].addEventListener( touchEvent, dropdownClick, true );
				}
			}

			// Open the sub-menu by clicking on a dropdown arrow
			if ( document.body.classList.contains( 'dropdown-click-arrow' ) ) {

				// Add a class to sub-menu items that are set to #
				for ( var i = 0; i < document.querySelectorAll( '.main-nav .menu-item-has-children > a' ).length; i++ ) {
					if ( '#' == document.querySelectorAll( '.main-nav .menu-item-has-children > a' )[i].getAttribute( 'href' ) ) {
						document.querySelectorAll( '.main-nav .menu-item-has-children > a' )[i].classList.add( 'menu-item-dropdown-click' );
					}
				}

				var dropdownToggleLinks = document.querySelectorAll( '.main-nav .menu-item-has-children > a .dropdown-menu-toggle' );
				for ( var i = 0; i < dropdownToggleLinks.length; i++ ) {
					dropdownToggleLinks[i].addEventListener( touchEvent, dropdownClick, false );

					dropdownToggleLinks[i].addEventListener( 'keydown', function( e ) {
						var _this = this;
						var key = e.which || e.keyCode;
						if ( key === 13 ) { // 13 is enter
							dropdownClick( e, _this );
						}
					}, false );
				}

				for ( var i = 0; i < document.querySelectorAll( '.main-nav .menu-item-has-children > a.menu-item-dropdown-click' ).length; i++ ) {
					document.querySelectorAll( '.main-nav .menu-item-has-children > a.menu-item-dropdown-click' )[i].addEventListener( touchEvent, dropdownClick, false );
				}
			}

			// Close sub-menus when clicking elsewhere
			document.addEventListener( 'click', function ( event ) {
				if ( document.querySelector( 'nav ul .toggled-on' ) ) {
					if ( ! event.target.closest( '.sfHover' ) ) {
						var activeSubMenus = document.querySelectorAll( 'nav ul .toggled-on' );
						for ( var i = 0; i < activeSubMenus.length; i++ ) {
							activeSubMenus[i].classList.remove( 'toggled-on' );
							activeSubMenus[i].closest( '.sfHover' ).classList.remove( 'sfHover' );
						}
					}
				}
			}, false);

			// Close sub-menus on escape key
			document.addEventListener( 'keydown', function( e ) {
				if ( document.querySelector( 'nav ul .toggled-on' ) ) {
					var key = e.which || e.keyCode;

					if ( key === 27 ) { // 27 is esc
						var activeSubMenus = document.querySelectorAll( 'nav ul .toggled-on' );
						for ( var i = 0; i < activeSubMenus.length; i++ ) {
							activeSubMenus[i].classList.remove( 'toggled-on' );
							activeSubMenus[i].closest( '.sfHover' ).classList.remove( 'sfHover' );
						}
					}
				}
			}, false );

		}
	}
})();