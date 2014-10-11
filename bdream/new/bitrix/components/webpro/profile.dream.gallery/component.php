<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	function diverse_array($vector) {
    $result = array();
    foreach($vector as $key1 => $value1)
        foreach($value1 as $key2 => $value2)
            $result[$key2][$key1] = $value2;
    return $result;
}
	
	
	if (isset($_POST['show_crop'])) {
    $arr_file = Array(
        "name" => $_FILES['dream_photo']['name'],
        "size" => $_FILES['dream_photo']['size'],
        "tmp_name" => $_FILES['dream_photo']['tmp_name'],
        "type" => "",
        "old_file" => "",
        "del" => "Y",
        "MODULE_ID" => "iblock");
    $fid = CFile::SaveFile($arr_file, "member");

	$dream_photo = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1000), $arSelect);
	$PHOTO_RES=Array();
	while ($object_photo = $dream_photo->GetNext())
	{
		$PHOTO_RES[]=$object["PROPERTY_PHOTO_VALUE"];
	}
    $upload = diverse_array($_FILES["dream_photo"]);
	$PHOTO_RES[]=$fid;
	CIBlockElement::SetPropertyValues($arParams["ELEMENT_ID"], 2, $PHOTO_RES, "PHOTO");
	
   
    
	}


	$arFilter = Array(
		"IBLOCK_ID"=> 2,
		"ID" => $arParams["ELEMENT_ID"],
		);
	
	$arSelect = Array("ID","PROPERTY_PHOTO");
	
	$dream_res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1000), $arSelect);
	$PHOTO=Array();
	while ($object = $dream_res->GetNext())
	{
		$PHOTO[]=$object["PROPERTY_PHOTO_VALUE"];
	}
	$arResult= Array (
		"DREAM" => Array (
			"ID" =>  $arParams["ELEMENT_ID"],
			"PHOTO" => $PHOTO,
		),
	);

		$this->IncludeComponentTemplate();
?>