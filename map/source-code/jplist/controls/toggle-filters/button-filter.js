(function($){
	'use strict';		
	
	/** 
	* Button filter control
	* @type {Object} 
    * @class ButtonFilter - button filters
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.ButtonFilter = {};	
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.render = function(control){		
		control.$control.data('selected', false);
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.ButtonFilter.getStatus(isDefault, control);
		
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
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status;
			
		//get status
		status = jQuery.fn.jplist.controls.ButtonFilter.getStatus(isDefault, control);
		
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
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.getPaths = function(control, paths){
	
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
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.getStatus = function(isDefault, control){
		
		var selected
			,data
			,status;
		
		if(isDefault){
			selected = false;
		}
		else{
			//get selected value
			selected = control.$control.data('selected');
		}
		
		if(selected){
			data = {
				path: control.$control.attr('data-path')
				,type: 'text'
				,filterType: 'path'
				,selected: selected
			};
		}
		else{
			data = {
				path: control.$control.attr('data-path')
				,type: 'text'
				,filterType: ''
				,selected: selected
			};
		}
		
		//init status
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		
		return status;
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.setStatus = function(status, control, isCookie){
		
		//update 'data'
		control.$control.data('selected', status.data.selected);
		
		//update class
		if(status.data.selected){
			control.$control.addClass('selected');
		}
		else{
			control.$control.removeClass('selected');
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.ButtonFilter
	*/
	jQuery.fn.jplist.controls.ButtonFilter.initEvents = function(control){
		
		var selected;
		
		control.$control.off().click(function(){
			
			//get selected value
			selected = control.$control.data('selected');
			
			//toggle value
			control.$control.data('selected', !selected);
			
			//update class
			if(selected){
				control.$control.removeClass('selected');
			}
			else{
				control.$control.addClass('selected');
			}
			
			//trigger force ask event
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};
	
	
})(jQuery);

