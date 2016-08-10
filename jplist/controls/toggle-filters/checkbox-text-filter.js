(function(jQuery){
	'use strict';

    /**
	* Checkbox text filter control
	* @type {Object}
    * @class CheckboxTextFilter - checkbox text filter control
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter = {};

    /**
	* Status object related data - used to define and perform filter action
	* @param {Array.<string>} textGroup - list of text values
    * @param {string} logic - 'or' / 'and'
    * @param {string} path - data-path attribute of the control
    * @param {string} ignoreRegex
	* @constructor
	* @function
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.statusRelatedData = function(textGroup, logic, path, ignoreRegex){

		return {
			textGroup: textGroup
            ,logic: logic
            ,path: path
            ,ignoreRegex: ignoreRegex
			,filterType: 'textGroup'
		};
	};

    /**
	* render CheckboxTextFilter control html
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.render = function(control){

		var $control = control.$control
			,$checkboxes = $control.find('input[type="checkbox"]');

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
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.getDeepLink = function(control){

		var deepLink = ''
			,status
			,isDefault = false
			,value = '';

		//get status
		status = jQuery.fn.jplist.controls.CheckboxTextFilter.getStatus(isDefault, control);

		if(status.data && $['isArray'](status.data.textGroup) && status.data.textGroup.length > 0){

			for(var i=0; i<status.data.textGroup.length; i++){

				if(value !== ''){
					value += '~';
				}

				value += status.data.textGroup[i];
			}

			//init deep link
			deepLink = control.name + '--textGroup=' + value;
		}

		return deepLink;
	};

    /**
	* Set deep link
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {string} propName - deep link property name
	* @param {string} propValue - deep link property value
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.getStatusByDeepLink = function(control, propName, propValue){

		var isDefault = true
			,status = null
			,sections;

		//get status
		status = jQuery.fn.jplist.controls.CheckboxTextFilter.getStatus(isDefault, control);

		if(status.data){

			if(propName === 'textGroup'){

				sections = propValue.split('~');

				if(sections.length > 0){

					status.data.textGroup = sections;

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
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.getPaths = function(control, paths){

		var $control = control.$control
			,dataPath
			,path;

        //get data-path
	    dataPath = $control.attr('data-path');

        if(dataPath){

            //create path object
			path = new jQuery.fn.jplist.models.Path(dataPath, 'text');

            //add path to the paths list
            if(!jQuery.fn.jplist.services.Path.isPathInList(path, paths)){
                paths.push(path);
            }
        }
	};

    /**
	* Get control status
	* @param {boolean} isDefault - if true, get default (initial) control status; else - get current control status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @return {jQuery.fn.jplist.models.Status}
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.getStatus = function(isDefault, control){

		var $control = control.$control
			,$checkboxes = $control.data('checkboxes')
			,data
            ,textGroup = []
            ,cbVal
			,$cb
			,cbData
			,status
            ,dataPath
            ,dataLogic
            ,ignore = ''
            ,i;

		if(isDefault){

			//init path group
			for(i=0; i<$checkboxes.length; i++){

				//get checkbox
				$cb = $checkboxes.eq(i);

				//get checkbox data
				cbData = $cb.data('checked');

				if(!!cbData){

					//get checkbox value
				    cbVal = $cb.val();

					if(cbVal){
						textGroup.push(cbVal);
					}
				}
			}
		}
		else{

			//init text group: get all selected checkbox values
			for(i=0; i<$checkboxes.length; i++){

				//get checkbox
				$cb = $checkboxes.eq(i);

				//get checkbox value
				cbVal = $cb.val();

				if(cbVal && $cb.get(0).checked){
					textGroup.push(cbVal);
				}
			}
		}

        //get data-path attribute
        dataPath = $control.attr('data-path');

        //get data-logic
        dataLogic = $control.attr('data-logic');
        if(!dataLogic){
            dataLogic = 'or';
        }

        if(control.controlTypeOptions && control.controlTypeOptions.ignore){

			//get ignore characters
			ignore = control.controlTypeOptions.ignore;
		}

		//init status related data
		data = new jQuery.fn.jplist.controls.CheckboxTextFilter.statusRelatedData(textGroup, dataLogic, dataPath, ignore);

		//init status
		status = new jQuery.fn.jplist.models.Status(control.name, control.action, control.type, data, control.cookies);

		return status;
	};

    /**
	* Set control status
	* @param {jQuery.fn.jplist.models.Status} status
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @param {boolean} isCookie - is status restored from cookies
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.setStatus = function(status, control, isCookie){

		var cbVal
			,$control = control.$control
			,$cb
			,$checkboxes = $control.data('checkboxes');

		if($checkboxes){

			//reset	all checkboxes
			$checkboxes.each(function(){
				$(this).get(0).checked = false;
			});

			if(status.data && status.data.textGroup && $['isArray'](status.data.textGroup) && status.data.textGroup.length > 0){

				for(var i=0; i<status.data.textGroup.length; i++){

					//get path
					cbVal = status.data.textGroup[i];

					$cb = $checkboxes.filter('[value="' + cbVal + '"]');

					if($cb.length > 0){
						$cb.get(0).checked = true;
					}
				}
			}
		}
	};

	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.CheckboxTextFilter
	*/
	jQuery.fn.jplist.controls.CheckboxTextFilter.initEvents = function(control){

		var $control = control.$control
			,checkboxes = $control.data('checkboxes');

		checkboxes.off('change').change(function(){
			control.events.lastStatus = jQuery.fn.jplist.controls.CheckboxTextFilter.getStatus(false, control);
			control.$jplistBox.trigger(control.options.force_ask_event, [false]);
		});
	};

})(jQuery);
