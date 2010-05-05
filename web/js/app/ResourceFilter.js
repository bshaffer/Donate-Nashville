/*
<?php include_partial('resource/resource_filter') ?>
*/

var ResourceFilter;
(function($) {
ResourceFilter = $.extend({}, {
	
	attachEvents: function() {
		// keep form from submitting
		$('.resourceFilter').submit(function(e) { e.preventDefault(); });
		
		// attach the events to the text input
		this.initSearchFilterForInput($('input.resource'));
	},
		

	// attaches the handlers to the input that send the ajax request
	initSearchFilterForInput: function(jq_input) {
		var self = this;
		jq_input.keyup($.debounce(500, function() { self.runFilter(jq_input); }));

		// jq_input.keyup(function() {
		// 	// mark as loading
		// 	self.updateUI(jq_input, true);
		// });
		
	},

	runFilter: function(jq_input) {
		// console.log('runFilter called');
		var self = this;
	
		var value = $.trim(jq_input.val());
		if (value.length >= this.MINIMUM_FILTER_LENGTH || value == '') {
	
			var action = jq_input.closest('form').attr('action')+'';
			var vars = {'q': value};
			$.load(action, vars, function(data, status) {
				// mark as not loading
				// self.updateUI(jq_input, false);
	
				if (status != 'success') {
					// Notify.flashError('Failed to load search results');
					return;
				}
	
				self.handleSearchFilterResults(data, jq_input);
			}, 'html');
		} else {
			// didn't get enough characters
			//  show as not loading
			// self.updateUI(jq_input, false);
		}
	},
	

	// updateUI: function(jq_input, loading) {
	// 	if (loading) {
	// 		jq_input.addClass('filterInputLoading');
	// 	} else {
	// 		jq_input.removeClass('filterInputLoading');
	// 	}
	// 	
	// },

	
	__end: null
});
})(jQuery);
