<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$iCount = 0;
foreach ($arResult["USERS"] as $res):
	$iCount++;

$year = intval((time()-MakeTimeStamp($res["PERSONAL_BIRTHDAY"]))/31556926);

$country = GetCountryByID($res["PERSONAL_COUNTRY"]);
if($_REQUEST["PAGEN_1"]>$arResult["NAV_RESULT"]->NavPageCount):
	echo "page_end";
	break;
else:?>
	<div class="verticalScrollElement">
	<div class="realUserBlock green member_dream_id" rel="<?=$res["ID"];?>">
		<div class="realationLeft">
			<?if($res["PERSONAL_PHOTO"]):?>
				<img src="<?=GetImageResized(CFile::GetPath($res["PERSONAL_PHOTO"]), 52, 52);?>"/>
			<?else:?>
				<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="52" height="52" alt="">
			<?endif;?>
		</div>
		
			<span class="realName"><?=$res["NAME"];?><br>
			<?=$res["LAST_NAME"];?></span>
			<div style="clear: both;"></div>
			<span class="realUserInfo">
				<?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?><br>
				<?=$country.", ".$res["PERSONAL_CITY"];?>
			</span>	
	</div>
	</div>
	<div style="clear: both;"></div>
<?endif;?>
<?endforeach;?>