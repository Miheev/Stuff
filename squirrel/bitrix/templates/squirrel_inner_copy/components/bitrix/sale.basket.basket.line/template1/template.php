<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["SHOW_PERSONAL_LINK"] == "Y")
{
    ?>
    <a href="<?=$arParams["PATH_TO_PERSONAL"]?>"><?GetMessage("TSB1_PERSONAL") ?></a>&nbsp;
<?
}?><a href="<?=$arParams["PATH_TO_BASKET"]?>"><img align="middle" src="<?=SITE_TEMPLATE_PATH?>/images/cart.png" alt="" /></a>
<?
if (IntVal($arResult["NUM_PRODUCTS"])>0)
{

    preg_match('/\d/', $arResult["PRODUCTS"], $res);
    ?>
    <div class="nums"><a href="<?=$arParams["PATH_TO_BASKET"]?>">В корзине<br/><span style="font-weight: 500;"><? echo $res[0];?> товаров</span></a></div><div class="clear"></div>

<?
}
else
{
    ?>
    <?//=$arResult["ERROR_MESSAGE"]?><p class="empty-basket">В корзине<br/><span>нет товара</span></p>
<?
}
?>