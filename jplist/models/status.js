(function($){
	'use strict';		
			
	/**
	* Status
	* @param {?string} name
	* @param {?string} action
	* @param {?string} type
	* @param {Object} data
	* @param {boolean} cookies
	* @constructor 
	*
	* @class Status - jplist control status data
	* @memberOf jQuery.fn.jplist.models
	*
	* @property {string} name - control name
	* @property {string} type - control type
	* @property {string} action - control action
	* @property {Object} data - related data
	* @property {boolean} cookies - if store control in cookies
	*/
	jQuery.fn.jplist.models.Status = function(name, action, type, data, cookies){
			
		this.action = action; //filter, sort, paging			
		this.name = name;
		this.type = type; //drop-down, placeholder, textbox
		this.data = data; //related data
		this.cookies = cookies;
	};
})(jQuery);

