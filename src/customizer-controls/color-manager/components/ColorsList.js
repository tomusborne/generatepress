import { kebabCase, toLower } from 'lodash';
import ColorPicker from '../../../components/color-picker';
import { AddColorButton, DeleteColorButton } from './buttons';
import { useCallback } from '@wordpress/element';

export default function ColorsList( {
	colors,
	choices,
	onChangeColor,
	onChangeSlug,
	onClickDeleteColor,
	onClickAddColor,
} ) {

	const checkSlugNotUsed = useCallback( ( slug ) => (
		colors.some( ( color ) => ( slug === color.slug ) )
	), [ JSON.stringify( colors ) ] );

	return (
		<div className="generate-component-color-picker-wrapper generate-color-manager-wrapper">
			{ colors && colors.map( ( color ) => (
				<div key={ color.slug } className="generate-color-manager--item">
					<ColorPicker
						tooltipPosition={ 'bottom center' }
						tooltipText={ color.slug || '' }
						hideLabel={ true }
						choices={ choices }
						value={ color.color }
						varNameValue={ color.slug }
						checkSlugNotUsed={ checkSlugNotUsed }
						onChange={ ( newColor ) => {
							onChangeColor( color.slug, newColor );
						} }
						onVarChange={ ( slugValue ) => {
							const newSlug = toLower( kebabCase( slugValue ) );

							onChangeSlug( color.slug, newSlug );
						} }
					/>

					<DeleteColorButton onClick={ () => ( onClickDeleteColor( color.slug ) ) } />
				</div>
			) ) }

			<div className="generate-color-manager--item">
				<AddColorButton onClick={ onClickAddColor } />
			</div>
		</div>
	);
}
