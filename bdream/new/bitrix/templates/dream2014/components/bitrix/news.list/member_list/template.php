<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="member_list">		
<?
$iCount = 0;

foreach ($arResult["USERS"] as $dreamId=>$res):
	$iCount++;
$year = intval((time()-MakeTimeStamp($res["PERSONAL_BIRTHDAY"]))/31556926);

$country = GetCountryByID($res["PERSONAL_COUNTRY"]);

?>
	<div class="verticalScrollElement">
	<div class="realUserBlock green member_dream_id<?if($iCount==1):?> activeMember<?endif;?>" rel="<?=$res["ID"];?>">
		<div class="realationLeft">
			<?if($res["PERSONAL_PHOTO"]):?>
				<img src="<?=GetImageResized(CFile::GetPath($res["PERSONAL_PHOTO"]), 52, 52);?>"/>
			<?else:?>
				<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="52" height="52" alt="">
			<?endif;?>
		</div>
		
			<span class="realName">
				<?=$res["NAME"];?><br>
				<?=$res["LAST_NAME"];?>
			</span>
			<div style="clear: both;"></div>
			<span class="realUserInfo">
				<?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?><br>
				<?=$country.", ".$res["PERSONAL_CITY"];?>
			</span>

		
	</div>
	<?if($iCount==1):?>
	<div class="arrowGreen"></div>
	<?endif;?>
	</div>
	<div style="clear: both;"></div>
<?endforeach;?>
		
</div>
<div class="verticalScrollBarWrap">
	<div class="scrollTop"></div>
	<div class="verticalScrollBar"></div>
	<div class="scrollBottom"></div>
</div>
<input type="text" class="scrollValue" value="0"/>


	<?/*if(CModule::IncludeModule("sale"))
	{
		$arCity = array();
		$db_vars = CSaleLocation::GetList(
				array("CITY_NAME" => "ASC"),
				array("LID" => LANGUAGE_ID),
				false,
				false,
				array()
		);

		while($vars = $db_vars->Fetch()):
		
			$arCity[] = $vars["CITY_NAME"];
			$arCountry[] = $vars["COUNTRY_NAME"];
		endwhile;
		$arCity = array_values(array_unique(array_diff($arCity, array(''))));
		$arCountry = array_values(array_unique(array_diff($arCountry, array(''))));
	}
	*/?>

<script>
var controll = false;

var page = 1;
var pageEnd = false;
$(function() {
	
	$(".verticalScrollBar").slider({
		orientation: "vertical",
		range: "min",
		min: 0,
		max: 100,
		value: 100,
		slide: function(event, ui) {
			
			blockCount = Math.ceil(($(".member_list .realUserBlock").length)/2);
		
			blockHeight=$(".memberListBlock").height();
			listHeight=$(".member_list").outerHeight(false)-blockHeight;
			topValue = (ui.value-100)/100*listHeight;

			$(".member_list").css("margin-top", topValue);

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
					$('.member_list').append("<span class='loader_slider'><?=GetMessage("LOAD");?></span>");
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
				blockHeight=$(".memberListBlock").height();
				listHeight=$(".member_list").outerHeight(false)-blockHeight;
				topValue = (ui.value-100)/100*listHeight;
			}
			
			if((ui.value)<=loadVal && !pageEnd && !controll)
			{
				if(!$(".loader_slider").length)
					$('.member_list').append("<span class='loader_slider'><?=GetMessage("LOAD");?></span>");
				
				controll=true;
				var url = window.location.search;
				var urlParms = url.substring(1);
				var data = "PAGEN_1="+(page+1)+"&"+urlParms;
				var obj = $( this );
				 $.ajax({
					   type: "POST",
					   url: "/member/member_list.php",
					   data: data,
					   success: function(data){
						   $(".loader_slider").remove();
						   if(data=="page_end")
						   {
							   pageEnd = true;						  
						   }
						   else
						   {   
								$('.member_list').append(data);
								blockHeight=$(".memberListBlock").height();
								listHeight=$(".member_list").outerHeight(false)-blockHeight;
								topValue = parseInt($(".member_list").css("margin-top"));
								minVal=parseInt(100+topValue/listHeight*100);
								obj.slider("option", "value", minVal);
								page = page+1;
								controll = false;

								if(!pageEnd)
								{
									blockHeight=$(".memberListBlock").height();
									listHeight=$(".member_list").outerHeight(false)-blockHeight;
									topValue = (ui.value-100)/100*listHeight;
								}
								
						   }
					   }
				});
			}

			
		}
	});

	$(".member_list").mousewheel(function(event, delta){

		var nowValue = $(".verticalScrollBar").slider("value");
		var max = $(".verticalScrollBar").slider("option", "max");
		var min = $(".verticalScrollBar").slider("option", "min");

		blockHeight=$(".memberListBlock").height();
		listHeight=$(".member_list").outerHeight(false)-blockHeight;
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
		blockHeight=$(".memberListBlock").height();
		listHeight=$(".member_list").outerHeight(false)-blockHeight;
		topValue = (nowValue-100)/100*listHeight;
		$(".member_list").css("margin-top", topValue);
		
	})

	$(".scrollTop").click(function(){
		var nowValue = $(".verticalScrollBar").slider("value");
		var max = $(".verticalScrollBar").slider("option", "max");

		blockHeight=$(".memberListBlock").height();
		listHeight=$(".member_list").outerHeight(false)-blockHeight;
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
		blockHeight=$(".memberListBlock").height();
		listHeight=$(".member_list").outerHeight(false)-blockHeight;
		topValue = (nowValue-100)/100*listHeight;
		$(".member_list").css("margin-top", topValue);
	});
	
	$(".scrollBottom").click(function(){
		var nowValue = $(".verticalScrollBar").slider("value");
		var min = $(".verticalScrollBar").slider("option", "min");

		blockHeight=$(".memberListBlock").height();
		listHeight=$(".member_list").outerHeight(false)-blockHeight;
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
		blockHeight=$(".memberListBlock").height();
		listHeight=$(".member_list").outerHeight(false)-blockHeight;
		topValue = (nowValue-100)/100*listHeight;
		$(".member_list").css("margin-top", topValue);
		
	});

	 var user_id = $(".member_dream_id").first().attr("rel");
		$("#member_dream").html("<?=GetMessage("LOAD");?>");
		$.ajax({
			   type: "POST",
			   url: "../member/member_dream.php",
			   data: "USER_ID="+user_id,
			   success: function(data){
			     $("#member_dream").html(data);
			   }
			 });


		
			  
				 $("#country").autocomplete({
						 source: function( request, response ) {
						        $.get("/personal/ajax_location.php",
								    {search:request.term, type:"country"},
								    function( data ) {
								        	  response(data);
								    },
						        	"json"
						        )
						 }
				});
				 $("#city").autocomplete({
					 source: function( request, response ) {
					        $.get("/personal/ajax_location.php",
							    {search:request.term, type:"city"},
							    function( data ) {
							        	  response(data);
							    },
					        	"json"
					        )
					 }
				});
			


	
});
</script>