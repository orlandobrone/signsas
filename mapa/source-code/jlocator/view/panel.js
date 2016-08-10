(function($){
	'use strict';		
	
	/**
	* enable direction label (autocomplete etc.)
	* @param {Object} self - this object
	* @param {jQueryObject} $directionLabel - directions label
	* @param {jQueryObject} $input - directions input field
	* @param {number} latitude
	* @param {number} longitude
	*/
	var enableDirectionLabel = function(self, $directionLabel, $input, latitude, longitude){
		
		var autocomplete
			,listenerHandle;
		
		//add data attribute
		$directionLabel.attr('data-enabled', 'true');
		
		if($input.length > 0){
				
			//init input autocomplete
			autocomplete = new google.maps.places.Autocomplete($input.get(0));
			autocomplete.jlocator = {
				latitude: latitude
				,longitude: longitude
			};
			
			//autocomplete listener
			listenerHandle = google.maps.event.addListener(autocomplete, 'place_changed', function(){
		
				var place
					,start
					,end
					,jlocator;
				
				//get jlocator data
				jlocator = this['jlocator'];
				
				//get choosen place
				place = autocomplete.getPlace();					
				
				if(place && place.geometry){
				
					//get points
					start = new google.maps.LatLng(jlocator['latitude'], jlocator['longitude']);
					end = new google.maps.LatLng(place.geometry.location["lat"](), place.geometry.location["lng"]());
					
					//trigger set directions event
					self.$root.trigger(self.options.setDirectionsEvent, [start, end]);					
				}
			});
		}
	};
	
	/**
	* init directions events
	* @param {Object} self - this object
	* @param {jQueryObject} $directionLabel
	*/
	var initDirectionEvents = function(self, $directionLabel){
		
		var $dataItem
			,latitude
			,longitude
			,$input
			,isVisible
			,enabled;
		
		//close all inputs
		self.$panelRoot.find('[data-type="directions-input"]').hide(0);
				
		if($directionLabel.length > 0){
			
			//get vars
			enabled = $directionLabel.attr('data-enabled');
			$dataItem = $directionLabel.parents('[data-type="store"]');
			$input = $dataItem.find('[data-type="directions-input"]');
			
			//if direcion label is not enabled -> enable it (autocomplete, its handler etc.)
			if(!enabled && $dataItem.length > 0){
				
				//get vars
				latitude = Number($dataItem.attr('data-latitude'));
				longitude = Number($dataItem.attr('data-longitude'));
				
				if(!isNaN(latitude) && !isNaN(longitude)){					
					enableDirectionLabel(self, $directionLabel, $input, latitude, longitude);
				}
			}
			
			if($input.length > 0){

				isVisible = $input.is(':visible');
				
				if(isVisible){
					$input.hide(0);
				}
				else{
					$input.show(0);
				}
			}
		}
	};
	
	/**
	* init events
	* @param {Object} self - 'this' object
	*/
	var initEvents = function(self){
		
		/**
		* store onclick
		*/
		self.$root.on('click', '[data-type="stores"] [data-type="store"]', function(){
			
			var store
				,$store;
			
			$store = $(this);
			
			//init store
			store = new jQuery.fn.jlocator.store($store, self.options);
			
			//trigger event
			self.$root.trigger(self.options.storeClickEvent, [store]);
			
			//remove active class from all current visible stores
			self.$panelRoot.find('[data-type="stores"] [data-type="store"]').removeClass('active');
			
			//add active class to the current store
			$store.addClass('active');
		});
		
		/**
		* get stores list event
		*/
		self.$root.on(self.options.getStoresListEvent, function(){
			
			//trigger send stores list event
			self.$root.trigger(self.options.sendStoreListEvent, [self.stores, getStoresView(self)]);
		});
		
		/**
		* init direction events
		*/
		self.$root.on('click', '[data-type="directions-label"]', function(){			
			initDirectionEvents(self, $(this));
		});
		
		/**
		* bind map pin click event
		*/
		self.$root.on(self.options.pinClickEvent, function(e, store){
			
			var longitude = store.longitude
				,latitude = store.latitude
				,$store
				,$stores;
				
			if($.isNumeric(longitude) && $.isNumeric(latitude)){
				
				//get all visible stores
				$stores = self.$panelRoot.find('[data-type="stores"] [data-type="store"]');
			
				//get store
				$store = $stores.filter('[data-longitude="' + longitude + '"][data-latitude="' + latitude + '"]');
				
				if($store.length > 0){
					
					$stores.removeClass('active');
					$store.addClass('active');
				}
			}
		});
	};
	
	/**
	* get stores view (current store list)
	* @param {Object} self - 'this' object
	* @return {Array.<jQuery.fn.jlocator.store>} - stores view (current store list)
	*/
	var getStoresView = function(self){
		
		var store
			,storesView = [];
		
		self.$panelRoot.find('[data-type="stores"] [data-type="store"]').each(function(){
						
			//init store
			store = new jQuery.fn.jlocator.store($(this), self.options);
			
			storesView.push(store);
		});
		
		return storesView;
	};
	
	/**
	* init full stores list
	* @param {Object} self - 'this' object
	* @return {Array.<jQuery.fn.jlocator.store>} - full stores list
	*/
	var initStoresList = function(self){
		
		var store
			,stores = [];
		
		self.$stores.each(function(){
						
			//init store
			store = new jQuery.fn.jlocator.store($(this), self.options);
			
			stores.push(store);
		});
		
		return stores;
	};
	
	/**
	* init jplist plugin: http://jplist.no81no.com/
	* @param {Object} self - 'this' object
	* @param {jQueryObject} $root - jlocator root element
	*/
	var initJPlist = function(self, $root){
		
		var saveCallback = self.options.jplist.redraw_callback;
		
		if($root.length > 0){
		
			self.options.jplist.redraw_callback = function(){
				
				if($.isFunction(saveCallback)){
					saveCallback();
					
					//trigger send stores list event
					self.$root.trigger(self.options.sendStoreListEvent, [self.stores, getStoresView(self)]);
				}
			};
			
			$root.jplist(self.options.jplist);
		}
	};
	
	/**
	* panel constructor
	* @param {jQueryObject} $root - jlocator root element
	* @param {Object} options - jlocator user options
	* @return {Object} - panel + this	
	* @constructor 
	*/
	var Init = function($root, options){
	
		var self = {
			$root: $root
			,options: options
			,stores: []
			
			//elements
			,$panelRoot: $root.find('[data-type="panel"]')
			,$stores: null
		};	

		//init vars
		self.$stores = self.$panelRoot.find('[data-type="stores"] [data-type="store"]');
		
		//init store list
		self.stores = initStoresList(self);
		
		//init jplist plugin
		initJPlist(self, self.$root);
				
		return $.extend(this, self);
	};
	
	/**
	* panel constructor
	* @param {jQueryObject} $root - jlocator root element
	* @param {Object} options - jlocator user options
	* @return {Object} - panel
	* @constructor 
	* @name panel
    * @class Controller
    * @memberOf jQuery.fn.jlocator
	* @property {jQueryObject} $root - jlocator root element
	* @property {Object} options - jlocator user options
	* @property {Array.<jQuery.fn.jlocator.store>} stores - jlocator stores array
	* @property {jQueryObject} $panelRoot - panel root element
	* @property {jQueryObject} $stores - stores list as jquery element
	*/
	jQuery.fn.jlocator.panel = function($root, options){
				
		//call constructor
		var self = new Init($root, options);	

		//init events
		initEvents(self);
		
		return self;
	};
})(jQuery);

