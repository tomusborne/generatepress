import GeneratePressFontFamilyControl from './GeneratePressFontFamilyControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-font-family-control' ] = GeneratePressFontFamilyControl;
