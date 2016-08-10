/*global jQuery:false */
(function($){
	'use strict';		
	
	
	
	/**
	* path inside dataitem: defined by data-path and data-type attributes within controls
	* @param {?string} jqPath - jquery path
	* @param {?string} dataType - data type of the content in this path - text, number, datetime
	*
	* @class Path - path inside dataitem: defined by data-path and data-type attributes within controls
	* @memberOf jQuery.fn.jplist.models	
	* @constructor 
	*
	* @property {?string} jqPath - jquery path
	* @property {?string} dataType - data type of the content in this path - text, number, datetime
	*/
	jQuery.fn.jplist.models.Path = function(jqPath, dataType){		
	
		//properties
		this.jqPath = jqPath;
		this.dataType = dataType; //string, number, datetime
	};
})(jQuery);

