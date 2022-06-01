import { DndProvider } from 'react-dnd';
import { HTML5Backend } from 'react-dnd-html5-backend';
import { useCallback, useEffect, useState } from '@wordpress/element';
import reorder from '../../utils/reorder';
import DndList from './DndList';

export function SimpleDndList( props ) {
	const {
		idKey = 'id',
		acceptedType = 'simple-list-item',
		listData = [],
		onChangeData,
		listClassName = '',
		itemClassName = '',
		InnerComponent,
	} = props;

	const [ data, setData ] = useState( [] );

	useEffect( () => {
		setData( listData );
	}, [ JSON.stringify( listData ) ] );

	useEffect( () => {
		onChangeData( data );
	}, [ JSON.stringify( data ) ] );

	const getIndex = useCallback( ( id ) => {
		const found = data.find( ( item ) => ( id === item[ idKey ] ) );

		return data.indexOf( found );
	}, [ JSON.stringify( data ) ] );

	const moveItem = useCallback( ( id, toIndex ) => {
		const index = getIndex( id );

		setData( reorder( data, index, toIndex ) );
	}, [ JSON.stringify( data ) ] );

	return (
		<DndProvider backend={ HTML5Backend }>
			<DndList
				data={ data }
				itemIdKey={ idKey }
				onDrop={ moveItem }
				getIndex={ getIndex }
				itemType={ acceptedType }
				listClassName={ listClassName }
				itemClassName={ itemClassName }
				InnerComponent={ InnerComponent }
			/>
		</DndProvider>
	);
}
