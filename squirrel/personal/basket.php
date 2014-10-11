<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<noindex>
<style>
    .block_left nav ul li:first-child {
        position:relative;
        background: #725f36 !important;
        border-radius: 5px !important;
    }
    .block_left nav ul li:first-child a {
        position:absolute;
        top: 0;
        left: 0;
        display: inline-block;
        width:191px;
        color: white !important;
    }
</style>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"template3",
	Array(
		"PATH_TO_ORDER" => "/personal/order.php",
		"HIDE_COUPON" => "Y",
		"COLUMNS_LIST" => array("NAME","PRICE","QUANTITY","DELETE","WEIGHT"),
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"SET_TITLE" => "N"
	)
);?>
<a class="http-ref" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"></a>
<script>
    $(document).ready(function(){
//        $('.block_left nav li').click(function(e){
//            if ($(this).find('a').attr('href') == '#back') {
//                e.preventDefault();
//                history.back();
//            }
//        });
//        $('.return-catalog a').click(function(e){
//                e.preventDefault();
//                history.back();
//        });

        backref= $('.http-ref').attr('href');
        if (backref.match(/basket\.php/))
            backref= '/catalog';

        $('.back-to-shop').attr('href', backref);
        $('.block_left nav li a').eq(0).attr('href', backref);
    });
</script>
</noindex><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>