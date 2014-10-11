<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$frame= $this->createFrame()->begin('<img src="'.SITE_TEMPLATE_PATH.'/img/wait27.gif" alt="" />');
?>
<?if ($arResult["isFormErrors"] == "Y"):?>
    <div class="error-msg">
    <?=$arResult["FORM_ERRORS_TEXT"];?>
    </div>
<?endif;?>

<?=$arResult["FORM_NOTE"]?>
<?$frame->end();?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

    <h3><?=$arResult["FORM_TITLE"]?></h3>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
    <div class="form-content">
    <div class='inputs'>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
			<?=$arQuestion["HTML_CODE"]?>
	<?
		}
	} //endwhile
	?>
    </div>
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
        <p class="text">После заказа звонка наши сотрудники свяжутся с Вами в ближайшее время</p>
<div class="buttons">
    <input class="abutton" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
    <?if ($arResult["F_RIGHT"] >= 15):?>
        <!--				&nbsp;<input type="hidden" name="web_form_apply" value="Y" />-->
        <!--                    <input type="submit" name="web_form_apply" value="--><?//=GetMessage("FORM_APPLY")?><!--" />-->
    <?endif;?>
    <!--				&nbsp;<input type="reset" value="--><?//=GetMessage("FORM_RESET");?><!--" />-->
</div>
<?//=$arResult["REQUIRED_SIGN"];?><!-- - --><?//=GetMessage("FORM_REQUIRED_FIELDS")?>
    </div>
    <?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)

?>