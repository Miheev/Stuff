<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (isset($_REQUEST["ELEMENT_ID"]) && !empty($_REQUEST["ELEMENT_ID"])) {

    $APPLICATION->SetTitle("");

    $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "blog_more_page",
        Array(
            "IBLOCK_TYPE" => "article",
            "IBLOCK_ID" => "3",
            "ELEMENT_ID" => "",
            "ELEMENT_CODE" => $_REQUEST["ELEMENT_ID"],
            "CHECK_DATES" => "Y",
            "FIELD_CODE" => array(	// Поля
                0 => "NAME",
                1 => "DETAIL_TEXT",
                2 => "DETAIL_PICTURE",
                3 => "DATE_CREATE",
                4 => "",
            ),
            "PROPERTY_CODE" => array("",""),
            "IBLOCK_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "META_KEYWORDS" => "-",
            "META_DESCRIPTION" => "-",
            "BROWSER_TITLE" => "-",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_ELEMENT_CHAIN" => "N",
            "ACTIVE_DATE_FORMAT" => "",
            "USE_PERMISSIONS" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "USE_SHARE" => "N",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Страница",
            "PAGER_SHOW_ALL" => "Y"
        )
    );
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.comments",
        "article_std",
        Array(
            "IBLOCK_TYPE" => "article",
            "IBLOCK_ID" => "3",
            "ELEMENT_ID" => "",
            "ELEMENT_CODE" => $_REQUEST["ELEMENT_ID"],
            "URL_TO_COMMENT" => "",
            "WIDTH" => "",
            "COMMENTS_COUNT" => "5",
            "TEMPLATE_THEME" => "green",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "0",
            "BLOG_USE" => "Y",
            "FB_USE" => "N",
            "VK_USE" => "N",
            "BLOG_TITLE" => "Комментарии",
            "BLOG_URL" => "design_blog",
            "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
            "EMAIL_NOTIFY" => "N",
            "SHOW_SPAM" => "Y",
            "SHOW_RATING" => "N"
        )
    );
} else {
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
            "PARENT_SECTION" => 2,
            "PARENT_SECTION_CODE" => '',
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