import DeviceInputGroup from './DeviceInputGroup';
import { __ } from '@wordpress/i18n';
import { getPlaceholder, getRangeProps } from '../../utils';

const MarginBottom = ( { font, onChange } ) => {
	return (
		<DeviceInputGroup
			label={
				'body' === font.selector
					? __( 'Paragraph Bottom Margin', 'generatepress' )
					: __( 'Bottom Margin', 'generatepress' )
			}

			unitValue={ font.marginBottomUnit }
			units={ [ 'px', 'em', 'rem' ] }
			onChangeUnit={ ( newValue ) => {
				onChange( 'marginBottomUnit', newValue, font.index );
			} }

			step={ getRangeProps( font, 'marginBottom', 'step', .1 ) }
			rangeMin={ getRangeProps( font, 'marginBottom', 'min', -1 ) }
			rangeMax={ getRangeProps( font, 'marginBottom', 'max', 5 ) }

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
