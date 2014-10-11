<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог | trastcomerc.ru");
$APPLICATION->SetPageProperty("description", "Мы предлагаем широкий ассортимент строительных материалов по адекватным ценам.");
$APPLICATION->SetPageProperty("keywords", "цемент, краски, клей, штукатурка, шпатлевка, гипсокартон, инструменты");
$APPLICATION->AddChainItem('Товары со скидкой', '/catalog/skidki');
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?>

<? CModule::IncludeModule('catalog');
if($res = CCatalogDiscount::GetDiscountProductsList(array(), array(">=DISCOUNT_ID" => 1), false, false, array())){
    while($ob = $res->GetNext()){
        $arDiscountElementID[] = $ob["PRODUCT_ID"];
    }}
?> <?$stuff_discount = array("ID" => $arDiscountElementID);?>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "discount_stuff_all", Array(
        "TEMPLATE_THEME" => "blue",	// Цветовая тема
        "ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
        "LABEL_PROP" => "-",	// Свойство меток товара
        "PRODUCT_SUBSCRIPTION" => "N",	// Разрешить оповещения для отсутствующих товаров
        "SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
        "SHOW_OLD_PRICE" => "N",	// Показывать старую цену
        "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
        "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
        "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "IBLOCK_TYPE" => "catalog",	// Тип инфоблока
        "IBLOCK_ID" => "11",	// Инфоблок
        "SECTION_ID" => "",	// ID раздела
        "SECTION_CODE" => "",	// Код раздела
        "SECTION_USER_FIELDS" => "",	// Свойства раздела
        "ELEMENT_SORT_FIELD" => "id",	// По какому полю сортируем элементы
        "ELEMENT_SORT_ORDER" => "desc",	// Порядок сортировки элементов
        "ELEMENT_SORT_FIELD2" => "sort",	// Поле для второй сортировки элементов
        "ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки элементов
        "FILTER_NAME" => "stuff_discount",	// Имя массива со значениями фильтра для фильтрации элементов
        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
        "SHOW_ALL_WO_SECTION" => "Y",	// Показывать все элементы, если не указан раздел
        "SECTION_URL" => "/catalog.php?SECTION_ID=#SECTION_ID#",	// URL, ведущий на страницу с содержимым раздела
        "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
        "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
        "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
        "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
        "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
        "PAGE_ELEMENT_COUNT" => "30",	// Количество элементов на странице
        "LINE_ELEMENT_COUNT" => "5",	// Количество элементов выводимых в одной строке таблицы
        "PROPERTY_CODE" => "",	// Свойства
        "OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
        "PRICE_CODE" => array(0=>"Соглашение для сайта КОЛОНКА 2"),	// Тип цены
        "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
        "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
        "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
        "BASKET_URL" => "/personal/order",	// URL, ведущий на страницу с корзиной покупателя
        "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
        "PRODUCT_ID_VARIABLE" => "ELEMENT_ID",	// Название переменной, в которой передается код товара для покупки
        "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
        "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
        "PRODUCT_PROPERTIES" => "",	// Характеристики товара
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
        "PAGER_TITLE" => "Товары",	// Название категорий
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "HIDE_NOT_AVAILABLE" => "N",	// Не отображать товары, которых нет на складах
        "CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
    ),
    false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>