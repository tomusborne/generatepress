import { DropdownMenu, MenuGroup, MenuItem } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import getIcon from '../../utils/get-icon';

export default function UnitDropdown( { value, onChange, units = [], disabled } ) {
	if ( ! units.length ) {
		return null;
	}

	// Replace the last item with our value if it's not a part of the visible list.
	if ( ! units.includes( value ) ) {
		units[ units.length - 1 ] = value;
	}

	return (
		<>
			<DropdownMenu
				className="gblocks-unit-control-units"
				label={ __( 'Select a unit', 'generatepress' ) }
				icon={ null }
				toggleProps={ {
					children: value || String.fromCharCode( 0x2014 ),
					disabled,
				} }
				popoverProps={ {
					className: 'gblocks-unit-control-popover',
					focusOnMount: true,
					noArrow: false,
				} }
			>
				{ ( { onClose } ) => (
					<>
						<MenuGroup>
							{ units.map( ( unit ) => (
								<MenuItem
									key={ unit }
									onClick={ () => {
										onChange( unit );
										onClose();
									} }
									isSelected={ unit === value }
									variant={ unit === value ? 'primary' : '' }
								>
									{ unit || String.fromCharCode( 0x2014 ) }
								</MenuItem>
							) ) }

							<MenuItem
								onClick={ () => {
									window.open( 'https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/Values_and_units', '_blank' ).focus();
								} }
								label={ __( 'Learn more about units', 'generatepress' ) }
								showTooltip={ true }
							>
								{ getIcon( 'info' ) }
							</MenuItem>
						</MenuGroup>
					</>
				) }
			</DropdownMenu>
		</>
	);
}
