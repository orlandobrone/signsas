(function($){
	'use strict';	
	
	/**
	* constructor
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist user options
	* @return {Object} - 'events' + this	
	* @constructor 
	*/
	var Init = function($jplistBox, options){
	
		var self = {
			options: options
			,$jplistBox: $jplistBox
			,lastStatus: null
		};	
				
		return $.extend(this, self);
	};
	
	/**
	* Events
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist user options
	* @return {Object} - events
	* @constructor 
	* @class Events - jplist events helper
	* @memberOf jQuery.fn.jplist.controller
	* @property {Object} lastStatus - last status caused html rebuild
	*/
	jQuery.fn.jplist.controller.Events = function($jplistBox, options){
				
		//call constructor
		return new Init($jplistBox, options);
	};
})(jQuery);
	