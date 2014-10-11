<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}
	if ($boolPicture || $boolDescr)
	{
		$arSections = $arResult["SECTIONS"];

		foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$i = 0;
			/*$arrFilter = array ();
			$Elements = CIBlockElement::GetList(array ("sort"=>"asc"), array(">CATALOG_QUANTITY" => 0, "SECTION_ID" => $arSection["ID"]), false, false);
			$i += $Elements->SelectedRowsCount();*/
			
				$totalSteps = array();
				$totalSteps[] = array($arSection["ID"]);
				
				for ($step = 1, $max = 6; $step <= $max; $step++):
					$totalSteps[$step] = array();
					foreach ($totalSteps[$step-1] as $ID):
						$rsCountSections = CIBlockSection::GetList(array(), array('SECTION_ID' => $ID), false, false);
						while ($rs = $rsCountSections->GetNext()):
							$totalSteps[$step][] = $rs["ID"];
						endwhile;
					endforeach;
				endfor;
				
				foreach ($totalSteps as $ts):
					foreach ($ts as $t):
						$Elements = CIBlockElement::GetList(array ("sort"=>"asc"), array(">CATALOG_QUANTITY" => 0, "SECTION_ID" => $t), false, false);
						$i += $Elements->SelectedRowsCount();
					endforeach;
				endforeach;
			
			//echo '<pre>'.print_r($totalSteps).'</pre>';
			
			/*if ($Elements->SelectedRowsCount() == 0 && $arSection["RELATIVE_DEPTH_LEVEL"] > 1):
				unset ($arSections[$key]);
				$arMap[$arSection['ID']] = $key;
			else:*/
				$arSections[$key]["ELEMENT_CNT"] = $i;
			//endif;
		}
		
		$arFind = $arSections;
		
		foreach ($arSections as $key => $arSection):
			if ($arSection["ELEMENT_CNT"] == 0):
				/*$i = 0;
				foreach ($arFind as $key2 => $arSection2):
					if ($arSection2["IBLOCK_SECTION_ID"] == $arSection["ID"] && $arSection2["RELATIVE_DEPTH_LEVEL"] > 1):
						$i += $arSections[$key2]["ELEMENT_CNT"];
					endif;
				endforeach;
				if ($i == 0):*/
					unset($arSections[$key]);
				/*else:
					$arSections[$key]["ELEMENT_CNT"] = $i;
				endif;*/
			endif;
		endforeach;
	
		/*foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arrFilter = array ();
			$Elements = CIBlockElement::GetList(array ("sort"=>"asc"), array(">CATALOG_QUANTITY" => 0, "SECTION_ID" => $arSection["ID"]), false, false);
			if ($Elements->SelectedRowsCount() == 0 && $arSection["RELATIVE_DEPTH_LEVEL"] > 1):
				unset ($arSections[$key]);
				$arMap[$arSection['ID']] = $key;
			else:
				$arSections[$key]["ELEMENT_CNT"] = $Elements->SelectedRowsCount();
			endif;
		}
		
		$arFind = $arSections;
		
		foreach ($arSections as $key => $arSection):
			if ($arSection["RELATIVE_DEPTH_LEVEL"] == 1 && $arSection["ELEMENT_CNT"] == 0):
				$i = 0;
				foreach ($arFind as $key2 => $arSection2):
					if ($arSection2["IBLOCK_SECTION_ID"] == $arSection["ID"] && $arSection2["RELATIVE_DEPTH_LEVEL"] > 1):
						$i += $arSections[$key2]["ELEMENT_CNT"];
					endif;
				endforeach;
				if ($i == 0):
					unset($arSections[$key]);
				else:
					$arSections[$key]["ELEMENT_CNT"] = $i;
				endif;
			endif;
		endforeach;*/
		
//		echo '<pre>'.print_r($arSections).'</pre>';
		
		$arResult["SECTIONS"] = $arSections;
		
		
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), true, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
}
?>