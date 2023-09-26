import { getMigratedUnits } from '../customizer-controls/font-manager/utils';

describe( 'Customizer unit migration', () => {
	it( 'should migrate separate units', () => {
		const fontValues = [
			{
				fontSize: 12,
				fontSizeUnit: 'px',
				lineHeight: 2,
				letterSpacing: 1,
				letterSpacingUnit: 'px',
				fontFamily: 'Ubuntu',
			},
			{
				lineHeight: 1,
				lineHeightUnit: 'rem',
			},
		];

		fontValues.forEach( ( font, index ) => {
			const newValues = getMigratedUnits( font );

			fontValues[ index ] = {
				...fontValues[ index ],
				...newValues,
			};
		} );

		expect( fontValues ).toEqual( [
			{
				fontFamily: 'Ubuntu',
				fontSize: '12px',
				fontSizeUnit: '',
				lineHeight: '2',
				letterSpacing: '1px',
				letterSpacingUnit: '',
			},
			{
				lineHeight: '1rem',
				lineHeightUnit: '',
			},
		] );
	} );
} );
