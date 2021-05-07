import GeneratePressRangeControl from './GeneratePressRangeControl';

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-range-control' ] = GeneratePressRangeControl;
