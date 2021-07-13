export default function getIcon( icon ) {
	if ( 'info' === icon ) {
		return <svg width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" aria-hidden="true"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z" /><path d="M464 336a48 48 0 1096 0 48 48 0 10-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z" /></svg>;
	}

	if ( 'x' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" /></svg>;
	}

	if ( 'ellipsis' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20" /><g><path d="M5 10c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zm12-2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-7 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" /></g></svg>;
	}

	if ( 'mobile' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" width="1em" height="1em"><path d="M6 2h8c.55 0 1 .45 1 1v14c0 .55-.45 1-1 1H6c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1zm7 12V4H7v10h6zM8 5h4l-4 5V5z" fill="currentColor" /></svg>;
	}

	if ( 'tablet' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" width="1em" height="1em"><path d="M4 2h12c.55 0 1 .45 1 1v14c0 .55-.45 1-1 1H4c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1zm11 14V4H5v12h10zM6 5h6l-6 5V5z" fill="currentColor" /></svg>;
	}

	if ( 'desktop' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true" width="1em" height="1em"><path d="M3 2h14c.55 0 1 .45 1 1v10c0 .55-.45 1-1 1h-5v2h2c.55 0 1 .45 1 1v1H5v-1c0-.55.45-1 1-1h2v-2H3c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1zm13 9V4H4v7h12zM5 5h9L5 9V5z" fill="currentColor" /></svg>;
	}

	if ( 'dash' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="1em" height="1em" viewBox="0 0 24 24"><path d="M4.5 12.75a.75.75 0 01.75-.75h13.5a.75.75 0 010 1.5H5.25a.75.75 0 01-.75-.75z" fill="currentColor" /></svg>;
	}

	if ( 'color' === icon ) {
		return <svg aria-hidden="true" viewBox="0 0 32 32"><circle cx="10" cy="12" r="2" fill="currentColor" /><circle cx="16" cy="9" r="2" fill="currentColor" /><circle cx="22" cy="12" r="2" fill="currentColor" /><circle cx="23" cy="18" r="2" fill="currentColor" /><circle cx="19" cy="23" r="2" fill="currentColor" /><path fill="currentColor" d="M16.54 2A14 14 0 002 16a4.82 4.82 0 006.09 4.65l1.12-.31a3 3 0 013.79 2.9V27a3 3 0 003 3 14 14 0 0014-14.54A14.05 14.05 0 0016.54 2zm8.11 22.31A11.93 11.93 0 0116 28a1 1 0 01-1-1v-3.76a5 5 0 00-5-5 5.07 5.07 0 00-1.33.18l-1.12.31A2.82 2.82 0 014 16 12 12 0 0116.47 4 12.18 12.18 0 0128 15.53a11.89 11.89 0 01-3.35 8.79z" /></svg>;
	}

	if ( 'plus' === icon ) {
		return <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" /></svg>;
	}

	if ( 'lock' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2" /><path d="M7 11V7a5 5 0 0110 0v4" /></svg>;
	}

	if ( 'unlock' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2" /><path d="M7 11V7a5 5 0 019.9-1" /></svg>;
	}

	if ( 'chevron-down' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>;
	}

	if ( 'chevron-up' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M18 15l-6-6-6 6" /></svg>;
	}

	if ( 'chevron-right' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" /></svg>;
	}
}
