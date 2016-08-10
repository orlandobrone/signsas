/*global jQuery:false */
(function($){
	'use strict';		
	
	/**
	* path inside dataitem: found by jQuery.fn.jplist.models.Path definition
	* @param {jQueryObject} jqElement - jquery element
	* @param {jQuery.fn.jplist.models.Path} path - path object	
	* @constructor 
	*
	* @class Pathitem - path inside dataitem: found by jQuery.fn.jplist.models.Path definition
	* @memberOf jQuery.fn.jplist.models
	*
	* @property {jQuery.fn.jplist.models.Path} path - path object	
	* @property {string} text - path item text
	* @property {string} html - path item html
	*/
	jQuery.fn.jplist.models.Pathitem = function(jqElement, path){
	
		//properties
		this.path = path;
		this.text = jqElement.text();
		this.html = jqElement.html();
	};
})(jQuery);

