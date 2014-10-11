<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
echo ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;

//echo '<pre>';
//print_r($arResult);
//echo '</pre>';

if ($normalCount > 0):
?>
<div id="basket_items_list">
    <div class="cart-full">
                    <?
                    foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

                        if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
                    ?>
                        <div id="<?=$arItem["ID"]?>" class="item clearfix">
                                    <div class="img block">
                                        <?
                                        if (!empty($arItem["PREVIEW_PICTURE_SRC"])):
                                            $url = $arItem["PREVIEW_PICTURE_SRC"];
                                        elseif (!empty($arItem["DETAIL_PICTURE_SRC"])):
                                            $url = $arItem["DETAIL_PICTURE_SRC"];
                                        else:
                                            $url = $templateFolder."/images/no_photo.png";
                                        endif;

                                        $img= CFile::ShowImage($url, 113, 122, 'alt=""', $arItem['DETAIL_PAGE_URL']);
                                        echo $img;
                                        ?>
                                    </div>
                                    <div class="text block">
                                        <h3>
                                            <?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
                                            <?=$arItem["NAME"]?>
                                            <?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
                                        </h3>
                                        <p class="code">(вес товара: <?=$arItem["WEIGHT_FORMATED"]; //PROPERTY_CML2_ARTICLE_VALUE ?>)</p>
                                    </div>
                                    <div class="action block">
                                        <div class="row">
                                            <div class="count">
                                                <?
                                                $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 1;
                                                $max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
                                                $useFloatQuantity = false;
                                                ?>
                                                <span class="count-btn" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$ratio?>, 'up', '<?=$useFloatQuantity?>');">+</span>
                                                <input
                                                    type="text"
                                                    size="3"
                                                    id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
                                                    name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
                                                    size="2"
                                                    maxlength="18"
                                                    min="0"
                                                    <?=$max?>
                                                    step="<?=$ratio?>"
                                                    style="max-width: 50px"
                                                    value="<?=$arItem["QUANTITY"]?>"
                                                    onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', '<?=$ratio?>', '<?=$useFloatQuantity?>')"
                                                    >
                                                <span class="count-btn" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$ratio?>, 'down', '<?=$useFloatQuantity?>');">-</span>
                                            </div>
                                            <div style="display: none;">
                                            <?
                                            echo getQuantitySelectControl(
                                                "QUANTITY_SELECT_".$arItem["ID"],
                                                "QUANTITY_SELECT_".$arItem["ID"],
                                                $arItem["QUANTITY"],
                                                $arItem["AVAILABLE_QUANTITY"],
                                                $useFloatQuantity,
                                                $arItem["MEASURE_RATIO"],
                                                $arItem["MEASURE_TEXT"]
                                            );
                                            ?>
                                            </div>
                                            <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
                                            <span class="price">За товар: </span><span class="price" id="current_price_<?=$arItem['ID']?>"><? echo round($arItem["FULL_PRICE"]);?> Р</span>
                                        </div>
                                        <div class="row">
                                                <a class="del" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"><?=GetMessage("SALE_DELETE")?></a>
                                                <a class="del" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delay"])?>"><?=GetMessage("SALE_DELAY")?></a>
                                            <span class="price-full" id="sum_<?=$arItem['ID']?>" data-discount="<?=$arItem['DISCOUNT_PRICE_PERCENT']?>"><?
                                                $tmp= explode(' ',$arItem["SUM"]);
                                                if (!empty($tmp)) {
                                                    $count= count($tmp)-1;
                                                    if ($count)
                                                        $str='';
                                                    for ($i=0; $i < $count; $i++)
                                                        $str.= ' '.$tmp[$i];
                                                    echo ltrim($str);
                                                }
                                                ?> Р</span>
                                        </div>
                                    </div>

                        </div>
                        <?
                        endif;
                    endforeach;
                    ?>

        <input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
        <input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
        <input type="hidden" id="QUANTITY_FLOAT" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
        <input type="hidden" id="COUNT_DISCOUNT_4_ALL_QUANTITY" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="PRICE_VAT_SHOW_VALUE" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="HIDE_COUPON" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="USE_PREPAYMENT" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />

        <?if ($arParams["HIDE_COUPON"] != "Y"):?>
            <div class="bx_ordercart_order_pay_left">
                <div class="bx_ordercart_coupon">
                    <span><?=GetMessage("STB_COUPON_PROMT")?></span>
                    <input type="text" id="COUPON" name="COUPON" value="<?=$arResult["COUPON"]?>" size="21" class="good"> <!-- "bad" if coupon is not valid -->
                </div>
            </div>
        <?endif;?>
    </div>
</div>
<?
else:
?>
<div id="basket_items_list">
    <div class="cart-full">
        <div class="item clearfix">
            <?=GetMessage("SALE_NO_ITEMS");?>
        </div>
    </div>
</div>
<?
endif;
?>