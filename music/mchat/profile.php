<?php

require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

if(!isset($_POST['u']) || !isset($_POST['p']) || hsh($_POST['u'].'hash_check')!=$_POST['p']){die();}
$u=(int)$_POST['u'];

if(isset($_POST['email']) && strlen(trim($_POST['email']))>6 && strstr($_POST['email'],'@') && strstr($_POST['email'],'.')){
$email=neutral_escape($_POST['email'],64,'str');

$where_str=''; $set_str='';

/* --- */

if(isset($_POST['opass']) && strlen(trim($_POST['opass']))>2 && isset($_POST['npas1']) && isset($_POST['npas2']) && strlen(trim($_POST['npas1']))>2 && $_POST['npas1']==$_POST['npas2']){

if($_POST['opass']=='xxxxx'){$opass=hsh($_SERVER['REMOTE_ADDR'].$salt);}
else{$opass=hsh($_POST['opass']);} $where_str.=" AND usr_pass='$opass'";

$npass=hsh($_POST['npas1']);
$set_str.=" usr_pass='$npass', ";}

$query='UPDATE '.$dbss['prfx']."_users SET $set_str usr_mail='$email' WHERE usr_id=$u $where_str";
neutral_query($query);

redirect('blab.php');die();}

/* --- */

$query='SELECT * FROM '.$dbss['prfx']."_users WHERE usr_id=$u";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$profile=neutral_fetch_array($result);}else{die();}
include 'ui/templates/profile.pxtm';

?>