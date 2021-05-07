import GeneratePressTextControl from './GeneratePressTextControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-text-control' ] = GeneratePressTextControl;
