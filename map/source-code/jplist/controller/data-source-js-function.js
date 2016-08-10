(function($){
	'use strict';
	
	/**
	* build result html
	* @param {Object} self - jplist panel 'this' object
	* @param {string} html
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var buildHtml = function(self, html, statuses){
		
		//update container html
		self.$itemsBox.html(html);
		
		//send readraw event		
		self.$jplistBox.trigger(self.options.answer_event, [statuses]);
		
		//no results found
		if(!html || $.trim(html) === ''){
			self.$noResults.removeClass('jplist-hidden');
			self.$itemsBox.addClass('jplist-hidden');
		}
		else{
			self.$noResults.addClass('jplist-hidden');
			self.$itemsBox.removeClass('jplist-hidden');
		}
		
		//redraw callback
		if($.isFunction(self.options.redraw_callback)){
			self.options.redraw_callback();
		}
	};
	
	/**
	* init events
	* @param {Object} self - jplist controller 'this' object
	*/
	var initEvents = function(self){
		
		//on ask event
		self.$jplistBox.on(self.options.ask_event, function(event, statuses){
					
			//save statuses in cookies
			if(self.options.cookies){
				jQuery.fn.jplist.services.Cookies.saveCookies(statuses, self.options.cookie_name, self.options.expiration);
			}
			
			if($.isFunction(self.options.dataSource.jsFunction.jsFunctionName)){
				
				//empty html
				self.$itemsBox.html('');
				
				//show preloader
				if(self.$preloader){
					self.$preloader.show(0);
				}
				
				//call to js function
				self.options.dataSource.jsFunction.jsFunctionName(statuses, self.options, function(html){
					
					//hide preloader
					if(self.$preloader){
						self.$preloader.hide(0);
					}
					
					//build result html
					buildHtml(self, html, statuses);		

					if(self.options.deep_linking){
						
						//if deep linking is enabled -> change url by statuses
						self.$jplistBox.trigger(self.options.change_url_deep_links_event, []);
					}
				});
			}
		});		
	};
	
	/**
	* server constructor
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {jQueryObject} $itemsBox - jplist items container
	* @param {jQueryObject} $noResults - jplist no results element
	* @param {Object} options - jplist user options
	* @return {Object} - server + this	
	* @constructor 
	*/
	var Init = function($jplistBox, $itemsBox, $noResults, options){
	
		var self = {
			options: options
			,$jplistBox: $jplistBox
			,$itemsBox: $itemsBox
			,$noResults: $noResults
			,$preloader: null
		};	
		
		//init preloader
		if(self.options.dataSource.jsFunction.preloaderPath){
			self.$preloader = self.$jplistBox.find(self.options.dataSource.jsFunction.preloaderPath);
		}
		
		//init events
		initEvents(self);
				
		return $.extend(this, self);
	};
	
	/**
	* Data source js function
	* @param {jQueryObject} $jplistBox - jplist root element
	* @param {jQueryObject} $itemsBox - jplist items container
	* @param {jQueryObject} $noResults - jplist no results element
	* @param {Object} options - jplist user options
	* @return {Object} - server
	* @constructor 
	*
    * @class JavaScript function as jplist data source (instead of HTML/DOM)
    * @memberOf jQuery.fn.jplist
	* @property {Object} options - user options
	* @property {jQueryObject} $jplistBox - jplist root element
	* @property {jQueryObject} $itemsBox - jplist items container
	* @property {jQueryObject} $noResults - jplist no results element
	* @property {jQueryObject} $preloader - jplist preloader element
	*/
	jQuery.fn.jplist.controller.dataSourceJSFunction = function($jplistBox, $itemsBox, $noResults, options){
				
		//call constructor
		return new Init($jplistBox, $itemsBox, $noResults, options);
	};
})(jQuery);