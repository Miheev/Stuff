<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1)
	return;

$arRootNode = Array();
//$topel= array();
foreach($arResult["arMap"] as $index => $arItem)
{
	if ($arItem["LEVEL"] == 0) {
        $arRootNode[] = $index;
//        $topel[]= $arItem;
    }
}

//array_unshift($arResult["arMap"], $topel);
//for ($i=0; $i<count($arRootNode); $i++) {
//    unset( $arResult["arMap"][$arRootNode[$i]+ count($arRootNode)]);
//}
//$arResult["arMap"]= array_values($arResult["arMap"]);


$allNum = count($arRootNode);
$colNum = ceil($allNum / $arParams["COL_NUM"]);


//echo '<pre>';
//var_export($arResult["arMap"]);
//echo '</pre>';
//$arParams["COL_NUM"]= 3;
$margin= 2;

/*'<style>
    .map-table>li{
        width: <?echo 100 / $arParams["COL_NUM"] - ($arParams["COL_NUM"]-1)*$margin / $arParams["COL_NUM"];?>%
    }
    .map-table>li+li {margin-left: <?=$margin?>%}
    .map-table>li:nth-child(<?=$arParams["COL_NUM"]?>n+1) {margin-left: 0;};
</style>'*/
?>


		<ul class="map-root menu">

		<?
		$previousLevel = -1;
		$counter = 0;
		$column = 1;


        for($index= 0; $index < count($arRootNode) ; $index++) :
        $arItem= $arResult["arMap"][$arRootNode[$index]];
        ?>
        <li><a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a></li>
        <?endfor; ?>
        </ul>
        <ul class="map-root menu map-table clearfix">
        <?

		for($index= 1; $index < count($arResult["arMap"]) - count($arRootNode) ; $index++) :
        $arItem= $arResult["arMap"][$index];
        ?>

			<?if ($arItem["LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["LEVEL"]));?>
			<?endif?>


			<?if ($counter >= $colNum && $arItem["LEVEL"] == 0):
					$allNum = $allNum-$counter;
					$colNum = ceil(($allNum) / ($arParams["COL_NUM"] > 1 ? ($arParams["COL_NUM"]-$column) : 1));
					$counter = 0;
					$column++;
			?>
				</ul>
            <ul class="map-root">
			<?endif?>

			<?if (array_key_exists($index+1, $arResult["arMap"]) && $arItem["LEVEL"] < $arResult["arMap"][$index+1]["LEVEL"]):?>

				<li><a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?>
					<ul class="map-level-<?=$arItem["LEVEL"]+1?>">

			<?else:?>

					<li><a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem["NAME"]?></a><?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0) {?><div><?=$arItem["DESCRIPTION"]?></div><?}?></li>

			<?endif?>


			<?
				$previousLevel = $arItem["LEVEL"];
				if($arItem["LEVEL"] == 0)
					$counter++;
			?>

		<?endfor?>

		<?if ($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>

		</ul>

<script>
    $(document).ready(function(){
        col_num_base= <?=$arParams["COL_NUM"];?>;
    });
</script>