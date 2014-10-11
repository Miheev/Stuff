<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "ООО Торговый дом \"Эксперт\"");
$APPLICATION->SetPageProperty("description", "гидро паро тепло");
$APPLICATION->SetPageProperty("keywords", "гидро паро тепло");
$APPLICATION->SetTitle("ООО Торговый дом \"Эксперт\"");
?><?$APPLICATION->IncludeComponent(
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
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => "30",
        "LINE_ELEMENT_COUNT" => "5",
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
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>