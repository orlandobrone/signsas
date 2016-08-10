/*global jQuery:false */
(function($){
	'use strict';		

	/**
	* render control html
	* @param {Object} self - jplist panel control type 'this' object
	*/
	var render = function(self){
		
		var render;
		
		if(self.controlTypeClass){	
			
			//get render method
			render = self.controlTypeClass['render'];
			
			if(render && $.isFunction(render)){
							
				//render html
				render(self);
			}
		}
	};
	
	/**
	* get control deep link	
	* @param {Object} self - jplist panel control type 'this' object
	* @return {string} deep link
	*/
	var getDeepLink = function(self){
		
		var getDeepLinkFunc
			,deepLink = '';
		
		if(self.controlTypeClass){	
			
			//get getStatusByDeepLink method
			getDeepLinkFunc = self.controlTypeClass['getDeepLink'];
			
			if(getDeepLinkFunc && $.isFunction(getDeepLinkFunc)){
						
				//call function
				deepLink = getDeepLinkFunc(self);
			}
		}
		
		return deepLink;
	};
	
	/**
	* set control deep link	
	* @param {Object} self - jplist panel control type 'this' object
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	*/
	var getStatusByDeepLink = function(self, propName, propValue){
		
		var getStatusByDeepLinkFunc
			,status = null;
		
		if(self.controlTypeClass){	
			
			//get getStatusByDeepLink method
			getStatusByDeepLinkFunc = self.controlTypeClass['getStatusByDeepLink'];
			
			if(getStatusByDeepLinkFunc && $.isFunction(getStatusByDeepLinkFunc)){
						
				//get updated status from control's 'getStatusByDeepLink' function
				status = getStatusByDeepLinkFunc(self, propName, propValue);
			}
		}
		
		return status;
	};
	
	/**
	* get all paths
	* @param {Object} self - jplist panel conrtol 'this' object
	* @return {Array.<jQuery.fn.jplist.models.Path>}
	*/
	var getPaths = function(self){
	
		var paths = []
			,getPaths;
			
		if(self.controlTypeClass){
			
			//get getPaths method
			getPaths = self.controlTypeClass['getPaths'];
			
			if(getPaths && $.isFunction(getPaths)){
							
				//getPaths
				getPaths(self, paths);
			}
		}
				
		return paths;
	};
	
	/**
	* get current status
	* @param {Object} self - jplist panel conrtol 'this' object
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @return {jQuery.fn.jplist.models.Status}
	*/
	var getStatus = function(self, isDefault){
	
		var status = null
			,getStatus;
		
		if(self.controlTypeClass){
			
			//get getStatus method
			getStatus = self.controlTypeClass['getStatus'];
			
			if(getStatus && $.isFunction(getStatus)){
							
				//getStatus
				status = getStatus(isDefault, self);
			}
		}
				
		return status;
	};
	
	/**
	* set status to control
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {boolean} isCookie - is status restored from cookies
	*/
	var setStatus = function(self, status, isCookie){
	
		var setStatus;
		
		if(status.action === self.action && status.name === self.name){//status.type == self.type 
		  
		   if(self.controlTypeClass){
				
				//get setStatus method
				setStatus = self.controlTypeClass['setStatus'];
				
				if(setStatus && $.isFunction(setStatus)){
						
					//setStatus
					setStatus(status, self, isCookie);
				}
			}
		 }
	};
	
	/**
	* init events
	* @param {Object} self - jplist panel control type 'this' object
	*/
	var initEvents = function(self){
	
		var initEvents;
		
		if(self.controlTypeClass){
			
			//get initEvents method
			initEvents = self.controlTypeClass['initEvents'];
			
			if(initEvents && $.isFunction(initEvents)){
							
				//initEvents
				initEvents(self);
			}
		}	 
	};
	
	/**
	* Panel control constructor	
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist options
	* @param {jQueryObject} $control - jquery object
	* @param {jQuery.fn.jplist.controller.Events} events
	* @return {Object} - panel control control + this
	* @constructor 
	*/
	var Init = function($jplistBox, options, $control, events){
		
		var self = {			
			$jplistBox: $jplistBox
			,options: options			
			,$control: $control
			,events: events
			
			,type: null
			,action: null
			,name: null
			,cookies: true //by default control is stored in cookies (if cookies are enabled)
			
			,controlType: null
			,controlTypeClass: null
			,controlTypeOptions: null
		}
		,temp;
		
		//set controls properties
		self.type = $control.attr('data-control-type');
		self.action = $control.attr('data-control-action');
		self.name = $control.attr('data-control-name');
		
		//by default control is stored in cookies (if cookies are enabled)
		//if data-control-cookies="false" - control is excluded from cookies
		temp = $control.attr('data-control-cookies');
		if(temp && temp.toString() === 'false'){
			self.cookies = false;
		}
		
		//init control vars
		self.controlType = self.options.control_types[self.type];
		
		if(self.controlType){
		
			//get control type class
			if(self.controlType['class_name']){
				self.controlTypeClass = jQuery.fn.jplist.controls[self.controlType['class_name']];
			}
			
			//get options
			if(self.controlType['options']){
				self.controlTypeOptions = self.controlType['options'];
			}
		}
		
		//render control html
		render(self);
		
		return $.extend(this, self);
	};
	
	/**
	* API: render control html	
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name render
	* @function
	*/
	Init.prototype.render = function(){
		render(this);
	};
	
	/**
	* API: set control status by deep link
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name getStatusByDeepLink
	* @function
	*/
	Init.prototype.getStatusByDeepLink = function(propName, propValue){
		return getStatusByDeepLink(this, propName, propValue);
	};
	
	/**
	* API: get deep link from control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name getDeepLink
	* @function
	*/
	Init.prototype.getDeepLink = function(){
		return getDeepLink(this);
	};
	
	/**
	* API: get all paths
	* @return {Array.<jQuery.fn.jplist.models.Path>}
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name getPaths
	* @function
	*/
	Init.prototype.getPaths = function(){
		return getPaths(this);
	};
	
	/**
	* API: get current status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @return {jQuery.fn.jplist.models.Status}	
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name getStatus
	* @function
	*/
	Init.prototype.getStatus = function(isDefault){
		return getStatus(this, isDefault);
	};
	
	/**
	* API: set status to control
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name setStatus
	* @function
	*/
	Init.prototype.setStatus = function(status, isCookie){
		setStatus(this, status, isCookie);
	};
	
	/**
	* API: init controls events	
	* @memberOf jQuery.fn.jplist.view.PanelControl#
	* @public	
	* @name initEvents
	* @function
	*/
	Init.prototype.initEvents = function(){
		initEvents(this);
	};
	
	/**
	* panel control 
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist options
	* @param {jQueryObject} $control	
	* @param {jQuery.fn.jplist.controller.Events} events
	* @constructor 
	* @memberOf jQuery.fn.jplist.view.PanelControl
	*
    * @class Panel control - representation of any control on the panel
    * @memberOf jQuery.fn.jplist.view
	*
	* @property {Object} options - user options	
	* @property {jQueryObject} $jplistBox - jplist root element
	* @property {jQueryObject} $control - control jquery element
	* @property {jQuery.fn.jplist.controller.Events} events
	*
	* @property {string} name - control name
	* @property {string} type - control type
	* @property {string} action - control action
	* @property {string} cookies - control cookies
	*
	* @property {string} controlType - control type object
	* @property {string} controlTypeClass - control class
	* @property {string} controlTypeOptions - control options
	*/
	jQuery.fn.jplist.view.PanelControl = function($jplistBox, options, $control, events){
		
		var self;
		
		//init contructor
		self = new Init($jplistBox, options, $control, events);
		
		//init events
		initEvents(self);
		
		//properties
		this.options = self['options'];
		this.$jplistBox = self['$jplistBox'];
		this.$control = self['$control'];
		this.events = self['events'];
		
		//control properties
		this.type = self['type'];
		this.action = self['action'];
		this.name = self['name'];	
		this.cookies = self['cookies'];
		
		//control additional properties
		this.controlType = self['controlType'];
		this.controlTypeClass = self['controlTypeClass'];
		this.controlTypeOptions = self['controlTypeOptions'];
		
		//methods
		this.render = self['render'];
		this.getPaths = self['getPaths'];
		this.getStatus = self['getStatus'];
		this.setStatus = self['setStatus'];
		this.initEvents = self['initEvents'];
		this.getStatusByDeepLink = self['getStatusByDeepLink'];
		this.getDeepLink = self['getDeepLink'];
	};
	
})(jQuery);

