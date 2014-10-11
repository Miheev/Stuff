<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "ООО Торговый дом \"Эксперт\"");
$APPLICATION->SetPageProperty("description", "гидро паро тепло");
$APPLICATION->SetPageProperty("keywords", "гидро паро тепло");
$APPLICATION->SetTitle("ООО Торговый дом \"Эксперт\"");
$APPLICATION->AddChainItem("Сертификаты", '/sertificate');
?>


<?$APPLICATION->IncludeComponent("bitrix:highloadblock.list", "sertif_base", Array(
		"BLOCK_ID" => "3",	// ID инфоблока
		"DETAIL_URL" => "",	// Путь к странице просмотра записи
	),
	false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>