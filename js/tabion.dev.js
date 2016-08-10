/*!
=====================================

Tabion jQuery by SONHLAB.com - version 1.0
website: http://sonhlab.com
Documentation: http://docs.sonhlab.com/tabion-jquery-responsive-tab-accordion/

=====================================
*/

(function($){

	var TabionObj = function(e, options){
	
		//Default settings
		var settings = $.extend({}, $.fn.tabion.defaults, options);
		
		var $tabid;
		var $animIn;
		var $timer;
		var $delay;
		var $pause=false;
		var movetab = {};
		var $curTab;
		var $newTab;
		var $viewWidth = $(e).width();
		var $winWidth = $(window).width();
		var $anim;
		var $autoplay = settings.autoPlay;
		var $move=false;
		var $responsive=false;
		var $ext;
		var $filepath;
				
		var $numTabs = $(e).find('.button-holder').find('.tabbt').length;
		var $lastTab = $numTabs-1;
		
		// Set index for slide
		for ( var $i=0; $i<$numTabs; $i++ ) {
			$(e).find('.button-holder').find('.tabbt').eq($i).attr('data-tabindex', $i);
		}
				
		
		// Start NextTab Function
		function NextTab() {

			if ( $pause == false && $responsive == false ) {
			
				$pause = true;
				
				movetab['left'] = '-'+$winWidth+'px';
				
				$curTab = $(e).find('.button-holder').find('.tab-active').attr('data-tabindex');
				$curTab = parseInt($curTab);
				
				$(e).find('.content-holder').animate(movetab, 200, 'swing',
				function(){
					clearTimeout($timer);
					
					$move=true;
					
					if ( $curTab < $numTabs-1 ) {
						// Set New Tab
						$newTab = $curTab+1;
					}
					else if ( $curTab >= $numTabs-1 ) {
						// Set New Tab
						$newTab = 0;
					}
					
					// Get Tab ID
					$tabid = $(e).find('.button-holder').find('.tabbt').eq($newTab).attr('data-tabid');
						
					$anim = false;
					
					// Prepare Tab Content Position
					$(e).find('.content-holder').css({'left':$winWidth+'px'});
					
					// Show New Tab Content
					ShowNewTab($tabid);
				});
			}
		}
		// End NextTab Function
		
		
		
		
		// Start PrevTab Function
		function PrevTab() {
		
			if ( $pause == false && $responsive == false ) {
			
				$pause = true;
				
				movetab['left'] = $winWidth+'px';
				
				$curTab = $(e).find('.button-holder').find('.tab-active').attr('data-tabindex');
				$curTab = parseInt($curTab);
				
				$(e).find('.content-holder').animate(movetab, 200, 'swing',
				function(){
					clearTimeout($timer);
					
					$move=true;
					
					if ( $curTab > 0 ) {
						$newTab = $curTab-1;
					}
					else if ( $curTab == 0 ) {
						$newTab = $lastTab;
					}
					
					// Prepare Tab Content Position
					$(e).find('.content-holder').css({'left':'-'+$winWidth+'px'});
					
					// Get Tab ID
					$tabid = $(e).find('.button-holder').find('.tabbt').eq($newTab).attr('data-tabid');
					
					$anim = false;
					
					// Show New Tab Content
					ShowNewTab($tabid);
				});
			}
		}
		// End PrevTab Function
		
	
		// Start AutoPlay Function
		function AutoPlay() {
			
			if ( $autoplay == true ) {
				
				$delay = $(e).find('.button-holder').find('.tab-active').attr('data-live');
				if ( $delay === undefined ) {
					$delay = settings.delay;
				}
				$delay = parseInt($delay);
				
				$timer = setTimeout(
					function(){
						if ( $pause == false && $responsive==false ) {
							
							$pause=true;
							
							$curTab = $(e).find('.button-holder').find('.tab-active').attr('data-tabindex');
							$curTab = parseInt($curTab);
							
							if ( $curTab < $numTabs - 1 ) {
								$newTab = $curTab + 1;
							}
							else { $newTab = 0 }

							$tabid = $(e).find('.button-holder').find('.tabbt').eq($newTab).attr('data-tabid');
							
							// Reset Active Tab
							$(e).find('.button-holder').find('.tabbt').removeClass('tab-active');
							$(e).find('.content-holder').find('.tabcontent').removeClass('tab-showcontent');
							
							// Set Active Tab
							$(e).find('.button-holder').find("div[data-tabid='"+ $tabid +"']").addClass('tab-active');
							
							// Play Animation Effect
							ShowNewTab($tabid);

						}
					}, $delay);

			}
		}
		// End AutoPlay Function
		

		
		
		
		// Start runAnim Function
		function runAnim() {
			
			if ( $(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").length > 0 ) {
				
				// Get Animation Effect
				$anim = $(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").attr('data-animIn');
				
				// Show Defaut Content
				$(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").addClass('tab-showcontent');
				
				// Play Animation Effect
				$(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").addClass($anim);
				
			}
			else { // Load AJAX Content
				AjaxLoad($tabid);
			}
				
			var resetAnim = window.setTimeout(
			function(){
				$(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").removeClass($anim);
				$pause = false;
			},1200);
			
		}
		// End runAnim Function
		
		
		// Start ShowNewTab Function
		function ShowNewTab($tabid) {
		
			$pause=true;
	
			// Reset Active Tab
			$(e).find('.button-holder').find('.tabbt').removeClass('tab-active');
				
			// Reset Tab Content Tab Content
			$(e).find('.content-holder').find('.tabcontent').removeClass('tab-showcontent');
			
			if ( $move==true ) { // Next or Prev
				// Set Active Tab
				$(e).find('.button-holder').find('.tabbt').eq($newTab).addClass('tab-active');
				
				// Get New Tabid
				$tabid = $(e).find('.button-holder').find('.tabbt').eq($newTab).attr('data-tabid');
				
				if ( $(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").length > 0 ) {
					// Show Defaut Content
					$(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").addClass('tab-showcontent');
				}
				else { // Load AJAX Content
					AjaxLoad($tabid);
				}
		
			}
			else {
				// Set Active Tab
				$(e).find('.button-holder').find("div[data-tabid='"+ $tabid +"']").addClass('tab-active');
			}
			
			// Play Javascript Animation
			$(e).find('.content-holder').animate({'left':'0px'}, 200, 'swing',
			function(){
			
				if ( $move==false ) {
					runAnim();
					
					if ( $responsive == true ) {
						$(e).find('.button-holder').find('.tabbt').css({'display':'none'});
						$(e).find('.responsive-tab').css({'display':'block'});
						
						$(e).find('.button-holder').css({'position':'absolute', 'z-index':'9998'});
						
						// Show Tab Control
						$(e).find('.tab-control').css({'display':'block'});
						
						$responsive=false;
					}
			
				}
				else {
					$pause = false;
				}
				
				// Run AutoPlay Function
				AutoPlay();
				
				$move=false;
			});
		
		}
		// End ShowNewTab Function
		
		
		
		// Start ClickTab Function
		function ClickTab($tab, $tabid) {
			
			// Check active status of the clicked tab
			if ( ! $($tab).hasClass('tab-active') ) {
				
				// Play Animation Effect
				ShowNewTab($tabid);
			
			}
			// End Check Active Status
		}
		// End ClickTab Function
		
		

		// Start AjaxLoad Function
		function AjaxLoad($tabid) {
			
			// Filename Extension
			$ext = $(e).find('.button-holder').find("div[data-tabid='"+ $tabid +"']").attr('data-ext');
			
			if ( $ext === undefined ) {
				$ext='php';
			}
			
			// New content file
			$filepath = 'content/tabion/'+$tabid+'.'+$ext;
			
			// Load new content
			$.ajax({
				url: $filepath,
				type:'POST',
				cache: false,
				success: function(tabcontent){
					if (tabcontent) {
						
						// Add new content
						$(e).find('.content-holder').append(tabcontent);
					
						// Show Defaut Content
						$(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").addClass('tab-showcontent');
						
						if ( $move==false ) {
							// Get Animation Effect
							$anim = $(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").attr('data-animIn');
							
							// Run Animation Effect
							$(e).find('.content-holder').find("div[data-tabid='"+ $tabid +"']").addClass($anim);
						}
				
					}
				},
				error: function(tabcontent) {
					alert('Error: Content not exist!');
				}
				
			});
			// End Ajax
			
		}
		// End AjaxLoad Function
		
		
		// Start to Load Default Content
		var $dftab = $(e).find('.button-holder').find('.tab-active:first').attr('data-tabid');
		
		$(e).find('.content-holder').find('.tabcontent').removeClass('tab-showcontent');
		
		if ( $(e).find('.content-holder').find("div[data-tabid='"+ $dftab +"']").length > 0 ) {
			// Show Defaut Content
			$(e).find('.content-holder').find("div[data-tabid='"+ $dftab +"']").addClass('tab-showcontent');
		}
		else { // Load AJAX Content
			AjaxLoad($dftab);
		}
		
		// Call AutoPlay Function
		AutoPlay();
		// End to Load Default Content
		
		
		
		// Start Show Play/Pause Button
		if ( $autoplay == true ) {
			$(e).find('.tab-control').find('.tabctrl-play').find('.icon-play').css({'display':'none'});
		}
		else {
			$(e).find('.tab-control').find('.tabctrl-play').find('.icon-pause').css({'display':'none'});
		}
		// End Show Play/Pause Button
		

		
		// Play and Pause Button Control
		$(e).find('.tab-control').find('.tabctrl-play').on('click',function() {
		
			if ( $autoplay == true ) { // Pause
				$(e).find('.tab-control').find('.tabctrl-play').find('.icon-pause').css({'display':'none'});
				$(e).find('.tab-control').find('.tabctrl-play').find('.icon-play').css({'display':'inline'});
				
				clearTimeout($timer);
				$autoplay=false;
			}
			else { // Play / Resume
				$(e).find('.tab-control').find('.tabctrl-play').find('.icon-play').css({'display':'none'});
				$(e).find('.tab-control').find('.tabctrl-play').find('.icon-pause').css({'display':'inline'});
				
				$autoplay=true;
				AutoPlay();
			}
		});
		
		

		// Start Click Responsive Button
		$(e).find('.responsive-tab').on('click', function() {
		
			$responsive=true;
			
			// Stop AutoPlay {
			$(e).find('.tab-control').find('.tabctrl-play').find('.icon-pause').css({'display':'none'});
			$(e).find('.tab-control').find('.tabctrl-play').find('.icon-play').css({'display':'inline'});
				
			clearTimeout($timer);
			$autoplay=false;
			// } Stop AutoPlay
				
		
			// Reset Active Tab
			$(e).find('.button-holder').find('.tabbt').removeClass('tab-active');
			
			// Hide Tab Content
			$(e).find('.content-holder').find('.tabcontent').removeClass('tab-showcontent');
			
			// Hide Control Buttons
			$(e).find('.tab-control').css({'display':'none'});
			
			// Hide Responsive Button
			$(this).css({'display':'none'});
			
			// Show All Tabs
			$(e).find('.button-holder').find('.tabbt').css({'display':'inline-block'});
			$(e).find('.button-holder').css({'position':'relative', 'z-index':'9999'});
		
		});
		// End Click Responsive Button
		
		
		
		// Click on a Tab Button
		$(e).find('.button-holder').find('.tabbt').on("click",
		function() {
			
			// Get Tab ID
			$tabid = $(this).attr('data-tabid');
			
			// Call ClickTab Fuction
			ClickTab(this, $tabid);
		
		});
		
		
		// Click Next Button
		$(e).find('.tab-control').find('.tabctrl-next').on('click',function(){
			NextTab();
		});
		
		
		// Click Prev Button
		$(e).find('.tab-control').find('.tabctrl-prev').on('click',function(){
			PrevTab();
		});
		
		
		// Press Left/Right Key to move Prev/Next Slide
		if ( settings.enableKeys == true ) {
			$(document).keydown(function(event) {
				if ( event.keyCode == 37 ) {
					PrevTab();
					return false;
				}
				else if ( event.keyCode == 39 ) {
					NextTab();
					return false;
				}
			});
		}
		
		// Swipe Left to Move Next
		if ( settings.enableSwipe == true ) {
			$(e).find('.content-holder').on('swipeleft', function(){
				NextTab();
			});
			
			// Swipe Right to Move Prev
			$(e).find('.content-holder').on('swiperight', function(){
				PrevTab();
			});
		}


	};
	
	
	
	$.fn.tabion = function(options) {
	
		return this.each(function(key, value){
					
			// Return early if this element already has a plugin instance
            if ($(this).data('tabion')) return $(this).data('tabion');
			
			// Pass options to plugin constructor
			var tabion = new TabionObj(this, options);
			
			// Store plugin object in this element's data
            $(this).data('tabion', tabion);
		
		});

	};
	
	
	
	//Default settings
	$.fn.tabion.defaults = {
		delay: 3000, // delay time (milisecond)
		autoPlay:false, // false | true
		enableSwipe:true, // false | true
		enableKeys:false // false | true
	};	
	
})(jQuery);