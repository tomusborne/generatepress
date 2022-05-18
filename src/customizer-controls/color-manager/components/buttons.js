import { Button, Tooltip } from '@wordpress/components';
import getIcon from '../../../utils/get-icon';
import { __ } from '@wordpress/i18n';

export function ColorManagerButton( { id, text, onClick, icon, disabled } ) {
	const classname = `generate-color-manager--${id}`;
	return (
		<Tooltip text={ text }>
			<Button className={ classname } onClick={ onClick } disabled={ disabled }>
				{ getIcon( icon ) }
			</Button>
		</Tooltip>
	);
}

export function DeleteColorButton( { onClick } ) {
	return (
		<ColorManagerButton
			id={ 'delete-color' }
			text={ __( 'Delete Color', 'generatepress' ) }
			icon={ 'x' }
			onClick={ onClick }
		/>
	);
}

export function AddColorButton( { onClick, disabled } ) {
	return (
		<ColorManagerButton
			id={ 'add-color' }
			text={ __( 'Add Global Color', 'generatepress' ) }
			icon={ 'plus' }
			disabled={ disabled }
			onClick={ onClick }
		/>
	);
}
