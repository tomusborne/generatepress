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

	// Move up through the ancestors of the current link until we hit .nav-menu.
	while ( -1 === self.className.indexOf( 'main-nav' ) ) {

		// On li elements toggle the class .focus.
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

toggleMobileMenu = function( e ) {
	if ( isVisible( navToggle ) ) {
		e.preventDefault();
		var closestLi = getClosest( this, 'li' );
		closestLi.classList.toggle( 'sfHover' );
		closestLi.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
	}
	
	e.stopPropagation();
}

checkMobile = function() {
	for ( var i = 0; i < allNavToggles.length; i++ ) {
		if ( ! isVisible( allNavToggles[i] ) ) {
			var closestParent = getClosest( allNavToggles[i], 'nav.toggled' );
			var closestNav = closestParent.getElementsByTagName( 'ul' )[0];
			if ( closestParent ) {
				removeClass( closestParent, 'toggled' );
				removeClass( htmlEl, 'mobile-menu-open' );
				
				if ( closestNav ) {
					closestNav.setAttribute( 'aria-hidden', 'true' );
				}
			}
		}
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

for ( var i = 0; i < dropdownToggle.length; i++ ) {
	dropdownToggle[i].addEventListener( 'click', toggleMobileMenu, false );
}

for ( var i = 0; i < navLinks.length; i++ ) {
	navLinks[i].addEventListener( 'click', function( e ) {
		if ( isVisible( navToggle ) ) {
			var url = this.getAttribute( 'href' );
			if ( '#' == url || '' == url ) {
				e.preventDefault();
				var closestLi = getClosest( this, 'li' );
				closestLi.classList.toggle( 'sfHover' );
				closestLi.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
			}
			
			if ( '#' !== url && '' !== url ) {
				removeClass( parent, "toggled" );
				removeClass( htmlEl, 'mobile-menu-open' );
				nav.setAttribute( 'aria-hidden', 'true' );
			}
			
		}
	}, false );
}

window.addEventListener( 'resize', checkMobile, false );
window.addEventListener( 'orientationchange', checkMobile, false );

/**
 * Dropdown click
 */
dropdownClick = function( e, _this = this ) {
	e.preventDefault();
	console.log(_this);
	var closestLi = getClosest( _this, 'li' );
	var siblings = getSiblings( closestLi );
	var parent = getClosest( _this, 'nav' );
	
	if ( parent.classList.contains( '.main-navigation' ) ) {
		if ( isVisible( '.secondary-navigation ul.toggled-on' ) ) {
			var navLink = document.querySelector( '.secondary-navigation .main-nav .menu-item-has-children > a' );
			removeClass( navLink.parentNode, 'sfHover' );
		}
	}
	
	for ( var o = 0; o < siblings.length; o++ ) {
		
		// Close other sub-menus
		if ( siblings[o].querySelector( '.toggled-on' ) ) {
			siblings[o].querySelector( '.toggled-on' ).classList.remove( 'toggled-on' );
		}
		
		// Remove sfHover class from other menu items
		siblings[o].classList.remove( 'sfHover' );
		
	}
	
	// Add sfHover class to parent li
	closestLi.classList.toggle( 'sfHover' );

	if ( document.body.classList.contains( 'dropdown-click-menu-item' ) ) {
		_this.parentNode.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
	} else if ( document.body.classList.contains( 'dropdown-click-arrow' ) ) {
		closestLi.querySelector( '.sub-menu' ).classList.toggle( 'toggled-on' );
	}
}

if ( document.body.classList.contains( 'dropdown-click' ) ) {
	var parentElementLinks = document.querySelectorAll( '.sf-menu .menu-item-has-children > a' ),
		dropdownToggleLinks = document.querySelectorAll( '.sf-menu .menu-item-has-children > a .dropdown-menu-toggle' );
	
	
	if ( document.body.classList.contains( 'dropdown-click-menu-item' ) ) {
		for ( var i = 0; i < parentElementLinks.length; i++ ) {
			parentElementLinks[i].addEventListener( 'click', dropdownClick, false );
		}
	}
	
	if ( document.body.classList.contains( 'dropdown-click-arrow' ) ) {
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
					dropdownClick( e, this );
				}
			}, false );
		}
		
		for ( var i = 0; i < document.querySelectorAll( '.sf-menu .menu-item-has-children > a.menu-item-dropdown-click' ).length; i++ ) {
			document.querySelectorAll( '.sf-menu .menu-item-has-children > a.menu-item-dropdown-click' )[i].addEventListener( 'click', dropdownClick, false );
		}
	}
}