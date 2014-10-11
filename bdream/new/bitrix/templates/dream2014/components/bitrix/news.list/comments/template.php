<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>
<?
$j=0;
$totalCount = count($arResult["ITEMS"]);

foreach($arResult["ITEMS"] as $arItem):
$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), array("ID"=>$arItem["PROPERTIES"]["USER"]["VALUE"]));
while($arUsers = $rsUsers->Fetch()):
	$arrUSER = $arUsers;
endwhile;
$j++;
$year = intval((time()-MakeTimeStamp($arrUSER["PERSONAL_BIRTHDAY"]))/31556926);
$country = GetCountryByID($arrUSER["PERSONAL_COUNTRY"]);

?>

<div class="clean-block">
                    <div class="header">
                        <div class="img">
                            <?if($arrUSER["PERSONAL_PHOTO"]):?>
								<img src="<?=GetImageResized(CFile::GetPath($arrUSER["PERSONAL_PHOTO"]), 71, 71);?>"/>
							<?else:?>
								<img src ="<?=GetImageResized(SITE_TEMPLATE_PATH."/images/img_user_big.png", 71, 71);?>">
							<?endif;?>
                        </div>
                        <div class="info">
                            <p class="name"><?=$arrUSER["NAME"]." ".$arrUSER["LAST_NAME"];?></p>
                            <p class="location"><?=$country.GetMessage("G").$arrUSER["PERSONAL_CITY"];?></p>
                            <p class="work">
								<?$i=0;?> 
								<?foreach ($arItem["ACTION"] as $name):
									if($i>0)
										echo ", ";
								
									echo $name;
									$i++;
								endforeach;?>
							</p>
                            <p class="datetime">
								<?$explodeDate = explode(" ", $arItem["DATE_CREATE"]);
									echo GetMessage("DATE").$explodeDate[0]."<br>";
									echo $explodeDate[1];
								?>
							</p>
                        </div>
                    </div>
                    <div class="content">
                        <?=$arItem["DETAIL_TEXT"];?>
                    </div>
                </div>
				
	
<?endforeach;?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?else:?>
<p><?=GetMessage("DONT_START");?></p>
<?endif;?>
