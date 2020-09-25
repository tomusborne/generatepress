( function( api ) {
	'use strict';

	// Add callback for when the header_textcolor setting exists.
	api( 'generate_settings[nav_position_setting]', function( setting ) {
		var isNavFloated, isNavAlignable, setNavDropPointActiveState, setNavAlignmentsActiveState;

		/**
		 * Determine whether the navigation is floating.
		 *
		 * @returns {boolean} Is floating?
		 */
		isNavFloated = function() {
			if ( 'nav-float-right' === setting.get() || 'nav-float-left' === setting.get() ) {
				return true;
			}

			return false;
		};

		/**
		 * Determine whether the navigation is align-able.
		 *
		 * @returns {boolean} Is floating?
		 */
		isNavAlignable = function() {
			if ( 'nav-float-right' === setting.get() || 'nav-float-left' === setting.get() ) {
				var navAsHeader = api.instance( 'generate_menu_plus_settings[navigation_as_header]' );

				if ( navAsHeader && navAsHeader.get() ) {
					return true;
				}

				return false;
			}

			return true;
		};

		/**
		 * Update a control's active state according to the navigation location setting's value.
		 *
		 * @param {wp.customize.Control} control
		 */
		setNavDropPointActiveState = function( control ) {
			var setActiveState = function() {
				control.active.set( isNavFloated() );
			};

			// FYI: With the following we can eliminate all of our PHP active_callback code.
			control.active.validate = isNavFloated;

			// Set initial active state.
			setActiveState();

			/*
			 * Update activate state whenever the setting is changed.
			 * Even when the setting does have a refresh transport where the
			 * server-side active callback will manage the active state upon
			 * refresh, having this JS management of the active state will
			 * ensure that controls will have their visibility toggled
			 * immediately instead of waiting for the preview to load.
			 * This is especially important if the setting has a postMessage
			 * transport where changing the setting wouldn't normally cause
			 * the preview to refresh and thus the server-side active_callbacks
			 * would not get invoked.
			 */
			setting.bind( setActiveState );
		};

		/**
		 * Update a control's active state according to the navigation location setting's value.
		 *
		 * @param {wp.customize.Control} control
		 */
		setNavAlignmentsActiveState = function( control ) {
			var setActiveState = function() {
				control.active.set( isNavAlignable() );
			};

			// FYI: With the following we can eliminate all of our PHP active_callback code.
			control.active.validate = isNavAlignable;

			// Set initial active state.
			setActiveState();

			/*
			 * Update activate state whenever the setting is changed.
			 * Even when the setting does have a refresh transport where the
			 * server-side active callback will manage the active state upon
			 * refresh, having this JS management of the active state will
			 * ensure that controls will have their visibility toggled
			 * immediately instead of waiting for the preview to load.
			 * This is especially important if the setting has a postMessage
			 * transport where changing the setting wouldn't normally cause
			 * the preview to refresh and thus the server-side active_callbacks
			 * would not get invoked.
			 */
			setting.bind( setActiveState );
		};

		api.control( 'generate_settings[nav_drop_point]', setNavDropPointActiveState );
		api.control( 'generate_settings[nav_layout_setting]', setNavAlignmentsActiveState );
		api.control( 'generate_settings[nav_inner_width]', setNavAlignmentsActiveState );
		api.control( 'generate_settings[nav_alignment_setting]', setNavAlignmentsActiveState );
	} );

	var setOption = function( options ) {
		if ( options.headerAlignment ) {
			api.instance( 'generate_settings[header_alignment_setting]' ).set( options.headerAlignment );
		}

		if ( options.navLocation ) {
			api.instance( 'generate_settings[nav_position_setting]' ).set( options.navLocation );
		}

		if ( options.navAlignment ) {
			api.instance( 'generate_settings[nav_alignment_setting]' ).set( options.navAlignment );
		}

		if ( options.boxAlignment ) {
			api.instance( 'generate_settings[container_alignment]' ).set( options.boxAlignment );
		}

		if ( options.siteTitleFontSize ) {
			api.instance( 'generate_settings[site_title_font_size]' ).set( options.siteTitleFontSize );
		}

		if ( 'undefined' !== typeof options.hideSiteTagline ) {
			api.instance( 'generate_settings[hide_tagline]' ).set( options.hideSiteTagline );
		}

		if ( options.headerPaddingTop ) {
			api.instance( 'generate_spacing_settings[header_top]' ).set( options.headerPaddingTop );
		}

		if ( options.headerPaddingBottom ) {
			api.instance( 'generate_spacing_settings[header_bottom]' ).set( options.headerPaddingBottom );
		}
	};

	api( 'generate_header_helper', function( value ) {
		var headerAlignment = false,
			navLocation = false,
			navAlignment = false,
			boxAlignment = false,
			siteTitleFontSize = false,
			hideSiteTagline = false,
			headerPaddingTop = false,
			headerPaddingBottom = false;

		value.bind( function( newval ) {
			var headerAlignmentSetting = api.instance( 'generate_settings[header_alignment_setting]' );
			var navLocationSetting = api.instance( 'generate_settings[nav_position_setting]' );
			var navAlignmentSetting = api.instance( 'generate_settings[nav_alignment_setting]' );
			var boxAlignmentSetting = api.instance( 'generate_settings[container_alignment]' );
			var siteTitleFontSizeSetting = api.instance( 'generate_settings[site_title_font_size]' );
			var hideSiteTaglineSetting = api.instance( 'generate_settings[hide_tagline]' );
			var headerPaddingTopSetting = api.instance( 'generate_spacing_settings[header_top]' );
			var headerPaddingBottomSetting = api.instance( 'generate_spacing_settings[header_bottom]' );

			if ( ! headerAlignmentSetting._dirty ) {
				headerAlignment = headerAlignmentSetting.get();
			}

			if ( ! navLocationSetting._dirty ) {
				navLocation = navLocationSetting.get();
			}

			if ( ! navAlignmentSetting._dirty ) {
				navAlignment = navAlignmentSetting.get();
			}

			if ( ! boxAlignmentSetting._dirty ) {
				boxAlignment = boxAlignmentSetting.get();
			}

			if ( ! siteTitleFontSizeSetting._dirty ) {
				siteTitleFontSize = siteTitleFontSizeSetting.get();
			}

			if ( ! hideSiteTaglineSetting._dirty ) {
				hideSiteTagline = hideSiteTaglineSetting.get();
			}

			if ( ! headerPaddingTopSetting._dirty ) {
				headerPaddingTop = headerPaddingTopSetting.get();
			}

			if ( ! headerPaddingBottomSetting._dirty ) {
				headerPaddingBottom = headerPaddingBottomSetting.get();
			}

			var options = {
				headerAlignment: generatepress_defaults.header_alignment_setting,
				navLocation: generatepress_defaults.nav_position_setting,
				navAlignment: generatepress_defaults.nav_alignment_setting,
				boxAlignment: generatepress_defaults.container_alignment,
				siteTitleFontSize: generatepress_typography_defaults.site_title_font_size,
				hideSiteTagline: generatepress_defaults.hide_tagline,
				headerPaddingTop: generatepress_spacing_defaults.header_top,
				headerPaddingBottom: generatepress_spacing_defaults.header_bottom,
			};

			if ( 'current' === newval ) {
				options = {
					headerAlignment: headerAlignment,
					navLocation: navLocation,
					navAlignment: navAlignment,
					boxAlignment: boxAlignment,
					siteTitleFontSize: siteTitleFontSize,
					hideSiteTagline: hideSiteTagline,
					headerPaddingTop: headerPaddingTop,
					headerPaddingBottom: headerPaddingBottom,
				};

				setOption( options );
			}

			if ( 'default' === newval ) {
				setOption( options );
			}

			if ( 'classic' === newval ) {
				var options = {
					headerAlignment: 'left',
					navLocation: 'nav-below-header',
					navAlignment: 'left',
					boxAlignment: 'boxes',
					siteTitleFontSize: '45',
					hideSiteTagline: '',
					headerPaddingTop: '40',
					headerPaddingBottom: '40',
				};

				setOption( options );
			}

			if ( 'nav-before' === newval ) {
				options['headerAlignment'] = 'left';
				options['navLocation'] = 'nav-above-header';
				options['navAlignment'] = 'left';

				setOption( options );
			}

			if ( 'nav-after' === newval ) {
				options['headerAlignment'] = 'left';
				options['navLocation'] = 'nav-below-header';
				options['navAlignment'] = 'left';

				setOption( options );
			}

			if ( 'nav-before-centered' === newval ) {
				options['headerAlignment'] = 'center';
				options['navLocation'] = 'nav-above-header';
				options['navAlignment'] = 'center';

				setOption( options );
			}

			if ( 'nav-after-centered' === newval ) {
				options['headerAlignment'] = 'center';
				options['navLocation'] = 'nav-below-header';
				options['navAlignment'] = 'center';

				setOption( options );
			}

			if ( 'nav-left' === newval ) {
				options['headerAlignment'] = 'left';
				options['navLocation'] = 'nav-float-left';
				options['navAlignment'] = 'right';

				setOption( options );
			}
		} );
	} );

	api( 'nav_color_presets', function( value ) {
		var backgroundColor = false,
			textColor = false,
			backgroundColorHover = false,
			textColorHover = false,
			currentBackgroundColor = false,
			currentTextColor = false,
			subMenuBackgroundColor = false,
			subMenuTextColor = false,
			subMenuBackgroundColorHover = false,
			subMenuTextColorHover = false,
			subMenuCurrentBackgroundColor = false,
			subMenuCurrentTextColor = false;

		value.bind( function( newval ) {
			var backgroundColorSetting = api.instance( 'generate_settings[navigation_background_color]' ),
				textColorSetting = api.instance( 'generate_settings[navigation_text_color]' ),
				backgroundColorHoverSetting = api.instance( 'generate_settings[navigation_background_hover_color]' ),
				textColorHoverSetting = api.instance( 'generate_settings[navigation_text_hover_color]' ),
				currentBackgroundColorSetting = api.instance( 'generate_settings[navigation_background_current_color]' ),
				currentTextColorSetting = api.instance( 'generate_settings[navigation_text_current_color]' ),
				subMenuBackgroundColorSetting = api.instance( 'generate_settings[subnavigation_background_color]' ),
				subMenuTextColorSetting = api.instance( 'generate_settings[subnavigation_text_color]' ),
				subMenuBackgroundColorHoverSetting = api.instance( 'generate_settings[subnavigation_background_hover_color]' ),
				subMenuTextColorHoverSetting = api.instance( 'generate_settings[subnavigation_text_hover_color]' ),
				subMenuCurrentBackgroundColorSetting = api.instance( 'generate_settings[subnavigation_background_current_color]' ),
				subMenuCurrentTextColorSetting = api.instance( 'generate_settings[subnavigation_text_current_color]' );

			if ( ! backgroundColorSetting._dirty ) {
				backgroundColor = backgroundColorSetting.get();
			}

			if ( ! textColorSetting._dirty ) {
				textColor = textColorSetting.get();
			}

			if ( ! backgroundColorHoverSetting._dirty ) {
				backgroundColorHover = backgroundColorHoverSetting.get();
			}

			if ( ! textColorHoverSetting._dirty ) {
				textColorHover = textColorHoverSetting.get();
			}

			if ( ! currentBackgroundColorSetting._dirty ) {
				currentBackgroundColor = currentBackgroundColorSetting.get();
			}

			if ( ! currentTextColorSetting._dirty ) {
				currentTextColor = currentTextColorSetting.get();
			}

			if ( ! subMenuBackgroundColorSetting._dirty ) {
				subMenuBackgroundColor = subMenuBackgroundColorSetting.get();
			}

			if ( ! subMenuTextColorSetting._dirty ) {
				subMenuTextColor = subMenuTextColorSetting.get();
			}

			if ( ! subMenuBackgroundColorHoverSetting._dirty ) {
				subMenuBackgroundColorHover = subMenuBackgroundColorHoverSetting.get();
			}

			if ( ! subMenuTextColorHoverSetting._dirty ) {
				subMenuTextColorHover = subMenuTextColorHoverSetting.get();
			}

			if ( ! subMenuCurrentBackgroundColorSetting._dirty ) {
				subMenuCurrentBackgroundColor = subMenuCurrentBackgroundColorSetting.get();
			}

			if ( ! subMenuCurrentTextColorSetting._dirty ) {
				subMenuCurrentTextColor = subMenuCurrentTextColorSetting.get();
			}

			if ( 'current' === newval ) {
				backgroundColorSetting.set( backgroundColor );
				textColorSetting.set( textColor );

				backgroundColorHoverSetting.set( backgroundColorHover );
				textColorHoverSetting.set( textColorHover );

				currentBackgroundColorSetting.set( currentBackgroundColor );
				currentTextColorSetting.set( currentTextColorSetting );

				subMenuBackgroundColorSetting.set( subMenuBackgroundColor );
				subMenuTextColorSetting.set( subMenuTextColor );

				subMenuBackgroundColorHoverSetting.set( subMenuBackgroundColorHover );
				subMenuTextColorHoverSetting.set( subMenuTextColorHover );

				subMenuCurrentBackgroundColorSetting.set( subMenuCurrentBackgroundColor );
				subMenuCurrentTextColorSetting.set( subMenuCurrentTextColorSetting );
			}

			if ( 'default' === newval ) {
				backgroundColorSetting.set( generatepress_color_defaults.navigation_background_color );
				textColorSetting.set( generatepress_color_defaults.navigation_text_color );

				backgroundColorHoverSetting.set( generatepress_color_defaults.navigation_background_hover_color );
				textColorHoverSetting.set( generatepress_color_defaults.navigation_text_hover_color );

				currentBackgroundColorSetting.set( generatepress_color_defaults.navigation_background_current_color );
				currentTextColorSetting.set( generatepress_color_defaults.navigation_text_current_color );

				subMenuBackgroundColorSetting.set( generatepress_color_defaults.subnavigation_background_color );
				subMenuTextColorSetting.set( generatepress_color_defaults.subnavigation_text_color );

				subMenuBackgroundColorHoverSetting.set( generatepress_color_defaults.subnavigation_background_hover_color );
				subMenuTextColorHoverSetting.set( generatepress_color_defaults.subnavigation_text_hover_color );

				subMenuCurrentBackgroundColorSetting.set( generatepress_color_defaults.subnavigation_background_current_color );
				subMenuCurrentTextColorSetting.set( generatepress_color_defaults.subnavigation_text_current_color );
			}

			if ( 'classic' === newval ) {
				backgroundColorSetting.set( '#222222' );
				textColorSetting.set( '#ffffff' );

				backgroundColorHoverSetting.set( '#3f3f3f' );
				textColorHoverSetting.set( '#ffffff' );

				currentBackgroundColorSetting.set( '#3f3f3f' );
				currentTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorSetting.set( '#3f3f3f' );
				subMenuTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorHoverSetting.set( '#4f4f4f' );
				subMenuTextColorHoverSetting.set( '#ffffff' );

				subMenuCurrentBackgroundColorSetting.set( '#4f4f4f' );
				subMenuCurrentTextColorSetting.set( '#ffffff' );
			}

			if ( 'grey' === newval ) {
				backgroundColorSetting.set( '#595959' );
				textColorSetting.set( '#ffffff' );

				backgroundColorHoverSetting.set( '#424242' );
				textColorHoverSetting.set( '#ffffff' );

				currentBackgroundColorSetting.set( '#424242' );
				currentTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorSetting.set( '#424242' );
				subMenuTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorHoverSetting.set( '#424242' );
				subMenuTextColorHoverSetting.set( '#dbdbdb' );

				subMenuCurrentBackgroundColorSetting.set( '#424242' );
				subMenuCurrentTextColorSetting.set( '#dbdbdb' );
			}

			if ( 'blue' === newval ) {
				backgroundColorSetting.set( '#1e73be' );
				textColorSetting.set( '#ffffff' );

				backgroundColorHoverSetting.set( '#035a9e' );
				textColorHoverSetting.set( '#ffffff' );

				currentBackgroundColorSetting.set( '#035a9e' );
				currentTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorSetting.set( '#035a9e' );
				subMenuTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorHoverSetting.set( '#035a9e' );
				subMenuTextColorHoverSetting.set( '#bbd2e8' );

				subMenuCurrentBackgroundColorSetting.set( '#035a9e' );
				subMenuCurrentTextColorSetting.set( '#bbd2e8' );
			}

			if ( 'red' === newval ) {
				backgroundColorSetting.set( '#ed4250' );
				textColorSetting.set( '#ffffff' );

				backgroundColorHoverSetting.set( '#c42f2f' );
				textColorHoverSetting.set( '#ffffff' );

				currentBackgroundColorSetting.set( '#c42f2f' );
				currentTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorSetting.set( '#c42f2f' );
				subMenuTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorHoverSetting.set( '#c42f2f' );
				subMenuTextColorHoverSetting.set( '#fcd9d6' );

				subMenuCurrentBackgroundColorSetting.set( '#c42f2f' );
				subMenuCurrentTextColorSetting.set( '#fcd9d6' );
			}

			if ( 'green' === newval ) {
				backgroundColorSetting.set( '#16aa74' );
				textColorSetting.set( '#ffffff' );

				backgroundColorHoverSetting.set( '#119b6d' );
				textColorHoverSetting.set( '#ffffff' );

				currentBackgroundColorSetting.set( '#119b6d' );
				currentTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorSetting.set( '#119b6d' );
				subMenuTextColorSetting.set( '#ffffff' );

				subMenuBackgroundColorHoverSetting.set( '#119b6d' );
				subMenuTextColorHoverSetting.set( '#c2e8de' );

				subMenuCurrentBackgroundColorSetting.set( '#119b6d' );
				subMenuCurrentTextColorSetting.set( '#c2e8de' );
			}

			jQuery('.wp-color-picker').wpColorPicker().change();
		} );
	} );

}( wp.customize ) );
