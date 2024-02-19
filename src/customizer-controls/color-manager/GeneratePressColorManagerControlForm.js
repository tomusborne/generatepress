import './style.scss';
import { useCallback, useEffect, useState } from '@wordpress/element';
import useColors from './hooks/useColors';
import { isObject, findIndex } from 'lodash';
import ColorsList from './components/ColorsList';
import { SimpleDndList } from '../../components/dnd';
import ColorPlaceholder from './components/ColorPlaceholder';
import { AddColorButton, ColorManagerButton } from './components/buttons';
import { __ } from '@wordpress/i18n';
import { colord, extend } from 'colord';
import mixPlugin from 'colord/plugins/mix';

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
	const [ isReordering, setIsReordering ] = useState( false );
	const [ reorderedColors, setReorderedColors ] = useState( [] );
	const [ calculateColors, setCalculateColors ] = useState( false );
	const [ showCalculateColors, setShowCalculateColors ] = useState( false );

	// Set saved colors on first render
	useEffect( () => {
		const initialColors = isObject( props.value ) ? Object.values( props.value ) : props.value;

		setColors( initialColors );
		setInitialized( true );
	}, [] );

	useEffect( () => {
		const requiredColorsToCalculate = [ 'contrast', 'contrast-2', 'contrast-3', 'base', 'base-2', 'base-3', 'accent' ];
		const allExist = requiredColorsToCalculate.every( ( slug ) => colors.some( ( item ) => item.slug === slug ) );

		setShowCalculateColors( allExist );
	}, [ JSON.stringify( colors ) ] );

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
			document.body.insertAdjacentHTML( 'beforeend', '<style id="generate-global-color-styles">' + css + '</style>' );
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

	function onClickReorder( event ) {
		event.preventDefault();

		if ( isReordering ) {
			setColors( reorderedColors );
			window.sessionStorage.setItem( 'generateGlobalColors', JSON.stringify( reorderedColors ) );
		}

		setIsReordering( ! isReordering );
	}

	return (
		<>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer } />

			<div className="generate-color-manager-wrapper">
				<div className="generate-color-manager--item">
					<AddColorButton onClick={ onClickAddColor } disabled={ isReordering } />
				</div>

				<div className="generate-color-manager--item">
					<ColorManagerButton
						id={ 'add-color' }
						icon={ isReordering ? 'check' : 'reorder' }
						text={ isReordering
							? __( 'Finish re-ordering', 'generatepress' )
							: __( 'Re-order colors', 'generatepress' )
						}
						onClick={ onClickReorder }
					/>
				</div>

				{ !! showCalculateColors && (
					<div className="generate-color-manager--item">
						<ColorManagerButton
							id={ 'color-gen' }
							icon={ 'ai' }
							text={ __( 'Set palette based on your accent color', 'generatepress' ) }
							isPressed={ calculateColors }
							disabled={ isReordering }
							onClick={ () => {
								setCalculateColors( ! calculateColors );
							} }
						/>
					</div>
				) }
			</div>

			{ ! isReordering
				? (
					<ColorsList
						colors={ colors }
						onChangeColor={ updateColorValue }
						onChangeSlug={ updateColorSlug }
						onClickDeleteColor={ deleteColor }
						onAccentColorChange={ ( accentColor ) => {
							if ( ! calculateColors ) {
								return;
							}

							extend( [ mixPlugin ] );
							const calculatedColors = [
								{ slug: 'contrast', color: colord( accentColor ).mix( '#000000', 0.9 ).toHex() },
								{ slug: 'contrast-2', color: colord( accentColor ).mix( '#000000', 0.7 ).toHex() },
								{ slug: 'contrast-3', color: colord( accentColor ).mix( '#000000', 0.5 ).toHex() },
								{ slug: 'base', color: colord( accentColor ).mix( '#ffffff', 0.9 ).toHex() },
								{ slug: 'base-2', color: colord( accentColor ).mix( '#ffffff', 0.95 ).toHex() },
								{ slug: 'base-3', color: colord( accentColor ).mix( '#ffffff', 1 ).toHex() },
								{ slug: 'accent', color: accentColor },
							];

							if ( colors.find( ( item ) => item.slug === 'accent-hover' ) ) {
								calculatedColors.push( { slug: 'accent-hover', color: colord( accentColor ).mix( '#000000', 0.3 ).toHex() } );
							}

							const updatedColors = colors.map( ( item ) => {
								const matchingItem = calculatedColors.find( ( secondItem ) => secondItem.slug === item.slug );
								if ( matchingItem ) {
									return { ...item, color: matchingItem.color };
								}
								return item;
							} );

							setColors( updatedColors );
						} }
						calculateColors={ calculateColors }
					/>
				)
				: (
					<SimpleDndList
						listData={ colors }
						idKey={ 'slug' }
						listClassName={ 'generate-color-manager-dnd-list' }
						itemClassName={ 'generate-color-manager-dnd-list-item' }
						InnerComponent={ ColorPlaceholder }
						onChangeData={ setReorderedColors }
					/>
				)
			}
		</>
	);
};

export default GeneratePressColorManagerControlForm;
