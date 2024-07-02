import './style.scss';
import './customizer-controls/color-picker';
import './customizer-controls/font-manager';
import './customizer-controls/color-manager';
import './customizer-controls/title';

document.addEventListener( 'DOMContentLoaded', () => {
	window.sessionStorage.removeItem( 'generateGlobalColors' );
} );
