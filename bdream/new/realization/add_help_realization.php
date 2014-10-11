<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?if(isset($_REQUEST["AR_ACTION"]) && $_REQUEST["AR_ACTION"] && isset($_REQUEST["DREAM_ID"]) && $_REQUEST["DREAM_ID"])
{
	CModule::IncludeModule("iblock");
	$arAction = explode(", " ,$_REQUEST["AR_ACTION"]);
	
	if(count($arAction)>0)
	{
		global $USER;
		
		$comment = htmlspecialcharsEx($_REQUEST["COMMENT"]);
		
		
		if(!$USER->IsAuthorized())
		{
			echo "error_authorize";
		}
		else
		{
				$arSelect = Array("ID", "NAME");
				$arFilter = Array("IBLOCK_ID"=>2, "ID"=>intval($_REQUEST["DREAM_ID"]));
				$rsDream = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				if($arDream = $rsDream->Fetch())
				{
					$arFilter = Array('IBLOCK_ID'=>5, 'EXTERNAL_ID'=>$_REQUEST["DREAM_ID"]);
					$rsSection = CIBlockSection::GetList(Array(), $arFilter);
						
					$SECTION_ID = false;
					if($arSection = $rsSection->Fetch())
					{
						$SECTION_ID = $arSection["ID"];
					}
					else
					{
						$SECTION_ID = false;
						$bs = new CIBlockSection;
						$arFields = Array(
								"ACTIVE" => "Y",
								"IBLOCK_ID" => 5,
								"NAME" => $arDream["NAME"],
								"EXTERNAL_ID" => $arDream["ID"]
									
						);
						$SECTION_ID = $bs->Add($arFields);
					}

					$el = new CIBlockElement;
					$PROP = array();
					$PROP["USER"] = $USER->GetID();
					$PROP["DREAM"] = $arDream["ID"];
					$PROP["ACTIONS"] = $arAction;
					$PROP["USER_NAME"] = $arUser["NAME"];
					$PROP["USER_LAST_NAME"] = $arUser["LAST_NAME"];
					$PROP["USER_CITY"] = $arUser["LAST_NAME"];
					$arLoadProductArray = Array(
							"MODIFIED_BY"    => $USER->GetID(),
							"IBLOCK_SECTION_ID" => $SECTION_ID,
							"IBLOCK_ID"      => 5,
							"PROPERTY_VALUES"=> $PROP,
							"DETAIL_TEXT"	 => $comment,
							"NAME"           => $USER->GetLogin(),
							"ACTIVE"         => "Y",
					);
						
					$ELEMENT_ID = $el->Add($arLoadProductArray);
					if($ELEMENT_ID)
					{
						$GLOBALS["arrFilter"] = array();
						$GLOBALS["arrFilter"]["PROPERTY_DREAM"] = $arDream["ID"];
						$APPLICATION->IncludeComponent("bitrix:news.list", "comments", array(
								"IBLOCK_TYPE" => "-",
								"IBLOCK_ID" => "5",
								"NEWS_COUNT" => "15",
								"SORT_BY1" => "ACTIVE_FROM",
								"SORT_ORDER1" => "DESC",
								"SORT_BY2" => "SORT",
								"SORT_ORDER2" => "ASC",
								"FILTER_NAME" => "arrFilter",
								"FIELD_CODE" => array(
										0 => "DATE_CREATE",
										1 => "",
								),
								"PROPERTY_CODE" => array(
										0 => "USER",
										1 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "Y",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
								"ADD_SECTIONS_CHAIN" => "Y",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "N",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "Комментарии",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => "",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"DISPLAY_DATE" => "Y",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"AJAX_OPTION_ADDITIONAL" => ""
						),
								false
						);
					}
					else
					{
						echo "error_add";
					}
				}
				else
				{
					echo "error_exists";
				}
		
			
		}
	}
		
}
?>