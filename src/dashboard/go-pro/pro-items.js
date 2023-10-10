import {
	__,
} from '@wordpress/i18n';

export default {
	themeBuilder: {
		title: __( 'Theme Builder', 'generatepress' ),
		description: __( 'Design and build your theme elements in the block editor.', 'generatepress' ),
		icon: <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z" /></svg>,
		action: {
			label: __( 'Explore our theme builder', 'generatepress' ),
			url: 'https://generatepress.com/premium#theme-builder',
			external: true,
		},
	},
	siteLibrary: {
		title: __( 'Site Library', 'generatepress' ),
		description: __( 'Start your site with a professionally-built starter site.', 'generatepress' ),
		icon: <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2zM22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" /></svg>,
		action: {
			label: __( 'Explore starter sites', 'generatepress' ),
			url: 'https://generatepress.com/premium#site-library',
			external: true,
		},
	},
	moreOptions: {
		title: __( 'More Options', 'generatepress' ),
		description: __( 'Add more options like our advanced hook system, mobile header, sticky navigation, infinite scroll, masonry and much more.', 'generatepress' ),
		icon: <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3M1 14h6M9 8h6M17 16h6" /></svg>,
		action: {
			label: __( 'Explore more options', 'generatepress' ),
			url: 'https://generatepress.com/premium',
			external: true,
		},
	},
	support: {
		title: __( 'Premium Support', 'generatepress' ),
		description: __( 'We take support seriously. Gain access to our premium support forums and take advantage of our industry-leading support.', 'generatepress' ),
		icon: <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="4" /><path d="M4.93 4.93l4.24 4.24M14.83 14.83l4.24 4.24M14.83 9.17l4.24-4.24M14.83 9.17l3.53-3.53M4.93 19.07l4.24-4.24" /></svg>,
		action: {
			label: __( 'Explore our support forums', 'generatepress' ),
			url: 'https://generate.support/',
			external: true,
		},
	},
};

