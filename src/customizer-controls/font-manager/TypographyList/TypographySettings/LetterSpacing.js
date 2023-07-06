import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder } from '../../utils';

const LetterSpacing = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={ __( 'Letter Spacing', 'generatepress' ) }
			defaultUnit="em"

			desktopValue={ font.letterSpacing }
			desktopInitial={ getPlaceholder( font, 'letterSpacing' ) }
			desktopOnChange={ ( newValue ) => {
				onChange( 'letterSpacing', newValue, font.index );
			} }

			tabletValue={ font.letterSpacingTablet }
			tabletInitial={ getPlaceholder( font, 'letterSpacingTablet' ) }
			tabletOnChange={ ( newValue ) => {
				onChange( 'letterSpacingTablet', newValue, font.index );
			} }

			mobileValue={ font.letterSpacingMobile }
			mobileInitial={ getPlaceholder( font, 'letterSpacingMobile' ) }
			mobileOnChange={ ( newValue ) => {
				onChange( 'letterSpacingMobile', newValue, font.index );
			} }
		/>
	);
};

export default LetterSpacing;
