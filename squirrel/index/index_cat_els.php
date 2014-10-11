
<style>
    .tabs {margin: 100px 0 30px;}
    .tabs ul {text-align: center;}
    .tabs li {display: inline;}
    .tabs li+li {margin-left: 15px;}
    .tabs li a {padding: 20px;}
    .tabs .item {display: none;}
</style>
 
<div class="tabs"> 
  <div class="title"> 
    <ul> 
      <li><a href="#" >Лидеры продаж</a></li>
     
      <li><a href="#" >Новинки</a></li>
     
      <li><a href="#" >Товары со скидкой</a></li>
     </ul>
   </div>
 
  <div class="content"> 
    <div class="item"> 
<? 


CModule::IncludeModule('catalog');  
  if($res = CCatalogDiscount::GetDiscountProductsList(array(), array(">=DISCOUNT_ID" => 1), false, false, array())){
  while($ob = $res->GetNext()){
        $arDiscountElementID[] = $ob["PRODUCT_ID"];
  }}
?> <?$arrFilter = array("ID" => $arDiscountElementID);?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	".default",
	Array(
		"VIEW_MODE" => "SECTION",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "9",
		"LINE_ELEMENT_COUNT" => "3",
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

                        id= $('.tabs .title a').index($(this));
                        $('.tabs .content .item').hide('fast', function(){
                            $('.tabs .content .item').eq(id).show();
                        });
                    });
                    $('.tabs .title a').eq(0).trigger('click');
                });
            });
        }
    }, 300);
</script>
 </div>
    