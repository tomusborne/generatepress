import { kebabCase, toLower } from 'lodash';
import ColorPicker from './ColorPicker';
import { useCallback, useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

export default function GlobalColorPicker( props ) {
	const { index, value, variableName, onChange, onChangeVariableName, checkVariableNameIsAvailable } = props;
	const [ isVariableNameDisabled, setVariableNameDisabled ] = useState( !! value );
	const [ localVariableName, setLocalVariableName ] = useState( '' );
	const [ isVariableNameValid, setVariableNameValid ] = useState( false );
	const [ variableNameHelpText, setHelpText ] = useState( '' );

	useEffect( () => {
		setLocalVariableName( variableName );
	}, [ variableName ] );

	useEffect( () => {
		setVariableNameValid( checkVariableNameIsAvailable( toLower( localVariableName ), index ) );
	}, [ localVariableName ] );

	useEffect( () => {
		const message = isVariableNameValid ? '' : __( 'Variable name already used.', 'generateblocks');

		setHelpText( message );
	}, [ isVariableNameValid ] );

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
