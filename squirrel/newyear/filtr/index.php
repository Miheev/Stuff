<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фильтр");
?> 
<script>
<? /* ?>
$(function() {
$( "#slider-range" ).slider({
  range: true,
  min: 0,
  max: 500,
  values: [ 75, 300 ],
  slide: function( event, ui ) {
    // $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    $( "#myFilter_cf_1_LEFT" ).val( ui.values[ 0 ] );
    $( "#myFilter_cf_1_RIGHT" ).val( ui.values[ 1 ] );
    }
  });
  $( "#myFilter_cf_1_LEFT" ).val( ui.values[ 0 ] );
  $( "#myFilter_cf_1_RIGHT" ).val( ui.values[ 1 ] );
  // $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});
<? */ ?>
</script>
<?
global ${myFilter};
//echo "1111<pre>"; print_r(myFilter); echo "</pre>2222";
?>

<?$APPLICATION->IncludeComponent("castlerock:castlerock.catalog.filter", "filtr", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "6",
	"FILTER_NAME" => "myFilter",
	"FIELD_CODE" => array(
		0 => "SECTION_ID",
	),
	"PROPERTY_CODE" => array(
		0 => "weight",
	),
	"LIST_HEIGHT" => "5",
	"TEXT_WIDTH" => "20",
	"NUMBER_WIDTH" => "5",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "600",
	"CACHE_GROUPS" => "N",
	"SAVE_IN_SESSION" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	)
	),
	$component
);?> 
<div class="list-selection-element">
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "elements", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "6",
	"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "",
	"ELEMENT_SORT_ORDER" => "",
	"FILTER_NAME" => "myFilter",
	"INCLUDE_SUBSECTIONS" => "N",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "24",
	"LINE_ELEMENT_COUNT" => "6",
	"PROPERTY_CODE" => array(
		0 => "art",
		1 => "weight",
		2 => "",
	),
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"BASKET_URL" => $arParams["BASKET_URL"],
	"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
	"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => "N",
	"META_KEYWORDS" => "",
	"META_DESCRIPTION" => "",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "Y",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новогодние подарки 2014",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "6000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	$component
);
?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>