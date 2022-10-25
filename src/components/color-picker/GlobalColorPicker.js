import { kebabCase, toLower } from 'lodash';
import ColorPicker from './index';
import { useCallback, useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

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

		const regex = new RegExp("[^a-z0-9\\-]");
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
			onChangeVariableName( kebabCase( toLower( localVariableName ) ) );
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
				updateVariableName();
			} }
			onChangeVariableName={ setLocalVariableName }
			onBlurVariableName={ updateVariableName }
			onEnableVariableName={ () => setVariableNameDisabled( false ) }
		/>
	);
}
