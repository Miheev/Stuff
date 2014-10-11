
<? 
$GLOBALS["arrFilter"] = array();
$GLOBALS["arrFilter"]["PROPERTY_DREAM"] = $arResult['DREAM_ID'];
if(isset($_REQUEST["filter_actions"]) && count($_REQUEST["filter_actions"])>0)
{
	$GLOBALS["arrFilter"]["PROPERTY_ACTIONS"] = $_REQUEST["filter_actions"];
}
$userFilter = array();
if($_REQUEST["country"])
{
	$countryArray = GetCountryArray();
	$countryArrayKey = array_search($_REQUEST["country"],$countryArray["reference"]);
	if($countryArrayKey)
	{
		$userFilter["PERSONAL_COUNTRY"] = $countryArray["reference_id"][$countryArrayKey];
	}
}
if($_REQUEST["city"])
{
	$userFilter["PERSONAL_CITY"] = $_REQUEST["city"];
}
if($_REQUEST["name"])
{
	$userFilter["NAME"] = trim($_REQUEST["name"]);
}
if($_REQUEST["last_name"])
{
	$userFilter["LAST_NAME"] = trim($_REQUEST["last_name"]);
}

if(count($userFilter)>0)
{
	$arUserID = array();
	$arSelect = Array("ID", "PROPERTY_USER");
	$arFilter = Array("IBLOCK_ID"=>5, "PROPERTY_DREAM"=>$arResult["ITEMS"][0]["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->Fetch())
	{
		$arUserID[$ob["PROPERTY_USER_VALUE"]] = $ob["PROPERTY_USER_VALUE"];
	}
	if(count($arUserID)>0)
	{
		$arUserID = array_values($arUserID);
		$userFilter["ID"] = "";
		for ($i=0; $i<count($arUserID); $i++)
		{
			if($i>0)
			{
				$userFilter["ID"] .= " | ";
			}
			$userFilter["ID"] .= $arUserID[$i];
		}
		
		$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $userFilter, array("FIELDS"=>array("ID")));
		while($arUsers = $rsUsers->Fetch()):
			$GLOBALS["arrFilter"]["PROPERTY_USER"][] = $arUsers["ID"];
		endwhile;
	}

}
?>
			
<?$APPLICATION->IncludeComponent("bitrix:news.list", "comments", array(
	"IBLOCK_TYPE" => "-",
	"IBLOCK_ID" => "5",
	"NEWS_COUNT" => "15",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "DATE_CREATE",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "USER",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"INCLUDE_SUBSECTIONS" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Комментарии",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
		
			
<?/*?>
<div style="clear: both;"></div>
<?
$GLOBALS["arrFilter"] = array();
$GLOBALS["arrFilter"]["PROPERTY_TYPE"] = 8;
$GLOBALS["arrFilter"]["PROPERTY_DREAM"] = $arResult['DREAM_ID'];
$APPLICATION->IncludeComponent("bitrix:news.list", "payments", array(
	"IBLOCK_TYPE" => "service",
	"IBLOCK_ID" => "7",
	"NEWS_COUNT" => "15",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "DATE_CREATE",
		1 => "CREATED_BY",
		2 => "CREATED_USER_NAME",
		3 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "PAY",
		1 => "USER",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"INCLUDE_SUBSECTIONS" => "N",
	"PAGER_TEMPLATE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Платежи",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"DREAM_ID" => $arResult['DREAM_ID']
	),
	false,
	Array('HIDE_ICONS' => 'Y')
);//*/?>