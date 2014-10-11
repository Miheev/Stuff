<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

if(!isset($_GET['q'])){$q=0;}else{$q=(int)$_GET['q'];}


$query='SELECT * FROM '.$dbss['prfx'].'_paintings WHERE p_id='.$q;
$result=neutral_query($query);

if(neutral_num_rows($result)<1){print '<!DOCTYPE html><html><head><title>...</title><meta charset="utf-8" /></head><body style="color:#000;background-color:#fff"><p style="font:10px verdana,sans-serif">'.$lang['nopnt'].'</p></body></html>';die();}
$pp=neutral_fetch_array($result);
$author=htmrem($pp['usr_name']);

$query='UPDATE '.$dbss['prfx'].'_paintings SET p_views=p_views+1 WHERE p_id='.$q;
neutral_query($query);

?><!DOCTYPE html>
<html><head>
<title>...</title>
<meta charset="utf-8" />
<!--[if IE]><script type="text/javascript" src="incl/excanvas.compiled.js"></script><![endif]-->
<script type="text/javascript"><!--
ii=0;pp=1;

px_array='<?php print $pp['p_srx'];?>';
py_array='<?php print $pp['p_sry'];?>';
pc_array='<?php print $pp['p_src'];?>';


px_array=px_array.split(' ');
py_array=py_array.split(' ');
pc_array=pc_array.split(' ');

cX=0;cY=0;cC=0;cW=0;dX=0;dY=0;

function mm(){
dX=cX;cX=px_array[ii];if(dX<1){dX=cX}
dY=cY;cY=py_array[ii];if(dY<1){dY=cY}
cC=pc_array[ii].substr(0,1);cC=cl(cC);
cW=pc_array[ii].substr(1,1);cW=parseInt(cW);
ii+=1;
if(!px_array[ii]){clearInterval(gpad);pp=0}else{droo()}}


function droo(){if(cX>0){
cn=ccn.getContext('2d');cn.beginPath();
cn.strokeStyle='#'+cC;cn.lineWidth=cW*2;cn.lineJoin='round';cn.moveTo(dX,dY);
cn.lineTo(cX,cY);cn.lineTo(dX,dY);
if(cX==dX && cY==dY){p=cX-1;o=cY-1;cn.lineTo(p,o);cn.lineTo(cX,cY);cn.lineTo(p,o);}
cn.stroke();}}

function cl(x){
switch(x){
case 'a':q='EEEEEE';break;
case 'b':q='5D1D11';break;
case 'c':q='F2956C';break;
case 'd':q='6178AC';break;
case 'e':q='DDDDDD';break;
case 'f':q='5A682D';break;
case 'g':q='A483BC';break;
case 'h':q='9FD18C';break;
case 'i':q='B4B6B5';break;
case 'j':q='F47322';break;
case 'k':q='253777';break;
case 'l':q='DE4D6C';break;
case 'm':q='767877';break;
case 'n':q='440D46';break;
case 'o':q='BCD52F';break;
case 'p':q='F98D21';break;
case 'q':q='454545';break;
case 'r':q='ED1E24';break;
case 's':q='6ABE45';break;
case 't':q='3853A4';break;
case 'u':q='232323';break;
case 'v':q='FDDA06';break;
case 'w':q='CE157D';break;
case 'x':q='1A94BD';break;
case 'y':q='FFFFFF';break;
default :q='000000';break;}
return q;}

cv='<canvas id="cnvs" style="width:400px;height:220px;background-color:#fff"></canvas>';

function switch_p(){
if(typeof gpad=='number'){clearInterval(gpad);}
ii=0;cn=ccn.getContext('2d');cn.fillStyle='#ffffff';cn.fillRect(0,0,400,220);
if(pp<1){pp=1;gpad=setInterval('mm()',10);}
else{pp=0;for(ss=0;ss<px_array.length-1;ss++){mm()}}
}
//-->
</script></head>
<body style="margin:0px;padding:0px">
<div id="bbh" style="margin:0px;padding:0px;cursor:pointer" onclick="switch_p()"></div>
<script type="text/javascript"><!--
document.getElementById('bbh').innerHTML=cv;
ccn=document.getElementById('cnvs'); ccn.width=400; ccn.height=220;
if(typeof px_array!='undefined' && px_array.length>0 && px_array.length==py_array.length && px_array.length==pc_array.length){gpad=setInterval('mm()',10);}
//-->
</script>
<div style="color:#fff;background-color:#000;padding:2px;padding-left:8px;padding-right:8px;font-size:8pt;font-family:verdana,sans-serif;position:absolute;top:210px"><?php print '<span style="cursor:pointer" onclick="if(parent.document.getElementById(\'ln\')){m=parent.document.getElementById(\'ln\');m.value=m.value+\' /p\'+'.$q.';m.focus()}" title="'.$lang['insrt'].'">p'.$q.'</span> '.$lang['author'].': '.$author;?></div>
</body></html>

