import './style.scss';

import {
	RangeControl,
	TextControl,
} from '@wordpress/components';

const GeneratePressRangeControlForm = ( props ) => {
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

			{ !! props.label &&
				<div className="generate-range-control-component-label">
					<span>{ props.label }</span>
				</div>
			}

			<div className="components-generate-range-control--wrapper">
				<div className="components-generate-range-control--range">
					<RangeControl
						className={ 'generate-range-control-range' }
						value={ props.value || 0 === props.value ? parseFloat( props.value ) : '' }
						onChange={ handleChangeComplete }
						min={ props.choices.rangeMin }
						max={ props.choices.rangeMax }
						step={ props.choices.step }
						withInputField={ false }
						initialPosition={ props.choices.initialPosition }
					/>
				</div>

				<div className="components-generate-range-control-input">
					<TextControl
						type="number"
						placeholder={ '' !== props.choices.placeholder ? props.choices.placeholder : '' }
						min={ props.choices.inputMin }
						max={ props.choices.inputMax }
						step={ props.choices.step }
						value={ props.value || 0 === props.value ? props.value : '' }
						onChange={ handleChangeComplete }
						onBlur={ () => {
							if ( props.value || 0 === props.value ) {
								handleChangeComplete( parseFloat( props.value ) );
							}
						} }
						onClick={ ( e ) => {
							// Make sure onBlur fires in Firefox.
							e.currentTarget.focus();
						} }
					/>
				</div>
			</div>
		</div>
	);
};

export default GeneratePressRangeControlForm;
