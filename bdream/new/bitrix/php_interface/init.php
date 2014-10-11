<?
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");

function GetImageResized($sPath, $w=0, $h=0, $mode=0)
{
	if(stripos($sPath,"://")===false)
		$sFullPath=$_SERVER["DOCUMENT_ROOT"].$sPath;
	else
		$sFullPath=$sPath;
	$md5=md5_file($sFullPath);
	$name=basename($sFullPath);
	$ext_orig=substr($sFullPath,strrpos($sFullPath,".")+1);
	$ext="jpg";
			
	if($ext_orig=="gif" || $ext_orig=="png")
		$ext="png";	
	
	$arSize=getimagesize($sFullPath);
	if($arSize[0]<=$w && $arSize[1]<=$h)
		return $sPath;
	
	$obCache = new CPHPCache; 
	$life_time = 0; 
	$image_id = md5($w."_".$h."_".$mode."_".$md5);
	$image_dir=substr($image_id,0,3);

	$IMAGE=$sPath;
	 
	$filename=$_SERVER["DOCUMENT_ROOT"]."/upload/resized/".$image_dir."/".$image_id.".".$ext;
	 
	if(!file_exists($filename))
	{

		$img=imagecreatefromstring(file_get_contents($sFullPath));

		$sw=$arSize[0];
		$sh=$arSize[1];
		$prop=$sw/$sh;

		$percent=($w/$sw<$h/$sh) ? $w/$sw : $h/$sh;
			
		if($mode==1) // вписать в коробку с белыми полями вокруг
		{

			if($sw>=$sh)
			{
				$percent=$w/$sw;
				$dx=0;
				$dy=($h-$percent*$sh)/2;
				$dw=$w;
				$dh=$percent*$sh;
			}
			else
			{
				$percent=$h/$sh;
				$dx=($w-$percent*$sw)/2;
				$dy=0;
				$dw=$percent*$sw;
				$dh=$h;
			}

		}
		elseif($mode==2) // вписать по ширине, высоту масштабировать
		{
			$percent=$w/$sw;
			$dx=0;
			$dy=0;
			$dw=$w;
			$dh=$percent*$sh;
			$h=$dh;
		}			
		else // вписать в коробку с обрезкой картинки
		{		
			$dw=$w;
			$dh=$h;
			if($w/$sw<$h/$sh)
			{
				$dx=($w-$h*$prop)/2;
				$dy=0;
				$dw=$prop*$h;
			}
			else
			{
				$dx=0;
				$dy=($h-$w/$prop)/2;
				$dh=$sh/$sw*$w;
			}
	
		}

		$img2=imagecreatetruecolor($w, $h);
		if($img===false || $img2===false)
			return $sPath;

		imagealphablending($img2, false);
		$bgcolor = imagecolortransparent($img);    
		imagefill($img2, 0,0, $bgcolor);
		imagecolortransparent($img2, $bgcolor);
		imagesavealpha($img2, true);		

		imagecopyresampled($img2, $img, $dx, $dy, 0, 0, $dw, $dh, $sw, $sh);

		if(!is_dir($_SERVER["DOCUMENT_ROOT"]."/upload/resized"))
			mkdir($_SERVER["DOCUMENT_ROOT"]."/upload/resized", BX_DIR_PERMISSIONS);
		
		if(!is_dir($_SERVER["DOCUMENT_ROOT"]."/upload/resized/".$image_dir))
			mkdir($_SERVER["DOCUMENT_ROOT"]."/upload/resized/".$image_dir, BX_DIR_PERMISSIONS);
		
		if($ext_orig=="gif" || $ext_orig=="png")
			imagepng($img2, $filename);
		else
			imagejpeg($img2, $filename, 85);
			
		$IMAGE="/upload/resized/".$image_dir."/".$image_id.".".$ext;
	}
	else
		$IMAGE="/upload/resized/".$image_dir."/".$image_id.".".$ext;
		
	return $IMAGE;	
}

function ruDecline($n, $var1, $var2, $var3)
{
	$n = abs($n) % 100;
	$n1 = $n % 10;
	if ($n > 10 && $n < 20) return $var3;
	if ($n1 > 1 && $n1 < 5) return $var2;
	if ($n1 == 1) return $var1;
	return $var3;
}

global $AR_CUR_SIMBOL;
$AR_CUR_SIMBOL = array("USD"=>"$", "EUR"=>"€", "RUB"=>"Р", "CNY"=>"Ұ");

AddEventHandler("sale", "OnSalePayOrder", "PostUserMony");
function PostUserMony($ID, $val)
{
	$arOrder=CSaleOrder::GetByID($ID);
	
	$dbBasketItems = CSaleBasket::GetList(
	array(
	"NAME" => "ASC",
	"ID" => "ASC"
			),
			array(
			"ORDER_ID" => intval($ID)
					),
					false,
					false,
					array("ID")
	);
	while ($arBasketItems = $dbBasketItems->Fetch()):
	
	$PROPS = array();
	$db_res = CSaleBasket::GetPropsList(
			array(
					"SORT" => "ASC",
					"NAME" => "ASC"
			),
			array("BASKET_ID" => intval($arBasketItems["ID"]))
	);
	while ($ar_res = $db_res->Fetch())
	{
		$PROPS[$ar_res["CODE"]] = $ar_res["VALUE"];
	}
	
	global $USER;
	CModule::IncludeModule("sale");
	$dbAccountCurrency = CSaleUserAccount::GetList(
			array(),
			array("USER_ID" => intval($arOrder["USER_ID"]))
	);
	while($arAccountCurrency = $dbAccountCurrency->Fetch())
	{
		if($PROPS["CURRENCY"]!=$arAccountCurrency["CURRENCY"]):
			CSaleUserAccount::Delete(intval($arAccountCurrency["ID"]));
		else:
		
		$sumMoney = $PROPS["PRICE"];
		
		
		if($sumMoney>0)
		{
			$arFields = array();
			$arFields["USER_ID"] = intval($arOrder["USER_ID"]);
			$arFields["AMOUNT"] = $sumMoney;
			$arFields["CURRENCY"] = $PROPS["CURRENCY"];
			$arFields["DEBIT"] = "Y";
			$arFields["NOTES"] = "Пополнение счёта пользователем";
			CSaleUserTransact::Add($arFields);
			
			
			$arFields = array();
			$arFields["USER_ID"] = intval($arOrder["USER_ID"]);
			$arFields["CURRENT_BUDGET"] = $arAccountCurrency["CURRENT_BUDGET"]+$sumMoney;
			CSaleUserAccount::Update($arAccountCurrency["ID"],$arFields);
		}
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."/test.txt", print_r($PROPS, TRUE), FILE_APPEND | LOCK_EX);
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."/test.txt", print_r($arAccountCurrency, TRUE), FILE_APPEND | LOCK_EX);
		endif;
	}
	
	endwhile;
}

function OnBeforeUserUpdateHandler(&$arFields)
{
    $arFields["LOGIN"] = $arFields["EMAIL"];
    return $arFields;
}
?>