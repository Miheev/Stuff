<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html>
<head>
<?
$page_class=trim($APPLICATION->GetCurPage(), '/');
if (empty($page_class)) {
    $page_class= 'index';
} else {
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
    $page_class = Cutil::translit($page_class,"ru",$arParams);
    preg_match('/.*(?=\?)/', $page_class, $tmp);
    $page_class = empty($tmp[0]) ? strtolower($page_class) : strtolower($tmp[0]);
    $page_class = str_replace(array("\\", '&', '?', '/'), '-', $page_class);

    if (intval($page_class)) $page_class= 'page-'.$page_class;
}
if ($page_class == 'auth')
    $page_class= 'wtf';


if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
    header('X-UA-Compatible: IE=edge,chrome=1');?>
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>/favicon.ico" />
<?
    echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
    $APPLICATION->ShowMeta("robots", false, true);
    $APPLICATION->ShowMeta("keywords", false, true);
    $APPLICATION->ShowMeta("description", false, true);
    $APPLICATION->ShowCSS(true, true);
    CUtil::InitJSCore();

    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();

//    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");	?>
    <title><?$APPLICATION->ShowTitle()?></title>

    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/normalize.min.css">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/style.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=SITE_TEMPLATE_PATH?>/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
<!--    --><?//CUtil::InitJSCore( array('ajax' , 'popup' ));?>

    <script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>

<!--[if gte IE 9]>
    <style type="text/css">
        .gradient {
            filter: none;
        }
    </style>
<![endif]-->

<!--[if lt IE 9]>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
<![endif]-->
</head>

<body class="<? echo $page_class; ?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<div class="header-container">
    <header class="header wrapper clearfix">
        <div class="brand">
            <div class="inner">
                <div class="city">
                    <span>Ваш город</span>
                    <select>
                        <option selected>Москва</option>
                        <option>Питер</option>
                    </select>
                </div>
                <div class="logo">
                    <h2>
                        <a href="/"><span class="first">R</span><span class="normal">bank</span><span class="last">ing</span></a>
                    </h2>
                    <p>Лучшие предложения от банков и страховых компаний</p>
                </div>
            </div>
        </div>
        <div class="find">
            <div class="inner clearfix">
                <input type="submit" />
                <input type="text" />
            </div>
        </div>
        <div class="mainmenu">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
                    "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                    "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                        0 => "",
                    ),
                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                ),
                false
            );?>
        </div>
    </header>
</div>
<? if ($page_class != 'index') : ?>
    <div class="bread-container">
        <div class="bread wrapper clearfix">
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "base", array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "-"
            ),
            false
        );?>
        </div>
    </div>
    <div class="main-container">
    <div class="main wrapper clearfix">
        <? if (preg_match('/^news\-/',$page_class)) : ?>
        <aside class="right">
    <!--        --><?php //include 'include/sidebar.php'; ?>
            <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php",
                    "PATH" => SITE_TEMPLATE_PATH."/include/right_banner.php"
                )
            );?>
        </aside>
        <div class="center">
        <?endif;?>
<? endif;  ?>