/*global jQuery:false */
(function($){
	'use strict';		
	
	/** 
	* Sort API
	* @type {Object} 
    * @class Sort actions (sort by number, text, datetime etc.)
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.actions.Sort = {};
	
	/**
	* get datetime format section/item
	* @param {string} replacedFormat
	* @return {string|number|null}
	*/
	var getDatetimeFormatItem = function(replacedFormat, datetimeString){
	
		var regex
			,regexValue
			,match
			,result = null;
		
		//init regex		
		regexValue = replacedFormat.replace(/{year}|{month}|{day}|{hour}|{min}|{sec}/g, '.*');
		regex = new RegExp(regexValue, 'g');
		
		//call match
		match = regex.exec(datetimeString);
		
		if(match && match.length > 1){
		   
			result = match[1];
		}
		
		return result;
	};
	
	/**
	* try parse datetime wilcard
	* @param {string|number} wilcard
	* @return {number}
	*/
	var formatTryParse = function(wilcard, value){
	
		var radix = 10
			,result = null;
		
		
		if(wilcard == '{month}'){
		
			value = value.toLowerCase();
			
			if(value === 'january' || value === 'jan' || value === 'jan.'){
				result = 0;
			}
			
			if(value === 'february' || value === 'feb' || value === 'feb.'){
				result = 1;
			}
			
			if(value === 'march' || value === 'mar' || value === 'mar.'){
				result = 2;
			}
			
			if(value == 'april' || value === 'apr' || value === 'apr.'){
				result = 3;
			}
			
			if(value === 'may'){
				result = 4;
			}
			
			if(value == 'july' || value === 'jun' || value === 'jun.'){
				result = 5;
			}
			
			if(value === 'april' || value === 'jul' || value === 'jul.'){
				result = 6;
			}
			
			if(value === 'august' || value === 'aug' || value === 'aug.'){
				result = 7;
			}
			
			if(value === 'september' || value === 'sep' || value === 'sep.'){
				result = 8;
			}
			
			if(value === 'october' || value === 'oct' || value === 'oct.'){
				result = 9;
			}
			
			if(value === 'november' || value === 'nov' || value === 'nov.'){
				result = 10;
			}
			
			if(value === 'december' || value === 'dec' || value === 'dec.'){
				result = 11;
			}
			
			if(result === null){
				result = parseInt(value, radix);
				
				if(!isNaN(result)){
					result--;
				}
			}
		}
		else{
			result = parseInt(value, radix);
		}
		
		
		
		return result;
	};
		
	/**
	* sort by index of dataitem (by id)
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem1
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem2
	* @param {string} order - sort order: asc or desc
	*/
	var sortIndex = function(dataitem1, dataitem2, order){
	
		var result
			,number1
			,number2;		
			
			//remove other characters
			number1 = dataitem1['index'];
			number2 = dataitem2['index'];
			
			if(number1 === number2){
				result = 0;
			}
			else{
				if(order == 'asc'){
					if(isNaN(number1)){
						result = 1;
					}	
					else{
						if(isNaN(number2)){
							result = -1;
						}
						else{
							result = number1 - number2;
						}
					}
				}
				else{
					if(isNaN(number1)){
						result = 1;
					}	
					else{
						if(isNaN(number2)){
							result = -1;
						}
						else{
							result = number2 - number1;
						}
					}
				}
			}
			
			return result;
	};
	
	/**
	* sort numbers
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem1
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem2
	* @param {string} order - sort order: asc or desc
	* @param {jQuery.fn.jplist.models.Path} path - path object	
	*/
	var sortNumbers = function(dataitem1, dataitem2, order, path){
	
		var pathitem1
				,pathitem2
				,number1
				,number2
				,result;
			
			pathitem1 = dataitem1.findPathitem(path);
			pathitem2 = dataitem2.findPathitem(path);			
			
			if(pathitem1 && pathitem2){
				//remove other characters
				number1 = parseFloat(pathitem1.text.replace(/[^0-9\.]+/g,''));
				number2 = parseFloat(pathitem2.text.replace(/[^0-9\.]+/g,''));
				
				if(number1 == number2){
					result = 0;
				}
				else{
					if(order == 'asc'){
						if(isNaN(number1)){
							result = 1;
						}	
						else{
							if(isNaN(number2)){
								result = -1;
							}
							else{
								result = number1 - number2;
							}
						}
					}
					else{
						if(isNaN(number1)){
							result = 1;
						}	
						else{
							if(isNaN(number2)){
								result = -1;
							}
							else{
								result = number2 - number1;
							}
						}
					}
				}
				
				return result;
			}
			else{
				return 0;
			}
	};
		
	/**
	* sort text
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem1
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem2
	* @param {string} order - sort order: asc or desc
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {string} ignore - remove characters regex expression
	*/
	var sortText = function(dataitem1, dataitem2, order, path, ignore){
		
		var pathitem1
			,pathitem2
			,text1
			,text2
			,regexExpr;
		
		pathitem1 = dataitem1.findPathitem(path);
		pathitem2 = dataitem2.findPathitem(path);	
		
		if(pathitem1 && pathitem2){
		
			if(ignore){
			
				//create regex
				regexExpr = new RegExp(ignore, 'ig');
				
				//remove other characters
				text1 = pathitem1.text.toString().replace(regexExpr, '').toLowerCase();
				text2 = pathitem2.text.toString().replace(regexExpr, '').toLowerCase();

			}
			else{
				
				//remove other characters
				text1 = pathitem1.text.toString().toLowerCase(); //.replace(/[^a-zA-Z0-9]+/g,'')
				text2 = pathitem2.text.toString().toLowerCase(); //.replace(/[^a-zA-Z0-9]+/g,'')
			}
			
			if(text1 == text2){
				return 0;
			}
			else{
				if(order == 'asc'){
					return text1 > text2 ? 1 : -1;
				}
				else{
					return text1 < text2 ? 1 : -1; 
				}
			}
		}
		else{
			return 0;
		}
	};
	
	/**
	* sort datetime
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem1
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem2
	* @param {string} order - sort order: asc or desc
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {string} dateTimeFormat
	*/
	var sortDatetime = function(dataitem1, dataitem2, order, path, dateTimeFormat){
	
		var pathitem1
			,pathitem2
			,date1
			,date2;
			
			pathitem1 = dataitem1.findPathitem(path);
			pathitem2 = dataitem2.findPathitem(path);			
			
			if(pathitem1 && pathitem2){
			
				//remove other characters
				if(!$.trim(dateTimeFormat)){
					date1 = new Date(Date.parse(pathitem1.text)); 
					date2 = new Date(Date.parse(pathitem2.text)); 
				}
				else{
					date1 = jQuery.fn.jplist.actions.Sort.formatDatetime(pathitem1.text, dateTimeFormat);
					date2 = jQuery.fn.jplist.actions.Sort.formatDatetime(pathitem2.text, dateTimeFormat);
				}
				
				if(date1 == date2){
					return 0;
				}
				else{
					if(order == 'asc'){
						return date1 > date2 ? 1 : -1; 
					}
					else{
						return date1 < date2 ? 1 : -1; 
					}
				}	
			}
			else{
				return 0;
			}
	};
	
	/**
	* Double Sort (recursive)
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem1
	* @param {jQuery.fn.jplist.models.Dataitem} dataitem2
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	* @param {number} index - index in the statuses array
	* @return {number} - -1, 0, 1
	*/
	var doubleSort = function(dataitem1, dataitem2, statuses, index){
	
		var result = 0
			,currentStatus
			,path
			,order;
		
		//check current status data type
		if(statuses.length > 0){
			
			//get current status
			currentStatus = statuses[index];
			
			if(currentStatus.data.path != 'default'){
			
				//get path
				path = new jQuery.fn.jplist.models.Path(currentStatus.data.path, currentStatus.data.type);
				
				//get order
				order = currentStatus.data.order;
				
				//get dtaetime format
				if(!currentStatus.data.dateTimeFormat){
				
					currentStatus.data.dateTimeFormat = '';
				}
				
				if(!currentStatus.data.ignore){
					currentStatus.data.ignore = '';
				}
				
				switch(currentStatus.data.type){
					
					case 'text':	
						
						result = sortText(dataitem1, dataitem2, order, path, currentStatus.data.ignore);
						break;
					
					case 'number':
						
						result = sortNumbers(dataitem1, dataitem2, order, path);
						break;
					
					case 'datetime':
						
						result = sortDatetime(dataitem1, dataitem2, order, path, currentStatus.data.dateTimeFormat);
						break;
					
					
					case 'date':
						
						result = sortDatetime(dataitem1, dataitem2, order, path, currentStatus.data.dateTimeFormat);
						break;
				}	
				
			}
			else{
				result = sortIndex(dataitem1, dataitem2, 'asc');				
			}	

			//if items are equal
			if(result === 0){
				
				if(index + 1 < statuses.length){
					
					//get result (recursive)
					result = doubleSort(dataitem1, dataitem2, statuses, index + 1);
				}
			}
			
		}
		
		return result;
	};
	
	/**
	* Get datetime from string with wildcards like {year}, {month}, {day}, {hour}, {min}, {sec}
	* @param {Date} datetime
	* @param {string} format
	* @return {Date}
	*/
	jQuery.fn.jplist.actions.Sort.formatDatetime = function(datetime, format){
	
		var formattedDatetime
			,replacedFormat
			,year
			,month
			,day
			,hour
			,minute
			,second;
			
			/*
			,specials = [
			  '/', '.', '*', '+', '?', '|',
			  '(', ')', '[', ']', '{', '}', '\\'
			];*/
			
		//special characters
		format = format.replace(/\./g, '\\.');	
		format = format.replace(/\(/g, '\\(');
		format = format.replace(/\)/g, '\\)');
		format = format.replace(/\[/g, '\\[');
		format = format.replace(/\]/g, '\\]');
		
		//get year
		replacedFormat = format.replace('{year}', '(.*)');
		year = getDatetimeFormatItem(replacedFormat, datetime);
		if(year){
			year = formatTryParse('{year}', year);
		}
		
		//get day
		replacedFormat = format.replace('{day}', '(.*)');
		day = getDatetimeFormatItem(replacedFormat, datetime);
		if(day){
			day = formatTryParse('{day}', day);
		}
		
		//get month: integer value representing the month, beginning with 0 for January to 11 for December		
		replacedFormat = format.replace('{month}', '(.*)');
		month = getDatetimeFormatItem(replacedFormat, datetime);
		if(month){
			month = formatTryParse('{month}', month);	
		}	
		
		//get hour: integer value representing the hour of the day (0-23)
		replacedFormat = format.replace('{hour}', '(.*)');
		hour = getDatetimeFormatItem(replacedFormat, datetime);
		if(hour){
			hour = formatTryParse('{hour}', hour);
		}
		
		//get minute: integer value representing the minute segment (0-59) of a time reading
		replacedFormat = format.replace('{min}', '(.*)');
		minute = getDatetimeFormatItem(replacedFormat, datetime);
		if(minute){
			minute = formatTryParse('{min}', minute);
		}
		
		//get second: integer value representing the minute segment (0-59) of a time reading
		replacedFormat = format.replace('{sec}', '(.*)');
		second = getDatetimeFormatItem(replacedFormat, datetime);
		if(second){
			second = formatTryParse('{sec}', second);
		}
		
		//check NaN/null/undefined values ---------------------------------------------------
		if(!year || isNaN(year)){
			year = 1900;
		}
		
		if(!month || isNaN(month)){
			month = 0;
		}
		
		if(!day || isNaN(day)){
			day = 1;
		}
		
		if(!hour || isNaN(hour)){
			hour = 0;
		}
		
		if(!minute || isNaN(minute)){
			minute = 0;
		}
		
		if(!second || isNaN(second)){
			second = 0;
		}
		
		formattedDatetime = new Date(year, month, day, hour, minute, second);
		
		return formattedDatetime;
	};
		
	/**
	* Main Sort
	* @param {Array.<jQuery.fn.jplist.models.Status>} statuses
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @memberOf jQuery.fn.jplist.actions.Sort
	*/
	jQuery.fn.jplist.actions.Sort.doubleSort = function(statuses, dataview){
	
		dataview.sort(function(dataitem1, dataitem2){	
			return doubleSort(dataitem1, dataitem2, statuses, 0);
		});
	};
	
	/**
	* Sort numbers api (not used directly in the plugin)
	* @param {string} order - sort order: asc or desc
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @memberOf jQuery.fn.jplist.actions.Sort
	*/
	jQuery.fn.jplist.actions.Sort.numbers = function(order, path, dataview){
	
		dataview.sort(function(dataitem1, dataitem2){
			return sortNumbers(dataitem1, dataitem2, order, path);
		});
	};
	
	/**
	* Sort text api (not used directly in the plugin)
	* @param {string} order - sort order: asc or desc
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @param {string} ignore - remove characters regex expression
	* @memberOf jQuery.fn.jplist.actions.Sort
	*/
	jQuery.fn.jplist.actions.Sort.text = function(order, path, dataview, ignore){
	
		dataview.sort(function(dataitem1, dataitem2){
			return sortText(dataitem1, dataitem2, order, path, ignore);
		});
	};
		
	/**
	* Sort datetime api (not used directly in the plugin)
	* @param {string} order - sort order: asc or desc
	* @param {jQuery.fn.jplist.models.Path} path - path object
	* @param {Array.<jQuery.fn.jplist.models.Dataitem>} dataview - collection dataview
	* @param {string} dateTimeFormat
	* @memberOf jQuery.fn.jplist.actions.Sort
	*/
	jQuery.fn.jplist.actions.Sort.datetime = function(order, path, dataview, dateTimeFormat){
	
		dataview.sort(function(dataitem1, dataitem2){
			return sortDatetime(dataitem1, dataitem2, order, path, dateTimeFormat);
		});
	};
	

})(jQuery);

