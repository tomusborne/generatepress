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
		if ( props.choices.sectionRedirect ) {
			wp.customize.section( props.choices.toggleId ).focus();
		} else {
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
		}
	};

	/* translators: Open "setting area title" settings. */
	const tooltipText = !! props.choices.tooltipText ? props.choices.tooltipText : sprintf( __( 'Open %s Settings', 'generatepress' ), props.choices.title );

	const toggleIcon = !! props.choices.sectionRedirect ? 'chevron-right' : 'chevron-down';

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
								{ props.choices.title }
							</Button>
						</Tooltip>

						<Tooltip text={ tooltipText }>
							<Button
								className="generate-customize-control-title--toggle"
								onClick={ onClick }
							>
								{ ! isToggled ? getIcon( toggleIcon ) : getIcon( 'chevron-up' ) }
							</Button>
						</Tooltip>
					</>
				}

				{ ! props.choices.toggleId &&
					<h3>{ props.choices.title }</h3>
				}
			</div>
		</>
	);
};

export default GeneratePressTitleControlForm;
