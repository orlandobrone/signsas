<?php
  /**
   * Header
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: header.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<!doctype html>

<head>
<?php echo $content->getMeta(); ?>
<script type="text/javascript">
var THEMEURL = "<?php echo THEMEURL; ?>";
var SITEURL = "<?php echo SITEURL; ?>";
</script>
<?php $content->getThemeStyle();?>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/tables.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/cycle.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/flex.js"></script>
<script type="text/javascript" src="<?php echo THEMEURL;?>/master.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/fancybox/helpers/jquery.fancybox-media.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/assets/fancybox/jquery.fancybox.css" media="screen" />
<?php if($core->eucookie):?>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/eu_cookies.js"></script>
<script type="text/javascript"> 
$(document).ready(function () {
    $("body").acceptCookies({
        position: 'top',
        notice: '<?php echo EU_NOTICE;?>',
        accept: '<?php echo EU_ACCEPT;?>',
        decline: '<?php echo EU_DECLINE;?>',
        decline_t: '<?php echo EU_DECLINE_T;?>',
        whatc: '<?php echo EU_W_COOKIES;?>'
    })
});
</script>
<?php endif;?>
<?php $content->getPluginAssets();?>
<?php $content->getModuleAssets();?>

<!-- Contact Form inicio -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script src="cfg-contactform-1/js/contactform.js"></script>
<link href="cfg-contactform-1/css/contactform.css" rel="stylesheet" type="text/css" />

<!-- Contact Form fin -->
<!-- cabezote responsive inicio -->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<!-- cabezote responsive fin -->

<!-- Inicio de tabion para servicios -->

<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />

<!-- CSS3 Animation -->
<link rel="stylesheet" href="css/animate-custom.css" type="text/css" />

<!-- Some Style for Demo -->
<link rel="stylesheet" href="css/global-demo.css" type="text/css" />

<!-- Tabion CSS Pack -->
<link rel="stylesheet" href="css/tabion.css" type="text/css" />

<meta name="viewport" content="width=device-width, user-scalable=no" />

<!-- IE 8 -->
<!--[if lt IE 9]>
<link rel="stylesheet" href="css/tabion-ie8.css" type="text/css" />
<![endif]-->





<!-- Start jQuery Library -->

<!--[if !IE]> -->
<script type="text/javascript" src="js/jquery/jquery.min.2.0.3.js"></script>
<!-- <![endif]-->

<!--[if gte IE 9]>
<script type="text/javascript" src="js/jquery/jquery.min.2.0.3.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="js/jquery/jquery.min.1.10.2.js"></script>
<![endif]-->

<!-- End jQuery Library -->

<!-- jQuery Mobile -->
<script type="text/javascript" src="js/jquery/jquery.mobile.touch.min.1.3.2.js"></script>

<!-- Tabion jQuery Plugin -->
<script type="text/javascript" src="js/tabion.min.js"></script>


<!-- Call Tabion jQuery Plugin -->
<script type="text/javascript">
$(window).load(function() {
	$('#tabionjs').tabion({
		delay: 3000, // delay time (milisecond)
		autoPlay:false, // false | true
		enableSwipe:true, // false | true
		enableKeys:true // false | true
	});
})
</script>
<!-- fin de tabion para servicios -->
<!-- galeria -->
<link rel="stylesheet" type="text/css" href="imagebox/imagebox.min.css" />
<script type="text/javascript" src="imagebox/imagebox.min.js"></script>


        
</head>
<body<?php if(method_exists('core', 'renderThemeBg')) $core->renderThemeBg();?>>
<!-- Header -->
<header id="header" class="clearfix">
<div class="container">
  <div class="grid_24">
    
     
        <?php include(WOJOLITE . "includes/right_plugins.php");?>
      
   
  </div>
    </div>
  <!-- Main Menu -->

</header>
<!-- Header /--> 