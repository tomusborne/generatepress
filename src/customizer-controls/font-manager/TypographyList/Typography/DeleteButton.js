import { Button, Tooltip } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import getIcon from '../../../../utils/get-icon';

const DeleteButton = ( { onClick } ) => {
	const deleteMessage = __( 'This will permanently delete this typography element.', 'generatepress' );

	return (
		<Tooltip text={ __( 'Delete Typography Element', 'generatepress' ) }>
			<Button
				className="generate-font-manager--delete-font"
				onClick={ () => {
					// eslint-disable-next-line
					if ( window.confirm( deleteMessage ) ) {
						onClick();
					}
				} }
				icon={ getIcon( 'x' ) }
			/>
		</Tooltip>
	);
};

export default DeleteButton;
