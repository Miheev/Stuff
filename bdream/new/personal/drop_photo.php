<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_REQUEST["ELEMENT_ID"] && $_REQUEST["PROP_ID"])
{
	$arFile["MODULE_ID"] = "iblock"; 
	$arFile["del"] = "Y"; 
	CModule::IncludeModule('iblock');
	CIBlockElement::SetPropertyValueCode(intval($_REQUEST["ELEMENT_ID"]), "PHOTO", Array (intval($_REQUEST["PROP_ID"])=>Array("VALUE"=>$arFile)));
}
?>
