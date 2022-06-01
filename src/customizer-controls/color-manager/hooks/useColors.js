import { filter, map } from 'lodash';
import { useReducer } from '@wordpress/element';

const defaultColor = {
	slug: '',
	color: '',
};

const initialState = [];

function reducer( state, action ) {
	switch ( action.type ) {
		case 'SET_COLORS':
			return [ ...action.payload ];

		case 'ADD_COLOR':
			return [ ...state, action.payload ];

		case 'UPDATE_COLOR_VALUE':
			return map( state, ( color ) => (
				color.slug === action.payload.slug ? { ...color, color: action.payload.value } : color )
			)

		case 'UPDATE_COLOR_SLUG':
			return map( state, ( color ) => (
				color.slug === action.payload.slug ? { ...color, slug: action.payload.value } : color )
			)

		case 'DELETE_COLOR':
			return filter( state, ( color ) => ( color.slug !== action.payload ) );

		default:
			return state;
	}
}

export default function useColors() {
	const [ colors, dispatch ] = useReducer( reducer, initialState );

	return {
		colors,
		setColors: ( payload ) => ( dispatch( { type: 'SET_COLORS', payload } ) ),
		addColor: ( slug = '', color = '' ) => ( dispatch( {
			type: 'ADD_COLOR',
			payload: Object.assign( {}, defaultColor, { slug, color } )
		} ) ),
		deleteColor: ( payload ) => ( dispatch( { type: 'DELETE_COLOR', payload } ) ),
		updateColorValue: ( slug, value ) => ( dispatch( { type: 'UPDATE_COLOR_VALUE', payload: { slug, value } } ) ),
		updateColorSlug: ( slug, value ) => ( dispatch( { type: 'UPDATE_COLOR_SLUG', payload: { slug, value } } ) ),
	};
}
