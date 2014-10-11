
<?php
$init_test_ok=1; $config_file='../config.php';

if( filesize($config_file)>1) {$init_test_ok=0; print '<div class="infoln1">config.php seems to have been set. The install expects an empty file, and will not continue.</div>';}else{@chmod($config_file,0777); @chmod('../errors.txt',0777); @chmod('../paintings',0777);}
if(!is_writable($config_file)){$init_test_ok=0; print '<div class="infoln1">config.php is not writeable.</div><div class="infoln2">CHMOD <b>config.php</b>, <b>errors.txt</b> and the subdirectory <b>/paintings</b> to 777 and <b><a href="index.php">reload</a></b> this page.</div><div class="divline"></div><div class="infoln3">* CHMOD (abbreviated from change mode) means to change permissions/attributes of a file or a directory on Linux and Unix based systems. This can be done with any FTP program. On Windows servers, look at the options of your hosting control panel or you may need to ask your hosting provider to make these files and folders writeable.</div>';} 

if($init_test_ok>0){ ?>

<div class="infoln2">The following is a list of the available database extensions. Please select a database extension:</div>

<?php if(function_exists('mysql_query')){?>
<div class="db2pick" style="background-color:#EDEDFC" onclick="document.forms.fms.dbtype.value='1';document.forms.fms.submit()" onmouseover="this.style.backgroundColor='#FFA0A2'" onmouseout="this.style.backgroundColor='#EDEDFC'">
<img src="mysql.png" style="float:left;margin-right:20px;margin-bottom:20px" alt="" />
<b style="font-size:10pt">MySQL</b><br />
You can use any existing MySQL database. The installation script cannot create a database for you. On the next screen you will have to provide a database name, a database user and a password.
Check your server documentation for details on how to create a new database and define user privileges. 
</div>
<div style="text-align:right;font-size:8pt">
<a href="http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/MySQLDatabases" onclick="window.open('http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/MySQLDatabases');return false">How to create a MySQL database, a database user and define privileges with cPanel</a>
</div><div style="margin:5px">&nbsp;</div>
<?php }?>

<?php if(function_exists('mysqli_query')){?>
<div class="db2pick" style="background-color:#EDEDFC" onclick="document.forms.fms.dbtype.value='2';document.forms.fms.submit()" onmouseover="this.style.backgroundColor='#FFA0A2'" onmouseout="this.style.backgroundColor='#EDEDFC'">
<img src="mysql.png" style="float:left;margin-right:20px;margin-bottom:20px" alt="" />
<b style="font-size:10pt">MySQLi</b><br />
MySQLi is a better and faster MySQL extension. You can use any existing MySQL database. The installation script cannot create a database for you. On the next screen you will have to provide a database name, a database user and a password.
Check your server documentation for details on how to create a new database and define user privileges. 
</div>
<div style="text-align:right;font-size:8pt">
<a href="http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/MySQLDatabases" onclick="window.open('http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/MySQLDatabases');return false">How to create a MySQL database, a database user and define privileges with cPanel</a>
</div><div style="margin:5px">&nbsp;</div>
<?php }?>

<?php if(function_exists('pg_query')){?>
<div class="db2pick" style="background-color:#DBFCDB" onclick="document.forms.fms.dbtype.value='3';document.forms.fms.submit()" onmouseover="this.style.backgroundColor='#FFA0A2'" onmouseout="this.style.backgroundColor='#DBFCDB'">
<img src="postgres.png" style="float:left;margin-right:20px;margin-bottom:20px" alt="" />
<b style="font-size:10pt">PostgreSQL</b><br />
You can use any existing Postgre database. The installation script cannot create a database for you and on the next screen you will have to provide a database name, a database user and a password.
Check your server documentation for details on how to create a new database and define user privileges.
</div>
<div style="text-align:right;font-size:8pt">
<a href="http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/PostgreSQL" onclick="window.open('http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/PostgreSQL');return false">How to create a Postgre database, a database user and define privileges with cPanel</a>
</div><div style="margin:5px">&nbsp;</div>
<?php }?>

<?php if(function_exists('sqlite_query')){?>
<div class="db2pick" onclick="document.forms.fms.dbtype.value='4';document.forms.fms.submit()" onmouseover="this.style.backgroundColor='#FFA0A2'" onmouseout="this.style.backgroundColor='#FCFCC4'">
<img src="sqlite.png" style="float:left;width:64px;height:64px;margin-right:20px;margin-bottom:20px" alt="" />
<b style="font-size:10pt">SQLite (SQLite 2)</b><br />
An SQLite database consists of a single file. The installation script will try to create a new directory and a database file. If not possible you will be prompted to create the directory manually and <b>CHMOD</b>* it to 777.
&nbsp; * <i>CHMOD means to change permissions/attributes of a file or a directory on Linux and Unix based systems. This can be done with any FTP program.</i>
</div><div style="margin:5px">&nbsp;</div>
<?php }?>

<?php if(extension_loaded('pdo_sqlite')){?>
<div class="db2pick" onclick="document.forms.fms.dbtype.value='5';document.forms.fms.submit()" onmouseover="this.style.backgroundColor='#FFA0A2'" onmouseout="this.style.backgroundColor='#FCFCC4'">
<img src="sqlite.png" style="float:left;width:64px;height:64px;margin-right:20px;margin-bottom:20px" alt="" />
<b style="font-size:10pt">PDO SQLite  (SQLite 3)</b><br />
An SQLite database consists of a single file. The installation script will try to create a new directory and a database file. If not possible you will be prompted to create the directory manually and <b>CHMOD</b>* it to 777.
&nbsp;  * <i>CHMOD means to change permissions/attributes of a file or a directory on Linux and Unix based systems. This can be done with any FTP program.</i>
</div><div style="margin:5px">&nbsp;</div>
<?php }?>

<script type="text/javascript">dtitle=document.title.toString();document.title=dtitle+' (Step 1 of 3)';</script>
<?php }?>
<p>
<input type="hidden" name="dbtype" value="0" />
<input type="hidden" name="step" value="<?php print $next_step;?>" />
</p>