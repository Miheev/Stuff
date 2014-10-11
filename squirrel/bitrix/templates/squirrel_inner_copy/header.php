<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <!DOCTYPE html>
<html>
    <head>
        <?$APPLICATION->ShowHead()?>
        <link href="<?=SITE_TEMPLATE_PATH?>/fonts.css" type="text/css" rel="stylesheet" />
        <title><?$APPLICATION->ShowTitle()?></title>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    </head>

<body>
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
<?php if (!preg_match('/personal\/basket/', $APPLICATION->GetCurPage())) : ?>
            <div class="search"><?$APPLICATION->IncludeComponent("bitrix:search.form", "template1", Array(
                        "PAGE" => "/search/",	// �������� ������ ����������� ������ (�������� ������ #SITE_DIR#)
                    ),
                    false
                );?></div>
<?php endif; ?>
            <div class="cart"><?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "template1", Array(
                        "PATH_TO_BASKET" => "/personal/basket.php",	// �������� �������
                        "PATH_TO_PERSONAL" => "/personal/",	// ������������ ������
                        "SHOW_PERSONAL_LINK" => "N",	// ���������� ������ �� ������������ ������
                    ),
                    false
                );?></div>
        </div>
    </header>
    <div class="block_right">

    <table border="0">
        <tr>
            <td><?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"breat", 
	array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "-"
	),
	false
);?></td>
        </tr>
    </table>





<?if (!$APPLICATION->GetTitle()):?><h1><?$APPLICATION->ShowTitle(false)?></h1><br /><?endif;?>