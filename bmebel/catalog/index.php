<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финские деревянные дома из кленого бруса ");
?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"catalog", 
	array(
		"IBLOCK_TYPE" => "houses",
		"IBLOCK_ID" => "21",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/catalog/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arrFilter",
		"FILTER_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "maki_stuff_list",
			1 => "maki_area",
			2 => "",
		),
		"FILTER_PRICE_CODE" => array(
		),
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"SHOW_TOP_ELEMENTS" => "N",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_TOP_DEPTH" => "4",
		"PAGE_ELEMENT_COUNT" => "1000",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_FIELD" => "property_maki_area",
		"ELEMENT_SORT_ORDER" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "maki_code",
			1 => "maki_area",
			2 => "maki_square",
			3 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "maki_brand_id",
			1 => "maki_stuff_list",
			2 => "maki_country",
			3 => "maki_type",
			4 => "maki_similar",
			5 => "maki_area",
			6 => "maki_houses",
			7 => "maki_groundterrace",
			8 => "maki_firstterrace",
			9 => "maki_useful_square",
			10 => "maki_plans",
			11 => "maki_elevations",
			12 => "",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_STORE" => "N",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#ELEMENT_CODE#.html",
			"compare" => "compare.php?action=#ACTION_CODE#",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc2",
		"EDIT_MODE" => "html",
		"EDIT_TEMPLATE" => ""
	)
);?>

<? if ($APPLICATION->GetCurUri() == '/catalog/index.php') { ?>

    <div id='show-stuff-info'>
    </div>
    <?CUtil::InitJSCore( array('ajax' , 'popup' ));?>

    <script type="text/javascript">
        <!--
        BX.ready(function(){
            BX.ajax.Setup({cache: false});
            var stuffInfo = new BX.PopupWindow("stuff_info", null, {
                content: BX('show-stuff-info'),
                titleBar: {content: BX.create("span", {html: '<img alt="" src="<? echo SITE_TEMPLATE_PATH; ?>/img/popup_mac_logo.png"/>', 'props': {'className': 'access-title-bar'}})},
                closeIcon: {right: "20px", top: "14px", 'background-color': 'black', 'border-radius': '15px'},
                zIndex: 0,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: false}
            });

            $('.catalog-section-element a').click(function(event){
                event.preventDefault();
                $('#show-stuff-info').empty();

                BX.ajax.insertToNode($(this).attr('href'), BX('show-stuff-info')); // функция ajax-загрузки контента из урла в #div
                stuffInfo.show(); // появление окна

                setTimeout(function small_img(){
                    if ($('#stuff_info .catalog-element').css('display') == 'none') setTimeout(small_img, 100);
                    else {
                        $('#stuff_info').css('top', ( $(window).scrollTop() ) +'px');
                        $('#stuff_info').css('left', '13%');
                    }
                }, 1000);


            });
        });
        //-->
    </script>
<? } else { ?>

    <script type="text/javascript">
        <!--
        BX.ready(function(){
            while ($('#take-order').length) $('#take-order').remove();
            while ($('#take_order').length) $('#take_order').remove();
            $('body').append('<div id="take-order"></div>');

            BX.ajax.Setup({cache: false});
            var takeOrder = new BX.PopupWindow("take_order", null, {
                content: BX('take-order'),
                titleBar: {content: BX.create("span", {'props': {'className': 'access-title-bar'}})},
                closeIcon: {right: "20px", top: "14px", 'background-color': 'black', 'border-radius': '15px'},
                zIndex: 0,
                offsetLeft: 100,
                offsetTop: 100,
                draggable: {restrict: false}
            });


            formsubmit= function(lpath) {

                output= {
                    NAME_DESC: $('.zakas input[name="NAME_DESC"]').val(),
                    NAME: $('.zakas input[name="NAME"]').val(),
                    COMPANY_DESC: $('.zakas input[name="COMPANY_DESC"]').val(),
                    COMPANY: $('.zakas input[name="COMPANY"]').val(),
                    PHONE_DESC: $('.zakas input[name="PHONE_DESC"]').val(),
                    PHONE: $('.zakas input[name="PHONE"]').val(),
                    EMAIL_DESC: $('.zakas input[name="EMAIL_DESC"]').val(),
                    EMAIL: $('.zakas input[name="EMAIL"]').val(),
                    DESCRIPTION_DESC: $('.zakas input[name="DESCRIPTION_DESC"]').val(),
                    DESCRIPTION: $('.zakas textarea[name="DESCRIPTION"]').val(),
                    captcha_sid: $('.zakas input[name="captcha_sid"]').val(),
                    captcha_word: $('.zakas input[name="captcha_word"]').val(),
                    SUBMIT: $('.zakas input[name="SUBMIT"]').val()
                }
                console.log(lpath);
                $.ajax({
                    type: "POST",
                    url: lpath,
                    data: output,
                    cache: false,
                    success: function(data, status){
                        console.log(status);
                        console.log(data);

                        errtxt= data.split('font');
                        $('#take-order .main>form').prev().empty();
                        console.log(errtxt);
                        if (errtxt[2].length)
                            $('#take-order .main>form').prev().append('<span style="color: red;" '+errtxt[2]+'span>');
                        else
                            $('#take-order .main>form').prev().append('<span style="color: red;" '+'>Непредвиденная ошибка. Catalog/index.php Строка 260<'+'span>');

                        //submt= $('#take-order .zakas input[type="submit"]').clone(true);
                        //$('#take-order').empty();
                        //$('#take-order').append(data);
                        //td_submt= $('#take-order .zakas tbody tr').last().find('td').last();
                        //tb_submt.empty();
                        //td_submt.append(submt);
                        //$('body').append(data);
                    }
                });
            }

            $('.catalog-element-demand a').click(function(event){
                event.preventDefault();
                linkpath = $(this).attr('href');

                BX.ajax.insertToNode($(this).attr('href'), BX('take-order')); // функция ajax-загрузки контента из урла в #div
                takeOrder.show(); // появление окна

                setTimeout(function small_img(){
                    if ($('#take_order').css('display') == 'none') setTimeout(small_img, 1000);
                    else {
//                                if ( !$('#popup-window-content-take_order #take-order').length )
//                                    $('#popup-window-content-take_order').empty();
//                                $('#popup-window-content-take_order').append($('#take-order'));

                        if (!$('#take_order div.main').length)
                            setTimeout(small_img, 100);
                        else {
                            $('#take_order').css('top', ( $(window).scrollTop()+100 ) +'px');
                            $('#take_order').css('left', '30%');

                            $('.zakas input[type="submit"]').click(function(event){
                                event.preventDefault();
                                formsubmit(linkpath);
                            });
                        }
                    }
                }, 1000);
            });
        });
        //-->
    </script>
<? } ?>


<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>