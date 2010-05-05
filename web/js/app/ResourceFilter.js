/*
<?php include_partial('resource/resource_filter') ?>
*/

var ResourceFilter;
(function($) {
ResourceFilter = $.extend({}, {
	
	MINIMUM_FILTER_LENGTH: 3,
	NO_RESULTS_STRING: '[ no results found ]',
	resource_type: 'time', // stuff or time
	
	setResourceType: function(resource_type) {
		this.resource_type = resource_type;
	},

	attachEvents: function() {
		if (this.resource_type == 'stuff') {
			this.attachEventsForStuff();
		} else {
			this.attachEventsForTime();
		}
	},
	
	attachEventsForStuff: function() {
		// keep form from submitting
		$('.resourceFilter').submit(function(e) { e.preventDefault(); });
		
		// attach the events to the text input
		this.initSearchFilterForInput($('input.resource'));
	},

	// attaches the handlers to the input that send the ajax request
	initSearchFilterForInput: function(jq_input) {
		var self = this;
		jq_input.keyup($.debounce(500, function() { self.runFilterForStuff(jq_input); }));
	},

	runFilterForStuff: function(jq_input) {
		// console.log('runFilter called');
		var self = this;

		// mark as loading
		self.updateUI(jq_input, true);
	
		var value = $.trim(jq_input.val());
		if (value.length >= this.MINIMUM_FILTER_LENGTH) {
			var action = jq_input.closest('form').attr('action')+'';
			var vars = {'q': value};
			$('#ResourceResultsList').load(action, vars, function(data, status) {
				// mark as not loading
				self.updateUI(jq_input, false);
				
				// if we got a blank string, show the no results string instead
				if (data.length < 1) {
					self.showNoResults();
				}
			}, 'html');
		} else {
			// didn't get enough characters

			//  show as not loading
			self.updateUI(jq_input, false);
			
			// fill no results string
			self.showNoResults();
		}
	},



	////////////////////////////////////////////////////////////
	/// Time

	attachEventsForTime: function() {
		// unimplemented
		
		// here we will pull the start date, the end date and send the appropriate request
	},

	runFilterForTime: function() {
		// get start and end times

		
		// console.log('runFilter called');
		var self = this;

		// mark as loading
		self.updateUI(jq_input, true);
	
		var value = $.trim(jq_input.val());
		if (value.length >= this.MINIMUM_FILTER_LENGTH) {
			var action = jq_input.closest('form').attr('action')+'';
			var vars = {start: start, end: end};
			$('#ResourceResultsList').load(action, vars, function(data, status) {
				// mark as not loading
				self.updateUI(jq_input, false);
				
				// if we got a blank string, show the no results string instead
				if (data.length < 1) {
					self.showNoResults();
				}
			}, 'html');
		} else {
			// didn't get enough characters

			//  show as not loading
			self.updateUI(jq_input, false);
			
			// fill no results string
			self.showNoResults();
		}
	},


	////////////////////////////////////////////////////////////
	/// Common

	showNoResults: function() {
		$('#ResourceResultsList').html('<span class="noResults">'+this.NO_RESULTS_STRING+'</span>');
	},
	
	// start_date, end_date

	updateUI: function(jq_input, loading) {
		if (loading) {
			$('#ResourceResultsList').addClass('searchLoading');
		} else {
			$('#ResourceResultsList').removeClass('searchLoading');
		}
		
	},

	
	__end: null
});
})(jQuery);
