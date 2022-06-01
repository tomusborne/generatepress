import { Button, TextControl, Tooltip } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import getIcon from '../../../utils/get-icon';

export default function VariableNameInput( props ) {
	const {
		value,
		onChange,
		onBlur,
		onEnable,
		isDisabled,
		helpText,
	} = props;
	return (
		<div className="generate-color-input--css-var-name-wrapper">
			<TextControl
				label={ __( 'CSS Variable Name', 'generatepress' ) }
				disabled={ isDisabled }
				help={ helpText }
				type={ 'text' }
				value={ value }
				onChange={ onChange }
				onBlur={ onBlur }
			/>

			{ isDisabled &&
				<Tooltip text={ __( 'Changing this name will remove its color from elements already using it.', 'generatepress' ) }>
					<Button
						onClick={ () => {
							// eslint-disable-next-line
							window.alert( __( 'Changing this name will break styles that are using it to define its color.', 'generatepress' ) );

							onEnable();

							setTimeout( function() {
								document.querySelector( '.generate-color-input--css-var-name-wrapper input' ).focus();
							}, 10 );
						} }
					>
						{ getIcon( 'unlock' ) }
					</Button>
				</Tooltip>
			}
		</div>
	);
}
