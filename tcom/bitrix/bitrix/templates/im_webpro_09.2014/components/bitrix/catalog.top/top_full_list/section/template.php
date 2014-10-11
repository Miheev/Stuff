<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var string $strElementEdit */
/** @var string $strElementDelete */
/** @var array $arElementDeleteParams */
/** @var array $arSkuTemplate */
/** @var array $templateData */
global $APPLICATION;
CModule::IncludeModule("iblock");

$item_id= 0;
$item_count= count($arResult['ITEMS']) - 1;
?>
<div class="product-list clearfix">
        <h1>Популярные товары</h1>
        <? foreach ($arResult['ITEMS'] as $key => $arItem) : //$arItem['DETAIL_PAGE_URL'];

            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
            $strMainID = $this->GetEditAreaId($arItem['ID']);

            $arItemIDs = array(
                'ID' => $strMainID,
                'PICT' => $strMainID . '_pict',
                'SECOND_PICT' => $strMainID . '_secondpict',
                'MAIN_PROPS' => $strMainID . '_main_props',

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
                'BASKET_PROP_DIV' => $strMainID . '_basket_prop'
            );

            $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
            $strTitle = (
            isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                : $arItem['NAME']
            );

            if ($item_id % 4 == 0)
                echo '<div class="list-row clearfix">';
            if ($item_id % 2 == 0) {
                    echo '<div class="row">';
            }
            ?>
            <div class="stuff-item <?php echo($item_id % 4 == 2 ? 'first' : ''); ?>">
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
                        $tmp= explode(' ',$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']); //PRINT_VALUE
                        if (!empty($tmp) && count($tmp) > 1) {
                            $count= count($tmp)-1;
                                $str='';
                            for ($i=0; $i < $count; $i++)
                                $str.= ' '.$tmp[$i];
                            echo ltrim($str) . ' <span>'.$tmp[$count].'</span>';
                        }
                        ?> </p>
                </div>
            </div>

            <?
            if ($item_id % 2 || $key == $item_count) {
                echo '</div>';
            }
            if ($item_id % 4 == 3 || $key == $item_count) {
                echo '</div>';
            }

            $item_id= $item_id == 3 ? 0 : $item_id+1;
        endforeach; ?>
</div>
