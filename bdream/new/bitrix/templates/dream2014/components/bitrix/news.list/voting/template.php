<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="memberDetailDream">

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$country = GetCountryByID($arResult["USER"]["PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arResult["USER"]["PERSONAL_BIRTHDAY"]))/31556926);
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<table>
<tr style="vertical-align: top;">
	<td>
		<img src="<?=GetImageResized(CFile::GetPath($arResult["USER"]["PERSONAL_PHOTO"]), 150, 150);?>"/>
		<?if($arResult["VOTE_YET"]):?>
			<div class="add_voting"><?=GetMessage("VOTE_ACSEPT");?></div><br>
		<?elseif(!$arResult["NOT_HAVE_VOTE"]):?>
			<div class="add_voting" rel="<?=$arResult["ITEMS"][0]["ID"]?>"><?=GetMessage("VOTE_ACSEPT");?></div>
			<span style="line-height: 12px; vertical-align: top;">
				<input type="checkbox" class="hide_vote"/>
				<b><?=GetMessage("HIDE_VOTE");?></b>
			</span>	
				<br><br>
		<?else:?>
		<br><br>
	
		<?endif;?>
			<div class="vote_count_<?=$arItem["ID"];?>">
			<a href="/voting/dream_voting_list.php?DREAM_ID=<?=$arResult["ITEMS"][0]["ID"];?>&USER_NAME=<?=$arResult["USER"]["NAME"]." ".$arResult["USER"]["LAST_NAME"]?>&USER_ID=<?=$arResult["USER"]["ID"];?>">
				<?=GetMessage("VOTE_YET");?><span><?=$arResult["VOTE"];?></span>
			</a>
		</div>
		
	</td>
	<td>
		<div class="personalName"><?=$arResult["USER"]["NAME"]." ".$arResult["USER"]["LAST_NAME"];?>
			<span style="font-size: 18px; padding-left: 10px;">
				<?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?>
			</span>
		</div>
		<div style="clear: both;"></div>
		<div><?=$country.", ".$arResult["USER"]["PERSONAL_CITY"];?></div>
		<?if (CModule::IncludeModule("blog")):
			$arUserBlog = CBlog::GetByOwnerID($arResult["USER"]["ID"]);
		endif;?>
		<?if($arUserBlog["URL"]):?>
			<div><a href="/blogs/<?=$arUserBlog["URL"];?>/"><?=GetMessage("USER_BLOG");?></a></div>
		<?endif;?>
		<?if(count($arResult["USER"]["UF_WEB"])>0):?>
		<div><?=GetMessage("WEB_SITES");?><br>
			<?
		
			foreach ($arResult["USER"]["UF_WEB"] as $key=>$arWeb):
				$cropString = mb_substr($arResult["USER"]["UF_WEB"][$key], 0, 30);
				if (mb_strlen($arResult["USER"]["UF_WEB"][$key]) > 30) {
					$cropString .= '...';
				}
			?>
				<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a><br>
			<?endforeach;?>
		</div>
		<?endif;?>
	</td>
</tr>

</table>
	
<div class="vote_list">
<?
$GLOBALS["arrFilter"] = array();
$GLOBALS["arrFilter"]["PROPERTY_DREAM"] = $arItem["ID"];
$GLOBALS["arrFilter"]["!PROPERTY_HIDE"] = 1;
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"voting_avatar_list",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "service",
		"IBLOCK_ID" => "3",
		"NEWS_COUNT" => "7",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array(),
		"PROPERTY_CODE" => array("USER"),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	),
false
);?>
</div><br>
	<div class="memberVotingDetailBlock">
		<table class="memberDreamDetail">
		<tbody><tr>
			<td class="tableHead"><?=GetMessage("DREAM");?></td>
			<td>`<?=$arItem["NAME"];?>`<br><?=$arItem["~DETAIL_TEXT"];?></td>
		</tr>
		<tr>
			<td class="tableHead"><?=GetMessage("ABOUT_ME");?></td>
			<td><?=$arItem["PROPERTIES"]["ABOUT_ME"]["VALUE"]["TEXT"];?></td>
		</tr>
		</tbody></table>
	</div>	
<?endforeach;?>
</div>
