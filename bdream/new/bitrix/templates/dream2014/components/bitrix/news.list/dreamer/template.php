<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

<div class="dreams clearfix">
<?$elem_cnt=0;foreach($arResult["ITEMS"] as $arItem):

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
                        <article>
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <div class="about">
                                    <div class="img">
									<?if($arItem["PREVIEW_PICTURE"]["SRC"]!=""){?>
											<img src="<?=GetImageResized($arItem["PREVIEW_PICTURE"]["SRC"], 230, 165);?>" alt="<?=$arItem["NAME"]?>"/>
										<?}else if($arItem["DETAIL_PICTURE"]["SRC"]!=""){?>
											<img src="<?=GetImageResized($arItem["DETAIL_PICTURE"]["SRC"], 230, 165);?>" alt="<?=$arItem["NAME"]?>"/>
										<?}else if($arItem["PROPERTIES"]["PHOTO"]["VALUE"][0]!=""){?>
											<img src="<?=GetImageResized(CFile::GetPath($arItem["PROPERTIES"]["PHOTO"]["VALUE"][0]), 230, 165);?>" alt="<?=$arItem["NAME"]?>"/>
										<?}else{?>
											<img src="/bitrix/templates/dream2014/img/img_user.png" width="230" height="165" alt="<?=$arItem["NAME"]?>">
										<?}?>
										
                                    </div>
                                    <div class="text">
                                        <h4><?=$arItem["NAME"]?></h4>
                                        <p class="user"><?=$arItem["AR_USER"]["NAME"];?> <?=$arItem["AR_USER"]["LAST_NAME"];?>, <?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?></p>
                                        <p class="location"><?=$country."<br>".$arItem["AR_USER"]["PERSONAL_CITY"];?></p>
                                        <p class="dream">
										<?$cropString = mb_substr($arItem["DETAIL_TEXT"], 0, 97);
										if (mb_strlen($arItem["DETAIL_TEXT"]) > 97) {
											$cropString .= '...';
										}
										echo $cropString;
										?>
										</p>
                                    </div>
                                    <span class="tbd">TurboDreams</span>
                                </div>
                                <div class="needs clearfix">
                                    <div class="left">
			<div class="radial-progress" data-progress="<?=$persent?>">
                                            <div class="circle">
                                                <div class="mask full">
                                                    <div class="fill"></div>
                                                </div>
                                                <div class="mask half">
                                                    <div class="fill"></div>
                                                    <div class="fill fix"></div>
                                                </div>
                                                <div class="shadow"></div>
                                            </div>
			
			
                                            <div class="inset jCProgress">
                                                <div class="percentage"><?=$persent?>%</div>
                                            </div>
                                        </div>

			
			
                                        
                                    </div>
                                    <div class="right">
                                        <p>Требуется</p>
                                        <h3><?=number_format($need, 0, ',', ' ' );?> <?=$simbol;?></h3>
                                        <p>Собрано <?=$persent?>%</p>
                                        <p><?=number_format($yet, 2, ',', ' ' );?> <?=$simbol;?></p>
                                    </div>
                                </div>
                            </a>
                        </article>
						
						
	<?$elem_cnt++;
	if($elem_cnt==4){?>
		</div>
		<div class="dreams clearfix">                 
	<?$elem_cnt=0;
	}?>
<?endforeach;?>	
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>