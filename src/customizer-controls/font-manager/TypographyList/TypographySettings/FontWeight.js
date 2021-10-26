import { __ } from '@wordpress/i18n';
import { getAvailableFonts } from '../../utils';
import { SelectControl } from '@wordpress/components';
import getFontWeights from '../../../../utils/get-font-weights';

const FontWeight = ( { index, value, fontFamily, onChange } ) => {
	return (
		<SelectControl
			label={ __( 'Font Weight', 'generatepress' ) }
			value={ value }
			options={ getFontWeights( fontFamily, getAvailableFonts() ) }
			onChange={ ( newValue ) => {
				onChange( 'fontWeight', newValue, index );
			} }
		/>
	);
};

export default FontWeight;
