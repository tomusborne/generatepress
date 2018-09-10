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

}( wp.customize ) );
