<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="wrapper">

<?foreach($arResult as $arItem):?>
	<?if($arItem["SELECTED"]):?>
		<li class="act"><a href="<?=$arItem["LINK"]?>"><span><strong><?=$arItem["TEXT"]?></strong></span></a></li>
	<?else:?>
		<li><a href="<?=$arItem["LINK"]?>"><span><strong><?=$arItem["TEXT"]?></strong></span></a></li>
	<?endif?>
	
<?endforeach?>

</ul>
<?endif?>