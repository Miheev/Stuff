<?
$arResult["USER"]=array();

foreach($arResult["ITEMS"] as $arItem):


$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>intval($arItem["PROPERTIES"]["USER"]["VALUE"])),array("SELECT"=>array("UF_*")));
while($arUsers = $rsUsers->Fetch())
{
	$arResult["USER"][$arUsers["ID"]]["USER_INFO"] = $arUsers;
	$arResult["USER"][$arUsers["ID"]]["DREAM_INFO"]["ID"] = $arItem["ID"];
	$arResult["USER"][$arUsers["ID"]]["DREAM_INFO"]["PREVIEW_TEXT"] = $arItem["PREVIEW_TEXT"];
	
	$arFilter = Array("IBLOCK_ID"=>3, "PROPERTY_DREAM"=>intval($arItem["ID"]));
	$rsVote = CIBlockElement::GetList(Array(), $arFilter, Array("PROPERTY_DREAM"));
	if($arVote = $rsVote->Fetch())
	{
		$arResult["USER"][$arUsers["ID"]]["VOTE"] = $arVote["CNT"];
	}
	else
	{
		$arResult["USER"][$arUsers["ID"]]["VOTE"] = 0;
	}
}

endforeach;?>