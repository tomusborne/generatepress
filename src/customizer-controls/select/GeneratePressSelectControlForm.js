import './style.scss';
import fontWeights from '../../utils/get-font-weights';

import {
	SelectControl,
} from '@wordpress/components';

import {
	__,
} from '@wordpress/i18n';

const GeneratePressSelectControlForm = ( props ) => {
	/**
	 * Save the value when changing the control.
	 *
	 * @param {Object} value - The value.
	 * @return {void}
	 */
	const handleChangeComplete = ( value ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( value );
	};

	let choices = props.choices.options;
	let fontFamily = '';

	if ( props.customizerSetting.id.includes( 'font_weight' ) ) {
		// Get the unique element of our font family control.
		let fontElement = props.customizerSetting.id.split( '[' ).pop();
		fontElement = fontElement.substring( 0, fontElement.indexOf( '_' ) );

		const fontFamilyControl = wp.customize.control( 'generate_settings[' + fontElement + '_font_family]' );

		if ( fontFamilyControl ) {
			fontFamily = fontFamilyControl.setting.get();
		}

		choices = fontWeights( fontFamily );
	}

	if ( props.customizerSetting.id.includes( 'font_transform' ) ) {
		choices = [
			{ value: '', 			label: __( 'Default', 'generatepress' ) },
			{ value: 'uppercase', 	label: __( 'Uppercase', 'generatepress' ) },
			{ value: 'lowercase', 	label: __( 'Lowercase', 'generatepress' ) },
			{ value: 'capitalize', 	label: __( 'Capitalize', 'generatepress' ) },
			{ value: 'initial', 	label: __( 'Normal', 'generatepress' ) },
		];
	}

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<SelectControl
				key={ fontFamily }
				label={ props.label }
				help={ props.description }
				value={ props.value }
				options={ choices }
				onChange={ handleChangeComplete }
			/>
		</div>
	);
};

export default GeneratePressSelectControlForm;
