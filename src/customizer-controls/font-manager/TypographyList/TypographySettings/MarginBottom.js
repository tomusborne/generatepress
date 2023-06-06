import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder } from '../../utils';

const MarginBottom = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={
				'body' === font.selector
					? __( 'Paragraph Bottom Margin', 'generatepress' )
					: __( 'Bottom Margin', 'generatepress' )
			}
			units={ [ 'px', 'em', 'rem' ] }
			defaultUnit="em"

			desktopValue={ font.marginBottom }
			desktopInitial={ getPlaceholder( font, 'marginBottom' ) }
			desktopOnChange={ ( newValue ) => {
				onChange( 'marginBottom', newValue, font.index );
			} }

			tabletValue={ font.marginBottomTablet }
			tabletInitial={ getPlaceholder( font, 'marginBottomTablet' ) }
			tabletOnChange={ ( newValue ) => {
				onChange( 'marginBottomTablet', newValue, font.index );
			} }

			mobileValue={ font.marginBottomMobile }
			mobileInitial={ getPlaceholder( font, 'marginBottomMobile' ) }
			mobileOnChange={ ( newValue ) => {
				onChange( 'marginBottomMobile', newValue, font.index );
			} }
		/>
	);
};

export default MarginBottom;
