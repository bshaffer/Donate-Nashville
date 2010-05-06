// onload code for the stuff form
jQuery(function() {
	ResourceFilter.setResourceType('time');

	// attach events AFTER all the document ready code has all executed
	setTimeout(function() {
		ResourceFilter.init();
		
		// also send an ajax call once to prepopulate the search results based on today's date
		ResourceFilter.forceUpdate();
	}, 0);
});