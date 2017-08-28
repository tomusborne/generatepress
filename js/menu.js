/**
 * Get the closest matching element up the DOM tree.
 * @private
 * @param  {Element} elem     Starting element
 * @param  {String}  selector Selector to match against
 * @return {Boolean|Element}  Returns null if not match found
 */
getClosest = function ( elem, selector ) {

    // Element.matches() polyfill
    if (!Element.prototype.matches) {
        Element.prototype.matches =
            Element.prototype.matchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector ||
            Element.prototype.oMatchesSelector ||
            Element.prototype.webkitMatchesSelector ||
            function(s) {
                var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                    i = matches.length;
                while (--i >= 0 && matches.item(i) !== this) {}
                return i > -1;
            };
    }

    // Get closest match
    for ( ; elem && elem !== document; elem = elem.parentNode ) {
        if ( elem.matches( selector ) ) return elem;
    }

    return null;

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

/**
 * Adds a class to any element
 *
 * @param {element} element
 * @param {string}  class
 */
addClass = function (el, cls) {
	if (el.className.indexOf(cls) !== 0) {
	  el.className += " " + cls;
	  el.className = el.className.replace(/(^\s*)|(\s*$)/g,"");
	}
}

/**
 * Remove a class from any element
 *
 * @param  {element} element
 * @param  {string}  class
 */
removeClass = function (el, cls) {
	var reg = new RegExp("(\\s|^)" + cls + "(\\s|$)");
	el.className = el.className.replace(reg, " ").replace(/(^\s*)|(\s*$)/g,"");
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

var parentElements = document.querySelectorAll( '.sf-menu .menu-item-has-children' ),
	nav,
	allNavToggles = document.querySelectorAll( '.menu-toggle' ),
	searchIcons = document.querySelectorAll( '.search-item a' ),
	navToggle = document.querySelector( '.menu-toggle' ),
	dropdownToggle = document.querySelectorAll( 'nav .dropdown-menu-toggle' ),
	navLinks = document.querySelectorAll( 'nav a' ),
	htmlEl = document.documentElement;

/**
 * Add sfHover class to menu items on hover
 */
var toggleSubMenu = function( e ) {
	var mobile = getClosest( this, '.main-nav' ).previousElementSibling;

	if ( isVisible( mobile ) ) {
		this.querySelector( 'ul' ).style.left = '-9999px';
		return;
	}

	this.classList.toggle( 'sfHover' );
}

for ( var i = 0; i < parentElements.length; i++ ) {
	if ( document.body.classList.contains( 'dropdown-hover' ) ) {
		parentElements[i].addEventListener( 'mouseenter', toggleSubMenu );
		parentElements[i].addEventListener( 'mouseleave', toggleSubMenu );
	}
}

/**
 * Make hover dropdown touch-friendly.
 */
if ( document.body.classList.contains( 'dropdown-hover' ) ) {
	if ('ontouchstart' in document.documentElement) {
		for ( var i = 0; i < parentElements.length; i++ ) {
			var $this = parentElements[i];
			var mobile = getClosest( this, '.main-nav' ).previousElementSibling;
			var closestParent = getClosest( $this.parentNode, '.menu-item-has-children' );

			if ( ! isVisible( mobile ) && ! closestParent.classList.contains( 'mega-menu' ) ) {
				this.addEventListener( 'touchstart', function( e ) {
					if ( e.touches.length === 1 ) {
						// Prevent touch events within dropdown bubbling down to document
						e.stopPropagation();

						// Toggle hover
						if ( ! $this.classList.contains( 'sfHover' ) ) {
							// Prevent link on first touch
							if ( e.target === this || e.target.parentNode === this ) {
								e.preventDefault();
							}
							
							var closestLi = getClosest( $this, 'li' );
							var siblings = getSiblings( closestLi );
							for ( var o = 0; o < siblings.length; o++ ) {

								if ( siblings[o].querySelector( '.toggled-on' ) ) {
									siblings[o].querySelector( '.toggled-on' ).classList.remove( 'toggled-on' );
								}

								siblings[o].classList.remove( 'sfHover' );

							}
							
							$this.classList.add( 'sfHover' );

							// Hide dropdown on touch outside
							document.addEventListener('touchstart', closeDropdown = function(e) {
								e.stopPropagation();

								$this.classList.remove( 'sfHover' );
								document.removeEventListener('touchstart', closeDropdown);
							});
						}
					}
				}, false);
			}
		}
	}
}

/**
 * Make menu items accessible
 */
var toggleFocus = function() {
	var mobile = getClosest( this, '.main-nav' ).previousElementSibling;

	if ( isVisible( mobile ) ) {
		return;
	}

	if ( document.body.classList.contains( 'dropdown-click' ) ) {
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
		parent = document.querySelector( this.getAttribute( 'data-nav' ) );
	} else {
		parent = getClosest( this, 'nav' );
	}

	nav = parent.getElementsByTagName( 'ul' )[0];

	if ( parent.classList.contains( 'toggled' ) ) {
		removeClass( parent, "toggled" );
		removeClass( htmlEl, 'mobile-menu-open' );
		nav.setAttribute( 'aria-hidden', 'true' );
	} else {
		addClass( parent, "toggled" );
		addClass( htmlEl, 'mobile-menu-open' );
		nav.setAttribute( 'aria-hidden', 'false' );
	}
}

for ( var i = 0; i < allNavToggles.length; i++ ) {
	allNavToggles[i].addEventListener( 'click', toggleNav, false );
	allNavToggles[i].addEventListener( 'keypress', function() {
		var key = e.which || e.keyCode;
		if (key === 13) { // 13 is enter
			toggleNav();
		}
	}, false );
}

// Open sub-menus
toggleSubNav = function( e ) {
	if ( isVisible( navToggle ) ) {
		e.preventDefault();
		var closestLi = getClosest( this, 'li' );
		closestLi.classList.toggle( 'sfHover' );
		closestLi.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
	}

	e.stopPropagation();
}

for ( var i = 0; i < dropdownToggle.length; i++ ) {
	dropdownToggle[i].addEventListener( 'click', toggleSubNav, false );
}

// Disable the mobile menu if the toggle isn't visible
checkMobile = function() {
	for ( var i = 0; i < allNavToggles.length; i++ ) {
		if ( ! isVisible( allNavToggles[i] ) ) {
			var closestParent = getClosest( allNavToggles[i], 'nav' );
			var closestNav = closestParent.getElementsByTagName( 'ul' )[0];
			var closestNavItems = closestNav.getElementsByTagName( 'li' );
			var closestSubMenus = closestNav.getElementsByTagName( 'ul' );
			if ( closestParent ) {
				removeClass( closestParent, 'toggled' );
				removeClass( htmlEl, 'mobile-menu-open' );

				for ( var li = 0; li < closestNavItems.length; li++ ) {
					removeClass( closestNavItems[li], 'sfHover' );
				}

				for ( var sm = 0; sm < closestSubMenus.length; sm++ ) {
					removeClass( closestSubMenus[sm], 'toggled-on' );
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
	navLinks[i].addEventListener( 'click', function( e ) {
		if ( isVisible( navToggle ) ) {
			var url = this.getAttribute( 'href' );

			// Open the sub-menu if the link has no destination
			if ( '#' == url || '' == url ) {
				e.preventDefault();
				var closestLi = getClosest( this, 'li' );
				closestLi.classList.toggle( 'sfHover' );
				var subMenu = closestLi.querySelector( '.sub-menu' );

				if ( subMenu ) {
					subMenu.classList.toggle( 'toggled-on' );
				}
			}

			// Close the mobile menu if our link does something
			if ( '#' !== url && '' !== url ) {
				removeClass( parent, "toggled" );
				removeClass( htmlEl, 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'true' );
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
	var closestLi = getClosest( _this, 'li' );
	var siblings = getSiblings( closestLi );
	var parent = getClosest( _this, 'nav' );

	// Close the secondary menu if we're clicking inside the main menu
	if ( parent.classList.contains( '.main-navigation' ) ) {
		if ( isVisible( '.secondary-navigation ul.toggled-on' ) ) {
			var navLink = document.querySelector( '.secondary-navigation .main-nav .menu-item-has-children > a' );
			removeClass( navLink.parentNode, 'sfHover' );
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

	var parentElementLinks = document.querySelectorAll( '.sf-menu .menu-item-has-children > a' ),
		dropdownToggleLinks = document.querySelectorAll( '.sf-menu .menu-item-has-children > a .dropdown-menu-toggle' );

	// Open the sub-menu by clicking on the entire link element
	if ( document.body.classList.contains( 'dropdown-click-menu-item' ) ) {
		for ( var i = 0; i < parentElementLinks.length; i++ ) {
			parentElementLinks[i].addEventListener( 'click', dropdownClick, true );
		}
	}

	// Open the sub-menu by clicking on a dropdown arrow
	if ( document.body.classList.contains( 'dropdown-click-arrow' ) ) {

		// Add a class to sub-menu items that are set to #
		for ( var i = 0; i < document.querySelectorAll( '.sf-menu .menu-item-has-children > a' ).length; i++ ) {
			if ( '#' == document.querySelectorAll( '.sf-menu .menu-item-has-children > a' )[i].getAttribute( 'href' ) ) {
				document.querySelectorAll( '.sf-menu .menu-item-has-children > a' )[i].classList.add( 'menu-item-dropdown-click' );
			}
		}

		for ( var i = 0; i < dropdownToggleLinks.length; i++ ) {
			dropdownToggleLinks[i].addEventListener( 'click', dropdownClick, false );

			dropdownToggleLinks[i].addEventListener( 'keydown', function( e ) {
				var key = e.which || e.keyCode;
				if ( key === 13 ) { // 13 is enter
					dropdownClick( e );
				}
			}, false );
		}

		for ( var i = 0; i < document.querySelectorAll( '.sf-menu .menu-item-has-children > a.menu-item-dropdown-click' ).length; i++ ) {
			document.querySelectorAll( '.sf-menu .menu-item-has-children > a.menu-item-dropdown-click' )[i].addEventListener( 'click', dropdownClick, false );
		}
	}

}

// Navigation search
toggleSearch = function( e ) {
  e.preventDefault();
	var item = this.parentNode;
	var nav = getClosest( item, 'nav' );

	if ( item.getAttribute( 'data-nav' ) ) {
		nav = document.querySelector( this.getAttribute( 'data-nav' ) );
	}

	var form = nav.querySelector( '.navigation-search' );

	if ( isVisible( form ) ) {
		item.querySelector( 'i' ).classList.remove( 'fa-close' );
		item.querySelector( 'i' ).classList.add( 'fa-search' );
		item.style.opacity = '1';
		item.style.float = '';
		form.style.display = 'none';
		item.classList.remove( 'active' );
	} else {
		item.style.opacity = '0';
		form.style.display = 'block';
		form.querySelector( 'input' ).focus();

		setTimeout( function() {
			item.querySelector( 'i' ).classList.remove( 'fa-search' );
			item.querySelector( 'i' ).classList.add( 'fa-close' );
			item.classList.add( 'active' );
			
			if ( document.body.classList.contains( 'rtl' ) ) {
				item.style.float = 'left';
			} else {
				item.style.float = 'right';
			}

			item.style.opacity = '1';
		}, 250 );
	}
}
if ( document.body.classList.contains( 'nav-search-enabled' ) ) {
	for ( var i = 0; i < searchIcons.length; i++ ) {
		searchIcons[i].addEventListener( 'click', toggleSearch, false );
	};
}