import './style.scss';

import {
	__,
} from '@wordpress/i18n';

import {
	useState,
} from '@wordpress/element';

import {
	Tooltip,
	BaseControl,
	ColorPicker,
	Popover,
	Button,
	TextControl,
	ColorPalette,
} from '@wordpress/components';

const GeneratePressColorControlForm = ( props ) => {
	const [ isOpen, setOpen ] = useState( false );
	const [ colorKey, setColorKey ] = useState( false );

	/**
	 * Save the value when changing the colorpicker.
	 *
	 * @param {Object} color - The color object from react-color.
	 * @return {void}
	 */
	const handleChangeComplete = ( color ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( color );
	};

	const toggleVisible = () => {
		setOpen( true );
	};

	const toggleClose = () => {
		setOpen( false );
	};

	let tooltip = __( 'Choose Color', 'generatepress' );

	if ( props.choices.tooltip ) {
		tooltip = props.choices.tooltip;
	}

	return (
		<div>
			<span className="description customize-control-description" dangerouslySetInnerHTML={ { __html: props.description } }></span>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<BaseControl
				className="generate-component-color-picker-wrapper"
			>
				{ !! props.label &&
					<div className="generate-color-component-label">
						<span>{ props.label }</span>
					</div>
				}

				<div className="generate-color-picker-area">
					<div className="components-color-palette__item-wrapper components-circular-option-picker__option-wrapper components-color-palette__custom-color">
						{ ! isOpen &&
							<Tooltip text={ tooltip } position="top center">
								<Button
									aria-expanded={ isOpen }
									className="components-color-palette__item components-circular-option-picker__option"
									onClick={ toggleVisible }
									aria-label={ __( 'Custom color picker', 'generatepress' ) }
									style={ { color: props.value ? props.value : 'transparent' } }
								>
									<span className="components-color-palette__custom-color-gradient" />
								</Button>
							</Tooltip>
						}

						{ isOpen &&
							<Tooltip text={ tooltip } position="top center">
								<Button
									aria-expanded={ isOpen }
									className="components-color-palette__item components-circular-option-picker__option"
									onClick={ toggleClose }
									aria-label={ __( 'Custom color picker', 'generatepress' ) }
									style={ { color: props.value ? props.value : 'transparent' } }
								>
									<span className="components-color-palette__custom-color-gradient" />
								</Button>
							</Tooltip>
						}
					</div>

					{ isOpen &&
						<Popover
							position="bottom center"
							className="generate-component-color-picker"
							onClose={ toggleClose }
							focusOnMount="container"
						>
							<BaseControl key={ colorKey }>
								<ColorPicker
									key={ colorKey }
									color={ props.value ? props.value : '' }
									onChangeComplete={ ( color ) => {
										let colorString;

										if ( 'undefined' === typeof color.rgb || color.rgb.a === 1 ) {
											colorString = color.hex;
										} else {
											const { r, g, b, a } = color.rgb;
											colorString = `rgba(${ r }, ${ g }, ${ b }, ${ a })`;
										}

										handleChangeComplete( colorString );
									} }
									disableAlpha={ ! props.alpha }
								/>

								<div className="generate-color-input-wrapper">
									<TextControl
										id="generate-color-input-field"
										className="generate-color-input"
										type={ 'text' }
										value={ props.value || '' }
										onChange={ ( color ) => {
											handleChangeComplete( color );
										} }
										onBlur={ () => {
											setColorKey( props.value );
										} }
									/>

									<Button
										isSmall
										isSecondary
										className="components-color-clear-color"
										onClick={ () => {
											const defaultValue = ( props.defaultValue ) ? props.defaultValue : '';

											wp.customize.control( props.customizerSetting.id ).setting.set( defaultValue );
											setColorKey( defaultValue );

											setTimeout( function() {
												document.querySelector( '.generate-color-input-wrapper input' ).focus();
											}, 10 );
										} }
									>
										{ __( 'Default', 'generatepress' ) }
									</Button>
								</div>
							</BaseControl>

							<BaseControl
								className="generate-component-color-picker-palette"
							>
								<ColorPalette
									colors={ generateCustomizerControls.palette }
									value={ props.value }
									onChange={ ( color ) => {
										handleChangeComplete( color );
										setColorKey( color );
									} }
									disableCustomColors={ true }
									clearable={ false }
								/>
							</BaseControl>
						</Popover>
					}
				</div>
			</BaseControl>
		</div>
	);
};

export default GeneratePressColorControlForm;
