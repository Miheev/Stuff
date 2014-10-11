<?//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>

<?php
$arResult= $_GET['dream_item'];
global $contry;
global $year;
?>

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