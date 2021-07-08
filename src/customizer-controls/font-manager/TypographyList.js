import Typography from './TypographyList/Typography';

const TypographyList = ( props ) => {
	const { fontList } = props;

	return fontList.map( ( font, index ) => {
		font.index = index;

		return (
			<Typography
				key={ index }
				itemId={ ( index + 1 ) }
				font={ font }
				{ ...props }
			/>
		);
	} );
};

export default TypographyList;
