<?php
  /**
   * Modules
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: modules.php, v2.00 2011-10-15 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");

  define("MODTHEMEURL", ($content->moduledata['theme']) ? SITEURL."/theme/".$content->moduledata['theme'] : THEMEURL);
  define("MODTHEMEDIR", ($content->moduledata['theme'] and is_file(WOJOLITE."theme/".$content->moduledata['theme'].'/mod_index.php')) ? WOJOLITE."theme/".$content->moduledata['theme'] : THEMEDIR);

  $plgresult = $content->getPluginLayoutFront(true);
  $plugtop = $content->searchPluginLayout($plgresult, "top");
  $plugbot = $content->searchPluginLayout($plgresult, "bottom");
  $plugleft = $content->searchPluginLayout($plgresult, "left");
  $plugright = $content->searchPluginLayout($plgresult, "right");

  $totalleft = count($plugleft);
  $totalright = count($plugright);
  $totaltop = count($plugtop);
  $totalbot = count($plugbot);

  if ($core->offline == 1 && $user->is_Admin())
      require_once(MODTHEMEDIR . "/mod_index.php");
  elseif ($core->offline == 1)
      require_once("maintenance.php");
  else
      require_once(MODTHEMEDIR . "/mod_index.php");
?>