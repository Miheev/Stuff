<pre><?php

require_once 'config.php';
require_once 'incl/main.inc';

dbconnect();$settings=get_settings(0);

$hist_msg=$settings['mssg_history']*3600;$hist_msg=$timestamp-$hist_msg;

// -----

$query='DELETE FROM '.$dbss['prfx']."_lines WHERE timestamp<$hist_msg";
neutral_query($query);

if($dbss['type']=='mysql' || $dbss['type']=='mysqli'){$affr=neutral_affected_rows();}else{$affr='~';}
print 'messages deleted: '.$affr."\r\n";

// -----

$query='SELECT p_id FROM '.$dbss['prfx']."_paintings WHERE timestamp<$hist_msg AND usr_id>0";
$result=neutral_query($query);
while($row=neutral_fetch_array($result)){@unlink('./paintings/'.$row['p_id'].'.png');}

$query='DELETE FROM '.$dbss['prfx']."_paintings WHERE timestamp<$hist_msg AND usr_id>0";
neutral_query($query);

if($dbss['type']=='mysql' || $dbss['type']=='mysqli'){$affr=neutral_affected_rows();}else{$affr='~';}
print 'paintings deleted: '.$affr."\r\n";

// -----

if($settings['del_gbuddies']!='0'){
$query='DELETE FROM '.$dbss['prfx']."_users WHERE usr_mail=''";
neutral_query($query);

if($dbss['type']=='mysql' || $dbss['type']=='mysqli'){$affr=neutral_affected_rows();}else{$affr='~';}
print 'guest names deleted: '.$affr."\r\n";}

// -----

if($settings['optimize_tbl']!='0'){
switch($dbss['type']){
case 'pdo_sqlite':$comm='VACUUM';break;
case 'sqlite':$comm='VACUUM';break;
case 'postgre':$comm='VACUUM';break;
default:$comm='OPTIMIZE TABLE';break;
}

$dbt=array('lines','users');

if($dbss['type']!='sqlite'){
while(list($key,$val)=each($dbt)){
$val=$dbss['prfx'].'_'.$val;
$query=$comm.' '.$val;
neutral_query($query);
}}
else{$query='VACUUM';neutral_query($query);}
print 'DB optimized';}

// -----


$total_time=time_to_run();$total_time=substr(($total_time-$start_time),0,5);
print "\r\n---------------------\r\n".'done / ' .$total_time.' sec';

?></pre>