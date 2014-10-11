<? if ($page_class != 'index') : ?>
</div></div></div>
<? endif;  ?>
<?include 'include/bottom_block.php'?>
</div> <!--Site Content -->

<div class="footer-container">
    <div class="inner">
        <footer class="wrapper footer">
            <div class="row clearfix">
                <div class="block map">
                    <h4>Карта сайта</h4>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer_menu",
                        Array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array()
                        ),
                        false
                    );?>
                </div>
                <div class="block text">
                    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "standard.php",
                            "PATH" => SITE_TEMPLATE_PATH."/include/footer_text.php"
                        )
                    );?>
                </div>
                <div class="block about">
                    <h4>Контакты</h4>
                    <p>Россия, МО г. Балашиха, Звездная, владение 11</p>
                    <p>manager2@trastcomerc.ru</p>
                    <p>+7(495)308-9022</p>
                </div>
                <div class="block brand">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/pyramid_foot.png" alt=""/>
                    </div>
                    <h2>Торговый дом <span>"Эксперт"</span></h2>
                </div>
            </div>
            <div class="row copyright clearfix">
                <div class="left">
                    <p><strong>Все права защищены <span>Торговый дом "Эксперт"</span>(с).</strong></p>
                </div>
                <div class="right">
                    <!--<img src="<?=SITE_TEMPLATE_PATH?>/img/wp_logo.png" alt=""/>-->
                    <!--<p>Сайт разработан: <span>WEBPRO</span></p>-->
                    <div class="webpro_c">
                        <a href="http://webpro.su" target="_blank">
                            <img src="http://webpro.su/form/create/img/v2.png" class="img1_co" alt="Сайт разработчика" title="Сайт разработчика"  />
                            <img src="http://webpro.su/form/create/img/v2h.png" class="img2_co" alt="Сайт разработчика" title="Сайт разработчика"  />
                            <div class="webpro-href">Сайт разработан: WEBPRO</div>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
<!--    --><?//if ($page_class == 'index') : ?>
<!--        <a class="w3-valid" href="http://validator.w3.org/check?uri=http%3A%2F%2Ftrastcomerc.ru%2F;st=1;group=1"><img src="--><?//=SITE_TEMPLATE_PATH?><!--/img/html5-validated.png" alt="" /></a>-->
<!--    --><?//endif;?>
</div>
<script type="text/javascript">
    <!--
    var addAnswer= 0;
    var cartItem= 0;

    citem_show= function(name, img) {
        $('#cart-item-content img').attr('src', img);
        $('#cart-item-content .name').text(name);

        cartItem.show();
        $('#cart_item').css('top', 0);
//            $('#cart_item').css('top', $('.fheader-container').position().top+$('.fheader-container').height());
        $('#cart_item').css('left', $('header.header .basket>.inner').position().left);
        $('#cart_item').css('position', 'fixed');

        setTimeout(function(){
            $('#cart_item').fadeOut('slow',function(){
                cartItem.close();
            });
            sbbl.refreshCart();
        } ,6000);
    };
    ready_stuff= function(){
        $('.cart-btn a, .basket-btn').click(function(e){
            e.preventDefault();

            name= '';
            img= '';
            if ($(this).parent().hasClass('product-btn')) {
                name= $(this).parents('.bx_item_container').find('.head').text().trim();
                img= $(this).parents('.bx_item_container').find('.bx_bigimages img').attr('src');

                console.log(name);
                console.log(img);
            } else if ($(this).parents('.stuff-item')) {
                name= $(this).parents('.stuff-item').find('.name').text().trim();
                img= $(this).parents('.stuff-item').find('.img img').attr('src');
            }

            url= $(this).attr('href');
            setTimeout(function(){
                citem_show(name, img);
            }, 1000);
            $.post(url, {}, function(data, result){
                if (result == 'success') {
                    ;
                } else {
                    alert('Товар не был добавлен в корзину!\n\r Пожалуйста перезагрузите страницу и попробуйте ещё раз.\n\r При повторном появлении этого сообщения свяжитесь с нами по телефону\n\r+7 (495) 308-9022');
                }
            });
        });
    };

    BX.ready(function(){

        addAnswer = new BX.PopupWindow("call_order", null, {
            content: BX('ajax-call-order'),
            closeIcon: {},
            autoHide : true,
            zIndex: 0,
            offsetLeft: 0,
            offsetTop: 0,
            lightShadow : true,
            overlay: {
                backgroundColor: 'black', opacity: '70'
            },
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
        cartItem = new BX.PopupWindow("cart_item", null, {
            content: BX('cart-item-content'),
            autoHide : true,
            zIndex: 0,
            offsetLeft: 0,
            offsetTop: 0,
            lightShadow : true,
            draggable: {restrict: false}
        });

//        $('#click_test').click(function(){
//            BX.ajax.insertToNode('/uslugi.php', BX('ajax-add-answer')); // функция ajax-загрузки контента из урла в #div
//            addAnswer.show(); // появление окна
//        });

        $('header.header .about a').click(function(e){
            e.preventDefault();

            addAnswer.show(); // появление окна
        });
        if ($('body').hasClass('personal-cart')) {
            obj= $('#call_order');
            if (obj.css('display') == 'none' && obj.find('.error-msg').length)
                addAnswer.show(); // появление окна
            if (obj.css('display') == 'none' && !obj.find('form').length) {
                addAnswer.show(); // появление окна

                setTimeout(function tmr_callorder(){
                    if ($('#call_order').css('display') != 'none')
                        setTimeout(tmr_callorder, 300);
                    else {
                        location.assign(location.pathname);
                    }
                }, 300);
            }
        }

        ready_stuff();

    });

    BX.addCustomEvent("onFrameDataReceived", function(data) {
        ready_stuff();
    });
    //-->
</script>

<div id="cart-item-content">
    <div class="text clearfix">
        <a href="/personal/cart" >
            <img src="<?=SITE_TEMPLATE_PATH?>/img/vedro.jpg" alt=""/>
            <p class="name">Оцинкованное ведро 12 литров</p>
        </a>
    </div>
        <p class="msg">Товар добавлен в корзину</p>
</div>
<div id='ajax-call-order'>
        <?
        $sets= Array(
            "WEB_FORM_ID" => "1",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "N",
            "SEF_MODE" => "N",
            "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "LIST_URL" => "",
            "EDIT_URL" => "result_edit.php",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
        );
        if ($page_class != 'personal-cart') {
            $ajax_sets= array(
                "AJAX_MODE" => "Y",  // режим AJAX
                "AJAX_OPTION_SHADOW" => "N", // затемнять область
                "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
                "AJAX_OPTION_STYLE" => "N", // подключать стили
                "AJAX_OPTION_HISTORY" => "N"
            );
            $sets= array_merge($sets, $ajax_sets);
        }
        $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "call_order",
            $sets
        );?>
</div>


<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '118006';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    var yaParams = {/*Здесь параметры визита*/};
</script>

<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter25587629 = new Ya.Metrika({id:25587629,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,params:window.yaParams||{ }});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25587629" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->s

	</body>	
</html>