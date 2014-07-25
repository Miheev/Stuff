<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript">
$(document).ready(function(){
	$('.right-filter-more').bind('click',function(){
        $('.right-filter-addition').slideDown('slow');
        $(this ).find('span').fadeOut('slow');
	});
});

</script>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="data-table right-filter" cellspacing="0" cellpadding="2">
	<thead>
		<tr>
			<td colspan="2" class="right-filter-title"><b><?=GetMessage("IBLOCK_FILTER_TITLE")?></b></td>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
                <? if($arItem['INPUT_NAME'] == 'arrFilter_pf[maki_area][RIGHT]'):?>
				<tr>
					<td class="right-filter-name"><label><?=$arItem["NAME"]?></label></td>
					<td class="right-filter-input small-select" >
                       <? $maki_area_left = array(50, 100, 150, 200, 250, 300, 350, 400, 450, 500);?>
                       <? $maki_area_right = array(100, 150, 200, 250, 300, 350, 400, 450, 500, 550 );?>

                        <select name="arrFilter_pf[maki_area][LEFT]" >
                             <option value="0">от</option>
                            <? foreach($maki_area_left as $value):?>
                                <option value="<? echo $value ;?>"  <? if ($_GET['arrFilter_pf']['maki_area']['LEFT'] == $value){ echo 'selected="selected"' ;}?>   ><? echo $value ;?></option>
                            <? endforeach;?>
                        </select>
                        <select  name="arrFilter_pf[maki_area][RIGHT]">
                            <option value="10000" >до</option>
                            <? foreach($maki_area_right as $value):?>
                                <option value="<? echo $value ;?>"  <? if ($_GET['arrFilter_pf']['maki_area']['RIGHT'] == $value){ echo 'selected="selected"'; }?>  ><? echo $value ;?></option>
                            <? endforeach;?>
                        </select>
                        м<sup>2</sup>
                       </td>
				</tr>
                <? endif;?>

                <? if($arItem['INPUT_NAME'] == 'arrFilter_pf[maki_country]' || $arItem['INPUT_NAME'] == 'arrFilter_pf[maki_stuff_list]'):?>

				<tr>
					<td class="right-filter-name" ><label><?=$arItem["NAME"]?> </label></td>
					<td class="right-filter-input" ><?=$arItem["INPUT"]?></td>
				</tr>
                <? endif;?>
			<?endif?>
		<?endforeach;?>


	</tbody>
	<tfoot class="right-filter-addition">


	</tfoot>
	</table>


    <div class="right-filter-addition">
        <? $count = 1 ;?>
 		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
                <? if($arItem['INPUT_NAME'] == 'arrFilter_pf[maki_country]' || $arItem['INPUT_NAME'] == 'arrFilter_pf[maki_stuff_list]' || $arItem['INPUT_NAME'] == 'arrFilter_pf[maki_area][RIGHT]'):?>

                <? else: ?>
				<p>
				    <label><?=$arItem["NAME"]?></label>
				    <span class="right-filter-addition-input-<? echo $count;?>"><?=$arItem["INPUT"]?></span>
				</p>
                <? endif;?>
			<?endif?>
        <? $count++?>
		<?endforeach;?>


    </div>
    <div class="right-filter-submit">
	    <input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
        <input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;
    </div>
   <div class="right-filter-more">
        <span>Расширеный поиск</span>
   </div>

</form>
