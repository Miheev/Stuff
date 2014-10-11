<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<a href="/news/" class="newMainHead"><span><?=GetMessage("NEWS");?></span></a>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<span class="mainNewsDate"><?=$arItem["ACTIVE_FROM"];?></span>
	<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="mainNewsLink"><?=$arItem["NAME"];?></a>
	
<?endforeach;?>
<img src="<?=SITE_TEMPLATE_PATH."/images/news_ico.png";?>"/>
