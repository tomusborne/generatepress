import { Button, Tooltip } from '@wordpress/components';

export default function ColorButton( props ) {
	const {
		color,
		tooltip,
		tooltipPosition,
		onClick,
		ariaExpanded,
	} = props;

	return (
		<div className="components-circular-option-picker__option-wrapper">
			<Tooltip text={ tooltip } position={ tooltipPosition }>
				<Button
					className="components-color-palette__item components-circular-option-picker__option"
					aria-expanded={ ariaExpanded }
					onClick={ onClick }
					aria-label={ tooltip }
					style={ { color } }
				>
					<span className="components-color-palette__custom-color-gradient" />
				</Button>
			</Tooltip>
		</div>
	);
}
