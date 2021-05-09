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
		body: __( 'Body', 'generatepress' ),
		'main-title': __( 'Site Title', 'generatepress' ),
		'site-description': __( 'Site Description', 'generatepress' ),
		'main-navigation': __( 'Main Navigation', 'generatepress' ),
		'main-sub-navigation': __( 'Main Sub-Navigation', 'generatepress' ),
		buttons: __( 'Buttons', 'generatepress' ),
		'all-headings': __( 'All Headings', 'generatepress' ),
		h1: __( 'Heading 1 (H1)', 'generatepress' ),
		h2: __( 'Heading 2 (H2)', 'generatepress' ),
		h3: __( 'Heading 3 (H3)', 'generatepress' ),
		h4: __( 'Heading 4 (H4)', 'generatepress' ),
		h5: __( 'Heading 5 (H5)', 'generatepress' ),
		h6: __( 'Heading 6 (H6)', 'generatepress' ),
		'widget-titles': __( 'Widget Titles', 'generatepress' ),
		footer: __( 'Footer', 'generatepress' ),
		custom: __( 'Custom', 'generatepress' ),
	};

	const getElementLabel = ( element ) => {
		return 'undefined' !== typeof elements[ element ] ? elements[ element ] : element;
	};

	const elementOptions = [
		{ value: '', label: __( 'Choose element…', 'generatepress' ) },
	];

	Object.keys( elements ).forEach( ( element ) => {
		elementOptions.push(
			{
				value: element,
				label: elements[ element ],
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
									{ !! fonts[ index ].selector ? getElementLabel( fonts[ index ].selector ) : props.label }
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

											<UtilityLabel
												label={ __( 'Font Size', 'generateblocks' ) }
												value={ fonts[ index ].fontSizeUnit }
												devices={ [ 'desktop', 'tablet', 'mobile' ] }
											/>

											<div className="generate-component-input-with-unit">
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
													rangeMin={ 3 }
													rangeMax={ 100 }
													step={ 1 }
													withInputField={ false }
												/>

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
