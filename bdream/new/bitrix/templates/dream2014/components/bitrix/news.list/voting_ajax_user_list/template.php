<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(count($arResult["USER"])>0):
if($_REQUEST["PAGEN_1"]>$arResult["NAV_RESULT"]->NavPageCount):
	echo "page_end";
else:
	$i=0;
	foreach($arResult["USER"] as $arUser):
	$i++;
	?>
	<div class="realUserBlock lilac <?if($iCount==1):?> activeMember<?endif;?>" <?if($i==2):?>style="margin-left: 5px;"<?$i=0; endif;?> rel="<?=$res["USER_ID"];?>">
		<div class="voting_dream_id" rel="<?=$arUser["USER_INFO"]["ID"];?>">
		
		<?
		$country = GetCountryByID($arUser["USER_INFO"]["PERSONAL_COUNTRY"]);
		$year = intval((time()-MakeTimeStamp($arUser["USER_INFO"]["PERSONAL_BIRTHDAY"]))/31556926);
		?>
			<div class="realationLeft">
			<?if($arUser["USER_INFO"]["PERSONAL_PHOTO"]):?>
				<img src="<?=GetImageResized(CFile::GetPath($arUser["USER_INFO"]["PERSONAL_PHOTO"]), 52, 52);?>"/>
			<?else:?>
				<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="52" height="52" alt="">
			<?endif;?>
			</div>
			<span class="realName">
				<?=$arUser["USER_INFO"]["NAME"];?><br>
				<?=$arUser["USER_INFO"]["LAST_NAME"];?>
			</span>
			<div style="clear: both;"></div>
			<span class="realUserInfo">
				<?=$country.", ".$arUser["USER_INFO"]["PERSONAL_CITY"];?>
			<div class="vote_count_<?=$arUser["DREAM_INFO"]["ID"];?>"><?=GetMessage("VOTE_YET");?><span><?=$arUser["VOTE"];?></span></div>
			</span>
		</div>	
	</div>
<?endforeach;
endif;?>
<?else:?>
	
<?endif;?>