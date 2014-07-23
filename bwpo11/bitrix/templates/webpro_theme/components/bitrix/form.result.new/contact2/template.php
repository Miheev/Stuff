<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<table class="form-table data-table">
	<thead>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<? //var_dump($arResult["QUESTIONS"]);
    //SIMPLE_QUESTION_780
    //SIMPLE_QUESTION_835
    //SIMPLE_QUESTION_456
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
		<tr>
			<td>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
			</td>
		</tr>
	<?
		}
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
	</tbody>
</table>

    <div class="appnitro">
        <p style="border-bottom: 1px dashed #bec1c3; padding-bottom: 5px; margin: 0px; padding-top: 10px;"></p>

        <p>Ведите имя и E-mail<span
                style="color: rgb(175, 0, 0); font-size: 11px;">(Обязательное поле)</span>:
        </p>
        <?php echo $arResult["QUESTIONS"]['SIMPLE_QUESTION_780']["HTML_CODE"]; ?>
        <?php echo $arResult["QUESTIONS"]['SIMPLE_QUESTION_835']["HTML_CODE"]; ?>
        <p style=" margin-bottom: -10px; ">Впишите ваш вопрос <span
                style="color: rgb(175, 0, 0); font-size: 11px;">(Обязательное поле)</span>:
        </p>
        <?php echo $arResult["QUESTIONS"]['SIMPLE_QUESTION_456']["HTML_CODE"]; ?>

                <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" class="btx-otprav" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />

    </div>

<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
