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

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
?>
<div class="center"> 
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"dream_menu",
	Array(
		"ROOT_MENU_TYPE" => "left",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array()
	)
	);?>

	<div class="gallery-node">
		<div class="img-full" data-imgid="0">
			<?
			$FILE = CFile::GetFileArray($arResult["DREAM"]["PHOTO"][0]);
			
			?>
			<img src="<? echo ($FILE["SRC"]);   ?>">
		</div>
		<div class="img-tumb clearfix">
			<ul>
				<?  foreach($arResult["DREAM"]["PHOTO"] as $FILE)
					  {   
						 $FILE = CFile::GetFileArray($FILE);   
					   ?><li class="sl-item"><div><img src="<? echo ($FILE["SRC"]);   ?>"> <span></span></div></li><?
					  }   
				?>
                <li><div class="img-add" style="position: relative;">
                        <form method="post" class="dream-form" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
                        <? $APPLICATION->IncludeComponent( "webpro:dreamphoto", "gallery", array('width'=>665, 'height'=>341));?>
                        </form>
                    </div>
                </li>
			 </ul>
		</div>
	</div>
		
</div>

<aside class="right create-node"> 
		<?$APPLICATION->IncludeComponent(
								"webpro:dream.golos",
								".default",
								Array(
									"DISPLAY_DATE" => "Y",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"AJAX_MODE" => "N",
									"IBLOCK_TYPE" => "dreams",
									"IBLOCK_ID" => "2",
									"ELEMENT_ID" => $arResult["DREAM"]["ID"],
									"FIELD_CODE" => array(0=>"",1=>"",),
									"PROPERTY_CODE" => array(0=>"TURBO_YET",1=>"MONEY_DREAM",2=>"TURBO_NEED",3=>"",),
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "36000000",
									"CACHE_NOTES" => "",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "Y",
									"PAGER_TEMPLATE" => ".default",
									"DISPLAY_TOP_PAGER" => "N",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_ADDITIONAL" => ""
								)
							);?>	
	 <?$APPLICATION->IncludeComponent(
	"webpro:pay.turbo",
	".default",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "dreams",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => $arResult["DREAM"]["ID"],
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"TURBO_YET",1=>"MONEY_DREAM",2=>"TURBO_NEED",3=>"",),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
 
  <div class="right_column_podp"> 
    <div class="column_podp_name"><span class="left">Присоединяйтесь</span>&nbsp;<span>DreamsStars</span> </div>
   
    <div class="column_podp_seti"> 
      <div class="podp_seti_vk">В контакте</div>
     
      <div class="podp_seti_fb">Facebook</div>
     </div>
   
    <div class="column_podp_seti_group"></div>
   </div>
 </aside>