(function($){
	'use strict';		
		
	/**
	* controller constructor
	* @param {jQueryObject} $root - jlocator root element
	* @param {Object} options - jlocator user options
	* @return {Object} - controller + this	
	* @constructor 
	*/
	var Init = function($root, options){
	
		var self = {
			$root: $root
			,options: options
			
			//objects
			,panel: null
			,map: null
		};
		
		//init objects
		self.panel = new jQuery.fn.jlocator.panel(self.$root, self.options);
		self.map = new jQuery.fn.jlocator.map(self.$root, self.options);
				
		return $.extend(this, self);
	};
	
	/**
	* controller constructor
	* @param {jQueryObject} $root - jlocator root element
	* @param {Object} options - jlocator user options
	* @return {Object} - controller
	* @constructor 
	* @name controller
    * @class Controller
    * @memberOf jQuery.fn.jlocator
	* @property {jQueryObject} $root - jlocator root element
	* @property {Object} options - jlocator user options
	* @property {jQuery.fn.jlocator.panel} panel - jlocator panel
	* @property {jQuery.fn.jlocator.map} map - jlocator map
	*/
	jQuery.fn.jlocator.controller = function($root, options){
				
		//call constructor
		return new Init($root, options);	
	};
})(jQuery);

