<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle("Отзывы клиентов || Webpro");
?>
<div class="width-list">
    <div class="breadcrumbs back">
        <div class="item"><a href="/portfolio">Портфолио</a></div>
        <div class="item"><span><?=$APPLICATION->showTitle(); ?></span></div>
    </div>
    <h2 class="page-title">Отзывы клиентов</h2>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
    <div class="review-list clearfix">
        <div class="row clearfix">
<?
$item_count= count($arResult["ITEMS"])-1;
$newcol= $item_count % 2 + intval($item_count/2);

foreach($arResult["ITEMS"] as $item_id => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    if ($item_id == 0) echo '<div class="column">';
    else if ($item_id == $newcol) echo '</div><div class="column">';
    ?>
	<div class="review-list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="inner clearfix">
            <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                <p class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></p>
            <?endif?>
            <div class="left">
                <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <h3><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>
                    <?else:?>
                        <h3><?echo $arItem["NAME"]?></h3>
                    <?endif;?>
                <?endif;?>
                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                    <?echo $arItem["PREVIEW_TEXT"];?>
                <?endif;?>
            </div>
            <div class="right">
                <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                                border="0"
                                src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                                /></a>
                    <?else:?>
                        <img
                            border="0"
                            src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                            width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                            />
                    <?endif;?>
                <?endif?>
            </div>
        </div>
	</div>
<?
    if ($item_id == $item_count) echo '</div>';
endforeach;?>
    </div>
    </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

<script>
    if (typeof items == 'undefined') {
        items= 0;
//        cur_pos= 0;
        BX.ajax.Setup({
            emulateOnload: true
        });
    }

    $(document).ready(function(){
//        cur_pos= $('#more-review-btn').position().top;

        if ($('body').hasClass('ajax-processed')) {
            $('.review-list>.row').addClass('hide');
            $('.review-list').prepend(items);
            $(window).scrollTop($(window).height());

            $('.review-list>.row.hide').slideDown('slow', function(){
                $('body').animate({scrollTop: $('.review-list>.row.hide .review-list-item').first().position().top-200},1000);
                $('.review-list>.row.hide').removeClass('hide');

                items= $('.review-list>.row').clone(true, true);
            });
        } else {
            $('body').addClass('ajax-processed');
            items= $('.review-list>.row').clone(true, true);

        }
    });
</script>