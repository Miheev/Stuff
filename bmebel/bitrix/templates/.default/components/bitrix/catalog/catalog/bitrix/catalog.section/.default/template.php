<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<? if($_GET['arrFilter_pf']['maki_area']['RIGHT'] < $_GET['arrFilter_pf']['maki_area']['LEFT']):   ?>
   <p align="center">Вы ввели некорретный запрос значение метража 'от' больше значения 'до'</p>
<?endif; ?>
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

   <div class="catalog-section-element">
	    <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
        <div class="catalog-section-element-img">
		    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"  alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
        </div>
		<?endif?>
        <div class="catalog-section-element-proper">
		<?foreach($arElement["PROPERTIES"] as $pid=>$arProperty):?>

            <? if($arProperty['CODE'] == 'maki_code'):?>
                <? if($arProperty['VALUE']):?>
                <div class="element-proper-code">
                    <?
                        $trans = array("ИД" => "", "ИБ" => "" );
                    ?>
                    <span><? echo strtr($arProperty['VALUE'], $trans) ;?></span>
                </div>
                <? else:?>
                <div class="element-proper-code">
                    <span><?=$arElement['ID'];?> !</span>
                </div>
                <? endif;?>
            <? endif;?>
            <? if($arProperty['CODE'] == 'maki_area'):?>
            <div class="element-proper-metr">
                <? if ($arProperty['VALUE']):?>
                    <span><?=$arProperty['VALUE'];?> кв.м</span>
                <? else:?>
                    <span>&nbsp;</span>
                <?endif;?>

            </div>
            <? endif;?>
		<?endforeach?>


            <? if($arElement['NAME']):?>
            <div class="element-proper-tip">
                <span>
                    <? echo TruncateText($arElement['NAME'], 18);?>
                </span>
            </div>
            <? endif;?>

        </div>
   </div>

<?endforeach ; ?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
