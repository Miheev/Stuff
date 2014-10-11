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
<pre><? print_r($_REQUEST);?></pre>
<? if(($arResult["~DETAIL_TEXT"]&&$arResult[NAME])|| $_REQUEST["EDIT_Dream"]!="" ) {?>
	<div class="create2-node">
		<? if($_REQUEST["EDIT_Dream"]!="") { ?>
			<div class="img-upload"> <img src="<?=GetImageResized(CFile::GetPath($arResult["PROPERTIES"]["PHOTO"]["VALUE"][0]), 665, 341);?>" alt="<?=$strAlt?>" /> </div>
		<? }?>
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
			<? if($_REQUEST["EDIT_Dream"]!="") { ?>
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
			<? $_REQUEST["EDIT_Dream"]= ""} else {?>
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
	<div class="right_turbodreams_sobr">
	<? if ($arResult["PROPERTIES"]["TURBO_NEED"]["VALUE"]=="") { ?>
		<div class="turbodreams_sobr_name"></div>
		<div class="turbodreams_sobr_col"> 
			<p class="no-check">Вы ещё не оценили свою мечту</p>
		</div>
		<div class="turbodreams_sobr_content"> 
			<p>Для оценки добавте мечту и укажите сколько по-вашему нужно средств для её воплощения</p>
		</div> 
	<? } else { ?>
		<?global $AR_CUR_SIMBOL;	
		CModule::IncludeModule("sale");
		$dbAccountCurrency = CSaleUserAccount::GetList(
			array(),
			array("USER_ID" => $arResult["PROPERTIES"]["USER"]["VALUE"]),
			false,
			false,
			array("CURRENCY")
			);
		if($arAccountCurrency = $dbAccountCurrency->Fetch()){
			$simbol = $AR_CUR_SIMBOL[$arAccountCurrency["CURRENCY"]];
		}
		else{
			$simbol = $AR_CUR_SIMBOL["USD"];
		}
		if($arResult["PROPERTIES"]["TURBO_YET"]["VALUE"]):
			$yet = $arResult["PROPERTIES"]["TURBO_YET"]["VALUE"];
		else:
			$yet = 0;
		endif;
		if($arResult["PROPERTIES"]["TURBO_NEED"]["VALUE"]):
			$need = $arResult["PROPERTIES"]["TURBO_NEED"]["VALUE"];
		else:
			$need = 0;
		endif;
		if($yet<$need){
			$persent = round($yet*100/$need);
		}
		else{
			$persent = 100;
		}?>
		<div class="turbodreams_sobr_name"></div>
			<div class="turbodreams_sobr_col">
				<div class="sobr_col_procc"></div>
					<div class="sobr_col_number">
						<p class="number"><?=number_format($yet, 2, ',', ' ' );?> <span class="pyb"><?=$simbol;?></span></p>
						<p class="procc">Собрано <?=$persent;?>%</p>
					</div>
				</div>
				<div class="turbodreams_sobr_content">
					<p>Требуется:</p>
					<p class="col"><?=number_format($need, 0, ',', ' ' );?> <?=$simbol;?></p>
				</div>
				<div class="sobr_col_buttom"><a href="/turbo_dreams/pay.php?DREAM_ID=<?=$arResult["ID"];?>">Перечислить</a></div>
					
	<? } ?>
	</div>
 
  <div class="right_column_podp"> 
    <div class="column_podp_name"><span class="left">Присоединяйтесь</span>&nbsp;<span>DreamsStars</span> </div>
   
    <div class="column_podp_seti"> 
      <div class="podp_seti_vk">В контакте</div>
     
      <div class="podp_seti_fb">Facebook</div>
     </div>
   
    <div class="column_podp_seti_group"></div>
   </div>
 </aside>