import { kebabCase, toLower } from 'lodash';
import ColorPicker from '../../../components/color-picker';
import { AddColorButton, DeleteColorButton } from './buttons';

export default function ColorsList( {
	colors,
	choices,
	onChangeColor,
	onChangeSlug,
	onClickDeleteColor,
	onClickAddColor,
} ) {
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
