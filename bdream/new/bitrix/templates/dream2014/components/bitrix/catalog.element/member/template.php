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

$_GET['dream_item']= $arResult['ID'];
?>
<?//echo "<pre>";print_R($arResult);echo "</pre>";?>
<div class="center" id="<? echo $arItemIDs['ID']; ?>">
    <div class="main_left_menu">
        <ul class="menu">
            <li><a class="active" href="/">Мечта</a></li>
            <li><a href="/member/gallery.php">Галерея</a></li>
            <li><a href="/member/help.php">Уже помогли</a></li>
        </ul>
    </div>
    <div class="tabs">
        <div class="item">
            <div class="main_left_img">
                <img src="<?=GetImageResized($arResult["DETAIL_PICTURE"]["SRC"], 665, 341);?>" alt="<?=$strAlt?>">
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
                <div class="left_news_name">Мечта</div>
                <div class="left_news_content">
                    <?=$arResult["~DETAIL_TEXT"];?></div>
            </div>
            <div class="main_left_news last">
                <div class="left_news_name">О себе</div>
                <div class="left_news_content">
                    <?=$arResult["PROPERTIES"]["ABOUT_ME"]["VALUE"]["TEXT"];?>
                </div>
            </div>
        </div>
        <div class="item" style="display: none;">
            <!--                            --><?//$APPLICATION->IncludeComponent(
            //                                "bitrix:main.include",
            //                                "",
            //                                Array(
            //                                    "AREA_FILE_SHOW" => "file",
            //                                    "AREA_FILE_SUFFIX" => "inc",
            //                                    "EDIT_TEMPLATE" => "",
            //                                    "AREA_FILE_RECURSIVE" => "Y",
            //                                    "PATH" => SITE_TEMPLATE_PATH."/components/bitrix/catalog.element/member/tabs/tab_gallery.php"
            //                                )
            //                            );?>
        </div>
        <div class="item" style="display: none;">
            <!--                            --><?//$APPLICATION->IncludeComponent(
            //                                "bitrix:main.include",
            //                                "",
            //                                Array(
            //                                    "AREA_FILE_SHOW" => "file",
            //                                    "AREA_FILE_SUFFIX" => "inc",
            //                                    "EDIT_TEMPLATE" => "",
            //                                    "AREA_FILE_RECURSIVE" => "Y",
            //                                    "PATH" => SITE_TEMPLATE_PATH."/components/bitrix/catalog.element/member/tabs/tab_help.php"
            //                                )
            //                            );?>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.main_left_menu a').click(function(e){
                e.preventDefault();

                id= $('.main_left_menu a').index($(this));
                pid= $('.main_left_menu a').index($('.main_left_menu a.active'));

                urls= [0,'tab_gallery.php', 'tab_help.php'];
                $('.tabs .item').eq(pid).fadeOut('slow', function(){
                    if ($('.tabs .item').eq(id).find('div').length) {
                        $('.tabs .item').eq(id).fadeIn('slow');
                        $('.main_left_menu a.active').removeClass('active');
                        $('.main_left_menu a').eq(id).addClass('active');
                    } else {
                        $.post('/bitrix/templates/dream2014/components/bitrix/catalog.element/member/tabs/'+urls[id],
                            {ELEMENT_ID:"<?php echo $_REQUEST["ELEMENT_ID"]; ?>"},
                            function(data, state){
                                console.log(state);
                                if (state == 'success') {
                                    $('.tabs .item').eq(id).append(data);

                                    $('.tabs .item').eq(id).fadeIn('slow');
                                    $('.main_left_menu a.active').removeClass('active');
                                    $('.main_left_menu a').eq(id).addClass('active');
                                } else
                                    console.log(data);
                            });
                    }
                });
            });
        });
    </script>
</div>
<aside class="right">
    <?global $USER;
    if ($USER->IsAuthorized()){?>
        <?$APPLICATION->IncludeComponent(
            "webpro:dream.favor",
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
                "FIELD_CODE" => array(),
                "PROPERTY_CODE" => array(),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "Y",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N"
            )
        );?>
        <?$APPLICATION->IncludeComponent(
            "webpro:dream.golos",
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
    <?}?>

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
        <div class="column_podp_name"><span class="left">Присоединяйтесь</span>&nbsp;<span>DreamsStart</span></div>
        <div class="column_podp_seti">
            <div class="podp_seti_vk">В контакте</div>
            <div class="podp_seti_fb">Facebook</div>
        </div>
        <div class="column_podp_seti_group"></div>
    </div>
</aside>