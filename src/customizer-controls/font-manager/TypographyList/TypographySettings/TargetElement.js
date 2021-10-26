import { __ } from '@wordpress/i18n';
import AdvancedSelect from '../../../../components/advanced-select';
import { getElementOptions } from '../../utils';
import { BaseControl } from '@wordpress/components';

const TargetElement = ( { index, value, onChange } ) => {
	return (
		<BaseControl
			label={ __( 'Target Element', 'generatepress' ) }
			id="generate-typography-choose-element"
		>
			<AdvancedSelect
				options={ getElementOptions() }
				placeholder={ __( 'Search elements…', 'generatepress' ) }
				currentValue={ value }
				onChange={ ( object ) => {
					onChange( object, index );
				} }
			/>
		</BaseControl>
	);
};

export default TargetElement;
