// Import CSS
import './style.scss';
import getIcon from '../../utils/get-icon';

import {
	useState,
} from '@wordpress/element';

import {
	__,
	sprintf,
} from '@wordpress/i18n';

import {
	ButtonGroup,
	Button,
	Tooltip,
} from '@wordpress/components';

const UtilityLabel = ( props ) => {
	const [ deviceType, setDevice ] = useState( 'desktop' ); // eslint-disable-line no-unused-vars

	const {
		label,
		devices,
	} = props;

	return (
		<div className="components-generate-units-control-header__units">
			<div className="components-generate-units-control-label__units">
				{ label }
			</div>

			<div className="components-generate-control__units">
				<ButtonGroup className="components-generate-control-buttons__units" aria-label={ __( 'Select Units', 'generatepress' ) }>
					{ devices.map( ( device ) => {
						let deviceName = __( 'Desktop', 'generatepress' );

						if ( 'tablet' === device ) {
							deviceName = __( 'Tablet', 'generatepress' );
						}

						if ( 'mobile' === device ) {
							deviceName = __( 'Mobile', 'generatepress' );
						}

						return <Tooltip
							/* translators: Unit type (px, em, %) */
							text={ sprintf( __( '%s Preview', 'generatepress' ), deviceName ) }
							key={ device }
						>
							<Button
								key={ device }
								className={ 'components-generate-control-button__units--' + device }
								isSmall
								/* translators: %s: values associated with CSS syntax, 'Pixel', 'Em', 'Percentage' */
								aria-label={ deviceName }
								onClick={ () => {
									wp.customize.previewedDevice.set( device );
									setDevice( device );
								} }
							>
								{ getIcon( device ) }
							</Button>
						</Tooltip>;
					} ) }
				</ButtonGroup>
			</div>
		</div>
	);
};

export default UtilityLabel;
