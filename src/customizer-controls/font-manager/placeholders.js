import {
	__,
} from '@wordpress/i18n';

const elements = {
	html: {
		module: 'core',
		group: 'base',
		label: 'HTML',
		placeholders: {},
	},
	body: {
		module: 'core',
		group: 'base',
		label: __( 'Body', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '17px',
			},
			lineHeight: {
				value: '1.5',
			},
			marginBottom: {
				value: '1.5em',
			},
		},
	},
	'main-title': {
		module: 'core',
		group: 'header',
		label: __( 'Site Title', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '25px',
			},
		},
	},
	'site-description': {
		module: 'core',
		group: 'header',
		label: __( 'Site Description', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '15px',
			},
		},
	},
	'primary-menu-items': {
		module: 'core',
		group: 'primaryNavigation',
		label: __( 'Primary Menu Items', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '15px',
			},
		},
	},
	'primary-sub-menu-items': {
		module: 'core',
		group: 'primaryNavigation',
		label: __( 'Primary Sub-Menu Items', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '14px',
			},
		},
	},
	'primary-menu-toggle': {
		module: 'core',
		group: 'primaryNavigation',
		label: __( 'Primary Mobile Menu Toggle', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '15px',
			},
		},
	},
	buttons: {
		module: 'core',
		group: 'content',
		label: __( 'Buttons', 'generatepress' ),
		placeholders: {},
	},
	'all-headings': {
		module: 'core',
		group: 'content',
		label: __( 'All Headings', 'generatepress' ),
		placeholders: {
			marginBottom: {
				value: '20px',
			},
		},
	},
	h1: {
		module: 'core',
		group: 'content',
		label: __( 'Heading 1 (H1)', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '42px',
			},
			lineHeight: {
				value: '1.2em',
			},
			marginBottom: {
				value: '20px',
			},
		},
	},
	'single-content-title': {
		module: 'core',
		group: 'content',
		label: __( 'Single Content Title (H1)', 'generatepress' ),
		placeholders: {},
	},
	h2: {
		module: 'core',
		group: 'content',
		label: __( 'Heading 2 (H2)', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '35px',
			},
			lineHeight: {
				value: '1.2em',
			},
			marginBottom: {
				value: '20px',
			},
		},
	},
	'archive-content-title': {
		module: 'core',
		group: 'content',
		label: __( 'Archive Content Title (H2)', 'generatepress' ),
		placeholders: {},
	},
	h3: {
		module: 'core',
		group: 'content',
		label: __( 'Heading 3 (H3)', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '29px',
			},
			lineHeight: {
				value: '1.2em',
			},
			marginBottom: {
				value: '20px',
			},
		},
	},
	h4: {
		module: 'core',
		group: 'content',
		label: __( 'Heading 4 (H4)', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '24px',
			},
			marginBottom: {
				value: '20px',
			},
		},
	},
	h5: {
		module: 'core',
		group: 'content',
		label: __( 'Heading 5 (H5)', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '20px',
			},
			marginBottom: {
				value: '20px',
			},
		},
	},
	h6: {
		module: 'core',
		group: 'content',
		label: __( 'Heading 6 (H6)', 'generatepress' ),
		placeholders: {
			marginBottom: {
				value: '20px',
			},
		},
	},
	'top-bar': {
		module: 'core',
		group: 'widgets',
		label: __( 'Top Bar', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '13px',
			},
		},
	},
	'widget-titles': {
		module: 'core',
		group: 'widgets',
		label: __( 'Widget Titles', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '20px',
			},
			marginBottom: {
				value: '30px',
			},
		},
	},
	footer: {
		module: 'core',
		group: 'footer',
		label: __( 'Footer Bar', 'generatepress' ),
		placeholders: {
			fontSize: {
				value: '15px',
			},
		},
	},
	custom: {
		module: 'core',
		group: 'other',
		label: __( 'Custom', 'generatepress' ),
		placeholders: {},
	},
};

export default elements;
