class Modal {
	constructor( {
		openTrigger,
		targetModal,
		triggers = [],
	} ) {
		// Save a reference of the modal.
		this.modal = document.getElementById( targetModal );

		// Save a reference to the passed config.
		this.config = {
			openTrigger,
			closeTrigger: 'data-gpmodal-close',
			openClass: 'gp-modal--open',
		};

		// Register click events only if pre binding eventListeners.
		if ( triggers.length > 0 ) {
			this.registerTriggers( ...triggers );
		}

		// Bind functions for event listeners.
		this.onClick = this.onClick.bind( this );
		this.onKeydown = this.onKeydown.bind( this );
	}

	/**
	 * Loops through all openTriggers and binds click event
	 *
	 * @param  {Array} triggers [Array of node elements]
	 * @return {void}
	 */
	registerTriggers( ...triggers ) {
		triggers.filter( Boolean ).forEach( ( trigger ) => {
			trigger.addEventListener( 'click', () => this.showModal() );

			trigger.addEventListener( 'keydown', ( e ) => {
				// "Spacebar" for IE11.
				if ( ' ' === e.key || 'Enter' === e.key || 'Spacebar' === e.key ) {
					// Prevent the default action to stop scrolling when space is pressed
					e.preventDefault();
					this.showModal();
				}
			} );
		} );
	}

	showModal() {
		this.modal.classList.add( 'gp-modal--transition' );
		this.activeElement = document.activeElement;
		this.modal.classList.add( this.config.openClass );
		this.scrollBehaviour( 'disable' );
		this.addEventListeners();
		this.setFocusToFirstNode();
		setTimeout( () => this.modal.classList.remove( 'gp-modal--transition' ), 100 );
	}

	closeModal() {
		const modal = this.modal;
		modal.classList.add( 'gp-modal--transition' );
		this.removeEventListeners();
		this.scrollBehaviour( 'enable' );

		if ( this.activeElement && this.activeElement.focus ) {
			this.activeElement.focus();
		}

		modal.classList.remove( this.config.openClass );
		setTimeout( () => modal.classList.remove( 'gp-modal--transition' ), 500 );
	}

	scrollBehaviour( toggle ) {
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

	addEventListeners() {
		this.modal.addEventListener( 'touchstart', this.onClick );
		this.modal.addEventListener( 'click', this.onClick );
		document.addEventListener( 'keydown', this.onKeydown );
	}

	removeEventListeners() {
		this.modal.removeEventListener( 'touchstart', this.onClick );
		this.modal.removeEventListener( 'click', this.onClick );
		document.removeEventListener( 'keydown', this.onKeydown );
	}

	/**
	 * Handles all click events from the modal.
	 * Closes modal if a target matches the closeTrigger attribute.
	 *
	 * @param {*} event Click Event
	 */
	onClick( event ) {
		if ( event.target.hasAttribute( this.config.closeTrigger ) || event.target.parentNode.hasAttribute( this.config.closeTrigger ) ) {
			event.preventDefault();
			event.stopPropagation();
			this.closeModal();
		}
	}

	onKeydown( event ) {
		if ( event.keyCode === 27 ) { // esc.
			this.closeModal();
		}

		if ( event.keyCode === 9 ) { // tab.
			this.retainFocus( event );
		}
	}

	getFocusableNodes() {
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

		const nodes = this.modal.querySelectorAll( FOCUSABLE_ELEMENTS );
		return Array( ...nodes );
	}

	/**
	 * Tries to set focus on a node which is not a close trigger
	 * if no other nodes exist then focuses on first close trigger
	 */
	setFocusToFirstNode() {
		const focusableNodes = this.getFocusableNodes();

		// no focusable nodes
		if ( focusableNodes.length === 0 ) {
			return;
		}

		// remove nodes on whose click, the modal closes
		// could not think of a better name :(
		const nodesWhichAreNotCloseTargets = focusableNodes.filter( ( node ) => {
			return ! node.hasAttribute( this.config.closeTrigger );
		} );

		if ( nodesWhichAreNotCloseTargets.length > 0 ) {
			nodesWhichAreNotCloseTargets[ 0 ].focus();
		}

		if ( nodesWhichAreNotCloseTargets.length === 0 ) {
			focusableNodes[ 0 ].focus();
		}
	}

	retainFocus( event ) {
		let focusableNodes = this.getFocusableNodes();

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
