<?php
  /**
   * Google Maps Class
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: class_admin.php, v1.00 2012-12-24 12:12:12 gewa Exp $
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class slideCMS
  {

      private $mTable = "mod_slidecms";
	  private $dTable = "mod_slidecms_data";
      private $pTable = "plugins";
      public $sliderid = null;
      const pluginspath = "plugins/slidecms/";
	  const maxFile = 3145728;
	  private static $fileTypes = array("jpg","jpeg","png");


      /**
       * slideCMS::__construct()
       * 
       * @return
       */
      function __construct()
      {
          $this->getSliderId();
      }


      /**
       * slideCMS::getSliderId()
       * 
       * @return
       */
      private function getSliderId()
      {
          global $core;
          if (isset($_GET['sliderid'])) {
              $sliderid = (is_numeric($_GET['sliderid']) && $_GET['sliderid'] > -1) ? intval($_GET['sliderid']) : false;
              $sliderid = sanitize($sliderid);

              if ($sliderid == false) {
                  $core->error("You have selected an Invalid SliderId", "slideCMS::getSliderId()");
              } else
                  return $this->sliderid = $sliderid;
          }
      }


      /**
       * slideCMS::getSliders()
       * 
       * @return
       */
      public function getSliders()
      {
          global $db, $core, $pager;

          require_once (WOJOLITE . "lib/class_paginate.php");
          $pager = new Paginator();

          $counter = countEntries($this->mTable);

          $pager->items_total = $counter;
          $pager->default_ipp = $core->perpage;
          $pager->paginate();

          if ($counter == 0) {
              $pager->limit = null;
          }

          $sql = "SELECT *" 
		  . "\n FROM " . $this->mTable
		  . "\n ORDER BY title" . $pager->limit;
          $row = $db->fetch_all($sql);

          return is_array($row) ? $row : 0;
      }

      /**
       * slideCMS::getSliderData()
       * 
	   * @param bool $sid
       * @return
       */
      public function getSliderData($sid = false)
      {
          global $db, $core;
		  
		  $id = ($sid) ? $sid : $this->sliderid;

          $sql = "SELECT *" 
		  . "\n FROM " . $this->dTable
		  . "\n WHERE slider_id = '".(int)$id."'"
		  . "\n ORDER BY sorting";
          $row = $db->fetch_all($sql);

          return is_array($row) ? $row : 0;
      }

	  /**
	   * slideCMS::loadPhotos()
	   * 
	   * @param int $sid
	   * @param mixed $sfolder
	   * @return
	   */

	  public function loadPhotos($sid, $sfolder)
	  {
		  global $core;
		  
		  if ($picrow = $this->getSliderData($sid)) {
			  foreach ($picrow as $row) {
				  print '
					<div class="sliderdata" id="sid_' .$row['id'] . '">
					  <div class="slider-inner">';
					  print '<figure>';
					     if($row['data_type'] == "vid") {
							 print '<img src="../plugins/slidecms/thumbmaker.php?src=../plugins/slidecms/images/video.png&amp;w=400&amp;h=250" alt="" class="slimage" />';
						 } else {
							 print '<img src="../plugins/slidecms/thumbmaker.php?src=../plugins/' . $sfolder . '/slides/' . $row['data'] . '&amp;w=400&amp;h=250" alt="" class="slimage" />';
						 }
                      print '</figure>
					  <div class="title">
					  <a href="javascript:void(0);" data-title="' . $row['caption'.$core->dblang] . '"  class="delete" id="item_' . $row['id'].'::' . $sfolder . '">
					  <img src="images/trash.png" alt="" title="' .  _DELETE . '" class="tooltip"/></a>
					  <a href="javascript:void(0);" data-title="' . $row['caption'.$core->dblang] . '" class="edit" id="list_' . $row['id'] . '">
					  <img src="images/pencil.png" alt="" title="' . _EDIT . '" class="tooltip"/></a>' . character_limiter($row['caption'.$core->dblang],50) . '
					  </div>
					</div>
				</div>';
			  }
		  }
	  }
                
      /**
       * slideCMS::editSlider()
       * 
       * @return
       */
      public function editSlider()
      {
          global $db, $core, $wojosec;

          if (empty($_POST['title']))
              $core->msgs['title'] = MOD_SLC_NAME_R;

          if (empty($core->msgs)) {
              $data = array(
                  'height' => empty($_POST['height']) ? 400 :  intval($_POST['height']),
                  'navtype' => sanitize($_POST['navtype']),
                  'navpos' => sanitize($_POST['navpos']),
				  'navplace' => sanitize($_POST['navplace']),
                  'navarrows' => intval($_POST['navarrows']),
				  'fullscreen' => intval($_POST['fullscreen']),
				  'transition' => sanitize($_POST['transition']),
				  'durration' => intval($_POST['durration']),
				  'captions' => intval($_POST['captions']),
				  'autoplay' => intval($_POST['autoplay']),
				  'loop' => intval($_POST['loop']),
				  'fit' => sanitize($_POST['fit']),
				  'shuffle' => intval($_POST['shuffle']),
				  );

              $db->update($this->mTable, $data, "id='" . (int)$this->sliderid . "'");
              ($this->sliderid) ? $wojosec->writeLog(MOD_SLC_GUPDATED, "", "no", "module") . $core->msgOk(MOD_SLC_GUPDATED) : $core->msgAlert(_SYSTEM_PROCCESS);

          } else
              print $core->msgStatus();
      }

      /**
       * slideCMS::addSlider()
       * 
       * @return
       */
	  public function addSlider()
	  {
		  global $db, $core, $wojosec;
	
		  if (empty($_POST['title']))
			  $core->msgs['title'] = MOD_SLC_NAME_R;
	
		  if (empty($core->msgs)) {
			  $data = array(
				  'title' => sanitize($_POST['title']),
				  'height' => empty($_POST['height']) ? 400 : intval($_POST['height']),
				  'plug_name' => "slidecms/" . sanitize(paranoia($_POST['title']),25),
				  'navtype' => sanitize($_POST['navtype']),
				  'navpos' => sanitize($_POST['navpos']),
				  'navplace' => sanitize($_POST['navplace']),
				  'navarrows' => intval($_POST['navarrows']),
				  'fullscreen' => intval($_POST['fullscreen']),
				  'transition' => sanitize($_POST['transition']),
				  'durration' => intval($_POST['durration']),
				  'captions' => intval($_POST['captions']),
				  'autoplay' => intval($_POST['autoplay']),
				  'loop' => intval($_POST['loop']),
				  'fit' => sanitize($_POST['fit']),
				  'shuffle' => intval($_POST['shuffle']),
				  );
	
			  $last_id = $db->insert($this->mTable, $data);
	
			  $plugin_file_main = WOJOLITE . slideCMS::pluginspath . 'main.php';
			  $slider_clean = str_replace('slidecms/', '', $data['plug_name']);
			  $plugin_file = WOJOLITE . slideCMS::pluginspath . $slider_clean . '/main.php';
			  mkdir(str_replace('/main.php', '', $plugin_file));
			  file_put_contents($plugin_file, str_replace('###SLIDERID###', $last_id, file_get_contents($plugin_file_main)));
			  mkdir(WOJOLITE . 'plugins/' . $data['plug_name'] . '/slides');
	
			  $datap = array(
				  'title' . $core->dblang => 'Slider - ' . $slider_clean,
				  'system' => 1,
				  'plugalias' => $data['plug_name'],
				  'created' => "NOW()",
				  'active' => 1,
				  );

			  $db->insert($this->pTable, $datap);
				  
			  ($db->affected()) ? $wojosec->writeLog(MOD_SLC_GADDED, "", "no", "module") . $core->msgOk(MOD_SLC_GADDED) : $core->msgAlert(_SYSTEM_PROCCESS);
	
		  } else
			  print $core->msgStatus();
	  }
	  
      /**
       * slideCMS::processVideo()
       * 
       * @return
       */
      public function processVideo($sid)
      {
          global $db, $core, $wojosec;

          if (empty($_POST['vurl']))
              $core->msgs['vurl'] = MOD_SLC_VIDURL_R;

          if (empty($core->msgs)) {
              $data = array(
                  'slider_id' => intval($sid),
                  'data_type' => "vid",
                  'data' => sanitize($_POST['vurl']),
                  'caption'.$core->dblang => sanitize($_POST['title']),
				  'created' => "NOW()"
				  );
               
			   $db->insert($this->dTable, $data);
              ($this->sliderid) ? $wojosec->writeLog($message, "", "no", "module") . $core->msgOk(MOD_SLC_VADDED) : $core->msgAlert(_SYSTEM_PROCCESS);


          } else
              print $core->msgStatus();
      }
	  
	  /**
	   * slideCMS::doUpload()
	   * 
	   * @return
	   */
	  public function doUpload($sid, $sfolder)
	  {
		  global $db, $core;
		  
		  if (self::validateUpload($sfolder) == true) {
			  $filedir = WOJOLITE . 'plugins/' . $sfolder . '/slides/';
			  $newName = "IMG_" . randName();
			  $ext = substr($_FILES['filedata']['name'], strrpos($_FILES['filedata']['name'], '.') + 1);
			  $fullname = $filedir . $newName . "." . strtolower($ext);
			  move_uploaded_file($_FILES['filedata']['tmp_name'], $fullname);

			  $data = array(
					'slider_id' => $sid, 
					'data' => $newName . "." . strtolower($ext),
					'data_type' => "img",  
					'caption'.$core->dblang => "-/-", 
					'created' => "NOW()"
					);
			  
			  $db->insert($this->dTable, $data);
			  
			  self::doJason(array(
				  "success" => true,
				  "id" => $_POST["fileid"],
				  "instanceid" => self::isXhrMethod() ? "" : $_POST["instanceid"],
				  "file" => array(
					  "name" => $_FILES["filedata"]["name"],
					  "mime" => $_FILES["filedata"]["type"],
					  "size" => $_FILES["filedata"]["size"],
					  "id" => $_POST["fileid"])));
		  }
	  }
	  
	  /**
	   * slideCMS::doJason()
	   * 
	   * @param mixed $result
	   * @return
	   */
	  public static function doJason($result)
	  {
		  $json = json_encode($result);
	
		  if (self::isXhrMethod()) {
			  header("Content-Type: application/json");
			  echo $json;
		  } else {
			  $instanceid = $result['instanceid'];
            echo "
			<script type=\"text/javascript\">
				parent.jQuery.fn.FileUploader.Instances['" . $instanceid."'].onComplete(eval('(".$json.")'));
			</script>";
            }
	  }

	  /**
	   * slideCMS::getFileExt()
	   * 
	   * @return
	   */
	  private static function getFileExt()
	  {
		  $name = $_FILES["filedata"]["name"];
		  $parts = explode(".", $name);
		  $last = sizeof($parts) - 1;
	
		  return (sizeof($parts) < 2) ? "" : strtolower($parts[$last]);
	  }

	  /**
	   * slideCMS::isXhrMethod()
	   * 
	   * @return
	   */
	  private static function isXhrMethod()
	  {
		  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	  }

	  /**
	   * slideCMS::isPostMethod()
	   * 
	   * @return
	   */
	  private static function isPostMethod()
	  {
		  return ($_SERVER["REQUEST_METHOD"] == "POST" or self::isXhrMethod());
	  }

	  /**
	   * slideCMS::validateUpload()
	   * 
	   * @return
	   */
	  private static function validateUpload($sfolder)
	  {
		  if (!self::isPostMethod()) {
			  self::doJason(array(
				  "success" => false, 
				  "message" => "This request type is not supported"));
			  return false;
		  }
	
		  if (isset($_POST["fileid"]) == false) {
			  self::doJason(array(
				  "success" => false, 
				  "message" => "No file was identified"));
			  return false;
		  }
	
		  if (sizeof($_FILES) == 0) {
			  self::doJason(array(
				  "success" => false,
				  "message" => "No file can be detected",
				  "instanceid" => $_POST["instanceid"],
				  "id" => $_POST["fileid"]));
			  return false;
		  }
	
		  if (self::maxFile != null && self::maxFile < $_FILES["filedata"]["size"]) {
			  self::doJason(array(
				  "success" => false,
				  "message" => str_replace("[LIMIT]", getSize($this->maxFile), MOD_GA_ERRFILESIZE_T),
				  "id" => $_POST["fileid"],
				  "instanceid" => self::isXhrMethod() ? "" : $_POST["instanceid"],
				  "file" => array(
					  "name" => $_FILES["filedata"]["name"],
					  "mime" => $_FILES["filedata"]["type"],
					  "size" => $_FILES["filedata"]["size"],
					  "id" => $_POST["fileid"])));
	
			  return false;
		  }
	
		  if (self::$fileTypes != null && in_array(self::getFileExt(), self::$fileTypes) == false) {
			  self::doJason(array(
				  "success" => false,
				  "message" => MOD_GA_ERRFILETYPE_T,
				  "id" => $_POST["fileid"],
				  "instanceid" => self::isXhrMethod() ? "" : $_POST["instanceid"],
				  "file" => array(
					  "name" => $_FILES["filedata"]["name"],
					  "mime" => $_FILES["filedata"]["type"],
					  "size" => $_FILES["filedata"]["size"],
					  "id" => $_POST["fileid"])));
	
			  return false;
		  }
	
		  if (!is_dir(WOJOLITE . 'plugins/' . $sfolder . '/slides/')) {
			  self::doJason(array(
				  "success" => false, 
				  "message" => MOD_SLC_UPLDIR,
				  "id" => $_POST["fileid"],
				  "instanceid" => self::isXhrMethod() ? "" : $_POST["instanceid"],
				  "file" => array(
					  "name" => $_FILES["filedata"]["name"],
					  "mime" => $_FILES["filedata"]["type"],
					  "size" => $_FILES["filedata"]["size"],
					  "id" => $_POST["fileid"])));
	
			  return false;
		  }
	
		  if (!is_writeable(WOJOLITE . 'plugins/' . $sfolder . '/slides/')) {
			  self::doJason(array(
				  "success" => false, 
				  "message" => str_replace("[DIRNAME]", 'plugins/'  . $sfolder . '/slides/', MOD_SLC_DIRNW),
				  "id" => $_POST["fileid"],
				  "instanceid" => self::isXhrMethod() ? "" : $_POST["instanceid"],
				  "file" => array(
					  "name" => $_FILES["filedata"]["name"],
					  "mime" => $_FILES["filedata"]["type"],
					  "size" => $_FILES["filedata"]["size"],
					  "id" => $_POST["fileid"])));
	
			  return false;
		  }
		  
		  return true;
	  }
  }
?>