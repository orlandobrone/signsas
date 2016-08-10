/*global jQuery:false */
(function($){
	'use strict';		
	
	/**
	* get current page
	* @param {boolean} isDefault
	* @param {jQueryObject} $el
	* @return {number}
	*/
	var getCurrentPage = function(isDefault, $el){
		
		var cpage = 0
			,currentPageString;
		
		//get current page
		if(isDefault){
		
			//by default current page is 0
			cpage = 0;
		}
		else{
			
			//get current page
			currentPageString = $el.attr('data-number');
			
			//parse to number
			cpage = Number(currentPageString);
			
			//if not a number => current page is 0
			if(isNaN(currentPageString)){
				cpage = 0;
			}
		}
		
		return cpage;
	};
	
	/**
	* get items per page - should be used only if dropdown 'items per page' is absent
	* @param {jQueryObject} $el
	* @return {number}
	*/
	var getItemsPerPage = function($el){
		
		var itemsPerPage = 0
			,itemsPerPageString;
		
		//items per page 
		itemsPerPageString = $el.attr('data-items-per-page');
		
		//get items per page as number
		itemsPerPage = Number(itemsPerPageString);
		
		if(isNaN(itemsPerPage)){
			itemsPerPage = 0;
		}
		
		return itemsPerPage;
	};
	
	/**
	* init pager span onclick
	* @param {jQuery.fn.jplist.view.PanelControl} control
	*/
	var initPagerClickEvents = function(control){
		
		var currentPage
			,status = null;
		
		control.$control.find('span').off('click').on('click', function(){
			
			//get current page number			
			currentPage = getCurrentPage(false, $(this)); //isDefault, $el
			
			//get status
			status = jQuery.fn.jplist.controls.Placeholder.getStatus(false, control);
			
			//update current page
			status.data.currentPage = currentPage;
			
			//send status event	
			control.events.lastStatus = status;
			control.$jplistBox.trigger(control.options.status_event, [status]);
				
		});
	};
	
	/**
	* set pager arrows visibility
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Object} pagingObj - paging status object
	*/
	var setArrows = function(control, pagingObj){
		
		//set pagingprev visibility
		if(pagingObj.currentPage === 0){
			control.$control.data('pagingprev').addClass('hidden');
		}
		else{
			control.$control.data('pagingprev').removeClass('hidden');
		}
		
		//set pagingnext visibility
		if(pagingObj.currentPage == pagingObj.pagesNumber - 1){ 
			control.$control.data('pagingnext').addClass('hidden');
		}
		else{
			control.$control.data('pagingnext').removeClass('hidden');
		}	
	};
	
	/**
	* build pager html for the given control and paging object (from event)
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Object} pagingObj - paging status object
	*/
	var buildPager = function(control, pagingObj){		
		
		var start
			,end
			,diff
			,temp
			,html = ''
			,options;
		
		//set options
		options = control.controlTypeOptions;
		
		if(pagingObj.currentPage >= 0 && pagingObj.currentPage < pagingObj.pagesNumber){
			
			control.$control.removeClass('hidden');
			
			diff = Math.floor(pagingObj.currentPage / options.paging_length);
			start = options.paging_length*diff;
			end = options.paging_length*(diff + 1);
			
			if(end > pagingObj.pagesNumber){
				end = pagingObj.pagesNumber;
			}
			
			html +=	'<div class="pagesbox">';			
			for(var i=start; i<end; i++){
				
				html += '<span ';						
				if(i === pagingObj.currentPage){
					html += ' class="current" data-active="true" ';
				}
				temp = i + 1;
				html += ' data-number="' + i + '" ';
				html += '>' + temp + '</span> ';
			}
			html +=	'</div>';
			
			//set html
			control.$control.data('pagingmid').html(html);

			//set data attributes
			control.$control.data('prev').attr('data-number', pagingObj.prevPage).removeClass('current');
			control.$control.data('next').attr('data-number', pagingObj.nextPage).removeClass('current');
			control.$control.data('last').attr('data-number', pagingObj.pagesNumber - 1).removeClass('current');
		}
		else{
			control.$control.addClass('hidden');
		}
		
		//update qrrows visibility
		setArrows(control, pagingObj);
	};
		
	/** 
	* Placeholder control (for example, contains pagination bullets)
	* @type {Object} 
    * @class Placeholder control - used like container for any html (for example, for pagination)
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Placeholder = {};
	
	/**
	* Status object related data (using in communication with controller)
	* @param {number} currentPage
	* @param {number} itemsPerPage - (should be used only if dropdown 'items per page' is absent)
	* @constructor
	* @function
	* @memberOf jQuery.fn.jplist.controls.Placeholder	
	*/
	jQuery.fn.jplist.controls.Placeholder.statusRelatedData = function(currentPage, itemsPerPage){
	
		var data = {
			currentPage: currentPage
			,paging: null
		};	
		
		if(itemsPerPage){
			data.number = itemsPerPage;
		}
		
		return data;
	};
	
	/**
	* Render control html: only main structure (the other content dynamically changes)
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Placeholder
	*/
	jQuery.fn.jplist.controls.Placeholder.render = function(control){
	
		var $pagingprev
			,$pagingmid
			,$pagingnext
			,options;
				
		//get options 
		options = control.controlTypeOptions;
		
		//set containers html		
		control.$control.html('<div class="pagingprev"></div><div class="pagingmid"></div><div class="pagingnext"></div>');
		
		//init vars
		$pagingprev = control.$control.find('.pagingprev');		
		$pagingmid = control.$control.find('.pagingmid');
		$pagingnext = control.$control.find('.pagingnext');
		
		//init data: add vars to placeholder jquery data obect
		control.$control.data('pagingprev', $pagingprev);
		control.$control.data('pagingmid', $pagingmid);
		control.$control.data('pagingnext', $pagingnext);
		
		//set arrows html
		$pagingprev.html('<span class="first" data-number="0">' + options.first_arrow + '</span><span class="prev">' + options.prev_arrow + '</span>');
		$pagingnext.html('<span class="next">' + options.next_arrow + '</span><span class="last">' + options.last_arrow + '</span>');
		
		//init arrows data: add vars to placeholder jquery data obect
		control.$control.data('first', $pagingprev.find('.first'));
		control.$control.data('prev', $pagingprev.find('.prev'));
		control.$control.data('next', $pagingnext.find('.next'));
		control.$control.data('last', $pagingnext.find('.last'));		
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.Placeholder
	*/
	jQuery.fn.jplist.controls.Placeholder.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.Placeholder.getStatus(isDefault, control);
		
		if(status.data){
			
			if($.isNumeric(status.data.currentPage)){
				
				//init deep link
				deepLink = control.name + '--currentPage=' + status.data.currentPage;
			}
			
			if($.isNumeric(status.data.number)){
				
				//init deep link
				deepLink = control.name + '--number=' + status.data.number;
			}
		}
		
		return deepLink;
	};
	
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Placeholder	
	*/
	jQuery.fn.jplist.controls.Placeholder.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status = null;
		
		if(propName !== 'currentPage'){
			return null;
		}
		
		//get status
		status = jQuery.fn.jplist.controls.Placeholder.getStatus(isDefault, control);
		
		if(status.data){
		
			switch(propName){
				
				case 'currentPage':{	
					
					//set current page
					status.data.currentPage = propValue;
					
					//trigger status event
					//control.$jplistBox.trigger(control.options.status_event, [status]);					
				}
				break;
				/*
				case 'number':{
										
					//set current page
					status.data.number = propValue;
					
					//trigger status event
					//control.$jplistBox.trigger(control.options.status_event, [status]);
				}
				break;
				*/
			}
		}
		
		return status;
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.Placeholder
	*/
	jQuery.fn.jplist.controls.Placeholder.getStatus = function(isDefault, control){
		
		var data
			,status = null
			,$span
			,cpage
			,itemsPerPage;	
		
		//get active span  
		$span = control.$control.find('span[data-active]').eq(0);
		
		//if no active span -> get first span
		if($span.length <= 0){
			$span = control.$control.find('span').eq(0);
		}
		
		//get current page
		cpage = getCurrentPage(isDefault, $span);
		
		//if jump_to_start option is enabled and last rebuild action was not pagination -> jump to 0
		if(control.controlTypeOptions 
			&& control.controlTypeOptions.jump_to_start
			&& control.events.lastStatus
			&& control.events.lastStatus.type !== 'placeholder'){
			
				cpage = 0;
		}
		
		//init items per page
		itemsPerPage = getItemsPerPage(control.$control);
		
		//create status related data
		data = new jQuery.fn.jplist.controls.Placeholder.statusRelatedData(cpage, itemsPerPage);		
			
		//create status
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);		
		
		return status;					
	};
		
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.Placeholder
	*/
	jQuery.fn.jplist.controls.Placeholder.setStatus = function(status, control, isCookie){
	
		var pagingObj;
		
		if(control.name === 'paging'){	
			
			if(!control.cookies && isCookie){					
									
				//update current page
				status.data.currentPage = 0;
				
				//send status event		
				control.events.lastStatus = status;
				control.$jplistBox.trigger(control.options.status_event, [status]);
					
			}	
			else{				
				if(status.data && status.data.paging){
					
					//get paging object from status related data
					pagingObj = status.data.paging;
					
					//build pager
					buildPager(control, pagingObj);
					initPagerClickEvents(control);
				}	
			}			
		}
		
	};
		
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Placeholder
	*/
	jQuery.fn.jplist.controls.Placeholder.initEvents = function(control){		
		initPagerClickEvents(control);
	};
	
})(jQuery);

