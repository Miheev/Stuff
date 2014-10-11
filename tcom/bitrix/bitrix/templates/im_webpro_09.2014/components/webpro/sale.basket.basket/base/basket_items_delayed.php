<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
?>
<div id="basket_items_delayed" class="bx_ordercart_order_table_container" style="display:none">
    <div class="cart-full">
        <?
        foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

            if ($arItem["DELAY"] == "Y" && $arItem["CAN_BUY"] == "Y"):
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
                                    disabled="disabled"
                                    >
                            </div>
                            <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
                            <span class="price">За товар: </span><span class="price" id="current_price_<?=$arItem['ID']?>"><?=$arItem["FULL_PRICE"];?> Р</span>
                        </div>
                        <div class="row">
                            <a class="del del-link" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"><?=GetMessage("SALE_DELETE")?></a>
                            <input type="hidden" name="DELAY_<?=$arItem["ID"]?>" value="Y"/>
                            <a class="del back-link" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["add"])?>"><?=GetMessage("SALE_ADD_TO_BASKET")?></a>
                                            <span class="price-full" id="sum_<?=$arItem['ID']?>"><?
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
    </div>
</div>