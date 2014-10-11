<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<?echo $testP;?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>

<?=$arResult["BX_SESSION_CHECK"]?>
<?ShowError($arResult["strProfileError"]);?>


<div class="main-container"> 
  <div class="main wrapper clearfix"> 				 
    <div class="center"> 					 
      <div class="sets-node">
		<div class="email">
			<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
				<?=$arResult["BX_SESSION_CHECK"]?>
				<h3><?=GetMessage('NEW_EMAIL');?></h3>
				<p><?=GetMessage('NEW_EMAIL_COM');?></p>
				<input type="email" name="email" autocomplete="" placeholder="email">
				<input type="hidden" name="settings_type" value="save_mail" />
				<input type="submit" class="abutton" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
			</form>
		</div>
		<div class="pass">
			<form method="post" name="form2" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
				<?=$arResult["BX_SESSION_CHECK"]?>
				<h3><?=GetMessage('NEW_PASSWOR');?></h3>
				<p><?=GetMessage('NEW_PASSWOR_COM');?></p>
				<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_REQ')?>"> 
				<input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_CONFIRM')?>">
				<input type="hidden" name="settings_type" value="save_psw" />
				<input type="submit" class="abutton" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
			</form>
		</div>
		<div class="news">
			<form method="post" name="form3" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
				<?=$arResult["BX_SESSION_CHECK"]?>
				<h3><?=GetMessage('NEWS_RSS')?></h3>
				<p><?=GetMessage('NEWS_RSS_COM')?></p>
				<input type="hidden" name="settings_type" value="news_rss" />
				<input type="submit" class="abutton" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("NEWS_RSS_ADD") : GetMessage("NEWS_RSS_ADD"))?>"> 
			</form>
        </div>
		<div class="news"> 
			<form method="post" name="form4" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
				<?=$arResult["BX_SESSION_CHECK"]?>
				<h3><?=GetMessage('USER_DELETE')?></h3>
				<p><?=GetMessage('USER_DELETE_COM')?></p>
				<input type="hidden" name="settings_type" value="user_delete" />
				<input type="submit" class="abutton" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_DELETE") : GetMessage("MAIN_DELETE"))?>"> 
			</form>
		</div>
	   </div>
   	   <aside class="right"></aside>
	  </div>
 </div>
<!-- #main -->
 </div>