<?php 
	/** 
	* Configuration

	* @package CMS Pro
	* @author wojocms.com
	* @copyright 2011
	* @version Id: config.ini.php, v2.00 2011-04-20 10:12:05 gewa Exp $
	*/
 
	 if (!defined("_VALID_PHP")) 
     die('Direct access to this location is not allowed.');
 
	/** 
	* Database Constants - these constants refer to 
	* the database configuration settings. 
	*/
	 define('DB_SERVER', 'localhost'); 
	 define('DB_USER', 'signsas_cms'); 
	 define('DB_PASS', '0kB2uL7N3dhU'); 
	 define('DB_DATABASE', 'signsas_cms');
 
	/** 
	* Show MySql Errors. 
	* Not recomended for live site. true/false 
	*/
	$DEBUG = false; 
?>