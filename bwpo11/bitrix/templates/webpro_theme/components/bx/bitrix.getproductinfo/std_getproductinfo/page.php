<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bx-product">
<?if(!empty($arResult["ERROR"]))
{
	foreach($arResult["ERROR"] as $val)
		ShowError($val);
}?>

<?
if(!empty($arResult["ITEMS"]))
{
	foreach($arResult["ITEMS"] as $val)
	{
		if(!$arResult["isOnePage"])
		{
			?>
			<div align="right"><a href="<?=$arResult["PATH_TO_LIST"]?>"><?=GetMessage("BACK_TO_LIST")?></a></div>
			<?
		}
		?>
		<div><?=$val["DESCRIPTION"]?></div>
		<?
	}
}
?>
</div>