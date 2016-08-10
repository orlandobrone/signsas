(function($){
	'use strict';		
	
	/** 
	* Date picker range control
	* @type {Object} 
    * @class DatePickerRangeFilter
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter = {};		
	
	/**
	* Status object related data (using in communication with controller)
	* @param {string} dataPath - DatePickerRangeFilter data-path attribute
	* @param {string} dateTimeFormat
	* @param {Date|string} prevDate
	* @param {Date|string} nextDate
	* @function
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.statusRelatedData = function(dataPath, dateTimeFormat, prevDate, nextDate){
			
		var result = {
			path: dataPath
			,format: dateTimeFormat
			,filterType: 'date_range'
			,prev_year: ''
			,prev_month: ''
			,prev_day: ''
			,next_year: ''
			,next_month: ''
			,next_day: ''
		};
		
		if(prevDate){
			result.prev_year = prevDate.getFullYear();
			result.prev_month = prevDate.getMonth();
			result.prev_day = prevDate.getDate();
		}
		
		if(nextDate){
			result.next_year = nextDate.getFullYear();
			result.next_month = nextDate.getMonth();
			result.next_day = nextDate.getDate();
		}
		
		return result;		
	};
		
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.DatePickerRangeFilter
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.render = function(control){
		
		var controlTypeOptions
			,options = {}
			,prev
			,next;
		
		//init vars
		controlTypeOptions = control['controlTypeOptions'];
		
		//init prev and next input fields
		prev = control.$control.find('[data-type="prev"]');
		next = control.$control.find('[data-type="next"]');
		
		//init data
		control.$control.data('jplist-datepicker-range-prev', prev);
		control.$control.data('jplist-datepicker-range-next', next);
		
		//init empty onchacnge
		prev.off().change(function(){
		
			if($.trim($(this).val()) === ''){
				control.events.lastStatus = jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatus(false, control);
				control.$jplistBox.trigger(control.options.force_ask_event, [false]);
			}
		});
		
		next.off().change(function(){
		
			if($.trim($(this).val()) === ''){
				control.events.lastStatus = jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatus(false, control);
				control.$jplistBox.trigger(control.options.force_ask_event, [false]);
			}
		});
		
		//init options
        options['onSelect'] = function(dateText, inst){
			control.events.lastStatus = jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		};
		
		if(controlTypeOptions){		
			controlTypeOptions['datepicker'](prev, options);
			controlTypeOptions['datepicker'](next, options);
		}
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.DatePickerRangeFilter
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatus(isDefault, control);
		
		if(status.data){
			
			if($.isNumeric(status.data.prev_year) && $.isNumeric(status.data.prev_month) && $.isNumeric(status.data.prev_day)){
				
				//init deep link
				deepLink += control.name + '--prev=' + status.data.prev_year + '~' + status.data.prev_month + '~' + status.data.prev_day;
			}
			
			if($.isNumeric(status.data.next_year) && $.isNumeric(status.data.next_month) && $.isNumeric(status.data.next_day)){
				
				if(deepLink !== ''){
					deepLink += '~~';
				}
				
				//init deep link
				deepLink += control.name + '--next=' + status.data.next_year + '~' + status.data.next_month + '~' + status.data.next_day;
			}
		}
		
		return deepLink;
	};
	
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.DatePickerRangeFilter
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status
			,sections;
			
		//get status
		status = jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatus(isDefault, control);
		
		if(status.data){
		
			switch(propName){
				
				case 'prev':{	
					
					sections = propValue.split('~');
					
					if(sections.length === 3){
					
						status.data.prev_year = sections[0];
						status.data.prev_month = sections[1];
						status.data.prev_day = sections[2];
						
						//trigger status event
						//control.$jplistBox.trigger(control.options.status_event, [status]);	
					}
				}
				break;
				
				case 'next':{
					
					sections = propValue.split('~');
					
					if(sections.length === 3){
					
						status.data.next_year = sections[0];
						status.data.next_month = sections[1];
						status.data.next_day = sections[2];
						
						//trigger status event
						//control.$jplistBox.trigger(control.options.status_event, [status]);	
					}
				}
				break;
			}
		}
		
		return status;
	};
	
	/**
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.DatePickerRangeFilter.
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.getPaths = function(control, paths){
	
		var jqPath
			,path;
		
		//init vars
		jqPath = control.$control.attr('data-path').toString();
		
		//init path
		if(jqPath && $.trim(jqPath) !== ''){
		   
			path = new jQuery.fn.jplist.models.Path(jqPath, 'datetime');
			
			if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
				paths.push(path);
			}
		}		
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.DatePickerRangeFilter
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.getStatus = function(isDefault, control){
				
		var status = null
			,data = null
			,prevDate = null
			,nextDate = null
			,dateTimeFormat
			,prev
			,next
			,dataPath;		
		
		//get vars
		dataPath = control.$control.attr('data-path').toString();
		dateTimeFormat = control.$control.attr('data-datetime-format').toString();
		
		//get prev/next controls
		prev = control.$control.data('jplist-datepicker-range-prev');
		next = control.$control.data('jplist-datepicker-range-next');
		
		if(!isDefault){
			//get dates from datepickers
			prevDate = prev['datepicker']('getDate');
			nextDate = next['datepicker']('getDate');
		}
		
		data = jQuery.fn.jplist.controls.DatePickerRangeFilter.statusRelatedData(dataPath, dateTimeFormat, prevDate, nextDate);			
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);	
		
		return status;		
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.DatePickerRangeFilter
	*/
	jQuery.fn.jplist.controls.DatePickerRangeFilter.setStatus = function(status, control, isCookie){
	
		var prevDate
			,nextDate
			,$prev
			,$next;

		//get prev/next controls
		$prev = control.$control.data('jplist-datepicker-range-prev');
		$next = control.$control.data('jplist-datepicker-range-next');
		
		if($.isNumeric(status.data.prev_year) && 
			$.isNumeric(status.data.prev_month) && 
			$.isNumeric(status.data.prev_day)){
		
			//init dates
			prevDate = new Date(status.data.prev_year, status.data.prev_month, status.data.prev_day);	
			$prev['datepicker']('setDate', prevDate);
		}
		else{
			$prev.val('');
		}
		
		if($.isNumeric(status.data.next_year) && 
			$.isNumeric(status.data.next_month) && 
			$.isNumeric(status.data.next_day)){
			
			nextDate = new Date(status.data.next_year, status.data.next_month, status.data.next_day);
			$next['datepicker']('setDate', nextDate);
		}
		else{				
			$next.val('');
		}		
	};
	
})(jQuery);

