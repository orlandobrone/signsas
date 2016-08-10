/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Helper Class
	* @type {Object} 
	* @class Helper class - general helpers
	* @memberOf jQuery.fn.jplist.services
	*/
	jQuery.fn.jplist.services.Helper = {};
	
	/**
	* get outer html
	* @param {jQueryObject} el - jquery element
	* @return {string} - outer html
	*/
	jQuery.fn.jplist.services.Helper.getOuterHtml = function(el){
	
		var html = '';
		var attr = el[0].attributes;
		var inner = el.html();
		var name = el[0].tagName.toString().toLowerCase();
		
		html += '<' + name;
		
		for(var i=0; i<attr.length; i++){
		
			if(attr[i].nodeValue){
			
				html += ' ' + attr[i].nodeName + '=';
				html += '"' + attr[i].nodeValue + '"';
			}
		}
		
		html += '>';
		html += inner;
		html += '</' + name + '>';
		
		return html;
	};
	
	/**
	* replace hash in url
	* @param {string} hash
	*/
	jQuery.fn.jplist.services.Helper.replaceHash = function(hash){
	
		var hashStr = $.trim(hash.replace('#', ''))
			,href
			,index;
		
		if(hashStr === ''){
			hashStr = '#';
		}
		else{
			hashStr = '#' + hashStr;
		}
		
		if(window.location.hash !== hashStr){
		
			if('replaceState' in window.history){
				window.history.replaceState('', '', hashStr);
			}
			else{			
				index = window.location.href.indexOf('#');
				
				if(index == -1){
					href = window.location.href + hashStr;
				}
				else{
					href = window.location.href.substring(0, index) + hashStr;
				}
				
				window.location.replace(href);				
			}
		}
	};		
	
})(jQuery);

