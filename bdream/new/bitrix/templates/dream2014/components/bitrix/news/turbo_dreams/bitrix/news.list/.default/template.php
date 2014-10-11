<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="wrapTurboDreamsList">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):

$year = intval((time()-MakeTimeStamp($arItem["AR_USER"]["PERSONAL_BIRTHDAY"]))/31556926);
$country = GetCountryByID($arItem["AR_USER"]["PERSONAL_COUNTRY"]);

if($arItem["PROPERTIES"]["TURBO_YET"]["VALUE"])
{
	$yet = $arItem["PROPERTIES"]["TURBO_YET"]["VALUE"];
}
else
{
	$yet = 0;
}
	
if($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"])
{
	$need = $arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"];
}
else
{
	$need = 0;
}


$persent = round($yet*100/$need);
if($persent>100)
{
	$persent = 100;
}
global $AR_CUR_SIMBOL;
CModule::IncludeModule("sale");
$dbAccountCurrency = CSaleUserAccount::GetList(
		array(),
		array("USER_ID" => $arItem["PROPERTIES"]["USER"]["VALUE"]),
		false,
		false,
		array("CURRENCY")
);
if($arAccountCurrency = $dbAccountCurrency->Fetch())
{
	$simbol = $AR_CUR_SIMBOL[$arAccountCurrency["CURRENCY"]];
}
else
{
	$simbol = $AR_CUR_SIMBOL["USD"];
}
?>

	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="turboDreamsBlock <?if($persent=="100"):?> full<?endif;?>">
	<div style="float: left; width: 240px; height: 128px;overflow: hidden;">
		<?if($arItem["AR_USER"]["PERSONAL_PHOTO"]):?>
				<img src="<?=GetImageResized(CFile::GetPath($arItem["AR_USER"]["PERSONAL_PHOTO"]), 79, 79);?>"/>
			<?else:?>
				<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="79" height="79" alt="">
		<?endif;?>
		<span class="turboUserInfo">
			<?=$arItem["AR_USER"]["NAME"];?> <?=$arItem["AR_USER"]["LAST_NAME"];?>
			<br>
				<?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?><br>
				<?=$country."<br>".$arItem["AR_USER"]["PERSONAL_CITY"];?>
		</span>
		<div style="clear: both;"></div>
		<?$cropString = mb_substr($arItem["DETAIL_TEXT"], 0, 105);
		if (mb_strlen($arItem["DETAIL_TEXT"]) > 105) {
			$cropString .= '...';
		}
		echo $cropString;
		?>
		
	</div>	
		<div class="turboMonyBlock">
			<?=GetMessage("NEED");?><br>
				<?=number_format($need, 0, ',', ' ' );?> <?=$simbol;?><br>
			<?=GetMessage("YET");?><br>
				<?=number_format($yet, 2, ',', ' ' );?> <?=$simbol;?><br>
			
			<?
			if($persent>0):?>
			<div id="turboProgress_<?=$arItem["ID"];?>" style="width: 70px; height: 70px; margin: 0 auto;"></div>
			<script>
				$( document ).ready(function() {
					$('#turboProgress_<?=$arItem["ID"];?>').cprogress({
						percent: 0,
						limit: <?=$persent;?>,
					    img1: '<?=SITE_TEMPLATE_PATH."/js/progress/img/progress1.png"?>', // background
					    img2: '<?=SITE_TEMPLATE_PATH."/js/progress/img/progress2.png"?>', // foreground
					    speed: 1,
					});
				});
			</script>	
			<?else:?>
			<div class="jCProgress" style="width: 70px; height: 70px; background: url('<?=SITE_TEMPLATE_PATH."/js/progress/img/progress1.png"?>') center no-repeat;">
				<div class="percent">0%</div>
			</div>
			<?endif;?>		
		</div>	
	</a>
<?endforeach;?>	
<div style="clear: both;"></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
