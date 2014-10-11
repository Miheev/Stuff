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

$PRODUCT_ID = 308;  // изменяем элемент с кодом (ID) 2
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


    <? if (isset($_POST['show_crop'])) {
        $arr_file = Array(
            "name" => $_FILES['dream_photo']['name'],
            "size" => $_FILES['dream_photo']['size'],
            "tmp_name" => $_FILES['dream_photo']['tmp_name'],
            "type" => "",
            "old_file" => "",
            "del" => "Y",
            "MODULE_ID" => "iblock");
        $fid = CFile::SaveFile($arr_file, "member");

        $el = new CIBlockElement;
        $PROP = array();
//    $PROP[12] = 'Белый';  // свойству с кодом 12 присваиваем значение "Белый"
        $arLoadProductArray = Array(
            'MODIFIED_BY' => $GLOBALS['USER']->GetID(), // элемент изменен текущим пользователем
            'IBLOCK_SECTION_ID' => false, // элемент лежит в корне раздела
            'IBLOCK_ID' => 2,
            'PROPERTY_VALUES' => $PROP,
            'NAME' => 'Элемент',
            'ACTIVE' => 'Y', // активен
//        'PREVIEW_TEXT' => 'текст для списка элементов',
//        'DETAIL_TEXT' => 'текст для детального просмотра',
            'DETAIL_PICTURE' => $_FILES['dream_photo'] // картинка, загружаемая из файлового поля веб-формы с именем DETAIL_PICTURE
        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            echo 'New ID: '.$PRODUCT_ID;
        } else {
            echo 'Error: '.$el->LAST_ERROR;
        }

//    $user = new CUser;
//    $arFile = CFile::MakeFileArray($out['imgpath']);
//    $arFile['del'] = "Y";
//    $arFile['old_file'] = intval($_POST['fid']);
//    $field= array('PERSONAL_PHOTO'=>$arFile);
//    $user->Update($USER->GetID(), $field);
////        $user->Update($USER->GetID(), array('PERSONAL_PHOTO'=>intval($_POST['fid'])));
//    $strError = $user->LAST_ERROR;
    }
    ?>



<?//print_r($_REQUEST);?>
<?//echo "<pre>";print_R($arResult);echo "</pre>";?>
<? if(($arResult["~DETAIL_TEXT"]&&$arResult["NAME"])|| $_REQUEST["EDIT_Dream"]!="" || $_REQUEST["Save_Dream"]!="") {?>
    <div class="create2-node">
			<div class="img-upload" style="position: relative; z-index: 1;">
                <form method="post" name="form1" class="dream-form" enctype="multipart/form-data">
                <? $APPLICATION->IncludeComponent( "webpro:dreamphoto", "", array('width'=>665, 'height'=>341, 'imgpath'=>$arResult["DETAIL_PICTURE"]["SRC"], 'strAlt'=>$strAlt));?>
                    </form>
            </div>

			<div class="main_left_img"> 
				<div class="left_img_footer"> 
					<div class="img_footer_head"> 
						<div class="img_footer_name"><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?> <?=$year." ".ruDecline($year,"год","года","лет");?></div>
						<div class="img_footer_country"><?=$country.", ".$arUser["PERSONAL_CITY"];?></div>
					</div>
					<?if(count($arUser["UF_WEB"])>0):?>
						<div class="img_footer_website"><?=GetMessage('WEB_SITES');?>&nbsp;
							<?foreach ($arUser["UF_WEB"] as $key=>$arWeb):
								$cropString = mb_substr($arUser["UF_WEB"][$key], 0, 30);
								if (mb_strlen($arUser["UF_WEB"][$key]) > 30) {
									$cropString .= '...';
									}?>
								<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a>,&nbsp; 
							<?endforeach;?>						
						</div>
					<?endif;?>
			   </div>
			 </div>
			<? if($_REQUEST["EDIT_Dream"]!=""||$_REQUEST["Save_Dream"]!="") { ?>
				<div class="main_left_news">
					<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
						<div class="left_news_name"><?=GetMessage('DREAM');?></div>
						<div class="left_news_content">
							<div class="text">
								<div class="input-container"><textarea name="ABOUT_DREAM" rows="5"><?=$arResult["~DETAIL_TEXT"];?></textarea></div>
								<p>Тут будет текст Тут будет текст Тут будет текст Тут будет текст</p>
							</div>
							<div class="mark">
								<span class="label"><?=GetMessage('COUNT_DREAM');?></span>
								<div class="input-container"><input name="COUNT_DREAM" type="text" autocomplete=""></div>
							</div>
							<div class="buttons">
								<input type="submit" class="abutton" name="Save_Dream" value="<?=GetMessage('ADD_DREAM');?>">
							</div>
						</div>
					</form>
                </div>
			<? } else {?>
			<div class="main_left_news">
				<div class="left_news_name"><?=GetMessage('DREAM');?></div>
				<div class="left_news_content"><?=$arResult["~DETAIL_TEXT"];?></div>
			</div>
			<? }?>
			<div class="main_left_news last">
				<div class="left_news_name"><?=GetMessage('ABOUT');?></div>
				<div class="left_news_content"><?=$arResult["PROPERTIES"]["ABOUT_ME"]["VALUE"]["TEXT"];?></div>
			</div>   
	</div>
<?} else { ?>
		<div class="create-node">	
			<div class="main_left_news">
				<div class="dream_h"><?=GetMessage('DREAM');?></div>
				<div class="left_news_content">У Вас ещё нет мечты, скорей добавте её, чтобы о ней узнали все.</div>
				<div class="btn-more">
					<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
						<input type="submit" class="saveProfileBtn" name="EDIT_Dream" value="<?=GetMessage('CREATE_DREAM');?>">	
					</form>
				</div>
			</div>
		</div>
		<? } ?>
		
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
							"ELEMENT_ID" => $arResult["ID"],
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