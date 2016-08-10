<?php
  /**
   * Gogole Maps
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: class_admin.php, v1.00 2012-12-24 12:12:12 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  if(!$user->getAcl("adblock")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
  
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  $gmaps = new GMaps();
?>
<?php switch($core->maction): case "edit": ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<?php $row = $gmaps->getSingle();?>
<div class="block-top-header">
  <h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_GM_TITLE1;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo MOD_GM_INFO1 . _REQ1 . required() . _REQ2;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><?php echo MOD_GM_SUBTITLE1.' &rsaquo; '.$row['name'];?></h2>
  </div>
  <div class="block-content">
    <form action="#" method="post" id="admin_form" name="admin_form">
      <table class="forms">
        <tfoot>
          <tr>
            <td><div class="button arrow">
                <input type="submit" value="<?php echo MOD_GM_EDIT;?>" name="dosubmit" />
                <span></span></div></td>
            <td><a href="index.php?do=modules&amp;action=config&amp;mod=gmaps" class="button-orange"><?php echo _CANCEL;?></a></td>
          </tr>
        </tfoot>
        <tbody>
          <tr>
            <th><?php echo MOD_GM_NAME;?>: <?php echo required();?></th>
            <td><input name="name" type="text" class="inputbox" value="<?php echo $row['name'];?>" size="55" title="<?php echo MOD_GM_NAME_R;?>"/></td>
          </tr>
          <tr>
            <th><?php echo MOD_GM_ZOOM_LEVEL;?>:</th>
            <td><input name="zoom" type="text" class="inputbox" id="zoomlevel" value="<?php echo $row['zoom'];?>" size="5" readonly="readonly"/></td>
          </tr>
          <tr>
            <th><?php echo MOD_GM_LOCATION?>: <?php echo required();?></th>
            <td><div  style="position:relative">
                <div style="position:absolute;z-index:5000;right:160px;top:5px">
                  <input name="address" type="text" class="inputbox-sml" id="address" size="35"/>
                  <input type="button" value="Search" class="button" id="lookup"/>
                </div>
                <div id="map" style="width:100%;height:350px;z-index:4000"></div>
              </div></td>
          </tr>
          <tr>
            <th>&nbsp;</th>
            <td><?php echo MOD_GM_MAPINFO;?></td>
          </tr>
        </tbody>
      </table>
      <input name="gmapsid" type="hidden" value="<?php echo $gmaps->gmapsid;?>" />
      <input name="lat" id="lat" type="hidden" value="<?php echo $row['lat']?>" />
      <input name="lng" id="lng" type="hidden" value="<?php echo $row['lng']?>" />
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[
 var map = null;
  $(document).ready(function () {
	  var geocoder;
	  geocoder = new google.maps.Geocoder();
	  var latitude = parseFloat("<?php echo $row['lat']?>");
	  var longitude = parseFloat("<?php echo $row['lng']?>");
	  loadMap(latitude, longitude);
	  setupMarker(latitude, longitude);

	  $('#lookup').click(function () {
		  var address = document.getElementById('address').value;
		  geocoder.geocode({
			  'address': address
		  }, function (results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				  map.setCenter(results[0].geometry.location);
				  var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
				  var marker = new google.maps.Marker({
					  map: map,
					  draggable: true,
					  raiseOnDrag: false,
					  icon: image,
					  position: results[0].geometry.location
				  });
				  $("#lat").val(results[0].geometry.location.lat());
				  $("#lng").val(results[0].geometry.location.lng());
			  
				  google.maps.event.addListener(marker, 'dragend', function (event) {
					  $("#lat").val(this.getPosition().lat());
					  $("#lng").val(this.getPosition().lng());
				  });			  
			  } else {
				  alert('Geocode was not successful for the following reason: ' + status);
			  }

		  });
	  });

	  google.maps.event.addListener(map, 'zoom_changed', function () {
		  document.getElementById('zoomlevel').value = map.getZoom();
	  });
  });
   // Loads the maps
  loadMap = function (latitude, longitude) {
	  var latlng = new google.maps.LatLng(latitude, longitude);
	  var myOptions = {
		  zoom: <?php echo $row['zoom'];?> ,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById("map"), myOptions);
  }
  
  setupMarker = function (latitude, longitude) {
	  var pos = new google.maps.LatLng(latitude, longitude);
	  var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
	  var marker = new google.maps.Marker({
		  position: pos,
		  map: map,
          draggable: true,
          raiseOnDrag: false,
		  icon: image,
		  title: name
	  });
	  /*
	  var info = "";
	  google.maps.event.addListener(marker, 'click', function () {
		  var infowindow = new google.maps.InfoWindow({
			  content: info
		  });
		  infowindow.open(map, marker);
	  });
	  */
	  google.maps.event.addListener(marker, 'dragend', function (event) {
		  $("#lat").val(this.getPosition().lat());
		  $("#lng").val(this.getPosition().lng());
	  });
  }
</script> 
<?php echo $core->doForm("processGMaps","modules/gmaps/controller.php");?>
<?php break;?>
<?php case"add": ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<div class="block-top-header">
  <h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_GM_TITLE2;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo MOD_GM_INFO2 . _REQ1 . required() . _REQ2;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><?php echo MOD_GM_SUBTITLE2;?></h2>
  </div>
  <div class="block-content">
    <form action="#" method="post" id="admin_form" name="admin_form">
      <table class="forms">
        <tfoot>
          <tr>
            <td><div class="button arrow">
                <input type="submit" value="<?php echo MOD_GM_ADD;?>" name="dosubmit" />
                <span></span></div></td>
            <td><a href="index.php?do=modules&amp;action=config&amp;mod=gmaps" class="button-orange"><?php echo _CANCEL;?></a></td>
          </tr>
        </tfoot>
        <tbody>
          <tr>
            <th><?php echo MOD_GM_NAME;?>: <?php echo required();?></th>
            <td><input name="name" type="text" class="inputbox" size="55" /></td>
          </tr>
          <tr>
            <th><?php echo MOD_GM_ZOOM_LEVEL;?>:</th>
            <td><input name="zoom" type="text" class="inputbox" id="zoomlevel" value="13" size="5" readonly="readonly" /></td>
          </tr>
          <tr>
            <th><?php echo MOD_GM_LOCATION?>: <?php echo required();?></th>
            <td><div  style="position:relative">
                <div style="position:absolute;z-index:5000;right:160px;top:5px">
                  <input name="address" type="text" class="inputbox-sml" id="address" size="35"/>
                  <input type="button" value="Search" class="button" id="lookup"/>
                </div>
                <div id="map" style="width:100%;height:350px;z-index:4000"></div>
              </div></td>
          </tr>
          <tr>
            <th>&nbsp;</th>
            <td><?php echo MOD_GM_MAPINFO;?></td>
          </tr>
        </tbody>
      </table>
      <input name="lat" id="lat" type="hidden"  />
      <input name="lng" id="lng" type="hidden"  />
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[
 var map = null;
  $(document).ready(function () {
	  var geocoder;
	  geocoder = new google.maps.Geocoder();
	  var latitude = 43.652527;
	  var longitude = -79.381961;
	  loadMap(latitude, longitude);

	  $('#lookup').click(function () {
		  var address = document.getElementById('address').value;
		  geocoder.geocode({
			  'address': address
		  }, function (results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				  map.setCenter(results[0].geometry.location);
				  var image = new google.maps.MarkerImage('<?php echo SITEURL;?>/assets/pin.png');
				  var marker = new google.maps.Marker({
					  map: map,
					  draggable: true,
					  raiseOnDrag: false,
					  icon: image,
					  position: results[0].geometry.location
				  });
				  $("#lat").val(results[0].geometry.location.lat());
				  $("#lng").val(results[0].geometry.location.lng());
			  
				  google.maps.event.addListener(marker, 'dragend', function (event) {
					  $("#lat").val(this.getPosition().lat());
					  $("#lng").val(this.getPosition().lng());
				  });			  
			  } else {
				  alert('Geocode was not successful for the following reason: ' + status);
			  }

		  });
	  });

	  google.maps.event.addListener(map, 'zoom_changed', function () {
		  document.getElementById('zoomlevel').value = map.getZoom();
	  });
  });
   // Loads the maps
  loadMap = function (latitude, longitude) {
	  var latlng = new google.maps.LatLng(latitude, longitude);
	  var myOptions = {
		  zoom: 13,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById("map"), myOptions);
  }
// ]]>
</script> 
<?php echo $core->doForm("processGMaps","modules/gmaps/controller.php");?>
<?php break;?>
<?php default: ?>
<?php $gmrow = $gmaps->getGMap();?>
<div class="block-top-header">
  <h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_GM_TITLE4;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo MOD_GM_INFO4;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><span><a href="index.php?do=modules&amp;action=config&amp;mod=gmaps&amp;mod_action=add"><?php echo MOD_GM_ADD;?></a></span><?php echo MOD_GM_SUBTITLE3 . $content->getModuleName(get("mod"));?></h2>
  </div>
  <div class="block-content">
    <table class="display sortable-table">
      <thead>
        <tr>
          <th class="firstrow">#</th>
          <th class="left sortable"><?php echo MOD_GM_NAME;?></th>
          <th class="left sortable"><?php echo MOD_GM_LAT;?></th>
          <th class="left sortable"><?php echo MOD_GM_LNG;?></th>
          <th class="left sortable"><?php echo MOD_GM_ZOOM_LEVEL;?></th>
          <th><?php echo _EDIT;?></th>
          <th><?php echo _DELETE;?></th>
        </tr>
      </thead>
      <?php if($pager->display_pages()):?>
      <tfoot>
        <tr>
          <td colspan="6"><div class="pagination"><?php echo $pager->display_pages();?></div></td>
        </tr>
      </tfoot>
      <?php endif;?>
      <tbody>
        <?php if(!$gmrow):?>
        <tr>
          <td colspan="7"><?php echo $core->msgAlert(MOD_GM_NOGMAPS,false);?></td>
        </tr>
        <?php else:?>
        <?php foreach ($gmrow as $row):?>
        <tr>
          <th><?php echo $row['id'];?>.</th>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['lat'];?></td>
          <td><?php echo $row['lng'];?></td>
          <td><?php echo $row['zoom'];?></td>
          <td class="center"><a href="index.php?do=modules&amp;action=config&amp;mod=gmaps&amp;mod_action=edit&amp;gmapsid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _EDIT;?>"/></a></td>
          <td class="center"><a href="javascript:void(0);" class="delete" data-title="<?php echo $row['name'];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
        </tr>
        <?php endforeach;?>
        <?php unset($row);?>
        <?php endif;?>
      </tbody>
    </table>
  </div>
</div>
<?php echo Core::doDelete(_DELETE.' '.MOD_GM_GMAP, "deleteGMap","modules/gmaps/controller.php");?> 
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $(".sortable-table").tablesorter({
        headers: {
            0: {
                sorter: false
            },
            5: {
                sorter: false
            },
            6: {
                sorter: false
            }
        }
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>