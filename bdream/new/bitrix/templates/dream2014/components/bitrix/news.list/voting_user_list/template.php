<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="main-container-name">До конца голосование осталось:<font>7 дней</font></div>
				<div class="main wrapper clearfix">
<div class="center">
	<section class="true-dreams">
	<div class="first_block">
		<div class="golos clearfix">	
<?$j=0;
//echo "<pre>";print_R($arResult);echo "</pre>";
if(count($arResult["USER"])>0):
	$i=0;$key=0;
	foreach($arResult["USER"] as $arUser){	
	if($i==3){?></div>
		<?if($key==3){?></div><?}?>
	<div class="golos clearfix"><?$i=0;}?>
	
	<article rel="<?=$res["USER_ID"];?>">
		<a href="#">
			<div class="about">
				<div class="img">
				<?if($arResult["ITEMS"][$key]["DETAIL_PICTURE"]["SRC"]!=""){?>
				<?
				$renderImage = CFile::ResizeImageGet(
					$arResult["ITEMS"][$key]["DETAIL_PICTURE"],
					Array("width" => "333", "height" => "207"),
					BX_RESIZE_IMAGE_EXACT
					);
				?>
					<img src="<?=$renderImage["src"]?>" alt="<?=$arResult["ITEMS"][$key]["NAME"]?>" title="<?=$arResult["ITEMS"][$key]["NAME"]?>"/>
				<?}else if($arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]!=""){?>
				<?
				$renderImage = CFile::ResizeImageGet(
					$arResult["ITEMS"][$key]["PREVIEW_PICTURE"],
					Array("width" => "333", "height" => "207"),
					BX_RESIZE_IMAGE_EXACT
					);
				?>
					<img src="<?=$renderImage["src"]?>" alt="<?=$arResult["ITEMS"][$key]["NAME"]?>" title="<?=$arResult["ITEMS"][$key]["NAME"]?>"/>
				<?}else if($arUser["USER_INFO"]["PERSONAL_PHOTO"]){?>
				<?
				$renderImage = CFile::ResizeImageGet(
					$arUser["USER_INFO"]["PERSONAL_PHOTO"],
					Array("width" => "333", "height" => "207"),
					BX_RESIZE_IMAGE_EXACT
					);
				?>
					<img src="<?=$renderImage["src"]?>" alt="<?=$arResult["ITEMS"][$key]["NAME"]?>" title="<?=$arResult["ITEMS"][$key]["NAME"]?>"/>
					
				<?}else{?>
					<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="333" height="207"  alt="<?=$arResult["ITEMS"][$key]["NAME"]?>" title="<?=$arResult["ITEMS"][$key]["NAME"]?>">
				<?}?>
				</div>
				<div class="text">
				
					<?$country = GetCountryByID($arUser["USER_INFO"]["PERSONAL_COUNTRY"]);
					$year = intval((time()-MakeTimeStamp($arUser["USER_INFO"]["PERSONAL_BIRTHDAY"]))/31556926);?> 
					
					<p class="user"><?=$arUser["USER_INFO"]["NAME"];?> <?=$arUser["USER_INFO"]["LAST_NAME"];?>, <?=$year?> лет</p>
					<p class="location"><?=$country.", ".$arUser["USER_INFO"]["PERSONAL_CITY"];?></p>
					<p class="dream"><?=$arResult["ITEMS"][$key]["DETAIL_TEXT"]?></p>
				</div>
				
			</div>
			<div class="needs clearfix">
			<?global $USER;
			$arFilter = Array("IBLOCK_ID"=>3, "PROPERTY_DREAM"=>$arResult["ITEMS"][$key]["ID"], "PROPERTY_USER"=>$USER->GetID(),"INCLUDE_SUBSECTIONS"=>"Y");
			$rsDream = CIBlockElement::GetList(Array(), $arFilter);
			if($arDream = $rsDream->Fetch()){
				$VOTE_YET=true;
			}else{
				$VOTE_YET=false;
			}
			if(!$VOTE_YET){?>
				<div class="needs_golos_buttom add_voting" rel="<?=$arResult["ITEMS"][$key]["ID"]?>">Голосовать</div>
			<?}else{?>
				<div class="have_golos">Голос принят</div>
			<?}?>				
				<div class="needs_golos_numer">Проголосовало: <?=$arUser["VOTE"];?></div>
			</div>
		</a>
	</article>
	
	
			
	<?$i++;$key++;}?>
<?endif;?>
						</div>
					</section>
				</div>
			</div>
<script>
var controll = false;
var listMargin = 0;
var blockCount = 0;
var stepMargin = 0;
var page = 1;
var topValue = 0;
var difference = 0;
var listHeight = 0;
var pageEnd = false;
$(function() {
	
	$(".verticalScrollBar").slider({
		orientation: "vertical",
		range: "min",
		min: 0,
		max: 100,
		value: 100,
		slide: function(event, ui) {
			
			blockCount = Math.ceil(($(".voting_list .realUserBlock").length)/2);
		
			blockHeight=$(".votingBlockLeft").height();
			listHeight=$(".voting_list").outerHeight(false)-blockHeight;
			topValue = (ui.value-100)/100*listHeight;

			$(".voting_list").css("margin-top", topValue);

			if(page==1)
			{
				var loadVal = 30;
			}
			else
			{
				var loadVal = 0-((page)*70);
			}
			
			if((ui.value)<=loadVal && !controll && !pageEnd)
			{
				if(!$(".loader_slider").length)
					$('.voting_list').append("<span class='loader_slider'><?=GetMessage("LOAD");?></span>");
			}

	
		},
		change: function(event, ui) {
			
			if(page==1)
			{
				var loadVal = 30;
			}
			else
			{
				var min = $(".verticalScrollBar").slider("option", "value");
				var loadVal = min+30;
			}

			if(!pageEnd)
			{
				blockHeight=$(".votingBlockLeft").height();
				listHeight=$(".voting_list").outerHeight(false)-blockHeight;
				topValue = (ui.value-100)/100*listHeight;
			}
			
			if((ui.value)<=loadVal && !pageEnd && !controll)
			{
				if(!$(".loader_slider").length)
					$('.voting_list').append("<span class='loader_slider'><?=GetMessage("LOAD");?></span>");
				
				controll=true;
				
				var obj = $( this );
				 $.ajax({
					   type: "POST",
					   url: "/voting/member_list.php",
					   data: "PAGEN_1="+(page+1),
					   success: function(data){
						   $(".loader_slider").remove();
						   if(data=="page_end")
						   {
							   pageEnd = true;						  
						   }
						   else
						   {   
								$('.voting_list').append(data);
								blockHeight=$(".votingBlockLeft").height();
								listHeight=$(".voting_list").outerHeight(false)-blockHeight;
								topValue = parseInt($(".voting_list").css("margin-top"));
								minVal=parseInt(100+topValue/listHeight*100);
								obj.slider("option", "value", minVal);
								page = page+1;
								controll = false;

								if(!pageEnd)
								{
									blockHeight=$(".votingBlockLeft").height();
									listHeight=$(".voting_list").outerHeight(false)-blockHeight;
									topValue = (ui.value-100)/100*listHeight;
								}
								
						   }
					   }
				});
			}

			
		}
	});

	$(".voting_list").mousewheel(function(event, delta){

		var nowValue = $(".verticalScrollBar").slider("value");
		var max = $(".verticalScrollBar").slider("option", "max");
		var min = $(".verticalScrollBar").slider("option", "min");

		blockHeight=$(".votingBlockLeft").height();
		listHeight=$(".voting_list").outerHeight(false)-blockHeight;
		step=parseInt(blockHeight/listHeight*100/20);

		if(delta>0)
		{
			if((nowValue+step)<=max)
			{
				$(".verticalScrollBar").slider("option", "value", nowValue+step);
			}
			else
			{
				var setStep = max-nowValue;
				$(".verticalScrollBar").slider("option", "value", nowValue+setStep);
			}
		}
		else
		{
			if((nowValue-step)>=min)
			{
				$(".verticalScrollBar").slider("option", "value", nowValue-step);
			}
			else
			{
				var setStep = nowValue-min;
				$(".verticalScrollBar").slider("option", "value", nowValue-setStep);
			}			
		}
			
		var nowValue = $(".verticalScrollBar").slider("value");
		blockHeight=$(".votingBlockLeft").height();
		listHeight=$(".voting_list").outerHeight(false)-blockHeight;
		topValue = (nowValue-100)/100*listHeight;
		$(".voting_list").css("margin-top", topValue);
		
	})

	$(".scrollTop").click(function(){
		var nowValue = $(".verticalScrollBar").slider("value");
		var max = $(".verticalScrollBar").slider("option", "max");

		blockHeight=$(".votingBlockLeft").height();
		listHeight=$(".voting_list").outerHeight(false)-blockHeight;
		step=parseInt(blockHeight/listHeight*100);
		
		if((nowValue+step)<=max)
		{
			$(".verticalScrollBar").slider("option", "value", nowValue+step);
		}
		else
		{
			var setStep = max-nowValue;
			$(".verticalScrollBar").slider("option", "value", nowValue+setStep);
		}

		var nowValue = $(".verticalScrollBar").slider("value");
		blockHeight=$(".votingBlockLeft").height();
		listHeight=$(".voting_list").outerHeight(false)-blockHeight;
		topValue = (nowValue-100)/100*listHeight;
		$(".voting_list").css("margin-top", topValue);
	});
	
	$(".scrollBottom").click(function(){
		var nowValue = $(".verticalScrollBar").slider("value");
		var min = $(".verticalScrollBar").slider("option", "min");

		blockHeight=$(".votingBlockLeft").height();
		listHeight=$(".voting_list").outerHeight(false)-blockHeight;
		step=parseInt(blockHeight/listHeight*100);
	
		if((nowValue-step)>=min)
		{
			$(".verticalScrollBar").slider("option", "value", nowValue-step);
		}
		else
		{
			var setStep = nowValue-min;
			$(".verticalScrollBar").slider("option", "value", nowValue-setStep);
		}

		var nowValue = $(".verticalScrollBar").slider("value");
		blockHeight=$(".votingBlockLeft").height();
		listHeight=$(".voting_list").outerHeight(false)-blockHeight;
		topValue = (nowValue-100)/100*listHeight;
		$(".voting_list").css("margin-top", topValue);
		
	});
	
});
</script>

