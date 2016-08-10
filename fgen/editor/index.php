<?php
/**********************************************************************************
 * Contact Form Generator is (c) Top Studio
 * It is strictly forbidden to use or copy all or part of an element other than for your 
 * own personal and private use without prior written consent from Top Studio http://topstudiodev.com
 * Copies or reproductions are strictly reserved for the private use of the person 
 * making the copy and not intended for a collective use.
 *********************************************************************************/

session_start();

require_once('class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

require_once('sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');

$contactform_obj = new contactForm($cfg=array());

if($contactform_obj->demo != 1)
{
	$contactformeditor_obj->authentication(true);
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Form Generator - Online Contact Form Builder</title>


<meta name="description" content="Create contact forms and feedback forms instantly. Build elegant contact forms that will match your website's identity perfectly. Everything is configurable: colors, fonts, input fields and buttons.">
<meta name="keywords" content="contact form, contact form generator, contact form builder, form builder">
<meta name="robots" content="follow,index">

<!-- jQuery -->
<script src="<?php echo $contactformeditor_obj->path_jquery;?>"></script>
<script src="<?php echo $contactformeditor_obj->path_jquery_ui;?>"></script> 
<link rel="stylesheet" href="<?php echo $contactformeditor_obj->path_jquery_ui_theme;?>"> 
<script src="<?php echo $contactformeditor_obj->path_jquery_ui_datepicker_language;?>"></script>


<!-- farbtastic -->
<script src="js/farbtastic/farbtastic.js"></script>
<link rel="stylesheet" href="js/farbtastic/farbtastic.css" type="text/css" />


<!-- Contact Form, must be called after jquery -->
<script src="js/contactformeditor.js"></script>
<script src="js/json2.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="sourcecontainer/<?php echo $contactformeditor_obj->dir_form_inc;?>/css/contactform.css"/>
<link rel="stylesheet" type="text/css" href="css/contactformeditor.css"/>
<link rel="stylesheet" type="text/css" href="css/global.css"/>


<!-- SWFUpload -->
<link href="js/swfupload/default.css" rel="stylesheet" type="text/css" />

<script src="js/swfupload/swfupload.js"></script>
<script src="js/swfupload/swfupload.queue.js"></script>
<script src="js/swfupload/fileprogress.js"></script>
<script src="js/swfupload/handlers.js"></script>


<script>

var cfg_php_safe_mode = '<?php echo (ini_get('safe_mode')?1:'');?>';

var dir_form_inc = '<?php echo $contactformeditor_obj->dir_form_inc;?>';

var elements = Array();
<?php
$json_load_form_setup = '';
$loaded_form_json_key = '';
if(isset($_GET['id']) && $_GET['id'] && $contactform_obj->demo != 1)
{
	$json_load_form = json_decode(file_get_contents('contactform-download/'.$contactformeditor_obj->forms_index_filename), true);
	
	if($json_load_form['forms'])
	{
		foreach($json_load_form['forms'] as $form_key=>$form_value)
		{
			if($form_value['form_id'] == $_GET['id'])
			{
				$json_load_form_setup = $form_value['element'];
				$loaded_form_json_key = $form_key;
				break;
			}
		}
		if(!$json_load_form_setup)
		{
			$form_id_does_not_exist = true;
			?>
			$(function(){$('#gotoformconfiguration-container').hide()});
			<?php
		}
	}
} else
{
	$json_load_form_setup = $contactformeditor_obj->form_elements_setup;
}
if($json_load_form_setup)
{
	foreach($json_load_form_setup as $load_form_element)
	{
?>
elements.push(<?php echo json_encode($load_form_element);?>);

<?php
	}
}
?>


<?php
if(isset($json_load_form['forms'][$loaded_form_json_key]) && $json_load_form['forms'][$loaded_form_json_key])
{
	// If a form is loaded, the form id is appended to the element name prefix
	// element name prefix is used to target the date field when changing the datepicker format or datepicker language
	// the "if" test is not done on $loaded_form_json_key alone because $loaded_form_json_key can equals 0 for the first form and the test would return false even if a form is loaded
	?>
	var element_name_prefix = '<?php echo $contactformeditor_obj->element_name_prefix.$json_load_form['forms'][$loaded_form_json_key]['form_id'].'-';?>';
	<?php
} else{
	?>
	var element_name_prefix = '<?php echo $contactformeditor_obj->element_name_prefix;?>';
	<?php
}
?>


var config_usernotification_inputid = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['config_usernotification_inputid']) && $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_inputid']) ? $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_inputid']:'';?>';
// ^-- used in buildSelectNotificationEmailAddress to preselect the correct email field in the user notification message configuration

<?php
if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default'])
{
	$addoptioncontainer_style['css'] = $json_load_form['forms'][$loaded_form_json_key]['css']['input'];
} else{
	$addoptioncontainer_style = '';
}
?>

<?php
/*
 * addcslashes for html_optioncheckboxcontainer and html_optionradiocontainer
 * to prevent javascript errors because of font families with single quotes
 * without addslashes: font-family:'Trebuchet MS' => error
 * with addslashes: font-family:\'Trebuchet MS\' => ok
 */
?>
var html_optioncheckboxcontainer = '<?php echo addcslashes($contactformeditor_obj->addOptionContainer(array('type'=>'checkbox', 'option'=>array('set'=>array(0=>array('value'=>$contactformeditor_obj->default_newoption_value)), 'container'=>$addoptioncontainer_style)), true, false, false), "'" );?>';
var html_editoptioncheckboxcontainer = '<?php echo $contactformeditor_obj->divEditOptionContainer('checkbox', $contactformeditor_obj->default_newoption_value, '');?>';

var html_optionradiocontainer = '<?php echo addcslashes($contactformeditor_obj->addOptionContainer(array('type'=>'radio', 'option'=>array('set'=>array(0=>array('value'=>$contactformeditor_obj->default_newoption_value)), 'container'=>$addoptioncontainer_style)), true, false, false), "'" );?>';
var html_editoptionradiocontainer = '<?php echo $contactformeditor_obj->divEditOptionContainer('radio', $contactformeditor_obj->default_newoption_value, '');?>';

var html_selectoption = '<?php echo $contactformeditor_obj->htmlSelectOption();?>';
var html_editselectoptioncontainer = '<?php echo $contactformeditor_obj->divEditOptionContainer('select', $contactformeditor_obj->default_newoption_value, '');?>';
var html_editselectmultipleoptioncontainer = '<?php echo $contactformeditor_obj->divEditOptionContainer('selectmultiple', $contactformeditor_obj->default_newoption_value, '');?>';

var html_empty_image_container = '<?php echo $contactformeditor_obj->html_empty_image_container;?>';
var contactformgenerator_dir_upload = '<?php echo $contactformeditor_obj->dir_upload;?>';

var slider_fontsize_min  = <?php echo $contactformeditor_obj->slider_fontsize_min;?>;
var slider_fontsize_max = <?php echo $contactformeditor_obj->slider_fontsize_max;?>;
var slider_fontsize_step = <?php echo $contactformeditor_obj->slider_fontsize_step;?>;

var default_color_formelement = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['color']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['color'])
														? $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['color'] : $contactformeditor_obj->default_color_formelement;?>';


var default_color_label = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['color']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['color'])
														? $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['color'] : $contactformeditor_obj->default_color_label;?>';

var default_color_paragraph = '<?php echo $contactformeditor_obj->default_color_paragraph;?>';
var default_color_submit = '<?php echo $contactformeditor_obj->default_color_submit;?>';
var default_color_title = '<?php echo $contactformeditor_obj->default_color_title;?>';

var default_fontfamily_formelement = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-family']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-family'])
															? $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-family'] : $contactformeditor_obj->default_fontfamily_formelement;?>';

var default_fontfamily_label = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-family']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-family'])
															? $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-family'] : $contactformeditor_obj->default_fontfamily_label;?>';

var default_fontfamily_paragraph = '<?php echo $contactformeditor_obj->default_fontfamily_paragraph;?>';
var default_fontfamily_submit = '<?php echo $contactformeditor_obj->default_fontfamily_submit;?>';
var default_fontfamily_title = '<?php echo $contactformeditor_obj->default_fontfamily_title;?>';
	
var default_fontsize_formelement = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-size']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-size'])
															? preg_replace("/[^0-9\.]/", '', $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-size']) : $contactformeditor_obj->default_fontsize_formelement;?>';

var default_fontsize_label = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-size']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-size'])
															? preg_replace("/[^0-9\.]/", '', $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-size']) : $contactformeditor_obj->default_fontsize_label;?>';


var default_fontsize_paragraph = '<?php echo $contactformeditor_obj->default_fontsize_paragraph;?>';
var default_fontsize_submit = '<?php echo $contactformeditor_obj->default_fontsize_submit;?>';
var default_fontsize_title = '<?php echo $contactformeditor_obj->default_fontsize_title;?>';
	
<?php
if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight']!='normal')
{	
	echo 'var default_fontweight_formelement = \''.$json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight'].'\';';
		
} elseif(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-style']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-style']!='normal')
{
	echo 'var default_fontweight_formelement = \''.$json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-style'].'\';';
}
else{
	echo 'var default_fontweight_formelement = \''.$contactformeditor_obj->default_fontweight_formelement.'\';';
}
?>


<?php
if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight']!='normal')
{	
	echo 'var default_fontweight_label = \''.$json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight'].'\';';
		
} elseif(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style']!='normal')
{
	echo 'var default_fontweight_label = \''.$json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style'].'\';';
}
else{
	echo 'var default_fontweight_label = \''.$contactformeditor_obj->default_fontweight_label.'\';';
}
?>

var default_fontweight_paragraph = '<?php echo $contactformeditor_obj->default_fontweight_paragraph;?>';
var default_fontweight_submit = '<?php echo $contactformeditor_obj->default_fontweight_submit;?>';
var default_fontweight_title = '<?php echo $contactformeditor_obj->default_fontweight_title;?>';
	
var default_width_captcha = '<?php echo $contactformeditor_obj->default_width_captcha;?>';
var default_width_date = '<?php echo $contactformeditor_obj->default_width_date;?>';
var default_width_email = '<?php echo $contactformeditor_obj->default_width_email;?>';
var default_width_input = '<?php echo $contactformeditor_obj->default_width_input;?>';
var default_width_label = '<?php echo $contactformeditor_obj->default_width_label;?>';
var default_width_option = '<?php echo $contactformeditor_obj->default_width_option;?>';
var default_width_paragraph = '<?php echo $contactformeditor_obj->default_width_paragraph;?>';
var default_width_submit = '<?php echo $contactformeditor_obj->default_width_submit;?>';
var default_width_textarea = '<?php echo $contactformeditor_obj->default_width_textarea;?>';
	
var default_margintop_option = '<?php echo $contactformeditor_obj->default_margintop_option;?>';


var default_bordercolor_inputformat = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-color']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-color'])
															? $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-color'] : $contactformeditor_obj->default_bordercolor_inputformat;?>';


var default_borderradius_inputformat = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-radius']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-radius'])
															? preg_replace("/[^0-9\.]/", '', $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-radius']) : $contactformeditor_obj->default_borderradius_inputformat;?>';

var default_borderwidth_inputformat = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-width']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-width'])
															? preg_replace("/[^0-9\.]/", '', $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-width']) : $contactformeditor_obj->default_borderwidth_inputformat;?>';


var default_padding_inputformat = '<?php echo (isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['padding']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['padding'])
															? preg_replace("/[^0-9\.]/", '', $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['padding']) : $contactformeditor_obj->default_padding_inputformat;?>';

var default_backgroundcolor_submit = '<?php echo $contactformeditor_obj->default_backgroundcolor_submit;?>';
var default_bordercolor_submit = '<?php echo $contactformeditor_obj->default_bordercolor_submit;?>';
	
var default_rows_textarea = '<?php echo $contactformeditor_obj->default_rows_textarea;?>';
	
var element_container_default_height = {};	
	
<?php if($contactform_obj->demo != 1){if(!isset($_SESSION['user']) || !$_SESSION['user']){exit;}}?>

$(function(){
	
	/**
	 * COLOR PICKER DEFAULT CONFIG
	 */
		
	var f = $.farbtastic('#title_colorpicker','' );
	$('#label_color').colorkit('#label_color', '.cfg-label', '#label_colorpicker', {'color':1} );
	$('#title_color').colorkit('#title_color', '.cfg-title', '#title_colorpicker', {'color':1} );
	$('#paragraph_color').colorkit('#paragraph_color', '.cfg-paragraph', '#paragraph_colorpicker', {'color':1} );
	$('#formelement_color').colorkit('#formelement_color', '.formelement', '#formelement_colorpicker', {'color':1} );
	$('#inputformat_color').colorkit('#inputformat_color', '.colortargetinputformat', '#inputformat_colorpicker', {'border-color':1} );
		

		$('#submit-changepassword').click(function()
		{
			$('.user-error').empty().hide();
			$('.user-validation').empty().hide();
			
			var submit_changepassword = $(this);
			submit_changepassword.hide();
			
			$('#loading-changepassword').show();
			
			$.post('inc/form-changepassword.php',
					{
						'user-login':$('#user-login').val(),
						'user-password-1':$('#user-password-1').val(),
						'user-password-2':$('#user-password-2').val()
					},
					function(data){
						submit_changepassword.show();
						$('#loading-changepassword').hide();
						
						$('#user-password-1').val('');
						$('#user-password-2').val('');
									
						var json_data = $.parseJSON(data);
						if(json_data['response'] == 'nok')
						{
							$('.user-error').show().append(json_data['response_msg']);
						} else{
							$('.user-validation').show().append(json_data['response_msg']);
						}
					}
				   ); // end post
		}); // end click


});



</script>



</head>

<body>

<div id="formfields">

		<?php
		// PHP VERSION CHECK
		if(!$contactformeditor_obj->isphp5())
		{
			echo $contactformeditor_obj->warning_php5;
			echo '</div></body></html>';
			exit;
		}
		?>
	<div id="header">
		<div id="cfg-header-l" >
		<a href="index.php"><img src="img/logo.png" border="0" /></a>
		<p id="baseline">Create your contact form without writing a single line of code.</p>
		</div>
	
		<div id="cfg-header-r">
			<?php
			if($contactform_obj->demo == 1)
			{
				?>
				<div style="float:right; width:210px; ">
				<a href="<?php echo $contactform_obj->envato_link;?>" target="_parent"><img src="img/buy.png" border="0" /></a>
				</div>
				<?php
			} 
			else
			{
				?>
				
				<div style="float:right; width:120px; height:42px;  border-left:1px solid #dddddd; padding-left:4px; ">
				<?php
				if($contactform_obj->demo != 1)
				{
					?>
					<div><a href="inc/form-logout.php" id="logout">Logout</a></div>
					<div class="cfg-header-r-sub"><span id="changepassword">Change password</span></div>
					<div class="cfg-header-r-sub"><span id="needhelp">Need help?</span></div>
					<?php
				}
				?>
				</div>
				
				<div style="float:right; width:260px; height:42px; padding-right:26px;  ">
				<?php
				if($contactform_obj->demo != 1)
				{
					?>
					<div id="cfg-version">
					&nbsp;&nbsp;&nbsp;&nbsp;Version <?php echo $contactformeditor_obj->version;?>&nbsp;<span style="font-size:14px;">© <a href="http://www.topstudiodev.com" target="_blank" id="topstudiowww"><span id="copyright-header">Top Studio</span></a></span>
					</div>
					<?php
					$print_newversionmessage = '';
					
					if(extension_loaded('SimpleXML'))
					{
						$grab_version = @simplexml_load_file('http://www.topstudiodev.com/contactformgenerator/version.xml');
					} else{
						$grab_version = '';
					}
					
					if(is_object($grab_version))
					{
						if(is_numeric((string)$grab_version[0]->version))
						{
							if($grab_version[0]->version != $contactformeditor_obj->version)
							{
								$print_newversionmessage = 1;
								?>
								<div id="newversionavailable" class="cfg-header-r-sub">
								<a href="http://codecanyon.net/item/contact-form-generator/1719810" target="_blank">A new version is available on Code Canyon!</a>
								</div>
								<?php
							}
						}
					}
					if(!$print_newversionmessage)
					{
						?>
								<div id="newversionavailable" class="cfg-header-r-sub">
								<a href="http://topstudiodev.com" target="_blank">Click here to be notified of the next update</a>
								</div>
						<?php
					}
				}
				?>
				</div>
				
				<div class="clear"></div>
				<?php
			} // end else
			?>
			
		</div><!-- end cfg-header-r -->
		
		<div class="clear"></div>
	</div><!-- end header -->
		
	
	<div id="formfields-menu-container">
	
			<div id="formfields-menu">
			
					<div class="addelement" id="addTitle">Title</div>
					<div class="addelement" id="addParagraph">Paragraph</div>
					<div class="addelement" id="addEmail">Email</div>
					<div class="addelement" id="addInputText">Single line text</div>
					<div class="addelement" id="addTextArea">Multi-line text</div>
					<div class="addelement" id="addCheckbox">Checkbox</div>
					<div class="addelement" id="addRadio">Radio button</div>
					<div class="addelement" id="addSelect">Select drop-down</div>
					<div class="addelement" id="addSelectMultiple">MultiSelect drop-down</div>
					<div class="addelement" id="addUpload">Upload</div>
					<div class="addelement" id="addImage">Image</div>
					<div class="addelement" id="addDate">Date</div>
					<div class="addelement" id="addTime">Time</div>
					<div class="addelement" id="addCaptcha">Captcha</div>
					<div class="addelement" id="addSubmit">Submit button</div>
				
			</div>
			
	</div>
	
	
	<div id="editorheader">
	
			<div class="header-btn" id="select-style">Fonts and colors</div>
			
			<div class="header-btn" id="textinputformat">Input field style</div>
			
			<div class="header-btn expandall" id="expandall">Expand all</div>
			
			<div class="header-btn collapseall" id="collapseall">Collapse all</div>
			
			<div class="header-btn" id="clearform">Clear form</div>
		
			<div class="header-btn" id="newform">New form</div>
			
			<?php
			if($contactform_obj->demo != 1)
			{
			?>
			<div class="header-btn" id="exit-form"><a href="../">Exit</a></div>
			<?php
			}
			?>
			
			<div class="clear"></div>
			
			<div id="samplecontainer">
			
				
				<div class="fontstyleeditor">
					
					<?php 
					/************************ LABELS ************************/
					$config_fse['title'] = 'Labels';
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-family']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-family'])
					{
						$config_fse['selectedfontfamily'] = $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-family'];
					} else{
						$config_fse['selectedfontfamily'] = $contactformeditor_obj->default_fontfamily_label;
					}
					
					$config_fse['selectfontfamily_class'] = 'newfontfamily-label fontsandcolors';
					$config_fse['fontsizeslider_id'] = 'sliderfontsize-label';
					$config_fse['fontsizeslidervalue_id'] = 'sliderfontsize-label-value';
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight']!='normal')
					{
						$config_fse['selectedfontweight'] = $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight'];
						
					} elseif(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style']!='normal')
					{
						$config_fse['selectedfontweight'] = $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style'];
						
					}
					else{
						$config_fse['selectedfontweight'] = $contactformeditor_obj->default_fontweight_label;
					}
					
					$config_fse['selectfontweight_class'] = 'newfontweight-label fontsandcolors';
					$config_fse['colorpicker_id'] = 'label_colorpicker';
					$config_fse['colorpickervalue_id'] = 'label_color';
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['color']) && $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-weight'])
					{
						$config_fse['colorpicker_defaultcolor'] = $json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['color'];
					} else{
						$config_fse['colorpicker_defaultcolor'] = $contactformeditor_obj->default_color_label;
					}
					
					echo $contactformeditor_obj->fontStyleEditor($config_fse);
					?>
					
					
				</div><!-- end fontstyleeditor -->
					
				<div class="fontstyleeditor">
					<?php 
					/************************ INPUT ************************/
					$config_fse['title'] = 'Input fields';
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-family']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-family'])
					{
						$config_fse['selectedfontfamily'] = $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-family'];
					} else{
						$config_fse['selectedfontfamily'] = $contactformeditor_obj->default_fontfamily_formelement;
					}
					$config_fse['selectfontfamily_class'] = 'newfontfamily-formelement fontsandcolors';
					$config_fse['fontsizeslider_id'] = 'sliderfontsize-formelement';
					$config_fse['fontsizeslidervalue_id'] = 'sliderfontsize-formelement-value';
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight']!='normal')
					{
						$config_fse['selectedfontweight'] = $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight'];
						
					} elseif(isset($json_load_form['forms'][$loaded_form_json_key]['css']['label']['default']['font-style']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-style']!='normal')
					{
						$config_fse['selectedfontweight'] = $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-style'];
						
					}
					else{
						$config_fse['selectedfontweight'] = $contactformeditor_obj->default_fontweight_formelement;
					}
					
					$config_fse['selectfontweight_class'] = 'newfontweight-formelement fontsandcolors';
					$config_fse['colorpicker_id'] = 'formelement_colorpicker';
					$config_fse['colorpickervalue_id'] = 'formelement_color';
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['color']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['font-weight'])
					{
						$config_fse['colorpicker_defaultcolor'] = $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['color'];
					} else{
						$config_fse['colorpicker_defaultcolor'] = $contactformeditor_obj->default_color_formelement;
					}
					
					echo $contactformeditor_obj->fontStyleEditor($config_fse);
					?>
				</div><!-- end fontstyleeditor -->
					
				<div class="fontstyleeditor">
					<?php 
					$config_fse['title'] = 'Paragraphs';
					$config_fse['selectedfontfamily'] = $contactformeditor_obj->default_fontfamily_paragraph;
					$config_fse['selectfontfamily_class'] = 'newfontfamily-paragraph fontsandcolors';
					$config_fse['fontsizeslider_id'] = 'sliderfontsize-paragraph';
					$config_fse['fontsizeslidervalue_id'] = 'sliderfontsize-paragraph-value';
					$config_fse['selectedfontweight'] = $contactformeditor_obj->default_fontweight_paragraph;
					$config_fse['selectfontweight_class'] = 'newfontweight-paragraph fontsandcolors';
					$config_fse['colorpicker_id'] = 'paragraph_colorpicker';
					$config_fse['colorpickervalue_id'] = 'paragraph_color';
					$config_fse['colorpicker_defaultcolor'] = $contactformeditor_obj->default_color_paragraph;
					echo $contactformeditor_obj->fontStyleEditor($config_fse);
					?>
				</div><!-- end fontstyleeditor -->
				
				<div class="fontstyleeditor">
					<?php 
					$config_fse['title'] = 'Titles';
					$config_fse['selectedfontfamily'] = $contactformeditor_obj->default_fontfamily_title;
					$config_fse['selectfontfamily_class'] = 'newfontfamily-title fontsandcolors';
					$config_fse['fontsizeslider_id'] = 'sliderfontsize-title';
					$config_fse['fontsizeslidervalue_id'] = 'sliderfontsize-title-value';
					$config_fse['selectedfontweight'] = $contactformeditor_obj->default_fontweight_title;
					$config_fse['selectfontweight_class'] = 'newfontweight-title fontsandcolors';
					$config_fse['colorpicker_id'] = 'title_colorpicker';
					$config_fse['colorpickervalue_id'] = 'title_color';
					$config_fse['colorpicker_defaultcolor'] = $contactformeditor_obj->default_color_title;
					echo $contactformeditor_obj->fontStyleEditor($config_fse);
					?>
				</div><!-- end fontstyleeditor -->
					
				<div class="clear"></div>

			</div> <!-- end samplecontainer -->
			
			
			
			<div id="textinputformat-container"  >
			<script>
			$(function(){
				$('#sliderpadding-textinputformat').slider({
								range: 'min',
								min: 0,
								max: 20,
								value: default_padding_inputformat,
								step: 1,
								change: function( event, ui ){
									/* for FF to prevent getting -1  value */
									$('#sliderpadding-textinputformat-value').html(ui.value);
									$('.cfg-type-text').css('padding', ui.value);
									$('.cfg-type-textarea').css('padding', ui.value);
									$('.cfg-captcha-input').css('padding', ui.value);
									
									default_padding_inputformat = ui.value;
									
									$('.element-container').each(function(){adjustElementHeightToLeftContent($(this));});

								},
								slide: function( event, ui ){
									$('#sliderpadding-textinputformat-value').html(ui.value);
									$('.cfg-type-text').css('padding', ui.value);
									$('.cfg-type-textarea').css('padding', ui.value);
									$('.cfg-captcha-input').css('padding', ui.value);
									
									default_padding_inputformat = ui.value;
									
									$('.element-container').each(function(){adjustElementHeightToLeftContent($(this));});
							
							}
				});
				$('#sliderpadding-textinputformat-value').html( $('#sliderpadding-textinputformat').slider('value') );
				
				$('#sliderborderradius-textinputformat').slider({
								range: "min",
								min: 0,
								max: 30,
								value: default_borderradius_inputformat,
								step: 1,
								change: function( event, ui ){
									/* for FF to prevent getting -1  value */
									$('#sliderborderradius-textinputformat-value').html(ui.value);
									$('.cfg-type-text').css('borderRadius', ui.value);
									$('.cfg-type-textarea').css('borderRadius', ui.value);
									$('.cfg-captcha-input').css('borderRadius', ui.value);
									default_borderradius_inputformat = ui.value;
								},
								slide: function( event, ui ){
									$('#sliderborderradius-textinputformat-value').html(ui.value);
									$('.cfg-type-text').css('borderRadius', ui.value);
									$('.cfg-type-textarea').css('borderRadius', ui.value);
									$('.cfg-captcha-input').css('borderRadius', ui.value);
									default_borderradius_inputformat = ui.value;
								}
				});
				$('#sliderborderradius-textinputformat-value').html( $('#sliderborderradius-textinputformat').slider('value') );
				
				$('#sliderborderwidth-textinputformat').slider({
								range: "min",
								min: 0,
								max: 10,
								value: default_borderwidth_inputformat,
								step: 1,
								change: function( event, ui ){
									/* for FF to prevent getting -1  value */
									$('#sliderborderwidth-textinputformat-value').html(ui.value);
									$('.cfg-type-text').css('borderWidth', ui.value);
									$('.cfg-type-textarea').css('borderWidth', ui.value);
									$('.cfg-captcha-input').css('borderWidth', ui.value);
									default_borderwidth_inputformat= ui.value;
									
									$('.element-container').each(function(){adjustElementHeightToLeftContent($(this));});
								},
								slide: function( event, ui ){
									$('#sliderborderwidth-textinputformat-value').html(ui.value);
									$('.cfg-type-text').css('borderWidth', ui.value);
									$('.cfg-type-textarea').css('borderWidth', ui.value);
									$('.cfg-captcha-input').css('borderWidth', ui.value);
									default_borderwidth_inputformat= ui.value;
									
									$('.element-container').each(function(){adjustElementHeightToLeftContent($(this));});
								}
				});
				$('#sliderborderwidth-textinputformat-value').html( $('#sliderborderwidth-textinputformat').slider('value') );
				
				
				
			});
			
			</script>
			
			<div class="textinputformat-container-l">
			Padding: <span class="slidertrackervalue"><span id="sliderpadding-textinputformat-value"></span>px</span>
			</div>
			
			<div class="textinputformat-container-r">
			<div id="sliderpadding-textinputformat"></div>
			</div>
			
			
			<div class="textinputformat-container-l">
			Border radius: <span class="slidertrackervalue"><span id="sliderborderradius-textinputformat-value"></span>px</span>
			</div>
			
			<div class="textinputformat-container-r">
			<div id="sliderborderradius-textinputformat"></div>
			</div>
			
			
			<div class="textinputformat-container-l">
			Border width: <span class="slidertrackervalue"><span id="sliderborderwidth-textinputformat-value"></span>px</span>
			</div>
			
			<div class="textinputformat-container-r">
			<div id="sliderborderwidth-textinputformat"></div>
			</div>
			
			

			<div class="textinputformat-container-l">
			Border color:
			</div>
			<div class="textinputformat-container-r">
				<?php 
				$config_color_inputformat['colorpickervalue_id'] = 'inputformat_color';
				$config_color_inputformat['colorpicker_id'] = 'inputformat_colorpicker';
				if(isset($json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-color']) && $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-color'])
				{
					$config_color_inputformat['colorpicker_defaultcolor'] = $json_load_form['forms'][$loaded_form_json_key]['css']['input']['default']['border-color'];
				} else{
					$config_color_inputformat['colorpicker_defaultcolor'] = $contactformeditor_obj->default_bordercolor_inputformat;
				}
				echo $contactformeditor_obj->setUpColorPicker($config_color_inputformat, false); // no need to specify colorpicker_csspropertyname because the javascript tag is already written in the index page
				?>
			</div>

			
			</div><!-- end textinputformat-container -->
	
	</div><!-- end editorheader -->
	
	<div id="formfields-editor">

	
	
	<div id="formeditor-container">
		<?php
		if(isset($form_id_does_not_exist) && $form_id_does_not_exist)
		{
			?>
			<div class="warning" style="	font-family:Verdana, Geneva, sans-serif; font-size:11px;">
			<p><strong>Error: you are trying a load a form that does not exist</strong>.</p>
			<p>Form id: <strong><?php echo htmlentities($_GET['id'], ENT_QUOTES, 'UTF-8');?></strong></p>
			</div>
			<?php
		}
		?>
	
		<?php
		// SUHOSIN CHECK
		$check_suhosin_post_max_value_length = 100000;
		/**
			$check_suhosin_get_max_value_length = 100000;
			&& (ini_get('suhosin.get.max_value_length')<$check_suhosin_get_max_value_length || ini_get('suhosin.post.max_value_length')<$check_suhosin_post_max_value_length)
			<br/><strong>suhosin.get.max_value_length</strong> : <span style="font-weight:bold; color: #009900;"><?php echo $check_suhosin_get_max_value_length;?></span>
		*/
		if(extension_loaded('suhosin') && ini_get('suhosin.post.max_value_length')<$check_suhosin_post_max_value_length)
		{
		?>
			<div class="warning" style="	font-family:Verdana, Geneva, sans-serif; font-size:11px;">
			<p><strong>Error: there is a small misconfiguration on your server</strong>.</p>
			
			<p>The Suhosin extension is installed on your server and the current value for <strong>suhosin.post.max_value_length</strong> is <strong><?php echo ini_get('suhosin.post.max_value_length');?></strong>.</p>
			
			<p>These settings are too low to make Contact Form Generator work properly.</p>
			
			<p>You can easily solve this problem by contacting your web hosting technical support and ask them to apply the settings below.
			
			<br/><strong>suhosin.post.max_value_length</strong> : <span style="font-weight:bold; color: #009900;"><?php echo $check_suhosin_post_max_value_length;?></span>
			
			<p><strong>The best solution would be to turn off/disable Suhosin</strong> on the directory where Contact Form Generator is installed</p>
			
			<p>If you need further assistance, don't hesitate to contact us at support@topstudiodev.com,
			<br />we will be glad to help you.</p>
			
			</div>
		<?php
		}
		?>
		
		<div id="formeditor"></div>
		
		<div class="setup" id="gotoformconfiguration-container">
			
			<input type="button" id="gotoformconfiguration" class="cfg-button cfg-button-sidepadding button-blue"  value="Next step: go to form configuration" />
			
		
		</div>
	
	</div><!-- end formeditor-container -->
	
	
	
	<div class="setup" id="formconfiguration" >
		
		
		<h2>Form configuration</h2>
		
		
		<div class="formconfiguration-separator"></div>
		
		
		<div class="formconfiguration-c">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_formname">Form name</label>
			</div>
			
			<div class="formconfiguration-r">
			
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['form_name']) && $json_load_form['forms'][$loaded_form_json_key]['form_name'])
			{
				$config_formname = $json_load_form['forms'][$loaded_form_json_key]['form_name'];
				$config_formid = $json_load_form['forms'][$loaded_form_json_key]['form_id'];
			} else{
				$config_formname = $contactformeditor_obj->config_formname;
				$config_formid = '';
			}
			?>
			<input type="text" name="config_formname" id="config_formname" value="<?php echo htmlentities($config_formname, ENT_QUOTES, 'UTF-8');?>" />
			
			<input type="hidden" name="form_id" id="form_id" value="<?php echo $config_formid;?>" />
			
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		
		<div class="formconfiguration-c">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_email_address">Your email address</label>
			</div>
			
			<div class="formconfiguration-r">
			<?php
			// EMAIL
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_email_address']) && $json_load_form['forms'][$loaded_form_json_key]['config_email_address'])
			{
				$config_email_address = $json_load_form['forms'][$loaded_form_json_key]['config_email_address'];
			} else{
				$config_email_address = $contactformeditor_obj->config_email_address;
			}
			
			// CC
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_email_address_cc']) && $json_load_form['forms'][$loaded_form_json_key]['config_email_address_cc'])
			{
				$config_email_address_cc = '';
				foreach($json_load_form['forms'][$loaded_form_json_key]['config_email_address_cc'] as $emailcc_value)
				{
					$config_email_address_cc .= $emailcc_value['emailaddress'].',';
				}
				$config_email_address_cc = substr($config_email_address_cc, 0, -1);
				
			} else{
				$config_email_address_cc = $contactformeditor_obj->config_email_address_cc;
			}
			
			// BCC
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_email_address_bcc']) && $json_load_form['forms'][$loaded_form_json_key]['config_email_address_bcc'])
			{
				$config_email_address_bcc = '';
				foreach($json_load_form['forms'][$loaded_form_json_key]['config_email_address_bcc'] as $emailbcc_value)
				{
					$config_email_address_bcc .= $emailbcc_value['emailaddress'].',';
				}
				$config_email_address_bcc = substr($config_email_address_bcc, 0, -1);
				
			} else{
				$config_email_address_bcc = $contactformeditor_obj->config_email_address_bcc;
			}
			
			
			// style applied on cc block and bcc block
			$editccbcc_container_style = ''; 
			
			if(!$config_email_address_cc && !$config_email_address_bcc)
			{
				$editccbcc_container_style = 'display:none';
				$addccbccrecipients_style = '';
			} else{
				$addccbccrecipients_style = 'display:none';
			}
			?>
			<input type="text" name="config_email_address" id="config_email_address" value="<?php echo $config_email_address;?>" />
			<p>You will receive your notification messages on this email address</p>
			<p class="editccbcc cfg-addccbccrecipients" style=" <?php echo $addccbccrecipients_style;?>">Add recipients to the notification message (Cc and Bcc)</p>
			<p class="editccbcc cfg-removeccbccrecipients" style=" <?php echo $editccbcc_container_style;?>">Remove Cc and Bcc recipients to the notification message</p>
			</div>
			
			<div class="clear"></div>
			
		</div>
		<script>
		$(function(){
			$('.editccbcc').click(function(){
			   $('.editccbcc-container').slideToggle(60, 
													 			function()
																{
																	if(!$(this).is(':visible'))
																	{	
																		$(this).find('#config_email_address_cc').val('');
																		$(this).find('#config_email_address_bcc').val('');
																		$('.cfg-addccbccrecipients').show();
																		$('.cfg-removeccbccrecipients').hide();
																	} else{
																		$('.cfg-addccbccrecipients').hide();
																		$('.cfg-removeccbccrecipients').show();
																	}
																});
			});
	   });
		</script>
		
		<div class="formconfiguration-c editccbcc-container" style=" <?php echo $editccbcc_container_style;?>">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_email_address_cc">Cc:</label>
			</div>
			
			<div class="formconfiguration-r">
			<input type="text" name="config_email_address_cc" id="config_email_address_cc" value="<?php echo $config_email_address_cc;?>" />
			<p>These recipients will receive a copy of the data collected in the form
			<br />Use commas to separate mutiple e-mail addresses</p>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	
		<div class="formconfiguration-c editccbcc-container" style=" <?php echo $editccbcc_container_style;?>">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_email_address_bcc">Bcc:</label>
			</div>
			
			<div class="formconfiguration-r">
			<input type="text" name="config_email_address_bcc" id="config_email_address_bcc" value="<?php echo $config_email_address_bcc;?>" />
			<p>These recipients will receive a copy of the data collected in the form
			<br />Use commas to separate mutiple e-mail addresses</p>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		
		
		
		
		<div class="formconfiguration-c">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_adminnotification_subject">Notification subject line</label>
			</div>
			
			<div class="formconfiguration-r">
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_adminnotification_subject']) && $json_load_form['forms'][$loaded_form_json_key]['config_adminnotification_subject'])
			{
				$config_adminnotification_subject = $json_load_form['forms'][$loaded_form_json_key]['config_adminnotification_subject'];
			} else{
				$config_adminnotification_subject = $contactformeditor_obj->config_adminnotification_subject;
			}
			?>
			<input type="text" name="config_adminnotification_subject" id="config_adminnotification_subject" value="<?php echo htmlentities($config_adminnotification_subject, ENT_QUOTES, 'UTF-8');?>" />
			
			<!--<p class="editadvancedoptions">Advanced options</p>-->

			</div>
			
			<div class="clear"></div>
			
		</div>
		
		
		<script>
		$(function(){
			$('.editadvancedoptions').click(function(){
			   $('.editadvancedoptions-container').slideToggle('fast', 
													 			function()
																{
																	
																});
			});
	   });
		</script>
		
		<?php
		if($contactform_obj->demo == 1)
		{
			$css_container_timezone = '	display:none;';
		} else{
			$css_container_timezone  = '';
		}
		?>

		<div class="formconfiguration-c " style=" <?php echo $css_container_timezone;?>"><!-- editadvancedoptions-container -->
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_timezone">Timezone</label>
			</div>
			
			<div class="formconfiguration-r">
			<select id="config_timezone">
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_timezone']) && $json_load_form['forms'][$loaded_form_json_key]['config_timezone'])
			{
				$config_timezone = $json_load_form['forms'][$loaded_form_json_key]['config_timezone'];
			} else{
				$config_timezone = '';
			}
			
			foreach(DateTimeZone::listIdentifiers() as $timezone_id)
			{
				$selected_timezone = '';
				
				if($config_timezone == $timezone_id)
				{
				   $selected_timezone = ' selected ';
				} else{
					if(!$config_timezone)
					{
						if($timezone_id == date_default_timezone_get() || $timezone_id == ini_get('date.timezone'))
						{
							$selected_timezone = ' selected ';
						}
					}
				}
				
				echo '<option '.$selected_timezone.' value="'.$timezone_id.'">'.$timezone_id.'</option>';
			}
			?>
			</select>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		
		
		
		
		<script>
		$(function(){
			$('#btn-redirecturl').click(function(){
				$(this).parent().find('.choice-confirmationmessage:eq(1)').removeClass('choice-selected-confirmationmessage');
				$(this).parent().find('.choice-confirmationmessage:eq(0)').addClass('choice-selected-confirmationmessage');
				$('.config-custom-validation').slideUp('fast');
				$('.config-redirecturl').slideDown('fast');
			});
			
			$('#btn-customconfirmationmessage').click(function(){
				$(this).parent().find('.choice-confirmationmessage:eq(0)').removeClass('choice-selected-confirmationmessage');
				$(this).parent().find('.choice-confirmationmessage:eq(1)').addClass('choice-selected-confirmationmessage');
				$('.config-custom-validation').slideDown('fast');
				$('.config-redirecturl').slideUp('fast');
			});
		});
		</script>
		
		<div class="formconfiguration-separator"></div>
		
		<h3>Form validation message</h3>
		
		<div class="formconfiguration-c ">
		
			<div class="formconfiguration-l">
			</div>
			
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_redirecturl']) && $json_load_form['forms'][$loaded_form_json_key]['config_redirecturl'])
			{
				$configredirecturl_radio_yes = ' checked="checked" ';
				$configredirecturl_radio_no = '';
				
				$configredirecturl_container_style = '';
				$configcustomvalidation_container_style = 'display:none';
				
				$configredirecturl_label_yes_class = 'choice-selected-confirmationmessage';
				$configredirecturl_label_no_class = '';
			} else{
				$configredirecturl_radio_yes = '';
				$configredirecturl_radio_no = ' checked="checked" ';
				
				$configredirecturl_container_style = 'display:none';
				$configcustomvalidation_container_style = '';
				
				$configredirecturl_label_yes_class = '';
				$configredirecturl_label_no_class = 'choice-selected-confirmationmessage';
			}

			?>
			
			<div class="formconfiguration-r">
			<input type="radio" <?php echo $configredirecturl_radio_yes;?> id="btn-redirecturl" name="radio-config-redirecturl" />
			<label for="btn-redirecturl"><span class="choice-confirmationmessage <?php echo $configredirecturl_label_yes_class;?>">Redirect the user to a specific url after he submits the form</span></label>
			<br />
			<input type="radio" <?php echo $configredirecturl_radio_no;?> id="btn-customconfirmationmessage" name="radio-config-redirecturl" />
			<label for="btn-customconfirmationmessage"><span class="choice-confirmationmessage <?php echo $configredirecturl_label_no_class;?>">Show the confirmation message in the form page</span></label>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		<div class="formconfiguration-c config-redirecturl" style=" <?php echo $configredirecturl_container_style;?>">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_redirecturl">URL</label>
			</div>
			
			<div class="formconfiguration-r">
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_redirecturl']) && $json_load_form['forms'][$loaded_form_json_key]['config_redirecturl'])
			{
				$config_redirecturl = $json_load_form['forms'][$loaded_form_json_key]['config_redirecturl'];
			} else{
				$config_redirecturl = '';
			}
			?>
			<input type="text" name="config_redirecturl" id="config_redirecturl" value="<?php echo htmlentities($config_redirecturl, ENT_QUOTES, 'UTF-8');?>" />
			<p>The user will be redirected to this URL after he submits the form
			<br />(don't forget to add the "http://" prefix)</p>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		
		<div class="formconfiguration-c config-custom-validation" style=" <?php echo $configcustomvalidation_container_style;?>">
		
			<div class="formconfiguration-l">
			<label class="label-formconfiguration" for="config_validationmessage">Message</label>
			</div>
			
			<div class="formconfiguration-r">
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['config_validationmessage']) && $json_load_form['forms'][$loaded_form_json_key]['config_validationmessage'])
			{
				$config_validationmessage = $json_load_form['forms'][$loaded_form_json_key]['config_validationmessage'];
			} else{
				$config_validationmessage = $contactformeditor_obj->config_validationmessage;
			}
			?>
			<textarea name="config_validationmessage" id="config_validationmessage" rows="2" cols="40"><?php echo $config_validationmessage;?></textarea>
			<p>This message will appear at the top of the form after the user submits the form</p>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		
		
		<script>
		$(function(){
			$('.othercolors').click(function(){
				$(this).closest('.formconfiguration-r').find('.messagecolor-container').slideToggle(100);
			});
	   });
		</script>
		<div class="formconfiguration-c config-custom-validation">
		
			<div class="formconfiguration-l">
			<label  class="label-formconfiguration">Message color</label>
			</div>
			
			<div class="formconfiguration-r">
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['validationmessage_style']['css']['default']) && $json_load_form['forms'][$loaded_form_json_key]['validationmessage_style']['css']['default'])
			{
				$default_message_color = $json_load_form['forms'][$loaded_form_json_key]['validationmessage_style'];
			} else{
				$default_message_color = '';
			}
			$contactformeditor_obj->editMessageColor('validation', $default_message_color);
			
			?>
			</div><!-- formconfiguration-r -->
			
			<div class="clear"></div>
			
		</div>
		
		
		<div id="config-errormessages-container" style="display:none">
		<div class="formconfiguration-separator"></div>
		
		<h3>Form error message</h3>
		
		<div id="config-erroremail-container" style="display:none">
			<div class="formconfiguration-c">
			
				<div class="formconfiguration-l">
				<label  class="label-formconfiguration" for="config_errormessage_invalidemailaddress">Invalid email address</label>
				</div>
				
				<div class="formconfiguration-r">
				<?php
				if(isset($json_load_form['forms'][$loaded_form_json_key]['config_errormessage_invalidemailaddress']) && $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_invalidemailaddress'])
				{
					$config_errormessage_invalidemailaddress = $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_invalidemailaddress'];
				} else{
					$config_errormessage_invalidemailaddress = $contactformeditor_obj->config_errormessage_invalidemailaddress;
				}
				?>
				<input type="text" name="config_errormessage_invalidemailaddress" id="config_errormessage_invalidemailaddress" value="<?php echo htmlentities($config_errormessage_invalidemailaddress, ENT_QUOTES, 'UTF-8');?>" />
				</div>
				<div class="clear"></div>
				
			</div>
		</div>
		
		
		<div id="config-errorempty-container" style="display:none">
			<div class="formconfiguration-c">
			
				<div class="formconfiguration-l">
				<label  class="label-formconfiguration" for="config_errormessage_emptyfield">Empty fields</label>
				</div>
				
				<div class="formconfiguration-r">
				<?php
				if(isset($json_load_form['forms'][$loaded_form_json_key]['config_errormessage_emptyfield']) && $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_emptyfield'])
				{
					$config_errormessage_emptyfield = $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_emptyfield'];
				} else{
					$config_errormessage_emptyfield = $contactformeditor_obj->config_errormessage_emptyfield;
				}
				?>
				<input type="text" name="config_errormessage_emptyfield" id="config_errormessage_emptyfield" value="<?php echo htmlentities($config_errormessage_emptyfield, ENT_QUOTES, 'UTF-8');?>" />		
				</div>
				<div class="clear"></div>
			
			</div>
		</div>
		
		
		<div id="config-errorcaptcha-container" style="display:none">
		
			<div class="formconfiguration-c">
			
				<div class="formconfiguration-l">
				<label  class="label-formconfiguration" for="config_errormessage_captcha">Wrong captcha</label>
				</div>
				
				<div class="formconfiguration-r">
				<?php
				if(isset($json_load_form['forms'][$loaded_form_json_key]['config_errormessage_captcha']) && $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_captcha'])
				{
					$config_errormessage_captcha = $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_captcha'];
				} else{
					$config_errormessage_captcha = $contactformeditor_obj->config_errormessage_captcha;
				}
				?>
				<input type="text" name="config_errormessage_captcha" id="config_errormessage_captcha" value="<?php echo htmlentities($config_errormessage_captcha, ENT_QUOTES, 'UTF-8');?>" />
				</div>
				<div class="clear"></div>
				
			</div>
			
		</div>
		
		
		<div id="config-errorupload-container" style="display:none">
			<div class="formconfiguration-c">
			
				<div class="formconfiguration-l">
				<label  class="label-formconfiguration" for="config_errormessage_uploadfileistoobig">Upload : file exceeds size limit</label>
				</div>
				
				<div class="formconfiguration-r">
				<?php
				if(isset($json_load_form['forms'][$loaded_form_json_key]['config_errormessage_uploadfileistoobig']) && $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_uploadfileistoobig'])
				{
					$config_errormessage_uploadfileistoobig = $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_uploadfileistoobig'];
				} else{
					$config_errormessage_uploadfileistoobig = $contactformeditor_obj->config_errormessage_uploadfileistoobig;
				}
				?>
				<input type="text" name="config_errormessage_uploadfileistoobig" id="config_errormessage_uploadfileistoobig" value="<?php echo htmlentities($config_errormessage_uploadfileistoobig, ENT_QUOTES, 'UTF-8');?>" />		
				</div>
				<div class="clear"></div>
			
			</div>
			
			
			<div class="formconfiguration-c">
			
				<div class="formconfiguration-l">
				<label  class="label-formconfiguration" for="config_errormessage_uploadinvalidfiletype">Upload : invalid file type</label>
				</div>
				
				<div class="formconfiguration-r">
				<?php
				if(isset($json_load_form['forms'][$loaded_form_json_key]['config_errormessage_uploadinvalidfiletype']) && $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_uploadinvalidfiletype'])
				{
					$config_errormessage_uploadinvalidfiletype = $json_load_form['forms'][$loaded_form_json_key]['config_errormessage_uploadinvalidfiletype'];
				} else{
					$config_errormessage_uploadinvalidfiletype = $contactformeditor_obj->config_errormessage_uploadinvalidfiletype;
				}
				?>
				<input type="text" name="config_errormessage_uploadinvalidfiletype" id="config_errormessage_uploadinvalidfiletype" value="<?php echo htmlentities($config_errormessage_uploadinvalidfiletype, ENT_QUOTES, 'UTF-8');?>" />		
				</div>
				<div class="clear"></div>
			
			</div>
		</div>
		
		<div class="formconfiguration-c">
		
			<div class="formconfiguration-l">
			<label  class="label-formconfiguration" >Message color</label>
			</div>
			
			<div class="formconfiguration-r">
			<?php
			if(isset($json_load_form['forms'][$loaded_form_json_key]['errormessage_style']['css']['default']) && $json_load_form['forms'][$loaded_form_json_key]['errormessage_style']['css']['default'])
			{
				$default_message_color = $json_load_form['forms'][$loaded_form_json_key]['errormessage_style'];
			} else{
				$default_message_color = '';
			}
			$contactformeditor_obj->editMessageColor('error', $default_message_color);
			
			?>
			</div><!-- formconfiguration-r -->
			<div class="clear"></div>

		</div>
		
		</div><!-- config-errormessages-container -->
		
		<div class="formconfiguration-separator"></div>
		
		
		<h3>Delivery Receipt</h3>
		
		<?php
		if(isset($json_load_form['forms'][$loaded_form_json_key]['config_usernotification_activate']) && $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_activate'])
		{
			$config_usernotification_activate_checked = ' checked="checked" ';
			$deliveryreceiptconfiguration_container_style = '';			
		} else{
			$config_usernotification_activate_checked = '';
			$deliveryreceiptconfiguration_container_style = 'display:none';
		}
		?>
		
		<div class="formconfiguration-c">
		
			<div class="formconfiguration-l">
			</div>
			
			<div class="formconfiguration-r">
				<p style="font-family:Arial, Helvetica, sans-serif; color:#000; font-style:normal;">
				<input type="checkbox" name="config_usernotification_activate" id="config_usernotification_activate" value="" <?php echo $config_usernotification_activate_checked;?> /> <label for="config_usernotification_activate">Activate delivery receipt: notify the user by email that his message has been sent to you</label>
				</p>
			</div>
					
			<div class="clear"></div>
		</div>
		
		
		<div id="deliveryreceiptconfiguration" style=" <?php echo $deliveryreceiptconfiguration_container_style?>">
				
				<!-- FORM DATA COPY IN THE USER NOTIFICATION -->
				<div class="formconfiguration-c">
				
					<div class="formconfiguration-l">
					</div>
					
					<div class="formconfiguration-r">
						<?php
						if(isset($json_load_form['forms'][$loaded_form_json_key]['config_usernotification_insertformdata']) && $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_insertformdata'])
						{
							$config_usernotification_insertformdata_checked = ' checked="checked" ';
						} else{
							$config_usernotification_insertformdata_checked = '';
						}
						?>
						<p style="font-family:Arial, Helvetica, sans-serif; color:#000; font-style:normal;">
						<input type="checkbox" name="config_usernotification_insertformdata" id="config_usernotification_insertformdata" value="" <?php echo $config_usernotification_insertformdata_checked;?> /> <label for="config_usernotification_insertformdata">Insert a copy of the form data in the user notification message</label>
						</p>
					</div>
					
					<div class="clear"></div>
					
				</div>
				
				<div class="formconfiguration-c">
				
					<div class="formconfiguration-l">
					<label  class="label-formconfiguration" for="config_emailaddress">Recipient's email</label>
					</div>
					
					<div class="formconfiguration-r">
					<div id="notificationemailaddress"></div>
					<p>The notification message will be sent to the email address put in this field</p>
					</div>
					<div class="clear"></div>
					
				</div>
		
				<div class="formconfiguration-c">
				
					<div class="formconfiguration-l">
					<label class="label-formconfiguration" for="config_email_from">Name in the inbox "From" field</label>
					</div>
					
					<div class="formconfiguration-r">
					<?php
					if(isset($json_load_form['forms'][$loaded_form_json_key]['config_email_from']) && $json_load_form['forms'][$loaded_form_json_key]['config_email_from'])
					{
						$config_email_from = $json_load_form['forms'][$loaded_form_json_key]['config_email_from'];
					} else{
						$config_email_from = $contactformeditor_obj->config_email_from;
					}
					?>
					<input type="text" name="config_email_from" id="config_email_from" value="<?php echo htmlentities($config_email_from, ENT_QUOTES, 'UTF-8');?>" />
					<p>This is the name that will be displayed in the user's inbox "From" field<br />If left blank, your email address will be displayed instead</p>
					</div>
					
					<div class="clear"></div>
					
				</div>
			
			
				<div class="formconfiguration-c">
				
					<div class="formconfiguration-l">
					<label  class="label-formconfiguration">Notification message format</label>
					</div>
					
					<div class="formconfiguration-r">
					<?php
					
					$notification_format_list = array(array('format_name'=>'Plain Text', 'format_value'=>'plaintext'), 
																array('format_name'=>'HTML', 'format_value'=>'html')
																);
					
					if(isset($json_load_form['forms'][$loaded_form_json_key]['config_usernotification_format']) && $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_format'])
					{
						$default_notification_format_list = $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_format'];
					} else{
						$default_notification_format_list = 'plaintext';
					}

					
					foreach($notification_format_list as $notification_format_list)
					{
						if($default_notification_format_list == $notification_format_list['format_value'])
						{
							${'checked_notification_format_'.$notification_format_list['format_value']} = ' checked="checked" ';
						} else{
							${'checked_notification_format_'.$notification_format_list['format_value']} = '';
						}
						?>
						
						<input type="radio" name="config_usernotification_format" id="config_usernotification_format_<?php echo $notification_format_list['format_value'];?>" value="<?php echo $notification_format_list['format_value'];?>" <?php echo ${'checked_notification_format_'.$notification_format_list['format_value']};?> />
						<label  for="config_usernotification_format_<?php echo $notification_format_list['format_value'];?>"><?php echo $notification_format_list['format_name'];?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
					}
					?>
					</div>
					<div class="clear"></div>
					
				</div>
			
			
				<div class="formconfiguration-c">
				
					<div class="formconfiguration-l">
					<label  class="label-formconfiguration" for="config_usernotification_subject">Notification subject line</label>
					</div>
					
					<div class="formconfiguration-r">
					<?php
					if(isset($json_load_form['forms'][$loaded_form_json_key]['config_usernotification_subject']) && $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_subject'])
					{
						$config_usernotification_subject = $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_subject'];
					} else{
						$config_usernotification_subject = $contactformeditor_obj->config_usernotification_subject;
					}
					?>
					<input type="text" name="config_usernotification_subject" id="config_usernotification_subject" value="<?php echo htmlentities($config_usernotification_subject, ENT_QUOTES, 'UTF-8');?>" />
					</div>
					<div class="clear"></div>
					
				</div>
				
			
				<div class="formconfiguration-c">
				
					<div class="formconfiguration-l">
					<label  class="label-formconfiguration" for="config_usernotification_message">Notification message</label>
					</div>
					
					<div class="formconfiguration-r">
					<?php
					if(isset($json_load_form['forms'][$loaded_form_json_key]['config_usernotification_message']) && $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_message'])
					{
						$config_usernotification_message = $json_load_form['forms'][$loaded_form_json_key]['config_usernotification_message'];
					} else{
						$config_usernotification_message = $contactformeditor_obj->config_usernotification_message;
					}
					?>
					<textarea name="config_usernotification_message" id="config_usernotification_message" rows="4" cols="40"><?php echo $config_usernotification_message;?></textarea>
					</div>
					<div class="clear"></div>
					
				</div>
			
		</div><!-- end deliveryreceiptconfiguration -->
		
		
		<h2>Ready? Create your form!</h2>
	
		
		<div id="downloadsources"></div>
		
		<div>
		<span id="savinginprogress" class="button-position">Creating source files</span>
		<span  id="saveform" class="cfg-button button-blue button-position">Save and create source files</span><span  id="returntoformedition" class="cfg-button button-position button-grey">Return to the form</span>
		</div>
		
		
	
	
	</div>

	
	
	

	</div><!-- end formfields-editor -->
	
	<div class="clear"></div>
	
	
</div><!-- end formfields -->


<div id="cfg-dialog-message" title="" style="display:none"></div><!-- show  confirmation and error messages in a jquery dialog box -->

<div id="dialog-changepassword" title="" style="display:none">
	<style type="text/css">
	.label-user{
		font-size:14px;
	}
	.input-user{
		width:160px;
	}
	.user-error, .user-validation{
		padding:4px;
		font-size:11px;
		display:none;
	}
	.user-error p, .user-validation p{
		margin:2px 0;
		line-height:20px;
	}
	</style>
	
	
	<div class="user-error"></div>
	<div class="user-validation"></div>
	
	<label for="user-login" class="label-user">Username</label>
	<input type="text" id="user-login" name="user-login" class="input-user" value="<?php echo htmlentities($_SESSION['user'], ENT_QUOTES, 'UTF-8');?>" />
	
	<label for="user-password-1"  class="label-user">New Password</label>
	<input type="password" id="user-password-1" name="user-password-1" class="input-user" />
						
	<label for="user-password-2"  class="label-user">Re-type New Password</label>
	<input type="password" id="user-password-2" name="user-password-2" class="input-user" />
	
	<img id="loading-changepassword" src="img/loading.gif" style="display:none" />
	<input type="submit" value="Change Password" class="cfg-button button-blue" id="submit-changepassword" />
	
	<div class="clear"></div>

</div><!-- show change password form -->





<?php
if($contactform_obj->demo != 1)
{
	?>

	<div id="footer">
	<p><span class="footer-section">Get The Latest Updates:</span> <a href="http://www.topstudiodev.com" target="_blank">Subscribe to the mailing list to be notified of the next update</a></p>
	<p><span class="footer-section">Contact Form Generator:</span> <a href="http://codecanyon.net/item/contact-form-generator/1719810" target="_blank">Download the latest version available on Code Canyon</a></p>
	<p><span class="footer-section">Help And Support:</span> <a href="mailto:support@topstudiodev.com">support@topstudiodev.com</a></p>
	<p><span class="footer-section">Top Studio Website:</span> <a href="http://www.topstudiodev.com" target="_blank">TopStudioDev.com</a></p>
	</div>
	<?php
}
?>

<div id="copyright">© <?php echo @date('Y');?> <a href="http://www.topstudiodev.com" target="_blank">Top Studio</a></div>



</body>
</html>