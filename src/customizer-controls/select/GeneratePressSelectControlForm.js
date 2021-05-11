import './style.scss';

import {
	SelectControl,
} from '@wordpress/components';

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

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<SelectControl
				label={ props.label }
				help={ props.description }
				value={ props.value }
				options={ props.choices.options }
				onChange={ handleChangeComplete }
			/>
		</div>
	);
};

export default GeneratePressSelectControlForm;
