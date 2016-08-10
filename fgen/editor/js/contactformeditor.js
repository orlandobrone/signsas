var element_id;
var span_required = '<span class="cfg-required">*</span>';
var init_index_element = 0;
var notification_selectedemailinput_id;

var colorpicker_value;
var colorpicker_target;
var colorpicker_id;
var colorpicker_csspropertyname;

var saveform_btn_add = 'Save and create source files';
var saveform_btn_update = 'Save and update';

$(function()
{
	$('.header-btn, .addelement, .choice-confirmationmessage').disableSelection();
	
	// hide the colorpicker when the user click outside of it (necessary when displaying the colorpicker from the colorpicker-ico)
	$(document).mouseup(function (e)
	{
		//console.log(e.target);
		var container = $('.colorpicker');
	
		if(container.has(e.target).length === 0)
		{
			container.hide();
			
			// z-index default value must be 1 (check contactformeditor.css)
			// z-index is set to 2 in colorkit to put the colorpicker of the current element above the element-editor-container of the element below
			container.closest('.element-editor-container').css({'z-index':'1'});
			
		}
	});
	/* until v1.5:
	$('body').click(function(e){
		$('.colorpicker').hide();
	});
	*/
	
	
	
	// SET UP DIALOG BOX
	$('#cfg-dialog-message').dialog({
									autoOpen: false,
									modal: true,
									resizable:false,
									draggable:false,
									position: ['center', 200], width: 380
									});
	
	$('#dialog-changepassword').dialog({
									autoOpen: false,
									modal: true,
									resizable:false,
									draggable:false,
									position: ['center', 200]
									});
	
	$('#changepassword').click(function()
	{
		$('#user-password-1').val('');
		$('#user-password-2').val('');
		
		$('#dialog-changepassword').dialog({
				autoOpen: true,
				title: 'Change your password',
				buttons:{
					/*Close: function(){$(this).dialog('close');}*/
				}
			});		
	});
	
	
	addFormElement(elements);
	
	
	/**
	 * SORTABLE ELEMENTS
	 */
	$('#formeditor').sortable({
		placeholder: 'ui-state-highlight'
		,handle: '.cfg-move-element'
		,start: function(event, ui){
			$('.ui-state-highlight').css({'height':ui.item[0]['offsetHeight']});
		}

	});
	
		
	/**
	 * MOVE ELEMENT
	 */
	 
	$('body').on('mousedown','.cfg-move-element', function(){
		$(this).closest('.cfg-elementmove').addClass('elementisselected');
	});
	
	$('body').on('mouseup','.cfg-move-element',function(){
		$(this).closest('.cfg-elementmove').removeClass('elementisselected');
	});
 
	 
	/**
	 * ADD ELEMENTS IN THE EDITOR
	 */
	function addFormElement(elements)
	{
		
		if(init_index_element<elements.length)
		{

			var json_element = {};
			
			for(var element_property in elements[init_index_element])
			{  
				json_element[element_property] = elements[init_index_element][element_property];
			}
			
			json_element['default_fontfamily_formelement'] = default_fontfamily_formelement;
			json_element['default_fontfamily_label'] = default_fontfamily_label;
			json_element['default_fontfamily_paragraph'] = default_fontfamily_paragraph;
			json_element['default_fontfamily_submit'] = default_fontfamily_submit;
			json_element['default_fontfamily_title'] = default_fontfamily_title;
			
			json_element['default_fontsize_formelement'] = default_fontsize_formelement;
			json_element['default_fontsize_label'] = default_fontsize_label;
			json_element['default_fontsize_paragraph'] = default_fontsize_paragraph;
			json_element['default_fontsize_submit'] = default_fontsize_submit;
			json_element['default_fontsize_title'] = default_fontsize_title;
			
			json_element['default_fontweight_formelement'] = default_fontweight_formelement;
			json_element['default_fontweight_label'] = default_fontweight_label;
			json_element['default_fontweight_paragraph'] = default_fontweight_paragraph;
			json_element['default_fontweight_submit'] = default_fontweight_submit;
			json_element['default_fontweight_title'] = default_fontweight_title;
			
			json_element['default_color_formelement'] = default_color_formelement;
			json_element['default_color_label'] = default_color_label;
			json_element['default_color_paragraph'] = default_color_paragraph;
			json_element['default_color_submit'] = default_color_submit;
			json_element['default_color_title'] = default_color_title;
			
			json_element['default_backgroundcolor_submit'] = default_backgroundcolor_submit;
			json_element['default_bordercolor_submit'] = default_bordercolor_submit;
			
			json_element['default_width_date'] = default_width_date;
			json_element['default_width_email'] = default_width_email;
			json_element['default_width_input'] = default_width_input;
			json_element['default_width_paragraph'] = default_width_paragraph;
			json_element['default_width_submit'] = default_width_submit;
			json_element['default_width_textarea'] = default_width_textarea;
			
			
			json_element['default_bordercolor_inputformat'] = default_bordercolor_inputformat;
			json_element['default_borderradius_inputformat'] = default_borderradius_inputformat;
			json_element['default_borderwidth_inputformat'] = default_borderwidth_inputformat;
			json_element['default_padding_inputformat'] = default_padding_inputformat;
			
			json_element['default_rows_textarea'] = default_rows_textarea;
		
			json_element = JSON.stringify(json_element);
			// ^--- json_element must be a string, not an array. PHP error if array "Warning: json_decode() expects parameter 1 to be string, array given"
			
			//console.log(json_element);
			
			
			if($('#formeditor').find('.cfg-submit').html() != null)
			{
				$('#formeditor').find('.cfg-submit').last().closest('.cfg-elementmove').before('<div class="loading"><img src="img/loading.gif" /></div>');
			} else{
				$('#formeditor').append('<div class="loading"><img src="img/loading.gif" /></div>');
			}
			
			$.post('inc/setupcontactform.php',
					{element:json_element},
					function(data)
					{
						//console.log(data);
						
						var regex = /id="(\d+)"/gi;
						match = regex.exec(data);
						// 2 elements can't have the same id
						if (match && $('#'+match[1]).length > 0)
						{
							//alert('This element already exists: '+match[1]);
							$('.loading').remove();
							addFormElement(elements);
						} else{
							
							init_index_element++;
								
							if($('#formeditor').find('.cfg-submit').html() != null)
							{
								// .last() in case there are 2+ submit buttons in the form
								$('#formeditor').find('.cfg-submit').last().closest('.cfg-elementmove').before(data);
							} else{
								$('#formeditor').append(data);
							}
			
							$('.element-container').fadeIn();
							
							$('.loading').remove();
							
							addFormElement(elements);
						}
					});
		}
		
		if(init_index_element==elements.length)
		{
			init_index_element = 0;
		}

		$('.sortoption-container').sortable({
				placeholder: 'ui-state-highlight'
				,handle: '.sortoption-handle'
				,update: function(event, ui)
					{
						if($(this).closest('.element-container').find('.cfg-element-container select'))
						{
							// clean previously checked elements
							$(this).closest('.element-container').find('.cfg-element-container select option').each(function(){$(this).attr('selected', false)});

							
							$(this).closest('.element-container')
									.find('.editoption-container input')
									.each(function(){
										
										var inputindex = $(this).parent().index();
										
										var newoptionvalue = $(this).val();
										
										// new option/value value
										$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').val(newoptionvalue);
										
										// new option/label value
										$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').html(newoptionvalue);
										
										// new check status
										if($(this).closest('.editoption-container').find('.selected').html())
										{
											$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').attr('selected', true);
										}
									});
						}
						if($(this).closest('.element-container').find('.cfg-element-container radio') || $(this).closest('.element-container').find('.cfg-element-container checkbox'))
						{
							// clean previously checked elements
							$(this).closest('.element-container').find('.cfg-option-content input').each(function(){$(this).attr('checked', false)});
							
							$(this).closest('.element-container')
									.find('.editoption-container input')
									.each(function(){
												   
										var inputindex = $(this).parent().index();

										//var newoptionvalue = $(this).closest('.element-container').find('.editoption-container input:eq('+inputindex+')').val();
										var newoptionvalue = $(this).val();
										
										// new input value
										$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+') input').val(newoptionvalue);
										
										// new label value
										$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+') label').text(newoptionvalue);
										
										// new check status
										if($(this).closest('.editoption-container').find('.selected').html())
										{
											//alert($(this).closest('.editoption-container').find('.selected').html());
											$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+') input').attr('checked', true);
										}
										
									});
							
						}
					} // end update method
		}); // end sortable
		
		
		returnToFormEdition();
	}
	
	
	
	$('#addCheckbox').click(function(){
		addFormElement([{'type':'checkbox'}]);
	});
	
	$('#addDate').click(function(){
		addFormElement([{'type':'date'}]);
	});
	
	$('#addEmail').click(function(){
		addFormElement([{'type':'email'}]);
	});
	
	$('#addImage').click(function(){
		addFormElement([{'type':'image'}]);
	});
	
	$('#addInputText').click(function(){
		addFormElement([{'type':'text'}]);
	});
	
	$('#addParagraph').click(function(){
		addFormElement([{'type':'paragraph'}]);
	});
	
	$('#addRadio').click(function(){
		addFormElement([{'type':'radio'}]);
	});
	
	$('#addSelect').click(function(){
		addFormElement([{'type':'select'}]);
	});
	
	$('#addSelectMultiple').click(function(){
		addFormElement([{'type':'selectmultiple'}]);
	});
	
	$('#addSubmit').click(function(){
		if($('.cfg-submit').length)
		{
			
			$('#cfg-dialog-message').html('<p>There can be only one submit button in the form.</p>');
			
			$('#cfg-dialog-message').dialog({
					autoOpen: true,
					title: 'Error',
					buttons:{
						Ok: function(){$(this).dialog('close');}
					}
			});		
			
			
		} else{
			addFormElement([{'type':'submit'}]);
		}
	});
	
	$('#addTextArea').click(function(){
		addFormElement([{'type':'textarea'}]);
	});
	
	$('#addTitle').click(function(){
		addFormElement([{'type':'title'}]);
	});
	
	$('#addTime').click(function(){
		addFormElement([{'type':'time'}]);
	});
	
	$('#addUpload').click(function(){
		addFormElement([{'type':'upload'}]);
	});
	
	$('#addCaptcha').click(function(){
		
		if($('.cfg-captcha-img').length)
		{
			
			$('#cfg-dialog-message').html('<p>There can be only one captcha field in the form.</p>');
			
				$('#cfg-dialog-message').dialog({
					autoOpen: true,
					title: 'Error',
					buttons:{
						Ok: function(){$(this).dialog('close');}
					}
				});		
			
			
		} else{
			addFormElement([{'type':'captcha'}]);
		}
	});
	
	$('#needhelp').click(function(){
		
			
		$('#cfg-dialog-message').html('<p>You need help with Contact Form Generator?<br />You found a bug?<br /><br />Contact us at: support@topstudiodev.com<br/><br/>We will get back to you in less than 24 hours.</p>');
			
		$('#cfg-dialog-message').dialog({
				autoOpen: true,
				title: 'Help',
				buttons:{
					Ok: function(){$(this).dialog('close');}
				}
		});		
	});
	
	
	
	/**
	 * ELEMENT ROLLOVER
	 */
	
	$('body').on('mouseenter', '.element-container', function(){
		$(this).find('.element-editor-container').fadeIn(60);
		$(this).addClass('elementisselected');
		
	});
	
	$('body').on('mouseleave', '.element-container', function(){
	
		if(!$(this).find('.element-editor').is(':visible'))
		{
			$(this).find('.element-editor-container').hide();
			$(this).removeClass('elementisselected');
		}
	});
	
	
	
	/**
	 * SELECT A STYLE ( FONTS AND COLORS )
	 */
	$('#select-style').click(function(){
		$('#samplecontainer').slideToggle('fast');
		$('#textinputformat-container').hide();
		
		returnToFormEdition();
	});
	
	
	/**
	 * TEXT INPUT FORMAT
	 */
	$('#textinputformat').click(function(){
		$('#textinputformat-container').slideToggle('fast');
		$('#samplecontainer').hide();
		
		returnToFormEdition();
	});
	
	
	/**
	 * EXPAND ALL / COLLAPSE ALL
	 */
	$('.expandall').click(function(){
		$(this).hide();
		$('.collapseall').show()	;
		$('.element-container').addClass('elementisselected');
		
		$('.element-container').each(function(){
											  
			var btn_hook = $(this).find('.elementconfiguration');
			
			if(!btn_hook.length)
			{	// paragraph elements don't have elementconfiguration btn
				btn_hook = $(this).find('.cfg-element-btn-paragraph');
			}
			//console.log(btn_hook);
			
			//$(this).closest('.element-container').find('.element-editor-container').show();
			
			configureElementContainerHeight(btn_hook, 'expandall');
			
		});
	});
	
	$('.collapseall').click(function(){
		$(this).hide();
		$('.expandall').show();
		$('.element-container').removeClass('elementisselected');
		
		$('.element-container').each(function(){
											  
			var btn_hook = $(this).find('.elementconfiguration');
			
			if(!btn_hook.length)
			{	// paragraph elements don't have elementconfiguration btn
				btn_hook = $(this).find('.cfg-element-btn-paragraph');
			}
			//console.log(btn_hook);
			
			//$(this).closest('.element-container').find('.element-editor-container').hide();
			
			configureElementContainerHeight(btn_hook, 'collapseall');
			
		});
		
	});
	
	
	/***
	 * CLEAR FORM
	 */
	$('#clearform').click(function(){
								   
		var html = '<p>Are you sure you want clear this form and delete all its elements? There is no undo.</p>';
		
		if($('#form_id').val())
		{
			html += '<p>Notice: you are currently working on form #'+$('#form_id').val()+'. ';
			html += 'If you want to create a new form with a new #id, click on the "New form" button in the top right corner instead.</p>';
		};
		
		$('#cfg-dialog-message').html(html);
		
		$('#cfg-dialog-message').dialog({
			autoOpen: true,
			title: 'Clear form',
			buttons: {
								
				'Delete all items': function() {
					$(this).dialog('close');
					$('#formeditor').empty();
					returnToFormEdition();
				},
				Cancel: function() {
					$(this).dialog('close');
				}
			}
		});
		
	});
	
	/***
	 * NEW FORM
	 */
	$('#newform').click(function(){

		$('#cfg-dialog-message').html('<p>Please select an option below to create your new form.</p>');
			
		$('#cfg-dialog-message').dialog({
				autoOpen: true,
				title: 'New form',
				buttons: {
							
					'Start from scratch': function() {
						$(this).dialog('close');
						$('#formeditor').empty();
						$('#form_id').val('');
						returnToFormEdition();
					},
					'Start with this template': function() {
						$(this).dialog('close');
						$('#form_id').val('');
						returnToFormEdition();
					},
					Cancel: function() {
						$(this).dialog('close');
					}
					
				}
		});		
	});
	
	
	/**
	 * SHOW ELEMENT CONFIGURATION
	 */
	function setElementContainerHeight(element_editor_to_toggle){
		

		var element_container = 	element_editor_to_toggle.closest('.element-container');
		//	element_container.css({'background-color': '#ff0033'});
		
		//var container_default_height = element_container_default_height[element_container.attr('id')];
		var container_default_height = parseInt(element_container.find('.cfg-element-container').innerHeight());
		
		//var element_editor_height = parseInt(element_container.find(element_editor_to_toggle).innerHeight());
		var element_editor_height = parseInt(element_container.find('.element-editor-container').innerHeight());
		
		
		if(element_editor_height>container_default_height)
		{
			//	console.log('right editor >  left element');
			var new_element_container_height = element_editor_height;
		} else{
			// 	console.log('left element > right editor');
			var new_element_container_height = container_default_height;
		}
		
		element_container.css({'height':new_element_container_height});
		
		
		//	console.log('container_default_height: '+container_default_height);
		//	console.log('element_editor_height:' +element_editor_height);
		//	console.log('new_element_container_height = container_default_height+element_editor_height:' +new_element_container_height);
		// console.log('=============================');
	}
	
	
	function configureElementContainerHeight(hook_target, mode)
	{
		var btn = $(hook_target);
		var element_container = 	$(hook_target).closest('.element-container');
		var element_editor = element_container.find('.element-editor');
		var element_editorcontainer = $(hook_target).closest('.element-editor-container'); // only for toggling the btn class
		
		if(!element_container_default_height[element_container.attr('id')])
		{
			element_container_default_height[element_container.attr('id')] = element_container.find('.cfg-element-container').innerHeight();
		}
		
		if(btn.is('.elementconfiguration'))
		{
			element_container.find('.cfg-edit-alignment-container').hide();
			element_container.find('.cfg-edit-paragraph-container').hide();
			var element_editor_to_toggle = '.cfg-edit-properties-container';
		}
		
		if(btn.is('.cfg-element-btn-alignment'))
		{
			element_container.find('.cfg-edit-properties-container').hide();
			element_container.find('.cfg-edit-paragraph-container').hide();
			var element_editor_to_toggle = '.cfg-edit-alignment-container';
		}
		
		if(btn.is('.cfg-element-btn-paragraph'))
		{
			element_container.find('.cfg-edit-properties-container').hide();
			element_container.find('.cfg-edit-alignment-container').hide();
			var element_editor_to_toggle = '.cfg-edit-paragraph-container';
		}
		element_editor_to_toggle = element_container.find(element_editor_to_toggle);
		
		var element_editor_height = parseInt(element_container.find(element_editor_to_toggle).innerHeight());

		
		if(parseInt(element_container.find('.cfg-element-container').innerHeight()) >= element_container_default_height[element_container.attr('id')])
		{
			//console.log('new content overlap');
			element_container_default_height[element_container.attr('id')] = parseInt(element_container.find('.cfg-element-container').innerHeight());
	
		}
		
		if(parseInt(element_container.find('.cfg-element-container').innerHeight()) < element_editor_height)
		{
			//console.log('new content no overlap');
			element_container_default_height[element_container.attr('id')] = element_container.innerHeight();

		}
		
		var slide_speed = 50;
		
		if(mode == 'toggle')
		{
			element_editor_to_toggle.slideToggle(slide_speed,
																	function(){
																		if($(this).is(':visible')){ // opened: adjust the container to the editor height
																			setElementContainerHeight(element_editor_to_toggle);
																			
																			// /!\ /!\ the same adusment must also be applied for mode = expandall
																			element_editorcontainer.find('.editelement-menu').removeClass('cfg-editelement-menu-btn-active');
																			btn.addClass('cfg-editelement-menu-btn-active');
	
																		} else{
																			// closed
																			// adjusted to cfg-element-container innerHeight for the case when the height of the left content increases dynamically (paragraph value, textarea rows, adding options, paragraph value+element, etc)
																			// /!\ /!\ the same adusment must also be applied when .cfg-close-edit is clicked and for mode = collapseall
																			element_container.css({'height':parseInt(element_container.find('.cfg-element-container').innerHeight())});
																			btn.removeClass('cfg-editelement-menu-btn-active');
																		}
																	});
		}
		
		if(mode == 'expandall')
		{

			element_editor_to_toggle.slideDown(slide_speed,
																	function(){
																		//console.log('expand all');
																		btn.closest('.element-editor-container').show(); // only for expand all
																		
																		setElementContainerHeight(element_editor_to_toggle);
																		element_editorcontainer.find('.editelement-menu').removeClass('cfg-editelement-menu-btn-active');
																		btn.addClass('cfg-editelement-menu-btn-active');
																	});
		}
		
		if(mode == 'collapseall')
		{
			
			element_editor_to_toggle.slideUp(slide_speed,
																function(){
																	//console.log('collapse all');
																	btn.closest('.element-editor-container').hide(); // only for collapse all
																	
																	element_container.css({'height':parseInt(element_container.find('.cfg-element-container').innerHeight())});
																	btn.removeClass('cfg-editelement-menu-btn-active');
																});
		}
	}
	
	
	$('body').on('click', '.elementconfiguration, .cfg-element-btn-alignment, .cfg-element-btn-paragraph', function(){
		configureElementContainerHeight($(this), 'toggle');
	});
	
	$('body').on('click', '.cfg-close-edit', function(){
												   
		var close_btn = $(this);
		
		close_btn.css('cursor','default'); // prevent from having the hand cursor after the element slided up
		
		var element_container = 	$(this).closest('.element-container');
		
		$(this).closest('.element-container').removeClass('elementisselected');
	
		$(this).closest('.element-container').find('.element-editor-container').slideUp(100,
																										function(){
																											$(this).closest('.element-container').find('.element-editor').hide();
																											close_btn.css('cursor','pointer'); // the element slidedup, the close button can gets its hand style
																											
																											// height adjustment (same adjustmen in on('click', '.elementconfiguration, .cfg-element-btn-alignment, .cfg-element-btn-paragraph',
																											element_container.css({'height':parseInt(element_container.find('.cfg-element-container').innerHeight())});
																										});
		
	});
	
	
	
	/**
	 * EDIT LABEL
	 */

	$('body').on('keyup focusout', '.editlabel', function()
	{
		var element_type = $(this).closest('.element-container').find('.exportelement-type').val();

		// TITLE
		if(element_type == 'title'){
			$(this).closest('.element-container').find('.cfg-title').text($(this).val());			
		}
		
		// SUBMIT
		else if(element_type == 'submit'){
			$(this).closest('.element-container').find('.cfg-element-container input').val($(this).val());
		}
		
		else{
			$(this).closest('.element-container').find('.cfg-element-container label:eq(0) .cfg-label-value').text($(this).val());
		}
		
	});
	
	
	/**
	 * EDIT PARAGRAPH
	 */
	$('body').on('keyup focusout', '.edit-paragraph', function()
	{
		var element_container = $(this).closest('.element-container');
		
		var paragraph = element_container.find('.cfg-paragraph');
		
		var text = $(this).val().replace(/\r?\n|\r/g, '<br />');
		
		paragraph.html(text);
		
		
		if(paragraph.html())
		{ // ^-- labelfloatparagraphwidth
			paragraph.css({'width':element_container.find('.slider-paragraph-width-value').val()+'px'});
		} else{
			paragraph.css({'width':''});
		}
		
		adjustElementHeightToLeftContent(element_container);
	});
	
	
	
	/**
	 * EDIT IMAGE FROM URL
	 */
	$('body').on('click', '.addimagefromurl', function()
	{
		// get url value
		var image_url = $.trim($(this).closest('.element-editor').find('.image_url').val());
		
		if(image_url)
		{
			var element_container = $(this).closest('.element-container');
			
			// add image in the form
			element_container.find('.addimagecontainer').remove();
			element_container.find('.cfg-element-content').empty().append('<img src="'+image_url+'" />');
			$(this).closest('.element-editor').find('.delimagefromurl').remove();
			
			// add delete button
			$(this).after('<div><span class="delimagefromurl">Delete</span></div>');
			
			// adjust element height after the image is loaded
			element_container.find('.cfg-element-content img').load(function(){
				adjustElementHeightToLeftContent(element_container);

			});
			
			
			// imagefromurl after imagefromupload
			if($(this).closest('.element-editor').find('.uploadimagefilename').val())
			{
				
				var filename = $(this).closest('.element-editor').find('.uploadimagefilename').val();
				var delimgbutton = $(this);

				$.post('inc/editimage-delete.php', 
						{filename:Array(filename)},
						function(data)
						{
							delimgbutton.closest('.element-editor').find('.uploadsuccess-container').hide();
		
						}
				);
				
			}
		}
		
	});
	
	/**
	 * DELETE IMAGE FROM URL
	 */
	$('body').on('click', '.delimagefromurl', function()
	{
		$(this).closest('.element-editor').find('.image_url').val('');
		resetImageContainer($(this));
		$(this).closest('.element-editor').find('.delimagefromurl').remove(); // must come after resetImageContainer as the dom element is passed as an argument in the function
		
		// the height adjustment of the element container is done inside resetImageContainer
	});
	
	/**
	 * DELETE IMAGE FROM UPLOAD
	 */
	$('body').on('click', '.delimagefromupload', function()
	{
		resetImageContainer($(this));
		var uploadimagesuccesscontainer = $(this).closest('.uploadsuccess-container');
		var filename = uploadimagesuccesscontainer.find('.uploadimagefilename').val();
		var delimgbutton = $(this);
		delimgbutton.hide();
		uploadimagesuccesscontainer.find('.uploadimageloading').show();
		
		$.post('inc/editimage-delete.php', 
			 	{filename:Array(filename)},
				function(data)
				{
					uploadimagesuccesscontainer.find('.uploadimageloading').hide();
					uploadimagesuccesscontainer.hide();
					uploadimagesuccesscontainer.find('.uploadimagehtmlfilename').empty(); // shows file name
					uploadimagesuccesscontainer.find('.uploadimagefilename').val(''); // contains the name of the file
					delimgbutton.show();
				}
		);
	});
	
	/**
	 * RESET IMAGE CONTAINER
	 */
	function resetImageContainer(e){
		$(e).closest('.element-container').find('.cfg-element-content').empty().append(html_empty_image_container);
		
		setElementContainerHeight(jQuery(e).closest('.element-container').find('.cfg-edit-properties-container'));
	}


	/**
	 * EDIT LABEL PLACEMENT AND ALIGNMENT
	 */
	$('body').on('click', '.label-positionning', function(){
		
		// display: block; alrady set in contactform.css for cfg-label
		var element_container = $(this).closest('.element-container');
		
		if($(this).is('.aligntop'))
		{
			// 'width':'' remove the width property if clicked after left or right alignment
			element_container.find('.cfg-label').css({'float':'none', 'text-align':'left', 'width':''});
			
			element_container.find('.cfg-elementeditor-label-width').slideUp(50, function(){
																								element_container
																								.find('.cfg-elementeditor-option-margintop')
																								.slideUp(50, function(){
																									setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
																								});
																						  });
			
			element_container.find('.sliderelement-label-width-value').val(0);
			
			// reset option margin to^^
			element_container.find('.sliderelement-option-margintop-value').val(default_margintop_option);
			element_container.find('.cfg-elementeditor-option-margintop').find('.ui-slider').slider('option', 'value', default_margintop_option);

		}
		
		if($(this).is('.alignleft'))
		{
			element_container.find('.cfg-label').css({'text-align':'left'});
		}
		
		if($(this).is('.alignright'))
		{
			element_container.find('.cfg-label').css({'text-align':'right'});
		}
		
		if($(this).is('.alignleft') || $(this).is('.alignright'))
		{
			if(!element_container.find('.cfg-elementeditor-label-width').is(':visible')) // prevents reseting the slider and element position by clicking on alignleft after using the width slider
			{
				// removes the width of the paragraph (else the paragraph width will make the right content not take the full right side width. Can be verified with checkbox for example. Ref: labelfloatparagraphwidth )
				var paragraph = element_container.find('.cfg-paragraph');
				if(!paragraph.html())
				{
					paragraph.css({'width':''});
					
				}
				
				element_container.find('.cfg-element-set').css({'float':'left'}); 
				
				element_container.find('.sliderelement-label-width-value').val(default_width_label); // inserting the label width in the json data is based on the width value in the input
				
				element_container.find('.cfg-elementeditor-label-width').find('.ui-slider').slider('option', 'value', default_width_label);
	
				element_container.find('.cfg-label').css({'float':'left', 'width':element_container.find('.sliderelement-label-width-value').val()+'px'});

				element_container.find('.cfg-elementeditor-label-width').slideDown(50, function(){
																									
																									// for radio and checkbox elements (the containerHeight must be set after the margin top edit box appears
																									if(element_container.find('.cfg-elementeditor-option-margintop').length)
																									{
																										element_container
																										.find('.cfg-elementeditor-option-margintop')
																										.slideDown(50, function(){
																											  setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
																										});
																									} 
																									// for the other input elements having labels
																									else{
																										  setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
																									}
																						
																						  		});
			}
			
		}
			
		adjustElementSetWidth($(this)); // must be called in anycase to set or remove cfg-element-set width

	});
	

	/**
	 * EDIT OPTION PLACEMENT AND ALIGNMENT
	 */
	$('body').on('click', '.option-positionning', function(){
		
		// display: block; alrady set in contactform.css for cfg-label
		var element_container = $(this).closest('.element-container');
		
		if($(this).is('.aligntop'))
		{
			// 'width':'' remove the width property if clicked after left or right alignment
			element_container.find('.cfg-option-content').css({'float':'none', 'text-align':'left', 'width':''});
			
			element_container.find('.cfg-elementeditor-option-width').slideUp(100, function(){
																								  		setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
																								});
			
			element_container.find('.sliderelement-option-width-value').val(0); // inserting the label width in the json data is based on the width value in the input
		}
		
		if($(this).is('.alignleft'))
		{
			
			if(!element_container.find('.cfg-elementeditor-option-width').is(':visible')) // prevents reseting the slider and element position by clicking on alignleft after using the width slider
			{
				element_container.find('.sliderelement-option-width-value').val(default_width_option); // inserting the label width in the json data is based on the width value in the input
				
				element_container.find('.cfg-elementeditor-option-width').find('.ui-slider').slider('option', 'value', default_width_option);
				
				var css = {};
				css['width'] = element_container.find('.sliderelement-option-width-value').val();
				
				element_container.find('.cfg-option-content').css(buildAlignOptionLeftCss(css));
				
				element_container.find('.cfg-elementeditor-option-width').slideDown(100, function(){
																								  		setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
																								  });
			}
			
		}

		adjustElementSetWidth($(this)); // must be called in anycase to set or remove cfg-element-set width
		
	
	});
	
	function buildAlignOptionLeftCss(css)
	{
		return ({'float':'left', 'width':css['width']+'px'});
	}
	

	/**
	 * EDIT TIME - ADD REMOVE AM PM
	 */
	$('body').on('click', '.12hourclock', function(){
		$(this).closest('.element-container').find('.cfg-time-ampm').show();
		$(this).closest('.element-container').find('.cfg-time-hour').empty();
		var houroptions = buildSelectHourOptions(12);
		$(this).closest('.element-container').find('.cfg-time-hour').append(houroptions);
	});
	
	$('body').on('click', '.24hourclock', function(){
		$(this).closest('.element-container').find('.cfg-time-ampm').hide();
		$(this).closest('.element-container').find('.cfg-time-hour').empty();
		var houroptions = buildSelectHourOptions(24);
		$(this).closest('.element-container').find('.cfg-time-hour').append(houroptions);
	});
	
	
	function buildSelectHourOptions(timeformat)
	{
		var houroptions = '';
		
		if(timeformat == 12){
			var i_start = 1;
			var i_end = 13;
		}
		if(timeformat == 24){
			var i_start = 0;
			var i_end = 24;
		}
		
		for(var i = i_start; i < i_end; i++){ 
			var i_zeropadding = ('00' + i.toString()).substr(i.toString().length);
			houroptions += "\r\n\t"+'<option value="'+i_zeropadding+'">'+i_zeropadding+'</option>';
		}
		
		return houroptions;
	}
	
	
	/*
	 * EDIT OPTION VALUE
	 */

	$('body').on('keyup focusout', '.editoption', function(){
		if( $(this).hasClass('radio') || $(this).hasClass('checkbox') )
		{
			var inputindex = $(this).parent().index();
			$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+') label').text($(this).val());
			$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+') input').val($(this).val());
		}
		
		if($(this).hasClass('select') || $(this).hasClass('selectmultiple'))
		{
			var inputindex = $(this).parent().index();
			newoption = $(this).val();
	
			var selectedoption_index = $(this).closest('.element-container').find('.cfg-element-container select option:selected').index(); // FF: focus on the current selected option
	
			$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').val($(this).val());
			$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').text($(this).val());
			$(this).closest('.element-container').find('.cfg-element-container select option:eq('+selectedoption_index+')').attr('selected',true); // FF: focus on the current selected option
		}
	});
	

	
	
	/**
	 * DELETE OPTION
	 */

	$('body').on('click', '.cfg-deleteoption', function()
	{
		var delete_btn = $(this);
		var inputindex = $(this).parent().index();
		
		if($(this).closest('.element-container').find('.editoption-container').length ==1)
		{
			
			$('#cfg-dialog-message').html('<p>You can\'t delete all choices.</p>');
			
			$('#cfg-dialog-message').dialog(
			{
				autoOpen: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				}
			});
				
			return false;
			
		} else
		{
			
			if( $(this).hasClass('radio') || $(this).hasClass('checkbox') )
			{
			
				$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+')').remove();
			}
			
			if($(this).hasClass('select') || $(this).hasClass('selectmultiple'))
			{
				$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').remove();		
			}
			
			$(this).closest('.editoption-container').slideUp(200,function(){
																		  setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container')); // must be called before the removal of the button, or it won't work, since delete_btn is removed
																		  
																		  $(this).remove();// must be called after inputindex, else index returns -1
																		  
																		  }); 
		}
		
		
	});




	/**
	 * ADD OPTION
	 */
	$('body').on('click', '.cfg-addoption', function()
	{
		var inputindex = $(this).parent().index();
		element_id = $(this).closest('.element-container').prop('id');
		
		if($(this).hasClass('radio'))
		{
			
			// form option
			$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+')').after(html_optionradiocontainer);
			
			// editform option
			$(this).closest('.editoption-container').after(html_editoptionradiocontainer);
			
		}
		
		if($(this).hasClass('checkbox'))
		{
			// form option
			$(this).closest('.element-container').find('.cfg-option-content:eq('+inputindex+')').after(html_optioncheckboxcontainer);
		
			// editform option
			$(this).closest('.editoption-container').after(html_editoptioncheckboxcontainer);
		}
		
		
		// update id, name and for attributes on the input and on the label
		if($(this).hasClass('radio') || $(this).hasClass('checkbox'))
		{
			var element_container = $(this).closest('.element-container');
			
			
			$(this).closest('.element-container').find('.cfg-option-content').each(function()
			{
				var option_container = $(this).closest('.cfg-option-content');
				var option_index = $(this).closest('.element-container').find('.cfg-option-content').index(option_container);
				//console.log($(this).index()+ ' / '+option_index);
						
				$(this).find('input').attr('id', element_name_prefix+element_id+'-'+option_index)
											.attr('name', element_name_prefix+element_id);
											
				// the id attribute for option label is useless
				$(this).find('label').attr('for', element_name_prefix+element_id+'-'+option_index);
				
			});
		

					
			// apply the current style of formelement to .formelement
			// if not applied, the new options added keep the launch default format values of formelements
			var html_form_newoption_container = element_container.find('.cfg-option-content:eq('+(inputindex+1)+')');
			html_form_newoption_container.css('font-family', default_fontfamily_formelement);
			html_form_newoption_container.css('font-size', default_fontsize_formelement+'px');
			html_form_newoption_container.css('color', default_color_formelement);
			if(default_fontweight_formelement == 'italic')
			{
				html_form_newoption_container.css('font-style', default_fontweight_formelement);
			} else{
				html_form_newoption_container.css('font-weight', default_fontweight_formelement);
			}
			
			
			// alignment: only apply to current and new options when the alignment is set to left
			if(element_container.find('.option-positionning:checked').val() == 'alignleft')
			{
				var css = {};
				css['width'] = element_container.find('.sliderelement-option-width-value').val();
				element_container.find('.cfg-option-content').css(buildAlignOptionLeftCss(css));
			}

		
		}
		
		if($(this).hasClass('select') || $(this).hasClass('selectmultiple'))
		{
		
			// form option
			$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').after("\r\n\t"+html_selectoption);
			
			// editform option
			if($(this).hasClass('select'))
			{
				$(this).closest('.editoption-container').after(html_editselectoptioncontainer);
			}
			
			if($(this).hasClass('selectmultiple'))
			{
				$(this).closest('.editoption-container').after(html_editselectmultipleoptioncontainer);
			}
			
			
		}
		
		$(this).closest('.editoption-container').next().hide().slideDown(100, 
																		 				function(){
																							setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
																						});
		
		
	});




	/**
	 * SET DEFAULT OPTION
	 */
	
	$('body').on('click', '.defaultoption', function()
	{
		var inputindex = $(this).parent().index();
		
		// RADIO CHECKBOX
		if( $(this).hasClass('radio') || $(this).hasClass('checkbox') )
		{
				// clean previously checked elements
				$(this).closest('.element-container').find('.cfg-option-content input').each(function(){$(this).attr('checked', false)});

				if($(this).hasClass('radio'))
				{
					$(this).closest('.sortoption-container').find('.radiocheck').removeClass('selected'); // for radio, all radio buttons must be reset in the editoption container
					
					// clean previously checked elements in editor
					$(this).closest('.element-container').find('.radiocheck').hide(); // all radio buttons must be reset in the editoption container
					$(this).closest('.element-container').find('.radiouncheck').show(); // all radio buttons must be reset in the editoption container
				}
				
				
				if($(this).hasClass('radiocheck'))
				{
					$(this).removeClass('selected');
					$(this).hide();
					$(this).prev().show();
					
				} else{
					$(this).next().addClass('selected');
					$(this).hide();
					$(this).next().show();
				}
				
				// foreach option checked, we check the associated input
				$(this).closest('.sortoption-container').find('.selected').each(function()
				{
					var option_selected_index = $(this).parent().index();
					//console.log(option_selected_index);
					$(this).closest('.element-container').find('.cfg-option-content input:eq('+option_selected_index+')').attr('checked', true);
				});
		}
		
		// SELECT
		if($(this).hasClass('select'))
		{
				$(this).closest('.sortoption-container').find('.radiocheck').removeClass('selected'); // for select, all radio buttons must be reset in the editoption container
		
				// clean previously checked elements
				$(this).closest('.element-container').find('.cfg-element-container select option').each(function(){$(this).attr('selected', false)});
				$(this).closest('.element-container').find('.radiouncheck').show(); // 2 for radio img, every radio button must be reset in the editoption container
				$(this).closest('.element-container').find('.radiocheck').hide(); // 2 for radio img, every radio button must be reset in the editoption container
				
				if($(this).hasClass('radiocheck'))
				{
					$(this).removeClass('selected');
					$(this).hide();
					$(this).prev().show();
					
					
					// all options are unselected after cleaning, if the same option is clicked twice, the focus is lost and a blank selection appears in IE and chrome
					if(!$(this).closest('.element-container').find('.cfg-element-container select option:selected').html()){
						$(this).closest('.element-container').find('.cfg-element-container select option:eq(0)').attr('selected', true);
					}
				} else{
					$(this).next().addClass('selected');
					$(this).hide();
					$(this).next().show();
					$(this).closest('.element-container').find('.cfg-element-container select option:eq('+inputindex+')').attr('selected', 'selected');
				}
		}

		// SELECT MULTIPLE
		if($(this).hasClass('selectmultiple'))
		{
				// clean previously checked elements
				$(this).closest('.element-container').find('.cfg-element-container select option').each(function(){$(this).attr('selected', false)});
				
				if($(this).hasClass('radiocheck'))
				{
					$(this).removeClass('selected');
					$(this).hide();
					$(this).prev().show();
					
				} else{
					$(this).next().addClass('selected');
					$(this).hide();
					$(this).next().show();
				}
				
				// foreach option checked, we check the associated input
				$(this).closest('.sortoption-container').find('.selected').each(function()
				{
					var option_selected_index = $(this).parent().index();
					$(this).closest('.element-container').find('.cfg-element-container select option:eq('+option_selected_index+')').attr('selected', 'selected');
				});
				
		}

	});

	
	$('body').on('click', '.defaultselectoption', function(){
		var inputindex = $(this).parent().index();
		
	});

	/**
	 * DATEPICKER FORMAT
	 */
	jQuery('body').on('change', '.datepickerformat', function()
	{
		var input_target = jQuery(this).closest('.element-container').find('.cfg-type-date');
		input_target.datepicker('option', 'dateFormat', jQuery(this).val());
	});

	/**
	 * DATEPICKER LANGUAGE
	 */
	jQuery('body').on('change', '.datepickerlanguage', function()
	{
		
		var input_target = jQuery(this).closest('.element-container').find('.cfg-type-date');
		input_target.datepicker('option', jQuery.datepicker.regional[jQuery(this).val()]);
		
		// re-apply the selected dateFormat because the regional includes its own dateformat
		input_target.datepicker('option', 'dateFormat', jQuery(this).closest('.element-container').find('.datepickerformat').val());
	});


	/**
	 * CAPTCHA FORMAT
	 */
	$('body').on('click', '#captchaformat-letters, #captchaformat-numbers, #captchaformat-lettersandnumbers, .cfg-captcha-refresh', function(){
		updateCaptcha();
	});
	
	$('body').on('change', '#captcha-length', function(){
		updateCaptcha();
	});
	
	
	
	function updateCaptcha(){

		var captcha_length = $('#captcha-length').val();
		var captcha_format = $('input[type=radio][name=captchaformat]:checked').val();
		
		$('.cfg-captcha-img').attr('src','sourcecontainer/'+dir_form_inc+'/inc/captcha.php?length='+captcha_length+'&format='+captcha_format+'&r=' + Math.random());
		
		
	}
	

	/**
	 * REQUIRED FIELD
	 */

	$('body').on('click', '.editrequired', function(){
		
		if($(this).is(':checked'))
		{
			$(this).closest('.element-container').find('.cfg-label').append(span_required);
			
		} else{
			$(this).closest('.element-container').find('.cfg-required').remove();
		}
		
	});
	
	
	/**
	 * DELETE ELEMENT FROM THE EDITOR
	 */
	
	$('body').on('click', '.deleteelement', function(){
		$(this).css('cursor','default'); // prevent from having the hand cursor after the element slided up

		$(this).closest('.cfg-elementmove').slideUp(100, function(){ $(this).remove(); });
	});
	
	
	/**
	 * NEXT STEP - CONFIGURATION
	 */
	$('#gotoformconfiguration').click(function(){
		
		// ERROR: no submit button
		if(!$('.cfg-submit').length)
		{
			$('#cfg-dialog-message').html('<p>You forgot to insert a submit button in your form.</p>');
				
			$('#cfg-dialog-message').dialog({
					autoOpen: true,
					title: 'Error',
					buttons:{
						Ok: function(){$(this).dialog('close');}
					}
			});
				
			return false;
		}
		
		// ADJUSTMENT: if no email field after having previously added one, the delivery receipt section must be hidden by default
		if(!$('.cfg-type-email').length)
		{
			$('#config_usernotification_activate').prop('checked', false);
			$('#deliveryreceiptconfiguration').hide();
		}
		
		
		// ERROR: no input field at all
		var form_has_input = 0;
		
		$('.exportelement-type').each(function()
		{
			if($.inArray($(this).val(), [ 'checkbox', 'date',  'email', 'radio', 'select', 'selectmultiple', 'text', 'textarea', 'time', 'upload' ]) != -1)
			{
				form_has_input = 1;
				
			}
		});
		
		if(!form_has_input)
		{
			$('#cfg-dialog-message').html('<p>You must add at least one input field in the form to make the data submission work properly.</p>');
				
			$('#cfg-dialog-message').dialog(
			{
				autoOpen: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				}
			});
				
			return false;
		}
		
		else{
		$('#formeditor-container').hide(1, function()
		{
			$('#samplecontainer, #textinputformat-container').slideUp('fast');
			$('#editorheader').hide();
			
			$('#formconfiguration').slideDown('fast');
			buildSelectNotificationEmailAddress(); 
			// ^-- this function must be triggered in gotoformconfiguration in order to update the labels of the email field names that will appear in the select options of #notificationemailaddress
			
			if(!$('#form_id').val())
			{
				$('#saveform').html(saveform_btn_add);
			} else{
				$('#saveform').html(saveform_btn_update);
			}
			
			
			if($('.editrequired:checked').length || $('.cfg-type-email').length || $('.cfg-captcha-img').length || $('.replace_upload_field').length)
			{
				$('#config-errormessages-container').show();
				
				if($('.editrequired:checked').length)
				{
					$('#config-errorempty-container').show();
				}
				
				if($('.cfg-type-email').length)
				{
					$('#config-erroremail-container').show();
				}
				
				if($('.cfg-captcha-img').length)
				{
					$('#config-errorcaptcha-container').show();
				}
				
				if($('.replace_upload_field').length)
				{
					$('#config-errorupload-container').show();
				}
			}
		});
		}
	});
	
	function returnToFormEdition(){
		
		$('#formconfiguration').hide();
		$('#downloadsources').empty();

		$('#formeditor-container').slideDown('fast');
		$('#editorheader').show();

		$('#config-errormessages-container').hide();
		$('#config-errorempty-container').hide();
		$('#config-erroremail-container').hide();
		$('#config-errorcaptcha-container').hide();
		$('#config-errorupload-container').hide();
	}
	
	$('#returntoformedition').click(function(){
		returnToFormEdition();
	});
	
	
	$('.selectmessagecolor-radio').click(function(){
		var messagecolorvalue = $(this).closest('.selectmessagecolor-container').find('.selectmessagecolor-value').val();
		
		if($(this).is('.errormessagecolor'))
		{
			var destvalue = $('#error-messagecolor-value');
			var destcontainer = $('#error-messagecolor-container');
		}
		
		if($(this).is('.validationmessagecolor'))
		{
			var destvalue = $('#validation-messagecolor-value');
			var destcontainer = $('#validation-messagecolor-container');
		}
		
		destvalue.val(messagecolorvalue);
		
		
		var colorcontainer = $(this).closest('.selectmessagecolor-container').find('.formconfiguration-message-style');
		
		colorcontainer.effect('transfer', {
							 						to: destcontainer
													}, 
													400,
													function(){
														destcontainer.attr('style', messagecolorvalue);
													}
													);

	});
	
	
	
	/**
	 * NEXT STEP - SAVE
	 */
	$('#saveform').click(function(){
								  
		// IE8 doesn't like $(this).trim()
		$('#config_formname').val($.trim($('#config_formname').val()));

		$('#config_email_from').val($.trim($('#config_email_from').val()));


		// EMAIL CC
		$('#config_email_address_cc').val($.trim($('#config_email_address_cc').val()));
		
		var config_email_address_cc_split = $('#config_email_address_cc').val().split(',');
		//	console.log(config_email_address_cc_split);
		
		var config_email_address_cc = Array();
		
		$.each(config_email_address_cc_split, function(i)
		{
			config_email_address_cc_split[i] = $.trim(config_email_address_cc_split[i]);
			
			if(config_email_address_cc_split[i]){
				// config_email_address_cc is an array that will contained trimmed values
				// "config_email_address_cc":[{"emailaddress":"a@a.com"},{"emailaddress":"b@b.com"},{"emailaddress":"c@c.com"}]
				config_email_address_cc.push({'emailaddress':config_email_address_cc_split[i]})
			}
		});
		//console.log(config_email_address_cc);
		
		
		// EMAIL BCC
		$('#config_email_address_bcc').val($.trim($('#config_email_address_bcc').val()));
			
		var config_email_address_bcc_split = $('#config_email_address_bcc').val().split(',');
		//	console.log(config_email_address_bcc_split);
		
		var config_email_address_bcc = Array();
		
		$.each(config_email_address_bcc_split, function(i)
		{
			config_email_address_bcc_split[i] = $.trim(config_email_address_bcc_split[i]);
			
			if(config_email_address_bcc_split[i]){
				config_email_address_bcc.push({'emailaddress':config_email_address_bcc_split[i]})
			}
		});
		
		//console.log(config_email_address_bcc);
	
		
		
		// EMAIL
		$('#config_email_address').val($.trim($('#config_email_address').val()));

		/*
		// Check form name
		// Javascript check disabled because of: Uncaught SyntaxError: Invalid flags supplied to RegExp constructor 'u'
		// the /u flag is PHP-specific, the form name is validated with php in saveform.php
		if(!$('#config_formname').val().match(regex_pattern_formname) && $('#config_formname').val())
		{

			$('#cfg-dialog-message').html('<p>Only alphanumeric characters are authorized in the form name.</p>');
			
			$('#cfg-dialog-message').dialog(
			{
				autoOpen: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
						$('#config_formname').focus();
					}
				}
			});
			
			return false;	
		}*/
		
		// ERROR: The form name can't be left empty
		if(!$.trim($('#config_formname').val()))
		{
			$('#cfg-dialog-message').html('<p>The form name can\'t be left empty.</p>');
				
			$('#cfg-dialog-message').dialog(
			{
				autoOpen: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
						$('#config_formname').focus();
					}
				}
			});
				
			return false;
		}
		
		// ERROR: The notification subject line can't be left empty
		if(!$.trim($('#config_adminnotification_subject').val()))
		{
			$('#cfg-dialog-message').html('<p>The noitification subject line can\'t be left empty.</p>');
				
			$('#cfg-dialog-message').dialog(
			{
				autoOpen: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
						$('#config_adminnotification_subject').focus();
					}
				}
			});
				
			return false;
		}

		
		// ERROR: Check if the url for the confirmation is empty
		if($('#btn-redirecturl').is(':checked'))
		{
			
			if( !$.trim($('#config_redirecturl').val()) ) 
			{
				$('#cfg-dialog-message').html('<p>The URL field in the validation message section can\'t be left empty.</p>');
				
				$('#cfg-dialog-message').dialog(
				{
					autoOpen: true,
					title: 'Error',
					buttons: {
						Ok: function() {
							$(this).dialog('close');
							$('#config_redirecturl').focus();

						}
					}
				});
				
				return false;
			}
												  
			var config_redirecturl = $.trim($('#config_redirecturl').val());
			var config_validationmessage = '';
			
		} else{
			var config_redirecturl = '';
			var config_validationmessage = $('#config_validationmessage').val();
		}
		
		// ERROR: if delivery receipt is activated, there must be an email field in the form
		if($('#config_usernotification_activate').is(':checked') && !$('#config_usernotification_inputid').val())
		{
			$('#cfg-dialog-message').html('<p>You must add at least one email field in the form to activate email notification.</p>');
				
			$('#cfg-dialog-message').dialog(
			{
				autoOpen: true,
				title: 'Error',
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				}
			});
				
			return false;
		}
		


		
		$('#saveform').hide();
		
		$('#downloadsources').empty().hide();

		$('#savinginprogress').show();


		

		
		// catch uploaded images file name
		var export_imageupload = Array();
		
		
		// JSON EXPORT ARRAY
		var json_export = {};
		var export_element = Array();


		// FORM PATH
		// spaces are replaced with underscores + encodeURI : encodes special characters, except , / ? : @ & = + $ #
		//var config_formdir = encodeURI($('#config_formname').val().replace(/ /g,"_"));
		// not used anymore: var regex_formpath = new RegExp(regex_replace_formname_pattern, 'g')
		// not used anymore : var config_formdir = $('#config_formname').val().replace(regex_formpath, regex_replace_formname_replacement);


		
		// REQUIRED EMAIL
		// catch required email element id for email validation procedure
		var export_required_email_id = Array();
		$('.cfg-type-email').each(function()
		{
			export_required_email_id.push($(this).closest('.element-container').prop('id'));
		}); 
		
		
		// REQUIRED FIELD
		// required elements ids (can't be empty fields)
		var export_required_id = Array();
		$('.editrequired:checked').each(function()
		{
			export_required_id.push($(this).closest('.element-container').prop('id'));
		}); 
		
		
		// ERROR AND VALIDATION MESSAGE STYLE
		function buildExportMessageStyle(split_message_style){
			var export_validationmessage_style = {};
			
			for(var i = 0; i < split_message_style.length; i++)
			{
				split_message_style[i] = $.trim(split_message_style[i]);
				
				if(split_message_style[i])
				{
					var split_css_message_style = split_message_style[i].split(':');
	
					export_validationmessage_style[$.trim(split_css_message_style[0])] = $.trim(split_css_message_style[1]);
				}
			}		
			
			return(export_validationmessage_style);
		}
		var split_validationmessage_style = $('#validation-messagecolor-value').val().split(';');
		var export_validationmessage_style = buildExportMessageStyle(split_validationmessage_style);
		
		var split_errormessage_style = $('#error-messagecolor-value').val().split(';');
		var export_errormessage_style = buildExportMessageStyle(split_errormessage_style);
		//console.log(export_validationmessage_style); console.log(export_errormessage_style);
		
		
		var export_datepicker_config = Array();
		var export_upload_config = Array();
		
		var export_captcha = {};
		
		var export_css = {};
		
		
		if($('.newfontweight-label').val() == 'italic')
		{
			var export_css_label_fontweight = 'normal';
			var export_css_label_fontstyle = 'italic';
		}
		if($('.newfontweight-label').val() == 'bold' || $('.newfontweight-label').val() == 'normal')
		{
			var export_css_label_fontweight = $('.newfontweight-label').val();
			var export_css_label_fontstyle = 'normal';
		}
		export_css['label'] = {
										'default':{
													'font-family':$('.newfontfamily-label').val(),
													'font-weight':export_css_label_fontweight,
													'font-style':export_css_label_fontstyle,
													'font-size':$('#sliderfontsize-label-value').html()+'px',
													'color':$.trim($('#label_color').val())
													}};
		
		
		if($('.newfontweight-formelement').val() == 'italic')
		{
			var export_css_input_fontweight = 'normal';
			var export_css_input_fontstyle = 'italic';
		}
		if($('.newfontweight-formelement').val() == 'bold' || $('.newfontweight-formelement').val() == 'normal')
		{
			var export_css_input_fontweight = $('.newfontweight-formelement').val();
			var export_css_input_fontstyle = 'normal';
		}
		
		export_css['input'] = {
										'default':{
													'font-family':$('.newfontfamily-formelement').val(),
													'font-weight':export_css_input_fontweight,
													'font-style':export_css_input_fontstyle,
													'font-size':$('#sliderfontsize-formelement-value').html()+'px',
													'color':$.trim($('#formelement_color').val()),
													'padding':$('#sliderpadding-textinputformat-value').html()+'px',
													'-webkit-border-radius':$('#sliderborderradius-textinputformat-value').html()+'px',
													'-moz-border-radius':$('#sliderborderradius-textinputformat-value').html()+'px',
													'border-radius':$('#sliderborderradius-textinputformat-value').html()+'px',
													'border-width':$('#sliderborderwidth-textinputformat-value').html()+'px',
													'border-style':'solid',
													'border-color':$.trim($('#inputformat_color').val())
													}
											};
		
		// export elements
		$('.exportelement-type').each(function()
		{
			
			var export_single_css = {};
			var type = $(this).val();
			var element_container = $(this).closest('.element-container');
			var export_element_id = element_container.prop('id');
			
			var export_input = {'value':'', 'css':{ 'default':{}, 'hover':{} }}; // no $.trim()
			
			var export_label = {'id':'', 'value':element_container.find('.editlabel').val(), 'css':{'default':{}}}; // id updated in saveform.php // no $.trim()
			
			var export_container = {'id':'', 'css':{ 'default':{}}}; // id updated in saveform.php
			
			
			// SINGLE CSS
			export_single_css['font-family'] = element_container.find('.selectfontfamily').val();
			
			var fontweight = element_container.find('.selectfontweight').val();
			if(fontweight == 'italic')
			{
				export_single_css['font-style'] = 'italic';
			} else{
				export_single_css['font-weight'] = element_container.find('.selectfontweight').val();
			}
			
			if(element_container.find('.sliderelement-fontsize-value').html())
			{
				// undefinedem without if()
				export_single_css['font-size'] = element_container.find('.sliderelement-fontsize-value').html()+'px';
			}
			
			export_single_css['color'] = element_container.find('.colorpickervalue').val();
			
			if(element_container.find('.cfg-edit-properties-container .slider-element-width-value').val())
			{
				// undefinedpx without if()
				export_input['css']['default']['width'] = element_container.find('.slider-element-width-value').val()+'px';
				
				export_single_css['width'] = element_container.find('.slider-element-width-value').val()+'px';
			}
			
			
			
			if($.inArray(type, [ 'checkbox', 'captcha', 'date', 'email', 'radio', 'select', 'selectmultiple', 'text', 'textarea', 'time', 'upload' ]) != -1)
			{
				export_label['css']['default']['font-family'] = export_css['label']['default']['font-family'];
				export_label['css']['default']['font-weight'] = export_css['label']['default']['font-weight'];
				export_label['css']['default']['font-style'] = export_css['label']['default']['font-style'];
				export_label['css']['default']['font-size'] = export_css['label']['default']['font-size'];
				export_label['css']['default']['color'] = export_css['label']['default']['color'];
				
				export_input['css']['default']['font-family'] = export_css['input']['default']['font-family'];
				export_input['css']['default']['font-weight'] = export_css['input']['default']['font-weight'];
				export_input['css']['default']['font-style'] = export_css['input']['default']['font-style'];
				export_input['css']['default']['font-size'] = export_css['input']['default']['font-size'];
				export_input['css']['default']['color'] = export_css['input']['default']['color'];
				
				if($.inArray(type, [ 'captcha', 'date', 'email', 'text', 'textarea' ]) != -1)
				{
					
					export_input['css']['default']['padding'] = export_css['input']['default']['padding'];
					export_input['css']['default']['-webkit-border-radius'] = export_css['input']['default']['-webkit-border-radius'];
					export_input['css']['default']['-moz-border-radius'] = export_css['input']['default']['-moz-border-radius'];
					export_input['css']['default']['border-radius'] = export_css['input']['default']['border-radius'];
					export_input['css']['default']['border-width'] = export_css['input']['default']['border-width'];
					export_input['css']['default']['border-style'] = export_css['input']['default']['border-style'];
					export_input['css']['default']['border-color'] = export_css['input']['default']['border-color'];
				}
				

				if(element_container.find('.label-positionning.alignleft').is(':checked')
					|| element_container.find('.label-positionning.alignright').is(':checked')
					)
				{	// ^-- no width val when alignment set to top
					export_label['css']['default']['width'] = element_container.find('.sliderelement-label-width-value').val()+'px';
					export_label['css']['default']['float'] = 'left';
					
					if(element_container.find('.label-positionning.alignleft').is(':checked'))
					{
						export_label['css']['default']['text-align'] = 'left';
					} else{
						export_label['css']['default']['text-align'] = 'right';
					}
					
					export_container['css']['default']['float'] = 'left';
					
					
					if($.inArray(type, [ 'checkbox', 'radio' ]) != -1)
					{
						// INSERT WIDTH NEEDS LABEL LEFT/RIGHT + OPTION LEFT
						if(element_container.find('.option-positionning.alignleft').is(':checked'))
						{
							export_container['css']['default']['width'] = element_container.find('.cfg-element-set').innerWidth()+'px';
						}
						
						// INSERT MARGIN NEEDS LABEL LEFT/RIGHT
						var element_set_margintop = element_container.find('.cfg-element-set').css('margin-top'); // no need to add +'px' because 'px' is already returned by .css()
						
						if(element_set_margintop != '0px')
						{
							export_container['css']['default']['margin-top'] = element_set_margintop;
						}
					}
					
				}
				
			}

			
			if(type == 'submit')
			{
				export_input['css']['default']['border-width'] = '1px';
				export_input['css']['default']['border-style'] = 'solid';
					
				export_input['css']['default']['font-family'] = export_single_css['font-family'];
				export_input['css']['default']['font-weight'] = export_single_css['font-weight'];
				export_input['css']['default']['font-style'] = export_single_css['font-style'];
				export_input['css']['default']['font-size'] = export_single_css['font-size'];
				
				var marginleft_submit = element_container.find('.slider-marginleft-submit-value').val();
				if(marginleft_submit!='0') // prevents having margin-left:0px
				{
					export_input['css']['default']['margin-left'] = marginleft_submit+'px';
				}else{
					export_input['css']['default']['margin-left'] = marginleft_submit;
				}
			
				var submit_compare_default_hover = Array(); // used to compare default and hover values: we only insert the hover value if it is different from the default value
				
				// DEFAULT CSS
				$(this).closest('.element-container').find('.css_default_value').each(function()
				{
					
					var css_property_name = $(this).closest('.optioneditor-fontstyleeditor-r').find('.export_css_property').val();
					var css_property_value = $.trim($(this).val());
							
					export_input['css']['default'][css_property_name] = css_property_value;
					
					submit_compare_default_hover.push(css_property_value);
				});
				
				// HOVER CSS
				$(this).closest('.element-container').find('.css_hover_value').each(function(i, l)
				{
					var css_property_name = $(this).closest('.optioneditor-fontstyleeditor-r').find('.export_css_property_hover').val();
					var css_property_value = $.trim($(this).val());
					
					
					// i in each(function(i,l)
					if(css_property_value != submit_compare_default_hover[i] && $(this).closest('.hover-editor').is('.hoveractive'))
					{// ^-- used to compare default and hover values: we only insert the hover value if it is different from the default value
						export_input['css']['hover'][css_property_name] = css_property_value;
					}
							
				});
								
			}
			
			if(type == 'select' || type == 'selectmultiple' || type == 'checkbox' || type == 'radio')
			{
				var export_option_array = Array();

				element_container.find('.editoption-container').each(function()
				{
					if($(this).find('.selected').html())
					{
						var option_checked = '1';
					} else{
						var option_checked = '';
					}
					
					export_option_array.push({
														'id':export_element_id+'-'+$(this).index(),
														'value':$.trim($(this).find('.editoption').val()),
														'checked':option_checked
														});
				});
			}
			
			
			var element_obj = {};
			
			element_obj['id'] = export_element_id;
			
			element_obj['type'] = type;
			
			// VALUE
			if($.inArray(type, ['submit']) != -1)
			{
				export_input['value'] = element_container.find('.editlabel').val();
			}
			
			// CAPTCHA
			if(type == 'captcha')
			{
				element_obj['format'] = element_container.find('.captchaformat:checked').val();
				element_obj['length'] = element_container.find('.captcha-length').val();
				element_obj['form_dir'] = ''; // updated in saveform.php
				element_obj['form_inc_dir'] = ''; // updated in saveform.php
				
				export_captcha['id'] = $(this).closest('.element-container').prop('id');
				export_captcha['format'] = $(this).closest('.element-container').find('.captchaformat:checked').val();
				export_captcha['length'] = $(this).closest('.element-container').find('.captcha-length').val();
			}
			
			// DATEPICKERFORMAT DATEPICKERLANGUAGE
			if(type == 'date')
			{
				export_datepicker_config.push({
															'id':export_element_id, 
															'format':element_container.find('.datepickerformat').val(), 
															'regional':element_container.find('.datepickerlanguage').val()
															});
				
				element_obj['format'] = element_container.find('.datepickerformat').val();
				element_obj['regional'] = element_container.find('.datepickerlanguage').val();
				
			}
			

			// UPLOAD
			if(type == 'upload')
			{
				
				var file_types = '';
				
				if(element_container.find('.radio_upload_filetype_all').is(':checked'))
				{
					file_types = '*.*';
				}
				
				if(element_container.find('.radio_upload_filetype_custom').is(':checked'))
				{
					file_types = $.trim(element_container.find('.upload_filetype_custom').val());
				}
				
				var export_upload_element = {};
				export_upload_element['id'] = export_element_id;
				export_upload_element['btn_upload_id'] = 'uploadbutton'; // spanButtonPlaceHolder written in class.contactformeditor.php and used in saveform.php;
				export_upload_element['file_size_limit'] = element_container.find('.upload_filesizelimit').val();
				export_upload_element['file_size_unit'] = element_container.find('.upload_filesizeunit:checked').val();
				export_upload_element['file_types'] = file_types;
				export_upload_element['upload_deletefile'] = element_container.find('.upload_deletefile:checked').val();
				
				element_obj['btn_upload_id'] = export_upload_element['btn_upload_id'];
				element_obj['file_size_limit'] = export_upload_element['file_size_limit'];
				element_obj['file_size_unit'] = export_upload_element['file_size_unit'];
				element_obj['file_types'] = export_upload_element['file_types'];
				element_obj['upload_deletefile'] = export_upload_element['upload_deletefile'];
				
				export_upload_config.push(export_upload_element); // saveform.php
			}
			
			
			// TITLE
			if(type == 'title')
			{
				element_obj['title'] = {'value':element_container.find('.editlabel').val(), 'css':{'default':export_single_css}};
			}
			
			// PARAGRAPH
			if(element_container.find('.edit-paragraph').length)
			{
				var paragraph_val = element_container.find('.edit-paragraph').val();
				
				export_single_css['width'] = element_container.find('.slider-paragraph-width-value').val()+'px';

				if(type == 'paragraph')
				{
					element_obj['paragraph'] = {'id':'', 'value':paragraph_val, 'css':{'default':export_single_css}}; // id updated in saveform.php
				}
				
				// for other elements, paragraph is pushed in json only if it's not empty
				if($.inArray(type, [ 'checkbox', 'captcha', 'date', 'email', 'radio', 'select', 'selectmultiple', 'text', 'textarea', 'time', 'upload' ]) != -1)
				{
					
					if(element_container.find('.edit-paragraph').val())
					{
						element_obj['paragraph'] = {'id':'', 'value':paragraph_val, 'css':{'default':export_single_css}}; // id updated in saveform.php
					}
				}
				
				
			}
			
			// REQUIRED
			if(element_container.find('.editrequired').is(':checked'))
			{
				element_obj['required'] = 1;
			}
			
			// AMPM TIME
			if(type == 'time')
			{
				element_obj['timeformat'] = element_container.find('.timeformat:checked').val();
			}
			
			
			// ROWS
			if(type == 'textarea')
			{
				element_obj['rows'] = element_container.find('.sliderelement-rows-value').val();
			}
			
			// LABEL
			if($.inArray(type, [ 'checkbox', 'captcha', 'date', 'email', 'radio', 'select', 'selectmultiple', 'text', 'textarea', 'time', 'upload' ]) != -1)
			{
				element_obj['label'] = export_label;
				
			}
			
			// INPUT CSS
			//'checkbox', 'radio', 
			if($.inArray(type, [ 'captcha', 'date', 'email', 'select', 'selectmultiple', 'submit', 'text', 'textarea', 'time' ]) != -1)
			{
				element_obj['input'] = export_input;
			}
			
			// OPTIONS			
			if($.inArray(type, [ 'checkbox', 'radio', 'select', 'selectmultiple' ]) != -1)
			{
				var export_optioncontainer = {'id':'', 'css':{'default':{}}}; // id updated in saveform.php
				export_optioncontainer['css'] = export_input['css'];
				
				if($.inArray(type, [ 'checkbox', 'radio' ]) != -1)
				{
					if(element_container.find('.option-positionning.alignleft').is(':checked'))
					{					
						export_optioncontainer['css']['default']['width'] = element_container.find('.sliderelement-option-width-value').val()+'px';
						
						export_optioncontainer['css']['default']['float'] = 'left';
					}
					
					element_obj['option'] = {'set':export_option_array, 'container':export_optioncontainer};
				}
				
				
				
				
				if($.inArray(type, [ 'select', 'selectmultiple' ]) != -1)
				{
					element_obj['option'] = {'set':export_option_array};
				}
			}
			
			
			// IMAGE
			// image url
			var export_imgurl = $.trim(element_container.find('.image_url').val());
			if(export_imgurl){
				element_obj['url'] = export_imgurl;  // to prevent imgurl = ''
			}
			
			// image upload
			var export_imageuploadfilename = element_container.find('.uploadimagefilename').val();
			if(export_imageuploadfilename)
			{
				element_obj['filename'] = element_container.find('.uploadimagefilename').val();
				element_obj['form_dir'] = ''; // updated in saveform.php
				element_obj['form_inc_dir'] = ''; // updated in saveform.php
				
				export_imageupload.push(element_obj['filename']);
			}
			
			element_obj['container'] = export_container;
		
			
			export_element.push(element_obj);
				
		});
		
		
		// FORM CONFIG
		json_export['form_id'] = $('#form_id').val();
		json_export['form_name'] = $('#config_formname').val();
		json_export['form_dir'] = ''; // value set in saveform.php, sent through js call to prevent having to create ['form_dir'] with php, which would put the form_dir key at the end of the json array / less easy to find and read
		json_export['config_email_address'] = $('#config_email_address').val();
		json_export['config_email_address_cc'] = config_email_address_cc;
		json_export['config_email_address_bcc'] = config_email_address_bcc;
		json_export['config_timezone'] = $('#config_timezone').val();
		json_export['config_redirecturl'] = config_redirecturl;
		json_export['config_validationmessage'] = config_validationmessage;
		
		json_export['config_errormessage_captcha'] = '';
		json_export['config_errormessage_emptyfield'] = '';
		json_export['config_errormessage_invalidemailaddress'] = '';
		json_export['config_errormessage_uploadfileistoobig'] = '';
		json_export['config_errormessage_uploadinvalidfiletype'] = '';
		
		if($('.cfg-captcha-img').length)
		{
			json_export['config_errormessage_captcha'] = $('#config_errormessage_captcha').val();
		}
		if($('.editrequired:checked').length)
		{
			json_export['config_errormessage_emptyfield'] = $('#config_errormessage_emptyfield').val();
		}
		if($('.cfg-type-email').length)
		{
			json_export['config_errormessage_invalidemailaddress'] = $('#config_errormessage_invalidemailaddress').val();	
		}
		if($('.replace_upload_field').length)
		{
			json_export['config_errormessage_uploadfileistoobig'] = $('#config_errormessage_uploadfileistoobig').val();
			json_export['config_errormessage_uploadinvalidfiletype'] = $('#config_errormessage_uploadinvalidfiletype').val();
		}
		
		
		json_export['config_adminnotification_subject'] = $('#config_adminnotification_subject').val();
		
		json_export['config_email_from'] = ''; // default value to prevent Undefined index
		json_export['config_usernotification_activate'] = ''; // default value to prevent Undefined index
		json_export['config_usernotification_insertformdata'] = ''; // default value to prevent Undefined index: config_usernotification_insertformdata
		json_export['config_usernotification_inputid'] = ''; // default value to prevent Undefined index
		json_export['config_usernotification_format'] = ''; // default value to prevent Undefined index
		json_export['config_usernotification_subject'] = ''; // default value to prevent Undefined index
		json_export['config_usernotification_message'] = ''; // default value to prevent Undefined index
		
		if($('#config_usernotification_activate').is(':checked') && $('#config_usernotification_inputid').val())
		{
			json_export['config_usernotification_activate'] = '1';
			
			if($('#config_usernotification_insertformdata').is(':checked'))
			{
				json_export['config_usernotification_insertformdata'] = '1';
			}
			
			json_export['config_email_from'] = $('#config_email_from').val();
			json_export['config_usernotification_inputid'] = $('#config_usernotification_inputid').val();
			json_export['config_usernotification_format'] = $('input[type=radio][name=config_usernotification_format]:checked').val();
			json_export['config_usernotification_subject'] = $('#config_usernotification_subject').val();
			json_export['config_usernotification_message'] = $('#config_usernotification_message').val();
			
		}
		
		
		json_export['validationmessage_style'] = {'css':{'default':export_validationmessage_style}};
		json_export['errormessage_style'] = {'css':{'default':export_errormessage_style}};
		json_export['formvalidation_email'] = export_required_email_id; // saveform.php
		json_export['formvalidation_required'] = export_required_id; // saveform.php
		json_export['imageupload'] = export_imageupload;
		json_export['upload'] = export_upload_config; // saveform.php
		json_export['datepicker'] = export_datepicker_config; // saveform.php
		json_export['captcha'] = export_captcha; // saveform.php
		json_export['element'] = export_element;
		json_export['css'] = export_css;

		json_export = JSON.stringify(json_export);
		
		//	console.log(json_export);
		// console.log('json_export length: '+json_export.length);
		
		
		var jqxhr_saveform = $.post('inc/saveform.php',
			   	{
					'json_export':json_export,
					'cf_f':$('#copyright-header:visible').html()

				},
				function(data)
				{	

			   		// 	console.log(data);
					var json_data = $.parseJSON(data);
					
					if(json_data['response'] == 'nok')
					{
						$('#cfg-dialog-message').html('<p>'+json_data['response_msg']+'</p>');
					
						$('#cfg-dialog-message').dialog(
						{
							autoOpen: true,
							title: 'Error',
							buttons: {
								Ok: function(){$(this).dialog('close');}
							}
						});		
						
					} else{
						
						if(json_data['form_id'])
						{
							// no form_id in demo mode, the button value must remain "save and create"
							$('#saveform').html(saveform_btn_update);
						} else{
							$('#saveform').html(saveform_btn_add);
						}
					   
						$('#downloadsources').html(json_data['response']).slideDown('fast');
						
						$('#form_id').val(json_data['form_id']);
					}
					
					$('#saveform').show();
					
					$('#savinginprogress').hide();
				
				}).error(function(){
					
					//console.log(jqxhr_saveform);
					
					if(jqxhr_saveform.status && jqxhr_saveform.status == 500)
					{
						$('#saveform').show();
						
						$('#savinginprogress').hide();
						
						var cfg_php_safe_mode_error_message = '<br /><br />The PHP Safe Mode is activated on your server. You must disable the Safe Mode and set the PHP safe_mode option to Off on your server in order to be able to create your forms properly.';
						
						var status_error_message = '500 Internal Server Error:<br />The server encountered an internal error or misconfiguration and was unable to complete your request.';
						
						var status_error_source = '';
						
						if(cfg_php_safe_mode){
							status_error_message += cfg_php_safe_mode_error_message;
							status_error_source = 1;
						}
						
						if(!status_error_source)
						{
							status_error_message += '<br /><br />Something has gone wrong on the server but the script wasn\'t able to idenfity why it is not working properly.';
							status_error_message += '<br /><br />Contact us at support@topstudiodev.com so that we can help you identify what the exact problem is.';
							status_error_message += '<br/><br/>We will get back to you in less than 24 hours.';
						}
						
						
						$('#cfg-dialog-message').html('<p>'+status_error_message+'</p>');
					
						$('#cfg-dialog-message').dialog(
						{
							autoOpen: true,
							title: 'Error',
							buttons: {
								Ok: function(){$(this).dialog('close');}
							}
						});		
					}
				});

		/*
		$(document).ajaxError(function(e, jqxhr, settings, exception)
		{
			// console.log(settings);
			// console.log(jqxhr);
		}); 		
		*/
	})
	
	/**
	 * DOWNLOAD DEMO
	 */
	$('body').on('click', '.demodownload', function()
	{
		$('#cfg-dialog-message').html('<p>You are currently using a demo version of Contact Form Generator.</p><p>The download feature is only available in the full version.</p><p>You can use the "<strong>View your form</strong>" button to see what your form looks like.</p>');
		
		$('#cfg-dialog-message').dialog(
		{
			autoOpen: true,
			title: 'Demo - Download sources',
			buttons: {
				Ok: function(){$(this).dialog('close');}
			}
		});		
						
		
	});
	
	/**
	 * FONT FAMILY - LABEL, TITLE
	 */
	function updateFontFamily(source, target, font)
	{
		if(source.hasClass('fontsandcolors')){
			$(target).css('font-family', font);
		} else{
			source.closest('.element-container').find(target).css('font-family', font);
		}
	}
	
	$('.newfontfamily-formelement').change(function()
	{
		default_fontfamily_formelement = $(this).val();
		updateFontFamily($(this), '.formelement', $(this).val());
	});
	
	$('body').on('change', '.newfontfamily-label', function()
	{
		default_fontfamily_label = $(this).val();
		updateFontFamily($(this), '.cfg-label', $(this).val());
	});
	
	$('body').on('change', '.newfontfamily-paragraph', function()
	{
		default_fontfamily_paragraph = $(this).val();
		updateFontFamily($(this), '.cfg-paragraph', $(this).val());
		
		// update the selected value in every element editor of this type
		// only from top editor to individual editor
		if($(this).is('.fontsandcolors'))
		{
			$('.newfontfamily-paragraph').val($(this).val());
		}
	});
	
	$('body').on('change', '.newfontfamily-submit', function()
	{
		default_fontfamily_submit = $(this).val();
		updateFontFamily($(this), '.cfg-submit', $(this).val());
	});
	
	$('body').on('change', '.newfontfamily-title', function()
	{
		default_fontfamily_title = $(this).val();
		updateFontFamily($(this), '.cfg-title', $(this).val());
		
		// update the selected value in every element editor of this type
		// only from top editor to individual editor
		if($(this).is('.fontsandcolors'))
		{
			$('.newfontfamily-title').val($(this).val());
		}
	});
	
	/**
	 * FONT WEIGHT updateFontWeight
	 */
	function updateFontWeight(source,target, fontweight)
	{	
		if(fontweight == 'italic'){
			var css_font_weight = 'normal';
			var css_font_style = 'italic';
		}
		else{
			var css_font_weight = fontweight;
			var css_font_style = 'normal';
		}
				
		if(source.hasClass('fontsandcolors')){
			$(target).css({'font-weight':css_font_weight, 'font-style':css_font_style});
		} else{
			source.closest('.element-container').find(target).css({'font-weight':css_font_weight, 'font-style':css_font_style});
		}
		
	}
	
	// FONT WEIGHT - LABEL
	
	$('body').on('change', '.newfontweight-label', function()
	{
		default_fontweight_label = $(this).val();

		updateFontWeight($(this), '.cfg-label', $(this).val());
	});


	// FONT WEIGHT - SUBMIT
	
	$('body').on('change', '.newfontweight-submit', function()
	{
		default_fontweight_submit = $(this).val();

		updateFontWeight($(this), '.cfg-submit', $(this).val());
	});

	// FONT WEIGHT - FORM ELEMENT
	
	$('.newfontweight-formelement').change(function()
	{
		default_fontweight_formelement = $(this).val();
		updateFontWeight($(this), '.formelement', $(this).val());
	});

	// FONT WEIGHT - TITLE
	$('body').on('change', '.newfontweight-title', function()
	{
		default_fontweight_title = $(this).val();
		
		updateFontWeight($(this),'.cfg-title', $(this).val());
		
		// update the selected value in every element editor of this type
		// only from top editor to individual editor
		if($(this).is('.fontsandcolors'))
		{
			$('.newfontweight-title').val($(this).val());
		}
	});


	// FONT WEIGHT - PARAGRAPH
	$('body').on('change', '.newfontweight-paragraph', function()
	{
		default_fontweight_paragraph = $(this).val();
		
		updateFontWeight($(this), '.cfg-paragraph', $(this).val());
		
		// update the selected value in every element editor of this type
		// only from top editor to individual editor
		if($(this).is('.fontsandcolors'))
		{
			$('.newfontweight-paragraph').val($(this).val());
		}
	});
	
	
	/**
	 * FONT SIZE - LABEL, TITLE
	 */
	function updateFontSize(target, fontsize)
	{
		$('.element-container').find(target).each(function(){
			$(this).css('font-size', fontsize+'px');
			
			// APPLY FONT SIZE VALUE FROM TOP PAN TO SLIDER IN ELEMENT EDITOR
			
			if($(this).hasClass('cfg-title') || $(this).hasClass('cfg-paragraph'))
			{
				$(this).closest('.element-container').find('.sliderelement-fontsize-value').html(fontsize);
				$(this).closest('.element-container').find('.sliderelement-fontsize-value')
																	.closest('.optioneditor-fontstyleeditor-r')
																	.find('.ui-slider')
																	.slider('option', 'value', fontsize);
			}
			
		});

		$('.element-container').each(function(){adjustElementHeightToLeftContent($(this));});


	}
	
	// LABEL SIZE SLIDER
	$('#sliderfontsize-label').slider({
					range: 'min',
					min: slider_fontsize_min,
					max: slider_fontsize_max,
					value: default_fontsize_label,
					step: slider_fontsize_step,
					slide: function( event, ui ){
						$('#sliderfontsize-label-value').html(ui.value);
						default_fontsize_label = ui.value; 
						updateFontSize('.cfg-label', ui.value);
					}
	});
	$('#sliderfontsize-label-value').html($('#sliderfontsize-label').slider('value'));
	
	
	// FORM ELEMENT SIZE SLIDER
	$('#sliderfontsize-formelement').slider({
					range: 'min',
					min: slider_fontsize_min,
					max: slider_fontsize_max,
					value: default_fontsize_formelement,
					step: slider_fontsize_step,
					slide: function( event, ui ){
						$('#sliderfontsize-formelement-value').html(ui.value);
						default_fontsize_formelement = ui.value; 
						updateFontSize('.formelement', ui.value);
						
					}
	});
	$('#sliderfontsize-formelement-value').html($('#sliderfontsize-formelement').slider('value'));
	
	
	
	// TITLE SIZE SLIDER
	$('#sliderfontsize-title').slider({
					range: 'min',
					min: slider_fontsize_min,
					max: slider_fontsize_max,
					value: default_fontsize_title,
					step: slider_fontsize_step,
					slide: function(event, ui){
						$('#sliderfontsize-title-value').html(ui.value);
						default_fontsize_title = ui.value; 
						updateFontSize('.cfg-title', ui.value);
					}
	});
	$('#sliderfontsize-title-value').html( $('#sliderfontsize-title').slider('value') );
	
	// PARAGRAPH SIZE SLIDER
	$('#sliderfontsize-paragraph').slider({
					range: 'min',
					min: slider_fontsize_min,
					max: slider_fontsize_max,
					value: default_fontsize_paragraph,
					step: slider_fontsize_step,
					slide: function(event, ui){
						$('#sliderfontsize-paragraph-value').html(ui.value);
						default_fontsize_paragraph = ui.value; 
						updateFontSize('.cfg-paragraph', ui.value);
					}
	});
	$('#sliderfontsize-paragraph-value').html($('#sliderfontsize-paragraph').slider('value'));
	
	
	
	
	/**
	 * SLIDER WIDTH VALUE FROM INPUT
	 */
	var delay_keyup = (function(){
									var timer = 0;
									return function(callback, ms){
										clearTimeout(timer);
										timer = setTimeout(callback, ms);
									};
								})();
	
	$('body').on('focusout', '.slider-marginleft-submit-value, .slider-element-width-value, .slider-paragraph-width-value, .sliderelement-label-width-value, .sliderelement-option-margintop-value, .sliderelement-option-width-value', function(){
		$(this).closest('.optioneditor-fontstyleeditor-c').find('.ui-slider').slider('option','value',$(this).val());
	});
		
	
	$('body').on('keyup', '.slider-marginleft-submit-value, .slider-element-width-value, .slider-paragraph-width-value, .sliderelement-label-width-value, .sliderelement-option-margintop-value, .sliderelement-option-width-value', function(){
			
			var sliderinputvalue = $(this);
			
			delay_keyup(function(){
				sliderinputvalue.closest('.optioneditor-fontstyleeditor-c').find('.ui-slider').slider('option','value',sliderinputvalue.val());
			}, 700 );
	
	});
		
		
	$('body').on('focusout', '.sliderelement-rows-value', function(){
		$(this).closest('.optioneditor-fontstyleeditor-c').find('.ui-slider').slider('option','value',$(this).val());
	});
	
	$('body').on('keyup', '.sliderelement-rows-value', function(){
			
			var sliderinputvalue = $(this);
			
			delay_keyup(function(){
				sliderinputvalue.closest('.optioneditor-fontstyleeditor-c').find('.ui-slider').slider('option','value',sliderinputvalue.val());
			}, 700 );
	
	});
	
	
	/**
	 * EMAIL NOTIFICATION CHECKBOX
	 */
	$('#config_usernotification_activate').click(function()
	{
		$('#deliveryreceiptconfiguration').slideToggle(30);
	});
	
	
	function buildSelectNotificationEmailAddress()
	{
		
		// if there is 1 email field, config_usernotification_inputid is an hidden input that stores the id of the email input of the form
		// if there are more than 1 email field, config_usernotification_inputid is a select field
		$('#config_usernotification_inputid').remove();
		
		var label_value = '';
		var emailinput_id = '';
		var count_email_field = $('.cfg-type-email').length;
		var select_emailnotificationinputid = '<select id="config_usernotification_inputid">';
		
		$('.cfg-type-email').each(function(){
			label_value = $(this).closest('.element-container').find('.cfg-label-value').html();
			emailinput_id = $(this).closest('.element-container').prop('id'); //$(this).prop('name');
			
			var option_selected = '';
			if(emailinput_id == config_usernotification_inputid)
			{
				// ^-- config_usernotification_inputid is created in index.php
				// preselect the right email field option when a form is loaded
				option_selected = 'selected="selected"';
			}
			select_emailnotificationinputid = select_emailnotificationinputid+'<option value="'+emailinput_id+'" '+option_selected+'>'+label_value+'</option>';
		});
		
		select_emailnotificationinputid = select_emailnotificationinputid+'</select>';
		
		$('#notificationemailaddress').empty();
		
		if(!count_email_field)
		{
			$('#notificationemailaddress').append('<p style="color:#ff0033; font-style:normal;">You must add at least one email field in the form to activate email notification</p>');
			notification_selectedemailinput_id = '';
		}
		
		if(count_email_field)
		{
			if(count_email_field > 1)
			{
				// append the options in the select container
				$('#notificationemailaddress').append(select_emailnotificationinputid);
			} else
			{
				$('#notificationemailaddress').append('<strong>'+label_value+'</strong>');
				$('#notificationemailaddress').append('<input type="hidden" name="config_usernotification_inputid" id="config_usernotification_inputid" value="'+emailinput_id+'"  />');
			}
			
		}
	}
	
	
	/**
	 * SLIDE RADIO OPTIONS IN UPLOAD EDITOR
	 */
	$('body').on('click', '.radio_upload_filetype', function()
	{
		$(this).closest('.upload-editor').find('.radio-upload-slide').hide();
		$(this).closest('.radio-upload-container').find('.radio-upload-slide').show();
		
		$(this).closest('.optioneditor-fontstyleeditor-c').find('label').removeClass('label-selected-element-editor');
		$(this).closest('div').find('label').addClass('label-selected-element-editor');
		
		setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
	});
	
	
	/**
	 * UPDATE DELETEFILE UPLOAD CHECKBOX
	 */
	$('body').on('click', '.upload_deletefile', function()
	{
		/**
		 * 1: File Attachment + Download Link
		 * 2: File Attachment Only
		 * 3: Download Link Only
		 */
		$(this).closest('.element-container').find('.cfg-uploaddeletefile').val($(this).val()); // change the value in the browser
		$(this).closest('.element-container').find('.cfg-uploaddeletefile').attr('value', $(this).val()); // change the input value in the html code, needed to have the right value in the final render (.val() doesn't change the html code)
		
		
		$(this).closest('.optioneditor-fontstyleeditor-c').find('label').removeClass('label-selected-element-editor');
		$(this).closest('div').find('label').addClass('label-selected-element-editor');
		
		$(this).closest('.optioneditor-fontstyleeditor-c').find('.cfg-element-editor-hint').hide();
		$(this).closest('div').find('.cfg-element-editor-hint').show();//slideDown('fast');
		
		setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
		
	});
	
	/**
	 * HIDE CHANGE HOVER COLOR cancelhovercolor
	 */
	$('body').on('click', '.cancelhovercolor', function()
	{
		var hovereditor = $(this).closest('.hover-editor');
		hovereditor.hide();
		hovereditor.removeClass('hoveractive'); // hoveractive used to know if the hovereditor is displayed for a specific css property, if hovereditor has class hoveractive the hover value is inserted in the json
		
		$(this).closest('.optioneditor-fontstyleeditor-c').find('.changecoloronhover-c').show();
		
		/*
		var css_default_value = $(this).closest('.optioneditor-fontstyleeditor-c').find('.css_default_value').val();
		$(this).closest('.hover-editor').find('.css_hover_value').val(css_default_value)
																					.css({'background-color':css_default_value});
																					
		$(this).closest('.hover-editor').find('.colorpicker-ico').css({'background-color':css_default_value});
		*/
		
		setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
		
		$('.cfg-submit').unbind('hover'); // console.log($('.cfg-submit').data('events'));
	});
	
	/**
	 * SHOW CHANGE HOVER COLOR cancelhovercolor
	 */
	$('body').on('click', '.changecoloronhover', function()
	{
		$(this).closest('.changecoloronhover-c').hide();
		
		var hovereditor = $(this).closest('.optioneditor-fontstyleeditor-c').find('.hover-editor');
		hovereditor.show();
		hovereditor.addClass('hoveractive');  // hoveractive used to know if the hovereditor is displayed for a specific css property, if hovereditor has class hoveractive the hover value is inserted in the json
		
		var css_attribute = $(this).closest('.optioneditor-fontstyleeditor-c').find('.export_css_property_hover').val();
		var css_hover_value = $(this).closest('.optioneditor-fontstyleeditor-c').find('.css_hover_value').val();
		var css_default_value = $(this).closest('.optioneditor-fontstyleeditor-c').find('.css_default_value').val();
		
		if(css_hover_value != css_default_value)
		{
			$('.cfg-submit').hover(
											function(){
												$(this).css(css_attribute, css_hover_value);
											},
											function(){
												$(this).css(css_attribute, css_default_value);
											}
											);
		}
		
		setElementContainerHeight($(this).closest('.element-container').find('.cfg-edit-properties-container'));
		
	});
	
	

	
	
		$.fn.colorkit = function (arg_colorpicker_value, arg_colorpicker_target, arg_colorpicker_id,arg_colorpicker_csspropertyname)
		{
			
			
			// same function for colorpicker ico and for input value
			$(this).parent().find('.colorpicker-ico').add($(this)).click(function(event){
									// open CP 1 and CP2, stopPropagation make the color selected from CP2 applied to the target
									event.stopPropagation();
									
									 // added in v.5, prevents from having multiple colorpicker panel opened (if 2 colorpickers are opened the color clicked in the second colorpicker is not applied)
									var colorpickercontainer = $(this).closest('.colorpicker-container');
									$('.colorpicker-container').not(colorpickercontainer).each(function(){
										// hide all colorpickers except the one that is currently opened (prevents hide/show bumping when clicking again in the input
										$(this).find('.colorpicker').hide();
									});
										
									// z-index is set to 2 to put the colorpicker of the current element above the element-editor-container of the element below
									colorpickercontainer.closest('.element-editor-container').css({'z-index':'2'});
									
									
									
									if(arg_colorpicker_target == 'element'){ // if equals 'element', we search which html object must have its color changed
										colorpicker_target = $(this).closest('.element-container').find('.colortarget');
									} else{
										colorpicker_target = arg_colorpicker_target; // else we target the specified class (index.php), like cfg-title, cfg-label, etc.
									}
									
									colorpicker_value = arg_colorpicker_value;
									colorpicker_id = arg_colorpicker_id;
									colorpicker_csspropertyname = arg_colorpicker_csspropertyname;//'#label_colorpicker';
									setUpColorPicker();
									
									// hover on the submit button in the editor (must be applied when choosing color from colorpicker ico or from input value)
									var colorinput = $(this);
									
									if($(colorpicker_target).hasClass('cfg-submit'))
									{
											
										// the hover effect should only apply if hover-editor is visible
										if(colorinput.closest('.optioneditor-fontstyleeditor-c').find('.hover-editor').is(':visible'))
										{
											// var css_attribute: to apply the hover effect on the proper css property (color, bg, border)
											var css_attribute = colorinput.closest('.optioneditor-fontstyleeditor-c').find('.export_css_property_hover').val();
											$(colorpicker_target).hover(
																				function(){
																					$(this).css(css_attribute, colorinput.closest('.optioneditor-fontstyleeditor-c').find('.css_hover_value').val());
																				},
																				function(){
																					$(this).css(css_attribute, colorinput.closest('.optioneditor-fontstyleeditor-c').find('.css_default_value').val());
																				}
																				);
											
										}
									}
									
									
									
								});

			$(this).change(function(){ updateElementColor(); });	
		
		} // end colorkit

	
	
}); // end document ready

	function adjustElementSetWidth(element_container)
	{
		var element_container = $(element_container).closest('.element-container');
		var element_set = element_container.find('.cfg-element-set');
		
		if(element_container.find('.option-positionning.alignleft').is(':checked') 
			&& (element_container.find('.label-positionning.alignleft').is(':checked') || element_container.find('.label-positionning.alignright').is(':checked'))
			)
		{
			
			var cfg_element_container = element_container.find('.cfg-element-container');
			//var cfg_element_container_width = parseInt(cfg_element_container.innerWidth());
			var cfg_element_container_width = parseInt(cfg_element_container.outerWidth(true)); //.outerWidth( [includeMargin] )
				
			var label = element_container.find('.cfg-label');
			//var label_width = parseInt(label.innerWidth());
			var label_width = parseInt(label.outerWidth(true)); //.outerWidth( [includeMargin] )
			
			var element_set_width = cfg_element_container_width - label_width;
			
			element_set.css({'width':element_set_width+'px'});
			//element_set.css({'background-color':'#ff0044'});
			/*
			console.log('label_width     element_set_width     cfg_element_container_width');
			console.log(label_width+'                                     '+element_set_width+'                              '+cfg_element_container_width);
			console.log('------------------------------------------------------------------');
			*/
			
		} else{
			element_set.css({'width':''});
			//element_set.css({'background-color':'#0f0'});
		}

	}

	function adjustElementHeightToLeftContent(element_container)
	{
		element_container = $(element_container);
		

		if(parseInt(element_container.find('.cfg-element-container').innerHeight()) + 20 > element_container.innerHeight())
		{// ^-- +20 helps adjusting the height comparison: always return the right result on focusout event for paragraphs
			var adjust_element_editor_height = parseInt(element_container.find('.cfg-element-container').innerHeight());
			element_container.css({'height':adjust_element_editor_height});
			
			//console.log('new height: '+adjust_element_editor_height);
		} else{
			//element-editor-container
			element_container.css({'height':parseInt(element_container.find('.element-editor-container').innerHeight())});
		}
	}


	function formatSubmit(target, color, backgroundcolor, bordercolor)
	{	
		$('#'+target).css('background-color',backgroundcolor);
		default_backgroundcolor_submit = backgroundcolor;
		
		$('#'+target).css('color',color);
		default_color_submit = color;
		
		$('#'+target).css('border-color',bordercolor);
		default_bordercolor_submit = bordercolor;
	}
	
	/**
	 * Update default width values on change/slide events with WIDTH SLIDER
	 */
	function sliderUpdateDefaultWidthValue(value, target_id, slidervaluecontainer_id)
	{
		$(slidervaluecontainer_id).val(value);
								
		$(target_id).css('width', value);
						
		if($(target_id).hasClass('cfg-submit'))
		{
			default_width_submit = value;
		}
		
		if($(target_id).hasClass('cfg-paragraph'))
		{
			default_width_paragraph = value;
		}
		
		if($(target_id).hasClass('cfg-type-textarea'))
		{
			default_width_textarea = value;
		}
		
		if($(target_id).hasClass('cfg-type-text') && !$(target_id).hasClass('cfg-type-date') && !$(target_id).hasClass('cfg-type-email'))
		{
			default_width_input = value;
		}
		
		if($(target_id).hasClass('cfg-type-date'))
		{
			default_width_date = value;
		}
		
		if($(target_id).hasClass('cfg-type-email'))
		{
			default_width_email = value;
		}

	}
	
	
	/***
	 * COLOR PICKER
	 */
	
	function setUpColorPicker()
	{
		f = $.farbtastic(colorpicker_id, '');
		f.linkTo(colorpicker_value); // linked to color input value
		$(colorpicker_id).fadeIn('fast');
	}
	
	
	function updateElementColor()
	{ // ^-- can't be included in colorkit, the function is also called in farbtastic js file
		
			var c = $(colorpicker_value).val();
			
			$(colorpicker_value).closest('.colorpicker-container').find('.colorpicker-ico').css('background-color', c);
			
			
			if(colorpicker_csspropertyname['color'])
			{
				if($(colorpicker_target).hasClass('cfg-title')){
					default_color_title = c;
					
					// APPLY COLOR VALUE FROM TOP PAN TO COLOR INPUTS IN ELEMENT EDITOR
					$(colorpicker_target).closest('.element-container').find('.colorpickervalue').val(c);
					$(colorpicker_target).closest('.element-container').find('.colorpickervalue').css('background-color',c);
					$(colorpicker_target).closest('.element-container').find('.colorpicker-ico').css('background-color',c);
					
				}
				if($(colorpicker_target).hasClass('cfg-paragraph')){
					default_color_paragraph = c;
					
					// APPLY COLOR VALUE FROM TOP PAN TO COLOR INPUTS IN ELEMENT EDITOR
					$(colorpicker_target).closest('.element-container').find('.colorpickervalue').val(c);
					$(colorpicker_target).closest('.element-container').find('.colorpickervalue').css('background-color',c);
					$(colorpicker_target).closest('.element-container').find('.colorpicker-ico').css('background-color',c);
				}
				if($(colorpicker_target).hasClass('cfg-label')){
					default_color_label = c;
				}
				if($(colorpicker_target).hasClass('formelement')){
					default_color_formelement = c;
				}
				if($(colorpicker_target).hasClass('cfg-submit')){
					default_color_submit = c;
				}
				
				$(colorpicker_target).css('color', c);
			}
			
			if(colorpicker_csspropertyname['background-color'])
			{
				if($(colorpicker_target).hasClass('cfg-submit')){
					default_backgroundcolor_submit = c;
				}
				$(colorpicker_target).css('background-color', c);
			}
			
			if(colorpicker_csspropertyname['border-color'])
			{
				if($(colorpicker_target).hasClass('cfg-submit')){
					default_bordercolor_submit = c;
				}
				$(colorpicker_target).css('border-color', c);
			}
			
			if(colorpicker_csspropertyname['border-color'])
			{
				if($(colorpicker_target).hasClass('formelement')){
					default_bordercolor_inputformat = c;
				}
				$(colorpicker_target).css('border-color', c);
			}
	}
	

