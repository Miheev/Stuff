<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (strlen($arResult['ERROR'])>0) { ?>
	<? ShowError($arResult['ERROR']) ?>
<? } ?>
<? if (strlen($arResult['NOTE'])>0) { ?>
	<? ShowNote($arResult['NOTE']) ?>
<? } ?>

<form action="" method="POST">
	<table class="zakas">
		<tr>
			<td><?=GetMessage('MAKI_ORDER_HOUSE_FIELD_NAME')?></td>
			<td>
				<input type="hidden" name="NAME_DESC" value="<?=GetMessage('MAKI_ORDER_HOUSE_FIELD_NAME')?>" />
				<input type="text" name="NAME" value="<?=$arResult['NAME']?>" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage('MAKI_ORDER_HOUSE_FIELD_СOMPANY')?></td>
			<td>
				<input type="hidden" name="COMPANY_DESC" value="<?=GetMessage('MAKI_ORDER_HOUSE_FIELD_СOMPANY')?>" />
				<input type="text" name="COMPANY" value="<?=$arResult['COMPANY']?>" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage('MAKI_ORDER_HOUSE_FIELD_PHONE')?></td>
			<td>
				<input type="hidden" name="PHONE_DESC" value="<?=GetMessage('MAKI_ORDER_HOUSE_FIELD_PHONE')?>" />
				<input type="text" name="PHONE" value="<?=$arResult['PHONE']?>" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage('MAKI_ORDER_HOUSE_FIELD_EMAIL')?></td>
			<td>
				<input type="hidden" name="EMAIL_DESC" value="<?=GetMessage('MAKI_ORDER_HOUSE_FIELD_EMAIL')?>" />
				<input type="text" name="EMAIL" value="<?=$arResult['EMAIL']?>" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage('MAKI_ORDER_HOUSE_FIELD_DESCRIPTION')?></td>
			<td>
				<input type="hidden" name="DESCRIPTION_DESC" value="<?=GetMessage('MAKI_ORDER_HOUSE_FIELD_DESCRIPTION')?>" />
				<textarea name="DESCRIPTION"><?=$arResult['DESCRIPTION']?></textarea>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<div class="mf-captcha">
					<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
					<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
					<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
					<input type="text" name="captcha_word" size="30" maxlength="50" value="">
				</div>
			</td>
		</tr>
		</tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="SUBMIT" value="<?=GetMessage('MAKI_ORDER_HOUSE_SUBMIT')?>" /></td>
		</tr>
	</table>
</form>