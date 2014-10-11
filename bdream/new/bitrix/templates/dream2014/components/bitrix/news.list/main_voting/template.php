<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div style="clear: both;"></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	
		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=>3, "PROPERTY_DREAM"=>$arItem["ID"]);
		$rsDream = CIBlockElement::GetList(Array(), $arFilter, Array("PROPERTY_DREAM"));
		if($arDream = $rsDream->Fetch())
		{
			$vote = $arDream["CNT"];
		}
		else
		{
			$vote = 0;
		}
	
	?>
	<div style="float: left; width: 225px;">
		<span><?=GetMessage("VOTE");?></span>
		<div class="mainVotingName"><b>“</b> <?=$arItem["NAME"];?> <b>”</b></div>
		<?
		$rsUser = CUser::GetByID($arItem["PROPERTIES"]["USER"]["VALUE"]);
		$arUser = $rsUser->Fetch();
		$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
		$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
		?>
		
		<div href="" class="mainVotingUser"><?=$arUser["NAME"]."<br>".$arUser["LAST_NAME"]?></div>
		<p class="mainVotingInfo"><?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?><br>
		<?=$country.", ".$arUser["PERSONAL_CITY"];?></p>
	</div>
	<div style="float: right;">
		<img class="mainVotingImg" src="<?=GetImageResized($arItem["DETAIL_PICTURE"]["SRC"], 206,206);?>" />
		<div class="mainVotingPanel"><img src="<?=SITE_TEMPLATE_PATH."/images/like.png";?>"><b id ="mainVotingSum"> <?=$vote?></b><div id="mainVotingBtn" rel="<?=$arItem['ID']?>"><?=GetMessage("VOTE_YET");?></div></div>
	</div>
<?endforeach;?>
<div style="clear: both;"></div>

