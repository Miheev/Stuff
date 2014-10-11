<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<br />
<?endif?>
<?if($arParams["USE_FILTER"]=="Y"):?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:catalog.filter",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	),
	$component
);
*/?>
<br />
<?endif;
$GLOBALS["arrFilter"] = array();
$GLOBALS["arrFilter"][">PROPERTY_TURBO_NEED"] = 0;
$userFilter = array();


if($_POST["country"])
{
	$countryArray = GetCountryArray();
	$countryArrayKey = array_search($_POST["country"],$countryArray["reference"]);
	if($countryArrayKey)
	{
		$userFilter["PERSONAL_COUNTRY"] = $countryArray["reference_id"][$countryArrayKey];
	}
}	

if($_POST["city"])
{
	$userFilter["PERSONAL_CITY"] = $_POST["city"];
}
if($_POST["name"])
{
	$userFilter["NAME"] = trim($_POST["name"]);
}
if($_POST["last_name"])
{
	$userFilter["LAST_NAME"] = trim($_POST["last_name"]);
}
if($_REQUEST["dream_datail"])
{
	$GLOBALS["arrFilter"]["DETAIL_TEXT"] = "%".$_POST["dream_datail"]."%";
}
if($_POST["indicator"])
{
	$GLOBALS["arrFilter"]["PROPERTY_INDICATOR"] = intval($_POST["indicator"]);
}
if(count($userFilter)>0)
{
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $userFilter, array("FIELDS"=>array("ID")));
	while($arUsers = $rsUsers->Fetch()):
	$GLOBALS["arrFilter"]["PROPERTY_USER"][] = $arUsers["ID"];
	endwhile;
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$arParams["SORT_BY1"],
		"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	"Y",
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
	),
	$component
);?>
<div class="turboFilterWrap">
	<span>Поиск</span>
	<form action="" class="filterForm">
		<?foreach ($arResult["ACTIONS"] as $actions):?>
			<label><input style type="checkbox" <?if(in_array($actions["INFO"]['ID'], $_POST["filter_actions"])):?> checked<?endif;?> name="filter_actions[]" value="<?=$actions["INFO"]['ID'];?>"> <?=$actions["INFO"]["NAME"]?></label><br>
		<?endforeach;?>
		<br>
		<input type="text" name="country" id="country" placeholder="<?=GetMessage("COUNTRY");?>" value="<?=htmlspecialcharsEx($_POST["country"]);?>">
		<input type="text" name="city" id="city" placeholder="<?=GetMessage("CITY");?>" value="<?=htmlspecialcharsEx($_POST["city"]);?>">
		<input type="text" name="name"  placeholder="<?=GetMessage("NAME");?>" value="<?=htmlspecialcharsEx($_POST["name"]);?>">
		<input type="text" name="last_name"  placeholder="<?=GetMessage("SECOND_NAME");?>" value="<?=htmlspecialcharsEx($_POST["last_name"]);?>">
		<input type="text" name="dream_datail"  placeholder="<?=GetMessage("DREAM");?>" value="<?=htmlspecialcharsEx($_POST["dream_datail"]);?>">
		<input type="text" name="indicator"  placeholder="<?=GetMessage("INDICATOR");?>" value="<?=htmlspecialcharsEx($_POST["indicator"]);?>">
		<input type="hidden" name="SET_FILTER" value="Y">
		<input type="submit" value="<?=GetMessage("SEARCH");?>">
		<?if($_POST["SET_FILTER"]):?>
			&nbsp;<a href="/turbo_dreams/"><?=GetMessage("UNSET");?></a>
		<?endif;?>
	</form>
</div>
<div style="clear: both"></div>
<? 
	/*if(CModule::IncludeModule("sale"))
	{
		$arCity = array();
		$db_vars = CSaleLocation::GetList(
				array("CITY_NAME" => "ASC"),
				array("LID" => LANGUAGE_ID),
				false,
				false,
				array()
		);

		while($vars = $db_vars->Fetch()):
		
			$arCity[] = $vars["CITY_NAME"];
			$arCountry[] = $vars["COUNTRY_NAME"];
		endwhile;
		$arCity = array_values(array_unique(array_diff($arCity, array(''))));
		$arCountry = array_values(array_unique(array_diff($arCountry, array(''))));
	}
	*/
	
?>
<script>

$(function() {
	 
	 $("#country").autocomplete({
			 source: function( request, response ) {
			        $.get("/personal/ajax_location.php",
					    {search:request.term, type:"country"},
					    function( data ) {
					        	  response(data);
					    },
			        	"json"
			        )
			 }
	});
	 $("#city").autocomplete({
		 source: function( request, response ) {
		        $.get("/personal/ajax_location.php",
				    {search:request.term, type:"city"},
				    function( data ) {
				        	  response(data);
				    },
		        	"json"
		        )
		 }
	});
});
</script>