import './style.scss';
import getIcon from '../../utils/get-icon';

import {
	useState,
} from '@wordpress/element';

import {
	Button,
} from '@wordpress/components';

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

	return (
		<>
			<div className="generate-customize-control-title">
				{ !! props.choices.toggleId &&
					<>
						<Button
							className="generate-customize-control-title--label"
							onClick={ onClick }
						>
							{ props.title }
						</Button>

						<Button
							className="generate-customize-control-title--toggle"
							isPrimary={ !! isToggled }
							isSecondary={ ! isToggled }
							onClick={ onClick }
						>
							{ getIcon( 'wrench' ) }
						</Button>
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
