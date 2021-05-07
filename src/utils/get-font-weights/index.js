import googleFonts from '../../customizer-controls/font-picker/google-fonts.json';

import {
	__,
} from '@wordpress/i18n';

export default function getFontWeight( fontFamily ) {
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

	if ( typeof googleFonts[ fontFamily ] !== 'undefined' && typeof googleFonts[ fontFamily ].variants !== 'undefined' ) {
		weight = [
			{ value: '', label: __( 'Default', 'generatepress' ) },
			{ value: 'normal', label: __( 'Normal', 'generatepress' ) },
			{ value: 'bold', label: __( 'Bold', 'generatepress' ) },
		];

		googleFonts[ fontFamily ].variants.filter( function( k ) {
			const hasLetters = k.match( /[a-z]/g );
			const hasNumbers = k.match( /[0-9]/g );

			if ( ( hasLetters && hasNumbers ) || 'italic' === k || 'regular' === k ) {
				return false;
			}

			return true;
		} ).forEach( ( k ) => {
			weight.push(
				{ value: k, label: k }
			);
		} );
	}

	return weight;
}
