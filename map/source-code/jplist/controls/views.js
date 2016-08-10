(function($){
	'use strict';		
	
	/** 
	* List/grid view control
	* @type {Object} 
    * @class Views control - used for grid/list view
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Views = {};
	
	/**
	* Status object related data (using in communication with controller)
	* @param {boolean} isGrid - does control have class 'grid'
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.Views.statusRelatedData = function(isGrid){
		
		return {
			isGrid: isGrid
		};
	};
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Views
	*/
	jQuery.fn.jplist.controls.Views.render = function(control){
		
		var listBtn
			,gridBtn;
			
		//find buttons
		listBtn = control.$control.find('.list-view');
		gridBtn = control.$control.find('.grid-view');
		
		//add to the data
		control.$control.data('list-view-btn', listBtn);
		control.$control.data('grid-view-btn', gridBtn);
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.Views
	*/
	jQuery.fn.jplist.controls.Views.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.Views.getStatus(isDefault, control);
		
		if(status.data && status.data.isGrid){
				
			//init deep link
			deepLink = control.name + '--isGrid=true';
		}
		
		return deepLink;
	};
	
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Views
	*/
	jQuery.fn.jplist.controls.Views.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status;
			
		//get status
		status = jQuery.fn.jplist.controls.Views.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'isGrid'){
				
				//set current page
				status.data.isGrid = true;
				
				//trigger status event
				//control.$jplistBox.trigger(control.options.status_event, [status]);	
			}
		}
		
		return status;
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Views
	*/
	jQuery.fn.jplist.controls.Views.getStatus = function(isDefault, control){
		
		var data
			,status;	
				
		//create status related data
		data = new jQuery.fn.jplist.controls.Views.statusRelatedData(control.$jplistBox.hasClass('grid'));
		
		//create status
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		
		return status;			
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.Views
	*/
	jQuery.fn.jplist.controls.Views.setStatus = function(status, control, isCookie){
	
		var isGrid;		
		if(status.data){
			if(!control.cookies && isCookie){
			
				//change class
				control.$jplistBox.removeClass('grid');
				status.data.isGrid = false;
				
				//force ask status event	
				control.$jplistBox.trigger(control.options.status_event, [status]);
			}
			else{
				//should control have class 'grid'?
				isGrid = status.data.isGrid;
				
				if(isGrid){
					control.$jplistBox.addClass('grid');
				}
				else{
					control.$jplistBox.removeClass('grid');
				}
			}
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Views
	*/
	jQuery.fn.jplist.controls.Views.initEvents = function(control){
	
		var $listBtn
			,$gridBtn;
			
		//find buttons
		$listBtn = control.$control.data('list-view-btn');
		$gridBtn = control.$control.data('grid-view-btn');
		
		if($listBtn.length > 0){
			$listBtn.click(function(){
			
				//change class
				control.$jplistBox.removeClass('grid');
				
				//update last status
				control.events.lastStatus = jQuery.fn.jplist.controls.Views.getStatus(false, control);
			
				//force ask event			
				control.$jplistBox.trigger(control.options.force_ask_event, [false]);
			});
		}
		
		if($gridBtn.length > 0){
			$gridBtn.click(function(){
			
				//change class
				control.$jplistBox.addClass('grid');
				
				//update last status
				control.events.lastStatus = jQuery.fn.jplist.controls.Views.getStatus(false, control);
				
				//force ask event			
				control.$jplistBox.trigger(control.options.force_ask_event, [false]);
			});
		}
	};
	
})(jQuery);

