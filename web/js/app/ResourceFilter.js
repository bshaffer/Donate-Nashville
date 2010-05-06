var ResourceFilter;
(function($) {
ResourceFilter = $.extend({}, {
	
	MINIMUM_FILTER_LENGTH: 3,
	KEYPRESS_DEBOUNCE_RATE: 400, // delays this long (in ms) after each keypress to prevent too many ajax requests
	NO_RESULTS_STRING: '', // this will be loaded from the html (see resource filter template)
	DEFAULT_STRING: '', // this will be loaded from the html (see resource filter template)

	resource_type: 'time', // stuff or time
	
	
	////////////////////////////////////////////////////////////
	/// Init handlers
	
	// called after the document is ready and initial documentReady functions are run
	init: function() {
		this.attachEvents();
		
		this.readStringsFromHTML();
	},
	
	
	// set to stuff or time
	setResourceType: function(resource_type) {
		this.resource_type = resource_type;
	},

	// attach the javascript events to this form
	attachEvents: function() {
		// hijack form submit event and prevent it from submitting
		$('.resourceFilter').submit(function(e) { e.preventDefault(); });

		// attach the onkeyup or onchange events to the input elements
		if (this.resource_type == 'stuff') {
			this.attachEventsForStuff();
		} else {
			this.attachEventsForTime();
		}
	},
	
	// sends the ajax request and populates the search results
	//  in the same way as if an input change event was triggered
	forceUpdate: function() {
		if (this.resource_type == 'stuff') {
			this.runFilterForStuff($('input.resource'));
		} else {
			this.dateOrTimeChanged();
		}
	},
	
	
	
	////////////////////////////////////////////////////////////
	/// Stuff
	
	// attaches the handler to the input that send the ajax request
	attachEventsForStuff: function() {
		var jq_input = $('input.resource');
		var self = this;

		// add the debounce filter
		jq_input.keyup($.debounce(self.KEYPRESS_DEBOUNCE_RATE, function() { self.runFilterForStuff(jq_input); }));
	},


	runFilterForStuff: function(jq_input) {
		var self = this;

		// mark as loading
		self.updateUI(true);
	
		var value = $.trim(jq_input.val());
		if (value.length >= this.MINIMUM_FILTER_LENGTH) {
			// get the action from the form
			var action = jq_input.closest('form').attr('action')+'';

			// send the ajax request
			var vars = {'q': value};
			$('#ResourceResultsList').load(action, vars, function(data, status) {
				// mark as not loading
				self.updateUI(false);
				
				// if we got a blank string, show the no results string instead
				if (data.length < 1) {
					self.showNoResults();
				}
			}, 'html');
		} else {
			// didn't get enough characters

			//  show as not loading
			self.updateUI(false);
			
			// fill the default string
			self.showDefaultString();
		}
	},



	////////////////////////////////////////////////////////////
	/// Time

	attachEventsForTime: function() {
		var self = this;
		
		// add to onSelect event for date pickers
		this.attachEventsForDatePicker('start_date');
		this.attachEventsForDatePicker('end_date');

		// add to onchange event for time pickers
		this.attachEventsForTimePicker('start_time');
		this.attachEventsForTimePicker('end_time');
		
	},
	
	attachEventsForDatePicker: function(date_field_id) {
		var self = this;

		// attach an onSelect event for the changed date when the datepicker is used
		var date_control = $('#'+date_field_id);

		// add an onSelect function to the datepicker
		date_control.datepicker('option', 'onSelect', function(date_text, datepicker_instance) {
			// call our function
			self.dateOrTimeChanged();
		});
	},
	
	attachEventsForTimePicker: function(time_field_id) {
		var self = this;

		$('#'+time_field_id).bind('change', function(e) {
			self.dateOrTimeChanged();
		});
	},
	
	
	// called when any date or time is changed - either manually or with the date picker or time picker
	//   here we pull the start date, the end date and send the appropriate request
	dateOrTimeChanged: function() {
		// get the start and end dates
		var values = this.getDateValues();

		// make sure there is at least a valid start date
		if (values !== null && values.start) {
			this.runFilterForTime(values.start, values.end);
		}
	},
	
	// this can return null for a non-existant date
	getDateValues: function() {
		var values = {};

	  var start_date = this.extractDateValue('start_date');
		if (!start_date.length) {
			return null;
		}

		// calculate start, with or without a time
		var start_time = this.extractTimeValue('start_time');
		values.start =  start_date + (start_time.length ? ' ' + start_time : '');

	  var end_date = this.extractDateValue('end_date');
    
    if (end_date) 
    {
  		// calculate end, if an end time was specified
  		var end_time = this.extractTimeValue('end_time');
  		values.end = (end_time ? end_date + ' ' + end_time : end_date);      
    }
    else
    {
      values.end = '';
    }

		return values;
	},
	
	extractTimeValue: function(time_field_id) {
		var time_text = '';
		var text_val = $('#'+time_field_id).val();
		return text_val;
	},
	
	
	extractDateValue: function(date_field_id) {
		var date_text = $('#'+date_field_id).val();
		
		// convert from m/d/y to y-m-d
		return date_text.replace(/(\d+)\/(\d+)\/(\d+)/,'$3-$1-$2');
	},
	
	
	
	runFilterForTime: function(start_date, end_date) {
		var self = this;
		
		// mark as loading
		self.updateUI(true);
	
		if (start_date) {
			// get the action from the form
			var action = $('#start_date').closest('form').attr('action')+'';

			// set the query vars
			//  the end date is optional
			var vars = {start: start_date};
			if (end_date.length) { vars.end = end_date; }

			// send the request
			$('#ResourceResultsList').load(action, vars, function(data, status) {
				// mark as not loading
				self.updateUI(false);
				
				// if we got a blank string, show the no results string instead
				if (data.length < 1) {
					self.showNoResults();
				}
			}, 'html');
		} else {
			// didn't get a start date

			//  show as not loading
			self.updateUI(false);
			
			// fill no results string
			self.showDefaultString();
		}
	},


	////////////////////////////////////////////////////////////
	/// Common

	// shows when no results are available
	showNoResults: function() {
		$('#ResourceResultsList').html('<div class="noResults">'+this.NO_RESULTS_STRING+'</div>');
	},
	
	showDefaultString: function() {
		$('#ResourceResultsList').html('<div class="emptyList">'+this.DEFAULT_STRING+'</div>');
	},
	
	
	// updates the user interface to add a "searchLoading" class
	updateUI: function(loading) {
		if (loading) {
			$('#ResourceResultsList').addClass('searchLoading');
		} else {
			$('#ResourceResultsList').removeClass('searchLoading');
		}
		
	},
	
	// reads the no results and default strings from the html
	readStringsFromHTML: function() {
		this.NO_RESULTS_STRING = $('#ResourceResultsList .noResults').html();
		this.DEFAULT_STRING = $('#ResourceResultsList .emptyList').html();
	},
	

	
	__end: null
});
})(jQuery);
