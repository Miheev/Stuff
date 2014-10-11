<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Моя мечта");

$ID="";
$userid=intval($USER->GetID());
$arSelect = Array("ID","PROPERTY_USER");
$arFilter = Array("IBLOCK_ID"=> "2", "PROPERTY_USER" => $userid);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFieldsDream = $ob->GetFields();
 $ID=$arFieldsDream["ID"];
}
if($ID!=""){?>
<?$APPLICATION->IncludeComponent(
	"webpro:add.dream",
	"profile_dream",
	Array(
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"DISPLAY_NAME" => "Y",
		"DETAIL_PICTURE_MODE" => "IMG",
		"ADD_DETAIL_TO_SLIDER" => "N",
		"DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"DISPLAY_COMPARE" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"USE_VOTE_RATING" => "N",
		"USE_COMMENTS" => "N",
		"IBLOCK_TYPE" => "dreams",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => $ID,
		"ELEMENT_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "NAME",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"PROPERTY_CODE" => array(0=>"YUOTUBE",1=>"DATE_EXECUTED",2=>"INDICATOR",3=>"USER_COMMENTS",4=>"EN_NAME",5=>"ABOUT_ME",6=>"ENGLISH_ABOUT_ME",7=>"DESCRIPTION_EXECUTE",8=>"ENGLISH_DETAIL_TEXT",9=>"USER",10=>"ADMIN_DESCRIPT",11=>"TURBO_YET",12=>"STATE",13=>"MONEY_DREAM",14=>"TURBO_NEED",15=>"",),
		"OFFERS_LIMIT" => "0",
		"PRICE_CODE" => array(0=>"BASE",),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(),
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"CONVERT_CURRENCY" => "N"
	)
);?>
<?}else{?>
<?$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arUser["PERSONAL_BIRTHDAY"]))/31556926);
?>
        <div class="center">
            <div class="create-node">
                <div class="main_left_img">
                    <div class="left_img_footer">
                        <div class="img_footer_head">
                            <div class="img_footer_name"><?=$arUser["NAME"]." ".$arUser["LAST_NAME"];?> <?=$year." ".ruDecline($year,"год","года","лет");?></div>
                            <div class="img_footer_country"><?=$country.", ".$arUser["PERSONAL_CITY"];?></div>
                        </div>
                        <?if(count($arUser["UF_WEB"])>0):?>
                        <div class="img_footer_website">Веб сайты:&nbsp;
						<?foreach ($arUser["UF_WEB"] as $key=>$arWeb):
							$cropString = mb_substr($arUser["UF_WEB"][$key], 0, 30);
							if (mb_strlen($arUser["UF_WEB"][$key]) > 30) {
								$cropString .= '...';
							}?>
							<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a> 
						<?endforeach;?>						
						</div>
						<?endif;?>
                    </div>
                </div>
                <div class="main_left_news">
                    <div class="dream_h">Мечта</div>
                    <div class="left_news_content">У Вас ещё нет мечты, скорей добавте её, чтобы о ней узнали все.</div>
                    <div class="btn-more">
                        <a href="/personal/edit.php">Создать мечту</a>
                    </div>
                </div>
                <div class="main_left_news last">
                    <div class="left_news_name">О себе</div>
                    <div class="left_news_content">-----</div>
                </div>
            </div>
        </div>
        <aside class="right create-node">           
            <div class="right_turbodreams_sobr">
                <div class="turbodreams_sobr_name"></div>
                <div class="turbodreams_sobr_col">
                <p class="no-check">Вы ещё не оценили свою мечту</p>
                </div>
                <div class="turbodreams_sobr_content">
                    <p>Для оценки добавте мечту и укажите сколько по-вашему нужно средств для её воплощения</p>
                </div>
            </div>
            <div class="right_column_podp">
                <div class="column_podp_name"><span class="left">Присоединяйтесь</span>&nbsp;<span>DreamsStars</span>
                </div>
                <div class="column_podp_seti">
                    <div class="podp_seti_vk">В контакте</div>
                    <div class="podp_seti_fb">Facebook</div>
                </div>
                <div class="column_podp_seti_group"></div>
            </div>
        </aside>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>