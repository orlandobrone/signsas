/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Path Service
	* @type {Object} 
	* @class Services for the path object (path inside dataitem, defined by data-path and data-type attributes within controls)
	* @memberOf jQuery.fn.jplist.services
	*/
	jQuery.fn.jplist.services.Path = {};	
	
	/**
	* Path datatype enum
	* @enum {string}
	
	jQuery.fn.jplist.services.Path.DATA_TYPE = {
		TEXT: 'text'
		,NUMBER: 'number'
		,DATETIME: 'datetime'
	};	
	*/
	
	/**
	* Is given path is in the given paths list (compare by jquery path only, data type is ignored)
	* @param {jQuery.fn.jplist.models.Path} path
	* @param {Array.<jQuery.fn.jplist.models.Path>} pathsList
	* @return {boolean}
	* @memberOf jQuery.fn.jplist.services.Path
	*/
	jQuery.fn.jplist.services.Path.isPathInList = function(path, pathsList){
	
		var cpath
			,isInList = false
			,PATH_ONLY = true;
		
		for(var i=0; i<pathsList.length; i++){
		
			//get path
			cpath = pathsList[i];
			
			if(jQuery.fn.jplist.services.Path.isPathsEqual(path, cpath, PATH_ONLY)){
				isInList = true;
				break;
			}
		}
		
		return isInList;
	};
	
	/**
	* Is 2 paths are equal
	* @param {jQuery.fn.jplist.models.Path} path1
	* @param {jQuery.fn.jplist.models.Path} path2
	* @param {boolean} pathOnly - compare only by data-path
	* @return {boolean}
	* @memberOf jQuery.fn.jplist.services.Path
	*/
	jQuery.fn.jplist.services.Path.isPathsEqual = function(path1, path2, pathOnly){
	
		var isEqual = false;
		
		if(pathOnly){
			if(path1.jqPath === path2.jqPath){				
				isEqual = true;
			}
		}
		else{
			if((path1.jqPath === path2.jqPath) && (path1.dataType === path2.dataType)){				
				isEqual = true;
			}
		}		
		
		return isEqual;
	};
	
	
})(jQuery);

