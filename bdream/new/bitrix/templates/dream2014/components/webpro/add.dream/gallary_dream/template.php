<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);



$db_props = CIBlockElement::GetProperty($PRODUCT_ID, "sort", "asc");

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);


$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);

if ($_REQUEST["Save_Dream"])
{
$edit_dream = new CIBlockElement;

$DETAIL_TEXT = $_REQUEST["ABOUT_DREAM"]; 
$MONEY_DREAM = $_REQUEST["COUNT_DREAM"];      // свойству с кодом 3 присваиваем значение 38

$arLoadProductArray = Array(
  
  "DETAIL_TEXT"    => $DETAIL_TEXT ,
  );

$PRODUCT_ID = $arResult["ID"];  // изменяем элемент с кодом (ID) 2
$res = $edit_dream->Update($PRODUCT_ID, $arLoadProductArray);
CIBlockElement::SetPropertyValueCode($PRODUCT_ID, "TURBO_NEED", $MONEY_DREAM);

}
?>
<? 
$rsUser = CUser::GetByID(intval($arResult["PROPERTIES"]["USER"]["VALUE"]));
$arUser = $rsUser->Fetch();

$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
?>

<div class="center"> 
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"dream_menu",
	Array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array()
	)
	);?>

	<div class="gallery-node">
		<div class="img-full" data-imgid="0">
			<?
			$FILE = CFile::GetFileArray($arResult["PROPERTIES"]["PHOTO"]["VALUE"][0]);
			
			?>
			<img src="<? echo ($FILE["SRC"]);   ?>">
		</div>
		<div class="img-tumb clearfix">
			<ul>
				<?  foreach($arResult["PROPERTIES"]["PHOTO"]["VALUE"] as $FILE)   
					  {   
						 $FILE = CFile::GetFileArray($FILE);   
					   ?><li class="sl-item"><div><img src="<? echo ($FILE["SRC"]);   ?>"> <span></span></div></li><?
					  }   
				?>
                <li><div class="img-add" style="position: relative;">
                        <form method="post" class="dream-form" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
                        <? $APPLICATION->IncludeComponent( "webpro:dreamphoto", "gallery", array('width'=>665, 'height'=>341));?>
                        </form>
                    </div>
                </li>
			 </ul>
		</div>
	</div>
		
</div>

<aside class="right create-node"> 
	<? if ($arResult["PROPERTIES"]["STATE"]["VALUE"] == 'Голосование') { ?>
		<div class="right_golos"> 
			<div class="right_golos_col"> 
				<div class="golos_col_name">Вы находитесь в голосовании</div>
				<div class="golos_col_time"> 
					<p>До конца голосования осталось:</p>
				</div>
				<div class="golos_col_time_number">7 дней.</div>
			</div>
			<div class="right_golos_buttom"> 
				<div class="golos_number"> 
					<p>Уже голосов:</p>
					<p class="number_col">124125</p>
				</div>
				<div class="needs_golos_buttom">Голосовать</div>
			</div>
		</div>
	<? } ?>
	 <?$APPLICATION->IncludeComponent(
	"webpro:pay.turbo",
	".default",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "dreams",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => $arResult[ID],
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"TURBO_YET",1=>"MONEY_DREAM",2=>"TURBO_NEED",3=>"",),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
 
  <div class="right_column_podp"> 
    <div class="column_podp_name"><span class="left">Присоединяйтесь</span>&nbsp;<span>DreamsStars</span> </div>
   
    <div class="column_podp_seti"> 
      <div class="podp_seti_vk">В контакте</div>
     
      <div class="podp_seti_fb">Facebook</div>
     </div>
   
    <div class="column_podp_seti_group"></div>
   </div>
 </aside>