import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';

const TextDecoration = ( { index, value, onChange } ) => {
	return (
		<SelectControl
			label={ __( 'Text Decoration', 'generatepress' ) }
			value={ value }
			options={ [
				{ value: '', 			label: __( 'Default', 'generatepress' ) },
				{ value: 'none',		label: __( 'None', 'generatepress' ) },
				{ value: 'underline',	label: __( 'Underline', 'generatepress' ) },
			] }
			onChange={ ( newValue ) => {
				onChange( 'textDecoration', newValue, index );
			} }
		/>
	);
};

export default TextDecoration;
