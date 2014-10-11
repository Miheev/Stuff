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
$this->setFrameMode(true);

if (!empty($arResult['ITEMS'])) {
    $templateData = array(
        'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
        'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
    );

//    echo '<pre>';
//    var_export($arResult);
//    echo '</pre>';
//    exit();
//    'IBLOCK_SECTION_ID' => '1301',
//      '~IBLOCK_SECTION_ID' => '1309',

    $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
    $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
    $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

//    function cmp_section2($a, $b) {
//        if ($a['~IBLOCK_SECTION_ID'] == $b['~IBLOCK_SECTION_ID']) {
//            return 0;
//        }
//        return ($a['~IBLOCK_SECTION_ID'] < $b['~IBLOCK_SECTION_ID']) ? -1 : 1;
//    }
//
//    usort ( $arResult['ITEMS'], 'cmp_section2');

    $prev_section= 0;
    $item_id= 0;
    $item_count= count($arResult['ITEMS']) - 1;
    $sect_count= count($arResult['cats']);

    CModule::IncludeModule("iblock");
    ?>
        <div class="product-list clearfix">
            <?
                if ($sect_count <= 1)
                   echo '<h1>'.$arResult['NAME'].'</h1>';
//                    echo '<div class="head">
//                                <h1>'.$arResult['NAME'].'</h1>
//                                <a href="'.$arResult["SECTION_PAGE_URL"].'?details=1">Показать все</a>
//                            </div>';

                foreach ($arResult['ITEMS'] as $key=>$arItem) :

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

                    if ($sect_count > 1 && $prev_section != $arItem['~IBLOCK_SECTION_ID'] && $arIBlockSection = GetIBlockSection($arItem['~IBLOCK_SECTION_ID'])) {
                        if ($item_id % 4 != 0)
                            echo '</div>';

                        echo '<div class="head">
                                <a href="'.$arIBlockSection["SECTION_PAGE_URL"].'?details=1"><h2>'.$arIBlockSection['NAME'].'</h2></a>
                                <a class="link-more" href="'.$arIBlockSection["SECTION_PAGE_URL"].'?details=1">Показать все</a>
                            </div>';
                        echo '<div class="list-row clearfix">';
                        $prev_section= $arItem['~IBLOCK_SECTION_ID'];
                        $item_id= 0;

                        $catid= array_search($prev_section, $arResult['cats']);
                        if ($catid !== false)
                            unset($arResult['cats'][$catid]);
                    } else if ($item_id % 4 == 0)
                        echo '<div class="list-row clearfix">';
                    ?>

                    <div class="stuff-item">
                        <div class="img">
                            <?php
                            $path = empty($arItem['PREVIEW_PICTURE']) ? $arItem['DETAIL_PICTURE']['SRC'] : $arItem['PREVIEW_PICTURE']['SRC'];
                            $img = CFile::ShowImage($path, 113, 122, 'alt=""', $arItem['DETAIL_PAGE_URL']);
                            echo $img;
                            ?>
                        </div>
                        <p class="name">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><? echo $arItem['NAME']; ?></a>
                        </p>

                        <div class="footer">
                            <a class="basket-btn" href="<? echo $arItem['ADD_URL']; ?>"></a>

                            <p class="price">
                                <?
                                $tmp = explode(' ', $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                                if (!empty($tmp) && count($tmp) > 1) {
                                    $count = count($tmp) - 1;
                                    $str = '';
                                    for ($i = 0; $i < $count; $i++)
                                        $str .= ' ' . $tmp[$i];
                                    echo ltrim($str) . ' <span>' . $tmp[$count] . '</span>';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <?
                    if ($item_id % 4 == 3 || $key == $item_count) {
                        echo '</div>';
                    }

                    $item_id= $item_id == 3 ? 0 : $item_id+1;
                endforeach; //endfor

            $catid= array_search($arResult['ID'], $arResult['cats']);
            if ($catid !== false)
                unset($arResult['cats'][$catid]);

//            var_dump($arResult['cats']);


            if (!empty($arResult["last_page"])) {

                foreach ($arResult['cats'] as $cat) {
                    $rsElements = CIBlockElement::GetList(array(), array('SECTION_ID'=>$cat, 'INCLUDE_SUBSECTIONS'=>'Y'), false, array('nTopCount'=>4, 'nPageSize'=>4), $arResult['arSelect']);
                    $rsElements->SetUrlTemplates($arParams["DETAIL_URL"]);
                    if($arParams["BY_LINK"]!=="Y" && !$arParams["SHOW_ALL_WO_SECTION"])
                        $rsElements->SetSectionContext($arResult);
                    $arResult["ITEMS"] = array();
                    $arMeasureMap = array();
                    $arElementLink = array();
                    $intKey = 0;

                    while($arItem = $rsElements->GetNext())
                    {
                        $arItem['ID'] = (int)$arItem['ID'];

                        $arItem['ACTIVE_FROM'] = $arItem['DATE_ACTIVE_FROM'];
                        $arItem['ACTIVE_TO'] = $arItem['DATE_ACTIVE_TO'];

                        if($arResult["ID"])
                            $arItem["IBLOCK_SECTION_ID"] = $arResult["ID"];

                        $arButtons = CIBlock::GetPanelButtons(
                            $arItem["IBLOCK_ID"],
                            $arItem["ID"],
                            $arResult["ID"],
                            array("SECTION_BUTTONS"=>false, "SESSID"=>false, "CATALOG"=>true)
                        );
                        $arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
                        $arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

                        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arItem["IBLOCK_ID"], $arItem["ID"]);
                        $arItem["IPROPERTY_VALUES"] = $ipropValues->getValues();

                        $arItem["PREVIEW_PICTURE"] = (0 < $arItem["PREVIEW_PICTURE"] ? CFile::GetFileArray($arItem["PREVIEW_PICTURE"]) : false);
                        if ($arItem["PREVIEW_PICTURE"])
                        {
                            $arItem["PREVIEW_PICTURE"]["ALT"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
                            if ($arItem["PREVIEW_PICTURE"]["ALT"] == "")
                                $arItem["PREVIEW_PICTURE"]["ALT"] = $arItem["NAME"];
                            $arItem["PREVIEW_PICTURE"]["TITLE"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
                            if ($arItem["PREVIEW_PICTURE"]["TITLE"] == "")
                                $arItem["PREVIEW_PICTURE"]["TITLE"] = $arItem["NAME"];
                        }
                        $arItem["DETAIL_PICTURE"] = (0 < $arItem["DETAIL_PICTURE"] ? CFile::GetFileArray($arItem["DETAIL_PICTURE"]) : false);
                        if ($arItem["DETAIL_PICTURE"])
                        {
                            $arItem["DETAIL_PICTURE"]["ALT"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"];
                            if ($arItem["DETAIL_PICTURE"]["ALT"] == "")
                                $arItem["DETAIL_PICTURE"]["ALT"] = $arItem["NAME"];
                            $arItem["DETAIL_PICTURE"]["TITLE"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"];
                            if ($arItem["DETAIL_PICTURE"]["TITLE"] == "")
                                $arItem["DETAIL_PICTURE"]["TITLE"] = $arItem["NAME"];
                        }

                        $arItem["PROPERTIES"] = array();
                        $arItem["DISPLAY_PROPERTIES"] = array();
                        $arItem["PRODUCT_PROPERTIES"] = array();
                        $arItem['PRODUCT_PROPERTIES_FILL'] = array();

                        if ($bIBlockCatalog)
                        {
                            if (!isset($arItem["CATALOG_MEASURE_RATIO"]))
                                $arItem["CATALOG_MEASURE_RATIO"] = 1;
                            if (!isset($arItem['CATALOG_MEASURE']))
                                $arItem['CATALOG_MEASURE'] = 0;
                            $arItem['CATALOG_MEASURE'] = (int)$arItem['CATALOG_MEASURE'];
                            if (0 > $arItem['CATALOG_MEASURE'])
                                $arItem['CATALOG_MEASURE'] = 0;
                            if (!isset($arItem['CATALOG_MEASURE_NAME']))
                                $arItem['CATALOG_MEASURE_NAME'] = '';

                            $arItem['CATALOG_MEASURE_NAME'] = $arDefaultMeasure['SYMBOL_RUS'];
                            $arItem['~CATALOG_MEASURE_NAME'] = $arDefaultMeasure['~SYMBOL_RUS'];
                            if (0 < $arItem['CATALOG_MEASURE'])
                            {
                                if (!isset($arMeasureMap[$arItem['CATALOG_MEASURE']]))
                                    $arMeasureMap[$arItem['CATALOG_MEASURE']] = array();
                                $arMeasureMap[$arItem['CATALOG_MEASURE']][] = $intKey;
                            }
                        }
                        $arResult["ITEMS"][$intKey] = $arItem;
                        $arResult["ELEMENTS"][$intKey] = $arItem["ID"];
                        $arElementLink[$arItem['ID']] = &$arResult["ITEMS"][$intKey];
                        $intKey++;
                    }

                    $prev_section= 0;
                    $item_id= 0;
                    $item_count= count($arResult['ITEMS']) - 1;
                    $sect_count= count($arResult['cats']);


                    foreach ($arResult['ITEMS'] as $key=>$arItem) :

                        //Дёргаем цену и элемента с id - $id
                        $arProduct = GetCatalogProduct($arItem['ID']);
                        $res = GetCatalogProductPrice($PRODUCT_ID, 1);
                        //Конвертируем валюту в рубли, вам может и не понадобится
                        //if(isset($ar_price['CURRENCY']) && $ar_price['CURRENCY']!="RUB") $ar_price['PRICE'] = CCurrencyRates::ConvertCurrency($ar_price['PRICE'], $ar_price["CURRENCY"], "RUB");
                        //В переменной $price теперь содержится цена товара

                        if ($item_id % 4 == 0) {
                            $arIBlockSection = GetIBlockSection($arItem['~IBLOCK_SECTION_ID']);
                            if (!empty($arIBlockSection)) {
                                echo '<div class="head">
                                    <a href="'.$arIBlockSection["SECTION_PAGE_URL"].'"><h2>'.$arIBlockSection['NAME'].'</h2></a>
                                    <a class="link-more" href="'.$arIBlockSection["SECTION_PAGE_URL"].'">Показать все</a>
                                </div>';
                                $catid= array_search($prev_section, $arResult['cats']);
                                if ($catid !== false)
                                    unset($arResult['cats'][$catid]);
                            }

                            echo '<div class="list-row clearfix">';
                        }
                        ?>

                        <div class="stuff-item">
                            <div class="img">
                                <?php
                                $path = empty($arItem['PREVIEW_PICTURE']) ? $arItem['DETAIL_PICTURE']['SRC'] : $arItem['PREVIEW_PICTURE']['SRC'];
                                $img = CFile::ShowImage($path, 113, 122, 'alt=""', $arItem['DETAIL_PAGE_URL']);
                                echo $img;
                                ?>
                            </div>
                            <p class="name">
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><? echo $arItem['NAME']; ?></a>
                            </p>

                            <div class="footer">
                                <a class="basket-btn" href="<? echo $arItem['ADD_URL']; ?>"></a>

                                <p class="price">
                                    <?
                                    $tmp = explode(' ', $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                                    if (!empty($tmp) && count($tmp) > 1) {
                                        $count = count($tmp) - 1;
                                        $str = '';
                                        for ($i = 0; $i < $count; $i++)
                                            $str .= ' ' . $tmp[$i];
                                        echo ltrim($str) . ' <span>' . $tmp[$count] . '</span>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?
                        if ($item_id % 4 == 3 || $key == $item_count) {
                            echo '</div>';
                        }

                        $item_id= $item_id == 3 ? 0 : $item_id+1;
                    endforeach; //endfor
                }
            }

            ?>
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
}
?>
<?if (!empty($arResult['DESCRIPTION'])) :?>
<div class="section-description">
    <?
    echo $arResult['DESCRIPTION'];
    ?>
</div>
<?endif;?>