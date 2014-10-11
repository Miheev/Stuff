<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
$rsUser = CUser::GetByID(intval($arResult["PROPERTIES"]["USER"]["VALUE"]));
$arUser = $rsUser->Fetch();

$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
?>
<div class="turboDreamsDetail">
<?
if(is_array($arResult["PROPERTIES"]["PHOTO"]["VALUE"] ) && count($arResult["PROPERTIES"]["PHOTO"]["VALUE"])>0):
shuffle($arResult["PROPERTIES"]["PHOTO"]["VALUE"]);
?>
<div class ="turboDetMainPhoto">
	<a href="<?=CFile::GetPath($arResult["PROPERTIES"]["PHOTO"]["VALUE"][0]);?>" rel="prettyPhoto">
		<img src="<?=GetImageResized(CFile::GetPath($arResult["PROPERTIES"]["PHOTO"]["VALUE"][0]), 500, 400);?>" alt="<?=$arResult["NAME"];?>"/>
	</a>
</div>
<?
?>
<div class="turboMorePhoto">
	<?
	$i=0;
	if(count($arResult["PROPERTIES"]["PHOTO"]["VALUE"])>1):
		foreach ($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $imgId):
			if($i==4)
			{
				break;
			}
			if($i>0):
			?>
				<a href="<?=CFile::GetPath($imgId);?>" rel="prettyPhoto">
					<img src="<?=GetImageResized(CFile::GetPath($imgId), 120, 120);?>" alt="<?=$arResult["NAME"];?>"/>
				</a>
			<?
			endif;
		$i++;
		endforeach;
	endif;
	?>
</div>
<?endif;?>
<div style="clear: both;"></div>
<?if($arResult["PROPERTIES"]["STATE"]["VALUE_ENUM_ID"]==5):?>
<div style="background: #19AF1C; padding: 5px; color: #fff;">
	Мечта <?=$arResult["NAME"];?> исполенена<br>
</div>
<?else:?>
<div>
	<?=$arResult["NAME"];?>
</div>
<?endif;?>
<br>
<div>
	<?=$arResult["DETAIL_TEXT"];?>
</div><br>
<div><b>О себе:</b></div>
<div>
	<?=$arResult["PROPERTIES"]["ABOUT_ME"]["VALUE"]["TEXT"];?>
</div>

</div>
<div class="turboDreamsPersona">
	<div><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?>
		<span style="font-size: 11px;"><?=$year." ".ruDecline($year,"год","года","лет");?></span>
	</div>
	<div><?=$country.", ".$arUser["PERSONAL_CITY"];?></div>
	<?if (CModule::IncludeModule("blog")):
		$arUserBlog = CBlog::GetByOwnerID($arResult["PROPERTIES"]["USER"]["VALUE"]);
	endif;?>
	<?if($arUserBlog["URL"]):?>
		<a href="/blogs/<?=$arUserBlog["URL"];?>/">Блог пользователя</a><br><br>
	<?endif;?>
	<div>
	<?if(count($arUser["UF_WEB"])>0):?>
	Веб сайты:
	<?
	foreach ($arUser["UF_WEB"] as $key=>$arWeb):
				$cropString = mb_substr($arUser["UF_WEB"][$key], 0, 30);
				if (mb_strlen($arUser["UF_WEB"][$key]) > 30) {
					$cropString .= '...';
				}
			?>
				<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a><br>
	<?endforeach;
	endif;
	global $AR_CUR_SIMBOL;
	
	CModule::IncludeModule("sale");
	$dbAccountCurrency = CSaleUserAccount::GetList(
			array(),
			array("USER_ID" => $arResult["PROPERTIES"]["USER"]["VALUE"]),
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
	</div>
	<br>
	<div class="turboDreamsDetailBlock">
		<?if($arResult["PROPERTIES"]["TURBO_YET"]["VALUE"]):
			$yet = $arResult["PROPERTIES"]["TURBO_YET"]["VALUE"];
		else:
			$yet = 0;
		endif;?>
		<?if($arResult["PROPERTIES"]["TURBO_NEED"]["VALUE"]):
			$need = $arResult["PROPERTIES"]["TURBO_NEED"]["VALUE"];
		else:
			$need = 0;
		endif;
		if($yet<$need)
		{
			$persent = round($yet*100/$need);
		}
		else 
		{
			$persent = 100;
		}
		?>
		<div class="turboYet"><?=number_format($yet, 2, ',', ' ' );?> <?=$simbol;?><br></div>
		<div class="turboNeed">требуется <?=number_format($need, 0, ',', ' ' );?> <?=$simbol;?><br></div>
		<? 
			$helpCount = 0;
			$arFilter = Array("IBLOCK_ID"=>7, "PROPERTY_DREAM"=>$arResult["ID"], "PROPERTY_TYPE"=>9);
			$res = CIBlockElement::GetList(Array(), $arFilter, array("PROPERTY_DREAM"));
			while($ob = $res->Fetch())
			{
				$helpCount = $ob["CNT"];
			}
		?>
		<p>
		<?
		if($helpCount>0):?>
			<br><a href="/turbo_dreams/turbo_help.php?DREAM_ID=<?=$arResult["ID"];?>" class="turboHelpYet"><?=$helpCount;?><br><span>уже помогли</span></a>
		<?endif;?>
		</p>
		<?if($persent>0):?>
			<div id="turboProgress_<?=$arResult["ID"];?>"></div>
			<script>
				$( document ).ready(function() {
					$('#turboProgress_<?=$arResult["ID"];?>').cprogress({
						percent: 0,
						limit: <?=$persent;?>,
					    img1: '<?=SITE_TEMPLATE_PATH."/js/progress/img/progress_big.png"?>', // background
					    img2: '<?=SITE_TEMPLATE_PATH."/js/progress/img/progress_bg_big.png"?>', // foreground
					    speed: 1,
					});
				});
			</script>
		<?else:?>
			<div class="jCProgress" style="width: 120px; height: 120px; background: url('<?=SITE_TEMPLATE_PATH."/js/progress/img/progress_big.png"?>') center no-repeat;">
				<div class="percent">0%</div>
			</div>
		<?endif;?>
		<a href="/turbo_dreams/pay.php?DREAM_ID=<?=$arResult["ID"];?>" class="turboHelpBtn">Платёж</a>
	</div>
		
</div>
<div style="clear: both;"></div>
<script>
	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
</script>