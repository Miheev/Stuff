<?php

$config_file='../config.php'; $config_ok=0;
$config_dist=@file('config.dist',FILE_IGNORE_NEW_LINES);
$config_dist=implode("\r\n",$config_dist);

if(isset($_POST['sssalt'])){$config_dist=str_replace('salt=\'\'','salt=\''.$_POST['sssalt'].'\'',$config_dist);}
if(isset($_POST['dbtype'])){$config_dist=str_replace('dbss[\'type\']=\'\'','dbss[\'type\']=\''.$_POST['dbtype'].'\'',$config_dist);}
if(isset($_POST['dbsqlt'])){$config_dist=str_replace('dbss[\'sqlt\']=\'\'','dbss[\'sqlt\']=\''.$_POST['dbsqlt'].'\'',$config_dist);}
if(isset($_POST['dbhost'])){$config_dist=str_replace('dbss[\'host\']=\'\'','dbss[\'host\']=\''.$_POST['dbhost'].'\'',$config_dist);}
if(isset($_POST['dbname'])){$config_dist=str_replace('dbss[\'name\']=\'\'','dbss[\'name\']=\''.$_POST['dbname'].'\'',$config_dist);}
if(isset($_POST['dbuser'])){$config_dist=str_replace('dbss[\'user\']=\'\'','dbss[\'user\']=\''.$_POST['dbuser'].'\'',$config_dist);}
if(isset($_POST['dbpass'])){$config_dist=str_replace('dbss[\'pass\']=\'\'','dbss[\'pass\']=\''.$_POST['dbpass'].'\'',$config_dist);}
if(isset($_POST['prefix'])){$config_dist=str_replace('dbss[\'prfx\']=\'\'','dbss[\'prfx\']=\''.$_POST['prefix'].'\'',$config_dist);}

if(is_writable($config_file)){
$fd=fopen($config_file,'w');fwrite($fd,$config_dist);fclose($fd);$config_ok=1;}
else{print '<div class="infoln1">config.php is not writeable.</div>';}


if($config_ok>0){
?>

<div class="infoln3">
Please set your ACP KEY in the fields below and click <b>NEXT</b>. The ACP KEY is a password that allows you to enter Admin Control Panel  (ACP = admin control panel). 
Your ACP KEY is case-sensitive and must be between 5 and 12 chars. It is recommended to use a mix of numbers, lowercase and uppercase letters.
<input type="hidden" name="step" value="<?php print $next_step;?>" /></div>

<div class="infoln2"><b>ACP KEY</b>: <input type="text" name="acp_key" maxlength="12" value="" />
&nbsp; &nbsp; &nbsp; <b>RETYPE ACP KEY</b>: <input type="text" name="retype" maxlength="12" value="" />
</div>

<div style="text-align:right"><input type="button" class="buttton" value="NEXT" onclick="a=document.forms.fms; if(5>a.acp_key.value.length || a.acp_key.value!=a.retype.value){a.acp_key.value='';a.retype.value='';return false}else{document.forms.fms.submit()}" /></div>
<script type="text/javascript">dtitle=document.title.toString();document.title=dtitle+' (Step 3 of 3)';</script>
<?php }?>

