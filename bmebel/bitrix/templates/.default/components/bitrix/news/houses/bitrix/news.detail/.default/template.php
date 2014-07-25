<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetPageProperty("tags", $arResult["NAME"]);
$APPLICATION->SetPageProperty("keywords", $arResult["NAME"]);
$APPLICATION->SetPageProperty("description", $arResult["NAME"]);
$APPLICATION->SetTitle($arResult["NAME"]);

$dbres=CIBlockSection::GetNavChain($arResult["IBLOCK_ID"],$arResult["IBLOCK_SECTION_ID"]);
$tit=$arResult["NAME"];
$sect=$dbres->fetch();
do
{
$tit.=" - ".$sect["NAME"];
}
while($sect=$dbres->fetch());
$tit.=" - ".$arResult["IBLOCK"]["NAME"];
$APPLICATION->SetPageProperty("title", $tit);
?>


            <script type="text/javascript" src="/js/jquery.corner.js"></script>
            <script type="text/javascript" src="/js/jquery.galleriffic.js"></script>
            <script type="text/javascript" src="/js/jquery.opacityrollover.js"></script>
            <script type="text/javascript">
            function printit(){
                window.print() ;
            }

            jQuery(document).ready(function($) {
                // We only want these styles applied when javascript is enabled
                $('div.navigation').css({'width' : '300px', 'float' : 'left'});
                $('div.content').css('display', 'block');

                // Initially set opacity on thumbs and add
                // additional styling for hover effect on thumbs
                var onMouseOutOpacity = 0.67;
                $('#thumbs ul.thumbs li').opacityrollover({
                    mouseOutOpacity:   onMouseOutOpacity,
                    mouseOverOpacity:  1.0,
                    fadeSpeed:         'fast',
                    exemptionSelector: '.selected'
                });

                // Initialize Advanced Galleriffic Gallery
                var gallery = $('#thumbs, #thumbs2').galleriffic({
                    delay:                     2500,
                    numThumbs:                 25,
                    preloadAhead:              10,
                    enableTopPager:            true,
                    enableBottomPager:         true,
                    maxPagesToShow:            7,
                    imageContainerSel:         '#slideshow',
                    controlsContainerSel:      '#controls',
                    captionContainerSel:       '#caption',
                    loadingContainerSel:       '#loading',
                    renderSSControls:          true,
                    renderNavControls:         true,
                    playLinkText:              'Play Slideshow',
                    pauseLinkText:             'Pause Slideshow',
                    prevLinkText:              '<img src=/images/rewind.png>',
                    nextLinkText:              '<img src=/images/fastf.png>',
                    nextPageLinkText:          'Next &rsaquo;',
                    prevPageLinkText:          '&lsaquo; Prev',
                    enableHistory:             false,
                    autoStart:                 false,
                    syncTransitions:           true,
                    defaultTransitionDuration: 900,
                    onSlideChange:             function(prevIndex, nextIndex) {
                        // 'this' refers to the gallery, which is an extension of $('#thumbs')
                        this.find('ul.thumbs').children()
                            .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                            .eq(nextIndex).fadeTo('fast', 1.0);

                    },
                    onPageTransitionOut:       function(callback) {
                        this.fadeTo('fast', 0.0, callback);
                    },
                    onPageTransitionIn:        function() {
                        this.fadeTo('fast', 1.0);

                    }
                });

            });

            </script>



<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
    <h1 class="house_name"><?=$arResult["NAME"]?></h1>
<?endif;?>
<div class="element-back">
   <a href="<?=$arResult['LIST_PAGE_URL']?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a>
</div>  




<table class="dom_table" style="width:1200px;">
    <tr>
        <td style="vertical-align:top; width:600px;">  
             <div style="width:600px;"></div>
             <div id="controls" class="controls"></div>
             <div class="slideshow-container">
                <div id="slideshow" class="slideshow">

                </div>
            </div>  
                                                  
        
        <div class="catalog-element-center-leftbot">
            <div class="catalog-element-print">
                <span>Версия для печати</span>
                <a class="element-print" target="_blank" href="<?=htmlspecialchars($APPLICATION->GetCurUri("print=Y"));?>" title="Версия для печати" rel="nofollow"></a>
            </div>
            <div class="catalog-element-demand">
                <span>Оставить заявку</span>
                <a class="element-demand" href="/countryhouse/order/"></a>
            </div>
        </div>   

            <br />
            <br />  
             <br />   
          
            
            
        </td>
        <td class="dom_table_right" style="width:335px; margin-right:15px;">
            <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                <? if ($pid=='maki_houses') { continue; } ?>
                <? if ($pid=='maki_plans') { continue; } ?>
                <? if ($pid=='maki_photo') { continue; } ?>
                <strong><?=$arProperty["NAME"]?></strong>&nbsp;&mdash;&nbsp;
                <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                    <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                <?else:?>
                    <?=$arProperty["DISPLAY_VALUE"];?>
                <?endif?>
                <br />
            <?endforeach;?>
            <?foreach($arResult["FIELDS"] as $code=>$value):?>
                <?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
                <br />
            <?endforeach;?>
            <br />
            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
                <p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
            <?endif;?>
            <?if($arResult["NAV_RESULT"]):?>
                <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
                <?echo $arResult["NAV_TEXT"];?>
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
             <?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
                <?echo $arResult["DETAIL_TEXT"];?>
             <?else:?>
                <?echo $arResult["PREVIEW_TEXT"];?>
            <?endif?>
            <br />
            <br />        
        </td>
		<td style="width:250px;">
		<b>Фотографии</b>
             <div id="thumbs" >
                    <ul class="thumbs noscript">
                    <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

                       <? if($arProperty['CODE'] == 'maki_houses'):?>
                      
                             <?foreach($arProperty['VALUE'] as $pi=>$Property):?>
                             <li>
                                <a class="thumb" href="<?=$Property['BIG_IMG']['src']?>"  data-height="<?=$Property['BIG_IMG']['height']?>" title="<?=$arResult["NAME"]?>">
                                    <img src="<?=$Property['SMALL_IMG']['src']?>" width="<?=$arProperty['VALUE_SMALL_IMG'][$k]['width']?>" height="<?=$arProperty['VALUE_SMALL_IMG'][$k]['height']?>"   class="thumbs">
                                </a>
                             </li>
                             <?endforeach?>
                       <? endif;?>
        <!--тут были планы-->
        
                       <? if($arProperty['CODE'] == 'maki_photo' ):?>

                            <?foreach($arProperty['VALUE'] as $k =>  $Property2):?>
                                <li>
                                    <a class="thumb" href="<?=$arProperty['VALUE_BIG_IMG'][$k]['src']?>" data-height="<?=$arProperty['VALUE_BIG_IMG'][$k]['height']?>" title="<?=$arResult["NAME"]?>">
                                        <img src="<?=$arProperty['VALUE_SMALL_IMG'][$k]['src']?>" width="<?=$arProperty['VALUE_SMALL_IMG'][$k]['width']?>" height="<?=$arProperty['VALUE_SMALL_IMG'][$k]['height']?>"  class="thumbs">
                                    </a>                           
                                </li>
                             <?endforeach?>
                       <? endif;?>

                    <?endforeach?>
                    </ul>

              </div>
              <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>  
                    <? if($arProperty['CODE'] == 'maki_plans'):?>
                        <strong>Планировки</strong><br />   

                        <?foreach($arProperty['VALUE'] as $k =>  $Property2):?>
                            <a href="<?=$arProperty['VALUE_BIG_IMG'][$k]['src']?>"  onclick="ImgShw('<?=$arProperty['VALUE_BIG_IMG'][$k]['src']?>', <?=$arProperty['VALUE_BIG_IMG'][$k]['width']?>, <?=$arProperty['VALUE_BIG_IMG'][$k]['height']?>, ''); return false;" >
                                <img src="<?=$arProperty['VALUE_SMALL_IMG'][$k]['src']?>" width="<?=$arProperty['VALUE_SMALL_IMG'][$k]['width']?>" height="<?=$arProperty['VALUE_SMALL_IMG'][$k]['height']?>" >
                            </a> 

                        <?endforeach?>
                    <? endif;?>             
              <?endforeach?>  
		</td>
    </tr>
</table>
    
    
</div>
<?
//printr($arResult["DISPLAY_PROPERTIES"]);
?>

