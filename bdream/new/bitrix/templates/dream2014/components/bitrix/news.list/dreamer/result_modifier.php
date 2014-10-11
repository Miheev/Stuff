<?foreach($arResult["ITEMS"] as $key=>$arItem):
$rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$arItem["PROPERTIES"]["USER"]["VALUE"]),array("SELECT"=>array("UF_*")));
while($arUser = $rsUser->Fetch())
{
	$arResult["ITEMS"][$key]["AR_USER"] = $arUser;
}
endforeach;?>