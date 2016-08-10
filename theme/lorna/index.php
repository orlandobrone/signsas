<?php
  /**
   * Index
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: index.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php include("header.php");?>
<?php if($content->slug and $core->showcrumbs):?>
<!-- Breadcrumbs -->
<section id="crumbs" class="row">
  <div class="container">
    <div class="clearfix">
      <div class="col grid_12">
        <h3><?php echo $content->title;?></h3>
      </div>
      <div class="col grid_12">
        <nav><?php echo _YOUAREHERE;?>: <em><a href="<?php echo SITEURL;?>/index.php"><?php echo _HOME;?></a> &rsaquo; <?php echo $content->getBreadcrumbs();?></em></nav>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumbs /-->
<?php endif;?>
<?php if ($plugtop): ?>
<?php if($content->slug):?>
<!-- Top Plugins /-->
<section id="topplugin" class="clearfix">
  <div class="container">
    <div class="row">
      <?php include(WOJOLITE . "includes/top_plugins.php");?>
    </div>
  </div>
</section>
<!-- Top Plugins /-->
<?php else:?>
<!-- Top Plugins /-->
<section id="home-top-plugin">
  <div class="row grid_24">
    <?php include(WOJOLITE . "includes/top_plugins.php");?>
  </div>
</section>
<!-- Top Plugins /-->
<?php endif;?>
<?php endif; ?>

<!-- Left and Right Layout -->
<div class="container">
  <?php switch(true): case $totalleft >= 1 && $totalright >= 1: ?>
  <div id="content-left-right" class="row grid_24">
    <div class="clearfix" id="page">
     
      <div id="maincontent" class="col grid_24">
        <?php $content->displayPage();?>
      </div>
      
    </div>
  </div>
  <?php break;?>
  <!-- Left and Right Layout /--> 
  
  <!-- Left Layout -->
  <?php case $totalleft >= 1: ?>
  <div id="content-left" class="row grid_24">
    <div id="page" class="clearfix">
      
      <div id="maincontent" class="grid_24">
        <?php $content->displayPage();?>
      </div>
    </div>
  </div>
  <?php break;?>
  <!-- Left Layout /--> 
  
  <!-- Right Layout -->
  <?php case $totalright >= 1: ?>
  <div id="page" class="grid_24">
      
        <?php $content->displayPage();?>
      
     
    
  </div>
  <?php break;?>
  <!-- Right Layout -->
  
  <?php default: ?>
  <!-- Full Layout -->
  <div id="page" class="row grid_24">
    <?php $content->displayPage();?>
  </div>
  <?php break;?>
  <!-- Full Layout /-->
  <?php endswitch;?>
</div>

<?php if ($plugbot): ?>
<!-- Bottom Plugins -->
<section id="botplugin">
  <div class="container">
    <div class="row">
      <?php include(WOJOLITE . "includes/bot_plugins.php");?>
    </div>
  </div>
</section>
<!-- Bottom Plugins /-->
<?php endif; ?>
<?php include("footer.php");?>