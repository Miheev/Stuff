<?php
require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0); $options=get_options(); $lang=get_language(); 

?><!DOCTYPE html>
<html><head>
<title>...</title>
<meta charset="utf-8" />
<?php print '<style type="text/css">'.$settings['style_delivery'].'</style>'; ?>
<link rel="stylesheet" type="text/css" href="ui/style.css" />
<!--[if IE]><script type="text/javascript" src="incl/excanvas.compiled.js"></script><![endif]-->
<script type="text/javascript"><!--
i=0;posx=0;posy=0;m_color='z';m_width=4;eX='';eY='';eC='';
cX=new Array();cY=new Array();cD=new Array();cC=new Array();cW=new Array();paint=false;

function setc(x){
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


function posf(e){
posx=0;posy=0;if(!e){e=window.event}
if(e.pageX||e.pageY){posx=e.pageX;posy=e.pageY;}else if(e.clientX||e.clientY){
posx=e.clientX+document.body.scrollLeft+document.documentElement.scrollLeft;
posy=e.clientY+document.body.scrollTop+document.documentElement.scrollTop;}
posx=parseInt(posx);posy=parseInt(posy);}

function adob(x,y,d){if(x<401 && y<221){eX+=' ';eX+=x;eY+=' ';eY+=y;eC+=' ';eC+=m_color;eC+=m_width;
if(x>0 && y>0){cX.push(x);cY.push(y);cD.push(d);cC.push(m_color);cW.push(m_width);}}}

function droo(){cn=ccn.getContext('2d');
for(;i<cX.length; i++){cn.beginPath();
if(cD[i] && i){cn.moveTo(cX[i-1],cY[i-1]);}else{cn.moveTo(cX[i]-1,cY[i]);}
cn.lineTo(cX[i],cY[i]);cn.closePath();colo=setc(cC[i]);
cn.strokeStyle='#'+colo;cn.lineJoin='round';
cn.lineWidth=cW[i]*2;cn.stroke();}}

function stok(){
cui=document.getElementById('p_cwi');
c_color=setc(m_color);c_color='#'+c_color;
cui.style.backgroundColor=c_color;
c_size=m_width*2+1;cui.style.width=c_size+'px';}

function rcol(x,y,z){
if(z>0){m_color=x;stok();
y.style.borderColor='#000';}
else{y.style.borderColor='#fff';}}

function bwdh(x,y){
x.style.borderColor='#000';
if(y>0){x.innerHTML='+';if(9>m_width){m_width+=1}}
else{x.innerHTML='-';if(m_width>1){m_width-=1}}
stok();
if(typeof qq == 'number'){clearTimeout(qq)};
sq=document.getElementById('p_spi');
sq.innerHTML=m_width; sq.style.display='block';
qq=setTimeout("sq.style.display='none'",1500)}

cv='<canvas id="cnvs" style="width:400px;height:220px;background-color:#fff;cursor:default"></canvas>';
//-->
</script>
<style type="text/css">
html{overflow:hidden}
.p_cc1{font-size:8px;width:10px;height:10px;border:1px solid #fff;margin-left:1px;float:left;cursor:pointer}
.p_cc2{font-size:8px;width:10px;height:10px;border:1px solid #fff;margin-left:1px;margin-top:1px;float:left;cursor:pointer}
</style>
</head>

<body class="paint_body bgcolor_panel_content">
<div id="bbh" style="margin:0px;padding:0px"></div>
<div id="p_spi" style="background-color:#000;color:#fff;position:absolute;top:175px;left:200px;font-size:14pt;padding:12px;font-weight:bold;display:none">0</div>

<div class="paint_toolbar_container bgcolor_panel_bars" style="border:1px solid #fff">
<div style="float:left;margin-left:3px">
<div class="paint_clear_button bgcolor_panel_bars" onmousedown="i=0;eX='';eY='';eC='';cX=new Array();cY=new Array();cD=new Array();cC=new Array();cW=new Array();cn=ccn.getContext('2d');cn.fillStyle='#ffffff';cn.fillRect(0,0,400,220);ccn.width=ccn.width;this.innerHTML='C';this.style.borderColor='#000';" onmouseup="this.innerHTML='C';this.style.borderColor='#fff'" onmouseout="this.innerHTML='C';this.style.borderColor='#fff'">C</div> 
<div style="width:176px;float:left;margin-left:3px">
<div class="p_cc1" style="background-color:#EEEEEE" onmousedown="rcol('a',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#5D1D11" onmousedown="rcol('b',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#F2956C" onmousedown="rcol('c',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#6178AC" onmousedown="rcol('d',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#DDDDDD" onmousedown="rcol('e',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#5A682D" onmousedown="rcol('f',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#A483BC" onmousedown="rcol('g',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#9FD18C" onmousedown="rcol('h',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#B4B6B5" onmousedown="rcol('i',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#F47322" onmousedown="rcol('j',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#253777" onmousedown="rcol('k',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#DE4D6C" onmousedown="rcol('l',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc1" style="background-color:#ffffff;margin-left:3px" onmousedown="rcol('y',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#767877" onmousedown="rcol('m',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#440D46" onmousedown="rcol('n',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#BCD52F" onmousedown="rcol('o',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#F98D21" onmousedown="rcol('p',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#454545" onmousedown="rcol('q',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#ED1E24" onmousedown="rcol('r',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#6ABE45" onmousedown="rcol('s',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#3853A4" onmousedown="rcol('t',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#232323" onmousedown="rcol('u',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#FDDA06" onmousedown="rcol('v',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#CE157D" onmousedown="rcol('w',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#1A94BD" onmousedown="rcol('x',this,1)" onmouseout="rcol(0,this,0)"></div>
<div class="p_cc2" style="background-color:#000000;margin-left:3px" onmousedown="rcol('z',this,1)" onmouseout="rcol(0,this,0)"></div>
</div></div>

<div style="float:left;width:22px">
<div class="paint_plus_minus bgcolor_panel_bars" style="margin-top:0px" onmousedown="bwdh(this,1)" onmouseup="this.innerHTML='+';this.style.borderColor='#fff'" onmouseout="this.innerHTML='+';this.style.borderColor='#fff'">+</div>
<div class="paint_plus_minus bgcolor_panel_bars" style="margin-top:1px" onmousedown="bwdh(this,0)" onmouseup="this.innerHTML='-';this.style.borderColor='#fff'" onmouseout="this.innerHTML='-';this.style.borderColor='#fff'">-</div>
</div>

<div id="p_cwi" style="margin-left:5px;float:left;height:21px;border:2px solid #fff"></div>

<input type="button" class="login_button title2 textbox_extra" style="float:right;margin-right:5px;width:100px;height:25px" onclick="if(eX.length>50){document.forms['ff'].srx.value=eX;document.forms['ff'].sry.value=eY;document.forms['ff'].src.value=eC;document.forms['ff'].submit();}else{this.style.color='#aaa';g='#000';o=this;setTimeout('o.style.color=g',2000)}" value="<?php print $lang['submit'];?>" />
<br style="clear:both" /></div>

<form id="ff" action="p_upload.php" method="post"><p>
<input type="hidden" name="srx" value="" />
<input type="hidden" name="sry" value="" />
<input type="hidden" name="src" value="" />
</p></form>

<div id="ocv" style="color:#fff;background-color:#f4f4f4;font-family:arial,sans-serif;font-weight:bold;font-size:48px;position:absolute;width:390px;height:210px;border:5px solid #fff;left:0px;top:0px;line-height:220px;text-align:center;cursor:pointer" onmousedown="this.style.display='none'"><?php print $lang['painthere'];?></div>

<script type="text/javascript">
document.getElementById('bbh').innerHTML=cv;
ccn=document.getElementById('cnvs'); ccn.width=400;ccn.height=220;
ccn.onmouseup=function(e){paint=false;adob(0,0)}
ccn.onmouseleave=function(e){paint=false;adob(0,0)}
ccn.onmousemove=function(e){if(paint){posf(e);adob(posx,posy,true);droo()}}
ccn.onmousedown=function(e){paint=true;posf(e);adob(posx,posy);droo()}
ccn.onselectstart=function(){return false;}; stok();
document.onmouseup=function(e){paint=false;adob(0,0)}
setTimeout("document.getElementById('ocv').style.display='none'",2000)
</script>
</body></html>