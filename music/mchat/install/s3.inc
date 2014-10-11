<?php

require_once '../config.php';
require_once '../incl/'.$dbss['type'].'_functions.inc';

function process_error($s){;}
function hsh($a){global $salt;$a=md5(md5($a).$salt);return $a;}
 $rn="\r\n"; $timestamp=time();

if(!isset($_POST['acp_key']) || strlen(trim($_POST['acp_key']))<5){print '<div class="infoln1">WRONG ACP KEY!</div></div></div></div></form></body></html>';die();}

$acp_key=hsh($_POST['acp_key']);
$cslt=microtime();$cslt=md5($cslt);$cslt=substr($cslt,0,16);
$url_path=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$url_path=str_replace('install/index.php','',$url_path);
$url_path='http://'.$url_path;
$def_mail='noreply@'.$_SERVER['SERVER_NAME'];

switch($dbss['type']){
case 'pdo_sqlite'  :$auto_increment='integer NOT NULL PRIMARY KEY';                $heap_type='';break;
case 'sqlite'      :$auto_increment='integer NOT NULL PRIMARY KEY';                $heap_type='';break;
case 'postgre'     :$auto_increment='serial PRIMARY KEY';                          $heap_type='';break;
default            :$auto_increment='integer NOT NULL auto_increment PRIMARY KEY'; $heap_type=' ENGINE=MEMORY;';break;
}

$dbss['sqlt']='../'.$dbss['sqlt'];

$install=array();
neutral_dbconnect();

/* ---- */


$install[]='CREATE TABLE '.$dbss['prfx'].'_lines(                               
line_id '.$auto_increment.',                              
from_id integer NOT NULL,                  
from_name varchar(64) NOT NULL,                           
timestamp integer NOT NULL,                
line_txt text NOT NULL)'; 

/* ---- */

$install[]='CREATE TABLE '.$dbss['prfx'].'_online(                                                      
usr_id integer NOT NULL,
usr_name varchar(64) NOT NULL,
usr_ip varchar(15) NOT NULL,                                                    
rtime integer NOT NULL)'.$heap_type;

/* ---- */

$install[]='CREATE TABLE '.$dbss['prfx'].'_users(                                
usr_id '.$auto_increment.',                                           
usr_name varchar(64) NOT NULL,                          
usr_pass char(32) NOT NULL,                             
usr_mail varchar(64) NOT NULL,                          
usr_join_date integer NOT NULL,                 
usr_status varchar(8) NOT NULL)';

/* ---- */

$install[]='CREATE TABLE '.$dbss['prfx'].'_paintings(
p_id '.$auto_increment.',
p_srx text NOT NULL,
p_sry text NOT NULL,
p_src text NOT NULL,
p_bgc char(6) NOT NULL,
p_views integer NOT NULL,
timestamp integer NOT NULL,
usr_id integer NOT NULL,
usr_name varchar(255) NOT NULL)';

/* ---- */

$install[]='CREATE TABLE '.$dbss['prfx'].'_settings(
set_id varchar(16) NOT NULL PRIMARY KEY,
set_value text NOT NULL,
set_fast smallint NOT NULL)';

$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('acp_timezone','0',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_timeform','0',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_language','5',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_effects','2',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_sound1','4',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_sound2','6',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_sound3','9',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_sound4','7',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('title','BlaB!',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('guests','1',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('register','1',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('activation','0',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('url','$url_path',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('default_mail','$def_mail',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('ajax_delay','500',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('ajax_update','6',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('post_length','128',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('post_interv','2000',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('admin_lang','0',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('wrong_acp','0',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('acp_key','$acp_key',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('admin_css','1',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('notebook','...',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('meta_desc','',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('meta_keyw','',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('del_gbuddies','1',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('mssg_history','17520',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('optimize_tbl','1',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('acp_attempts','180',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('acp_lhours','2',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('show_topic','1',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('logo','<img src=\"ui/images/logo.png\" style=\"float:right;margin-right:5px\" alt=\"\" />',0)";
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('cookie_salt','$cslt',0)";

$fp='../incl/faq_example.txt';
if(is_file($fp)){$faq=file($fp); $faq=implode('',$faq);$faq=neutral_escape($faq,9000,'txt');}else{$faq='';}
$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('faq_page','$faq',1)";

$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('style_template','
td,p,div,input,select,textarea{font-size:[15];font-family:[3];text-align:left}
input,select,textarea{color:#[13];background-color:#[14];padding:2px;border-width:0px;box-sizing:border-box}
.bgcolor_overal{color:#[1];background-color:#[2]}
.bgcolor_panel_bars{color:#[9];background-color:#[10]}
.bgcolor_panel_content{color:#[11];background-color:#[12]}
.bgcolor_top_bar{color:#[5];background-color:#[6]}
.bgcolor_bottom_bar{color:#[7];background-color:#[8]}
.title1{font-size:[17];font-weight:bold;text-transform:uppercase}
.title2{font-size:[18];font-weight:bold;text-transform:uppercase}
.text_small{font-size:[16]}
.panels_extra{[19]}
.boxes_extra{[20]}
.topbar_extra{[21]}
.bottombar_extra{[22]}
.textbox_extra{[23]}
.body_extra{[24]}
.link_color{color:#[4];cursor:pointer}
.oo{font-weight:bold;line-height:13px;white-space:nowrap;color:#[4];margin-left:8px}
',1)";

$install[]='INSERT INTO '.$dbss['prfx']."_settings VALUES('style_delivery','
td,p,div,input,select,textarea{font-size:9pt;font-family:verdana,helvetica,sans-serif;text-align:left}
input,select,textarea{color:#fff;background-color:#444;padding:2px;border-width:0px;box-sizing:border-box}
.bgcolor_overal{color:#fff;background-color:#333}
.bgcolor_panel_bars{color:#fff;background-color:#111}
.bgcolor_panel_content{color:#fff;background-color:#222}
.bgcolor_top_bar{color:#fff;background-color:#222}
.bgcolor_bottom_bar{color:#fff;background-color:#222}
.title1{font-size:12pt;font-weight:bold;text-transform:uppercase}
.title2{font-size:8pt;font-weight:bold;text-transform:uppercase}
.text_small{font-size:8pt}
.panels_extra{border-radius:10px;box-shadow:2px 2px 2px #111}
.boxes_extra{border:0px solid #fff;border-radius:5px;box-shadow:2px 2px 2px #111}
.topbar_extra{border-bottom:1px solid #111;box-shadow:0px 2px 2px #111}
.bottombar_extra{border-top:1px solid #111;box-shadow:0px -2px 2px #111}
.textbox_extra{border:1px solid #fff;box-shadow:2px 2px 2px #111}
.body_extra{background-image:none}
.link_color{color:#FEC400;cursor:pointer}
.oo{font-weight:bold;line-height:13px;white-space:nowrap;color:#FEC400;margin-left:8px}
',0)";

$install[]='CREATE TABLE '.$dbss['prfx'].'_style(
sid smallint NOT NULL,    
value text NOT NULL,
desktop smallint NOT NULL)';

$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(1,'fff',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(2,'333',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(3,'verdana, sans-serif',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(4,'FEC400',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(5,'fff',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(6,'222',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(7,'fff',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(8,'222',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(9,'fff',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(10,'111',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(11,'fff',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(12,'222',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(13,'fff',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(14,'444',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(15,'9pt',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(16,'8pt',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(17,'12pt',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(18,'9pt',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(19,'border-radius:10px;box-shadow:2px 2px 2px #111',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(20,'border:0px solid #fff;border-radius:5px;box-shadow:2px 2px 2px #111',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(21,'border-bottom:1px solid #111;box-shadow:0px 2px 2px #111',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(22,'border-top:1px solid #111;box-shadow:0px -2px 2px #111',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(23,'border:1px solid #fff;box-shadow:2px 2px 2px #111',1)";
$install[]='INSERT INTO '.$dbss['prfx']."_style VALUES(24,'background-image:none',1)";

for($i=0;$i<count($install);$i++){neutral_query($install[$i]);}

?>
<div class="infoln2">Install completed! Remove or rename <b>/install</b> directory, <a href="../login.php" onclick="window.open('../login.php');return false"><b>login to chat</b></a> or enter <a href="../admin.php" onclick="window.open('../admin.php');return false"><b>Admin CP</b></a>.</div>