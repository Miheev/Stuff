<div id="usl-block-2">
    <div class="width-list">

        <div class="price-block">
            <div class="price-name">SEO</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Составление семантического ядра</li>
                    <li>Внутренняя и внешняя оптимизацияя сайта</li>
                    <li>Написание SEO текстов</li>
                    <li>Экспресс аудит</li>
                    <li>Аналитика продвижения</li>

                </ul>
            </div>
            <div class="price">от 8 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>
        <div class="price-block">
            <div class="price-name-2">Контекстная реклама</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Яндекс + Google</li>
                    <li>Составление семантического ядра</li>
                    <li>Подбор ключевых фраз</li>
                    <li>Написание объявлений</li>
                    <li>Оптимизация кампаний</li>

                </ul>
            </div>
            <div class="price">от 18 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>

        <div class="price-block">
            <div class="price-name-2">Полное продвижение</div>
            <div class="price-pozitiv">
                <ul>
                    <li>SEO</li>
                    <li>Контекстная реклама</li>
                    <li>Медийная реклама</li>
                    <li>Реклама в соц сетях</li>
                    <li>Полная аналитика</li>
                </ul>
            </div>
            <div class="price">от 35 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>
        <div class="price-block">
            <div class="price-name">Аудит</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Обработка статистики</li>
                    <li>Экспресс проверка ресурса</li>
                    <li>Выявление слабых мест</li>
                    <li>Консультация</li>
                    <li>Рекомендации к внедрению</li>
                </ul>
            </div>
            <div class="price">от 70 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>
    </div>
</div>

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

        site_type= ['SEO', 'Контекстная реклама', 'Полное продвижение', 'Аудит'];

        $('.price-zakaz a').click(function(e){
            e.preventDefault();

            msg_id= $('.price-zakaz a').index($(this));
            $('#ajax-add-answer input[name="form_text_53"]').val(site_type[msg_id]);
            addAnswer.show(); // появление окна
        });
    });
    //-->
</script>

<div id='ajax-add-answer'>
    <div class="form-zakaz form1">
        <div class="form-name">Отправить заявку <br>на SEO</div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "std_composit",
            Array(
                "WEB_FORM_ID" => "18",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "N",
                "SEF_MODE" => "N",
                "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "LIST_URL" => "/blagodarnost/blagodarnost3.php",
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