<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if ($page_class != 'index') : ?>
    <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php",
            "PATH" => SITE_TEMPLATE_PATH."/include/bottom_banner.php"
        )
    );?>
    <? if (preg_match('/^news\-/',$page_class)) : ?>
    </div>
    <?endif;?>
    </div></div>
<? endif;  ?>
<?//include 'include/bottom_block.php'?>

<div class="footer-container">
    <footer class="footer wrapper clearfix">
        <div class="bottom-menu">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", array(
                "ROOT_MENU_TYPE" => "bottom",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
                ),
                false
            );?>
        </div>
        <div class="social">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ico_twit.png"/></a>
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ico_face.png"/></a>
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ico_vk.png"/></a>
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/img/ico_odno.png"/></a>
        </div>
        <div class="copy">
            &copy; Все права защищены 2014 "Rbanking.ru"
        </div>
    </footer>
</div>

</body>
</html>