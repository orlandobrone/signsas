/*global jQuery:false */
(function($){
	'use strict';		
			
	/**
	* find pathitem by path in the given dataitem (in the pathitems array)
	* @param {Object} self - jplist dataitem 'this' object
	* @param {jQuery.fn.jplist.models.Path} path - pathitem to find
	* @return {jQuery.fn.jplist.models.Pathitem}	
	* @private
	*/
	var findPathitem = function(self, path){
	
		var resultPathitem = null
			,pathitem
			,PATH_ONLY = true;		
		
		for(var i=0; i<self.pathitems.length; i++){
		
			//get value
			pathitem = self.pathitems[i];
			
			if(jQuery.fn.jplist.services.Path.isPathsEqual(pathitem.path, path, PATH_ONLY)){ //path1, path2, pathOnly
				resultPathitem = pathitem;
				break;
			}
		}
		
		return resultPathitem;
	};
	
	/**
	* get pathitems by paths 
	* @param {Object} self - jplist dataitem 'this' object
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	* @return {Array.<jQuery.fn.jplist.models.Pathitem>}
	* @private
	*/
	var getPathitems = function(self, paths){
	
		var path
			,pathitem
			,jqElement
			,pathitems = [];
		
		for(var i=0; i<paths.length; i++){
				
			//get path object
			path = paths[i];
			
			//jquery element
			jqElement = self.jqElement.find(path.jqPath);
						
			if(jqElement.length > 0){
			
				//create pathitem
				pathitem = new jQuery.fn.jplist.models.Pathitem(jqElement, path);
				
				//add to the list
				pathitems.push(pathitem);
			}
		}
		
		return pathitems;
	};
	
	/**
	* dataitem constructor
	* @param {jQueryObject} jqElement - item to add to data array
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	* @param {number} index
	* @return {Object} - dataitem + this
	* @constructor 
	*/
	var Init = function(jqElement, paths, index){
	
		var self = {
			html: null
			,pathitems: []
			,jqElement: jqElement
			,index: index
		};	
				
		//init vars
		self.html = jQuery.fn.jplist.services.Helper.getOuterHtml(jqElement);
		
		//init pathitems
		self.pathitems = getPathitems(self, paths);
		
		return $.extend(this, self);
	};
	
	//api -----------------------------------------------------------------
		
	/**
	* Find pathitem by path (in the pathitems array)
	* @param {jQuery.fn.jplist.models.Path} path - pathitem to find
	* @return {jQuery.fn.jplist.models.Pathitem}	
	* @memberOf jQuery.fn.jplist.models.Dataitem#
	* @name findPathitem
	*/
	Init.prototype.findPathitem = function(path){
		return findPathitem(this, path);
	};
	
	/**
	* dataitem - item within jplist container
	* @param {jQueryObject} jqElement - item to add to data array	
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	* @param {number} index
	* @class Dataitem - item within jplist container
	* @constructor
	* @memberOf jQuery.fn.jplist.models		
	*/
	jQuery.fn.jplist.models.Dataitem = function(jqElement, paths, index){
		
		var self;
		
		//call constructor
		self = new Init(jqElement, paths, index);
		
		//properties
		this.html = self['html'];
		this.jqElement = self['jqElement'];
		this.pathitems = self['pathitems'];
		
		//methods
		this.findPathitem = self['findPathitem'];
	};
})(jQuery);

