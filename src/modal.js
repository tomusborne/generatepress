import Modal from './modal/index';

const options = Object.assign( {}, { openTrigger: 'data-gpmodal-trigger' } );
const triggers = [ ...document.querySelectorAll( `[${ options.openTrigger }]` ) ];

const triggerData = triggers.reduce( ( data, currentTrigger ) => {
	const targetModal = currentTrigger.attributes[ options.openTrigger ].value;
	data[ targetModal ] = data[ targetModal ] || [];
	data[ targetModal ].push( currentTrigger );

	return data;
}, [] );

for ( const key in triggerData ) {
	const value = triggerData[ key ];
	options.targetModal = key;
	options.triggers = [ ...value ];
	new Modal( options );
}
