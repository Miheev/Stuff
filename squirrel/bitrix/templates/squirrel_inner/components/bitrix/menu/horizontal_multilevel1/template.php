<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>

<?$ooop=0;$i=0;
foreach($arResult as $arItem):
?>
<?if($arItem["DEPTH_LEVEL"] == 1):$ooop++;?><?endif?>
<?endforeach?>

<ul>
<?foreach($arResult as $arItem): $i++;
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?if ($i<$ooop):?><li class="sep"></li><?endif?>
<?endforeach?>

</ul>
<?endif?>