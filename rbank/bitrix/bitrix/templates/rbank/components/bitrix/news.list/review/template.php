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
<section class="review-list">
    <div class="head">
        <h2>Отзывы</h2>
        <div class="select">
            <div class="abbr clearfix"><span class="label">Выберите банк</span><span class="pointer"></span></div>
            <div class="list">
                <a href="javascript:void(0);" >Банк 1</a>
                <a href="javascript:void(0);">Банк 2</a>
                <a href="javascript:void(0);">Банк 3</a>
            </div>
        </div>
    </div>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $id => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    ?>
	<div class="item clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                    <p class="name"><?echo $arItem["NAME"]?></p>
            <?endif;?>
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
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</section>


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