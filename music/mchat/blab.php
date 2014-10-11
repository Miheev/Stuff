<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

unset($user);
if(isset($_COOKIE['blab7_xuidc'])){

$uid=explode('z',$_COOKIE['blab7_xuidc']);

if(isset($uid[1]) && hsh($uid[0].$settings['cookie_salt'])==$uid[1]){
$uid=(int)$uid[0];

$query='SELECT * FROM '.$dbss['prfx']."_users WHERE usr_id=$uid";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$ext_user=neutral_fetch_array($result);

$user=array();
$user['id']=(int)$ext_user['usr_id'];
$user['name']=$ext_user['usr_name'];
}}}

if(!isset($user['id']) || !$user['name']){redirect('login.php');die();}

$ajx_name=$user['name'];
$ajx_name=str_replace("'",'*',$ajx_name);
$ajx_name=str_replace('&','*',$ajx_name);
$ajx_name=str_replace('+','*',$ajx_name);
$ajx_name=str_replace('­','*',$ajx_name);
$ajx_name=str_replace('"','*',$ajx_name);
$ajx_name=str_replace('\\','*',$ajx_name);
$ajx_name=trim($ajx_name);


$lhash=hsh($user['id'].'hash_check');
$uhash=hsh($user['id'].$ajx_name.'blab'); 
$js_vars='uid='.$user['id'].';uname=\''.$ajx_name.'\';uhash=\''.$uhash.'\';';

include 'ui/smilies.inc';

$title=$settings['title'];
include 'ui/templates/head.pxtm';
include 'ui/templates/blab.pxtm';

?>