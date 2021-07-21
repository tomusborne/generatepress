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
			<Placeholder className="generatepress-dashboard__placeholder">
				<Spinner />
			</Placeholder>
		);
	}

	const customizeItems = applyFilters( 'generate_dashboard_customize_items', allCustomizeItems );

	const ItemAction = ( item ) => {
		const buttonAttributes = {
			className: 'components-button is-primary',
			href: customizeItems[ item ].action.url,
			target: !! customizeItems[ item ].action.external ? '_blank' : null,
			rel: !! customizeItems[ item ].action.external ? 'noreferrer noopener' : null,
		};

		return (
			<>
				{ !! customizeItems[ item ].action &&
					<a { ...buttonAttributes }>
						{ customizeItems[ item ].action.label || __( 'Open options', 'generatepress' ) }
					</a>
				}
			</>
		);
	};

	return (
		<>
			{ !! customizeItems > 0 &&
				<>
					<div className="generatepress-dashboard__section-title">
						<h2>{ __( 'Start Customizing', 'generatepress' ) }</h2>
					</div>

					<div className="generatepress-dashboard__section">
						{ Object.keys( customizeItems ).map( ( item, index ) => {
							return (
								<div className="generatepress-dashboard__section-item" key={ index }>
									<div className="generatepress-dashboard__section-item-content">
										{ !! customizeItems[ item ].title &&
											<div className="generatepress-dashboard__section-item-title">
												{ customizeItems[ item ].title }
											</div>
										}

										{ !! customizeItems[ item ].description && <div className="generatepress-dashboard__section-item-description">{ customizeItems[ item ].description }</div> }
									</div>

									<div className="generatepress-dashboard__section-item-action">
										{ applyFilters( 'generate_dashboard_customize_item_action', ItemAction( item ), customizeItems[ item ] ) }
									</div>
								</div>
							);
						} ) }

						{ applyFilters( 'generate_dashboard_inside_start_customizing' ) }
					</div>
				</>
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
