<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";
	
$strReturn = '<div class="bread"><ul class="menu">';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    $class= '';
    if ($index == $itemSize-2)
        $class= 'class="last"';

    if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= '<li><a '.$class.' href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
//            '<li class="arrow"><p class="inner"><span class="triangle"></span></p></li>';
	else
		$strReturn .= '<li class="last"><span>'.$title.'</span></li>';
}

$strReturn .= '</ul></div>';

return $strReturn;
?>