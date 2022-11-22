import { toLower } from 'lodash';
import ColorPicker from './index';
import { useCallback, useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Transform a string to kebab case.
 *
 * @param {string} input The input to transform.
 * @return {string} The input transformed to kebab case.
 */
function kebabCase( input ) {
	return input
		.replace( /[^a-zA-Z0-9\s-_]/g, '' ) // Remove special characters, except spaces, underscore, and the dash.
		.trim() // Remove starting/ending spaces.
		.replace( /[\s_]+/g, '-' ) // Replaces spaces and underscores to single dash.
		.replace( /([a-z])([A-Z])/g, '$1-$2' ) // Split when lower case is before an upper case.
		.toLowerCase();
}

export default function GlobalColorPicker( props ) {
	const { index, value, variableName, onChange, onChangeVariableName, checkVariableNameIsAvailable } = props;
	const [ isVariableNameDisabled, setVariableNameDisabled ] = useState( !! value );
	const [ localVariableName, setLocalVariableName ] = useState( '' );
	const [ isVariableNameValid, setVariableNameValid ] = useState( false );
	const [ variableNameHasSpecialChars, setVariableNameHasSpecialChars ] = useState( false );
	const [ variableNameHelpText, setHelpText ] = useState( '' );

	useEffect( () => {
		setLocalVariableName( variableName );
	}, [ variableName ] );

	useEffect( () => {
		setVariableNameValid( checkVariableNameIsAvailable( toLower( localVariableName ), index ) );

		const regex = new RegExp( /[^a-z0-9\\-]/ );
		setVariableNameHasSpecialChars( regex.test( localVariableName ) );
	}, [ localVariableName ] );

	useEffect( () => {
		const message = isVariableNameValid ? '' : __( 'Variable name already used.', 'generateblocks');

		setHelpText( message );
	}, [ isVariableNameValid ] );

	useEffect( () => {
		if ( variableNameHasSpecialChars ) {
			setHelpText( __( 'Variable name will be converted to kebab-case.', 'generateblocks') );
		} else if ( isVariableNameValid && ! variableNameHasSpecialChars ) {
			setHelpText( '' );
		}
	}, [ variableNameHasSpecialChars, isVariableNameValid ] );

	const updateVariableName = useCallback( () => {
		if ( isVariableNameValid ) {
			const kebabVariable = kebabCase( localVariableName );

			onChangeVariableName( kebabVariable );
			setLocalVariableName( kebabVariable );
		} else {
			setLocalVariableName( variableName );
		}
	}, [ isVariableNameValid, localVariableName, variableName ] );

	return (
		<ColorPicker
			value={ value }
			variableName={ localVariableName }
			hideLabel={ true }
			tooltipText={ variableName || '' }
			tooltipPosition={ 'bottom center' }
			showAlpha={ true }
			showReset={ false }
			showVariableName={ true }
			showPalette={ false }
			variableNameIsDisabled={ isVariableNameDisabled }
			variableNameHelpText={ variableNameHelpText }
			onChange={ onChange }
			onClosePanel={ () => {
				setVariableNameDisabled( true );
			} }
			onChangeVariableName={ setLocalVariableName }
			onBlurVariableName={ updateVariableName }
			onEnableVariableName={ () => setVariableNameDisabled( false ) }
		/>
	);
}
