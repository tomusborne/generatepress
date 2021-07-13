/**
 * WordPress dependencies
 */
import {
	__,
} from '@wordpress/i18n';

import {
	Placeholder,
	Spinner,
} from '@wordpress/components';

import {
	render,
	useState,
	useEffect,
} from '@wordpress/element';

/**
 * Internal dependencies
 */
import './style.scss';
import customizeItems from './customize-items';

const StartCustomizing = () => {
	const [ isLoaded, setLoaded ] = useState( false );

	useEffect( () => {
		if ( ! isLoaded ) {
			setLoaded( true );
		}
	} );

	if ( ! isLoaded ) {
		return (
			<Placeholder className="generatepress-dashboard-placeholder">
				<Spinner />
			</Placeholder>
		);
	}

	return (
		<>
			<h2>{ __( 'Start Customizing', 'generatepress' ) }</h2>

			{ !! customizeItems > 0 &&
				<div className="generatepress-start-customizing">
					{ Object.keys( customizeItems ).map( ( item, index ) => (
						<div className="generatepress-start-customizing__item" key={ index }>
							{ !! customizeItems[ item ].icon && <div className="generatepress-start-customizing__icon">{ customizeItems[ item ].icon }</div> }
							<div className="generatepress-start-customizing__content">
								{ !! customizeItems[ item ].title && <div className="generatepress-start-customizing__title">{ customizeItems[ item ].title }</div> }
								{ !! customizeItems[ item ].description && <div className="generatepress-start-customizing__description">{ customizeItems[ item ].description }</div> }
								{ !! customizeItems[ item ].action &&
									<div className="generatepress-start-customizing__action">
										<a className="button-component" href={ customizeItems[ item ].action }>
											{ customizeItems[ item ].actionLabel || __( 'Go to options', 'generatepress' ) }
										</a>
									</div>
								}
							</div>
						</div>
					) ) }
				</div>
			}
		</>
	);
};

window.addEventListener( 'DOMContentLoaded', () => {
	render(
		<StartCustomizing />,
		document.getElementById( 'generatepress-dashboard-app' )
	);
} );
