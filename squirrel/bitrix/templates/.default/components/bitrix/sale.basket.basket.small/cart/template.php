<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $cnt = 0; ?>
<table class="sale_basket_small">
	<? foreach ($arResult["ITEMS"] as $v) $cnt += $v["QUANTITY"]; ?>
	<tr>
		<td align="left" style="padding-left:60px;">� ������� <strong><?=$cnt;?></strong> �������</td>
		<td align="right"><a href="<?=$arParams["PATH_TO_BASKET"];?>">������� � �������</td>
	</tr>
</table>