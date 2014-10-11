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

if (!empty($arResult['ITEMS']))
{

	$arSkuTemplate = array();

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM'));

	$strFullPath = $_SERVER['DOCUMENT_ROOT'].$this->GetFolder();
	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/'.ToLower($arParams['VIEW_MODE']).'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);
	switch ($arParams['VIEW_MODE'])
	{
		case 'BANNER':
			include($strFullPath.'/banner/template.php');
			break;
		case 'SLIDER':
			include($strFullPath.'/slider/template.php');
			break;
		case 'SECTION':
			include($strFullPath.'/section/template.php');
			break;
	}
?>

<?
}
?>