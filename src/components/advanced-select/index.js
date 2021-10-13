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

		menu: ( base ) => ( {
			...base,
			zIndex: 999999,
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
		maxMenuHeight: 250,
		theme: customTheme,
		menuPlacement: 'auto',
	};

	const props = Object.assign( {}, defaultProps, componentProps );

	// Get our label/value object based on the current value.
	Object.keys( props.options ).forEach( ( key ) => {
		const groupedOptions = props.options[ key ].options;

		if ( groupedOptions ) {
			groupedOptions.forEach( ( optionKey ) => {
				if ( optionKey.value === props.currentValue ) {
					props.value = { label: optionKey.label, value: props.currentValue };
				}
			} );
		} else if ( props.options[ key ].value === props.currentValue ) {
			props.value = { label: props.options[ key ].label, value: props.currentValue };
		}
	} );

	return ( <Select { ...props } /> );
};

export default GeneratePressAdvancedSelect;
