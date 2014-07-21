<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->ShowHead();?>
<?IncludeTemplateLangFile(__FILE__);?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/print.css" media="print" />
</head>
<body>	
		<div id="panel"><?$APPLICATION->ShowPanel();?></div>


				<div id="header">
                    <a href="/" id="logo"></a>
                    <div class="width-list">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "horizontal_multilevel",
                        Array(
                            "ROOT_MENU_TYPE" => "top",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => Array()
                        )
                    );?>
                </div> </div>
				<div id="content-wrapper">
					<?if($APPLICATION->GetCurPage(true) != SITE_DIR."index.php")
					{
						echo "<h1>";
						$APPLICATION->ShowTitle(false);
						echo "</h1>";
					}
					?>