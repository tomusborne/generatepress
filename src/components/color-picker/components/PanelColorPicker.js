import { ColorPicker } from '@wordpress/components';

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

		return colorValue;
	};

	return (
		<ColorPicker
			color={ getPaletteValue( value ) || '' }
			onChangeComplete={ ( color ) => {
				let colorString;

				if ( 'undefined' === typeof color.rgb || color.rgb.a === 1 ) {
					colorString = color.hex;
				} else {
					const { r, g, b, a } = color.rgb;
					colorString = `rgba(${ r }, ${ g }, ${ b }, ${ a })`;
				}

				onChange( colorString );
			} }
			disableAlpha={ ! showAlpha }
		/>
	);
}
