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
?>
<h1>Новости финансового рынка</h1>
<div class="news-list">
<div class="content">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $id => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    if ($id % 2 == 0)
        echo '<div class="row clearfix">';
    ?>
	<div class="item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="left">
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):
            $img= CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_EXACT, true);
            ?>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                            src="<?=$img["src"]?>"
                            width="120"
                            height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                            alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                            /></a>
                <?else:?>
                    <img
                        src="<?=$img["src"]?>"
                        width="120"
                        height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                        title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                        />
                <?endif;?>
		<?endif?>
        </div>
        <div class="right">
            <div class="head clearfix">
                <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                    <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                        <h3><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>
                    <?else:?>
                        <h3><?echo $arItem["NAME"]?></h3>
                    <?endif;?>
                <?endif;?>
                <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DATE_ACTIVE_FROM"]):?>
                    <span class="date"><?echo $arItem["DATE_ACTIVE_FROM"]?></span>
                <?endif?>
            </div>
            <div class="text">
                <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                    <?echo $arItem["PREVIEW_TEXT"];?>
                <?endif;?>
            </div>
<!--		--><?//foreach($arItem["FIELDS"] as $code=>$value):?>
<!--			<small>-->
<!--			--><?//=GetMessage("IBLOCK_FIELD_".$code)?><!--:&nbsp;--><?//=$value;?>
<!--			</small><br />-->
<!--		--><?//endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
            <a class="more" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
        </div>
	</div>
<?
    if ($id % 2 == 1)
        echo '</div>';
endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
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
//        cur_pos= $('#more-news-btn').position().top;

        if ($('body').hasClass('ajax-processed')) {
            $('.news-list .row').addClass('hide');
            $('.news-list .content').prepend(items);
            $(window).scrollTop($(window).height());

            $('.news-list .row.hide').slideDown('slow', function(){
                $('body').animate({scrollTop: $('.news-list .row.hide .item').first().position().top-200},1000);
                $('.news-list .row.hide').removeClass('hide');

                items= $('.news-list .row').clone(true, true);
            });
        } else {
            $('body').addClass('ajax-processed');
            items= $('.news-list .row').clone(true, true);

        }
    });
</script>