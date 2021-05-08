import GeneratePressFontManagerControl from './GeneratePressFontManagerControl';
import GeneratePressTypographyControl from './GeneratePressTypographyControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-font-manager-control' ] = GeneratePressFontManagerControl;
wp.customize.controlConstructor[ 'generate-typography-control' ] = GeneratePressTypographyControl;
