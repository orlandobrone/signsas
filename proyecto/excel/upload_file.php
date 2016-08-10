<?php
require('class/Uploader.php');

$upload_dir = 'uploads/';
$valid_extensions = array('xls');
 
$Upload = new FileUpload('uploadfile');
$result = $Upload->handleUpload($upload_dir, $valid_extensions);

if (!$result) {
    echo json_encode(array('success' => false, 'msg' => $Upload->getErrorMsg()));   
} else {
    echo json_encode(array('success' => true, 'file' => $Upload->getFileName())); 
}

?>