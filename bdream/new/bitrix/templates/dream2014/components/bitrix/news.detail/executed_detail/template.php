<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
$rsUser = CUser::GetByID(intval($arResult["PROPERTIES"]["USER"]["VALUE"]));
$arUser = $rsUser->Fetch();

$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
?>

<h1 id="pageTitleCrimson">
<?=GetMessage("EX_DREAM");?><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?><div class="crimsonHr"></div>
</h1><br>
<div style="float: left;">
	<div class="detailExecutedBlock">
		<div style="clear: both;"></div>
		<div style="float: right;"><?=ConvertTimeStamp(MakeTimeStamp($arResult["PROPERTIES"]["DATE_EXECUTED"]["VALUE"]));?></div>
		<div style="clear: both;"></div>
		<div style="float: left;">
			<img src="<?=GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 120, 120);?>"/>
		</div>
		<div style="float: left; width: 675px; margin-left: 15px;">
			<div class="executedDetailUserName"><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?><span style="float: right;"><?=GetMessage("DATE_EX");?></span></div>
			<div style="padding-bottom: 3px;"><?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?></div>
			<div><?=$country.", ".$arUser["PERSONAL_CITY"];?></div>
			<br><br>
			<div><?=GetMessage("DREAM");?>"<?=$arResult["NAME"];?>" - <?=$arResult["DETAIL_TEXT"];?></div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<hr style="border: 1px solid #ccc; margin: 10px;">
	<div class="executedDetailText">
		<span style="padding-left: 10px;"><b><?=GetMessage("VIDEO");?></b></span>
		<div style="clear: both;"></div><br>
		<?if(is_array($arResult["PROPERTIES"]["YUOTUBE"]["VALUE"]) && count($arResult["PROPERTIES"]["PHOTO"]["VALUE"])>0):
			$i=0;
			foreach($arResult["PROPERTIES"]["YUOTUBE"]["VALUE"] as $link):
			$i++;
			?>
				<iframe <?if($i==2):?> style="margin-left: 75px;"<?$i=0; endif;?>width="380" height="275" src="<?=$link?>" frameborder="0" allowfullscreen></iframe>
			<?endforeach;
		endif;?>
		<div style="clear: both;"></div>
		<hr style="border: 1px solid #ccc; margin: 10px;">
		<span><b><?=GetMessage("DREAM_COMMENT");?></b></span>
		<div><?=$arResult["PROPERTIES"]["DESCRIPTION_EXECUTE"]["VALUE"]["TEXT"];?></div>
		
		<div style="clear: both;"></div>
		<hr style="border: 1px solid #ccc; margin: 10px;">
		<span><b><?=GetMessage("COMMENT");?><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?><?=GetMessage("ABOUT_EX_DREAM");?></b></span>
		<div><?=$arResult["PROPERTIES"]["USER_COMMENTS"]["~VALUE"]["TEXT"];?></div>
		
	</div>
	
</div>
<div style="float: right; margin-right: 5px;">
	<?if(is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"]) && count($arResult["PROPERTIES"]["PHOTO"]["VALUE"])>0):
					foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $arImg):?>
							<a href="<?=CFile::GetPath($arImg);?>" rel="prettyPhoto"><img src="<?=GetImageResized(CFile::GetPath($arImg), 120, 120);?>"/></a>
							<div style="clear: both;"></div><br>
					<?endforeach;?>
	<?endif;?>
</div>
<div style="clear: both;"></div>
<script>
	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
</script>