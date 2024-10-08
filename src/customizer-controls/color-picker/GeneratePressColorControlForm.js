import './style.scss';
import { __ } from '@wordpress/i18n';
import { BaseControl } from '@wordpress/components';
import ColorPicker from '../../components/color-picker';
import { useState, useEffect } from '@wordpress/element';

const GeneratePressColorControlForm = ( props ) => {
	const [ value, setValue ] = useState( '' );

	useEffect( () => {
		setValue( props.value );
	}, [] );

	/**
	 * Save the value when changing the colorpicker.
	 *
	 * @param {Object} color - The color object from react-color.
	 * @return {void}
	 */
	const handleChangeComplete = ( color ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( color );
		setValue( color );
	};

	const showLabel = ! props.choices.hideLabel || 'undefined' === typeof props.choices.hideLabel;

	return (
		<>
			<span className="description customize-control-description" dangerouslySetInnerHTML={ { __html: props.description } }></span>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<BaseControl
				className="generate-component-color-picker-wrapper"
				data-toggleId={ !! props.choices.toggleId ? props.choices.toggleId : null }
			>
				{ !! props.label && showLabel &&
					<div className="generate-color-component-label">
						<span>{ props.label }</span>
					</div>
				}

				<ColorPicker
					value={ value }
					hideLabel={ true }
					tooltipText={ props?.choices?.tooltip || __( 'Choose Color', 'generatepress' ) }
					tooltipPosition={ 'top center' }
					showAlpha={ true }
					showReset={ true }
					showVariableName={ false }
					showPalette={ true }
					variableNameIsDisabled={ true }
					label={ props.label }
					onChange={ ( newValue ) => {
						handleChangeComplete( newValue );
					} }
					onClickReset={ () => {
						handleChangeComplete( props.defaultValue );
					} }
				/>
			</BaseControl>
		</>
	);
};

export default GeneratePressColorControlForm;
