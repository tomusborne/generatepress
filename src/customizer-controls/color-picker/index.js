import GeneratePressColorControl from './GeneratePressColorControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-color-control' ] = GeneratePressColorControl;
