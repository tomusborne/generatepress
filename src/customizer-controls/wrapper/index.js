import GeneratePressWrapperControl from './GeneratePressWrapperControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-wrapper-control' ] = GeneratePressWrapperControl;
