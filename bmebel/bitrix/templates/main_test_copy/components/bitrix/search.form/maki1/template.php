<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=$arResult["FORM_ACTION"]?>" class="search">
	<input type="text" id="srch" name="q" value="" maxlength="50" />
	<input name="s" id="srch_btn" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" style="font-size:11px; height:22px;" />
</form>
