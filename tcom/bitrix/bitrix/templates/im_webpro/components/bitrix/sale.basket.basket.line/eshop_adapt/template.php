<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (IntVal($arResult["NUM_PRODUCTS"])>0):?>
<a class="OrderNumber" href="<?=$arParams["PATH_TO_BASKET"]?>">Ваш заказ<br><?echo $arResult["NUM_PRODUCTS"];?> товаров</a>
<?else:?>
	<a class="OrderNumber" href="<?=$arParams["PATH_TO_BASKET"]?>">Ваш заказ<br><?echo $arResult["NUM_PRODUCTS"];?> товаров</a>
<?endif?>

<script>
	var obEshopBasket = new JSEshopBasket("<?=$this->GetFolder()?>/ajax.php", "<?=SITE_ID?>");
</script>