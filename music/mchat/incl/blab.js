iev=0; div_toscroll=0; lock_autoscroll=0; txt_b=0; txt_i=0; txt_c=999; tmp_j='';
chat_lid=-1; online_hash='0'; chat_post=''; hocus=1; s_msg=new Array();
history_p=20*60; history_f=0; js_flood=0; jfr='<iframe name="ifr" style="display:none"></iframe>'; sess_snd=1;
htto=new Array(); mmc=1;

tit_a=document.title.toString();tit_b='* '+tit_a;

tmp_a=0; // object [ajx]
tmp_d=0; // object [opa]
tmp_o=0; // opa X
tmp_s=1; // opa direction

ogg_ok=false;mp3_ok=false; audf=document.createElement('audio');
if(audf.canPlayType && ''!=audf.canPlayType('audio/mpeg')){mp3_ok=true;}
if(audf.canPlayType && ''!=audf.canPlayType('audio/ogg')){ogg_ok=true;}


function set_opa(a,b){
if(effe<1 || iev>0){
if(b>0){document.getElementById(a).style.display='block';document.getElementById(a).style.visibility='inherit'}else{document.getElementById(a).style.display='none'}}
else{
if(typeof opad=='number' && typeof tmp_d=='object'){
clearInterval(opad);tmp_d.style.opacity=1;if(tmp_s>0 && tmp_d.style.display!='none'){tmp_d.style.display='block'}else{tmp_d.style.display='none'}
}
tmp_d=document.getElementById(a);
tmp_d.style.display='block';tmp_d.style.visibility='visible';
if(b>0){tmp_d.style.opacity=0;tmp_o=0;  tmp_s=1;opad=setInterval('do_opa()',10);}
   else{tmp_d.style.opacity=1;tmp_o=100;tmp_s=0;opad=setInterval('do_opa()',10);}
}}

function do_opa(){
if(tmp_s>0){tmp_o+=5;j=tmp_o/100;tmp_d.style.opacity=j
if(tmp_o>=100){clearInterval(opad);}}
else{   tmp_o-=5;j=tmp_o/100;tmp_d.style.opacity=j
if(tmp_o<=0){clearInterval(opad);tmp_d.style.display='none';}
}}


if(typeof window.external=='object' && typeof document.all=='object'){
iev=navigator.userAgent;iev=iev.split('MSIE');iev=parseInt(iev[1]);if(iev>8){iev=0}}

function go(x){window.location.href=x;}
function op(m,n){if(iev>1){m.style.filter='alpha(opacity='+n*10+')';}else{m.style.opacity=n/10;}return false}

function set_rsize(){close_l(); close_p();
if(lock_autoscroll==0){document.getElementById('blab_chat').scrollTop=9999999;}}

function ad_emo(w){v=document.getElementById('ln');v.value=v.value+ ' '+w+' ';v.focus();}

function play_s(x){if(x>0){
if(ogg_ok || mp3_ok){
if(ogg_ok){x='ui/sounds/'+x+'.ogg';}
else if(mp3_ok){x='ui/sounds/'+x+'.mp3';}
audf.src=x; audf.play();}
else{x='ui/sounds/'+x+'.swf';
document.getElementById('sn').innerHTML='';
ssr='<object data="'+x+'" type="application/x-shockwave-flash" width="1" height="1" style="position:absolute;left:0px;top:0px;visibility:hidden"><param name="movie" value="'+x+'" /><param name="menu" value="false" /><param name="quality" value="high" /></object>';
document.getElementById('sn').innerHTML=ssr;}}}

function http_obj(){
if(typeof window.external=='object' && typeof document.all=='object'){
r=new ActiveXObject("Microsoft.XMLHTTP")}
else{r=new XMLHttpRequest()}return r}

function scrll(m){
if(div_toscroll<1){dv=document.getElementById('blab_chat');
if(lock_autoscroll<1 && (m==38 || m==40)){close_l();set_opa('box_autoscroll',1);lock_autoscroll=1;}}
else{dv=document.getElementById('blab_online_content')}
if(m==38){dv.scrollTop-=15} if(m==40){dv.scrollTop+=15}}

function scrll2(m){
if(div_toscroll<1){dv=document.getElementById('blab_chat');
if(lock_autoscroll<1){close_l();set_opa('box_autoscroll',1);lock_autoscroll=1;}}
              else{dv=document.getElementById('blab_online_content')}
if(m>0){dv.scrollTop-=15}else{dv.scrollTop+=15}}


function hide_o(x){
if(x<1){
document.getElementById('blab_online_content').style.display='none';
document.getElementById('blab_online_show_button').style.display='block';
document.getElementById('blab_online_top_bar').style.display='none';
document.getElementById('blab_chat').style.width='95%';}
else{ws='78%';
document.getElementById('blab_online_content').style.display='block';
document.getElementById('blab_online_show_button').style.display='none';
document.getElementById('blab_online_top_bar').style.display='block';
document.getElementById('blab_chat').style.width=ws;}
setTimeout('dv2scrll(0)',20);
document.getElementById('blab_chat').scrollTop=9999999;}

function dv2scrll(x){
div_toscroll=x; if(x<1){
document.getElementById('arri1').style.display='block';
document.getElementById('arri2').style.display='none';}
else{
document.getElementById('arri1').style.display='none';
document.getElementById('arri2').style.display='block';}}

function s_chat(){
mmc++;htto[mmc]=http_obj();
s='uid='+uid+'&uname='+uname+'&uhash='+uhash+'&chat_lid='+chat_lid+'&online_hash='+online_hash+'&zone='+zone+'&tfrm='+tfrm+'&txt_b='+txt_b+'&txt_i='+txt_i+'&txt_c='+txt_c;
if(chat_post.length>0){
pz=/\%/g;chat_post=chat_post.replace(pz,'%25');
amp=/&/g;chat_post=chat_post.replace(amp,'%26');
pl=/\+/g;chat_post=chat_post.replace(pl,'%2B');
s=s+'&cp='+chat_post;chat_post='';}
htto[mmc].open('post','ajb.php');
htto[mmc].setRequestHeader('Content-Type','application/x-www-form-urlencoded');
htto[mmc].onreadystatechange=function(){r_chat(mmc)};htto[mmc].send(s);
if(debug>0){tt1=new Date();tt1=parseInt(tt1.getTime());}}

function r_chat(x){
if(htto[x].readyState==4 && x==mmc){
bcdiv=document.getElementById('blab_chat');
splay=false; r=htto[x].responseText.toString();
r=r.split('|:|');
if(r[5]){r[5]=parseInt(r[5]);if(r[5]>0){s_msg=new Array();bcdiv.innerHTML='';splay=snd3;}}
if(r[3]){
if(r[1].length>0){document.getElementById('blab_online_content').innerHTML=r[1];online_hash=r[3];if(!splay){splay=snd2;}}
if(r[0].length>0){rxx=check_msg(r[0]);
dv1s='kk'+chat_lid;if(iev<1 && document.getElementById(dv1s)){dv1s=document.getElementById(dv1s);dv1s.style.opacity=1;}
dv2s='kk'+r[2];rxx='<div id="'+dv2s+'" style="visibility:hidden">'+rxx+'</div>';
bcdiv.innerHTML+=rxx;if(!splay || splay==snd2){splay=snd1;};setTimeout("set_opa(dv2s,1)",50);}
if(lock_autoscroll==0){lock_autoscroll=1; setTimeout('bcdiv.scrollTop=9999999',10); setTimeout('lock_autoscroll=0',100);}
if(r[2]>0){chat_lid=r[2];}
if(splay && splay!=snd2 && hocus<1){document.title=tit_b;}
if(splay && sess_snd>0){play_s(splay);}}
if(r[4] && debug>0){
tt2=new Date();tt2=parseInt(tt2.getTime());tt2=(tt2-tt1)/1000;tt2=tt2.toString()+'000';tt2=tt2.substr(0,5);
document.getElementById('debug').innerHTML=r[4]+'s ('+tt2+'s)';}
}}

function check_msg(x){
z='';x=x.split('</div>');
for(i=0;i<x.length-1;i++){
y=x[i].split(':|:');
y[0]=parseInt(y[0],10);
if(!s_msg[y[0]] && y[1]){
s_msg[y[0]]=true;
y[1]=y[1]+'</div>';
z+=y[1];}}return z;}

function pat(x){
ctxt=document.getElementById('ln').value;
document.getElementById('ln').value='‹@'+x+'› '+ctxt;
document.getElementById('ln').focus();}

function count_txt(a,b){
c=a.value.length; if(c>b){a.value=a.value.substr(0,b)}}

function force_dr(x){
if(chat_post.length>0){
if(js_flood>0 && x>0){chat_post='';
document.getElementById('blab_bottom_elements_tbl').style.display='none';
document.getElementById('blab_flood_warning').style.display='block';}
else{clearInterval(brc);
if(x>0){document.getElementById('ln').value='';
if(document.getElementById('blab_bottom_elements_tbl').style.visibility!='hidden'){document.getElementById('ln').focus();}
js_flood=1;setTimeout('js_flood=0',post_interv);}
mmc=1;s_chat();brc=setInterval('s_chat()',ajax_update*1000);
}}}

function close_l(){
document.getElementById('box_scrollhint').style.display='none';
document.getElementById('box_ins_paint_container').style.display='none';
document.getElementById('box_ins_paint_content').innerHTML='';
document.getElementById('box_paint_container').style.display='none';
document.getElementById('box_smilies').style.display='none';
document.getElementById('box_colours').style.display='none';
}

function close_p(){
if(document.getElementById('bd')){
dd=document.getElementById('bd'); reset_panel();
document.getElementById('blab_panel').style.display='none';
if(effe>0){if(iev>1){dd.style.filter='alpha(opacity=100)';}dd.style.opacity='1';}
else{dd.style.visibility='visible';}
document.getElementById('blab_chat').scrollTop=9999999;}}

function txt_swap(x,y){
a=document.getElementById('ln'); 
b=false;if(document.getElementById('pm')){b=document.getElementById('pm');}

if(x==0){if(txt_b==1){txt_b=0;y.className='txt_format_button_normal';a.style.fontWeight='normal';if(b){b.style.fontWeight='normal';}}
else{txt_b=1;y.className='txt_format_button_active';a.style.fontWeight='bold';if(b){b.style.fontWeight='bold';}}}

if(x==1){if(txt_i==1){txt_i=0;y.className='txt_format_button_normal';a.style.fontStyle='normal';if(b){b.style.fontStyle='normal';}}
else{txt_i=1;y.className='txt_format_button_active';a.style.fontStyle='italic';if(b){b.style.fontStyle='italic';}}}
a.focus();}

function pick_c(n,c,o){
a=document.getElementById('ln'); 
b=false;if(document.getElementById('pm')){b=document.getElementById('pm');}
document.getElementById('clr').style.borderColor='#'+c;
a.style.color='#'+c; if(b){b.style.color='#'+c;} txt_c=n; 
if(o==1){set_opa('box_colours',0);}
a.focus();}

function load_panel(x){
close_l();reset_panel();
document.getElementById('mnu_panels').style.display='none';
document.getElementById('mnu_history').style.display='none';
if(x==1){document.getElementById('mnu_panels').style.display='block';}
if(x==2){document.getElementById('mnu_history').style.display='block';}

pn=document.getElementById('blab_panel'); pw=parseInt(pn.style.width);
if(!document.documentElement.clientWidth>0){dw=document.body.clientWidth}else{dw=document.documentElement.clientWidth;}
if(!document.documentElement.clientHeight>0){dh=document.body.clientHeight}else{dh=document.documentElement.clientHeight;}
pw=(dw-pw)/2;ph=(dh-350)/2; pn.style.left=pw+'px'; pn.style.top=ph+'px';

dd=document.getElementById('bd');
if(effe>0){if(iev>1){dd.style.filter='alpha(opacity=10)';}dd.style.opacity='0.1';}
else{dd.style.visibility='hidden';}
set_opa('blab_panel',1);}

function reset_panel(){
document.getElementById('panel_mid').innerHTML='<div class="panel_loading"></div>';}

function load_ajc(x,y,z,j,t){
tmp_a=x; httu=http_obj(); httu.open('post',y); tmp_j=j;
httu.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
httu.onreadystatechange=disp_ajc;httu.send(z);setTimeout('tmp_j=""',5000);
temp_message=t;}

function disp_ajc(){
if(httu.readyState==4){
o=document.getElementById(tmp_a);
rst=httu.responseText.toString();
if(rst.length>1){o.innerHTML=rst;}else{o.innerHTML=temp_message}
eval(tmp_j);tmp_j='';}}

function show_help(x){
if(typeof a=='object'){set_opa(x,1)}
return false}

function show_paint(){
close_l(); set_opa('box_paint_container',1);
if(document.getElementById('box_paint_content').innerHTML==''){
document.getElementById('box_paint_content').innerHTML='<iframe src="p_paint.php" scrolling="no" frameborder="0" style="margin:0px;padding:0px;width:400px;height:260px;border-width:0px;overflow:hidden"></iframe>';
}}

function play_p(x){
close_l(); close_p(); set_opa('box_ins_paint_container',1); x=parseInt(x); 
ee='<iframe src="p_play.php?q='+x+'" scrolling="no" frameborder="0" style="width:400px;height:225px;border-width:0px;overflow:hidden"></iframe>';
setTimeout("document.getElementById('box_ins_paint_content').innerHTML=ee",200);
}

function help_all(x){
for(i=0;i < 100;i++){
j='s'+i
a=document.getElementById(j)
if(typeof a=='object' && a!=null){
if(x==0){a.style.display='none';}
else{a.style.display='block';}
}}return false}

function sbr(x,y){
for(i=0;i<10;i++){
a=document.getElementById('s'+x+'x'+i);
a.style.borderColor='#fff';
a.style.width='7px';a.style.height='7px';
a.style.borderWidth='1px';}
b=document.getElementById('s'+x+'x'+y);
b.style.borderColor='#000';
b.style.width='5px';b.style.height='5px';
b.style.borderWidth='2px';
}