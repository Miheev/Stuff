<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.container-filtr {
	display:block;
	padding:0px;
	margin: 0px;
	width: 660px;
	margin-left: auto;
	margin-right: auto;
background-color: #fff;
display:table;
}

.container-filtr > div {
display:table-cell;
	width: 150px;
}
.cell2 {
vertical-align:top;
display:table-cell;
padding: 5px;
background-color: #D9E4EA;
border: 2px solid #fff;
}
.container-filtr p
{
padding-bottom: 5px;
font: 18px/1 MyriadProSemibold;
}
.her1
{
width:154px; float:left;
}
.cell2last {width:310px !important;}
.list-selection-element {margin-top:10px;}
</style>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]; echo"filtr/";?>" method="get">
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table" cellspacing="0" cellpadding="2">
	<tbody>
				<tr>
					<td valign="top">
<div class="container-filtr">
  <div class="cell2"><p>Цена</p><?=$arResult["ITEMS"]["Цена"]["INPUT"]?></div>
  <div class="cell2"><p>Вес</p><?=$arResult["ITEMS"]["Вес"]["INPUT"]?></div>
  <div class="cell2 cell2last"><?=$arResult["ITEMS"]["Раздел"]["INPUT"]?></div>
</div>
					</td>
				</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" /></td>
		</tr>
	</tfoot>
	</table>
</form>
<?
   if($USER->GetID()==1)
    {
       //echo "<pre>"; print_r($arResult["ITEMS"]); echo "</pre>"; 
    }
?>