<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");
?>
<div class="width-list">
<?$APPLICATION->IncludeComponent(
	"bx:bitrix.getproductinfo",
	"std_getproductinfo",
	Array(
		"SEF_MODE" => "N",
		"VARIABLE_ALIASES" => Array("page"=>"page"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400",
		"SET_TITLE" => "Y",
		"SET_KEYWORDS" => "Y",
		"PAGES" => array("list","bsm","intranet","mobile","bitrix24","solutions"),
		"PARTNER_ID" => "991292"
	)
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>