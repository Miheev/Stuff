<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$this->setFrameMode(true);
?>
<?$frame = $this->createFrame()->begin('<img src="'.SITE_TEMPLATE_PATH.'/img/wait27.gif" alt="" />')?>
<?require(realpath(dirname(__FILE__)).'/ajax_template.php')?>
<?//$frame->beginStub()?>
<!--		<div class="bx_small_cart">-->
<!--			<span class="icon_cart"></span>-->
<!--			--><?//=GetMessage('TSB1_CART')?>
<!--		</div>-->
	<?$frame->end()?>
<script>
	sbbl.elemBlock = BX('bx_cart_block');

	sbbl.ajaxPath = '<?=$componentPath?>/ajax.php';
	sbbl.siteId = '<?=SITE_ID?>';
	sbbl.templateName = '<?=$templateName?>';
	sbbl.arParams = <?=CUtil::PhpToJSObject ($arParams)?>;

	BX.addCustomEvent(window, 'OnBasketChange', sbbl.refreshCart);

	<?if ($arParams["POSITION_FIXED"] == "Y"):?>
		sbbl.elemStatus = BX('bx_cart_block_status');
		sbbl.strCollapse = '<?=GetMessage('TSB1_COLLAPSE')?>';
		sbbl.strExpand = '<?=GetMessage('TSB1_EXPAND')?>';
		sbbl.bClosed = true;

		sbbl.elemProducts = BX('bx_cart_block_products');
		sbbl.bMaxHeight = false;
		sbbl.bVerticalTop = <?=$arParams["POSITION_VERTICAL"] == "top" ? 'true' : 'false'?>;

		<?if ($arParams["POSITION_VERTICAL"] == "top"):?>
			sbbl.fixCartTopPosition();
			BX.addCustomEvent(window, "onTopPanelCollapse", sbbl.fixCartTopPosition);
		<?endif?>

		sbbl.resizeTimer = null;
		BX.bind(window, 'resize', function() {
			clearTimeout(sbbl.resizeTimer);
			sbbl.resizeTimer = setTimeout(sbbl.toggleMaxHeight, 500);
		});
	<?endif?>

</script>