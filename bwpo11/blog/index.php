<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if(isset($_REQUEST["SECTION_ID"]) && !empty($_REQUEST["SECTION_ID"])) {
    $APPLICATION->SetTitle("Категория блога");
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "blog_section_page",
        Array(
            "2" => "SECTION_ID",
            "3" => "3",
            "IBLOCK_TYPE" => "article",
            "IBLOCK_ID" => "3",
            "NEWS_COUNT" => "20",
            "SORT_BY1" => "",
            "SORT_ORDER1" => "",
            "SORT_BY2" => "",
            "SORT_ORDER2" => "",
            "FILTER_NAME" => "",
            "FIELD_CODE" => array("NAME","TAGS","PREVIEW_TEXT","DATE_CREATE",""),
            "PROPERTY_CODE" => array("",""),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => $_REQUEST["SECTION_ID"],
            "INCLUDE_SUBSECTIONS" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Новости",
            "PAGER_SHOW_ALWAYS" => "Y",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y"
        )
    );
}
elseif (isset($_REQUEST["ELEMENT_ID"]) && !empty($_REQUEST["ELEMENT_ID"])) {

$APPLICATION->SetTitle("");

$APPLICATION->IncludeComponent("bitrix:news.detail", "blog_more_page", Array(
	"IBLOCK_TYPE" => "article",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "3",	// Код информационного блока
	"ELEMENT_ID" => "",	// ID новости
	"ELEMENT_CODE" => $_REQUEST["ELEMENT_ID"],	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => array(	// Поля
		0 => "NAME",
		1 => "DETAIL_TEXT",
		2 => "DETAIL_PICTURE",
		3 => "DATE_CREATE",
		4 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "",
		1 => "",
	),
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
$APPLICATION->SetPageProperty("title", "Блог");
$APPLICATION->SetPageProperty("keywords", "Блог");
$APPLICATION->SetPageProperty("description", "Блог");
$APPLICATION->SetTitle("Блог");

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "blog_page",
    Array(
        "IBLOCK_TYPE" => "article",
        "IBLOCK_ID" => "3",
        "NEWS_COUNT" => "20",
        "SORT_BY1" => "ID",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "",
        "SORT_ORDER2" => "",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array("NAME","TAGS","PREVIEW_TEXT","DATE_CREATE",""),
        "PROPERTY_CODE" => array("",""),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "PAGER_TEMPLATE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y"
    )
);
}
?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>