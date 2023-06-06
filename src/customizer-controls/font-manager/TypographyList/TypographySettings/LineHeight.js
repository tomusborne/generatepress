import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder } from '../../utils';

const LineHeight = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={ __( 'Line Height', 'generatepress' ) }
			units={ [ '', 'px', 'em', 'rem' ] }
			defaultUnit="em"

			desktopValue={ font.lineHeight }
			desktopInitial={ getPlaceholder( font, 'lineHeight' ) }
			desktopOnChange={ ( newValue ) => {
				onChange( 'lineHeight', newValue, font.index );
			} }

			tabletValue={ font.lineHeightTablet }
			tabletInitial={ getPlaceholder( font, 'lineHeightTablet' ) }
			tabletOnChange={ ( newValue ) => {
				onChange( 'lineHeightTablet', newValue, font.index );
			} }

			mobileValue={ font.lineHeightMobile }
			mobileInitial={ getPlaceholder( font, 'lineHeightMobile' ) }
			mobileOnChange={ ( newValue ) => {
				onChange( 'lineHeightMobile', newValue, font.index );
			} }
		/>
	);
};

export default LineHeight;
