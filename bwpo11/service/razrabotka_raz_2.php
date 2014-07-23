<div id="usl-block-2">
    <div class="width-list">
        <div class="price-block">
            <div class="price-name">Визитка</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Уникальный дизайн</li>
                    <li>Система управления</li>
                    <li>Наполнение 5 страниц</li>
                    <li>Форма обратной связи</li>
                    <li>Домен на год</li>
                    <li>3 месяца хостинга</li>

                </ul>
            </div>
            <div class="price">от 80 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>
        <div class="price-block">
            <div class="price-name">Landing page</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Качественный дизайн</li>
                    <li>Форма заказа</li>
                    <li>Высокая конверсия</li>
                    <li>1 месяц оптимизации</li>
                    <li>Статистика</li>
                    <li>3 месяца хостинга</li>
                </ul>
            </div>
            <div class="price">от 150 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>
        <div class="price-block">
            <div class="price-name">Интернет магазин</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Уникальный дизайн</li>
                    <li>Система управления</li>
                    <li>Каталог товаров</li>
                    <li>Корзина товаров</li>
                    <li>Домен на год</li>
                    <li>3 месяца хостинга</li>
                </ul>
            </div>
            <div class="price">от 150 000 Р</div>
            <div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
        </div>
        <div class="price-block">
            <div class="price-name">Портал компании</div>
            <div class="price-pozitiv">
                <ul>
                    <li>Уникальный дизайн</li>
                    <li>СRM-система</li>
                    <li>Система управления сайтом</li>
                    <li>Реализация уникального функционала</li>
                    <li>и многое другое...</li>
                </ul>
            </div>
            <div class="price">от 500 000 Р</div>
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

        site_type= ['Визитка', 'Landing page', 'Интернет магазин', 'Портал компании'];

        $('.price-zakaz a').click(function(e){
            e.preventDefault();

            msg_id= $('.price-zakaz a').index($(this));
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
            "",
            Array(
                "WEB_FORM_ID" => "4",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "N",
                "SEF_MODE" => "N",
                "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "LIST_URL" => "result_list.php",
                "EDIT_URL" => "result_edit.php",
                "SUCCESS_URL" => "",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => ""
            )
        );?>
    </div>
</div>