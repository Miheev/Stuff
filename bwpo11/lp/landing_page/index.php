<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Landing Page");
?><?
$_GET['bid']= 6;

$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc_2",
		"EDIT_TEMPLATE" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"PATH" => "/service/razrabotka_raz_1.php"
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"PATH" => "/service/razrabotka_raz_3.php"
	)
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"PATH" => "/service/razrabotka_raz_4.php"
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"PATH" => "/service/razrabotka_raz_5.php"
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"PATH" => "/service/razrabotka_raz_6.php"
	)
);?>

<?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

<script type="text/javascript">
    <!--
    BX.ready(function(){

        var addAnswer = new BX.PopupWindow("my_answer", null, {
            content: BX('ajax-add-answer'),
            closeIcon: {right: "30px", top: "10px", 'background-color': 'black', 'border-radius': '15px'},
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

        site_type= 'Одностраничный сайт_lp';

        $('.zakaz-tovat').click(function(e){
            e.preventDefault();

            $('#ajax-add-answer input[name="form_text_9"]').val(site_type);
            addAnswer.show(); // появление окна
        });
    });

        $(document).ready(function(){

            $('form').each(function(){
                obj= $(this).find('input[type="text"]');
                obj.eq(1).attr('placeholder', 'Email');
                obj.eq(0).attr('placeholder', 'Имя');
            });
			$('form[name="SIMPLE_FORM_4"] input[type="submit"]').val('Отправить');
            
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
                "LIST_URL" => "/blagodarnost/blagodarnost6.php",
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

    <script >
        $(document).ready(function(){
            $('.photo>a').click(funcion(e){e.preventDefault();});
        });
    </script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>