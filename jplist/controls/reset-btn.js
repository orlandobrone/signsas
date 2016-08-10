(function($){
	'use strict';		
	
	/** 
	* List/grid view control
	* @type {Object} 
    * @class Reset button control
    * @memberOf jQuery.fn.jplist
	*/
	jQuery.fn.jplist.controls.Reset = {};
			
	/**
	* Init control events
	* @param {jQuery.fn.jplist.view.PanelControl} control
	* @memberOf jQuery.fn.jplist.controls.Reset
	*/
	jQuery.fn.jplist.controls.Reset.initEvents = function(control){
	
		control.$control.off().click(function(){
		
			//force ask event			
			control.$jplistBox.trigger(control.options.force_ask_event, [true]);
		});
	};
	
})(jQuery);

