import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';

const TextTransform = ( { index, value, onChange } ) => {
	return (
		<SelectControl
			label={ __( 'Text Transform', 'generatepress' ) }
			value={ value }
			options={ [
				{ value: '', 			label: __( 'Default', 'generatepress' ) },
				{ value: 'uppercase', 	label: __( 'Uppercase', 'generatepress' ) },
				{ value: 'lowercase', 	label: __( 'Lowercase', 'generatepress' ) },
				{ value: 'capitalize', 	label: __( 'Capitalize', 'generatepress' ) },
				{ value: 'initial', 	label: __( 'Normal', 'generatepress' ) },
			] }
			onChange={ ( newValue ) => {
				onChange( 'textTransform', newValue, index );
			} }
		/>
	);
};

export default TextTransform;
