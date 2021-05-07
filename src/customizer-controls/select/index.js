import GeneratePressSelectControl from './GeneratePressSelectControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-select-control' ] = GeneratePressSelectControl;
