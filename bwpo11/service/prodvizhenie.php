<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Продвижение сайта");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "pro_1",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "pro_2",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "pro_3",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "pro_4",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "pro_5",
		"EDIT_TEMPLATE" => ""
	)
);?>

    <!--    <script src="/sendmail/jquery.formatter.min.js"></script>-->
    <script >

        $(document).ready(function(){

            $('form').each(function(){
                obj= $(this).find('input[type="text"]');
                obj.eq(1).attr('placeholder', 'Email');
                obj.eq(0).attr('placeholder', 'Имя');
            });
        });
    </script>


<?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

    <script type="text/javascript">
        <!--
        BX.ready(function(){

            var otzvImg = new BX.PopupWindow("otzv_img", null, {
                content: BX('otzv-img-cont'),
                closeIcon: {right: "30px", top: "30px", 'background-color': 'black', 'border-radius': '15px'},
                zIndex: 0,
                lightShadow : true
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

            $('a.zoom').click(function(e){
                e.preventDefault();

                $('#otzv-img-cont img').attr('src', $(this).find('img').attr('src'));
                otzvImg.show(); // появление окна

            });
        });
        //-->
    </script>

    <div id='otzv-img-cont' style="width: 500px;">
        <img src="" style="width: 100%; height: auto;"/>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>