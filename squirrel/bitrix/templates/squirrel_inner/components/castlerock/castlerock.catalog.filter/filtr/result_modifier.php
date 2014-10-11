<?
$new_items = array();
foreach($arResult["ITEMS"] as $arItem) {
  if(array_key_exists("HIDDEN", $arItem)) {
    $new_items[] = $arItem;
  } else {
    $new_items[$arItem["NAME"]] = $arItem;
  }
}
$arResult["ITEMS"] = $new_items;

?>