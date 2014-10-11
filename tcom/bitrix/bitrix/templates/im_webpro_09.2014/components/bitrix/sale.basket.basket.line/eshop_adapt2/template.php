<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<span class="OrderImg"></span>
<?if (IntVal($arResult["NUM_PRODUCTS"])>0):?>
<a class="OrderNumber" href="<?=$arParams["PATH_TO_BASKET"]?>">Ваш заказ:<br><?echo $arResult["NUM_PRODUCTS"];?> товаров</a>
<?else:?>
	<a class="bx_cart_top_inline_link" href="<?=$arParams["PATH_TO_BASKET"]?>"><?echo GetMessage('YOUR_CART_EMPTY')?><span id="bx_cart_num"></span></a>
<?endif?>
<script>
	var obEshopBasket = new JSEshopBasket("<?=$this->GetFolder()?>/ajax.php", "<?=SITE_ID?>");
</script>