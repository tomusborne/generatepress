import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder } from '../../utils';

const FontSize = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={ __( 'Font size', 'generatepress' ) }
			desktopValue={ font.fontSize }
			desktopInitial={ getPlaceholder( font, 'fontSize' ) }
			desktopOnChange={ ( newValue ) => {
				onChange( 'fontSize', newValue, font.index );
			} }

			tabletValue={ font.fontSizeTablet }
			tabletInitial={ getPlaceholder( font, 'fontSizeTablet' ) }
			tabletOnChange={ ( newValue ) => {
				onChange( 'fontSizeTablet', newValue, font.index );
			} }

			mobileValue={ font.fontSizeMobile }
			mobileInitial={ getPlaceholder( font, 'fontSizeMobile' ) }
			mobileOnChange={ ( newValue ) => {
				onChange( 'fontSizeMobile', newValue, font.index );
			} }
		/>
	);
};

export default FontSize;
