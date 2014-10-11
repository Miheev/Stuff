<?
$arResult["USER"]=array();
foreach($arResult["ITEMS"] as $arItem):
$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>intval($arItem["PROPERTIES"]["USER"]["VALUE"])),array("SELECT"=>array("UF_*")));
if($arUsers = $rsUsers->Fetch())
{
	$arResult["USERS"][$arItem["ID"]] = $arUsers;
}
endforeach;
?>