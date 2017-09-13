( function() {
    if ( 'querySelector' in document && 'addEventListener' in window ) {
		/**
		 * Navigation search.
		 *
		 * @param e The event.
		 * @param _this The clicked item.
		 */
		toggleSearch = function( e, item ) {
			e.preventDefault();

			if ( ! item ) {
				var item = this;
			}

			var nav = item.closest( 'nav' );

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
				form.classList.remove( 'nav-search-active' );
				item.classList.remove( 'active' );
			} else {
				form.style.display = 'block';
				item.style.opacity = '0';
				form.querySelector( 'input' ).focus();
				form.classList.add( 'nav-search-active' );

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
			var searchItems = document.querySelectorAll( '.search-item' );

			for ( var i = 0; i < searchItems.length; i++ ) {
				searchItems[i].addEventListener( 'click', toggleSearch, false );
			}

			// Close navigation search on click elsewhere
			document.addEventListener( 'click', function ( event ) {
				if ( document.querySelector( '.navigation-search.nav-search-active' ) ) {
					if ( ! event.target.closest( '.navigation-search' ) && ! event.target.closest( '.search-item' ) ) {
						var activeSearchItems = document.querySelectorAll( '.search-item.active' );
						for ( var i = 0; i < activeSearchItems.length; i++ ) {
							toggleSearch( event, activeSearchItems[i] );
						}
					}
				}
			}, false);

			// Close navigation search on escape key
			document.addEventListener( 'keydown', function( e ) {
				if ( document.querySelector( '.navigation-search.nav-search-active' ) ) {
					var key = e.which || e.keyCode;

					if ( key === 27 ) { // 27 is esc
						var activeSearchItems = document.querySelectorAll( '.search-item.active' );
						for ( var i = 0; i < activeSearchItems.length; i++ ) {
							toggleSearch( event, activeSearchItems[i] );
						}
					}
				}
			}, false );
		}
	}
})();