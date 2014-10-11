<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новогодние Подарки 2015");
$APPLICATION->SetPageProperty("description", "Новогодние подарки – это то, что сможет порадовать любого человека. Новый 2014 год – это время чудес и, конечно же, подарков");
$APPLICATION->SetPageProperty("keywords", "новогодние подарки, новогодние подарки 2015, оригинальные новогодние подарки, сладкие подарки, новый год, подарки,новогодние");
?>
<?php
// Здесь мы обновляем свойство "Napomnitb" у товара
if ($_POST["actionADD2REMINDER"] == "Напомнить" and $_POST["action"] != "")
{
    // Получаем значение свойства элемента
    $db_props = CIBlockElement::GetProperty($_POST["IBLOCK_ID"], $_POST["id"], array("sort" => "asc"), Array("CODE"=>"remind"));

    $value = "";
    $log = 0;
    if($ar_props = $db_props->Fetch())
    {
        $value = $ar_props["VALUE"]["TEXT"];
        $log = 1;
    }

    if ($log != 0)
    {
        $value = $value.$_POST["action"]."||";
    }

    CIBlockElement::SetPropertyValues($_POST["id"], $_POST["IBLOCK_ID"], array("VALUE"=>array("TEXT"=>$value, "TYPE"=>"html")), "remind");
    $sep='';
    if (preg_match('/\?/', $_SERVER['HTTP_REFERER']))
        $sep='&';
    else
        $sep='?';
    header('Location: '.$_SERVER['HTTP_REFERER'].$sep.'remind_stat=success');
}

$same_stuff= array('!ID'=>$_GET['ELEMENT_ID']);
?>
<?$APPLICATION->IncludeComponent("bitrix:catalog", "RUST", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "6",
	"BASKET_URL" => "/personal/basket.php",
        'PRODUCT_SUBSCRIPTION' => 'Y',
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/newyear/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "N",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "Y",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "N",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "myFilter",
	"FILTER_FIELD_CODE" => array(
		0 => "",
		1 => "SECTION_ID",
		2 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "weight",
		1 => "",
	),
	"FILTER_PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_COMPARE" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"SHOW_TOP_ELEMENTS" => "N",
	"PAGE_ELEMENT_COUNT" => "30",
	"LINE_ELEMENT_COUNT" => "3",
	"ELEMENT_SORT_FIELD" => "shows",
	"ELEMENT_SORT_ORDER" => "desc",
	"LIST_PROPERTY_CODE" => array(
		0 => "art",
		1 => "weight",
		2 => "",
	),
	"INCLUDE_SUBSECTIONS" => "Y",
	"LIST_META_KEYWORDS" => "-",
	"LIST_META_DESCRIPTION" => "-",
	"LIST_BROWSER_TITLE" => "-",
	"DETAIL_PROPERTY_CODE" => array(
		0 => "art",
		1 => "weight",
		2 => "to_stock",
		3 => "remind",
	),
	"DETAIL_META_KEYWORDS" => "-",
	"DETAIL_META_DESCRIPTION" => "-",
	"DETAIL_BROWSER_TITLE" => "-",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"USE_ALSO_BUY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
//        "HIDE_NOT_AVAILABLE" => "N",
//        "ADD_SECTIONS_CHAIN" => "Y",
//        "ADD_ELEMENT_CHAIN" => "N",
//        "USE_ELEMENT_COUNTER" => "Y",
//        "FILTER_VIEW_MODE" => "VERTICAL",
//        "CONVERT_CURRENCY" => "N",
        "USE_PRODUCT_QUANTITY" => "Y",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
//        "PRODUCT_PROPS_VARIABLE" => "prop",
//        "PARTIAL_PRODUCT_PROPERTIES" => "N",
//        "PRODUCT_PROPERTIES" => array(
//        ),
        "SECTION_COUNT_ELEMENTS" => "Y",
        "SECTION_TOP_DEPTH" => "2",
        "SECTIONS_VIEW_MODE" => "LIST",
//        "SECTIONS_SHOW_PARENT_NAME" => "Y",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER2" => "desc",
//        "DETAIL_DISPLAY_NAME" => "Y",
//        "DETAIL_DETAIL_PICTURE_MODE" => "IMG",
//        "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
//        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
//        "USE_STORE" => "N",
//        "TEMPLATE_THEME" => "blue",
//        "ADD_PICT_PROP" => "-",
//        "LABEL_PROP" => "-",
//        "SHOW_DISCOUNT_PERCENT" => "N",
//        "SHOW_OLD_PRICE" => "N",
        "DETAIL_SHOW_MAX_QUANTITY" => "Y",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "Уведомить о поступлении",
//        "MESS_BTN_COMPARE" => "Сравнение",
//        "MESS_BTN_DETAIL" => "Подробнее",
//        "MESS_NOT_AVAILABLE" => "Нет в наличии",
//        "DETAIL_USE_VOTE_RATING" => "N",
//        "DETAIL_USE_COMMENTS" => "N",
//        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"SEF_URL_TEMPLATES" => array(
		"sections" => "",
		"section" => "#SECTION_ID#/",
		"element" => "#SECTION_ID#/#ELEMENT_ID#/",
		"compare" => "compare.php?action=#ACTION_CODE#",
	),
	"VARIABLE_ALIASES" => array(
		"compare" => array(
			"ACTION_CODE" => "action",
		),
	)
	),
	false
);?> 
<div> 
  <br />
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>