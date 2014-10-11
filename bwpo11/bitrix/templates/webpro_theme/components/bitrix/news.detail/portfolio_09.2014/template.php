<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//$frame = $this->createFrame()->begin("");
$img_margin= 5;
?>

<!--    <pre>-->
<!--        --><?//print_r($arResult);?>
<!--    </pre>-->


<div class="clearfix width-list port-full text">
    <div class="breadcrumbs back">
        <div class="item"><a href="/portfolio">Портфолио</a></div>
        <div class="item"><span><?=$APPLICATION->showTitle(); ?></span></div>
    </div>
    <div class="info clearfix">
        <div class="left">
            <h1><?php echo $arResult["NAME"]; ?></h1>
            <?if (!empty($arResult["DISPLAY_PROPERTIES"]['cms']['DISPLAY_VALUE'])) : ?>
            <p class="cms <?=$arResult["DISPLAY_PROPERTIES"]['cms']['VALUE_XML_ID'];?>">Разработано на <span><?=$arResult["DISPLAY_PROPERTIES"]['cms']['DISPLAY_VALUE'];?></span>
                <? echo CFile::ShowImage(SITE_TEMPLATE_PATH.'/images/ico_'.$arResult["DISPLAY_PROPERTIES"]['cms']['VALUE_XML_ID'].'.png', 40, 40); ?>
            </p>
            <?endif;?>
            <?if (!empty($arResult["DISPLAY_PROPERTIES"]['site']['DISPLAY_VALUE'])) : ?>
            <p class="site">Сайт: <a target="_blank" href="http://<?=$arResult["DISPLAY_PROPERTIES"]['site']['DISPLAY_VALUE'];?>"><?=$arResult["DISPLAY_PROPERTIES"]['site']['DISPLAY_VALUE'];?></a></p>
            <?endif;?>
        </div>
        <div class="right">
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]['result']['DISPLAY_VALUE'])) :?>
            <h3>Итоги разработки:</h3>
                <?=$arResult["DISPLAY_PROPERTIES"]['result']['DISPLAY_VALUE'];?>
            <? else :
                echo '&nbsp;&nbsp;';
            endif; ?>
        </div>
    </div>
    <div class="description">
        <h3>Описание проекта:</h3>
        <?=$arResult["DETAIL_TEXT"];?>
    </div>
</div>
    <div class="clearfix port-full imgs">
            <div class="img-full">
                <div class="img-back">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/port_monitor.png" alt=""/>

                    <div class="img-monitor">
                        <img class="cur" src="<?= $arResult["DETAIL_PICTURE"]["SRC"]; ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
                    </div>
                    <div class="img-glare">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/fg_portfolio.png" alt=""/>
                    </div>
                </div>
            </div>
            <div class="img-tumb">
                <div class="width-list inner clearfix">
                    <?
                    if (!isset($arResult["DISPLAY_PROPERTIES"]['imgs']['FILE_VALUE']))
                        $arResult["DISPLAY_PROPERTIES"]['imgs']['FILE_VALUE']= array();
                    if (empty($arResult["DISPLAY_PROPERTIES"]['imgs']['FILE_VALUE'])) {
                        ;
                    } else {
                        array_unshift($arResult["DISPLAY_PROPERTIES"]['imgs']['FILE_VALUE'], $arResult["DETAIL_PICTURE"]);
                        foreach ($arResult["DISPLAY_PROPERTIES"]['imgs']['FILE_VALUE'] as $img)
                            echo CFile::ShowImage($img['SRC']);
                    }
                    ?>
                </div>
            </div>
    </div>
<script>
    imglock= false;
    $(document).ready(function(){
        $('.img-tumb img').click(function(){

            if (!imglock) {
                imglock= true;

                it= $(this);
                cur= $('.img-monitor .cur');
                if (it.attr('src') == cur.attr('src')) {
                    imglock= false;
                    return;
                }

                id= $('.img-tumb img').index(it);

                nimg= it.clone();
                nimg.addClass('next');
                nimg.appendTo($('.img-monitor'));

                $('body').animate({scrollTop: $('.img-monitor').position().top+450},1000);
                cur.fadeOut('slow');
                setTimeout(function(){
                    $('.img-monitor .next').fadeIn('slow', function(){
                        cur.remove();
                        $(this).removeClass('next').addClass('cur');

                        imglock= false;
                    });
                }, 200);
            }
        });
    });
</script>

<?if (isset($arResult["DISPLAY_PROPERTIES"]['review_id'])) :
    $review = false;
    if(CModule::IncludeModule('iblock') && ($review = GetIBlockElement($arResult["DISPLAY_PROPERTIES"]['review_id']['VALUE'], 'portfolio'))) :
    ?>
    <div class="clearfix width-list port-full">
        <div class="review">
            <div class="inner clearfix">
                <div class="left">
                    <?
                    echo CFile::ShowImage($review['PREVIEW_PICTURE'], 150, 999);
                    ?>
                </div>
                <div class="right">
                    <h3><?=$review['NAME']?></h3>
                    <div class="description">
                        <?=$review['PREVIEW_TEXT']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a class="abutton" href="/portfolio">Назад в портфолио</a>
        </div>
    </div>
    <?endif;
endif;?>
<?php //$frame->end(); ?>