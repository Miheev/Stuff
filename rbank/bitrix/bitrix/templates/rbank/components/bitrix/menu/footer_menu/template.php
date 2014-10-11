<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <ul class="menu">
<?
$count= count($arResult) - 2;
foreach($arResult as $id => $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
		<li <?echo $id < $count ? '' : 'class="distant"';?>>
            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
        </li>

<?endforeach?>
    </ul>
<?endif?>