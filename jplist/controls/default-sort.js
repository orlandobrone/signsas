(function($){
	'use strict';		
	
	/** 
	* 'Default sort' control - used instead of 'sort dropdown' control, to define the inital sort order.
	* @type {Object} 
    * @class 'Default sort' control - used instead of 'sort dropdown' control, to define the inital sort order.
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.DefaultSort = {};
		
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.DefaultSort
	* @static
	*/
	jQuery.fn.jplist.controls.DefaultSort.getStatus = function(isDefault, control){
		
		var data
			,status;	
						
		data = new jQuery.fn.jplist.controls.Dropdown.statusRelatedDataSort(control.$control.attr('data-path')
																			,control.$control.attr('data-type')
																			,control.$control.attr('data-order')
																			,control.$control.attr('data-datetime-format')
																			,control.$control.attr('data-ignore'));
		
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		
		return status;			
	};	
	
})(jQuery);

