<?
/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CUserTypeManager $USER_FIELD_MANAGER
 * @param array $arParams
 * @param CBitrixComponent $this
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
CModule::IncludeModule("iblock");
$USER_ID= CUser::GetID();
$USER_INFO_M=CUser::GetByID($USER_ID);	
$USER_INFO = $USER_INFO_M->Fetch();
?><pre><? //print_r($USER_INFO); ?></pre><?

$dbAccountCurrency = CSaleUserAccount::GetList(
        array(),
        array("USER_ID" => $USER_ID),
        false,
        false,
        array("CURRENT_BUDGET", "CURRENCY")
    );
while ($arAccountCurrency = $dbAccountCurrency->Fetch())
{
    $money .= SaleFormatCurrency($arAccountCurrency["CURRENT_BUDGET"],
                            $arAccountCurrency["CURRENCY"])."<br>";
}
$dream_id = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => "2" , "ACTIVE" => "Y", "PROPERTY_USER" => $USER_ID ), false, Array("nPageSize"=>1), Array("ID"));
$dream_element = $dream_id->GetNextElement();	
if ($dream_element != "") {$dream_count=1;} else {$dream_count=0;}
$arResult = Array (
	"USER_NAME"=>$USER_INFO["NAME"],
	"USER_LAST_NAME"=>$USER_INFO["LAST_NAME"],
	"USER_WEB"=>$USER_INFO["UF_WEB"],
	"USER_PHOTO" => $USER_INFO["PERSONAL_PHOTO"],
	"USER_PERSONAL_CITY"=>$USER_INFO["PERSONAL_CITY"],
	"USER_PERSONAL_COUNTRY"=>$USER_INFO["PERSONAL_COUNTRY"],
	"USER_PERSONAL_BIRTHDAY"=>$USER_INFO["PERSONAL_BIRTHDAY"],
	"ABOUT" => $USER_INFO["UF_ABOUT"],
	"DREAM_COUNT" => $dream_count,
	"MONEY"=> $money,
);

	
$this->IncludeComponentTemplate();
