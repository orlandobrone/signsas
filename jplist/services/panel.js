/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Panel Class
	* @type {Object} 
	* @class Services for the panel object
	* @memberOf jQuery.fn.jplist.services
	*/
	jQuery.fn.jplist.services.Panel = {};
	
	/**
	* Find controls with the same name and action
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	* @param {?string} name
	* @param {?string} action
	* @return {Array.<jQuery.fn.jplist.view.PanelControl>}
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.findControlsByNameAction = function(controls, name, action){
		
		var sameControls = []
			,control;
		
		for(var i=0; i<controls.length; i++){
		
			//get control type
			control = controls[i];
			
			if(control.name === name && control.action === action){
				sameControls.push(control);
			}
		}
			
		return sameControls;
	};

	/**
	* Find controls with the same name
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	* @param {?string} name
	* @return {Array.<jQuery.fn.jplist.view.PanelControl>}
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.findControlsByName = function(controls, name){
		
		var sameControls = []
			,control;
		
		for(var i=0; i<controls.length; i++){
		
			//get control type
			control = controls[i];
			
			if(control.name === name){
				sameControls.push(control);
			}
		}
			
		return sameControls;
	};
	
	/**
	* merge statuses with the same name and different types
	* @param {Array.<jQuery.fn.jplist.models.Status>} oldStatuses - statuses to merge
	* @return {Array.<jQuery.fn.jplist.models.Status>}
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.mergeIdenticalStatuses = function(oldStatuses){
	
		var statuses = []
			,status
			,index
			,same_name_status
			,temp;
		
		for(var i=0; i<oldStatuses.length; i++){
								
			//get control status
			status = oldStatuses[i];
			
			//add status to the list
			if(status){
			
				//search for the statuses with the same name
				index = jQuery.fn.jplist.services.Status.findStatusByField(status, 'name', statuses);
				
				if(index !== -1){
					
					//there is statuses with the same name
					same_name_status = statuses[index];
					
					if(same_name_status.action === status.action){
						
						//same name and different stypes: dropdown pager + placeholder pages -> merge statuses
						if(same_name_status.type !== status.type){
							
							temp = $.extend(true, {}, status, statuses[index]);
							statuses[index] = temp;
							//$.extend(true, statuses[index], status);
						}
					}
				}
				else{
					//no statuses with the same name ->add to statuses list
					statuses.push(status);
				}				
			}
		}
		
		return statuses;
	};
	
	/**
	* Merge current statuses list with the given status: if status with the same name and action is found in the list, merge them
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	* @param {jQuery.fn.jplist.models.Status} status
	* @return {Array.<jQuery.fn.jplist.models.Status>}
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.mergeWithStatus = function(statuses, status){
	
		var cStatus;
		
		for(var i=0; i<statuses.length; i++){
		
			//get current status
			cStatus = statuses[i];
			
			if(cStatus.name === status.name && cStatus.action === status.action){
			 
				//merge current status with the given one
				$.extend(true, cStatus, status);
			}
		}
		
		return statuses;
	};
	
	/**
	* Get current panel statuses (for ask event)
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	* @param {boolean} isDefault - if true, get default (initial) panel status; else - get current panel status
	* @return {Array.<jQuery.fn.jplist.models.Status>}
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.getStatuses = function(controls, isDefault){
	
		var statuses = []
			,control
			,status
			,index
			,same_name_status;
		
		for(var i=0; i<controls.length; i++){
		
			//get control type
			control = controls[i];
			
			//get control status
			status = control.getStatus(isDefault);
			
			//add status to the list
			if(status){
			
				//search for the statuses with the same name
				index = jQuery.fn.jplist.services.Status.findStatusByField(status, 'name', statuses);
				
				if(index != -1){
					
					//there is statuses with the same name
					same_name_status = statuses[index];
					
					if(same_name_status.action == status.action){
						
						//same name and different stypes: dropdown pager + placeholder pages -> merge statuses
						if(same_name_status.type != status.type){
							
							$.extend(true, statuses[index], status);
						}
					}
				}
				else{
					//no statuses with the same name ->add to statuses list
					statuses.push(status);
				}				
			}
		}
		
		return statuses;
	};
			
	/**
	* Set current statuses (for answer event)
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	* @param {boolean} isCookie - are statuses restored from cookies
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.setStatuses = function(controls, statuses, isCookie){
		
		var status
			,sameControls;
		
		for(var i=0; i<statuses.length; i++){
		
			//get status
			status = statuses[i];
			
			//get controls group (with the status.name and status.action)
			sameControls = jQuery.fn.jplist.services.Panel.findControlsByNameAction(controls, status.name, status.action);
			
			for(var k=0; k<sameControls.length; k++){
			
				//set control status
				sameControls[k].setStatus(status, isCookie);
			}
		}
	};

	/**
	* Get panel paths
	* @param {Array.<jQuery.fn.jplist.view.PanelControl>} controls
	* @return {Array.<jQuery.fn.jplist.models.Path>}
	* @memberOf jQuery.fn.jplist.services.Panel
	*/
	jQuery.fn.jplist.services.Panel.getPaths = function(controls){
	
		var control
			,paths
			,path
			,generalPathsList = [];
		
		for(var i=0; i<controls.length; i++){
		
			//get control type
			control = controls[i];
			
			//get control type paths
			paths = control.getPaths();
			
			for(var k=0; k<paths.length; k++){
			
				//get path
				path = paths[k];
				
				if(!jQuery.fn.jplist.services.Path.isPathInList(path, generalPathsList)){
				
					//add path to the list
					generalPathsList.push(path);
				}
			}
		}
		
		return generalPathsList;
	};	
	
})(jQuery);

