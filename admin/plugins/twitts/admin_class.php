<?php
  /**
   * latestTwitts Class
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: class_admin.php, v2.00 2013-06-12 10:12:05 gewa Exp $
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

  class latestTwitts
  {

      private $mTable = "plug_twitter_config";
      private $options = null;
      private $queryArgs = null;
      private $feed = null;


      /**
       * latestTwitts::__construct()
       * 
       * @param mixed $opts
       * @return
       */
      public function __construct($opts = array())
      {
          $this->getconfig();
          $this->options = array(
              'exclude_replies' => false,
              'detect_links' => true,
              'detect_mentions' => true,
              'detect_hashtags' => true,
              'replace_full_links' => true,
              'use_ssl' => false,
              'screen_name' => $this->username,
              'consumer_key' => $this->consumer_key,
              'consumer_secret' => $this->consumer_secret,
              'user_token' => $this->access_token,
              'user_secret' => $this->access_secret,
              'user_id' => null,
              'count' => $this->counter,
              'cache_life' => 3600,
              'cache_dir' => WOJOLITE . 'plugins/twitts/cache/',
              'link_anchor_class' => 'tweetLink',
              'mention_anchor_class' => 'mentionLink',
              'hash_anchor_class' => 'hashLink',
              'format' => '<li>{tweet:text}</li>',
              'format_retweet' => '<li class="retweet">{tweet:text}</li>',
              'relative_time_keywords' => array(
                  'second',
                  'minute',
                  'hour',
                  'day',
                  'week',
                  'month',
                  'year',
                  'decade'),
              'relative_time_plural_keywords' => array(
                  _M_SECONDS,
                  _M_MINUTES,
                  _M_HOURS,
                  _M_DAYS,
                  _M_WEEKS,
                  _MONTHS,
                  _YEARS,
                  'decades'),
              'relative_time_prefix' => '',
              'relative_time_suffix' => _AGO);

          $this->options = array_merge($this->options, $opts);
          $this->queryArgs = array(
              'user_id',
              'screen_name',
              'since_id',
              'count',
              'max_id',
              'trim_user',
              'exclude_replies');
      }

      /**
       * latestTwitts::getconfig()
       * 
       * @return
       */
      private function getconfig()
      {
          global $db;

          $sql = "SELECT * FROM " . $this->mTable . "";
          $row = $db->first($sql);

          $this->username = $row['username'];
          $this->consumer_key = $row['consumer_key'];
          $this->consumer_secret = $row['consumer_secret'];
          $this->access_token = $row['access_token'];
          $this->access_secret = $row['access_secret'];
          $this->counter = $row['counter'];
          $this->speed = $row['speed'];
          $this->show_image = $row['show_image'];
          $this->timeout = $row['timeout'];
      }

      /**
       * latestTwitts::processConfig()
       * 
       * @return
       */
      function processConfig()
      {
          global $db, $core, $wojosec;

          if (empty($_POST['username']))
              $core->msgs['username'] = PLG_TW_USER_R;

          if (empty($_POST['consumer_key']))
              $core->msgs['consumer_key'] = PLG_TW_KEY_R;

          if (empty($_POST['consumer_secret']))
              $core->msgs['consumer_secret'] = PLG_TW_SECRET_R;

          if (empty($_POST['access_token']))
              $core->msgs['access_token'] = PLG_TW_TOKEN_R;

          if (empty($_POST['access_secret']))
              $core->msgs['access_secret'] = PLG_TW_TSECRET_R;

          if (empty($core->msgs)) {
              $data = array(
                  'username' => sanitize($_POST['username']),
                  'consumer_key' => sanitize($_POST['consumer_key']),
                  'consumer_secret' => sanitize($_POST['consumer_secret']),
                  'access_token' => sanitize($_POST['access_token']),
                  'access_secret' => sanitize($_POST['access_secret']),
                  'counter' => intval($_POST['counter']),
                  'speed' => intval($_POST['speed']),
                  'show_image' => intval($_POST['show_image']),
                  'timeout' => intval($_POST['timeout']));

              $db->update($this->mTable, $data);
              ($db->affected()) ? $wojosec->writeLog(PLG_TW_UPDATED, "", "no", "plugin") . $core->msgOk(PLG_TW_UPDATED) : $core->msgAlert(_SYSTEM_PROCCESS);

          } else
              print $core->msgStatus();
      }

      /**
       * latestTwitts::PrintFeed()
       * 
       * @param mixed $callback
       * @return
       */
      public function PrintFeed($callback = null)
      {
          if ($this->feed == null)
              $this->loadFeed();

          $callable = is_callable($callback);

          echo "<ul>";

          foreach ($this->feed as $i => $tweet) {
              if ($i + 1 > self::option('count'))
                  break;

              if (isset($tweet['retweeted_status'])) {
                  $user = $tweet['user'];
                  $tweet = $tweet['retweeted_status'];
                  $tweet['retweeter'] = $user;
                  $tweet['is_retweet'] = true;
              } else {
                  $tweet['is_retweet'] = false;
              }

              $tweet['original_text'] = $tweet['text'];
              $tweet['relative_time'] = self::relativeTime(strtotime($tweet['created_at']));
              $tweet['twitter_link'] = 'https://twitter.com/' . $tweet['user']['id_str'] . '/status/' . $tweet['id_str'];
              $tweet['tweet_index'] = $i;

              $entities = $tweet['entities'];

              if (self::option('detect_links')) {
                  foreach ($entities['urls'] as $link) {
                      $format = sprintf('<a href="%s" class="%s">%s</a>', $link['expanded_url'], self::option('link_anchor_class'), self::option('replace_full_links') ? $link['display_url'] : $link['url']);

                      $tweet['text'] = str_ireplace($link['url'], $format, $tweet['text']);
                  }

                  if (isset($entities['media'])) {
                      foreach ($entities['media'] as $media) {
                          $format = sprintf('<a href="%s" class="%s">%s</a>', $media['expanded_url'], self::option('link_anchor_class'), self::option('replace_full_links') ? $media['display_url'] : $media['url']);

                          $tweet['text'] = str_ireplace($media['url'], $format, $tweet['text']);
                      }
                  }
              }

              if (self::option('detect_mentions')) {
                  foreach ($entities['user_mentions'] as $mention) {
                      $format = sprintf('<a href="http://twitter.com/%s" title="View %s\'s Profile on Twitter" class="%s">@%s</a>', $mention['screen_name'], $mention['name'], self::option('mention_anchor_class'), $mention['screen_name']);

                      $tweet['text'] = str_ireplace('@' . $mention['screen_name'], $format, $tweet['text']);
                  }
              }

              if (self::option('detect_hashtags')) {
                  foreach ($entities['hashtags'] as $hashtag) {
                      $format = sprintf('<a href="http://twitter.com/#!/search?q=%s" title="Search &#35;%s on Twitter" class="%s">#%s</a>', $hashtag['text'], $hashtag['text'], self::option('hash_anchor_class'), $hashtag['text']);

                      $tweet['text'] = str_ireplace('#' . $hashtag['text'], $format, $tweet['text']);
                  }
              }

                  $callback($tweet);
          }

          echo "</ul>";
      }


      /**
       * latestTwitts::option()
       * 
       * @param mixed $option
       * @return
       */
      public function option($option)
      {
          return $this->options[$option];
      }


      /**
       * latestTwitts::setOption()
       * 
       * @param mixed $option
       * @param mixed $value
       * @return
       */
      public function setOption($option, $value)
      {
          $this->options[$option] = $value;
      }

	  /**
	   * latestTwitts::relativeTime()
	   * 
	   * @param mixed $timestamp
	   * @return
	   */
	  private function relativeTime($timestamp)
	  {
		  $difference = time() - $timestamp;
	
		  list($periods, $periodsPlural) = array(self::option('relative_time_keywords'), self::option('relative_time_plural_keywords'));
	
		  $lengths = array(
			  60,
			  60,
			  24,
			  7,
			  4.35,
			  12,
			  10);
	
		  for ($i = 0; $difference >= $lengths[$i] && $i < 7; $i++)
			  $difference /= $lengths[$i];
	
		  $difference = round($difference);
	
		  return sprintf('%s %s %s %s', self::option('relative_time_prefix'), $difference, $difference != 1 ? $periodsPlural[$i] : $periods[$i], self::option('relative_time_suffix'));
	  }

	  /**
	   * latestTwitts::queryParameters()
	   * 
	   * @return
	   */
	  private function queryParameters()
	  {
		  $params = array();
	
		  foreach ($this->options as $option => $val)
			  if (in_array($option, $this->queryArgs))
				  $params[$option] = $val;
	
		  return $params;
	  }
	
	  /**
	   * latestTwitts::cacheLocation()
	   * 
	   * @return
	   */
	  private function cacheLocation()
	  {
		  return self::option('cache_dir') . strtolower($this->username);
	  }

	  /**
	   * latestTwitts::cache()
	   * 
	   * @return
	   */
	  private function cache()
	  {
		  $handle = @fopen(self::cacheLocation(), 'r');
	
		  if (!$handle)
			  return false;
	
		  $cache = @stream_get_contents($handle);
	
		  fclose($handle);
	
		  return json_decode($cache, true);
	  }
	
	  /**
	   * latestTwitts::setCache()
	   * 
	   * @param mixed $data
	   * @return
	   */
	  private function setCache($data)
	  {
		  if (!file_exists(self::option('cache_dir')))
			  mkdir(self::option('cache_dir'));
	
		  file_put_contents(self::cacheLocation(), $data);
	  }

	  /**
	   * latestTwitts::loadFeed()
	   * 
	   * @return
	   */
	  private function loadFeed()
	  {
		  if (self::option('cache_life') == 0) {
			  $this->feed = self::loadAPI();
			  return;
		  }
	
		  $cache = self::cache();
	
		  if ($cache === false || time() - $cache['time'] >= self::option('cache_life')) {
			  $data = self::loadAPI();
	
			  self::setCache(json_encode(array('time' => time(), 'data' => $data)));
	
			  $this->feed = $data;
		  } else {
			  $this->feed = $cache['data'];
		  }
	  }

	  /**
	   * latestTwitts::loadAPI()
	   * 
	   * @return
	   */
	  private function loadAPI()
	  {
		  require_once ("oAuth.php");
		  $auth = new tmhOAuth($this->options);
	
		  $code = $auth->request('GET', $auth->url('1.1/statuses/user_timeline'), self::queryParameters());
	
		  $data = json_decode($auth->response['response'], true);
	
		  if (isset($data['errors'])) {
			  $errors = '';
	
			  foreach ($data['errors'] as $error)
				  $errors .= ' ' . $error['message'] . '; code ' . $error['code'] . '.';
	
			  self::throwError('Twitter returned the following errors -' . $errors);
		  }
	
		  return $data;
	  }
	
	  /**
	   * latestTwitts::throwError()
	   * 
	   * @param mixed $error
	   * @return
	   */
	  private function throwError($error)
	  {
		  global $core;
		  
		  die($core->msgError("<b> Twitter Class Error: </b> $error"));
	  }
  }
?>