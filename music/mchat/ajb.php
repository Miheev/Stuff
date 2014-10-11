<?php 
require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($_POST['uid']) || !isset($_POST['uname']) || !isset($_POST['uhash']) || $_POST['uhash']!=hsh($_POST['uid'].$_POST['uname'].'blab')){die();}

$uid=(int)$_POST['uid'];  $ip=$_SERVER['REMOTE_ADDR'];
$uname=htmrem($_POST['uname']); $uname=neutral_escape($uname,64,'str');
if(isset($_POST['chat_lid'])){$chat_lid=(int)$_POST['chat_lid'];}else{$chat_lid=0;}
if(isset($_POST['zone'])){$tzone=(int)$_POST['zone'];}else{$tzone=0;}
if(isset($_POST['tfrm'])){$tfrm=(int)$_POST['tfrm'];}else{$tfrm=1;}
if(!isset($_POST['online_hash'])){$_POST['online_hash']=0;}

dbconnect(); 

/* --- */

if(isset($_POST['cp'])){

$line=htmrem($_POST['cp']); 
if(strstr($line,'/p')){$line=str_replace("'",'&#39;',$line);$line=str_replace('\\','',$line);
$line=preg_replace("/\/p([0-9]+)/","<img onclick=\"play_p('$1')\" class=\"paint_thumb\" src=\"paintings/$1.png\" alt=\"\" />",$line);}
$line=url2link($line);
$line=str_replace('‹@','‹<i>@',$line); $line=str_replace('›','</i>›',$line);

if(is_array($bwords) && count($bwords)>0){
for($i=0;$i<count($bwords);$i++){
if(function_exists('str_ireplace')){$line=str_ireplace($bwords[$i],'***',$line);}
else{$line=str_replace($bwords[$i],'***',$line);}}}

$line=neutral_escape($line,3062,'str');

if(strlen($line)>0){

$line=emo2image($line);

$uuname=$uname;
if(stristr($line,$topic) && strlen($line)-strlen($topic)>2){$uuname='';$line=str_replace($topic,'',$line);$line='<span style="font-size:150%;font-weight:bold">'.$line.' ('.$uname.')</span>';}

if(isset($_POST['txt_b']) && $_POST['txt_b']=='1'){$line='<b>'.$line.'</b>';}
if(isset($_POST['txt_i']) && $_POST['txt_i']=='1'){$line='<i>'.$line.'</i>';}
if(isset($_POST['txt_c']) && $_POST['txt_c']!=''){$color=(int)$_POST['txt_c'];
$clr=array('000000','000033','000066','000099','0000CC','0000FF','003300','003333','003366','003399','0033CC','0033FF','006600','006633','006666','006699','0066CC','0066FF','009900','009933','009966','009999','0099CC','0099FF','00CC00','00CC33','00CC66','00CC99','00CCCC','00CCFF','00FF00','00FF33','00FF66','00FF99','00FFCC','00FFFF','330000','330033','330066','330099','3300CC','3300FF','333300','333333','333366','333399','3333CC','3333FF','336600','336633','336666','336699','3366CC','3366FF','339900','339933','339966','339999','3399CC','3399FF','33CC00','33CC33','33CC66','33CC99','33CCCC','33CCFF','33FF00','33FF33','33FF66','33FF99','33FFCC','33FFFF','660000','660033','660066','660099','6600CC','6600FF','663300','663333','663366','663399','6633CC','6633FF','666600','666633','666666','666699','6666CC','6666FF','669900','669933','669966','669999','6699CC','6699FF','66CC00','66CC33','66CC66','66CC99','66CCCC','66CCFF','66FF00','66FF33','66FF66','66FF99','66FFCC','66FFFF','990000','990033','990066','990099','9900CC','9900FF','993300','993333','993366','993399','9933CC','9933FF','996600','996633','996666','996699','9966CC','9966FF','999900','999933','999966','999999','9999CC','9999FF','99CC00','99CC33','99CC66','99CC99','99CCCC','99CCFF','99FF00','99FF33','99FF66','99FF99','99FFCC','99FFFF','CC0000','CC0033','CC0066','CC0099','CC00CC','CC00FF','CC3300','CC3333','CC3366','CC3399','CC33CC','CC33FF','CC6600','CC6633','CC6666','CC6699','CC66CC','CC66FF','CC9900','CC9933','CC9966','CC9999','CC99CC','CC99FF','CCCC00','CCCC33','CCCC66','CCCC99','CCCCCC','CCCCFF','CCFF00','CCFF33','CCFF66','CCFF99','CCFFCC','CCFFFF','FF0000','FF0033','FF0066','FF0099','FF00CC','FF00FF','FF3300','FF3333','FF3366','FF3399','FF33CC','FF33FF','FF6600','FF6633','FF6666','FF6699','FF66CC','FF66FF','FF9900','FF9933','FF9966','FF9999','FF99CC','FF99FF','FFCC00','FFCC33','FFCC66','FFCC99','FFCCCC','FFCCFF','FFFF00','FFFF33','FFFF66','FFFF99','FFFFCC','FFFFFF');
if(isset($clr[$color])){$line='<span style="color:#'.$clr[$color].'">'.$line.'</span>';}}

$query='INSERT INTO '.$dbss['prfx']."_lines VALUES(NULL,$uid,'$uuname',$timestamp,'$line')";
neutral_query($query);}}

/* --- */

if($latest_mssg<1){$latest_mssg=1;}
if($chat_lid<0){$where_clause="ORDER BY line_id DESC LIMIT $latest_mssg OFFSET 0";}else{$where_clause="WHERE line_id>$chat_lid ORDER BY line_id ASC";}

$query='SELECT * FROM '.$dbss['prfx']."_lines $where_clause";
$result=neutral_query($query);

$messages=array(); $latest_id=0; $topic=0;
switch($tfrm){
case 1:$format='h:i:s A';break;
case 2:$format='Y-m-d H:i:s';break;
case 3:$format='d.m.Y H:i:s';break;
case 4:$format='m/d/Y h:i:s A';break;
case 5:$format='';break;
default :$format='H:i:s';break;}

if(neutral_num_rows($result)>0){
while($row=neutral_fetch_array($result)){
if(strlen($row['from_name'])<1){$topic=1;}
$pnum=$row['line_id'];while(strlen($pnum)<9){$pnum='0'.$pnum;}
if(strlen($row['from_name'])>0){$pm='<span class="link" onclick="pat(\''.$row['from_name'].'\')"><b>'.$row['from_name'].'</b></span>: ';}else{$pm='';}
if($format!='' && strlen($row['from_name'])>0){$tmm=gmdate($format,$row['timestamp']+$tzone*60);$tmm='['.$tmm.']';}else{$tmm='';}
$messages[]=$pnum.':|:<div><span class="text_small">'.$tmm.'</span> '.$pm.$row['line_txt'].'</div>';
if($row['line_id']>$latest_id){$latest_id=$row['line_id'];}}

if($chat_lid<0){sort($messages);}
$messages=implode('',$messages);}else{$messages='';}

if($latest_mssg<2 && $chat_lid<0){$messages='';}

/* --- */

$tpoint=$timestamp-30;
$query='DELETE FROM '.$dbss['prfx']."_online WHERE usr_id=$uid OR rtime<$tpoint";
neutral_query($query);

$query='INSERT INTO '.$dbss['prfx']."_online VALUES($uid,'$uname','$ip',$timestamp)";
neutral_query($query);

$query='SELECT usr_id,usr_name FROM '.$dbss['prfx']."_online ORDER BY usr_name ASC";
$online=neutral_query($query);

$olist=''; 

while($row=neutral_fetch_array($online)){
if($row['usr_id']==$uid){$n='&not;';}else{$n='';}
$olist.='<div class="oo">&middot;&nbsp;'.$row['usr_name'].' '.$n.'</div>';}

$ohash=md5($olist); if($ohash==$_POST['online_hash']){$olist='';}

$end_time=time_to_run();
$total_time=substr(($end_time-$start_time),0,5);

print $messages.'|:|'.$olist.'|:|'.$latest_id.'|:|'.$ohash.'|:|'.$queries.'/'.$total_time.'|:|'.$topic; 

?>