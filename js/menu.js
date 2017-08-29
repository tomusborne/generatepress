/**
 * .closest() pollyfil
 */
if ( window.Element && ! Element.prototype.closest ) {
	Element.prototype.closest = 
	function(s) {
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

getSiblings = function (elem) {
	var siblings = [];
	var sibling = elem.parentNode.firstChild;
	for (; sibling; sibling = sibling.nextSibling) {
		if (sibling.nodeType !== 1 || sibling === elem) continue;
		siblings.push(sibling);
	}
	return siblings;
}

Element.prototype.hasClass = function (className) {
	if ( this.classList ) {
		return this.classList.contains( className );
	} else {
		return new RegExp(' ' + className + ' ').test(' ' + this.className + ' ');
	}
};

Element.prototype.addClass = function (className) {
	if ( this.classList ) {
		this.classList.add( className );
	} else {
		if ( ! this.hasClass( className ) ) {
			this.className += ' ' + className;
		}
	}
};

Element.prototype.removeClass = function (className) {
	if ( this.classList ) {
		this.classList.remove( className );
	} else {
		var newClass = ' ' + this.className.replace(/[\t\r\n]/g, ' ') + ' '
		if (this.hasClass(className)) {
			while (newClass.indexOf( ' ' + className + ' ') >= 0) {
				newClass = newClass.replace(' ' + className + ' ', ' ');
			}
			this.className = newClass.replace(/^\s+|\s+$/g, ' ');
		}
	}
};

Element.prototype.toggleClass = function (className) {
	if ( this.classList ) {
		this.classList.toggle( className );
	} else {
		var newClass = ' ' + this.className.replace(/[\t\r\n]/g, " ") + ' ';
		if (this.hasClass(className)) {
			while (newClass.indexOf(" " + className + " ") >= 0) {
				newClass = newClass.replace(" " + className + " ", " ");
			}
			this.className = newClass.replace(/^\s+|\s+$/g, ' ');
		} else {
			this.className += ' ' + className;
		}
	}
};

var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' ),
	nav,
	allNavToggles = document.querySelectorAll( '.menu-toggle' ),
	searchIcons = document.querySelectorAll( '.search-item a' ),
	navToggle = document.querySelector( '.menu-toggle' ),
	dropdownToggle = document.querySelectorAll( 'nav .dropdown-menu-toggle' ),
	navLinks = document.querySelectorAll( 'nav a' ),
	touchEvent = 'ontouchstart' in document.documentElement ? 'touchstart' : 'click',
	htmlEl = document.documentElement;

/**
 * Add sfHover class to menu items on hover
 */
var toggleSubMenu = function( e ) {
	var mobile = this.closest( '.main-nav' ).previousElementSibling;

	if ( isVisible( mobile ) ) {
		return;
	}

	this.toggleClass( 'sfHover' );
}

for ( var i = 0; i < parentElements.length; i++ ) {
	if ( document.body.hasClass( 'dropdown-hover' ) ) {
		parentElements[i].addEventListener( 'mouseenter', toggleSubMenu );
		parentElements[i].addEventListener( 'mouseleave', toggleSubMenu );
	}
}

/**
 * Make hover dropdown touch-friendly.
 */
if ( document.body.hasClass( 'dropdown-hover' ) ) {
	if ( 'ontouchstart' in document.documentElement ) {
		for ( var i = 0; i < parentElements.length; i++ ) {
			var $this = parentElements[i];
			var mobile = $this.closest( '.main-nav' ).previousElementSibling;
			var closestParent = $this.parentNode.closest( '.menu-item-has-children' );
			
			if ( isVisible( mobile ) ) {
				// do nothing
			} else {
				$this.addEventListener( 'touchstart', function( e ) {
					if ( e.touches.length === 1 ) {
						// Prevent touch events within dropdown bubbling down to document
						e.stopPropagation();

						// Toggle hover
						if ( ! this.hasClass( 'sfHover' ) ) {
							// Prevent link on first touch
							if ( e.target === this || e.target.parentNode === this ) {
								e.preventDefault();
							}
							
							var closestLi = this.closest( 'li' );
							var siblings = getSiblings( closestLi );
							for ( var o = 0; o < siblings.length; o++ ) {

								if ( siblings[o].querySelector( '.toggled-on' ) ) {
									siblings[o].querySelector( '.toggled-on' ).removeClass( 'toggled-on' );
								}

								siblings[o].removeClass( 'sfHover' );

							}
							
							this.addClass( 'sfHover' );

							// Hide dropdown on touch outside
							document.addEventListener('touchstart', closeDropdown = function(e) {
								e.stopPropagation();

								this.removeClass( 'sfHover' );
								document.removeEventListener('touchstart', closeDropdown);
							});
						}
					}
				}, true );
			}
		}
	}
}

/**
 * Make menu items accessible
 */
var toggleFocus = function() {
	var mobile = this.closest( '.main-nav' ).previousElementSibling;

	if ( isVisible( mobile ) ) {
		return;
	}

	if ( document.body.hasClass( 'dropdown-click' ) ) {
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
 * Start mobile menu toggle
 */
toggleNav = function() {
	if ( this.getAttribute( 'data-nav' ) ) {
		parentContainer = document.getElementById( this.getAttribute( 'data-nav' ) );
	} else {
		parentContainer = document.getElementById( this.closest( 'nav' ).getAttribute( 'id' ) );
	}

	nav = parentContainer.getElementsByTagName( 'ul' )[0];

	if ( parentContainer.hasClass( 'toggled' ) ) {
		parentContainer.removeClass( 'toggled' );
		htmlEl.removeClass( 'mobile-menu-open' );
		nav.setAttribute( 'aria-hidden', 'true' );
	} else {
		parentContainer.addClass( 'toggled' );
		htmlEl.addClass( 'mobile-menu-open' );
		nav.setAttribute( 'aria-hidden', 'false' );
	}
}

for ( var i = 0; i < allNavToggles.length; i++ ) {
	allNavToggles[i].addEventListener( touchEvent, toggleNav, false );
	allNavToggles[i].addEventListener( 'keypress', function() {
		var key = e.which || e.keyCode;
		if (key === 13) { // 13 is enter
			toggleNav();
		}
	}, false );
}

// Open sub-menus
toggleSubNav = function( e ) {
	if ( isVisible( navToggle ) && ! document.body.hasClass( 'dropdown-click' ) ) {
		e.preventDefault();
		var closestLi = this.closest( 'li' );
		var subMenu = closestLi.querySelector( '.sub-menu' );

		closestLi.toggleClass( 'sfHover' );
		subMenu.toggleClass( 'toggled-on' );
	}

	e.stopPropagation();
}

for ( var i = 0; i < dropdownToggle.length; i++ ) {
	dropdownToggle[i].addEventListener( touchEvent, toggleSubNav, false );
}

// Disable the mobile menu if the toggle isn't visible
checkMobile = function() {
	for ( var i = 0; i < allNavToggles.length; i++ ) {
		if ( ! isVisible( allNavToggles[i] ) ) {
			var closestParent = allNavToggles[i].closest( 'nav' );
			var closestNav = closestParent.getElementsByTagName( 'ul' )[0];
			var closestNavItems = closestNav.getElementsByTagName( 'li' );
			var closestSubMenus = closestNav.getElementsByTagName( 'ul' );
			if ( closestParent ) {
				closestParent.removeClass( 'toggled' );
				htmlEl.removeClass( 'mobile-menu-open' );

				for ( var li = 0; li < closestNavItems.length; li++ ) {
					closestNavItems[li].removeClass( 'sfHover' );
				}

				for ( var sm = 0; sm < closestSubMenus.length; sm++ ) {
					closestSubMenus[sm].removeClass( 'toggled-on' );
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

// Do things when nav links are clicked
for ( var i = 0; i < navLinks.length; i++ ) {
	navLinks[i].addEventListener( touchEvent, function( e ) {
		if ( isVisible( navToggle ) && ! document.body.hasClass( 'dropdown-click' ) ) {
			var parent = this.closest( 'nav' );
			var url = this.getAttribute( 'href' );

			// Open the sub-menu if the link has no destination
			if ( '#' == url || '' == url ) {
				e.preventDefault();
				var closestLi = this.closest( 'li' );
				closestLi.toggleClass( 'sfHover' );
				var subMenu = closestLi.querySelector( '.sub-menu' );

				if ( subMenu ) {
					subMenu.toggleClass( 'toggled-on' );
				}
			}

			// Close the mobile menu if our link does something
			if ( '#' !== url && '' !== url && ! navigator.userAgent.match( /iemobile/i ) ) {
				setTimeout( function() {
					parent.removeClass( 'toggled' );
					htmlEl.removeClass( 'mobile-menu-open' );
					nav.setAttribute( 'aria-hidden', 'true' );
				}, 200 );
			}
		}
	}, false );
}

/**
 * Dropdown click
 */
dropdownClick = function( e ) {
	e.preventDefault();
	var _this = this;
	var closestLi = _this.closest( 'li' );
	var siblings = getSiblings( closestLi );
	var parent = _this.closest( 'nav' );

	// Close the secondary menu if we're clicking inside the main menu
	if ( parent.hasClass( '.main-navigation' ) ) {
		if ( isVisible( '.secondary-navigation ul.toggled-on' ) ) {
			var navLink = document.querySelector( '.secondary-navigation .main-nav .menu-item-has-children > a' );
			navLink.parentNode.removeClass( 'sfHover' );
		}
	}

	// Close other sub-menus
	for ( var o = 0; o < siblings.length; o++ ) {
		if ( siblings[o].querySelector( '.toggled-on' ) ) {
			siblings[o].querySelector( '.toggled-on' ).removeClass( 'toggled-on' );
		}

		siblings[o].removeClass( 'sfHover' );
	}

	// Add sfHover class to parent li
	closestLi.toggleClass( 'sfHover' );

	// Open the sub-menu
	if ( document.body.hasClass( 'dropdown-click-menu-item' ) ) {
		_this.parentNode.querySelector( '.sub-menu' ).toggleClass( 'toggled-on' );
	} else if ( document.body.hasClass( 'dropdown-click-arrow' ) ) {
		closestLi.querySelector( '.sub-menu' ).toggleClass( 'toggled-on' );
	}

	return false;
}

// Do stuff if click dropdown if enabled
if ( document.body.hasClass( 'dropdown-click' ) ) {

	var parentElementLinks = document.querySelectorAll( '.sf-menu .menu-item-has-children > a' );

	// Open the sub-menu by clicking on the entire link element
	if ( document.body.hasClass( 'dropdown-click-menu-item' ) ) {
		for ( var i = 0; i < parentElementLinks.length; i++ ) {
			parentElementLinks[i].addEventListener( touchEvent, dropdownClick, true );
		}
	}

	// Open the sub-menu by clicking on a dropdown arrow
	if ( document.body.hasClass( 'dropdown-click-arrow' ) ) {

		// Add a class to sub-menu items that are set to #
		for ( var i = 0; i < document.querySelectorAll( '.sf-menu .menu-item-has-children > a' ).length; i++ ) {
			if ( '#' == document.querySelectorAll( '.sf-menu .menu-item-has-children > a' )[i].getAttribute( 'href' ) ) {
				document.querySelectorAll( '.sf-menu .menu-item-has-children > a' )[i].addClass( 'menu-item-dropdown-click' );
			}
		}

		var dropdownToggleLinks = document.querySelectorAll( '.sf-menu .menu-item-has-children > a .dropdown-menu-toggle' );
		for ( var i = 0; i < dropdownToggleLinks.length; i++ ) {
			dropdownToggleLinks[i].addEventListener( touchEvent, dropdownClick, false );

			dropdownToggleLinks[i].addEventListener( 'keydown', function( e ) {
				var key = e.which || e.keyCode;
				if ( key === 13 ) { // 13 is enter
					dropdownClick( e );
				}
			}, false );
		}

		for ( var i = 0; i < document.querySelectorAll( '.sf-menu .menu-item-has-children > a.menu-item-dropdown-click' ).length; i++ ) {
			document.querySelectorAll( '.sf-menu .menu-item-has-children > a.menu-item-dropdown-click' )[i].addEventListener( touchEvent, dropdownClick, false );
		}
	}

}

// Navigation search
toggleSearch = function( e, item ) {
	e.preventDefault();
	
	if ( ! item ) {
		var item = this.parentNode;
	}

	var nav = item.closest( 'nav' );

	if ( item.getAttribute( 'data-nav' ) ) {
		nav = document.querySelector( this.getAttribute( 'data-nav' ) );
	}

	var form = nav.querySelector( '.navigation-search' );

	if ( isVisible( form ) ) {
		item.querySelector( 'i' ).removeClass( 'fa-close' );
		item.querySelector( 'i' ).addClass( 'fa-search' );
		item.style.opacity = '1';
		item.style.float = '';
		form.style.display = 'none';
		form.removeClass( 'nav-search-active' );
		item.removeClass( 'active' );
	} else {
		form.style.display = 'block';
		item.style.opacity = '0';
		form.querySelector( 'input' ).focus();
		form.addClass( 'nav-search-active' );

		setTimeout( function() {
			item.querySelector( 'i' ).removeClass( 'fa-search' );
			item.querySelector( 'i' ).addClass( 'fa-close' );
			item.addClass( 'active' );
			
			if ( document.body.hasClass( 'rtl' ) ) {
				item.style.float = 'left';
			} else {
				item.style.float = 'right';
			}

			item.style.opacity = '1';
		}, 250 );
	}
}
if ( document.body.hasClass( 'nav-search-enabled' ) ) {
	for ( var i = 0; i < searchIcons.length; i++ ) {
		searchIcons[i].addEventListener( touchEvent, toggleSearch, false );
	};

	document.addEventListener( 'keydown', function( e ) {
		if ( document.querySelector( '.navigation-search' ).hasClass( 'nav-search-active' ) ) {
			var key = e.which || e.keyCode;

			if ( key === 27 ) { // 27 is esc
				toggleSearch( e, document.querySelector( '.search-item.active a' ) );
			}
		}
	}, false );
}