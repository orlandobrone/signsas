(function(jQuery){
	'use strict';		
	
	/** 
	* Checkbox group filter control
	* @type {Object} 
    * @class CheckboxGroupFilter - group of checkboxes control
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter = {};	
	
	/**
	* Status object related data
	* @param {Array.<string>} pathGroup - list of paths
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.statusRelatedData = function(pathGroup){
		
		return {
			pathGroup: pathGroup
			,filterType: 'pathGroup'
		};
	};
	
	/**
	* CheckboxGroupFilter control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.render = function(control){
		
		var $control = control.$control
			,$checkboxes = $control.find('[data-path]');
		
		//in every checkbox: save if it's checked in it's data
		$checkboxes.each(function(){			
			var $cb = $(this);			
			$cb.data('checked', $cb.get(0).checked);
		});
		
		//save vars to the 'data'
		$control.data('checkboxes', $checkboxes);
	};
	
	/**
	* Get deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {string} deep link
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.getDeepLink = function(control){
		
		var deepLink = ''
			,status
			,isDefault = false
			,value = '';
		
		//get status
		status = jQuery.fn.jplist.controls.CheckboxGroupFilter.getStatus(isDefault, control);
		
		if(status.data && $['isArray'](status.data.pathGroup) && status.data.pathGroup.length > 0){
			
			for(var i=0; i<status.data.pathGroup.length; i++){
				
				if(value !== ''){
					value += '~';
				}
				
				value += status.data.pathGroup[i];
			}
			
			//init deep link
			deepLink = control.name + '--pathGroup=' + value;
		}
		
		return deepLink;
	};
	
	/**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.getStatusByDeepLink = function(control, propName, propValue){
		
		var isDefault = true
			,status
			,sections;
			
		//get status
		status = jQuery.fn.jplist.controls.CheckboxGroupFilter.getStatus(isDefault, control);
		
		if(status.data){
		
			if(propName === 'pathGroup'){
				
				sections = propValue.split('~');
				
				if(sections.length > 0){
					
					status.data.pathGroup = sections;
					
					//trigger status event
					//control.$jplistBox.trigger(control.options.status_event, [status]);	
				}
			}
		}
		
		return status;
	};
	
	/**
	* Get control paths
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {Array.<jQuery.fn.jplist.models.Path>} paths
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.getPaths = function(control, paths){
	
		var $control = control.$control
			,checkboxes = $control.data('checkboxes')
			,cb
			,dataPath
			,path;

		if(checkboxes){
			for(var i=0; i<checkboxes.length; i++){

				//get checkbox
				cb = checkboxes.eq(i);

				//get data-path
				dataPath = cb.attr('data-path');

				if(dataPath){

					//create path object
					path = new jQuery.fn.jplist.models.Path(dataPath, 'text');

					//add path to the paths list
					if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
						paths.push(path);
					}
				}
			}
		}

	};
	
	/**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.getStatus = function(isDefault, control){
	
		var $control = control.$control
			,$checkboxes = $control.data('checkboxes')
			,data
			,pathGroup = []
			,$cb
			,cbData
			,dataPath
			,status
            ,i;
		
		if(isDefault){
			
			//init path group
			for(i=0; i<$checkboxes.length; i++){
					
				//get checkbox
				$cb = $checkboxes.eq(i);	

				//get checkbox data
				cbData = $cb.data('checked');
				
				if(!!cbData){
				
					//get data-path
					dataPath = $cb.attr('data-path');
					
					if(dataPath){
						pathGroup.push(dataPath);
					}
				}
			}
		}
		else{
		
			//init path group
			for(i=0; i<$checkboxes.length; i++){

				//get checkbox
				$cb = $checkboxes.eq(i);			
				
				//get data-path
				dataPath = $cb.attr('data-path');
				
				if(dataPath && $cb.get(0).checked){
					pathGroup.push(dataPath);
				}			
			}
		}		
		
		//init status related data
		data = new jQuery.fn.jplist.controls.CheckboxGroupFilter.statusRelatedData(pathGroup);
		
		//init status
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);
		
		return status;			
	};
	
	/**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.setStatus = function(status, control, isCookie){
		
		var path
			,$control = control.$control
			,$cb
			,$checkboxes = $control.data('checkboxes');
			
		if($checkboxes){
		
			//reset	all checkboxes
			$checkboxes.each(function(){
				$(this).get(0).checked = false;
			});
		
			if(status.data && status.data.pathGroup && $['isArray'](status.data.pathGroup) && status.data.pathGroup.length > 0){
				
				for(var i=0; i<status.data.pathGroup.length; i++){
					
					//get path
					path = status.data.pathGroup[i];
					
					$cb = $checkboxes.filter('[data-path="' + path + '"]');
					
					if($cb.length > 0){
						$cb.get(0).checked = true;
						//$cb.trigger('change');
					}
				}
			}
		}
	};
	
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.CheckboxGroupFilter
	*/
	jQuery.fn.jplist.controls.CheckboxGroupFilter.initEvents = function(control){
		
		var $control = control.$control
			,checkboxes = $control.data('checkboxes');
			
		checkboxes.off('change').change(function(){
			control.events.lastStatus = jQuery.fn.jplist.controls.CheckboxGroupFilter.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};
	
	
})(jQuery);

