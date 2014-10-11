<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html>
<head>
<meta name='wmail-verification' content='196e57096dc7d965' />
<?$APPLICATION->ShowHead()?>
<link href="<?=SITE_TEMPLATE_PATH?>/fonts.css" type="text/css" rel="stylesheet" />
<title><?$APPLICATION->ShowTitle()?></title>
<!--[if lt IE 9]> 
 <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
<![endif]-->
</head>

<body>
<link rel="icon" href="http://konditerka.com/images/favicon.ico" type="image/x-icon" />
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="container">
	<header>
		<figure><?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/logo.php"),
			Array(),
			Array("MODE"=>"html")
		);?></figure>
		<div>
			<div class="tel"><?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include_areas/tel.php"),
				Array(),
				Array("MODE"=>"html")
			);?></div>
			<div class="login"><?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include_areas/login.php"),
				Array(),
				Array("MODE"=>"html")
			);?></div>
			<div class="clear"></div>
			<nav>
			<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel1", array(
				"ROOT_MENU_TYPE" => "top",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => array(
				),
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "top",
				"USE_EXT" => "N",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N"
				),
				false
			);?>
			</nav>
			<div class="clear"></div>
			<div class="search"><?$APPLICATION->IncludeComponent("bitrix:search.form", "template1", Array(
				"PAGE" => "/search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
				),
				false
			);?></div>
		</div>
	</header>
	<div class="block_right">