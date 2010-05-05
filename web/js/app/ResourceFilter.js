var ResourceFilter;
(function($) {
ResourceFilter = $.extend({}, {
	
	MINIMUM_FILTER_LENGTH: 3,
	KEYPRESS_DEBOUNCE_RATE: 400, // delays this long (in ms) after each keypress to prevent too many ajax requests
	NO_RESULTS_STRING: '[ no results found ]',

	resource_type: 'time', // stuff or time
	
	
	////////////////////////////////////////////////////////////
	/// Init handlers
	
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
			this.dateSelectChanged();
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
			
			// fill no results string
			self.showNoResults();
		}
	},



	////////////////////////////////////////////////////////////
	/// Time

	attachEventsForTime: function() {
		var self = this;
		
		// bind an onchange event to all the pulldowns
		$('#resource_date_month, #resource_date_day, #resource_date_year, #start_time_hour, #start_time_minute, #end_time_hour, #end_time_minute').bind('change', function(e) {
			self.dateSelectChanged();
		});

		// add to onSelect event for date pickers
		this.attachEventsForDatePicker('resource_date');
    // this.attachEventsForDatePicker('end');
	},
	
	attachEventsForDatePicker: function(prefix) {
		var self = this;

		// attach an onSelect event for the changed date when the datepicker is used
		var date_control = $('#'+prefix+'_jquery_control');

		// capture the old onSelect function and call it
		var old_event_func = date_control.datepicker('option', 'onSelect');
		date_control.datepicker('option', 'onSelect', function(date_text, datepicker_instance) {
			// call the old function
			(old_event_func)(date_text, datepicker_instance);
			
			// call our function
			self.dateSelectChanged();
		});
	},
	
	// called when any date is changed - either manually or with the date picker
	// here we will pull the start date, the end date and send the appropriate request
	dateSelectChanged: function() {
		// get the start and end dates
		var values = this.getDateValues();

		// make sure there is at least a valid start date
		if (values.start) {
			this.runFilterForTime(values.start, values.end);
		}
	},
	
	getDateValues: function() {
	  var date = this.extractDateValue('resource_date');
		var values = {};
		values.start =  date + ' ' + this.extractTimeValue('start_time');
		var endTime = this.extractTimeValue('end_time', true);
		values.end =  endTime ? date + ' ' + endTime : '';
		return values;
	},
	
	extractTimeValue: function(prefix, required) {
		var time_text = '';
		
		// a temporary function to extract a date field and verify an integer value
		var extractIntVal = function(field_name) {
			var text_val = $('#'+prefix+'_'+field_name).val();
			var int_val = parseInt(text_val, 10);
			if (isNaN(int_val)) { return null; }
			return text_val;
		};

		// hour can be blank if required is false
		var hour = extractIntVal('hour');
		if (hour === null) { if(required) { return false; } else {hour = '00'}; }
		// minute can be blank
		var minute = extractIntVal('minute');
		if (minute === null) { minute = '00'; }
		
		// return the date in y-m-d h:m:s
		return hour+':'+minute+':00';
	},
	
	
	extractDateValue: function(prefix) {
		var date_text = '';
		
		// a temporary function to extract a date field and verify an integer value
		var extractIntVal = function(field_name) {
			var text_val = $('#'+prefix+'_'+field_name).val();
			var int_val = parseInt(text_val, 10);
			if (isNaN(int_val)) { return null; }
			return text_val;
		};
		
		// year/month/day must have a value
		var year = extractIntVal('year');
		if (year === null) { return false; }
		var month = extractIntVal('month');
		if (month === null) { return false; }
		var day = extractIntVal('day');
		if (day === null) { return false; }
		
		// return the date in y-m-d h:m:s
		return year+'-'+month+'-'+day;
	},
	
	
	
	runFilterForTime: function(start_date, end_date) {
		var self = this;
		
		// mark as loading
		self.updateUI(true);
	
		if (start_date) {
			// get the action from the form
			var action = $('#resource_date_month').closest('form').attr('action')+'';

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
			self.showNoResults();
		}
	},


	////////////////////////////////////////////////////////////
	/// Common

	// shows when no results are available
	showNoResults: function() {
		$('#ResourceResultsList').html('<span class="noResults">'+this.NO_RESULTS_STRING+'</span>');
	},
	
	// updates the user interface to add a "searchLoading" class
	updateUI: function(loading) {
		if (loading) {
			$('#ResourceResultsList').addClass('searchLoading');
		} else {
			$('#ResourceResultsList').removeClass('searchLoading');
		}
		
	},

	
	__end: null
});
})(jQuery);
