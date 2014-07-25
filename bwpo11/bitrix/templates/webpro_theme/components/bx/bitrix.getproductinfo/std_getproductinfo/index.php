<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$frame= $this->createFrame()->begin();
?>
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
		?>
		<p><h3><a href="<?=$val["URL"]?>"><?=$val["TITLE"]?></a></h3>
		<?=$val["DESCRIPTION"]?>
		</p>
		<?
	}
}
$this->end();
?>
</div>