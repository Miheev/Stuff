<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

if (!empty($arResult['ITEMS']) && count($arResult['ITEMS']) > 5) {
    $frame= $this->createFrame()->begin('<img src="'.SITE_TEMPLATE_PATH.'/img/wait27.gif" alt="" />');

    $templateData = array(
        'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
        'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
    );


    $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
    $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
    $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
    ?>
    <div class="head">
        <h2>Вы смотрели</h2>
        <!--                <a class="link-more" href="/catalog/linked/?ELEMENT_ID=--><?//=$_POST['EXTRA_STUFF_ID']?><!--">Смотреть все</a>-->
    </div>
    <div class="slider-viewport">
        <div class="content bxslider clearfix">
            <?    foreach ($arResult['ITEMS'] as $key => $arItem) :
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                $strMainID = $this->GetEditAreaId($arItem['ID']);

                $arItemIDs = array(
                    'ID' => $strMainID,
                    'PICT' => $strMainID . '_pict',
                    'SECOND_PICT' => $strMainID . '_secondpict',

                    'QUANTITY' => $strMainID . '_quantity',
                    'QUANTITY_DOWN' => $strMainID . '_quant_down',
                    'QUANTITY_UP' => $strMainID . '_quant_up',
                    'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                    'BUY_LINK' => $strMainID . '_buy_link',
                    'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

                    'PRICE' => $strMainID . '_price',
                    'DSC_PERC' => $strMainID . '_dsc_perc',
                    'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

                    'PROP_DIV' => $strMainID . '_sku_tree',
                    'PROP' => $strMainID . '_prop_',
                    'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                    'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                );

                $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                $strTitle = (
                isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                    ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                    : $arItem['NAME']
                );

                //Дёргаем цену и элемента с id - $id
                $arProduct = GetCatalogProduct($arItem['ID']);
                $res = GetCatalogProductPrice($PRODUCT_ID, 1);
//Конвертируем валюту в рубли, вам может и не понадобится
//if(isset($ar_price['CURRENCY']) && $ar_price['CURRENCY']!="RUB") $ar_price['PRICE'] = CCurrencyRates::ConvertCurrency($ar_price['PRICE'], $ar_price["CURRENCY"], "RUB");
//В переменной $price теперь содержится цена товара


                ?>
                <div class="stuff-item">
                    <div class="img">
                        <?php
                        $path = empty($arItem['PREVIEW_PICTURE']) ? $arItem['DETAIL_PICTURE']['SRC'] : $arItem['PREVIEW_PICTURE']['SRC'];
                        $img= CFile::ShowImage($path, 113, 122, 'alt=""', $arItem['DETAIL_PAGE_URL']);
                        echo $img;
                        ?>
                    </div>
                    <p class="name">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><? echo $arItem['NAME']; ?></a>
                    </p>

                    <div class="footer">
                        <a class="basket-btn" href="<? echo $arItem['ADD_URL']; ?>"></a>

                        <p class="price">
                            <?
                            $tmp= explode(' ',$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                            if (!empty($tmp) && count($tmp) > 1) {
                                $count= count($tmp)-1;
                                $str='';
                                for ($i=0; $i < $count; $i++)
                                    $str.= ' '.$tmp[$i];
                                echo ltrim($str) . ' <span>'.$tmp[$count].'</span>';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    </div>
    <script type="text/javascript">
        BX.message({
            MESS_BTN_BUY:                '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_BUY')); ?>',
            MESS_BTN_ADD_TO_BASKET:      '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
            MESS_NOT_AVAILABLE:          '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL:                  '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK:            '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR:                 '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS:          '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL:            '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR:        '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS:      '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE:           '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>'
        });
    </script>
    <?
    if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
        ?><? echo $arResult["NAV_STRING"]; ?><?
    }
    $frame->end();
} else {
    $this->setFrameMode(true);

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.top",
        "bx_popular",
        array(
            "VIEW_MODE" => "SECTION",
            "TEMPLATE_THEME" => "blue",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => "-",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "IBLOCK_TYPE" => "support_test_iblock_type",
            "IBLOCK_ID" => "11",
            "ELEMENT_SORT_FIELD" => "shows",
            "ELEMENT_SORT_ORDER" => "desc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FILTER_NAME" => "",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID"],
            "DISPLAY_COMPARE" => "N",
            "ELEMENT_COUNT" => $arParams['ELEMENT_COUNT'],
            "LINE_ELEMENT_COUNT" => $arParams['LINE_ELEMENT_COUNT'],
            "PROPERTY_CODE" => array(
                0 => "CML2_ARTICLE",
                1 => "CML2_BASE_UNIT",
                2 => "CML2_MANUFACTURER",
                3 => "CML2_ATTRIBUTES",
                4 => "CML2_BAR_CODE",
                5 => "",
            ),
            "OFFERS_LIMIT" => "4",
            "PRICE_CODE" => array(
                0 => "Соглашение для сайта КОЛОНКА 2",
            ),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "N",
            "BASKET_URL" => "/personal/order",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "ELEMENT_ID",
            "USE_PRODUCT_QUANTITY" => "Y",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "Y",
            "PRODUCT_PROPERTIES" => array(
            ),
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "HIDE_NOT_AVAILABLE" => "N",
            "CONVERT_CURRENCY" => "N"
        ),
        false
    );
}
?>