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

  require_once (WOJOLITE . "admin/modules/adblock/lang/" . $core->language . ".lang.php");

  class GMaps
  {

      private $mTable = "mod_gmaps";
      private $pTable = "plugins";
      public $gmapsid = null;
      public $pluginspath = "plugins/gmaps/";


      /**
       * GMaps::__construct()
       * 
       * @return
       */
      function __construct()
      {
          $this->getGMapsId();
      }


      /**
       * GMaps::getGMapsId()
       * 
       * @return
       */
      private function getGMapsId()
      {
          global $core;
          if (isset($_GET['gmapsid'])) {
              $gmapsid = (is_numeric($_GET['gmapsid']) && $_GET['gmapsid'] > -1) ? intval($_GET['gmapsid']) : false;
              $gmapsid = sanitize($gmapsid);

              if ($gmapsid == false) {
                  $core->error("You have selected an Invalid GMapsId", "GMaps::getGMapsId()");
              } else
                  return $this->gmapsid = $gmapsid;
          }
      }


      /**
       * GMaps::getGMap()
       * 
       * @return
       */
      public function getGMap()
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

          $sql = "SELECT m.*" 
		  . "\n FROM " . $this->mTable . " as m" 
		  . "\n ORDER BY m.id, m.name" . $pager->limit;
          $row = $db->fetch_all($sql);

          return is_array($row) ? $row : 0;
      }


      /**
       * GMaps::getSingle()
       * 
       * @return
       */
      public function getSingle()
      {
          global $db, $core;

          $sql = "SELECT m.*" 
		  . "\n FROM " . $this->mTable . " as m" 
		  . "\n WHERE id = {$this->gmapsid}";

          $row = $db->first($sql);

          return is_array($row) ? $row : 0;
      }


      /**
       * GMaps::processGMap()
       * 
       * @return
       */
      public function processGMap()
      {
          global $db, $core, $wojosec;

          if (empty($_POST['name']))
              $core->msgs['name'] = MOD_GM_NAME_R;

          if (empty($_POST['lat']) or empty($_POST['lng']))
              $core->msgs['lat'] = MOD_GM_LLERR;

          if (!preg_match('/^[a-z0-9]+$/i', $_POST['name']))
              $core->msgs['name'] = MOD_GM_NAME2_R;

          if ($this->gmapsid) {
              $currentData = $core->getRowById($this->mTable, $this->gmapsid);
              $current_name = $currentData['name'];

              $sqlSelectPlugins = $db->first("SELECT id FROM " . $this->pTable 
											. "\n WHERE plugalias = 'gmaps/" . sanitize($_POST['name']) . "'" 
											. "\n AND plugalias <> 'gmaps/" . $current_name . "'");
          } else {
              $sqlSelectPlugins = $db->first("SELECT id FROM " . $this->pTable 
											. "\n WHERE plugalias = 'gmaps/" . sanitize($_POST['name']) . "'");
          }

          $existingPluginsRow = $sqlSelectPlugins;
          $existingPluginsId = $existingPluginsRow['id'];

          if ($existingPluginsId)
              $core->msgs['name'] = MOD_GM_NAME_EXISTS;

          if (empty($core->msgs)) {
              $data = array(
                  'name' => sanitize($_POST['name']),
                  'lat' => sanitize($_POST['lat']),
                  'lng' => sanitize($_POST['lng']),
                  'zoom' => intval($_POST['zoom']));

              $mode = ($this->gmapsid) ? 'update' : 'insert';

              $current_name = '';
              //get current value of name column
              if ($mode == 'update') {
                  $currentData = $core->getRowById($this->mTable, $this->gmapsid);
                  $current_name = $currentData['name'];
                  $current_name_clean = str_replace('gmaps/', '', $current_name);
              }

              $gmaps_clean = str_replace('gmaps/', '', $data['name']);
              $plugin_file = WOJOLITE . $this->pluginspath . $gmaps_clean . '/main.php';
              $plugin_file_main = WOJOLITE . $this->pluginspath . 'main.php';

              if ($mode == 'insert' && is_dir(str_replace('/main.php', '', $plugin_file))) {
                  $core->msgs['name'] = MOD_GM_NAME_EXISTS;
                  print $core->msgStatus();
                  return;
              }

              ($mode == 'update') ? $db->update($this->mTable, $data, "id='" . (int)$this->gmapsid . "'") : $db->insert($this->mTable, $data);
              $message = ($mode == 'update') ? MOD_GM_GUPDATED : MOD_GM_GADDED;

              $this->gmapsid = $this->gmapsid ? $this->gmapsid : $db->insertid();


              if ($mode == 'insert') {
                  mkdir(str_replace('/main.php', '', $plugin_file));
                  file_put_contents($plugin_file, str_replace('###GMAPSID###', $this->gmapsid, file_get_contents($plugin_file_main)));

				  $datai = array(
					  'title' . $core->dblang => 'Google Maps - ' . $gmaps_clean,
					  'system' => 1,
					  'plugalias' => 'gmaps/' . $data['name'],
					  'created' => "NOW()",
					  'active' => 1,
					  );

				  $db->insert($this->pTable, $datai);
              } else
                  if ($current_name != $data['name']) {
                      $plugin_file_current = WOJOLITE . $this->pluginspath . $current_name_clean . '/main.php';
                      unlink($plugin_file_current);
                      rmdir(str_replace('/main.php', '', $plugin_file_current));

                      mkdir(str_replace('/main.php', '', $plugin_file));
                      file_put_contents($plugin_file, str_replace('###GMAPSID###', $this->gmapsid, file_get_contents($plugin_file_main)));

					  $datau = array(
						  'title' . $core->dblang => 'Google Maps - ' . $gmaps_clean,
						  'system' => 1,
						  'plugalias' => 'gmaps/' . $data['name']
						  );
					  
					  $db->update($this->pTable, $datau, "plugalias='" . $current_name . "'");
                  }

              ($this->gmapsid) ? $wojosec->writeLog($message, "", "no", "module") . $core->msgOk($message) : $core->msgAlert(_SYSTEM_PROCCESS);


          } else
              print $core->msgStatus();
      }

  }
?>