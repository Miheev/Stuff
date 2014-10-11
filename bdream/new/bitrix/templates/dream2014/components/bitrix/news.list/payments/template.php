<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$totalSum = 0;

$USER_CURRENCY = "";
CModule::IncludeModule("sale");
$arSelect = Array("ID", "NAME", "PROPERTY_USER");
$arFilter = Array("IBLOCK_ID"=>2, "ID"=>intval($arParams["DREAM_ID"]));
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
if($ob = $res->Fetch())
{	
	$dbAccountCurrency = CSaleUserAccount::GetList(
			array(),
			array("USER_ID" => intval($ob["PROPERTY_USER_VALUE"]))
	);
	while($arAccountCurrency = $dbAccountCurrency->Fetch())
	{
		$USER_CURRENCY = $arAccountCurrency["CURRENCY"];
	}
}

foreach($arResult["ITEMS"] as $arItem):
	if($arItem["PROPERTIES"]["CURRENCY"]["VALUE"]==$USER_CURRENCY)
	{
		$totalSum += $arItem["PROPERTIES"]["PAY"]["VALUE"];
	}
	else
	{
		$convert = CCurrencyRates::ConvertCurrency($arItem["PROPERTIES"]["PAY"]["VALUE"],$arItem["PROPERTIES"]["CURRENCY"]["VALUE"],$USER_CURRENCY);		
		$totalSum += $convert;
	}
	
endforeach;?>
<?global $AR_CUR_SIMBOL;?>
<h3><?=GetMessage("ACOUNT_DREAM");?><b><?=number_format($totalSum, 2, ',', ' ');?></b>	<?=$AR_CUR_SIMBOL[$USER_CURRENCY];?></h3>
<div class="payList">
<h4><?=GetMessage("HISTORY_PAY");?></h4>
<ul>
<?foreach($arResult["ITEMS"] as $arItem):
if($arItem["PROPERTIES"]["PRIVAT"]["VALUE_ENUM_ID"]!=7){
	$rsUser = CUser::GetByID(intval($arItem["CREATED_BY"]));
	$arUser = $rsUser->Fetch();
	?>
		<li><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?> - <?=$arItem["PROPERTIES"]["PAY"]["VALUE"]." ".$AR_CUR_SIMBOL[$arItem["PROPERTIES"]["CURRENCY"]["VALUE"]];?></li>
	<?
}else{?>
<li><?=GetMessage("ANONIMUS");?> - <?=$arItem["PROPERTIES"]["PAY"]["VALUE"]." ".$AR_CUR_SIMBOL[$arItem["PROPERTIES"]["CURRENCY"]["VALUE"]];?></li>
<?}
endforeach;?>
</ul>
<div style="clear: both;"></div>
</div>




