<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?> <?
$GLOBALS["arrFilter"] = array();
//$GLOBALS["arrFilter"][">=PROPERTY_TURBO_NEED"] = 0;
$userFilter = array();

if($_GET["country"]!=""){
	$countryArray = GetCountryArray();
	$countryArrayKey = array_search($_GET["country"],$countryArray["reference"]);
	if($countryArrayKey)
	{
			$filter = Array(
				"NAME"=>"%".trim($_GET["name"])."%",
				"PERSONAL_COUNTRY"=>$countryArray["reference_id"][$countryArrayKey],
				"PERSONAL_CITY" => "%".$_GET["city"]."%",
				"LAST_NAME"=>"%".trim($_GET["last_name"])."%"
			);
			$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
			while ($arP = $rsUsers->Fetch()){
				$id[]=$arP["ID"];		
			}
			$id[]="0";
			$GLOBALS["arrFilter"]["PROPERTY_USER"] = $id;
	}
}	

if($_GET["city"]!=""){
			$filter = Array(
				"NAME"=>"%".trim($_GET["name"])."%",
				"PERSONAL_COUNTRY"=>$countryArray["reference_id"][$countryArrayKey],
				"PERSONAL_CITY" => "%".$_GET["city"]."%",
				"LAST_NAME"=>"%".trim($_GET["last_name"])."%"
			);
			$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
			while ($arP = $rsUsers->Fetch()){
				$id[]=$arP["ID"];		
			}
			$id[]="0";
			$GLOBALS["arrFilter"]["PROPERTY_USER"] = $id;
}

if($_GET["name"]!=""){
			$filter = Array(
				"NAME"=>"%".trim($_GET["name"])."%",
				"PERSONAL_COUNTRY"=>$countryArray["reference_id"][$countryArrayKey],
				"PERSONAL_CITY" => "%".$_GET["city"]."%",
				"LAST_NAME"=>"%".trim($_GET["last_name"])."%"
			);
			$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
			while ($arP = $rsUsers->Fetch()){
				$id[]=$arP["ID"];		
			}
			$id[]="0";
			$GLOBALS["arrFilter"]["PROPERTY_USER"] = $id;
}
if($_GET["last_name"]!="")
{
			$filter = Array(
				"NAME"=>"%".trim($_GET["name"])."%",
				"PERSONAL_COUNTRY"=>$countryArray["reference_id"][$countryArrayKey],
				"PERSONAL_CITY" => "%".$_GET["city"]."%",
				"LAST_NAME"=>"%".trim($_GET["last_name"])."%"
			);
			$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
			while ($arP = $rsUsers->Fetch()){
				$id[]=$arP["ID"];		
			}
			$id[]="0";
			$GLOBALS["arrFilter"]["PROPERTY_USER"] = $id;
}
if($_REQUEST["dream_datail"]!="")
{
	$GLOBALS["arrFilter"]["NAME"] = "%".$_GET["dream_datail"]."%";
}
if($_GET["indicator_min"]!="" && $_GET["indicator_max"]!="")
{

if($_GET["indicator_min"]==0){ $indicator_min="";}else{$indicator_min=$_GET["indicator_min"];}
if($_GET["indicator_max"]==0){ $indicator_max="";}else{$indicator_max=$_GET["indicator_max"];}
	$GLOBALS["arrFilter"][">=PROPERTY_INDICATOR"] = intval($indicator_min);
	$GLOBALS["arrFilter"]["<=PROPERTY_INDICATOR"] = intval($indicator_max);
}
if($_GET["dream"]!="")
{
	$GLOBALS["arrFilter"]["PROPERTY_STATE"] = $_GET["dream"];
}
if(count($userFilter)>0)
{
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $userFilter, array("FIELDS"=>array("ID")));
	while($arUsers = $rsUsers->Fetch()):
	$GLOBALS["arrFilter"]["PROPERTY_USER"][] = $arUsers["ID"];
	endwhile;
}
if($_GET["sorting"]=="week")
{

$current_week_start = date("d.m.Y",strtotime("last Monday"));
$current_week_end = date("d.m.Y",strtotime("Sunday"));
	$GLOBALS["arrFilter"][">DATE_CREATE"]=$current_week_start;
	$GLOBALS["arrFilter"]["<DATE_CREATE"]=$current_week_end;

}else if($_GET["sorting"]=="popular"){
	$sort="SHOW_COUNTER";
	$ord="desc";
}else if($_GET["sorting"]=="voting"){
	$GLOBALS["arrFilter"]["PROPERTY_STATE"]=3;
	$GLOBALS["arrFilter"][">=PROPERTY_INDICATOR"] = "";
	$GLOBALS["arrFilter"]["<=PROPERTY_INDICATOR"] = "100";

}else if($_GET["sorting"]=="all" || $_GET["sorting"]==""){

}
$_SESSION["arrFilter"]=$GLOBALS["arrFilter"];
//echo "<pre>";print_r($GLOBALS["arrFilter"]);echo "</pre>";

?> <?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"dreams_list",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "dreams",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "15",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"SORT_BY1" => $sort,
		"SORT_ORDER1" => $ord,
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(),
		"LIST_PROPERTY_CODE" => array("ABOUT_ME", "USER", "USER_GOLOS", "TURBO_YET", "TURBO_NEED"),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "NAME",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(),
		"DETAIL_PROPERTY_CODE" => array("ABOUT_ME", "USER", "TURBO_YET", "TURBO_NEED", "PHOTO"),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => "count",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"FILTER_NAME" => "arrFilter",
		"FILTER_FIELD_CODE" => array(),
		"FILTER_PROPERTY_CODE" => array("YUOTUBE", "DATE_EXECUTED", "INDICATOR", "USER_COMMENTS", "EN_NAME", "ABOUT_ME", "ENGLISH_ABOUT_ME", "DESCRIPTION_EXECUTE", "ENGLISH_DETAIL_TEXT", "USER", "ADMIN_DESCRIPT", "TURBO_YET", "STATE", "MONEY_DREAM", "TURBO_NEED"),
		"SEF_FOLDER" => "/member/",
		"SEF_URL_TEMPLATES" => Array(
			"detail" => "#ELEMENT_ID#/"
		),
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"VARIABLE_ALIASES" => Array(
			"news" => Array(),
			"section" => Array(),
			"detail" => Array(),
		)
	)
);?>