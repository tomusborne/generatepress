import './style.scss';
import googleFonts from './google-fonts.json';
import getIcon from '../../utils/get-icon';
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import AdvancedSelect from '../../components/advanced-select';
import {
	TextControl,
	ToggleControl,
	Button,
	Tooltip,
	BaseControl,
} from '@wordpress/components';

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

	const propagateChanges = ( currentFontFamily, previousFontFamily ) => {
		const typographyControl = wp.customize.control( 'generate_settings[typography]' );
		const fonts = typographyControl.setting.get();
		const fontValues = [ ...fonts ];

		fonts.filter( function( font ) {
			if ( '' === font.fontFamily && '' === previousFontFamily ) {
				return false;
			}

			if ( font.fontFamily !== previousFontFamily ) {
				return false;
			}

			return true;
		} ).forEach( ( typography, index ) => {
			fontValues[ index ] = {
				...fontValues[ index ],
				fontFamily: currentFontFamily,
			};
		} );

		typographyControl.setting.set( fontValues );
		typographyControl.renderContent();
	};

	const toggleClose = () => {
		setOpen( 0 );
	};

	const fonts = props.value;

	const fontFamilies = [
		{
			label: __( 'System fonts', 'generatepress' ),
			options: [
				{ value: 'Arial', label: 'Arial' },
				{ value: 'Helvetica', label: 'Helvetica' },
				{ value: 'Times New Roman', label: 'Times New Roman' },
				{ value: 'Georgia', label: 'Georgia' },
			],
		},
		{
			label: __( 'Google Fonts', 'generatepress' ),
			options: Object.keys( googleFonts ).map( ( font ) => ( { value: font, label: font } ) ),
		},
	];

	fonts.forEach( ( font ) => {
		const index = font.googleFont ? 1 : 0;

		fontFamilies[ index ].options = fontFamilies[ index ].options.filter( ( obj ) => obj.value !== font.fontFamily );
	} );

	const isValidGoogleFont = ( font ) => Object.keys( googleFonts ).includes( font );
	const fontFamilyExists = ( fontFamily ) => fonts.filter( ( font ) => font.fontFamily === fontFamily ).length > 0;

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			{
				!! fonts.length > 0 && fonts.map( ( font, index ) => {
					const itemId = index + 1;

					const onFontChange = ( value ) => {
						const fontValues = [ ...fonts ];
						const previousValue = fontValues[ index ];

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

						propagateChanges( fontValues[ index ].fontFamily, previousValue.fontFamily );
					};

					const onFontSelect = ( newFont ) => onFontChange( newFont.value );

					const onFontShortcut = ( value ) => {
						if ( fontFamilyExists( value ) ) {
							// eslint-disable-next-line
							alert( __( 'Font already selected', 'generatepress' ) );

							value = '';
						}

						onFontChange( value );
					};

					const currentFontFamily = fonts[ index ].fontFamily || '';

					return (
						<div className="generate-font-manager--item" key={ index }>
							<div className="generate-font-manager--header">
								<Button
									className="generate-font-manager--label"
									onClick={ () => {
										if ( itemId !== isOpen ) {
											setOpen( itemId );
										} else {
											setOpen( false );
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
											} else {
												setOpen( false );
											}
										} }
									>
										{ itemId === isOpen ? getIcon( 'chevron-up' ) : getIcon( 'chevron-down' ) }
									</Button>
								</Tooltip>

								<Tooltip text={ __( 'Delete Font Family', 'generatepress' ) }>
									<Button
										className="generate-font-manager--delete-font"
										onClick={ () => {
											// eslint-disable-next-line
											if ( window.confirm( __( 'This will permanently delete this font family. Doing so will stop elements from displaying it as their font.', 'generatepress' ) ) ) {
												const fontValues = [ ...fonts ];
												const previousValue = fontValues[ index ];

												propagateChanges( '', previousValue.fontFamily );

												fontValues.splice( index, 1 );
												handleChangeComplete( fontValues );
											}
										} }
										style={ { opacity: itemId === isOpen ? 0.2 : '', pointerEvents: !! isOpen ? 'none' : '' } }
									>
										{ getIcon( 'x' ) }
									</Button>
								</Tooltip>
							</div>

							{ itemId === isOpen &&
								<div className="generate-customize-control--font-dropdown">
									<BaseControl
										className="generate-component-font-family-picker-wrapper"
										id="generate-font-manager-family-name--input"
									>
										<AdvancedSelect
											options={ fontFamilies }
											placeholder={ __( 'Search fonts…', 'generatepress' ) }
											onChange={ onFontSelect }
										/>

										<TextControl
											id="generate-font-manager-family-name--input"
											className="generate-font-manager-family-name--input"
											label={ __( 'Font family name', 'generatepress' ) }
											value={ currentFontFamily }
											onChange={ onFontShortcut }
										/>

										{ !! fonts[ index ].fontFamily &&
											<div className="generate-font-manager--options">
												<ToggleControl
													className="generate-font-manager-google-font--field"
													label={ __( 'Google Font', 'generatepress' ) }
													checked={ !! fonts[ index ].googleFont }
													disabled={ ! isValidGoogleFont( currentFontFamily ) }
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
								</div>
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
						googleFontApi: 1,
						googleFontCategory: '',
						googleFontVariants: '',
					} );

					handleChangeComplete( fontValues );

					const itemCount = wp.customize.control( props.customizerSetting.id ).setting.get().length;
					setOpen( itemCount );
				} }
			>
				{ __( 'Add Font', 'generatepress' ) }
			</Button>
		</div>
	);
};

export default GeneratePressFontManagerControlForm;
