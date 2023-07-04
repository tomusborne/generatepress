import './style.scss';
import { useState, useEffect } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import TypographyList from './TypographyList';
import { selectorHasMarginBottom } from './utils';
import { isEmpty } from 'lodash';

const GeneratePressTypographyControlForm = ( props ) => {
	const propValues = props.value;
	const [ fonts, setFonts ] = useState( [] );
	const [ isOpen, setOpen ] = useState( 0 );
	const [ isUserInteraction, setIsUserInteraction ] = useState( false );

	useEffect( () => {
		let newFonts = [];

		if ( Array.isArray( propValues ) ) {
			newFonts = propValues;
		} else if ( 'object' === typeof propValues ) {
			newFonts = Object.values( propValues );
		}

		setFonts( newFonts );
		migrateOldUnits( newFonts );
	}, [] );

	useEffect( () => {
		// Prevents the Customizer iframe refreshing on load.
		const transport = isUserInteraction ? 'refresh' : 'postMessage';

		wp.customize.control( props.customizerSetting.id ).setting.transport = transport;
		wp.customize.control( props.customizerSetting.id ).setting.set( fonts );
	}, [ fonts ] );

	/**
	 * Migrate our number fields with separate units to single values with
	 * the units included.
	 *
	 * @param {Array} fontValues The existing font values.
	 *
	 * @since 3.4.0
	 */
	function migrateOldUnits( fontValues = [] ) {
		const numberFields = [ 'fontSize', 'lineHeight', 'letterSpacing', 'marginBottom' ];
		let updateValues = false;

		fontValues.forEach( ( font, index ) => {
			const newValues = {};

			numberFields.forEach( ( field ) => {
				const unit = font[ field + 'Unit' ] || '';

				[ '', 'Tablet', 'Mobile' ].forEach( ( device ) => {
					const fieldName = field + device;

					if ( ! isNaN( font[ fieldName ] ) && unit ) {
						newValues[ fieldName ] = String( font[ fieldName ] + unit );
					}
				} );

				if ( unit ) {
					newValues[ field + 'Unit' ] = '';
				}
			} );

			if ( ! isEmpty( newValues ) ) {
				fontValues[ index ] = {
					...fontValues[ index ],
					...newValues,
				};
				updateValues = true;
			}
		} );

		if ( updateValues ) {
			setFonts( fontValues );
		}
	}

	const toggleClose = () => setOpen( 0 );

	const updateFonts = ( fontValues ) => {
		setIsUserInteraction( true );
		setFonts( fontValues );
	};

	const deleteFont = ( fontIndex ) => {
		const fontValues = [ ...fonts ];

		fontValues.splice( fontIndex, 1 );
		updateFonts( fontValues );
	};

	const onChangeElement = ( { value, group, module }, index ) => {
		const fontValues = [ ...fonts ];

		fontValues[ index ] = {
			...fontValues[ index ],
			selector: value,
			module,
			group,
		};

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

		updateFonts( fontValues );
	};

	const onChangeFontValue = ( property, value, index ) => {
		const fontValues = [ ...fonts ];

		fontValues[ index ] = { ...fontValues[ index ] };
		fontValues[ index ][ property ] = value;

		updateFonts( fontValues );
	};

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer } />

			<TypographyList
				fontList={ fonts }
				setOpen={ setOpen }
				isOpen={ isOpen }
				label={ props.label }
				deleteFont={ deleteFont }
				toggleClose={ toggleClose }
				onChangeFontValue={ onChangeFontValue }
				onChangeElement={ onChangeElement }
			/>

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
						textDecoration: '',
						fontStyle: '',
						fontSize: '',
						fontSizeTablet: '',
						fontSizeMobile: '',
						lineHeight: '',
						lineHeightTablet: '',
						lineHeightMobile: '',
						letterSpacing: '',
						letterSpacingTablet: '',
						letterSpacingMobile: '',
					} );

					updateFonts( fontValues );

					setOpen( fontValues.length );
				} }
			>
				{ __( 'Add Typography', 'generatepress' ) }
			</Button>
		</div>
	);
};

export default GeneratePressTypographyControlForm;
