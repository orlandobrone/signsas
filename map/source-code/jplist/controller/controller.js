(function($){
	'use strict';		
		
	/**
	* build collection html
	* @param {Object} self - jplist panel 'this' object
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var buildCollectionHtml = function(self, collection, statuses){
		
		var $dataitems = collection.dataitemsToJqueryObject()
			,$dataview = collection.dataviewToJqueryObject();
		
		if($dataitems.length > 0){
			$dataitems.detach();
		}
		
		if($dataview.length > 0){
			self.$itemsBox.append($dataview);
		}		
		
		//send redraw event
		self.$jplistBox.trigger(self.options.answer_event, [statuses]);
		
		//no results found
		if(collection.dataview.length <=0){
			self.$noResults.removeClass('jplist-hidden');
			self.$itemsBox.addClass('jplist-hidden');
		}
		else{
			self.$noResults.addClass('jplist-hidden');
			self.$itemsBox.removeClass('jplist-hidden');
		}
		
		//redraw callback
		if($.isFunction(self.options.redraw_callback)){
			self.options.redraw_callback(collection, $dataview, statuses);
		}
	};
	
	/**
	* animate to top
	* @param {Object} self - jplist panel 'this' object
	*/
	var animateToTop = function(self){
		
		var offset;
		
		if(self.options.animate_to_top !== ''){
		
			//set offset
			if(self.options.animate_to_top !== 'auto'){
				offset = $(self.options.animate_to_top).offset().top;
			}
			else{
				offset = self.$jplistBox.offset().top;
			}
			
			$('html, body').animate({
				scrollTop: offset
			}, self.options.animate_to_top_duration);
		}
	};
	
	/**
	* update collection dataview: sorting
	* @param {Object} self - jplist controller 'this' object
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var updateDataviewSort = function(self, collection, statuses){
	
		var actionStatuses;
		
		//sort
		actionStatuses = jQuery.fn.jplist.services.Status.getStatusesByAction('sort', statuses);
		
		jQuery.fn.jplist.actions.Sort.doubleSort(actionStatuses, collection.dataview);		
	};
	
	/**
	* modify dataview
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {jQuery.fn.jplist.models.Status} status
	*/
	var modifyDataviewCallback = function(collection, status){
		
		collection.modifyDataview(function(dataview){		
				
			var path;
			
			//get path
			path = new jQuery.fn.jplist.models.Path(status.data.path, null); 
			
			//update dataview
			switch(status.data.filterType){
				
				case 'text':{	
					collection.dataview = jQuery.fn.jplist.actions.Filters.textFilter(
						status.data.value
						, path
						, dataview
						, status.data.ignore
					);						
				}
				break;
				
				case 'path':{
					collection.dataview = jQuery.fn.jplist.actions.Filters.pathFilter(
						path
						, dataview
					);
				}
				break;					
				
				case 'inverted_path':{
					collection.dataview = jQuery.fn.jplist.actions.Filters.invertedPathFilter(
						status.data['checked_checkboxes']
						, dataview
					);
				}
				break;
				
				case 'range':{					
					collection.dataview = jQuery.fn.jplist.actions.Filters.rangeFilter(
						path
						, dataview
						, status.data.min
						, status.data.max
						, status.data.prev
						, status.data.next
					);
				}
				break;
				
				case 'date':{
					collection.dataview = jQuery.fn.jplist.actions.Filters.dateFilter(
						status.data['year']
						, status.data['month']
						, status.data['day']
						, path, dataview
						, status.data['format']
					);
				}
				break;
				
				case 'date_range':{
					collection.dataview = jQuery.fn.jplist.actions.Filters.dateRangeFilter(
						path
						,dataview
						,status.data['format']
						,status.data['prev_year']
						,status.data['prev_month']
						,status.data['prev_day']
						,status.data['next_year']
						,status.data['next_month']
						,status.data['next_day']
					);
				}
				break;
				
				//filter by paths group - used in checkboxes group filter
				case 'pathGroup':{						
					collection.dataview = jQuery.fn.jplist.actions.Filters.pathGroupFilter(
						status.data['pathGroup']
						, dataview
					);
				}
				break;

                //filter by text group - used in checkboxes text filter
                case 'textGroup':{
                    collection.dataview = jQuery.fn.jplist.actions.Filters.textGroupFilter(
						status.data['textGroup']
                        ,status.data['logic']
                        ,status.data['path']
                        ,status.data['ignoreRegex']
						,dataview
					);
                }
                break;
				
				//autocomplete filter for jlocator
				case 'autocomplete':{	
					collection.dataview = jQuery.fn.jplist.actions.Filters.autocompleteFilter(
						status.data['latitude']
						, status.data['longitude']
						, status.data['name']
						, dataview
						, status.data['radius']
					);
				}
				break;
			}
		});
	};
	
	/**
	* update collection dataview: filtering
	* @param {Object} self - jplist controller 'this' object
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var updateDataviewFilter = function(self, collection, statuses){
	
		var actionStatuses
			,status;
		
		//get filter statuses		
		actionStatuses = jQuery.fn.jplist.services.Status.getStatusesByAction('filter', statuses);
		
		for(var i=0; i<actionStatuses.length; i++){
		
			//get status
			status = actionStatuses[i];
			
			//modify dataview
			modifyDataviewCallback(collection, status);
		}			
	};
	
	/**
	* update collection dataview: pagination
	* @param {Object} self - jplist controller 'this' object
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var updateDataviewPaging = function(self, collection, statuses){
		
		var actionStatuses
			,paging = null
			,status
			,currentPage;
		
		//get list of pagination statuses
		actionStatuses = jQuery.fn.jplist.services.Status.getStatusesByAction('paging', statuses);
		
		for(var i=0; i<actionStatuses.length; i++){
		
			//get pagination status
			status = actionStatuses[i];
			
			//init current page
			if(!status.data.currentPage){
				currentPage = 0;
			}
			else{
				currentPage = status.data.currentPage;
			}
			
			//create paging object
			paging = new jQuery.fn.jplist.actions.Pagination(currentPage, status.data.number, collection.dataview.length);
			
			//add paging object to the paging status
			actionStatuses[i].data.paging = paging;
			
			//update dataview
			collection.dataview = jQuery.fn.jplist.actions.Filters.pagerFilter(paging, collection.dataview);
		}
		
	};
	
	/**
	* update collection dataview:
	* start from dataview reset (dataview = dataitems)
	* sort databiew, filter it and apply pagination
	* then create html and animate to top if needed
	* @param {Object} self - jplist controller 'this' object
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	*/
	var updateDataview = function(self, collection, statuses){
		
		//reset dataview
		collection.resetDataview();
				
		//sorting
		updateDataviewSort(self, collection, statuses);
				
		//filtering
		updateDataviewFilter(self, collection, statuses);
				
		//pagination
		updateDataviewPaging(self, collection, statuses);
				
		//build html							
		buildCollectionHtml(self, collection, statuses);
		
		//animate to top
		animateToTop(self);
	};
		
	/**
	* init events
	* @param {Object} self - jplist controller 'this' object
	*/
	var initHtmlEvents = function(self){
		
		//on ask event
		self.$jplistBox.on(self.options.ask_event, function(event, statuses){
			
			//save statuses in cookies
			if(self.options.cookies){
				jQuery.fn.jplist.services.Cookies.saveCookies(statuses, self.options.cookie_name, self.options.expiration);
			}
			
			if(self.collection){
				
				//update dataview
				updateDataview(self, self.collection, statuses);
			}	

			if(self.options.deep_linking){
				
				//if deep linking is enabled -> change url by statuses
				self.$jplistBox.trigger(self.options.change_url_deep_links_event, []);
			}
		});		
	};
	
	/**
	* add ittems to collection
	* @param {Object} self - jplist controller 'this' object
	* @param {jQuery.fn.jplist.services.Collection} collection
	* @param {jQueryObject} $items
	* @param {number} counter
	*/
	var addItemsToCollection = function(self, collection, $items, counter){
		
		var $item;
		
		for(; counter<$items.length; counter++){
			
			//get item
			$item = $items.eq(counter);
			
			//add item to the array
			collection.addDataItem($item, self.panel.paths, counter);
			
			//setTimeout is added to improve browser performance
			/* jshint -W083 */
			if(counter + 1 < $items.length && counter % 50 === 0){
				window.setTimeout(function(){
					addItemsToCollection(self, collection, $items, counter);
				}, 0);
			}
			/* jshint +W083 */
		}		
	};
	
	/**
	* create collection of dataitems
	* @param {Object} self - jplist controller 'this' object
	* @return {jQuery.fn.jplist.services.Collection}
	*/
	var getCollection = function(self){
	
		var collection
			,$items;
		
		//create new collection
		collection = new jQuery.fn.jplist.services.Collection();				
					
		//get items inside items box
		$items = self.$itemsBox.find(self.options.item_path).detach();
		
		//add ittems to collection
		addItemsToCollection(self, collection, $items, 0);
		
		//update dataview
		collection.resetDataview();
		
		return collection;
	};
	
	/**
	* init data source
	* @param {Object} self - jplist controller 'this' object
	*/
	var initDataSource = function(self){
		
		var dataSource = self.options.dataSource;
		
		//if data source option doesn't exist -> it should be 'html'
		if(!dataSource){
			dataSource = 'html';
		}
		
		//check data source option:
		switch(self.options.dataSource.type){
		
			//html data source (dom)
			case 'html':{				
				
				//init collection
				self.collection = getCollection(self);
				
				//init events
				initHtmlEvents(self);				
			}
			break;
			
			//server side data source
			case 'server':{
				
				//init server object
				self.server = new jQuery.fn.jplist.controller.Server(self.$jplistBox, self.$itemsBox, self.$noResults, self.options);
			}
			break;
			
			//data source from js function
			case 'jsFunction':{
				
				if($.isFunction(self.options.dataSource.jsFunction.jsFunctionName)){
				
					//init data source from js function
					self.dataSourceJSFunction = new jQuery.fn.jplist.controller.dataSourceJSFunction(self.$jplistBox, self.$itemsBox, self.$noResults, self.options);
				}
			}				
			break;
		}
		
	};
		
	/**
	* controller constructor
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist user options
	* @return {Object} - controller + this	
	* @constructor 
	*/
	var Init = function($jplistBox, options){
	
		var cookiesStatuses
			,self = {
				options: options
				,$jplistBox: $jplistBox
				,$itemsBox: $jplistBox.find(options.items_box).eq(0)
				,$noResults: null
				
				,panel: null
				,collection: null
				,events: null				
				,server: null
				,dataSourceJSFunction: null
		};	
		
		//init vars
		self.events = new jQuery.fn.jplist.controller.Events(self.$jplistBox, self.options);
		self.panel = new jQuery.fn.jplist.view.Panel(self.$jplistBox, self.options, self.events);
		self.$noResults = $jplistBox.find(self.options.no_results);
		
		//init data source
		initDataSource(self);	

		//if deep links options is enabled
		if(self.options.deep_linking){
			
			//try restore panel state from query string
			self.$jplistBox.trigger(self.options.set_deep_links_event, []);
		}
		else{		
			//check cookies
			if(self.options.cookies){
				
				//restore statuses from cookies
				cookiesStatuses = jQuery.fn.jplist.services.Cookies.restoreCookies(self.options.cookie_name);
				
				//send readraw event	
				if(cookiesStatuses.length > 0){
					self.$jplistBox.trigger(self.options.restore_event, [cookiesStatuses]);
				}
				else{
					//send panel redraw event
					self.$jplistBox.trigger(self.options.force_ask_event, [true]);
				}
			}
			else{			
				//send panel redraw event
				self.$jplistBox.trigger(self.options.force_ask_event, [true]);
			}
		}		
				
		return $.extend(this, self);
	};
	
	/**
	* Controller
	* @param {jQueryObject} $jplistBox - jplist jquery element
	* @param {Object} options - jplist user options
	* @return {Object} - controller
	* @constructor 
    * @class Controller - the main controller class
    * @memberOf jQuery.fn.jplist.controller
	* @property {Object} options - user options
	* @property {jQueryElement} $jplistBox - jplist root element
	* @property {jQueryElement} $itemsBox - jplist items container
	* @property {jQueryElement} $noResults - jplist 'no results' element
	* @property {jQuery.fn.jplist.view.Panel} panel - panel object
	* @property {jQuery.fn.jplist.services.Collection} collection - collection object
	* @property {jQuery.fn.jplist.controller.Server} server - server object
	* @property {jQuery.fn.jplist.controller.dataSourceJSFunction} dataSourceJSFunction - dataSourceJSFunction object
	*/
	jQuery.fn.jplist.controller.Controller = function($jplistBox, options){
				
		//call constructor
		return new Init($jplistBox, options);
	};
})(jQuery);

