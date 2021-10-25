import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder, getRangeProps } from '../../utils';

const FontSize = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={ __( 'Font size', 'generatepress' ) }

			unitValue={ font.fontSizeUnit }
			units={ [ 'px', 'em', 'rem', '%' ] }
			onChangeUnit={ ( newValue ) => {
				onChange( 'fontSizeUnit', newValue, font.index );
			} }

			step={ getRangeProps( font, 'fontSize', 'step', 1 ) }
			rangeMin={ getRangeProps( font, 'fontSize', 'min', 1 ) }
			rangeMax={ getRangeProps( font, 'fontSize', 'max', 100 ) }
			inputMin={ 0 }

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
