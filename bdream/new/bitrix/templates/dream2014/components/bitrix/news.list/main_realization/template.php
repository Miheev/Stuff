<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	
		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=>5, "PROPERTY_DREAM"=>$arItem["ID"]);
		$rsDream = CIBlockElement::GetList(Array(), $arFilter, Array("PROPERTY_DREAM"));
		if($arDream = $rsDream->Fetch())
		{
			$comment = $arDream["CNT"];
		}
		else
		{
			$comment = 0;
		}
	
	?>
	<div style="float: left;">
		<img class="mainRealizationImg" src="<?=GetImageResized($arItem["DETAIL_PICTURE"]["SRC"], 212,212);?>" />
		<div class="mainRealizationPanel"><img src="<?=SITE_TEMPLATE_PATH."/images/talk.png";?>"><b id ="mainCommentSum"> <?=$comment?></b><div id="mainRealBtn" rel="<?=$arItem['ID']?>"><?=GetMessage("ACTION");?></div></div>
	</div>
	<div style="float: right; width: 210px;">
		<span><?=GetMessage("EX_DREAM");?></span>
		<div class="mainRealizationName"><b>“</b> <?=$arItem["NAME"];?> <b>”</b></div>
		<?
		$rsUser = CUser::GetByID($arItem["PROPERTIES"]["USER"]["VALUE"]);
		$arUser = $rsUser->Fetch();
		$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
		$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
		?>
		
		<div class="mainRealizationUser"><?=$arUser["NAME"]." ".$arUser["LAST_NAME"]?></div>
		<p class="mainRealizationInfo"><?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?><br>
		<?=$country.", ".$arUser["PERSONAL_CITY"];?></p>
	</div>

<?endforeach;?>

