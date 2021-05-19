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
	};

	const colors = props.value;

	return (
		<div>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<div className="generate-color-manager-wrapper">
				{
					colors.map( ( color, index ) => {
						const colorProps = {
							...props,
							value: colors[ index ].color,
						};

						return (
							<div className="generate-color-manager--item" key={ index }>
								<ColorPicker
									{ ...colorProps }
									onChange={ ( value ) => {
										const colorValues = [ ...colors ];

										colorValues[ index ] = {
											...colorValues[ index ],
											color: value,
										};

										handleChangeComplete( colorValues );
									} }
								/>

								<Tooltip text={ __( 'Delete Color', 'generatepress' ) }>
									<Button
										className="generate-color-manager--delete-color"
										onClick={ () => {
											// eslint-disable-next-line
											if ( window.confirm( __( 'This will permanently delete this color.', 'generatepress' ) ) ) {
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
					<Tooltip text={ __( 'Add Color', 'generatepress' ) }>
						<Button
							className="generate-color-manager--add-color"
							onClick={ () => {
								const colorValues = [ ...props.value ];

								colorValues.push( {
									label: '',
									color: '',
								} );

								handleChangeComplete( colorValues );
							} }
						>
							+
						</Button>
					</Tooltip>
				</div>
			</div>
		</div>
	);
};

export default GeneratePressColorManagerControlForm;
