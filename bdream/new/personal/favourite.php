<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избраные");
?>
<?
global $USER;
if ($USER->IsAuthorized()) {
	$filter = Array("ID"=>$USER->GetID());
	$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), $filter,array("SELECT"=>array("UF_FAVOURIT"))); 
	while ($arUser = $rsUsers->Fetch()) 
	{
	   $favour=$arUser["UF_FAVOURIT"];
	}
if($favour[0]!=""){
$arrFilter=array("ID"=>$favour);
?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"member_favour",
	Array(
		"IBLOCK_TYPE" => "dreams",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT","DETAIL_TEXT","PREVIEW_PICTURE",'DETAIL_PICTURE'),
		"PROPERTY_CODE" => array(0=>"USER",1=>"",),
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
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Мечты",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
<?}else{?> В избранном нет мечт! <?}
}else{?> Просмотр доступен только авторизированым пользователям. Пожалуста, <a href="/auth/" >авторизуйтесь</a> или пройдите процедуру <a href="/auth/reg/" >регистрации</a>. <?}?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>