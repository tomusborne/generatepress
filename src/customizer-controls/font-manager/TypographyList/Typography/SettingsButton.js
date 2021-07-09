import { Button, Tooltip } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import getIcon from '../../../../utils/get-icon';

const SettingsButton = ( { itemId, setOpen, isOpen } ) => {
	return (
		<Tooltip text={ __( 'Open Typography Settings', 'generatepress' ) }>
			<Button
				className="generate-font-manager--open"
				onClick={ () => {
					if ( itemId !== isOpen ) {
						setOpen( itemId );
					}
				} }
			>
				{ getIcon( 'settings' ) }
			</Button>
		</Tooltip>
	);
};

export default SettingsButton;
