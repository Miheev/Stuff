<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=$arResult["FORM_ACTION"]?>" class="search">
	<input type="text" name="q" value="" maxlength="50" />
	<input class="s_button" name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>"  />
</form>
