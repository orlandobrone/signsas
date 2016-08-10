/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Textbox control - used as text filter
	* @type {Object} 
    * @class Textbox control - used as text filter
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Textbox = {};
	
	/**
	* Status object related data (using in communication with controller)
	* @param {string} dataPath - textbox data-path attribute
	* @param {string} value - textbox value
	* @param {string} ignore - ignore characters regex (defined in javascript in control's options)
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Textbox.statusRelatedData = function(dataPath, value, ignore){
		
		return {
			path: dataPath		
			,ignore: ignore
			,value: value
			,filterType: 'text' //used in controller to define filter type
		};
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.Textbox
	*/
	jQuery.fn.jplist.controls.Textbox.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.Textbox.getStatus(isDefault, control);
		
		if(status.data){
			
			if($.trim(status.data.value) !== ''){
				
				//init deep link
				deepLink = control.name + '--value=' + status.data.value;
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
	* @memberOf jQuery.fn.jplist.controls.Textbox
	*/
	jQuery.fn.jplist.controls.Textbox.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status;
			
		//get status
		status = jQuery.fn.jplist.controls.Textbox.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'value'){
				
				//set current page
				status.data.value = propValue;
				
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
	* @memberOf jQuery.fn.jplist.controls.Textbox
	*/
	jQuery.fn.jplist.controls.Textbox.getPaths = function(control, paths){
	
		var jqPath
			,dataType
			,path;
		
		//init path vars
		jqPath = control.$control.attr('data-path');
		dataType = null;
		
		//init path
		if(jqPath && $.trim(jqPath) !== ''){
		   
			path = new jQuery.fn.jplist.models.Path(jqPath, dataType);
			
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
	* @memberOf jQuery.fn.jplist.controls.Textbox
	*/
	jQuery.fn.jplist.controls.Textbox.getStatus = function(isDefault, control){
		
		var data
			,status
			,dataPath
			,value
			,ignore = '';	
			
		//init data-path
		dataPath = control.$control.attr('data-path');
				
		//init value
		if(isDefault){
			value = '';
		}
		else{
			value = control.$control.val();
		}		
		
		if(control.controlTypeOptions && control.controlTypeOptions.ignore){
		 
			//get ignore characters
			ignore = control.controlTypeOptions.ignore;
		}
		
		//create status related data object
		data = new jQuery.fn.jplist.controls.Textbox.statusRelatedData(dataPath, value, ignore);
		
		//create status object
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		
		return status;			
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.Textbox
	*/
	jQuery.fn.jplist.controls.Textbox.setStatus = function(status, control, isCookie){
				
		if(!control.cookies && isCookie){
			
			status.data.value = '';
			
			//send status event	
			control.$jplistBox.trigger(control.options.status_event, [status]);
		}
		else{
			if(status.data){
			
				if(!status.data.value){
					status.data.value = '';
				}
				
				//set value
				control.$control.val(status.data.value);
			}
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Textbox
	*/
	jQuery.fn.jplist.controls.Textbox.initEvents = function(control){
		
		control.$control.off('keyup').on('keyup', function(){	
			
			//update last status
			control.events.lastStatus = jQuery.fn.jplist.controls.Textbox.getStatus(false, control);
		
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};
	
	
})(jQuery);

