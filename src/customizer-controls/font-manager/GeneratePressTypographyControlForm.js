import './style.scss';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import TypographyList from './TypographyList';
import { getElements, selectorHasMarginBottom } from './utils';

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

	const deleteFont = ( fontIndex ) => {
		const fontValues = [ ...fonts ];

		fontValues.splice( fontIndex, 1 );
		handleChangeComplete( fontValues );
	};

	const onChangeElement = ( { value }, index ) => {
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
	};

	const onChangeFontValue = ( property, value, index ) => {
		const fontValues = [ ...fonts ];

		fontValues[ index ] = { ...fontValues[ index ] };
		fontValues[ index ][ property ] = value;

		handleChangeComplete( fontValues );
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

					const itemCount = wp.customize.control( props.customizerSetting.id ).setting.get().length;
					setOpen( itemCount );
				} }
			>
				{ __( 'Add Typography', 'generatepress' ) }
			</Button>
		</div>
	);
};

export default GeneratePressTypographyControlForm;
