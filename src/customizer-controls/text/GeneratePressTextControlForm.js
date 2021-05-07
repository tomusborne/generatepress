import './style.scss';

import {
	TextControl,
} from '@wordpress/components';

const GeneratePressTextControlForm = ( props ) => {
	/**
	 * Save the value when changing the control.
	 *
	 * @param {Object} value - The value.
	 * @return {void}
	 */
	const handleChangeComplete = ( value ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( value );
	};

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<TextControl
				label={ props.label }
				help={ props.description }
				value={ props.value || '' }
				onChange={ handleChangeComplete }
			/>
		</div>
	);
};

export default GeneratePressTextControlForm;
