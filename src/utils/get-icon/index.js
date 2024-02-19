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

	if ( 'plus' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" /></svg>;
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

	if ( 'trash' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" fill="none" style={ { fill: 'none' } } stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6" /></svg>;
	}

	if ( 'reorder' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="1" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path d="m5 9-3 3 3 3M9 5l3-3 3 3M15 19l-3 3-3-3M19 9l3 3-3 3M2 12h20M12 2v20" /></svg>;
	}

	if ( 'check' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" viewBox="0 0 24 24"><path fill="none" d="M20 6 9 17l-5-5" /></svg>;
	}

	if ( 'ai' === icon ) {
		return <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none" /><path d="M80.84,170.47l-51.66-19a7.92,7.92,0,0,1,0-14.86l51.66-19a7.88,7.88,0,0,0,4.69-4.69l19-51.66a7.92,7.92,0,0,1,14.86,0l19,51.66a7.88,7.88,0,0,0,4.69,4.69l51.66,19a7.92,7.92,0,0,1,0,14.86l-51.66,19a7.88,7.88,0,0,0-4.69,4.69l-19,51.66a7.92,7.92,0,0,1-14.86,0l-19-51.66A7.88,7.88,0,0,0,80.84,170.47Z" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="16" /><line x1="176" y1="16" x2="176" y2="64" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="16" /><line x1="224" y1="72" x2="224" y2="104" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="16" /><line x1="152" y1="40" x2="200" y2="40" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="16" /><line x1="208" y1="88" x2="240" y2="88" fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="16" /></svg>;
	}
}
