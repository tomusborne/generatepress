import './style.scss';
import Select from 'react-select';

const GeneratePressAdvancedSelect = ( componentProps ) => {
	const customStyles = {
		indicatorSeparator: () => ( {
			display: 'none',
		} ),

		indicatorsContainer: ( provided ) => ( {
			...provided,
			maxHeight: '30px',
		} ),
	};

	const customTheme = ( provided ) => ( {
		borderRadius: 2,
		colors: {
			...provided.colors,
			primary: 'var(--wp-admin-theme-color)',
			neutral20: '#757575',
			neutral30: '#757575',
		},
		spacing: {
			controlHeight: 30,
			baseUnit: 3,
			menuGutter: 3,
		},
	} );

	const defaultProps = {
		className: 'generate-advanced-select',
		classNamePrefix: 'generate-advanced-select',
		isSearchable: true,
		styles: customStyles,
		instanceId: 'input-field',
		maxMenuHeight: 130,
		theme: customTheme,
	};

	const props = Object.assign( {}, defaultProps, componentProps );

	return ( <Select { ...props } /> );
};

export default GeneratePressAdvancedSelect;
