<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);

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
?>
<!DOCTYPE html>
<html>
    <head>
    <?
    if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        header('X-UA-Compatible: IE=edge,chrome=1');
    ?>
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>/favicon.ico" />
	<?
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);
	?>
	<?
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");	?>
	<title><?$APPLICATION->ShowTitle()?></title>
    <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/normalize.min.css">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/style.css">

        <link rel='stylesheet' href="<?=SITE_TEMPLATE_PATH?>/add/superfish/dist/css/superfish.css" type='text/css' media='all' />
        <link rel='stylesheet' href="<?=SITE_TEMPLATE_PATH?>/add/superfish/dist/css/superfish-vertical.css" type='text/css' media='all' />
        <link href="<?=SITE_TEMPLATE_PATH?>/add/bxslider/merge_jquery.bxslider.css" rel="stylesheet">


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=SITE_TEMPLATE_PATH?>/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

    <script src="<?=SITE_TEMPLATE_PATH?>/add/superfish/dist/js/hoverIntent.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/add/superfish/dist/js/superfish.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/add/bxslider/jquery.bxslider.min.js"></script>

        <script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>


        <link type="text/css"  rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/js/smslider.css" />
	<script type="text/javascript" src="http://malsup.github.io/jquery.cycle.all.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
  fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
 });
});
</script>

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

          <script>
            var page_class= "<? echo $page_class; ?>";

            $(document).ready(function(){
                $('nav li.item-'+page_class).addClass('active');
            });
        </script>
	</head>

    <body class="<? echo $page_class; ?>">
<!--    <div id="page-hfix" ><div id="page-wrap-hfix"><div class="page-inner">-->

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="siteContent">

<div class="fheader-container">
    <div class="flip-header wrapper clearfix">
        <div class="inner">
            <div class="left">
                <p>Город: <span>Москва</span></p>
            </div>
            <div class="right auth-btn">
                <a href="<?=SITE_DIR?>login/" class="abutton">Регистрация</a>
                <a href="<?=SITE_DIR?>login/" class="abutton"><?echo ($USER->IsAuthorized() ? 'Профиль' : 'Вход');?></a>
            </div>
        </div>
    </div>
</div>
<div class="header-container">
    <header class="header wrapper clearfix">
        <div class="top-row clearfix">
            <div class="brand block">
                <a href="/">
                <div class="img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/pyramid.png" alt="" />
                </div>
                <h2>Торговый дом <span>"Эксперт"</span></h2>
                </a>
            </div>
            <div class="about block">
                <div class="inner">
                    <div class="content">
                        <p>По будням<br /> с 9.00 до 18.00</p>
                        <p>+7(495)308-9022</p>
                        <p>Заказать <a href="#">обратный звонок</a></p>
                    </div>
                </div>
            </div>
            <div class="basket block">
                <div class="inner" id="bx_cart_block">
                    <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "slide_cart", array(
	"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
	"PATH_TO_PERSONAL" => SITE_DIR."personal/",
	"SHOW_PERSONAL_LINK" => "N",
	"SHOW_NUM_PRODUCTS" => "Y",
	"SHOW_TOTAL_PRICE" => "Y",
	"SHOW_PRODUCTS" => "Y",
	"POSITION_FIXED" => "Y",
	"POSITION_HORIZONTAL" => "right",
	"POSITION_VERTICAL" => "top",
	"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
	"SHOW_DELAY" => "Y",
	"SHOW_NOTAVAIL" => "Y",
	"SHOW_SUBSCRIBE" => "Y",
	"SHOW_IMAGE" => "Y",
	"SHOW_PRICE" => "Y",
	"SHOW_SUMMARY" => "Y"
	),
	false
);?>
                </div>
            </div>
        </div>
        <div class="menu-row clearfix">
            <nav>
                <ul class="menu">
                    <li class="ico-main item-index"><a href="/">Главная</a></li>
                    <li class="mobile ico-contact item-kontakty"><a href="/kontakty/">Контакты</a></li>
                    <li class="mobile-480 ico-about item-news"><a href="/news">Новости</a></li>
                    <li class="ico-catalog item-catalog"><a href="/catalog">Каталог</a></li>
                    <li class="mobile ico-basket item-personal-cart"><a href="/personal/cart/">Корзина</a></li>
                    <li class="mobile-480 ico-howtobuy item-catalog-skidki"><a href="/catalog/skidki">Скидки</a></li>

                    <li class="full ico-howtobuy item-catalog-skidki"><a href="/catalog/skidki">Скидки</a></li>
                    <li class="full ico-about item-news"><a href="/news">Новости</a></li>
                    <li class="full ico-contact item-kontakty"><a href="/kontakty/">Контакты</a></li>
                </ul>
            </nav>
<!--            --><?//$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel1", Array(
//                    "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
//                    "MENU_CACHE_TYPE" => "Y",	// Тип кеширования
//                    "MENU_CACHE_TIME" => "36000000",	// Время кеширования (сек.)
//                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
//                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
//                    "MAX_LEVEL" => "1",	// Уровень вложенности меню
//                    "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
//                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
//                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
//                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
//                ),
//                false
//            );?>
                <?$APPLICATION->IncludeComponent("bitrix:search.title", "base", array(
                        "NUM_CATEGORIES" => "1",
                        "TOP_COUNT" => "5",
                        "ORDER" => "date",
                        "USE_LANGUAGE_GUESS" => "Y",
                        "CHECK_DATES" => "N",
                        "SHOW_OTHERS" => "N",
                        "PAGE" => SITE_DIR."search.php",
                        "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                        "CATEGORY_0" => array(
                            0 => "iblock_support_test_iblock_type",
                        ),
                        "CATEGORY_0_iblock_support_test_iblock_type" => array(
                            0 => "11",
                        ),
                        "SHOW_INPUT" => "Y",
                        "INPUT_ID" => "title-search-input",
                        "CONTAINER_ID" => "search_tt_in",
                        "PRICE_CODE" => array(
                        ),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "SHOW_PREVIEW" => "Y",
                        "PREVIEW_WIDTH" => "75",
                        "PREVIEW_HEIGHT" => "75",
                        "CONVERT_CURRENCY" => "Y",
                        "CURRENCY_ID" => "RUB"
                    ),
                    false
                );?>
<!--                    <input type="text" autocomplete />-->
        </div>
    </header>
</div>

<?if(!$USER->IsAuthorized() && $page_class == 'personal-cart') :?>
    <script>
        $('document').ready(function(){
            $('.auth-btn a').click(function(e){
                e.preventDefault();
                e.stopPropagation();

                $('body').animate({scrollTop: $(window).height()/2},1000);
            });
        });
    </script>
<?else :?>
<div class="auth-container">
        <div class="auth wrapper clearfix">
            <div class="flip-block">
                <div class="inner">
                    <div class="tab-head clearfix">
                        <span class="reg">Регистрация</span>
                        <span class="entry">Вход</span>
                        <img class="close" src="<?=SITE_TEMPLATE_PATH?>/img/btn_close.png" alt="" />
                    </div>
                    <div class="tabs">
                        <div class="item reg-item clearfix">
                            <?$APPLICATION->IncludeComponent(
	"webpro:main.register",
	"simple_register", 
	array(
		"SHOW_FIELDS" => array(
			0 => "PERSONAL_MOBILE",
		),
		"REQUIRED_FIELDS" => array(
			0 => "PERSONAL_MAILBOX",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => ""
	),
	false
);?>
                        </div>
                        <div class="item entry-item clearfix">
                            <div class="block form">
<!--                                <form>-->
<!--                                    <input type="email" placeholder="Электронная почта">-->
<!--                                    <input type="password" placeholder="Пароль">-->
<!--                                    <input type="submit" class="abutton" value="Войти">-->
<!--                                    <a href="#">Забыли пароль?</a>-->
<!--                                </form>-->
                                <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"simple_auth", 
	array(
		"REGISTER_URL" => "/auth",
		"FORGOT_PASSWORD_URL" => "/auth",
		"PROFILE_URL" => "/personal/profile",
		"SHOW_ERRORS" => "Y",
		"AUTH_SERVICES" => "N"
	),
	false
);?>
                            </div>
                            <div class="block order">
                                <div class="block-head">Заказы</div>
                                <a href="/personal/cart">Посмотреть свою корзину</a>
                                <a href="/personal/order">История просмотра товаров</a>
                            </div>
                            <div class="block text">
                                <p>Чтобы получать больше скидок, участвовать в обсуждении товаров, Вам необходимо зарегистрироваться.</p>
                                <p>Регистрируясь на сайте, Вы дайте согласие на обработку и хранение указанных персональных данных.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>

    <? if ($page_class != 'index') : ?>
    <div class="main-container">
        <div class="main wrapper clearfix">
            <aside class="left">
                <div class="inner clearfix">
                    <?php include 'include/sidebar.php'; ?>
                </div>
            </aside>
            <div class="center">
    <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"base",
	array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "-"
	),
	false
);?>
    <? endif;  ?>