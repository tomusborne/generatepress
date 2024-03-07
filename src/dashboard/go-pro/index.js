import render from '../../utils/react-render';

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
	useState,
	useEffect,
} from '@wordpress/element';

/**
 * Internal dependencies
 */
import './style.scss';
import proItems from './pro-items';

const GoPro = () => {
	const [ isLoaded, setLoaded ] = useState( false );

	useEffect( () => {
		if ( ! isLoaded ) {
			setLoaded( true );
		}
	} );

	if ( generateDashboard.hasPremium ) {
		return null;
	}

	if ( ! isLoaded ) {
		return (
			<Placeholder className="generatepress-dashboard__placeholder">
				<Spinner />
			</Placeholder>
		);
	}

	return (
		<>
			{ !! proItems > 0 &&
				<>
					<div className="generatepress-dashboard__section-title">
						<h2>{ __( 'GeneratePress Premium', 'generatepress' ) }</h2>
					</div>

					<div className="generatepress-dashboard__section-description">
						<p>{ __( 'Take GeneratePress to the next level with more options, professionally designed starter sites, and block-based theme building.', 'generatepress' ) }</p>
					</div>

					<div className="generatepress-dashboard__section generatepress-dashboard__premium">
						{ Object.keys( proItems ).map( ( item, index ) => {
							const buttonAttributes = {
								className: 'components-button is-primary',
								href: proItems[ item ].action.url,
								target: !! proItems[ item ].action.external ? '_blank' : null,
								rel: !! proItems[ item ].action.external ? 'noreferrer noopener' : null,
							};

							return (
								<div className="generatepress-dashboard__premium-item" key={ index }>
									<div className="generatepress-dashboard__premium-item-content">
										{ !! proItems[ item ].icon &&
											<div className="generatepress-dashboard__premium-item-icon">
												{ proItems[ item ].icon }
											</div>
										}

										{ !! proItems[ item ].title &&
											<div className="generatepress-dashboard__premium-item-title">
												{ proItems[ item ].title }
											</div>
										}

										{ !! proItems[ item ].description && <div className="generatepress-dashboard__premium-item-description">{ proItems[ item ].description }</div> }
									</div>

									<div className="generatepress-dashboard__premium-item-action">
										{ !! proItems[ item ].action &&
											<a { ...buttonAttributes }>
												{ proItems[ item ].action.label || __( 'Open options', 'generatepress' ) }
											</a>
										}
									</div>
								</div>
							);
						} ) }
					</div>
				</>
			}
		</>
	);
};

window.addEventListener( 'DOMContentLoaded', () => {
	render(
		<GoPro />,
		document.getElementById( 'generatepress-dashboard-go-pro' )
	);
} );
