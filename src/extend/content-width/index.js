import { registerPlugin } from '@wordpress/plugins';
import domReady from '@wordpress/dom-ready';

function getContentWidth( layout, contentContainer = '' ) {
	let contentWidth = '';
	let unit = 'px';
	const containerWidth = generatepressBlockEditor.containerWidth;
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
	if ( 'true' === contentContainer ) {
		if ( 'left-sidebar' === layout ) {
			contentWidth = 100 - leftSidebarWidth;
		} else if ( 'right-sidebar' === layout ) {
			contentWidth = 100 - rightSidebarWidth;
		} else if ( 'no-sidebar' === layout ) {
			contentWidth = 100;
		} else {
			contentWidth = 100 - leftSidebarWidth - rightSidebarWidth;
		}

		unit = '%';
	}

	return contentWidth + unit;
}

const ContentWidth = () => {
	domReady( () => {
		const body = document.querySelector( '.editor-styles-wrapper' );
		const sidebarLayout = document.getElementById( 'generate-sidebar-layout' );
		const fullWidth = document.getElementById( '_generate-full-width-content' );
		const currentSidebarLayout = sidebarLayout?.value || generatepressBlockEditor.globalSidebarLayout;

		body?.style?.setProperty( '--content-width', getContentWidth( currentSidebarLayout, fullWidth?.value ) );

		sidebarLayout.onchange = ( event ) => {
			body?.style?.setProperty( '--content-width', getContentWidth( event.target.value || generatepressBlockEditor.globalSidebarLayout, fullWidth?.value ) );
		};

		fullWidth.onchange = ( event ) => {
			body?.style?.setProperty( '--content-width', getContentWidth( sidebarLayout?.value || generatepressBlockEditor.globalSidebarLayout, event.target.value ) );
		};
	} );

	return null;
};

registerPlugin( 'generatepress-content-width', { render: ContentWidth } );
