<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$this->IncludeLangFile('template.php');
?>
        <div class="info-cont gradient">
            <div class="info">
                <div class="left">
                    <a href="/personal/cart"><img src="<?=SITE_TEMPLATE_PATH?>/img/basket_main.png" alt="" /></a>
                </div>
                <div class="text">
                    <?if ($arResult['NUM_PRODUCTS'] > 0 && $arParams['SHOW_NUM_PRODUCTS'] == 'N' && $arParams['SHOW_TOTAL_PRICE'] == 'N'):?>
                        <a href="<?=$arParams['PATH_TO_BASKET']?>"><?=GetMessage('TSB1_CART')?></a>
                    <? else :?>

                        <?if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y'):?>
                            <?if ($arResult['NUM_PRODUCTS'] > 0):?>
                                <p>Всего: <strong>
                                        <a href="<?=$arParams['PATH_TO_BASKET']?>"><?=$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)']?></a>
                                </strong></p>
                            <?else:?>
                                <p>Всего: <strong>
                                        <?=$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)']?>
                                    </strong></p>
                            <?endif?>
                        <?endif?>
                        <?if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
                            <?if ($arResult['NUM_PRODUCTS'] > 0 && $arParams['SHOW_NUM_PRODUCTS'] == 'N'):?>
                                <p><?=GetMessage('TSB1_TOTAL_PRICE')?>: <strong>
                                        <a href="<?=$arParams['PATH_TO_BASKET']?>"><?=$arResult['TOTAL_PRICE']?></a>
                                    </strong></p>
                            <?else:?>
                                <p><?=GetMessage('TSB1_TOTAL_PRICE')?>: <strong>
                                        <strong><?=$arResult['TOTAL_PRICE']?></strong>
                                    </strong></p>
                            <?endif?>
                        <?endif?>
                    <?endif?>
                    <?if ($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
                        <br>
                        <span class="icon_profile"></span>
                        <a class="link_profile" href="<?=$arParams['PATH_TO_PERSONAL']?>"><?=GetMessage('TSB1_PERSONAL')?></a>
                    <?endif?>
                </div>
                <div class="right">
                    <img class="basket-open" src="<?=SITE_TEMPLATE_PATH?>/img/basket_chk.png" alt="" />
                </div>
            </div>
        </div>

            <?if ($arResult['NUM_PRODUCTS'] > 0):?>
                <div class="content <?
                $topNumber = 3;
                if ($arParams['SHOW_TOTAL_PRICE'] == 'N')
                    $topNumber--;
                if ($arParams['SHOW_PERSONAL_LINK'] == 'N')
                    $topNumber--;
                if ($topNumber != 3)
                    echo " top$topNumber";
                ?>">

                        <?foreach ($arResult["CATEGORIES"] as $category => $items):
                            if (empty($items))
                                continue;
                            ?>
<!--                            <div class="bx_item_status">--><?//=GetMessage("TSB1_$category")?><!--</div>-->
                            <?foreach ($items as $v):?>
                            <div class="item bx_itemincart">
                                <div class=""  ></div>
                                <?if ($arParams["SHOW_IMAGE"] == "Y"):?>
                                    <div class="img">
                                        <?if ($v["PICTURE_SRC"]):?>
                                            <?if($v["DETAIL_PAGE_URL"]):?>
                                                <a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>"></a>
                                            <?else:?>
                                                <img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>" />
                                            <?endif?>
                                        <?endif?>
                                    </div>
                                <?endif?>
                                <div class="text clearfix">
                                    <p class="name">
                                        <?if ($v["DETAIL_PAGE_URL"]):?>
                                            <a href="<?=$v["DETAIL_PAGE_URL"]?>"><?=$v["NAME"]?></a>
                                        <?else:?>
                                            <?=$v["NAME"]?>
                                        <?endif?>
                                    </p>
                                </div>
                                <div class="price-action clearfix">
                                    <span class="price"><?=$v["QUANTITY"]?>x<?=$v["FULL_PRICE"]?></span>
                                    <a class="del-btn bx_item_delete" href="javascript:void(0);" onclick="sbbl.removeItemFromCart(<?=$v['ID']?>); $(this).parents('.item').first().remove();" title="<?=GetMessage("TSB1_DELETE")?>">Удалить</a>
                                </div>
                            </div>
                        <?endforeach?>
                        <?endforeach?>

<!--                    --><?//if($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>
<!--                        <div class="bx_button_container">-->
<!--                            <a href="--><?//=$arParams["PATH_TO_ORDER"]?><!--" class="bx_bt_button_type_2 bx_medium">-->
<!--                                --><?//=GetMessage("TSB1_2ORDER")?>
<!--                            </a>-->
<!--                        </div>-->
<!--                    --><?//endif?>

                </div>
            <?endif?>