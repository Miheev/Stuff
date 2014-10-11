<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

function getElWeight($ID) {
	$ar = CCatalogProduct::GetByID($ID);
	return $ar['WEIGHT'];
}
	
?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table cellpadding="0" cellspacing="0" border="0">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<tr>
		<?endif;?>

		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%">

			<table cellpadding="0" cellspacing="2" border="0">
				<tr>
					<td colspan="2"><b><!--<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">--><?=$arElement["NAME"]?><!--</a>--></b><br /></td>
				</tr>
				<tr>
					<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
						<td valign="top">
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arElement["NAME"]?>" /><br />
						</td>
					<?elseif(is_array($arElement["DETAIL_PICTURE"])):?>
						<td valign="top">
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arElement["NAME"]?>" /><br />
						</td>
					<?endif?>
					<td valign="top">
						<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
							<?if($arPrice["CAN_ACCESS"]):?>
								<p><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp;
								<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
									<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
								<?else:?><span class="catalog-price"><? if($arPrice["VALUE"] == 1.00) echo 'звоните'; else echo $arPrice["PRINT_VALUE"]; ?></span><?endif;?>
								</p>
							<?endif;?>
						<?endforeach;?>
						<?if(is_array($arElement["PRICE_MATRIX"])):?>
								<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>

									<b style="padding-right:0;width:5%;font-size:11px;" valign="top"><?= GetMessage("CATALOG_QUANTITY") ?>:</b>
								<?endif?>
								<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>

									<b style="padding-right:0;width:5%;font-size:11px;" valign="top"><?= $arType["NAME_LANG"] ?>:</b>
								<?endforeach?>
							<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
								<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
									 	<?
										if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
											echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
										elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
											echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
										elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
											echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
										?>
								<?endif?>
								<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
									    <?
										if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>
											<s><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])?></s><span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
										<?else:?>
											<span class="catalog-price"><? if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"] == 1.00) echo 'звоните'; else echo FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]); ?></span>
										<?endif?>&nbsp;
								<?endforeach?>
							<?endforeach?>
							<br />
						<?endif?>

						<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<b style="font-size:11px;"><?=$arProperty["NAME"]?>:</b>&nbsp;<?
								if(is_array($arProperty["DISPLAY_VALUE"]))
									echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
								else
									echo $arProperty["DISPLAY_VALUE"];?><br />
						<?endforeach?>
						<b style="font-size:11px;">Вес:</b>&nbsp;<?=getElWeight($arElement["ID"]);?> гр.<br />
						<b style="font-size:11px;">Дополнительная информация:</b>&nbsp;<?=$arElement["PREVIEW_TEXT"]?>
					</td>
				</tr>
			</table>
			<br />


			<?if($arParams["DISPLAY_COMPARE"]):?>
				<a href="<?echo $arElement["COMPARE_URL"]?>"><?echo GetMessage("CATALOG_COMPARE")?></a>&nbsp;
			<?endif?>
			<?if(/*$arElement["CAN_BUY"]*/false):?>
				<a href="/personal/basket.php"><!--<?echo $arElement["BUY_URL"]?>В корзину<?echo GetMessage("CATALOG_ADD")?>-->Перейти в корзину</a>
				&nbsp;&nbsp;&nbsp;<a href="<?echo $arElement["ADD_URL"]?>">Добавить в корзину</a>
			<?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
				<?//=GetMessage("CATALOG_NOT_AVAILABLE")?>
			<?endif?>
			&nbsp;
		</td>

		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif?>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>

</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>