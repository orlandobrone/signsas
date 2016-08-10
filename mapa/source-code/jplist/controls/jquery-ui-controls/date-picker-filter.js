(function($){
	'use strict';		
	
	/** 
	* Date picker control
	* @type {Object} 
    * @class DatePickerFilter
    * @memberOf jQuery.fn.jplist.controls
	*/
	jQuery.fn.jplist.controls.DatePickerFilter = {};	
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.render = function(control){
		
		var controlTypeOptions
			,options = {};
		
		//init vars
		controlTypeOptions = control['controlTypeOptions'];
		
		//disable
		//control.$control['datepicker']('disable');
		
		//init empty onchacnge
		control.$control.off().change(function(){
		
			//control.$jplistBox.trigger(control.options.force_ask_event, [false]);
			if($.trim($(this).val()) === ''){
				control.events.lastStatus = jQuery.fn.jplist.controls.DatePickerFilter.getStatus(false, control);
				control.$jplistBox.trigger(control.options.force_ask_event, [false]);
			}
		});
		
		//init options
		options['onSelect'] = function(dateText, inst){ 
			control.events.lastStatus = jQuery.fn.jplist.controls.DatePickerFilter.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		};
		
		if(controlTypeOptions){		
			controlTypeOptions['datepicker'](control.$control, options);
		}
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.DatePickerFilter.getStatus(isDefault, control);
		
		if(status.data){
			
			if($.isNumeric(status.data.year) && $.isNumeric(status.data.month) && $.isNumeric(status.data.day)){
				
				//init deep link
				deepLink = control.name + '--year~month~day=' + status.data.year + '~' + status.data.month + '~' + status.data.day;
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
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status
			,sections;
			
		//get status
		status = jQuery.fn.jplist.controls.DatePickerFilter.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'year~month~day'){
				
				sections = propValue.split('~');
				
				if(sections.length === 3){
					
					status.data.year = sections[0];
					status.data.month = sections[1];
					status.data.day = sections[2];
					
					//trigger status event
					//control.$jplistBox.trigger(control.options.status_event, [status]);	
				}
			}
		}
		
		return status;
	};
	
	/**
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter.
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.getPaths = function(control, paths){
	
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
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.getStatus = function(isDefault, control){
		
		var status = null
			,data
			,date = null
			,dateTimeFormat;		
		
		//get datetime format
		dateTimeFormat = control.$control.attr('data-datetime-format');
		
		//get date from datepicker
		date = control.$control['datepicker']('getDate');
		
		if(date){
		
			//init data object
			data = {
				path: control.$control.attr('data-path')
				,filterType: 'date'
				//,date: control.$control['datepicker']('getDate')
				,year: date.getFullYear()
				,month: date.getMonth()
				,day: date.getDate()
				,format: dateTimeFormat
			};
			
			status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		}
		
		return status;		
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.setStatus = function(status, control, isCookie){
	
		var date;

		if(status.data && $.isNumeric(status.data.year) && $.isNumeric(status.data.month) && $.isNumeric(status.data.day)){
			
			//init date
			date = new Date(status.data.year, status.data.month, status.data.day);
			
			//set value
			control.$control['datepicker']('setDate', date);
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.DatePickerFilter
	*/
	jQuery.fn.jplist.controls.DatePickerFilter.initEvents = function(control){
		
		
	};
	
})(jQuery);

