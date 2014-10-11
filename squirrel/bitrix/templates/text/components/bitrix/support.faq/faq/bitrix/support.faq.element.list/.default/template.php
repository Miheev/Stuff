<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//elements list?>
<a name="top"></a>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
	<li class="point-faq"><a href="#<?=$val["ID"]?>"><?=$val['NAME']?></a><br/></li>
<?endforeach;?>
<br/>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
<a name="<?=$val["ID"]?>"></a>
<table cellpadding="0" cellspacing="0" class="data-table" width="100%">
	<tr>
		<th>
		<?
		//add edit element button
		if(isset($val['EDIT_BUTTON']))
			echo $val['EDIT_BUTTON'];
		?>
		<?=$val['NAME']?>
		</th>
	</tr>
	<tr>
		<td>
		<?=$val['PREVIEW_TEXT']?>
		<?=$val['DETAIL_TEXT']?>
		<br/>
		<a href="#top"><?=GetMessage("SUPPORT_FAQ_GO_UP")?></a>
		</td>
	</tr>
</table>
<br/>
<?endforeach;?>