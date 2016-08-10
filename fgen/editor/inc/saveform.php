<?php
/**********************************************************************************
 * Contact Form Generator is (c) Top Studio
 * It is strictly forbidden to use or copy all or part of an element other than for your 
 * own personal and private use without prior written consent from Top Studio http://topstudiodev.com
 * Copies or reproductions are strictly reserved for the private use of the person 
 * making the copy and not intended for a collective use.
 *********************************************************************************/

session_start(); // for authentication and for "PHPSESSID" : "'.session_id().'" in buildUploadJsFunction

require_once('../class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

require_once('../sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');
$contactform_obj = new contactForm($cfg=array());



/**************************************************************************************
 * ERROR: WRITABLE JSON INDEX FILE
 */
if($contactform_obj->demo != 1)
{
	/**************************************************************************************
	 * Write the json index file if it's missing
	 */
	if(!is_file('../contactform-download/'.$contactformeditor_obj->forms_index_filename))
	{
		
		$fp = fopen('../contactform-download/'.$contactformeditor_obj->forms_index_filename, 'w+');
				
		fwrite($fp, $contactformeditor_obj->reset_json_index_content);
				
		fclose($fp);
	}
	
	if(!is_writable('../contactform-download/'.$contactformeditor_obj->forms_index_filename))
	{
		echo '{"response":"nok",'
				.' "response_msg":"'.$contactformeditor_obj->error_not_writable_form_index_file.'"'
				.'}';
		exit;
	}
}


/**************************************************************************************
 * ERROR: WRITABLE contactform-download DIR
 */

if(!is_writable('../contactform-download'))
{
	@chmod('../contactform-download', 0755);
	
	if(!is_writable('../contactform-download'))
	{
		@chmod('../contactform-download', 0777);
		
		if(!is_writable('../contactform-download'))
		{
			echo '{"response":"nok",'
						.' "response_msg":"'.$contactformeditor_obj->error_not_writable_dir_form_download.'"'
						.'}';
			exit;
		}
	}
}

function ts_ex(){exit;} ; function ts_login(){exit;}

/************************* SOFTWARE VERSION / EXPORT VERSION ************************************************/
$json_export_decode['software_version'] = $contactformeditor_obj->version;
$json_export_decode['export_version'] = $contactformeditor_obj->export_version;
$json_export_decode['date'] = time();

$json_export_decode = array_merge($json_export_decode, 
								  					json_decode($contactformeditor_obj->quote_smart($_POST['json_export']), true)
													);

$post_form_id = $json_export_decode['form_id']; // only needed for the last test to update the json tree

// AUTHENTICATION
if($contactform_obj->demo != 1)
{
	if(isset($json_export_decode['config_email_address']))
	{
	
		if(isset($_COOKIE['user']) && $_COOKIE['user'])
		{
			if(file_exists('../inc/user.php'))
			{
				require_once('../inc/user.php');
			}
			
			if( isset($user['login']) && $user['login'] && isset($user['password']) && $user['password'] )
			{
				$auth_exp = explode('*',$_COOKIE['user']);
				
				$cookie_login = $auth_exp[0];
				$cookie_password = $auth_exp[1];
				
					
				// VERIFY LOGIN AND PASSWORD
				if($cookie_login && $cookie_login == $user['login'] && $cookie_password && $cookie_password == $user['password'])
				{
					$_SESSION['user'] = $user['login'];
				}
			}
		}
		
		// no session['user'] after cookie check?
		if(!isset($_SESSION['user']) || !$_SESSION['user'])
		{
			echo '{"response":"nok",'
						.' "response_msg":"Your form can\'t be created: your session has expired due to an extended period of inactivity.'
													.'<br /><br/><strong>Your server automatically stops sessions after '.ceil(ini_get('session.gc_maxlifetime')/60).' minutes of inactivity</strong>.'
													.'<br /><br/>If you want unlimited session time, click on the \"remember me\" checkbox when you log in.'
													.'"'
						.'}';
			exit;
		}
	
	} 
	else{
		$contactformeditor_obj->authentication(true);
	}
}


// UPDATE JSON STRING : insert form_id into element's id attribute => cfg-element-1-1
$json_form_index = $contactformeditor_obj->loadFormIndex();
$loaded_form_json_key = '';
$form_id = '';
$captcha_session_unique_id = sha1(microtime());

if($contactform_obj->demo != 1)
{
	if(!$json_export_decode['form_id'])
	{
		// getting the max id
		$form_index_ids = array();
		foreach($json_form_index['forms'] as $form_key=>$form_value)
		{
			$form_index_ids[] = $form_value['form_id'];
		}
		
		// to prevent Warning: max() [<a href='function.max'>function.max</a>]: Array must contain at least one element
		if($form_index_ids)
		{
			$form_id = max($form_index_ids)+1; // <=============== FORM_ID
		} else{
			$form_id = 1; // <================================ FORM_ID
		}
		
		// print_r($json_form_index); print_r($form_index_ids); echo $form_id; exit;
		
	} else{
	
		$form_id = $json_export_decode['form_id']; // <========= FORM_ID (must be put before foreach: del from A save from B, that way $form_id always returns something even if form_id is not in the forms index)
		
		foreach($json_form_index['forms'] as $form_key=>$form_value)
		{
			if($form_value['form_id'] == $json_export_decode['form_id'])
			{
				$form_to_delete = $form_value['form_dir'];
				
				$loaded_form_json_key = $form_key;
			}
		}
	}
}

$json_export_decode['form_id'] = ''.$form_id.''; 
// ^-- to prevent "form_id":"" in the json tree when inserting a new form
// ^-- ''..'' : without the quotes, when creating a new form json_encode returns  "form_id":1 instead of "form_id":"1"



$html_form = '';

if(trim($json_export_decode['form_name']))
{
	$dir_form_name = trim($json_export_decode['form_name']);
}


if($contactform_obj->demo == 1)
{	
	$dir_form_name = 'contactform_'.@date('Ymd_His').'_'.sha1($_SERVER['REMOTE_ADDR'].microtime());
}


/**************************************************************************************
 * ERROR: CONFIG EMAIL FROM NAME
 * HostMonster: Our servers will not accept the name for the email address and the email address to be the same
 */
if(@stristr($contactformeditor_obj->quote_smart($json_export_decode['config_email_from']), '@'))
{
	echo '{"response":"nok",'
			.' "response_msg":"Remove the character \"@\" in the \"From\" field of the delivery receipt section."'
			.'}';
	exit;
}


/**************************************************************************************
 * ERROR: CONFIG EMAIL ADRESS
 */
$json_export_decode['config_email_address'] = trim($json_export_decode['config_email_address']);
if(  !$contactformeditor_obj->isEmail( $contactformeditor_obj->quote_smart($json_export_decode['config_email_address']) )  )
{
	echo '{"response":"nok",'
			.' "response_msg":"Your email address is invalid.<br/><br/>You must indicate a valid email address in order to receive the messages sent with this contact form."'
			.'}';
	exit;
}

/**************************************************************************************
 * ERROR: CONFIG EMAIL ADRESS CC
 */
$cc_semicolon = '';
if(isset($json_export_decode['config_email_address_cc']) && $json_export_decode['config_email_address_cc'])
{
	//$explode_email = explode(',', $contactformeditor_obj->quote_smart($json_export_decode['config_email_address_cc']));
	
	
	foreach($json_export_decode['config_email_address_cc'] as $email_value)
	{
		$email_value = trim($email_value['emailaddress']);
		
		if($email_value)
		{
			$cc_semicolon .= $email_value.',';
			
			if(  !$contactformeditor_obj->isEmail( $contactformeditor_obj->quote_smart($email_value) )  )
			{
				echo '{"response":"nok",'
						.' "response_msg":"There is an invalid email address in the  \"Cc:\" field.<br/><br/>Don\'t forget to use commas as a separator if you indicate multiple email addresses."'
						.'}';
				exit;
			}
		}
	}
	
	$cc_semicolon = substr($cc_semicolon, 0, -1);
}


/**************************************************************************************
 * ERROR: CONFIG EMAIL ADRESS BCC
 */
$bcc_semicolon = '';
if(isset($json_export_decode['config_email_address_bcc']) && $json_export_decode['config_email_address_bcc'])
{
	//$explode_email = explode(',', $contactformeditor_obj->quote_smart($json_export_decode['config_email_address_bcc']));
	
	
	foreach($json_export_decode['config_email_address_bcc'] as $email_value)
	{
		$email_value = trim($email_value['emailaddress']);
		
		if($email_value)
		{
			$bcc_semicolon .= $email_value.',';
			
			if(  !$contactformeditor_obj->isEmail( $contactformeditor_obj->quote_smart($email_value) )  )
			{
				echo '{"response":"nok",'
						.' "response_msg":"There is an invalid email address in the  \"Bcc:\" field.<br/><br/>Don\'t forget to use commas as a separator if you indicate multiple email addresses."'
						.'}';
				exit;
			}
		}
	}
	
	$bcc_semicolon = substr($bcc_semicolon, 0, -1);
}


/**************************************************************************************
 * ERROR: FORM NAME
 */
if(trim($json_export_decode['form_name']))
{
	if(!preg_match($contactformeditor_obj->regex_pattern_formname, trim($json_export_decode['form_name'])))
	{
		echo '{"response":"nok",'
				.' "response_msg":"<p>Only alphanumeric characters are authorized in the form name.</p>"'
				.'}';
		exit;
	}

}

if(!trim($json_export_decode['form_name']))
{
	echo '{"response":"nok",'
			.' "response_msg":"<p>The form name can\'t be left empty.</p>"'
			.'}';
	exit;

}
${'t'.'s'.'_'.'c'.'o'.'n'.'t'.'r'.'o'.'l'} = 't'.'s'.'_'.'e'.'x';

/**************************************************************************************
 * ERROR: REDIRECT URL
 */
if(isset($json_export_decode['config_redirecturl']) && trim($json_export_decode['config_redirecturl']))
{

	$cfg_redirecturl = trim($json_export_decode['config_redirecturl']);
	
	$pattern_url = '_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?$_iuS';

	if( !preg_match($pattern_url, $cfg_redirecturl) )
	{
		echo '{"response":"nok",'
				.' "response_msg":"<p>The URL provided for the confirmation page is not a valid URL.</p><p>Don\'t forget to add the \"http://\" prefix.</p>"'
				.'}';
		exit;
	}
	
} else{
	$cfg_redirecturl = '';
}


/**************************************************************************************
 * EVERYTHING IS OK: BUILD THE FOLDER NAME / DELETE PREVIOUS VERSION OF THE FORM
 */

$dir_form_name = preg_replace('/'.$contactformeditor_obj->regex_replace_formname_pattern.'/', $contactformeditor_obj->regex_replace_formname_replacement, $dir_form_name);

// remove duplicate dashes
$dir_form_name = preg_replace("/-+/", '-', $dir_form_name);

if(${'c'.'o'.'n'.'t'.'a'.'c'.'t'.'f'.'o'.'r'.'m'.'_'.'o'.'b'.'j'}->{'d'.'e'.'m'.'o'} != (23/23)){if(sha1(trim(${'_'.'P'.'O'.'S'.'T'}['c'.'f'.'_'.'f'])) != ${'c'.'o'.'n'.'t'.'a'.'c'.'t'.'f'.'o'.'r'.'m'.'e'.'d'.'i'.'t'.'o'.'r'.'_'.'o'.'b'.'j'}->{'c'.'r'.'_'.'s'.'h'.'a'.'1'})	{$ts_control();}}
	
// remove the last dash
$dir_form_name = preg_replace("/-$/",'',$dir_form_name);



if($contactform_obj->demo != 1)
{
	
	if($json_export_decode['form_id'])
	{
		if(isset($form_to_delete) && $form_to_delete && file_exists('../contactform-download/'.$form_to_delete))
		{
			$contactformeditor_obj->rrmdir('../contactform-download/'.$form_to_delete);
			
			if(is_dir('../contactform-download/'.$form_to_delete))
			{
				echo '{"response":"nok",'
						.' "response_msg":"'.$contactformeditor_obj->errorNotWritableDirForm($form_to_delete).'"'
						.'}';
				exit;
			}
		}
	}
	
	$dir_form_name = $dir_form_name.'-'.$form_id;
	
} else{
	$form_id = 1; // default value needed, json response returned at the end of the file
}

$json_export_decode['form_dir'] = $dir_form_name;


$dir_form_copy_dest = '../'.$contactformeditor_obj->dir_form_download.'/'.$dir_form_name;

$zip_file_name = $dir_form_name.'.zip';

$html_form_container_id = $contactformeditor_obj->formIncDirName($form_id); // used as a replacement string in contactform.js


/**************************************************************************************
 * EDITING JSON ARRAY : element ids, etc.
 *
 */


function formatUploadButtonHtmlId($post_id)
{
	global $contactformeditor_obj, $form_id;
	return $contactformeditor_obj->uploadbutton_prefix.str_replace('-', '_', $contactformeditor_obj->element_name_prefix).$form_id.'_'.$post_id;
}

/************************* element ************************************************/
foreach($json_export_decode['element'] as $key=>$value)
{
	$json_export_decode['element'][$key]['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value['id']));
	
	if(isset($value['paragraph']) && $value['paragraph'])
	{
		$json_export_decode['element'][$key]['paragraph']['id'] = $json_export_decode['element'][$key]['id'].$contactformeditor_obj->paragraph_suffix;
	}
	
	if(isset($value['label']) && $value['label'])
	{
		$json_export_decode['element'][$key]['label']['id'] = $contactformeditor_obj->buildElementLabelId($json_export_decode['element'][$key]['id']);
	}
	
	if(isset($value['container']) && $value['container'])
	{
		$json_export_decode['element'][$key]['container']['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value['id'])).$contactformeditor_obj->elementset_suffix;
	}
	
	if($value['type'] == 'captcha')
	{
		$json_export_decode['element'][$key]['form_dir'] = $json_export_decode['form_dir'];
		$json_export_decode['element'][$key]['form_inc_dir'] = $contactformeditor_obj->formIncDirName($form_id);
	}
	
	if(isset($value['filename']) && $value['filename'])
	{
		$json_export_decode['element'][$key]['form_dir'] = $json_export_decode['form_dir'];
		$json_export_decode['element'][$key]['form_inc_dir'] = $contactformeditor_obj->formIncDirName($form_id);
	}
	
	if(isset($value['btn_upload_id']) && $value['btn_upload_id'])
	{
		$json_export_decode['element'][$key]['btn_upload_id'] = formatUploadButtonHtmlId($value['id']);
	}
	
	if(isset($value['option']['set']) && $value['option']['set'])
	{
		foreach($value['option']['set'] as $optionproperties_k => $optionproperties_v)
		{
			$json_export_decode['element'][$key]['option']['set'][$optionproperties_k]['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$optionproperties_v['id']));
		}
	}
	
	if(isset($value['option']['container']) && $value['option']['container'])
	{
		$json_export_decode['element'][$key]['option']['container']['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value['id'])).$contactformeditor_obj->optioncontent_suffix;
		
	}
	
}

/************************* formvalidation_email ************************************************/
foreach($json_export_decode['formvalidation_email'] as $key=>$value)
{
	$json_export_decode['formvalidation_email'][$key] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value));
}

/************************* formvalidation_required ************************************************/
foreach($json_export_decode['formvalidation_required'] as $key=>$value)
{
	$json_export_decode['formvalidation_required'][$key] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value));
}

/************************* datepicker ************************************************/
foreach($json_export_decode['datepicker'] as $key=>$value)
{
	$json_export_decode['datepicker'][$key]['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value['id']));
}

/************************* upload ************************************************/
foreach($json_export_decode['upload'] as $key=>$value)
{
	$json_export_decode['upload'][$key]['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$value['id']));
	
	// element_name_prefix: cfg-element-
	$json_export_decode['upload'][$key]['btn_upload_id'] = formatUploadButtonHtmlId($value['id']);
}

/************************* captcha ************************************************/
if(isset($json_export_decode['captcha']['id']) && $json_export_decode['captcha']['id'])
{
	$json_export_decode['captcha']['id'] = $contactformeditor_obj->formatElementHtmlId(array('form_id'=>$form_id, 'target_id'=>$json_export_decode['captcha']['id']));
	$json_export_decode['captcha']['elementlabel_id'] = $contactformeditor_obj->buildElementLabelId($json_export_decode['captcha']['id']);
}

// print_r($json_export_decode);

/**************************************************************************************
 * CONFIG : ERROR MESSAGE UPLOAD
 * variables written in contactform.js
 */
if(isset($json_export_decode['config_errormessage_uploadfileistoobig']) && trim($json_export_decode['config_errormessage_uploadfileistoobig']))
{
	$swfupload_js_var['cfg_formerrormessage_uploadfileistoobig'] = trim($json_export_decode['config_errormessage_uploadfileistoobig']);
} else{
	$swfupload_js_var['cfg_formerrormessage_uploadfileistoobig'] = '';
}

if(isset($json_export_decode['config_errormessage_uploadinvalidfiletype']) && trim($json_export_decode['config_errormessage_uploadinvalidfiletype']))
{
	$swfupload_js_var['cfg_formerrormessage_uploadinvalidfiletype'] = trim($json_export_decode['config_errormessage_uploadinvalidfiletype']);
} else{
	$swfupload_js_var['cfg_formerrormessage_uploadinvalidfiletype'] = '';
}


/**************************************************************************************
 * CONFIG : VARIABLES FOR FORM CONFIG FILE
 * variables written in contactform.config.php
 */

// the message must stands on 1 single line in the javascript code, nl2br automatically adds line breaks
if(isset($json_export_decode['config_validationmessage']) && trim($json_export_decode['config_validationmessage']))
{
	$cfg_validationmessage = preg_replace("/(\r\n|\n|\r)/", "", nl2br(addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_validationmessage'])), "'" ) ) );
} else{
	$cfg_validationmessage = '';
}


// the control must be done on config_usernotification_activate: usernotification_inputid can have a value even if config_usernotification_activate is unchecked
// usernotification_inputid value is assigned when clicking on "go to configuration"
$json_export_decode['config_usernotification_activate'] = isset($json_export_decode['config_usernotification_activate'])?$json_export_decode['config_usernotification_activate']:'';
$json_export_decode['config_usernotification_inputid'] = isset($json_export_decode['config_usernotification_inputid'])?$json_export_decode['config_usernotification_inputid']:'';
if($json_export_decode['config_usernotification_activate'] && $json_export_decode['config_usernotification_inputid'])
{

	$cfg_usernotification_format = addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_usernotification_format'])), "'");
	
	$cfg_usernotification_subject = addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_usernotification_subject'])), "'");
	
	$cfg_emailnotificationmessage = preg_replace("/(\r\n|\n|\r)/", "", nl2br(addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_usernotification_message'])), "'" ) ) );
	
	$cfg_emailnotificationinputid = $contactformeditor_obj->element_name_prefix.$form_id.'-'.trim($json_export_decode['config_usernotification_inputid']);
	/* ^-- can't have the name $post_form and not $usernotification_inputid
	 * if register globals is ON, a value would be assigned on $cfg['usernotification_inputid'] in $cfg[\'usernotification_inputid\'] = \''.$post_usernotification_inputid
	 * it would cause the send of a notification receipt to the user sending the form even if the notification checkbox is unchecked
	 * the send of the notification is based on if($contactform_obj->cfg['usernotification_inputid']) in form-validation.php
	 */
	
}

if(isset($json_export_decode['config_usernotification_insertformdata']) && $contactformeditor_obj->quote_smart(trim($json_export_decode['config_usernotification_insertformdata'])))
{
	$cfg_usernotification_insertformdata = 1;
} else{
	$cfg_usernotification_insertformdata = '\'\'';
}

$cfg_usernotification_subject = isset($cfg_usernotification_subject)?$cfg_usernotification_subject:'';
$cfg_emailnotificationmessage = isset($cfg_emailnotificationmessage)?$cfg_emailnotificationmessage:'';
$cfg_emailnotificationinputid = isset($cfg_emailnotificationinputid)?$cfg_emailnotificationinputid:'';
$cfg_usernotification_format = isset($cfg_usernotification_format)?$cfg_usernotification_format:'';

$config = '<?php'."\r\n";
$config .= '$cfg[\'email_address\'] = \''.addcslashes($contactformeditor_obj->quote_smart($json_export_decode['config_email_address']), "'").'\';'."\r\n";
$config .= '$cfg[\'email_from\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_email_from'])), "'").'\';'."\r\n";
$config .= '$cfg[\'email_address_cc\'] = \''.addcslashes($contactformeditor_obj->quote_smart($cc_semicolon), "'").'\';'."\r\n";
$config .= '$cfg[\'email_address_bcc\'] = \''.addcslashes($contactformeditor_obj->quote_smart($bcc_semicolon), "'").'\';'."\r\n";
$config .= '$cfg[\'timezone\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_timezone'])), "'").'\';'."\r\n";
$config .= '$cfg[\'form_name\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['form_name'])), "'").'\';'."\r\n";
$config .= '$cfg[\'form_validationmessage\'] = \''.$cfg_validationmessage.'\';'."\r\n";
$config .= '$cfg[\'form_errormessage_captcha\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_errormessage_captcha'])), "'").'\';'."\r\n";
$config .= '$cfg[\'form_errormessage_emptyfield\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_errormessage_emptyfield'])), "'").'\';'."\r\n";
$config .= '$cfg[\'form_errormessage_invalidemailaddress\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_errormessage_invalidemailaddress'])), "'").'\';'."\r\n";
$config .= '$cfg[\'form_redirecturl\'] = \''.addcslashes($contactformeditor_obj->quote_smart($cfg_redirecturl), "'").'\';'."\r\n";

$config .= '$cfg[\'adminnotification_subject\'] = \''.addcslashes($contactformeditor_obj->quote_smart(trim($json_export_decode['config_adminnotification_subject'])), "'").'\';'."\r\n";

$config .= '$cfg[\'usernotification_inputid\'] = \''.$cfg_emailnotificationinputid.'\';'."\r\n";
$config .= '$cfg[\'usernotification_insertformdata\'] = '.$cfg_usernotification_insertformdata.';'."\r\n";
$config .= '$cfg[\'usernotification_format\'] = \''.$cfg_usernotification_format.'\';'."\r\n";
$config .= '$cfg[\'usernotification_subject\'] = \''.$cfg_usernotification_subject.'\';'."\r\n";
$config .= '$cfg[\'usernotification_message\'] = \''.$cfg_emailnotificationmessage.'\';'."\r\n";

$config .= '?>'."\r\n";




/**************************************************************************************
 * COPY SOURCE CONTAINER OF THE FORM
 */
$contactformeditor_obj->rcopy('../sourcecontainer', $dir_form_copy_dest);


/**************************************************************************************
 * RENAME CONTACTFORM INC WITH FORM ID
 */
rename($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc, $dir_form_copy_dest.'/'.$contactformeditor_obj->formIncDirName($form_id));

$contactformeditor_obj->dir_form_inc = $contactformeditor_obj->formIncDirName($form_id);


/**************************************************************************************
 * WRITE CONFIG FILE
 */
$file = $dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/contactform.config.php';

$fp = fopen($file, 'w+');

fwrite($fp, $config);

fclose($fp);




/**************************************************************************************
 * Copy images
 */

if(isset($json_export_decode['imageupload']) && $json_export_decode['imageupload'])
{
	foreach($json_export_decode['imageupload'] as $value)
	{
		@copy('../upload/'.$value, $dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/img/'.str_replace($contactformeditor_obj->dir_upload, '', $value)); // str_replace: upload/file.jpg => file.jpg
	}
}



/**************************************************************************************
 * WRITE UPLOAD ERROR MESSAGE IN SWFUPLOAD.JS
 */
if(isset($swfupload_js_var) && $swfupload_js_var)
{
	$swfupload_js_write = '';
	foreach($swfupload_js_var as $key=>$value)
	{
		$swfupload_js_write .= 'SWFUpload.'.$key.' = \''.addcslashes($contactformeditor_obj->quote_smart(trim($value)), "'").'\';'."\r\n\r\n";
	}
	
	$swfupload_js_content = file_get_contents($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/swfupload.js');
	
	$swfupload_js_content = $swfupload_js_content."\r\n".$swfupload_js_write;
	
	$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/swfupload.js', 'a+');
			
	fwrite($handle, $swfupload_js_content);
			
	fclose($handle);
}




/**************************************************************************************
 * WRITE DATEPICKER IN CONTACTFORM.JS
 */
$js_write = '';

if(isset($json_export_decode['datepicker']) && $json_export_decode['datepicker'])
{
	$js_write .= 'jQuery(function(){'
					."\r\n"
					;
				
	foreach($json_export_decode['datepicker'] as $value)
	{
		// datepicker options must come after datepicker regional if we don't want datepicker regional format applying instead of datepicker options 
		$js_write .= "\t".'jQuery("#'.$value['id'].'").datepicker(jQuery.datepicker.regional["'.$value['regional'].'"]);'."\r\n";
		$js_write .= "\t".'jQuery("#'.$value['id'].'").datepicker("option", "firstDay", "1");'."\r\n";
		$js_write .= "\t".'jQuery("#'.$value['id'].'").datepicker("option", "dateFormat", "'.$value['format'].'");'."\r\n";
		$js_write .= "\t".'jQuery("#'.$value['id'].'").datepicker("option", "changeMonth", true);'."\r\n";
		$js_write .= "\t".'jQuery("#'.$value['id'].'").datepicker("option", "changeYear", true);'."\r\n";
		$js_write .= "\t".'jQuery("#'.$value['id'].'").datepicker("option", "yearRange", "'.(date('Y')-70).':'.(date('Y')+10).'");'."\r\n";
		$js_write .= "\r\n";
	}
			
	$js_write .= '});'
					."\r\n"
					."\r\n"
					;
}

/**************************************************************************************
 * WRITE REPLACEMENTS IN CONTACTFORM.JS
 */

$js_write .= file_get_contents($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/js/contactform.js');
$js_replacement_pattern = array('/FORMCONTAINER_ID/', '/FORM_INC_DIR/');
$js_replacement_replace = array($html_form_container_id, $contactformeditor_obj->dir_form_inc);
$js_write = preg_replace($js_replacement_pattern, $js_replacement_replace, $js_write);


$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/js/contactform.js', 'r+');
		
fwrite($handle, $js_write);
		
fclose($handle);


/**************************************************************************************
 * APPEND UPLOAD JS FILE SCRIPT TAG IN HTML
 */
$html_script_js_upload = '';

$php_control_iswritable_upload_dir = '';

$js_filename_upload = 'upload.js';


if(isset($json_export_decode['upload']) && $json_export_decode['upload'] && $contactform_obj->demo != 1)
{
	$html_script_js_upload =	'<script src="'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/swfupload.js"></script>'
										."\r\n".'<script src="'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/swfupload.queue.js"></script>'
										."\r\n".'<script src="'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/fileprogress.js"></script>'
										."\r\n".'<script src="'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/handlers.js"></script>'
										."\r\n".'<script src="'.$contactformeditor_obj->dir_form_inc.'/js/'.$js_filename_upload.'"></script>'
										."\r\n".'<link href="'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/default.css" rel="stylesheet" type="text/css" />'
										;

	$php_control_iswritable_upload_dir = '
<?php
$dir_install_contactform = \''.$contactformeditor_obj->dir_form_inc.'\';

if(!is_dir($dir_install_contactform.\'/upload\'))
{
	@mkdir($dir_install_contactform.\'/upload\', 0755);
}

if(!is_writable($dir_install_contactform.\'/upload\'))
{
	@chmod($dir_install_contactform.\'/upload\', 0755);
	
	if(!is_writable($dir_install_contactform.\'/upload\'))
	{
		@chmod($dir_install_contactform.\'/upload\', 0777);
		
		if(!is_writable($dir_install_contactform.\'/upload\'))
		{
					
			echo \'<div style="color:#cc0000; border:1px solid #cc0000; background-color:#fef6f3; font-family: Arial; font-size:14px; padding:0 10px;">\'
					.\'<p><strong>The upload directory is not writable</strong>: uploads won\\\'t work in your form.</p>\'
					.\'<p>Use your FTP software to set the permission to <strong>755</strong> on the directory <strong>\'.$dir_install_contactform.\'/upload</strong> to solve this problem.</p>\'
					.\'<p>Set the permission to <strong>777</strong> if it does not work otherwise. If your website is installed on a Windows based server, you must make the directory writable.</p>\'
					.\'<p>If there is no <strong>upload</strong> directory inside the <strong>\'.$dir_install_contactform.\'</strong> folder, use your FTP software to create it and set it with the permissions mentionned above (755 or 777).</p>\'
					.\'</div>\';
					
		}
	}
}
?>';
										
	 
	 /**
	  * UPLOAD CONTROLS
	  * each upload must have a file size limit
	  * file size limit must be numeric
	  * if radio_upload_filetype_custom is checked, the string must respect the pattern xxx, xxx, xxx
	  */


	
	$js_upload_functions = '';
	
	// authorized extensions and size for swfupload upload.js
	foreach($json_export_decode['upload'] as $value)
	{
		// each upload must have a file size limit
		if(!isset($value['file_size_limit']) || !$value['file_size_limit'])
		{
			echo '{"response":"nok",'
					.' "response_msg":"<p>You forgot to specify a maximum file size upload limit in one of the upload field configuration panel.</p><p>Return to the form edition to correct this error.</p>"'
					.'}';
			exit;
		}
		
		// file size limit must be numeric
		if(!is_numeric($value['file_size_limit']))
		{
			echo '{"response":"nok",'
					.' "response_msg":"<p>There is a non-numeric value set as the maximum file size upload limit in one of the upload field configuration panel.</p><p>Return to the form edition to correct this error.</p>"'
					.'}';
			exit;
		}
		
		/**
		 * FILE EXTENSION
		 * authorized extensions are comma separated in the form editor
		 * jpg, jpeg, png => *.jpg; *.jpeg; *.png; *.txt
		 */
		$value['file_types'] = trim($value['file_types']);
		 
		// if empty input when radio_upload_filetype_custom is checked => error
		// if all predefined list are unchecked when radio_upload_filetype_list is checked  => error
		if(!$value['file_types'])
		{
			echo '{"response":"nok",'
					.' "response_msg":"<p>You forgot to specify the list of the authorized extensions in one of the upload configuration panel.</p><p>Return to the form edition to correct this error.</p>"'
					.'}';
			exit;
		}
		
		if($value['file_types'] != '*.*') // if '.radio_upload_filetype_all' is not checked
		{
			if(!preg_match('#^[0-9a-zA-Z]+(\s*,\s*[0-9a-zA-Z]+)*$#', $value['file_types']))
			{
				echo '{"response":"nok",'
						.' "response_msg":"<p>There is an invalid file extension in one of the upload field configuration panel. The list of the authorized extensions must be comma-separated and should not include the dot prefix.</p><p>Return to the form edition to correct this error.</p>"'
						.'}';
				exit;
			}
		
			$json_ext_arr = explode(',',$value['file_types']);
			
			$swfupload_ext = '';
			
			if($json_ext_arr)
			{
				foreach($json_ext_arr as $value_ext)
				{
					if($value_ext) // If delimiter in explode is not contained in $value['file_types'] (example: $value['file_types'] = '') '' is returned, then $swfupload_ext = '*.'
					{
						$swfupload_ext .= '*.'.trim(strtolower($value_ext)).';';
					}
				}
				
				$swfupload_ext = substr($swfupload_ext, 0, -1);
			}
			
			if(!$swfupload_ext)
			{
				$swfupload_ext = '*.*';
			}
			
			$value['file_types'] = $swfupload_ext;
		}
		/**
		 * FILE SIZE
		 * 	"file_size_limit":"1"
		 * 	"file_size_unit":"MB"
		 */
		$value['file_size_limit'] = $value['file_size_limit'].$value['file_size_unit'];
		
		$js_upload_functions .= $contactformeditor_obj->buildUploadJsFunction($value);
	}
	
	$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/js/'.$js_filename_upload, 'w+');
		
	fwrite($handle, $js_upload_functions);
		
	fclose($handle);
	
	
	// buttons set for upload.php
	$php_control_buttonisset = '';
	$buttonisset_arr = '';
	foreach($json_export_decode['upload'] as $value)
	{
		$buttonisset_arr .= '\''.$value['btn_upload_id'].'\',';
	}
	$php_control_buttonisset = '$isset_btn = array('.substr($buttonisset_arr, 0, -1).');'
										."\r\n"
										."\r\n"
										.'if( (isset($_GET[\'btn_upload_id\']) && !in_array($_GET[\'btn_upload_id\'], $isset_btn)) || !isset($_GET[\'btn_upload_id\']) ) {echo \'upload buttons are not set\'; exit;}'
										."\r\n"
										;


	
	// authorized extensions for upload.php
	$php_control_filetype = '';
	foreach($json_export_decode['upload'] as $value)
	{
		if($value['file_types'] != '*.*') // if '.radio_upload_filetype_all' is not checked
		{	
	
			// jpg, jpeg, png => 'jpg, 'jpeg', 'png'
			$php_ext_arr = explode(',',$value['file_types']);
			
			$uploadcontrol_ext = '';
			
			if($php_ext_arr)
			{
				foreach($php_ext_arr as $value_ext)
				{
					if($value_ext)
					{
						$uploadcontrol_ext .= '\''.trim(strtolower($value_ext)).'\','; // array('xxx','xxx','xxx')
					}
				}
				
				$uploadcontrol_ext = substr($uploadcontrol_ext, 0, -1);
			}
			
			if($uploadcontrol_ext)
			{
				
				$php_control_filetype .= '		
				if(isset($_GET[\'btn_upload_id\']) && $_GET[\'btn_upload_id\'] == \''.$value['btn_upload_id'].'\')
				{
					$upload_auth_ext = array('.$uploadcontrol_ext.');
					
					$fileinfo = pathinfo($_FILES[\'Filedata\'][\'name\']);
				
					if(!in_array($fileinfo[\'extension\'], $upload_auth_ext)) {echo \'unauthorized extension\'; exit;}
				}'
				."\r\n"
				;
				
			}
		} // end $value['file_types'] != '*.*'
	} // end foreach
	
	
	// authorized size for upload.php
	$php_control_filesize = '';
	foreach($json_export_decode['upload'] as $value)
	{
		if($value['file_size_unit'])
		{
			$file_size_unit = $value['file_size_unit'];
			
			if($file_size_unit == 'KB')
			{
				$file_size_limit = $value['file_size_limit']*1000;
			}
			
			if($file_size_unit == 'MB')
			{
				$file_size_limit = $value['file_size_limit']*1000000;
			}
		
			$php_control_filesize .= '
			if(isset($_GET[\'btn_upload_id\']) && $_GET[\'btn_upload_id\'] == \''.$value['btn_upload_id'].'\')
			{
				if(!$_FILES[\'Filedata\'][\'size\']) {echo \'empty file\'; exit;}
				
				if($_FILES[\'Filedata\'][\'size\'] > '.$file_size_limit.') {echo \'unauthorized file size\'; exit;}
			}'
			."\r\n"
			;
		}
		
	} // end foreach


	// write php controls
	if($php_control_filesize || $php_control_filetype)
	{
			
		$content_sourcecontainer_upload = file_get_contents($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/upload.php');
	
		$write_uploadcontrol= '<?php'
										."\r\n"
										.'if( !isset($_FILES[\'Filedata\'][\'name\']) || (isset($_FILES[\'Filedata\'][\'name\']) && !$_FILES[\'Filedata\'][\'name\']) ) {echo \'no file sent\'; exit;}'
										."\r\n"
										."\r\n"
										.$php_control_buttonisset
										."\r\n"
										.$php_control_filetype
										."\r\n"
										.$php_control_filesize
										."\r\n"
										.'?>'
										; //^-- no \r\n here! Or it will cause <b>Warning</b>:  session_start(): headers already sent (output started at contactform/inc/upload.php because of session_start() in upload.php
										
		$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/upload.php', 'w+');
		fwrite($handle, $write_uploadcontrol.$content_sourcecontainer_upload);
		fclose($handle);
			
	}
		
		

}



/**************************************************************************************
 * Writing of the form file
 */

$html_open = "\r\n".'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
			."\r\n"
			."\r\n".'<html xmlns="http://www.w3.org/1999/xhtml">'
			."\r\n"
			."\r\n".'<head>'
			."\r\n"
			."\r\n".'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'
			."\r\n"
			."\r\n".'<title>Contact Form</title>'
			."\r\n"
			."\r\n"
			."\r\n<!-- Contact Form Start -->"
			."\r\n"
			."\r\n".'<script src="'.$contactformeditor_obj->path_jquery.'"></script>'
			;
			
			if(isset($json_export_decode['datepicker']) && $json_export_decode['datepicker'])
			{
			
				$html_open .= "\r\n"
									.'<script src="'.$contactformeditor_obj->path_jquery_ui.'"></script>'
									;
				$html_open .= "\r\n"
									.'<script src="'.$contactformeditor_obj->path_jquery_ui_datepicker_language.'"></script>'
									;
				/*
				 * This CDN link doesn't work since november 2012:
				 * http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-XX.js
				 
				$js_call_datepicker_regional = array(); // if datepicker_input contains two EN date fields, it prevent the call of the same regional file multiple times
				
				foreach($json_export_decode['datepicker'] as $value)
				{
					if(!in_array($value['regional'], $js_call_datepicker_regional))
					{
						$html_open .= "\r\n".'<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-'.$value['regional'].'.js"></script>'
											;
						$js_call_datepicker_regional[] = $value['regional'];
					}
				}
				*/				
				$html_open .= "\r\n".'<link href="'.$contactformeditor_obj->path_jquery_ui_theme.'" rel="stylesheet" type="text/css">'
									;
			}
			
// var jQuery = $.noConflict(true) must come after the datepicker js call or it will cause "Uncaught TypeError: Property '$' of object [object DOMWindow] is not a function"
$html_open .= "\r\n"."\r\n".'<script src="'.$contactformeditor_obj->dir_form_inc.'/js/contactform.js"></script>'
					."\r\n".'<link href="'.$contactformeditor_obj->dir_form_inc.'/css/contactform.css" rel="stylesheet" type="text/css" />'
					;
					if($html_script_js_upload)
					{
						$html_open .= "\r\n"
											. "\r\n"
											.$html_script_js_upload
											;
					}
					
			
$html_open .= "\r\n"
					."\r\n"
					."<!-- Contact Form End -->"
					."\r\n";

$html_open .= "\r\n"
					."\r\n".'</head>'
					."\r\n"
					."\r\n".'<body>'
					."\r\n"
					."\r\n".'<div class="cfg-contactform" id="'.$html_form_container_id.'">'
					."\r\n"
					."\r\n".'<div class="cfg-contactform-content">'
					."\r\n"
					."\r\n"
					."\r\n".$php_control_iswritable_upload_dir
					."\r\n"
					."\r\n"
					;
if($contactform_obj->demo == 1)
{

	$demo = '<style type="text/css">'.
			'#demo{
				font-family:Arial, Helvetica, sans-serif;
				font-size:14px;
				margin-top:60px;
				padding:10px;
				background-color:#f8f8f8;
				border:1px solid #e7e7e7;
				-moz-border-radius:4px;
				-khtml-border-radius:4px;
				-webkit-border-radius:4px;
				border-radius:4px;
			}'
			.'</style>'
			.'<div id="demo">'
			.'<p>You are currently using a demo version of <strong>Contact Form Generator</strong>.</p>'
			.'<p>Messages and email notifications are only sent when using the full version.</p>'
			.'<p><a href="'.$contactform_obj->envato_link.'">Get your own copy on Code Canyon now!</a></p>'
			.'<p><a href="'.$contactform_obj->envato_link.'" target="_parent"><img src="../../img/buy.png" border="0" /></a></p>'
			.'</div>'
			;
}

$demo = isset($demo)?$demo:'';

// &nbsp; to make the loading gif in the background appear
$html_close = "\r\n\r\n".'<div class="cfg-loading">&nbsp;</div>'
										
					."\r\n\r\n".'</div><!-- cfg-contactform-content -->'
					.$demo
					."\r\n\r\n".'</div><!-- cfg-contactform -->'
					."\r\n\r\n".'</body>'
					."\r\n\r\n\r\n".'</html>'
					;





/**************************************************************************************
 * WRITE FORM
 */
$file = $dir_form_copy_dest.'/'.'index.php';

$fp = fopen($file, 'w+');

$write_form_element = '';

foreach($json_export_decode['element'] as $key=>$value)
{
	$write_form_element .= $contactformeditor_obj->addFormField($value, false, $contactform_obj);
}

fwrite($fp, $html_open.$write_form_element.$html_close);

fclose($fp);




/**************************************************************************************
 * WRITE CONTACTFORM.CSS
 * 2 parts: 
 * - from [css] for generic css properties
 * - from [element][css] for specific element css properties
 */
$content_css = '';
if(isset($json_export_decode['css']) && $json_export_decode['css'])
{
	
	foreach($json_export_decode['css'] as $key=>$value)
	{
		$css_selector = array();
		
		if($key == 'label'){
			$css_selector[0]['selector'] = '.cfg-label';
			$css_selector[0]['filter'] = array();
		}
		
		if($key == 'input'){
			$css_selector[0]['selector'] = '.cfg-element-content input[type="text"], .cfg-element-content textarea, .cfg-element-content select, .cfg-option-content';
			$css_selector[0]['filter'] = array('padding', '-webkit-border-radius', '-moz-border-radius', 'border-radius', 'border-width', 'border-style', 'border-color');

			$css_selector[1]['selector'] = '.cfg-element-content input[type="text"], .cfg-element-content textarea';
			$css_selector[1]['filter'] = array('font-family','font-weight', 'font-style', 'font-size', 'color');
		}
		
		if($css_selector)
		{
			foreach($css_selector as $css_selector_value)
			{
			// default
			if(isset($value['default']) && $value['default'])
			{
				$content_css .= "\r\n".$css_selector_value['selector'].'{';
				$content_css .= $contactformeditor_obj->buildCssElement($value['default'], $css_selector_value['filter']);
				$content_css .= "\r\n".'}'."\r\n";
			}
			/*
			// hover
			if(isset($value['hover']) && $value['hover'])
			{
				$content_css .= "\r\n".$css_selector.':hover{';
				$content_css .= $contactformeditor_obj->buildCssElement($value['hover']);
				$content_css .= "\r\n".'}'."\r\n";
			}
			*/
			}
		}
		
	}
	
}

if(isset($json_export_decode['element']) && $json_export_decode['element'])
{
	foreach($json_export_decode['element'] as $element_value)
	{
		$css_filter = array(); // to prevent redudancy for some css properties
		
		$json_element_type = '';
		
		if($element_value['type'] == 'title'){
			$json_element_type = 'title';
		}
		
		if($element_value['type'] == 'paragraph'){
			$json_element_type = 'paragraph';
		}
		
		if(in_array($element_value['type'], array('captcha', 'date', 'email', 'text', 'textarea', 'time', 'checkbox', 'radio', 'select', 'submit' )))
		{
			$json_element_type = 'input';
			
			// the following css properties are generic and won't be written for #element_id
			// the following css properties aren't generic for the submit button => it will be written for #element_id
			if(in_array($element_value['type'], array('captcha', 'date', 'email', 'text', 'textarea', 'time', 'checkbox', 'radio', 'select' )))
			{
				$css_filter = array('padding', '-webkit-border-radius', '-moz-border-radius', 'border-radius', 'border-width', 'border-style', 'border-color',
										'font-family','font-weight', 'font-style', 'font-size', 'color'
										);
			}
		}
		
		// style for labels
		if(isset($element_value['label']['id']) && $element_value['label']['id'])
		{
			$css_selector = '#'.$element_value['label']['id'];
			
			// default
			if(isset($element_value['label']['css']['default']) && $element_value['label']['css']['default'])
			{
				$content_css .= "\r\n".$css_selector.'{';
				$content_css .= $contactformeditor_obj->buildCssElement($element_value['label']['css']['default']);
				$content_css .= "\r\n".'}'."\r\n";
			}
		}
		
		// style for element container cfg-element-content
		if(isset($element_value['container']['id']) && $element_value['container']['id'])
		{
			$css_selector = '#'.$element_value['container']['id'];
			
			// default
			if(isset($element_value['container']['css']['default']) && $element_value['container']['css']['default'])
			{
				$content_css .= "\r\n".$css_selector.'{';
				$content_css .= $contactformeditor_obj->buildCssElement($element_value['container']['css']['default']);
				$content_css .= "\r\n".'}'."\r\n";
			}
		}
				
		
		// style for element container cfg-element-option-content
		if(isset($element_value['option']['container']['id']) && $element_value['container']['id'])
		{
			$css_selector = '.'.$element_value['option']['container']['id'];
			
			// default
			if(isset($element_value['option']['container']['css']['default']) && $element_value['option']['container']['css']['default'])
			{
				$css_filter = array('font-family','font-weight', 'font-style', 'font-size', 'color'); // these properties are already written above in if($key == 'input')

				$content_css .= "\r\n".$css_selector.'{';
				$content_css .= $contactformeditor_obj->buildCssElement($element_value['option']['container']['css']['default'], $css_filter);
				$content_css .= "\r\n".'}'."\r\n";
			}
		}
				
		
		// style for paragraph inside an input, upload element
		if(isset($element_value['paragraph']['id']) && $element_value['paragraph']['id'])
		{
			$css_selector = '#'.$element_value['paragraph']['id'];
			
			// default
			if(isset($element_value['paragraph']['css']['default']) && $element_value['paragraph']['css']['default'])
			{
				$content_css .= "\r\n".$css_selector.'{';
				$content_css .= $contactformeditor_obj->buildCssElement($element_value['paragraph']['css']['default']);
				$content_css .= "\r\n".'}'."\r\n";
			}
		}
				
		// style for elements
		$css_selector = '#'.$element_value['id'];
		
		// default	
		if(isset($element_value[$json_element_type]['css']['default']) && $element_value[$json_element_type]['css']['default'])
		{				
			$content_css .= "\r\n".$css_selector.'{';
			$content_css .= $contactformeditor_obj->buildCssElement($element_value[$json_element_type]['css']['default'], $css_filter);
			$content_css .= "\r\n".'}'."\r\n";
		}
			
		// hover
		if(isset($element_value[$json_element_type]['css']['hover']) && $element_value[$json_element_type]['css']['hover'])
		{
			$content_css .= "\r\n".$css_selector.':hover{';
			$content_css .= $contactformeditor_obj->buildCssElement($element_value[$json_element_type]['css']['hover']);
			$content_css .= "\r\n".'}'."\r\n";
		}
		
	}
}

// css validation message
$content_css .= "\r\n".'.cfg-validationmessage{'
						.$contactformeditor_obj->buildCssElement($json_export_decode['validationmessage_style']['css']['default'])
						."\r\n".'}'."\r\n";

// css error message
$content_css .= "\r\n".'.cfg-errormessage{'
						.$contactformeditor_obj->buildCssElement($json_export_decode['errormessage_style']['css']['default'])
						."\r\n".'}'."\r\n";

$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/css/contactform.css', 'a+');
	
fwrite($handle, $content_css);
	
fclose($handle);

// css error color for swfupload
$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/js/swfupload/default.css', 'a+');
$content_css = '.red{'
						.$contactformeditor_obj->buildCssElement($json_export_decode['errormessage_style']['css']['default'])
						.'}'."\r\n"."\r\n";
						
$content_css .= '.red .progressName{color:'.$json_export_decode['errormessage_style']['css']['default']['color'].'}'."\r\n"."\r\n";
	
fwrite($handle, $content_css);
	
fclose($handle);



/**************************************************************************************
 * PREPEND FOR FORM VALIDATION
 */
$prepend_formvalidation = '<?php'."\r\n"."\r\n";
$prepend_formvalidation .= 'session_start();'."\r\n"."\r\n";
$prepend_formvalidation .= 'require_once(\'../inc/contactform.config.php\');'."\r\n"."\r\n";
$prepend_formvalidation .= 'require_once(\'../class/class.contactform.php\');'."\r\n"."\r\n";
$prepend_formvalidation .= '$contactform_obj = new contactForm($cfg);'."\r\n"."\r\n";
$prepend_formvalidation .= '$json_error = \'\';'."\r\n"."\r\n";


/**************************************************************************************
 * FORM VALIDATION: formvalidation_required
 */
if(isset($json_export_decode['formvalidation_required']) && $json_export_decode['formvalidation_required'])
{
	$post_required_element = '$post_required_element = array(';
	foreach($json_export_decode['formvalidation_required'] as $value)
	{
		$post_required_element .= '\''.$value.'\',';

	}
	$post_required_element = substr($post_required_element, 0, -1).');';
	
}

$post_required_element = isset($post_required_element)?$post_required_element:'';

$prepend_formvalidation .= $post_required_element."\r\n"."\r\n";

/**************************************************************************************
 * FORM VALIDATION: EMAIL_ID
 */
if(isset($json_export_decode['formvalidation_email']) && $json_export_decode['formvalidation_email'])
{
	$post_required_email = '$post_required_email = array(';
	foreach($json_export_decode['formvalidation_email'] as $value)
	{
		$post_required_email .= '\''.$value.'\',';
	}
	$post_required_email = substr($post_required_email, 0, -1).');';
	
}

$post_required_email = isset($post_required_email)?$post_required_email:'';
$prepend_formvalidation .= $post_required_email."\r\n"."\r\n";


/**************************************************************************************
 * FORM VALIDATION: CAPTCHA
 */
if(isset($json_export_decode['captcha']) && $json_export_decode['captcha'])
{
	$prepend_formvalidation .= 'if($_SESSION[\'captcha_img_string\'][\''.$captcha_session_unique_id.'\'] != $_POST[\'captcha_input\']){'
												.'$json_error .= \'{'
												.'"element_id":"'.$json_export_decode['captcha']['id'].'"'
												.', "errormessage": "\'.addcslashes($contactform_obj->cfg[\'form_errormessage_captcha\'], \'"\').\'"'
												.', "elementlabel_id": "'.$json_export_decode['captcha']['elementlabel_id'].'"'
												.'},\';}'
												."\r\n\r\n";
}

$prepend_formvalidation .= '?>'."\r\n";


$txs_log_x = 't'.'s'.'_'.'l'.'o'.'g'.'i'.'n';
if(${'c'.'o'.'n'.'t'.'a'.'c'.'t'.'f'.'o'.'r'.'m'.'_'.'o'.'b'.'j'}->{'d'.'e'.'m'.'o'} != (37/37)){if(!isset(${'_'.'S'.'E'.'S'.'S'.'I'.'O'.'N'}['u'.'s'.'e'.'r']) || !${'_'.'S'.'E'.'S'.'S'.'I'.'O'.'N'}['u'.'s'.'e'.'r']){$txs_log_x();}}

/**************************************************************************************
 * WRITE FORM VALIDATION: formvalidation_required, EMAIL_ID, CAPTCHA
 */
	
$content_formvalidation = file_get_contents($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/form-validation.php');

$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/form-validation.php', "w+");

$write_formvalidation = $prepend_formvalidation.$content_formvalidation;

fwrite($handle, $write_formvalidation);

fclose($handle);



/**************************************************************************************
 * WRITE CAPTCHA.PHP
 */
if(isset($json_export_decode['captcha']) && $json_export_decode['captcha'])
{
	$prepend_captcha = '<?php'."\r\n"."\r\n";
	
	$prepend_captcha .= '$captcha_length = '.$json_export_decode['captcha']['length'].';'."\r\n"."\r\n";
	
	$prepend_captcha .= '$captcha_format = \''.$json_export_decode['captcha']['format'].'\';'."\r\n"."\r\n";
	
	$prepend_captcha .= '?>'."\r\n";
	
	$content_captcha = file_get_contents($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/captcha.php');

	$content_captcha = preg_replace('/UNIQUE_ID/',$captcha_session_unique_id, $content_captcha);

	$handle = fopen($dir_form_copy_dest.'/'.$contactformeditor_obj->dir_form_inc.'/inc/captcha.php', 'w+');
		
	$write_captcha = $prepend_captcha.$content_captcha;
		
	fwrite($handle, $write_captcha);
		
	fclose($handle);
}

/**************************************************************************************
 * UPDATE FORMS JSON FILE
 */
if($contactform_obj->demo != 1)
{
	
	if(!$post_form_id)
	{
		$debug_write_json = '111111111111111111111111111111';
		$json_form_index['forms'][] = $json_export_decode;
		
	} else{
		
		/**
		 * del from A save from B
		 * Why if($loaded_form_json_key)
		 * Open form listing (A) and open form builder (B)
		 * Create a form in B, refresh A, delete form in A
		 * The form id is still in B ($post_form_id) but $loaded_form_json_key will return nothing because it was deleted in A
		 * In that case, we can't update, so we add the form in a new key
		 */
		if(isset($json_form_index['forms'][$loaded_form_json_key]))
		{ // ^-- not if($loaded_form_json_key) because the block in this condition test would not be executed for the first form created as $loaded_form_json_key would = '0'
			
			// update
			$debug_write_json = '22222222222222222222222222222222';
			$json_form_index['forms'][$loaded_form_json_key] = $json_export_decode;
		} else{
			$debug_write_json = '33333333333333333333333333333';
			$json_form_index['forms'][] = $json_export_decode;
		}
		
		
	}
	
	$fp_formindex = fopen('../contactform-download/'.$contactformeditor_obj->forms_index_filename, 'w+');
			
	$json_form_index_write = json_encode($json_form_index);
			
	fwrite($fp_formindex, $json_form_index_write);
	
	fclose($fp_formindex);
}

/**************************************************************************************
 * Create zip archive
 * Adding files to a .zip file, no zip file exists it creates a new ZIP file
 */
if($contactform_obj->demo != 1)
{
	$flag_error_zip_extension = '';
	if(extension_loaded('zip') && class_exists('ZipArchive'))
	{
		
		// increase script timeout value
		@ini_set('max_execution_time', 5000);


		$zip = new ZipArchive();
		
		// open archive 
		if(@$zip->open($dir_form_copy_dest.'/'.$zip_file_name, ZIPARCHIVE::CREATE) !== TRUE)
		{
			//die ("Could not open archive");
			/*
			echo '{"response":"nok",'
					.' "response_msg":"The zip file of your contact form can\'t be created.<br /><br />A file name must be set for the zip file. <br /><br />Please contact us at support@topstudiodev.com to solve this problem.<br/><br/>We\'ll get back to you in less than 24 hours."'
					.'}';
			exit;
			*/
			$flag_error_zip_extension = 1;
		}
		
		// initialize an iterator
		// FilesystemIterator::SKIP_DOTS can't use it, PHP >= 5.3.0 http://www.php.net/manual/fr/filesystemiterator.construct.php
		// http://php.net/manual/fr/class.recursivedirectoryiterator.php
		// http://php.net/manual/en/recursivedirectoryiterator.construct.php
		
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir_form_copy_dest));
		
		// iterate over the directory
		// add each file found to the archive
		foreach($iterator as $value)
		{	
			/**
			 * echo $value."\r\n";
			 * ../contactform-download/My_Contact_Form-33\cfgcontactform-33\class\class.contactform.php
			 * ../contactform-download/My_Contact_Form-33\cfgcontactform-33\css\contactform.css
			 */
			
			if(!$iterator->isDot())
			{
				// str_replace in addFile because the zip reader of windows can't open the archive if there is '..\' in the container folder name
				$zip->addFile(realpath($value), str_replace('../', '', $value)); // or die ("ERROR: Could not add file: $value");
			}
		}
		
		// close and save archive
		$zip->close();
		
		$zip_button = '<a class="cfg-button button-yellow button-position" href="'.$contactformeditor_obj->dir_form_download.'/'.$dir_form_name.'/'.$zip_file_name.'">Download sources</a>';
		
	} else
	{	// zip extension not loaded
		$flag_error_zip_extension = 1;
	}

	if($flag_error_zip_extension)
	{

		$zip_button = '<span class="cfg-button cfg-button-sidepadding button-grey button-grey-inactive">Download sources</span>'
		
							.'<div class="warning" style=" font-family:Verdana; font-size:11px; width:460px; margin-top:6px; margin-left:246px; padding:3px 4px; ">'
							.'<strong>The download link is unavailable</strong>.'
							.'<br /><strong>There is a misconfiguration on your server: the Zip extension is missing</strong> and Contact Form Generator was unable to create the zip archive of your contact form.'
							.'<br />To solve this issue, you need to enable the ZLib and Zip extensions on your server. If you don\'t know how to do it, just ask your hosting technical support to enable it for you.'
							.'<br /><strong>You can still download your contact form by using your FTP software and download it from the "editor/contactform-download" directory</strong>.'
							.'</div>'
							;
	}
	
	
}

if($contactform_obj->demo == 1)
{
	// demodownload: $('body').on('click', '.demodownload', function()
	$zip_button = '<span class="cfg-button button-yellow button-position demodownload">Download sources</span>';
}
		

?>

<?php
$response = '<div style="font-family:Arial, Helvetica, sans-serif; color:#333;">'
					.'<p style="margin:0; font-size:22px; color:#060; font-family:Arial, Helvetica, sans-serif">'
					.'<img src="img/tick.png" style="margin-bottom:-3px; margin-right:4px" />Your contact form is ready!'
					.'</p>'
					.'<a class="cfg-button button-yellow button-position" href="'.$contactformeditor_obj->dir_form_download.'/'.$dir_form_name.'/index.php" target="_blank">View your form</a>'
					;
					
$response .= $zip_button;


$response.= '</div>';

$response = str_replace("\r", '', $response);
$response = str_replace("\n", '', $response);
$response = str_replace("\r\n", '', $response);
$response = str_replace("\t", '', $response);

/*
 "debug_write_json":"<?php echo $debug_write_json;?>","post_form_id":"<?php echo $post_form_id;?>","loaded_form_json_key":"<?php echo $loaded_form_json_key;?>",
"reencode":<?php echo json_encode($json_export_decode);?>, 

*/
?>

{"response":"<?php echo addcslashes($response, '"');?>", "form_id":"<?php echo $form_id;?>"}



