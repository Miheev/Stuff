<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Web-студия полного цикла || Webpro");
$APPLICATION->SetPageProperty("title", "Web-студия полного цикла || Webpro");
$APPLICATION->SetPageProperty("keywords", "Создание и разработка сайтов, дизайн и продвижение сайтов в поисковых системах, контекстная реклама. Веб-студия Webpro - профессиональная веб-студия с обширным спектром предлагаемых услуг.");
$APPLICATION->SetPageProperty("description", "веб студия,web студия,создание сайта,заказать создание сайта,цена,стоимость,сроки, продвижение сайтов, поисковое продвижение сайта, раскрутка сайтов, оптимизация сайтов, продвижение в поисковых системах, продвижение сайтов, контекстная реклама, контекстная реклама google, контекстная реклама yandex, стоимость контекстной рекламы, контекстная реклама цена, бегун контекстная реклама, агентство интернет рекламы, web-дизайн, веб-дизайн, web, веб дизайн интернет сайта, красивый, современный, креативный, оригинальный, стильный, эксклюзивный ,макет заказать");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "area_head_img",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "area_service",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "area_portfolio",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "area_blog",
		"EDIT_TEMPLATE" => ""
	)
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>