<?php 

if(!headers_sent()){
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-type: text/html; charset=UTF-8");}

if(isset($_POST['step'])){$step=(int)$_POST['step'];}else{$step=0;} $next_step=$step+1;

?><!DOCTYPE html>
<html><head>
<title>BlaB! Install</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="install.css" />
<script type="text/javascript">

</script></head><body>
<form action="index.php" id="fms" method="post" style="margin:0px;padding:0px">
<div style="text-align:center;background-color:transparent"><div class="mainbox">
<div class="content">

<?php
switch($step){
case 1 : $dbtype=0;if(isset($_POST['dbtype'])){$dbtype=(int)$_POST['dbtype'];} if($dbtype>0 && $dbtype<4){require 's1a.inc';}elseif($dbtype>3 && $dbtype<6){require 's1b.inc';}else{require 'dbtype.inc';};break;
case 2 : require 's2.inc';break;
case 3 : require 's3.inc';break;
default: require 's0.inc';break;
}
?>
<div class="divline"></div>
<div style="text-align:right;font-weight:bold">
Powered by <a href="http://hot-things.net">BlaB!</a>
</div></div>
</div></div>
</form></body></html>