import googleFonts from './google-fonts.json';
import fontWeights from '../../utils/get-font-weights';
import './style.scss';

import {
	__,
} from '@wordpress/i18n';

import {
	BaseControl,
	TextControl,
} from '@wordpress/components';

const GeneratePressFontFamilyControlForm = ( props ) => {
	/**
	 * Save the value when changing the control.
	 *
	 * @param {Object} value - The value.
	 * @return {void}
	 */
	const handleChangeComplete = ( value ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( value );
	};

	const onFontShortcut = ( event ) => {
		wp.customize.control( props.customizerSetting.id ).setting.set( event.target.value );
		onFontChange( event.target.value );
	};

	const fontWeightSettingId = props.customizerSetting.id.replace( 'family', 'weight' );
	const googleFontSettingId = props.customizerSetting.id.replace( 'family', 'google' );
	const fontCategoryId = props.customizerSetting.id.replace( 'family', 'category' );
	const fontVariantsId = props.customizerSetting.id.replace( 'family', 'variants' );

	const fonts = [
		{ value: '', label: __( 'Quick select…', 'generateblocks' ) },
		{ value: 'default', label: __( 'Default', 'generateblocks' ) },
		{ value: 'Arial', label: 'Arial' },
		{ value: 'Helvetica', label: 'Helvetica' },
		{ value: 'Times New Roman', label: 'Times New Roman' },
		{ value: 'Georgia', label: 'Georgia' },
	];

	Object.keys( googleFonts ).slice( 0, 20 ).forEach( ( k ) => {
		fonts.push(
			{ value: k, label: k }
		);
	} );

	const onFontChange = ( value ) => {
		if ( 'default' === value ) {
			value = props.defaultValue;
		}

		wp.customize.control( props.customizerSetting.id ).setting.set( value );

		const fontWeightControl = wp.customize.control( fontWeightSettingId );

		if ( fontWeightControl ) {
			const fontWeight = fontWeightControl.setting.get();

			// Temporarily set font weight setting to force it to re-render with font-family specific values.
			fontWeightControl.setting.set( 'refresh' );

			if ( fontWeight && Object.values( fontWeights( value ) ).indexOf( fontWeight ) < 0 ) {
				fontWeightControl.setting.set( '' );
			} else {
				fontWeightControl.setting.set( fontWeight );
			}
		}

		if ( typeof googleFonts[ value ] !== 'undefined' ) {
			wp.customize.control( googleFontSettingId ).setting.set( true );
			wp.customize.control( fontCategoryId ).setting.set( googleFonts[ value ].category );
			wp.customize.control( fontVariantsId ).setting.set( googleFonts[ value ].variants.join( ', ' ) );
		} else {
			wp.customize.control( googleFontSettingId ).setting.set( false );
			wp.customize.control( fontCategoryId ).setting.set( '' );
			wp.customize.control( fontVariantsId ).setting.set( '' );
		}
	};

	return (
		<div>
			<span className="description customize-control-description" dangerouslySetInnerHTML={ { __html: props.description } }></span>
			<div className="customize-control-notifications-container" ref={ props.setNotificationContainer }></div>

			<BaseControl
				className="generate-component-font-family-picker-wrapper"
				label={ !! props.label ? props.label : null }
				id="generate-font-family-field"
			>
				<select
					className="components-select-control__input components-select-control__input--generate-fontfamily"
					onChange={ ( value ) => {
						onFontShortcut( value );
					} }
					onBlur={ () => {
						// do nothing
					} }
				>
					{ fonts.map( ( option, index ) =>
						<option
							key={ `${ option.label }-${ option.value }-${ index }` }
							value={ option.value }
						>
							{ option.label }
						</option>
					) }
				</select>

				<TextControl
					id="generate-font-family-field"
					value={ props.value }
					help={ __( 'Font family name', 'generatepress' ) }
					onChange={ handleChangeComplete }
				/>
			</BaseControl>
		</div>
	);
};

export default GeneratePressFontFamilyControlForm;
