import Label from './Typography/Label';
import SettingsButton from './Typography/SettingsButton';
import DeleteButton from './Typography/DeleteButton';
import TypographySettings from './TypographySettings';

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

	return (
		<div className="generate-font-manager--item">

			<div className="generate-font-manager--header" style={ { pointerEvents: !! isOpen ? 'none' : '' } }>
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
