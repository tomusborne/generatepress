import hasNumericValue from '../../utils/has-numeric-value';

// Import CSS
import './style.scss';

import {
	Component,
} from '@wordpress/element';

import {
	RangeControl,
	TextControl,
} from '@wordpress/components';

export default class RangeControlInput extends Component {
	render() {
		const {
			label,
			value,
			onChange,
			rangeMin = 0,
			rangeMax = 100,
			inputMin = '',
			inputMax = '',
			step = 1,
			help = '',
			beforeIcon = '',
			initialPosition = '',
			placeholder = '',
		} = this.props;

		return (
			<div className="components-generate-range-control">
				{ label &&
					<div className="components-generate-range-control--label">
						{ label }
					</div>
				}

				<div className="components-generate-range-control--wrapper">
					<div className="components-generate-range-control--range">
						<RangeControl
							className={ 'generate-range-control-range' }
							beforeIcon={ beforeIcon }
							value={ hasNumericValue( value ) ? parseFloat( value ) : '' }
							onChange={ ( newVal ) => onChange( newVal ) }
							min={ rangeMin }
							max={ rangeMax }
							step={ step }
							withInputField={ false }
							initialPosition={ initialPosition }
						/>
					</div>

					<div className="components-generate-range-control-input">
						<TextControl
							type="number"
							placeholder={ '' !== placeholder ? placeholder : '' }
							min={ inputMin }
							max={ inputMax }
							step={ step }
							value={ hasNumericValue( value ) ? value : '' }
							onChange={ ( newVal ) => onChange( newVal ) }
						/>
					</div>
				</div>

				{ help &&
					<p className="components-base-control__help">
						{ help }
					</p>
				}
			</div>
		);
	}
}
