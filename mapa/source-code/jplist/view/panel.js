(function($){
	'use strict';
	
	/**
	* get panel controls
	* @param {Object} self - jplist panel 'this' object
	* @param {jQueryObject} $controls
	* @return {Array.<jQuery.fn.jplist.view.PanelControl>}
	*/
	var getPanelControls = function(self, $controls){
	
		var $control
			,control
			,controls = [];
		
		for(var i=0; i<$controls.length; i++){
		
			//get jquery control
			$control = $controls.eq(i);
			
			//create new control
			control = new jQuery.fn.jplist.view.PanelControl(self.$jplistBox, self.options, $control, self.events);
			
			//add to the list
			controls.push(control);
		}
		
		return controls;
	};
	
	/**
	* set controls statuses by deep link params
	* @param {Object} self - jplist panel 'this' object
	* @param {Array.<Object>} params - array of params {controlName: '...', propName: '...', propValue: '...'}
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	*/
	var setDeepLinks = function(self, params, controls){
		
		var param
			,controlsWithSameName
			,control
			,status
			,newStatuses = []
			,oldStatuses
			,isDefault = false
			,i;
		
		for(i=0; i<params.length; i++){
			
			//get param
			param = params[i];
			
			//get all controls with the given name
			controlsWithSameName = jQuery.fn.jplist.services.Panel.findControlsByName(controls, param.controlName);
			
			for(var j=0; j<controlsWithSameName.length; j++){
				
				//get control
				control = controlsWithSameName[j];
				
				//set key-value pair
				status = control.getStatusByDeepLink(param.propName, param.propValue);
				
				if(status){
					newStatuses.push(status);
				}
			}
		}
				
		//get current statuses
		oldStatuses = jQuery.fn.jplist.services.Panel.getStatuses(self.controls, isDefault);
				
		for(i=0; i<newStatuses.length; i++){			
			jQuery.fn.jplist.services.Panel.mergeWithStatus(oldStatuses, newStatuses[i]);
		}
		
		//send ask event
		self.$jplistBox.trigger(self.options.ask_event, [oldStatuses]);
	};
	
	/**
	* get params from deep link url
	* @param {Object} self - jplist panel 'this' object
	* @param {string} hash - for example: paging-number=5~~sort-path~type~order=.title~text~asc~~paging-currentPage=1
	* @return {Array.<Object>} array of params {controlName: '...', propName: '...', propValue: '...'}
	*/
	var getParamsFromDeepLinkUrl = function(self, hash){
		
		var sections = []
			,section
			,params = []
			,param
			,pairSections
			,keySections
			,key
			,value;
		
		if(self.options.deep_linking && $.trim(hash) !== ''){
			
			//get sections
			sections = hash.split('~~');
			
			for(var i=0; i<sections.length; i++){
				
				//get section
				section = sections[i];
				
				//get pair: key + value
				pairSections = section.split('=');
				
				if(pairSections.length === 2){
					
					//get pair
					key = pairSections[0];
					value = pairSections[1];
					
					//get key sections
					keySections = key.split('--');
					
					if(keySections.length === 2){
						
						param = {
							controlName: keySections[0]
							,propName: keySections[1]
							,propValue: value
						};
						
						params.push(param);
					}
				}
			}
		}
	
		return params;
	};
	
	/**
	* get deep links url from controls
	* @param {Object} self - jplist panel 'this' object
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	* @return {string} url
	*/
	var getDeepLinksUrl = function(self, controls){
	
		var control
			,url = ''
			,deepLinksArr = []
			,deepLink = '';
		
		for(var i=0; i<controls.length; i++){
			
			//get control
			control = controls[i];
			
			//get deep link
			deepLink = $.trim(control.getDeepLink());
			
			//add it to the list
			if((deepLink !== '') && ($.inArray(deepLink, deepLinksArr) === -1)){
				deepLinksArr.push(deepLink);
			}
		}
		
		//init deep links url
		url = deepLinksArr.join('~~');
		
		return url;
	};
	
	/**
	* set sticky position
	* @param {jQueryObject} $stickyEl - sticky element on the panel
	*/
	var setStickyPosition = function($stickyEl){
		
		var scrollTop = $(window).scrollTop()
			,top;
		
		//get top value
		top = Number($stickyEl.data('top'));
		
		if(!isNaN(top)){
		
			if (scrollTop > top){ 
				$stickyEl.addClass('jplist-sticky');
			}
			else{
				$stickyEl.removeClass('jplist-sticky');
			}
		}
	};
	
	/**
	* init sticky elements
	* @param {jQueryObject} $sticky - sticky elements on the panel
	*/
	var initSticky = function(self, $sticky){
			
		$sticky.each(function(){
			
			var $stickyEl = $(this)
				,top = $stickyEl.offset().top;
			
			//save top value
			$stickyEl.data('top', top);
			
			//set position first time
			setStickyPosition($stickyEl);
		});
		
		$(window).scroll(function(){
			
			$sticky.each(function(){
							
				//set position first time
				setStickyPosition( $(this));
			});
		});
	};
	
	/**
	* init events
	* @param {Object} self - jplist panel 'this' object
	*/
	var initEvents = function(self){
		
		var control
			,NOT_RESTORED_FROM_COOKIES = false
			,RESTORED_FROM_COOKIES = true;
		
		//init events for every control in the panel
		for(var i=0; i<self.controls.length; i++){
		
			//get control type
			control = self.controls[i];
			
			//init control events
			control.initEvents();			
		}
		
		//event from controller to panel after html rebuild
		self.$jplistBox.on(self.options.answer_event, function(event, statusesArray){
			
			//set statuses
			jQuery.fn.jplist.services.Panel.setStatuses(self.controls, statusesArray, NOT_RESTORED_FROM_COOKIES);
		});
		
		//event to panel -> panel sends ask event
		self.$jplistBox.on(self.options.force_ask_event, function(event, isDefault){
		
			var statuses;
			
			//get current statuses
			statuses = jQuery.fn.jplist.services.Panel.getStatuses(self.controls, isDefault);
			
			//trigger ask event
			self.$jplistBox.trigger(self.options.ask_event, [statuses]);
		});		
		
		//event to panel -> restore panel from event data (statuses array)
		self.$jplistBox.on(self.options.restore_event, function(event, statusesArray){
			
			//restore drop downs
			jQuery.fn.jplist.services.Panel.setStatuses(self.controls, statusesArray, RESTORED_FROM_COOKIES);
			
			//ask event
			self.$jplistBox.trigger(self.options.ask_event, [statusesArray]);
		});	
		
		//event to panel -> get all statuses and merge them with the given status, then send ask event
		self.$jplistBox.on(self.options.status_event, function(event, status){			
			
			var statuses
				,isDefault = false;
						
			//get current statuses
			statuses = jQuery.fn.jplist.services.Panel.getStatuses(self.controls, isDefault);
			
			//merge
			statuses = jQuery.fn.jplist.services.Panel.mergeWithStatus(statuses, status);
			
			//send ask event
			self.$jplistBox.trigger(self.options.ask_event, [statuses]);
		});
		
		//event to panel -> get deep links from all panel controls
		self.$jplistBox.on(self.options.change_url_deep_links_event, function(event){	
		
			var deepLinkUrl = '';
			
			if(self.options.deep_linking){
				
				//get deep link url
				deepLinkUrl = getDeepLinksUrl(self, self.controls);
				
				//set new hash
				//window.location.hash = deepLinkUrl;
				jQuery.fn.jplist.services.Helper.replaceHash(deepLinkUrl);
			}
		});
		
		//event to panel -> set panel controls statuses by their deep links
		self.$jplistBox.on(self.options.set_deep_links_event, function(event){	
			
			var hash = $.trim(window.location.hash.replace('#', ''))
				,params;
			
			//set deep links
			params = getParamsFromDeepLinkUrl(self, hash);
			
			if(params.length <= 0){
				
				//send panel redraw event
				self.$jplistBox.trigger(self.options.force_ask_event, [true]);
			}
			else{				
				setDeepLinks(self, params, self.controls);				
			}			
		});
		
		/**
		* bind rebuild panel event
		* @param {Object} event
		* @param {Function} callback
		*/
		self.$jplistBox.on(self.options.rebuild_panel_event, function(event, callback){
			
			//init panel controls
			self.$controls = self.$panel.find('[data-control-type]');			
			self.controls = getPanelControls(self, self.$controls);
			
			//get panel paths
			self.paths = jQuery.fn.jplist.services.Panel.getPaths(self.controls);
			
			//init events for every control in the panel
			for(var i=0; i<self.controls.length; i++){
			
				//get control type
				control = self.controls[i];
				
				//init control events
				control.initEvents();			
			}
			
			if($.isFunction(callback)){
				callback(self.$controls, self.controls, self.paths);
			}
		});		
	};
	
	/**
	* panel constructor
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist options
	* @param {jQuery.fn.jplist.controller.Events} events
	* @return {Object} - panel + this
	* @constructor 
	*/
	var Init = function($jplistBox, options, events){
	
		var self = {
			options: options	//user options	
			,$jplistBox: $jplistBox //jplist container
			,$panel: $jplistBox.find(options.panel_path) //panel jquery element		
			,$controls: null //jquery controls
			,$sticky: null
			,events: events
					
			,paths: [] //all paths	
			,controls: [] //panel controls
		};			
		
		//init panel controls
		self.$controls = self.$panel.find('[data-control-type]');			
		self.controls = getPanelControls(self, self.$controls);
		
		//get panel paths
		self.paths = jQuery.fn.jplist.services.Panel.getPaths(self.controls);
		
		//find sticky elements
		self.$sticky = self.$jplistBox.find('[data-sticky="true"]');
		
		//init sticky
		if(self.$sticky.length > 0){
			initSticky(self, self.$sticky);
		}
		
		//init events
		initEvents(self);
		
		return $.extend(this, self);
	};
	
	/**
	* Panel constructor
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist options
	* @param {jQuery.fn.jplist.controller.Events} events
	* @constructor 
    * @class Panel class - representation of jplist panel object
    * @memberOf jQuery.fn.jplist
	*
	* @property {Object} options - user options	
	* @property {jQueryObject} $jplistBox - jplist root element
	* @property {jQueryObject} $panel - panel jquery element
	* @property {jQueryObject} $sticky - sticky elements on the panel
	* @property {jQuery.fn.jplist.controller.Events} events
	* @property {jQueryObject} $controls - jquery controls list
	* @property {Array.<jQuery.fn.jplist.models.Path>} paths - all controls paths
	* @property {Array.<jQuery.fn.jplist.view.PanelControl>} paths - all controls
	*/
	jQuery.fn.jplist.view.Panel = function($jplistBox, options, events){
	
		var self;	

		//call constructor
		self = new Init($jplistBox, options, events);
		
		//properties
		this.paths = self['paths'];
		this.controls = self['controls'];
	};
})(jQuery);