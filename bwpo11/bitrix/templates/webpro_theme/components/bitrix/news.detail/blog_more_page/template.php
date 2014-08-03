<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
if ($arResult["IBLOCK_SECTION_ID"] == "3")
    $bclass = 'razrab';
else
    $bclass = 'design';
?>
<div class="node-type-blog-<?php echo $bclass; ?> clearfix width-list">

    <div id="right-sidebar">
        <div class="region region-right-sidebar">
            <div id="block-block-6" class="block block-block">


                <div class="content">
                    <div class="blog-point">Выбор блога:</div>
                    <div id="blog-menu">
                        <a href="/design-blog" class="design">
                            <div class="design-img"></div>
                            Дизайн</a>
                        <a href="/programing-blog" class="programing">
                            <div class="programing-img"></div>
                            Разработка</a>
                        <div class="row">
                            <a href="/productinfo/" class="productinfo">
                                <img src="<? echo SITE_TEMPLATE_PATH; ?>/images/1c-bitrix-logo-vert.gif" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="middle-column" class="column ">

            <a id="main-content"></a>

            <div class="block-name-content">
                <span class="title" id="page-title"><?php echo $arResult["NAME"]; ?></span>
            </div>
            <div class="block-name-hr"></div>


            <div class="tabs"></div>
            <div class="region region-content">
                <div id="block-system-main" class="block block-system">


                    <div class="content">
                        <div class="node node-blog-design clearfix">


                            <div class="meta submitted submitted-date">
                                <?php $tmp= explode(' ',$arResult["TIMESTAMP_X"]); echo $tmp[0]; ?>
                            </div>

                            <div class="content clearfix">
                                <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                                    <div class="field-items">
                                        <?php echo $arResult["DETAIL_TEXT"]; ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.section, /#content -->


</div>



