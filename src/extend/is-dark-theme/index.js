import { registerPlugin } from '@wordpress/plugins';
import { useEffect } from '@wordpress/element';
import tinycolor from 'tinycolor2';

const IsDarkTheme = () => {
	useEffect( () => {
		if ( generatepressBlockEditor.show_editor_styles ) {
			let textColor = generatepressBlockEditor.text_color;

			if ( String( textColor ).startsWith( 'var(' ) ) {
				const variableName = textColor.match( /\(([^)]+)\)/ );

				if ( variableName ) {
					const variableValue = getComputedStyle( document.querySelector( '.editor-styles-wrapper' ) )?.getPropertyValue( variableName[ 1 ] );

					if ( variableValue ) {
						textColor = variableValue;
					}
				}
			}

			textColor = tinycolor( textColor ).toHex8();
			const isTextDark = tinycolor( textColor ).isDark();

			if ( ! isTextDark ) {
				document.body.classList.add( 'is-dark-theme' );
			} else {
				document.body.classList.remove( 'is-dark-theme' );
			}
		}
	}, [] );

	return null;
};

registerPlugin( 'generatepress-is-dark-theme', { render: IsDarkTheme } );
