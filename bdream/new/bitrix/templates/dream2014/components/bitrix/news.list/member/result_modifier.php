<?
$arResult["USER"]=array();

foreach($arResult["ITEMS"] as $arItem):

$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$arItem["PROPERTIES"]["USER"]["VALUE"]),array("SELECT"=>array("UF_*")));
while($arUsers = $rsUsers->Fetch())
{

	$arResult["USER"] = $arUsers;

}

endforeach;?>