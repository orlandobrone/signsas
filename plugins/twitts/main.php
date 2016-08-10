<?php
  /**
   * Latest Twitts
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: main.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  require_once(WOJOLITE . "admin/plugins/twitts/admin_class.php");
  $twitt = new latestTwitts();
?>
<!-- Start Latest Twitts -->
<?php
  function twitterStyle($tweet)
  {
      global $twitt, $core;
	  
      echo '<li class="twitter_item">';
      if ($twitt->show_image) {
          echo '<img src="' . $tweet['user']['profile_image_url'] . '" class="avatar img-left" alt=""/>';
      }
		echo '<div>
				 <div class="user">
					 <a href="https://www.twitter.com/' . $tweet['user']['screen_name'] . '">
						 <span class="screenname">
							 <small>@</small>' . $tweet['user']['screen_name'] . '
						 </span>
						 </a>
				 <span class="time">
					 <a href="' . $tweet['twitter_link'] . '"> ' . dodate($core->long_date, $tweet['created_at']) . ' </a>
				 </span>
					 
				 </div>
				 <div> ' . $tweet['text'] . ' </div>
				 ' . ($tweet['is_retweet'] ? '<div class="retweet"> Retweeted by ' . $tweet['retweeter']['name'] . ' </div>' : '');
		echo '</div>
           </li>';
  }
?>
<?php if($twitt->username):?>
<div id="twitt"><?php echo $twitt->PrintFeed('twitterStyle');?></div>
<div id="twitt-nav">
  <div class="next"></div>
  <div class="prev"></div>
  <br class="clear" />
</div>
<script type="text/javascript">
// <![CDATA[
  $(document).ready(function() {
	  if ($('#twitt li').length > 0) {
		  $('#twitt ul').cycle({
			  fx: 'scrollHorz',
			  speed: <?php echo $twitt->speed;?>,
			  randomizeEffects: true,
			  timeout: <?php echo $twitt->timeout;?>,
			  cleartype: true,
			  cleartypeNoBg: true,
			  pause: true,
			  next: '#twitt-nav .next',
			  prev: '#twitt-nav .prev'
		  });
	  }
  });
</script>
<?php endif;?>
<!-- End Latest Twitts /-->