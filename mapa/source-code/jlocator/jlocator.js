/**
 * @license jQuery jlocator Plugin ##VERSION## 
 * Copyright 2012-2013 Miriam Zusin. All rights reserved.
 * To use this file you must to buy a licence at http://codecanyon.net/user/no81no/portfolio 
 */
 
(function(jQuery){
	'use strict';	
	
	/**
    * jQuery Library
    * @see <a href="http://jquery.com/" title="" target="_blank">jquery.com</a>
    * @name jQuery
    * @class jQuery Library
    */
	 
	/**
    * jQuery 'fn' definition
    * @see <a href="http://jquery.com/" title="" target="_blank">jquery.com</a>
    * @name fn
    * @class jQuery Library
    * @memberOf jQuery
    */

	/**
    * jPList definition
    * @see <a href="http://jplist.no81no.com/" title="" target="_blank">jQuery jPList Plugin</a>
    * @name jQuery.fn.jplist
    * @class jQuery jPList Plugin
    */	
	
	/**
    * jPList Controls definition
    * @see <a href="http://jplist.no81no.com/html/controls.html" title="" target="_blank">jQuery jPList Plugin Controls</a>
    * @name jQuery.fn.jplist.controls
    * @class jQuery jPList Plugin Controls
    */
	 
	/** 
	* jlocator constructor 
	* @param {Object} userOptions - jlocator user options
	* @param {jQueryObject} $root - jlocator container
	* @constructor 
	*/
	var Init = function(userOptions, $root){
		
		var self = {
			options: userOptions
			,$root: $root
			,controller: null
		};
		
		//init user options
		self.options = $.extend(true, {	
					
			//map defauls
			startZoom: 2
			,storeZoom: 17
			,latitude: 0
			,longitude: 90	
			
			,geolocation: true
			,markerIcon: '' //'' for default
			,directionsType: 'DRIVING' //BICYCLING, TRANSIT, WALKING
            ,mapTypeId: 'ROADMAP' //ROADMAP, SATELLITE, HYBRID, TERRAIN
			
			//jplist options: http://jplist.no81no.com/
			,jplist: {
				
				items_box: '[data-type="stores"]' 
				,item_path: '[data-type="store"]'
				,panel_path: '[data-type="controls"]'
				,no_results: '[data-type="no-results"]'
				,redraw_callback: function(){
					
				}
				
				//panel controls
				,control_types: {
					
					'autocomplete':{
						class_name: 'Autocomplete' 
						,options: {}
					}
					
					,'autocomplete-radius':{
						class_name: 'AutocompleteRadius' 
						,options: {}
					}
					
				}
			}
			
			//if info window should be opened on store click
			,openInfoWindowOnStoreClick: false 
			
			//info window content
			,infoWindow: function(html, title, address, city, state, zipcode, country){
				return '<div class="info-window">' + html + '</div>';
			}	

			//events
			,storeClickEvent: 'storeClickEvent'
			,pinClickEvent: 'pinClickEvent'
			,sendStoreListEvent: 'sendStoreListEvent'
			,getStoresListEvent: 'getStoresListEvent'
			,setDirectionsEvent: 'setDirectionsEvent'
			
		}, userOptions);
		
		//init controller		
		self.controller = new $.fn.jlocator.controller($root, self.options);		
		
		return jQuery.extend(this, self); 
	};
	
	/** 
	* jlocator main contructor
	* @example
	* <pre>
	* $('#jlocator').jlocator();
	* </pre>
	* @param {Object} userOptions - jlocator user options
	* @name jlocator
    * @class jQuery jlocator Plugin
    * @memberOf jQuery.fn	
	* @property {jQueryObject} $root - jlocator root element
	* @property {Object} options - jlocator user options
	* @property {jQuery.fn.jlocator.controller} controller - jlocator controller
	*/
	jQuery.fn.jlocator = function(userOptions){
	
		return this.each(function(){
		
			var self;
			
			//init constructor
			self = new Init(userOptions, $(this));
			
			//save in data
			$(this).data('jlocator', self);
		});
	};
})(jQuery);