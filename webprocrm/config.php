<?php

/*if ( !preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"]) ) {
    $enc = 'UTF-8';
    header('Content-type: text/html; charset='.$enc);
    mb_internal_encoding($enc);
} else {
    $enc = 'windows-1251';
    header('Content-type: text/html; charset='.$enc);
    mb_internal_encoding($enc);
}*/
mb_internal_encoding("utf-8");
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'ru_RU');

define('DB_NAME', 'webprocrm');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mintsql');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');

define( 'MEMORY_LIMIT', '96M' );
define( 'UPLOAD_LIMIT', '10M' );

define( 'SITE_NAME', 'webprocrm.su' );
define('AUTH_KEY',   '9C`U8L2A-Z{mtwtEkZ<_Z G7%[IP8:37Cn-mY~cU$bt~i7Oq9(+{oLi9,[rO?C@_');

/************
 * Path Vars
 ***********/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/************
 * Template Vars
 ***********/

$page_title = '';
$page_class = '';
$main_block= '';
$script_block = '';
$css_lib = '';
$script_lib = '';

error_reporting(E_ALL /*& ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED*/);
	
require_once(ABSPATH . 'php/conf.php');
require_once(ABSPATH . 'php/rba/rba.php');
