<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)) { ?>
	<? foreach($arResult as $arItem) { ?>
		<a href="<?=$arItem["LINK"]?>" class="<?=$arItem["PARAMS"]['class']?><?=($arItem["SELECTED"])?' selected':''?>" <?=($arItem["PARAMS"]['target'])?'target="'.$arItem["PARAMS"]['target'].'"':''?>><?//=$arItem["TEXT"]?></a>
		<br />
	<? } ?>
<? } ?>