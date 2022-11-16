import './style.scss';
import { BaseControl, Popover } from '@wordpress/components';
import { useCallback, useState } from '@wordpress/element';
import ColorButton from './components/ColorButton';
import PanelColorPicker from './components/PanelColorPicker';
import VariableNameInput from './components/VariableNameInput';
import ColorInput from './components/ColorInput';
import ColorPalette from './components/ColorPalette';
import { useDebouncedCallback } from 'use-debounce';

export default function ColorPicker( props ) {
	const {
		value,
		variableName,
		label,
		tooltipText,
		tooltipPosition,
		showAlpha,
		showReset,
		showVariableName,
		showPalette,
		variableNameIsDisabled,
		variableNameHelpText,
		onChange = () => false,
		onClosePanel = () => false,
		onChangeVariableName = () => false,
		onBlurVariableName = () => false,
		onEnableVariableName = () => false,
		onClickReset = () => false,
	} = props;

	const [ isPanelOpen, setIsPanelOpen ] = useState( false );
	const openPanel = useCallback( () => {
		setIsPanelOpen( true );
	} );

	const closePanel = useCallback( () => {
		setIsPanelOpen( false );
		onClosePanel();
	} );

	// This fixes useState getting called twice on close.
	const debouncedClosePanel = useDebouncedCallback( closePanel, 100 );

	return (
		<div className="generate-color-picker-area">
			<ColorButton
				color={ value || 'transparent' }
				tooltip={ tooltipText }
				tooltipPosition={ tooltipPosition }
				ariaExpanded={ isPanelOpen }
				onClick={ isPanelOpen ? debouncedClosePanel : openPanel }
			/>

			{ isPanelOpen &&
			<Popover
				position="bottom center"
				className="generate-component-color-picker"
				onClose={ debouncedClosePanel }
				focusOnMount="container"
				shift={ true }
			>
				<BaseControl
					label={ !! label ? label : '' }
					id="generate-color-input-field"
					className="generate-color-input-main-label"
				>
					<PanelColorPicker
						value={ value }
						onChange={ onChange }
						showAlpha={ showAlpha }
					/>

					<div className="generate-color-option-area">
						{ showVariableName &&
						<VariableNameInput
							value={ variableName }
							onChange={ onChangeVariableName }
							onBlur={ onBlurVariableName }
							onEnable={ onEnableVariableName }
							isDisabled={ variableNameIsDisabled }
							helpText={ variableNameHelpText }
						/>
						}

						<ColorInput
							value={ value }
							onChange={ onChange }
							showReset={ showReset }
							onClickReset={ onClickReset }
						/>

						{ showPalette &&
						<ColorPalette
							value={ value }
							onChange={ onChange }
						/>
						}

					</div>
				</BaseControl>
			</Popover>
			}
		</div>
	);
}
