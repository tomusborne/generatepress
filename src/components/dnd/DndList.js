import { useDrop } from 'react-dnd';
import DndItem from './DndItem';

export default function DndList( props ) {
	const {
		data,
		itemIdKey,
		onDrop,
		getIndex,
		itemType,
		listClassName,
		itemClassName,
		InnerComponent,
	} = props;

	const [ , drop ] = useDrop( () => ( {
		accept: itemType,
	} ) );

	return (
		<div ref={ drop } className={ listClassName }>
			{ data && data.map( ( item ) => (
				<DndItem
					key={ item[ itemIdKey ] }
					id={ item[ itemIdKey ] }
					itemType={ itemType }
					className={ itemClassName }
					onDrop={ onDrop }
					getIndex={ getIndex }
					InnerComponent={ InnerComponent }
					innerComponentProps={ { item } }
				/>
			) ) }
		</div>
	);
}
