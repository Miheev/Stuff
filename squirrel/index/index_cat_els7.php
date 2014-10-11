<style>
    .tabs {margin: 100px 0 30px;}
    .tabs ul {text-align: center;}
    .tabs li {display: inline;}
    .tabs li+li {margin-left: 15px;}
    .tabs li a {padding: 20px;}
    .tabs .item {display: none;}
</style>
<div class="tabs">
    <div class="title">
        <ul>
            <li><a href="#">Лидеры продаж</a></li>
            <li><a href="#">Новинки</a></li>
            <li><a href="#">Товары со скидкой</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="item">
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.bestsellers",
                "",
                Array(
                    "LINE_ELEMENT_COUNT" => "4",
                    "TEMPLATE_THEME" => "blue",
                    "BY" => "QUANTITY",
                    "PERIOD" => "120",
                    "FILTER" => array("CANCELED","ALLOW_DELIVERY","PAYED","DEDUCTED"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "86400",
                    "AJAX_MODE" => "N",
                    "DETAIL_URL" => "",
                    "BASKET_URL" => "/personal/basket.php",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PARTIAL_PRODUCT_PROPERTIES" => "Y",
                    "DISPLAY_COMPARE" => "N",
                    "SHOW_OLD_PRICE" => "N",
                    "SHOW_DISCOUNT_PERCENT" => "N",
                    "PRICE_CODE" => array("BASE"),
                    "SHOW_PRICE_COUNT" => "1",
                    "PRODUCT_SUBSCRIPTION" => "N",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "SHOW_NAME" => "Y",
                    "SHOW_IMAGE" => "Y",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                    "PAGE_ELEMENT_COUNT" => "8",
                    "SHOW_PRODUCTS_2" => "Y",
                    "PROPERTY_CODE_2" => array("art","weight"),
                    "CART_PROPERTIES_2" => array(),
                    "LABEL_PROP_2" => "-",
                    "SHOW_PRODUCTS_5" => "Y",
                    "PROPERTY_CODE_5" => array("art","weight"),
                    "CART_PROPERTIES_5" => array(),
                    "LABEL_PROP_5" => "-",
                    "SHOW_PRODUCTS_6" => "Y",
                    "PROPERTY_CODE_6" => array("art","weight"),
                    "CART_PROPERTIES_6" => array(),
                    "LABEL_PROP_6" => "-",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "CONVERT_CURRENCY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N"
                )
            );?>
        </div>
        <div class="item">
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "elements1",
                Array(
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "2",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => "",
                    "SECTION_USER_FIELDS" => array(),
                    "ELEMENT_SORT_FIELD" => "timestamp_x",
                    "ELEMENT_SORT_ORDER" => "desc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "FILTER_NAME" => "arrFilter",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "SHOW_ALL_WO_SECTION" => "Y",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SET_META_KEYWORDS" => "N",
                    "META_KEYWORDS" => "-",
                    "SET_META_DESCRIPTION" => "N",
                    "META_DESCRIPTION" => "-",
                    "BROWSER_TITLE" => "-",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "DISPLAY_COMPARE" => "N",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "PAGE_ELEMENT_COUNT" => "8",
                    "LINE_ELEMENT_COUNT" => "4",
                    "PROPERTY_CODE" => array("art","weight"),
                    "OFFERS_LIMIT" => "5",
                    "PRICE_CODE" => array("BASE"),
                    "USE_PRICE_COUNT" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "BASKET_URL" => "/personal/basket.php",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRODUCT_PROPERTIES" => array(),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Товары",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "CONVERT_CURRENCY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N"
                )
            );?> 
        </div>
        <div class="item">
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "elements1",
                Array(
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "content",
                    "IBLOCK_ID" => "2",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => "",
                    "SECTION_USER_FIELDS" => array(),
                    "ELEMENT_SORT_FIELD" => "discount",
                    "ELEMENT_SORT_ORDER" => "desc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "FILTER_NAME" => "arrFilter",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "SHOW_ALL_WO_SECTION" => "Y",
                    "SECTION_URL" => "",
                    "DETAIL_URL" => "",
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SET_META_KEYWORDS" => "N",
                    "META_KEYWORDS" => "-",
                    "SET_META_DESCRIPTION" => "N",
                    "META_DESCRIPTION" => "-",
                    "BROWSER_TITLE" => "-",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "DISPLAY_COMPARE" => "N",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "PAGE_ELEMENT_COUNT" => "8",
                    "LINE_ELEMENT_COUNT" => "4",
                    "PROPERTY_CODE" => array("art", "weight", "discount"),
                    "OFFERS_LIMIT" => "5",
                    "PRICE_CODE" => array(),
                    "USE_PRICE_COUNT" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "PRICE_VAT_INCLUDE" => "Y",
                    "BASKET_URL" => "/personal/basket.php",
                    "ACTION_VARIABLE" => "action",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRODUCT_PROPERTIES" => array(),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Товары",
                    "PAGER_SHOW_ALWAYS" => "Y",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "Y",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "CONVERT_CURRENCY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N"
                )
            );?>
        </div>
    </div>
<script>
    setTimeout(function tmr_jq(){
        if (typeof jQuery == 'undefined')
            setTimeout(tmr_jq, 300);
        else {
            jQuery(function ($) {
                $(document).ready(function () {
                    $('.tabs .title a').click(function(e){
                        e.preventDefault();

                        id= $('.tabs .title a').index($(this));
                        $('.tabs .content .item').hide('fast', function(){
                            $('.tabs .content .item').eq(id).show();
                        });
                    });
                });
            });
        }
    }, 300);
</script>
</div>   