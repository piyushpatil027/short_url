<?php

$root_path = dirname(__FILE__);
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
$site_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/short_url/";

define("ROOT_PATH", $root_path . "/");
define("SITE_URL", $site_url);
define("TITLE", " | Short_URL");

define("GOOGLE_API_KEY", "your api key"); // Place your Google API Key
?>
