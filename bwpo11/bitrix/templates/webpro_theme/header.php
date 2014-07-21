<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
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
        <?php $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/effect-style.css"); ?>
        <?
        CJSCore::Init(array("jquery"));
        ?>
    </head>
    <?php
    $page_class=trim($APPLICATION->GetCurPage(), '/');
    if (empty($page_class))
        $page_class= 'index';
    else
        $arParams = array("replace_space"=>"-","replace_other"=>"-");
        $page_class = Cutil::translit($page_class,"ru",$arParams);
    ?>
    <body class="<?php echo $page_class; ?>">
    <div id="header">
        <div class="width-list clearfix">
            <a href="/" id="logo"></a>
            <div id="header-navigation">
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
            </div>
        </div> </div>
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>

    </body>
    <div id="main-wrapper">
      <div id="page-h" class="clearfix width-list">
        <?if($APPLICATION->GetCurPage(true) != SITE_DIR."index.php")
        {
            echo "<h1 style='display: none;'>";
            $APPLICATION->ShowTitle(false);
            echo "</h1>";
        }
        ?>
      </div>