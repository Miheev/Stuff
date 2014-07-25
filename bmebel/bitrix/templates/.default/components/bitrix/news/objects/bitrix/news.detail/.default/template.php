<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*
<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
	<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arResult["NAME"]?>" />
<?endif?>
<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
	<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
<?endif;?>
*/?>
<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
	<h2><?=$arResult["NAME"]?></h2>
<?endif;?>
	
<table class="dom_table" style="width:100%;">
	<tr>
		<td style="vertical-align:top; width:600px;">
			<img id="maki_house_big_image_id" src="<?=CFile::GetPath($arResult["DISPLAY_PROPERTIES"]['obj_houses']['VALUE'][0]['BIG'])?>" width="600" alt="<?=$arResult["DISPLAY_PROPERTIES"]['obj_houses']['DESCRIPTION'][0]?>" title="<?=$arResult["DISPLAY_PROPERTIES"]['obj_houses']['DESCRIPTION'][0]?>" />

			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
				<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
			<?endif;?>
			<?if($arResult["NAV_RESULT"]):?>
				<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
				<?echo $arResult["NAV_TEXT"];?>
				<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
		 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
				<?echo $arResult["DETAIL_TEXT"];?>
		 	<?else:?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
			<br />

			
		</td>
		<td class="dom_table_right" style="width:100%;">
			<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
				<? if ($pid=='obj_houses') { continue; } ?>
				<strong><?=$arProperty["NAME"]?></strong>&nbsp;&mdash;&nbsp;
				<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
					<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
				<?else:?>
					<?=$arProperty["DISPLAY_VALUE"];?>
				<?endif?>
				<br />
			<?endforeach;?>
			<?foreach($arResult["FIELDS"] as $code=>$value):?>
				<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
				<br />
			<?endforeach;?>
			<br />
			
			<div class="dom_vid">
				<strong>Виды на дом</strong>
				<br />
				<? foreach ($arResult["DISPLAY_PROPERTIES"]['obj_houses']['VALUE'] as $key => $value) { ?>
					<a href="<?=CFile::GetPath($value['BIG'])?>" onclick="changeImage('<?=CFile::GetPath($value['BIG'])?>', '<?=$arResult["DISPLAY_PROPERTIES"]['obj_houses']['DESCRIPTION'][$key]?>'); return false;"><img src="<?=CFile::GetPath($value['SMALL'])?>" width="80" height="80" title="<?=$arResult["DISPLAY_PROPERTIES"]['obj_houses']['DESCRIPTION'][$key]?>"></a>
				<? } ?>
			</div>
		</td>
	</tr>
</table>
	
	
</div>
