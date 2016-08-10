<?php
session_start();

require_once('../class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

require_once('../sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');
$contactform_obj = new contactForm($cfg=array());

// only possible when not using the demo
if($contactform_obj->demo != 1)
{
	
	$contactformeditor_obj->authentication(true);
	
	
	$post_form_dir = (isset($_POST['form_dir']) && $_POST['form_dir']) ? $_POST['form_dir'] : '';
	
	if($post_form_dir)
	{
		// DELETE FORM JSON FILE
		
		$form_index_file = '../contactform-download/'.$contactformeditor_obj->forms_index_filename;
		
		$json_form_index = json_decode(file_get_contents($form_index_file), true);
		
		//print_r($json_form_index);
		
		
		foreach($post_form_dir as $post_form_dir_value)
		{
				if($_POST['software_version'] >= '1.5')
				{
					foreach($json_form_index['forms'] as $form_key=>$form_value)
					{
						if($form_value['form_dir'] == $post_form_dir_value)
						{
							unset($json_form_index['forms'][$form_key]);
							break; 
						}
					}
					
					//print_r($json_form_index);
					
					/***
					 * array_values required
					 * For example: if the form has 2 entries and if we unset the first entry, 
					 * the json will look like this: {"forms":{"1":{" instead of {"forms":[{"
					 *
					 * http://stackoverflow.com/questions/3869129/php-json-encode-as-object-after-php-array-unset
					 * "The reason for that is that your array has a hole in it: it has the indices 0 and 2, but misses 1. 
					 * JSON can't encode arrays with holes because the array syntax has no support for indices.
					 * You can encode array_values($a) instead, which will return a reindexed array."
					 *
					 * "The unset() function allows removing keys from an array. Be aware that the array will not be reindexed"
					 */
					 /**/
					$json_form_index['forms'] = array_values($json_form_index['forms']); 
					
					
					// JSON INDEX FILE WRITABLE?
					$is_writable_form_index_file = false;
					if(!is_writable($form_index_file))
					{
							echo '{"response":"nok",'
									.' "response_msg":"'.$contactformeditor_obj->error_not_writable_form_index_file.'"'
									.'}';
							exit;
					} else{
						$is_writable_form_index_file = true;
					}
					
				} // if software version
				
				
				
															
				if($_POST['software_version'] >= '1.5' && $is_writable_form_index_file)
				{
					// DELETE FORM DIRECTORY
					$contactformeditor_obj->rrmdir('../contactform-download/'.$contactformeditor_obj->quote_smart($post_form_dir_value));
					
					// FORM DIRECTORY STILL EXISTS?
					// problem with infomaniak servers http://stackoverflow.com/questions/12117266/php-file-is-writable-but-cannot-be-deleted
					if(is_dir('../contactform-download/'.$contactformeditor_obj->quote_smart($post_form_dir_value)))
					{
						echo '{"response":"nok",'
								.' "response_msg":"'.$contactformeditor_obj->errorNotWritableDirForm($post_form_dir_value).'"'
								.'}';
						exit;
					} else{
						// REWRITE JSON FORM INDEX FILE
						$fp = fopen($form_index_file, 'w+');
						
						$json_form_index_write = json_encode($json_form_index);
						
						fwrite($fp, $json_form_index_write);
						
						fclose($fp);
					}
					
				}
				
				if($_POST['software_version'] < '1.5')
				{
					// DELETE FORM DIRECTORY
					$contactformeditor_obj->rrmdir('../contactform-download/'.$contactformeditor_obj->quote_smart($post_form_dir_value));
					if(is_dir('../contactform-download/'.$contactformeditor_obj->quote_smart($post_form_dir_value)))
					{
						echo '{"response":"nok",'
								.' "response_msg":"'.$contactformeditor_obj->errorNotWritableDirForm($post_form_dir_value).'"'
								.'}';
						exit;
					}
				}	
			}
	}
	
}
?>