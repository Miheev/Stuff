<?CModule::IncludeModule("iblock");?>

<?foreach ($arResult["USERS"] as $key=>$res): ?>
<? 
	$arFilter = Array("IBLOCK_ID"=>2, "PROPERTY_USER"=>$res["USER_ID"]);
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
	$rsDream = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($arDream = $rsDream->Fetch())
	{
		$arResult["USERS"][$key]["DREAM"]["ID"] = $arDream["ID"];
		$arResult["USERS"][$key]["DREAM"]["PREVIEW_TEXT"] = $arDream["PREVIEW_TEXT"];
		$dreamId = $arDream["ID"];
	}
	
?>

<?endforeach;?>