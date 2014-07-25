<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<div style="margin-left:18px; margin-top:-12px; font-size:10px;">'.'<a href="/" title="Главная" style="color:#06F; text-decoration:underline; font-size:10px;">Главная</a>&nbsp;&raquo;&nbsp;';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= '&nbsp;&raquo;&nbsp;';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "")
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" style="color:#06F; text-decoration:underline; font-size:10px;">'.$title.'</a>';
	else
		$strReturn .= ''.$title.'';
}

$strReturn .= '</div>';

return $strReturn;
?>