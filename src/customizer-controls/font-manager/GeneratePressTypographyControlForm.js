import './style.scss';
import getIcon from '../../utils/get-icon';
import getFontWeights from '../../utils/get-font-weights';
import hasNumericValue from '../../utils/has-numeric-value';
import RangeControl from '../../components/range-control';
import UtilityLabel from '../../components/utility-label';
import UnitPicker from '../../components/unit-picker';
import AdvancedSelect from '../../components/advanced-select';
import {
	getElements,
	getElementLabel,
	getPlaceholder,
	getRangeProps,
	selectorHasMarginBottom,
	getElementOptions,
	getFontFamilies,
	getAvailableFonts,
} from './utils';

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
	const elements = getElements();

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

								<Tooltip text={ __( 'Open Typography Settings', 'generatepress' ) }>
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
									<BaseControl
										label={ __( 'Target Element', 'generatepress' ) }
										id="generate-typography-choose-element"
									>
										<AdvancedSelect
											options={ getElementOptions() }
											placeholder={ __( 'Search elements…', 'generatepress' ) }
											currentValue={ fonts[ index ].selector }
											onChange={ ( object ) => {
												const value = object.value;
												const fontValues = [ ...fonts ];
												const module = elements[ value ].module || 'core';

												fontValues[ index ] = {
													...fontValues[ index ],
													module,
													selector: value,
												};

												const placeholders = elements[ value ].placeholders;

												if ( placeholders ) {
													// Set our default unit if it exists.
													Object.keys( placeholders ).forEach( ( placeholder ) => {
														const unit = elements[ value ].placeholders[ placeholder ].unit;

														if ( unit ) {
															const unitName = placeholder + 'Unit';

															fontValues[ index ] = {
																...fontValues[ index ],
																[ unitName ]: unit,
															};
														}
													} );
												}

												// Unset any margin values if margin isn't supported.
												if ( ! selectorHasMarginBottom( value ) ) {
													fontValues[ index ] = {
														...fontValues[ index ],
														marginBottom: '',
														marginBottomTablet: '',
														marginBottomMobile: '',
														marginBottomUnit: '',
													};
												}

												handleChangeComplete( fontValues );
											} }
										/>
									</BaseControl>

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
												options={ getFontFamilies() }
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
													options={ getFontWeights( fonts[ index ].fontFamily, getAvailableFonts() ) }
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
													label={ __( 'Font Size', 'generatepress' ) }
													value={ fonts[ index ].fontSizeUnit }
													devices={ [ 'desktop', 'tablet', 'mobile' ] }
												/>

												<div className="generate-component-input-with-unit">
													<div className="generate-component-device-field" data-device="desktop">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].fontSize ) ? parseFloat( fonts[ index ].fontSize ) : getPlaceholder( fonts[ index ], 'fontSize' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	fontSize: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'fontSize', 'min', 1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'fontSize', 'max', 100 ) }
															step={ getRangeProps( fonts[ index ], 'fontSize', 'step', 1 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'fontSize' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="tablet">
														<RangeControl
															data-generate-control-device="tablet"
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].fontSizeTablet ) ? parseFloat( fonts[ index ].fontSizeTablet ) : getPlaceholder( fonts[ index ], 'fontSizeTablet' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	fontSizeTablet: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'fontSize', 'min', 1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'fontSize', 'max', 100 ) }
															step={ getRangeProps( fonts[ index ], 'fontSize', 'step', 1 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'fontSizeTablet' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="mobile">
														<RangeControl
															data-generate-control-device="mobile"
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].fontSizeMobile ) ? parseFloat( fonts[ index ].fontSizeMobile ) : getPlaceholder( fonts[ index ], 'fontSizeMobile' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	fontSizeMobile: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'fontSize', 'min', 1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'fontSize', 'max', 100 ) }
															step={ getRangeProps( fonts[ index ], 'fontSize', 'step', 1 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'fontSizeMobile' ) }
														/>
													</div>

													<UnitPicker
														value={ fonts[ index ].fontSizeUnit }
														units={ [ 'px', 'em', 'rem', '%' ] }
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
													label={ __( 'Line Height', 'generatepress' ) }
													value={ fonts[ index ].lineHeightUnit }
													devices={ [ 'desktop', 'tablet', 'mobile' ] }
												/>

												<div className="generate-component-input-with-unit">
													<div className="generate-component-device-field" data-device="desktop">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].lineHeight ) ? parseFloat( fonts[ index ].lineHeight ) : getPlaceholder( fonts[ index ], 'lineHeight' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	lineHeight: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'lineHeight', 'min', 1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'lineHeight', 'max', 5 ) }
															step={ getRangeProps( fonts[ index ], 'lineHeight', 'step', .1 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'lineHeight' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="tablet">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].lineHeightTablet ) ? parseFloat( fonts[ index ].lineHeightTablet ) : getPlaceholder( fonts[ index ], 'lineHeightTablet' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	lineHeightTablet: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'lineHeight', 'min', 1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'lineHeight', 'max', 5 ) }
															step={ getRangeProps( fonts[ index ], 'lineHeight', 'step', .1 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'lineHeightTablet' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="mobile">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].lineHeightMobile ) ? parseFloat( fonts[ index ].lineHeightMobile ) : getPlaceholder( fonts[ index ], 'lineHeightMobile' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	lineHeightMobile: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'lineHeight', 'min', 1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'lineHeight', 'max', 5 ) }
															step={ getRangeProps( fonts[ index ], 'lineHeight', 'step', .1 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'lineHeightMobile' ) }
														/>
													</div>

													<UnitPicker
														value={ fonts[ index ].lineHeightUnit }
														units={ [ '', 'px', 'em', 'rem' ] }
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
													label={ __( 'Letter Spacing', 'generatepress' ) }
													value={ fonts[ index ].letterSpacingUnit }
													devices={ [ 'desktop', 'tablet', 'mobile' ] }
												/>

												<div className="generate-component-input-with-unit">
													<div className="generate-component-device-field" data-device="desktop">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].letterSpacing ) ? parseFloat( fonts[ index ].letterSpacing ) : getPlaceholder( fonts[ index ], 'letterSpacing' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	letterSpacing: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'letterSpacing', 'min', -1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'letterSpacing', 'max', 10 ) }
															step={ getRangeProps( fonts[ index ], 'letterSpacing', 'step', .01 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'letterSpacing' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="tablet">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].letterSpacingTablet ) ? parseFloat( fonts[ index ].letterSpacingTablet ) : getPlaceholder( fonts[ index ], 'letterSpacingTablet' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	letterSpacingTablet: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'letterSpacing', 'min', -1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'letterSpacing', 'max', 10 ) }
															step={ getRangeProps( fonts[ index ], 'letterSpacing', 'step', .01 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'letterSpacingTablet' ) }
														/>
													</div>

													<div className="generate-component-device-field" data-device="mobile">
														<RangeControl
															className={ 'generate-range-control-range' }
															value={ hasNumericValue( fonts[ index ].letterSpacingMobile ) ? parseFloat( fonts[ index ].letterSpacingMobile ) : getPlaceholder( fonts[ index ], 'letterSpacingMobile' ) }
															onChange={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	letterSpacingMobile: value,
																};

																handleChangeComplete( fontValues );
															} }
															rangeMin={ getRangeProps( fonts[ index ], 'letterSpacing', 'min', -1 ) }
															rangeMax={ getRangeProps( fonts[ index ], 'letterSpacing', 'max', 10 ) }
															step={ getRangeProps( fonts[ index ], 'letterSpacing', 'step', .01 ) }
															withInputField={ false }
															initialPosition={ getPlaceholder( fonts[ index ], 'letterSpacingMobile' ) }
														/>
													</div>

													<UnitPicker
														value={ fonts[ index ].letterSpacingUnit }
														units={ [ 'px', 'em', 'rem' ] }
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

											{ selectorHasMarginBottom( fonts[ index ].selector ) &&
												<BaseControl>
													<UtilityLabel
														label={ 'body' === fonts[ index ].selector ? __( 'Paragraph Bottom Margin', 'generatepress' ) : __( 'Bottom Margin', 'generatepress' ) }
														value={ fonts[ index ].marginBottomUnit }
														devices={ [ 'desktop', 'tablet', 'mobile' ] }
													/>

													<div className="generate-component-input-with-unit">
														<div className="generate-component-device-field" data-device="desktop">
															<RangeControl
																className={ 'generate-range-control-range' }
																value={ hasNumericValue( fonts[ index ].marginBottom ) ? parseFloat( fonts[ index ].marginBottom ) : getPlaceholder( fonts[ index ], 'marginBottom' ) }
																onChange={ ( value ) => {
																	const fontValues = [ ...fonts ];

																	fontValues[ index ] = {
																		...fontValues[ index ],
																		marginBottom: value,
																	};

																	handleChangeComplete( fontValues );
																} }
																rangeMin={ getRangeProps( fonts[ index ], 'marginBottom', 'min', 1 ) }
																rangeMax={ getRangeProps( fonts[ index ], 'marginBottom', 'max', 5 ) }
																step={ getRangeProps( fonts[ index ], 'marginBottom', 'step', .1 ) }
																withInputField={ false }
																initialPosition={ getPlaceholder( fonts[ index ], 'marginBottom' ) }
															/>
														</div>

														<div className="generate-component-device-field" data-device="tablet">
															<RangeControl
																className={ 'generate-range-control-range' }
																value={ hasNumericValue( fonts[ index ].marginBottomTablet ) ? parseFloat( fonts[ index ].marginBottomTablet ) : getPlaceholder( fonts[ index ], 'marginBottomTablet' ) }
																onChange={ ( value ) => {
																	const fontValues = [ ...fonts ];

																	fontValues[ index ] = {
																		...fontValues[ index ],
																		marginBottomTablet: value,
																	};

																	handleChangeComplete( fontValues );
																} }
																rangeMin={ getRangeProps( fonts[ index ], 'marginBottom', 'min', 1 ) }
																rangeMax={ getRangeProps( fonts[ index ], 'marginBottom', 'max', 5 ) }
																step={ getRangeProps( fonts[ index ], 'marginBottom', 'step', .1 ) }
																withInputField={ false }
																initialPosition={ getPlaceholder( fonts[ index ], 'marginBottomTablet' ) }
															/>
														</div>

														<div className="generate-component-device-field" data-device="mobile">
															<RangeControl
																className={ 'generate-range-control-range' }
																value={ hasNumericValue( fonts[ index ].marginBottomMobile ) ? parseFloat( fonts[ index ].marginBottomMobile ) : getPlaceholder( fonts[ index ], 'marginBottomMobile' ) }
																onChange={ ( value ) => {
																	const fontValues = [ ...fonts ];

																	fontValues[ index ] = {
																		...fontValues[ index ],
																		marginBottomMobile: value,
																	};

																	handleChangeComplete( fontValues );
																} }
																rangeMin={ getRangeProps( fonts[ index ], 'marginBottom', 'min', 1 ) }
																rangeMax={ getRangeProps( fonts[ index ], 'marginBottom', 'max', 5 ) }
																step={ getRangeProps( fonts[ index ], 'marginBottom', 'step', .1 ) }
																withInputField={ false }
																initialPosition={ getPlaceholder( fonts[ index ], 'marginBottomMobile' ) }
															/>
														</div>

														<UnitPicker
															value={ fonts[ index ].marginBottomUnit }
															units={ [ 'px', 'em', 'rem' ] }
															onClick={ ( value ) => {
																const fontValues = [ ...fonts ];

																fontValues[ index ] = {
																	...fontValues[ index ],
																	marginBottomUnit: value,
																};

																handleChangeComplete( fontValues );
															} }
														/>
													</div>
												</BaseControl>
											}
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
				{ __( 'Add Typography', 'generatepress' ) }
			</Button>
		</div>
	);
};

export default GeneratePressTypographyControlForm;
