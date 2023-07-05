/**
 * External dependencies
 */
import { useEffect, useState, useRef } from '@wordpress/element';
import { TextControl, BaseControl } from '@wordpress/components';
import classnames from 'classnames';

/**
 * Internal dependencies
 */

import './style.scss';
import UnitDropdown from './unit-dropdown';
import unitList from './unit-list';

export default function UnitControl( props ) {
	const {
		label,
		units = [],
		defaultUnit = '',
		unitCount = 7,
		id,
		disabled = false,
		overrideValue = null,
		overrideAction = () => null,
		onChange,
		value,
		placeholder,
		help = '',
		focusOnMount = false,
		onFocus = () => null,
	} = props;

	const visibleUnits = units.concat( unitList ).slice( 0, unitCount );
	const [ unitValue, setUnitValue ] = useState( '' );
	const [ numericValue, setNumericValue ] = useState( '' );
	const [ placeholderValue, setPlaceholderValue ] = useState( '' );
	const isMounted = useRef( false );
	const wrapperRef = useRef( false );
	const inputRef = useRef( false );

	const splitValues = ( values ) => {
		const unitRegex = unitList.join( '|' );
		const splitRegex = new RegExp( `(${ unitRegex })` );

		return values
			? values.toString().toLowerCase().split( splitRegex ).filter( ( singleValue ) => '' !== singleValue )
			: [];
	};

	const getNumericValue = ( values ) => values.length > 0 ? values[ 0 ].trim() : '';
	const defaultUnitValue = defaultUnit ? defaultUnit : visibleUnits[ 0 ];
	const getUnitValue = ( values ) => {
		if ( values.length > 1 ) {
			// Return the unit if we have it.
			return values[ 1 ];
		} else if ( values.length > 0 ) {
			// Return no unit if we have a value but no unit.
			return '';
		} else if ( ! values.length ) {
			// Return the default unit if we have no value or unit.
			return defaultUnitValue;
		}
	};

	// Test if the value starts with a number, decimal or a single dash.
	const startsWithNumber = ( number ) => /^([-]?\d|[-]?\.)/.test( number );

	const setPlaceholders = () => {
		if ( ! value ) {
			const placeholderValues = overrideValue
				? splitValues( overrideValue )
				: splitValues( placeholder );

			setPlaceholderValue( getNumericValue( placeholderValues ) );
			setUnitValue( getUnitValue( placeholderValues ) );
		}
	};

	// Split the number and unit into two values.
	useEffect( () => {
		const newValue = overrideValue && disabled ? overrideValue : value;

		// Split our values if we're starting with a number.
		if ( startsWithNumber( newValue ) ) {
			const values = splitValues( newValue );

			setNumericValue( getNumericValue( values ) );
			setUnitValue( getUnitValue( values ) );
		} else {
			setNumericValue( newValue );
			setUnitValue( '' );
		}

		setPlaceholders();
	}, [ value, overrideValue ] );

	useEffect( () => {
		// Don't run this on first render.
		if ( ! isMounted.current ) {
			isMounted.current = true;
			return;
		}

		const hasOverride = !! overrideValue && !! disabled;

		const fullValue = startsWithNumber( numericValue )
			? numericValue + unitValue
			: numericValue;

		// Clear the placeholder if the units don't match.
		if ( ! fullValue ) {
			if ( unitValue !== getUnitValue( splitValues( placeholder ) ) ) {
				setPlaceholderValue( '' );
			} else {
				setPlaceholders();
			}
		}

		if ( ! hasOverride && fullValue !== value ) {
			onChange( fullValue );
		}
	}, [ numericValue, unitValue ] );

	useEffect( () => {
		if ( focusOnMount && inputRef?.current ) {
			inputRef.current.focus();
		}
	}, [ label ] );

	return (
		<BaseControl
			label={ label }
			help={ help }
			id={ id }
			className={ classnames( {
				'gblocks-unit-control': true,
				'gblocks-unit-control__disabled': !! disabled,
			} ) }
		>
			<div className="gblocks-unit-control__input" ref={ wrapperRef }>
				<TextControl
					type="text"
					value={ numericValue }
					placeholder={ placeholderValue }
					id={ id }
					autoComplete="off"
					disabled={ disabled }
					onChange={ ( newValue ) => setNumericValue( newValue ) }
					onFocus={ () => {
						onFocus();
					} }
					ref={ inputRef }
				/>

				<div className="gblocks-unit-control__input--action">
					{ !! overrideAction && <div className="gblocks-unit-control__override-action">{ overrideAction() } </div> }

					{ (
						startsWithNumber( numericValue ) ||
						(
							! numericValue &&
							( ! placeholderValue || startsWithNumber( placeholderValue ) )
						)
					) &&
						<UnitDropdown
							value={ unitValue }
							disabled={ disabled || 1 === visibleUnits.length }
							units={ visibleUnits }
							onChange={ ( newValue ) => setUnitValue( newValue ) }
						/>
					}
				</div>
			</div>
		</BaseControl>
	);
}
