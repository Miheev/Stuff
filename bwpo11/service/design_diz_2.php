<div id="usl-block-2">
				<div class="width-list">
					<div class="price-block">
						<div class="price-name-2">Графический контент</div>
						<div class="price-pozitiv">
							<ul>
								<li>Качественный дизайн</li>
								<li>Банера</li>
								<li>Логотипы</li>
								<li>Элементы сайтов</li>
                                <li>разработка до 2 дней</li>																					
							</ul>
						</div>
						<div class="price">от 500Р</div>
						<div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
					</div>
					<div class="price-block">
						<div class="price-name">Дизайн сайта</div>
						<div class="price-pozitiv">
							<ul>
								<li>Качественный дизайн</li>
								<li>Визитка</li>
								<li>Магазин</li>
								<li>Landing page</li>
                                <li>разработка до 7 дней</li>
								</ul>
						</div>
						<div class="price">от 6 000 Р</div>
						<div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
					</div>
					<div class="price-block">
						<div class="price-name">Фирменный стиль</div>
						<div class="price-pozitiv">
							<ul>
								<li>Качественный дизайн</li>
								<li>Фирменные бланки</li>
								<li>деловые конверты</li>
								<li>визитные карточки</li>
                                <li>разработка до 15 дней</li>
								</ul>
						</div>
						<div class="price">от 20 000 Р</div>
						<div class="price-zakaz"><a href="#zakaz-form">Заказать</a></div>
					</div>
					<div class="price-block">
						<div class="price-name-2">3D моделирование</div>
						<div class="price-pozitiv">
							<ul>
								<li>Качественная модель</li>
								<li>Модель предметов</li>
								<li>Модель зданий</li>
								<li>и многое другое...</li>
                                <li>разработка 15 дней</li>
							</ul>
						</div>
						<div class="price">50 000 Р</div>
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

        site_type= ['Графический контент', 'Дизайн сайта', 'Фирменный стиль', '3D моделирование'];

        $('.price-zakaz a').click(function(e){
            e.preventDefault();

            msg_id= $('.price-zakaz a').index($(this));
            console.log(site_type[msg_id]);
            $('#ajax-add-answer input[name="form_text_12"]').attr('value', site_type[msg_id]);
            addAnswer.show(); // появление окна
        });
    });
    //-->
</script>

<div id='ajax-add-answer'>
    <div class="form-zakaz form1">
        <div class="form-name">Отправить заявку <br>на разработку дизайна</div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "std_composit",
            Array(
                "WEB_FORM_ID" => "6",
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