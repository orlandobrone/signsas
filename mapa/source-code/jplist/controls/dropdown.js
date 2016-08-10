/*global jQuery:false, document: false */
(function($){
	'use strict';		
	
	/** 
	* Dropdown control: sort dropdown, filter dropdown, paging dropdown etc.
	* @type {Object} 
    * @class Dropdown control - sort, filter, pagination dropdowns
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Dropdown = {};
	
	/**
	* Status object related data for sort (using in communication with controller)
	* @param {string} dataPath - textbox data-path attribute
	* @param {string} type - text, number or datetime
	* @param {string} order - 'asc' or 'desc'
	* @param {string} dateTimeFormat - like {day}.{month}.{year} //{year}, {month}, {day}, {hour}, {min}, {sec}
	* @param {string} ignore - ignore regex
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Dropdown.statusRelatedDataSort = function(dataPath, type, order, dateTimeFormat, ignore){
		
		return {
			path: dataPath
			,type: type
			,order: order
			,dateTimeFormat: dateTimeFormat
			,ignore: ignore
		};
	};
	
	/**
	* Status object related data for filter (using in communication with controller)
	* @param {string} dataPath - textbox data-path attribute
	* @param {string} type - text, number or datetime
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Dropdown.statusRelatedDataFilter = function(dataPath, type){
		
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
	jQuery.fn.jplist.controls.Dropdown.statusRelatedDataItemsOnPage = function(number){
		
		return {
			number: number
		};
	};
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.render = function(control){
		
		var li
			,span;
			
		//get first li
		li = control.$control.find('li:eq(0)');
		
		li.addClass('active');
		span = li.find('span');
		
		//init panel
		if(control.$control.find('.panel').length <= 0){
			control.$control.prepend('<div class="panel">' + span.text() + '</div>');	
		}	
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.Dropdown.getStatus(isDefault, control);
		
		if(status.data){
		
			switch(control.action){
				
				case 'paging':{
					
					if($.isNumeric(status.data.number) || status.data.number === 'all' ){
						
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
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status
			,sections;
		
		if((propName !== 'number') && (propName !== 'path~type~order') && (propName !== 'path')){			
			return null;
		}
		
		//get status
		status = jQuery.fn.jplist.controls.Dropdown.getStatus(isDefault, control);
		
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
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.getPaths = function(control, paths){
	
		var jqPath
			,dataType
			,path;
			
		control.$control.find('span').each(function(){
				
			//init vars
			jqPath = $(this).attr('data-path');
			dataType = $(this).attr('data-type');
			
			//init path
			if(jqPath && $.trim(jqPath) !== ''){
			   
			    //init path
				path = new jQuery.fn.jplist.models.Path(jqPath, dataType);
				
				if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
					paths.push(path);
				}
			}
		});
	};
	
	/**
	* get span with default value
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQueryObject} - span with default value
	*/
	var getSpanWithDefaultValue = function(control){
		
		var $li
			,$span;
		
		$li = control.$control.find('li:has(span[data-default="true"])').eq(0);
			
		if($li.length <= 0){
			$li = control.$control.find('li:eq(0)');
		}
		
		//get span
		$span = $li.find('span');
		
		return $span;
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.getStatus = function(isDefault, control){
		
		var status = null
			,data
			,$li
			,$span
			,dateTimeFormat
			,ignore;
						
		if(isDefault){
					
			$li = control.$control.find('li:has(span[data-default="true"])').eq(0);
			
			if($li.length <= 0){
				$li = control.$control.find('li:eq(0)');
			}
		}
		else{
			$li = control.$control.find('.active');
		}
		
		//get span
		$span = $li.find('span');
		
		switch(control.action){
			
			case 'paging':{
			
				//create status related data
				data = new jQuery.fn.jplist.controls.Select.statusRelatedDataItemsOnPage( $span.attr('data-number'));
				
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
				
				//init ignore
				ignore = control.$control.attr('data-ignore');
				
				if(!ignore){
					ignore = '';
				}
				
				//init status related data
				data = new jQuery.fn.jplist.controls.Select.statusRelatedDataSort($span.attr('data-path'), $span.attr('data-type'), $span.attr('data-order'), dateTimeFormat);
				
				//create status
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);				
			}
			break;
			
			case 'filter':{
				
				//create status related data				
				data = new jQuery.fn.jplist.controls.Dropdown.statusRelatedDataFilter($span.attr('data-path'), $span.attr('data-type'));
				
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
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.setStatus = function(status, control, isCookie){
	
		var $li
			,$span = null;
		
		if(!control.cookies && isCookie){	
			$span = getSpanWithDefaultValue(control);			
		}
		
		switch(control.action){
				
			case 'filter':{
			
				if(!control.cookies && isCookie && $span.length > 0){
										
					status.data.path = $span.attr('data-path');
					status.data.type = $span.attr('data-type');
					
					//send status event		
					control.events.lastStatus = status;
					control.$jplistBox.trigger(control.options.status_event, [status]);
				}
				else{
					//remove active class
					control.$control.find('li').removeClass('active');
					
					//set active class
					$li = control.$control.find('li:has([data-path="' + status.data.path + '"])');
					$li.addClass('active');
					
					//update dropdown panel
					control.$control.find('.panel').text($li.eq(0).text());	
				}				
			}
			break;
			
			case 'sort':{
				
				if(!control.cookies && isCookie && $span.length > 0){
										
					status.data.path = $span.attr('data-path');
					status.data.type = $span.attr('data-type');
					status.data.order = $span.attr('data-order');					
										
					//send status event		
					control.events.lastStatus = status;
					control.$jplistBox.trigger(control.options.status_event, [status]);
				}
				else{
					//remove active class
					control.$control.find('li').removeClass('active');
					
					//set active class
					if(status.data.path == 'default'){
						$li = control.$control.find('li:has([data-path="default"])');
					}
					else{
						$li = control.$control.find('li:has([data-path="' + status.data.path + '"][data-type="' + status.data.type + '"][data-order="' + status.data.order + '"])');
					}
					
					$li.addClass('active');
					
					//update dropdown panel
					control.$control.find('.panel').text($li.eq(0).text());	
				}				
			}
			break;
			
			case 'paging':{
				
				if(!control.cookies && isCookie && $span.length > 0){
										
					status.data.number = $span.attr('data-number');
					
					//send status event		
					control.events.lastStatus = status;
					control.$jplistBox.trigger(control.options.status_event, [status]);
				}
				else{
					//remove active class
					control.$control.find('li').removeClass('active');
					
					//set active class
					$li = control.$control.find('li:has([data-number="' + status.data.number + '"])');
					if($li.length === 0){
						$li = control.$control.find('li:has([data-number="all"])');
					}
					
					$li.addClass('active');
					
					//update dropdown panel
					control.$control.find('.panel').text($li.eq(0).text());	
				}
			}
			break;
		}
	};
		
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Dropdown
	*/
	jQuery.fn.jplist.controls.Dropdown.initEvents = function(control){
		
		var dropdowns = $(document).find('[data-control-type="drop-down"]');
		
		$(document).click(function(){
			dropdowns.find('ul').hide();
		});
		
		$(document).off('jplist_dropdown_close').on('jplist_dropdown_close', function(event, jq_dropdown){
		
			dropdowns.each(function(){
				if(!$(this).is(jq_dropdown)){
					$(this).find('ul').hide();
				}
			});
		});
		
		control.$control.find('.panel').off().click(function(event){
			
			var dropdown
				,ul;
				
			//stop propagation
			event.stopPropagation();
			
			dropdown = $(this).parents('[data-control-type]');	
			ul = dropdown.find('ul');
			
			//close other dropdowns
			$(document).trigger('jplist_dropdown_close', [dropdown]);
			
			//current dropdown			
			if(ul.is(':visible')){
				ul.hide();
			}
			else{
				ul.show();
			}
		});
		
		control.$control.find('li').off().click(function(){
		
			var status
				,data_path
				,data_number
				,span;
			
			status = jQuery.fn.jplist.controls.Dropdown.getStatus(false, control);
			
			span = $(this).find('span');
			data_path = span.attr('data-path');
			data_number = span.attr('data-number');
			
			if(data_path){
			
				status.data.path = data_path;
				status.data.type = span.attr('data-type');
				status.data.order = span.attr('data-order');				
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

