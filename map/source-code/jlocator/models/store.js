(function($){
	'use strict';		
	
	/**
	* get value
	* @param {Object} self - this object
	* @param {string} dataType - data type name (title, address, etc.)
	*/
	var getValue = function(self, dataType){
	
		var $el;
		
		//get value
		$el = self.$element.find('[data-type="' + dataType + '"]');
		
		//if null?
		if($el.length > 0){
			return $el.text();
		}
		
		return null;
	};
	
	/**
	* get full address
	* @param {Object} self - this object
	* @return {string}
	*/
	var getFullAddress = function(self){	
	
		var fullAddress = '';
		
		if(self.address){
			fullAddress += self.address + ' ';
		}
		
		if(self.city){
			fullAddress += self.city + ' ';
		}
		
		if(self.state){
			fullAddress += self.state + ' ';
		}
		
		if(self.zipcode){
			fullAddress += self.zipcode + ' ';
		}
		
		if(self.country){
			fullAddress += self.country + ' ';
		}
		
		return fullAddress;		
	};
	
	/**
	* get store data
	* @param {Object} self - this object
	*/
	var getData = function(self){
	
		var latitude
			,longitude
			,icon;
		
		//get vars
		self.title = getValue(self, 'title');
		self.address = getValue(self, 'address');
		self.city = getValue(self, 'city');
		self.state = getValue(self, 'state');
		self.zipcode = getValue(self, 'zipcode');
		self.country = getValue(self, 'country');
		
		//get custom marker icon (if exists)		
		icon = self.$element.attr('data-marker-icon');
		if(icon){
			self.customMarkerIcon = icon;
		}
		
		//get latitude
		latitude = self.$element.attr('data-latitude');		
		if($.isNumeric(latitude)){			
			self.latitude = latitude;
		}
		
		//get longitude
		longitude = self.$element.attr('data-longitude');		
		if($.isNumeric(longitude)){			
			self.longitude = longitude;
		}
		
		if($.isNumeric(latitude) && $.isNumeric(longitude)){			
			self.latlng = new google.maps.LatLng(self.latitude, self.longitude, true);
		}
	};
	
	/**
	* store constructor
	* @param {jQueryObject} $element - store element
	* @param {Object} options - jlocator user options
	* @return {Object} - store + this	
	* @constructor 
	*/
	var Init = function($element, options){
	
		var self = {			
			$element: $element
			,options: options
			,customMarkerIcon: ''
			,html: ''
			
			//address vars
			,fullAddress: ''
			,title: ''
			,address: ''
			,city: ''
			,state: ''
			,zipcode: ''
			,country: ''
			
			//point
			,latitude: null
			,longitude: null
			,latlng: null
		};	
		
		//init html
		self.html = jQuery.fn['jplist']['services']['Helper']['getOuterHtml']($element);
		
		//get data
		getData(self);
		
		//get full address
		getFullAddress(self);
				
		return $.extend(this, self);
	};
	
	/**
	* store constructor
	* @param {jQueryObject} $element - store element
	* @param {Object} options - jlocator user options
	* @return {Object} - store
	* @constructor 
	* @name store
    * @class Controller
    * @memberOf jQuery.fn.jlocator
	* @property {jQueryObject} $element - store element
	* @property {Object} options - jlocator user options
	* @property {string} customMarkerIcon - store custom marker icon url
	* @property {string} html - store html
	* @property {string} fullAddress - store full address
	* @property {string} address - store address
	* @property {string} city - store city
	* @property {string} state - store state
	* @property {string} zipcode - store zipcode
	* @property {string} country - store country
	* @property {number} latitude - store latitude
	* @property {number} longitude - store longitude
	* @property {Object} latlng - google latlng object
	*/
	jQuery.fn.jlocator.store = function($element, options){
				
		//call constructor
		var self = new Init($element, options);	
		
		return self;
	};
})(jQuery);

