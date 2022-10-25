import { RgbStringColorPicker, RgbaStringColorPicker } from 'react-colorful';
import { colord } from 'colord';
import { useMemo } from '@wordpress/element';
import { useDebouncedCallback } from 'use-debounce';

export default function PanelColorPicker( { value, showAlpha, onChange } ) {
	const getPaletteValue = ( colorValue ) => {
		if ( String( colorValue ).startsWith( 'var(' ) ) {
			const variableName = colorValue.match( /\(([^)]+)\)/ );

			if ( variableName ) {
				const variableValue = getComputedStyle( document.documentElement ).getPropertyValue( variableName[ 1 ] );

				if ( variableValue ) {
					colorValue = variableValue;
				}
			}
		}

		return colord( colorValue ).toRgbString();
	};

	const Picker = showAlpha ? RgbaStringColorPicker : RgbStringColorPicker;
	const rgbColor = useMemo( () => getPaletteValue( value ), [ value ] );
	const debounced = useDebouncedCallback( onChange, 100 );

	return (
		<Picker
			color={ rgbColor }
			onChange={ ( nextColor ) => {
				if ( colord( nextColor ).isValid() ) {
					const alphaValue = colord( nextColor ).alpha();
					nextColor = 1 === alphaValue ? colord( nextColor ).toHex() : nextColor;
				}

				debounced( nextColor );
			} }
		/>
	);
}
