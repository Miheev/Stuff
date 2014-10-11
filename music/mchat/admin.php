<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(1);

include 'lang/languages.inc';
include 'lang/'.$lang_admin[$settings['admin_lang']];

$wrong_acp=(int)$settings['wrong_acp'];$wrong_acp=$timestamp-$wrong_acp;

if(isset($_POST['acp_key']) && hsh($_POST['acp_key'])==$settings['acp_key'] && $wrong_acp>$settings['acp_attempts']){
$acp_key=hsh($settings['acp_key']);
setcookie('blab7_acpkey',$acp_key,time()+3600*$settings['acp_lhours'],'/');
redirect('admin.php');}

elseif(isset($_POST['acp_key'])){
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$timestamp' WHERE set_id='wrong_acp'";
neutral_query($query);
redirect('admin.php');}

if(!isset($_COOKIE['blab7_acpkey']) || hsh($settings['acp_key'])!=$_COOKIE['blab7_acpkey']){
$title=$lang['acpkey'];
include 'admin/head.pxtm';
include 'admin/acpkey.pxtm';
die();}

if(isset($_GET['q']) && $_GET['q']=='logout'){
setcookie('blab7_acpkey','',time()+3600,'/');
redirect('admin.php');}

/* --- */


if(isset($_POST['settings'])){

if(isset($_POST['admin_lang']) && $_POST['admin_lang']!=$settings['admin_lang']){
$admin_lang=neutral_escape($_POST['admin_lang'],2,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$admin_lang' WHERE set_id='admin_lang'";
neutral_query($query);}

if(isset($_POST['admin_css']) && $_POST['admin_css']!=$settings['admin_css']){
$admin_css=neutral_escape($_POST['admin_css'],2,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$admin_css' WHERE set_id='admin_css'";
neutral_query($query);}

if(isset($_POST['acp_lhours']) && $_POST['acp_lhours']!=$settings['acp_lhours']){
$acp_lhours=(int)$_POST['acp_lhours'];
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$acp_lhours' WHERE set_id='acp_lhours'";
neutral_query($query);}

if(isset($_POST['acp_attempts']) && $_POST['acp_attempts']!=$settings['acp_attempts']){
$acp_attempts=(int)$_POST['acp_attempts'];
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$acp_attempts' WHERE set_id='acp_attempts'";
neutral_query($query);}

if(isset($_POST['acp_timezone']) && $_POST['acp_timezone']!=$settings['acp_timezone']){
$acp_timezone=neutral_escape($_POST['acp_timezone'],3,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$acp_timezone' WHERE set_id='acp_timezone'";
neutral_query($query);}

if(isset($_POST['default_timeform']) && $_POST['default_timeform']!=$settings['default_timeform']){
$default_timeform=neutral_escape($_POST['default_timeform'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_timeform' WHERE set_id='default_timeform'";
neutral_query($query);}

if(isset($_POST['default_language']) && $_POST['default_language']!=$settings['default_language']){
$default_language=neutral_escape($_POST['default_language'],2,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_language' WHERE set_id='default_language'";
neutral_query($query);}

if(isset($_POST['default_effects']) && $_POST['default_effects']!=$settings['default_effects']){
$default_effects=neutral_escape($_POST['default_effects'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_effects' WHERE set_id='default_effects'";
neutral_query($query);}

if(isset($_POST['default_sound1']) && $_POST['default_sound1']!=$settings['default_sound1']){
$default_sound1=neutral_escape($_POST['default_sound1'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_sound1' WHERE set_id='default_sound1'";
neutral_query($query);}

if(isset($_POST['default_sound2']) && $_POST['default_sound2']!=$settings['default_sound2']){
$default_sound2=neutral_escape($_POST['default_sound2'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_sound2' WHERE set_id='default_sound2'";
neutral_query($query);}

if(isset($_POST['default_sound3']) && $_POST['default_sound3']!=$settings['default_sound3']){
$default_sound3=neutral_escape($_POST['default_sound3'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_sound3' WHERE set_id='default_sound3'";
neutral_query($query);}

if($_POST['title']!=$settings['title']){
$title=neutral_escape($_POST['title'],512,'str');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$title' WHERE set_id='title'";
neutral_query($query);}

if($_POST['url']!=$settings['url']){
$url=neutral_escape($_POST['url'],512,'str');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$url' WHERE set_id='url'";
neutral_query($query);}

if($_POST['default_mail']!=$settings['default_mail']){
$default_mail=neutral_escape($_POST['default_mail'],512,'str');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$default_mail' WHERE set_id='default_mail'";
neutral_query($query);}

if($_POST['meta_desc']!=$settings['meta_desc']){
$meta_desc=neutral_escape($_POST['meta_desc'],1024,'str');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$meta_desc' WHERE set_id='meta_desc'";
neutral_query($query);}

if($_POST['meta_keyw']!=$settings['meta_keyw']){
$meta_keyw=neutral_escape($_POST['meta_keyw'],1024,'str');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$meta_keyw' WHERE set_id='meta_keyw'";
neutral_query($query);}

if(isset($_POST['guests']) && $_POST['guests']!=$settings['guests']){
$guests=neutral_escape($_POST['guests'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$guests' WHERE set_id='guests'";
neutral_query($query);}

if(isset($_POST['register']) && $_POST['register']!=$settings['register']){
$register=neutral_escape($_POST['register'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$register' WHERE set_id='register'";
neutral_query($query);}

if(isset($_POST['show_topic']) && isset($settings['show_topic']) && $_POST['show_topic']!=$settings['show_topic']){
$show_topic=neutral_escape($_POST['show_topic'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$show_topic' WHERE set_id='show_topic'";
neutral_query($query);}

if(isset($_POST['activation']) && $_POST['activation']!=$settings['activation']){
$activation=neutral_escape($_POST['activation'],1,'int');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$activation' WHERE set_id='activation'";
neutral_query($query);}

if(isset($_POST['ajax_update']) && $_POST['ajax_update']!=$settings['ajax_update']){
$ajax_update=(int)$_POST['ajax_update']; if($ajax_update>15 || $ajax_update<5){$ajax_update=6;}
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$ajax_update' WHERE set_id='ajax_update'";
neutral_query($query);}

if(isset($_POST['post_interv']) && $_POST['post_interv']!=$settings['post_interv']){
$post_interv=(int)$_POST['post_interv']; if($post_interv>9000 || $post_interv<500){$post_interv=500;}
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$post_interv' WHERE set_id='post_interv'";
neutral_query($query);}

if(isset($_POST['ajax_delay']) && $_POST['ajax_delay']!=$settings['ajax_delay']){
$ajax_delay=(int)$_POST['ajax_delay']; if($ajax_delay>900 || $ajax_delay<10){$ajax_delay=200;}
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$ajax_delay' WHERE set_id='ajax_delay'";
neutral_query($query);}

if(isset($_POST['post_length']) && $_POST['post_length']!=$settings['post_length']){
$post_length=(int)$_POST['post_length']; if($post_length>2048 || $post_length<128){$post_length=512;}
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$post_length' WHERE set_id='post_length'";
neutral_query($query);}

redirect('admin.php?q=options');}

// ----

if(isset($_POST['mass_msg'])){
if(isset($_POST['mltple']) && is_array($_POST['mltple']) && count($_POST['mltple'])>0){

$mltple=$_POST['mltple'];
for($i=0;$i<count($mltple);$i++){$mltple[$i]=(int)$mltple[$i];}
$mltple=implode(',',$mltple);
$query='DELETE FROM '.$dbss['prfx']."_lines WHERE line_id IN ($mltple)";
neutral_query($query);}
redirect('admin.php?q=messages');
}

if(isset($_POST['mass_ptn'])){
if(isset($_POST['mltple']) && is_array($_POST['mltple']) && count($_POST['mltple'])>0){

$mltple=$_POST['mltple'];
for($i=0;$i<count($mltple);$i++){$mltple[$i]=(int)$mltple[$i]; @unlink('paintings/'.$mltple[$i].'.png');}
$mltple=implode(',',$mltple);
$query='DELETE FROM '.$dbss['prfx']."_paintings WHERE p_id IN ($mltple)";
neutral_query($query);}
redirect('admin.php?q=paintings');
}

if(isset($_POST['mass_usr'])){$ina='';
if(isset($_POST['mltple']) && is_array($_POST['mltple']) && count($_POST['mltple'])>0){

$mass_usr=(int)$_POST['mass_usr'];$mltple=$_POST['mltple'];

if($mass_usr>0 && $mass_usr<3){
for($i=0;$i<count($mltple);$i++){$mltple[$i]=(int)$mltple[$i];}
$mltple=implode(',',$mltple);

if($mass_usr==1){$query='DELETE FROM '.$dbss['prfx']."_users WHERE usr_id IN ($mltple)";}
if($mass_usr==2){$query='UPDATE '.$dbss['prfx']."_users SET usr_status='0' WHERE usr_id IN ($mltple)";$ina='&inact=1';}
neutral_query($query);}}
redirect('admin.php?q=users'.$ina);}


if(isset($_POST['add_user'])){
$new_user=neutral_escape($_POST['add_user'],60,'str');
$add_n='';

$query='SELECT usr_id FROM '.$dbss['prfx']."_users WHERE usr_name='$new_user'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$add_n=rand(100,999);$new_user.=$add_n;}

$new_mail=neutral_escape($_POST['add_user'].$add_n.'@'.$_SERVER['SERVER_NAME'],64,'str');
$new_pass=hsh($new_user.$new_mail);

$query='INSERT INTO '.$dbss['prfx']."_users VALUES(NULL,'$new_user','$new_pass','$new_mail',$timestamp,'0')";
neutral_query($query);
redirect('admin.php?q=users');}


if(isset($_GET['del1usr'])){
$del1usr=(int)$_GET['del1usr'];
$query='DELETE FROM '.$dbss['prfx']."_users WHERE usr_id=$del1usr";
neutral_query($query);
redirect('admin.php?q=users');}


if(isset($_GET['act1usr'])){
$act1usr=(int)$_GET['act1usr'];

$query='SELECT usr_mail FROM '.$dbss['prfx']."_users WHERE usr_id=$act1usr";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$email=neutral_fetch_array($result);$email=$email['usr_mail'];
$mll=send_mail($email,$lang['adm_ac_sub'],$lang['adm_ac_msg'].$settings['url'],$settings['default_mail']);

$query='UPDATE '.$dbss['prfx']."_users SET usr_status='0' WHERE usr_id=$act1usr";
neutral_query($query);

if($mll!=TRUE){print $lang['acco_m_err'];die();};}

redirect('admin.php?q=users&inact=1');}


if(isset($_POST['usr_id']) && isset($_POST['usr_name']) && isset($_POST['usr_pass']) && isset($_POST['usr_mail'])){

$upd='';

$uid=(int)$_POST['usr_id'];
$uname=neutral_escape($_POST['usr_name'],64,'str');
$upass=hsh($_POST['usr_pass']);
$umail=neutral_escape($_POST['usr_mail'],64,'str');

$query='SELECT usr_id,usr_join_date FROM '.$dbss['prfx']."_users WHERE usr_name='$uname' AND usr_id<>$uid";
$result=neutral_query($query);$usr_join_date=neutral_fetch_array($result);$usr_join_date=(int)$usr_join_date['usr_join_date'];

if(neutral_num_rows($result)<1 && strlen($uname)>2){$upd.="usr_name='$uname',";}
if(strlen(trim($_POST['usr_pass']))>2){$upd.="usr_pass='$upass',";}
if(strlen(trim($_POST['usr_mail']))>6){$upd.="usr_mail='$umail',";}

if($upd!=''){
$query='UPDATE '.$dbss['prfx']."_users SET $upd usr_status=0 WHERE usr_id=$uid";
neutral_query($query);}

redirect('admin.php?q=user&u='.$uid);}


// ----


if(isset($_POST['mssg_history']) && isset($_POST['del_gbuddies']) && isset($_POST['optimize_tbl'])){
if($_POST['mssg_history']!=$settings['mssg_history']){
$mssg_history=(int)$_POST['mssg_history'];
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$mssg_history' WHERE set_id='mssg_history'";
neutral_query($query);}

if($_POST['del_gbuddies']!=$settings['del_gbuddies']){
$del_gbuddies=(int)$_POST['del_gbuddies'];
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$del_gbuddies' WHERE set_id='del_gbuddies'";
neutral_query($query);}

if($_POST['optimize_tbl']!=$settings['optimize_tbl']){
$optimize_tbl=(int)$_POST['optimize_tbl'];
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$optimize_tbl' WHERE set_id='optimize_tbl'";
neutral_query($query);}

redirect('admin.php?q=database');}

// ----

if(isset($_POST['cacp']) && isset($_POST['nacp']) && isset($_POST['racp'])){
$cacp=trim($_POST['cacp']);$nacp=trim($_POST['nacp']);$racp=trim($_POST['racp']);

if(strlen($nacp)>4 && $nacp==$racp && hsh($cacp)==$settings['acp_key']){
$acp_key=hsh($nacp);
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$acp_key' WHERE set_id='acp_key'";
neutral_query($query);
redirect('admin.php?q=acpkey');
}}

// -----

if(isset($_POST['notebook']) && isset($_POST['rdr'])){
$notebook=neutral_escape($_POST['notebook'],10000,'txt');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$notebook' WHERE set_id='notebook'";
neutral_query($query);
switch($_POST['rdr']){
case '1':redirect('admin.php?q=settings');break;
default:redirect('admin.php');break;}}

// -----

if(isset($_POST['faq_page'])){
$faq_page=neutral_escape($_POST['faq_page'],65535,'txt');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$faq_page' WHERE set_id='faq_page'";
neutral_query($query); redirect('admin.php?q=faq');}

// -----

if(isset($_POST['logo'])){

$logo=neutral_escape($_POST['logo'],65535,'txt');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$logo' WHERE set_id='logo'";
neutral_query($query);

$stm=$settings['style_template'];

$btx=neutral_escape($_POST['bt1'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=1"; neutral_query($query);  $stm=str_replace('[1]',$btx,$stm);
$btx=neutral_escape($_POST['bt2'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=2"; neutral_query($query);  $stm=str_replace('[2]',$btx,$stm);
$btx=neutral_escape($_POST['bt3'],128,'str');   $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=3"; neutral_query($query);  $stm=str_replace('[3]',$btx,$stm);
$btx=neutral_escape($_POST['bt4'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=4"; neutral_query($query);  $stm=str_replace('[4]',$btx,$stm);
$btx=neutral_escape($_POST['bt5'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=5"; neutral_query($query);  $stm=str_replace('[5]',$btx,$stm);
$btx=neutral_escape($_POST['bt6'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=6"; neutral_query($query);  $stm=str_replace('[6]',$btx,$stm);
$btx=neutral_escape($_POST['bt7'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=7"; neutral_query($query);  $stm=str_replace('[7]',$btx,$stm);
$btx=neutral_escape($_POST['bt8'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=8"; neutral_query($query);  $stm=str_replace('[8]',$btx,$stm);
$btx=neutral_escape($_POST['bt9'],6,'str');     $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=9"; neutral_query($query);  $stm=str_replace('[9]',$btx,$stm);
$btx=neutral_escape($_POST['bt10'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=10"; neutral_query($query); $stm=str_replace('[10]',$btx,$stm);
$btx=neutral_escape($_POST['bt11'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=11"; neutral_query($query); $stm=str_replace('[11]',$btx,$stm);
$btx=neutral_escape($_POST['bt12'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=12"; neutral_query($query); $stm=str_replace('[12]',$btx,$stm);
$btx=neutral_escape($_POST['bt13'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=13"; neutral_query($query); $stm=str_replace('[13]',$btx,$stm);
$btx=neutral_escape($_POST['bt14'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=14"; neutral_query($query); $stm=str_replace('[14]',$btx,$stm);
$btx=neutral_escape($_POST['bt15'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=15"; neutral_query($query); $stm=str_replace('[15]',$btx,$stm);
$btx=neutral_escape($_POST['bt16'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=16"; neutral_query($query); $stm=str_replace('[16]',$btx,$stm);
$btx=neutral_escape($_POST['bt17'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=17"; neutral_query($query); $stm=str_replace('[17]',$btx,$stm);
$btx=neutral_escape($_POST['bt18'],6,'str');    $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=18"; neutral_query($query); $stm=str_replace('[18]',$btx,$stm);
$btx=neutral_escape($_POST['bt19'],2048,'str'); $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=19"; neutral_query($query); $stm=str_replace('[19]',$btx,$stm);
$btx=neutral_escape($_POST['bt20'],2048,'str'); $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=20"; neutral_query($query); $stm=str_replace('[20]',$btx,$stm);
$btx=neutral_escape($_POST['bt21'],2048,'str'); $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=21"; neutral_query($query); $stm=str_replace('[21]',$btx,$stm);
$btx=neutral_escape($_POST['bt22'],2048,'str'); $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=22"; neutral_query($query); $stm=str_replace('[22]',$btx,$stm);
$btx=neutral_escape($_POST['bt23'],2048,'str'); $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=23"; neutral_query($query); $stm=str_replace('[23]',$btx,$stm);
$btx=neutral_escape($_POST['bt24'],2048,'str'); $query='UPDATE '.$dbss['prfx']."_style SET value='$btx' WHERE sid=24"; neutral_query($query); $stm=str_replace('[24]',$btx,$stm);

$stm=neutral_escape($stm,9999,'txt');
$query='UPDATE '.$dbss['prfx']."_settings SET set_value='$stm' WHERE set_id='style_delivery'";
neutral_query($query);

redirect('admin.php?q=style');}

// -----

if(isset($_GET['q']) && $_GET['q']=='dell_all'){
$query='DELETE FROM '.$dbss['prfx'].'_lines';
neutral_query($query);
redirect('admin.php?q=messages');}

// -----

if(isset($_GET['update'])){
include 'admin/update.php';
redirect('admin.php?q=update');}

/* --- */

if(!isset($_GET['q'])){$q='main';}else{$q=$_GET['q'];}

switch ($q){
case 'online'   : $title=$lang['main'];     $page='sl_online.pxtm';break;
case 'chatters' : $title=$lang['main'];     $page='sl_chatters.pxtm';break;
case 'messages' : $title=$lang['main'];     $page='sl_messages.pxtm';break;
case 'paintings': $title=$lang['main'];     $page='sl_paintings.pxtm';break;
case 'user'     : $title=$lang['users'];    $page='user.pxtm';break;
case 'users'    : $title=$lang['users'];    $page='users.pxtm';break;
case 'style'   : $title=$lang['style'];    $page='style.pxtm';break;
case 'config'   : $title='config.php';      $page='st_config.pxtm';break;
case 'options'  : $title=$lang['settings']; $page='st_settings.pxtm';break;
case 'database' : $title=$lang['settings']; $page='st_database.pxtm';break;
case 'acpkey'   : $title=$lang['settings']; $page='st_acpkey.pxtm';break;
case 'faq'      : $title=$lang['settings']; $page='st_faq.pxtm';break;
case 'update'   : $title=$lang['settings']; $page='st_update.pxtm';break;
case 'imp_faq'  : $title=$lang['settings']; $page='st_faq.pxtm';$fp='incl/faq_example.txt';if(is_file($fp)){$fp=file($fp); $settings['faq_page']=implode('',$fp);}break;

default: $title=$lang['main'];$page='main.pxtm';break;}

include 'admin/head.pxtm';
include 'admin/overal_header.pxtm';
include 'admin/'.$page;
include 'admin/overal_footer.pxtm';


?>