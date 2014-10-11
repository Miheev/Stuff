<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test-photo");
?> <?
print_r ($_FILES);
$APPLICATION->IncludeComponent("bitrix:main.file.input", "profile_avatar",
   array(
      "INPUT_NAME"=>"USER_PHOTO",
      "MULTIPLE"=>"N",
      "MODULE_ID"=>"main",
      "MAX_FILE_SIZE"=>"1572864",
      "ALLOW_UPLOAD"=>"I", 
      "ALLOW_UPLOAD_EXT"=>"",
	  "INPUT_CAPTION"=> "Выбрать файл"
   ),
   false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>