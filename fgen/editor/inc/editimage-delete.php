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
	
	$post_filename = (isset($_POST['filename']) && $_POST['filename']) ? $_POST['filename'] : '';
	
	if($post_filename)
	{
		foreach($post_filename as $post_filename_value)
		{
			@unlink('../'.$contactformeditor_obj->dir_upload.$contactformeditor_obj->quote_smart($post_filename_value));
			
			// FILE STILL EXISTS?
			// problem with infomaniak servers http://stackoverflow.com/questions/12117266/php-file-is-writable-but-cannot-be-deleted
														
			if(is_file('../'.$contactformeditor_obj->dir_upload.$contactformeditor_obj->quote_smart($post_filename_value)))
			{
				echo '{"response":"nok",'
						.' "response_msg":"'.$contactformeditor_obj->errorNotWritableAdminUpload($post_filename_value).'"'
						.'}';
				exit;
			}
		}
	}
}
?>