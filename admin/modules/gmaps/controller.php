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

  $gmaps = new GMaps();
?>
<?php
  /* Proccess GMap */
  if (isset($_POST['processGMaps'])):
      $gmaps->gmapsid = (isset($_POST['gmapsid'])) ? $_POST['gmapsid'] : 0;
      $gmaps->processGMap();
  endif;
?>
<?php
  /* Delete GMap  */
  if (isset($_POST['deleteGMap'])):
      $id = sanitize($_POST['deleteGMap']);
      $name = getValue("name", "mod_gmaps", "id='" . $id . "'");

      if ($name) {
          $pluginid = getValue("id", "plugins", "plugalias='gmaps/" . $name . "'");

          $name_clean = str_replace('gmaps/', '', $name);
          $plugin_file_current = WOJOLITE . $gmaps->pluginspath . $name_clean . '/main.php';
          unlink($plugin_file_current);
          rmdir(str_replace('/main.php', '', $plugin_file_current));
          if ($pluginid) {
			  $db->delete("plugins", "id=" . $pluginid);
			  $db->delete("layout", "plug_id=" . $pluginid);
		  }
      }

      $db->delete("mod_gmaps", "id='" . (int)$id . "'");

      $title = sanitize($_POST['title']);
      print ($db->affected()) ? $wojosec->writeLog(MOD_GM_GMAP . ' <strong>' . $title . '</strong> ' . _DELETED, "", "no", "module") . $core->msgOk(MOD_GM_GMAP . ' <strong>' . $title . '</strong> ' . _DELETED) : $core->msgAlert(_SYSTEM_PROCCESS);
  endif;
?>