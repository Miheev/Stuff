<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta name='yandex-verification' content='6fbb80d2b2661675' />
<meta name='yandex-verification' content='771cfadc5bd293de' />
<link rel="icon" href="http://www.konditerka.com/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.konditerka.com/favicon.ico" type="image/x-icon" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 7]>
<link rel="stylesheet" href="/css/ie7.css" type="text/css" />
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="/css/ie6.css" type="text/css" />
<![endif]-->
<script type="text/javascript" src="/js/mootools.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</head>
<body id="page-1">
<?$APPLICATION->ShowPanel();?>

<div class="main_block">
	<div class="content_container">
		<!--header -->
		<div id="header">
			<div class="main">
				<div class="menu">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "mainmenu", array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "top",
						"USE_EXT" => "N"
						),
						false
					);?>
				</div>			
				<div class="logo" >
				<span class="the_logo" onclick="window.location='/'"></span>
					<?$APPLICATION->IncludeComponent("bitrix:search.form", "search", array(
						"PAGE" => "#SITE_DIR#search/index.php"
						),
						false
					);?>
				</div>
				<div class="image-center">
					<img src='/images/slideshow/1.jpg' alt="" title="" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<!--header end-->
		<div id="content">
			<div class="main">
				<div class="wrapper">
					<div class="col-1">
						<img class="title" alt="" src='/images/page-1-title1.gif' />
 <div align="center">Новости компании :</div>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "newslist", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "8",
	"NEWS_COUNT" => "4",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "N",
	"DETAIL_URL" => "/news/#ELEMENT_ID#/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

					<a href="/news/" class="link">Все новости компании</a>
					<br /><br />
 <div align="center">Новости сайта :</div>



						<?$APPLICATION->IncludeComponent("bitrix:news.list", "newslist", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "1",
	"NEWS_COUNT" => "5",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "N",
	"DETAIL_URL" => "/news/#ELEMENT_ID#/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

					<a href="/news/" class="link">Все новости</a>
					<br /><br />
	<a href="/article/" >Статьи к новому году</a><br /><br />
        <?$APPLICATION->IncludeComponent("bitrix:news.line", "news_line", Array(
	"IBLOCK_TYPE" => "content",	// Тип информационного блока
	"IBLOCKS" => array(	// Код информационного блока
		0 => "7",
	),
	"NEWS_COUNT" => "3",	// Количество новостей на странице
	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "300",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);?> 
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", ".default", array(
	"REGISTER_URL" => "/reg/",
	"PROFILE_URL" => "/personal/",
	"SHOW_ERRORS" => "Y"
	),
	false
);?> 
					</div>
					<div class="col-2">					
						<div class="padding2 padding1">
							<div class="cols wrapper">
								<div class="col-1 maxheight">
									<div class="title1">
										<img alt="" src='/images/page-4-title2.gif' />
									</div>
									<a href="/newyear/"><img alt="" src='/images/banner1.jpg' /></a>								
								</div>
								<div class="col-2 maxheight">
									<div class="title2">
										<img alt="" src='/images/page-4-title3.gif' />
									</div>
									<a href="/sladkie_podarki/"><img alt="" src='/images/banner2.jpg' /></a>
								</div>
								<div class="col-3 maxheight">
									<div class="title3">
										<img alt="" src='/images/page-4-title4.gif' />
									</div>
									<a href="/catalog/"><img alt="" src="/images/catalog.jpg" /></a>								
								</div>
							</div>
						</div>
						