import {
	registerPlugin,
} from '@wordpress/plugins';

import {
	useSelect,
	select,
} from '@wordpress/data';

const SetResponsiveClasses = () => {
	const {
		deviceType,
	} = useSelect( () => {
		const {
			__experimentalGetPreviewDeviceType: getPreviewDeviceType,
		} = select( 'core/edit-post' );

		if ( ! getPreviewDeviceType ) {
			return {
				deviceType: null,
			};
		}

		return {
			deviceType: getPreviewDeviceType(),
		};
	}, [] );

	document.querySelector( 'body' ).classList.remove( 'gp-is-device-desktop', 'gp-is-device-tablet', 'gp-is-device-mobile' );
	document.querySelector( 'body' ).classList.add( 'gp-is-device-' + deviceType.toLowerCase() );

	return null;
};

if ( select( 'core/edit-post' ).__experimentalGetPreviewDeviceType ) {
	registerPlugin( 'generatepress-responsive-classes', { render: SetResponsiveClasses } );
}
