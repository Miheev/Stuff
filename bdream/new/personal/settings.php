<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Настройки");
$APPLICATION->SetPageProperty("keywords", "Настройки");
$APPLICATION->SetPageProperty("description", "Настройки");
$APPLICATION->SetTitle("Настройки");
?> <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"profile_menu",
	Array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => ""
	)
);?>
 <?$APPLICATION->IncludeComponent(
	"webpro:settings.profile",
	"settings",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(0=>"UF_VALUTA",),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => "",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?> 

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>