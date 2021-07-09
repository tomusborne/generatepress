import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder, getRangeProps } from '../../utils';

const LetterSpacing = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={ __( 'Letter Spacing', 'generatepress' ) }

			unitValue={ font.letterSpacingUnit }
			units={ [ 'px', 'em', 'rem' ] }
			onChangeUnit={ ( newValue ) => {
				onChange( 'letterSpacingUnit', newValue, font.index );
			} }

			step={ getRangeProps( font, 'letterSpacing', 'step', .01 ) }
			rangeMin={ getRangeProps( font, 'letterSpacing', 'min', -1 ) }
			rangeMax={ getRangeProps( font, 'letterSpacing', 'max', 10 ) }

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
