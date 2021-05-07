import GeneratePressToggleControl from './GeneratePressToggleControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-toggle-control' ] = GeneratePressToggleControl;
