<?php
/**********************************************************************************
 * Contact Form Generator is (c) Top Studio
 * It is strictly forbidden to use or copy all or part of an element other than for your 
 * own personal and private use without prior written consent from Top Studio http://topstudiodev.com
 * Copies or reproductions are strictly reserved for the private use of the person 
 * making the copy and not intended for a collective use.
 *********************************************************************************/

class contactFormEditor{

	function contactFormEditor()
	{
		$this->version = '1.5';
		$this->export_version = '1.0';
		
		$this->forms_index_filename = 'forms.txt';

		$this->path_jquery = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';
		$this->path_jquery_ui = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js';
		$this->path_jquery_ui_theme = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/smoothness/jquery-ui.css';
		$this->path_jquery_ui_datepicker_language = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/i18n/jquery-ui-i18n.min.js';
		
		/* admin notification */
		$this->config_adminnotification_subject = 'New message sent from your website';
		$this->config_validationmessage = 'Thank you, your message has been sent to us.'."\r\n".'We will get back to you as soon as possible.';
	
		/* user notification */
		$this->config_usernotification_subject = 'Thanks for your message';
		$this->config_usernotification_message = 'Thank you for contacting us.'."\r\n".'We will answer you as soon as possible.';
		
		$this->config_email_address = '';
		$this->config_email_from = '';
		$this->config_email_address_cc = ''; // Use commas to separate mutiple e-mail addresses
		$this->config_email_address_bcc = ''; // Use commas to separate mutiple e-mail addresses
		$this->config_errormessage_captcha = 'Value does not match';
		$this->config_errormessage_emptyfield = 'This field can\'t be left empty';
		$this->config_errormessage_invalidemailaddress = 'Invalid email address';
		$this->config_errormessage_uploadfileistoobig = 'File size is too large';
		$this->config_errormessage_uploadinvalidfiletype = 'Unauthorized file type';
		
		$this->config_formname = 'My Contact Form'; // should only contain alphanumeric characters [a...z A...Z 0...9]
		$this->element_name_prefix = 'cfg-element-';
		$this->option_name_prefix = 'cfg-option-';
		$this->uploadbutton_prefix = 'uploadbutton_';
		$this->paragraph_suffix = '-paragraph';
		$this->label_suffix = '-label';
		$this->elementset_suffix = '-set';
		$this->elementcontent_suffix = '-content';
		$this->optioncontent_suffix = '-option-content';
		/**
		 * Form Set Up
		 * Possible values:
		 *	Captcha field: 'captcha'
		 *	Checkboxes: 'checkbox'
		 *	Date field: 'date'
		 *	Email field: 'email'
		 *	Image: 'image'
		 *	Paragraph: 'paragraph'
		 *	Radio buttons: 'radio'
		 *	Select / Drop-down list: 'select'
		 *	Select Multiple / Drop-down list: 'selectmultiple'
		 *	Single line text: 'text'
		 *	Submit button : 'submit'
		 *	Textarea / Multi-line Text: 'textarea'
		 *	Title: 'title'
		 *	Time field: 'time'
		 *	Upload / File attachment: 'upload'
		 */
		 
		$this->form_elements_setup = array();
		
		$this->addElement('title');
		$this->addElement('paragraph');
		$this->addElement('email');
		$this->addElement('textarea');
		$this->addElement('submit');
		/*
		*/
		
		/*
		$this->addElement('title');
		$this->addElement('paragraph');
		$this->addElement('email');
		$this->addElement('text');
		$this->addElement('textarea');
		$this->addElement('checkbox');
		$this->addElement('radio');
		$this->addElement('select');
		$this->addElement('selectmultiple');
		$this->addElement('upload');
		$this->addElement('image');
		$this->addElement('date');
		$this->addElement('time');
		$this->addElement('captcha');
		$this->addElement('submit');
		*/
	
		$this->default_option_value = 'Option';
		$this->default_newoption_value = 'New option';
		
		$this->html_empty_image_container = '<div class="addimagecontainer">Use the options on the right to add an image here</div>';
		$this->dir_upload = 'upload/';
		$this->upload_image_authorized_ext = array ('.jpg', '.jpeg', '.jpe', '.gif', '.png');
		foreach($this->upload_image_authorized_ext as $ext_value)
		{
			$this->swfupload_authorized_ext .= '*'.$ext_value.';';
		}
		$this->swfupload_authorized_ext = substr($this->swfupload_authorized_ext, 0, -1);
		
		$this->default_width_captcha = 110;
		$this->default_width_date = 100;
		$this->default_width_email = 220;
		$this->default_width_input = 220;
		$this->default_width_label = 130;
		$this->default_width_option = 100;
		$this->default_width_paragraph = 300;
		$this->default_width_submit = 140;
		$this->default_width_textarea = 300;
		
		$this->default_marginleft_submit = 0;
		$this->default_margintop_option = 0;
		
		$this->default_rows_textarea = 6;

		$this->slider_marginleft_min = 0;
		$this->slider_marginleft_max = 400;
		$this->slider_width_min = 10;
		$this->slider_width_max = 430;
		$this->slider_rows_min = 1;
		$this->slider_rows_max = 30;
		$this->slider_fontsize_min = 8;
		$this->slider_fontsize_max = 60;
		$this->slider_fontsize_step = 1;
		$this->slider_margintop_min = 0;
		$this->slider_margintop_max = 20;
		
		
		$this->default_backgroundcolor_submit = '#f1f1f1';
		$this->default_bordercolor_submit = '#cccccc';
		
		$this->default_color_formelement = '#000000';
		$this->default_color_label = '#4DBCE9';
		$this->default_color_paragraph = '#000000';
		$this->default_color_submit = '#555555';
		$this->default_color_title = '#26ADE4';
		
		$this->default_fontfamily_formelement = 'Verdana';
		$this->default_fontfamily_label = 'Trebuchet MS';
		$this->default_fontfamily_paragraph = 'Verdana';
		$this->default_fontfamily_submit = 'Arial';
		$this->default_fontfamily_title = 'Arial';
		
		$this->default_fontsize_formelement = '12';
		$this->default_fontsize_label = '18';
		$this->default_fontsize_paragraph = '12';
		$this->default_fontsize_submit = '20';
		$this->default_fontsize_title = '36';
		
		$this->default_fontweight_formelement = 'normal';
		$this->default_fontweight_label = 'normal';		
		$this->default_fontweight_paragraph = 'normal';
		$this->default_fontweight_submit = 'bold';
		$this->default_fontweight_title = 'bold';
		

		$this->default_bordercolor_inputformat = '#dcdcdc';
		$this->default_borderradius_inputformat = '4';
		$this->default_borderwidth_inputformat = '1';
		$this->default_padding_inputformat = '5';
		
		

		// use <br /> or <br> to insert line breaks
		$this->default_label_title = 'Contact us';
		$this->default_label_paragraph = 'To contact us, use the form below.<br />We will get back to you as soon as possible.';
		$this->default_label_captcha = 'Captcha: enter the letters below';
		$this->default_label_checkbox = 'Checkboxes';
		$this->default_label_date = 'Date';
		$this->default_label_email = 'Email address';
		$this->default_label_radio = 'Radio buttons';
		$this->default_label_select = 'Select';
		$this->default_label_selectmultiple = 'Multiple Select';
		$this->default_label_submit = 'Send';
		$this->default_label_textarea = 'Your message';
		$this->default_label_text = 'Text field';
		$this->default_label_time = 'Time';
		$this->default_label_upload = 'Upload';

		$this->datepicker_default_format = 'mm/dd/yy';
		// y - year (two digit) yy - year (four digit) http://docs.jquery.com/UI/Datepicker/formatDate
		$this->datepicker_formats = array(
										  				'mm/dd/yy'=>'mm/dd/y',
										  				'mm/dd/yyyy'=>'mm/dd/yy',
										  				'dd/mm/yy'=>'dd/mm/y',
										  				'dd/mm/yyyy'=>'dd/mm/yy',
										  				'dd-mm-yy'=>'dd-mm-y',
										  				'dd-mm-yyyy'=>'dd-mm-yy',
										  				'yy-mm-dd'=>'y-mm-dd',
										  				'yyyy-mm-dd'=>'yy-mm-dd'
										  				);
		
		$this->datepicker_language = array(
										   					'Bosnian'=>'bs',
										   					'Bulgarian'=>'bg',
										   					'Brazilian'=>'pt-BR',
										   					'Chinese (simplified)'=>'zh-CN',
										   					'Chinese (traditional)'=>'zh-TW',
										   					'Czech'=>'cs',
										   					'Croatian'=>'hr',
										   					'Danish'=>'da',
										   					'Dutch'=>'nl',
										   					'English'=>'en-GB',
										   					'Español'=>'es',
										   					'Estonian'=>'et',
										   					'Finnish'=>'fi',
										   					'French'=>'fr',
										   					'German'=>'de',
										   					'Greek'=>'el',
										   					'Hebrew'=>'he',
										   					'Hungarian'=>'hu',
										   					'Icelandic'=>'is',
										   					'Indonesian'=>'id',
										   					'Italian'=>'it',
										   					'Japanese'=>'ja',
										   					'Lithuanian'=>'lt',
										   					'Norwegian'=>'no',
										   					'Polish'=>'pl',
										   					'Portuguese'=>'pt-BR',
										   					'Romanian'=>'ro',
										   					'Russian'=>'ru',
										   					'Serbian'=>'sr',
										   					'Slovak'=>'sk',
										   					'Slovenian'=>'sl',
										   					'Swedish'=>'sv',
										   					'Ukrainian'=>'uk',
										   					'Vietnamese'=>'vi'
															);
		
		$this->datepicker_default_language = 'English';
		
		
		
		$this->captcha_default_length = 6;
		$this->captcha_default_format = 'lettersandnumbers'; // Choices: lettersandnumbers / letters / numbers
		
		$this->upload_filesizelimit = 1; //preg_replace('/M/i', '', ini_get('upload_max_filesize'));
		$this->upload_filesizeunit = 'MB';
		$this->upload_fileextension = array(
															'Image' =>	 array('jpeg', 'jpg', 'tif', 'png', 'gif', 'bmp', 'psd', 'ai', 'eps'),
															'Text' => array('doc', 'docx', 'pdf', 'txt', 'xls', 'xlsx')
														);
		
		$this->submit_colors = array(
									 	array('name'=>'Blue', 'color'=>'#FFF', 'backgroundcolor' => '#339cde', 'bordercolor' => '#077bc4'),
										array('name'=>'Green', 'color'=>'#FFF', 'backgroundcolor' => '#6ab12b', 'bordercolor' => '#489404'),
										array('name'=>'Grey', 'color'=>'#555555', 'backgroundcolor' => '#f1f1f1', 'bordercolor' => '#cccccc'),
										array('name'=>'Orange', 'color'=>'#FFF', 'backgroundcolor' => '#ff8f20', 'bordercolor' => '#f18e09'),
										array('name'=>'Red', 'color'=>'#FFF', 'backgroundcolor' => '#cc0000', 'bordercolor' => '#ac0404'),
										array('name'=>'Yellow', 'color'=>'#000000', 'backgroundcolor' => '#ffe01b', 'bordercolor' => '#f4d303')
									);
		
		$this->fontstyleeditor_fontlist = array('Arial', 'Courier New', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana');
		
		$this->message_style_padding = 'padding:5px 7px;';
		
		$this->validation_message_styles = array(
												 
												 
												 array('background-color:#88CC00; color:#fff;'.$this->message_style_padding),
												 array('background-color:#77B300; color:#fff;'.$this->message_style_padding),
												 array('background-color:#669900; color:#fff;'.$this->message_style_padding),
												 
												 
												 array('background-color:#00b700; color:#fff;'.$this->message_style_padding),
												 array('background-color:#009900; color:#fff;'.$this->message_style_padding),
												 array('background-color:#008000; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#5FB35F; color:#fff;'.$this->message_style_padding),
												 array('background-color:#519951; color:#fff;'.$this->message_style_padding),
												 array('background-color:#448044; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#BACC93; color:#fff;'.$this->message_style_padding),
												 array('background-color:#A3B381; color:#fff;'.$this->message_style_padding),
												 array('background-color:#8B996E; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#fff; color:#00BD00;'.$this->message_style_padding),
												 array('background-color:#fff; color:#00A100;'.$this->message_style_padding),
												 array('background-color:#fff; color:#007500;'.$this->message_style_padding),
												 
												 );
		
		$this->default_validation_message_style = 3;
		
		// 1st color: start color
		// 2nd color: 1st V-10
		// 3rd color: 1st V-20
		$this->error_message_styles = array(
												 
												 array('background-color:#FF0033; color:#fff;'.$this->message_style_padding),
												 array('background-color:#E6002E; color:#fff;'.$this->message_style_padding),
												 array('background-color:#CC0029; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#FF0000; color:#fff;'.$this->message_style_padding),
												 array('background-color:#E60000; color:#fff;'.$this->message_style_padding),
												 array('background-color:#CC0000; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#FF4747; color:#fff;'.$this->message_style_padding),
												 array('background-color:#E64040; color:#fff;'.$this->message_style_padding),
												 array('background-color:#CC3939; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#FF9A9A; color:#fff;'.$this->message_style_padding),
												 array('background-color:#E68A8A; color:#fff;'.$this->message_style_padding),
												 array('background-color:#CC7A7A; color:#fff;'.$this->message_style_padding),
												 
												 array('background-color:#fff; color:#FF0000;'.$this->message_style_padding),
												 array('background-color:#fff; color:#E60000;'.$this->message_style_padding),
												 array('background-color:#fff; color:#CC0000;'.$this->message_style_padding),
												 );
		
		$this->default_error_message_style = 3;
		
		$this->regex_replace_formname_pattern = ' '; // spaces will be replaced with dashes
		$this->regex_replace_formname_replacement = '-'; // spaces will be replaced with dashes
		
		$this->regex_pattern_formname = '/^[a-z0-9- ]+$/i'; // letters, numbers, - , spaces, case insensitive
		//$this->regex_pattern_formname = '/^[\p{L}]+$/ui'; // letters, numbers, - , spaces, case insensitive
		
		$this->warning_php5 = '<div class="warning" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">'
										.'<p><strong>Error: Contact Form Generator requires PHP 5.2 or newer to work properly</strong>.</p>'
										.'<p>The version of PHP installed on your server is <strong>'.phpversion().'</strong></p>'
										.'<p>You can solve this problem by contacting your web hosting technical support and ask them to activate PHP 5.2 or newer.</p>'
										.'<p>Don\'t hesitate to contact us at support@topstudiodev.com if you need further assistance, we will be glad to help you.</p>'
										.'</div>';
		
		$this->dir_form_inc = 'cfg-contactform';
		$this->dir_form_download = 'contactform-download';
		
		$this->reset_json_index_content = '{"forms":[]}';
		
		$this->error_not_writable_form_index_file = '<p>The file that indexes your forms can\'t be edited.</p>'
																	.'<p>Set the permission to 755 on the file \'editor/'.$this->dir_form_download.'/'.$this->forms_index_filename.'\' on your server to solve this problem.</p>'
																	.'<p>Set the permission to 777 if it does not work otherwise.</p>';

		$this->error_not_writable_dir_form_download = '<p>The directory that will contain your new forms can\'t be edited.</p>'
																		.'<p>Set the permission to 755 on the \'editor/'.$this->dir_form_download.'\' directory on your server to solve this problem.</p>'
																		.'<p>Set the permission to 777 if it does not work otherwise.</p>';


		$this->error_not_writable_dir_upload = '<p>The directory that will contain your new forms can\'t be edited.</p>'
															.'<p>Set the permission to 755 on the \'editor/'.$this->dir_form_download.'\' directory on your server to solve this problem.</p>'
															.'<p>Set the permission to 777 if it does not work otherwise.</p>';

		$this->error_not_writable_dir_upload = '<p>The directory that will contain your uploads can\'t be edited.</p>'
															.'<p>Set the permission to 755 on the directory \'editor/upload\' on your server to solve this problem.</p>'
															.'<p>Set the permission to 777 if it does not work otherwise.</p>';


		$style_fontfamily_formelement = 'font-family:'.$this->default_fontfamily_formelement.';';
		$style_fontsize_formelement = 'font-size:'.$this->default_fontsize_formelement.'px;';
		if($this->default_fontweight_formelement == 'bold' || $this->default_fontweight_formelement == 'normal')
		{
			$style_fontweight_formelement = 'font-weight:'.$this->default_fontweight_formelement.';';
		}
		if($this->default_fontweight_formelement == 'italic' )
		{
			$style_fontweight_formelement = 'font-style:'.$this->default_fontweight_formelement.';';
		}
		$style_color_formelement = 'color:'.$this->default_color_formelement.';';
		$this->style_formelement = $style_fontfamily_formelement.$style_fontsize_formelement.$style_fontweight_formelement.$style_color_formelement;

		$this->cr_sha1 = '423700b9f763d025147a87f9d316b24f0fefbb7a';

	}
	
	function errorNotWritableDirForm($form_dir)
	{
		$error = '<p>The form directory can\'t be edited.</p>'
					.'<p>Set the permission to 755 on the directory \'editor/'.$this->dir_form_download.'/'.$form_dir.'\' on your server to solve this problem.</p>'
					.'<p>Also set the permission to 755 on the directory \'editor/'.$this->dir_form_download.'\' on your server to solve this problem.</p>'
					.'<p>Set the permission to 777 for both directories if it does not work otherwise.</p>';
		
		return($error);
	}
	
	function errorNotWritableAdminUpload($filename)
	{
													
		$error = '<p>This file can\'t be edited.</p>'
					.'<p>Set the permission to 755 on the file \'editor/upload/'.addcslashes($filename, '"').'\' on your server to solve this problem.</p>'
					.'<p>Also set the permission to 755 on the directory \'editor/upload\' on your server to solve this problem.</p>'
					.'<p>Set the permission to 777 for both elements if it does not work otherwise.</p>';
	
		return($error);
	}
	
	function addElement($type){
		$this->form_elements_setup[]['type'] = $type;
	}
	
	
	function editorParagraph(){
		?>
		<div class="optioneditor-text">Paragraph</div>
				
		<div class="textbox-container">
		<textarea rows="4" cols="10" class="input-elementeditor inputborder-elementeditor edit-paragraph" ><?php echo preg_replace('#<br(\s*)/>|<br(\s*)>#i', "\r\n", $this->default_label_paragraph); ?></textarea>
		</div>
		<?php
	}

	function addEditParagraph($element)
	{
		if(isset($element['id']) && $element['id'])
		{
			$edit_paragraph_value = (isset($element['paragraph']['value']) && $element['paragraph']['value'])? $element['paragraph']['value'] : '';
		} else{
			if($element['type'] == 'paragraph')
			{
				$edit_paragraph_value = $this->default_label_paragraph;
			} else{
				$edit_paragraph_value = '';
			}
		}
				
		?>
		<div class="optioneditor-text">Paragraph</div>
						
		<div class="textbox-container">
		<textarea rows="3" cols="10" class="input-elementeditor inputborder-elementeditor edit-paragraph" ><?php echo preg_replace('#<br(\s*)/>|<br(\s*)>#i', "\r\n", $edit_paragraph_value); ?></textarea>
		</div>
		
		<div class="optioneditor-text">Font and color</div>
		
		<?php
		$preselect_fontfamily = (isset($element['paragraph']['css']['default']['font-family']) && $element['paragraph']['css']['default']['font-family']) ? $element['paragraph']['css']['default']['font-family'] : $this->default_fontfamily_paragraph;
		$this->addEditFontFamily(array('class_select'=>'newfontfamily-paragraph', 'preselect_value'=>$preselect_fontfamily));
		
		$slider_update_var_name = 'default_fontsize_paragraph';
		$slider_fontsize_value = 	(isset($element['paragraph']['css']['default']['font-size']) && $element['paragraph']['css']['default']['font-size']) ? preg_replace("/[^0-9\.]/", '',$element['paragraph']['css']['default']['font-size']) : $slider_update_var_name;
		$this->addEditFontSize($element, array('slider_update_var_name'=>$slider_update_var_name, 'slider_value'=>$slider_fontsize_value));
		
		$preselect_fontweight = (isset($element['paragraph']['css']['default']['font-weight']) && $element['paragraph']['css']['default']['font-weight']) ? $element['paragraph']['css']['default']['font-weight'] : $this->default_fontweight_paragraph;
		$preselect_fontweight = (isset($element['paragraph']['css']['default']['font-style']) && $element['paragraph']['css']['default']['font-style']) ? $element['paragraph']['css']['default']['font-style'] : $preselect_fontweight;
		$this->addEditFontWeight(array('class_select'=>'newfontweight-paragraph', 'preselect_value'=>$preselect_fontweight));
		?>

		<div class="optioneditor-fontstyleeditor-c">
			<div class="optioneditor-fontstyleeditor-l">
			Font color:
			</div>
						
			<div class="optioneditor-fontstyleeditor-r">
			<?php
			$configcolorpicker['colorpicker_defaultcolor'] = (isset($element['paragraph']['css']['default']['color']) && $element['paragraph']['css']['default']['color']) ? $element['paragraph']['css']['default']['color'] : $this->default_color_paragraph;
			$configcolorpicker['colorpicker_csspropertyname'] = 'color';
			$configcolorpicker['colorpickervalue_id'] = 'element_color_'.$_SESSION['form_element_id'];
			$configcolorpicker['colorpicker_id'] = 'element_colorpicker_'.$_SESSION['form_element_id'];
			echo $this->setUpColorPicker($configcolorpicker);
			?>
			</div>

			<div class="clear"></div>
			
		</div><!-- optioneditor-fontstyleeditor-c -->
		
		<?php
		$slider_width_value = (isset($element['paragraph']['css']['default']['width']) && $element['paragraph']['css']['default']['width']) ? preg_replace("/[^0-9\.]/", '',$element['paragraph']['css']['default']['width']) : $this->default_width_paragraph;
		$this->addEditWidth($element, array('slider_value'=>$slider_width_value, 'target_type'=>'paragraph'));
		?>
		
	<?php
	}
	
	function addEditFontFamily($config)
	{
	?>
		<div class="optioneditor-fontstyleeditor-c">
			<div class="optioneditor-fontstyleeditor-l">
			Font family:
			</div>
	
			<div class="optioneditor-fontstyleeditor-r">
			<select class="selectfontfamily <?php echo $config['class_select'];?>">
					
				<?php
				foreach($this->fontstyleeditor_fontlist as $value)
				{
				?>
				<option value="<?php echo $value;?>" style="font-family:'<?php echo $value;?>'" <?php echo $config['preselect_value']==$value?'selected':'';?>><?php echo $value;?></option>
				<?php
				}
				?>
			</select>
			</div>
			<div class="clear"></div>
		</div>
	
	<?php	
	}
	
	function addEditFontSize($element, $config)
	{
	?>
			<div class="optioneditor-fontstyleeditor-c">
				<div class="optioneditor-fontstyleeditor-l">
				Font size:
				</div>
				
				<div class="optioneditor-fontstyleeditor-r">
					<?php
					$slider_fontsize_id = (isset($element['id']) && $element['id']) ? 'sliderelement-fontsize-'.$element['id'] : 'sliderelement-fontsize-'.$this->htmlElementName($_SESSION['form_element_id']);
					$slider_fontsize_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-fontsize-value-'.$element['id'] : 'sliderelement-fontsize-value-'.$this->htmlElementName($_SESSION['form_element_id']);
					?>
					
					<script>
					$('#<?php echo $slider_fontsize_id;?>').slider(
					{
						range: 'min',
						min: <?php echo $this->slider_fontsize_min;?>,
						max: <?php echo $this->slider_fontsize_max;?>,
						value: <?php echo $config['slider_value'];?>,
						step: <?php echo $this->slider_fontsize_step;?>,
						slide: function( event, ui ){
							$('#<?php echo $slider_fontsize_value_id;?>').html(ui.value);
							<?php echo $config['slider_update_var_name'];?> = ui.value;
							$(this).closest('.element-container').find('.sliderfontsizetarget').css('font-size', ui.value+'px');
						}
					});
					
					$('#<?php echo $slider_fontsize_value_id;?>').html( $('#<?php echo $slider_fontsize_id;?>').slider('value') );
					</script>					
							
							
					<p style="margin:0 0 6px 0"><span class="slidertrackervalue"><span id="<?php echo $slider_fontsize_value_id;?>" class="sliderelement-fontsize-value"></span>px</span></p>
					<div id="<?php echo $slider_fontsize_id;?>"></div>
				</div>
				<div class="clear"></div>
		</div>
		<?php
	}
	
	function addEditWidth($element, $config)
	{
		// $config['target_type'] prevents id name conflicts between width two width sliders: one slider for the element input width and one slider for the paragraph
		// without $config['target_type'] we would have "sliderelement-width-cfg-element-83" twice and the input width slider would be missing
		$slider_width_id = (isset($element['id']) && $element['id']) ? 'sliderelement-width-'.$config['target_type'].'-'.$element['id'] : 'sliderelement-width-'.$config['target_type'].'-'.$this->htmlElementName($_SESSION['form_element_id']);
				
		if($config['target_type'] == 'paragraph')
		{
			$slider_width_target_id = (isset($element['id']) && $element['id']) ? $element['id'].$this->paragraph_suffix : $this->htmlElementName($_SESSION['form_element_id']).$this->paragraph_suffix;
			
			$slider_width_class = 'slider-paragraph-width-value'; // not the same slider for element and for paragraph: the json export is based on this class name to catch the width value
		} else{
			$slider_width_target_id = (isset($element['id']) && $element['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
			
			$slider_width_class = 'slider-element-width-value'; // not the same slider for element and for paragraph: the json export is based on this class name to catch the width value
		}
				
		$slider_width_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-width-'.$config['target_type'].'-value-'.$element['id'] : 'sliderelement-width-'.$config['target_type'].'-value-'.$this->htmlElementName($_SESSION['form_element_id']);
		
		$editor_title = 'Width';
		if($element['type'] == 'textarea')
		{
			$editor_title = 'Width and rows';
		}
		
		$input_type = array('text', 'date', 'email');
		if(in_array($element['type'], $input_type))
		{
			$editor_title = 'Input width';
		}
		?>
				<div class="optioneditor-text"><?php echo $editor_title;?></div>
				
				<div class="optioneditor-fontstyleeditor-c">
					<script>
					$('#<?php echo $slider_width_id;?>').slider(
					{
						range: 'min',
						min: <?php echo $this->slider_width_min; ?>,
						max: <?php echo $this->slider_width_max; ?>,
						value: <?php echo $config['slider_value']; ?>,
						step: 1,
						change: function( event, ui )
						{
							// the change event is called when the input ".slider-element-width-value" is updated
							sliderUpdateDefaultWidthValue(ui.value, '#<?php echo $slider_width_target_id;?>', '#<?php echo $slider_width_value_id;?>');
						},
						slide: function( event, ui )
						{
							sliderUpdateDefaultWidthValue(ui.value, '#<?php echo $slider_width_target_id;?>', '#<?php echo $slider_width_value_id;?>');
							
							if($('#<?php echo $slider_width_target_id;?>').hasClass('cfg-paragraph'))
							{
								$('#<?php echo $slider_width_target_id;?>').addClass('slidertrackerwidthborder');
								
							}
							
						},
						stop: function(event, ui)
						{
							if($('#<?php echo $slider_width_target_id;?>').hasClass('cfg-paragraph'))
							{
								$('#<?php echo $slider_width_target_id;?>').removeClass('slidertrackerwidthborder');
								
							}
						}
					});
				
					</script>
					
					<div style="margin-bottom:6px;">Width: <input type="text" id="<?php echo $slider_width_value_id;?>" class="<?php echo $slider_width_class;?> slider-value inputborder-elementeditor" value="<?php echo $config['slider_value'];?>" />px</div>
					
					<div id="<?php echo $slider_width_id;?>"></div>
	
	
				</div>
				<div class="clear"></div>
				
	
	<?php
	}
	
	function addEditFontWeight($config)
	{
	?>
		<div class="optioneditor-fontstyleeditor-c">
			<div class="optioneditor-fontstyleeditor-l">
			Font weight:
			</div>
			
			<div class="optioneditor-fontstyleeditor-r">
				<select class="selectfontweight <?php echo $config['class_select'];?>" >
				<option value="normal" <?php echo $config['preselect_value']=='normal'?'selected':'';?>>Normal</option>
				<option value="bold" <?php echo $config['preselect_value']=='bold'?'selected':'';?>>Bold</option>
				<option value="italic" <?php echo $config['preselect_value']=='italic'?'selected':'';?>>Italic</option>
				</select>
			</div>
			
			<div class="clear"></div>
	</div>
	
	<?php
	}
	

	function addEditAlignment($element)
	{
		?>
		<div class="optioneditor-text">Label alignment</div>
		
		<?php
		$html_id = 'labelpositionning-'.$_SESSION['form_element_id'];
		
		$edit_align_label_left = (isset($element['label']['css']['default']['text-align']) && $element['label']['css']['default']['text-align'] == 'left') ? ' checked="checked" ' : '';
		$edit_align_label_right = (isset($element['label']['css']['default']['text-align']) && $element['label']['css']['default']['text-align'] == 'right') ? ' checked="checked" ' : '';

		$edit_align_label_top = '';
		// if no text-align property => vertical alignment
		if(!$edit_align_label_left && !$edit_align_label_right)
		{
			$edit_align_label_top = ' checked="checked" '; 
			$display_editwidth_label = 'display:none;';
		} else{
			$display_editwidth_label = '';
		}
		?>
				
		<div class="textbox-container">
			<div class="optioneditor-fontstyleeditor-c">
			<input type="radio" name="<?php echo $html_id;?>" class="label-positionning aligntop" value="aligntop" <?php echo $edit_align_label_top;?> /> Top-aligned label
			<br />
			<input type="radio" name="<?php echo $html_id;?>" class="label-positionning alignleft" value="alignleft" <?php echo $edit_align_label_left;?> /> Left-aligned label
			<br />
			<input type="radio" name="<?php echo $html_id;?>" class="label-positionning alignright" value="alignright" <?php echo $edit_align_label_right;?> /> Right-aligned label
			
			</div>
		</div>
		
		<div class="cfg-elementeditor-label-width" style=" <?php echo $display_editwidth_label;?>">
		
		<div class="optioneditor-text">Label width</div>
	
		<div class="optioneditor-fontstyleeditor-c">
		
			<?php
			$slider_width_id = (isset($element['id']) && $element['id']) ? 'sliderelement-label-width-'.$element['id'] : 'sliderelement-label-width-'.$this->htmlElementName($_SESSION['form_element_id']);
			$slider_width_target_id = (isset($element['id']) && $element['id']) ? $this->buildElementLabelId($element['id']) : $this->buildElementLabelId($this->formatElementHtmlId(array('target_id'=>$_SESSION['form_element_id'])));
			$slider_width_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-label-width-value-'.$element['id'] : 'sliderelement-label-width-value-'.$this->htmlElementName($_SESSION['form_element_id']);
			$slider_width_value = (isset($element['label']['css']['default']['width']) && $element['label']['css']['default']['width']) ? preg_replace("/[^0-9\.]/", '', $element['label']['css']['default']['width']) : 0; // default setting: top alignment, width = 0 (inserting the label width in the json data is based on the presence of a width value in the input)
			?>
			<script>
			$('#<?php echo $slider_width_id;?>').slider(
			{
				range: 'min',
				min: <?php echo $this->slider_width_min; ?>,
				max: <?php echo $this->slider_width_max; ?>,
				value: <?php echo $slider_width_value; ?>,
				step: 1,
				change: function(event, ui)
				{
					// the change event is called when the input ".slider-element-width-value" is updated
					sliderUpdateDefaultWidthValue(ui.value, '#<?php echo $slider_width_target_id;?>', '#<?php echo $slider_width_value_id;?>');
					
				},
				slide: function(event, ui)
				{
					sliderUpdateDefaultWidthValue(ui.value, '#<?php echo $slider_width_target_id;?>', '#<?php echo $slider_width_value_id;?>');
					
					var element_container = $(this).closest('.element-container');
					adjustElementSetWidth($(this)); // must be called to adjust cfg-element-set width
					
					/* removed because the border messes with the width calculation of each side (when the border is added, there is a bump on the options alignment)
					if($('#<?php echo $slider_width_target_id;?>').hasClass('cfg-label'))
					{
						$('#<?php echo $slider_width_target_id;?>').addClass('slidertrackerwidthborder');
						
					}
					*/	
				},
				stop: function(event, ui)
				{
					/* removed because the border messes with the width calculation of each side (when the border is added, there is a bump on the options alignment)
					if($('#<?php echo $slider_width_target_id;?>').hasClass('cfg-label'))
					{
						$('#<?php echo $slider_width_target_id;?>').removeClass('slidertrackerwidthborder');
					}
					*/
				}
			});
				
			</script>
			
			<div style="margin-bottom:6px;">Width: <input type="text" id="<?php echo $slider_width_value_id;?>" class="sliderelement-label-width-value slider-value inputborder-elementeditor" value="<?php echo $slider_width_value;?>" />px</div>
					
			<div id="<?php echo $slider_width_id;?>"></div>
	
		</div><!--optioneditor-fontstyleeditor-c-->
		</div><!--cfg-elementeditor-width-->


		<?php
		if($element['type'] == 'radio' || $element['type'] == 'checkbox')
		{
		?>
		<div class="optioneditor-text">Options alignment</div>

		<?php
		$html_id = 'optionpositionning-'.$_SESSION['form_element_id'];
		
		$edit_align_option_left = (isset($element['option']['container']['css']['default']['float']) && $element['option']['container']['css']['default']['float'] == 'left') ? ' checked="checked" ' : '';

		$edit_align_option_top = '';
		// if no text-align property => vertical alignment
		if(!$edit_align_option_left)
		{
			$edit_align_option_top = ' checked="checked" '; 
			$display_editwidth_option = 'display:none;';
		} else{
			$display_editwidth_option = '';
		}
		?>
				
		<div class="textbox-container">
			<div class="optioneditor-fontstyleeditor-c">
			<input type="radio" name="<?php echo $html_id;?>" class="option-positionning aligntop" value="aligntop" <?php echo $edit_align_option_top;?> /> Top-aligned option
			<br />
			<input type="radio" name="<?php echo $html_id;?>" class="option-positionning alignleft" value="alignleft" <?php echo $edit_align_option_left;?> /> Left-aligned option
			
			</div>
		</div>
		
		<!-- OPTION WIDTH -->
		<div class="cfg-elementeditor-option-width" style=" <?php echo $display_editwidth_option;?>">
				
		<div class="optioneditor-fontstyleeditor-c">
			<?php
			$slider_width_id = (isset($element['id']) && $element['id']) ? 'sliderelement-option-width-'.$element['id'] : 'sliderelement-option-width-'.$this->htmlElementName($_SESSION['form_element_id']);
			$slider_width_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-option-width-value-'.$element['id'] : 'sliderelement-option-width-value-'.$this->htmlElementName($_SESSION['form_element_id']);
			$slider_width_value = (isset($element['option']['container']['css']['default']['width']) && $element['option']['container']['css']['default']['width']) ? preg_replace("/[^0-9\.]/", '', $element['option']['container']['css']['default']['width']) : 0; // default setting: top alignment, width = 0 (inserting the label width in the json data is based on the presence of a width value in the input)
			?>
			<script>
			$('#<?php echo $slider_width_id;?>').slider(
			{
				range: 'min',
				min: <?php echo $this->slider_width_min; ?>,
				max: <?php echo $this->slider_width_max; ?>,
				value: <?php echo $slider_width_value; ?>,
				step: 1,
				change: function(event, ui)
				{
					// the change event is called when the input ".slider-element-width-value" is updated
					$(this).closest('.element-container').find('.cfg-option-content').css({'width':ui.value});
					$('#<?php echo $slider_width_value_id;?>').val(ui.value);

				},
				slide: function(event, ui)
				{
					$(this).closest('.element-container').find('.cfg-option-content').css({'width':ui.value});
					$(this).closest('.element-container').find('.cfg-option-content').addClass('slidertrackerwidthborder');
					$('#<?php echo $slider_width_value_id;?>').val( ui.value );
							
				},
				stop: function(event, ui)
				{
					$(this).closest('.element-container').find('.cfg-option-content').removeClass('slidertrackerwidthborder');
				}
			});
				
			</script>
					
			<div style="margin-bottom:6px;">Width: <input type="text" id="<?php echo $slider_width_value_id;?>" class="sliderelement-option-width-value slider-value inputborder-elementeditor" value="<?php echo $slider_width_value;?>" />px</div>
					
			<div id="<?php echo $slider_width_id;?>"></div>
	
		</div><!--optioneditor-fontstyleeditor-c-->
		</div><!--cfg-elementeditor-width-->
		
		
		<!-- OPTION MARGIN-TOP -->
		<?php
		if(isset($element['label']['css']['default']['float']) && $element['label']['css']['default']['float'])
		{
			$display_editmargintop_option = '';
		} else{
			$display_editmargintop_option = 'display:none;';
		}
		?>
		<div class="cfg-elementeditor-option-margintop" style=" <?php echo $display_editmargintop_option;?>">
				
		<div class="optioneditor-fontstyleeditor-c">
			<?php
			$slider_margintop_id = (isset($element['id']) && $element['id']) ? 'sliderelement-option-margintop-'.$element['id'] : 'sliderelement-option-margintop-'.$this->htmlElementName($_SESSION['form_element_id']);
			$slider_margintop_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-option-margintop-value-'.$element['id'] : 'sliderelement-option-margintop-value-'.$this->htmlElementName($_SESSION['form_element_id']);
			$slider_margintop_value = (isset($element['container']['css']['default']['margin-top']) && $element['container']['css']['default']['margin-top']) ? preg_replace("/[^0-9\.]/", '', $element['container']['css']['default']['margin-top']) : 0; // default setting: top alignment, margin-top = 0 (inserting the label width in the json data is based on the presence of a width value in the input)
			?>
			<script>
			$('#<?php echo $slider_margintop_id;?>').slider(
			{
				range: 'min',
				min: <?php echo $this->slider_margintop_min; ?>,
				max: <?php echo $this->slider_margintop_max; ?>,
				value: <?php echo $slider_margintop_value; ?>,
				step: 1,
				change: function(event, ui)
				{
					// the change event is called when the input ".slider-element-margintop-value" is updated or when label is aligned top (updates the input value with the change event, then changes the css margin-top property)
					$(this).closest('.element-container').find('.cfg-element-set').css({'margin-top':ui.value});
					//$(this).closest('.element-container').find('.cfg-option-content').css({'margin-top':ui.value});
					$('#<?php echo $slider_margintop_value_id;?>').val(ui.value);
				},
				slide: function(event, ui)
				{
					$(this).closest('.element-container').find('.cfg-element-set').css({'margin-top':ui.value});
					$('#<?php echo $slider_margintop_value_id;?>').val(ui.value);
				}
			});
				
			</script>
					
			<div style="margin-bottom:6px;">Top margin: <input type="text" id="<?php echo $slider_margintop_value_id;?>" class="sliderelement-option-margintop-value slider-value inputborder-elementeditor" value="<?php echo $slider_margintop_value;?>" />px</div>
					
			<div id="<?php echo $slider_margintop_id;?>"></div>
			
		</div><!--optioneditor-fontstyleeditor-c-->
		</div><!--cfg-elementeditor-width-->

		<?php
		} // if type radio or checkbox
		?>
		

		<?php
	}
	
	function addEditFormField($element)
	{
			$type = $element['type'];
			?>
			
			<?php
			
			/****************************************************************************
			 * REQUIRED FIELD EMAIL
			 */
			if($type == 'email')
			{
				?>
				<div class="optioneditor-text">Required field</div>
				
				<div class="textbox-container">
				<input type="checkbox" checked="checked" disabled /> A valid email address will be required
				</div>
				<?php
			}
			
			
			
			/****************************************************************************
			 * REQUIRED FIELD CHECKBOX
			 */
			$required_field_type = array('text', 'textarea', 'select', 'selectmultiple', 'upload', 'radio', 'checkbox', 'date');
			
			if(in_array($type, $required_field_type))
			{	
				$edit_required_check = (isset($element['required']) && $element['required']) ? ' checked="checked" ' : '';

				?>
				<div class="optioneditor-text">Required field</div>
				<div class="textbox-container">
				<input type="checkbox" class="editrequired" <?php echo $edit_required_check;?> /> This field can't be left empty
				</div>
				<?php
			}
			
			
			/****************************************************************************
			 * LABEL TITLE VALUE
			 */
			if($type != 'paragraph' && $type != 'image')
			{
				
				$edit_element_label = (isset($element['label']['value']) && $element['label']['value']) ? $element['label']['value'] : $this->{'default_label_'.$type};
				
				if($type == 'title'){
					$edit_element_label = (isset($element['title']['value']) && $element['title']['value']) ? $element['title']['value'] : $this->{'default_label_'.$type};
				}
				
				if($type == 'submit'){
					$edit_element_label = (isset($element['input']['value']) && $element['input']['value']) ? $element['input']['value'] : $this->{'default_label_'.$type};
				}

				?>
				<div class="optioneditor-text">Element title</div>
				
				<div class="textbox-container">
				<input type="text" class="input-elementeditor inputborder-elementeditor editlabel" value="<?php echo htmlentities($edit_element_label, ENT_QUOTES, 'UTF-8');?>"    />
				</div>
				<?php
			}
			
			
			
			/****************************************************************************
			 * IMAGE
			 */
			if($type == 'image')
			{
				
				$edit_img_url = (isset($element['url']) && $element['url']) ? $element['url'] : '';
				
				
				$element_name 	= (isset($element['id']) && $element['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
				$uploadsuccesscontainer_style			= (isset($element['id']) && $element['id'] && isset($element['filename']) && $element['filename']) ? '' : ' display:none; ';
				$uploadsuccesscontainer_filename	= (isset($element['id']) && $element['id'] && isset($element['filename']) && $element['filename']) ? $element['filename'] : '';

				?>
				<div class="optioneditor-text">Image URL</div>
				
				<div class="textbox-container">
				<input type="text" class="image_url inputimageurl-elementeditor inputborder-elementeditor" value="<?php echo $edit_img_url;?>" /><input type="submit" value="Add image" class="addimagefromurl" />
				</div>
				
				<div class="optioneditor-text">Upload image</div>
				
				<div class="optioneditor-fontstyleeditor-c">
				
						<?php
						require_once('../sourcecontainer/'.$this->dir_form_inc.'/class/class.contactform.php');
						$contactformdemo_obj = new contactForm($cfg = array());
						if($contactformdemo_obj->demo == 1)
						{
							echo '<p>You are currently using a demo version of Contact Form Generator.</p><p>The upload function is only available in the full version.</p>';
						} else{
								?>
								<?php
								if(!is_writable('../'.$this->dir_upload))
								{
								?>
								<div style="margin:0 0 4px 0"><span style="color:#ff0033">Installation warning</span> : set the permission to '755' on the 'editor/<?php echo substr($this->dir_upload, 0, -1);?>' directory on your server to make the image upload work (set the permission to '777' if it does not work otherwise).</div>
								<?php
								}
								?>
								<div class="" id="fsUploadProgress-<?php echo $element_name;?>">
										
										
										<div class="uploadsuccess-container" style=" <?php echo $uploadsuccesscontainer_style;?>">
										
											<span class="uploadimagehtmlfilename"><?php echo $uploadsuccesscontainer_filename;?></span>
											<input type="hidden" class="uploadimagefilename" value="<?php echo $uploadsuccesscontainer_filename;?>" /><!-- used to delete the image -->
											<span class="delimagefromupload">Delete</span>
											<img src="img/loading.gif" class="uploadimageloading" style="display:none" />
											
										</div>
										
										
								</div>
								<!--<div id="divStatus"></div>--><!-- queueComplete in handlers.js 0 Files Uploaded-->
								<div>
									<span id="spanButtonPlaceHolder-<?php echo $element_name;?>"></span>
									<input id="btnCancel-<?php echo $element_name;?>" type="button" value="Cancel Upload" onclick="swfu.cancelQueue();" disabled="disabled" style="display:none;margin-left: 2px; font-size: 8pt; height: 29px;" />
								</div>
								<script type="text/javascript">
										var swfu;
								
										$(function(){
											var settings = {
												flash_url : "js/swfupload/swfupload.swf",
												upload_url: "inc/uploadimage.php",
												post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
												file_size_limit : "100 MB",
												file_types : "<?php echo $this->swfupload_authorized_ext;?>",
												file_types_description : "All Files",
												file_upload_limit : 0,
												file_queue_limit : 0,
												custom_settings : {
													progressTarget : "fsUploadProgress-<?php echo $element_name;?>",
													cancelButtonId : "btnCancel-<?php echo $element_name;?>"
												},
												debug: false,
								
												// Button settings
												button_image_url: "img/upload-button.png",
												button_width: "130",
												button_height: "31",
												button_placeholder_id: "spanButtonPlaceHolder-<?php echo $element_name;?>",
												
												button_action:SWFUpload.BUTTON_ACTION.SELECT_FILE, // when the Flash button is clicked the file dialog will only allow a single file to be selected
												button_cursor: SWFUpload.CURSOR.HAND,
								
												// The event handler functions are defined in handlers.js
												file_queued_handler : fileQueued,
												file_queue_error_handler : fileQueueError,
												file_dialog_complete_handler : fileDialogComplete,
												upload_start_handler : uploadStart,
												upload_progress_handler : uploadProgress,
												upload_error_handler : uploadError,
												upload_success_handler : uploadSuccess, // uploadSuccess in handlers.js
												upload_complete_handler : uploadComplete // FileProgress.prototype.setComplete in fileprogress.js
											};
											/* queue_complete_handler : queueComplete	// queueComplete in handlers.js, Queue plugin event */
											
											swfu = new SWFUpload(settings);
										 });
									</script>
							<?php
							}
							?>
				
				</div><!-- end optioneditor-fontstyleeditor-c -->

				
				
				<?php
			}
			
			
			/****************************************************************************
			 * OPTIONS RADIO CHECKBOX SELECT
			 */
			if( $type == 'radio' || $type == 'checkbox' || $type == 'select' || $type == 'selectmultiple' )
			{
				// $html must be placed between div to get editoption-container index number equals to 0, 1, 2 etc. 
				?>
				<div class="optioneditor-text">List of choices</div>
				<div class="textbox-container">
				<div class="sortoption-container">
					<?php
					if((isset($element['option']['set']) && $element['option']['set']))
					{
						foreach($element['option']['set'] as $edit_element_option_set)
						{
							
							echo $this->divEditOptionContainer($type, $edit_element_option_set['value'], $edit_element_option_set['checked']);
						}
						
					}
					else{
						for($i=1; $i<=3; $i++)
						{
							
							echo $this->divEditOptionContainer($type, $this->default_option_value, '');
						}
					}
					?>
				</div>
				</div>
				<?php
			}
			
			
			/****************************************************************************
			 * FIELD SIZE / WIDTH
			 */
			switch($type)
			{
				case 'submit':
				case 'text':
				case 'email':
				case 'textarea':
				case 'date':
				
				if($type == 'text') $slider_width_value = (isset($element['id']) && $element['id']) ? preg_replace("/[^0-9\.]/", '', $element['input']['css']['default']['width']) : $this->default_width_input;
				if($type == 'email') $slider_width_value = (isset($element['id']) && $element['id']) ? preg_replace("/[^0-9\.]/", '',$element['input']['css']['default']['width']) : $this->default_width_email;
				if($type == 'date') $slider_width_value = (isset($element['id']) && $element['id']) ? preg_replace("/[^0-9\.]/", '',$element['input']['css']['default']['width']) : $this->default_width_date;
				if($type == 'textarea') $slider_width_value = (isset($element['id']) && $element['id']) ? preg_replace("/[^0-9\.]/", '',$element['input']['css']['default']['width']) : $this->default_width_textarea;
				if($type == 'submit') $slider_width_value = (isset($element['id']) && $element['id']) ? preg_replace("/[^0-9\.]/", '',$element['input']['css']['default']['width']) : $this->default_width_submit;
				
				$this->addEditWidth($element, array('slider_value'=>$slider_width_value, 'target_type'=>$type));
				
				
			}
			
			/****************************************************************************
			 * DATE
			 */
			if($type == 'date')
			{
				$edit_dateformat = (isset($element['format']) && $element['format']) ? $element['format'] : $this->datepicker_formats[$this->datepicker_default_format];
				$edit_datelanguage = (isset($element['regional']) && $element['regional']) ? $element['regional'] : $this->datepicker_language[$this->datepicker_default_language];
				?>
				<div class="optioneditor-text">Date format</div>
				<div class="optioneditor-fontstyleeditor-c">
				<select class="datepickerformat">
				<?php
				foreach($this->datepicker_formats as $datepicker_option=>$datepicker_value)
				{
					$selected_datepicker = ($datepicker_value == $edit_dateformat)?'selected':'';
					echo '<option value="'.$datepicker_value.'" '.$selected_datepicker.' >'.$datepicker_option.'</option>';
				}
				?>
				</select>
				</div>
				
				<div class="optioneditor-text">Language</div>
				<div class="optioneditor-fontstyleeditor-c">
				<select class="datepickerlanguage">
				<?php
				foreach($this->datepicker_language as $datepickerlanguage_option=>$datepickerlanguage_value)
				{
					$selected_datepickerlanguage = ($datepickerlanguage_value == $edit_datelanguage)?'selected':'';
					echo '<option value="'.$datepickerlanguage_value.'" '.$selected_datepickerlanguage.' >'.$datepickerlanguage_option.'</option>';
				}
				?>
				</select>
				</div>
				
			<?php
			}
		
			/****************************************************************************
			 * TIME
			 */
			if($type == 'time')
			{
				$html_id = 'timeformat-'.$_SESSION['form_element_id'];
				
				
				$edit_time12_check = (isset($element['timeformat']) && $element['timeformat'] == 12) ? ' checked="checked" ' : '';
				$edit_time24_check = (isset($element['timeformat']) && $element['timeformat'] == 24) ? ' checked="checked" ' : '';
				
				// default setting
				if(!$edit_time12_check && !$edit_time24_check)
				{
					$edit_time24_check = ' checked="checked" '; 
					$edit_time12_check = ''; 
				}
				?>
				
				<div class="optioneditor-text">Time format</div>
				<div class="textbox-container">
					<div class="optioneditor-fontstyleeditor-c">
						<input type="radio" name="<?php echo $html_id;?>" id="<?php echo $html_id;?>-12hourclock" class="timeformat 12hourclock" value="12" <?php echo $edit_time12_check;?> /> <label for="<?php echo $html_id;?>-12hourclock">12-hour clock</label>
						<br />
						<input type="radio" name="<?php echo $html_id;?>" id="<?php echo $html_id;?>-24hourclock" class="timeformat 24hourclock" value="24" <?php echo $edit_time24_check;?> /> <label for="<?php echo $html_id;?>-24hourclock">24-hour clock</label>
					</div>
				</div>
				<?php
			}
		
			/****************************************************************************
			 * CAPTCHA
			 */
			if($type == 'captcha')
			{
				$edit_captchaformat = (isset($element['format']) && $element['format']) ? $element['format'] : $this->captcha_default_format;
				$edit_captchalength = (isset($element['length']) && $element['length']) ? $element['length'] : $this->captcha_default_length;
				
				?>
				<div class="optioneditor-text">Captcha format</div>
				
				<div class="optioneditor-fontstyleeditor-c">
				<?php
				$formats = array(
									'letters'=>'Only letters',
									'numbers'=>'Only numbers',
									'lettersandnumbers'=>'Letters and numbers'
									);
				foreach($formats as $key=>$value)
				{
					$checked = ($key==$edit_captchaformat)?' checked ':'';
					?>
					<input type="radio" name="captchaformat" class="captchaformat <?php echo $key;?>" id="captchaformat-<?php echo $key;?>" value="<?php echo $key;?>" <?php echo $checked;?> />
					<label for="captchaformat-<?php echo $key;?>"><?php echo $value;?></label><br />
					<?php
				}
				?>	
				</div>
				
						
				<div class="optioneditor-text">Captcha length</div>
				
				<select id="captcha-length" class="captcha-length">
				<?php
				// i can't be > 8 : Warning: array_rand(): Second argument has to be between 1 and the number of elements in the array // there are 8 elements in $captcha_number
				for($i=3;  $i<=8; $i++)
				{
					$selected = ($i == $edit_captchalength)?'selected':'';
					echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
				}
				?>
				
				</select>
				<?php
			}
		
			/**
			 * TEXTAREA ROWS
			 */
		
			if($type == 'textarea')
			{
				$slider_rows_value = (isset($element['rows']) && $element['rows']) ? $element['rows'] : $this->default_rows_textarea;
				
				$slider_rows_id = (isset($element['id']) && $element['id']) ? 'sliderelement-rows-'.$element['id'] : 'sliderelement-rows-'.$this->htmlElementName($_SESSION['form_element_id']);
				$slider_rows_target_id = (isset($element['id']) && $element['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
				$slider_rows_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-rows-value-'.$element['id'] : 'sliderelement-rows-value-'.$this->htmlElementName($_SESSION['form_element_id']);
				?>
				<div class="optioneditor-fontstyleeditor-c">
				
				<script>
				$('#<?php echo $slider_rows_id;?>').slider(
				{
					range: 'min',
					min: <?php echo $this->slider_rows_min;?>,
					max: <?php echo $this->slider_rows_max;?>,
					value: <?php echo $slider_rows_value;?>,
					step: 1,
					change: function(event, ui){
						// the change event is called when the value is updated from the input text ".sliderelement-rows-value"
						$('#<?php echo $slider_rows_value_id;?>').val(ui.value);
						$('#<?php echo $slider_rows_target_id;?>').attr('rows', ui.value);
						default_rows_textarea = ui.value;
						
						var element_container = $('#<?php echo $slider_rows_target_id;?>').closest('.element-container');
						adjustElementHeightToLeftContent(element_container);
						// ^-- only in the change event because
						// the adjustment becomes buggy in Opera if adjustElementHeightToLeftContent is also added on the slide event
					},
					slide: function(event, ui){
						$('#<?php echo $slider_rows_value_id;?>').val(ui.value);
						$('#<?php echo $slider_rows_target_id;?>').attr('rows', ui.value);
						default_rows_textarea = ui.value;
					}
				});
				
				</script>
				
				<div style="margin-bottom:6px;">Rows: <input type="text" id="<?php echo $slider_rows_value_id;?>" class="sliderelement-rows-value slider-value" value="<?php echo $slider_rows_value;?>" /></div>
				<div id="<?php echo $slider_rows_id;?>"></div>
	
				</div>
				<?php
			}
			
				
			
			/**
			 * FONT FAMILY / FONT SIZE / FONT WEIGHT / COLOR
			 */
			
			if($type == 'title' || $type == 'submit')
			{
				if($type == 'title')
				{
					$class_newfontfamily = 'newfontfamily-title';
					$class_newfontweight = 'newfontweight-title';
					$slider_update_var_name = 'default_fontsize_title';
					$preselect_fontfamily = (isset($element['title']['css']['default']['font-family']) && $element['title']['css']['default']['font-family']) ? $element['title']['css']['default']['font-family'] : $this->default_fontfamily_title;
					
					$preselect_fontweight = (isset($element['title']['css']['default']['font-weight']) && $element['title']['css']['default']['font-weight']) ? $element['title']['css']['default']['font-weight'] : $this->default_fontweight_title;
					$preselect_fontweight = (isset($element['title']['css']['default']['font-style']) && $element['title']['css']['default']['font-style']) ? $element['title']['css']['default']['font-style'] : $preselect_fontweight;
					
					$slider_fontsize_value = 	(isset($element['title']['css']['default']['font-size']) && $element['title']['css']['default']['font-size']) ? preg_replace("/[^0-9\.]/", '', $element['title']['css']['default']['font-size']) : $slider_update_var_name;
					// ^-- preg_replace to keep the numeric part of the string => "font-size":"2.2em"
				}
				if($type == 'submit')
				{
					$class_newfontfamily = 'newfontfamily-submit';
					$class_newfontweight = 'newfontweight-submit';
					$slider_update_var_name = 'default_fontsize_submit';
					$preselect_fontfamily = (isset($element['input']['css']['default']['font-family']) && $element['input']['css']['default']['font-family']) ? $element['input']['css']['default']['font-family'] : $this->default_fontfamily_submit;
					
					$preselect_fontweight = (isset($element['input']['css']['default']['font-weight']) && $element['input']['css']['default']['font-weight']) ? $element['input']['css']['default']['font-weight'] : $this->default_fontweight_submit;
					$preselect_fontweight = (isset($element['input']['css']['default']['font-style']) && $element['input']['css']['default']['font-style']) ? $element['input']['css']['default']['font-style'] : $preselect_fontweight;
					
					$slider_fontsize_value = 	(isset($element['input']['css']['default']['font-size']) && $element['input']['css']['default']['font-size']) ? preg_replace("/[^0-9\.]/", '',$element['input']['css']['default']['font-size']) : $slider_update_var_name;
				}
				?>
				

				<div class="optioneditor-text">Font and color</div>
				<?php
				$this->addEditFontFamily(array('class_select'=>$class_newfontfamily, 'preselect_value'=>$preselect_fontfamily));
				?>
				
				<?php
				$this->addEditFontSize($element, array('slider_update_var_name'=>$slider_update_var_name, 'slider_value'=>$slider_fontsize_value));
				?>
				
				<?php
				$this->addEditFontWeight(array('class_select'=>$class_newfontweight, 'preselect_value'=>$preselect_fontweight));
				?>
				
			
	
				<div class="optioneditor-fontstyleeditor-c">
						<div class="optioneditor-fontstyleeditor-l">
						Font color:
						</div>
						
						<div class="optioneditor-fontstyleeditor-r">
						<?php 
						$configcolorpicker['colorpicker_csspropertyname'] = 'color';
						$configcolorpicker['colorpickervalue_id'] = 'element_color_'.$_SESSION['form_element_id'];
						$configcolorpicker['colorpicker_id'] = 'element_colorpicker_'.$_SESSION['form_element_id'];
						if($type == 'title')
						{
							$configcolorpicker['colorpicker_defaultcolor'] =  (isset($element['title']['css']['default']['color']) && $element['title']['css']['default']['color']) ? $element['title']['css']['default']['color'] : $this->default_color_title; 
						}
						if($type == 'submit')
						{
							$configcolorpicker['colorpicker_defaultcolor'] = (isset($element['input']['css']['default']['color']) && $element['input']['css']['default']['color']) ? $element['input']['css']['default']['color'] : $this->default_color_submit;
							$configcolorpicker_submit_color = $configcolorpicker['colorpicker_defaultcolor']; // only used to display or hide hover color block
							$configcolorpicker['export_css'] = 'css_default_value';
						}
						echo $this->setUpColorPicker($configcolorpicker);
						?>
						
						<?php
						if($type == 'submit')
						{
							if(isset($element['input']['css']['hover']['color']) && $element['input']['css']['hover']['color'] 
							   && $element['input']['css']['hover']['color'] != $configcolorpicker_submit_color)
							{
								$css_submit_hover_color_container = '';
								$css_toggle_hover_color_container = 'display:none;';
							} else{
								$css_submit_hover_color_container = 'display:none;';
								$css_toggle_hover_color_container = '';
							}
						?>
							<input type="hidden" value="color" class="export_css_property" /><!-- must be placed in the div -->
							<div class="changecoloronhover-c" style=" <?php echo $css_toggle_hover_color_container;?>">
							<span class="changecoloronhover">Change color on Hover</span>
							</div>
						<?php
						}
						?>
						
						</div>
						
						<div class="clear"></div>
						
							<?php
							if($type == 'submit')
							{
							// hoveractive used to know if the hovereditor is displayed for a specific css property, if hovereditor has class hoveractive the hover value is inserted in the json
							?>
							<div class="hover-editor <?php echo ((isset($element['input']['css']['hover']['color']) && $element['input']['css']['hover']['color'])?'hoveractive':'');?>" style=" <?php echo $css_submit_hover_color_container;?>">
								<div class="optioneditor-fontstyleeditor-l">
								Hover color:<br />
								</div>
								
								<div class="optioneditor-fontstyleeditor-r">
								<?php 
								$configcolorpicker_submit_color_hover['colorpicker_csspropertyname'] = '';
								$configcolorpicker_submit_color_hover['colorpickervalue_id'] = 'element_hovercolor_'.$_SESSION['form_element_id'];
								$configcolorpicker_submit_color_hover['colorpicker_id'] = 'element_hovercolorpicker_'.$_SESSION['form_element_id'];
								// if no hover color, we apply the inherited submit color
								$configcolorpicker_submit_color_hover['colorpicker_defaultcolor'] = (isset($element['input']['css']['hover']['color']) && $element['input']['css']['hover']['color']) ? $element['input']['css']['hover']['color'] : $configcolorpicker_submit_color;
								$configcolorpicker_submit_color_hover['export_css'] = 'css_hover_value';
								echo $this->setUpColorPicker($configcolorpicker_submit_color_hover);
								?>
								<input type="hidden" value="color" class="export_css_property_hover" /><!-- must be placed in the div -->
								<div class="cancelhovercolor-c"><span class="cancelhovercolor">Cancel Hover color</span></div>
								</div>
								<div class="clear"></div>
							</div> <!-- end hover-editor -->
							<?php
							}
							?>
						
				</div>
			<?php
			}
			
			/**
			 * BORDER COLOR / BACKGROUND COLOR: SUBMIT
			 */
			if($type == 'submit')
			{
				?>
				
				<div class="optioneditor-fontstyleeditor-c">
						<div class="optioneditor-fontstyleeditor-l">
						Background:
						</div>
						
						<div class="optioneditor-fontstyleeditor-r">
							<?php
							$configcolorpicker_bg_submit['colorpicker_csspropertyname'] = 'background-color';
							$configcolorpicker_bg_submit['colorpickervalue_id'] = 'element_bgcolor_'.$_SESSION['form_element_id'];
							$configcolorpicker_bg_submit['colorpicker_id'] = 'element_bgcolorpicker_'.$_SESSION['form_element_id'];
							$configcolorpicker_bg_submit['colorpicker_defaultcolor'] = (isset($element['input']['css']['default']['background-color']) && $element['input']['css']['default']['background-color']) ? $element['input']['css']['default']['background-color'] : $this->default_backgroundcolor_submit;
							$configcolorpicker_bg_submit['export_css'] = 'css_default_value';
							echo $this->setUpColorPicker($configcolorpicker_bg_submit);
							?>
							<?php
							if(isset($element['input']['css']['hover']['background-color']) && $element['input']['css']['hover']['background-color'] 
							   && $element['input']['css']['hover']['background-color'] != $configcolorpicker_bg_submit['colorpicker_defaultcolor'])
							{
								$css_submit_hover_backgroundcolor_container = '';
								$css_toggle_hover_backgroundcolor_container = 'display:none;';
							} else{
								$css_submit_hover_backgroundcolor_container = 'display:none;';
								$css_toggle_hover_backgroundcolor_container = '';
							}
							?>
							<input type="hidden" value="background-color" class="export_css_property" /><!-- must be placed in the div -->
							<div class="changecoloronhover-c" style=" <?php echo $css_toggle_hover_backgroundcolor_container;?>">
							<span class="changecoloronhover">Change color on Hover</span>
							</div>
						</div>
						
						<div class="clear"></div>
						
							<div class="hover-editor <?php echo ((isset($element['input']['css']['hover']['background-color']) && $element['input']['css']['hover']['background-color'])?'hoveractive':'');?>" style=" <?php echo $css_submit_hover_backgroundcolor_container;?>">
								<div class="optioneditor-fontstyleeditor-l">
								Hover color:<br />
								</div>
								
								<div class="optioneditor-fontstyleeditor-r">
								<?php
								$configcolorpicker_bg_submit['colorpicker_csspropertyname'] = '';
								$configcolorpicker_bg_submit['colorpickervalue_id'] = 'element_hoverbgcolor_'.$_SESSION['form_element_id'];
								$configcolorpicker_bg_submit['colorpicker_id'] = 'element_hoverbgcolorpicker_'.$_SESSION['form_element_id'];
								$configcolorpicker_bg_submit['export_css'] = 'css_hover_value';
								// if no hover color, we apply the inherited submit color
								$configcolorpicker_bg_submit['colorpicker_defaultcolor'] = (isset($element['input']['css']['hover']['background-color']) && $element['input']['css']['hover']['background-color']) ? $element['input']['css']['hover']['background-color'] : $configcolorpicker_bg_submit['colorpicker_defaultcolor'];
								echo $this->setUpColorPicker($configcolorpicker_bg_submit);
								?>
								<input type="hidden" value="background-color" class="export_css_property_hover" /><!-- must be placed in the div -->
								<div class="cancelhovercolor-c"><span class="cancelhovercolor">Cancel Hover color</span></div>
								</div>
								
								<div class="clear"></div>
							</div> <!-- end hover-editor -->
				</div>
				
				
				<div class="optioneditor-fontstyleeditor-c">
						<div class="optioneditor-fontstyleeditor-l">
						Border:
						</div>
						
						<div class="optioneditor-fontstyleeditor-r">
							<?php
							$configcolorpicker_border_submit['colorpicker_csspropertyname'] = 'border-color';
							$configcolorpicker_border_submit['colorpickervalue_id'] = 'element_bordercolor_'.$_SESSION['form_element_id'];
							$configcolorpicker_border_submit['colorpicker_id'] = 'element_bordercolorpicker_'.$_SESSION['form_element_id'];
							$configcolorpicker_border_submit['colorpicker_defaultcolor'] = (isset($element['input']['css']['default']['border-color']) && $element['input']['css']['default']['border-color']) ? $element['input']['css']['default']['border-color'] : $this->default_bordercolor_submit;
							$configcolorpicker_border_submit['export_css'] = 'css_default_value';
							echo $this->setUpColorPicker($configcolorpicker_border_submit);
							?>
							<?php
							if(isset($element['input']['css']['hover']['border-color']) && $element['input']['css']['hover']['border-color'] 
							   && $element['input']['css']['hover']['border-color'] != $configcolorpicker_border_submit['colorpicker_defaultcolor'])
							{
								$css_submit_hover_bordercolor_container = '';
								$css_toggle_hover_bordercolor_container = 'display:none;';
							} else{
								$css_submit_hover_bordercolor_container = 'display:none;';
								$css_toggle_hover_bordercolor_container = '';
							}
							?>
							<input type="hidden" value="border-color" class="export_css_property" /><!-- must be placed in the div -->
							<div class="changecoloronhover-c" style=" <?php echo $css_toggle_hover_bordercolor_container;?>">
							<span class="changecoloronhover">Change color on Hover</span>
							</div>
						</div>
						
						<div class="clear"></div>
							<div class="hover-editor <?php echo ((isset($element['input']['css']['hover']['border-color']) && $element['input']['css']['hover']['border-color'])?'hoveractive':'');?>" style=" <?php echo $css_submit_hover_bordercolor_container;?>">
								<div class="optioneditor-fontstyleeditor-l">
								Hover color:<br />
								</div>
								
								<div class="optioneditor-fontstyleeditor-r">
								<?php
								$configcolorpicker_border_submit['colorpicker_csspropertyname'] = '';
								$configcolorpicker_border_submit['colorpickervalue_id'] = 'element_hoverbordercolor_'.$_SESSION['form_element_id'];
								$configcolorpicker_border_submit['colorpicker_id'] = 'element_hoverbordercolorpicker_'.$_SESSION['form_element_id'];
								$configcolorpicker_border_submit['export_css'] = 'css_hover_value';
								// if no hover color, we apply the inherited submit color
								$configcolorpicker_border_submit['colorpicker_defaultcolor'] = (isset($element['input']['css']['hover']['border-color']) && $element['input']['css']['hover']['border-color']) ? $element['input']['css']['hover']['border-color'] : $configcolorpicker_border_submit['colorpicker_defaultcolor'];
								echo $this->setUpColorPicker($configcolorpicker_border_submit);
								?>
								<input type="hidden" value="border-color" class="export_css_property_hover" /><!-- must be placed in the div -->
								<div class="cancelhovercolor-c"><span class="cancelhovercolor">Cancel Hover color</span></div>
								</div>
								
								<div class="clear"></div>
							</div> <!-- end hover-editor -->
				</div>
				
				<div class="optioneditor-fontstyleeditor-c">
					<div class="optioneditor-fontstyleeditor-l">
					Left margin:
					</div>
						
					<div class="optioneditor-fontstyleeditor-r">
					<?php
					$slider_marginleft_id = (isset($element['id']) && $element['id']) ? 'sliderelement-marginleft-submit-'.$element['id'] : 'sliderelement-marginleft-submit-'.$this->htmlElementName($_SESSION['form_element_id']);
					$slider_marginleft_target_id = (isset($element['id']) && $element['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
					$slider_marginleft_class = 'slider-marginleft-submit-value'; // not the same slider for element and for paragraph: the json export is based on this class name to catch the width value
					$slider_marginleft_value_id = (isset($element['id']) && $element['id']) ? 'sliderelement-marginleft-submit-value-'.$element['id'] : 'sliderelement-marginleft-submit-value-'.$this->htmlElementName($_SESSION['form_element_id']);
					$slider_marginleft_value = (isset($element['id']) && $element['id']) ? preg_replace("/[^0-9\.]/", '',$element['input']['css']['default']['margin-left']) : $this->default_marginleft_submit;
					?>
				
					<script>
					$('#<?php echo $slider_marginleft_id;?>').slider(
					{
						range: 'min',
						min: <?php echo $this->slider_marginleft_min; ?>,
						max: <?php echo $this->slider_marginleft_max; ?>,
						value: <?php echo $slider_marginleft_value; ?>,
						step: 1,
						change: function( event, ui )
						{
							// the change event is called when the value is updated from the input text ".slider-marginleft-submit-value"
							$('#<?php echo $slider_marginleft_value_id;?>').val(ui.value);
							$('#<?php echo $slider_marginleft_target_id;?>').css({'margin-left':ui.value});
						},
						slide: function( event, ui )
						{
							//
							$('#<?php echo $slider_marginleft_value_id;?>').val(ui.value);
							$('#<?php echo $slider_marginleft_target_id;?>').css({'margin-left':ui.value});
							
						}
					});
				
					</script>
					
					<div style="margin-bottom:6px;"><input type="text" id="<?php echo $slider_marginleft_value_id;?>" class="<?php echo $slider_marginleft_class;?> slider-value inputborder-elementeditor" value="<?php echo $slider_marginleft_value;?>" />px</div>
					
					<div id="<?php echo $slider_marginleft_id;?>"></div>
	
	
					</div>
					
					<div class="clear"></div>
				</div><!-- optioneditor-fontstyleeditor-c -->
			
				
			<?php				
			}
			
			
			
			if($type == 'submit')
			{/*
				?>
				<div class="optioneditor-text">Preformatted buttons</div>
				
				<div class="optioneditor-fontstyleeditor-c">
					<?php
					foreach($this->submit_colors as $key=>$value)
					{
						// For IE and Opera: style="background-color:transparent;	border:none;"
						?>
						<input class="formatsubmit" onclick="javascript:formatSubmit('element-<?php echo $_SESSION['form_element_id'];?>','<?php echo $value['color'];?>', '<?php echo $value['backgroundcolor'];?>', '<?php echo $value['bordercolor'];?>')" type="radio" name="<?php echo $_SESSION['form_element_id'];?>-submitstyle" id="<?php echo $_SESSION['form_element_id'];?>-submitstyle-<?php echo $value['name'];?>" >
						
						<label for="<?php echo $_SESSION['form_element_id'];?>-submitstyle-<?php echo $value['name'];?>"><?php echo $value['name'];?></label>
					<br />
					<?php
					}
					?>
				</div>
				
				<?php
			*/
			}
			?>
			
			<?php
			/****************************************************************************
			 * UPLOAD
			 */
			if( $type == 'upload' )
			{
				$upload_edit_filesizelimit = (isset($element['id']) && $element['id']) ? $element['file_size_limit'] : $this->upload_filesizelimit;
				$upload_edit_filesizeunit = (isset($element['id']) && $element['id']) ? $element['file_size_unit'] : $this->upload_filesizeunit;
				
				?>
				
				
				<div class="upload-editor">
				
				<div class="optioneditor-text">Upload: maximum file size</div>
				
				<div class="optioneditor-fontstyleeditor-c">
					<div>
					<input type="text" class="upload_filesizelimit input-elementeditor inputborder-elementeditor " value="<?php echo $upload_edit_filesizelimit;?>" style="width:30px; text-align:center;" />
					
					<?php
					foreach(array('MB', 'KB') as $value)
					{
						if($value == $upload_edit_filesizeunit)
						{
							$selected_filesizeunit = 'checked';
						} else{
							$selected_filesizeunit = '';
						}
						$html_name_filesizeunit = 'file_size_unit_'.$_SESSION['form_element_id'];
						$html_id_filesizeunit = 'file_size_unit_'.$_SESSION['form_element_id'].'_'.$value;
		
						?>
						<input <?php echo $selected_filesizeunit;?> type="radio" name="<?php echo $html_name_filesizeunit;?>" id="<?php echo $html_id_filesizeunit;?>" class="upload_filesizeunit" value="<?php echo $value;?>" />
						<label for="<?php echo $html_id_filesizeunit;?>"><?php echo $value;?></label>
						<?php
					}
					?>
					
					<p class="cfg-element-editor-hint">
					The maximum authorized file size for uploads on this server is <strong><?php echo str_ireplace('M', 'MB', ini_get('upload_max_filesize'));?></strong>
					</p>
					<p class="cfg-element-editor-hint">
					Remember the notification message may not arrive in your inbox if the uploaded file size exceeds the allowable attachment size limit of your email service provider.</p>
					</div>
					
				</div><!-- end optioneditor-fontstyleeditor-c -->
				
				<div class="optioneditor-text">Upload: authorized file extensions</div>
				<div class="optioneditor-fontstyleeditor-c">
					
					<?php
					$html_name_radio_upload = 'radio_upload_'.$_SESSION['form_element_id'];
					$upload_edit_filetypes = (isset($element['file_types']) && $element['file_types']) ? $element['file_types'] : '*.*';
					
					if($upload_edit_filetypes == '*.*')
					{
						$allext_checked = ' checked="checked" ';
						$allext_labelselected = ' label-selected-element-editor ';
						
						$specifyext_checked = '';
						$specifyext_display = ' display:none ';
						$specifyext_labelselected = '';
						
						$upload_edit_filetypes = ''; // else *.* is shown in the input if load json with *.* and then click on "specify"
					} else{
						$allext_checked = '';
						$allext_labelselected = '';
						
						$specifyext_checked = ' checked="checked" ';
						$specifyext_display = '';
						$specifyext_labelselected = ' label-selected-element-editor ';
					}
					?>
					<div>
					<input type="radio" class="radio_upload_filetype_all radio_upload_filetype" <?php echo $allext_checked;?> name="<?php echo $html_name_radio_upload?>" id="<?php echo $html_name_radio_upload?>_1" />
					<label for="<?php echo $html_name_radio_upload?>_1" class="<?php echo $allext_labelselected;?> label-select-element-editor">All file extensions are authorized</label>
					</div>
					
					
					
					<div class="radio-upload-container">
					
						<input type="radio" class="radio_upload_filetype_custom radio_upload_filetype " <?php echo $specifyext_checked;?> name="<?php echo $html_name_radio_upload?>" id="<?php echo $html_name_radio_upload?>_3"/>
						<label for="<?php echo $html_name_radio_upload?>_3" class="<?php echo $specifyext_labelselected;?> label-select-element-editor">Specify authorized extensions</label>
						
						<div class="radio-upload-slide" style=" <?php echo $specifyext_display?>">
						
							<input type="text" class="upload_filetype_custom  inputborder-elementeditor inputoption-elementeditor " value="<?php echo $upload_edit_filetypes;?>" style="width:150px; margin-left:26px;" /> 
							
							<p  class="cfg-element-editor-hint">Separate extensions with commas (no dots)
							
							<br />Example: jpg,doc,txt</p>
							
						</div><!-- end radio-upload-slide -->
						
					</div><!-- end radio-upload-container -->
					
					
					
				</div><!-- end optioneditor-fontstyleeditor-c -->
				
				<div class="optioneditor-text">How do you want to receive the file?</div>
				<div class="optioneditor-fontstyleeditor-c">
					
					<?php
					$html_prefix_upload_deletefile = 'upload_deletefile_'.$_SESSION['form_element_id'];
					
					$selected_upload_receive_method_id =  (isset($element['upload_deletefile']) && $element['upload_deletefile']) ? $element['upload_deletefile'] : 1;
					
					$upload_receive_method[1]['id'] = 1;
					$upload_receive_method[1]['title'] = 'File Attachment + Download Link';
					$upload_receive_method[1]['description'] = 'The file will be attached in the admin notification message.<br />The file stays on the server after the user submits the form.';
					
					$upload_receive_method[2]['id'] = 2;
					$upload_receive_method[2]['title'] = 'File Attachment Only';
					$upload_receive_method[2]['description'] = 'The file will be attached in the admin notification message.<br />The file will be deleted from the server after the user submits the form.';
					
					$upload_receive_method[3]['id'] = 3;
					$upload_receive_method[3]['title'] = 'Download Link Only';
					$upload_receive_method[3]['description'] = 'No file attached in the admin notification message but a download link instead.<br />Recommended if you think the uploaded file size will exceed the allowable attachment size limit of your email service provider.<br />The file stays on the server after the user submits the form.';
					
					foreach($upload_receive_method as $upload_receive_value)
					{
						if($upload_receive_value['id'] == $selected_upload_receive_method_id)
						{
							$uploadreceive_checked = ' checked="checked" ';
							$uploadreceive_labelselected = ' label-selected-element-editor ';
							$uploadreceive_hintdisplay = '';
							
						} else{
							$uploadreceive_checked = '';
							$uploadreceive_labelselected = '';
							$uploadreceive_hintdisplay = ' display:none; ';
						}
						?>
						<div>
							
							<input type="radio" value="<?php echo $upload_receive_value['id'];?>" class="upload_deletefile" <?php echo $uploadreceive_checked;?> name="<?php echo $html_prefix_upload_deletefile;?>" id="<?php echo $html_prefix_upload_deletefile;?>_<?php echo $upload_receive_value['id'];?>" />
							
							<label for="<?php echo $html_prefix_upload_deletefile;?>_<?php echo $upload_receive_value['id'];?>" class="<?php echo $uploadreceive_labelselected;?> label-select-element-editor"><?php echo $upload_receive_value['title'];?></label>
							
							<div class="cfg-element-editor-hint" style=" <?php echo $uploadreceive_hintdisplay;?>"><?php echo $upload_receive_value['description'];?></div>
							
						</div>
						
						<?php
					}
					
					
					
					?>
				</div><!-- end optioneditor-fontstyleeditor-c -->
				
				</div><!-- end uploadeditor -->
				<?php
			}
			?>
			
			
			<?php
				
	}

	function insertParagraph($editor, $element, $default_value, $default_style)
	{
			
			$element_name = (isset($element['paragraph']['id']) && $element['paragraph']['id']) ? $element['paragraph']['id'] : $this->htmlElementName($_SESSION['form_element_id']).$this->paragraph_suffix;
			
			$paragraph_class = $editor ? 'colortarget sliderfontsizetarget' : '';
			
			$paragraph_style = '';
			if($editor)
			{
				$paragraph_style = 'style="'.((isset($element['paragraph']) && $element['paragraph']) ? $this->buildStyle($element['paragraph']) : $default_style).'"';
			}
			
			if(isset($element['id']) && $element['id'])
			{
				$paragraph_value = (isset($element['paragraph']['value']) &&  $element['paragraph']['value'])? $element['paragraph']['value'] : '';
			} else{
				$paragraph_value = $default_value;
			}
			
			$html_form_element = '';
			
			if($editor || (isset($element['paragraph']['value']) &&  $element['paragraph']['value']))
			{ // ^-- the paragraph element should only be displayed if we are in the editor of there is something in the paragraph
			  // this condition prevents displaying empty cfg-paragraph block in the form
				$html_form_element = "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
												."\r\n\t\t".'<div class="cfg-paragraph '.$paragraph_class.'" name="'.$element_name.'" id="'.$element_name.'" '.$paragraph_style.' >'
																."\r\n\t\t".nl2br($paragraph_value)
																."\r\n\t\t".'</div>'
												."\r\n\t\t".'</div>'
												;
			}



			return($html_form_element);
	}


	function addFormField($element, $editor, $contactform_obj = false)
	{
		
		// to prevent style properties such as "font-family:undefined;"
		foreach($element as $key=>$value)
		{
			if($value == 'undefined') unset ($element[$key]);
		}
		
		$type = $element['type'];
		

		$object_types = array('label', 'formelement', 'title', 'paragraph', 'submit');
		
		$style_paragraph = ''; // default value (required for insertParagraph called in addFormField)
		
		if($editor)
		{
			// Assign Color, FontFamily, FontSize, FontWeight
			foreach($object_types as $value)
			{
				${'style_fontfamily_'.$value} = 'font-family:'.$element['default_fontfamily_'.$value].';';
				
				${'style_fontsize_'.$value} = 'font-size:'.$element['default_fontsize_'.$value].'px;';
				
				if($element['default_fontweight_'.$value] == 'bold' || $element['default_fontweight_'.$value] == 'normal')
				{
					${'style_fontweight_'.$value} = 'font-weight:'.$element['default_fontweight_'.$value].';';
				}
				if($element['default_fontweight_'.$value] == 'italic')
				{
					${'style_fontweight_'.$value} = 'font-style:'.$element['default_fontweight_'.$value].';';
				}
		
				${'style_color_'.$value} = 'color:'.$element['default_color_'.$value].';';
			}
		
			// style title
			$style_title = $style_color_title.$style_fontfamily_title.$style_fontsize_title.$style_fontweight_title;
		
			// style paragraph
			$style_width_paragraph = 'width:'.$element['default_width_paragraph'].'px;';
			if(isset($element['id']) && $element['id'])
			{	//Ref: labelfloatparagraphwidth // removes the width of the paragraph (else the paragraph width will make the right content not take the full right side width
				if(!isset($element['paragraph']['value']))
				{	//Ref: labelfloatparagraphwidth
					$style_width_paragraph = '';
				}
			}
			$style_paragraph = $style_color_paragraph.$style_fontfamily_paragraph.$style_fontsize_paragraph.$style_fontweight_paragraph.$style_width_paragraph;

			// style submit
			$style_backgroundcolor_submit = $element['default_backgroundcolor_submit']?'background-color:'.$element['default_backgroundcolor_submit'].';':'';
			$style_bordercolor_submit = $element['default_bordercolor_submit']?'border:1px solid '.$element['default_bordercolor_submit'].';':'';
			$style_width_submit = 'width:'.$element['default_width_submit'].'px;';
			$style_submit = $style_color_submit.$style_fontfamily_submit.$style_fontsize_submit.$style_fontweight_submit.$style_backgroundcolor_submit.$style_bordercolor_submit.$style_width_submit;

		
			// style label
			$style_label = $style_color_label.$style_fontfamily_label.$style_fontsize_label.$style_fontweight_label;
		
		
			// style formelement
			$this->style_formelement = $style_color_formelement.$style_fontfamily_formelement.$style_fontsize_formelement.$style_fontweight_formelement;
			
			// style input text
			$style_width_input = 'width:'.$element['default_width_input'].'px;';
			$style_inputtext = $this->style_formelement.$style_width_input;

			// style date
			$style_width_date = 'width:'.$element['default_width_date'].'px;';
			$style_date = $this->style_formelement.$style_width_date;
		
			// style email
			$style_width_email = 'width:'.$element['default_width_email'].'px;';
			$style_email = $this->style_formelement.$style_width_email;

			// style textarea
			$style_width_textarea = 'width:'.$element['default_width_textarea'].'px;';
			$style_textarea = $this->style_formelement.$style_width_textarea;

			// style captcha
			$style_captcha = isset($style_captcha)?$style_captcha:'';
			$style_captcha = $this->style_formelement.$style_captcha;

			// style time
			$style_time = isset($style_time)?$style_time:'';
			$style_time = $this->style_formelement.$style_time;


			// style inputformat
			$style_bordercolor_inputformat = 'border-style:solid; border-color:'.$element['default_bordercolor_inputformat'].';';
			$style_borderradius_inputformat = '-moz-border-radius:'.$element['default_borderradius_inputformat'].'px;'
															.'-webkit-border-radius:'.$element['default_borderradius_inputformat'].'px;'
															.'border-radius:'.$element['default_borderradius_inputformat'].'px;'
															;

			$style_borderwidth_inputformat = 'border-width:'.$element['default_borderwidth_inputformat'].'px;';
			$style_padding_inputformat = 'padding:'.$element['default_padding_inputformat'].'px;';
			$this->style_inputformat = $style_bordercolor_inputformat.$style_borderradius_inputformat.$style_borderwidth_inputformat.$style_padding_inputformat;


			// maj default values for preselection
			$this->default_fontfamily_title = $element['default_fontfamily_title'];
			$this->default_fontfamily_paragraph = $element['default_fontfamily_paragraph'];
			$this->default_fontfamily_submit = $element['default_fontfamily_submit'];
			
			$this->default_fontweight_title = $element['default_fontweight_title'];
			$this->default_fontweight_paragraph = $element['default_fontweight_paragraph'];
			$this->default_fontweight_submit = $element['default_fontweight_submit'];
			
			$this->default_color_title = $element['default_color_title'];
			$this->default_color_paragraph = $element['default_color_paragraph'];
			$this->default_color_submit = $element['default_color_submit'];
			$this->default_backgroundcolor_submit = $element['default_backgroundcolor_submit'];
			$this->default_bordercolor_submit = $element['default_bordercolor_submit'];
			
			$this->default_width_date = $element['default_width_date'];
			$this->default_width_email = $element['default_width_email'];
			$this->default_width_input = $element['default_width_input'];
			$this->default_width_paragraph = $element['default_width_paragraph'];
			$this->default_width_submit = $element['default_width_submit'];
			$this->default_width_textarea = $element['default_width_textarea'];
			
			$this->default_rows_textarea = $element['default_rows_textarea'];
			
		} // end if($editor)
		
				
		$html_form_element = '';
		
		$element['required'] = (isset($element['required']) && $element['required'])?$element['required']:''; // isset test because "required" property won't be in the json_export object if the checkbox required is not checked
			
			
		$element_name 	= (isset($element['id']) && $element['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
			
		
		if($type == 'captcha')
		{
			$element_class 		= $editor ? 'class="cfg-captcha-input formelement colortargetinputformat"' : 'class="cfg-captcha-input"';
			
			$captcha_url_dir 		= $editor ? 'sourcecontainer/' : '';
			$captcha_url_arg 	= (isset($element['id']) && $element['id']) ? '?length='.$element['length'].'&format='.$element['format'] : '';
			$captcha_img_src	= $captcha_url_dir.$this->dir_form_inc.'/inc/captcha.php';
			
			if($editor)
			{
				// append ?length=4&format=letters on the captcha in the editor only
				$captcha_img_src .= $captcha_url_arg;
			}

			$element_style = '';
			$label_config['style'] = '';
			
			
			if($editor)
			{
				$element_style 	= 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $style_captcha.$this->style_inputformat).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
				
			}
			
			if($editor)
			{
				$captcharefresh_path = 'sourcecontainer/'.$this->dir_form_inc.'/';
			} else{
				$captcharefresh_path = (isset($element['id']) && $element['id']) ? $element['form_inc_dir'].'/' : '';
			}
			
			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_captcha;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? '' : '';

		
			
			
			$html_form_element = $this->htmlLabel($label_config);
			
			$html_form_element .=  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .=  "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											  ."\r\n\t\t".'<div class="captcha_container">'
											  				."\r\n\t\t".'<img src="'.$captcha_img_src.'"  class="cfg-captcha-img" name="'.$element_name.'" id="'.$element_name.'" />'
															."\r\n\t\t".'<img src="'.$captcharefresh_path.'img/captcha-refresh.png" class="cfg-captcha-refresh" />'
															."\r\n\t\t".'</div>'
											  ."\r\n\t\t".'<input type="text" name="'.$element_name.'" id="'.$element_name.'" '.$element_class.' '.$element_style.' />'
											  ."\r\n\t\t".'</div>'
											  ."\r\n\t".'</div>'
											  ."\r\n";
		}
		
		
		if($type == 'date')
		{
			
			$element_class 	= $editor ? 'formelement colortargetinputformat' : '';
			
			$element_datepicker_format =  (isset($element['id']) && $element['id']) ? $element['format'] : $this->datepicker_default_format;
			$element_datepicker_language =  (isset($element['id']) && $element['id']) ? $element['regional'] : $this->datepicker_language[$this->datepicker_default_language];
		
			$element_style = '';
			$label_config['style'] = '';
			if($editor)
			{
				$element_style 	= 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $style_date.$this->style_inputformat).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}
			
			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_date;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';

			
			$html_form_element = $this->htmlLabel($label_config);
			
			
			if($editor)
			{
				// datepicker options must come after datepicker regional if we don't want datepicker regional format applying instead of datepicker options 
				//												.'$( "#'.$element_name.'" ).datepicker("option", $.datepicker.regional["'.$element_datepicker_language.'"]);'
//												.'$("#'.$element_name.'").datepicker({firstDay: 1, , changeMonth: true, changeYear: true });'

				$html_form_element .= '<script>'
												.'$("#'.$element_name.'").datepicker($.datepicker.regional["'.$element_datepicker_language.'"]);'
												.'$("#'.$element_name.'").datepicker("option", "dateFormat", "'.$element_datepicker_format.'");'
												.'$("#'.$element_name.'").datepicker("option", "firstDay", "1");'
												.'$("#'.$element_name.'").datepicker("option", "changeMonth", true);'
												.'$("#'.$element_name.'").datepicker("option", "changeYear", true);'
												.'</script>';
			}
			
			$html_form_element .=  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .=  "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											  ."\r\n\t\t".'<input type="text" class="cfg-type-text cfg-type-date cfg-form-value '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" value="" '.$element_style.' />'
											  ."\r\n\t\t".'</div>'
											  ."\r\n\t".'</div>'
											  ."\r\n";
		}
		
		if($type == 'email')
		{
			$element_class 			= $editor ? 'cfg-type-email formelement colortargetinputformat' : '';
			
			$element_style = '';
			$label_config['style'] = '';
			
			if($editor)
			{
				$element_style = 'style="'.((isset($element['id']) && $element['id']) ?$this->buildStyle($element['input']) : $style_email.$this->style_inputformat).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}
			
			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_email;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? 1 : 1;
		
			
			
			
			$html_form_element = $this->htmlLabel($label_config);
			
			
			$html_form_element .= "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .= "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											 ."\r\n\t\t".'<input type="text" class="cfg-type-text cfg-form-value '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" '.$element_style.' />'
											 ."\r\n\t\t".'</div>'
											 ."\r\n\t".'</div>'
											 ."\r\n"
											;
		}
		
		if($type == 'image')
		{
			$img_container = '';
			
			if(isset($element['id']) && $element['id'])
			{
				if(isset($element['url']) && $element['url'])
				{
					$img_container = '<img src="'.$element['url'].'" />';
					
				}
				if(isset($element['filename']) && $element['filename'])
				{
					if($editor)
					{
						$img_upload_path =  'contactform-download/'.$element['form_dir'].'/'.$element['form_inc_dir'].'/';
					} else{
						$img_upload_path = $element['form_inc_dir'].'/';
					}
					
					$img_container = '<img src="'.$img_upload_path.'img/'.$element['filename'].'" />';
				}
				
			}
			
			if($editor || $img_container)
			{ // ^-- when we are in the editor or when there is some image data (url or file) in the json element
				
				if(!$img_container)
				{ // ^-- when we are in the editor and when there is no image data (url or file) in the image json element
					$img_container = $this->html_empty_image_container;
				}
			
				$html_form_element =  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor)
												 ."\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
												 ."\r\n\t\t".$img_container
												 ."\r\n\t\t".'</div>'
												 ."\r\n\t".'</div>'
												 ."\r\n"
												;
			}
		}
			
		
		if($type == 'paragraph')
		{
			$html_form_element =  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			$html_form_element .= $this->insertParagraph($editor, $element, $this->default_label_paragraph, $style_paragraph)
											."\r\n\t".'</div>'
											."\r\n"
											;
		}
		


		if($type == 'select' || $type == 'selectmultiple')
		{
			$element_class = $editor ? 'formelement' : '';
			
			$element_style = '';
			$label_config['style'] = '';
			
			if($editor)
			{
				$element_style = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $this->style_formelement).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}

			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : ($type == 'select'? $this->default_label_select : $this->default_label_selectmultiple);
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';
			
			
			$html_form_element = $this->htmlLabel($label_config);
			
			$multiple = '';
			$html_attr_multiple = '';
			if($type == 'selectmultiple')
			{
				$multiple = 'multiple'; // => <select multiple="multiple" class="cfg-type-selectmultiple
				$html_attr_multiple = ' multiple="multiple"';
			}
			
			$html_form_element .=  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .= "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											  ."\r\n\t\t".'<select'.$html_attr_multiple.' class="cfg-type-select'.$multiple.' cfg-form-value '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" '.$element_style.'>';
			
		
			if(isset($element['id']) && $element['id'])
			{
				foreach($element['option']['set'] as $option_config)
				{
					if(isset($option_config['checked']) && $option_config['checked'])
					{
						$option_selected = 'selected="selected"';
					} else{
						$option_selected = '';
					}
					$html_form_element .= "\r\n\t\t".'<option value="'.$option_config['value'].'" '.$option_selected.'>'.$option_config['value'].'</option>';
				}
			}
			else{
				for($i=1; $i<=3; $i++)
				{
					$html_form_element .= "\r\n\t\t".'<option value="'.$this->default_option_value.'">'.$this->default_option_value.'</option>';
				}
			}

			
			$html_form_element .= "\r\n\t\t".'</select>'
											."\r\n\t\t".'</div>'
											."\r\n\t".'</div>'
											."\r\n";
			
		}
					
					
		if($type == 'submit')
		{
			$element_class 	= $editor ? 'colortarget sliderfontsizetarget' : '';
			$element_label 	= (isset($element['id']) && $element['id']) ? $element['input']['value'] : $this->default_label_submit;
			
			$element_style 	= '';
			
			if($editor)
			{
				$element_style 	= 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $style_submit).'"';
			}


			$html_form_element =  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor)
											 ."\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											 ."\r\n\t\t".'<input type="submit" class="cfg-submit '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" value="'.htmlentities($element_label, ENT_QUOTES, 'UTF-8').'"  '.$element_style.' />'
											 ."\r\n\t\t".'</div>'
											 ."\r\n\t".'</div>'
											 ."\r\n";
			/**
			 * Building the jQuery hover effect on the submit button
			 */
			$build_hover_css = array('background-color', 'border-color', 'color');
			$js_hover_mouseover_css_object = '';
			$js_hover_mouseout_css_object = '';
			
			if(isset($element['input']['css']['hover']) && $element['input']['css']['hover']
			&& isset($element['input']['css']['default']) && $element['input']['css']['default']
			&& $editor
			)
			{
				foreach($build_hover_css as $build_hover_css_propertyname)
				{
					if(isset($element['input']['css']['hover'][$build_hover_css_propertyname]) && $element['input']['css']['hover'][$build_hover_css_propertyname]
					&& isset($element['input']['css']['default'][$build_hover_css_propertyname]) && $element['input']['css']['default'][$build_hover_css_propertyname])
					{ // ^-- it's possible to have border-color in default, but in hover, we need both to build the hover effect
						$js_hover_mouseover_css_object .= '\''.$build_hover_css_propertyname.'\':\''.$element['input']['css']['hover'][$build_hover_css_propertyname].'\',';
						$js_hover_mouseout_css_object .= '\''.$build_hover_css_propertyname.'\':\''.$element['input']['css']['default'][$build_hover_css_propertyname].'\',';
					}
				}
				
				$js_hover_mouseover_css_object = substr($js_hover_mouseover_css_object, 0, -1);
				$js_hover_mouseout_css_object = substr($js_hover_mouseout_css_object, 0, -1);
				
				$html_form_element .= '<script>'
												.'$(function(){'
												.'$(".cfg-submit").hover('
																		 .'function(){'
																			.'$(this).css({'.$js_hover_mouseover_css_object.'});'
																		.'},'
																		.'function(){'
																			.'$(this).css({'.$js_hover_mouseout_css_object.'});'
																		.'}'
																		.');'
												.'});'
												.'</script>';


			} // if isset css default an css hover 
											 

		}			
			
	
		if($type == 'text')
		{
			$element_class 	= $editor ? 'formelement colortargetinputformat' : '';
			
			$element_style = '';
			$label_config['style'] = '';
			
			if($editor)
			{
				$element_style 	= 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $style_inputtext.$this->style_inputformat).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}
			
			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_text;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';
			
			$html_form_element = $this->htmlLabel($label_config);
		
			$html_form_element .= "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .= "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											 ."\r\n\t\t".'<input type="text" class="cfg-type-text cfg-form-value '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" '.$element_style.' />'
											 ."\r\n\t\t".'</div>'
											 ."\r\n\t".'</div>'
											 ."\r\n";
		}			
			
		if($type == 'textarea')
		{
			$element_class 	= $editor ? 'formelement colortargetinputformat' : '';
			
			$element_rows = (isset($element['id']) && $element['id']) ? $element['rows'] : $this->default_rows_textarea;
			
			$element_style = '';
			$label_config['style'] = '';
			
			if($editor)
			{
				$element_style = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $style_textarea.$this->style_inputformat).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}
				
			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_textarea;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';

			
			$html_form_element = $this->htmlLabel($label_config);
			
			$html_form_element .=  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .=  "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											  ."\r\n\t\t".'<textarea class="cfg-type-textarea cfg-form-value '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" rows="'.$element_rows.'" '.$element_style.'></textarea>'
											  ."\r\n\t\t".'</div>'
											  ."\r\n\t".'</div>'
											  ."\r\n"
												;
		}
		
		
		if($type == 'time')
		{
			
			$element_class 	= $editor ? 'formelement' : '';
			
			$element_style = '';
			$label_config['style'] = '';
			if($editor)
			{
				$element_style = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['input']) : $style_time).'"';
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}

			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_time;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';

			
			$html_form_element = $this->htmlLabel($label_config);
			
			$html_form_element .=  "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .= "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor);
			
					
			// hour
			$html_form_element .= "\r\n\t\t".'<select class="cfg-time-hour cfg-type-time cfg-form-value '.$element_class.'" name="'.$element_name.'" id="'.$element_name.'" '.$element_style.'>';
							
			for($i=1; $i<= (isset($element['timeformat']) && $element['timeformat'] == 12 ? 12 : 24); $i++)
			{
				$html_form_element .= "\r\n\t\t".'<option value="'.str_pad($i, 2, '0', STR_PAD_LEFT).'">'.str_pad($i, 2, '0', STR_PAD_LEFT).'</option>';
			}
					
			$html_form_element .= "\r\n\t\t".'</select> : ';
					
					
			// minutes
			$html_form_element .= "\r\n\t\t".'<select class="cfg-time-minute '.$element_class.'" '.$element_style.'>';
					
			$minutes = array('00', '05' , '10', '15', '20', '25', '30', '35', '40', '45', '50', '55');
								
			foreach($minutes as $value)
			{
					$html_form_element .= "\r\n\t\t".'<option value="'.$value.'" >'.$value.'</option>';
			}
										
			$html_form_element .= "\r\n\t\t".'</select>';


			// the ampm must be included when we are in the form builder (we use a check $element['ampm'] to display or hide the ampm select)
			$include_ampm = ''; // default value
			$ampm_class = ''; // default value
			if($editor)
			{
				$ampm_class = 'hidden'; // 24 hour format by default in the editor
				$include_ampm = 1;
				if(isset($element['timeformat']) && $element['timeformat'] == 12){
					$ampm_class = '';
				}
			} else{
				if(isset($element['timeformat']) && $element['timeformat'] == 12){
					$include_ampm = 1;
				}
			}
					
			// AM PM
			if($include_ampm)
			{
				$html_form_element .= "\r\n\t\t".' <select class="cfg-time-ampm '.$ampm_class.' '.$element_class.'" '.$element_style.'>';
								
				$ampm = array('AM', 'PM');
								
				foreach($ampm as $value)
				{
					$html_form_element .= "\r\n\t\t".'<option value="'.$value.'" >'.$value.'</option>';
				}
									
				$html_form_element .= "\r\n\t\t".'</select>';
			}
			
			$html_form_element .= "\r\n\t\t".'</div>'
											 ."\r\n\t".'</div>'
											 ."\r\n";
			
					
		}			
		
		if($type == 'title')
		{
			
			$element_label 	= (isset($element['id']) && $element['id']) ? $element['title']['value'] : $this->default_label_title;
			$element_class 	= $editor ? 'colortarget sliderfontsizetarget' : ''; // test on editor because we only need those classes when loading the form in the form builder (and not when creating it on the fly in saveform)
			
			$element_style = '';
			if($editor)
			{
				$element_style = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['title']) : $style_title).'"';
			}
			
			$html_form_element = "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor)
											."\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
											."\r\n\t\t".'<span class="cfg-title '.$element_class.'" '.$element_style.' name="'.$element_name.'" id="'.$element_name.'">'.$element_label.'</span>'
											."\r\n\t\t".'</div>'
											."\r\n\t".'</div>'
											."\r\n";
		}
			
		if($type == 'upload')
		{

			$element_id 				= (isset($element['id']) && $element['id']) ? $element['id'] : $_SESSION['form_element_id'];
			
			$label_config['style'] = '';
			if($editor)
			{
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}
			
			$label_config['element_id'] 	= $element_name;
			$label_config['value'] 			= (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_upload;
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';

			
			$html_form_element = $this->htmlLabel($label_config);
			
			$html_form_element .= "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);

											
			
			$upload_btn_img = '';
			if($editor)
			{
				$upload_btn_img = '<div class="replace_upload_field" style="height:31px; overflow:hidden;"><img src="sourcecontainer/'.$this->dir_form_inc.'/js/swfupload/img/upload-button.png" /></div>';
			} else{
			
				// if demo mode is on we display the upload button as an image
				$demo_upload_msg = '';
				if(isset($contactform_obj->demo) && $contactform_obj->demo == 1)
				{
					
					$demo_upload_msg = '<div style="background-color:#fef6ca; border:1px solid #f9dd34; -moz-border-radius:4px; -khtml-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; padding:6px; margin:4px 0;">'
												.'<p style="margin:0; font-family: Verdana; font-size:12px">Upload fields only work when using the <a href="'.$contactform_obj->envato_link.'">full version of Contact Form Generator</a></p>'
												.'</div>';	
					
					$upload_btn_img = $demo_upload_msg.'<div class="replace_upload_field" style="height:31px; overflow:hidden;"><img src="'.$this->dir_form_inc.'/js/swfupload/img/upload-button.png" /></div>';
				}
				
			}
			
			
			// spanButtonPlaceHolder-ID used in upload_json['uploads'] in contactformeditor.js
			// height:31px; overflow:hidden used in saveform.php for preg_replace (IE...)
			$html_form_element .= "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor)
															.$upload_btn_img;
			
			if(isset($contactform_obj->demo) && $contactform_obj->demo != 1)
			{
				$js_element_name = str_replace('-', '_', $element_name); // in order to prevent dashes in variables names in upload.js => var swfupload_cfg_element_1;
				
				$html_form_element .= "\r\n\t\t\t".'<input type="hidden" class="cfg-form-value cfg-uploadfilename" name="'.$element_name.'"  />'
												 ."\r\n\t\t\t".'<input type="hidden" class="cfg-uploaddeletefile" value="'.$element['upload_deletefile'].'"  />'
												 ."\r\n\t\t\t".'<span id="'.$this->uploadbutton_prefix.$js_element_name.'" class="btnUpload"></span>'
												 ."\r\n\t\t\t".'<input id="btnCancel_'.$js_element_name.'" type="button" value="Cancel Upload" onclick="swfupload_'.$js_element_name.'.cancelQueue();" disabled="disabled" style="display:none;margin-left: 2px; font-size: 8pt; height: 29px;" />'
												 ."\r\n\t\t\t".'<div id="fsUploadProgress_'.$js_element_name.'"></div>'
												 ;
			}
			
			$html_form_element .= "\r\n\t\t".'</div>'
											 ."\r\n\t".'</div>'
											 ."\r\n"
												;
		}

		if($type == 'radio')
		{
			$label_config['value'] = (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_radio;
		}
		
		if($type == 'checkbox')
		{
			$label_config['value'] = (isset($element['id']) && $element['id']) ? $this->getLabelValueFromJson($element) : $this->default_label_checkbox;
		}			
				
		if($type == 'checkbox' || $type == 'radio')
		{

			// only $label_config['value'] is different
			$label_config['style'] = '';
			if($editor)
			{
				$label_config['style'] = 'style="'.((isset($element['id']) && $element['id']) ? $this->buildStyle($element['label']) : $style_label).'"';
			}
			
			$label_config['element_id'] 	= (isset($element['id']) && $element['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
			$label_config['required'] 		= (isset($element['id']) && $element['id']) ? $element['required'] : '';
			
			
			$html_form_element .= $this->htmlLabel($label_config);
			
			$html_form_element .= "\r\n\r\n\t".$this->htmlOpenDivElementSet($element, $editor);
			
			$html_form_element .= $this->insertParagraph($editor, $element, $default_value = '', $style_paragraph);
			
			$html_form_element .= "\r\n\t\t".$this->htmlOpenDivElementContent($element, $editor);
			
			$html_form_element .= "\r\n\t\t\t".'<div class="cfg-option-set">';
			
			
			if(isset($element['option']) && $element['option'])
			{
				if($editor)
				{
					$html_form_element .= $this->addOptionContainer($element, true, true, true);
				} else{
					$html_form_element .= $this->addOptionContainer($element, false, true, true);
				}
			} else
			{
				$default_option_array['type'] = $type;
				for($i=0; $i<=2; $i++)
				{
					$default_option_array['option']['set'][$i]['value'] = $this->default_option_value;
				}

				$html_form_element .= $this->addOptionContainer($default_option_array, true, true, true);
			}
			
			$html_form_element .= "\r\n\t\t\t".'</div>'; //cfg-option-container

			$html_form_element .= "\r\n\t\t".'</div>'; //htmlOpenDivElementContent
												
			$html_form_element .= "\r\n\t".'</div>'
												."\r\n"; //htmlOpenDivElementSet
		}
		
		// $html_form_element can = '' in the case of $type = image when there is no img url or img file, this prevents from having <div class="element"></div> in the code
		if($html_form_element)
		{
			$html_form_element = '<div class="cfg-element-container">'
											.$html_form_element;
			
			/**
			 * Needed in the editor:
			 * helps calculating the element height when aligning on left/right the label
			 * prevents the right side from overlapping on the element that is below (exemple with checkboxes that would overlap the following element if label aligned on left/right)
			 *
			 * Needed in the render of the form to properly clear the alignment if label is aligned on left/right
			 */
			if(!in_array($element['type'], array('image', 'paragraph', 'submit', 'title')))
			{
				$html_form_element .= "\r\n\t".'<div class="cfg-clear"></div>'."\r\n";
			}
			
			$html_form_element .= '</div>'
											 ."\r\n\r\n"
											 ."\r\n";
		}
		
		return($html_form_element);
		
	}
	
	function buildElementLabelId($id)
	{
		return ($id.$this->label_suffix);
	}
	
	
	function formatElementHtmlId($param)
	{
		if(isset($param['form_id']) && $param['form_id'])
		{
			return $this->element_name_prefix.$param['form_id'].'-'.$param['target_id'];
		} else{
			return $this->element_name_prefix.$param['target_id'];
		}
	}
	
	function htmlLabel($label_config)
	{
		
		$html_label = "\r\n"."\r\n\t".'<label class="cfg-label" id="'.$this->buildElementLabelId($label_config['element_id']).'" '.$label_config['style'].'>'
							.'<span class="cfg-label-value">'.$label_config['value'].'</span>';
							
		if($label_config['required'])
		{
			$html_label .= '<span class="cfg-required">*</span>';
		}
		
		/*
		The error message div is appended on the fly in contactform.js
		$html_label .= '</label>'
							."\r\n\r\n\t".'<div class="cfg-errormessage" id="'.$label_config['element_id'].'-errormessage"></div>';
		*/
		$html_label .= '</label>';
		
		return($html_label);
		
	}
	
	function htmlSelectOption()
	{
		$html = '<option value="'.$this->default_newoption_value.'">'.$this->default_newoption_value.'</option>';
		
		return($html);

	}
	
	function htmlOpenDivElementContent($element, $editor)
	{
		/*
		$elementcontainer_style = '';
		if($editor && isset($element['container']['css']['default']) && $element['container']['css']['default'])
		{
			$elementcontainer_style = 'style="'.$this->buildStyle($element['container']).'"';
		}
		
		$elementcontainer_id = (isset($element['container']['id']) && $element['container']['id']) ? $element['container']['id'] : $this->htmlElementName($_SESSION['form_element_id']).$this->elementcontent_suffix;
		
		$html_form_element = '<div class="cfg-element-content" id="'.$elementcontainer_id.'" '.$elementcontainer_style.'>';
		*/
		$html_form_element = '<div class="cfg-element-content">';
		
		return $html_form_element;
	}
	
	function htmlOpenDivElementSet($element, $editor)
	{
		$elementcontainer_style = '';
		if($editor && isset($element['container']['css']['default']) && $element['container']['css']['default'])
		{
			$elementcontainer_style = 'style="'.$this->buildStyle($element['container']).'"';
		}
		
		$elementcontainer_id = (isset($element['container']['id']) && $element['container']['id']) ? $element['container']['id'] : $this->htmlElementName($_SESSION['form_element_id']).$this->elementset_suffix;
		
		$html_form_element = '<div class="cfg-element-set" id="'.$elementcontainer_id.'" '.$elementcontainer_style.'>';
		
		return $html_form_element;
	}
	
	function addOptionContainer($element, $editor, $insert_attr, $linebreaks)
	{
		$html_line_break = '';
		$tab = '';
		
		if($linebreaks == true)
		{
			$html_line_break = "\r\n\t";
			$tab = "\t";
		} else{
			/*
			v1.4
			$html_line_break = '\'+"\r\n\t"+\'';
			$tab = '\'+"\t"+\'';
			*/
			$html_line_break = '';
			$tab = '';
		}
		
		$html='';
		$i = 0;
		
		
		foreach($element['option']['set'] as $value)
		{
			$attr_input = '';
			$attr_label = '';
			
			if($insert_attr)
			{
				$option_name 	= (isset($value['id']) && $value['id']) ? $element['id'] : $this->htmlElementName($_SESSION['form_element_id']);
				$option_id 			= (isset($value['id']) && $value['id']) ? $value['id'] : $this->htmlElementName($_SESSION['form_element_id']).'-'.$i;
		
				$attr_input = 'name="'.$option_name.'" id="'.$option_id.'"';
				$attr_label = 'for="'.$option_id.'"';
			}
			
			$option_content_class = (isset($element['option']['container']['id']) && $element['option']['container']['id']) ? ' '.$element['option']['container']['id'] : '';
			if($editor)
			{
				$option_content_class .= ' formelement';
			}
			
			$option_content_style = '';
			if($editor)
			{
				$css_filter = array('padding', '-webkit-border-radius', '-moz-border-radius', 'border-radius', 'border-width', 'border-style', 'border-color');

				$option_content_style = 'style="'.((isset($element['option']['container']) && $element['option']['container']) ?$this->buildStyle($element['option']['container'], $css_filter) : $this->style_formelement).'"';
			}
			
			
			$label_style = '';
			if($editor)
			{	// deactivated because the label inherits its style from its option container
				//$label_style 	= 'style="'.((isset($value['id']) && $value['id']) ? $this->buildStyle($element['option']) : $this->style_formelement).'"';
			}
			
			$checked = (isset($value['checked']) && $value['checked'])?'checked="checked"':'';

			$html .= $html_line_break.$tab.$tab.$tab.'<div class="cfg-option-content'.$option_content_class.'" '.$option_content_style.'>'
						.$html_line_break.$tab.$tab.$tab.'<input type="'.$element['type'].'" class="cfg-form-value" '.$attr_input.' value="'.$value['value'].'" '.$checked.' />'
						.$html_line_break.$tab.$tab.$tab.'<label '.$attr_label.$label_style.'>'.$value['value'].'</label>'
						.$html_line_break.$tab.$tab.$tab.'</div>';
					
			$i++;
		}
		
		return($html);
	}
	
	
	function divEditOptionContainer($optiontype, $value, $checked)
	{
		
		if($optiontype == 'select')
		{
			$img_uncheck = 'ui-radio-button-uncheck.png';
			$img_check = 'ui-radio-button.png';
		}
		
		if($optiontype == 'radio')
		{
			$img_uncheck = 'ui-radio-button-uncheck.png';
			$img_check = 'ui-radio-button.png';
		}
		
		if($optiontype == 'checkbox' || $optiontype == 'selectmultiple')
		{
			$img_uncheck = 'ui-check-box-uncheck.png';
			$img_check = 'ui-check-box.png';
		}
		
		$uncheck_style_display_option = $checked ? ' display:none; ' : '';
		$check_style_display_option = $checked ? '' : ' display:none; ';
		
		// the class "selected" is necessary to make it work properly (contactformeditor.js)
		// the class "selected" is only added on radiocheck
		$check_class_selected = $checked ? ' selected ' : '';
		
		
		$html = '<div class="editoption-container">'
					.'<input type="text" value="'.$value.'" class="editoption '.$optiontype.' inputoption-elementeditor inputborder-elementeditor" size="18"  />'
					.'<span class="cfg-addoption '.$optiontype.'" ><img src="img/plus-button.png" title="Add an option" /></span>'
					.'<span class="cfg-deleteoption '.$optiontype.'"><img src="img/cross-button.png" title="Delete this option" /></span>'
					.'<span class="defaultoption  '.$optiontype.' radiouncheck" style="'.$uncheck_style_display_option.'"><img src="img/'.$img_uncheck.'" title="Make this option preselected" /></span>'
					.'<span class="defaultoption  '.$optiontype.' radiocheck '.$check_class_selected.'" style="'.$check_style_display_option.'"><img src="img/'.$img_check.'" title="Unselect this option" /></span>'
					.'&nbsp;<span class="sortoption-handle"><img src="img/arrow-move.png" title="Move this element"  style="cursor:move;" /></span>'
					.'</div>';
					
		return($html);
	}
	
	
	function fontStyleEditor($config_fse)
	{
	?>
			<div class="fontstyleeditor-t"><?php echo $config_fse['title'];?></div>
			<div class="fontstyleeditor-c">
					<div class="fontstyleeditor-l">
					Font family:
					</div>
					<div class="fontstyleeditor-r">
					<select class="<?php echo $config_fse['selectfontfamily_class'];?>">
					
					<?php
					foreach($this->fontstyleeditor_fontlist as $value)
					{
					?>
					<option value="<?php echo $value;?>"  style="font-family:'<?php echo $value;?>'" <?php echo $config_fse['selectedfontfamily']==$value?'selected':'';?>><?php echo $value;?></option>
					<?php
					}
					?>
					</select>
					</div>
					<div class="clear"></div>
			</div>
			
			<div class="fontstyleeditor-c">
					<div class="fontstyleeditor-l">
					Font size: 
					</div>
					<div class="fontstyleeditor-r">
					<span class="slidertrackervalue"><span id="<?php echo $config_fse['fontsizeslidervalue_id'];?>"></span>px</span>
					<div id="<?php echo $config_fse['fontsizeslider_id'];?>" style="margin-top:6px;"></div>
					</div>
					<div class="clear"></div>
			</div>

			
			<div class="fontstyleeditor-c">
					<div class="fontstyleeditor-l">
					Font weight:
					</div>
					<div class="fontstyleeditor-r">
					<select class="<?php echo $config_fse['selectfontweight_class'];?>">
					<option value="normal" <?php echo $config_fse['selectedfontweight']=='normal'?'selected':'';?>>Normal</option>
					<option value="bold" <?php echo $config_fse['selectedfontweight']=='bold'?'selected':'';?>>Bold</option>
					<option value="italic" <?php echo $config_fse['selectedfontweight']=='italic'?'selected':'';?>>Italic</option>
					</select>
					</div>
					<div class="clear"></div>
			</div>
			
			
			<div class="fontstyleeditor-c">
					<div class="fontstyleeditor-l">
					Font color:
					</div>
					<div class="fontstyleeditor-r">

					<?php 
					echo $this->setUpColorPicker($config_fse, false); // no need to specify colorpicker_csspropertyname because the javascript tag is already written in the index page
					?>

					</div>
					<div class="clear"></div>
			</div>
	<?php
	}
	
	function setUpColorPicker($config, $insert_script_tag = true)
	{
		/*
			<script>
			$('#<?php echo 'element_color_'.$_SESSION['form_element_id'];?>').colorkit('#<?php echo 'element_color_'.$_SESSION['form_element_id'];?>', 'element', '#element_colorpicker_<?php echo $_SESSION['form_element_id'];?>',{'color':1} );
			</script>
		
			<script>
			$('#<?php echo 'element_hovercolor_'.$_SESSION['form_element_id'];?>').colorkit('#<?php echo 'element_hovercolor_'.$_SESSION['form_element_id'];?>', 'element', '#element_hovercolorpicker_<?php echo $_SESSION['form_element_id'];?>', {'':''} );
			</script>
			
			<script>
			$('#element_bgcolor_<?php echo $_SESSION['form_element_id'];?>').colorkit('#element_bgcolor_<?php echo $_SESSION['form_element_id'];?>', 'element', '#element_bgcolorpicker_<?php echo $_SESSION['form_element_id'];?>', {'background-color':1} );
			</script>
			
			<script>
			$('#element_hoverbgcolor_<?php echo $_SESSION['form_element_id'];?>').colorkit('#element_hoverbgcolor_<?php echo $_SESSION['form_element_id'];?>', 'element', '#element_hoverbgcolorpicker_<?php echo $_SESSION['form_element_id'];?>', {'':''} );
			</script>
			
			<script>
			$('#element_bordercolor_<?php echo $_SESSION['form_element_id'];?>').colorkit('#element_bordercolor_<?php echo $_SESSION['form_element_id'];?>', 'element', '#element_bordercolorpicker_<?php echo $_SESSION['form_element_id'];?>', {'border-color':1} );
			</script>
			
			<script>
			$('#element_hoverbordercolor_<?php echo $_SESSION['form_element_id'];?>').colorkit('#element_hoverbordercolor_<?php echo $_SESSION['form_element_id'];?>', 'element', '#element_hoverbordercolorpicker_<?php echo $_SESSION['form_element_id'];?>', {'':''} );
			</script>
		*/
		?>
		<?php
		# {'':''} when adding hover effect, it prevents from applying the color directly on the element inside the editor (updateElementColor is called inside colorkit on the change event)
		# {'color':1} tells what css property to change on the element inside the editor (updateElementColor is called inside colorkit on the change event)
		?>
		
		<?php
		// the script tag and colorkit call is not written for colorpicker of the global top editor
		if($insert_script_tag)
		{
		?>
			<script>
			$('#<?php echo $config['colorpickervalue_id'];?>').colorkit('#<?php echo $config['colorpickervalue_id'];?>', 'element', '#<?php echo $config['colorpicker_id'];?>', {<?php if(isset($config['colorpicker_csspropertyname']) && $config['colorpicker_csspropertyname']) {echo '\''.$config['colorpicker_csspropertyname'].'\':1';} else echo '\'\':\'\'';?>} );
			</script>
		<?php
		}
		?>
		
		<?php		
		$inputvalue_style_color = '#ffffff';
		if($config['colorpicker_defaultcolor']=='#ffffff'){$inputvalue_style_color = '#000000';}
		if($config['colorpicker_defaultcolor']=='#000000'){$inputvalue_style_color = '#ffffff';}
		
		
		$config['export_css'] = isset($config['export_css'])?$config['export_css']:'';
		
		$html = '<div class="colorpicker-container">'
						.'<input type="text" id="'.$config['colorpickervalue_id'].'"  value="'.$config['colorpicker_defaultcolor'].'" class="colorpickervalue '.$config['export_css'].'"  style="background-color:'.$config['colorpicker_defaultcolor'].'; color:'.$inputvalue_style_color.';"  />'
						.'<div class="colorpicker-ico" style="background-color:'.$config['colorpicker_defaultcolor'].'"><img src="img/ui-color-picker.png"  /></div>'
						.'<div id="'.$config['colorpicker_id'].'" class="colorpicker"></div>'
						.'<div class="clear"></div>'
					.'</div>'
					;
		
		return($html);

	}
	
	function buildUploadJsFunction($value)
	{
		// file_upload_limit : 0 unlimited uploads authorized (the user can upload as many files as he wants)
		// file_queue_limit : 1 no multiple downloads at once
		
		// in order to prevent dashes in variables names in upload.js => var swfupload_cfg_element_1;
		$value['id'] = str_replace('-', '_', $value['id']);
		
		$js = 'var swfupload_'.$value['id'].'; // this variable name is also used in onclick="cfg_upload_xxx.cancelQueue();"
				jQuery(function(){
					var swfupload_'.$value['id'].' = new SWFUpload({
											flash_url : "'.$this->dir_form_inc.'/js/swfupload/swfupload.swf",
											upload_url: "'.$this->dir_form_inc.'/inc/upload.php?btn_upload_id='.$value['btn_upload_id'].'",
											post_params: {"PHPSESSID" : "'.session_id().'"},
											file_size_limit : "'.$value['file_size_limit'].'",
											file_types : "'.$value['file_types'].'",
											file_types_description : "All Files",
											file_upload_limit : 0,
											file_queue_limit : 1,
											custom_settings : {
												progressTarget : "fsUploadProgress_'.$value['id'].'",
												cancelButtonId : "btnCancel_'.$value['id'].'"
											},
											debug: false,
											
											// Button settings
											button_image_url: "'.$this->dir_form_inc.'/js/swfupload/img/upload-button.png",
											button_width: "130",
											button_height: "31",
											button_placeholder_id: "'.$value['btn_upload_id'].'",
													
											button_action:SWFUpload.BUTTON_ACTION.SELECT_FILE, // when the Flash button is clicked the file dialog will only allow a single file to be selected
											button_cursor: SWFUpload.CURSOR.HAND,
									
											// The event handler functions are defined in handlers.js
											file_queued_handler : fileQueued,
											file_queue_error_handler : fileQueueError,
											file_dialog_complete_handler : fileDialogComplete,
											upload_start_handler : uploadStart,
											upload_progress_handler : uploadProgress,
											upload_error_handler : uploadError,
											upload_success_handler : uploadSuccess, // uploadSuccess in handlers.js
											upload_complete_handler : uploadComplete // FileProgress.prototype.setComplete in fileprogress.js
										});
						/* queue_complete_handler : queueComplete	// queueComplete in handlers.js, Queue plugin event */
										
				});'
				."\r\n\r\n";
			
		return $js;
	}
	
	function closeEditContainer(){
		return ('<div class="cfg-close-edit-container"><span class="cfg-close-edit">Close</span></div>');
	}
	
	function buildStyle($style, $filter = array())
	{
		$load_element_style = '';
		
		if(isset($style['css']['default']) && $style['css']['default'])
		{
			
			foreach($style['css']['default'] as $css_property => $css_value)
			{
				if(!in_array($css_property, $filter))
				{
					// add quotes on the font family name if it contains spaces: Trebuchet MS=> 'Trebuchet MS'
					if($css_property == 'font-family' && preg_match("/\\s/", $css_value))
					{
						$css_value = '\''.$css_value.'\'';
					}
					
					$load_element_style .= $css_property.':'.$css_value.';';
				}
			}
		
		}
		
		return $load_element_style;
	}
	
	
	function buildCssElement($style, $filter = array())
	{
		$content_css  = '';
		
		foreach($style as $css_property_name=>$css_property_value)
		{
			if(!in_array($css_property_name, $filter))
			{
				// add quotes on the font family name if it contains spaces: Trebuchet MS=> 'Trebuchet MS'
				if($css_property_name == 'font-family' && preg_match("/\\s/", $css_property_value))
				{
					$css_property_value = '\''.$css_property_value.'\'';
				}
			
				$content_css .= "\r\n\t".$css_property_name.':'.$css_property_value.';';
			}
		}
		
		return $content_css;
	}
	
	
	function htmlElementName($id)
	{
		return ($this->element_name_prefix.$id);
	}
	
	function getLabelValueFromJson($element)
	{
		return $element['label']['value'];
	}
	
	function formIncDirName($form_id)
	{
		return $this->dir_form_inc.'-'.$form_id;
	}



	function editMessageColor($type, $defaultcolor = '')
	{
		if($defaultcolor)
		{	
			$defaultcolor = $this->buildStyle($defaultcolor);
			$loadform = 1;
		} else{
			$defaultcolor = $this->{$type.'_message_styles'}[$this->{'default_'.$type.'_message_style'}][0];
			$loadform = '';
		}
		
		// errormessagecolor validationerrormessagecolor in contactformeditor.js
		?>
		<div style="padding-top:4px;">
		
			<div style="float:left; width:44px;">
			
				<input type="hidden" id="<?php echo $type;?>-messagecolor-value" value="<?php echo $defaultcolor;?>" />
				
				<span id="<?php echo $type;?>-messagecolor-container" class="formconfiguration-message-style" style=" <?php echo $defaultcolor;?>">abc</span>
			
			</div>
			
			<div style="float:left; width:320px;">
			
				<span class="othercolors">Change color</span>
				
				<div class="messagecolor-container" style="display:none;">
					
					<?php
					if($loadform)
					{
						?>
						<input type="radio" name="<?php echo $type;?>_message_style" class="selectmessagecolor-radio <?php echo $type;?>messagecolor" checked="checked" id="loadform_<?php echo $type;?>_color" />
						<span class="formconfiguration-message-style" style=" <?php echo $defaultcolor;?>"><label for="loadform_<?php echo $type;?>_color">abc</label></span>
						<div class="clear" style="margin-bottom:8px;"></div>
						<?php
					}
					?>
					
					<?php
					foreach($this->{$type.'_message_styles'} as $key=>$value)
					{
						// if a form is loaded the color choice above is already checked
						$checked_color_validation_message = '';
						if(!$loadform)
						{
							$checked_color_validation_message = ($key == $this->{'default_'.$type.'_message_style'})?'checked':'';
						}
						
						$label_for = $type.'-message-style-'.$key;
						
						?>
						<div class="selectmessagecolor-container" style="float:left; width:80px; margin:0 4px 8px 0;">

							<input type="hidden" class="selectmessagecolor-value" value="<?php echo $value[0];?>" />
							
							<input type="radio" name="<?php echo $type;?>_message_style" class="selectmessagecolor-radio <?php echo $type;?>messagecolor" <?php echo $checked_color_validation_message;?> id="<?php echo $label_for;?>" />
							
							<span class="formconfiguration-message-style" style=" <?php echo $value[0];?>"><label for="<?php echo $label_for;?>">abc</label></span>
							
						</div>
						<?php
					}
					?>	
				</div><!-- messagecolor-container -->
				
			</div>
			
		</div>
		<?php
	}
	
	
	function loadFormIndex(){
		
		$json_form_index = json_decode(file_get_contents('../contactform-download/'.$this->forms_index_filename), true);
		
		return $json_form_index;
	}
	

	/**
	 * Delete duplicate directory and copy source files
	 */
	// removes files and non-empty directories
	function rrmdir($dir)
	{
		if(is_dir($dir))
		{
			$objects = scandir($dir); 
			foreach($objects as $object){ 
				if($object != "." && $object != "..")
				{ 
					if(filetype($dir."/".$object) == "dir"){
						//echo "rrmdir DIR/OBJECT: $dir/$object"."\r\n";
						$this->rrmdir($dir."/".$object);
					}
					else{
						//echo "unlink DIR/OBJECT: $dir/$object"."\r\n";
						@unlink($dir."/".$object); 
					}
				}
			}
			reset($objects); 
			@rmdir($dir); 
		} 
	} 
	
	// copies files and non-empty directories
	function rcopy($src, $dst)
	{
		if(file_exists($dst)) $this->rrmdir($dst); // delete the directory if it exists
		if(is_dir($src))
		{
			@mkdir($dst);
			//echo "MK DIR DST: $dst"."\r\n";
			
			$files = scandir($src);
			foreach($files as $file)
			{
				if($file != "." && $file != "..")
				{
					//echo "rcopy SRC/FILE: $src/$file"."\r\n";
					//echo "rcopy DST/FILE: $dst/$file"."\r\n";
					$this->rcopy("$src/$file", "$dst/$file");
				}
			}
		}
		else if (file_exists($src))
		{
			@copy($src, $dst);
			//echo "copy SRC/DST: $src | $dst"."\r\n";
		}
	}

	
	function quote_smart($value)
	{
		if(get_magic_quotes_gpc())
		{
			$value = stripslashes($value);
		}
		
		return $value;
	}

	function isEmail($email)
	{
		$atom   = '[-a-z0-9\\_]';   // authorized caracters before @
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // authorized caracters after @
									   
		$regex = '/^' . $atom . '+' .   
		'(\.' . $atom . '+)*' .         
										
		'@' .                           
		'(' . $domain . '{1,63}\.)+' .  
										
		$domain . '{2,63}$/i';          
		
		// test de l'adresse e-mail
		return preg_match($regex, trim($email)) ? 1 : 0;
		
	}
	
	function isphp5()
	{
		if(strnatcmp(phpversion(),'5.2.0') >=0)
		{
			return true;
		}
	}

	
	
	function authentication($redir)
	{
		//print_r($_SESSION); print_r($_COOKIE);
		// $user['login'] = '';
		// $user['password'] = '';
		
		if(preg_match('#editor/inc/#', $_SERVER['SCRIPT_NAME']))
		{
			if(file_exists('../inc/user.php'))
			{
				require_once('../inc/user.php');
			}
		}
		elseif(preg_match('#editor#', $_SERVER['SCRIPT_NAME']))
		{
			if(file_exists('inc/user.php'))
			{
				require_once('inc/user.php');
			}
		} else
		{
			if(file_exists('editor/inc/user.php'))
			{
				require_once('editor/inc/user.php');
			}
		}
		
		// 1. the display of the login box is based on wether $_SESSION['user'] is set or not
		// 2. if user.php is missing or if the user deletes user.php after he creates the account
		if(!isset($user['login']) || !isset($user['password'])) 
		{
			unset($_SESSION['user']);
		}
		
		if(!isset($_SESSION['user']) || !$_SESSION['user'])
		{
			if(isset($_COOKIE['user']) && $_COOKIE['user'] && isset($user['login']) && $user['login'] && isset($user['password']) && $user['password'] )
			{
				$auth_exp = explode('*',$_COOKIE['user']);
				
				$cookie_login = $auth_exp[0];
				$cookie_password = $auth_exp[1];
				
				
				// VERIFY LOGIN AND PASSWORD
				if($cookie_login && $cookie_login == $user['login'] && $cookie_password && $cookie_password == $user['password'])
				{
					$_SESSION['user'] = $user['login'];
				}
 			} // isset cookie
			
			
			/**
			 * no session, no cookie
			 * the header location must be applied only if authentication is called from a page different
			 * from the index (listing)
			 * this redirection is not applied when we are on index (listing) as it would cause an infinite redirection loop
			 */
			if($redir && (!isset($_SESSION['user']) || !$_SESSION['user']))
			{
				header('Location: ../index.php');
				exit;
			}
		} // isset session
	}
	
}
// THERE MUST BE NO BLANK LINES AFTER THE CLOSING TAG
// OR COULD CAUSE :
// Warning: Cannot modify header information - headers already sent 
// in editor/inc/form-login.php
?>