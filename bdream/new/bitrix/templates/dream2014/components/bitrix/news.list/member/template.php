<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="memberDetailDream">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?
$year = intval((time()-MakeTimeStamp($arResult["USER"]["PERSONAL_BIRTHDAY"]))/31556926);
$country = GetCountryByID($arResult["USER"]["PERSONAL_COUNTRY"]);?>
<div class="personalImgBlock">
<?if($arResult["USER"]["PERSONAL_PHOTO"]):?>
	<img src="<?=GetImageResized(CFile::GetPath($arResult["USER"]["PERSONAL_PHOTO"]), 160, 160);?>"/>
<?else:?>
	<img src ="<?=SITE_TEMPLATE_PATH."/images/img_user_big.png";?>" width="160px;" height="160px;">
<?endif;?>
</div>
<div class="memberInfoBlock">
<span class="personalName">
	<?=$arResult["USER"]["NAME"]." ".$arResult["USER"]["LAST_NAME"];?>
</span><br><br>
<span class="personalCityInfo">
	<?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?>
</span><br>
<span class="personalCityInfo">
	<?=$country.", ".$arResult["USER"]["PERSONAL_CITY"];?>
</span><br>
<?if (CModule::IncludeModule("blog")):
		$arUserBlog = CBlog::GetByOwnerID($arResult["USER"]["ID"]);
endif;?>
		<?if($arUserBlog["URL"]):?>
			<div><a href="/blogs/<?=$arUserBlog["URL"];?>/" class="userBlogLink"><?=GetMessage("USER_BLOG");?></a></div>
		<?endif;?>
<span><?=GetMessage("WEB_SITES");?><br>
<div class="memberWebSiteList">
<?foreach ($arResult["USER"]["UF_WEB"] as $key=>$arWeb):
	$cropHttp = str_replace("http://", "", $arResult["USER"]["UF_WEB"][$key]);
	$cropString = mb_substr($cropHttp, 0, 20);
	if (mb_strlen($arResult["USER"]["UF_WEB"][$key]) > $lenght) {
		$cropString .= '...';
	}
	?>
		<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a><br>
<?endforeach;?>
</div> 
</span>

</div>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?if($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"]):
	
	$persent = round($arItem["PROPERTIES"]["TURBO_YET"]["VALUE"]*100/$arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"]);
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
	?>
	<a href="/turbo_dreams/<?=$arItem["ID"];?>/" class="memberTurboDreamBlock">
	<h4>TurboDreams</h4>
	<p><?=GetMessage("DREAM");?><span style="font-size: 16px; font-weight: bold;"><?=number_format($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"], 0, ',', ' ' );?></span> <?=$simbol;?></p>
	<p><?=GetMessage("LAST");?><span style="font-size: 16px; font-weight: bold;"><?=number_format($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"]-$arItem["PROPERTIES"]["TURBO_YET"]["VALUE"], 0, ',', ' ' );?></span> <?=$simbol;?></p>
	<div style="clear: both;"></div>
		<?if($persent>0):?>
			<div id="turboProgress_<?=$arItem["ID"];?>" class="memberActiveTurbo"></div>
			<?
			if(number_format($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"]-$arItem["PROPERTIES"]["TURBO_YET"]["VALUE"])<0){
				$persent="100";
			}else{
			$need=$arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"];
			$yet=abs($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"]-$arItem["PROPERTIES"]["TURBO_YET"]["VALUE"]);
				$persent=$yet*100/$need;
			}
			
			?>
			
			<script>
				$( document ).ready(function() {
					$('#turboProgress_<?=$arItem["ID"];?>').cprogress({
						percent: 0, // starting position
						img1: '<?=SITE_TEMPLATE_PATH."/js/progress/img/progress1.png"?>', // background
						img2: '<?=SITE_TEMPLATE_PATH."/js/progress/img/progress2.png"?>', // foreground
						speed: 1, // speed (timeout)
						PIStep : 0.05, // every step foreground area is bigger about this val
						limit: <?=$persent?>, // end value
						loop : false, //if true, no matter if limit is set, progressbar will be running
						showPercent : true, //show hide percent
						onInit: function(){console.log('onInit');},
						onProgress: function(p){console.log('onProgress',p);}, //p=current percent
						onComplete: function(p){console.log('onComplete',p);}
					});
				});
			</script>	
			<?else:?>
			<div class="jCProgress" style="width: 70px; height: 70px; margin: 0 auto; background: url('<?=SITE_TEMPLATE_PATH."/js/progress/img/progress1.png"?>') center no-repeat;">
				<div class="percent" style="margin-left: 5px;">0%</div>
			</div>
			<?endif;?>	
	
	</a>
	<?endif;?>
	<div style="clear: both;"></div>
	<?if(is_array($arItem["PROPERTIES"]["PHOTO"]["VALUE"]) && count($arItem["PROPERTIES"]["PHOTO"]["VALUE"])>0 || $arItem["PROPERTIES"]["PHOTO"]["VALUE"]):?>
		<div class="caruselBlock">
				<a id="prevMemberSlide" href="#">&lt;</a>
				<div class="list_carousel_member">
							<ul id="member_slider">
								<?foreach ($arItem["PROPERTIES"]["PHOTO"]["VALUE"] as $imgId):?>
									<li><a href="<?=GetImageResized(CFile::GetPath($imgId), 900, 700);?>" rel="prettyPhoto"><img src="<?=GetImageResized(CFile::GetPath($imgId), 70, 70);?>"/></a></li>
								<?endforeach;?>
							</ul>
							<div class="clearfix"></div>
				</div>
				<a id="nextMemberSlide" href="#">&gt;</a>
				<div style="clear: both;"></div>
		</div>	
	<?endif;?>
	<br>
	<?
global $USER;
if ($USER->IsAuthorized()) {?>
	<?//проверям есть ли данные товар в избранных у текущего пользователя
	//сначала выберем все его избранные
	$filter = Array("ID"=>$USER->GetID());
	$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), $filter,array("SELECT"=>array("UF_FAVOURIT"))); 
	while ($arUser = $rsUsers->Fetch()) 
	{
	   $favour[]=$arUser["UF_FAVOURIT"];
	}
	if(in_array($arItem["ID"],$favour[0])){?>
				<input type="button" value="Избранная мечта"/>
	<?}else{?>
			<div class="favour_add_block">
				<input type="button" value="Добавить в избранное" class="add_favour" id="<?=$arItem["ID"];?>"/>
			</div>
	<?}?>
<?}?>
	<div class="memberDreamDetailBlock">
		<table class="memberDreamDetail">
		<tr>
			<td class="tableHead"><?=GetMessage("DREAM_SHORT");?></td>
			<td><?=$arItem["~DETAIL_TEXT"];?></td>
		</tr>
		<tr>
			<td class="tableHead"><?=GetMessage("ABOUT_ME");?></td>
			<td><?=$arItem["PROPERTIES"]["ABOUT_ME"]["~VALUE"]["TEXT"];?></td>
		</tr>
		</table>
	</div>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<div style="clear: both;"></div>
</div>
	<?if(is_array($arItem["PROPERTIES"]["PHOTO"]["VALUE"]) && count($arItem["PROPERTIES"]["PHOTO"]["VALUE"])>0 || $arItem["PROPERTIES"]["PHOTO"]["VALUE"]):?>
<script>
$( document ).ready(function() {
	$("#member_slider").carouFredSel({
		auto: false,
		prev: '#prevMemberSlide',
		next: '#nextMemberSlide'
	});
});
</script>
<?endif;?>
<script>
	$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".add_favour").click(function(e){
				var id=$(this).attr("id");
				var user=<?=$USER->GetID()?>;
				$.ajax({
				   type: "POST",
				   url: "/member/fav_memb.php", // путь к файлу, который будем читать
				   data: "id="+id+"&user="+user,
				   dataType: "html",
				   cache: false,
				   success: function(html){ 
						$(".favour_add_block").html("Мечта успешно добавлена");
				   }
				});//*/
		});
	});
	</script>

