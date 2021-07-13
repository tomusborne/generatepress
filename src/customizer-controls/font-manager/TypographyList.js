import Typography from './TypographyList/Typography';
import { getElementGroups, objectMapToArray, groupBy } from './utils';

const TypographyList = ( props ) => {
	const { fontList } = props;
	const groupedFonts = groupBy( fontList, 'group', 'other' );
	const elementGroups = getElementGroups();

	return objectMapToArray( elementGroups, ( groupLabel, group ) => {
		const fonts = groupedFonts[ group ] ?? [];

		if ( fonts.length === 0 ) {
			return;
		}

		return (
			<div key={ group }>
				<span style={ { fontSize: '15px', fontWeight: 600, marginBottom: '10px' } }>{ groupLabel }</span>
				{ fonts.map( ( font ) => (
					<Typography
						key={ font.index }
						itemId={ ( font.index + 1 ) }
						font={ font }
						{ ...props }
					/>
				) ) }
			</div>
		);
	} );
};

export default TypographyList;
