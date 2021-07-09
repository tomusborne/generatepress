import { Button } from '@wordpress/components';
import { getElementLabel } from '../../utils';

const Label = ( { itemId, setOpen, isOpen, font, label } ) => {
	return (
		<Button
			className="generate-font-manager--label"
			onClick={ () => {
				if ( itemId !== isOpen ) {
					setOpen( itemId );
				}
			} }
		>
			{ ! font.selector && label }

			{ !! font.selector &&
			<>
				{ getElementLabel( font ) }
				{ !! font.fontFamily && ' / ' + font.fontFamily }
				{ !! font.fontSize && ' / ' + font.fontSize }
				{ !! font.fontSize && !! font.fontSizeUnit && font.fontSizeUnit }
			</>
			}
		</Button>
	);
};

export default Label;
