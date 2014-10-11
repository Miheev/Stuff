<?php 
require_once 'config.php';
require_once 'incl/main.inc';

$separator=', ';
$hyb_style='position:fixed;color:#000;background-color:#eee;border:1px solid #333;padding:5px;';

if(isset($_GET['mode'])){$mode=(int)$_GET['mode'];}else{$mode=0;}

dbconnect();
$query='SELECT usr_name FROM '.$dbss['prfx']."_online WHERE ($timestamp-rtime)<20";
$result=neutral_query($query);

$online=array();
while($row=neutral_fetch_array($result)){
$online[]=addslashes(htmrem($row['usr_name']));}

sort($online); 
$numonl=count($online);
$online=implode($separator,$online);


switch($mode){
case 0 : print 'document.write(\''.$numonl.'\');';break;
case 1 : print 'document.write(\''.$online.'\');';break;
case 2 :
$create_dv_nmbr='<a href="#" onclick="sho_list(event);return false"><span id="blab_online_nmbr">(<b>'.$numonl.'</b>)</span></a>';
$create_dv_list='<span id="blab_online_list" onclick="set_empty();return false" style="'.$hyb_style.';display:none">&nbsp;'.$online.'&nbsp;</span>';
break; default: print 'document.write(\'No such mode...\');';break;}

if($mode<>2){die();}
?>

function set_empty(){
document.getElementById('blab_online_list').style.display='none';
document.getElementById('blab_online_nmbr').innerHTML='';}

function sho_list(evt){
if(typeof window.external=='object' && typeof document.all=='object'){cX=parseInt(evt.clientX);cY=parseInt(evt.clientY)}else{cX=evt.pageX;cY=evt.pageY}
document.getElementById('blab_online_list').style.top=cY+'px';
document.getElementById('blab_online_list').style.left=cX+'px';
document.getElementById('blab_online_list').style.display='block';}

document.write('<?php print $create_dv_nmbr.$create_dv_list;?>');
setTimeout('set_empty()',20000);