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
	<div class="gallery-node">
		<div class="img-full" data-imgid="0">
			<img src="<? echo ($arResult["DREAM_PHOTO"][0]);   ?>">
		</div>
		<div class="img-tumb clearfix">
			<ul>
				<?  foreach($arResult["DREAM_PHOTO"] as $FILE)   
					  {   
					   ?><li class="sl-item"><div><img src="<? echo ($FILE);   ?>"> <span></span></div></li><?
					  }   
				?>
			 </ul>
		</div>
	</div>
		
</div>

