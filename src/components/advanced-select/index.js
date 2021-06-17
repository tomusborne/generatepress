import './style.scss';
import Select from 'react-select';

const GeneratePressAdvancedSelect = ( { current, placeholder, options, onChange } ) => {
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
			menuGutter: 0,
		},
	} );

	const hasValue = options.find( ( item ) => {
		if ( item.options && item.options.some( ( option ) => ( option.value === current ) ) ) {
			return true;
		} else if ( ! item.options && item.value === current ) {
			return true;
		}

		return false;
	} );

	return (
		<Select
			className="generate-advanced-select"
			classNamePrefix="generate-advanced-select"
			placeholder={ placeholder }
			isSearchable={ true }
			options={ options }
			styles={ customStyles }
			value={ hasValue ? { label: current, value: current } : undefined }
			onChange={ ( selected ) => onChange( selected.value ) }
			instanceId={ 'input-field' }
			maxMenuHeight={ 130 }
			theme={ customTheme }
		/>
	);
};

export default GeneratePressAdvancedSelect;
