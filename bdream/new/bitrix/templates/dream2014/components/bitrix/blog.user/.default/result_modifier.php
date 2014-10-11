<?

CModule::IncludeModule("iblock");
$arResult["User"]["ID"] = $USER->GetID();

$rsDream = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=>2, "PROPERTY_USER"=>$arResult["User"]["ID"]));
while($arDream = $rsDream->GetNextElement())
{
	$arResult["DREAM"]["FIELDS"] = $arDream->GetFields();
	$arResult["DREAM"]["PROP"] = $arDream->GetProperties();
}



?>

