import GeneratePressColorManagerControl from './GeneratePressColorManagerControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-color-manager-control' ] = GeneratePressColorManagerControl;
