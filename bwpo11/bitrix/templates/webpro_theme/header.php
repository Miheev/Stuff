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

        $page_class=trim($APPLICATION->GetCurPage(), '/');
        if (empty($page_class))
            $page_class= 'index';
        else
            $arParams = array("replace_space"=>"-","replace_other"=>"-");
        $page_class = Cutil::translit($page_class,"ru",$arParams);

        //var_dump($APPLICATION->GetCurPageParam());

        if (preg_match('/service/', $page_class)) {
//            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/includes/bxslider/jquery.bxslider.css");
//            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/includes/bxslider/jquery.bxslider.min.js");
//            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/sl_init.js");
            ?>
            <link href="<? echo SITE_TEMPLATE_PATH; ?>/includes/jqzoom/css/jquery.jqzoom.css" type="text/css"  rel="stylesheet" />
            <link href="<? echo SITE_TEMPLATE_PATH; ?>/includes/bxslider/jquery.bxslider.css" type="text/css"  rel="stylesheet" />
            <script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/includes/bxslider/jquery.bxslider.min.js"></script>
            <script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/includes/jqzoom/js/jquery.jqzoom-core.js"></script>
            <script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/js/sl_init.js"></script>
        <? }
        ?>
    </head>
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
        </div>
    </div>
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <?php if (preg_match('/blog.php/', $APPLICATION->GetCurPageParam())) {
        ?>
        <div id="header-img">
            <div class="region region-header-img">
                <div id="block-block-4" class="block block-block">


                    <div class="content">
                        <div id="lp-block1_b">

                        </div>  </div>
                </div>
            </div>
        </div>
    <? }
    ?>
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