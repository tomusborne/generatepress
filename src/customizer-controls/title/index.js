import GeneratePressTitleControl from './GeneratePressTitleControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-title-control' ] = GeneratePressTitleControl;
