<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/js/jquery.corner.js"></script>
<script type="text/javascript" src="/js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="/js/jquery.opacityrollover.js"></script>
<script type="text/javascript">

$(document).ready(function(){
/*
	$('.thumbs').bind('click',function(){
        var hei = $('#imBig').height();
        hei = hei*0.7;
      //  alert(hei);
        $('#divBig').css('min-height', hei);
		$('.thumbs').removeClass("sel");
		$('#imBig').fadeOut('fast').css('display','none'); // скрытие
		$('#imBig').attr('src',$(this).attr('alt')); // замена картинки
		$('#imBig').fadeIn(); // показ картинки
		$(this).addClass("sel"); // установка рамки у превью

	});
*/
    $(".special-offers-block-content").corner();
    $('.special-offers-block-content').hover(function(){
        $(".special-offers-block-content-text", this).stop().animate({left:'140px'},{queue:false,duration:160});
    }, function() {
      $(".special-offers-block-content-text", this).stop().animate({left:'262px'},{queue:false,duration:160});
    });

});
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
				var gallery = $('#thumbs').galleriffic({
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

<?
// Functions for a conclusion of a parental  SECTION
$nav = CIBlockSection::GetNavChain(IntVal($arResult['IBLOCK_ID']), IntVal($arResult['IBLOCK_SECTION_ID']));
while ($arNav=$nav->GetNext()):
    if($arNav['DEPTH_LEVEL'] == 1):
      $res = CIBlockSection::GetByID($arNav["ID"]);
      if($ar_res = $res->GetNext()) {

            $parentselectionimg = $ar_res['PICTURE'];
            $parentselection = $ar_res['NAME'];

      }
    endif;

endwhile;


?>

<div class="catalog-element">
  <div class="catalog-popup-top">
          <div class="catalog-element-name">
              <?=$arResult['NAME']?>
          </div>
      <div class="clear"></div>
  </div>
  <div class="catalog-element-center">
    <div class="catalog-element-center-left" >
	    <div id="controls" class="controls"></div>
        <div class="slideshow-container">
		    <div id="slideshow" class="slideshow"></div>
	    </div>
        <div class="catalog-element-center-leftbot" id="thumbs">
            <ul class="thumbs noscript">
                <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

                    <? if($arProperty['CODE'] == 'maki_houses'):?>

                        <?foreach($arProperty['VALUE'] as $pi=>$Property):?>
                            <li>
                                <a class="thumb" href="<?=$Property['BIG_IMG']['src']?>" data-height="<?=$Property['BIG_IMG']['height']?>" title="<?=$arResult['NAME']?>">
                                    <img src="<?=$Property['SMALL_IMG']['src']?>" width="60" height="60" alt="<?=$arResult['NAME']?>" class="thumbs">
                                </a>
                            </li>
                        <?endforeach?>
                    <? endif;?>
                    <!--тут были планы-->
                    <? if($arProperty['CODE'] == 'maki_plans' ):?>

                        <?foreach($arProperty['VALUE'] as $k =>  $Property2):?>
                            <?
                            $src = $arProperty['VALUE_BIG_IMG'][$k]['src'];
                            $bigpath2 = CFile::GetPath($Property2); ?>
                            <li>
                                <a class="thumb" href="<?=$arProperty['VALUE_BIG_IMG'][$k]['src']?>" data-height="<?=$arProperty['VALUE_BIG_IMG'][$k]['height']?>" title="<?=$arResult['NAME']?>">
                                    <img src="<?=$arProperty['VALUE_SMALL_IMG'][$k]['src']?>" width="60" height="60" alt="<?=$arResult['NAME']?>" class="thumbs">
                                </a>
                            </li>
                        <?endforeach?>
                    <? endif;?>

                    <? if($arProperty['CODE'] == 'maki_elevations' ):?>

                        <?foreach($arProperty['VALUE'] as $k => $Property3):?>
                            <?
                            $src = $arProperty['VALUE_BIG_IMG'][$k]['src'];
                            $bigpath3 = CFile::GetPath($Property3); ?>
                            <li>
                                <a class="thumb" href="<?=$arProperty['VALUE_BIG_IMG'][$k]['src']?>" data-height="<?=$arProperty['VALUE_BIG_IMG'][$k]['height']?>" title="<?=$arResult['NAME']?>">
                                    <img src="<?=$arProperty['VALUE_SMALL_IMG'][$k]['src']?>" width="60" height="60" alt="<?=$arResult['NAME']?>" class="thumbs">
                                </a>
                            </li>
                        <?endforeach?>
                    <? endif;?>
                <?endforeach?>
            </ul>
        </div>
    </div>
    <div class="catalog-element-center-right">
        <div class="element-properties">
            <div class="catalog-element-demand">
                <a class="" href="/countryhouse/order/">Оставить заявку</a>
            </div>

    	    <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
               <? if($arProperty['CODE'] == 'maki_houses' || $arProperty['CODE'] == 'maki_plans' || $arProperty['CODE'] == 'maki_elevations' || $arProperty['CODE'] == 'maki_similar'):?>

               <?else:?>
                    <p><b><?=$arProperty["NAME"]?></b><span><?=$arProperty["DISPLAY_VALUE"]?> <? if($arProperty['CODE'] != 'maki_area'){} else{ echo 'м2';}?></span></p>
               <? endif;?>

    		<?endforeach?>

        </div>
	<?if($arResult["DETAIL_TEXT"]):?>
        <div class="catalog-element-descript">
            <p><b>Описание дома</b></p>
            <div class="catalog-element-descr-block">
              <?=$arResult["DETAIL_TEXT"]?>
            </div>
        </div>
	<?elseif($arResult["PREVIEW_TEXT"]):?>
        <div class="catalog-element-descript">
            <p><b>Описание дома</b></p>
            <div class="catalog-element-descr-block">
                <?=$arResult["PREVIEW_TEXT"]?>
            </div>
        </div>
	<?endif;?>
			<div style="padding:10px 0 0 0;"><?$APPLICATION->IncludeComponent(
	"activiti.bitrixonrails:facebook.like.button",
	"",
	Array(
		"URL_TO_LIKE" => "",
		"LAYOUT_STYLE" => "standard",
		"SHOW_FACES" => "Y",
		"WIDTH" => "450",
		"VERB_TO_DISPLAY" => "like",
		"FONT" => "arial",
		"COLOR" => "light",
		"LANG" => "ru_RU",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
false
);?><div>
    </div>
    <div class="clear"></div>
  </div>
  <? if($arResult["DISPLAY_PROPERTIES"]['maki_similar']['VALUE']['0']):?>
  <div class="catalog-element-bottom">

      <div class="catalog-element-bottom-left">
      <?foreach($arResult["DISPLAY_PROPERTIES"]['maki_similar']['VALUE'] as $similar_id):?>
              <div class="special-offers-block">
                  <div class="special-offers-block-left">
                      <div class="special-offers-block-right">
                          <div class="special-offers-block-fon">
                             <div class="special-offers-block-content">
                              <?
                                $res = CIBlockElement::GetByID($similar_id);
                                if($ar_res = $res->GetNext()): ?>
                                  <a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><? echo CFile::ShowImage($ar_res['PREVIEW_PICTURE'], 262, auto, "border=0 width='262' ", "", false);?></a>
                                  <div class="special-offers-block-content-text">
                                        <h4><a href="<?=$ar_res['DETAIL_PAGE_URL']?>"><?=$ar_res['NAME']?></a></h4>
                                        <div class="special-offers-block-content-text-propert">
                                        <?
                                          $db_props = CIBlockElement::GetProperty($ar_res['IBLOCK_ID'], $ar_res['ID'], array("sort" => "asc"), Array("CODE"=>"maki_code"));
                                          if($ar_props = $db_props->GetNext()):
                                             if ($ar_props['VALUE']):
                                                echo "<p>".$ar_props['NAME'].':<span>'.$ar_props['VALUE'].'</span></p>';
                                             endif;
                                          endif;

                                          $db_props = CIBlockElement::GetProperty($ar_res['IBLOCK_ID'], $ar_res['ID'], array("sort" => "asc"), Array("CODE"=>"maki_area"));
                                          if($ar_props = $db_props->GetNext()):
                                             if ($ar_props['VALUE']):
                                                echo "<p>".$ar_props['NAME'].':<span>'.$ar_props['VALUE'].'м<sup>2</sup></span></p>';
                                             endif;
                                          endif;
                                        ?>
                                        </div>
                                  </div>

                              <? endif;?>

                             </div>
                          </div>
                      </div>
                  </div>
              </div>

      <?endforeach?>
      </div>
      <div class="catalog-element-bottom-right">
          <h3>Похожие проекты домов</h3>
      </div>
      <div class="clear"></div>
  </div>
  <? endif; ?>


		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
			<?if($arPrice["CAN_ACCESS"]):?>
				<p><?=$arResult["CAT_PRICES"][$code]["TITLE"];?>&nbsp;
				<?if($arParams["PRICE_VAT_SHOW_VALUE"] && ($arPrice["VATRATE_VALUE"] > 0)):?>
					<?if($arParams["PRICE_VAT_INCLUDE"]):?>
						(<?echo GetMessage("CATALOG_PRICE_VAT")?>)
					<?else:?>
						(<?echo GetMessage("CATALOG_PRICE_NOVAT")?>)
					<?endif?>
				<?endif;?>:&nbsp;
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
					<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?><br />
						<?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["DISCOUNT_VATRATE_VALUE"] > 0 ? $arPrice["PRINT_DISCOUNT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span>
					<?endif;?>
				<?else:?>
					<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?><br />
						<?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["VATRATE_VALUE"] > 0 ? $arPrice["PRINT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span>
					<?endif;?>
				<?endif?>
				</p>
			<?endif;?>
		<?endforeach;?>
		<?if(is_array($arResult["PRICE_MATRIX"])):?>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
			<thead>
			<tr>
				<?if(count($arResult["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
					<td><?= GetMessage("CATALOG_QUANTITY") ?></td>
				<?endif;?>
				<?foreach($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
					<td><?= $arType["NAME_LANG"] ?></td>
				<?endforeach?>
			</tr>
			</thead>
			<?foreach ($arResult["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
			<tr>
				<?if(count($arResult["PRICE_MATRIX"]["ROWS"]) > 1 || count($arResult["PRICE_MATRIX"]["ROWS"]) == 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
					<th nowrap>
						<?if(IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
							echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
						elseif(IntVal($arQuantity["QUANTITY_FROM"]) > 0)
							echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
						elseif(IntVal($arQuantity["QUANTITY_TO"]) > 0)
							echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
						?>
					</th>
				<?endif;?>
				<?foreach($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
					<td>
						<?if($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"])
							echo '<s>'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]).'</s> <span class="catalog-price">'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])."</span>";
						else
							echo '<span class="catalog-price">'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])."</span>";
						?>
					</td>
				<?endforeach?>
			</tr>
			<?endforeach?>
			</table>
			<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?>
				<?if($arParams["PRICE_VAT_INCLUDE"]):?>
					<small><?=GetMessage('CATALOG_VAT_INCLUDED')?></small>
				<?else:?>
					<small><?=GetMessage('CATALOG_VAT_NOT_INCLUDED')?></small>
				<?endif?>
			<?endif;?><br />
		<?endif?>
		<?if($arResult["CAN_BUY"]):?>
			<?if($arParams["USE_PRODUCT_QUANTITY"] || count($arResult["PRODUCT_PROPERTIES"])):?>
				<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
				<table border="0" cellspacing="0" cellpadding="2">
				<?if($arParams["USE_PRODUCT_QUANTITY"]):?>
					<tr valign="top">
						<td><?echo GetMessage("CT_BCE_QUANTITY")?>:</td>
						<td>
							<input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
						</td>
					</tr>
				<?endif;?>
				<?foreach($arResult["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
					<tr valign="top">
						<td><?echo $arResult["PROPERTIES"][$pid]["NAME"]?>:</td>
						<td>
						<?if(
							$arResult["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
							&& $arResult["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
						):?>
							<?foreach($product_property["VALUES"] as $k => $v):?>
								<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
							<?endforeach;?>
						<?else:?>
							<select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
								<?foreach($product_property["VALUES"] as $k => $v):?>
									<option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
								<?endforeach;?>
							</select>
						<?endif;?>
						</td>
					</tr>
				<?endforeach;?>
				</table>
				<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
				<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult["ID"]?>">
				<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
				<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD_TO_BASKET")?>">
				</form>
			<?else:?>
				<noindex>
				<a href="<?echo $arResult["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
				&nbsp;<a href="<?echo $arResult["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></a>
				</noindex>
			<?endif;?>
		<?elseif((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])):?>
			<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
		<?endif?>
		<br />

	<?if(count($arResult["LINKED_ELEMENTS"])>0):?>
		<br /><b><?=$arResult["LINKED_ELEMENTS"][0]["IBLOCK_NAME"]?>:</b>
		<ul>
	<?foreach($arResult["LINKED_ELEMENTS"] as $arElement):?>
		<li><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></li>
	<?endforeach;?>
		</ul>
	<?endif?>
	<?
	// additional photos
	$LINE_ELEMENT_COUNT = 2; // number of elements in a row
	if(count($arResult["MORE_PHOTO"])>0):?>
		<a name="more_photo"></a>
		<?foreach($arResult["MORE_PHOTO"] as $PHOTO):?>
			<img border="0" src="<?=$PHOTO["SRC"]?>" width="<?=$PHOTO["WIDTH"]?>" height="<?=$PHOTO["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /><br />
		<?endforeach?>
	<?endif?>

</div>
    <div class="catalog-element-center-left" >

    </div>

