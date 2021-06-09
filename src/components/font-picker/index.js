import { __ } from '@wordpress/i18n';
import Select from 'react-select';

const GeneratePressFontPicker = ( { current, fontList, onChange } ) => {
    const customStyles = {
        control: (provided) => ({
            ...provided,
            marginBottom: '12px'
        }),

        input: (provided) => ({
            ...provided,
            border: 'none',
            width: '100%'
        }),

        menu: (provided) => ({
            ...provided,
            maxHeight: '120px'
        }),

        menuList: (provided) => ({
            ...provided,
            maxHeight: '120px'
        }),

        indicatorSeparator: () => ({
            display: 'none'
        })
    };

    return (
        <Select
            className="generatepress-font-picker"
            placeholder={__( 'Quick select...', 'generatepress' )}
            isSearchable={true}
            options={fontList}
            styles={customStyles}
            value={
                fontList.some(font => (font.value === current)) ? {label: current, value: current} : undefined
            }
            onChange={(selected) => onChange(selected.value)}
        />
    );
};

export default GeneratePressFontPicker;
