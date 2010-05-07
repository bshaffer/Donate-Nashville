var ResourceFilter;
(function($) {
ResourceFilter = $.extend({}, {
	
	MINIMUM_FILTER_LENGTH: 3,
	KEYPRESS_DEBOUNCE_RATE: 450, // delays this long (in ms) after each keypress to prevent too many ajax requests
	FADE_TIME: 250, // fade in/out takes this long

	// these are specified in the resource filter template
	NO_RESULTS_STRING: '', // this will be loaded from the html (see resource filter template)
	DEFAULT_STRING: '', // this will be loaded from the html (see resource filter template)

	resource_type: 'time', // stuff or time
	
	
	////////////////////////////////////////////////////////////
	/// Init handlers
	
	// called after the document is ready and initial documentReady functions are run
	init: function() {
		// attach the change events to do the ajax search
		this.attachEvents();
		
		// read the NO_RESULTS_STRING and DEFAULT_STRING from the HTML
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
		self.updateUI(true, 'list');
	  
		var value = $.trim(jq_input.val());
		if (value.length >= this.MINIMUM_FILTER_LENGTH) {
			// get the action from the form
			var action = jq_input.closest('form').attr('action')+'';

			// send the ajax request
			var vars = {'q': value};
			$.getJSON(action, vars, function(data, status) {
				data.stuff = $.trim(data.stuff);
				if (data.stuff.length > 0) {
					// got data back - show the html string
					self.showContent(data.stuff);
				} else {
					// if we got a blank string, show the no results string instead
					self.showNoResults();
				}
				
				data.info = $.trim(data.info);
				if (data.info.length > 0) {
					// got data back - show the html string
				  self.updateUI(true, 'sidebar');
					self.showSidebarContent(data.info);
				}
				
			});
		} else {
			// didn't get enough characters
			
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
			$.get(action, vars, function(data, status) {
				data = $.trim(data);
				if (data.length > 0) {
					// got data back - show the html string
					self.showContent(data);
				} else {
					// if we got a blank string, show the no results string instead
					self.showNoResults();
				}

			}, 'html');
		} else {
			// didn't get a start date

			// fill no results string
			self.showDefaultString();
		}
	},


	////////////////////////////////////////////////////////////
	/// Common

	// shows when no results are available
	showNoResults: function() {
		this.showContent('<div class="noResults">'+this.NO_RESULTS_STRING+'</div>');
	},
	
	// shows when no results are available
	showNoSidebarResults: function() {
		this.showSidebarContent('');
	},
	
	showDefaultString: function() {
		this.showContent('<div class="emptyList">'+this.DEFAULT_STRING+'</div>');
	},
	
	
	////////////////////////////////////////////////////////////
	/// UI Updates
	
	showContent: function(new_content, location) {
		var self = this;
		var id = 'ResultsContainer';
		if(location === 'sidebar') { id = 'SidebarContainer'; }
		
		// update content
		$('#'+id).queue(function() {
			$(this).html(new_content);
			$(this).dequeue();

			// mark as no longer loading after the content is applied
			self.updateUI(false, location);
		});
	},
	
	showSidebarContent: function(new_content) {
		this.showContent(new_content, 'sidebar');
	},

	// updates the user interface to add a "searchLoading" class
	updateUI: function(loading, location) {
		var list_id, container_id;
		if(location === 'sidebar') {
			list_id = 'sidebar';
			container_id = 'SidebarContainer';
		} else {
			list_id = 'ResourceResultsList';
			container_id = 'ResultsContainer';
		}

		if (loading) {
			$('#'+container_id).animate({opacity:0}, this.FADE_TIME);
			$('#'+container_id).queue(function() {
				$('#'+list_id).addClass('searchLoading');
				$(this).dequeue();
			});
		} else {
			$('#'+list_id).removeClass('searchLoading');
			$('#'+container_id).animate({opacity:1}, this.FADE_TIME);
		}
	},
	
	// reads the no results and default strings from the html
	readStringsFromHTML: function() {
		this.NO_RESULTS_STRING = $('#ResultsContainer .noResults').html();
		this.DEFAULT_STRING = $('#ResultsContainer .emptyList').html();
	},
	

	
	__end: null
});
})(jQuery);
