import { registerPlugin } from '@wordpress/plugins';
import domReady from '@wordpress/dom-ready';

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

		// We multiply the padding by 2 to account for border-box.
		contentWidth = Number( contentWidth ) - ( contentPadding * 2 );
	}

	// Account for our full width content option.
	if ( 'true' === contentContainer && ! generatepressBlockEditor.customContentWidth ) {
		contentWidth = 100;
		unit = '%';
	}

	return contentWidth + unit;
}

const ContentWidth = () => {
	domReady( () => {
		const sidebarLayout = document.getElementById( 'generate-sidebar-layout' );
		const fullWidth = document.getElementById( '_generate-full-width-content' );

		if ( ! sidebarLayout || ! fullWidth ) {
			return;
		}

		const contentContainer = fullWidth?.value ? fullWidth?.value : generatepressBlockEditor.contentAreaType;
		const currentSidebarLayout = sidebarLayout?.value || generatepressBlockEditor.globalSidebarLayout;
		const body = document.querySelector( '.editor-styles-wrapper' );

		body?.style?.setProperty( '--content-width', getContentWidth( currentSidebarLayout, contentContainer ) );

		sidebarLayout.onchange = ( event ) => {
			// We need to check fullWidth again in case it has changed since load.
			const latestContentContainer = fullWidth?.value ? fullWidth?.value : generatepressBlockEditor.contentAreaType;
			body?.style?.setProperty( '--content-width', getContentWidth( event.target.value || generatepressBlockEditor.globalSidebarLayout, latestContentContainer ) );
		};

		fullWidth.onchange = ( event ) => {
			body?.style?.setProperty( '--content-width', getContentWidth( sidebarLayout?.value || generatepressBlockEditor.globalSidebarLayout, event.target.value ) );
		};
	} );

	return null;
};

registerPlugin( 'generatepress-content-width', { render: ContentWidth } );
