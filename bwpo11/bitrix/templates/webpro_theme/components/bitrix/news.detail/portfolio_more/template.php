<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="clearfix width-list">


            <div class="block-name-content">
                <?php
                    $tmp= explode(' ', $arResult["NAME"], 2);
                ?>
                <span class="black"><?php echo $tmp[0]; ?></span> <span class="green"><?php echo $tmp[1]; ?></span>
            </div>
            <div class="block-name-hr"></div>


            <div class="tabs"></div>
            <div class="region region-content">
                <div id="block-system-main" class="block block-system">


                    <div class="content">
                        <div class="node node-work clearfix">


                            <div class="content clearfix">
                                <div class="field field-name-field-image field-type-image field-label-hidden">
                                    <div class="field-items">
                                        <div class="field-item even"><img
                                                class="detail_picture"
                                                border="0"
                                                src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                                                width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                                                height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                                                alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                                                title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                                                /></div>
                                    </div>
                                </div>
                                <div class="field field-name-field-name-project field-type-text field-label-above">
                                    <div class="field-label">Название проекта:&nbsp;</div>
                                    <div class="field-items">
                                        <div class="field-item even"><?=$arResult["NAME"]; ?></div>
                                    </div>
                                </div>
                                <div class="field field-name-field-fullopis field-type-text-long field-label-above">
                                    <div class="field-label">Описание проекта:&nbsp;</div>
                                    <div class="field-items">
                                        <?=$arResult["DETAIL_TEXT"]; ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

</div>