<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (isset($_REQUEST["ELEMENT_CODE"]) && !empty($_REQUEST["ELEMENT_CODE"])) {
$APPLICATION->SetTitle("");
$APPLICATION->IncludeComponent("bitrix:news.detail", "portfolio_more", Array(
	"IBLOCK_TYPE" => "portfolio",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "2",	// Код информационного блока
	"ELEMENT_ID" => '',	// ID новости
	"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
    "PROPERTY_CODE" => array("ext_field",""),
	"IBLOCK_URL" => "",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
	"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
	"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
	"ACTIVE_DATE_FORMAT" => "",	// Формат показа даты
	"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить детальное изображение
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"USE_SHARE" => "N",	// Отображать панель соц. закладок
	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Страница",	// Название категорий
	"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
	),
	false
);

} else {

$APPLICATION->SetPageProperty("title", "Портфолио");
$APPLICATION->SetPageProperty("keywords", "Портфолио");
$APPLICATION->SetPageProperty("description", "Портфолио");
$APPLICATION->SetTitle("Портфолио");
$APPLICATION->IncludeComponent("bitrix:catalog.section", "portfolio_page", Array(
        "IBLOCK_TYPE" => "portfolio",	// Тип инфоблока
        "IBLOCK_ID" => "2",	// Инфоблок
        "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
        "SECTION_CODE" => "",	// Код раздела
        "SECTION_USER_FIELDS" => array(	// Свойства раздела
            0 => "",
            1 => "",
        ),
        "ELEMENT_SORT_FIELD" => "",	// По какому полю сортируем элементы
        "ELEMENT_SORT_ORDER" => "",	// Порядок сортировки элементов
        "ELEMENT_SORT_FIELD2" => "",	// Поле для второй сортировки элементов
        "ELEMENT_SORT_ORDER2" => "",	// Порядок второй сортировки элементов
        "FILTER_NAME" => "arrFilter",	// Имя массива со значениями фильтра для фильтрации элементов
        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
        "SHOW_ALL_WO_SECTION" => "N",	// Показывать все элементы, если не указан раздел
        "PAGE_ELEMENT_COUNT" => "12",	// Количество элементов на странице
        "LINE_ELEMENT_COUNT" => "3",	// Количество элементов выводимых в одной строке таблицы
        "PROPERTY_CODE" => array(	// Свойства
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",	// Максимальное количество предложений для показа (0 - все)
        "TEMPLATE_THEME" => "",	// Цветовая тема
        "MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",	// Текст кнопки "Уведомить о поступлении"
        "MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
        "MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
        "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
        "DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
        "SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
        "META_KEYWORDS" => "",	// Установить ключевые слова страницы из свойства
        "SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
        "META_DESCRIPTION" => "",	// Установить описание страницы из свойства
        "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
        "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
        "PRICE_CODE" => "",	// Тип цены
        "USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
        "SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
        "PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
        "BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
        "ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
        "PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
        "USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
        "PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
        "PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
        "PRODUCT_PROPERTIES" => "",	// Характеристики товара
        "PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
        "PAGER_TITLE" => "Товары",	// Название категорий
        "PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
        "ADD_PICT_PROP" => "-",	// Дополнительная картинка основного товара
        "LABEL_PROP" => "-",	// Свойство меток товара
    ),
    false
);
}
?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>