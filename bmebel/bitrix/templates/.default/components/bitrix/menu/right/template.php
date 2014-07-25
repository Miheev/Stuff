<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)) { ?>
	<div class="second_menu">
	<? foreach($arResult as $arItem) { ?>
		<? if ($arItem["SELECTED"]) { ?>
			<a href="<?=$arItem["LINK"]?>" class="selected" ><?=$arItem["TEXT"]?></a>			
		<? } else { ?>
			<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
		<? } ?>
		<? if ($arItem['PARAMS']['description']) { ?>
			<br />
			<?=$arItem['PARAMS']['description']?>
			<br />
		<? } ?>
		<br />
	<? } ?>
	</div>
<? } ?>