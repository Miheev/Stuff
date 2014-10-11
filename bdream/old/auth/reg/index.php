<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$arfields = array(
		"NAME",
		"LAST_NAME",
		"PERSONAL_COUNTRY",
		"PERSONAL_CITY",
		"PERSONAL_BIRTHDAY",
		"PERSONAL_GENDER",
		"PERSONAL_PHONE",
		"UF_WEB",
		"UF_SKYPE",
		"UF_SHOW_LAST_NAME",
		"UF_EN_NAME",
		"UF_EN_LAST_NAME"
		);


$APPLICATION->IncludeComponent("lol:main.register_new","",Array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => $arfields,
		"REQUIRED_FIELDS" => Array(),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/personal/",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => Array(),
		"SEF_FOLDER" => "/",
		"VARIABLE_ALIASES" => Array()
)
);


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>