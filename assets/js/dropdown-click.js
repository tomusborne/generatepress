( function() {
	'use strict';

	if ( 'querySelector' in document && 'addEventListener' in window ) {
		var body = document.body,
			i;
		/**
		 * Dropdown click
		 *
		 * @param {Object} e The event.
		 * @param {Object} _this The clicked item.
		 */
		var dropdownClick = function( e, _this ) {
			e.preventDefault();
			e.stopPropagation();

			if ( ! _this ) {
				_this = this;
			}

			var closestLi = _this.closest( 'li' );

			// Close other sub-menus
			var openedSubMenus = _this.closest( 'nav' ).querySelectorAll( 'ul.toggled-on' );
			if ( openedSubMenus && ! _this.closest( 'ul' ).classList.contains( 'toggled-on' ) && ! _this.closest( 'li' ).classList.contains( 'sfHover' ) ) {
				for ( var o = 0; o < openedSubMenus.length; o++ ) {
					openedSubMenus[ o ].classList.remove( 'toggled-on' );
					openedSubMenus[ o ].closest( 'li' ).classList.remove( 'sfHover' );
				}
			}

			// Add sfHover class to parent li
			closestLi.classList.toggle( 'sfHover' );

			// Set aria-expanded on arrow
			var dropdownToggle = closestLi.querySelector( '.dropdown-menu-toggle' );
			if ( 'false' === dropdownToggle.getAttribute( 'aria-expanded' ) || ! dropdownToggle.getAttribute( 'aria-expanded' ) ) {
				dropdownToggle.setAttribute( 'aria-expanded', 'true' );
			} else {
				dropdownToggle.setAttribute( 'aria-expanded', 'false' );
			}

			if ( closestLi.querySelector( '.sub-menu' ) ) {
				var subMenuSelector = '.sub-menu';
			} else {
				subMenuSelector = '.children';
			}

			// Open the sub-menu
			if ( body.classList.contains( 'dropdown-click-menu-item' ) ) {
				_this.parentNode.querySelector( subMenuSelector ).classList.toggle( 'toggled-on' );
			} else if ( body.classList.contains( 'dropdown-click-arrow' ) ) {
				closestLi.querySelector( subMenuSelector ).classList.toggle( 'toggled-on' );
			}
		};

		// Do stuff if click dropdown if enabled
		var parentElementLinks = document.querySelectorAll( '.main-nav .menu-item-has-children > a' );

		// Open the sub-menu by clicking on the entire link element
		if ( body.classList.contains( 'dropdown-click-menu-item' ) ) {
			for ( i = 0; i < parentElementLinks.length; i++ ) {
				parentElementLinks[ i ].addEventListener( 'click', dropdownClick, true );
			}
		}

		// Open the sub-menu by clicking on a dropdown arrow
		if ( body.classList.contains( 'dropdown-click-arrow' ) ) {
			// Add a class to sub-menu items that are set to #
			for ( i = 0; i < document.querySelectorAll( '.main-nav .menu-item-has-children > a' ).length; i++ ) {
				if ( '#' === document.querySelectorAll( '.main-nav .menu-item-has-children > a' )[ i ].getAttribute( 'href' ) ) {
					document.querySelectorAll( '.main-nav .menu-item-has-children > a' )[ i ].classList.add( 'menu-item-dropdown-click' );
				}
			}

			var dropdownToggleLinks = document.querySelectorAll( '.main-nav .menu-item-has-children > a .dropdown-menu-toggle' );
			for ( i = 0; i < dropdownToggleLinks.length; i++ ) {
				dropdownToggleLinks[ i ].addEventListener( 'click', dropdownClick, false );

				dropdownToggleLinks[ i ].addEventListener( 'keydown', function( e ) {
					var _this = this;

					if ( 'Enter' === e.key ) {
						dropdownClick( e, _this );
					}
				}, false );
			}

			for ( i = 0; i < document.querySelectorAll( '.main-nav .menu-item-has-children > a.menu-item-dropdown-click' ).length; i++ ) {
				document.querySelectorAll( '.main-nav .menu-item-has-children > a.menu-item-dropdown-click' )[ i ].addEventListener( 'click', dropdownClick, false );
			}
		}

		var closeSubMenus = function() {
			if ( document.querySelector( 'nav ul .toggled-on' ) ) {
				var activeSubMenus = document.querySelectorAll( 'nav ul .toggled-on' );
				var activeDropdownToggles = document.querySelectorAll( 'nav .dropdown-menu-toggle' );
				for ( i = 0; i < activeSubMenus.length; i++ ) {
					activeSubMenus[ i ].classList.remove( 'toggled-on' );
					activeSubMenus[ i ].closest( '.sfHover' ).classList.remove( 'sfHover' );
				}

				for ( i = 0; i < activeDropdownToggles.length; i++ ) {
					activeDropdownToggles[ i ].setAttribute( 'aria-expanded', 'false' );
				}
			}
		};

		// Close sub-menus when clicking elsewhere
		document.addEventListener( 'click', function( event ) {
			if ( ! event.target.closest( '.sfHover' ) ) {
				closeSubMenus();
			}
		}, false );

		// Close sub-menus on escape key
		document.addEventListener( 'keydown', function( e ) {
			if ( 'Escape' === e.key ) { // 27 is esc
				closeSubMenus();
			}
		}, false );
	}
}() );
