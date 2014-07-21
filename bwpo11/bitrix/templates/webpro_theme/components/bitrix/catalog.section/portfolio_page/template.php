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

    $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
    $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
    $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
    ?>
        <div class="width-list">
            <div class="block-name-content">
                <?php
                $tmp= explode(' ', $arResult["NAME"], 2);
                ?>
                <span class="black">Наши</span> <span class="green">работы</span>
            </div>
            <div class="block-name-hr"></div>
                <?
                foreach ($arResult['ITEMS'] as $key => $arItem) {
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
                    ?>
                    <div class="work views-row">
                    <div class="work-in">
                        <img src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" />


                        <div class="work-info">
                            <div class="work-name">

                                <div class="catalog_item_title"><a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
                                                                   title="<? echo $arItem['NAME']; ?>"><? echo $arItem['NAME']; ?></a></div>
                            </div>
                            <div class="work-opis">

                                <div class="views-field views-field-field-opis">
                                    <? echo $arItem['PREVIEW_TEXT']; ?>
                                </div>
                            </div>
                            <div class="work-more">

                                <div class="views-field views-field-view-node"><span class="field-content"><a
                                            href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">Посмотреть</a></span></div>
                            </div>
                        </div>
                    </div></div><?
                }
                ?>

        </div>

<?

}
?>