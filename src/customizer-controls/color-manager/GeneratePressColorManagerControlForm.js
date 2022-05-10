import './style.scss';
import { useCallback, useEffect, useState } from '@wordpress/element';
import useColors from './hooks/useColors';
import { isObject, findIndex } from 'lodash';
import ColorsList from './components/ColorsList';

const GeneratePressColorManagerControlForm = ( props ) => {
	const {
		colors,
		setColors,
		addColor,
		deleteColor,
		updateColorValue,
		updateColorSlug,
	} = useColors();

	const [ initialized, setInitialized ] = useState( false );

	// Set saved colors on first render
	useEffect( () => {
		const initialColors = isObject( props.value ) ? Object.values( props.value ) : props.value;

		setColors( initialColors );
		setInitialized( true );
	}, [] );

	/**
	 * Save the value when changing the control.
	 *
	 * @param {Object} value - The value.
	 * @return {void}
	 */
	const handleDocumentChange = ( value ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( value );

		let css = ':root {';

		if ( value.length > 0 ) {
			value.forEach( ( color ) => {
				const slug = color.slug.replace( ' ', '-' ).toLowerCase();
				css += '--' + slug + ': ' + color.color + ';';
			} );
		}

		css += '}';

		const style = document.getElementById( 'generate-global-color-styles' );

		if ( style ) {
			style.innerHTML = css;
		} else {
			document.head.insertAdjacentHTML( 'beforeend', '<style id="generate-global-color-styles">' + css + '</style>' );
		}
	};

	const setSessionStorage = ( value ) => {
		const palette = [];

		if ( value.length > 0 ) {
			value.forEach( ( color ) => {
				palette.push(
					{
						name: color.slug,
						slug: color.slug,
						color: 'var(--' + color.slug + ')',
					}
				);
			} );
		}

		window.sessionStorage.setItem( 'generateGlobalColors', JSON.stringify( palette ) );
	};

	useEffect( () => {
		if ( initialized ) {
			setSessionStorage( colors );
			handleDocumentChange( colors );
		}
	}, [ JSON.stringify( colors ), initialized ] );

	const onClickAddColor = useCallback( () => {
		function getNewSlug( count ) {
			const slug = `global-color-${ count + 1 }`;

			return ( -1 === findIndex( colors, { slug } ) )
				? slug
				: getNewSlug( count + 1 );
		}

		addColor( getNewSlug( colors.length ) );
	}, [ colors.length ] );

	return (
		<>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer } />

			<ColorsList
				colors={ colors }
				choices={ props.choices }
				onChangeColor={ updateColorValue }
				onChangeSlug={ updateColorSlug }
				onClickAddColor={ onClickAddColor }
				onClickDeleteColor={ deleteColor }
			/>
		</>
	);
};

export default GeneratePressColorManagerControlForm;
