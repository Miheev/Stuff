<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:7px; width:640px">
<td colspan="2" style="padding:0px 0px 0px 0px; background: transparent url(/images/ny_back.jpg) repeat-y scroll center top;" class="blue_cn">
<table border="0" cellspacing="0" cellpadding="0" style="background:url(/images/ny_back.jpg) top repeat-y; width:640px;">
<tr>
<td style="background:url(/images/ny_top.jpg) top no-repeat; padding:0 25px;">
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table" cellspacing="0" cellpadding="2">
	<thead>
		<tr>
			<td colspan="2" align="center"><strong><?//=GetMessage("IBLOCK_FILTER_TITLE")?>&nbsp;</strong></td>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top" height="30"><strong><?=$arItem["NAME"]?>:&nbsp;</strong></td>
					<td valign="top" height="30"><?=$arItem["INPUT"]?></td>
				</tr>
			<?endif?>
		<?endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				<input type="submit" name="set_filter" value="Искать" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /></td>
		</tr>
	</tfoot>
	</table>
</form>
</td></tr>
</table>
<br />
<hr color="#6995BC" />
<table border="0" cellspacing="0" cellpadding="0" style="background:url(/images/ny_bot.jpg) bottom no-repeat; width:640px;">
<tr>
<td>