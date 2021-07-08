import { Button, Popover } from '@wordpress/components';
import TargetElement from './TypographySettings/TargetElement';
import CustomSelector from './TypographySettings/CustomSelector';
import FontFamily from './TypographySettings/FontFamily';
import FontWeight from './TypographySettings/FontWeight';
import TextTransform from './TypographySettings/TextTransform';
import FontSize from './TypographySettings/FontSize';
import LineHeight from './TypographySettings/LineHeight';
import LetterSpacing from './TypographySettings/LetterSpacing';
import MarginBottom from './TypographySettings/MarginBottom';
import { selectorHasMarginBottom } from '../utils';
import { __ } from '@wordpress/i18n';

const TypographySettings = ( props ) => {
	const {
		font,
		toggleClose,
		onChangeFontValue,
		onChangeElement,
	} = props;

	return (
		<Popover
			position="bottom center"
			className="generate-customize-control--popover generate-customize-control--font-popover"
			onClose={ toggleClose }
			focusOnMount="container"
		>
			<TargetElement
				index={ font.index }
				value={ font.selector }
				onChange={ onChangeElement }
			/>

			{ !! font.selector &&
				<>
					{ font.selector === 'custom' &&
						<CustomSelector
							index={ font.index }
							value={ font.customSelector }
							onChange={ onChangeFontValue }
						/>
					}

					<FontFamily
						index={ font.index }
						value={ font.fontFamily }
						onChange={ onChangeFontValue }
					/>

					<div className="components-base-control generate-font-manager--select-options">
						<FontWeight
							index={ font.index }
							value={ font.fontWeight }
							fontFamily={ font.fontFamily }
							onChange={ onChangeFontValue }
						/>

						<TextTransform
							index={ font.index }
							value={ font.textTransform }
							onChange={ onChangeFontValue }
						/>
					</div>

					<FontSize font={ font } onChange={ onChangeFontValue } />
					<LineHeight font={ font } onChange={ onChangeFontValue } />
					<LetterSpacing font={ font } onChange={ onChangeFontValue } />

					{ selectorHasMarginBottom( font.selector ) &&
						<MarginBottom font={ font } onChange={ onChangeFontValue } />
					}
				</>
			}

			<div className="generate-font-manager--footer">
				<Button
					isSecondary
					isSmall
					onClick={ toggleClose }
				>
					{ __( 'Close', 'generatepress' ) }
				</Button>
			</div>

		</Popover>
	);
};

export default TypographySettings;
