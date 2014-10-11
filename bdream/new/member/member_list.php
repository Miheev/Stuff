<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
$GLOBALS["arrFilter"] = array();

$userFilter = array();
if($_REQUEST["country"])
{
	$countryArray = GetCountryArray();
	$countryArrayKey = array_search($_REQUEST["country"],$countryArray["reference"]);
	if($countryArrayKey)
	{
		$userFilter["PERSONAL_COUNTRY"] = $countryArray["reference_id"][$countryArrayKey];
	}
	else
	{
		$notFind = true;
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
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $userFilter, array("FIELDS"=>array("ID")));
	while($arUsers = $rsUsers->Fetch()):
		$GLOBALS["arrFilter"]["PROPERTY_USER"][] = $arUsers["ID"];
	endwhile;
}
$notFind = false;
if($_REQUEST["country"] || $_REQUEST["city"])
{
	if(count($GLOBALS["arrFilter"]["PROPERTY_USER"])<1)
	{
		$notFind = true;
	}
}



//$GLOBALS["arrFilter"]["!DETAIL_TEXT"] = false;
//$GLOBALS["arrFilter"]["!PROPERTY_STATE"] = array(3,4,5);
$APPLICATION->IncludeComponent("bitrix:news.list", "member_list_ajax", array(
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "8",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(
				0 => "",
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
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
),
		false
);
?>