<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
?>
<div class="bx_section">
    <input type="hidden" name="showProps" id="showProps" value="N" />
	<div id="sale_order_props" class="info" <?=($bHideProps && $_POST["showProps"] != "Y")?"style='display:none;'":''?>>
		<?
		PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);

        $arResult["ORDER_PROP"]["USER_PROPS_Y"][1]['TYPE']= 'hidden';
        $arResult["ORDER_PROP"]["USER_PROPS_Y"][2]['TYPE']= 'hidden';
        $arResult["ORDER_PROP"]["USER_PROPS_Y"][6]['TYPE']= 'hidden';
        PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);

//        var_dump($arResult["ORDER_PROP"]["USER_PROPS_N"]);
//        var_dump($arResult["ORDER_PROP"]["USER_PROPS_Y"]);

        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
		?>
	</div>
</div>


<div style="display:none;">
<?
	$APPLICATION->IncludeComponent(
		"bitrix:sale.ajax.locations",
		$arParams["TEMPLATE_LOCATION"],
		array(
			"AJAX_CALL" => "N",
			"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
			"REGION_INPUT_NAME" => "REGION_tmp",
			"CITY_INPUT_NAME" => "tmp",
			"CITY_OUT_LOCATION" => "Y",
			"LOCATION_VALUE" => "",
			"ONCITYCHANGE" => "submitForm()",
		),
		null,
		array('HIDE_ICONS' => 'Y')
	);
?>
</div>