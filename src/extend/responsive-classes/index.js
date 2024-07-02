import {
	registerPlugin,
} from '@wordpress/plugins';

import {
	useSelect,
	select,
} from '@wordpress/data';

import { store as editorStore } from '@wordpress/editor';

const SetResponsiveClasses = () => {
	const {
		deviceType,
	} = useSelect( () => {
		const {
			getDeviceType: getPreviewDeviceType = () => false,
		} = select( editorStore );

		if ( getPreviewDeviceType() ) {
			return {
				deviceType: getPreviewDeviceType(),
			};
		}

		const {
			__experimentalGetPreviewDeviceType: experimentalGetPreviewDeviceType = () => 'Desktop',
		} = select( 'core/edit-post' );

		return {
			deviceType: experimentalGetPreviewDeviceType(),
		};
	}, [] );

	document.querySelector( 'body' ).classList.remove( 'gp-is-device-desktop', 'gp-is-device-tablet', 'gp-is-device-mobile' );
	document.querySelector( 'body' ).classList.add( 'gp-is-device-' + deviceType.toLowerCase() );

	return null;
};

if ( select( 'core/edit-post' ) && select( 'core/edit-post' ).__experimentalGetPreviewDeviceType ) {
	registerPlugin( 'generatepress-responsive-classes', { render: SetResponsiveClasses } );
}
