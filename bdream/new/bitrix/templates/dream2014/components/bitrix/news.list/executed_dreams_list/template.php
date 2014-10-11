<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="executedDreamsList">
<?foreach($arResult["ITEMS"] as $arItem):
	$rsUser = CUser::GetByID(intval($arItem["PROPERTIES"]["USER"]["VALUE"]));
	$arUser = $rsUser->Fetch();

?>
	<a href="/executed_dreams/detail.php?ID=<?=$arItem["ID"];?>" class="executedDream">
		<span class="executedUserName"><?=GetMessage("EX_DREAM");?><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?></span>
		<span class="dateExecuted"><?=GetMessage("EX_DREAM");?><?=ConvertTimeStamp(MakeTimeStamp($arItem["PROPERTIES"]["DATE_EXECUTED"]["VALUE"]));?></span>
		<div style="clear: both;"></div><br>
		<div style="float: left">
			<img class="executedUserAvatar" src="<?=GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 100, 100);?>"/>
		</div>
		<div style="float: left; margin-left: 10px;">
			<div class="executedDetailLink"><?=GetMessage("MORE");?></div>
			<div class="executedMorePhoto">
				<?if(is_array($arItem["PROPERTIES"]["PHOTO"]["VALUE"]) && count($arItem["PROPERTIES"]["PHOTO"]["VALUE"])>0):
					foreach($arItem["PROPERTIES"]["PHOTO"]["VALUE"] as $arImg):?>
							<img src="<?=GetImageResized(CFile::GetPath($arImg), 52, 52);?>"/>
					<?endforeach;?>
				<?endif;?>
			</div>
		</div>
		<div style="clear: both;"></div>
	</a>
<?endforeach;?>
</div>
<div class="executedDreamBanner">
<?$APPLICATION->IncludeComponent("bitrix:advertising.banner","",Array(
		"TYPE" => "executed_dreams", 
		"CACHE_TYPE" => "A",
		"NOINDEX" => "Y", 
		"CACHE_TIME" => "3600" 
	)
);?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

