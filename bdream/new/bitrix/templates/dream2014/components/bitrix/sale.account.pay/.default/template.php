<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(strlen($arResult["errorMessage"]) > 0)
	ShowError($arResult["errorMessage"]);

?>
<h1 id="pageTitleBlue">
<?=GetMessage("SAP_BUY_MONEY")?>
<div class="blueHr"></div>
</h1>
<h3><?=GetMessage("HAVE_MONEY");?></h3><br>
<form method="post" name="buyMoney" action="">
<?
foreach($arResult["AMOUNT_TO_SHOW"] as $key=>$v)
{
	?><div class="addSumItem"><label><input type="radio" <?if($key==0):?>checked<?endif;?> name="<?=$arParams["VAR"]?>" value="<?=$v["ID"]?>"><?=$v["NAME"]?></label><br /></div><?
}
?>
<input type="submit" name="button" value="<?=GetMessage("SAP_BUTTON")?>">
</form>