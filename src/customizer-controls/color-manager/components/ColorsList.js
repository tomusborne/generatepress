import GlobalColorPicker from '../../../components/color-picker/GlobalColorPicker';
import { DeleteColorButton } from './buttons';
import { memo, useCallback } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const MemoizedColorPicker = memo( GlobalColorPicker, ( prev, next ) => {
	return (
		prev.value === next.value &&
		prev.variableName === next.variableName &&
		prev.checkVariableNameIsAvailable === next.checkVariableNameIsAvailable &&
		prev.calculateColors === next.calculateColors
	);
} );

export default function ColorsList( {
	colors,
	onChangeColor,
	onChangeSlug,
	onClickDeleteColor,
	onAccentColorChange,
	calculateColors,
} ) {
	const checkVariableNameIsAvailable = useCallback( ( slug, index ) => (
		! colors.some( ( color, idx ) => ( slug === color.slug && idx !== index ) )
	), [ JSON.stringify( colors ) ] );

	return (
		<div className="generate-component-color-picker-wrapper generate-color-manager-wrapper">
			{ colors && colors.map( ( color, index ) => {
				if ( calculateColors && 'accent' !== color.slug ) {
					return null;
				}

				return (
					<div key={ String( index ) } className="generate-color-manager--item">
						<MemoizedColorPicker
							index={ index }
							value={ color.color }
							variableName={ color.slug }
							onChange={ ( newColor ) => {
								onChangeColor( color.slug, newColor );

								if ( 'accent' === color.slug ) {
									onAccentColorChange( newColor );
								}
							} }
							onChangeVariableName={ ( slugValue ) => {
								onChangeSlug( color.slug, slugValue );
							} }
							checkVariableNameIsAvailable={ checkVariableNameIsAvailable }
							calculateColors={ calculateColors }
						/>

						<DeleteColorButton onClick={ () => {
							// eslint-disable-next-line
							if ( window.confirm( __( 'This will permanently delete this color. Doing so will break styles that are using it to define their color.', 'generatepress' ) ) ) {
								onClickDeleteColor( color.slug );
							}
						} } />
					</div>
				);
			} ) }
		</div>
	);
}
