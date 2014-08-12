<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="rightcol rightcolcatalog">
            <?if($arParams["USE_FILTER"]=="Y"):?>
            <div class="right-block-filter">
            <?$APPLICATION->IncludeComponent(
            	"bitrix:catalog.filter",
            	"",
            	Array(
            		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
            		"FILTER_NAME" => $arParams["FILTER_NAME"],
            		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
             		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
            		"PRICE_CODE" => $arParams["FILTER_PRICE_CODE"],
            		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
            		"CACHE_TIME" => $arParams["CACHE_TIME"],
            		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            	),
            	$component
            );
            ?>
            </div>
                <?/*$APPLICATION->IncludeComponent(
                	"bitrix:catalog.section.list",
                	"",
                	Array(
                		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
                		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
                		"CACHE_TIME" => $arParams["CACHE_TIME"],
                		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "TOP_DEPTH" => "1",
                		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]
                	),
                	$component
                );
                */?>
            <br />
<?$APPLICATION->IncludeComponent("bitrix:main.include", "template3", Array(
	"AREA_FILE_SHOW" => "page",	// Показывать включаемую область
		"AREA_FILE_SUFFIX" => "inc",	// Суффикс имени файла включаемой области
		"EDIT_TEMPLATE" => "",	// Шаблон области по умолчанию
	),
	false
);?>
			<?$APPLICATION->IncludeComponent("altop:callback", "house_order", array(
	"EMAIL_TO" => "info@makihouse.ru",
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "TEL",
	),
	"OK_TEXT" => "Спасибо, ваше сообщение принято.",
	"HREF_TEXT" => "Заказать расчет дома",
	"HEAD_TEXT" => "Заказать расчет дома"
	),
	false
);?>
            <?endif?>
		</div>



<!--<table cellpadding="0" cellspacing="0" class="tablecatalog">
    <tr>
	    <td class="centercol centercolcatalog">-->
<div class="centercol centercolcatalog">
        <?if($arParams["USE_FILTER"]=="Y"):?>
          <div style=" display: none">
            <?$APPLICATION->IncludeComponent(
            	"bitrix:catalog.filter",
            	"",
            	Array(
            		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
            		"FILTER_NAME" => $arParams["FILTER_NAME"],
            		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
             		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
            		"PRICE_CODE" => $arParams["FILTER_PRICE_CODE"],
            		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
            		"CACHE_TIME" => $arParams["CACHE_TIME"],
            		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            	),
            	$component
            );
            ?>
          </div>
          <?endif?>


<?$APPLICATION->IncludeComponent(
	"maki:catalogmaki.section",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "SHOW_ALL_WO_SECTION" => "Y",
 		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	),
	$component
);
?>

<?if($arParams["USE_COMPARE"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NAME" => $arParams["COMPARE_NAME"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
	),
	$component
);?>
<br />
<?endif?>


<?if($arParams["SHOW_TOP_ELEMENTS"]!="N"):?>
<hr />
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
		"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	),
$component
);?>
<?endif?>

		</div>

	<!--</tr>
</table>-->