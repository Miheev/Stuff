<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(isset($_REQUEST["IMG_SRC"]) && $_REQUEST["IMG_SRC"]
&& isset($_REQUEST["W"]) && $_REQUEST["W"]
&& isset($_REQUEST["H"]) && $_REQUEST["H"]
):


$arFile = CFile::MakeFileArray($_REQUEST["IMG_SRC"]);


$crop_width = intval($_REQUEST["W"]);
$crop_height = intval($_REQUEST["H"]);
$new = imagecreatetruecolor($crop_width, $crop_height);
$white = imagecolorallocate($new, 255, 255, 255);
imagefill($new, 0, 0, $white);
if($arFile["type"]=="image/jpeg")
{
	$current_image = imageCreateFromJpeg($arFile["tmp_name"]);
}
elseif($arFile["type"]=="image/png")
{
	$current_image = imageCreateFromPng($arFile["tmp_name"]);
}
elseif($arFile["type"]=="image/gif")
{
	$current_image = imageCreateFromGif($arFile["tmp_name"]);
}

$randomName = md5(rand()."_".$arFile["name"]."_".rand());	
$newFileName = $_SERVER["DOCUMENT_ROOT"]."/upload/crop/".$randomName.".png";
$fileSRC = "/upload/crop/".$randomName.".png";
imagecopyresampled($new, $current_image, 0, 0, intval($_REQUEST["X"]), intval($_REQUEST["Y"]), $crop_width, $crop_height, $crop_width, $crop_height);
$error = imagepng($new, $newFileName);
imagedestroy($new);
if($error)
{
	if($USER->IsAuthorized())
	{
		$rsUser = CUser::GetByID(intval($USER->GetID()));
		if($arUser = $rsUser->Fetch())
		{
			$arOldFile = CFile::MakeFileArray($newFileName);
			$arOldFile['del'] = "Y";
			$arOldFile['old_file'] = intval($arUser["PERSONAL_PHOTO"]);
		
			$user = new CUser;
			$fields = Array(
					"PERSONAL_PHOTO" => $arOldFile,
			);
			$user->Update(intval($arUser["ID"]), $fields);
			unlink($newFileName);

			$rsUser = CUser::GetByID(intval($USER->GetID()));
			if($arUser = $rsUser->Fetch())
			{
				$arResult = array();
				$src = CFile::GetPath($arUser["PERSONAL_PHOTO"]);
				$arResult["big"] = $src;
				$arResult["min_big"] = GetImageResized($src, 188,188);
				echo json_encode($arResult);
			}
		}
	}
	else
	{
		$arResult = array();
		$arResult["post_file_src"] = "Y";
		$arResult["big"] = $fileSRC;
		$arResult["min_big"] = GetImageResized($fileSRC, 188,188);
		echo json_encode($arResult);
	}	
}
else
{
	echo "ERROR";
}


else:?>

	
<?endif;?>
