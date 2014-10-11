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

<br/>
<?
if (!empty($arResult["ERROR_MESSAGE"])):
?>
<div class="forum-note-box forum-note-error">
	<div class="forum-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"], "forum-note-error");?></div>
</div>
<?
endif;
if (!empty($arResult["OK_MESSAGE"])): 
?>
<div class="forum-note-box forum-note-success">
	<div class="forum-note-box-text"><?=ShowNote($arResult["OK_MESSAGE"], "forum-note-success")?></div>
</div>
<?
endif;

?>

<div class="member_list">
			
<?
if ($arResult["SHOW_RESULT"] != "Y"):		
	return false;
endif;

$iCount = 0;
foreach ($arResult["USERS"] as $res):
	$iCount++;
?>
<div class="voting_dream_id" rel="<?=$res["USER_ID"];?>">
<?if($res["PERSONAL_PHOTO"]):?>
	<img src="<?=GetImageResized(CFile::GetPath($res["PERSONAL_PHOTO"]), 60, 60);?>"/>
<?else:?>
	<div style="width: 60px; height: 60px; border: 1px solid #000;"></div>
<?endif;?>

		<div class="forum-user-name">
			<span><?=$res["SHOW_ABC"];?></span>
		</div>

<br>
<?$country = GetCountryByID($res["PERSONAL_COUNTRY"]);?>
<?=$country.", ".$res["PERSONAL_CITY"];?><br>
Ссылка на блог пользователя<br>
<?=$res["DREAM"]["PREVIEW_TEXT"];?><br>
<div class="vote_count_<?=$res["DREAM"]["ID"];?>">Прголосовало <span><?=$res["VOTE"];?></span></div>
</div>
<?
endforeach;
?>
				
			
	
</div>
<?

if ($arResult["NAV_RESULT"]->NavPageCount > 0):
?>
<br>
<div class="forum-navigation-box forum-navigation-bottom">
	<div class="forum-page-navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<div class="forum-clear-float"></div>
</div>
<?
endif;
?>
