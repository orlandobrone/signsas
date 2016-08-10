<?php
  /**
   * Language Data Add
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: lang-add.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php
	$db->query('LOCK TABLES plug_content_slider WRITE');
	$db->query("ALTER TABLE plug_content_slider ADD title_$flag_id VARCHAR(150) NOT NULL AFTER title_en");
	$db->query("ALTER TABLE plug_content_slider ADD description_$flag_id TEXT AFTER description_en");
	$db->query('UNLOCK TABLES');

	if($plug_content_slider = $db->fetch_all("SELECT * FROM plug_content_slider")) {
		foreach ($plug_content_slider as $row) {
			$data['title_' . $flag_id] = $row['title_en'];
			$data['description_' . $flag_id] = $row['description_en'];
			$db->update("plug_content_slider", $data, "id = '".$row['id']."'");
		}
		unset($data, $row);
	}
?>