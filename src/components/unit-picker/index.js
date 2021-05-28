import './style.scss';
import getIcon from '../../utils/get-icon';

import {
	__,
	sprintf,
	_x,
} from '@wordpress/i18n';

import {
	ButtonGroup,
	Button,
	Tooltip,
	Dropdown,
} from '@wordpress/components';

const GeneratePressUnitPickerControl = ( props ) => {
	const {
		value,
		onClick,
		units,
	} = props;

	return (
		<div className="components-generate--control__units">
			<Dropdown
				className="generate-component-control--unit-picker"
				contentClassName="generate-component-control--unit-picker-area"
				position="middle center"
				focusOnMount="container"
				renderToggle={ ( { isOpen, onToggle } ) => (
					<Button onClick={ onToggle } aria-expanded={ isOpen }>
						{ value ? value : getIcon( 'dash' ) }
					</Button>
				) }
				renderContent={ ( { onClose } ) => {
					return (
						<ButtonGroup className="components-generate--control-buttons__units" aria-label={ __( 'Select Units', 'generatepress' ) }>
							{ units.map( ( unit ) => {
								let unitName = unit;
								const unitLabel = ! unit ? getIcon( 'dash' ) : unit;

								if ( '' === unit ) {
									unitName = __( 'No Unit', 'generatepress' );
								}

								if ( 'px' === unit ) {
									unitName = _x( 'Pixel', 'A size unit for CSS markup', 'generatepress' );
								}

								if ( 'em' === unit ) {
									unitName = _x( 'Em', 'A size unit for CSS markup', 'generatepress' );
								}

								if ( '%' === unit ) {
									unitName = _x( 'Percentage', 'A size unit for CSS markup', 'generatepress' );
								}

								if ( 'deg' === unit ) {
									unitName = _x( 'Degree', 'A size unit for CSS markup', 'generatepress' );
								}

								return <Tooltip
									/* translators: Unit type (px, em, %) */
									text={ !! unit ? sprintf( __( '%s Units', 'generatepress' ), unitName ) : unitName }
									key={ unit }
								>
									<Button
										key={ unit }
										className={ 'components-generate--control-button__units--' + unit }
										isSmall
										isPrimary={ value === unit }
										aria-pressed={ value === unit }
										/* translators: %s: values associated with CSS syntax, 'Pixel', 'Em', 'Percentage' */
										aria-label={ !! unit ? sprintf( __( '%s Units', 'generatepress' ), unitName ) : unitName }
										onClick={ () => {
											onClick( unit );
											onClose();
										} }
									>
										{ unitLabel }
									</Button>
								</Tooltip>;
							} ) }
						</ButtonGroup>
					);
				} }
			/>
		</div>
	);
};

export default GeneratePressUnitPickerControl;
