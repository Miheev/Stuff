<?php

require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(0);

$strows=array(); 
$query='SELECT sid,value FROM '.$dbss['prfx'].'_style WHERE sid>18';
$result=neutral_query($query);
while($row=neutral_fetch_array($result)){$strows[$row['sid']]=$row['value'];}

?><!DOCTYPE html>
<html><head>
<title>blab</title>
<meta charset="utf-8" />
<style type="text/css">
.panels_extra{<?php $entry=htmrem($strows[19]);print $entry;?>}
.boxes_extra{<?php $entry=htmrem($strows[20]);print $entry;?>}
.topbar_extra{<?php $entry=htmrem($strows[21]);print $entry;?>}
.bottombar_extra{<?php $entry=htmrem($strows[22]);print $entry;?>}
.textbox_extra{<?php $entry=htmrem($strows[23]);print $entry;?>}
.body_extra{<?php $entry=htmrem($strows[24]);print $entry;?>}
</style>
</head><body class="body_extra" style="border-width:0px;margin:0px;padding:0px">
<div id="topbar" class="topbar_extra" style="position:fixed;top:0px;left:0px;right:0px;height:60px">
<table style="width:100%"><tr><td style="width:50%;line-height:55px;cursor:pointer;white-space:nowrap"><b>&nbsp;&nbsp;&nbsp;HISTORY&nbsp;&middot;&nbsp;SETTINGS&nbsp;&middot;&nbsp;LOGOUT</b></td><td><?php print $settings['logo'];?></td></tr></table></div>
<div id="chatarea" style="position:fixed;top:70px;left:10px;right:25%;height:220px"><b>John:</b> Hello there!<br /><b>Marta:</b>Hi John, I just found a new website, have a look: <span id="link" style="cursor:pointer">http://elgoog.im</span></div>
<div id="paneltop" class="panels_extra" style="position:fixed;top:70px;right:2%;width:18%;bottom:45px;padding:5px;line-height:28px"><b>&nbsp;ONLINE</b></div>
<div id="panelmid" style="position:fixed;top:105px;right:2%;width:18%;bottom:55px;padding:5px;line-height:16px"><span id="users" style="font-weight:bold;line-height:13px;cursor:default">&middot; John<br />&middot; Juliet<br />&middot; Marta</span></div>
<div id="botbar" class="bottombar_extra" style="position:fixed;bottom:0px;left:0px;right:0px;height:22px;padding:5px;line-height:22px">
<input id="inputbox" class="textbox_extra" type="text" style="width:88%;margin-right:5px" value="oooo ;-)" /><input id="submitbox" class="textbox_extra" type="button" style="width:10%;font-weight:bold" value="submit" /></div>
<div id="smiliebox" class="boxes_extra" style="position:fixed;bottom:45px;left:2%;width:90px;height:30px;padding:5px;">
<img src="admin/bsm.png" style="float:left;margin:4px" alt="" /><img src="admin/bsm.png" style="float:left;margin:4px" alt="" /><img src="admin/bsm.png" style="float:left;margin:4px" alt="" />
</div>
<div id="loadp" style="color:#fff;position:fixed;top:0px;bottom:0px;left:0px;right:0px;background-color:#000;font-weight:bold;text-align:center;cursor:pointer;line-height:200px" onclick="location.reload()">...</div>
<script type="text/javascript">parent.ilo=1;</script>
</body></html>