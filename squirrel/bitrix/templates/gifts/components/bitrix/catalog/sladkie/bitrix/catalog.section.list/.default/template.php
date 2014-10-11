<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if(count($arResult["SECTIONS"])) :?>
<div class="catalog-list" style="padding:25px;">
<ul>
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<li>
		<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
			<img src="<?=$arSection["PICTURE"]["SRC"]?>" width="<?=$arSection["PICTURE"]["WIDTH"]?>" height="<?=$arSection["PICTURE"]["HEIGHT"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
			<?=$arSection["NAME"]?>
		</a><br /><br /><br /><br />
	</li>
<? endforeach; ?>
</ul>
</div><br /><br /><br />
<? endif; ?>
