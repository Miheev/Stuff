<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if (preg_match('/basket.php/', $APPLICATION->GetCurPageParam())) return;
//delayed function must return a string
if(empty($arResult))
    return "";

$strReturn = '<ul class="breadcrumb-navigation">';

$index = 0;
if (preg_match('/newyear/', $APPLICATION->GetCurPageParam()))
    $index= 1;

for($index, $itemSize = count($arResult); $index < $itemSize; $index++)
{
    /*if($index > 0)
        $strReturn .= '<li><span>&nbsp;&gt;&nbsp;</span></li>';*/

    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if($arResult[$index]["LINK"] <> "")
        $strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
    else
        $strReturn .= '<li>'.$title.'</li>';
}
$strReturn .= '<li>'.$APPLICATION->GetTitle().'</li>';

$strReturn .= '</ul>';
return $strReturn;
?>
