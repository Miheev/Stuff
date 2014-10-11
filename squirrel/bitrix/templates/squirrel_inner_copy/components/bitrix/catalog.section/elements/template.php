<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--[if lt IE 8]><style>
*:first-child+html .block span { /* хак для ие7 */
display: block;
z-index: expression(
runtimeStyle.zIndex = 1,
this == ((105/2)-parseInt(offsetHeight)/2) <0 ? style.marginTop="0" : style.marginTop=(108/2)-(parseInt(offsetHeight)/2) +'px');
}
</style><![endif]-->
<!--[if lt IE 7]><style>
*:first-child+html .block span { /* хак для ие7 */
display: block;
z-index: expression(
runtimeStyle.zIndex = 1,
this == ((105/2)-parseInt(offsetHeight)/2) <0 ? style.marginTop="0" : style.marginTop=(108/2)-(parseInt(offsetHeight)/2) +'px');
}
</style><![endif]-->
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
<?
$arFileTmp = CFile::ResizeImageGet(
      $arElement["PREVIEW_PICTURE"],
      array('width' => 106, 'height' => 106),
      BX_RESIZE_IMAGE_PROPORTIONAL,
      true
   );
?>
<?
$arFileTmp2 = CFile::ResizeImageGet(
      $arElement["DETAIL_PICTURE"],
      array('width' => 106, 'height' => 106),
      BX_RESIZE_IMAGE_PROPORTIONAL,
      false
   );
?>
				<div class="floatll">
					<div class="corners">
						<div class="corners1 block"><span>
                                                 <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
                                                   <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=$arFileTmp["src"]?>" alt="<?=$arElement["NAME"]?>"></a>
                                                 <?else:?>
                                                   <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=$arFileTmp2["src"]?>" alt="<?=$arElement["NAME"]?>"></a>
                                                 <?endif?></span> 
							<p>
							<?if(!$arElement["PREVIEW_PICTURE"] && !$arElement["DETAIL_PICTURE"]):?>
							
							<?endif?>
							</p>
						</div>
					</div>
					<p style="color:#548DA5;">

					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a><br />
					<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<?=$arProperty["NAME"]?>:&nbsp;<?
								if(is_array($arProperty["DISPLAY_VALUE"]))
									echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
								else
									echo $arProperty["DISPLAY_VALUE"];?>
						<?endforeach?><br />						
					</p>
				</div>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>