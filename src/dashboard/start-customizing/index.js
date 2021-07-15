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

import {
	applyFilters,
} from '@wordpress/hooks';

/**
 * Internal dependencies
 */
import './style.scss';
import allCustomizeItems from './customize-items';

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

	const customizeItems = applyFilters( 'generate_dashboard_customize_items', allCustomizeItems );

	return (
		<>
			<h2>{ __( 'Start Customizing', 'generatepress' ) }</h2>

			{ !! customizeItems > 0 &&
				<div className="generatepress-start-customizing">
					{ Object.keys( customizeItems ).map( ( item, index ) => {
						const buttonAttributes = {
							className: 'components-button is-primary',
							href: customizeItems[ item ].action.url,
							target: !! customizeItems[ item ].action.external ? '_blank' : null,
							rel: !! customizeItems[ item ].action.external ? 'noreferrer noopener' : null,
						};

						return (
							<div className="generatepress-start-customizing__item" key={ index }>
								{ !! customizeItems[ item ].icon && <div className="generatepress-start-customizing__icon">{ customizeItems[ item ].icon }</div> }
								<div className="generatepress-start-customizing__content">
									{ !! customizeItems[ item ].title &&
										<div className="generatepress-start-customizing__title">
											{ customizeItems[ item ].title }
											{ !! customizeItems[ item ].pro && <span className="generatepress-start-customizing__pro">{ __( 'Pro', 'generatepress' ) }</span> }
										</div>
									}

									{ !! customizeItems[ item ].description && <div className="generatepress-start-customizing__description">{ customizeItems[ item ].description }</div> }

									{ !! customizeItems[ item ].action &&
										<div className="generatepress-start-customizing__action">
											<a { ...buttonAttributes }>
												{ customizeItems[ item ].action.label || __( 'Go to options', 'generatepress' ) }
											</a>
										</div>
									}
								</div>
							</div>
						);
					} ) }

					{ applyFilters( 'generate_dashboard_inside_start_customizing' ) }
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
