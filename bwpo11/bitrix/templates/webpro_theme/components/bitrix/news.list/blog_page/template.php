<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="clearfix width-list">

    <div id="right-sidebar">
        <div class="region region-right-sidebar">
            <div id="block-block-6" class="block block-block">


                <div class="content">
                    <div class="blog-point">Выбор блога:</div>
                    <div id="blog-menu">
                        <a href="/blog/list.php?SECTION_ID=2" class="design">
                            <div class="design-img"></div>
                            Дизайн</a>
                        <a href="/blog/list.php?SECTION_ID=3" class="programing">
                            <div class="programing-img"></div>
                            Разработка</a></div>
                </div>
            </div>
        </div>
    </div>


    <div id="middle-column" class="column ">
            <a id="main-content"></a>


            <div class="tabs"></div>
            <div class="region region-content">
                <div id="block-system-main" class="block block-system">


                    <div class="content">
                        <div
                            class="view view-blog-all view-id-blog_all view-display-id-blog_all view-blog view-dom-id-a71c1359fbdef2e835979325b6cd72d8">


                            <div class="view-content">

                                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                        <?
                                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                        ?>
                                        <div class="views-row views-row-2 views-row-even">
                                            <?php
                                            if ($arItem["IBLOCK_SECTION_ID"] == "3")
                                                $bclass = 'razrab';
                                            else
                                                $bclass = 'design';
                                            ?>
                                            <div class="blog_<?php echo $bclass; ?>_a">
                                                <div class="views-field views-field-title">
                                                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
                                                </div>
                                            </div>


                                            <div class="views-field views-field-created">
                                        <span class="field-content"><? $tmp = explode(' ', $arItem['DATE_CREATE']);
                                            echo $tmp[0]; ?></span>
                                            </div>


                                            <div class="views-field views-field-body">
                                                <? echo $arItem["PREVIEW_TEXT"]; ?>
                                            </div>


                                            <div class="views-field views-field-view-node">
                                                <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">читать</a>
                                            </div>


                                            <div class="views-field views-field-field-tags">
                                                <div class="field-content">
                                                    <?php
                                                    //if (isset($arItem["TAGS"]) && !empty($arItem["TAGS"])) {
                                                    echo $arItem["TAGS"]
                                                    //}
                                                    ?>
<!--                                                    <a href="/tegi/virtualnyy-hosting"-->
<!--                                                       typeof="skos:Concept"-->
<!--                                                       property="rdfs:label skos:prefLabel" datatype="">виртуальный-->
<!--                                                                                                        хостинг</a>,-->
<!--                                                    <a href="/tegi/vps" typeof="skos:Concept"-->
<!--                                                       property="rdfs:label skos:prefLabel" datatype="">VPS</a>-->
                                                </div>
                                            </div>
                                        </div>
                                    <? endforeach; ?>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.section, /#content -->


</div>