<?php
session_start();

if(isset($_SESSION['form_element_id']))
{
	$_SESSION['form_element_id']++;
} else{
	$_SESSION['form_element_id'] = 1; 
}

require_once('../class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();


// AUTHENTICATION
require_once('../sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');

$contactform_obj = new contactForm($cfg=array());

if($contactform_obj->demo != 1)
{
	$contactformeditor_obj->authentication(true);
}
?>


<?php
$json_decode_element = json_decode($contactformeditor_obj->quote_smart($_POST['element']), true);

if(isset($json_decode_element['id']) && $json_decode_element['id'])
{
	$explode_element_id = explode('-', $json_decode_element['id']); // prevents "Only variables shoulds be Passed by reference" when using end(explode()) in EasyPHP
	$container_id = end($explode_element_id);
	// that way if a form is loaded we keep the original html element-container id instead of having a new html id created with $_SESSION['form_element_id']
} else{
	$container_id = $_SESSION['form_element_id'];
}

$element_type_with_properties = array('checkbox', 'captcha', 'date', 'email', 'image', 'radio', 'select', 'selectmultiple', 'submit', 'text', 'textarea', 'time', 'title', 'upload');
$element_type_with_label = array('checkbox', 'captcha', 'date', 'email', 'radio', 'select', 'selectmultiple', 'text', 'textarea', 'time', 'upload');
$element_type_with_paragraph = array('checkbox', 'captcha', 'date', 'email', 'paragraph', 'radio', 'select', 'selectmultiple', 'text', 'textarea', 'time', 'upload');


?>

<div class="cfg-elementmove">

	<div id="<?php echo $container_id; ?>" class="element-container">
	
		<input class="exportelement-type" value="<?php echo $json_decode_element['type'];?>" type="hidden" />

		<?php echo $contactformeditor_obj->addFormField($json_decode_element, true);?>
		
		<div class="element-editor-container">
			
			<div class="editelement-menu deleteelement" title="Delete this element" >
			<img src="img/cross.png" />
			</div>
			
			<?php if($contactform_obj->demo != 1){if(!isset($_SESSION['user']) || !$_SESSION['user']){exit;}}?>
			
			<?php
			if(in_array($json_decode_element['type'], $element_type_with_paragraph))
			{
				?>
				<div class="editelement-menu cfg-element-btn-paragraph" title="Edit paragraph" >
				<img src="img/element-editor-menu-paragraph.png" />
				</div>
			<?php
			}
			?>
			
			<?php
			if(in_array($json_decode_element['type'], $element_type_with_label))
			{
				?>
				<div class="editelement-menu cfg-element-btn-alignment" title="Edit alignment" >
				<img src="img/element-editor-menu-alignment.png" />
				</div>
			<?php
			}
			?>
			
			<?php
			if(in_array($json_decode_element['type'], $element_type_with_properties))
			{
				?>
				<div class="editelement-menu elementconfiguration" title="Edit element"  >
				<img src="img/element-editor-menu-edit.png" />
				</div>
			<?php
			}
			?>
			
			
			
			<div class="clear"></div>
			
			<?php
			if(in_array($json_decode_element['type'], $element_type_with_label))
			{
				?>
				<div class="element-editor cfg-edit-alignment-container">
				<?php
				echo $contactformeditor_obj->addEditAlignment($json_decode_element);
				?>
				<?php
				echo $contactformeditor_obj->closeEditContainer();
				?>
				</div>
			<?php
			}
			?>
			
			<?php
			if(in_array($json_decode_element['type'], $element_type_with_paragraph))
			{
				?>
				<div class="element-editor cfg-edit-paragraph-container">
				<?php
				echo $contactformeditor_obj->addEditParagraph($json_decode_element);
				?>
				<?php
				echo $contactformeditor_obj->closeEditContainer();
				?>
				</div>
			<?php
			}
			?>
			
			<?php
			if(in_array($json_decode_element['type'], $element_type_with_properties))
			{
				?>
				<div class="element-editor cfg-edit-properties-container">
				<?php
				echo $contactformeditor_obj->addEditFormField($json_decode_element);
				?>
				<?php
				echo $contactformeditor_obj->closeEditContainer();
				?>
				</div>
			<?php
			}
			?>
			
		</div>
		
		<div class="clear"></div>
		
	</div><!-- element-editor-container -->
	
	
	<div class="editelement-menu cfg-move-element" style="float:left;" title="Move this element">
	<img src="img/arrow-move.png" />
	</div>
	
	<div class="clear"></div>
	
</div>