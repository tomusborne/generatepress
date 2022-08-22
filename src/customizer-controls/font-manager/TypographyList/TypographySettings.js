import { Button } from '@wordpress/components';
import TargetElement from './TypographySettings/TargetElement';
import CustomSelector from './TypographySettings/CustomSelector';
import FontFamily from './TypographySettings/FontFamily';
import FontWeight from './TypographySettings/FontWeight';
import TextTransform from './TypographySettings/TextTransform';
import FontStyle from './TypographySettings/FontStyle';
import FontSize from './TypographySettings/FontSize';
import LineHeight from './TypographySettings/LineHeight';
import LetterSpacing from './TypographySettings/LetterSpacing';
import MarginBottom from './TypographySettings/MarginBottom';
import TextDecoration from './TypographySettings/textDecoration';
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
		<div className="generate-customize-control--font-dropdown">
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

						<FontStyle
							index={ font.index }
							value={ font.fontStyle }
							onChange={ onChangeFontValue }
						/>

						<TextDecoration
							index={ font.index }
							value={ font.textDecoration }
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

		</div>
	);
};

export default TypographySettings;
