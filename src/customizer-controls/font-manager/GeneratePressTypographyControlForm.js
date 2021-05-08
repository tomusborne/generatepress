import './style.scss';
import getIcon from '../../utils/get-icon';

import {
	useState,
} from '@wordpress/element';

import {
	TextControl,
	ToggleControl,
	Button,
	Tooltip,
	BaseControl,
	Popover,
	SelectControl,
} from '@wordpress/components';

import {
	__,
} from '@wordpress/i18n';

const GeneratePressTypographyControlForm = ( props ) => {
	const [ isOpen, setOpen ] = useState( 0 );

	/**
	 * Save the value when changing the control.
	 *
	 * @param {Object} value - The value.
	 * @return {void}
	 */
	const handleChangeComplete = ( value ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( value );
	};

	const toggleClose = () => {
		setOpen( 0 );
	};

	const fonts = props.value;

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			{
				fonts.map( ( font, index ) => {
					const itemId = index + 1;

					const fontManagerControl = wp.customize.control( 'generate_settings[font_manager]' );
					const availableFonts = fontManagerControl.setting.get();

					const elements = [
						{ value: '', label: __( 'Choose element…', 'generatepress' ) },
						{ value: 'body', label: __( 'Body', 'generatepress' ) },
						{ value: 'main-title', label: __( 'Site Title', 'generatepress' ) },
						{ value: 'site-description', label: __( 'Site Description', 'generatepress' ) },
						{ value: 'main-navigation', label: __( 'Main Navigation', 'generatepress' ) },
						{ value: 'buttons', label: __( 'Buttons', 'generatepress' ) },
					];

					console.log(availableFonts);

					return (
						<div className="generate-font-manager--item" key={ index }>
							<div className="generate-font-manager--header" style={ { pointerEvents: !! isOpen ? 'none' : '' } }>
								<Button
									className="generate-font-manager--label"
									onClick={ () => {
										if ( itemId !== isOpen ) {
											setOpen( itemId );
										}
									} }
								>
									{ !! fonts[ index ].selector ? fonts[ index ].selector : props.label }
									{ !! fonts[ index ].selector && !! fonts[ index ].fontFamily && ' / ' + fonts[ index ].fontFamily }
								</Button>

								<Tooltip text={ __( 'Delete Typography Element', 'generatepress' ) }>
									<Button
										className="generate-font-manager--delete-font"
										onClick={ () => {
											// eslint-disable-next-line
											if ( window.confirm( __( 'This will permanently delete this typography element.', 'generatepress' ) ) ) {
												const fontValues = [ ...fonts ];

												fontValues.splice( index, 1 );
												handleChangeComplete( fontValues );
											}
										} }
										icon={ getIcon( 'x' ) }
									/>
								</Tooltip>
							</div>

							{ itemId === isOpen &&
								<Popover
									position="bottom center"
									className="generate-customize-control--popover"
									onClose={ toggleClose }
									focusOnMount="container"
								>
									<BaseControl
										className="generate-component-font-family-picker-wrapper"
										id="generate-font-manager-family-name--input"
									>

										<SelectControl
											label={ __( 'Element', 'generatepress' ) }
											help={ __( 'Choose the element to target.', 'generatepress' ) }
											value={ fonts[ index ].selector }
											options={ elements }
											onChange={ ( value ) => {
												const fontValues = [ ...fonts ];

												fontValues[ index ] = {
													...fontValues[ index ],
													selector: value,
												};

												handleChangeComplete( fontValues );
											} }
										/>

										{ !! fonts[ index ].selector &&
											<div>
												<select
													className="components-select-control__input components-select-control__input--generate-fontfamily"
													onChange={ ( value ) => {
														//onFontShortcut( value );
													} }
													onBlur={ () => {
														// do nothing
													} }
												>
													<option key="choose" value="">{ __( 'Choose…', 'generatepress' ) }</option>
													{ availableFonts.map( ( option, i ) =>
														<option
															key={ availableFonts[ i ].fontFamily }
															value={ availableFonts[ i ].fontFamily }
														>
															{ availableFonts[ i ].fontFamily }
														</option>
													) }
												</select>
											</div>
										}
										<div className="generate-font-manager--footer">
											<Button
												isSecondary
												isSmall
												onClick={ toggleClose }
											>
												{ __( 'Close', 'generatepress' ) }
											</Button>
										</div>
									</BaseControl>
								</Popover>
							}
						</div>
					);
				} )
			}

			<Button
				isPrimary
				onClick={ () => {
					const fontValues = [ ...props.value ];

					fontValues.push( {
						fontFamily: '',
						googleFont: false,
						googleFontCategory: '',
						googleFontVariants: '',
					} );

					handleChangeComplete( fontValues );
				} }
			>
				{ __( 'Add Element', 'generatepress' ) }
			</Button>
		</div>
	);
};

export default GeneratePressTypographyControlForm;
