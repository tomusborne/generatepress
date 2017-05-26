(function ( $ ) {
	$.fn.GenerateDropdownMenu = function( options ) {
		// Set the default settings
		var settings = $.extend({
			transition: 'slide',
			transition_speed: 150,
			open_delay: 300,
			close_delay: 300
		}, options );
		
		var $dropdowns, mobile, slideout, click = true;
		
		$dropdowns = $( this );
		mobile = $( '.menu-toggle' );
		slideout = $( '.slideout-navigation' );
		
		$dropdowns.attr( 'aria-haspopup', 'true' );
		$dropdowns.children( 'ul' ).css( {
			'display': 'none',
			'opacity': 0
		});
		
		over = function() {
			var $this = $(this);
			mobile = $this.closest( '.main-nav' ).prevAll( '.menu-toggle' );
			
			if ( mobile.is( ':visible' ) )
				return;
			
			if ( $this.parent().closest( '.menu-item-has-children' ).hasClass( 'mega-menu' ) )
				return;

			if ($this.prop('hoverTimeout')) {
				$this.prop('hoverTimeout', clearTimeout($this.prop('hoverTimeout')));
			}

			$this.prop('hoverIntent', setTimeout(function() {
				if ( 'slide' == settings.transition ) {
					$this.children( 'ul' )
						.slideDown( settings.transition_speed )
						.animate(
							{ opacity: 1 },
							{ queue: false, duration: 'fast' }
						).css( 'display','block' );
				} else {
					$this.children( 'ul' ).fadeIn( settings.transition_speed ).css( 'display','block' );
				}
				$this.addClass('sfHover');
			}, settings.open_delay));
		}
		
		out = function() {
			var $this = $(this);
			mobile = $this.closest( '.main-nav' ).prevAll( '.menu-toggle' );
			
			if ( mobile.is( ':visible' ) )
				return;

			if ($this.prop('hoverIntent')) {
				$this.prop('hoverIntent', clearTimeout($this.prop('hoverIntent')));
			}

			$this.prop('hoverTimeout', setTimeout(function() {
				$this.children( 'ul' ).fadeTo( 10, 0, function() {
					$this.children( 'ul' ).css( 'display','none' );
				});
				$this.removeClass('sfHover');
			}, settings.close_delay));
		}
		
		$dropdowns.on( 'mouseenter', over ).on( 'mouseleave', out );
		$dropdowns.on( 'focusin', over ).on( 'focusout', out );
		
		if (  document.addEventListener  ) {
			if ('ontouchstart' in document.documentElement) {
				$dropdowns.each(function() {
					var $this = $(this);
					mobile = $this.closest( '.main-nav' ).prevAll( '.menu-toggle' );
					
					if ( mobile.is( ':visible' ) )
						return;
					
					if ( $this.parent().closest( '.menu-item-has-children' ).hasClass( 'mega-menu' ) )
						return;

					this.addEventListener('touchstart', function(e) {
						if (e.touches.length === 1) {
							// Prevent touch events within dropdown bubbling down to document
							e.stopPropagation();

							// Toggle hover
							if (!$this.hasClass('sfHover')) {
								// Prevent link on first touch
								if (e.target === this || e.target.parentNode === this) {
									e.preventDefault();
								}
								
								click = false;

								// Hide other open dropdowns
								$this.siblings().removeClass('sfHover');
								$this.siblings().children( 'ul' ).css({
									'display': 'none',
									'opacity': 0
								});
								
								// Show this dropdown
								$this.addClass('sfHover');
								$this.children( 'ul' ).css({
									'display': 'block',
									'opacity': 1
								});

								// Hide dropdown on touch outside
								document.addEventListener('touchstart', closeDropdown = function(e) {
									e.stopPropagation();

									$this.removeClass('sfHover');
									$this.children( 'ul' ).css({
										'display': 'none',
										'opacity': 0
									});
									document.removeEventListener('touchstart', closeDropdown);
								});
							}
						}
					}, false);
				});
			}
		}

		$( '.dropdown-menu-toggle' ).on( 'click', function() {
			mobile = $( this ).closest( '.main-nav' ).prevAll( '.menu-toggle' );
			if ( mobile.is( ':visible' ) || 'visible' == slideout.css( 'visibility' ) ) {
				return;
			}
			var url = $( this ).parent().attr( 'href' );
			if ( typeof url != 'undefined' && click ) {
				window.location.href = $( this ).parent().attr( 'href' );
			}
		});

		
		$.fn.GenerateDropdownMenu.destroy = function() {
			$dropdowns.children( 'ul' ).css( 'display','' );
			$dropdowns.unbind('mouseenter mouseleave focusin focusout');
        }
	};
}( jQuery ));

jQuery( document ).ready( function( $ ) {
	// Initiate our dropdown menu
   $( '.sf-menu .menu-item-has-children' ).GenerateDropdownMenu();
});

// Nullify superfish function if it's being called in an old version of GP Premium
// This can be removed after a while (GP Premium 1.2.78)
;(function ($) {
	$.fn.superfish = function () {
		return false;
	};
})(jQuery, window);