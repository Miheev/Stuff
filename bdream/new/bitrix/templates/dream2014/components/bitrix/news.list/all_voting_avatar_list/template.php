<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$i=0;
foreach($arResult["USER"] as $arUser):?>
<div class="allVoteList" >
<?$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);

if($arUser["PERSONAL_PHOTO"]):?>
	<img src="<?=GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 52, 52);?>"/>
<?else:?>
	<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="52" height="52" alt="">
<?endif;?>
	<div style="float: left;">
		<span><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?></span><br>
		<span><?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?></span><br>
		<span><?=$country.", ".$arUser["PERSONAL_CITY"];?></span>
	</div>
</div>
<?
$i++;
if($i==2):
$i=0;
?>
<div style="clear: both;"></div>
<?endif;
endforeach;?>
<div style="clear: both;"></div><br>



