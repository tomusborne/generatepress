import { TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const CustomSelector = ( { value, index, onChange } ) => {
	return (
		<TextControl
			help={ __( 'Enter custom CSS selector.', 'generatepress' ) }
			value={ value }
			onChange={ ( newValue ) => {
				onChange( 'customSelector', newValue, index );
			} }
		/>
	);
};

export default CustomSelector;
