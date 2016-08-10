/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Status Service
	* @type {Object} 
	* @class Services for control status object
	* @memberOf jQuery.fn.jplist.services
	*/
	jQuery.fn.jplist.services.Status = {};	
		
	/**
	* Find status by the given field in the statuses array (comparison is not deep, can't compare data object)
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {string} field - status field name
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	* @return {number} - index of the status in the status list, or -1 if not found
	* @memberOf jQuery.fn.jplist.services.Status
	*/
	jQuery.fn.jplist.services.Status.findStatusByField = function(status, field, statuses){
	
		var index = -1
			,cstatus;
		
		for(var i=0; i<statuses.length; i++){
		
			//get dataitem
			cstatus = statuses[i];
			
			if(cstatus[field] === status[field]){
				index = i;
				break;
			}
		}
		
		return index;
	};
	
	/**
	* Get statuses by action
	* @param {string} action
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	* @return {Array.<jQuery.fn.jplist.models.Status>} 
	* @memberOf jQuery.fn.jplist.services.Status
	*/
	jQuery.fn.jplist.services.Status.getStatusesByAction = function(action, statuses){
		
		var resultStatuses = []
			,status;
		
		for(var i=0; i<statuses.length; i++){
		
			//get status
			status = statuses[i];
			
			if(status.action === action){
				resultStatuses.push(status);
			}
		}
		
		return resultStatuses;
	};
	
})(jQuery);

