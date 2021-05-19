import './style.scss';
import ColorPicker from '../../components/color-picker';

import {
	BaseControl,
} from '@wordpress/components';

const GeneratePressColorControlForm = ( props ) => {
	/**
	 * Save the value when changing the colorpicker.
	 *
	 * @param {Object} color - The color object from react-color.
	 * @return {void}
	 */
	const handleChangeComplete = ( color ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( color );
	};

	return (
		<>
			<span className="description customize-control-description" dangerouslySetInnerHTML={ { __html: props.description } }></span>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<BaseControl
				className="generate-component-color-picker-wrapper"
				data-toggleId={ !! props.choices.toggleId ? props.choices.toggleId : null }
			>
				{ !! props.label &&
					<div className="generate-color-component-label">
						<span>{ props.label }</span>
					</div>
				}

				<ColorPicker
					{ ...props }
					onChange={ ( value ) => {
						handleChangeComplete( value );
					} }
				/>
			</BaseControl>
		</>
	);
};

export default GeneratePressColorControlForm;
