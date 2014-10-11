<?CModule::IncludeModule('catalog');
if($res = CCatalogDiscount::GetDiscountProductsList(array(), array(">=DISCOUNT_ID" => 3), false, false, array())){
    while($ob = $res->GetNext()){
        $arDiscountElementID[] = $ob["PRODUCT_ID"];
    }}?>
<? $arrFilter = array("ID" => $arDiscountElementID);
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	"discount_index",
	Array(
		"VIEW_MODE" => "SECTION",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"MESS_BTN_BUY" => "������",
		"MESS_BTN_ADD_TO_BASKET" => "� �������",
		"MESS_BTN_DETAIL" => "���������",
		"MESS_NOT_AVAILABLE" => "��� � �������",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "2",
		"ELEMENT_SORT_FIELD" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "4",
		"LINE_ELEMENT_COUNT" => "4",
		"PROPERTY_CODE" => array("art","weight"),
		"OFFERS_LIMIT" => "4",
		"PRICE_CODE" => array(),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "N"
	)
);?>