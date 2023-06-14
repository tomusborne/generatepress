/**
 * External dependencies
 */
import { useEffect, useState, useRef } from '@wordpress/element';
import { TextControl, BaseControl } from '@wordpress/components';
import classnames from 'classnames';

/**
 * Internal dependencies
 */

import './editor.scss';

export default function UnitControl( props ) {
	const {
		label,
		units = [ 'px', 'em', '%', 'rem' ],
		defaultUnit = '',
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

	const [ unitValue, setUnitValue ] = useState( '' );
	const [ numericValue, setNumericValue ] = useState( '' );
	const [ placeholderValue, setPlaceholderValue ] = useState( '' );
	const isMounted = useRef( false );
	const wrapperRef = useRef( false );
	const inputRef = useRef( false );

	const splitValues = ( values ) => {
		const unitRegex = units.join( '|' );
		const splitRegex = new RegExp( `(${ unitRegex })` );

		// Allow numbers with no units.
		if ( ! isNaN( values ) ) {
			return [ values, '' ];
		}

		return values
			? values.toString().split( splitRegex ).filter( ( singleValue ) => '' !== singleValue )
			: [];
	};

	const getNumericValue = ( values ) => values.length > 0 ? values[ 0 ] : '';
	const defaultUnitValue = defaultUnit ? defaultUnit : units[ 0 ];
	const getUnitValue = ( values ) => values.length > 1 ? values[ 1 ] : defaultUnitValue;

	// Test if the value starts with a number or a decimal.
	const startsWithNumber = ( number ) => /^[0-9.]/.test( number );

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

				{ !! overrideAction && <div className="gblocks-unit-control__override-action">{ overrideAction() } </div> }

				{ (
					startsWithNumber( numericValue ) ||
					(
						! numericValue &&
						( ! placeholderValue || startsWithNumber( placeholderValue ) )
					)
				) &&
					<span className="gblocks-unit-control__unit-select">
						<select
							value={ unitValue }
							disabled={ disabled || 1 === units.length }
							onChange={ ( e ) => setUnitValue( e.target.value ) }
						>
							{ units.map( ( unitOption ) => <option key={ unitOption } value={ unitOption }>{ '' === unitOption ? '—' : unitOption }</option> ) }
						</select>
					</span>
				}
			</div>
		</BaseControl>
	);
}
