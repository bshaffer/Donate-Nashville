// onload code for the stuff form
jQuery(function() {
	ResourceFilter.setResourceType('time');

	// attach events AFTER all the document ready code has all executed
	setTimeout(function() {
		ResourceFilter.attachEvents();
	}, 0);
});