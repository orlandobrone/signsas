(function(jQuery){
	'use strict';		
	
	/** 
	* Checkbox filter control
	* @type {Object} 
    * @class CheckboxFilter - checkbox filter control
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.CheckboxFilter = {};	
	
	/**
	* Render control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.render = function(control){
		
		//on html render: get the default values of the checkbox (if checked, true or false)
		var isChecked = control.$control.get(0).checked;
		
		//if undefined, set false
		if(isChecked !== true){
			isChecked = false;
		}
		
		//save the default values to the 'data'
		control.$control.data('default-checked', isChecked);
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false;
		
		//get status
		status = jQuery.fn.jplist.controls.CheckboxFilter.getStatus(isDefault, control);
		
		if(status.data && status.data.isChecked){
				
			//init deep link
			deepLink = control.name + '--isChecked=true';
		}
		
		return deepLink;
	};
		
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status;
			
		//get status
		status = jQuery.fn.jplist.controls.CheckboxFilter.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'isChecked'){
				
				//set current page
				status.data.isChecked = true;
				
				//trigger status event
				//control.$jplistBox.trigger(control.options.status_event, [status]);	
			}
		}
		
		return status;
	};
	
	/**
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.getPaths = function(control, paths){
	
		var jqPath
			,path
			,allCheckboxesOrPaths;		
				
		//ger data-path attribute
		jqPath = control.$control.attr('data-path');
		
		//init path
		if(jqPath){
		   
		    //create path object
			path = new jQuery.fn.jplist.models.Path(jqPath, 'text');
			
			//add path to the paths list
			if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
				paths.push(path);
			}
		}
		
		//get list of all checkboxes with or logic
		allCheckboxesOrPaths = control.$jplistBox.find('[data-control-type="' + control.type + '"][data-control-action="' + control.action + '"][data-logic="or"]');
		
		//save all checkboxes to the 'data'
		control.$jplistBox.data('jplist-all-cb-or', allCheckboxesOrPaths);
	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.getStatus = function(isDefault, control){
		
		var status = null
			,data
			,isChecked
			,dataLogic
			,logic = 'and'
			,allCheckboxesOrPaths;
			
		//get data-logic attribute
		dataLogic = control.$control.attr('data-logic');
		
		//get logic: or/and
		if(dataLogic && dataLogic.toString() === 'or'){
		
			logic = 'or';
		}
		
		//get checkbox value:
		if(isDefault){	
		
			//if default, get the value saved in 'data'
			isChecked = control.$control.data('default-checked');
			if(isChecked !== true){
				isChecked = false;
			}
		}
		else{
			//if not default, get checkbox current value
			isChecked = control.$control.get(0).checked;
		}		
		
		if(logic === 'and'){ //AND logic:
			data = {
				path: control.$control.attr('data-path')
				,type: 'text'
				,filterType: 'path'
				,isChecked: isChecked
			};
		}
		else{ //OR logic		
		
			//get list of all checkboxes with or logic
			allCheckboxesOrPaths = control.$jplistBox.data('jplist-all-cb-or');
		
			data = {
				path: control.$control.attr('data-path')
				,type: 'text'
				,filterType: 'inverted_path'
				,checked_checkboxes: allCheckboxesOrPaths.filter(':checked')
				,isChecked: isChecked
			};
		}
		
		
		if(logic === 'and'){
			if(isChecked){
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
				return status;	
			}
			else{
				data.filterType = '';
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
				return status;
			}
		}
		else{
			if(isChecked){
				data.filterType = '';
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
				return status;
			}
			else{
				status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
				return status;
			}
		}
			
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.setStatus = function(status, control, isCookie){
		
		var data_path
			,dataLogic
			,logic = 'and';
		
		//get data-logic attribute
		dataLogic = control.$control.attr('data-logic');
		
		//get logic
		if(dataLogic && dataLogic.toString() === 'or'){
		
			logic = 'or';
		}
		
		//get data path
		data_path = control.$control.attr('data-path');
		//console.log(status.data.isChecked);
		
		if(status.data.isChecked !== true){
			control.$control.get(0).checked = false;
		}
		else{
			control.$control.get(0).checked = true;
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.CheckboxFilter
	*/
	jQuery.fn.jplist.controls.CheckboxFilter.initEvents = function(control){
		
		control.$control.off().change(function(){
			control.events.lastStatus = jQuery.fn.jplist.controls.CheckboxFilter.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};
	
	
})(jQuery);

