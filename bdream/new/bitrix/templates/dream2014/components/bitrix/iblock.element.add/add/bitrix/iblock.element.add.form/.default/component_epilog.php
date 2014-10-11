<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?CJSCore::Init(array('translit'));?>
<?
	//echo "<pre>";print_r($arResult);echo "</pre>";
if(trim($arResult["ELEMENT_PROPERTIES"][10][0]["~VALUE"]["TEXT"])==""){
	$ID=$arResult["ELEMENT"]["ID"];
	$text_old = $arResult["ELEMENT"]["DETAIL_TEXT"];
	$arParams = array("replace_space"=>" ","replace_other"=>"-");
	$translate = Cutil::translit($text_old,"ru",$arParams);
	echo $ID;
$prop["ENGLISH_DETAIL_TEXT"] = array('VALUE'=>array('TYPE'=>'HTML', 'TEXT'=>$translate));
CIBlockElement::SetPropertyValuesEx($ID, 2, $prop);

//LocalRedirect($APPLICATION->GetCurUri());
	//*/
}
?>