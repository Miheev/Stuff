<?
$arResult["USER"]=array();
$arResult["ACTIONS"]=array();
foreach($arResult["ITEMS"] as $arItem):

$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>intval($arItem["PROPERTIES"]["USER"]["VALUE"])),array("SELECT"=>array("UF_*")));
while($arUsers = $rsUsers->Fetch())
{
	$arResult["USER"] = $arUsers;
}

$arSelect = Array("ID", "NAME", "PROPERTY_DREAM");
$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", "PROPERTY_DREAM"=>$arItem["ID"]);
$rsActions = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arActions = $rsActions->Fetch())
{
	$arResult["ACTIONS"][$arActions["ID"]]["INFO"] = $arActions;
}

foreach ($arResult["ACTIONS"] as $id=>$action)
{
	$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y", "PROPERTY_DREAM"=>$arItem["ID"], "PROPERTY_ACTIONS"=>$id);
	$rsActions = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_DREAM"));
	if($arActions = $rsActions->Fetch())
	{
		$arResult["ACTIONS"][$id]["COUNT"] = $arActions["CNT"];
	}
	else
	{
		$arResult["ACTIONS"][$id]["COUNT"] = 0;
	}
}

endforeach;

$cp = $this->__component; // объект компонента
if (is_object($cp))
{
	$cp->arResult['DREAM_ID'] = $arResult["ITEMS"][0]["ID"];
	$cp->SetResultCacheKeys(array('DREAM_ID'));
	$arResult['DREAM_ID'] = $cp->arResult['DREAM_ID'];
}
?>