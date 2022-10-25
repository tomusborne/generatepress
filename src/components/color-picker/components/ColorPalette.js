import { BaseControl, ColorPalette } from '@wordpress/components';

export default function PanelColorPalette( { value, onChange } ) {
	let palette = generateCustomizerControls.palette;

	const localPalette = window.sessionStorage.getItem( 'generateGlobalColors' );

	if ( localPalette ) {
		palette = JSON.parse( localPalette );
	}

	return (
		<BaseControl
			className="generate-component-color-picker-palette"
		>
			<ColorPalette
				colors={ palette }
				value={ value }
				onChange={ ( color ) => {
					if ( 'undefined' === typeof color ) {
						color = '';
					}

					onChange( color );

					setTimeout( function() {
						document.querySelector( '.generate-color-input-wrapper input' ).focus();
					}, 10 );
				} }
				disableCustomColors={ true }
				clearable={ false }
			/>
		</BaseControl>
	);
}
