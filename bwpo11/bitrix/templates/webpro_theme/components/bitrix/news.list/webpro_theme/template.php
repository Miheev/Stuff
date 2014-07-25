<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$frame= $this->createFrame()->begin();
?>
<div class="news-list">
    <?php
        $design= array();
        $pro= array();
    foreach($arResult["ITEMS"] as $id => $arItem) {
        if ($arItem["IBLOCK_SECTION_ID"] == "3") {
            array_push($pro, $arItem);
            unset($arResult["ITEMS"][$id]);
        }
    }
    $design= array_values($arResult["ITEMS"]);
    ?>
    <div id="block-views-programm-block-razrab" class="block block-views view-miniblog view-display-id-block_razrab">
    <?foreach($pro as $arItem):?>
        <div class="views-row">
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="views-field views-field-title">
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
            </div>
            <div class="views-field views-field-created">
                <span class="field-content"><? $tmp= explode(' ', $arItem['DATE_CREATE']); echo $tmp[0]; ?></span>
            </div>
            <div class="views-field views-field-body">
                    <?echo $arItem["PREVIEW_TEXT"];?>
            </div>
            <div class="views-field views-field-view-node">
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">читать</a>
            </div>
        </div>
    <?endforeach;?>
        </div>
    <div id="block-views-blog-disign-block-design" class="block block-views view-miniblog view-display-id-block_design">
    <?foreach($design as $arItem):?>
        <div class="views-row">
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="views-field views-field-title">
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
            </div>
            <div class="views-field views-field-created">
                <span class="field-content"><? $tmp= explode(' ', $arItem['DATE_CREATE']); echo $tmp[0]; ?></span>
            </div>
            <div class="views-field views-field-body">
                <?echo $arItem["PREVIEW_TEXT"];?>
            </div>
            <div class="views-field views-field-view-node">
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">читать</a>
            </div>
        </div>
    <?endforeach;?>
        </div>
</div>
<? $frame->end(); ?>