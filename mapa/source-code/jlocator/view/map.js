(function($){
	'use strict';		
	
	/**
	* set directions
	* @param {Object} self - this object
	* @param {Object|string} start
	* @param {Object|string} end
	*/
	var setDirections = function(self, start, end){
	
		var request;
		
		//init request
		request = {
            origin:start
            ,destination:end
            ,travelMode: google.maps['DirectionsTravelMode'][self.options.directionsType]
        };
		
		self.directionsService['route'](request, function(response, status){
			
			if(status == google.maps['DirectionsStatus']['OK']){
				self.directionsDisplay['setDirections'](response);
			}
        });
	};
	
	/**
	* close all info windows
	* @param {Object} self - this object
	*/
	var closeAllInfoWindows = function(self){
	
		var cmarker;
		
		//close all opened info windows
		for(var i=0; i<self.markers.length; i++){
		
			//marker
			cmarker = self.markers[i];
			
			if(cmarker.infowindow){
				cmarker.infowindow.close();
			}
		}
	};
	
	/**
	* open info window
	* @param {Object} self - this object
	* @param {Object} marker
	*/
	var openInfoWindow = function(self, marker){
	
		//close all info windows
		closeAllInfoWindows(self);
		
		//open current info window
		marker.infowindow.open(self.mapCanvas, marker);
	};
	
	/**
	* clear markers
	* @param {Object} self - this object
	*/
	var clearMarkers = function(self){
		
		var marker;
		
		for(var i=0; i<self.markers.length; i++){
		
			//get marker
			marker = self.markers[i];
			
			//clear marker
			marker.setMap(null);
		}
		
		//empty markers
		self.markers = [];
	};
	
	/**
	* find marker by store
	* @param {Object} self - this object
	* @param {jQuery.fn.jlocator.store} store
	* @return {Object|null} marker
	*/
	var findMarker = function(self, store){
		
		var marker
			,markerStore;
		
		for(var i=0; i<self.markers.length; i++){
			
			//get marker
			marker = self.markers[i];
			
			//get marker store
			markerStore = marker['store'];
			
			if(markerStore && 
				markerStore.latitude === store.latitude &&
				markerStore.longitude === store.longitude){
				
				return marker;
			}
		}
		
		return null;
	};
	
	/**
	* set markers
	* @param {Object} self - this object
	* @param {jQuery.fn.jlocator.store} store
	*/
	var setMarker = function(self, store){
		
		var infowindow
			,marker
			,markerSettings;
		
		//init info window
		infowindow = new google.maps.InfoWindow();
		
		//set info window html
		if($.isFunction(self.options.infoWindow)){
			infowindow.setContent(self.options.infoWindow(store['html'], store.title, store.address, store.city, store.state, store.zipcode, store.country));
		}
		
		//init marker settings
		markerSettings = {
			position: store.latlng
			,map: self.mapCanvas
			,title: 'Click to zoom'
		};
		
		//marker icon
		if(store.customMarkerIcon !== ''){
			markerSettings.icon = store.customMarkerIcon;
		}
		else{
			if(self.options.markerIcon !== ''){
				markerSettings.icon = self.options.markerIcon;
			}
		}
		
		//create marker
		marker = new google.maps.Marker(markerSettings);
		
		$.extend(marker,{
			infowindow: infowindow
			,store: store
		});	
		
		//add marker to the markers list
		self.markers.push(marker);
		
		google.maps.event.addListener(marker, 'click', function(e){			
			
			//open popup
			openInfoWindow(self, this);
			
			//trigger event
			self.$root.trigger(self.options.pinClickEvent, [store]);
		});
	};
	
	/**
	* set markers
	* @param {Object} self - this object
	* @param {Array.<jQuery.fn.jlocator.store>} stores
	*/
	var setMarkers = function(self, stores){	
		
		var store;
		
		//clear markers
		clearMarkers(self);
		
		for(var i=0; i<stores.length; i++){
		
			//get store
			store = stores[i];
			
			//set marker
			setMarker(self, store);
		}
	};
	
	/**
	* jump
	* @param {Object} self - this object
	* @param {google.maps.LatLng} latlng
	* @param {number} zoom
	*/
	var jump = function(self, latlng, zoom){	
		self.mapCanvas.setCenter(latlng);
		self.mapCanvas.setZoom(zoom);
	};	
	
	/**
	* init geolocation
	* @param {Object} self - this object
	*/	
	var initGeolocation = function(self){
	
		var latitude
			,longitude
			,latlng;
		
		if(self.options.geolocation && navigator.geolocation){
		
			navigator.geolocation.getCurrentPosition(function(position){
				
				latitude = position.coords.latitude;
				longitude = position.coords.longitude;	
				latlng = new google.maps.LatLng(latitude, longitude);
				
				//jump to map
				jump(self, latlng, self.options.storeZoom);	
			});
		}
	};
	
	/**
	* init events
	* @param {Object} self - 'this' object
	*/
	var initEvents = function(self){
		
		/**
		* bind store click event
		*/
		self.$root.on(self.options.storeClickEvent, function(e, store){
			
			var marker;
			
			if(store){
			
				//close all info windows
				closeAllInfoWindows(self);
				
				//jump to the store
				jump(self, store.latlng, self.options.storeZoom);
				
				if(self.options.openInfoWindowOnStoreClick){
					
					//get marker by store
					marker = findMarker(self, store);
										
					if(marker){
						google.maps.event.trigger(marker, 'click');
					}
				}
			}
		});
		
		/**
		* bind stores list event
		*/
		self.$root.on(self.options.sendStoreListEvent, function(e, fullStoresList, storesView){
			
			setMarkers(self, storesView);
		});
		
		/**
		* bind set directions event
		*/
		self.$root.on(self.options.setDirectionsEvent, function(e, start, end){			
			setDirections(self, start, end);			
		});
	};
	
	/**
	* init map
	* @param {Object} self - 'this' object
	* @param {jQueryObject} $mapRoot - map root jquery element
	*/
	var initMap = function(self, $mapRoot){
		
		var pyrmont;
				
		if(google && google.maps){
		
			google.maps.event.addDomListener(window, 'load', function(){
				
				//directions
				self.directionsService = new google.maps['DirectionsService']();
				self.directionsDisplay = new google.maps['DirectionsRenderer']();	
		
				//init pyrmont
				pyrmont = new google.maps.LatLng(self.options.latitude, self.options.longitude);
				
				//create map
				self.mapCanvas = new google.maps.Map(self.$mapRoot.get(0), 
				{
					mapTypeId: google.maps.MapTypeId[self.options.mapTypeId]
					,center: pyrmont
					,zoom: self.options.startZoom
				});
				
				//init directions display
				self.directionsDisplay.setMap(self.mapCanvas);
				
				//init events
				initEvents(self);
				
				//get stores list -> draw markers
				self.$root.trigger(self.options.getStoresListEvent, []);
				
				//init geolocation (if needed)
				initGeolocation(self);
			});
		}
	};
	
	/**
	* map constructor
	* @param {jQueryObject} $root - jlocator root element
	* @param {Object} options - jlocator user options
	* @return {Object} - map + this	
	* @constructor 
	*/
	var Init = function($root, options){
	
		var self = {
			$root: $root
			,options: options
			
			//map
			,mapCanvas: null
			,geocoder: null
			,markers: []
			
			//jplist
			,$mapRoot: $root.find('[data-type="map"]')
			
			//directions
			,directionsService: null
			,directionsDisplay: null
		};		
		
		//init map
		initMap(self, self.$mapRoot);
				
		return $.extend(this, self);
	};
	
	/**
	* map
	* @param {jQueryObject} $root - jlocator root element
	* @param {Object} options - jlocator user options
	* @return {Object} - map
	* @constructor 
	* @name map
    * @class Controller
    * @memberOf jQuery.fn.jlocator
	* @property {jQueryObject} $root - jlocator root element
	* @property {Object} options - jlocator user options
	* @property {Object} mapCanvas - map convas element
	* @property {Object} geocoder - google geocoder element
	* @property {jQueryObject} $mapRoot - map root element
	* @property {Object} directionsService - google directions service
	* @property {Object} directionsDisplay - google directions display
	*/
	jQuery.fn.jlocator.map = function($root, options){
				
		//call constructor
		return new Init($root, options);	
	};
})(jQuery);

