/*global jQuery:false */
(function($){
	'use strict';		
		
	/** 
	* Select control: sort select, filter select, paging select etc.
	* @type {Object}
	* @class Select control - used for sorting, pagination and filtering
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Select = {};
		
	/**
	* Status object related data for sort (using in communication with controller)
	* @param {string} dataPath - textbox data-path attribute
	* @param {string} type - text, number or datetime
	* @param {string} order - 'asc' or 'desc'
	* @param {string} dateTimeFormat - like {day}.{month}.{year} //{year}, {month}, {day}, {hour}, {min}, {sec}
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Select.statusRelatedDataSort = function(dataPath, type, order, dateTimeFormat){
		
		return {
			path: dataPath
			,type: type
			,order: order
			,dateTimeFormat: dateTimeFormat
		};
	};
	
	/**
	* Status object related data for filter (using in communication with controller)
	* @param {string} dataPath - textbox data-path attribute
	* @param {string} type - text, number or datetime
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Select.statusRelatedDataFilter = function(dataPath, type){
		
		return {
			path: dataPath
			,type: type
			,filterType: 'path'
		};
	};
	
	/**
	* Status object related data for 'items on page' (using in communication with controller)
	* @param {string} number
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Select.statusRelatedDataItemsOnPage = function(number){
		
		return {
			number: number
		};
	};
	
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Select
	*/
	jQuery.fn.jplist.controls.Select.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status
			,sections;
			
		//get status
		status = jQuery.fn.jplist.controls.Select.getStatus(isDefault, control);
		
		if(status.data){
		
			switch(control.action){
					
				case 'paging':{
				
					if((propName === 'number') && $.isNumeric(status.data.number)){
						
						//set value
						status.data.number = propValue;
						
						//trigger status event
						//control.$jplistBox.trigger(control.options.status_event, [status]);
					}					
				}	
				break;			
				
				case 'sort':{
									
					if(propName === 'path~type~order'){
						
						sections = propValue.split('~');
						
						if(sections.length === 3){
							
							status.data.path = sections[0];
							status.data.type = sections[1];
							status.data.order = sections[2];
							
							//trigger status event
							//control.$jplistBox.trigger(control.options.status_event, [status]);
						}
					}
				}
				break;
				
				case 'filter':{
					
					if((propName === 'path') && status.data.path){
						
						//set value
						status.data.path = propValue;
						
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
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.Select
	*/
	jQuery.fn.jplist.controls.Select.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.Select.getStatus(isDefault, control);
		
		if(status.data){
		
			switch(control.action){
				
				case 'paging':{
					
					if($.isNumeric(status.data.number)){
						
						//init deep link
						deepLink = control.name + '--number=' + status.data.number;
					}
				}	
				break;			
				
				case 'sort':{
									
					if(status.data.path && status.data.type && status.data.order){
						
						//init deep link
						deepLink = control.name + '--path~type~order=' + status.data.path + '~' + status.data.type + '~' + status.data.order;
					}
				}
				break;
				
				case 'filter':{
					
					if(status.data.path){
						
						//init deep link
						deepLink = control.name + '--path=' + status.data.path;
					}
				}
				break;
			}
		}
		
		return deepLink;
	};
	
	/**
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.Select
	*/
	jQuery.fn.jplist.controls.Select.getPaths = function(control, paths){
	
		var jqPath
			,dataType
			,path;
			
		control.$control.find('option').each(function(){
				
			//init vars
			jqPath = $(this).attr('data-path');
			dataType = $(this).attr('data-type');
			
			//init path
			if(jqPath && $.trim(jqPath) !== ''){
			   
				path = new jQuery.fn.jplist.models.Path(jqPath, dataType);
								
				if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
					paths.push(path);
				}
			}
		});
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Select
	*/
	jQuery.fn.jplist.controls.Select.getStatus = function(isDefault, control){
	
		var $option
			,status = null
			,dateTimeFormat = ''
			,data;
		
		//get selected option (if default, get option with data-default=true or first option)
		if(isDefault){
		
			$option = control.$control.find('option[data-default="true"]').eq(0);
			if($option.length <= 0){
				$option =  control.$control.find('option').eq(0);
			}
		}
		else{
			$option = control.$control.find('option:selected');
		}
		
		switch(control.action){
		
			case 'paging':{
			
				//create status related data
				data = new jQuery.fn.jplist.controls.Select.statusRelatedDataItemsOnPage($option.attr('data-number'));
				
				//create status object
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);				
			}
			break;
			
			case 'sort':{
								
				//init datetime format
				dateTimeFormat = control.$control.attr('data-datetime-format');
				
				if(!dateTimeFormat){
					dateTimeFormat = '';
				}
				
				//init status related data
				data = new jQuery.fn.jplist.controls.Select.statusRelatedDataSort($option.attr('data-path'), $option.attr('data-type'), $option.attr('data-order'), dateTimeFormat);
				
				//create status
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);				
			}
			break;
			
			case 'filter':{
				
				//create status related data				
				data = new jQuery.fn.jplist.controls.Select.statusRelatedDataFilter($option.attr('data-path'), $option.attr('data-type'));
				
				//create status
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);				
			}
			break;
		}
		
		return status;	
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.Select
	*/
	jQuery.fn.jplist.controls.Select.setStatus = function(status, control, isCookie){
	
		var $option;
		
		switch(control.action){
		
			case 'filter':{
				
				if(!control.cookies && isCookie){				
					status.data.path = 'default';	
					control.events.lastStatus = status;
					control.$jplistBox.trigger(control.options.status_event, [status]);
				}
				else{					
					$option = control.$control.find('option[data-path="' + status.data.path + '"]');
					
					if($option && $option.length > 0){
						$option.get(0).selected = true;		
					}
				}				
			}
			break;
			
			case 'sort':{
				
				if(!control.cookies && isCookie){				
					status.data.path = 'default';
					control.events.lastStatus = status;
					control.$jplistBox.trigger(control.options.status_event, [status]);
				}
				else{
					//set active class
					if(status.data.path == 'default'){
						$option = control.$control.find('option[data-path="' + status.data.path + '"]');
					}
					else{
						$option = control.$control.find('option[data-path="' + status.data.path + '"][data-type="' + status.data.type + '"][data-order="' + status.data.order + '"]');
					}
					
					if($option.length > 0){
						$option.get(0).selected = true;				
					}
				}
			}
			break;
			
			case 'paging':{
				
				$option = control.$control.find('option[data-number="' + status.data.number + '"]');
				if($option.length === 0){
					$option = control.$control.find('option[data-number="all"]');
				}
				$option.get(0).selected = true;
			}
			break;
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Select
	*/
	jQuery.fn.jplist.controls.Select.initEvents = function(control){
		
		control.$control.change(function(){
		
			var status
				,selectedOption
				,data_path
				,data_number;
			
			status = jQuery.fn.jplist.controls.Select.getStatus(false, control);
			
			//get selected option
			selectedOption = $(this).find('option:selected');
			
			//get data
			data_path = selectedOption.attr('data-path');
			data_number = selectedOption.attr('data-number');
			
			if(data_path){
			
				status.data.path = data_path;
				status.data.type = $(this).attr('data-type');
				status.data.order = $(this).attr('data-order');				
			}
			else{
				if(data_number){
					status.data.number = data_number;
				}
			}
			
			//send status event			
			control.events.lastStatus = status;
			control.$jplistBox.trigger(control.options.status_event, [status]);
		});
	};
	
})(jQuery);

