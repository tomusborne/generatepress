import { render, createRoot } from '@wordpress/element';

export default function( component, root ) {
	if ( undefined !== createRoot ) {
		createRoot( root ).render( component );
	} else {
		render( component, root );
	}
}
