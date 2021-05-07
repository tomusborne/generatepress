import './style.scss';

import {
	ToggleControl,
} from '@wordpress/components';

const GeneratePressToggleControlForm = ( props ) => {
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

			<ToggleControl
				label={ props.label }
				help={ props.description }
				checked={ !! props.value }
				onChange={ handleChangeComplete }
			/>
		</div>
	);
};

export default GeneratePressToggleControlForm;
