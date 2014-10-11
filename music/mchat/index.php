<?php

require_once 'config.php';
if(!isset($salt)){
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('location: ./install/');die();}
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options();


if(isset($_POST['uid']) && isset($_POST['ups']) && hsh($_POST['uid'].'hash_check')==$_POST['ups']){
$uid=(int)$_POST['uid']; 
$query='DELETE FROM '.$dbss['prfx']."_online WHERE usr_id=$uid";
neutral_query($query); redirect('login.php'); die();}


if(isset($_GET['url'])){$url=(int)$_GET['url'];}else{$url=0;}

switch($url){
case 1: $url='login.php';break;
case 2: $url='register.php';break;
case 3: $url='password.php';break;
default: $url='blab.php';break;}

if(isset($_GET['lang'])){
$gl=(int)$_GET['lang'];
include 'lang/languages.inc';
if(is_file('lang/'.$lang_files[$gl])){
$options[0]=$gl;
$options=implode('z',$options);
setcookie('blab7_options',$options,time()+3600*24*365,'/');
redirect($url);die();}}

if(isset($_GET['veff'])){
$vf=(int)$_GET['veff'];
if($vf<2){$options[3]=$vf;
$options=implode('z',$options);
setcookie('blab7_options',$options,time()+3600*24*365,'/');
redirect($url);die();}}

if(!isset($_COOKIE['blab7_xuidc'])){redirect('login.php');die();}

redirect($url);
?>