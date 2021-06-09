import './style.scss';
import {__} from '@wordpress/i18n';
import Select from 'react-select';

const GeneratePressFontPicker = ( { current, fontList, onChange } ) => {
    const customStyles = {
        indicatorSeparator: () => ({
            display: 'none'
        }),

        indicatorsContainer: (provided) => ({
            ...provided,
            maxHeight: '30px'
        })
    };

    const customTheme = (provided) => ({
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
            menuGutter: 0
        }
    });

    return (
        <Select
            className="generate-font-picker"
            classNamePrefix="generate-font-picker"
            placeholder={__( 'Search font...', 'generatepress' )}
            isSearchable={true}
            options={fontList}
            styles={customStyles}
            onChange={(selected) => onChange(selected.value)}
            instanceId={'input-field'}
            maxMenuHeight={130}
            theme={customTheme}
        />
    );
};

export default GeneratePressFontPicker;
