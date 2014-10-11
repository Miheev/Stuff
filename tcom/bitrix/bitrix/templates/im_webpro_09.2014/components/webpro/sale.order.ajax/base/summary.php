<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = ($arResult["PRICE_WITHOUT_DISCOUNT"] != $arResult["ORDER_TOTAL_PRICE_FORMATED"])? true : false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>


<div class="result">
        <p class="clearfix"><?echo GetMessage('SOA_TEMPL_SUM_WEIGHT_SUM')?> <span><?=$arResult["ORDER_WEIGHT_FORMATED"]?></span></p>
        <p class="clearfix"><?echo GetMessage('SOA_TEMPL_SUM_SUMMARY')?> <span class="incalc currency" id="allVATSum_FORMATED"><?=format_price($arResult["ORDER_PRICE_FORMATED"])?></span></p>
    <?if ($bUseDiscount):
        ?>
        <p class="clearfix" style="text-decoration:line-through; color:#828282;">Старая цена: <span style="text-decoration:line-through;" class="incalc currency" id="PRICE_WITHOUT_DISCOUNT"><?=format_price($arResult["PRICE_WITHOUT_DISCOUNT"])?></span></p>
    <?endif ?>
    <?
//    if(!empty($arResult["TAX_LIST"]))
//    {
//        foreach($arResult["TAX_LIST"] as $tax_id => $val)
//        {
//            ?>
<!--            <p>--><?//echo $val["NAME"]?><!-- --><?//=$val["VALUE_FORMATED"]?><!--: <span class="incalc tax-price currency" id="tax-price---><?//=$tax_id?><!--">--><?//=format_price($val["VALUE_MONEY_FORMATED"])?><!--</span></p>-->
<!--        --><?//
//        }
//    }
    ?>
    <? if (doubleval($arResult["DELIVERY_PRICE"]) > 0) : ?>
        <p class="clearfix"><?echo GetMessage('SOA_TEMPL_SUM_DELIVERY')?> <span class="incalc currency" id="delivery-price"><?=format_price($arResult["DELIVERY_PRICE_FORMATED"])?></span></p>
    <? endif; ?>
    <? if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0) :   ?>
        <p class="clearfix"><?echo GetMessage('SOA_TEMPL_SUM_PAYED')?> <span class="currency" id="from-account"><?=format_price($arResult["PAYED_FROM_ACCOUNT_FORMATED"])?></span></p>
    <?endif;?>
</div>
<p class="price-result">Итого к оплате: <span class="simple nowrap incalc" id="allSum_FORMATED"><?=format_price($arResult["ORDER_TOTAL_PRICE_FORMATED"])?> Р</span></p>
