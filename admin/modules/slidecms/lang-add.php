<?php
  /**
   * Language Data Add
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: lang-add.php, v1.00 2012-12-24 12:12:12 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php
	$db->query('LOCK TABLES mod_slidecms_data WRITE');
	$db->query("ALTER TABLE mod_slidecms_data ADD COLUMN caption_$flag_id VARCHAR(100) NOT NULL AFTER caption_en");
	$db->query('UNLOCK TABLES');

	if($mod_slidecms_data = $db->fetch_all("SELECT * FROM mod_slidecms_data")) {
		foreach ($mod_slidecms_data as $row) {
			$data['caption_' . $flag_id] = $row['caption_en'];
			$db->update("mod_slidecms_data", $data, "id = '".$row['id']."'");
		}
		unset($data, $row);
	}
?>