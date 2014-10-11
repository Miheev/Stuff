<?php

$rd1str=''; $rd2str=''; 
$alphabet='abcdefghijklmnopqrstuvwxyz1234567890';
for($i=0;$i<16;$i++){
$rd1str.=$alphabet[(mt_rand(0,(strlen($alphabet)-1)))];
$rd2str.=$alphabet[(mt_rand(0,(strlen($alphabet)-1)))];}

$dbtype=0;$db2con=0;
if(isset($_POST['dbtype'])){$dbtype=(int)$_POST['dbtype'];}

if($dbtype==4){$db2con='sqlite';}
if($dbtype==5){$db2con='pdo_sqlite';}

if(!isset($_POST['db_dir'])){
$db_dir='sqlitedb_'.$rd1str;
@mkdir('../'.$db_dir, 0777);
}else{$db_dir=$_POST['db_dir'];}

$db_fle=$db_dir.'/blab.sqlite';

@fopen('../'.$db_fle, 'w');
$fd=@fopen('../'.$db_dir.'/.htaccess', 'w');@fwrite($fd,'deny from all');@fclose($fd);
@chmod('../'.$db_fle, 0777);

if(is_writable('../'.$db_fle)){?>

<div class="infoln2">Database directory and database file created successfully.
<input type="hidden" name="sssalt" value="<?php print $rd2str;?>" />
<input type="hidden" name="dbtype" value="<?php print $db2con;?>" />
<input type="hidden" name="dbsqlt" value="<?php print $db_fle;?>" />
<input type="hidden" name="prefix" value="blab7" />

<input type="hidden" name="step" value="<?php print $next_step;?>" />
</div>
<script type="text/javascript">setTimeout('document.forms.fms.submit()',1000);</script>


<?php }else{ $next_step=$step;?>

<div>
The install script cannot create a database directory for you. Create a new directory with the following name: <div class="infoln1"><?php print $db_dir;?></div> under your chat directory and <b>CHMOD</b> it to <b>777</b>. When ready click <b>NEXT</b>.
<div class="divline"></div>
<div class="infoln3">
* CHMOD (abbreviated from change mode) means to change permissions/attributes of a file or a directory on Linux and Unix based systems. 
This can be done with any FTP program. 
On Windows servers, look at the options of your hosting control panel or you may need to ask your hosting provider to make these files and folders writeable.
</div>
<input type="hidden" name="step" value="<?php print $next_step;?>" />
<input type="hidden" name="dbtype" value="<?php print $dbtype;?>" />
<input type="hidden" name="db_dir" value="<?php print $db_dir;?>" />
</div>
<?php }?>

<div style="text-align:right"><input type="submit" class="buttton" value="NEXT" /></div>
<script type="text/javascript">dtitle=document.title.toString();document.title=dtitle+' (Step 2 of 3)';</script>
