<div id="usl-block-6">
    <div class="width-list">
        <div class="form-zakaz form1">
            <div class="form-name">Заказать бесплатный расчёт стоимости сайта</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "std_composit",
                Array(
                    "WEB_FORM_ID" => "5",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "USE_EXTENDED_ERRORS" => "N",
                    "SEF_MODE" => "N",
                    "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "LIST_URL" => "/blagodarnost/blagodarnost4.php",
                    "EDIT_URL" => "result_edit.php",
                    "SUCCESS_URL" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "CHAIN_ITEM_LINK" => ""
                )
            );?>
        </div>
    </div>
</div>