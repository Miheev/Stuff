<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list-left">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<p class="news-item"><small><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a><br /></small></p>
	<?endforeach;?>
</div>
