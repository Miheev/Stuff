
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <ul>
        <?foreach($arResult as $arItem):?>
            <?
            $image = '';
            if(strlen($arItem["PARAMS"]["IMG"])>0){
                $image = '<img style="padding-top: 5px; padding-right: 5px;" src="'.$arItem["PARAMS"]["IMG"].'" border="0" />';
            }
            ?>
            <?if($arItem["SELECTED"]):?>
                <li><?=$image?><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><?=$image?><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>
        <?endforeach?>
    </ul>
<?endif?>