import GeneratePressControl from '../../components/GeneratePressControl';

import GeneratePressColorControlForm from './GeneratePressColorControlForm';

const GeneratePressColorControl = GeneratePressControl.extend( GeneratePressColorControlForm, {
	getWrapper: function getWrapper() {
		const control = this;

		let wrapper = control.container[ 0 ];

		if ( control.params.choices.wrapper ) {
			const wrapperElement = document.getElementById( control.params.choices.wrapper + '--wrapper' );

			if ( wrapperElement ) {
				// Move this control into the wrapper.
				wrapper = wrapperElement;

				// Hide the original <li> container.
				control.container[ 0 ].style.display = 'none';
			}
		}

		if ( control.params.choices.toggleId ) {
			wrapper.setAttribute( 'data-toggleId', control.params.choices.toggleId );
		}

		return wrapper;
	},
} );

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-color-control' ] = GeneratePressColorControl;
