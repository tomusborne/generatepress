import Label from './Typography/Label';
import SettingsButton from './Typography/SettingsButton';
import DeleteButton from './Typography/DeleteButton';
import TypographySettings from './TypographySettings';
import getIcon from '../../../utils/get-icon';

const Typography = ( props ) => {
	const {
		font,
		label,
		itemId,
		setOpen,
		isOpen,
		deleteFont,
		toggleClose,
		onChangeFontValue,
		onChangeElement,
	} = props;

	const dragStyles = font.chosen ? {
		backgroundColor: '#c3c4c7',
	} : {};

	return (
		<div className="generate-font-manager--item" style={ dragStyles }>

			<div className="generate-font-manager--header" style={ { pointerEvents: !! isOpen ? 'none' : '' } }>
				<div className="generate-font-manager--drag-handle" >{ getIcon( 'drag-handle' ) }</div>
				<Label
					font={ font }
					itemId={ itemId }
					setOpen={ setOpen }
					isOpen={ isOpen }
					label={ label }
				/>
				<SettingsButton itemId={ itemId } setOpen={ setOpen } isOpen={ isOpen } />
				<DeleteButton onClick={ deleteFont } />
			</div>

			{ itemId === isOpen &&
				<TypographySettings
					font={ font }
					toggleClose={ toggleClose }
					onChangeFontValue={ onChangeFontValue }
					onChangeElement={ onChangeElement }
				/>
			}
		</div>
	);
};

export default Typography;
