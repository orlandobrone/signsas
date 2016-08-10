/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Label control (for example, contains pager info: Page 1 of 7) 
	* @type {Object}
	* @class Label control - used to represent static text (for example, pagination information)
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Label = {};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.Label
	*/
	jQuery.fn.jplist.controls.Label.setStatus = function(status, control, isCookie){
	
		var pagingObj
			,infoType;
		
		if(status.action === 'paging' && status.data && status.data.paging){
			
			pagingObj = status.data.paging;
			
			if(pagingObj.pagesNumber <= 0){
				control.$control.html('');
			}
			else{
				//get pager type
				infoType = control.$control.attr('data-type');
				
				//replace
				infoType = infoType.replace('{current}', pagingObj.currentPage + 1);
				infoType = infoType.replace('{pages}', pagingObj.pagesNumber);
				infoType = infoType.replace('{start}', pagingObj.start + 1);
				infoType = infoType.replace('{end}', pagingObj.end);
				infoType = infoType.replace('{all}', pagingObj.itemsNumber);
				
				//set html
				control.$control.html(infoType);
			}
		}
	};
	
	
})(jQuery);

