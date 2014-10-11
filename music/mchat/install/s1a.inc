<?php

$rd2str=''; $dbtype=0; $db2con=0; $dbsett_ok=0;

$alphabet='abcdefghijklmnopqrstuvwxyz1234567890';
for($i=0;$i<16;$i++){$rd2str.=$alphabet[(mt_rand(0,(strlen($alphabet)-1)))];}

function process_error($s){global $dbsett_ok;$dbsett_ok=0;print '<div class="infoln1">'.$s.'</div>';}

if(isset($_POST['dbtype'])){$dbtype=(int)$_POST['dbtype'];}

if($dbtype==1){$db2con='mysql';}
if($dbtype==2){$db2con='mysqli';}
if($dbtype==3){$db2con='postgre';}

if(isset($_POST['dbhost']) && isset($_POST['dbname']) && isset($_POST['dbuser']) && isset($_POST['dbpass'])){
$dbss['host']=$_POST['dbhost'];
$dbss['name']=$_POST['dbname'];
$dbss['user']=$_POST['dbuser'];
$dbss['pass']=$_POST['dbpass'];

require_once '../incl/'.$db2con.'_functions.inc';
$dbsett_ok=1;@neutral_dbconnect();}

if(!isset($_POST['dbhost'])){$dbhost='localhost';}else{$dbhost=$_POST['dbhost'];}
if(!isset($_POST['dbname'])){$dbname='';}else{$dbname=$_POST['dbname'];}
if(!isset($_POST['dbuser'])){$dbuser='';}else{$dbuser=$_POST['dbuser'];}
if(!isset($_POST['dbpass'])){$dbpass='';}else{$dbpass=$_POST['dbpass'];}
if(!isset($_POST['prefix']) || strlen($_POST['prefix'])<1){$prefix='blab7';}else{$prefix=$_POST['prefix'];}


if($dbsett_ok<1){ ?>

<div class="infoln2">Please fill in the settings to connect to your database server:</div>
<table style="width:100%">
<tr><td class="tdcolb1">DATABASE EXTENSION</td>
<td class="tdcolb2"><input type="text" name="dbhost" style="width:90%;font-weight:bold" value="<?php print $db2con;?>" readonly="readonly" /></td></tr>
<tr><td class="tdcolb1">DATABASE HOST<div class="tdcolln">The host where your SQL server operates, and in most cases it is <i>localhost</i>. On Windows systems, to avoid a php/ipv6 bug, enter <i>127.0.0.1</i> instead of <i>localhost</i>.</div></td>
<td class="tdcolb2"><input type="text" name="dbhost" style="width:90%" value="<?php print $dbhost;?>" /></td></tr>
<tr><td class="tdcolb1">DATABASE NAME<div class="tdcolln">The database you want to install BlaB! in. You can use any existing database. Note that the installation script cannot create a database for you!</div></td>
<td class="tdcolb2"><input type="text" name="dbname" style="width:90%" value="<?php print $dbname;?>" /></td></tr>
<tr><td class="tdcolb1">DATABASE USER<div class="tdcolln">The username to connect to the database. Check your server documentation for details on how to create a new database, new user and define user privileges.</div></td>
<td class="tdcolb2"><input type="text" name="dbuser" style="width:90%" value="<?php print $dbuser;?>" /></td></tr>
<tr><td class="tdcolb1">DATABASE PASSWORD<div class="tdcolln">The password to connect to the database. Check your server documentation for details on how to create a new database, new user and define user privileges.</div></td>
<td class="tdcolb2"><input type="text" name="dbpass" style="width:90%" value="<?php print $dbpass;?>" /></td></tr>
<tr><td class="tdcolb1">TABLE PREFIX<div class="tdcolln">The table prefix should contain letters and numbers only. In this way you can install multiple scripts in the same database using different prefixes.</div></td>
<td class="tdcolb2"><input type="text" name="prefix" style="width:90%" value="<?php print $prefix;?>" /></td></tr>
</table><p>
<input type="hidden" name="dbtype" value="<?php print $dbtype;?>" />
<input type="hidden" name="step" value="<?php print $step;?>" />
</p>
<div style="text-align:right"><input type="submit" class="buttton" value="TEST CONNECTION" /></div>
<?php }else{?>

<input type="hidden" name="sssalt" value="<?php print $rd2str;?>" />
<input type="hidden" name="dbtype" value="<?php print $db2con;?>" />
<input type="hidden" name="dbhost" value="<?php print $dbhost;?>" />
<input type="hidden" name="dbname" value="<?php print $dbname;?>" />
<input type="hidden" name="dbuser" value="<?php print $dbuser;?>" />
<input type="hidden" name="dbpass" value="<?php print $dbpass;?>" />
<input type="hidden" name="prefix" value="<?php print $prefix;?>" />
<input type="hidden" name="step" value="<?php print $next_step;?>" />
<div class="infoln2">Successfully connected to the database.</div>
<div style="text-align:right"><input type="submit" class="buttton" value="NEXT" /></div>

<?php }?>

<script type="text/javascript">dtitle=document.title.toString();document.title=dtitle+' (Step 2 of 3)';</script>