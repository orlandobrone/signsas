(function($){
	'use strict';		
	
	/** 
	* Radio button filter control
	* @type {Object} 
    * @class RadioButtonsFilter control - radio buttons filters
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter = {};	
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.render = function(control){
		
		//on html render: get the default values of the checkbox (if checked, true or false)
		var selected = control.$control.get(0).checked;
		
		//if undefined, set false
		if(selected !== true){
			selected = false;
		}
		
		//save the default values to the 'data'
		control.$control.data('default-checked', selected);
	};
	
	/**
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.getPaths = function(control, paths){
	
		var jqPath
			,path;		
				
		//ger data-path attribute
		jqPath = control.$control.attr('data-path');
		
		//init path
		if(jqPath && $.trim(jqPath) !== ''){
		
			path = new jQuery.fn.jplist.models.Path(jqPath, 'text');
			
			if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
				paths.push(path);
			}
		}
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.RadioButtonsFilter.getStatus(isDefault, control);
		
		if(status.data && status.data.selected){
				
			//init deep link
			deepLink = control.name + '--selected=true';
		}
		
		return deepLink;
	};
	
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status;
			
		//get status
		status = jQuery.fn.jplist.controls.RadioButtonsFilter.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'selected'){
				
				//set current page
				status.data.selected = true;
				
				//trigger status event
				//control.$jplistBox.trigger(control.options.status_event, [status]);	
			}
		}
		
		return status;
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.getStatus = function(isDefault, control){
		
		var status = null
			,data
			,selected;
		
		if(isDefault){	
		
			//if default, get the value saved in 'data'
			selected = control.$control.data('default-checked');
			if(selected !== true){
				selected = false;
			}
		}
		else{
			selected = control.$control.get(0).checked;
		}		
		
		data = {
			path: control.$control.attr('data-path')
			,type: 'text'
			,filterType: 'path'
			,selected: selected
		};		
			
		if(selected){
			status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);	
			return status;
		}
		else{
			data.filterType = '';
			status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
			return status;
		}
			
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.setStatus = function(status, control, isCookie){
	
		if(status.data.selected !== true){
			control.$control.get(0).checked = false;
		}
		else{
			control.$control.get(0).checked = true;
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.RadioButtonsFilter
	*/
	jQuery.fn.jplist.controls.RadioButtonsFilter.initEvents = function(control){
		
		control.$control.off().change(function(){
			control.events.lastStatus = jQuery.fn.jplist.controls.RadioButtonsFilter.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};
	
	
})(jQuery);

