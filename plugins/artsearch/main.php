<?php
  /**
   * Article Search
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-09-25 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php $surl = ($core->seo == 1) ? $core->site_url . '/article-search/' : $core->site_url . '/modules.php?module=articles&amp;do=article-search';?>
<!-- Start Article Search -->
<form action="<?php echo $surl;?>" method="post">
  <div style="height:40px;border:1px solid rgba(0,0,0,0.2);border-radius:2px;box-shadow:inset 0px 0px 0px 3px rgba(0, 0, 0, 0.1);background-color:#eee;">
    <input name="submit-search" type="submit" style="border:0;padding:0;margin:0;width:40px;height:34px;margin-right:3px;background-image:url(<?php echo SITEURL;?>/plugins/artsearch/images/button.png);background-repeat: no-repeat;background-position:0 0;cursor:pointer;font-size:12px;float:right;margin-top:3px;background-color:#5fa3d2;" value=""/><input type="text" name="keywords" style="width:100%;padding:0;border:0;margin:0;height:40px;line-height:40px;background-color:transparent;text-indent:10px;margin-right:-48px;outline:none;font-family:Arial, Helvetica, Garuda, sans-serif;font-size:14px"/>
    
  </div>
</form>
<!-- End Article Search /-->