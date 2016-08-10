/*global jQuery:false */
(function ($) {
	'use strict';		
		
	/**
	* dataview toString
	* @param {Object} self - jplist collection 'this' object
	* @return {string}
	*/
	var dataviewToString = function(self){
	
		var dataitem
			,html = ""
			,i;
		
		for(i=0; i<self.dataview.length; i++){
		
			//get dataitem
			dataitem = self.dataview[i];
			
			//add dataitem html
			html += dataitem.html;
		}
		return html;
	};
	
	/**
	* convert dataview to jquery object
	* @return {jQueryObject}
	*/
	var dataviewToJqueryObject = function(self){
		
		return $(self.dataview).map(function(index, $element){
			return $element.jqElement.get();
		});
	};
	
	/**
	* convert dataitems to jquery object
	* @return {jQueryObject}
	*/
	var dataitemsToJqueryObject = function(self){
		
		return $(self.dataitems).map(function(index, $element){
			return $element.jqElement.get();
		});
	};
	
	/**
	* modify dataview (sort, filter etc.)
	* @param {Object} self - jplist collection 'this' object
	* @param {Function} callback
	*/
	var modifyDataview = function(self, callback){
		if($.isFunction(callback)){
			callback(self.dataview);
		}
	};
	
	/**
	* reset dataview: dataview <- dataitems
	* @param {Object} self - jplist collection 'this' object
	*/
	var resetDataview = function(self){
		self.dataview = $.merge([], self.dataitems);
	};
		
	/**
	* find dataitem by its id in dataitems array
	* @param {Object} self - jplist collection 'this' object	
	* @param {jQueryObject} item - item to add to dataitems array
	* @return {number} - index of dataitem in dataitems array, or -1 if not found
	*/
	var indexOf = function(self, item){
		
		var dataitem
			,index = -1
			,html1
			,html2;
		
		for(var i=0; i<self.dataitems.length; i++){
		
			//get dataitem
			dataitem = self.dataitems[i];
			
			//get outer html
			html1 = jQuery.fn.jplist.services.Helper.getOuterHtml(dataitem.jqElement);
			html2 = jQuery.fn.jplist.services.Helper.getOuterHtml(item);
			
			if(html1 === html2){ //dataitem.jqElement.is(item)	
				index = i;
				break;
			}
		}
		
		return index;
	};
	
	/**
	* delete dataitem from dataitems array
	* @param {Object} self - jplist collection 'this' object	
	* @param {jQueryObject} item - jquery element to delete
	*/
	var delDataitem = function(self, item){
	
		var index;
		
		index = indexOf(self, item);
		
		if(index !== -1){
			self.dataitems.splice(index, 1);
		}
		
		/*
		var dataitem
			,index;
		
		for(var i=0; i<self.dataitems.length; i++){
		
			//get dataitem
			dataitem = self.dataitems[i];
			
			//get item index
			index = indexOf(self, item); //dataitem.jqElement
						
			if(index !== -1){ //dataitem.jqElement.is(item)
				self.dataitems.splice(i, 1);
				console.log(self.dataitems);
			}
		}
		*/
	};
	
	/**
	* delete dataitem collection from dataitems array
	* @param {Object} self - jplist collection 'this' object	
	* @param {jQueryObject} items - jquery element to delete
	*/
	var delDataitems = function(self, items){
	
		items.each(function(){			
			delDataitem(self, $(this));
		});
	};
	
	/**
	* add jquery item to jplist dataitems array
	* @param {Object} self - jplist collection 'this' object
	* @param {jQueryObject} item - item to add to dataitems array
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	* @param {number} index
	*/
	var addDataItem = function(self, item, paths, index){
	
		var data_item;
			
		//create dataitem
		data_item = new jQuery.fn.jplist.models.Dataitem(item, paths, index);		
				
		//add item dataitems to array
		self.dataitems.push(data_item);
	};
	
	/**
	* add jquery item collection to jplist dataitems array
	* @param {Object} self - jplist collection 'this' object	
	* @param {jQueryObject} items - items to add to dataitems array
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	*/
	var addDataItems = function(self, items, paths){
		
		items.each(function(index){			
			addDataItem(self, $(this), paths, index);
		});
	};
	
	/**
	* empty collection
	* @param {Object} self - jplist collection 'this' object	
	*/
	var empty = function(self){
		self.dataitems = [];
		self.dataview = [];
	};
	
	/** 
	* jplist collection constructor
	* @return {Object} - jplist collection
	* @constructor 
	*/
	var Init = function(){
	
		var self = {
			dataitems: []
			,dataview: []
		};	
		
		return $.extend(this, self);
	};
	
	//api -----------------------------------------------------------------
	
	/**
	* API: convert dataview to jquery object
	* @return {jQueryObject}
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name dataviewToJqueryObject
	* @function
	*/
	Init.prototype.dataviewToJqueryObject = function(){
		return dataviewToJqueryObject(this);
	};
	
	/**
	* API: convert dataitems to jquery object
	* @return {jQueryObject}
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name dataitemsToJqueryObject
	* @function
	*/
	Init.prototype.dataitemsToJqueryObject = function(){
		return dataitemsToJqueryObject(this);
	};
	
	/**
	* API: reset dataview collection with initial dataitems set.
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name resetDataview
	* @function
	*/
	Init.prototype.resetDataview = function(){
		resetDataview(this);
	};
	
	/**
	* API: modify collection dataview with sorting, filter, pagination etc.
	* @param {Function} callback
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name modifyDataview
	* @function
	*/
	Init.prototype.modifyDataview = function(callback){
		modifyDataview(this, callback);
	};
	
	/**
	* API: empty collection
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name empty
	* @function
	*/
	Init.prototype.empty = function(){	
		empty(this);
	};
	
	/**
	* API: convetrs jQuery element (item) to dataitem and adds it to the dataitems collection
	* @param {jQueryObject} item - jquery item to add
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	* @param {number} index
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name addDataItem
	* @function
	*/
	Init.prototype.addDataItem = function(item, paths, index){	
		addDataItem(this, item, paths, index);
	};
	
	/**
	* API: convetrs a set of jQuery elements (items) to dataitems and adds them to the dataitems collection	
	* @param {jQueryObject} items - jquery items to add
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths - paths objects array
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name addDataItems
	* @function
	*/
	Init.prototype.addDataItems = function(items, paths){		
		addDataItems(this, items, paths);
	};
	
	/**
	* API: searches for jQuery element (item) in the dataitems collection and deletes it
	* @param {jQueryObject} item - jquery element (item) to delete
	* @public
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name delDataitem
	* @function
	*/
	Init.prototype.delDataitem = function(item){
		delDataitem(this, item);
	};
	
	/**
	* API: searches for jQuery elements (items) in the dataitems collection and deletes them
	* @param {jQueryObject} items - jquery element to delete
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name delDataitems
	* @function
	*/
	Init.prototype.delDataitems = function(items){
		delDataitems(this, items);
	};
	
	/**
	* API: searches for dataitem in the collection (by id)
	* @param {jQueryObject} item - jquery element to delete
	* @return {number} - index of dataitem in dataitems array
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name indexOf
	* @function
	*/
	Init.prototype.indexOf = function(item){
		return indexOf(this, item);
	};
	
	/**
	* API: get HTML of the collection in the current state (dataview): with the current filter, sorting etc.
	* @return {string}
	* @public	
	* @memberOf jQuery.fn.jplist.services.Collection#
	* @name dataviewToString
	* @function
	*/
	Init.prototype.dataviewToString = function(){	
		return dataviewToString(this);
	};
	
	/** 
	* jplist collection
	* @constructor 
	*
	* @memberOf jQuery.fn.jplist
	* @class Dataitems collection - collection of the items within jplist container 
	*/
	jQuery.fn.jplist.services.Collection = function(){
		
		var self;
		
		//call constructor
		self = new Init();
		
		//propeties
		this.dataitems = self['dataitems'];
		this.dataview = self['dataview'];
		
		//methods
		this.resetDataview = self['resetDataview'];
		this.modifyDataview = self['modifyDataview'];	
		this.addDataItem = self['addDataItem'];	
		this.addDataItems = self['addDataItems'];	
		this.empty = self['empty'];
		this.delDataitem = self['delDataitem'];	
		this.delDataitems = self['delDataitems'];	
		this.indexOf = self['indexOf'];			
		this.dataviewToString = self['dataviewToString'];	
		this.dataviewToJqueryObject = self['dataviewToJqueryObject'];
		this.dataitemsToJqueryObject = self['dataitemsToJqueryObject'];
	};
})(jQuery);

