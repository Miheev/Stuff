<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<div class="navigation">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
   if($index > 0)
      $strReturn .= '&nbsp;/&nbsp;';

   $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
   if($arResult[$index]["LINK"] <> "" && $index+1 != $itemSize)
      $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
   else
      $strReturn .= '<strong class="puk">'.$title.'</strong>';
}

$strReturn .= '</div>';
return $strReturn;
?>
