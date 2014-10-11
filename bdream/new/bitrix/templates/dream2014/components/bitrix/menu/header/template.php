<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?
CModule::IncludeModule("iblock");

$arSelect = Array("ID", "NAME", "PROPERTY_USER");
$arFilter = Array("IBLOCK_ID"=>IntVal(2), "ACTIVE"=>"Y", "!PROPERTY_USER"=>false, "PROPERTY_STATE"=>3);
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->Fetch())
{
	$rsUser = CUser::GetByID($ob["PROPERTY_USER_VALUE"]);
	$arUser = $rsUser->Fetch();
	if($arUser["PERSONAL_PHOTO"])
	{
		$userDropID = $arUser["ID"];
		$imgVoting = GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 79, 79);
		break;
	}
}

$arSelect = Array("ID", "NAME", "PROPERTY_USER");
$arFilter = Array("IBLOCK_ID"=>IntVal(2), "ACTIVE"=>"Y", "!PROPERTY_USER"=>false);
if($userDropID)
{
	$arFilter["!PROPERTY_USER"] = $userDropID;
}
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array ("nTopCount" => 8), $arSelect);
while($ob = $res->Fetch())
{
	$rsUser = CUser::GetByID($ob["PROPERTY_USER_VALUE"]);
	$arUser = $rsUser->Fetch();

	if($arUser["PERSONAL_PHOTO"])
	{
		$imgMem = GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 79, 79);
		break;
	}
}



$arSelect = Array("ID", "NAME", "PROPERTY_USER");
$arFilter = Array("IBLOCK_ID"=>IntVal(2), "ACTIVE"=>"Y", "!PROPERTY_USER"=>false, "PROPERTY_STATE"=>4);
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->Fetch())
{
	$rsUser = CUser::GetByID($ob["PROPERTY_USER_VALUE"]);
	$arUser = $rsUser->Fetch();
	if($arUser["PERSONAL_PHOTO"])
	{
		$imgExeption = GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 79, 79);
		break;
	}
}

$imgYet = array();
$i=0;
$arSelect = Array("ID", "NAME", "PROPERTY_USER");
$arFilter = Array("IBLOCK_ID"=>IntVal(2), "ACTIVE"=>"Y", "!PROPERTY_USER"=>false, "PROPERTY_STATE"=> 5);
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array ("nTopCount" => 5), $arSelect);
while($ob = $res->Fetch())
{
	$rsUser = CUser::GetByID($ob["PROPERTY_USER_VALUE"]);
	$arUser = $rsUser->Fetch();
	if($arUser["PERSONAL_PHOTO"])
	{
		$imgYet[] = GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 45, 45);
		$i++;
		if($i==3)
		{
			break;
		}
	}
}

foreach($arResult as $i=>$arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
	
?>
<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>

<?endforeach?>

<?endif?>