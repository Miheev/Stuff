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
?>



<div class="center">
    <div class="main_left_menu">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "profile_menu1", Array(
                "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
            ),
            false
        );?>
<!--        --><?//$APPLICATION->IncludeComponent(
//            "bitrix:menu",
//            "profile_menu",
//            Array(
//                "ROOT_MENU_TYPE" => "left",
//                "MAX_LEVEL" => "1",
//                "CHILD_MENU_TYPE" => "left",
//                "USE_EXT" => "N",
//                "DELAY" => "N",
//                "ALLOW_MULTI_SELECT" => "N",
//                "MENU_CACHE_TYPE" => "N",
//                "MENU_CACHE_TIME" => "3600",
//                "MENU_CACHE_USE_GROUPS" => "Y",
//                "MENU_CACHE_GET_VARS" => ""
//            )
//        );?>
    </div>



    <div class="news-list">
        <?if($arParams["DISPLAY_TOP_PAGER"]):?>
            <?=$arResult["NAV_STRING"]?>
            <br />
        <?endif;?>

        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            $rsUser = CUser::GetByID(intval($arItem["DISPLAY_PROPERTIES"]["USER"]["VALUE"]));
            $arUser = $rsUser->Fetch();
            $country = GetCountryByID($arUser["PERSONAL_COUNTRY"]);
            ?>
        <div class="clean-block news-item<?=$arItem["ID"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="header">
                <div class="img">
                    <img src="<?echo empty($arItem["PREVIEW_PICTURE"]['SRC']) ? $arItem["DETAIL_PICTURE"]['SRC'] : $arItem["PREVIEW_PICTURE"]['SRC'];?>" alt="" />
                </div>
                <div class="info">
                    <p class="name" ><a href="/member/?USER_ID=<?=$arItem["DISPLAY_PROPERTIES"]["USER"]["VALUE"]?>"><?echo $arItem["NAME"]?></a></p>
                    <p class="location"><?=$country.", ".$arUser["PERSONAL_CITY"];?></p>
<!--                    <span class="delete_favour" id="--><?//=$arItem["ID"]?><!--">Удалить</span>-->
                </div>
                <a class="del-btn abutton" href="javascript:void(0);" data-id="<?=$arItem["ID"]?>">Удалить</a>
            </div>
            <p class="hint">Его мечта</p>
            <div class="content">
                <?echo empty($arItem["PREVIEW_TEXT"]) ? $arItem["DETAIL_TEXT"] : $arItem["PREVIEW_TEXT"];?>
            </div>
        </div>
        <?endforeach;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br />
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".del-btn").click(function(e){
                e.preventDefault();

                var id=$(this).attr("data-id");
                var user=<?=$USER->GetID()?>;
                $.ajax({
                    type: "POST",
                    url: "/member/delete_fav_memb.php", // путь к файлу, который будем читать
                    data: "id="+id+"&user="+user,
                    dataType: "html",
                    cache: false,
                    success: function(html){
                        $(".news-item"+id).html("Мечта успешно удалена");
                    }
                });//*/
            });
        });
    </script>


</div>
<aside class="right">
    <div class="flip-block pocket">
        <h3>Мой кошелёк</h3>
        <div class="content">
            <div class="balance"><?=$arResult["MONEY"]?></div>
            <a class="abutton" href="/personal/add_money.php">Пополнить</a>
        </div>
    </div>
</aside>