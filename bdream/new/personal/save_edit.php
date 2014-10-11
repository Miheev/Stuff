<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<? 
CModule::IncludeModule("iblock");
global $USER;
$USER_ID = $USER->GetID();
if($_REQUEST["ACTION"]=="SAVE_NAME")
{
	if($_REQUEST["NAME"])
	{
		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=>2, "PROPERTY_USER"=>intval($USER_ID));
		$rsDream = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		if($arDream = $rsDream->Fetch())
		{
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
					"NAME"=> htmlspecialcharsEx($_REQUEST["NAME"])
			);
			$res = $el->Update(intval($arDream["ID"]), $arLoadProductArray);
			
			if(intval($_REQUEST["TURBO"])>=0)
			{
				CIBlockElement::SetPropertyValueCode(intval($arDream["ID"]), "TURBO_NEED", intval($_REQUEST["TURBO"]));
			}	
			echo "OK";
		}
	}
}
else
{
	$PROP_CODE = $_REQUEST["PROP"];
	if($USER_ID && isset($_REQUEST["PROP"])&& $_REQUEST["PROP"])
	{
		if($_REQUEST["PROP"]=="DETAIL_TEXT")
		{
			$DETAIL_TEXT = trim(strip_tags($_REQUEST[$PROP_CODE], "<br>"), "<br />");
		}
		else 
		{
			$PROP_TEXT = trim(strip_tags($_REQUEST[$PROP_CODE], "<br>"), "<br />");
		}

		$arSelect = Array("ID", "NAME");
		$arFilter = Array("IBLOCK_ID"=>2, "PROPERTY_USER"=>intval($USER_ID));
		$rsDream = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		if($arDream = $rsDream->Fetch())
		{
			if($DETAIL_TEXT)
			{
				$el = new CIBlockElement;
				$arLoadProductArray = Array(
						"MODIFIED_BY"    => $USER_ID,
						"DETAIL_TEXT"    => $DETAIL_TEXT	
				);
				$res = $el->Update(intval($arDream["ID"]), $arLoadProductArray);
				if($res)
				{
					echo $DETAIL_TEXT;
				}
				else
				{
					echo "error";
				}
			}
			elseif($PROP_TEXT)
			{
				CIBlockElement::SetPropertyValueCode(intval($arDream["ID"]), $PROP_CODE, array(array("TYPE"=>"HTML", "TEXT"=>$PROP_TEXT)));
				echo $PROP_TEXT;
			}
			else
			{
				echo "error";
			}
		}
		else
		{
			echo "error_exists";
		}
	}
	else
	{
		echo "error";
	}
}
?>