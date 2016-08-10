<?php
  /**
   * Content
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: index.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  require_once("init.php");
  
  $plgresult = $content->getPluginLayoutFront();
  $plugtop = $content->searchPluginLayout($plgresult, "top");
  $plugbot = $content->searchPluginLayout($plgresult, "bottom");
  $plugleft = $content->searchPluginLayout($plgresult, "left");
  $plugright = $content->searchPluginLayout($plgresult, "right");
  
  $totalleft = count($plugleft);
  $totalright = count($plugright);
  $totaltop = count($plugtop);
  $totalbot = count($plugbot);
  
  $core->getVisitors(); // visitor counter
  if ($core->offline == 1 && $user->is_Admin())
      require_once(THEMEDIR . "/index.php");
  elseif ($core->offline == 1)
      require_once("maintenance.php");
  else
      require_once(THEMEDIR . "/index.php");
?>