<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

if($settings['register']=='0'){die();}
setcookie('blab7_xuidc','',time()+3600*24*365,'/');

/* --- */

if(isset($_POST['check_name'])){
$check_name=neutral_escape($_POST['check_name'],64,'str');
$query='SELECT usr_name FROM '.$dbss['prfx']."_users WHERE usr_name='$check_name'";
$result=neutral_query($query);
if(neutral_num_rows($result)>0){print $lang['nmtaken'];}else{print '1';}die();}

/* --- */

if(isset($_GET['activate'])){
$astr=neutral_escape($_GET['activate'],8,'str');

$query='UPDATE '.$dbss['prfx']."_users SET usr_status='0' WHERE usr_status='$astr'";
$result=neutral_query($query);

$title=$settings['title'];
$info=$lang['account_ok'];
$link='login.php';
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}

/* --- */

if(isset($_POST['uname']) && isset($_POST['upass']) && isset($_POST['rpass']) && isset($_POST['email'])){

$uname=neutral_escape($_POST['uname'],64,'str');
$upass=neutral_escape($_POST['upass'],64,'str');
$rpass=neutral_escape($_POST['rpass'],64,'str');
$email=neutral_escape($_POST['email'],64,'str');

$user_ok=0;
$query='SELECT usr_name FROM '.$dbss['prfx']."_users WHERE usr_name='$uname' OR usr_mail='$email'";
$result=neutral_query($query);
if(neutral_num_rows($result)<1 && strlen($uname)>2 && strlen($upass)>2 && strlen($email)>6 && $upass==$rpass && stristr($email,'@') && stristr($email,'.')){$user_ok=1;}

if($user_ok<1){
$title=$settings['title'];
$info=$lang['wrong'].' (e-mail)';
$link='register.php';
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}


switch($settings['activation']){
case '1': $info=$lang['check_inbox']; $a_string=substr(hsh($email),0,8); $mll=1; break;
case '2': $info=$lang['wait_app'];  $a_string=substr(hsh($email),0,8); $mll=0; break;
default : $link='login.php'; $info=$lang['account_ok']; $a_string='0'; $mll=0; break;}

$upass=hsh($upass);
$query='INSERT INTO '.$dbss['prfx']."_users VALUES(NULL,'$uname','$upass','$email',$timestamp,'$a_string')"; neutral_query($query);

if($mll>0){
$a_link=$settings['url'].'/register.php?activate='.$a_string;
$message=str_replace('%ACTIVATION%',$a_link,$lang['m1_msg']);
$mll=send_mail($email,$lang['m1_sub'],$message,$settings['default_mail']);
if($mll!=TRUE){$info=$lang['mail_error'];}}

$title=$settings['title'];
include 'ui/templates/head.pxtm';
include 'ui/templates/info.pxtm';
die();}

/* --- */

include 'lang/languages.inc';

$title=$settings['title'].': '.$lang['register'];
include 'ui/templates/head.pxtm';
include 'ui/templates/register.pxtm';

?>