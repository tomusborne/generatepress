( function() {
  'use strict';

	function scrollTo(element, to, duration) {
		if ( duration <= 0 ) {
			return;
		}

		var difference = to - element.scrollTop;
		var perTick = difference / duration * 10;

		setTimeout(function() {
			element.scrollTop = element.scrollTop + perTick;
			if ( element.scrollTop === to ) {
				return;
			}
			scrollTo(element, to, duration - 10);
		}, 10);
	}

	function trackScroll() {
		var scrolled = window.pageYOffset;
		var coords = goTopBtn.getAttribute( 'data-start-scroll' ) ;

		if ( scrolled > coords ) {
			goTopBtn.style.opacity = '1';
			goTopBtn.style.visibility = 'visible';
		}

		if (scrolled < coords) {
			goTopBtn.style.opacity = '0';
			goTopBtn.style.visibility = 'hidden';
		}
	}

	var goTopBtn = document.querySelector( '.generate-back-to-top' );

	window.addEventListener( 'scroll', trackScroll );

	goTopBtn.addEventListener( 'click', function( e ) {
		e.preventDefault();
		scrollTo( document.body, 0, goTopBtn.getAttribute( 'data-scroll-speed' ) );
	} );
} )();