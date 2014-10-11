<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

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

if(!isset($user['id']) || !$user['name']){print 'error 000';die();}


/* --- */

if(!isset($_POST['srx']) || !isset($_POST['sry']) || !isset($_POST['src'])){print 'error 001';die();}
$srx=trim($_POST['srx']);$sry=trim($_POST['sry']);$src=trim($_POST['src']);
if(strlen($srx)>65000 || strlen($sry)>65000 || strlen($src)>65000){print 'error 002';die();}
if(!preg_match('/[^0-9 ]/',$srx)){$sr1=explode(' ',$srx);}else{print 'error 003';die();}
if(!preg_match('/[^0-9 ]/',$sry)){$sr2=explode(' ',$sry);}else{print 'error 004';die();}
if(!preg_match('/[^a-z0-9 ]/',$src)){$sr3=explode(' ',$src);}else{print 'error 005';die();}
if(count($sr1)<2){print 'error 006';die();}
if((count($sr1) != count($sr2)) || (count($sr1) != count($sr3))){print 'error 007';die();}

$thumb='np';

$srx=neutral_escape($srx,65000,'str');
$sry=neutral_escape($sry,65000,'str');
$src=neutral_escape($src,65000,'str');

$uid=(int)$user['id'];
$uname=neutral_escape($user['name'],255,'str');

$query='INSERT INTO '.$dbss['prfx']."_paintings VALUES(NULL,'$srx','$sry','$src','',0,$timestamp,$uid,'$uname')";
neutral_query($query);

$query='SELECT MAX(p_id) FROM '.$dbss['prfx'].'_paintings';
$result=neutral_query($query);$pid=neutral_fetch_array($result);$pid=(int)$pid[0];


if(function_exists('imagecolorallocate') && function_exists('imagecreate') && function_exists('imagesetbrush')){
$q1=0;$q2=0;$q3=0;$m1=-1;$m2=-1;$m3=-1;$s1=0;$s2=-1;

function cl($x){
global $q1,$q2,$q3;
switch($x){
case 'a':$q1=0xEE;$q2=0xEE;$q3=0xEE;break;
case 'b':$q1=0x5D;$q2=0x1D;$q3=0x11;break;
case 'c':$q1=0xF2;$q2=0x95;$q3=0x6C;break;
case 'd':$q1=0x61;$q2=0x78;$q3=0xAC;break;
case 'e':$q1=0xDD;$q2=0xDD;$q3=0xDD;break;
case 'f':$q1=0x5A;$q2=0x68;$q3=0x2D;break;
case 'g':$q1=0xA4;$q2=0x83;$q3=0xBC;break;
case 'h':$q1=0x9F;$q2=0xD1;$q3=0x8C;break;
case 'i':$q1=0xB4;$q2=0xB6;$q3=0xB5;break;
case 'j':$q1=0xF4;$q2=0x73;$q3=0x22;break;
case 'k':$q1=0x25;$q2=0x37;$q3=0x77;break;
case 'l':$q1=0xDE;$q2=0x4D;$q3=0x6C;break;
case 'm':$q1=0x76;$q2=0x78;$q3=0x77;break;
case 'n':$q1=0x44;$q2=0x0D;$q3=0x46;break;
case 'o':$q1=0xBC;$q2=0xD5;$q3=0x2F;break;
case 'p':$q1=0xF9;$q2=0x8D;$q3=0x21;break;
case 'q':$q1=0x45;$q2=0x45;$q3=0x45;break;
case 'r':$q1=0xED;$q2=0x1E;$q3=0x24;break;
case 's':$q1=0x6A;$q2=0xBE;$q3=0x45;break;
case 't':$q1=0x38;$q2=0x53;$q3=0xA4;break;
case 'u':$q1=0x23;$q2=0x23;$q3=0x23;break;
case 'v':$q1=0xFD;$q2=0xDA;$q3=0x06;break;
case 'w':$q1=0xCE;$q2=0x15;$q3=0x7D;break;
case 'x':$q1=0x1A;$q2=0x94;$q3=0xBD;break;
case 'y':$q1=0xFF;$q2=0xFF;$q3=0xFF;break;
default :$q1=0x00;$q2=0x00;$q3=0x00;break;}}


$im=imagecreate(400,220);
$fff=imagecolorallocate($im,0xff,0xff,0xff);
imagefill($im,0,0,$fff);
$dx=0;$dy=0;$cx=0;$cy=0;

for($i=0;$i<count($sr1);$i++){
cl(substr($sr3[$i],0,1)); $s1=substr($sr3[$i],1,1);$s1*=2;

if($s1!=$s2 || $q1!=$m1 ||  $q2!=$m2 ||  $q3!=$m3){
$brush=imagecreate($s1,$s1);$s3=$s1/2;$s3=(int)$s3;
$b_col=imagecolorallocate($brush,0,0,0);
imagecolortransparent($brush,$b_col);
$f_col=imagecolorallocate($brush,$q1,$q2,$q3);
imagefilledellipse($brush,$s3,$s3,$s1,$s1,$f_col);
imagesetbrush($im,$brush);
$m1=$q1;$m2=$q2;$m3=$q3;$s2=$s1;}

$dx=$cx; $dy=$cy; $cx=$sr1[$i]; $cy=$sr2[$i];
if($dx>0 && $dy>0 && $cx>0 && $cy>0){imageline($im,$dx,$dy,$cx,$cy,IMG_COLOR_BRUSHED);}
elseif($cx>0 && $cy>0){imageline($im,$cx-1,$cy-1,$cx,$cy,IMG_COLOR_BRUSHED);}
}

$im2=imagecreate(68,38);
imagecopyresampled($im2, $im, 0, 0, 0, 0, 68, 38, 400, 220);
@imagepng($im2,'./paintings/'.$pid.'.png'); 
imagedestroy($brush); imagedestroy($im); imagedestroy($im2);
}

$message=str_replace('/p%P_NUM%','<span class="link_color" style="text-align:right" onclick="if(parent.document.getElementById(\'ln\')){m=parent.document.getElementById(\'ln\');m.value=m.value+\' /p%P_NUM%\';m.focus()}"><b>/p%P_NUM%</b></span>',$lang['post_pntg']);
$message=str_replace('%P_NUM%',$pid,$message);

?><!DOCTYPE html>
<html><head>
<title>...</title>
<meta charset="utf-8" />
<?php print '<style type="text/css">'.$settings['style_delivery'].'</style>'; ?>
<link rel="stylesheet" type="text/css" href="ui/style.css" />
</head><body class="paint_body bgcolor_panel_content">
<div style="margin:35px;margin-top:100px;margin-bottom:20px;text-align:justify">
<img src="paintings/<?php print $pid;?>.png" class="paint_thumb" alt="" style="float:left;margin-right:25px" onclick="if(typeof parent.play_p == 'function'){parent.play_p(<?php print $pid;?>);}" />
<?php print $message;?></div>
<div style="margin-right:35px;float:right;font-weight:bold">
<span class="link_color" onclick="self.location.href='p_paint.php'"><?php print $lang['paint'];?></span>
</div><div style="margin-left:35px;float:left;font-weight:bold">
 <b>p<?php print $pid;?></b>: <span class="link_color" onclick="if(parent.document.getElementById('ln')){m=parent.document.getElementById('ln');m.value=m.value+' /p'+<?php print $pid;?>;m.focus()}"><?php print $lang['insrt'];?></span>
&middot;
<span class="link_color" onclick="if(parent.document.getElementById('ln') && typeof parent.close_l == 'function'){parent.chat_post='/p'+<?php print $pid;?>;parent.close_l();parent.force_dr(1)}"><?php print $lang['postp'];?></span>
&middot;
<span class="link_color" onclick="if(typeof parent.play_p == 'function'){parent.play_p(<?php print $pid;?>);}"><?php print $lang['playp'];?></span>
</div>
</body></html>