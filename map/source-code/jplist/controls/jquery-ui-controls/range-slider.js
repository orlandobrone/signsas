(function($){
	'use strict';		
	
	/** 
	* Range slider control
	* @type {Object} 
    * @class Range slider control
    * @memberOf jQuery.fn.jplist.controls
	*/
	jQuery.fn.jplist.controls.RangeSlider = {};	
	
	/**
	* Status object related data (using in communication with controller)
	* @param {string} dataPath - RangeSlider data-path attribute
	* @param {number} min
	* @param {number} max
	* @param {number} prev
	* @param {number} next
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.RangeSlider.statusRelatedData = function(dataPath, min, max, prev, next){
		
		return {
			path: dataPath
			,type: 'number'
			,filterType: 'range'
			,min: min
			,max: max
			,prev: prev
			,next: next
		};
	};
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.RangeSlider
	*/
	jQuery.fn.jplist.controls.RangeSlider.render = function(control){
		
		var $uiSlider = null
			,controlTypeOptions
			,$prev = null
			,$next = null;
		
		//get elements
		$uiSlider = control.$control.find('[data-type="ui-slider"]');
		$prev = control.$control.find('[data-type="prev-value"]');
		$next = control.$control.find('[data-type="next-value"]');
		
		//save to data
		control.$control.data('jplist-ui-slider', $uiSlider);
		control.$control.data('jplist-prev-value', $prev);
		control.$control.data('jplist-next-value', $next);
		
		//call ui function
		controlTypeOptions = control['controlTypeOptions'];
		
		if(controlTypeOptions){	

			//call ui slider functions
			controlTypeOptions['ui_slider']($uiSlider, $prev, $next);			
			controlTypeOptions['set_values']($uiSlider, $prev, $next);
		}		
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.RangeSlider
	*/
	jQuery.fn.jplist.controls.RangeSlider.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.RangeSlider.getStatus(isDefault, control);
		
		if(status.data){
			
			if($.isNumeric(status.data.prev) && $.isNumeric(status.data.next)){
				
				//init deep link
				deepLink = control.name + '--prev~next=' + status.data.prev + '~' + status.data.next;
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
	* @memberOf jQuery.fn.jplist.controls.RangeSlider
	*/
	jQuery.fn.jplist.controls.RangeSlider.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status
			,sections;
			
		//get status
		status = jQuery.fn.jplist.controls.RangeSlider.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'prev~next'){
				
				sections = propValue.split('~');
				
				if(sections.length === 2){
					
					status.data.prev = sections[0];
					status.data.next = sections[1];
					
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
	* @memberOf jQuery.fn.jplist.controls.RangeSlider.
	*/
	jQuery.fn.jplist.controls.RangeSlider.getPaths = function(control, paths){
	
		var jqPath
			,path;
		
		//init vars
		jqPath = control.$control.attr('data-path').toString();
			
		//init path
		if(jqPath && $.trim(jqPath) !== ''){
		   
			path = new jQuery.fn.jplist.models.Path(jqPath, 'number');
			
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
	* @memberOf jQuery.fn.jplist.controls.RangeSlider
	*/
	jQuery.fn.jplist.controls.RangeSlider.getStatus = function(isDefault, control){
		
		var status = null
			,data
			,dataPath, min, max, prev, next
			,$uiSlider = control.$control.data('jplist-ui-slider');		
		
		//init vars
		dataPath = control.$control.attr('data-path').toString();		
		min = $uiSlider['slider']('option', 'min');
		max = $uiSlider['slider']('option', 'max');
		
		if(isDefault){			
			prev = min;
			next = max;
		}
		else{
			prev = $uiSlider['slider']('values', 0);
			next = $uiSlider['slider']('values', 1);
		}
		
		data = new jQuery.fn.jplist.controls.RangeSlider.statusRelatedData(dataPath, min, max, prev, next);						
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		
		return status;		
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.RangeSlider
	*/
	jQuery.fn.jplist.controls.RangeSlider.setStatus = function(status, control, isCookie){
	
		var $uiSlider = null
			,prev
			,next
			,controlTypeOptions
			,$prev
			,$next;
		
		//get ui slider
		$uiSlider = control.$control.data('jplist-ui-slider');
		$prev = control.$control.find('[data-type="prev-value"]');
		$next = control.$control.find('[data-type="next-value"]');
						
		if($.isNumeric(status.data.prev) && $.isNumeric(status.data.next)){
			
			//get values
			prev = Number(status.data.prev);
			next = Number(status.data.next);			
			
			if(!isNaN(prev) && !isNaN(next)){	
				
				if($uiSlider['slider']('values', 0) != prev){
					$uiSlider['slider']('values', 0, prev);
				}
				
				if($uiSlider['slider']('values', 1) != next){
					$uiSlider['slider']('values', 1, next);
				}
			}
		}

		//init values
		controlTypeOptions = control['controlTypeOptions'];	
		if(controlTypeOptions){				
			controlTypeOptions['set_values']($uiSlider, $prev, $next);
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.RangeSlider
	*/
	jQuery.fn.jplist.controls.RangeSlider.initEvents = function(control){
		
		var $uiSlider = null;
		
		//get ui slider
		$uiSlider = control.$control.data('jplist-ui-slider');
		
		//on value change
		$uiSlider.on('slidechange', function(event, ui) {
			
			//forse ask event	
			control.events.lastStatus = jQuery.fn.jplist.controls.RangeSlider.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};
})(jQuery);

