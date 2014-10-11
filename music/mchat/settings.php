<?php

require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($_GET['tzone'])){$tzone=0;}else{$tzone=(int)$_GET['tzone'];}

if(isset($_POST['sett0'])){
$p0=(int)$_POST['sett0'];
$p1=0;// void, timezone
if(isset($_POST['sett2'])){$p2=(int)$_POST['sett2'];}else{$p2=0;}
if(isset($_POST['sett3'])){$p3=(int)$_POST['sett3'];}else{$p3=0;}
if(isset($_POST['sett4'])){$p4=(int)$_POST['sett4'];}else{$p4=0;}
if(isset($_POST['sett5'])){$p5=(int)$_POST['sett5'];}else{$p5=0;}
if(isset($_POST['sett6'])){$p6=(int)$_POST['sett6'];}else{$p6=0;}
if(isset($_POST['sett7'])){$p7=(int)$_POST['sett7'];}else{$p7=0;}
if(isset($_POST['sett8'])){$p8=(int)$_POST['sett8'];}else{$p8=0;}
if(isset($_POST['sett9'])){$p9=(int)$_POST['sett9'];}else{$p9=0;}
if(isset($_POST['sett10'])){$p10=(int)$_POST['sett10'];}else{$p10=999;}
$pp=$p0.'z'.$p1.'z'.$p2.'z'.$p3.'z'.$p4.'z'.$p5.'z'.$p6.'z'.$p7.'z'.$p8.'z'.$p9.'z'.$p10;
setcookie('blab7_options',$pp,time()+3600*24*365,'/');
redirect('blab.php');die();}

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

include 'lang/languages.inc';
include 'ui/templates/settings.pxtm';

?>