<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.section", "linked_stuff", Array(
	"AJAX_MODE" => $arParams["AJAX_MODE"],
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
	"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
	"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
	"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
	"FILTER_NAME" => $arParams["FILTER_NAME"],
	"SECTION_URL" => $arParams["SECTION_URL"],
	"DETAIL_URL" => $arParams["DETAIL_URL"],
	"BASKET_URL" => $arParams["BASKET_URL"],
	"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
	"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
	"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
	"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_FILTER" => $arParams["CACHE_FILTER"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"SET_TITLE" => $arParams["SET_TITLE"],
	"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
	"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
	"PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
	"PRICE_CODE" => $arParams["PRICE_CODE"],
	"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
	"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
	"BY_LINK"=>"Y",
	"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
	"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
	"PAGER_TITLE" => $arParams["PAGER_TITLE"],
	"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
	"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
	"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
	"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
	"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
	"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
	"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
	"CURRENCY_ID" => $arParams["CURRENCY_ID"],
	"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
),
$component);
?>