import './style.scss';
import getIcon from '../../utils/get-icon';
import ColorPicker from '../../components/color-picker';

import {
	Button,
	Tooltip,
} from '@wordpress/components';

import {
	__,
} from '@wordpress/i18n';

const GeneratePressColorManagerControlForm = ( props ) => {
	/**
	 * Save the value when changing the control.
	 *
	 * @param {Object} value - The value.
	 * @return {void}
	 */
	const handleChangeComplete = ( value ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( value );

		let css = ':root {';

		if ( value.length > 0 ) {
			value.forEach( ( color ) => {
				const slug = color.slug.replace( ' ', '-' ).toLowerCase();
				css += '--' + slug + ': ' + color.color + ';';
			} );
		}

		css += '}';

		const style = document.getElementById( 'generate-global-color-styles' );

		if ( style ) {
			style.innerHTML = css;
		} else {
			document.head.insertAdjacentHTML( 'beforeend', '<style id="generate-global-color-styles">' + css + '</style>' );
		}
	};

	const setSessionStorage = ( value ) => {
		const palette = [];

		if ( value.length > 0 ) {
			value.forEach( ( color ) => {
				const slug = color.slug.replace( ' ', '-' ).toLowerCase();

				palette.push(
					{
						name: color.name || color.slug,
						slug,
						color: 'var(--' + color.slug + ')',
					}
				);
			} );
		}

		window.sessionStorage.setItem( 'generateGlobalColors', JSON.stringify( palette ) );
	};

	const colors = props.value;

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<div className="generate-component-color-picker-wrapper generate-color-manager-wrapper">
				{
					colors.map( ( color, index ) => {
						const colorProps = {
							...props,
							value: colors[ index ].color,
							varNameValue: colors[ index ].slug,
						};

						return (
							<div className="generate-color-manager--item" key={ index }>
								<ColorPicker
									{ ...colorProps }
									tooltipPosition="bottom center"
									tooltipText={ colors[ index ].name || colors[ index ].slug }
									hideLabel={ true }
									onChange={ ( value ) => {
										const colorValues = [ ...colors ];

										colorValues[ index ] = {
											...colorValues[ index ],
											color: value,
										};

										handleChangeComplete( colorValues );
										setSessionStorage( colorValues );
									} }
									onVarChange={ ( value ) => {
										const colorValues = [ ...colors ];

										// Convert value to kebab-case.
										value = value
											.replace( /([a-z])([A-Z])/g, '$1-$2' )
											.replace( /[\s_]+/g, '-' )
											.toLowerCase();

										colorValues[ index ] = {
											...colorValues[ index ],
											slug: value,
										};

										handleChangeComplete( colorValues );
										setSessionStorage( colorValues );
									} }
								/>

								<Tooltip text={ __( 'Delete Color', 'generatepress' ) }>
									<Button
										className="generate-color-manager--delete-color"
										onClick={ () => {
											// eslint-disable-next-line
											if ( window.confirm( __( 'This will permanently delete this color. Doing so will break styles that are using it to define their color.', 'generatepress' ) ) ) {
												const colorValues = [ ...colors ];

												colorValues.splice( index, 1 );
												handleChangeComplete( colorValues );
											}
										} }
										icon={ getIcon( 'x' ) }
									/>
								</Tooltip>
							</div>
						);
					} )
				}

				<div className="generate-color-manager--item">
					<Tooltip text={ __( 'Add Global Color', 'generatepress' ) }>
						<Button
							className="generate-color-manager--add-color"
							onClick={ () => {
								const colorValues = [ ...props.value ];
								const length = colorValues.length + 1;

								colorValues.push( {
									slug: 'global-color-' + length,
									color: '',
								} );

								handleChangeComplete( colorValues );
							} }
						>
							{ getIcon( 'plus' ) }
						</Button>
					</Tooltip>
				</div>
			</div>
		</div>
	);
};

export default GeneratePressColorManagerControlForm;
