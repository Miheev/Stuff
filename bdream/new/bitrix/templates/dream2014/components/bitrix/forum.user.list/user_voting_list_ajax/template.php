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

if ($arResult["SHOW_RESULT"] != "Y"):		
	return false;
endif;

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
	<div class="realUserBlock green member_dream_id<?if($iCount==1):?> activeMember<?endif;?>" rel="<?=$res["USER_ID"];?>">
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
				<?=$year." ".ruDecline($year,"год","года","лет");?><br>
				<?=$country.", ".$res["PERSONAL_CITY"];?>
			</span>	
	</div>
	</div>
	<div style="clear: both;"></div>
<?endif;?>
<?endforeach;?>