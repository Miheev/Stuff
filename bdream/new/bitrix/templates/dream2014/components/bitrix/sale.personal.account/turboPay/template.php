<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
$res = CIBlockElement::GetByID(intval($_REQUEST["DREAM_ID"]));
if($ar_res = $res->Fetch()):?>
	<h1><?=GetMessage("CONF_PAY");?>"<?=$ar_res["NAME"];?>"</h1>
<?else:
	localRedirect("/turbo_dreams/");
endif;
?>
<?global $AR_CUR_SIMBOL;?>
<input type="text" size="5" name="SUM" value="500" class="paySum"><span> <?=$AR_CUR_SIMBOL[$arResult["ACCOUNT_LIST"][0]["CURRENCY"]["CURRENCY"]];?></span>
&nbsp;<input type="submit" value="<?=GetMessage("POST_MONY");?>" class="btnPostPay"><br>
<input type="hidden" name="TYPE" value="9">
<inpu type="hidden" name="USER_PAY" value="<?=$USER->GetID();?>">
<input type="hidden" name="DREAM_ID" value="<?=$_REQUEST["DREAM_ID"];?>">
<label for="privatPay"><input type="checkbox" vlaue="Y" id="privatPay" name="PRIVAT_PAY"><?=GetMessage("CONF_PAY");?></label><br>
<br>
<?if(strlen($arResult["ERROR_MESSAGE"])<=0):
	echo $arResult["DATE"];
	?><br />
	<ul>
	<?
	foreach($arResult["ACCOUNT_LIST"] as $val)
	{
		?>
		<li><?=$val["INFO"]?></li>
		<?
	}
	?>
	</ul>
	<?
else:
	echo ShowError($arResult["ERROR_MESSAGE"]);
endif;?>
<a href="/personal/add_money.php"><?=GetMessage("ADD_MONY");?></a><br><br>
<a href="/turbo_dreams/<?=$_REQUEST["DREAM_ID"];?>/"><?=GetMessage("BACK");?></a>