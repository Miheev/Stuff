<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<div class="catalog-element"> 	
  <table width="100%" border="0" cellspacing="0" cellpadding="2"> 		
    <tbody>
      <tr> 		 			<?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?><td width="0%" valign="top" > 				<?if(is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])):?> 					<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" id="image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>" style="display:block;cursor:pointer;cursor: hand;" onclick="document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='block'"  /> 					<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" id="image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>" style="display:none;cursor:pointer; cursor: hand;" onclick="document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='block'"  /> 				<?elseif(is_array($arResult["DETAIL_PICTURE"])):?> 					<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  /> 				<?elseif(is_array($arResult["PREVIEW_PICTURE"])):?> 					<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  /> 				<?endif?> 				<?if(count($arResult["MORE_PHOTO"])>0):?> 					
          <br />
        <a href="#more_photo" ><?=GetMessage("CATALOG_MORE_PHOTO")?></a> 				<?endif;?> 			</td> 		 			<?endif;?><td width="100%" valign="top" > 				<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?> 					<?=$arProperty["NAME"]?>:<b>&nbsp;<?
					if(is_array($arProperty["DISPLAY_VALUE"])):
						echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
					elseif($pid=="MANUAL"):
						?><a href="<?=$arProperty["VALUE"]?>" ><?=GetMessage("CATALOG_DOWNLOAD")?></a><?
					else:
						echo $arProperty["DISPLAY_VALUE"];?> 					<?endif?></b>
          <br />
         				<?endforeach?> 			</td> 		</tr>
     	</tbody>
  </table>
 	<?if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):?> 		<?foreach($arResult["OFFERS"] as $arOffer):?> 			<?foreach($arParams["OFFERS_FIELD_CODE"] as $field_code):?> 				<small><?echo GetMessage("IBLOCK_FIELD_".$field_code)?>:&nbsp;<?
						echo $arOffer[$field_code];?></small>
  <br />
 			<?endforeach;?> 			<?foreach($arOffer["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?> 				<small><?=$arProperty["NAME"]?>:&nbsp;<?
					if(is_array($arProperty["DISPLAY_VALUE"]))
						echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
					else
						echo $arProperty["DISPLAY_VALUE"];?></small>
  <br />
 			<?endforeach?> 			<?foreach($arOffer["PRICES"] as $code=>$arPrice):?> 				<?if($arPrice["CAN_ACCESS"]):?> 					
  <p><?=$arResult["CAT_PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp; 					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?> 						<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> 					<?else:?> 						<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span> 					<?endif?> 					</p>
 				<?endif;?> 			<?endforeach;?> 			
  <p> 			<?if($arOffer["CAN_BUY"]):?> 				<?if($arParams["USE_PRODUCT_QUANTITY"]):?> 					</p>
<form action="&lt;img id=" bxid_411232"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0">&quot; method=&quot;post&quot; enctype=&quot;multipart/form-data&quot;&gt; 					
    <table border="0" cellspacing="0" cellpadding="2"> 						
      <tbody>
        <tr valign="top"> 							<td><?echo GetMessage("CT_BCE_QUANTITY")?>:</td> 							<td> 								<input type="text" name="&lt;img id=" bxid_711675"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;1&quot; size=&quot;5&quot;&gt; 							</td> 						</tr>
       					</tbody>
    </table>
   					<input type="hidden" name="&lt;img id=" bxid_491064"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;BUY&quot;&gt; 					<input type="hidden" name="&lt;img id=" bxid_307650"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;<?echo $arOffer["ID"]?>&quot;&gt; 					<input type="submit" name="&lt;img id=" bxid_738842"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;<?echo GetMessage("CATALOG_BUY")?>&quot;&gt; 					<input type="submit" name="&lt;img id=" bxid_194996"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;<?echo GetMessage("CT_BCE_CATALOG_ADD")?>&quot;&gt; 					</form> 				<?else:?> 					<noindex> 					<a href="<?echo $arOffer["BUY_URL"]?>" rel="nofollow" ><?echo GetMessage("CATALOG_BUY")?></a> 					&nbsp;<a href="<?echo $arOffer["ADD_URL"]?>" rel="nofollow" ><?echo GetMessage("CT_BCE_CATALOG_ADD")?></a> 					</noindex> 				<?endif;?> 			<?elseif(count($arResult["CAT_PRICES"]) > 0):?> 				<?=GetMessage("CATALOG_NOT_AVAILABLE")?> 			<?endif?> 			
  <p></p>
 		<?endforeach;?> 	<?else:?> 		<?foreach($arResult["PRICES"] as $code=>$arPrice):?> 			<?if($arPrice["CAN_ACCESS"]):?> 				
  <p><?=$arResult["CAT_PRICES"][$code]["TITLE"];?>&nbsp; 				<?if($arParams["PRICE_VAT_SHOW_VALUE"] && ($arPrice["VATRATE_VALUE"] > 0)):?> 					<?if($arParams["PRICE_VAT_INCLUDE"]):?> 						(<?echo GetMessage("CATALOG_PRICE_VAT")?>) 					<?else:?> 						(<?echo GetMessage("CATALOG_PRICE_NOVAT")?>) 					<?endif?> 				<?endif;?>:&nbsp; 				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?> 					<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> 					<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?>
    <br />
   						<?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["DISCOUNT_VATRATE_VALUE"] > 0 ? $arPrice["PRINT_DISCOUNT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span> 					<?endif;?> 				<?else:?> 					<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span> 					<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?>
    <br />
   						<?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["VATRATE_VALUE"] > 0 ? $arPrice["PRINT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span> 					<?endif;?> 				<?endif?> 				</p>
 			<?endif;?> 		<?endforeach;?> 		<?if(is_array($arResult["PRICE_MATRIX"])):?> 			
  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table"> 			<thead> 			
      <tr> 				 					<?if(count($arResult["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?><td ><?= GetMessage("CATALOG_QUANTITY") ?></td> 				<?endif;?> 				 					<?foreach($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?><td ><?= $arType["NAME_LANG"] ?></td> 				<?endforeach?> 			</tr>
     			</thead> 			 			
    <tbody>
      <?foreach ($arResult["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?><tr > 				 					<?if(count($arResult["PRICE_MATRIX"]["ROWS"]) > 1 || count($arResult["PRICE_MATRIX"]["ROWS"]) == 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?><th nowrap="" > 						<?if(IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
							echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
						elseif(IntVal($arQuantity["QUANTITY_FROM"]) > 0)
							echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
						elseif(IntVal($arQuantity["QUANTITY_TO"]) > 0)
							echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
						?> 					</th> 				<?endif;?> 				 					<?foreach($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?><td > 						<?if($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"])
							echo '<s>'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]).'</s> <span class="catalog-price">'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])."</span>";
						else
							echo '<span class="catalog-price">'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])."</span>";
						?> 					</td> 				<?endforeach?> 			</tr>
     			
      <?endforeach?>
     			</tbody>
  </table>
 			<?if($arParams["PRICE_VAT_SHOW_VALUE"]):?> 				<?if($arParams["PRICE_VAT_INCLUDE"]):?> 					<small><?=GetMessage('CATALOG_VAT_INCLUDED')?></small> 				<?else:?> 					<small><?=GetMessage('CATALOG_VAT_NOT_INCLUDED')?></small> 				<?endif?> 			<?endif;?>
  <br />
 		<?endif?> 		<?if($arResult["CAN_BUY"]):?> 			<?if($arParams["USE_PRODUCT_QUANTITY"] || count($arResult["PRODUCT_PROPERTIES"])):?> 				<form action="&lt;img id=" bxid_233304"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0">&quot; method=&quot;post&quot; enctype=&quot;multipart/form-data&quot;&gt; 				
    <table border="0" cellspacing="0" cellpadding="2"> 				 					
      <tbody>
        <?if($arParams["USE_PRODUCT_QUANTITY"]):?><tr valign="top" > 						<td><?echo GetMessage("CT_BCE_QUANTITY")?>:</td> 						<td> 							<input type="text" name="&lt;img id=" bxid_714052"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;1&quot; size=&quot;5&quot;&gt; 						</td> 					</tr>
       				
        <?endif;?>
       				 					
        <?foreach($arResult["PRODUCT_PROPERTIES"] as $pid => $product_property):?><tr valign="top" > 						<td><?echo $arResult["PROPERTIES"][$pid]["NAME"]?>:</td> 						<td> 						<?if(
							$arResult["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
							&& $arResult["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
						):?> 							<?foreach($product_property["VALUES"] as $k => $v):?> 								<label><input type="radio" name="&lt;img id=" bxid_571032"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />[<?echo $pid?>]&quot; value=&quot;<?echo $k?>&quot; <?if($k == $product_property["SELECTED"]) echo '"checked"'?>&gt;<?echo $v?></label>
            <br />
           							<?endforeach;?> 						<?else:?> 							<select name="&lt;img id=" bxid_880735"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0">[]&quot;&gt; 								 									<option value="&lt;img id=" bxid_776033"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0">&quot; &gt;</option> 								 							</select> 						<?endif;?> 						</td> 					</tr>
       				
        <?endforeach;?>
       				</tbody>
    </table>
   				<input type="hidden" name="&lt;img id=" bxid_76982"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;BUY&quot;&gt; 				<input type="hidden" name="&lt;img id=" bxid_741065"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;<?echo $arResult["ID"]?>&quot;&gt; 				<input type="submit" name="&lt;img id=" bxid_304100"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;<?echo GetMessage("CATALOG_BUY")?>&quot;&gt; 				<input type="submit" name="&lt;img id=" bxid_406147"="" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />&quot; value=&quot;<?echo GetMessage("CATALOG_ADD_TO_BASKET")?>&quot;&gt; 				</form> 			<?else:?> 				<noindex> 				<a href="<?echo $arResult["BUY_URL"]?>" rel="nofollow" ><?echo GetMessage("CATALOG_BUY")?></a> 				&nbsp;<a href="<?echo $arResult["ADD_URL"]?>" rel="nofollow" ><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></a> 				</noindex> 			<?endif;?> 		<?elseif((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])):?> 			<?=GetMessage("CATALOG_NOT_AVAILABLE")?> 		<?endif?> 	<?endif?> 		
  <br />
 	<?if($arResult["DETAIL_TEXT"]):?> 		
  <br />
<?=$arResult["DETAIL_TEXT"]?>
  <br />
 	<?elseif($arResult["PREVIEW_TEXT"]):?> 		
  <br />
<?=$arResult["PREVIEW_TEXT"]?>
  <br />
 	<?endif;?> 	<?if(count($arResult["LINKED_ELEMENTS"])>0):?> 		
  <br />
<b><?=$arResult["LINKED_ELEMENTS"][0]["IBLOCK_NAME"]?>:</b> 		
  <ul> 	<?foreach($arResult["LINKED_ELEMENTS"] as $arElement):?> 		
    <li><a href="<?=$arElement["DETAIL_PAGE_URL"]?>" ><?=$arElement["NAME"]?></a></li>
   	<?endforeach;?> 		</ul>
 	<?endif?> 	<?
	// additional photos
	$LINE_ELEMENT_COUNT = 2; // number of elements in a row
	if(count($arResult["MORE_PHOTO"])>0):?> 		
<a name="more_photo"></a>
 		<?foreach($arResult["MORE_PHOTO"] as $PHOTO):?> 			<img border="0" src="<?=$PHOTO["SRC"]?>" width="<?=$PHOTO["WIDTH"]?>" height="<?=$PHOTO["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  />
  <br />
 		<?endforeach?> 	<?endif?> 	<?if(is_array($arResult["SECTION"])):?> 		
  <br />
	<?endif?> </div>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "dop", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "6",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "RAND",
	"ELEMENT_SORT_ORDER" => "ASC",
	"FILTER_NAME" => "arrFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "4",
	"LINE_ELEMENT_COUNT" => "4",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "MARKER",
		2 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "Y",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "Y",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
