import { useDrag, useDrop } from 'react-dnd';

export default function DndItem( props ) {
	const {
		id,
		itemType,
		onDrop,
		getIndex,
		className,
		innerComponentProps,
		InnerComponent,
	} = props;

	const [ { isDragging }, drag ] = useDrag( () => ( {
		type: itemType,

		item: { id },

		collect: ( monitor ) => ( {
			isDragging: monitor.isDragging(),
		} ),
	} ), [ id ] );

	const [ , drop ] = useDrop( () => ( {
		accept: itemType,

		hover: ( { id: draggedId } ) => {
			if ( draggedId !== id ) {
				const overIndex = getIndex( id );

				onDrop( draggedId, overIndex );
			}
		},
	} ), [ getIndex, onDrop ] );

	const opacity = isDragging ? 0 : 1;

	return (
		<div
			ref={ ( node ) => ( drag( drop( node ) ) ) }
			className={ className }
			style={ { opacity } }
		>
			{ InnerComponent &&
				<InnerComponent { ...innerComponentProps } />
			}
		</div>
	);

}
