import { registerPlugin } from '@wordpress/plugins';
import { useEffect, useState } from '@wordpress/element';
import domReady from '@wordpress/dom-ready';
import { store as editorStore } from '@wordpress/editor';
import { useSelect } from '@wordpress/data';

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

	const editorMode = useSelect( ( select ) => (
		select( editorStore ).getEditorMode()
	), [] );

	const deviceType = useSelect( ( select ) => {
		const { getDeviceType } = select( 'core/editor' ) || {};

		if ( 'function' === typeof getDeviceType ) {
			return getDeviceType();
		}

		const {
			__experimentalGetPreviewDeviceType: experimentalGetPreviewDeviceType,
		} = select( 'core/edit-post' );

		if ( 'function' === typeof experimentalGetPreviewDeviceType ) {
			return experimentalGetPreviewDeviceType();
		}

		return 'Desktop';
	}, [] );

	useEffect( () => {
		const iframe = document.querySelector( 'iframe[name="editor-canvas"]' );
		const queryDocument = iframe?.contentDocument || document;
		const body = queryDocument.querySelector( '.editor-styles-wrapper' );

		if ( body ) {
			const contentWidth = getContentWidth( sidebarLayout, fullWidth );
			body.style.setProperty( '--content-width', contentWidth );
		}

		if ( iframe && 'loading' === iframe.contentDocument.readyState ) {
			const handleLoad = () => {
				if ( body ) {
					const contentWidth = getContentWidth( sidebarLayout, fullWidth );
					body.style.setProperty( '--content-width', contentWidth );
				}
			};

			iframe.addEventListener( 'load', handleLoad, { once: true } );
			return () => iframe.removeEventListener( 'load', handleLoad );
		}
	}, [ sidebarLayout, fullWidth, editorMode, deviceType ] );

	domReady( () => {
		const sidebarSelect = document.getElementById( 'generate-sidebar-layout' );
		const contentWidthSelect = document.getElementById( '_generate-full-width-content' );

		if ( sidebarSelect ) {
			sidebarSelect.onchange = ( event ) => {
				setSidebarLayout( event.target.value || generatepressBlockEditor.sidebarLayout );
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
