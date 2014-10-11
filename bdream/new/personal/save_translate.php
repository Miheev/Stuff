<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<? 
global $USER;

$USER_ID = $USER->GetID();
$PROP_CODE = $_REQUEST["PROP"];
if($USER_ID && isset($_REQUEST["PROP"])&& $_REQUEST["PROP"])
{
	CModule::IncludeModule("iblock");
	$PROP_TEXT = trim(strip_tags($_REQUEST["PROP_TEXT"], "<br>"), "<br />");
	
	$arSelect = Array("ID", "NAME");
	$arFilter = Array("IBLOCK_ID"=>2, "PROPERTY_USER"=>intval($USER_ID));
	$rsDream = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($arDream = $rsDream->Fetch())
	{
		CIBlockElement::SetPropertyValueCode(intval($arDream["ID"]), $PROP_CODE, array(array("TYPE"=>"HTML", "TEXT"=>$PROP_TEXT)));
	}
	else
	{
		echo "error_exists";
	}
}
else
{
	echo "error";
}


?>