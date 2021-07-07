import GeneratePressControl from '../../components/GeneratePressControl';
import GeneratePressColorManagerControlForm from './GeneratePressColorManagerControlForm';

const GeneratePressColorManagerControl = GeneratePressControl.extend( GeneratePressColorManagerControlForm );

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-color-manager-control' ] = GeneratePressColorManagerControl;
