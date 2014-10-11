<?
$arResult["USER"]=array();

foreach($arResult["ITEMS"] as $arItem):

$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$arItem["PROPERTIES"]["USER"]["VALUE"]),array("SELECT"=>array("UF_*")));
while($arUsers = $rsUsers->Fetch())
{
	$arResult["USER"] = $arUsers;
}

$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>3, "PROPERTY_DREAM"=>$arItem["ID"]);
$rsDream = CIBlockElement::GetList(Array(), $arFilter, Array("PROPERTY_DREAM"));
if($arDream = $rsDream->Fetch())
{
	$arResult["VOTE"] = $arDream["CNT"];
}
else
{
	$arResult["VOTE"] = 0;
}

$arFilter = Array("IBLOCK_ID"=>3, "PROPERTY_DREAM"=>$arItem["ID"], "PROPERTY_USER"=>$arParams["THIS_USER"]);
$rsDream = CIBlockElement::GetList(Array(), $arFilter);
if($arDream = $rsDream->Fetch())
{
	$arResult["VOTE_YET"] = true;
}
else
{
	$arResult["VOTE_YET"] = false;
}
if($USER->GetID()==$arItem["PROPERTIES"]["USER"]["VALUE"])
{
	$arResult["NOT_HAVE_VOTE"] = true;
}
else
{
	$arResult["NOT_HAVE_VOTE"] = false;
}
endforeach;?>