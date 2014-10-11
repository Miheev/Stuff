<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Компания ООО Торговый дом Эксперт предлагает для покупателей широкий выбор товаров для стройки отделки и обычного бытового ремонта. Мы предлагаем нашим покупателям широкий ассортимент гибкие индивидуальные скидки и доставку товара прямо к месту проведения технических работ.");
$APPLICATION->SetPageProperty("keywords", "строительные материалы, строительные материалы купить москва, строительные материалы купить недорого");
$APPLICATION->SetTitle("ООО Торговый дом \"Эксперт\"");
?><!-- 
<div class="MainRightColumnCommodity"> 						 
  <div class="MainRightColumnCommodity_First"> 							 
    <div class="MainRightColumnCommodityImg_1"></div>
   							 
    <div class="MainRightColumnCommodityContent"> 
      <div class="RightColumnCommodityContent"><a href="http://siteone.center-sites.ru/catalog.php" >Каталог 
          <br />
         (в наличии)</a></div>
     </div>
   						</div>
 						 
  <div class="MainRightColumnCommodity_"> 							 
    <div class="MainRightColumnCommodityImg_2"></div>
   							 
    <div class="MainRightColumnCommodityContent"> 
      <div class="RightColumnCommodityContent"><a href="http://siteone.center-sites.ru/page1.php" >Каталог 
          <br />
         (весь товар)</a></div>
     </div>
   						</div>
 						 
  <div class="MainRightColumnCommodity_"> 							 
    <div class="MainRightColumnCommodityImg_3"></div>
   							 
    <div class="MainRightColumnCommodityContent"> 
      <div class="RightColumnCommodityContent"><a href="#" >Название 
          <br />
         товара</a></div>
     </div>
   						</div>
 					</div>
 -->
<div class="RightColumnNewProducts"> 
  <h2> </h2>
 
  <h2>Новые товары</h2>
 </div>
 <? $GLOBALS['bottomFilter'] = array("!PROPERTY_103" => false); ?> <?$APPLICATION->IncludeComponent("bitrix:catalog.section", "template2", array(
	"IBLOCK_TYPE" => "support_test_iblock_type",
	"IBLOCK_ID" => "11",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "RAND",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD2" => "name",
	"ELEMENT_SORT_ORDER2" => "asc",
	"FILTER_NAME" => "bottomFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"HIDE_NOT_AVAILABLE" => "Y",
	"PAGE_ELEMENT_COUNT" => "6",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_LIMIT" => "5",
	"TEMPLATE_THEME" => "blue",
	"ADD_PICT_PROP" => "-",
	"LABEL_PROP" => "-",
	"PRODUCT_SUBSCRIPTION" => "N",
	"SHOW_DISCOUNT_PERCENT" => "N",
	"SHOW_OLD_PRICE" => "N",
	"MESS_BTN_BUY" => "Купить",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_SUBSCRIBE" => "Подписаться",
	"MESS_BTN_DETAIL" => "Подробнее",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"SECTION_URL" => "/catalog.php?SECTION_ID=#SECTION_ID#",
	"DETAIL_URL" => "/catalog.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"SET_META_KEYWORDS" => "N",
	"META_KEYWORDS" => "-",
	"SET_META_DESCRIPTION" => "N",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "Соглашение для сайта КОЛОНКА 2",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"CONVERT_CURRENCY" => "N",
	"BASKET_URL" => "/personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"USE_PRODUCT_QUANTITY" => "Y",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"PAGER_TEMPLATE" => ".default",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>