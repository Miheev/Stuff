<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div>

<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<div class="floatl" id="<?=$this->GetEditAreaId($arSection['ID']);?>" OnClick="document.location='<?=$arSection["SECTION_PAGE_URL"]?>'">
		<div class="corners" OnClick="document.location='<?=$arSection["SECTION_PAGE_URL"]?>'">
			<div alt="<?=$arSection["NAME"]?>" class="corners1"<?if($arSection["PICTURE"]["SRC"]):?> style="background: url(<?=$arSection["PICTURE"]["SRC"]?>) center center no-repeat;background-size:contain;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$arSection["PICTURE"]["SRC"]?>', sizingMethod='scale');-ms-filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=$arSection["PICTURE"]["SRC"]?>', sizingMethod='scale')';"<?endif?>>
				<p>
					<?if(!$arSection["PICTURE"]["SRC"]):?>
					
					<?endif?>
				</p>
			</div>
		</div>
		<p>
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
			<?=$arSection["NAME"]?>
			<?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)
			<?endif;?>
			</a>
		</p>
	</div>
<?endforeach?>
<?if(!$arSection):?>
<?endif;?>
 <div class="clear"></div>
<?$res = CIBlockSection::GetByID($_REQUEST["SECTION_ID"]);if($ar_res = $res->GetNext())
  echo $ar_res['DESCRIPTION'];?>
</div>