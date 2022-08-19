import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';

const FontStyle = ( { index, value, onChange } ) => {
	return (
		<SelectControl
			label={ __( 'Font Style', 'generatepress' ) }
			value={ value }
			options={ [
				{ value: '', 			label: __( 'Default', 'generatepress' ) },
				{ value: 'normal',		label: __( 'Normal', 'generatepress' ) },
				{ value: 'italic',		label: __( 'Italic', 'generatepress' ) },
				{ value: 'oblique', 	label: __( 'Oblique', 'generatepress' ) },
				{ value: 'initial', 	label: __( 'Initial', 'generatepress' ) },
			] }
			onChange={ ( newValue ) => {
				onChange( 'fontStyle', newValue, index );
			} }
		/>
	);
};

export default FontStyle;
