(function($){
	'use strict';
	
	/**
	* update statuses with data from server
	* @param {Object} self - jplist panel 'this' object
	* @param {Object} data - server data
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var setServerData = function(self, data, statuses){
	
		var count = 0
			,status
			,pagingStatuses
			,paging;
		
		if(data.count && $.isNumeric(data.count)){
			count = data.count;
		}
		
		//get list of pagination statuses
		pagingStatuses = jQuery.fn.jplist.services.Status.getStatusesByAction('paging', statuses);
		
		for(var i=0; i<pagingStatuses.length; i++){
		
			//get pagination status
			status = pagingStatuses[i];
			
			//init current page
			if(!status.data.currentPage){
				status.data.currentPage = 0;
			}
			
			//create paging object
			paging = new jQuery.fn.jplist.actions.Pagination(status.data.currentPage, status.data.number, count);
			
			//add paging object to the paging status
			pagingStatuses[i].data.paging = paging;			
		}
	};
	
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
						
			//hide items box
			self.$itemsBox.addClass('jplist-hidden');
			
			//hide no results section
			self.$noResults.addClass('jplist-hidden');
			
			//show preloader
			if(self.$preloader){
				self.$preloader.removeClass('jplist-hidden');
			}
			
			//save statuses in cookies
			if(self.options.cookies){
				jQuery.fn.jplist.services.Cookies.saveCookies(statuses, self.options.cookie_name, self.options.expiration);
			}
			
			if(!self.options.dataSource.server.ajax.data){
				self.options.dataSource.server.ajax.data = {};
			}
			
			//add statuses to the data array
			self.options.dataSource.server.ajax.data.statuses = encodeURIComponent(JSON.stringify(statuses));
						
			//send ajax request to the server
			$.ajax(self.options.dataSource.server.ajax).done(function(serverData){
			
				var json = {
					html: ''
				};
				
				//hide preloader
				if(self.$preloader){
					self.$preloader.addClass('jplist-hidden');
				}
				
				//show items box
				self.$itemsBox.removeClass('jplist-hidden');
				
				if(serverData){
					json = $.parseJSON(serverData);
					
					if(!json.html){
						json.html = '';
					}
					
					if(json.data){						
						setServerData(self, json.data, statuses);						
					}
					
					//build result html
					buildHtml(self, json.html, statuses);
				}
				
				//server ok callback
				if($.isFunction(self.options.dataSource.server.serverOkCallback)){
					self.options.dataSource.server.serverOkCallback(json.html, statuses);
				}
			})
			.fail(function(){
			
				//server ok callback
				if($.isFunction(self.options.dataSource.server.serverErrorCallback)){
					self.options.dataSource.server.serverErrorCallback(statuses);
				}
			});
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
		if(self.options.dataSource.server.preloaderPath){
			self.$preloader = self.$jplistBox.find(self.options.dataSource.server.preloaderPath);
		}
		
		//init events
		initEvents(self);
				
		return $.extend(this, self);
	};
	
	/**
	* Server
	* @param {jQueryObject} $jplistBox - jplist root element
	* @param {jQueryObject} $itemsBox - jplist items container
	* @param {jQueryObject} $noResults - jplist no results element
	* @param {Object} options - jplist user options
	* @return {Object} - server
	* @constructor 
	*
    * @class Server - ajax as data source (instead of HTML/DOM)
    * @memberOf jQuery.fn.jplist
	* @property {Object} options - user options
	* @property {jQueryObject} $jplistBox - jplist root element
	* @property {jQueryObject} $itemsBox - jplist items container
	* @property {jQueryObject} $noResults - jplist no results element
	*/
	jQuery.fn.jplist.controller.Server = function($jplistBox, $itemsBox, $noResults, options){
				
		//call constructor
		return new Init($jplistBox, $itemsBox, $noResults, options);
	};
})(jQuery);