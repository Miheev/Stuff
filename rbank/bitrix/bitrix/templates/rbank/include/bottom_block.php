<?if (!empty($_POST['EXTRA_STUFF_ID'])) :?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.link.list",
            "base",
            array(
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "support_test_iblock_type",
                "IBLOCK_ID" => "11",
                "LINK_PROPERTY_SID" => "EXTRA_STUFF",
                "ELEMENT_ID" => $_POST["EXTRA_STUFF_ID"],
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER2" => "desc",
                "FILTER_NAME" => "",
                "SECTION_URL" => "/catalog/#SECTION_CODE#/",
                "DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
                "BASKET_URL" => "/personal/cart/",
                "ACTION_VARIABLE" => "action",
                "PRODUCT_ID_VARIABLE" => "id",
                "SECTION_ID_VARIABLE" => "",
                "SET_TITLE" => "N",
                "PAGE_ELEMENT_COUNT" => "30",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PRICE_CODE" => array(
                    0 => "Соглашение для сайта КОЛОНКА 2",
                ),
                "USE_PRICE_COUNT" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "PRICE_VAT_INCLUDE" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "300",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "PAGER_TEMPLATE" => "base",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Товары",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "HIDE_NOT_AVAILABLE" => "N",
                "CONVERT_CURRENCY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => ""
            ),
            false
        );?>
<?elseif (preg_match('/(^catalog)/', $page_class)) :?>
    <div class="slider-container">
        <div class="slider wrapper clearfix">
            <?$APPLICATION->IncludeComponent("bitrix:catalog.viewed.products", "bx_stuff", Array(
                    "LINE_ELEMENT_COUNT" => "5",	// Количество элементов, выводимых в одной строке
                    "TEMPLATE_THEME" => "blue",	// Цветовая тема
                    "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
                    "BASKET_URL" => "/personal/cart",	// URL, ведущий на страницу с корзиной покупателя
                    "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
                    "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
                    "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
                    "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить частично заполненные свойства
                    "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
                    "SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
                    "PRICE_CODE" => array(	// Тип цены
                        0 => "Соглашение для сайта КОЛОНКА 2",
                    ),
                    "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
                    "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
                    "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
                    "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
                    "SHOW_NAME" => "Y",	// Показывать название
                    "SHOW_IMAGE" => "Y",	// Показывать изображение
                    "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
                    "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
                    "PAGE_ELEMENT_COUNT" => "30",	// Количество элементов на странице
                    "SHOW_FROM_SECTION" => "Y",	// Показывать товары из раздела
                    "CACHE_TYPE" => "A",	// Тип кеширования
                    "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                    "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                    "SHOW_PRODUCTS_10" => "N",	// Показывать товары каталога
                    "PROPERTY_CODE_10" => array(	// Свойства для отображения
                        0 => "",
                        1 => "",
                    ),
                    "CART_PROPERTIES_10" => array(	// Свойства для добавления в корзину
                        0 => "",
                        1 => "",
                    ),
                    "ADDITIONAL_PICT_PROP_10" => "MORE_PHOTO",	// Дополнительная картинка
                    "LABEL_PROP_10" => "-",	// Свойство меток товара
                    "SHOW_PRODUCTS_11" => "Y",	// Показывать товары каталога
                    "PROPERTY_CODE_11" => array(	// Свойства для отображения
                        0 => "",
                        1 => "",
                    ),
                    "CART_PROPERTIES_11" => array(	// Свойства для добавления в корзину
                        0 => "",
                        1 => "",
                    ),
                    "ADDITIONAL_PICT_PROP_11" => "MORE_PHOTO",	// Дополнительная картинка
                    "LABEL_PROP_11" => "-",	// Свойство меток товара
                    "HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
                    "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
                    "IBLOCK_ID" => "11",	// ID инфоблока
                    "SECTION_ID" => $_POST['CUR_SECTION'],	// ID раздела
                    "SECTION_CODE" => "",	// Код раздела
                ),
                false
            );?>
        </div>
    </div>
<?elseif (preg_match('/(^search)|(^personal)/', $page_class)) :?>
<div class="slider-container">
    <div class="slider wrapper clearfix">
        <?$APPLICATION->IncludeComponent("bitrix:catalog.viewed.products", "bx_simple_stuff", Array(
        "LINE_ELEMENT_COUNT" => "5",	// Количество элементов, выводимых в одной строке
        "TEMPLATE_THEME" => "blue",	// Цветовая тема
        "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
        "BASKET_URL" => "/personal/cart",	// URL, ведущий на страницу с корзиной покупателя
        "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
        "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
        "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
        "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить частично заполненные свойства
        "SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
        "SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
        "PRICE_CODE" => array(	// Тип цены
        0 => "Соглашение для сайта КОЛОНКА 2",
        ),
        "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
        "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
        "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
        "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
        "SHOW_NAME" => "Y",	// Показывать название
        "SHOW_IMAGE" => "Y",	// Показывать изображение
        "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
        "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
        "PAGE_ELEMENT_COUNT" => "10",	// Количество элементов на странице
        "SHOW_FROM_SECTION" => "Y",	// Показывать товары из раздела
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "SHOW_PRODUCTS_10" => "N",	// Показывать товары каталога
        "PROPERTY_CODE_10" => array(	// Свойства для отображения
        0 => "",
        1 => "",
        ),
        "CART_PROPERTIES_10" => array(	// Свойства для добавления в корзину
        0 => "",
        1 => "",
        ),
        "ADDITIONAL_PICT_PROP_10" => "MORE_PHOTO",	// Дополнительная картинка
        "LABEL_PROP_10" => "-",	// Свойство меток товара
        "SHOW_PRODUCTS_11" => "Y",	// Показывать товары каталога
        "PROPERTY_CODE_11" => array(	// Свойства для отображения
        0 => "",
        1 => "",
        ),
        "CART_PROPERTIES_11" => array(	// Свойства для добавления в корзину
        0 => "",
        1 => "",
        ),
        "ADDITIONAL_PICT_PROP_11" => "MORE_PHOTO",	// Дополнительная картинка
        "LABEL_PROP_11" => "-",	// Свойство меток товара
        "HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
        "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
        "IBLOCK_ID" => "11",	// ID инфоблока
        "SECTION_ID" => $_POST['CUR_SECTION'],	// ID раздела
        "SECTION_CODE" => "",	// Код раздела
        ),
        false
        );?>
    </div>
</div>
<?endif;?>