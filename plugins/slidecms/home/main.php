<?php
  /**
   * Slider Manager
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2013
   * @version $Id: main.php, v1.00 2013-09-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');


  if (class_exists('slideCMS')) {
	  $slider = new slideCMS();	
  } else {
	  require(WOJOLITE . "admin/modules/slidecms/admin_class.php");
	  $slider = new slideCMS();	
  }
  
  $id = intval('1');
  $row = $core->getRowById("mod_slidecms", $id);
  if($row)
	  $sliderdata = $slider->getSliderData($id);
?>
<script type="text/javascript">
function isMyScriptLoaded(url) {
    scripts = document.getElementsByTagName('script');
    for (var i = scripts.length; i--;) {
        if (scripts[i].src == url) return true;
    }
    return false;
}

if (!isMyScriptLoaded('plugins/slidecms/sliderscript.js')) {
	document.write('<script type="text/javascript" src="plugins/slidecms/sliderscript.js"><\/script>');
}

if (!$("link[href='plugins/slidecms/slidercss.css']").length)
    $('<link href="plugins/slidecms/slidercss.css" rel="stylesheet">').appendTo("head");
</script>
<?php if($sliderdata):?>
<div id="slidecms_<?php echo $id;?>">
  <?php foreach ($sliderdata as $srow):?>
  <?php if($srow['data_type'] == "vid"):?>
  <a href="<?php echo $srow['data'];?>"<?php if($row['captions']):?> data-caption="<?php echo $srow['caption' . $core->dblang];?><?php endif;?>"><?php echo $srow['caption' . $core->dblang];?></a>
  <?php else:?>
  <a href="plugins/<?php echo $row['plug_name'];?>/slides/<?php echo $srow['data'];?>" <?php if($row['captions']):?> data-caption="<?php echo $srow['caption' . $core->dblang];?>"<?php endif;?>><img src="plugins/slidecms/thumbmaker.php?src=plugins/<?php echo $row['plug_name'];?>/slides/<?php echo $srow['data'];?>&amp;w=100&amp;h=60&amp;s=1&amp;t=1" alt=""  /></a>
  <?php endif;?>
  <?php endforeach;?>
</div>
<?php unset($srow);?>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
	$('#slidecms_<?php echo $id;?>').fotorama({
		width: '100%',
		nav: '<?php echo $row['navtype'];?>',
		navposition:'<?php echo $row['navpos'];?>',
		arrows: <?php echo $row['navarrows'] ? 'true' : 'false';?>,
		navposplace: '<?php echo $row['navplace'];?>',
		height: <?php echo $row['height'];?>,
		shuffle: <?php echo $row['shuffle'] ? 'true' : 'false';?>,
		allowfullscreen: <?php echo $row['fullscreen'] ? 'true' : 'false';?>,
		transition: '<?php echo $row['transition'];?>',
		autoplay: <?php echo $row['autoplay'] ? 'true' : 'false';?>,
		loop: <?php echo $row['loop'] ? 'true' : 'false';?>,
		fit: '<?php echo $row['fit'];?>',
		thumbwidth: 100,
		thumbheight: 60,
	});
});
// ]]>
</script>
<?php unset($row);?>
<?php endif;?>
