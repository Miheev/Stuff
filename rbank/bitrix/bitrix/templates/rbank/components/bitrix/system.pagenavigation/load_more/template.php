<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="buttons" id="more-review-btn">
<?if($arResult["bDescPageNumbering"] === true):?>

	<?if ($arResult["NavPageNomer"] > 1):?>
		<a class="abutton" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">Ещё отзывы</a>
	<?else:?>
        <a class="totop abutton" href="javascript:void(0)">В начало</a>
	<?endif?>

<?else:?>

	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<a class="abutton" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">Ещё отзывы</a>
	<?else:?>
		<a class="totop abutton" href="javascript:void(0)">В начало</a>
	<?endif?>

<?endif?>
    <script>
        $(document).ready(function(){
            $('#more-review-btn .totop').click(function(e){
                e.preventDefault();

                $('body').animate({scrollTop: $('h1').position().top},1000);
            });
        });
    </script>
</div>