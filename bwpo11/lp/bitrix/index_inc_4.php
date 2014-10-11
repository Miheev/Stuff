<div id="usl-block-2-3" style="display: none;">
        <div class="block-name width-list">Что мы делаем</div>
        <div class="hr width-list"></div>
        <div class="tabs clearfix">
            <div class="title width-list">
                <ul class="clearfix">
                    <li class="first"><a href="#" >Интернет-магазин</a></li>
                    <li class="middle"><a href="#" >Корпоративные сайты</a></li>
                    <li class="last"><a href="#" >Сайт-каталог</a></li>
                </ul>
            </div>
            <div class="content">
                <div class="inner width-list">

                    <div class="item first">
                        <div class="left">
                            <div class="main">
                                <div class="item-title">Что включает в себя:</div>
                                <ul>
                                    <li>Уникальный дизайн</li>
                                    <li>Удобная CMS</li>
                                    <li>Связь с посетителями</li>
                                    <li>Каталог товара</li>
                                    <li>Карточки товаров</li>
                                    <li>Корзина товаров</li>
                                    <li>Личный кабинет покупателя</li>
                                    <li>Управление заказами</li>
                                    <li>Статистика посещаемости </li>
                                </ul>
                            </div>
                            <div class="profit">
                                <div class="profit-name">А так же бесплатно получите:</div>
                                <ul>
                                    <li>Домен в зоне .ru</li>
                                    <li>3 месяца хостинга</li>
                                    <li>3 месяца тех поддержки</li>
                                    <li>1 часовая консультация “Возможности вашего сайта”</li>
                                    <li>E-mail вида <br> ……@(имя вашего домена).ru </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/bk_plabel.png" />
                            <div class="item-title"><span>от</span> 120 000 <span>руб.</span></div>
                        </div>
                        <div class="btn-container">
                            <div class="button">
                                <a href="javascript:voud(0);">Заказать</a>
                            </div>
                        </div>
                    </div>
                    <div class="item middle">
                        <div class="left">
                            <div class="main">
                                <div class="item-title">Что включает в себя:</div>
                                <ul>
                                    <li>Уникальный дизайн</li>
                                    <li>Удобная CMS</li>
                                    <li>Связь с посетителями</li>
                                    <li>Представление товара(услуги, деятельности)</li>
                                    <li>Авторизация</li>
                                    <li>Первоначальное наполнение сайта</li>
                                    <li>Интерактивная карта</li>
                                    <li>Статистика посещаемости </li>
                                </ul>
                            </div>
                            <div class="profit">
                                <div class="profit-name">А так же бесплатно получите:</div>
                                <ul>
                                    <li>Домен в зоне .ru</li>
                                    <li>3 месяца хостинга</li>
                                    <li>3 месяца тех поддержки</li>
                                    <li>1 часовая консультация “Возможности вашего сайта”</li>
                                    <li>E-mail вида <br> ……@(имя вашего домена).ru </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/bk_plabel.png" />
                            <div class="item-title"><span>от</span> 120 000 <span>руб.</span></div>
                        </div>
                        <div class="btn-container">
                            <div class="button">
                                <a href="javascript:voud(0);">Заказать</a>
                            </div>
                        </div>
                    </div>
                    <div class="item last">
                        <div class="left">
                            <div class="main">
                            <div class="item-title">Что включает в себя:</div>
                            <ul>
                                <li>Качественный дизайн</li>
                                <li>Форма заказа</li>
                                <li>Высокая конверсия</li>
                                <li>1 месяц оптимизации</li>
                                <li>Домен на год</li>
                                <li>3 мес. хостинга</li>
                                <li>3 месяца хостинга</li>
                                <li>3 месяца тех поддержки</li>
                            </ul>
                            </div>
                            <div class="profit">
                                <div class="profit-name">А так же бесплатно получите:</div>
                                <ul>
                                    <li>Домен в зоне .ru</li>
                                    <li>1 часовая консультация “Возможности вашего сайта”</li>
                                    <li>E-mail вида <br> ……@(имя вашего домена).ru </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/bk_plabel.png" />
                            <div class="item-title"><span>от</span> 150 000 <span>руб.</span></div>
                        </div>
                        <div class="btn-container">
                            <div class="button">
                                <a href="javascript:voud(0);">Заказать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    jQuery(function ($) {
        $(document).ready(function () {
            $('#usl-block-2-2 .item').click(function(e){
                id= $('#usl-block-2-2 .item').index($(this));

                $('#usl-block-2-2').fadeOut('slow');
                $('#usl-block-2-3').fadeIn('slow', function(){
                    $('#usl-block-2-3 .title a').eq(id).trigger('click');
                });
            });
            $('#usl-block-2-3 .tabs .title a').click(function(e){
                e.preventDefault();

                pid= $('#usl-block-2-3 .tabs .title a').index($('#usl-block-2-3 .tabs .title a.active'));
                id= $('#usl-block-2-3 .tabs .title a').index($(this));
                if (id == pid) return;

                $('#usl-block-2-3 .content .item').eq(pid).fadeOut('slow', function(){
                    $('#usl-block-2-3 .content .item').eq(id).fadeIn('slow');
                });
                $('#usl-block-2-3 .tabs .title a.active').removeClass('active');
                $(this).addClass('active');
            });
            //$('.tabs .title a').eq(0).trigger('click');
        });
    });
</script>


<?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

<script type="text/javascript">
    <!--
    BX.ready(function(){

        var addAnswer = new BX.PopupWindow("my_answer", null, {
            content: BX('ajax-add-answer'),
            closeIcon: {right: "30px", top: "30px", 'background-color': 'black', 'border-radius': '15px'},
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

//        $('#click_test').click(function(){
//            BX.ajax.insertToNode('/uslugi.php', BX('ajax-add-answer')); // функция ajax-загрузки контента из урла в #div
//            addAnswer.show(); // появление окна
//        });

        site_type= ['Интернет-магазин', 'Корпоративный сайт', 'Сайт каталог'];

        $('#usl-block-2-3 .tabs .button a').click(function(e){
            e.preventDefault();

            obj= $(this).parents('.item');
            msg_id= $('.price-zakaz a').index(obj);
            $('#ajax-add-answer input[name="form_text_9"]').val(site_type[msg_id]);
            addAnswer.show(); // появление окна
        });
    });
    //-->
</script>

<div id='ajax-add-answer'>
    <div class="form-zakaz form1">
        <div class="form-name">Отправить заявку <br>на разработку сайта</div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "std_composit",
            Array(
                "WEB_FORM_ID" => "4",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "N",
                "SEF_MODE" => "N",
                "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "LIST_URL" => "/blagodarnost/blagodarnost".$_GET['bid'].".php",
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