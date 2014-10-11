<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

setcookie('blab7_xuidc','',time()+3600*24*365,'/');
$ip=$_SERVER['REMOTE_ADDR'];

/* --- */

if(isset($_GET['newpass'])){

$str=explode('z',$_GET['newpass']);
if(isset($str[2]) && substr(hsh($str[0].$str[1]),0,8)==$str[2]){

$uid=(int)$str[0]; $newpass=hsh($str[1]);
$query='UPDATE '.$dbss['prfx']."_users SET usr_pass='$newpass' WHERE usr_id=$uid";
$result=neutral_query($query);

$title=$settings['title'];
$info=$lang['action_ok'];
$link='login.php';
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}}

/* --- */

if(isset($_POST['uname']) && isset($_POST['email'])){

$uname=neutral_escape($_POST['uname'],64,'str');
$email=neutral_escape($_POST['email'],64,'str');

if(strlen($uname)<3 && strlen($email)<7){
$title=$settings['title']; $info=$lang['wrong']; $link='password.php';
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}

$query='SELECT * FROM '.$dbss['prfx']."_users WHERE usr_name='$uname' AND usr_mail='$email'"; 
$result=neutral_query($query);

if(neutral_num_rows($result)<1){
$title=$settings['title']; $info=$lang['wrong']; $link='password.php';
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}

$user=neutral_fetch_array($result);
$uid=$user['usr_id'];

$newpss=substr(hsh(microtime()),0,5);
$a_string=substr(hsh($uid.$newpss),0,8);
$a_string=$uid.'z'.$newpss.'z'.$a_string;
$a_link=$settings['url'].'/password.php?newpass='.$a_string;

$message=str_replace('%LINK%',$a_link,$lang['m2_msg']);
$message=str_replace('%PASSWORD%',$newpss,$message);

$mll=send_mail($user['usr_mail'],$lang['m2_sub'],$message,$settings['default_mail']);
if($mll!=TRUE){$info=$lang['mail_error'];}else{$info=$lang['check_inbox'];}

$title=$settings['title'];
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}

/* --- */

include 'lang/languages.inc';

$title=$settings['title'].': '.$lang['forgot_pass'];
include 'ui/templates/head.pxtm';
include 'ui/templates/password.pxtm';

?>