( function( api ) {
	'use strict';

	// Add callback for when the header_textcolor setting exists.
	api( 'generate_settings[nav_position_setting]', function( setting ) {
		var isNavFloated, linkSettingValueToControlActiveState;

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
		 * Update a control's active state according to the navigation location setting's value.
		 *
		 * @param {wp.customize.Control} control
		 */
		linkSettingValueToControlActiveState = function( control ) {
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

		// Call linkSettingValueToControlActiveState on the navigation dropdown point.
		api.control( 'generate_settings[nav_drop_point]', linkSettingValueToControlActiveState );
	} );

	var setOption = function( headerAlignment, navLocation, navAlignment ) {
		if ( headerAlignment ) {
			api.control( 'generate_settings[header_alignment_setting]' ).setting.set( headerAlignment );
		}

		if ( navLocation ) {
			api.control( 'generate_settings[nav_position_setting]' ).setting.set( navLocation );
		}

		if ( navAlignment ) {
			api.control( 'generate_settings[nav_alignment_setting]' ).setting.set( navAlignment );
		}
	};

	api( 'generate_header_helper', function( value ) {
		var headerAlignment = false,
			navLocation = false,
			navAlignment = false;

		value.bind( function( newval ) {
			var headerAlignmentSetting = api.control( 'generate_settings[header_alignment_setting]' ).setting;
			var navLocationSetting = api.control( 'generate_settings[nav_position_setting]' ).setting;
			var navAlignmentSetting = api.control( 'generate_settings[nav_alignment_setting]' ).setting;

			if ( ! headerAlignmentSetting._dirty ) {
				headerAlignment = headerAlignmentSetting.get();
			}

			if ( ! navLocationSetting._dirty ) {
				navLocation = navLocationSetting.get();
			}

			if ( ! navAlignmentSetting._dirty ) {
				navAlignment = navAlignmentSetting.get();
			}

			if ( 'current' === newval ) {
				setOption( headerAlignment, navLocation, navAlignment );
			}

			if ( 'default' === newval ) {
				setOption( generatepress_defaults.header_alignment_setting, generatepress_defaults.nav_position_setting, generatepress_defaults.nav_alignment_setting );
			}

			if ( 'nav-before-centered' === newval ) {
				setOption( 'center', 'nav-above-header', 'center' );
			}

			if ( 'nav-after-centered' === newval ) {
				setOption( 'center', 'nav-below-header', 'center' );
			}

			if ( 'nav-right' === newval ) {
				setOption( 'left', 'nav-float-right', 'left' );
			}

			if ( 'nav-left' === newval ) {
				setOption( 'right', 'nav-float-left', 'right' );
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

			if ( 'white' === newval ) {
				backgroundColorSetting.set( '#ffffff' );
				textColorSetting.set( '#000000' );

				backgroundColorHoverSetting.set( '#ffffff' );
				textColorHoverSetting.set( '#8f919e' );

				currentBackgroundColorSetting.set( '#ffffff' );
				currentTextColorSetting.set( '#8f919e' );

				subMenuBackgroundColorSetting.set( '#f6f9fc' );
				subMenuTextColorSetting.set( '#000000' );

				subMenuBackgroundColorHoverSetting.set( '#f6f9fc' );
				subMenuTextColorHoverSetting.set( '#8f919e' );

				subMenuCurrentBackgroundColorSetting.set( '#f6f9fc' );
				subMenuCurrentTextColorSetting.set( '#8f919e' );
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
