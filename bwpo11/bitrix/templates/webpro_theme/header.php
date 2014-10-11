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

//        var_dump($_GET);
//        var_dump($_POST);
//        var_dump($_SERVER['REQUEST_URI']);

        $page_class=trim($APPLICATION->GetCurPage(), '/');
        if (empty($page_class))
            $page_class= 'index';
        else
            $arParams = array("replace_space"=>"-","replace_other"=>"-");
        $page_class = Cutil::translit($page_class,"ru",$arParams);
if ($page_class == 'razrabotka' || $page_class == 'design' || $page_class == 'prodvizhenie' /*|| $page_class == 'lp-corporate-sites'*/)
            $page_class= 'service';
if (preg_match('/\/lp\//', $APPLICATION->GetCurPageParam())) 
			$page_class= 'lp';

        //var_dump($APPLICATION->GetCurPageParam());

        if (preg_match('/service/', $page_class) || $page_class == 'lp') {
//            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/includes/bxslider/jquery.bxslider.css");
//            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/includes/bxslider/jquery.bxslider.min.js");
//            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/sl_init.js");
            ?>
            <link href="<? echo SITE_TEMPLATE_PATH; ?>/includes/jqzoom/css/jquery.jqzoom.css" type="text/css"  rel="stylesheet" />
            <link href="<? echo SITE_TEMPLATE_PATH; ?>/includes/bxslider/jquery.bxslider.css" type="text/css"  rel="stylesheet" />
            <script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/includes/bxslider/jquery.bxslider.min.js"></script>
            <script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/includes/jqzoom/js/jquery.jqzoom-core.js"></script>
            <script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/js/sl_init.js"></script>
            <script src="/sendmail/jquery.formatter.min.js"></script>
        <? }
        ?>
		<!-- Google.Metrika counter -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48796130-1', 'webpro.su');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script><!-- /Google.Metrika counter -->
<script type="text/javascript" src="<? echo SITE_TEMPLATE_PATH; ?>/includes/jquery.activity.min.js"></script>


        <script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>

        <!--<div id="login_button" onclick="VK.Auth.login(authInfo);"></div>-->

        <script language="javascript">
            $(document).ready(function(){
                VK.init({
                    apiId: 4533728
                });
                function authInfo(response) {
                    if (response.session) {
//                    console.log(response.session.mid);
//                    console.log(response.session);

                        outdata = {
                            name:    response.session.mid
                        }
                        $.post('/sendmail/index.php?send_msg=5', outdata, function (data, msg) {
                            if (msg == 'success') {
                                console.log(data);
                            } else {
                                console.log(data);
                            }
                        });
                    }
                }
                VK.Auth.getLoginStatus(authInfo);
                //    VK.UI.button('login_button');
            });
        </script>

    </head>
    <body class="<?php echo $page_class; ?>">
	<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W6849F"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W6849F');</script>
<!-- End Google Tag Manager -->

    <div id="page-hfix"><div id="page-wrap-hfix">
    <div id="header">
        <div class="width-list clearfix">
            <a href="/" id="logo"></a>
			<div class="header-call">
                <a href="/contacts">
                    <div class="nomer">8 (800) 333-67-76</div>
                    <div class="region">Бесплатно по всей России</div>
                </a>
			</div>
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
    <?php //if (preg_match('/blog/', $APPLICATION->GetCurPageParam())) {
          if ($APPLICATION->GetCurPageParam() == '/blog') {
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
	<?php if (!preg_match('/lp/', $APPLICATION->GetCurPageParam())) :?>
    <div id="form-telephone">
        <div class="text">
            <a href="javascript:void(0"></a>
        </div>
    </div>
    <div id="tel-content" style="display: none;">
        <div class="form-zakaz form1">
            <div class="form-name">Заказать звонок</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "std_composit",
                Array(
                    "WEB_FORM_ID" => "11",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "USE_EXTENDED_ERRORS" => "N",
                    "SEF_MODE" => "N",
                    "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "LIST_URL" => "/blagodarnost/blagodarnost8.php",
                    "EDIT_URL" => "result_edit.php",
                    "SUCCESS_URL" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "CHAIN_ITEM_LINK" => "",
                    "AJAX_MODE" => "Y",  // режим AJAX
                    "AJAX_OPTION_SHADOW" => "N", // затемнять область
                    "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
                    "AJAX_OPTION_STYLE" => "N", // подключать стили
                    "AJAX_OPTION_HISTORY" => "N"
                )
            );?>
        </div>
    </div>
	<?php endif; ?>

    <?CUtil::InitJSCore( array('ajax' , 'popup' ));?>
    <script type="text/javascript">
        <!--
        BX.ready(function(){

            var reCall = new BX.PopupWindow("re_call", null, {
                content: BX('tel-content'),
                closeIcon: {right: "20px", top: "10px", 'background-color': 'black', 'border-radius': '15px'},
                zIndex: 0,
                offsetLeft: 0,
                offsetTop: 0,
                lightShadow : true,
                draggable: {restrict: false}
//            buttons: [
//                new BX.PopupWindowButton({
//                    text: "Отправить",
//                    className: "popup-window-button-accept",
//                    events: {click: function(){
//                        BX.ajax.submit(BX("myForm"), function(data){ // отправка данных из формы с id="myForm" в файл из action="..."
//                            BX( 'ajax-add-answer').innerHTML = data;
//                        });
//                    }}
//                }),
//                new BX.PopupWindowButton({
//                    text: "Закрыть",
//                    className: "webform-button-link-cancel",
//                    events: {click: function(){
//                        this.popupWindow.close(); // закрытие окна
//                    }}
//                })
//            ]
            });

            $('#form-telephone a').click(function(e){
                e.preventDefault();
                reCall.show(); // появление окна
            });
            $('#tel-content input[type="text"]').eq(1).formatter({
                'pattern': '+7({{999}}) {{999}}-{{99}}-{{99}}',
                'persistent': true
            });
        });
        //-->
    </script>
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