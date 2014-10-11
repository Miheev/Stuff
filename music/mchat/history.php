<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect();

if(isset($_POST['lang_p'])){$lang_p=$_POST['lang_p'];}else{$lang_p='Page';}
if(isset($_POST['lang_m'])){$lang_m=$_POST['lang_m'];}else{$lang_m='Posts';}
if(isset($_POST['history_p'])){$period=(int)$_POST['history_p'];}else{$period=1200;} if($period<1){$period=999999999;}
if(isset($_POST['history_f'])){$from=(int)$_POST['history_f'];}else{$from=0;}
if(isset($_POST['uid'])){$uid=(int)$_POST['uid'];}else{$uid=0;}
if(isset($_POST['zone'])){$tzone=(int)$_POST['zone'];}else{$tzone=0;}
if(isset($_POST['tfrm'])){$tfrm=(int)$_POST['tfrm'];}else{$tfrm=1;}
if(!isset($_POST['uname']) || !isset($_POST['uhash']) || $_POST['uhash']!=hsh($uid.$_POST['uname'].'blab')){die();}

$tpoint=$timestamp-$period;
$query='SELECT COUNT(*) FROM '.$dbss['prfx']."_lines WHERE timestamp>$tpoint";
$result=neutral_query($query);

$lines_count=neutral_fetch_array($result);$lines_count=(int)$lines_count[0];

$pages_count=ceil($lines_count/100);if($pages_count<1){$pages_count=1;}
$pages_numbr=ceil($from/100)+1;

if($lines_count>0){
$query='SELECT * FROM '.$dbss['prfx']."_lines WHERE timestamp>$tpoint ORDER BY line_id ASC LIMIT 100 OFFSET $from";
$result=neutral_query($query);

$to=$from+100; if($lines_count<$to){$to=$lines_count;}
if($from<$lines_count){$inf_line='<div class="text_small">('.$lang_m.': '.$lines_count.') ('.$lang_p.': '.$pages_numbr.'/'.$pages_count.')</div>&nbsp;';print $inf_line;}

switch($tfrm){
case 1:$format='m/d/Y h:i:s A';break;
case 3:$format='d.m.Y H:i:s';break;
case 4:$format='m/d/Y h:i:s A';break;
default :$format='Y-m-d H:i:s';break;}

while($row=neutral_fetch_array($result)){
if(strlen($row['from_name'])>0){$pm='<b class="text_small">'.$row['from_name'].'</b>: ';}else{$pm='';}
$tmm=gmdate($format,$row['timestamp']+$tzone*60);$tmm='['.$tmm.']';
print '<div><span class="text_small">'.$tmm.'</span> '.$pm.$row['line_txt'].'</div>';}
if($from<$lines_count){print '<p></p>'.$inf_line;}}
else{print '-';}
?>