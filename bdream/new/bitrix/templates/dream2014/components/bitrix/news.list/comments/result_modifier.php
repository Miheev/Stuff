<? 
foreach($arResult["ITEMS"] as $key=>$arItem)
{
	$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$arItem["PROPERTIES"]["DREAM"]["VALUE"]),array("SELECT"=>array("UF_*")));
	while($arUsers = $rsUsers->Fetch())
	{
		$arResult["ITEMS"][$key]["USER"] = $arUsers;
	}
	
	$rsActions = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>4, "ID"=>$arItem["PROPERTIES"]["ACTIONS"]["VALUE"]), false, false, array("NAME"));
	while($arActions = $rsActions->Fetch())
	{
		$arResult["ITEMS"][$key]["ACTION"][] = $arActions["NAME"];
	}
	
}



?>