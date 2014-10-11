<?
define("STOP_STATISTICS", true);
define("PUBLIC_AJAX_MODE", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$arResult = array();
if(CModule::IncludeModule("sale"))
{
	if(!empty($_REQUEST["search"]) && is_string($_REQUEST["search"]))
	{
		$search = $APPLICATION->UnJSEscape($_REQUEST["search"]);

		$arParams = array();
		$params = explode(",", $_REQUEST["params"]);
		foreach($params as $param)
		{
			list($key, $val) = explode(":", $param);
			$arParams[$key] = $val;
		}

		
		if($_REQUEST["type"]=="city")
		{
			$rsLocationsList = CSaleLocation::GetList(
					array(
							"CITY_NAME_LANG" => "ASC",
							"COUNTRY_NAME_LANG" => "ASC",
							"SORT" => "ASC",
					),
					array(
							"~CITY_NAME" => $search."%",
							"LID" => LANGUAGE_ID,
					),
					false,
					array("nTopCount" => 10),
					array(
							"ID", "CITY_ID", "CITY_NAME", "COUNTRY_NAME_LANG", "REGION_NAME_LANG"
					)
			);
			while ($arCity = $rsLocationsList->GetNext())
			{
				$arResult[] = $arCity["CITY_NAME"];
			}
		}
		elseif($_REQUEST["type"]=="country")
		{
			$rsLocationsList = CSaleLocation::GetList(
					array(
							"COUNTRY_NAME_LANG" => "ASC",
							"SORT" => "ASC",
					),
					array(
							"~COUNTRY_NAME" => $search."%",
							"LID" => LANGUAGE_ID,
							"CITY_ID" => false,
							"REGION_ID" => false,
					),
					false,
					array("nTopCount" => 10),
					array(
							"ID", "COUNTRY_NAME_LANG"
					)
			);
			while ($arCity = $rsLocationsList->GetNext())
			{
				$arResult[] = $arCity["COUNTRY_NAME_LANG"];
			}
		}
		
		
		/*$rsLocationsList = CSaleLocation::GetList(
			array(
				"CITY_NAME_LANG" => "ASC",
				"COUNTRY_NAME_LANG" => "ASC",
				"SORT" => "ASC",
			),
			array(
				"~REGION_NAME" => $search."%",
				"LID" => LANGUAGE_ID,
				"CITY_ID" => false,
			),
			false,
			array("nTopCount" => 10),
			array(
				"ID", "CITY_ID", "CITY_NAME", "COUNTRY_NAME_LANG", "REGION_NAME_LANG"
			)
		);
		while ($arCity = $rsLocationsList->GetNext())
		{
			$arResult[] = array(
				"ID" => $arCity["ID"],
				"NAME" => "",
				"REGION_NAME" => $arCity["REGION_NAME_LANG"],
				"COUNTRY_NAME" => $arCity["COUNTRY_NAME_LANG"],
			);
		}
		$rsLocationsList = CSaleLocation::GetList(
			array(
				"COUNTRY_NAME_LANG" => "ASC",
				"SORT" => "ASC",
			),
			array(
				"~COUNTRY_NAME" => $search."%",
				"LID" => LANGUAGE_ID,
				"CITY_ID" => false,
				"REGION_ID" => false,
			),
			false,
			array("nTopCount" => 10),
			array(
				"ID", "COUNTRY_NAME_LANG"
			)
		);
		while ($arCity = $rsLocationsList->GetNext())
		{
			$arResult[] = array(
				"ID" => $arCity["ID"],
				"NAME" => "",
				"REGION_NAME" => "",
				"COUNTRY_NAME" => $arCity["COUNTRY_NAME_LANG"],
			);
		}*/
	}
}
$arResult = array_values(array_unique(array_diff($arResult, array(''))));
echo json_encode($arResult);

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");
die();

?>