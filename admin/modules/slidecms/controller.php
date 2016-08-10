<?php
  /**
   * Controller
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: controller.php, v1.00 2012-12-24 12:12:12 gewa Exp $
   */
  define("_VALID_PHP", true);

  require_once ("../../init.php");
  if (!$user->is_Admin())
      redirect_to("../../login.php");

  require_once ("lang/" . $core->language . ".lang.php");
  require_once ("admin_class.php");

  $slider = new slideCMS();
?>
<?php
  /* Update Slide Order */
  if (isset($_POST['sortSlides'])) :
      foreach ($_POST['sid'] as $k => $v) :
          $p = $k + 1;
          $data['sorting'] = $p;
          $db->update("mod_slidecms_data", $data, "id='" . $v . "'");
      endforeach;
 endif;

  /* Delete Image */
  if (isset($_POST['deleteMedia'])): 
  
  list($id, $folder) = explode("::", $_POST['deleteMedia']);
  
  $id = intval($id);
  $folder = sanitize($folder);
  $dirname = WOJOLITE . 'plugins/' . $folder . '/slides/';

  $img = getValue("data", "mod_slidecms_data", "id='" . $id . "'");

  @unlink($dirname . $img);

  $db->delete("mod_slidecms_data", "id='" . $id . "'");
  $title = sanitize($_POST['title']);
  
  print ($db->affected()) ? $wojosec->writeLog(_IMAGE .' <strong>'.$title.'</strong> '._DELETED, "", "no", "module") . $core->msgOk(_IMAGE .' <strong>'.$title.'</strong> '._DELETED) : $core->msgAlert(_SYSTEM_PROCCESS); 
  endif;
  
  /* == Rename Photo == */
  if (isset($_POST['renameMedia'])): 
  $id = intval($_POST['renameMedia']);
  $data['caption'.$core->dblang] = sanitize($_POST['caption']);
  $db->update("mod_slidecms_data", $data, "id='" . $id . "'");
    
  print ($db->affected()) ? $wojosec->writeLog(_IMAGE .' <strong>'.$data['caption'.$core->dblang].'</strong> '._UPDATED, "", "no", "module") . $core->msgOk(_IMAGE .' <strong>'.$data['caption'.$core->dblang].'</strong> '._UPDATED) : $core->msgAlert(_SYSTEM_PROCCESS); 
  endif;

  /* == Process Video == */
  if (isset($_POST['doVids'])):
      $slider->processVideo($_POST['sid']);
  endif;
  
  /* == Load Media == */
  if (isset($_POST['loadMedia'])):
      $sid = intval($_POST['sid']);
	  $sfolder = sanitize($_POST['sfolder']);
      $slider->loadPhotos($sid, $sfolder);
  endif;

  /* == Edit Slider == */
  if (isset($_POST['editSlider'])):
       $slider->sliderid = (isset($_POST['sliderid'])) ? $_POST['sliderid'] : 0;
       $slider->editSlider();
  endif;

  /* == Add Slider == */
  if (isset($_POST['addSlider'])):
       $slider->addSlider();
  endif;
  
  /* == Upload Photos == */
  if (isset($_POST['fileid'])):
       $sid = intval($_REQUEST['sid']);
	   $sfolder = sanitize($_REQUEST['sfolder']);
       $slider->doUpload($sid, $sfolder);
  endif;
  
  /* == Delete Master Slider == */
  if (isset($_POST['deleteSlider'])):
      $id = sanitize($_POST['deleteSlider']);
	  $row = $core->getRowById("mod_slidecms", $id);

      if ($row) {
          $pluginid = getValue("id", "plugins", "plugalias='" . $row['plug_name'] . "'");
		  $dirname = WOJOLITE . 'plugins/' . $row['plug_name'];
		  
		  delete_directory($dirname);
          $db->delete("plugins", "id=" . $pluginid);
          $db->delete("layout", "plug_id=" . $pluginid);
      }

      $db->delete("mod_slidecms", "id='" . (int)$id . "'");

      $title = sanitize($_POST['title']);
      print ($db->affected()) ? $wojosec->writeLog(MOD_SLC_SLIDER . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "module") . $core->msgOk(MOD_SLC_SLIDER . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>