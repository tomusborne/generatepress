// Import CSS
import './style.scss';

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
		<div className="components-gblocks-units-control-header__units">
			<div className="components-gblocks-units-control-label__units">
				{ label }
			</div>

			<div className="components-gblocks-control__units">
				<ButtonGroup className="components-gblocks-control-buttons__units" aria-label={ __( 'Select Units', 'generateblocks-pro' ) }>
					{ devices.map( ( device ) => {
						let deviceName = __( 'Desktop', 'generatepress' );

						if ( 'tablet' === device ) {
							deviceName = __( 'Tablet', 'generatepress' );
						}

						if ( 'mobile' === device ) {
							deviceName = __( 'Mobile', 'generatepress' );
						}

						const previewedDevice = wp.customize.previewedDevice.get();

						return <Tooltip
							/* translators: Unit type (px, em, %) */
							text={ sprintf( __( '%s Preview', 'generateblocks-pro' ), deviceName ) }
							key={ device }
						>
							<Button
								key={ device }
								className={ 'components-gblocks-control-button__units--' + device }
								isSmall
								isPrimary={ previewedDevice === device }
								aria-pressed={ previewedDevice === device }
								/* translators: %s: values associated with CSS syntax, 'Pixel', 'Em', 'Percentage' */
								aria-label={ deviceName }
								onClick={ () => {
									wp.customize.previewedDevice.set( device );
									setDevice( device );
								} }
							>
								{ deviceName }
							</Button>
						</Tooltip>;
					} ) }
				</ButtonGroup>
			</div>
		</div>
	);
};

export default UtilityLabel;
