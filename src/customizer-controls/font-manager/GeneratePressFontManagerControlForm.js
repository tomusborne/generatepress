import './style.scss';
import googleFonts from './google-fonts.json';
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
} from '@wordpress/components';

import {
	__,
} from '@wordpress/i18n';

const GeneratePressFontManagerControlForm = ( props ) => {
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

					const fontFamilies = [
						{ value: '', label: __( 'Quick select…', 'generatepress' ) },
						{ value: 'System Default', label: __( 'System Default', 'generatepress' ) },
						{ value: 'Arial', label: 'Arial' },
						{ value: 'Helvetica', label: 'Helvetica' },
						{ value: 'Times New Roman', label: 'Times New Roman' },
						{ value: 'Georgia', label: 'Georgia' },
					];

					Object.keys( googleFonts ).slice( 0, 20 ).forEach( ( k ) => {
						fontFamilies.push(
							{ value: k, label: k }
						);
					} );

					const onFontChange = ( value ) => {
						const fontValues = [ ...fonts ];

						fontValues[ index ] = {
							...fontValues[ index ],
							fontFamily: value,
						};

						handleChangeComplete( fontValues );

						if ( typeof googleFonts[ value ] !== 'undefined' ) {
							fontValues[ index ] = {
								...fontValues[ index ],
								googleFont: true,
								googleFontCategory: googleFonts[ value ].category,
								googleFontVariants: googleFonts[ value ].variants.join( ', ' ),
							};

							handleChangeComplete( fontValues );
						} else {
							fontValues[ index ] = {
								...fontValues[ index ],
								googleFont: false,
								googleFontCategory: '',
								googleFontVariants: '',
							};

							handleChangeComplete( fontValues );
						}
					};

					const onFontShortcut = ( event ) => {
						const fontValues = [ ...fonts ];

						fontValues[ index ] = {
							...fontValues[ index ],
							fontFamily: event.target.value,
						};

						handleChangeComplete( fontValues );
						onFontChange( event.target.value );
					};

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
									{ !! fonts[ index ].fontFamily ? fonts[ index ].fontFamily : props.label }
								</Button>

								<Tooltip text={ __( 'Open Font Family Settings', 'generatepress' ) }>
									<Button
										className="generate-font-manager--open"
										onClick={ () => {
											if ( itemId !== isOpen ) {
												setOpen( itemId );
											}
										} }
									>
										{ getIcon( 'settings' ) }
									</Button>
								</Tooltip>

								<Tooltip text={ __( 'Delete Font Family', 'generatepress' ) }>
									<Button
										className="generate-font-manager--delete-font"
										onClick={ () => {
											// eslint-disable-next-line
											if ( window.confirm( __( 'This will permanently delete this font family.', 'generatepress' ) ) ) {
												const fontValues = [ ...fonts ];

												fontValues.splice( index, 1 );
												handleChangeComplete( fontValues );
											}
										} }
									>
										{ getIcon( 'x' ) }
									</Button>
								</Tooltip>
							</div>

							{ itemId === isOpen &&
								<Popover
									position="bottom center"
									className="generate-customize-control--popover generate-customize-control--font-popover"
									onClose={ toggleClose }
									focusOnMount="container"
								>
									<BaseControl
										className="generate-component-font-family-picker-wrapper"
										id="generate-font-manager-family-name--input"
									>
										<select
											className="components-select-control__input components-select-control__input--generate-fontfamily"
											onChange={ ( value ) => {
												onFontShortcut( value );
											} }
											onBlur={ () => {
												// do nothing
											} }
										>
											{ fontFamilies.map( ( option, i ) =>
												<option
													key={ `${ option.label }-${ option.value }-${ i }` }
													value={ option.value }
												>
													{ option.label }
												</option>
											) }
										</select>

										<TextControl
											id="generate-font-manager-family-name--input"
											className="generate-font-manager-family-name--input"
											help={ __( 'Font family name', 'generatepress' ) }
											value={ fonts[ index ].fontFamily || '' }
											onChange={ ( value ) => {
												const fontValues = [ ...fonts ];

												fontValues[ index ] = {
													...fontValues[ index ],
													fontFamily: value,
												};

												handleChangeComplete( fontValues );
											} }
										/>

										{ !! fonts[ index ].fontFamily &&
											<div className="generate-font-manager--options">
												<ToggleControl
													className="generate-font-manager-google-font--field"
													label={ __( 'Google Font', 'generatepress' ) }
													checked={ !! fonts[ index ].googleFont }
													onChange={ ( value ) => {
														const fontValues = [ ...fonts ];

														fontValues[ index ] = {
															...fontValues[ index ],
															googleFont: value,
														};

														handleChangeComplete( fontValues );
													} }
												/>

												{ !! fonts[ index ].googleFont &&
													<div className="generate-font-manager--google-font-options">
														<TextControl
															label={ __( 'Category', 'generatepress' ) }
															value={ fonts[ index ].googleFontCategory || '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	googleFontCategory: value,
																};

																handleChangeComplete( fontValues );
															} }
														/>

														<TextControl
															label={ __( 'Variants', 'generatepress' ) }
															value={ fonts[ index ].googleFontVariants || '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	googleFontVariants: value,
																};

																handleChangeComplete( fontValues );
															} }
														/>
													</div>
												}
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
				{ __( 'Add Font', 'generatepress' ) }
			</Button>
		</div>
	);
};

export default GeneratePressFontManagerControlForm;
