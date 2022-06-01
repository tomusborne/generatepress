import { Tooltip } from '@wordpress/components';

export default function ColorPlaceholder( { item } ) {
	return (
		<Tooltip text={ item.slug } position={ 'top center' }>
			<span style={ { backgroundColor: item.color } } />
		</Tooltip>
	);
}
