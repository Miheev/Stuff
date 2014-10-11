<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
if (!$this->__component->__parent || empty($this->__component->__parent->__name)):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/themes/blue/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/forum/templates/.default/styles/additional.css');
endif;
/********************************************************************
				Input params
********************************************************************/
$arParams["SEO_USER"] = (in_array($arParams["SEO_USER"], array("Y", "N", "TEXT")) ? $arParams["SEO_USER"] : "Y");
$arParams["USER_TMPL"] = '<noindex><a rel="nofollow" href="#URL#" title="'.GetMessage("F_USER_PROFILE").'">#NAME#</a></noindex>';
if ($arParams["SEO_USER"] == "N") $arParams["USER_TMPL"] = '<a href="#URL#" title="'.GetMessage("F_USER_PROFILE").'">#NAME#</a>';
elseif ($arParams["SEO_USER"] == "TEXT") $arParams["USER_TMPL"] = '#NAME#';
/********************************************************************
				/Input params
********************************************************************/
$arSort = array(
	"NUM_POSTS" => array("NAME" => GetMessage("LU_FILTER_SORT_NUM_POSTS")), 
	"SHOW_ABC" => array("NAME" => GetMessage("LU_FILTER_SORT_NAME")), 
);
if ($arResult["SHOW_VOTES"] == "Y"):
	$arSort["POINTS"] = array("NAME" => GetMessage("LU_FILTER_SORT_POINTS"));
endif;
$arSort["DATE_REGISTER"] = array("NAME" => GetMessage("LU_FILTER_SORT_DATE_REGISTER"));
$arSort["LAST_VISIT"] = array("NAME" => GetMessage("LU_FILTER_SORT_LAST_VISIT"));
?>

<div class="member_list">
			
<?
if ($arResult["SHOW_RESULT"] != "Y"):		
	return false;
endif;

$iCount = 0;
foreach ($arResult["USERS"] as $res):
	$iCount++;

$year = intval((time()-MakeTimeStamp($res["PERSONAL_BIRTHDAY"]))/31556926);

$country = GetCountryByID($res["PERSONAL_COUNTRY"]);

?>
	<div class="verticalScrollElement">
	<div class="realUserBlock green member_dream_id<?if($iCount==1):?> activeMember<?endif;?>" rel="<?=$res["USER_ID"];?>">
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
				<?=$year." ".ruDecline($year,"год","года","лет");?><br>
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


	<?if(CModule::IncludeModule("sale"))
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
	?>

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
			var difference = $('.verticalScrollElement').height();
			if(ui.value==100)
			{
				$(".member_list").css("margin-top", 0);
			}
			else
			{
				var topValue = -((100-ui.value)*difference/100);
				$(".member_list").css("margin-top", topValue);
			}
			
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
				$('.verticalScrollElement').last().next().after("<span class='loader_slider'>загрузка...</span>");
				//$('.loader_slider').replaceWith();
				controll = true;
			}
	
		},
		change: function(event, ui) {
			
			if(page==1)
			{
				var loadVal = 30;
			}
			else
			{
				var loadVal = 0-((page)*70);
			}
			
			$(".loader_slider").remove();
			if((ui.value)<=loadVal && !pageEnd)
			{
				var obj = $( this );
				 $.ajax({
					   type: "POST",
					   url: "/member/member_list.php",
					   data: "PAGEN_1="+(page+1),
					   success: function(data){
						   console.log(data);
						   if(data=="page_end")
						   {
							   pageEnd = true;
						   }
						   else
						   {   
							   $('.verticalScrollElement').last().next().after(data); 
							   var minVal = (-200)*page;						 
							   obj.slider( "option", "min", minVal);
							   page = page+1;
							   controll = false;
						   }
					   }
				});	
			
			}

			var difference = $('.verticalScrollElement').height();
			if(ui.value==100)
			{
				$(".member_list").css("margin-top", 0);
			}
			else
			{
				var topValue = -((100-ui.value)*difference/100);
				$(".member_list").css("margin-top", topValue);
			}
		}
	});

	$(".scrollTop").click(function(){
		var nowValue = $(".verticalScrollBar").slider("value");
		$(".verticalScrollBar").slider("value", nowValue+20);
	});
	
	$(".scrollBottom").click(function(){
		var nowValue = $(".verticalScrollBar").slider("value");
		$(".verticalScrollBar").slider("value", nowValue-20);
	});


	 var user_id = $(".member_dream_id").first().attr("rel");
		$("#member_dream").html("Загрузка...");
		$.ajax({
			   type: "POST",
			   url: "../member/member_dream.php",
			   data: "USER_ID="+user_id,
			   success: function(data){
			     $("#member_dream").html(data);
			   }
			 });


		 var availableCity = <?=CUtil::PhpToJsObject($arCity);?>;
		 var availableCountry = <?=CUtil::PhpToJsObject($arCountry);?>;
		 $("#city").autocomplete({
		      source: availableCity
		    });
		 $("#country").autocomplete({
		        source: availableCountry
		    });
		 


	
});
</script>