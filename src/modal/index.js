function Modal( { targetModal, openTrigger, triggers = [] } ) {
	const modal = document.getElementById( targetModal );

	if ( ! modal ) {
		return;
	}

	const config = { openTrigger, closeTrigger: 'data-gpmodal-close', openClass: 'gp-modal--open' };
	let activeElement = '';

	// Register click events only if pre binding eventListeners.
	if ( triggers.length > 0 ) {
		registerTriggers( ...triggers );
	}

	/**
	 * Loops through all openTriggers and binds click event
	 *
	 * @param  {Array} allTriggers [Array of node elements]
	 * @return {void}
	 */
	function registerTriggers( ...allTriggers ) {
		allTriggers.filter( Boolean ).forEach( ( trigger ) => {
			trigger.addEventListener( 'click', () => showModal() );

			trigger.addEventListener( 'keydown', ( e ) => {
				// "Spacebar" for IE11.
				if ( ' ' === e.key || 'Enter' === e.key || 'Spacebar' === e.key ) {
					// Prevent the default action to stop scrolling when space is pressed
					e.preventDefault();
					showModal();
				}
			} );
		} );
	}

	function showModal() {
		modal.classList.add( 'gp-modal--transition' );
		activeElement = document.activeElement;
		modal.classList.add( config.openClass );
		scrollBehaviour( 'disable' );
		addEventListeners();
		setFocusToFirstNode();
		setTimeout( () => modal.classList.remove( 'gp-modal--transition' ), 100 );
	}

	function closeModal() {
		modal.classList.add( 'gp-modal--transition' );
		removeEventListeners();
		scrollBehaviour( 'enable' );

		if ( activeElement && activeElement.focus ) {
			activeElement.focus();
		}

		modal.classList.remove( config.openClass );
		setTimeout( () => modal.classList.remove( 'gp-modal--transition' ), 500 );
	}

	function scrollBehaviour( toggle ) {
		const body = document.querySelector( 'body' );

		switch ( toggle ) {
			case 'enable':
				Object.assign( body.style, { overflow: '' } );
				break;
			case 'disable':
				Object.assign( body.style, { overflow: 'hidden' } );
				break;
			default:
		}
	}

	function addEventListeners() {
		modal.addEventListener( 'touchstart', onClick );
		modal.addEventListener( 'click', onClick );
		document.addEventListener( 'keydown', onKeydown );
	}

	function removeEventListeners() {
		modal.removeEventListener( 'touchstart', onClick );
		modal.removeEventListener( 'click', onClick );
		document.removeEventListener( 'keydown', onKeydown );
	}

	/**
	 * Handles all click events from the modal.
	 * Closes modal if a target matches the closeTrigger attribute.
	 *
	 * @param {*} event Click Event
	 */
	function onClick( event ) {
		if ( event.target.hasAttribute( config.closeTrigger ) || event.target.parentNode.hasAttribute( config.closeTrigger ) ) {
			event.preventDefault();
			event.stopPropagation();
			closeModal();
		}
	}

	function onKeydown( event ) {
		if ( event.keyCode === 27 ) { // esc.
			closeModal();
		}

		if ( event.keyCode === 9 ) { // tab.
			retainFocus( event );
		}
	}

	function getFocusableNodes() {
		const FOCUSABLE_ELEMENTS = [
			'a[href]',
			'area[href]',
			'input:not([disabled]):not([type="hidden"]):not([aria-hidden])',
			'select:not([disabled]):not([aria-hidden])',
			'textarea:not([disabled]):not([aria-hidden])',
			'button:not([disabled]):not([aria-hidden])',
			'iframe',
			'object',
			'embed',
			'[contenteditable]',
			'[tabindex]:not([tabindex^="-"])',
		];

		const nodes = modal.querySelectorAll( FOCUSABLE_ELEMENTS );
		return Array( ...nodes );
	}

	/**
	 * Tries to set focus on a node which is not a close trigger
	 * if no other nodes exist then focuses on first close trigger
	 */
	function setFocusToFirstNode() {
		const focusableNodes = getFocusableNodes();

		// no focusable nodes
		if ( focusableNodes.length === 0 ) {
			return;
		}

		// remove nodes on whose click, the modal closes
		// could not think of a better name :(
		const nodesWhichAreNotCloseTargets = focusableNodes.filter( ( node ) => {
			return ! node.hasAttribute( config.closeTrigger );
		} );

		if ( nodesWhichAreNotCloseTargets.length > 0 ) {
			nodesWhichAreNotCloseTargets[ 0 ].focus();
		}

		if ( nodesWhichAreNotCloseTargets.length === 0 ) {
			focusableNodes[ 0 ].focus();
		}
	}

	function retainFocus( event ) {
		let focusableNodes = getFocusableNodes();

		// no focusable nodes
		if ( focusableNodes.length === 0 ) {
			return;
		}

		/**
		 * Filters nodes which are hidden to prevent
		 * focus leak outside modal
		 */
		focusableNodes = focusableNodes.filter( ( node ) => {
			return ( node.offsetParent !== null );
		} );

		const focusedItemIndex = focusableNodes.indexOf( document.activeElement );

		if ( event.shiftKey && focusedItemIndex === 0 ) {
			focusableNodes[ focusableNodes.length - 1 ].focus();
			event.preventDefault();
		}

		if ( ! event.shiftKey && focusableNodes.length > 0 && focusedItemIndex === focusableNodes.length - 1 ) {
			focusableNodes[ 0 ].focus();
			event.preventDefault();
		}
	}
}

export default Modal;
