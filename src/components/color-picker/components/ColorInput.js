import { Button, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const isHex = ( hex ) => {
	return /^([0-9A-F]{3}){1,2}$/i.test( hex );
};

export default function ColorInput( { value, onChange, showReset = false, onClickReset } ) {
	return (
		<div className="generate-color-input-wrapper">
			<TextControl
				id="generate-color-input-field"
				className="generate-color-input"
				type={ 'text' }
				value={ value || '' }
				onChange={ ( color ) => {
					if ( ! color.startsWith( '#' ) && isHex( color ) ) {
						color = '#' + color;
					}

					onChange( color );
				} }
			/>

			{ showReset &&
				<Button isSmall isSecondary className="components-color-clear-color" onClick={ onClickReset }>
					{ __( 'Default', 'generatepress' ) }
				</Button>
			}
		</div>
	);
}
