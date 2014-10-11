<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Воплощение мечты");
?> 
<?
$GLOBALS["arrFilter"] = array();
$GLOBALS["arrFilter"]["PROPERTY_STATE"] = 4;
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"realization", 
	array(
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "1",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "YUOTUBE",
			2 => "DATE_EXECUTED",
			3 => "INDICATOR",
			4 => "vote_count",
			5 => "USER_COMMENTS",
			6 => "EN_NAME",
			7 => "ABOUT_ME",
			8 => "ENGLISH_ABOUT_ME",
			9 => "DESCRIPTION_EXECUTE",
			10 => "ENGLISH_DETAIL_TEXT",
			11 => "USER",
			12 => "rating",
			13 => "ADMIN_DESCRIPT",
			14 => "TURBO_YET",
			15 => "STATE",
			16 => "MONEY_DREAM",
			17 => "vote_sum",
			18 => "TURBO_NEED",
			19 => "SATE",
			20 => "",
		),
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
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y"
	),
	false
);?> 
<div style="clear: both"></div>
 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>