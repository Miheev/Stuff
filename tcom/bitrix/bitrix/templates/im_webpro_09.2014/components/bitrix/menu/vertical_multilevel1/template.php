<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//$frame= $this->createFrame()->begin('<img src="'.SITE_TEMPLATE_PATH.'/img/wait27.gif" alt="" />');
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):?>

    <?

    ?>

<!--<div class="LeftMenuUL">-->
<ul class="menu sf-menu sf-vertical">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):
	$i = $key;
			$bHasSelected = $arItem['SELECTED'];
			$childSelected = false;
			if (!$bHasSelected)         //если не выбран родитель, проверим не выбраны ли дети
			{
				while ($arResult[++$i]['DEPTH_LEVEL'] > $arItem['DEPTH_LEVEL'])
				{
					if ($arResult[$i]['SELECTED'])
					{
						$bHasSelected = $childSelected = true; break;   // если выбран ребенок, то выбираем и родителя
					}
				}
			}
	?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
	<li class="HeaderNav<?echo $arItem["SELECTED"] ? ' sfHover' : ''; ?>"><a href="<?=$arItem["LINK"]?>" class="showlist <?if ($arItem["SELECTED"]):?>root-item-selected<?else:?><?endif?>" <?echo empty($arItem["ID"])? '' : 'id="'.$arItem["ID"].'"';?>><?=$arItem["TEXT"]?></a>

				<ul class="HeaderUL open<?=$arItem["ID"]?>" <?if (!$childSelected && $bHasSelected){?>style="display:block;"<?}?>>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" class="showlist parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>" <?echo empty($arItem["ID"])? '' : 'id="'.$arItem["ID"].'"';?>><?=$arItem["TEXT"]?></a>
				<ul class="HeaderUL open<?=$arItem["ID"]?>" <?if ($arItem['DEPTH_LEVEL'] > 1 && !$childSelected && $bHasSelected){?>style="display:block;"<?}?>>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li <?echo $arItem["SELECTED"] ? 'class="sfHover"' : ''; ?>><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<!--</div>-->

<script type="text/javascript">
/*
	$(document).ready(function(){
		$(".showlist").click(function () {
			var id=$(this).attr('id');		
			if ($(this).attr("data-row") != 'shown'){
				$('.open'+id).hide("normal");
				$('.open'+id).attr({"data-row": 'hidden'});
			}else{
				$('.open'+id).show("normal");
				$('.open'+id).attr({"data-row": 'shown'});
			}
		
			$('.open'+id).hide("normal");
			$(this).find('.HeaderUL').show("normal");	
		});
	});
	//*/
	$('.HeaderNav').click(
	function() {
		if ($(this).attr("data-row") != 'shown') {
			$(this).find('.HeaderUL').show("normal");
			$(this).attr({"data-row": 'shown'})
		}
		else {
			$(this).find('.HeaderUL').hide("normal");
			$(this).attr({"data-row": 'hidden'})
		}
}/*,
	function() {
		$(this).find('.HeaderUL').hide("normal");
}*/
)
</script>
<?endif?>

<?//$frame->end();?>