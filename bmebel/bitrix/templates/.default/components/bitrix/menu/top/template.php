<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)) { ?>
	<ul>
		<? foreach ($arResult as $arItem) { ?>
			<? if ($arItem["SELECTED"]) { ?>
				<li><a href="<?=$arItem["LINK"]?>" class="selected"><strong><?=$arItem["TEXT"]?></strong></a></li>
			<? } else { ?>
				<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<? } ?>
		<? } ?>
	</ul>
<? } ?>