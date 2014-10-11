<div id="usl-block-4">
    <div class="width-list razrab">
        <div class="block-name">Наши последние работы</div>
        <div class="work1 block">
            <div class="work-img">
                <div class="end-circle"><div class="opisanie">Краткое описание</div></div>
            </div>
            <div class="work-name">ДальХабдизель</div>
        </div>
        <div class="work2 block">
            <div class="work-img">
                <div class="end-circle"><div class="opisanie">Краткое описание</div></div>
            </div>
            <div class="work-name">Гармония</div>
        </div>
        <div class="work3 block">
            <div class="work-img">
                <div class="end-circle"><div class="opisanie">Краткое описание</div></div>
            </div>
            <div class="work-name">Netcom</div>
        </div>
        <div class="work4 block">
            <div class="work-img">
                <div class="end-circle"><div class="opisanie">Краткое описание</div></div>
            </div>
            <div class="work-name">Цветовой рай</div>
        </div>
    </div>
    <div id='show-port-more'>
        <div class="portfolio-more">

            <div class="info" id="show-port-more-load">

            </div>
            <div class="portfolio-zakaz">
                <div class="name-zakaz">
                    Заказать такой сайт
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:form.result.new",
                    "portfolio_popup",
                    Array(
                        "WEB_FORM_ID" => "10",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "USE_EXTENDED_ERRORS" => "N",
                        "SEF_MODE" => "N",
                        "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "LIST_URL" => "/blagodarnost/blagodarnost6.php",
                        "EDIT_URL" => "result_edit.php",
                        "SUCCESS_URL" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "CHAIN_ITEM_LINK" => ""
                    )
                );?>
            </div>
        </div>
    </div>
</div>


<?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

<script type="text/javascript">
    <!--
    BX.ready(function(){

        var portMore = new BX.PopupWindow("port_more", null, {
            content: BX('show-port-more'),
            titleBar: {content: BX.create("span", {html: '<b>Подробно о проекте</b>', 'props': {'className': 'access-title-bar'}})},
            closeIcon: {right: "30px", top: "50px", 'background-color': 'black', 'border-radius': '15px'},
            zIndex: 0,
            offsetLeft: 100,
            offsetTop: 0,
            draggable: {restrict: false},
            buttons: [
//                new BX.PopupWindowButton({
//                    text: "Отправить",
//                    className: "popup-window-button-accept",
//                    events: {click: function(){
//                        BX.ajax.submit(BX("myForm"), function(data){ // отправка данных из формы с id="myForm" в файл из action="..."
//                            BX( 'ajax-add-answer').innerHTML = data;
//                        });
//                    }}
//                }),
                new BX.PopupWindowButton({
                    text: "Закрыть",
                    className: "webform-button-link-cancel",
                    events: {click: function(){
                        this.popupWindow.close(); // закрытие окна
                    }}
                })
            ]
        });

        $('.work-img').click(function(e){
            e.preventDefault();

            iid= $('.work-img').index($(this));
            BX.ajax.insertToNode('/portfolio/popup.php?port_id='+iid, BX('show-port-more-load')); // функция ajax-загрузки контента из урла в #div
            portMore.show(); // появление окна

            setTimeout(function small_img(){
                if ($('#port_more').css('display') == 'none') setTimeout(small_img, 1000);
                else {
//                    $('.small-img img').click(function(){
//                        $('.zoomPad img').attr('src', $(this).attr('src'));
//                    });
                    $('.jqzoom').jqzoom({
                        zoomType: 'standard',
                        lens:true,
                        preloadImages: false,
                        zoomWidth: 450,
//                        zoomHeight: 49,
                        alwaysOn:false,
                        xOffset: 100
                    });
                    $('input[name="form_text_30"]').val($('#show-port-more .poroject-info .opis').eq(0).text().trim());
                }
            }, 1000);

//            before=true;
//            after=true;
//            setTtimeout(function bf_popup(){
//                if ($('#port_more').css('display') == 'none' && before) {
//                    $('#port_more').fadeIn(400, // сначала плавно показываем темную подложку
//                        function(){ // после выполнения предъидущей анимации
//                            $('#port_more')
//                                .css('display', 'block') // убираем у модального окна display: none;
//                                .animate({opacity: 1, top: '50%', left: 'x'}, 200); // плавно прибавляем прозрачность одновременно со съезжанием вниз
//                        });
//                    before= false;
//                } else if(after) {
//                    $('#port_more')
//                        .animate({opacity: 0, top: '45%'}, 200,  // плавно меняем прозрачность на 0 и одновременно двигаем окно вверх
//                        function(){ // после анимации
//                            $(this).css('display', 'none'); // делаем ему display: none;
//                            $('#port_more').fadeOut(400); // скрываем подложку
//                        }
//                    );
//                    after= false;
//                }
//                if (before || after) setTtimeout(bf_popup, 100);
//            },10);

        });
    });
    //-->
</script>
