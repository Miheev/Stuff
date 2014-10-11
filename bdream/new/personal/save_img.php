<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?
global $USER;
if ($USER->IsAuthorized())
{
	if(isset($_REQUEST["FILE_ID"]) && $_REQUEST["FILE_ID"]):
		if(CModule::IncludeModule("iblock"))
		{
		
			$arFilter = Array("IBLOCK_ID"=>2, "PROPERTY_USER"=>$USER->GetID());
			$res = CIBlockElement::GetList(Array(), $arFilter);
			if($ob = $res->Fetch())
			{
				$arFile = CFile::MakeFileArray(CFile::GetPath(intval($_REQUEST["FILE_ID"])));
				if(CFile::IsImage($arFile["name"]))
				{
					CIBlockElement::SetPropertyValueCode($ob["ID"], "PHOTO", Array("VALUE"=>$arFile));
					echo "OK";
				}	
			}
		}
	endif;
}
?>