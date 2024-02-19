import { registerPlugin } from '@wordpress/plugins';
import { useEffect, useState } from '@wordpress/element';
import domReady from '@wordpress/dom-ready';
import { useSelect, select } from '@wordpress/data';

function getContentWidth( layout, contentContainer = '' ) {
	let contentWidth = '';
	let unit = 'px';
	const containerWidth = generatepressBlockEditor.customContentWidth
		? parseInt( generatepressBlockEditor.customContentWidth )
		: generatepressBlockEditor.containerWidth;
	const leftSidebarWidth = generatepressBlockEditor.leftSidebarWidth;
	const rightSidebarWidth = generatepressBlockEditor.rightSidebarWidth;

	// Get the pixel width of our content section.
	if ( 'left-sidebar' === layout ) {
		contentWidth = containerWidth * ( ( 100 - leftSidebarWidth ) / 100 );
	} else if ( 'right-sidebar' === layout ) {
		contentWidth = containerWidth * ( ( 100 - rightSidebarWidth ) / 100 );
	} else if ( 'no-sidebar' === layout ) {
		contentWidth = containerWidth;
	} else {
		contentWidth = containerWidth * ( ( 100 - ( Number( leftSidebarWidth ) + Number( rightSidebarWidth ) ) ) / 100 );
	}

	// Account for padding if necessary.
	if ( '' === contentContainer ) {
		const contentPadding = parseInt( generatepressBlockEditor.contentPaddingRight ) + parseInt( generatepressBlockEditor.contentPaddingLeft );
		contentWidth = Number( contentWidth ) - contentPadding;
	}

	// Account for our full width content option.
	if ( 'true' === contentContainer && ! generatepressBlockEditor.customContentWidth ) {
		contentWidth = 100;
		unit = '%';
	}

	return contentWidth + unit;
}

const ContentWidth = () => {
	const [ sidebarLayout, setSidebarLayout ] = useState( generatepressBlockEditor.sidebarLayout );
	const [ fullWidth, setFullWidth ] = useState( generatepressBlockEditor.contentAreaType );

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

	// We use editorWrapperStyles to update the content width when changing devices or code editor to visual editor.
	// See https://github.com/tomusborne/generatepress/issues/493.
	useEffect( () => {
		const body = document.querySelector( '.editor-styles-wrapper' );
		body?.style?.setProperty( '--content-width', getContentWidth( sidebarLayout, fullWidth ) );
	}, [ sidebarLayout, fullWidth, deviceType ] );

	domReady( () => {
		const sidebarSelect = document.getElementById( 'generate-sidebar-layout' );
		const contentWidthSelect = document.getElementById( '_generate-full-width-content' );

		if ( sidebarSelect ) {
			sidebarSelect.onchange = ( event ) => {
				setSidebarLayout( event.target.value || generatepressBlockEditor.globalSidebarLayout );
			};
		}

		if ( contentWidthSelect ) {
			contentWidthSelect.onchange = ( event ) => {
				setFullWidth( event.target.value || generatepressBlockEditor.contentAreaType );
			};
		}
	} );

	return null;
};

registerPlugin( 'generatepress-content-width', { render: ContentWidth } );
