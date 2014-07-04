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

define('DB_NAME', 'fprotect');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mintsql');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');

define('AUTH_KEY',   'IOD8{vLiKrBQtH=U3sz^$b0(HvquCvOgKf5-P<q):j[7O8_=fsZXw+rA<n5{L]~&');

/**
 * Lists
 */


/************
 * Path Vars
 ***********/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/************
 * Template Vars
 ***********/

$page_class = '';
$main_block= '';

error_reporting(E_ALL /*& ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED*/);
ini_set('display_errors', 1);
	
require_once(ABSPATH . 'php/conf.php');