<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	
		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=>3, "PROPERTY_DREAM"=>$arItem["ID"]);
		$rsDream = CIBlockElement::GetList(Array(), $arFilter, Array("PROPERTY_DREAM"));
		if($arDream = $rsDream->Fetch())
		{
			$vote = $arDream["CNT"];
		}
		else
		{
			$vote = 0;
		}
	

		$endingArray = array(GetMessage("PEOPLE"), GetMessage("PEOPLES"), GetMessage("PEOPLE"));
		function getNumEnding($totalUsers, $endingArray)
		{
			$number = $number % 100;
			if ($number>=11 && $number<=19) {
				$ending=$endingArray[2];
			}
			else {
				$i = $number % 10;
				switch ($i)
				{
					case (1): $ending = $endingArray[0]; break;
					case (2):
					case (3):
					case (4): $ending = $endingArray[1]; break;
					default: $ending=$endingArray[2];
				}
			}
			return $ending;
		}

		
		
	?>
	<div style="float: left;">
		<?if($arItem["DETAIL_PICTURE"]["SRC"]):?>
			<img class="mainVotingImg" src="<?=GetImageResized($arItem["DETAIL_PICTURE"]["SRC"], 190,190);?>" />
		<?elseif($arItem["PROPERTIES"]["PHOTO"]):?>
			<img src="<?=GetImageResized(CFile::GetPath($arItem["PROPERTIES"]["PHOTO"]["VALUE"][0]), 190,190);?>"/>
		<?else:?>
			<img src ="<?=GetImageResized(SITE_TEMPLATE_PATH."/images/img_user_big.png", 190, 190);?>" style="width: 190px; height: 190px;">
		<?endif;?>
	</div>
	<div style="float: right; width: 200px;">
		<span><?=GetMessage("YET");?></span>
		<div class="mainMembers1"><?=GetMessage("YET");?></div>
		<div class="mainMembersCount">
			<div style="float: left;">
			<?
				$totalUsers = CUser::GetCount();
				echo number_format( $totalUsers, 0, ',', ' ' );
				
			?>
			</div>
			<div class="mainMembers2"><?=getNumEnding($totalUsers, $endingArray);?></div>
		</div>
		<div style="clear: both;"></div><br>
		<?
		$rsUser = CUser::GetByID($arItem["PROPERTIES"]["USER"]["VALUE"]);
		$arUser = $rsUser->Fetch();
		$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
		$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
		?>
		
		<div class="mainUserName"><?=$arUser["NAME"]." ".$arUser["LAST_NAME"]?></div>
		<p class="mainMemberInfo"><?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?><br>
		<?=$country.", ".$arUser["PERSONAL_CITY"];?></p>
		<img src="<?=SITE_TEMPLATE_PATH."/images/people.png";?>" class="mainMembersImg">
	</div>
<?endforeach;?>

