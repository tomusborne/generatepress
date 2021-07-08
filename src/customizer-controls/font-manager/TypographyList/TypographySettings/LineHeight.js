import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder, getRangeProps } from '../../utils';

const LineHeight = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={ __( 'Line Height', 'generatepress' ) }

			unitValue={ font.lineHeightUnit }
			units={ [ '', 'px', 'em', 'rem' ] }
			onChangeUnit={ ( newValue ) => {
				onChange( 'lineHeightUnit', newValue, font.index );
			} }

			step={ getRangeProps( font, 'lineHeight', 'step', .1 ) }
			rangeMin={ getRangeProps( font, 'lineHeight', 'min', 1 ) }
			rangeMax={ getRangeProps( font, 'lineHeight', 'max', 5 ) }

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
