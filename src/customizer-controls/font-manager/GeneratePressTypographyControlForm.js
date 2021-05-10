import './style.scss';
import getIcon from '../../utils/get-icon';
import getFontWeights from '../../utils/get-font-weights';
import hasNumericValue from '../../utils/has-numeric-value';
import RangeControl from '../../components/range-control';
import UtilityLabel from '../../components/utility-label';
import UnitPicker from '../../components/unit-picker';

import {
	useState,
} from '@wordpress/element';

import {
	TextControl,
	Button,
	Tooltip,
	Popover,
	SelectControl,
	BaseControl,
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

	const fontManagerControl = wp.customize.control( 'generate_settings[font_manager]' );
	const availableFonts = fontManagerControl.setting.get();

	const elements = {
		body: {
			label: __( 'Body', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '17',
					min: 6,
					max: 25,
					step: 1,
				},
				lineHeight: {
					value: '1.5',
					min: 1,
					max: 5,
					step: .1,
				},
			},
		},
		'main-title': {
			label: __( 'Site Title', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '25',
					min: 10,
					max: 200,
					step: 1,
				},
			},
		},
		'site-description': {
			label: __( 'Site Description', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '15',
					min: 6,
					max: 50,
					step: 1,
				},
			},
		},
		'primary-menu-items': {
			label: __( 'Primary Menu Items', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '15',
					min: 6,
					max: 30,
					step: 1,
				},
			},
		},
		'primary-sub-menu-items': {
			label: __( 'Primary Sub-Menu Items', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '14',
					min: 6,
					max: 30,
					step: 1,
				},
			},
		},
		buttons: {
			label: __( 'Buttons', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '',
					min: 5,
					max: 100,
					step: 1,
				},
			},
		},
		'all-headings': {
			label: __( 'All Headings', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: '',
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					value: '',
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		h1: {
			label: __( 'Heading 1 (H1)', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 42,
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					value: 1.2,
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		h2: {
			label: __( 'Heading 2 (H2)', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 35,
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					value: 1.2,
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		h3: {
			label: __( 'Heading 3 (H3)', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 29,
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					value: 1.2,
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		h4: {
			label: __( 'Heading 4 (H4)', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 24,
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		h5: {
			label: __( 'Heading 5 (H5)', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 20,
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		h6: {
			label: __( 'Heading 6 (H6)', 'generatepress' ),
			placeholders: {
				fontSize: {
					min: 15,
					max: 100,
					step: 1,
				},
				lineHeight: {
					min: 0,
					max: 5,
					step: .1,
				},
			},
		},
		'top-bar': {
			label: __( 'Top Bar', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 13,
					min: 6,
					max: 25,
					step: 1,
				},
			},
		},
		'widget-titles': {
			label: __( 'Widget Titles', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 20,
					min: 6,
					max: 30,
					step: 1,
				},
			},
		},
		footer: {
			label: __( 'Footer', 'generatepress' ),
			placeholders: {
				fontSize: {
					value: 15,
					min: 6,
					max: 30,
					step: 1,
				},
			},
		},
		custom: {
			label: __( 'Custom', 'generatepress' ),
			placeholders: {},
		},
	};

	const elementOptions = [
		{ value: '', label: __( 'Choose element…', 'generatepress' ) },
	];

	Object.keys( elements ).forEach( ( element ) => {
		elementOptions.push(
			{
				value: element,
				label: elements[ element ].label,
			}
		);
	} );

	const fontFamilies = [
		{ value: '', label: __( '-- Select --', 'generatepress' ) },
		{ value: 'System Font', label: __( 'System Font', 'generatepress' ) },
	];

	availableFonts.forEach( ( value, i ) => {
		fontFamilies.push(
			{
				value: availableFonts[ i ].fontFamily,
				label: availableFonts[ i ].fontFamily,
			}
		);
	} );

	const getElementLabel = ( settings ) => {
		let label = 'undefined' !== typeof elements[ settings.selector ] ? elements[ settings.selector ].label : settings.selector;

		if ( 'custom' === settings.selector && !! settings.customSelector ) {
			label = settings.customSelector;
		}

		return label;
	};

	const getPlaceholder = ( settings, property ) => {
		let placeholder = 'undefined' !== typeof elements[ settings.selector ].placeholders[ property ] ? elements[ settings.selector ].placeholders[ property ].value : '';

		if ( property.includes( 'Tablet' ) ) {
			const desktopSettingName = property.replace( 'Tablet', '' );

			placeholder = 'undefined' !== typeof elements[ settings.selector ].placeholders[ desktopSettingName ] ? elements[ settings.selector ].placeholders[ desktopSettingName ].value : placeholder;
			placeholder = 'undefined' !== typeof settings[ desktopSettingName ] && hasNumericValue( settings[ desktopSettingName ] ) ? settings[ desktopSettingName ] : placeholder;
		}

		if ( property.includes( 'Mobile' ) ) {
			const tabletSettingName = property.replace( 'Mobile', 'Tablet' );
			const desktopSettingName = property.replace( 'Mobile', '' );

			placeholder = 'undefined' !== typeof elements[ settings.selector ].placeholders[ desktopSettingName ] ? elements[ settings.selector ].placeholders[ desktopSettingName ].value : placeholder;
			placeholder = 'undefined' !== typeof elements[ settings.selector ].placeholders[ tabletSettingName ] ? elements[ settings.selector ].placeholders[ tabletSettingName ].value : placeholder;
			placeholder = 'undefined' !== typeof settings[ desktopSettingName ] && hasNumericValue( settings[ desktopSettingName ] ) ? settings[ desktopSettingName ] : placeholder;
			placeholder = 'undefined' !== typeof settings[ tabletSettingName ] && hasNumericValue( settings[ tabletSettingName ] ) ? settings[ tabletSettingName ] : placeholder;
		}

		return placeholder;
	};

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			{
				fonts.map( ( font, index ) => {
					const itemId = index + 1;

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
									{ ! fonts[ index ].selector &&
										props.label
									}

									{ !! fonts[ index ].selector &&
										<>
											{ getElementLabel( fonts[ index ] ) }
											{ !! fonts[ index ].fontFamily && ' / ' + fonts[ index ].fontFamily }
											{ !! fonts[ index ].fontSize && ' / ' + fonts[ index ].fontSize }
											{ !! fonts[ index ].fontSize && !! fonts[ index ].fontSizeUnit && fonts[ index ].fontSizeUnit }
										</>
									}
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
									className="generate-customize-control--popover generate-customize-control--font-popover"
									onClose={ toggleClose }
									focusOnMount="container"
								>
									<SelectControl
										label={ __( 'Element', 'generatepress' ) }
										help={ __( 'Choose the element to target.', 'generatepress' ) }
										value={ fonts[ index ].selector }
										options={ elementOptions }
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
										<>
											{ 'custom' === fonts[ index ].selector &&
												<TextControl
													help={ __( 'Enter custom CSS selector.', 'generatepress' ) }
													value={ fonts[ index ].customSelector }
													onChange={ ( value ) => {
														const fontValues = [ ...fonts ];

														fontValues[ index ] = {
															...fontValues[ index ],
															customSelector: value,
														};

														handleChangeComplete( fontValues );
													} }
												/>
											}

											<SelectControl
												label={ __( 'Font Family', 'generatepress' ) }
												value={ fonts[ index ].fontFamily }
												options={ fontFamilies }
												onChange={ ( value ) => {
													const fontValues = [ ...fonts ];

													fontValues[ index ] = {
														...fontValues[ index ],
														fontFamily: value,
													};

													handleChangeComplete( fontValues );
												} }
											/>

											<div className="components-base-control generate-font-manager--select-options">
												<SelectControl
													label={ __( 'Font Weight', 'generatepress' ) }
													value={ fonts[ index ].fontWeight }
													options={ getFontWeights( fonts[ index ].fontFamily ) }
													onChange={ ( value ) => {
														const fontValues = [ ...fonts ];

														fontValues[ index ] = {
															...fontValues[ index ],
															fontWeight: value,
														};

														handleChangeComplete( fontValues );
													} }
												/>

												<SelectControl
													label={ __( 'Text Transform', 'generatepress' ) }
													value={ fonts[ index ].textTransform }
													options={ [
														{ value: '', 			label: __( 'Default', 'generatepress' ) },
														{ value: 'uppercase', 	label: __( 'Uppercase', 'generatepress' ) },
														{ value: 'lowercase', 	label: __( 'Lowercase', 'generatepress' ) },
														{ value: 'capitalize', 	label: __( 'Capitalize', 'generatepress' ) },
														{ value: 'initial', 	label: __( 'Normal', 'generatepress' ) },
													] }
													onChange={ ( value ) => {
														const fontValues = [ ...fonts ];

														fontValues[ index ] = {
															...fontValues[ index ],
															textTransform: value,
														};

														handleChangeComplete( fontValues );
													} }
												/>
											</div>

											<BaseControl>
												<UtilityLabel
													label={ __( 'Font Size', 'generateblocks' ) }
													value={ fonts[ index ].fontSizeUnit }
													devices={ [ 'desktop', 'tablet', 'mobile' ] }
												/>

												<div className="generate-component-input-with-unit">
													<div className="generate-component-device-field" data-device="desktop">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].fontSize ) ? parseFloat( fonts[ index ].fontSize ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	fontSize: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.min ? elements[ fonts[ index ].selector ].placeholders.min : 1 }
															rangeMax={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.max ? elements[ fonts[ index ].selector ].placeholders.max : 100 }
															step={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.step ? elements[ fonts[ index ].selector ].placeholders.step : 1 }
															withInputField={ false }
															placeholder={ getPlaceholder( fonts[ index ], 'fontSize' ) }
															initialPosition={ getPlaceholder( fonts[ index ], 'fontSize' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="tablet">
														<RangeControl
															data-generate-control-device="tablet"
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].fontSizeTablet ) ? parseFloat( fonts[ index ].fontSizeTablet ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	fontSizeTablet: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.min ? elements[ fonts[ index ].selector ].placeholders.min : 1 }
															rangeMax={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.max ? elements[ fonts[ index ].selector ].placeholders.max : 100 }
															step={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.step ? elements[ fonts[ index ].selector ].placeholders.step : 1 }
															withInputField={ false }
															placeholder={ getPlaceholder( fonts[ index ], 'fontSizeTablet' ) }
															initialPosition={ getPlaceholder( fonts[ index ], 'fontSizeTablet' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="mobile">
														<RangeControl
															data-generate-control-device="mobile"
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].fontSizeMobile ) ? parseFloat( fonts[ index ].fontSizeMobile ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	fontSizeMobile: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.min ? elements[ fonts[ index ].selector ].placeholders.min : 1 }
															rangeMax={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.max ? elements[ fonts[ index ].selector ].placeholders.max : 100 }
															step={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.step ? elements[ fonts[ index ].selector ].placeholders.step : 1 }
															withInputField={ false }
															placeholder={ getPlaceholder( fonts[ index ], 'fontSizeMobile' ) }
															initialPosition={ getPlaceholder( fonts[ index ], 'fontSizeMobile' ) }
														/>
													</div>

													<UnitPicker
														value={ fonts[ index ].fontSizeUnit }
														units={ [ 'px', 'em', '%' ] }
														onClick={ ( value ) => {
															const fontValues = [ ...fonts ];

															fontValues[ index ] = {
																...fontValues[ index ],
																fontSizeUnit: value,
															};

															handleChangeComplete( fontValues );
														} }
													/>
												</div>
											</BaseControl>

											<BaseControl>
												<UtilityLabel
													label={ __( 'Line Height', 'generateblocks' ) }
													value={ fonts[ index ].lineHeightUnit }
													devices={ [ 'desktop', 'tablet', 'mobile' ] }
												/>

												<div className="generate-component-input-with-unit">
													<div className="generate-component-device-field" data-device="desktop">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].lineHeight ) ? parseFloat( fonts[ index ].lineHeight ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	lineHeight: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.min ? elements[ fonts[ index ].selector ].placeholders.min : 1 }
															rangeMax={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.max ? elements[ fonts[ index ].selector ].placeholders.max : 5 }
															step={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.step ? elements[ fonts[ index ].selector ].placeholders.step : .1 }
															withInputField={ false }
															placeholder={ getPlaceholder( fonts[ index ], 'lineHeight' ) }
															initialPosition={ getPlaceholder( fonts[ index ], 'lineHeight' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="tablet">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].lineHeightTablet ) ? parseFloat( fonts[ index ].lineHeightTablet ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	lineHeightTablet: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.min ? elements[ fonts[ index ].selector ].placeholders.min : 1 }
															rangeMax={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.max ? elements[ fonts[ index ].selector ].placeholders.max : 5 }
															step={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.step ? elements[ fonts[ index ].selector ].placeholders.step : .1 }
															withInputField={ false }
															placeholder={ getPlaceholder( fonts[ index ], 'lineHeightTablet' ) }
															initialPosition={ getPlaceholder( fonts[ index ], 'lineHeightTablet' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="mobile">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].lineHeightMobile ) ? parseFloat( fonts[ index ].lineHeightMobile ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	lineHeightMobile: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.min ? elements[ fonts[ index ].selector ].placeholders.min : 1 }
															rangeMax={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.max ? elements[ fonts[ index ].selector ].placeholders.max : 5 }
															step={ 'undefined' !== typeof elements[ fonts[ index ].selector ].placeholders.step ? elements[ fonts[ index ].selector ].placeholders.step : .1 }
															withInputField={ false }
															placeholder={ getPlaceholder( fonts[ index ], 'lineHeightMobile' ) }
															initialPosition={ getPlaceholder( fonts[ index ], 'lineHeightMobile' ) }
														/>
													</div>

													<UnitPicker
														value={ fonts[ index ].lineHeightUnit }
														units={ [ '', 'px', 'em', '%' ] }
														onClick={ ( value ) => {
															const fontValues = [ ...fonts ];

															fontValues[ index ] = {
																...fontValues[ index ],
																lineHeightUnit: value,
															};

															handleChangeComplete( fontValues );
														} }
													/>
												</div>
											</BaseControl>

											<BaseControl>
												<UtilityLabel
													label={ __( 'Letter Spacing', 'generateblocks' ) }
													value={ fonts[ index ].letterSpacingUnit }
													devices={ [ 'desktop', 'tablet', 'mobile' ] }
												/>

												<div className="generate-component-input-with-unit">
													<div className="generate-component-device-field" data-device="desktop">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].letterSpacing ) ? parseFloat( fonts[ index ].letterSpacing ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	letterSpacing: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ -1 }
															rangeMax={ 10 }
															step={ .01 }
															withInputField={ false }
														/>
													</div>

													<div className="generate-component-device-field" data-device="tablet">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].letterSpacingTablet ) ? parseFloat( fonts[ index ].letterSpacingTablet ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	letterSpacingTablet: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ -1 }
															rangeMax={ 10 }
															step={ .01 }
															withInputField={ false }
														/>
													</div>

													<div className="generate-component-device-field" data-device="mobile">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].letterSpacingMobile ) ? parseFloat( fonts[ index ].letterSpacingMobile ) : '' }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	letterSpacingMobile: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ -1 }
															rangeMax={ 10 }
															step={ .01 }
															withInputField={ false }
														/>
													</div>

													<UnitPicker
														value={ fonts[ index ].letterSpacingUnit }
														units={ [ 'px', 'em', '%' ] }
														onClick={ ( value ) => {
															const fontValues = [ ...fonts ];

															fontValues[ index ] = {
																...fontValues[ index ],
																letterSpacingUnit: value,
															};

															handleChangeComplete( fontValues );
														} }
													/>
												</div>
											</BaseControl>
										</>
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
						selector: '',
						customSelector: '',
						fontFamily: '',
						fontWeight: '',
						textTransform: '',
						fontSize: '',
						fontSizeTablet: '',
						fontSizeMobile: '',
						fontSizeUnit: 'px',
						lineHeight: '',
						lineHeightTablet: '',
						lineHeightMobile: '',
						lineHeightUnit: '',
						letterSpacing: '',
						letterSpacingTablet: '',
						letterSpacingMobile: '',
						letterSpacingUnit: 'px',
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
