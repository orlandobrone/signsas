<?php
  /**
   * Language File
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2012
   * @version $Id: language.php, v1.00 2012-12-24 12:12:12 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php
  define('MOD_SLC_TITLE1', 'Manage Slider &rsaquo; Edit Slider');
  define('MOD_SLC_INFO1', 'Here you can update your slider configuration.');
  define('MOD_SLC_SUBTITLE1', 'Editing Slider');

  define('MOD_SLC_TITLE2', 'Manage Slider &rsaquo; Add Slider');
  define('MOD_SLC_INFO2', 'Here you can add new Slider.<br />Once you create new slider go to edit mode and assign your images and videos.');
  define('MOD_SLC_SUBTITLE2', 'Adding New Slider');
  define('MOD_SLC_NOSLIDERS','<span>Alert!</span>There are no existing sliders, please create one.');
  define('MOD_SLC_NOSLIDES','<span>Alert!</span>You don\'t have any slides yet. Please add...');
  define('MOD_SLC_SLIDER','Slider');
  define('MOD_SLC_NAME_EXISTS','Slider Name Exists');
  define('MOD_SLC_MAPINFO','Enter your address and press serch button. Drag marker to adjust your location. You can also zoom in/out to set zoom level.');
  
  define('MOD_SLC_SUBTITLE3', 'Configure Module &rsaquo; ');
  
  define('MOD_SLC_CONFG', 'General Configuration');
  define('MOD_SLC_CONFD', 'Data Configuration');
    
  define('MOD_SLC_NAME', 'Slider Title');
  define('MOD_SLC_NAME_R', 'Please Enter Slider Title');
  define('MOD_SLC_NAME2_R', 'Slider Title must contain only letters and numbers.');
  define('MOD_SLC_HEIGHT','Slider Height');
  define('MOD_SLC_HEIGHT_T','Default slider height in pixels');
  define('MOD_SLC_HEIGHT_R','Please Enter Slider Height');
  
  define('MOD_SLC_NAVTYPE','Navigation Type');
  define('MOD_SLC_NAVTYPE_1','Thumbs');
  define('MOD_SLC_NAVTYPE_2','Dots');
  define('MOD_SLC_NAVTYPE_3','None');
  
  define('MOD_SLC_NAVPOS','Navigation Position');
  define('MOD_SLC_NAVPOS_1','Top');
  define('MOD_SLC_NAVPOS_2','Bottom');

  define('MOD_SLC_NAVPLACE','Navigation Place');
  define('MOD_SLC_NAVPLACE_1','Inner');
  define('MOD_SLC_NAVPLACE_2','Outer');

  define('MOD_SLC_RESMETHOD','Image Resize');
  define('MOD_SLC_RESMETHOD_1','Contain');
  define('MOD_SLC_RESMETHOD_2','Cover');
  define('MOD_SLC_RESMETHOD_3','Scaledown');
  define('MOD_SLC_RESMETHOD_4','None');
  define('MOD_SLC_RESMETHOD_I','Resize Methods');
  define('MOD_SLC_RESMETHOD_T','There are 4 ways to fit an image into a slide:<br />1. <strong>Contain</strong> - Stretching the image to be fully displayed while fitting within the slide.<br />2. <strong>Cover</strong> - Stretching and cropping the image to completely cover the slide.<br />3. <strong>Scaledown</strong> - Stretching the image if it is bigger than the slide.<br />4. <strong>None</strong> - Using the image\'s own dimensions. ');
  
  define('MOD_SLC_ARROWS','Show Navigation Arrows');
  define('MOD_SLC_FULLSCREEN','Allow Fullscreen Preview');
  define('MOD_SLC_TRANSITION','Default Transition');
  define('MOD_SLC_TRANSITION_1','Crossfade');
  define('MOD_SLC_TRANSITION_2','Slide');
  define('MOD_SLC_TRANSDURRATION','Transition Durration');
  define('MOD_SLC_TRANSDURRATION_T','Transition Durration in miliseconds');
  
  define('MOD_SLC_CAPTION','Show Captions');
  define('MOD_SLC_AUTOPLAY','Autoplay');
  define('MOD_SLC_LOOP','Infinite Loop');
  define('MOD_SLC_SHUFFLE','Shuffle');

  define('MOD_SLC_INFO_T', 'Here you can manage your Slider media.<br />Drag and drop upload is available in Firefox, Chrome and Safari browser.<br />You can also reorder media by dragging the items around the grid.');
  define('MOD_SLC_VID_T', 'Youtube and Vimeo videos are supported. Url format: http://youtube.com/watch?v=C3l52wBslWag, or http://youtu.be/C3l52wBslWag, or http://vimeo.com/61657412 or http://player.vimeo.com/video/61657412');
  
  define('MOD_SLC_VIDTITLE', 'Video Title');
  define('MOD_SLC_VIDURL', 'Video Url');
  define('MOD_SLC_VIDURL_R', 'Please Enter Video Url');
  define('MOD_SLC_ADD2', 'Add');
  
  define('MOD_SLC_CAPTION_I', 'Media Caption');
  define('MOD_SLC_CAPTION_E', 'Edit Media Caption');
  
  define('MOD_SLC_POS', 'Position');
  define('MOD_SLC_POS_SAVE', 'Save Position');
  define('MOD_SLC_GUPDATED', '<span>Success!</span>Slider updated successfully!');
  define('MOD_SLC_GADDED', '<span>Success!</span>Slider added successfully!');
  define('MOD_SLC_VADDED', '<span>Success!</span>Video added successfully!');
  define('MOD_SLC_TITLE4', 'Slider Manager');
  define('MOD_SLC_INFO4', 'Here you can manage your sliders.<br /><strong>Note:</strong> Deleting slider will delete all images and plugin associated with deleted slider.');
  
  define('MOD_SLC_ADD_I','Add Images');
  define('MOD_SLC_ADD_V', 'Add Videos');

  define('MOD_SLC_DRAGF', 'Drag your file(s) in here');
  define('MOD_SLC_DROPF', 'Drop your file(s) here');
  define('MOD_SLC_FILEINFO', 'You can add up to 10 (*.jpg .*png) files at once, each file size must not exceed 3MB.');
  define('MOD_SLC_ADDS', 'Add New Image');
  define('MOD_SLC_ADDMORE', 'Upload Images');
  define('MOD_SLC_START', 'Start File Upload');
  define('MOD_SLC_CLEAR', 'Clear File Queue');
  define('MOD_SLC_DROP', 'Error - File Type');
  define('MOD_SLC_ERRFILETYPE', 'Error - File Type');
  define('MOD_SLC_ERRFILETYPE_T', 'You have chosen unsupported file extension!<br />Valid file types are: jpeg, jpg, png');
  define('MOD_SLC_ERRFILESIZE', 'Error - File Size');
  define('MOD_SLC_ERRFILESIZE_T', 'File is larger than the <strong>[LIMIT]</strong> limit');
  define('MOD_SLC_UPLDIR', 'Upload directory does not exists');
  define('MOD_SLC_DIRNW', 'Upload image directory [DIRNAME] is not writtable');
  
  define('MOD_SLC_ADD','Add Slider');
  define('MOD_SLC_EDIT','Edit Slider');

?>