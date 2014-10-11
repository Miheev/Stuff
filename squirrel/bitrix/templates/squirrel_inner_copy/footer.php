<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
	</div>
	<div class="block_left">
		<nav>
			<?$APPLICATION->IncludeComponent("bitrix:menu", "template1", Array(
				"ROOT_MENU_TYPE" => "left",	// ��� ���� ��� ������� ������
				"MAX_LEVEL" => "1",	// ������� ����������� ����
				"CHILD_MENU_TYPE" => "left",	// ��� ���� ��� ��������� �������
				"USE_EXT" => "Y",	// ���������� ����� � ������� ���� .���_����.menu_ext.php
				"MENU_CACHE_TYPE" => "A",	// ��� �����������
				"MENU_CACHE_TIME" => "3600",	// ����� ����������� (���.)
				"MENU_CACHE_USE_GROUPS" => "Y",	// ��������� ����� �������
				"MENU_CACHE_GET_VARS" => array(	// �������� ���������� �������
					0 => "SECTION_ID",
					1 => "page",
				)
				),
				false
			);?>
		</nav>
		<div>
            <?
if (!preg_match('(catalog\/[^\/]+\/.+)|(sladkie_podarki\/[^\/]+\/.+)|(catalog\/detail.php)|(sladkie_podarki\/detail.php)/', $APPLICATION->GetCurPage())) :
                $APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath("include_areas/partners.php"),
                    Array(),
                    Array("MODE"=>"html")
                );
            ?>
            <?php
            $iblock_id=5;
            if (preg_match('/catalog/', $APPLICATION->GetCurPageParam()))
                $iblock_id=2;
            ?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "elements1", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => $iblock_id,
	"SECTION_ID" => "",
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
	"PAGE_ELEMENT_COUNT" => "1",
	"LINE_ELEMENT_COUNT" => "1",
	"PROPERTY_CODE" => array(
		0 => "weight",
		1 => "",
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
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "0",
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
	"SHOW_PRICE_COUNT" => "0",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "������",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?php endif; ?>

		</div>
		<div><?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/left_include.php"),
			Array(),
			Array("MODE"=>"html")
			);?></div>
	</div>
	<div class="clear"></div>
	<footer>
		<hr class="bottom_sep" />
				<section class="help">
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include_areas/help.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</section>
		<section class="newsline2">
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include_areas/newsline2.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</section>
		<section class="newsline1">
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("include_areas/newsline1.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</section>
		<section class="spec">
            <?
            $path= '/bitrix/templates/squirrel';
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "PATH" => $path."/include_areas/footer_menu.php"
                )
            );?>
			<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/spec.php"),
			Array(),
			Array("MODE"=>"html")
			);?>
		</section>
		<hr class="bottom_sep" />
<!--		<aside class="copy">-->
<!--			--><?//$APPLICATION->IncludeFile(
//			$APPLICATION->GetTemplatePath("include_areas/copy.php"),
//			Array(),
//			Array("MODE"=>"html")
//			);?>
<!--		</aside>-->
	</footer>
</div>
</body>
</html>