import './style.scss';
import getIcon from '../../utils/get-icon';

import {
	useState,
} from '@wordpress/element';

import {
	Button,
	Tooltip,
} from '@wordpress/components';

import {
	__,
	sprintf,
} from '@wordpress/i18n';

const GeneratePressTitleControlForm = ( props ) => {
	const [ isToggled, setToggle ] = useState( false );

	const onClick = () => {
		const toggleAreas = document.querySelectorAll( '[data-toggleId="' + props.choices.toggleId + '"]' );

		toggleAreas.forEach( ( area ) => {
			if ( ! isToggled ) {
				area.style.display = 'block';
				setToggle( true );
			} else {
				area.style.display = '';
				setToggle( false );
			}
		} );
	};

	/* translators: Open "setting area title" settings. */
	const tooltipText = !! props.choices.tooltipText ? props.choices.tooltipText : sprintf( __( 'Open %s Settings', 'generatepress' ), props.title );

	return (
		<>
			<div className="generate-customize-control-title">
				{ !! props.choices.toggleId &&
					<>
						<Tooltip text={ tooltipText }>
							<Button
								className="generate-customize-control-title--label"
								onClick={ onClick }
							>
								{ props.title }
							</Button>
						</Tooltip>

						<Tooltip text={ tooltipText }>
							<Button
								className="generate-customize-control-title--toggle"
								isPrimary={ !! isToggled }
								isSecondary={ ! isToggled }
								onClick={ onClick }
							>
								{ getIcon( 'settings' ) }
							</Button>
						</Tooltip>
					</>
				}

				{ ! props.choices.toggleId &&
					<h3>{ props.title }</h3>
				}
			</div>
		</>
	);
};

export default GeneratePressTitleControlForm;
