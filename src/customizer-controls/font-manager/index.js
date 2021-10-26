import GeneratePressControl from '../../components/GeneratePressControl';

import GeneratePressFontManagerControlForm from './GeneratePressFontManagerControlForm';
import GeneratePressTypographyControlForm from './GeneratePressTypographyControlForm';

const GeneratePressFontManagerControl = GeneratePressControl.extend( GeneratePressFontManagerControlForm );
const GeneratePressTypographyControl = GeneratePressControl.extend( GeneratePressTypographyControlForm );

// Register control type with Customizer.
wp.customize.controlConstructor[ 'generate-font-manager-control' ] = GeneratePressFontManagerControl;
wp.customize.controlConstructor[ 'generate-typography-control' ] = GeneratePressTypographyControl;
