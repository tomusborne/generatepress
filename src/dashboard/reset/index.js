/**
 * WordPress dependencies
 */
import {
	__,
} from '@wordpress/i18n';

import {
	Placeholder,
	Spinner,
	Button,
} from '@wordpress/components';

import {
	render,
	useState,
	useEffect,
} from '@wordpress/element';

import apiFetch from '@wordpress/api-fetch';

/**
 * Internal dependencies
 */
import './style.scss';

const Reset = () => {
	const [ isLoaded, setLoaded ] = useState( false );
	const [ isResetting, setIsResetting ] = useState( false );

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

	const resetSettings = ( e ) => {
		setIsResetting( true );
		const message = e.target.nextElementSibling;

		apiFetch( {
			path: '/generatepress/v1/reset',
			method: 'POST',
			data: {},
		} ).then( ( result ) => {
			setIsResetting( false );
			message.classList.add( 'generatepress-dashboard__section-item-message__show' );

			if ( 'object' === typeof result.response ) {
				message.textContent = __( 'Settings reset.', 'generatepress' );
			} else {
				message.textContent = result.response;
			}

			if ( ! result.success || ! result.response ) {
				message.classList.add( 'generatepress-dashboard__section-item-message__error' );
			} else {
				setTimeout( function() {
					message.classList.remove( 'generatepress-dashboard__section-item-message__show' );
				}, 3000 );
			}
		} );
	};

	return (
		<>
			<div className="generatepress-dashboard__section">
				<div className="generatepress-dashboard__section-title" style={ { marginBottom: 0 } }>
					<h2>{ __( 'Reset', 'generatepress' ) }</h2>
				</div>

				<div className="generatepress-dashboard__section-item-description" style={ { marginTop: 0 } }>
					{ __( 'Reset your customizer settings.', 'generatepress' ) }
				</div>

				<Button
					className="generatepress-dashboard__reset-button"
					style={ {
						marginTop: '10px',
					} }
					disabled={ !! isResetting }
					isPrimary
					onClick={ ( e ) => {
						// eslint-disable-next-line
						if ( window.confirm( __( 'This will delete all of your customizer settings. It cannot be undone.', 'generatepress' ) ) ) {
							resetSettings( e );
						}
					} }
				>
					{ !! isResetting && <Spinner /> }
					{ ! isResetting && __( 'Reset', 'generatepress' ) }
				</Button>

				<span className="generatepress-dashboard__section-item-message" style={ { marginLeft: '10px' } }></span>
			</div>
		</>
	);
};

window.addEventListener( 'DOMContentLoaded', () => {
	render(
		<Reset />,
		document.getElementById( 'generatepress-reset' )
	);
} );
