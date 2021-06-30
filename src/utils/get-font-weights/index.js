import googleFonts from '../../customizer-controls/font-manager/google-fonts.json';

import {
	__,
} from '@wordpress/i18n';

export default function getFontWeight( fontFamily, availableFonts ) {
	let weight = [
		{ value: '', 		label: __( 'Default', 'generatepress' ) },
		{ value: 'normal', 	label: __( 'Normal', 'generatepress' ) },
		{ value: 'bold', 	label: __( 'Bold', 'generatepress' ) },
		{ value: '100', 	label: '100' },
		{ value: '200', 	label: '200' },
		{ value: '300', 	label: '300' },
		{ value: '400', 	label: '400' },
		{ value: '500', 	label: '500' },
		{ value: '600', 	label: '600' },
		{ value: '700', 	label: '700' },
		{ value: '800', 	label: '800' },
		{ value: '900', 	label: '900' },
	];

	if ( 'undefined' !== typeof googleFonts[ fontFamily ] && 'undefined' !== availableFonts.googleFontVariants ) {
		weight = [
			{ value: '', label: __( 'Default', 'generatepress' ) },
			{ value: 'normal', label: __( 'Normal', 'generatepress' ) },
			{ value: 'bold', label: __( 'Bold', 'generatepress' ) },
		];

		availableFonts.filter( function( font ) {
			if ( font.fontFamily === fontFamily ) {
				return true;
			}

			return false;
		} ).forEach( ( font ) => {
			let variants = font.googleFontVariants.replaceAll( ' ', '' );
			variants = variants.split( ',' );

			variants.filter( function( variant ) {
				const hasLetters = variant.match( /[a-z]/g );
				const hasNumbers = variant.match( /[0-9]/g );

				if ( ( hasLetters && hasNumbers ) || 'italic' === variant || 'regular' === variant ) {
					return false;
				}

				return true;
			} ).forEach( ( variant ) => {
				weight.push(
					{ value: variant, label: variant }
				);
			} );
		} );
	}

	return weight;
}
