<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!$arParams['MAIL_TYPE']) {
	return;
}

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600;
	
$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N";
if($arParams["SET_TITLE"]) {
	$APPLICATION->SetTitle();
}

if ($_POST && strlen($_POST['SUBMIT'])>0) {
	$arResult = $_POST;
	$arResult['ERROR'] = "";
	foreach ($_POST as $key => $value) {
		if (strlen(trim($value))==0 && isset($_POST[$key."_DESC"])) {
			$arResult['ERROR'] .= GetMessage('MAKI_ORDER_HOUSE_ERROR', array("#FIELD#" => $_POST[$key."_DESC"]))."<br />";
		}		
	}
//	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
//	$captcha_code = $_POST["captcha_sid"];
//	$captcha_word = $_POST["captcha_word"];
//	$cpt = new CCaptcha();
//	$captchaPass = COption::GetOptionString("main", "captcha_password", "");
//	if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
//	{
//		if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
//			$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
//	}
//	else
//		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");
	
	$arResult['NOTE'] = "";
	if (strlen($arResult['ERROR'])==0) {	
		CEvent::Send($arParams['MAIL_TYPE'], LANG, $_POST);
		$arResult['NOTE'] .= GetMessage('MAKI_ORDER_HOUSE_NOTE');
	}
}

$arResult["capCode"] =  htmlspecialchars($APPLICATION->CaptchaGetCode());

//if($this->StartResultCache(false, array($USER->GetGroups(), $bUSER_HAVE_ACCESS))) {
	$this->IncludeComponentTemplate();
//}
?>