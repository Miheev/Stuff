<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "������������ ������� �� ������� �������������� ���.");
$APPLICATION->SetPageProperty("keywords", "������������ ������� , ������� , ��������");
$APPLICATION->SetPageProperty("title", "������������ ������� �� �������� \"�������\"");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("������� ��������");
?> <section> <header> <figure><a href="http://www.konditerka.com/newyear/" ><img title="���������� �������" src="/images/figure2.png"  /></a> <figcaption><a href="http://www.konditerka.com/newyear/" >���������� �������</a></figcaption> </figure> <figure><a href="http://www.konditerka.com/sladkie_podarki/" ><img title="������� �������" src="/images/figure1.png"  /></a> <figcaption><a href="http://www.konditerka.com/sladkie_podarki/" >������� �������</a></figcaption> </figure> <figure><a href="http://www.konditerka.com/catalog/" ><img title="�������" src="/images/figure3.png"  /></a> <figcaption><a href="http://www.konditerka.com/catalog/" >�������</a></figcaption> </figure> </header> 
  <p style="text-align: center;"><font face="Arial"> 
      <br />
     </font></p>
 
  <p style="text-align: center;"><font face="Arial"> 
      <br />
     </font></p>
 
  <br />
 
  <p style="text-align: left;"></p>
 
  <div> <? /* $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "cat_els",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/index/index_cat_els.php"
	)
);  */ ?> <? /* $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "cat_els",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/index/index_cat.php"
	)
); */?> </div>

  <div class="tabs">
    <div class="title"> 
      <ul> 
        <li><a href="#" >������ ������</a></li>
       
        <li><a href="#" >�������</a></li>
       
        <li><a href="#" >������ �� �������</a></li>
       </ul>
     </div>
   
    <div class="content"> 
 <div class="item"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "cat_add_1",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/index/index_cat_add_1.php"
	)
);?> </div>
   
    <div class="item"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "cat_add_1",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/index/index_cat_add_2.php"
	)
);?> </div> 
      <div class="item"> <?


CModule::IncludeModule('catalog');  
  if($res = CCatalogDiscount::GetDiscountProductsList(array(), array(">=DISCOUNT_ID" => 1), false, false, array())){
  while($ob = $res->GetNext()){
        $arDiscountElementID[] = $ob["PRODUCT_ID"];
  }}
?> <?$arrFilter = array("ID" => $arDiscountElementID);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	"catalog_index",
	Array(
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => "",
		"VIEW_MODE" => "SECTION",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "������",
		"MESS_BTN_ADD_TO_BASKET" => "� �������",
		"MESS_BTN_DETAIL" => "���������",
		"MESS_NOT_AVAILABLE" => "��� � �������",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "4",
		"LINE_ELEMENT_COUNT" => "4",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"OFFERS_LIMIT" => "5",
		"PRICE_CODE" => array(),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"HIDE_NOT_AVAILABLE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-"
	)
);?>
          <?$APPLICATION->IncludeComponent(
              "bitrix:catalog.top",
              "catalog_index",
              Array(
                  "IBLOCK_TYPE" => "content",
                  "IBLOCK_ID" => "",
                  "VIEW_MODE" => "SECTION",
                  "SHOW_DISCOUNT_PERCENT" => "N",
                  "SHOW_OLD_PRICE" => "N",
                  "MESS_BTN_BUY" => "������",
                  "MESS_BTN_ADD_TO_BASKET" => "� �������",
                  "MESS_BTN_DETAIL" => "���������",
                  "MESS_NOT_AVAILABLE" => "��� � �������",
                  "ELEMENT_SORT_FIELD" => "sort",
                  "ELEMENT_SORT_ORDER" => "desc",
                  "ELEMENT_SORT_FIELD2" => "id",
                  "ELEMENT_SORT_ORDER2" => "desc",
                  "FILTER_NAME" => "arrFilter",
                  "SECTION_URL" => "",
                  "DETAIL_URL" => "",
                  "SECTION_ID_VARIABLE" => "SECTION_ID",
                  "DISPLAY_COMPARE" => "N",
                  "ELEMENT_COUNT" => "4",
                  "LINE_ELEMENT_COUNT" => "4",
                  "PROPERTY_CODE" => array(0=>"",1=>"",),
                  "OFFERS_LIMIT" => "5",
                  "PRICE_CODE" => array(),
                  "USE_PRICE_COUNT" => "N",
                  "SHOW_PRICE_COUNT" => "1",
                  "PRICE_VAT_INCLUDE" => "Y",
                  "BASKET_URL" => "/personal/basket.php",
                  "ACTION_VARIABLE" => "action",
                  "PRODUCT_ID_VARIABLE" => "id",
                  "USE_PRODUCT_QUANTITY" => "N",
                  "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                  "ADD_PROPERTIES_TO_BASKET" => "Y",
                  "PRODUCT_PROPS_VARIABLE" => "prop",
                  "PARTIAL_PRODUCT_PROPERTIES" => "N",
                  "PRODUCT_PROPERTIES" => array(),
                  "CACHE_TYPE" => "A",
                  "CACHE_TIME" => "36000000",
                  "CACHE_FILTER" => "N",
                  "CACHE_GROUPS" => "Y",
                  "HIDE_NOT_AVAILABLE" => "Y",
                  "CONVERT_CURRENCY" => "N",
                  "TEMPLATE_THEME" => "blue",
                  "ADD_PICT_PROP" => "-",
                  "LABEL_PROP" => "-"
              )
          );?>
          <?$APPLICATION->IncludeComponent(
              "bitrix:catalog.top",
              "catalog_index",
              Array(
                  "IBLOCK_TYPE" => "content",
                  "IBLOCK_ID" => "",
                  "VIEW_MODE" => "SECTION",
                  "SHOW_DISCOUNT_PERCENT" => "N",
                  "SHOW_OLD_PRICE" => "N",
                  "MESS_BTN_BUY" => "������",
                  "MESS_BTN_ADD_TO_BASKET" => "� �������",
                  "MESS_BTN_DETAIL" => "���������",
                  "MESS_NOT_AVAILABLE" => "��� � �������",
                  "ELEMENT_SORT_FIELD" => "sort",
                  "ELEMENT_SORT_ORDER" => "desc",
                  "ELEMENT_SORT_FIELD2" => "id",
                  "ELEMENT_SORT_ORDER2" => "desc",
                  "FILTER_NAME" => "arrFilter",
                  "SECTION_URL" => "",
                  "DETAIL_URL" => "",
                  "SECTION_ID_VARIABLE" => "SECTION_ID",
                  "DISPLAY_COMPARE" => "N",
                  "ELEMENT_COUNT" => "4",
                  "LINE_ELEMENT_COUNT" => "4",
                  "PROPERTY_CODE" => array(0=>"",1=>"",),
                  "OFFERS_LIMIT" => "5",
                  "PRICE_CODE" => array(),
                  "USE_PRICE_COUNT" => "N",
                  "SHOW_PRICE_COUNT" => "1",
                  "PRICE_VAT_INCLUDE" => "Y",
                  "BASKET_URL" => "/personal/basket.php",
                  "ACTION_VARIABLE" => "action",
                  "PRODUCT_ID_VARIABLE" => "id",
                  "USE_PRODUCT_QUANTITY" => "N",
                  "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                  "ADD_PROPERTIES_TO_BASKET" => "Y",
                  "PRODUCT_PROPS_VARIABLE" => "prop",
                  "PARTIAL_PRODUCT_PROPERTIES" => "N",
                  "PRODUCT_PROPERTIES" => array(),
                  "CACHE_TYPE" => "A",
                  "CACHE_TIME" => "36000000",
                  "CACHE_FILTER" => "N",
                  "CACHE_GROUPS" => "Y",
                  "HIDE_NOT_AVAILABLE" => "Y",
                  "CONVERT_CURRENCY" => "N",
                  "TEMPLATE_THEME" => "blue",
                  "ADD_PICT_PROP" => "-",
                  "LABEL_PROP" => "-"
              )
          );?>
      </div>
     </div>

    <script>
        setTimeout(function tmr_jq(){
            if (typeof jQuery == 'undefined')
                setTimeout(tmr_jq, 300);
            else {
                jQuery(function ($) {
                    $(document).ready(function () {
                        $('.tabs .title a').click(function(e){
                            e.preventDefault();

                            pid= $('.tabs .title a').index($('.tabs .title a.active'));
                            id= $('.tabs .title a').index($(this));
                            if (id == pid) return;

                            $('.tabs .content .item').css('display', 'none');
                                $('.tabs .content .item').eq(id).css('display', 'block');
                            $('.tabs .title a').removeClass('active');
                            $(this).addClass('active');
                        });
                        $('.tabs .title a').eq(0).trigger('click');
                    });
                });
            }
        }, 300);
    </script>
 </div>

<div class="block-index-text">
    <h2>������������ �������</h2>
    <div class="clearfix">
        <div class="left">
            <div class="item">
                <h3>���������</h3>
                <p>�������� - ��� ���������, ������ ���������, ���� ������ ������� ������ �� ������ �������� ����, �� � ����.</p>
            </div>
            <div class="item">
                <h3>���������</h3>
                <p>�������� - ��� ���������, ������ ���������, ���� ������ ������� ������ �� ������ �������� ����, �� � ����. ��� ������� ���������� ����� �������� �������������. ������ ����� ��������� ������� ������� � ������� ������ &laquo;�������� ������&raquo;.</p>
            </div>
            <div class="item">
                <h3>���������</h3>
                <p>�������� - ��� ���������, ������ ���������, ���� ������ ������� ������ �� ������ �������� ����, �� � ����.</p>
            </div>
        </div>
        <div class="right">
            <div class="item">
                <h3>���������</h3>
                <p>�������� - ��� ���������, ������ ���������, ���� ������ ������� ������ �� ������ �������� ����, �� � ����. ��� ������� ���������� ����� �������� �������������. ������ ����� ��������� ������� ������� � ������� ������ &laquo;�������� ������&raquo;.</p>
            </div>
            <div class="item">
                <h3>���������</h3>
                <p>�������� - ��� ���������, ������ ���������, ���� ������ ������� ������ �� ������ �������� ����, �� � ����. ��� ������� ���������� ����� �������� �������������. ������ ����� ��������� ������� ������� � ������� ������ &laquo;�������� ������&raquo;.</p>
            </div>
        </div>
    </div>
</div>� �

 </section><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>