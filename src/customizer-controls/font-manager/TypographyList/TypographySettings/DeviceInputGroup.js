import UtilityLabel from '../../../../components/utility-label';
import { BaseControl } from '@wordpress/components';
import UnitControl from '../../../../components/unit-control';
import { useState } from '@wordpress/element';

const DeviceInputGroup = ( props ) => {
	const {
		label,
		units,
		defaultUnit = '',
		desktopValue,
		desktopInitial,
		desktopOnChange,
		tabletValue,
		tabletInitial,
		tabletOnChange,
		mobileInitial,
		mobileValue,
		mobileOnChange,
	} = props;

	const [ device, setDevice ] = useState( 'desktop' );

	return (
		<BaseControl>
			<UtilityLabel
				label={ label }
				devices={ [ 'desktop', 'tablet', 'mobile' ] }
				onClick={ ( deviceType ) => setDevice( deviceType ) }
			/>

			<div className="generate-component-input-with-unit">
				<div className="generate-component-device-field" data-device="desktop">
					<UnitControl
						key={ device }
						units={ units }
						value={ desktopValue }
						placeholder={ desktopInitial }
						onChange={ desktopOnChange }
						defaultUnit={ defaultUnit }
					/>
				</div>

				<div className="generate-component-device-field" data-device="tablet">
					<UnitControl
						key={ device }
						units={ units }
						value={ tabletValue }
						placeholder={ tabletInitial }
						onChange={ tabletOnChange }
						defaultUnit={ defaultUnit }
					/>
				</div>

				<div className="generate-component-device-field" data-device="mobile">
					<UnitControl
						key={ device }
						units={ units }
						value={ mobileValue }
						placeholder={ mobileInitial }
						onChange={ mobileOnChange }
						defaultUnit={ defaultUnit }
					/>
				</div>
			</div>
		</BaseControl>
	);
};

export default DeviceInputGroup;
