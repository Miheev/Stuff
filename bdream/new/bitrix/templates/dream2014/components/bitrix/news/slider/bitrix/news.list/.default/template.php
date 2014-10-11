<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <div class="slider clearfix">
                <div class="slider-viewport">
                    <div class="bxslider">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
						
                        <section id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <header>
                               <h2><?echo $arItem["NAME"]?></h2>
                                 <a href="<?echo $arItem["PROPERTIES"]["WWW"]["VALUE"]?>"><button>Начать действовать</button></a>
                            </header>
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>" />
                        </section>
	
<?endforeach;?>         
                    </div>
                </div>
            </div>
