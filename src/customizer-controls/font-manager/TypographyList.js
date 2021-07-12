import Typography from './TypographyList/Typography';
import { ReactSortable } from 'react-sortablejs';
import { useState, useCallback } from '@wordpress/element';

const TypographyList = ( props ) => {
	const { fontList, setFonts } = props;
	const [ sortableFonts, setSortableFonts ] = useState( fontList );

	const onDragEnd = useCallback( () => {
		setFonts( sortableFonts );
	}, [ sortableFonts, setFonts ] );

	return (
		<ReactSortable
			list={ sortableFonts }
			setList={ setSortableFonts }
			handle=".generate-font-manager--drag-handle"
			onEnd={ onDragEnd }
		>
			{ sortableFonts.map( ( font, index ) => {
				font.index = index;

				return (
					<div key={ index } className="sortable-item-wrapper">
						<div className="sortable-item-content">
							<Typography
								key={ index }
								itemId={ ( index + 1 ) }
								font={ font }
								{ ...props }
							/>
						</div>
					</div>
				);
			} ) }
		</ReactSortable>
	);
};

export default TypographyList;
