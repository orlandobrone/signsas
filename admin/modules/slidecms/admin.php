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
  
  if(!$user->getAcl("slidecms")): print $core->msgAlert(_CG_ONLYADMIN, false); return; endif;
  
  require_once("lang/" . $core->language . ".lang.php");
  require_once("admin_class.php");
  $slider = new slideCMS();
?>
<?php switch($core->maction): case "edit": ?>
<?php $row = $core->getRowById("mod_slidecms", $slider->sliderid);?>
<?php $sliderdata = $slider->getSliderData();?>
<div class="block-top-header">
  <h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_SLC_TITLE1;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo MOD_SLC_INFO1 . _REQ1 . required() . _REQ2;?></p>
<div class="block-border">
  <div class="block-header">
    <ul class="idTabs" id="tabs">
      <li><a href="#general"><?php echo MOD_SLC_CONFG;?></a></li>
      <li><a href="#data"><?php echo MOD_SLC_CONFD;?></a></li>
    </ul>
    <h2><?php echo MOD_SLC_SUBTITLE1.' &rsaquo; '.$row['title'];?></h2>
  </div>
  <div class="block-content">
    <div id="general" class="tab_content">
      <form action="#" method="post" id="admin_form" name="admin_form">
        <table class="forms">
          <tfoot>
            <tr>
              <td><div class="button arrow">
                  <input type="submit" value="<?php echo MOD_SLC_EDIT;?>" name="dosubmit" />
                  <span></span></div></td>
              <td><a href="index.php?do=modules&amp;action=config&amp;mod=slidecms" class="button-orange"><?php echo _CANCEL;?></a></td>
            </tr>
          </tfoot>
          <tr>
            <th><?php echo MOD_SLC_NAME;?>: <?php echo required();?></th>
            <td><input name="title" type="text" class="inputbox" value="<?php echo $row['title'];?>" size="55" /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_HEIGHT;?>: <?php echo required();?></th>
            <td><input name="height" type="text" class="inputbox" value="<?php echo $row['height'];?>" size="10" />
              <?php echo tooltip(MOD_SLC_HEIGHT_T);?></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_NAVTYPE;?>:</th>
            <td><label for="navtype-1"><?php echo MOD_SLC_NAVTYPE_1;?></label>
              <input type="radio" name="navtype" id="navtype-1" value="thumbs" <?php getChecked($row['navtype'], "thumbs"); ?> />
              <label for="navtype-2"><?php echo MOD_SLC_NAVTYPE_2;?></label>
              <input type="radio" name="navtype" id="navtype-2" value="dots" <?php getChecked($row['navtype'], "dots"); ?> />
              <label for="navtype-3"><?php echo MOD_SLC_NAVTYPE_3;?></label>
              <input type="radio" name="navtype" id="navtype-3" value="false" <?php getChecked($row['navtype'], "false"); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_NAVPOS;?>:</th>
            <td><label for="navpos-1"><?php echo MOD_SLC_NAVPOS_1;?></label>
              <input type="radio" name="navpos" id="navpos-1" value="top" <?php getChecked($row['navpos'], "top"); ?> />
              <label for="navpos-2"><?php echo MOD_SLC_NAVPOS_2;?></label>
              <input type="radio" name="navpos" id="navpos-2" value="bottom" <?php getChecked($row['navpos'], "bottom"); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_NAVPLACE;?>:</th>
            <td><label for="navplace-1"><?php echo MOD_SLC_NAVPLACE_1;?></label>
              <input type="radio" name="navplace" id="navplace-1" value="innernav" <?php getChecked($row['navplace'], "innernav"); ?> />
              <label for="navplace-2"><?php echo MOD_SLC_NAVPLACE_2;?></label>
              <input type="radio" name="navplace" id="navplace-2" value="outer" <?php getChecked($row['navplace'], "outer"); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_ARROWS;?>:</th>
            <td><label for="navarrows-1"><?php echo _YES;?></label>
              <input type="radio" name="navarrows" id="navarrows-1" value="1" <?php getChecked($row['navarrows'], 1); ?> />
              <label for="navarrows-2"><?php echo _NO;?></label>
              <input type="radio" name="navarrows" id="navarrows-2" value="0" <?php getChecked($row['navarrows'], 0); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_RESMETHOD;?>:</th>
            <td><label for="fit-1"><?php echo MOD_SLC_RESMETHOD_1;?></label>
              <input type="radio" name="fit" id="fit-1" value="contain" <?php getChecked($row['fit'], "contain"); ?> />
              <label for="fit-2"><?php echo MOD_SLC_RESMETHOD_2;?></label>
              <input type="radio" name="fit" id="fit-2" value="cover" <?php getChecked($row['fit'], "cover"); ?> />
              <label for="fit-3"><?php echo MOD_SLC_RESMETHOD_3;?></label>
              <input type="radio" name="fit" id="fit-3" value="scaledown" <?php getChecked($row['fit'], "scaledown"); ?> />
              <label for="fit-4"><?php echo MOD_SLC_RESMETHOD_4;?></label>
              <input type="radio" name="fit" id="fit-4" value="none" <?php getChecked($row['fit'], "none"); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_RESMETHOD_I;?>:</th>
            <td><?php echo MOD_SLC_RESMETHOD_T;?></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_FULLSCREEN;?>:</th>
            <td><label for="fullscreen-1"><?php echo _YES;?></label>
              <input type="radio" name="fullscreen" id="fullscreen-1" value="1" <?php getChecked($row['fullscreen'], 1); ?> />
              <label for="fullscreen-2"><?php echo _NO;?></label>
              <input type="radio" name="fullscreen" id="fullscreen-2" value="0" <?php getChecked($row['fullscreen'], 0); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_TRANSITION;?>:</th>
            <td><label for="transition-1"><?php echo MOD_SLC_TRANSITION_1;?></label>
              <input type="radio" name="transition" id="transition-1" value="slide" <?php getChecked($row['transition'], "slide"); ?> />
              <label for="transition-2"><?php echo MOD_SLC_TRANSITION_2;?></label>
              <input type="radio" name="transition" id="transition-2" value="crossfade" <?php getChecked($row['transition'], "crossfade"); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_TRANSDURRATION;?>:</th>
            <td><input name="durration" type="text" class="inputbox" value="<?php echo $row['durration'];?>" size="10" />
              <?php echo tooltip(MOD_SLC_TRANSDURRATION_T);?></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_CAPTION;?>:</th>
            <td><label for="captions-1"><?php echo _YES;?></label>
              <input type="radio" name="captions" id="captions-1" value="1" <?php getChecked($row['captions'], 1); ?> />
              <label for="captions-2"><?php echo _NO;?></label>
              <input type="radio" name="captions" id="captions-2" value="0" <?php getChecked($row['captions'], 0); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_AUTOPLAY;?>:</th>
            <td><label for="autoplay-1"><?php echo _YES;?></label>
              <input type="radio" name="autoplay" id="autoplay-1" value="1" <?php getChecked($row['autoplay'], 1); ?> />
              <label for="autoplay-2"><?php echo _NO;?></label>
              <input type="radio" name="autoplay" id="autoplay-2" value="0" <?php getChecked($row['autoplay'], 0); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_LOOP;?>:</th>
            <td><label for="loop-1"><?php echo _YES;?></label>
              <input type="radio" name="loop" id="loop-1" value="1" <?php getChecked($row['loop'], 1); ?> />
              <label for="loop-2"><?php echo _NO;?></label>
              <input type="radio" name="loop" id="loop-2" value="0" <?php getChecked($row['loop'], 0); ?> /></td>
          </tr>
          <tr>
            <th><?php echo MOD_SLC_SHUFFLE;?>:</th>
            <td><label for="shuffle-1"><?php echo _YES;?></label>
              <input type="radio" name="shuffle" id="shuffle-1" value="1" <?php getChecked($row['shuffle'], 1); ?> />
              <label for="shuffle-2"><?php echo _NO;?></label>
              <input type="radio" name="shuffle" id="shuffle-2" value="0" <?php getChecked($row['shuffle'], 0); ?> /></td>
          </tr>
        </table>
        <input name="sliderid" type="hidden" value="<?php echo $row['id'];?>" />
      </form>
    </div>
    <div id="data" class="tab_content">
      <table class="forms">
        <tr>
          <td><p class="info"><?php echo MOD_SLC_INFO_T;?></p>
            <div class="utility">
              <div class="right">
                <div class="button arrow">
                  <input type="button" class="addvideo" onclick="$('#addvids').slideToggle();" value="<?php echo MOD_SLC_ADD_V;?>" name="addvideo" />
                  <span></span></div>
                <div class="button arrow">
                  <input type="button" class="addmedia" onclick="$('#uploader').slideToggle();" value="<?php echo MOD_SLC_ADD_I;?>" name="addmedia" />
                  <span></span></div>
              </div>
            </div>
            <div id="addvids" style="display:none">
              <table class="forms">
                <tr>
                  <th><?php echo MOD_SLC_VIDURL;?>:</th>
                  <td><input name="vidurl" type="text" class="inputbox"  size="45" /></td>
                  <th><?php echo MOD_SLC_VIDTITLE;?>:</th>
                  <td><input name="vidcaption" type="text" class="inputbox"  size="45" />
                    <a href="javascript:void(0);" id="dovids" class="button button-sml"><?php echo MOD_SLC_ADD2;?></a></td>
                </tr>
                <tr>
                  <td colspan="4" class="center"><?php echo MOD_SLC_VID_T;?></td>
                </tr>
              </table>
            </div>
            <div id="uploader" style="display:none">
              <div class="uploader">
                <div class="dragspace hidden">
                  <p class="zonemessage"><?php echo MOD_SLC_DRAGF;?></p>
                  <p class="message"><?php echo MOD_SLC_FILEINFO;?></p>
                </div>
                <div class="buttons">
                  <div class="addbutton hidden">
                    <form action="modules/slidecms/controller.php" method="post" id="uploadform" name="uploadform" enctype="multipart/form-data">
                      <div class="fileuploader">
                        <input type="text" class="filename" readonly="readonly"/>
                        <input type="button" name="file" class="filebutton" value="<?php echo _BROWSE;?>"/>
                        <input type="file" name="filedata" />
                        <input name="sid" type="hidden" value="<?php echo $row['id'];?>" />
                        <input name="sfolder" type="hidden" value="<?php echo $row['plug_name'];?>" />
                      </div>
                    </form>
                  </div>
                </div>
                <div class="uploadspace hidden"></div>
                <div class="buttons"> <a class="startbutton button-green hidden"><?php echo MOD_SLC_START;?></a> <a class="clearbutton button button-orange hidden"><?php echo MOD_SLC_CLEAR;?></a> </div>
              </div>
            </div></td>
        </tr>
        <tr>
          <td><div id="maindata">
              <?php if(!$sliderdata):?>
              <?php echo $core->msgAlert(MOD_SLC_NOSLIDES,false);?>
              <?php else:?>
              <?php foreach ($sliderdata as $row2):?>
              <div class="sliderdata" id="sid_<?php echo $row2['id'];?>">
                <div class="slider-inner">
                  <figure>
                    <?php if($row2['data_type'] == "vid"):?>
                    <img src="../plugins/slidecms/thumbmaker.php?src=../plugins/slidecms/images/video.png&amp;w=400&amp;h=250" alt="" class="slimage" />
                    <?php else:?>
                    <img src="../plugins/slidecms/thumbmaker.php?src=../plugins/<?php echo $row['plug_name'];?>/slides/<?php echo $row2['data'];?>&amp;w=400&amp;h=250" alt="" class="slimage" />
                    <?php endif;?>
                  </figure>
                  <div class="title"><a href="javascript:void(0);" data-title="<?php echo $row2['caption'.$core->dblang];?>" class="delete" id="item_<?php echo $row2['id'] . '::' .$row['plug_name'];?>"> <img src="images/trash.png" alt="" title="<?php echo _DELETE;?>" class="tooltip"/></a> <a href="javascript:void(0);" data-title="<?php echo $row2['caption'.$core->dblang];?>" class="edit" id="list_<?php echo $row2['id'];?>"> <img src="images/pencil.png" alt="" title="<?php echo _EDIT;?>" class="tooltip"/></a><?php echo character_limiter($row2['caption'.$core->dblang],50);?></div>
                </div>
              </div>
              <?php endforeach;?>
              <?php endif;?>
            </div>
            <?php unset($row2);?></td>
        </tr>
      </table>
      <div class="clear"></div>
    </div>
  </div>
</div>
<?php echo $core->doForm("editSlider","modules/slidecms/controller.php");?> 
<script type="text/javascript" src="assets/fileupload.js"></script> 
<script type="text/javascript">
  function showLoader() {
	  $('#loader').fadeIn(200);
  }

  function hideLoader() {
	  $('#loader').fadeOut(200);
  };

  function loadList() {
	  showLoader();
	  $.ajax({
		  type: 'post',
		  url: "modules/slidecms/controller.php",
		  data: {
			  loadMedia: 1,
			  'sid' :<?php echo $row['id'];?>,
			  'sfolder' :'<?php echo $row['plug_name'];?>'
		  },
		  cache: false,
		  success: function (html) {
			  $("#maindata").html(html);
		  }
	  });
	  hideLoader();
  }

  var galHelper = function (e, div) {
	  div.children().each(function () {
		  $(this).width($(this).width());
	  });
	  return div;
  };
  
  $(window).ready(function(){
	   $(".uploader").FileUploader({
		  url: "modules/slidecms/controller.php?sid=<?php echo $row['id'];?>&sfolder=<?php echo $row['plug_name'];?>",
		  maxAllowedFiles: 10,
		  maxFileSize: 1024 * 1024 * 3,
		  allowedTypes: ["jpeg", "jpg", "png"],
		  msg: {
			  extTitle : "<?php echo MOD_SLC_ERRFILETYPE;?>",
			  extError : "<?php echo MOD_SLC_ERRFILETYPE_T;?>",
			  sizeTitle : "<?php echo MOD_SLC_ERRFILESIZE;?>",
			  sizeError : "<?php echo str_replace("[LIMIT]", 3, MOD_SLC_ERRFILESIZE_T);?>",
			  dropFiles : "<?php echo MOD_SLC_DROPF;?>",
			  ierror : "<?php echo _ERROR;?>",
		  },
		  onAllComplete: function(msg){
			  showLoader()
			setTimeout(function () {
				$(loadList()).fadeIn("slow");
			}, 2000);
		  }
	  });
  });
$(document).ready(function () {
    $("#maindata").sortable({
        opacity: 0.6,
        helper: galHelper,
        update: function() {
            var order = $('#maindata').sortable('serialize');
			    order += '&sortSlides=1';
                $.ajax({
                    type: 'post',
                    url: "modules/slidecms/controller.php",
                    data: order,

                    success: function (msg) {
						$("#msgholder").html(msg);
                    }
                });
			$("#maindata").disableSelection();
        }
    });
	// Edit Caption
	$('#maindata').on('click', 'a.edit', function () {
		var id = $(this).attr('id').replace('list_', '')
		var parent = $(this).closest('.sliderdata');
		var pre = $(this).closest('.title');
		var caption = $(this).attr('data-title');
		var text = '<span class="ui-icon ui-icon-info" style="float:left; margin:0 10px 10px 0;"></span><?php echo MOD_SLC_CAPTION_I;?><br />';
		text += '<div><input name="title" type="text" id="caption" style="width:280px" class="inputbox" value="' + caption + '" size="45" />';
		$.confirm({
			'title': '<?php echo MOD_SLC_CAPTION_E;?>',
			'message': text,
			'buttons': {
				'<?php echo _RENAME;?>': {
					'class': 'yes',
					'action': function () {
						var title = $('#caption').attr('value');
						$.ajax({
							type: 'post',
							url: "modules/slidecms/controller.php",
							data: {
								'renameMedia' : id,
								'caption' :title
							},
							success: function (res) {
								pre.html("<img src='images/v-preloader.gif' />");
								$("#msgholder").html(res);
								setTimeout(function () {
									$(loadList()).fadeIn("slow");
								}, 2000);
							}
						});
					}
				},
				'<?php echo _CANCEL;?>': {
					'class': 'no',
					'action': function () {}
				}
			}
		});
	});
	  $('#maindata').on('click', 'a.delete', function () {
		  var id = $(this).attr('id').replace('item_', '')
		  var parent = $(this).closest('.sliderdata');
		  var title = $(this).attr('data-title');
		  var text = '<div><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _DEL_CONFIRM;?></div>';
		  $.confirm({
			  'title': '<?php echo _DELETE.' '._IMAGE;?>',
			  'message': text,
			  'buttons': {
				  '<?php echo _DELETE;?>': {
					  'class': 'yes',
					  'action': function () {
						  $.ajax({
							  type: 'post',
							  url: "modules/slidecms/controller.php",
							  data: 'deleteMedia=' + id + '&title=' + encodeURIComponent(title),
							  success: function (msg) {
								  parent.fadeOut(400, function () {
									  parent.remove();
								  });
								  $("#msgholder").html(msg);
							  }
						  });
					  }
				  },
				  '<?php echo _CANCEL;?>': {
					  'class': 'no',
					  'action': function () {}
				  }
			  }
		  });
	});
	// Add Video
	  $('a#dovids').on('click', function () {
		  showLoader();
		  var vidtitle = $("input[name=vidcaption]").val();
		  var vidurl = $("input[name=vidurl]").val();
		  $.ajax({
			  type: 'post',
			  url: "modules/slidecms/controller.php",
			  data: {
				  doVids:1,
				  sid :<?php echo $row['id'];?>,
				  vurl: vidurl,
				  title: encodeURIComponent(vidtitle),
				  },
			  success: function (msg) {
				  hideLoader();
				  $("#msgholder").html(msg);
				  setTimeout(function () {
					  $(loadList()).fadeIn("slow");
				  }, 2000);
			  }
		  });
	});
});
</script>
<?php break;?>
<?php case"add": ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<div class="block-top-header">
  <h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_SLC_TITLE2;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo MOD_SLC_INFO2 . _REQ1 . required() . _REQ2;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><?php echo MOD_SLC_SUBTITLE2;?></h2>
  </div>
  <div class="block-content">
    <form action="#" method="post" id="admin_form" name="admin_form">
      <table class="forms">
        <tfoot>
          <tr>
            <td><div class="button arrow">
                <input type="submit" value="<?php echo MOD_SLC_ADD;?>" name="dosubmit" />
                <span></span></div></td>
            <td><a href="index.php?do=modules&amp;action=config&amp;mod=slidecms" class="button-orange"><?php echo _CANCEL;?></a></td>
          </tr>
        </tfoot>
        <tr>
          <th><?php echo MOD_SLC_NAME;?>: <?php echo required();?></th>
          <td><input name="title" type="text" class="inputbox" size="55" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_HEIGHT;?>: <?php echo required();?></th>
          <td><input name="height" type="text" class="inputbox" value="400" size="10" />
            <?php echo tooltip(MOD_SLC_HEIGHT_T);?></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_NAVTYPE;?>:</th>
          <td><label for="navtype-1"><?php echo MOD_SLC_NAVTYPE_1;?></label>
            <input type="radio" name="navtype" id="navtype-1" value="thumbs"  />
            <label for="navtype-2"><?php echo MOD_SLC_NAVTYPE_2;?></label>
            <input name="navtype" type="radio" id="navtype-2" value="dots" checked="checked"  />
            <label for="navtype-3"><?php echo MOD_SLC_NAVTYPE_3;?></label>
            <input type="radio" name="navtype" id="navtype-3" value="false" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_NAVPOS;?>:</th>
          <td><label for="navpos-1"><?php echo MOD_SLC_NAVPOS_1;?></label>
            <input type="radio" name="navpos" id="navpos-1" value="top" />
            <label for="navpos-2"><?php echo MOD_SLC_NAVPOS_2;?></label>
            <input name="navpos" type="radio" id="navpos-2" value="bottom" checked="checked" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_NAVPLACE;?>:</th>
          <td><label for="navplace-1"><?php echo MOD_SLC_NAVPLACE_1;?></label>
            <input type="radio" name="navplace" id="navplace-1" value="innernav" />
            <label for="navplace-2"><?php echo MOD_SLC_NAVPLACE_2;?></label>
            <input name="navplace" type="radio" id="navplace-2" value="outer" checked="checked"  /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_ARROWS;?>:</th>
          <td><label for="navarrows-1"><?php echo _YES;?></label>
            <input name="navarrows" type="radio" id="navarrows-1" value="1" checked="checked"  />
            <label for="navarrows-2"><?php echo _NO;?></label>
            <input type="radio" name="navarrows" id="navarrows-2" value="0"  /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_RESMETHOD;?>:</th>
          <td><label for="fit-1"><?php echo MOD_SLC_RESMETHOD_1;?></label>
            <input name="fit" type="radio" id="fit-1" value="contain" checked="checked"  />
            <label for="fit-2"><?php echo MOD_SLC_RESMETHOD_2;?></label>
            <input type="radio" name="fit" id="fit-2" value="cover" />
            <label for="fit-3"><?php echo MOD_SLC_RESMETHOD_3;?></label>
            <input type="radio" name="fit" id="fit-3" value="scaledown"  />
            <label for="fit-4"><?php echo MOD_SLC_RESMETHOD_4;?></label>
            <input type="radio" name="fit" id="fit-4" value="none" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_RESMETHOD_I;?>:</th>
          <td><?php echo MOD_SLC_RESMETHOD_T;?></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_FULLSCREEN;?>:</th>
          <td><label for="fullscreen-1"><?php echo _YES;?></label>
            <input type="radio" name="fullscreen" id="fullscreen-1" value="1"  />
            <label for="fullscreen-2"><?php echo _NO;?></label>
            <input name="fullscreen" type="radio" id="fullscreen-2" value="0" checked="checked"  /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_TRANSITION;?>:</th>
          <td><label for="transition-1"><?php echo MOD_SLC_TRANSITION_1;?></label>
            <input type="radio" name="transition" id="transition-1" value="slide" />
            <label for="transition-2"><?php echo MOD_SLC_TRANSITION_2;?></label>
            <input name="transition" type="radio" id="transition-2" value="crossfade" checked="checked" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_TRANSDURRATION;?>:</th>
          <td><input name="durration" type="text" class="inputbox" value="350" size="10" />
            <?php echo tooltip(MOD_SLC_TRANSDURRATION_T);?></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_CAPTION;?>:</th>
          <td><label for="captions-1"><?php echo _YES;?></label>
            <input name="captions" type="radio" id="captions-1" value="1" checked="checked" />
            <label for="captions-2"><?php echo _NO;?></label>
            <input type="radio" name="captions" id="captions-2" value="0" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_AUTOPLAY;?>:</th>
          <td><label for="autoplay-1"><?php echo _YES;?></label>
            <input type="radio" name="autoplay" id="autoplay-1" value="1" />
            <label for="autoplay-2"><?php echo _NO;?></label>
            <input name="autoplay" type="radio" id="autoplay-2" value="0" checked="checked" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_LOOP;?>:</th>
          <td><label for="loop-1"><?php echo _YES;?></label>
            <input type="radio" name="loop" id="loop-1" value="1" />
            <label for="loop-2"><?php echo _NO;?></label>
            <input name="loop" type="radio" id="loop-2" value="0" checked="checked" /></td>
        </tr>
        <tr>
          <th><?php echo MOD_SLC_SHUFFLE;?>:</th>
          <td><label for="shuffle-1"><?php echo _YES;?></label>
            <input type="radio" name="shuffle" id="shuffle-1" value="1" />
            <label for="shuffle-2"><?php echo _NO;?></label>
            <input name="shuffle" type="radio" id="shuffle-2" value="0" checked="checked" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php echo $core->doForm("addSlider","modules/slidecms/controller.php");?>
<?php break;?>
<?php default: ?>
<?php $sliderow = $slider->getSliders();?>
<div class="block-top-header">
  <h1><img src="images/mod-sml.png" alt="" /><?php echo MOD_SLC_TITLE4;?></h1>
  <div class="divider"><span></span></div>
</div>
<p class="info"><span><?php echo $core->langIcon();?></span><?php echo MOD_SLC_INFO4;?></p>
<div class="block-border">
  <div class="block-header">
    <h2><span><a href="index.php?do=modules&amp;action=config&amp;mod=slidecms&amp;mod_action=add"><?php echo MOD_SLC_ADD;?></a></span><?php echo MOD_SLC_SUBTITLE3 . $content->getModuleName(get("mod"));?></h2>
  </div>
  <div class="block-content">
    <table class="display sortable-table">
      <thead>
        <tr>
          <th class="firstrow">#</th>
          <th class="left sortable"><?php echo MOD_SLC_NAME;?></th>
          <th><?php echo _EDIT;?></th>
          <th><?php echo _DELETE;?></th>
        </tr>
      </thead>
      <?php if($pager->display_pages()):?>
      <tfoot>
        <tr>
          <td colspan="3"><div class="pagination"><?php echo $pager->display_pages();?></div></td>
        </tr>
      </tfoot>
      <?php endif;?>
      <tbody>
        <?php if(!$sliderow):?>
        <tr>
          <td colspan="4"><?php echo $core->msgAlert(MOD_SLC_NOSLIDERS,false);?></td>
        </tr>
        <?php else:?>
        <?php foreach ($sliderow as $row):?>
        <tr>
          <th><?php echo $row['id'];?>.</th>
          <td><?php echo $row['title'];?></td>
          <td class="center"><a href="index.php?do=modules&amp;action=config&amp;mod=slidecms&amp;mod_action=edit&amp;sliderid=<?php echo $row['id'];?>"><img src="images/edit.png" class="tooltip"  alt="" title="<?php echo _EDIT;?>"/></a></td>
          <td class="center"><a href="javascript:void(0);" class="delete" data-title="<?php echo $row['title'];?>" id="item_<?php echo $row['id'];?>"><img src="images/delete.png" class="tooltip"  alt="" title="<?php echo _DELETE;?>"/></a></td>
        </tr>
        <?php endforeach;?>
        <?php unset($row);?>
        <?php endif;?>
      </tbody>
    </table>
  </div>
</div>
<?php echo Core::doDelete(_DELETE.' '.MOD_SLC_SLIDER, "deleteSlider","modules/slidecms/controller.php");?> 
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $(".sortable-table").tablesorter({
        headers: {
            0: {
                sorter: false
            },
            2: {
                sorter: false
            },
            3: {
                sorter: false
            }
        }
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>
