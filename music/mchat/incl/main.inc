<?php

function time_to_run(){
$time=microtime();
$time=explode(' ',$time);
return $time[1]+$time[0];}
$start_time=time_to_run();

// -----

function process_error($s){
global $error_log;
if(is_writeable($error_log)){
$s="\r\n".date('Y-m-d H:i:s').' '.$s;
$fd=fopen($error_log,"a");
$fout=fwrite($fd,$s);fclose($fd);}
die('SQL error... Please check your error log file for details...');}

// -----

function htmrem($a){
$a=str_replace('<','&lt;',$a);
$a=str_replace('>','&gt;',$a);
$a=str_replace('"','&quot;',$a);
$a=str_replace('|:|','',$a);
$a=str_replace(':|:','',$a);
return $a;}

// -----

function shorturl($a){$b=substr($a,0,25);if(strlen($a)>25)$b.='...';return $b;}

function url2link($t) {
$t=preg_replace("#(([a-zA-Z]+://)([a-zA-Z0-9?&%.;:/=+_-]*))#e", "'<span class=\"link_color text_underline\" onclick=\"window.open(\'$1\');return false\">'.shorturl(\"$3\").'</span>'",$t);
return $t;}

function emo2image($t){
include 'ui/smilies.inc';
$emoticons=array_merge($emoticons,$aliases);
for($i=0;$i<count($emoticons);$i++){
$row=explode(' ',$emoticons[$i]);
if(isset($row[2])){$row[1]=$row[2];}
$t=str_replace($row[0],"<img src=\"ui/smilies/$row[1]\"  alt=\"$row[0]\" />",$t);}
return $t;}

// -----


function hsh($a){
global $salt;
$a=md5(md5($a).$salt);
return $a;}

// -----

function dbconnect(){global $dbss;if($dbss['pcon']>0){neutral_dbpconnect();}else{neutral_dbconnect();}}

// -----

function get_language(){
global $options;
include 'lang/languages.inc';

$set_lang='lang/'.$lang_files[$options[0]];
if(!is_file($set_lang)){$set_lang='lang/'.$lang_files[0];}

include $set_lang;return $lang;}

// ----

function get_settings($f){
global $dbss;$settings=array(); 
if($f>0){$f='';}else{$f=' WHERE set_fast=0';}
$query='SELECT set_id,set_value FROM '.$dbss['prfx'].'_settings'.$f;
$result=neutral_query($query);
while($row=neutral_fetch_array($result)){$settings[$row['set_id']]=$row['set_value'];}
return $settings;}

// ----

function redirect($u){
header('location:'.$u);
}

// ----

function send_mail($a,$b,$c,$d){
$d="From: $d\r\n";
$d.="Content-type: text/plain; charset=\"utf-8\"\r\n";
$d.="Content-Transfer-Encoding: 8bit\r\n";
$e=mail($a,$b,$c,$d); return $e;}

// ----

function get_options(){
global $settings;$options=array();
if(isset($_COOKIE['blab7_options'])){$options=explode('z',$_COOKIE['blab7_options']);}

if(!isset($options[10])){

$options[0]=$settings['default_language'];
$options[1]=0; // void, timezone
$options[2]=$settings['default_timeform'];
$options[3]=$settings['default_effects'];
$options[4]=$settings['default_sound1'];
$options[5]=$settings['default_sound2'];
$options[6]=$settings['default_sound3'];
$options[7]=$settings['default_sound4'];
$options[8]=0;    // bold
$options[9]=0;    // italic
$options[10]=999; // color
}

if(stristr($_SERVER['HTTP_USER_AGENT'],'MSIE')){
$iev=explode('MSIE',$_SERVER['HTTP_USER_AGENT']);
$iev=(int)$iev[1];if($iev<9){$options[3]=0;}}

for($i=0;$i<11;$i++){$options[$i]=(int)$options[$i];}
return $options;}

/* --- */

$random=mt_rand(1,999999); $timestamp=time(); $queries=0; 
unset($settings,$options);

require_once 'incl/'.$dbss['type'].'_functions.inc';

if(!headers_sent()){
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-type: text/html; charset=UTF-8");}

?>