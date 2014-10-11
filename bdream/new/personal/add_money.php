<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пополнение счёта");?>
<?
global $USER;
if($USER->IsAuthorized())
{
CModule::IncludeModule("sale");
$dbAccountCurrency = CSaleUserAccount::GetList(
        array(),
        array("USER_ID" => $USER->GetID())    
    );
	
	if($arAccountCurrency = $dbAccountCurrency->Fetch())
	{
		
		$APPLICATION->IncludeComponent("lol:sale.account.pay_string","",Array(
			"PATH_TO_BASKET" => "/personal/cart/",
			"REDIRECT_TO_CURRENT_PAGE" => "/personal/cart/",
			"SELL_AMOUNT" => Array("1", "2", "3", "4"),
			"SELL_CURRENCY" => $arAccountCurrency["CURRENCY"],
			"VAR" => "buyMoney",
			"CALLBACK_NAME" => "PayUserAccountDeliveryOrderCallback",
			"SET_TITLE" => "Y"
				)
		);

	}
}	
else
{
	localRedirect("/auth/");
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>