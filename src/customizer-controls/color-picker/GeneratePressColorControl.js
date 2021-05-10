import GeneratePressColorControlForm from './GeneratePressColorControlForm';

import {
	render,
	unmountComponentAtNode,
} from '@wordpress/element';

import {
	SlotFillProvider,
	Popover,
} from '@wordpress/components';

/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */
const GeneratePressColorControl = wp.customize.Control.extend( {

	/**
	 * After control has been first rendered, start re-rendering when setting changes.
	 *
	 * React is able to be used here instead of the wp.customize.Element abstraction.
	 *
	 * @return {void}
	 */
	ready: function ready() {
		const control = this;

		// Re-render control when setting changes.
		control.setting.bind( () => {
			control.renderContent();
		} );

		control.rgbaControlNotifications();
	},

	/**
	 * Embed the control in the document.
	 *
	 * Overrides the embed() method to embed the control
	 * when the section is expanded instead of on load.
	 *
	 * @since 1.0.0
	 * @return {void}
	 */
	embed() {
		const control = this;
		const sectionId = control.section();

		if ( ! sectionId ) {
			return;
		}

		wp.customize.section( sectionId, function( section ) {
			section.expanded.bind( function( expanded ) {
				if ( expanded ) {
					control.actuallyEmbed();
				}
			} );
		} );
	},

	/**
	 * Deferred embedding of control.
	 *
	 * This function is called in Section.onChangeExpanded() so the control
	 * will only get embedded when the Section is first expanded.
	 *
	 * @since 1.0.0
	 */
	actuallyEmbed() {
		const control = this;

		if ( 'resolved' === control.deferred.embedded.state() ) {
			return;
		}

		control.renderContent();
		control.deferred.embedded.resolve(); // Triggers control.ready().
	},

	/**
	 * Initialize.
	 *
	 * @param {string} id - Control ID.
	 * @param {Object} params - Control params.
	 */
	initialize( id, params ) {
		const control = this;

		// Bind functions to this control context for passing as React props.
		control.setNotificationContainer = control.setNotificationContainer.bind( control );

		wp.customize.Control.prototype.initialize.call( control, id, params );

		// The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.
		function onRemoved( removedControl ) {
			if ( control === removedControl ) {
				control.destroy();
				control.container.remove();
				wp.customize.control.unbind( 'removed', onRemoved );
			}
		}
		wp.customize.control.bind( 'removed', onRemoved );
	},

	/**
	 * Set notification container and render.
	 *
	 * This is called when the React component is mounted.
	 *
	 * @param {Element} element - Notification container.
	 * @return {void}
	 */
	setNotificationContainer: function setNotificationContainer( element ) {
		const control = this;
		control.notifications.container = jQuery( element );
		control.notifications.render();
	},

	/**
	 * Render the control into the DOM.
	 *
	 * This is called from the Control#embed() method in the parent class.
	 *
	 * @return {void}
	 */
	renderContent: function renderContent() {
		const control = this;
		const value = control.setting.get();

		const form = <SlotFillProvider>
			<GeneratePressColorControlForm
				{ ...control.params }
				value={ value }
				setNotificationContainer={ control.setNotificationContainer }
				customizerSetting={ control.setting }
				control={ control }
				choices={ control.params.choices }
				default={ control.params.defaultValue }
				alpha={ control.params.alpha }
			/>
			<Popover.Slot />
		</SlotFillProvider>;

		let wrapper = control.container[ 0 ];

		if ( control.params.choices.wrapper ) {
			const wrapperElement = document.getElementById( control.params.choices.wrapper + '--wrapper' );

			if ( wrapperElement ) {
				// Move this control into the wrapper.
				wrapper = wrapperElement;

				// Hide the original <li> container.
				control.container.hide();
			}
		}

		render(
			form,
			wrapper
		);
	},

	/**
	 * Handle removal/de-registration of the control.
	 *
	 * This is essentially the inverse of the Control#embed() method.
	 *
	 * @see https://core.trac.wordpress.org/ticket/31334
	 * @return {void}
	 */
	destroy: function destroy() {
		const control = this;

		// Garbage collection: undo mounting that was done in the embed/renderContent method.
		unmountComponentAtNode( control.container[ 0 ] );

		// Call destroy method in parent if it exists (as of #31334).
		if ( wp.customize.Control.prototype.destroy ) {
			wp.customize.Control.prototype.destroy.call( control );
		}
	},

	/**
	 * Handles notifications.
	 *
	 * @return {void}
	 */
	rgbaControlNotifications() {
		const control = this;
		const code = 'long_title';

		// Make sure we have the message before proceeding.
		if ( ! window._wpCustomizeControlsL10n.cheatin ) {
			return;
		}

		const patternTest = RegExp( /^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/ );

		wp.customize( control.id, function( setting ) {
			setting.bind( function( value ) {
				value = value.toLowerCase();

				if ( false === patternTest.test( value ) && ! value.includes( 'var' ) ) {
					setting.notifications.add( code, new wp.customize.Notification( code, {
						type: 'warning',
						message: window._wpCustomizeControlsL10n.cheatin,
					} ) );
				} else {
					setting.notifications.remove( code );
				}
			} );
		} );
	},
} );

export default GeneratePressColorControl;
