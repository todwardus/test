<?php
//Config error 
error_reporting(E_ALL);// & ~E_NOTICE

$domain         = "a.hu";
$domain_http    = "http://".$domain."/";

########## Database Info ##########
define('DB_NAME',       'a');
define('DB_USER',       'a');
define('DB_PASSWORD',   'a');
define('DB_HOST',       'a');
define('DB_CHARSET',    'utf8');
define('DB_TYPE',       'mysql');
$TablePrefix = '';

// pl /web/beszolas/szepidezet.hu
define('DIR_CORE',          APP . 'core');

define('DIR_CONTROLLER',    APP . 'controller');
define('DIR_MODEL',         APP . 'model');
define('DIR_VIEW',          APP . 'view/template');
define('DIR_LIB',           APP . 'lib');

define('DIR_THEME',         DIR_VIEW.'/aru');

define('URL_PROTOCOL',      'http://');
define('URL_DOMAIN',        $_SERVER['HTTP_HOST']);
define('URL',               URL_PROTOCOL . URL_DOMAIN .'/');
define('URL_PUBLIC',        URL.'public');

//Settings
define('SZEPI_DQPP',        20);//Default-Quotes-Per-Page
define('ID_PW',             rand(1,9999999));//unique_pageview_id

//SALT-INFO: https://crackstation.net/hashing-security.htm
define('SALT',              'rxoo7v0DSE7lzILU6Y99i0nj3M7REH6UNC2FPbSh1KGBQdIzxZPqVKS');//#topsecret
define('COOKIE_NAME',       'BB_USER_ID');
if (isset($_COOKIE[COOKIE_NAME])){define('COOKIE_DATA',       $_COOKIE[COOKIE_NAME]);}

// Google Tag Manager id
define('ID_GTM',    'GTM-NTCSJJ');
//FB APP
define('ID_FB_APP', '138034986254296');


//Resources
define('TIME_START',        microtime(true));       //in microsec
define('MEMORY_START',      memory_get_usage());    //in bytes
define('MEMORY_START_PEAK', memory_get_peak_usage());    //in bytes

//CRON-hoz infó
//http://php.net/manual/en/function.ignore-user-abort.php
?>