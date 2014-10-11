<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>

<html>
<head <?if($page=="/"){?>class="no-js"<?}?>>		
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<?$APPLICATION->ShowHead()?>
		<?$site_path=SITE_TEMPLATE_PATH;?>
		<title><?$APPLICATION->ShowTitle()?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
		

        <link rel="stylesheet" href="<?=$site_path?>/css/normalize.min.css">
        <link rel="stylesheet" href="<?=$site_path?>/css/style.css">
		
        <!--<link href="<?=$site_path?>/add/chosen/chosen.css" rel="stylesheet">-->

        <link href="<?=$site_path?>/add/bxslider/jquery.bxslider.css" rel="stylesheet">
        <link href="<?=$site_path?>/add/scpb/css/circle.css" rel="stylesheet">
        <link href="<?=$site_path?>/add/kalypto/css/kalypto.css" rel="stylesheet">
        <link href="<?=$site_path?>/add/nouislider/jquery.nouislider.css" rel="stylesheet">

		<?php CJSCore::Init(array("jquery")); ?>

        <!--[if lt IE 9]>
            <script src="<?=$site_path?>/js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
		

    </head>
	<?$page = $APPLICATION->GetCurDir(); $subpage=$APPLICATION->GetCurPage();?>
    <body 
	<?if($page=="/" ){?>class="index"<?}
		else if($page=="/member/"){?>class="dreams"<?}
		else if($page=="/voting/" || $page=="/executed_dreams/"){?>class="dreams_golos"<?}
		else if($page=="/realization/"){?>class="realization"<?}
		else if(preg_match('/^\/news/', $page)){?>class="news"<?} //$page=="/news/" ||
		else if($page=="/auth/"){?>class="auth"<?}
		else if($_REQUEST["ELEMENT_ID"]!="" || $page=="/personal/dream/" ){?>class="dreams_mechti"<?}
		else if($page=="/personal/" && ($subpage=="/personal/" || $subpage=="/personal/index.php")){?>class="user"<?}
        else if($subpage=="/personal/favourite.php"){?>class="favorite"<?}
        else if($subpage=="/personal/settings.php"|| $subpage=="/personal/edit.php") {?>class="user_sets"<?}
		else if($subpage=="/auth/reg/success.php") {?>class="reg-valid"<?}
		if($page=="/auth/reg/") {?>class="registration"<?}  ?>
	>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	
    <div class="header-container">
        <header class="header wrapper clearfix">
            <div class="brand block">
				<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/incude/logoname.php",
							"EDIT_TEMPLATE" => ""
						),
					false
				);?>                
            </div>
            <div class="about block">
			<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"header", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		)
	),
	false
);?>
            </div>
            <div class="user block">
			<?global $USER;
			if($USER->IsAuthorized()){?>
                <a href="/mail/">Почта</a>
				<?$rsUser = CUser::GetByID($USER->GetID());
				$arUser = $rsUser->Fetch();
					$code_img=$arUser["PERSONAL_PHOTO"]
				?>
				<a href="/personal/"><img src="<?=CFile::GetPath($code_img)?>" /></a>
				
				
						
                <div class="personal">
                    <!--<span>я</span>-->
				<div class="select">
                            <div class="abbr clearfix"><span class="label"></span><span class="pointer"></span></div>
                            <div class="list">
                                <div class="optgroup">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"personal",
									Array(
										"ROOT_MENU_TYPE" => "profile_menu",
										"MAX_LEVEL" => "1",
										"CHILD_MENU_TYPE" => "left",
										"USE_EXT" => "N",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array()
									),
								false
								);?>
                                </div>
								<?if (CModule::IncludeModule("sale")){
									if ($ar = CSaleUserAccount::GetByUserID($USER->GetID(), "RUB")){
										$sale=SaleFormatCurrency($ar["CURRENT_BUDGET"], $ar["CURRENCY"]);
									}
								}?>
								<?if($sale!=""){?>
                                <div class="optgroup" data-label="Ваш счёт">
                                    <span><strong>Ваш счёт</strong></span>
                                    <a href="/personal/"><?=$sale?></a>
                                </div>
								<?}?>
                                <div class="optgroup">
								<?$name=$USER->GetFullName();
							if($name==""){
								$name=$USER->GetLogin();
							}?>
								<span>Вы зашли как <strong><?=$name?></strong></span>
                                <a href="<?=$APPLICATION->GetCurPageParam("logout=yes", array("logout", "login"));?>">Выйти</a>
                                </div>
                            </div>
                        </div>
						
                </div>
			<?}else{?>
				<a href="/auth/" class="autorizz">Вход</a>
				<a href="/auth/reg/">Регистрация</a>
			<?}?>
            </div>
            <!--<div class="contry block">-->
                <!--<span>rus</span>-->
            <!--</div>-->
<?$APPLICATION->IncludeComponent("bitrix:search.form", "header_searchline", Array(
	"USE_SUGGEST" => "N",	// Показывать подсказку с поисковыми фразами
		"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
	),
	false
);?> 

        </header>
    </div>
		<?if($page=="/" && $subpage!="/test.php"){?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"slider", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "dreams",
		"IBLOCK_ID" => "10",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "WWW",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"SEF_FOLDER" => "/slider/",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>               
		<?}else{?>
		 <div class="menu-container clearfix">
                <nav class="wrapper clearfix">
                    <ul class="menu">
					<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer", 
	array(
		"ROOT_MENU_TYPE" => "second_top",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		)
	),
	false
);?>
                    </ul>
                </nav>
            </div>
		<?}?>
<?if($page!="/"){?>
        <div class="main-container">
            <div class="main wrapper clearfix">
<?}?>