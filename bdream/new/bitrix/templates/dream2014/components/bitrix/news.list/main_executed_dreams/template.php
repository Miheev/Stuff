<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<span><?=GetMessage("EX_DREAM");?></span><br>
	<div style="clear: both"></div>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="exImgBlock">
	<?if($arItem["DETAIL_PICTURE"]["SRC"]):?>
		<div><img src="<?=GetImageResized($arItem["DETAIL_PICTURE"]["SRC"], 73,73);?>"/></div>
	<?elseif($arItem["PROPERTIES"]["PHOTO"]):?>
		<div><img src="<?=GetImageResized(CFile::GetPath($arItem["PROPERTIES"]["PHOTO"]["VALUE"][0]), 73,73);?>"/></div>
	<?endif;?>
	</div>
<?endforeach;?>

