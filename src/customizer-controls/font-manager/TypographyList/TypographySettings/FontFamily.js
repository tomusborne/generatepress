import { __ } from '@wordpress/i18n';
import { getFontFamilies } from '../../utils';
import { SelectControl } from '@wordpress/components';

const FontFamily = ( { index, value, onChange } ) => {
	return (
		<SelectControl
			label={ __( 'Font Family', 'generatepress' ) }
			value={ value }
			options={ getFontFamilies() }
			onChange={ ( newValue ) => {
				onChange( 'fontFamily', newValue, index );
			} }
		/>
	);
};

export default FontFamily;
