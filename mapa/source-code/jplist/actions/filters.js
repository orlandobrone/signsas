/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Filters API
	* @type {Object} 
	* @class Filter actions - filter by text, by path etc.
    * @memberOf jQuery.fn.jplist	
	*/
	jQuery.fn.jplist.actions.Filters = {};
	
	/**
	* remove characters
	* @param {string} text
	* @param {string} regex - remove characters regex expression
	* @return {string}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.removeCharacters = function(text, regex){
		
		var regexExpr;
		
		if(!text){				
			return '';
		}
		
		//create regex
		regexExpr = new RegExp(regex, 'ig');
		
		//return text.replace(/[^a-zA-Z0-9]+/g,'').toLowerCase();
		return text.replace(regexExpr, '').toLowerCase();
	};
	
	/**
	* pathFilter - filter dataview by path: only items with the given path are allowed
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.pathFilter = function(path, dataview){
	
		var dataitem
			,pathitem
			,resultDataview = [];
		
		for(var i=0; i<dataview.length; i++){
		
			//get dataitem
			dataitem = dataview[i];			
			
			if(path.jqPath === 'default'){
				
				//default drop down choice
				resultDataview.push(dataitem);
			}
			else{
				//find value by path
				pathitem = dataitem.findPathitem(path);				
				
				//if path is found
				if(pathitem){										
					resultDataview.push(dataitem);	
				}
			}			
		}
		
		return resultDataview;
	};
	
	/**
	* pathGroupFilter - filter dataview by paths group - used for checkboxes group
	* @param {Array.<string>} pathGroup - list of paths
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.pathGroupFilter = function(pathGroup, dataview){
	
		var path
			,pathObj
			,paths = []
			,dataitem
			,pathitem
			,resultDataview = [];
		
		if(pathGroup.length <= 0){
			return dataview;
		}
		else{
			//init paths list
			for(var p=0; p<pathGroup.length; p++){
				
				//get path
				path = pathGroup[p];
				
				//create path object
				pathObj = new jQuery.fn.jplist.models.Path(path, null);
				
				//add to paths list
				paths.push(pathObj);
			}
			
			for(var i=0; i<dataview.length; i++){
				
				//get dataitem
				dataitem = dataview[i];		
				
				for(var j=0; j<paths.length; j++){
					
					//get path object
					pathObj = paths[j];
					
					if(pathObj.jqPath === 'default'){
						
						//default drop down choice
						resultDataview.push(dataitem);
						break;
					}
					else{
						//find value by path
						pathitem = dataitem.findPathitem(pathObj);
						
						//if path is found
						if(pathitem){										
							resultDataview.push(dataitem);	
						}
					}
				}
			}
		}
		
		return resultDataview;
	};
	
	/**
	* invertedPathFilter - filter dataview by path: only items not in the given path are allowed
	* @param {jQueryObject} checkedCheckboxes - checked checkboxes list
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - stores dataview
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.invertedPathFilter = function(checkedCheckboxes, dataview){	
		
		var dataitem
			,pathitem
			,resultDataview = []
			,path
			,dataPath
			,addFlag = false
			,cb;		
		
		for(var i=0; i<dataview.length; i++){
		
			//get dataitem
			dataitem = dataview[i];		

			//set flag to false
			addFlag = false;
			
			if(checkedCheckboxes && checkedCheckboxes.length > 0){
			
				for(var j=0; j<checkedCheckboxes.length; j++){
				
					//get checkboxe
					cb = checkedCheckboxes.eq(j);
					
					//get path
					dataPath = cb.attr('data-path').toString();
					
					if(dataPath == 'default'){
						addFlag = true;					
					}
					else{
						//get data path
						path = new jQuery.fn.jplist.models.Path(dataPath, null); 
						
						//find value by path
						pathitem = dataitem.findPathitem(path);
						
						if(pathitem){										
							addFlag = true;	
						}
					}			
				}
				
				if(addFlag){
					resultDataview.push(dataitem);
				}
			}
		}
		
		return resultDataview;
		
	};
	
	/**
	* textFilter - filter dataview by text in the given jquery path
	* @param {string} text - filter text
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @param {string} ignoreRegex
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.textFilter = function(text, path, dataview, ignoreRegex){
	
		var dataitem
			,pathitem
			,resultDataview = []
			,text1
			,text2;
		
		for(var i=0; i<dataview.length; i++){
		
			//get dataitem
			dataitem = dataview[i];
			
			//find value by path
			pathitem = dataitem.findPathitem(path);
			
			if(path.jqPath === 'default'){
				
				//default drop down choice
				resultDataview.push(dataitem);
			}
			else{
				//if path is found
				if(pathitem){
					
					text1 = jQuery.fn.jplist.actions.Filters.removeCharacters(pathitem.text, ignoreRegex);
					text2 = jQuery.fn.jplist.actions.Filters.removeCharacters(text, ignoreRegex);
					
					//value.text contains text
					if(text1.indexOf(text2) !== -1){
						resultDataview.push(dataitem);					
					}
				}
			}			
		}
		
		return resultDataview;
	};

    /**
	* textGroupFilter - filter dataview by text group - used for checkboxes text filter
	* @param {Array.<string>} textGroup - list of text values
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
    * @param {string} logic - 'or' / 'and'
    * @param {string} dataPath - data-path attribute
    * @param {string} ignoreRegex
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.textGroupFilter = function(textGroup, logic, dataPath, ignoreRegex, dataview){

        var txtValue
			,dataitem
            ,pathitem
            ,pathItemText
            ,formattedTxt
            ,pathObj
			,resultDataview = []
            ,tempList
            ,txt;

		if(textGroup.length <= 0){
			return dataview;
		}
		else{

            //create path object
            pathObj = new jQuery.fn.jplist.models.Path(dataPath, null);

			for(var i=0; i<dataview.length; i++){

				//get dataitem
				dataitem = dataview[i];

                //find value by path
                pathitem = dataitem.findPathitem(pathObj);

                if(pathObj.jqPath === 'default'){

                    //default drop down choice
                    resultDataview.push(dataitem);
                }
                else{
                    //if path is found
				    if(pathitem){

                        //get text from the pathitem
                        pathItemText = jQuery.fn.jplist.actions.Filters.removeCharacters(pathitem.text, ignoreRegex);

                        if(logic === 'or'){

                            for(txt=0; txt<textGroup.length; txt++){

                                //get text value
                                txtValue = textGroup[txt];

                                //remove 'ignore characters' from the text value
                                formattedTxt = jQuery.fn.jplist.actions.Filters.removeCharacters(txtValue, ignoreRegex);

                                //pathitem text contains text value?
                                if(pathItemText.indexOf(formattedTxt) !== -1){
                                    resultDataview.push(dataitem);
                                    break;
                                }
                            }
                        }
                        else{  //logic === 'and'

                            tempList = [];

                            for(txt=0; txt<textGroup.length; txt++){

                                //get text value
                                txtValue = textGroup[txt];

                                 //remove 'ignore characters' from the text value
                                formattedTxt = jQuery.fn.jplist.actions.Filters.removeCharacters(txtValue, ignoreRegex);

                                //pathitem text contains text value?
                                if(pathItemText.indexOf(formattedTxt) !== -1){
                                    tempList.push(formattedTxt);
                                }
                            }

                            if(tempList.length === textGroup.length){
                                resultDataview.push(dataitem);
                            }
                        }
                    }
                }
			}
		}

		return resultDataview;
    };

	/**
	* date filter - filter dataview by date in the given jquery path
	* @param {number} year
	* @param {number} month
	* @param {number} day
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @param {string} format - datetime format
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.dateFilter = function(year, month, day, path, dataview, format){
	
		var dataitem
			,pathitem
			,resultDataview = []
			,pathitemDate;
		
		for(var i=0; i<dataview.length; i++){
		
			//get dataitem
			dataitem = dataview[i];
			
			//find value by path
			pathitem = dataitem.findPathitem(path);
			
			//if path is found
			if(pathitem){
				
				if(!year || !month || !day){
				
					resultDataview.push(dataitem);	
				}
				else{
				
					//get date from pathitem (by its text value)
					pathitemDate = jQuery.fn.jplist.actions.Sort.formatDatetime(pathitem.text, format);
					
					if(pathitemDate && typeof pathitemDate.getFullYear === 'function'){
						
						if((pathitemDate.getFullYear() === year) && (pathitemDate.getMonth() - 1 === month) && (pathitemDate.getDate() === day)){							
							resultDataview.push(dataitem);	
						}
					}
				}
			}
			
		}
		
		return resultDataview;
	};
	
	/**
	* pagination filter
	* @param {Object} pagingObj - paging object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.pagerFilter = function(pagingObj, dataview){
	
		var resultDataview = [];
		resultDataview = dataview.slice(pagingObj.start, pagingObj.end);
		return resultDataview;
	};
	
	/**
	* rangeFilter - range filter
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @param {number} min
	* @param {number} max
	* @param {number} prev
	* @param {number} next
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.rangeFilter = function(path, dataview, min, max, prev, next){
	
		var resultDataview = []
			,dataitem
			,pathitem
			,num;
		
		for(var i=0; i<dataview.length; i++){
		
			//get dataitem
			dataitem = dataview[i];			
			
			//find value by path
			pathitem = dataitem.findPathitem(path);	

			//if path is found
			if(pathitem){										
				
				//get number				
				num = Number(pathitem.text.replace(/[^0-9\.]+/g,''));
				
				if(!isNaN(num) && num >= prev && num <= next){
					
					//add to list
					resultDataview.push(dataitem);
				}
			}
		}
		
		return resultDataview;
	};
	
	/**
	* date range filter - range filter
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @param {string} format - datetime format
	* @param {number} prev_year
	* @param {number} prev_month
	* @param {number} prev_day
	* @param {number} next_year
	* @param {number} next_month
	* @param {number} next_day
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.dateRangeFilter = function(path
															,dataview
															,format
															,prev_year
															,prev_month
															,prev_day
															,next_year
															,next_month
															,next_day){
	
		var resultDataview = []
			,dataitem
			,pathitem
			,is_prevDate_not_valid
			,is_nextDate_not_valid
			,prevDate
			,nextDate
			,pathitemDate;
		
		for(var i=0; i<dataview.length; i++){
		
			//get dataitem
			dataitem = dataview[i];
			
			//find value by path
			pathitem = dataitem.findPathitem(path);
			
			//if path is found
			if(pathitem){
				
				//is valid
				is_prevDate_not_valid = (!prev_year || !prev_month || !prev_day);									
				is_nextDate_not_valid = (!next_year || !next_month || !next_day);
				
				if(is_prevDate_not_valid || is_nextDate_not_valid){				
					resultDataview.push(dataitem);	
				}
				else{
					
					//get date from pathitem (by its text value)
					pathitemDate = jQuery.fn.jplist.actions.Sort.formatDatetime(pathitem.text, format);
					
					if(pathitemDate && typeof pathitemDate.getFullYear === 'function'){						
						
						//prev date
						prevDate = new Date(prev_year, prev_month, prev_day);
						nextDate = new Date(next_year, next_month, next_day);						
											
						//zero time
						pathitemDate.setHours(0);
						pathitemDate.setMinutes(0);
						pathitemDate.setSeconds(0);
						
						if(pathitemDate >= prevDate && pathitemDate <= nextDate){
							resultDataview.push(dataitem);	
						}
					}
				}
			}
			
		}
		
		return resultDataview;
	};
	
	
	/**
	* autocomplete filter for jlocator: distance between the given point and store <= given radius
	* @param {number} latitude
	* @param {number} longitude
	* @param {string} name - the place name
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - stores dataview
	* @param {number} radius
	* @return {Array.<jQuery.fn.jplist.models.Dataitem>}
	* @memberOf jQuery.fn.jplist.actions.Filters
	*/
	jQuery.fn.jplist.actions.Filters.autocompleteFilter = function(latitude, longitude, name, dataview, radius){
	
		var resultDataview = []
			,latlng
			,distance
			,dataitem
			,store
			,sameCountry;
		
		if($.isNumeric(latitude) 
			&& $.isNumeric(longitude) 
			&& google
			&& jQuery.fn.jlocator
			&& jQuery.fn.jlocator.store){
			
			//init latlng
			latlng = new google['maps']['LatLng'](latitude, longitude);
			
			for(var i=0; i<dataview.length; i++){
			
				//get store
				dataitem = dataview[i];				
				store = new jQuery.fn.jlocator.store(dataitem.jqElement, {});
				
				if(store.country){
				
					//check if same country
					sameCountry = $.trim(store.country.toLowerCase()) == $.trim(name.toLowerCase());
				}
				else{
					sameCountry = false;
				}
				
				//get distance
				distance = google.maps.geometry.spherical.computeDistanceBetween(latlng, store['latlng']);				
								
				if(distance <= radius || sameCountry){
					resultDataview.push(dataitem);
				}
			}
			
			return resultDataview;
		}
		else{
			return dataview;
		}
	};
})(jQuery);

