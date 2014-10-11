<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="topMenu">

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

		<li>
				<a href="<?=$arItem["LINK"]?>" class="<?if($arItem["SELECTED"]):?>selected<?endif;?> menuItem<?=$arItem["PARAMS"]["TYPE"];?>" title="<?=$arItem["TEXT"]?>">
				<?if($arItem["PARAMS"]["TYPE"]=="ABOUT"):?>
					<span class="menuName<?=$arItem["PARAMS"]["TYPE"];?>"><?=$arItem["TEXT"]?></span>
					<img src="/bitrix/templates/dreams_start/images/logo.png" width="120" class="imgAbout" alt="">
				<?elseif($arItem["PARAMS"]["TYPE"]=="MECH"):?>
					<span class="menuName<?=$arItem["PARAMS"]["TYPE"];?>"><?=$arItem["TEXT"]?></span>
					<img src="/bitrix/templates/dreams_start/images/mech.png" width="57" class="imgMech" alt="">
				<?elseif($arItem["PARAMS"]["TYPE"]=="MEMBER"):?>
					<span class="menuName<?=$arItem["PARAMS"]["TYPE"];?>"><?=$arItem["TEXT"]?></span>
					<img src="<?=$imgMem;?>" width="79" height="79" class="imgMem" alt="">
					<div style="clear: both;"></div>
					<span class="menuUserCount"><?=GetMessage("YET");?><br><?=CUser::GetCount();?></span>
				<?elseif($arItem["PARAMS"]["TYPE"]=="VOTE"):?>
					<img src="<?=$imgVoting;?>" width="79" height="79" class="imgVoting" alt="">
					<span class="menuName<?=$arItem["PARAMS"]["TYPE"];?>"><?=$arItem["TEXT"]?></span>
				<?elseif($arItem["PARAMS"]["TYPE"]=="REAL"):?>
					<img src="<?=$imgExeption;?>" width="79" height="79" class="imgVoting" alt="">
					<span class="menuName<?=$arItem["PARAMS"]["TYPE"];?>"><?=$arItem["TEXT"]?></span>
				<?elseif($arItem["PARAMS"]["TYPE"]=="EX"):?>
					<span class="menuName<?=$arItem["PARAMS"]["TYPE"];?>"><?=$arItem["TEXT"]?></span>
					<?foreach ($imgYet as $src):?>
						<img src="<?=$src;?>" width="45" height="45" class="imgYet" alt="">
					<?endforeach;?>
				<?endif;?>
			</a>
		</li>
	
	
<?endforeach?>

</ul>
<?endif?>
<div style="clear: both;"></div>