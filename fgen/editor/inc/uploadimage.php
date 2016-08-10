<?php
session_start();

require_once('../class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

require_once('../sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');
$contactform_obj = new contactForm($cfg=array());

// only possible when not using the demo
if($contactform_obj->demo != 1)
{

	//$contactformeditor_obj->authentication(true);
	
	
	if(!is_writable('../'.$contactformeditor_obj->dir_upload))
	{
		@chmod('../'.$contactformeditor_obj->dir_upload, 0755);
	}
	
	
	function uploadFile($copy_src_filename, $originalfilename, $testnewfilename)
	{
		global $i;
		
		$contactformeditor_obj = new contactFormEditor();
		global $contactformeditor_obj;
	
		if(file_exists('../'.$contactformeditor_obj->dir_upload.$testnewfilename))
		{
		
			$fileinfo = pathinfo($originalfilename);
			$filename_noext =  basename($originalfilename,'.'.$fileinfo['extension']);
			
			
			$i++;
			$suffix = str_pad($i, 3, '0', STR_PAD_LEFT);
			
			$newfilename = $filename_noext.' - '.$suffix.'.'.$fileinfo['extension'];
			
			uploadFile($copy_src_filename, $originalfilename, $newfilename);
			
		} else{
		
			@copy($copy_src_filename, '../'.$contactformeditor_obj->dir_upload.$testnewfilename);
			echo $testnewfilename; // image file name needed to append the image with its new name in uploadSuccess (handlers.js)
		}
		
		
	}
	
	uploadFile($_FILES['Filedata']['tmp_name'], $_FILES['Filedata']['name'], $_FILES['Filedata']['name']);
	
	exit;
}
?>